<?php

namespace backend\controllers;

use common\models\Message;
use common\models\TransactionHistory;
use common\models\User;
use frontend\controllers\base\BaseController;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class RechargeController extends BaseController
{
    public function actionIndex($code = null, $name=null, $email=null)
    {
        $result = $code;
        if(substr($code,0,4)=='#000'){
            $code = substr($code,4,4);
        }

        $query = User::find()->where(['>','permission', User::ROLE_ADMIN]);

        if($code){
            $query->andWhere(['=','id', $code]);
        }

        if($name){
            $query->andFilterWhere(['like', 'name', $name]);
        }

        if($email){
            $query->andFilterWhere(['like', 'email', $email]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $users = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('index',[
            'users' => $users,
            'pages' => $pages,
            'result' => $result,
            'name' => $name,
            'email' => $email

        ]);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $requet = Yii::$app->request->post();

            $model->wallet += $requet['money'];

            $model->save();

            $this->transaction($requet['money'], $requet['message-transaction'], $model->id);

            $content = 'Giao dịch thành công: Bạn vừa nạp thành công số tiền <span style="color: red">'.number_format($requet['money'], 0, ",", ".").'</span> đ vào tài khoản hệ thống. Vui lòng kiểm tra';
            $this->message($model->id,$content);

            return $this->redirect(['transaction-history/history','user_id'=> $model->id]);
        }
            return $this->render('update',[
            'model' => $model
        ]);
    }

    /**
     * @param $money
     * @param $user
     * @return bool
     */
    private function transaction($money, $message, $user_id)
    {
        $transaction = new TransactionHistory();

        $transaction->code = 'GD'.$user_id.'-'.time();
        $transaction->amount = $money;
        $transaction->message = $message;
        $transaction->type = TransactionHistory::RECHARGE;
        $transaction->status = TransactionHistory::SUCCESS;
        $transaction->user_id = $user_id;
        $transaction->time = date('Y-m-d', time() + 7 * 3600);

        return $transaction->save(false);
    }

    /**
     * @param $money
     * @param $user
     * @param $content
     * @return bool
     */
    private function message($user, $content)
    {
        $message = new Message();
        $message->message = $content ;
        $message->user_id = $user;
        $message->type = Message::SEND_USER;

        return $message->save();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
