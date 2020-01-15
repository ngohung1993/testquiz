<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class QuestionAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'components/font-awesome/css/font-awesome.min.css',
        'create-exam/css/roboto.css',
        'create-exam/css/header.css',
        'create-exam/css/default.css',
        'create-exam/css/base_cover.css,form.css',
        'create-exam/css/cover.css',
        'create-exam/css/exam.css',
        'create-exam/css/main.css',
        'create-exam/css/owl.carousel.css',
        'create-exam/css/thichonloc.css,tao-de.css'
    ];
    public $js = [
        'theme/exam/js/question.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}