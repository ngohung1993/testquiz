<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CountdownAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'components/font-awesome/css/font-awesome.min.css',
        'theme/exam/css/exam.css'
    ];
    public $js = [
        'theme/exam/js/countdown.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'frontend\assets\AngularAsset'
    ];
}