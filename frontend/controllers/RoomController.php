<?php

namespace frontend\controllers;

use Yii;
use common\models\Room;
use common\models\Exam;
use yii\data\Pagination;
use yii\db\Expression;
use common\models\UserExam;
use yii\filters\VerbFilter;
use common\models\Question;
use yii\filters\AccessControl;
use common\models\ExamQuestion;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

class RoomController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'result'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'result'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST']
                ]
            ]
        ];
    }

    /**
     * @param $exam_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCreate($exam_id)
    {
        $this->checkUserExam($exam_id);

        $exam = Exam::findOne($exam_id);

        $room = new Room();
        $room->exam_id = $exam['id'];
        $room->user_id = $this->user->id;

        if ($exam->type == Exam::CUSTOM) {
            $questions = Question::find()->where(['id' => ExamQuestion::find()->select('question_id')->where(['exam_id' => $exam_id])])->orderBy(new Expression('rand()'))->all();

            $shuffleAnswers = $this->shuffleAnswers($questions);
            $room->questions = json_encode($shuffleAnswers);
        }

        $room->save();

        return $this->redirect(['index', 'id' => $room->id]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        $this->layout = 'room';

        $room = $this->findModel($id);

        if ($room->status == Room::STATUS_CLOSED) {
            return $this->redirect(['result', 'id' => $id]);
        }

        $exam = Exam::find()->where(['id' => $room->exam_id])->one();

        $questions = [];

        if ($exam->type == Exam::CUSTOM) {
            $room->questions = json_decode($room->questions, true);

            $query = Question::find()->where(['id' => ExamQuestion::find()->select('question_id')->where(['exam_id' => $exam['id']])])->all();

            foreach ($query as $key => $value) {
                $questions[$value['id']] = $value;
            }
        }

        if (Yii::$app->request->post()) {

            $completion_time = date('H:i:s', (strtotime($exam['time']) - Yii::$app->request->post('completion_time')));

            $chooseAndMatching = json_decode(Yii::$app->request->post('answers'), true);
            $fillBlank = Yii::$app->request->post('fill');

            $answers = $this->mergeAnswer($chooseAndMatching, $fillBlank);

            if ($exam['type'] == Exam::CUSTOM) {
                $result = $this->gradingExamCustom($room, $questions, $answers);
            } else {
                $result = $this->gradingExamUpload(json_decode($exam['answer'], true), $answers);
            }

            $room->status = Room::STATUS_CLOSED;
            $room->scores = $result['scores'];
            $room->answers = json_encode($result['answers']);
            $room->questions = json_encode($room->questions);
            $room->completion_time = $completion_time;

            $room->save();

            return $this->redirect(['result', 'id' => $id]);
        }

        $view = $exam['type'] == Exam::CUSTOM ? 'index' : 'index-upload';

        return $this->render($view, [
            'exam' => $exam,
            'room' => $room,
            'questions' => $questions
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionResult($id)
    {
        $this->layout = 'room';

        $room = $this->findModel($id);

        if ($room->status == Room::STATUS_OPENING) {
            return $this->redirect(['index', 'id' => $id]);
        }

        $room->answers = json_decode($room->answers, true);
        $room->questions = json_decode($room->questions, true);

        $exam = Exam::find()->where(['id' => $room->exam_id])->one();

        $query = Question::find()->where(['id' => ExamQuestion::find()->select('question_id')->where(['exam_id' => $exam['id']])])->all();

        $questions = [];
        foreach ($query as $key => $value) {
            $questions[$value['id']] = $value;
        }

        $test_times = Room::find()->where(['user_id' => $this->user->id, 'exam_id' => $room->exam_id])->count();

        $view = $exam['type'] == Exam::CUSTOM ? 'result' : 'result-upload';

        return $this->render($view, [
            'exam' => $exam,
            'room' => $room,
            'test_times' => $test_times,
            'questions' => $questions
        ]);
    }

    /**
     * @param $questions
     * @return array
     */
    protected function shuffleAnswers($questions)
    {
        $shuffleAnswers = [];

        foreach ($questions as $key => $question) {
            switch ($question['type']) {
                case Question::TYPE_CHOOSE:
                case Question::TYPE_MATCHING:

                    $shuffleAnswers[$question['id']] = array_keys($this->shuffleKeepKey(json_decode($question['answer'], true)));

                    break;
                default:
                    $shuffleAnswers[$question['id']] = [];
                    break;
            }
        }

        return $shuffleAnswers;
    }

    /**
     * @param $array
     * @return array
     */
    protected function shuffleKeepKey($array)
    {
        $shuffled_array = array();

        $keys = array_keys($array);
        shuffle($keys);

        foreach ($keys as $key) {
            $shuffled_array[$key] = $array[$key];
        }

        return $shuffled_array;
    }

    /**
     * @param $chooseAndMatching
     * @param $fillBlank
     * @return array
     */
    protected function mergeAnswer($chooseAndMatching, $fillBlank)
    {
        $result = [];

        if ($chooseAndMatching) {
            foreach ($chooseAndMatching as $key => $value) {
                $result[$key]['answers'] = str_split($value);
                $result[$key]['result'] = false;
            }
        }

        if ($fillBlank) {
            foreach ($fillBlank as $key => $value) {
                $result[$key]['answers'] = $value;
                $result[$key]['result'] = false;
            }
        }

        return $result;
    }

    /**
     * @param $answers
     * @param $result
     * @return array
     */
    protected function gradingExamUpload($answers, $result)
    {
        $scores = 0;

        foreach ($answers as $key => $value) {
            if (isset($result[$key]) && in_array($value, $result[$key]['answers'])) {
                $scores++;
                $result[$key]['result'] = true;
            }
        }

        return ['scores' => $scores, 'answers' => $result];
    }

    /**
     * @param $room
     * @param $questions
     * @param $answers
     * @return array
     */
    protected function gradingExamCustom($room, $questions, $answers)
    {
        $scores = 0;
        $keyAnswers = ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3];

        foreach ($questions as $key => $question) {
            if (isset($answers[$question['id']])) {
                switch ($question['type']) {
                    case (Question::TYPE_CHOOSE):
                        $answers_correct = json_decode($question['answer_correct'], true);

                        $temp = 0;

                        foreach ($answers[$question['id']]['answers'] as $answer) {
                            if ($answer && $keyAnswers[$answer]) {
                                $temp += isset($answers_correct[$room['questions'][$question['id']][$keyAnswers[$answer]]]) ? 1 : 0;
                            }
                        }

                        if ($temp == count($answers_correct)) {
                            $scores++;
                            $answers[$question['id']]['result'] = true;
                        }

                        break;
                    case (Question::TYPE_FILL):
                        $answers_correct = json_decode($question['answer'], true);

                        $temp = 0;

                        foreach ($answers[$question['id']]['answers'] as $k => $answer) {
                            $temp += (($answers_correct[$k] == $answer) ? 1 : 0);
                        }

                        if ($temp == count($answers_correct)) {
                            $scores++;
                            $answers[$question['id']]['result'] = true;
                        }

                        break;
                    case (Question::TYPE_MATCHING):
                        $answers_correct = json_decode($question['answer'], true);

                        $str1 = $str2 = '';

                        foreach ($answers_correct as $key1 => $value1) {
                            $str1 .= $key1;
                        }

                        foreach ($answers[$question['id']]['answers'] as $key2 => $value2) {
                            $str2 .= $room['questions'][$question['id']][$value2];
                        }

                        if ($str1 == $str2) {
                            $scores++;
                            $answers[$question['id']]['result'] = true;
                        }

                        break;
                    default:
                        break;
                }
            }
        }

        return ['scores' => $scores, 'answers' => $answers];
    }

    /**
     * @param $exam_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionHistory($exam_id)
    {
        $this->layout = 'room';
        $exam = Exam::findOne($exam_id);

        if (!$exam) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $query = Room::find()->where(['exam_id' => $exam_id])->andWhere(['user_id' => $this->user->id]);

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $test_times = Room::find()->where(['user_id' => $this->user->id, 'exam_id' => $exam_id])->count();
        $rooms = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();


        return $this->render('history', [
            'user' => $this->user,
            'exam' => $exam,
            'rooms' => $rooms,
            'pages' => $pages,
            'test_times' => $test_times
        ]);
    }

    /**
     * @param $id
     * @return bool
     * @throws NotFoundHttpException
     */
    protected function checkUserExam($id)
    {
        if (UserExam::find()->where(['exam_id' => $id])->one() || Exam::find()->where(['user_id' => $this->user->id])->andWhere(['id' => $id])->one()) {
            return true;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null && $model->user_id == $this->user->id) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}