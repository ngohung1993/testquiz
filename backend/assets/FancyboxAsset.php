<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FancyboxAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'cms/components/fancybox/source/jquery.fancybox.css',
        'css/bootstrap-editable.css'
	];
	public $js = [
		'cms/components/fancybox/source/jquery.fancybox.js',
		'customer/js/fancybox.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
