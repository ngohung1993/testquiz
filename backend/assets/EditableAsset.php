<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EditableAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'cms/components/bootstrap3-editable/css/bootstrap-editable.css',
	];
	public $js = [
		'cms/components/bootstrap/js/bootstrap.min.js',
		'cms/components/bootstrap3-editable/js/bootstrap-editable.min.js',
		'customer/js/editable.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
