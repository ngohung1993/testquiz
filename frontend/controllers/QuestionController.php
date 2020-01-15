<?php

namespace frontend\controllers;

use Yii;
use Throwable;
use common\models\Exam;
use common\models\Question;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\ExamQuestion;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

class QuestionController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete'],
                'rules' => [
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ]
            ]
        ];
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDelete()
    {
        if ($post = Yii::$app->request->post()) {
            $exam = Exam::findOne($post['exam_id']);
            $model = Question::findOne($post['question_id']);

            $exam_question = ExamQuestion::find()->where(['question_id' => $post['question_id']])->andWhere(['exam_id' => $post['exam_id']])->one();

            if ($exam_question && $exam->user_id == $this->user->id && ($exam->status == Exam::KHO_USER || $exam->status == Exam::KHONG_DUYET)) {
                $model->delete();
                $exam_question->delete();
            }

            return $this->redirect(['exam/question', 'id' => $post['exam_id']]);
        }

        return $this->redirect(['exam/index']);
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}