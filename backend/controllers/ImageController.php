<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\controllers\base\AdminController;
use common\models\Image;
use common\models\PhotoLocation;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends AdminController
{
    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $locations = PhotoLocation::find()->where(['released' => 1])->all();
        return $this->render('index', [
            'locations' => $locations
        ]);
    }

    /**
     * Displays a single Image model.
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
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCreate($id)
    {
        $location = PhotoLocation::findOne($id);
        if (!$location) {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }

        $images = Image::find()->where(['=', 'photo_location_id', $id])->all();

        return $this->render('create', [
            'images' => $images,
            'location' => $location
        ]);
    }

    /**
     * Updates an existing Image model.
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
     * Deletes an existing Image model.
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
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
