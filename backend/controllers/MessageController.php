<?php

namespace backend\controllers;

use Yii;
use common\models\Message;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

class MessageController extends BaseController
{
    public function actionIndex($user= null)
    {
        $query = Message::find()->joinWith('user')->where(['type'=> Message::SEND_ADMIN]);

        if($user){
            $query->andFilterWhere(['like', 'user.name', $user]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $messages = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();

        $count = Message::find()->where(['type'=> Message::SEND_ADMIN])->count();

        return $this->render('index',[
            'messages' => $messages,
            'user' => $user,
            'pages' => $pages,
            'count' => $count,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * @param int $id
     * @return Message|\common\models\User|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
