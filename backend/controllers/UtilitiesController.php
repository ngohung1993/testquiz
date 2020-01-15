<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use common\models\Utilities;

/**
 * UtilitiesController implements the CRUD actions for Utilities model.
 */
class UtilitiesController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'POST' ],
				],
			],
		];
	}

	/**
	 * Lists all Utilities models.
	 * @return mixed
	 */
	public function actionIndex() {
		$utilities = Utilities::find()->all();

		return $this->render( 'index', [
			'utilities' => $utilities
		] );
	}

	/**
	 * Displays a single Utilities model.
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
	 * Creates a new Utilities model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Utilities();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing Utilities model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate( $id ) {
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'update', [
			'model' => $model,
		] );
	}

	/**
	 * Deletes an existing Utilities model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete( $id ) {
		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the Utilities model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Utilities the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = Utilities::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
