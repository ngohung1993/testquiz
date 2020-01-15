<?php

namespace frontend\controllers;

use common\models\Exam;
use common\models\User;
use common\models\UserExam;
use Yii;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;
use yii\filters\AccessControl;

class UserExamController extends BaseController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['save-exam'],
                'rules' => [
                    [
                        'actions' => ['save-exam'],
                        'allow' => true,
                        'roles' => [
                            '@'
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $exam_id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionSaveExam($exam_id)
    {
        $exam = Exam::find()->where(['id' => $exam_id])->andWhere(['status' => Exam::DUYET])->one();
        $user_exam = UserExam::find()->where(['exam_id' => $exam_id])->andWhere(['user_id' => $this->user->id])->one();
        if ($user_exam) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        } else {
            if ($exam) {
                $user_exam = new UserExam();
                $user_exam->user_id = $this->user->id;
                $user_exam->exam_id = $exam_id;
                $user_exam->type = UserExam::SAVE;
                $user_exam->save();
                return true;
            } else {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
        }
    }
}
