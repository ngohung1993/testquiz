<?php

namespace backend\controllers;

use common\helpers\FunctionHelper;
use common\models\Topic;
use Yii;
use Throwable;
use common\models\SeoTool;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use common\models\Subject;
use common\models\Classroom;
use common\models\ClassroomDetail;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use yii\db\StaleObjectException as StaleObjectExceptionAlias;

/**
 * ClassroomController implements the CRUD actions for Classroom model.
 */
class ClassroomController extends AdminController
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
     * Lists all Classroom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Classroom::find();

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $classrooms = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();

        return $this->render('index', [
            'classrooms' => $classrooms,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Classroom model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Classroom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Classroom();
        $seo = new SeoTool();
        $subjects = Subject::find()->where(['status' => Subject::ACTIVE])->all();

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $seo->save();
            $model->seo_tool_id = $seo->id;
            $model->save();

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            $model->save();

            $subjectsChosen = Yii::$app->request->post('subjects');

            if($subjectsChosen) {
                $this->saveClassroomDetail($subjectsChosen, $model->id);
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'subjects' => $subjects,
            'seo' => $seo
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws StaleObjectExceptionAlias
     * @throws Throwable
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = SeoTool::findOne($model->seo_tool_id);
        $subjects = Subject::find()->where(['status' => Subject::ACTIVE])->all();
        $classroomDetails = ArrayHelper::getColumn(ClassroomDetail::find()->where(['classroom_id' => $id])->asArray()->all(), 'subject_id');

        $arr= [];

        $classroomDetail = ClassroomDetail::find()->where(['classroom_id'=> $id])->asArray()->all();

        foreach ($classroomDetail as $value){
            $topics = Topic::find()->where(['classroom_detail_id'=> $value['id']])->all();

            foreach ($topics as $value1){
                if($value1){
                    array_push($arr, $value1['classroom_detail_id']);
                }
            }
        }

        $classroomDetailTopic = [];
        foreach ($arr as $val){
            $elementClassroomDetail = ClassroomDetail::find()->where(['id'=> $val])->one();
            array_push($classroomDetailTopic, $elementClassroomDetail['subject_id']);
        }
        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {


            $this->deleteClassroomDetail($model->id, $classroomDetailTopic);

            $subjectsChosen = Yii::$app->request->post('subjects');

            if($subjectsChosen){
                $this->saveClassroomDetail($subjectsChosen, $model->id);
            }

            $model->save();

            $seo->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'subjects' => $subjects,
            'classroomDetails' => $classroomDetails,
            'seo' => $seo,
            'classroomDetailTopic' => $classroomDetailTopic
        ]);
    }

    /**
     * @param $subjectsChosen
     * @param $id
     * @return bool
     */
    protected function saveClassroomDetail($subjectsChosen,$id)
    {
        foreach ($subjectsChosen as $key => $value) {
            $classroomDetail = new ClassroomDetail();
            $classroomDetail->classroom_id = $id;
            $classroomDetail->subject_id = $value;
            $classroomDetail->save();
        }
        return true;
    }
    /**
     * @param $classroom_id
     * @return bool
     * @throws StaleObjectExceptionAlias
     * @throws Throwable
     */
    protected function deleteClassroomDetail($classroom_id, $arr)
    {
        $classroomDetails = ClassroomDetail::find()->where(['classroom_id'=> $classroom_id])->all();

        foreach ($classroomDetails as $key => $value){
            $classroomDetail = ClassroomDetail::findOne($value->id);
            if($classroomDetail){
                foreach ($arr as $value1){
                    if($value1 != $value->subject_id){
                        $classroomDetail->delete();
                    }
                }

            }
        }
        return true;
    }

    /**
     * Deletes an existing Classroom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectExceptionAlias
     * @throws Throwable
     */
    public function actionDelete($id, $page)
    {
        $model =  $this->findModel($id);

        $classroomDetail = ClassroomDetail::find()->where(['classroom_id'=> $id])->all();

        $arr = [];

        foreach ($classroomDetail as $value){
            $topics = Topic::find()->where(['classroom_detail_id'=> $value['id']])->all();

            foreach ($topics as $value1){
                if($value1){
                    array_push($arr, $value1);
                }
            }
        }

        if(count($arr)> 0){
            Yii::$app->session->setFlash('flag', 'Trong lớp học hiện tại đang chứa chủ đề với đề thi, lên không được phép xóa lớp này');
            return $this->redirect(['index','page'=> $page + 1]);
        }else{
            $model->delete();
            return $this->redirect(['index','page'=> $page + 1]);
        }

    }

    /**
     * Finds the Classroom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classroom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classroom::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}