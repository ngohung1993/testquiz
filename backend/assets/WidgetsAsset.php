<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class WidgetsAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'cms/components/color-picker/css/colorpicker.css',
		'customer/css/styles.css',
		'customer/css/widgets.css'
	];
	public $js = [
		'cms/components/color-picker/js/colorpicker.js',
		'customer/js/widgets.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
