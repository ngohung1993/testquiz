<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Tab;
use common\models\Image;
use common\models\base\TabSearch;
use common\helpers\FunctionHelper;


/**
 * TabController implements the CRUD actions for Tab model.
 */
class TabController extends Controller
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
     * Lists all Tab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tab model.
     *
     * @param integer $id
     *
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
     * @param $parent_id
     * @param $table
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate($parent_id, $table)
    {

        $model = new Tab();

        switch ($table) {
            case 'post':
                $model->post_id = $parent_id;
                break;
            case 'setting':
                $model->setting_id = $parent_id;
                break;
            case 'category':
                $model->category_id = $parent_id;
                break;
            case 'classified':
                $model->classified_id = $parent_id;
                break;
            default:
                break;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;
            $model->save();
            return $this->redirect([$table . '/tab', 'id' => $parent_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'table' => $table,
            'parent_id' => $parent_id,
        ]);
    }

    /**
     * Updates an existing Tab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @param integer $parent_id
     * @param integer $table
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $parent_id, $table)
    {
        $model = $this->findModel($id);
        $images = Image::find()->where(['=', 'tab_id', $id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$table . '/tab', 'id' => $parent_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'table' => $table,
            'parent_id' => $parent_id,
            'images' => $images
        ]);
    }

    /**
     * Deletes an existing Tab model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @param integer $table
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id, $table)
    {

        $model = $this->findModel($id);

        $parent_id = null;

        switch ($table) {
            case 'post':
                $parent_id = $model->post_id;
                break;
            case 'setting':
                $parent_id = $model->setting_id;
                break;
            case 'classified':
                $parent_id = $model->classified_id;
                break;
            default:
                break;
        }

        $model->delete();

        return $this->redirect([$table . '/tab', 'id' => $parent_id]);
    }

    /**
     * Finds the Tab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Tab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
