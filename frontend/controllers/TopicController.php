<?php

namespace frontend\controllers;

use common\helpers\FunctionHelper;
use common\models\Category;
use common\models\Classroom;
use common\models\ClassroomDetail;
use common\models\Exam;
use common\models\Message;
use common\models\SeoTool;
use Yii;
use common\models\Topic;
use frontend\controllers\base\BaseController;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TopicController extends BaseController
{
    /**
     * @param int $status
     * @param null $key
     * @return string
     */
    public function actionIndex($status = Topic::DUYET, $key = null)
    {
        $this->layout = 'profile';

        $query = Topic::find()
            ->where(['status' => $status])
            ->andWhere(['active'=> Topic::ACTIVE])
            ->andWhere(['user_id' => $this->user->id]);

        if ($key) {
            $query->andFilterWhere(['like', 'title', $key]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 16,
            'totalCount' => $query->count(),
        ]);

        $topics = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('index', [
            'topics' => $topics,
            'status' => $status,
            'user' => $this->user->id,
            'pages' => $pages,
            'key' => $key
        ]);
    }

    /**
     * @param null $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionCreate($id = null)
    {
        $this->layout = 'profile';
        $classrooms = Classroom::find()->where(['status' => Classroom::ACTIVE])->all();
        $categories = Category::find()->where(['type' => Category::TOPIC])->all();

        if (!$id) {
            $model = new Topic();
            $seo = new SeoTool();
            $classroomDetail = '';
            if ($model->load(Yii::$app->request->post())) {
                $seo->save();

                $model->seo_tool_id = $seo->id;

                $post = Yii:: $app->request->post();

                if ($model->status == null) {
                    $model->status = Topic::KHO_USER;
                }

                $classroom_id = $post['classroom'];
                $subject_id = $post['subject'];
                $classrooms_detail = ClassroomDetail::find()->where(['classroom_id' => $classroom_id])->andWhere(['subject_id' => $subject_id])->one();

                $model->classroom_detail_id = $classrooms_detail['id'];
                $model->user_id = $this->user->id;
                $model->active = Topic::ACTIVE;

                $model->save(false);

                $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

                $model->save();

                if($model->status == Topic::CHO_DUYET){
                    $content = 'Duyệt chủ đề : Chủ đề <span style="color: #5bc0de">'.$model->title.'</span> của thành viên <span style="color: blue">'.$this->user->name.'</span> <a style="text-decoration: underline;" href ="/admin/topic/view?id='.$model->id.'"> chờ duyêt</a>' ;
                    $this->actionSaveMessage($content);
                }

                return $this->redirect(['index', 'status' => $model->status]);
            }
        } else {
            $model = $this->findModel($id);

            $this->checkUpdate($model->status);

            $seo = SeoTool::findOne($model['seo_tool_id']);
            $classroomDetail = ClassroomDetail::findOne($model->classroom_detail_id);

            if ($model->load(Yii::$app->request->post())) {

                $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;
                $seo->save();

                $model->tags = json_encode(explode(',', $model->tags));

                $model->save();

                if($model->status == Topic::CHO_DUYET){
                    $content = 'Duyệt chủ đề : Chủ đề <span style="color: #5bc0de">'.$model->title.'</span> của thành viên <span style="color: blue">'.$this->user->name.'</span> <a style="text-decoration: underline;" href ="/admin/topic/view?id='.$model->id.'">chờ duyêt</a>' ;
                    $this->actionSaveMessage($content);
                }

                return $this->redirect(['index', 'status' => $model->status]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'classrooms' => $classrooms,
            'categories' => $categories,
            'classroomDetail' => $classroomDetail,
            'seo' => $seo,
            'id' => $id
        ]);
    }

    /**
     * @param $message
     * @return bool
     */
    private function actionSaveMessage($content)
    {
        $message = new Message();

        $message->message = $content ;
        $message->user_id = $this->user->id;
        $message->type = Message::SEND_ADMIN;

        return $message->save();
    }
    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $this->layout = 'profile';
        
        $topic = $this->findModel($id);

        $classroomDetail = ClassroomDetail::findOne($topic->classroom_detail_id);
        $query = Exam::find()->where(['user_id' => $this->user->id])->andWhere(['topic_id' => $topic->id]);

        $pages = new Pagination([
            'defaultPageSize' => 16,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();
        return $this->render('view', [
            'topic' => $topic,
            'classroomDetail' => $classroomDetail,
            'exams' => $exams,
            'pages' => $pages
        ]);
    }

    /**
     * @param null $status
     * @param null $active
     * @return string
     */
    public function actionFilterTopic($status = null, $active = null)
    {

        $this->layout = 'profile';
        if ($status == null) {
            $status = Topic::DUYET;
        }
        $query = Topic::find()->where(['user_id' => $this->user->id])->andWhere(['active'=> Topic::ACTIVE]);

        if ($status == 0) {
            $query->andWhere(['=', 'status', 0]);
        } else {
            $query->andWhere(['=', 'status', $status]);
        }

        if ($active == '0') {
            $query->andWhere(['=', 'active', '0']);
        } elseif ($active == 1) {
            $query->andWhere(['=', 'active', 1]);
        }

        $pages = new Pagination([
            'defaultPageSize' => 16,
            'totalCount' => $query->count(),
        ]);

        $topics = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('filter-topic', [
            'topics' => $topics,
            'status' => $status,
            'active' => $active,
            'user' => $this->user->id,
            'pages' => $pages,
        ]);
    }

    /**
     * @param $status
     * @throws NotFoundHttpException
     */
    protected  function checkUpdate($status)
    {
        if($status != Topic::KHO_USER && $status != Topic::KHONG_DUYET ){
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \common\models\base\Topic the loaded model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Topic::findOne($id)) !== null && $model->user_id == $this->user->id) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}