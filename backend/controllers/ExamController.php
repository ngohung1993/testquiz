<?php

namespace backend\controllers;

use common\models\Message;
use common\models\ReportQuestion;
use common\models\Topic;
use common\models\Question;
use Yii;
use common\models\Exam;
use common\models\ExamQuestion;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;

/**
 * ExamController implements the CRUD actions for Exam model.
 */
class ExamController extends AdminController
{
    /**
     * @param null $status
     * @param null $title
     * @param null $user
     * @param null $topic
     * @param null $deal
     * @return string
     */
    public function actionIndex($status = null, $title = null, $user = null, $topic = null, $deal = null)
    {
        if (!$status) {
            $status = Exam::CHO_DUYET;
        }

        $query = Exam::find()->joinWith('topic')->joinWith('user')
            ->where(['topic.active'=> Topic::ACTIVE])
            ->andWhere(['topic.status'=> Topic::DUYET])
            ->andWhere(['exam.status' => $status])
            ->andWhere(['<>', 'exam.status', Exam::KHO_USER])
            ->andWhere(['exam.disable'=> 1]);

        if($title){
            $query->andWhere(['like', 'exam.title', $title]);
        }

        if($user){
            $query->andWhere(['like', 'user.name', $user]);
        }

        if($topic){
            $query->andWhere(['like', 'topic.title', $topic]);
        }

        if($deal){
            $query->andWhere(['=','exam.admin_show_hide', $deal]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('index', [
            'exams' => $exams,
            'pages' => $pages,
            'status' => $status,
            'title' => $title,
            'user' => $user,
            'deal' => $deal,
            'topic' => $topic
        ]);
    }

    /**
     * Displays a single Exam model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $exam = $this->findModel($id);
        $topic = Topic::findOne($exam->topic_id);

        $questions = Question::find()->where(['id' => ExamQuestion::find()->select('question_id')->where(['exam_id' => $id])])->all();

        if (Yii::$app->request->post()) {
            $exam->status = Exam::DUYET;

            $exam->save(false);

            $content = 'Đề thi <span style="color: #5bc0de">' . $exam->title . '</span> duyệt thành công.';
            $this->message($content, $exam->user_id);

            return $this->redirect(['topic/views', 'id' => $topic->id]);
        }

        $view = $exam->type == Exam::CUSTOM ? 'view' : 'view-upload';

        return $this->render($view, [
            'exam' => $this->findModel($id),
            'questions' => $questions,
            'topic' => $topic
        ]);
    }

    /**
     * @param $content
     * @param $user
     * @return bool
     */
    private function message($content, $user)
    {
        $message = new Message();
        $message->message = $content;
        $message->user_id = $user;
        $message->type = Message::SEND_USER;
        return $message->save(false);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionReject($id)
    {
        $exam = $this->findModel($id);

        if ($exam->load(Yii::$app->request->post())) {
            $exam->status = Exam::KHONG_DUYET;

            $exam->save(false);

            $content = 'Đề thi <span style="color: #5bc0de">' . $exam->title . '</span> không được duyệt. Lý do không duyệt: ' . $exam->reason_reject;

            $this->message($content, $exam->user_id);
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param $topic_id
     * @param null $status
     * @return string
     */
    public function actionExamTopic($topic_id, $status = null)
    {
        $query = Exam::find()->where(['topic_id' => $topic_id])->andWhere(['<>', 'status', Exam::KHO_USER]);

        $query->andWhere(['status' => $status]);

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('exam-topic', [
            'exams' => $exams,
            'pages' => $pages,
            'status' => $status
        ]);
    }

    /**
     * @param null $title
     * @param null $user
     * @param null $topic
     * @return string
     */
    public function actionUserDelete($title = null, $user = null, $topic = null)
    {
        $query = Exam::find()
            ->joinWith('topic')
            ->joinWith('user')
            ->where(['exam.disable' => 0])
            ->andWhere(['<>', 'exam.status', Exam::KHO_USER])
            ->orWhere(['topic.active'=>Topic::NO_ACTIVE]);

        if($title){
            $query->andWhere(['like', 'exam.title', $title]);
        }

        if($user){
            $query->andWhere(['like', 'user.name', $user]);
        }

        if($topic){
            $query->andWhere(['like', 'topic.title', $topic]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('user-delete', [
            'exams' => $exams,
            'pages' => $pages,
            'title' => $title,
            'user' => $user,
            'topic' => $topic
        ]);
    }

    /**
     * @param null $title
     * @param null $user
     * @param null $topic
     * @return string
     */
    public function actionError($title = null, $user = null, $topic = null)
    {
        $query = Exam::find()
            ->innerJoin('exam_question','exam.id = exam_question.exam_id')
            ->innerJoin('question','question.id = exam_question.question_id')
            ->innerJoin('report_question','report_question.question_id = question.id')
            ->where(['<>','report_question.status', ReportQuestion::STATUS_SUCCESS])
            ->orWhere(['exam.status'=> Exam::EXAM_ERROR]);

        $query->joinWith('user')->joinWith('topic');

        if($title){
            $query->andWhere(['like', 'exam.title', $title]);
        }

        if($user){
            $query->andWhere(['like', 'user.name', $user]);
        }

        if($topic){
            $query->andWhere(['like', 'topic.title', $topic]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);
        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('error',[
            'exams' => $exams,
            'pages' => $pages,
            'title' => $title,
            'user' => $user,
            'topic' => $topic
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetailError($id)
    {
        $exam = $this->findModel($id);
        $topic = Topic::findOne($exam->topic_id);

        $reportQuestion = ReportQuestion::find()
            ->innerJoin('question','report_question.question_id = question.id')
            ->innerJoin('exam_question','exam_question.question_id = question.id')
            ->innerJoin('exam','exam.id = exam_question.exam_id')
            ->where(['exam.id'=> $id])
            ->asArray()
            ->all();

        $countErrorSuccess = $this->queryReportQuestion($id);

        return $this->render('detail-error',[
            'exam' => $exam,
            'topic' => $topic,
            'reportQuestion' => $reportQuestion,
            'countErrorSuccess' => $countErrorSuccess
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionWork($id)
    {
        $exam = $this->findModel($id);

        if ($exam->load(Yii::$app->request->post())) {

            $exam->status = Exam::DUYET;

            $exam->save(false);

            $content = 'Đề thi <span style="color: #5bc0de">' . $exam->title . '</span> được hoạt động trở lại';

            $this->message($content, $exam->user_id);
        }

        return $this->redirect(['/exam/error']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionShow($id, $pages)
    {
        $exam  = $this->findModel($id);

        $exam->admin_show_hide = Exam::ADMIN_SHOW;

        $exam->reason_reject = null;

        $content = 'Đề thi <span style="color: #5bc0de">' . $exam->title . '</span> được bật hoạt động trở lại';

        $this->message($content, $exam->user_id);

        $exam->save();

        return $this->redirect(['exam/index','status' => Exam::DUYET]);
    }

    /**
     * @param $id
     * @param $status
     * @return \yii\db\ActiveQuery
     */
    private function queryReportQuestion($id, $status = null)
    {
        $query = ReportQuestion::find()
            ->innerJoin('question','report_question.question_id = question.id')
            ->innerJoin('exam_question','exam_question.question_id = question.id')
            ->innerJoin('exam','exam.id = exam_question.exam_id')
            ->where(['exam.id'=> $id])
            ->andWhere(['report_question.status' => ReportQuestion::STATUS_SUCCESS])
            ->count();

        return $query;
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exam::findOne($id)) !== null && $model->status != Exam::KHO_USER) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}