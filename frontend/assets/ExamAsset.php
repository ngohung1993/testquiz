<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ExamAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/css/bootstrap.min.css',
        'theme/exam/css/classes.css',
        'theme/exam/css/clean.css',
        'theme/exam/css/exam.css',
    ];
    public $js = [
        'theme/js/exam.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
