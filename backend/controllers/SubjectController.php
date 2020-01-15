<?php

namespace backend\controllers;

use backend\controllers\base\AdminController;
use common\helpers\FunctionHelper;
use Yii;
use common\models\Subject;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ClassroomDetail;
use common\models\SeoTool;
use common\models\Topic;

/**
 * SubjectController implements the CRUD actions for Subject model.
 */
class SubjectController extends AdminController
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
     * Lists all Subject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Subject::find()->where(['disable'=> 1]);

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $subjects = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();
        return $this->render('index', [
            'subjects' => $subjects,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Subject model.
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
     * Creates a new Subject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subject();
        $seo = new SeoTool();
        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $seo->save();
            $model->seo_tool_id = $seo->id;
            $model->save();

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;
            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = SeoTool::findOne($model->seo_tool_id);
        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $model->save();
            $seo->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo
        ]);
    }

    /**
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model =  $this->findModel($id);

        $model->disable = 0;
        $model->status = Subject::NO_ACTIVE;

        $model->save();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Subject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subject::findOne($id)) !== null && $model->disable == 1) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
