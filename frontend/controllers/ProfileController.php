<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use common\models\Exam;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;
use yii\filters\AccessControl;
use common\models\Topic;

class ProfileController extends BaseController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['introduce', 'information', 're-password'],
                'rules' => [
                    [
                        'actions' => ['introduce', 'information', 're-password'],
                        'allow' => true,
                        'roles' => [
                            '@'
                        ],
                    ],
                ],
            ],
        ];
    }

    public function actionIntroduce()
    {
        $this->layout = 'profile';
        return $this->render('introduce');
    }

    public function actionInformation()
    {
        $this->layout = 'profile';
        return $this->render('information');
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionRePassword()
    {
        $this->layout = 'profile';
        if (!$this->user || $this->user->auth != null) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        return $this->render('re-password', ['model' => $this->user]);
    }

    /**
     * @param $user_id
     * @param null $price
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPersonal($user_id, $price = null)
    {
        $this->layout = 'main';

        $user = User::findOne($user_id);

        if ($user == null) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        $query = Exam::find()->joinWith('topic')
            ->where(['topic.active' => Topic::ACTIVE])
            ->andWhere(['exam.disable' => Exam::BLOCK])
            ->andWhere(['exam.status' => Exam::DUYET])
            ->andWhere(['exam.user_id' => $user['id']]);

        if ($price == 'free') {
            $query->andWhere(['price' => 0]);
        }

        if ($price === 'paid') {
            $query->andWhere(['<>', 'price', 0]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->all();

        return $this->render('personal', [
            'user' => $user,
            'exams' => $exams,
            'pages' => $pagination,
            'price' => $price
        ]);
    }
}