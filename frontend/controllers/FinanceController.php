<?php

namespace frontend\controllers;

use common\models\GeneralInformation;
use common\models\Message;
use common\models\TransactionHistory;
use common\models\User;
use common\models\AccountBank;
use frontend\controllers\base\BaseController;
use Yii;
use yii\data\Pagination;

class FinanceController extends BaseController
{
    /**
     * @param null $type
     * @return string|\yii\web\Response
     */
    public function actionIndex($type = null)
    {
        $this->layout = 'profile';

        if($type == null){
            $type = 1;
        }

        $totalMoney = 0;

        $user = User::findOne($this->user->id);
        $account = AccountBank::find()->where(['user_id'=> $this->user->id])->andWhere(['status'=>1])->andWhere(['type'=>1])->one();
        $query = TransactionHistory::find()->where(['user_id' => $this->user->id])->andWhere(['type'=> $type]);
        $totalTransactionStatus = TransactionHistory::find()->where(['user_id'=> $this->user->id])->andWhere(['type'=> $type])->andWhere(['status'=> TransactionHistory::SUCCESS])->all();
        $minimum_money = GeneralInformation::find()->one();

        foreach ($totalTransactionStatus as $key => $value){
            $totalMoney += $value->amount;
        }

        $model = new TransactionHistory();

        if ($model->load(Yii::$app->request->post())){

            $money = str_replace(',', '', $model->amount);
            $model->amount = $money;
            $model->user_id = $this->user->id;
            $model->time = date('Y-m-d', time() + 7 * 3600);
            $model->type = TransactionHistory::WITHDRAWAL;

            $model->save(false);

            $model->code = 'GD0'.$model->id.'-'.time();
            $model->save();

            $user->wallet -= $money;

            $user->save();
            $content = 'Giao dịch rút tiền: Thành viên <span style="color: blue">'.$this->user->name.'</span> yêu cầu rút  <span style="color: red">'.number_format($money, 0, ",", ".").'</span> đ từ tài khoản. <a style="text-decoration: underline" href="/admin/transaction-history/update?id='.$model->id.'">Admin xử lý</a>';
            $this->saveMessage($content);

            return $this->refresh();
        }

        $pages = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $transactions = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('index', [
            'user' => $user,
            'model' => $model,
            'account' => $account,
            'transactions' => $transactions,
            'type' => $type,
            'pages' => $pages,
            'totalMoney' => $totalMoney,
            'minimum_money'=> $minimum_money
        ]);
    }

    /**
     * @return string
     */
    public function actionAccount()
    {
        $this->layout = 'profile';

        $accounts = AccountBank::find()->where(['user_id'=> $this->user->id])->andWhere(['type'=> 1])->all();

        return $this->render('account', [
            'accounts' => $accounts
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreateAccount()
    {
        $this->layout = 'profile';

        $model = new AccountBank();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = $this->user->id;

            $this->status($model->status, $this->user->id);

            $model->save();

            return $this->redirect(['account']);
        }
        return $this->render('create-account', [
            'model' => $model
        ]);
    }

    private function status($status, $user)
    {
        if ($status == 1) {
            $accounts = AccountBank::find()->where(['user_id' => $user])->all();
            foreach ($accounts as $value) {
                $account = AccountBank::findOne($value->id);
                $account->status = 0;
                $account->save();
            }
        }
        return true;
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdateAccount($id)
    {
        $this->layout = 'profile';

        $model = AccountBank::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->status($model->status, $this->user->id);
            $model->save();
            return $this->redirect(['account']);
        }

        return $this->render('update-account', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $account = AccountBank::find()->where(['user_id' => $this->user->id])->andWhere(['id' => $id])->one();
        $account->type = 0;
        $account->save();

        return $this->redirect(['account']);
    }

    public function actionView($id)
    {
        $this->layout = 'profile';
        $model = TransactionHistory::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionViews($id)
    {
        $this->layout = 'profile';
        $model = TransactionHistory::findOne($id);
        $account = AccountBank::find()
            ->where(['id' => $model->account_id])
            ->andWhere(['user_id' => $this->user->id])
            ->one();

        return $this->render('views', [
            'model' => $model,
            'account' => $account,
        ]);
    }

    public function actionRecharge()
    {
        $this->layout = 'profile';
        $totalMoney = 0;
        $totalTransactionStatus = TransactionHistory::find()->where(['user_id' => $this->user->id])->andWhere(['type' => TransactionHistory::RECHARGE])->andWhere(['status' => TransactionHistory::SUCCESS])->all();

        foreach ($totalTransactionStatus as $key => $value) {
            $totalMoney += $value->amount;
        }
        $user = User::findOne($this->user->id);
        $account_admins = AccountBank::find()->where(['user_id' => User::ROLE_ADMIN])->all();
        $query = TransactionHistory::find()->where(['user_id' => $this->user->id])->andWhere(['type' => TransactionHistory::RECHARGE]);

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $transactions = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('recharge', [
            'user' => $user,
            'transactions' => $transactions,
            'pages' => $pages,
            'account_admins' => $account_admins,
            'totalMoney' => $totalMoney
        ]);
    }

    private function saveMessage($content)
    {
        $message = new Message();

        $message->message = $content;
        $message->user_id = $this->user->id;
        $message->type = Message::SEND_ADMIN;

        return $message->save();

    }

}
