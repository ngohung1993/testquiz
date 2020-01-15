<?php

namespace frontend\controllers;

use common\models\Exam;
use common\models\Message;
use frontend\controllers\base\BaseController;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class MessageController extends BaseController
{
    /**
     * @return string
     */

    public function actionIndex()
    {
        $this->layout = 'profile';
        $query = Message::find()->where(['user_id'=> $this->user->id])->andWhere(['type'=> Message::SEND_USER]);

        $pages = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $messages = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();

        return $this->render('index',[
            'pages' => $pages,
            'messages' => $messages
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
        $model = $this->findModel($id);

        if($model){
            $model->delete();
        }
        return $this->redirect('index');
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
