<?php

namespace backend\controllers\base;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\components\AccessRule;
use common\models\User;

/**
 * BaseController implements the CRUD actions for Course model.
 */
class SeniorController extends Controller
{
    /***
     * @var User
     */
    public $user;

	/**
	 * @inheritdoc
	 * @throws NotFoundHttpException
	 */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        if (!Yii::$app->user->isGuest) {
            $this->user = $this->findModel(Yii::$app->user->identity->getId());
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'index', 'update', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ]
                    ],
                ],
            ],
        ];
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }
}
