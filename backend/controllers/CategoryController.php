<?php

namespace backend\controllers;

use common\models\Topic;
use Yii;
use yii\data\Pagination;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use common\models\Tab;
use common\models\SeoTool;
use common\models\Category;
use common\helpers\FunctionHelper;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AdminController
{

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Category::find()->orderBy('category.serial ASC');

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $categories = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('updated_at DESC')
            ->all();

        return $this->render('index', [
            'categories' => $categories,
            'pages' => $pages,
        ]);
    }

    public function actionTab($id)
    {

        $tabs = Tab::find()->where(['category_id' => $id])->all();
        $category = Category::findOne($id);

        return $this->render('tab', [
            'category' => $category,
            'tabs' => $tabs
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $seo = new SeoTool();
        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            $seo->save();
            $model->seo_tool_id = $seo->id;

            if ($model->parent_id == null) {
                $children = Category::find()->where(['is', 'parent_id', null])->all();
            } else {
                $children = Category::find()->where(['=', 'parent_id', $model->parent_id])->all();
            }
            $model->type = Category::TOPIC;
            $model->serial = count($children) + 1;
            $model->save();
            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;
            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = SeoTool::findOne($model->seo_tool_id);

        if ($model->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {

            $model->slug = FunctionHelper::slug($model->title) . '-' . $model->id;

            if ($model->parent_id == null) {
                $children = Category::find()->where(['is', 'parent_id', null])->all();
            } else {
                $children = Category::find()->where(['=', 'parent_id', $model->parent_id])->all();
            }

            $old = $model->getOldAttribute('parent_id');

            if ($old != $model->parent_id) {
                $model->serial = count($children) + 1;
            }

            $seo->save();
            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $topic = Topic::find()->where(['category_id' => $id])->all();


        if($topic){
            Yii::$app->session->setFlash('flag', 'Danh mục hiện tại đang chứa chủ đề với đề thi, lên không được phép xóa danh mục này');
            return $this->redirect(['index']);
        }

        if ($model->parent_id == null) {
            $brother = Category::find()->where(['is', 'parent_id', null])->all();
        } else {
            $brother = Category::find()->where(['=', 'parent_id', $model->parent_id])->all();
        }

        $serial_old = $model->serial;

        foreach ($brother as $key => $value) {
            if ($value['id'] != $id && $value['serial'] > $serial_old) {
                $value['serial'] -= 1;
                $value->save(false);
            }
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
