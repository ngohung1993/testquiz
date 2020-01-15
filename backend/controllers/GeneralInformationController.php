<?php

namespace backend\controllers;

use Yii;
use common\models\GeneralInformation;
use backend\controllers\base\AdminController;

/**
 * GeneralInformationController implements the CRUD actions for GeneralInformation model.
 */
class GeneralInformationController extends AdminController {
	/**
	 * Lists all GeneralInformation models.
	 * @return mixed
	 */
	public function actionIndex() {
		$general = GeneralInformation::findOne( 1 );

		if ( $general->load( Yii::$app->request->post() ) && $general->save() ) {

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'index', [
			'general' => $general
		] );
	}
}