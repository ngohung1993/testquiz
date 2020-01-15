<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\AuditLog;

/**
 * AuditLogController implements the CRUD actions for AuditLog model.
 */
class AuditLogController extends Controller {
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
	 * Lists all AuditLog models.
	 * @return mixed
	 */
	public function actionIndex() {

		$audit_logs = AuditLog::find()->joinWith( 'user' )->all();

		return $this->render( 'index', [
			'audit_logs' => $audit_logs
		] );
	}
}
