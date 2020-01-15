<?php

namespace backend\controllers;

use common\models\Topic;
use common\models\Exam;
use common\models\TransactionHistory;
use Yii;
use Throwable;
use common\models\User;
use common\models\SignupForm;
use yii\data\Pagination;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use backend\controllers\base\SeniorController;

class UserController extends SeniorController
{
    /**
     * @param $name
     * @param $email
     * @param $status
     * @param $permissions
     * @return array
     */
    private function search($name, $email, $status, $permissions)
    {
        $query = User::find()->where(['permission' => $permissions]);

        if ($name) {
            $query->andWhere(['like', 'name', $name]);
        }

        if ($email) {
            $query->andWhere(['like', 'email', $email]);
        }

        if ($status != null) {
            $query->andWhere(['=', 'status', $status]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $users = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();

        return [
            'users' => $users,
            'pages' => $pages,
        ];
    }

    /**
     * @param null $name
     * @param null $email
     * @param null $status
     * @return string
     */
    public function actionStaff($name = null, $email = null, $status = null)
    {
        $permissions = [
            User::ROLE_ADMIN,
            User::ROLE_CENSOR,
            User::ROLE_EDITOR,
            User::ROLE_CASHIER
        ];

        $results = $this->search($name, $email, $status, $permissions);


        return $this->render('staff', [
            'users' => $results['users'],
            'pages' => $results['pages'],
            'name' => $name,
            'email' => $email,
            'status' => $status
        ]);
    }

    /**
     * @param null $name
     * @param null $email
     * @param null $status
     * @return string
     */
    public function actionClient($name = null, $email = null, $status = null)
    {
        $permissions = [
            User::ROLE_USER
        ];
        $results = $this->search($name, $email, $status, $permissions);

        return $this->render('client', [
            'users' => $results['users'],
            'pages' => $results['pages'],
            'name' => $name,
            'email' => $email,
            'status' => $status
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {

            $model->email = $model->username;
            if ($model->signup()) {
                return $this->redirect(['staff']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $this->user
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionUpdate($id)
    {
        $model = new SignupForm();

        $user = $this->findModel($id);

        $model->name = $user['name'];
        $model->phone = $user['phone'];
        $model->email = $user['email'];
        $model->address = $user['address'];
        $model->username = $user['username'];
        $model->permission = $user['permission'];

        if ($model->load(Yii::$app->request->post())) {

            $user['name'] = $model->name;
            $user['phone'] = $model->phone;
            $user['address'] = $model->address;
            $user['permission'] = $model->permission;

            $user->save();

            return $this->redirect(['staff']);
        }

        return $this->render('update', [
            'user' => $user,
            'model' => $model
        ]);
    }


    /**
     * @param $id
     * @param null $type
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id, $type = null)
    {
        if ($type == null) {
            $type = TransactionHistory::RECHARGE;
        }

        $model = $this->findModel($id);
        $query = TransactionHistory::find()->where(['user_id' => $id])->andWhere(['type' => $type]);

        $transactionPage = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
            'pageParam' => 'transaction-page',
        ]);

        $transactions = $query->offset($transactionPage->offset)->limit($transactionPage->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        $queryTopic = Topic::find()->where(['user_id'=> $id])
            ->andWhere(['status' => Topic::DUYET])
            ->andWhere(['active' => Topic::ACTIVE]);

        $topicPages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $queryTopic->count(),
            'pageParam' => 'topic-page',
        ]);

        $topics = $queryTopic->offset($topicPages->offset)->limit($topicPages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        $queryExam = Exam::find()
            ->joinWith('topic')
            ->where(['exam.user_id' => $id])
            ->andWhere(['topic.status' => Topic::DUYET])
            ->andWhere(['topic.active' => Topic::ACTIVE])
            ->andWhere(['exam.status' => Exam::DUYET])
            ->andWhere(['exam.disable' => Exam::BLOCK]);

        $examPages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $queryExam->count(),
            'pageParam' => 'exam-page',
        ]);

        $exams = $queryExam->offset($examPages->offset)->limit($examPages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('view', [
            'model' => $model,
            'transactions' => $transactions,
            'transactionPage' => $transactionPage,
            'topics' => $topics,
            'topicPages' => $topicPages,
            'exams' => $exams,
            'examPages' => $examPages,
            'type' => $type
        ]);
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