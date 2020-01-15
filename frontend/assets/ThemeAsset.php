<?php

namespace frontend\assets;

use yii\web\AssetBundle;


/**
 * Main frontend application asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bootstrap/css/bootstrap.css',
        'bootstrap/css/bootstrap.min.css',
        'bootstrap/css/style.css',
        'components/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'bootstrap/js/bootstrap.js',
        'bootstrap/js/main.js'
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
