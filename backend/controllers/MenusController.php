<?php

namespace backend\controllers;


use Yii;
use yii\helpers\Json;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use common\models\Menus;
use common\models\LocationMenu;
use backend\controllers\base\AdminController;

/**
 * MenusController implements the CRUD actions for Links model.
 */
class MenusController extends AdminController
{
    /**
     * @param null $keyword
     * @return array
     */
    protected function search($keyword = null)
    {
        $query = Menus::find();

        if ($keyword) {
            $query->andWhere(['like', 'title', $keyword]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $query->count(),
        ]);

        $model = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return [
            'model' => $model,
            'pagination' => $pagination
        ];
    }

    /**
     * @param $keyword
     * Lists all Links models.
     * @return mixed
     */
    public function actionIndex($keyword = null)
    {
        $search = $this->search($keyword);

        return $this->render('index', [
            'keyword' => $keyword,
            'links' => $search['model'],
            'pagination' => $search['pagination']
        ]);
    }

    /**
     * Displays a single Links model.
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
     * Creates a new Links model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->created_at = date('Y-m-d H:i:s', time() + 7 * 3600);
            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Links model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            foreach (Json::decode($model->location_menus) as $key => $value) {
                $location = LocationMenu::findOne($value);
                $location->menus_id = $model->id;
                $location->save();
            }

            $locations = LocationMenu::find()->all();
            foreach ($locations as $key => $value) {
                if (in_array($value['id'], Json::decode($model->location_menus))) {
                    $value['menus_id'] = $model->id;

                } else {
                    if ($value['menus_id'] == $model->id) {
                        $value['menus_id'] = null;
                        $value->save();
                    }
                }

                $value->save();
            }

            if ($model->save()) {
                return $this->refresh();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Links model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Links model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
