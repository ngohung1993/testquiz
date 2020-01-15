<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SiteAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'cms/components/js-confirm/css/jquery-confirm.css',
		'customer/css/loaders.css'
	];
	public $js = [
		'cms/components/js-confirm/js/jquery-confirm.js',
		'customer/js/site.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
