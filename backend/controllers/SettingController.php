<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use backend\controllers\base\MiddleController;
use common\models\Tab;
use common\models\User;
use common\models\Image;
use common\models\Setting;
use common\helpers\FunctionHelper;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends MiddleController {
	/**
	 * Lists all Setting models.
	 * @return mixed
	 */
	public function actionIndex() {
		$query = Setting::find();

		$render = 'index-senior';

		if ( $this->user['permission'] != User::ROLE_ADMIN ) {
			$query->where( [ '>', 'released', 0 ] );
			$render = 'index';
		}

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $settings = $query->offset($pages->offset)->limit($pages->limit)
            ->ORDERBY('id DESC')
            ->all();

		return $this->render( $render, [
			'settings' => $settings,
			'user'     => $this->user,
            'pages' => $pages,
		] );
	}

	/**
	 * @param $id
	 *
	 * @return string
	 */
	public function actionTab( $id ) {

		$tabs    = Tab::find()->where( [ 'setting_id' => $id ] )->all();
		$setting = Setting::findOne( $id );

		return $this->render( 'tab', [
			'setting' => $setting,
			'tabs'    => $tabs
		] );
	}

	/**
	 * Displays a single Setting model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView( $id ) {
		return $this->render( 'view', [
			'model' => $this->findModel( $id ),
		] );
	}

	/**
	 * Creates a new Setting model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Setting();

		if ( $model->load( Yii::$app->request->post() ) ) {

			if ( $model->save() ) {
				return $this->redirect( [ 'index' ] );
			}
		}

		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing Setting model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 * @throws \Throwable
	 */
	public function actionUpdate( $id ) {
		$model  = $this->findModel( $id );
		$images = Image::find()->where( [ '=', 'setting_id', $id ] )->all();

		if ( $model->load( Yii::$app->request->post() ) ) {

			$model->slug = FunctionHelper::slug( $model->title ) . '-' . $model->id;

			if ( $model->save() ) {
				return $this->redirect( [ 'index' ] );
			}
		}

		return $this->render( 'update', [
			'model'  => $model,
			'images' => $images
		] );
	}

	/**
	 * Deletes an existing Setting model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 * @throws \Throwable
	 */
	public function actionDelete( $id ) {
		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the Setting model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Setting the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = Setting::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( Yii::t( 'backend', 'The requested page does not exist.' ) );
	}
}
