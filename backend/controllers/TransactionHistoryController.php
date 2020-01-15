<?php

namespace backend\controllers;


use common\models\AccountBank;
use common\models\Message;
use common\models\User;
use Yii;
use common\models\TransactionHistory;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\base\AdminController;

/**
 * TransactionHistoryController implements the CRUD actions for TransactionHistory model.
 */
class TransactionHistoryController extends AdminController
{
    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * @param null $user
     * @param null $start
     * @param null $type
     * @param null $end
     * @param null $amount
     * @return string
     */
    public function actionIndex($user = null, $start = null, $end = null)
    {
        $query = TransactionHistory::find()
            ->joinWith('user')
            ->where(['AND', ['<>','transaction_history.type',TransactionHistory::SELL_EXAM], ['<>','transaction_history.type',TransactionHistory::BY_EXAM]])
            ->andWhere(['=','transaction_history.status', TransactionHistory::ADMIN_HANDLING]);

        if($user){
            $query->andWhere(['like', 'user.name', $user]);
        }

        if($start){
            $query->andWhere(['>=', 'transaction_history.time', $start]);
        }

        if ($end) {
            $query->andWhere(['<=', 'transaction_history.time', $end]);
        }


        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $transactions = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('index', [
            'transactions' => $transactions,
            'pages' => $pages,
            'user' => $user,
            'start' => $start,
            'end' => $end,
        ]);
    }

    /**
     * @param null $user
     * @param null $status
     * @param null $type
     * @param null $start
     * @param null $end
     * @return string
     */
    public function actionHander($user = null, $status = null, $type = null, $start = null, $end = null )
    {
        $query = TransactionHistory::find()
            ->joinWith('user')
            ->where(['AND', ['<>','transaction_history.type',TransactionHistory::SELL_EXAM], ['<>','transaction_history.type',TransactionHistory::BY_EXAM]])
            ->andWhere(['<>','transaction_history.status', TransactionHistory::ADMIN_HANDLING]);

        if($user){
            $query->andWhere(['like', 'user.name', $user]);
        }

        if($status){
            $query->andWhere(['=', 'transaction_history.status', $status]);
        }

        if($type){
            $query->andWhere(['=', 'transaction_history.type', $type]);
        }

        if($start){
            $query->andWhere(['>=', 'transaction_history.time', $start]);
        }

        if ($end) {
            $query->andWhere(['<=', 'transaction_history.time', $end]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $transactions = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('hander', [
            'transactions' => $transactions,
            'pages' => $pages,
            'user' => $user,
            'status' => $status,
            'type' => $type,
            'start' => $start,
            'end' => $end
        ]);
    }

    /**
     * @param $content
     * @param $user
     * @return bool
     */
    private function message($content,$user)
    {
        $message = new Message();

        $message->message = $content ;
        $message->user_id = $user;
        $message->type = Message::SEND_USER;

        return $message->save();

    }
    /**
     * Displays a single TransactionHistory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $account = AccountBank::findOne($model['account_id']);

        return $this->render('view', [
            'model' => $model,
            'account' => $account
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViews($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne($model->user_id);

        return $this->render('views', [
            'model' => $model,
            'user' => $user
        ]);
    }

    /**
     * Creates a new TransactionHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransactionHistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransactionHistory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $account = AccountBank::findOne($model['account_id']);
        $user = User::findOne($model['user_id']);

        if ($model->load(Yii::$app->request->post())) {

            $model->status = TransactionHistory::SUCCESS;

            $content = 'Giao dịch thành công: Bạn rút thành công số tiền là '.number_format($model->amount,0,',','.').' đ vào tài khoản ngân hàng. Vui lòng kiểm tra ';
            $this->message($content,$user->id);

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'account' => $account
        ]);
    }

    public function actionHistory($user_id)
    {
        $user = User::findOne($user_id);
        $query = TransactionHistory::find()
            ->where(['user_id'=> $user_id])
            ->andWhere(['type'=> TransactionHistory::RECHARGE]);

        $pages = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $transactions = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('history',[
            'transactions' => $transactions,
            'pages' => $pages,
            'user' => $user
        ]);
    }
    /**
     * Deletes an existing TransactionHistory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $status
     * @param $check
     * @throws NotFoundHttpException
     */
    public function checkStatus($status, $check)
    {
        if($status != $check ){
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }


    /**
     * Finds the TransactionHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransactionHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransactionHistory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
