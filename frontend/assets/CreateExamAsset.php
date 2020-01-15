<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CreateExamAsset extends AssetBundle
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
        'theme/js/jquery.min.js',
        'components/jquery-ui/js/jquery-ui.min.js',
        'create-exam/js/footer.js',
        'create-exam/js/create.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}