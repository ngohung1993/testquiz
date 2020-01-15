<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Exam;
use common\models\Message;
use Yii;
use common\models\Topic;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use frontend\controllers\base\BaseController;

/**
 * TopicController implements the CRUD actions for Topic model.
 */
class TopicController extends BaseController
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
     * @param $status
     * @param null $topic
     * @param null $user
     * @param null $category
     * @return string
     */
    public function actionIndex($status, $topic = null, $user = null, $category = null)
    {
        $categories = Category::find()->all();
        $query = Topic::find()->joinWith('user')
            ->where(['topic.status'=>$status])
            ->andWhere(['topic.active'=> Topic::ACTIVE])
            ->andWhere(['<>','topic.status', Topic::KHO_USER]);

        if($topic){
            $query->andFilterWhere(['like', 'topic.title', $topic]);
        }

        if($user){
            $query->andFilterWhere(['like', 'user.name', $user]);
        }

        if($category){
            $query->andWhere(['=','category_id', $category]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $topics = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at ASC')
            ->all();


        return $this->render('index', [
            'categories'=> $categories,
            'topics' => $topics,
            'pages' => $pages,
            'status' => $status,
            'topic' => $topic,
            'user' => $user,
            'category' => $category
        ]);
    }

    public function actionUserDelete($topic = null, $user = null, $category = null)
    {
        $categories = Category::find()->all();
        $query = Topic::find()->joinWith('user')
            ->where(['topic.active'=>Topic::NO_ACTIVE])
            ->andWhere(['<>','topic.status', Topic::KHO_USER]);

        if($topic){
            $query->andFilterWhere(['like', 'topic.title', $topic]);
        }

        if($user){
            $query->andFilterWhere(['like', 'user.name', $user]);
        }

        if($category){
            $query->andWhere(['=','category_id', $category]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $topics = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at ASC')
            ->all();


        return $this->render('user-delete', [
            'categories'=> $categories,
            'topics' => $topics,
            'pages' => $pages,
            'topic' => $topic,
            'user' => $user,
            'category' => $category
        ]);
    }
    /**
     * Displays a single Topic model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $status = null)
    {
        $model = $this->findModel($id);
        $query = Exam::find()->where(['topic_id'=> $id])->andWhere(['<>','status', Exam::KHO_USER]);

        if($status== null){
            $query->all();
        }elseif($status == Exam::DUYET){
            $query->andWhere(['like','status', Exam::DUYET]);
        }elseif($status == Exam::KHONG_DUYET){
            $query->andWhere(['like','status', Exam::KHONG_DUYET]);
        }else{
            $query->andWhere(['like','status', Exam::CHO_DUYET]);
        }

        if (Yii::$app->request->post()) {

            $model->status = Topic::DUYET;
            $model->active = Topic::ACTIVE;

            $model->save(false);

            $content = 'Chủ đề <span style="color: #5bc0de">'.$model->title.'</span> duyệt thành công.';
            $this->message($content, $model->user_id);

            return $this->redirect(['views', 'id' => $id]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at ASC')
            ->all();

        return $this->render('view', [
            'model' => $model,
            'exams' => $exams,
            'pages' => $pages,
            'status' => $status
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionViews($id,$status = null)
    {
        $model = $this->findModel($id);

        $query = Exam::find()->where(['topic_id'=> $id])->andWhere(['<>','status', Exam::KHO_USER]);

        if($status== null){
            $query->all();
        }elseif($status == Exam::DUYET){
            $query->andWhere(['like','status', Exam::DUYET]);
        }elseif($status == Exam::KHONG_DUYET){
            $query->andWhere(['like','status', Exam::KHONG_DUYET]);
        }else{
            $query->andWhere(['like','status', Exam::CHO_DUYET]);
        }

        $this->checkStatus($model->status, Topic::DUYET);

        if (Yii::$app->request->post()) {

            $model->status = Topic::DUYET;

            $model->save(false);

            return $this->redirect(['index', 'status' => Topic::CHO_DUYET]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at ASC')
            ->all();

        return $this->render('views', [
            'model' => $model,
            'exams' => $exams,
            'pages' => $pages,
            'status' => $status
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionReject($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status = Topic::KHONG_DUYET;

            $model->save(false);

            $content = 'Chủ đề <span style="color: #5bc0de">'.$model->title.'</span> không được duyệt. Lý do không duyệt: '.$model->reason_reject;

            $this->message($content, $model->user_id);
        }

        return $this->redirect(['views', 'id' => $id]);
    }

    private function message($content, $user)
    {
        $message = new Message();
        $message->message = $content;
        $message->user_id = $user;
        $message->type = Message::SEND_USER;
        return $message->save(false);
    }

    /**
     * Creates a new Topic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Topic();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Topic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $status
     * @param $check
     * @throws NotFoundHttpException
     */
    public function checkStatus($status, $check)
    {
        if(!$status == $check ){
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Deletes an existing Topic model.
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
     * Finds the Topic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Topic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Topic::findOne($id)) !== null && $model->status != Topic::KHO_USER) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
