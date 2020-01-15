<?php

namespace frontend\assets;

use yii\web\AssetBundle;


/**
 * Main frontend application asset bundle.
 */
class ProfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/css/theme.member.min.css',
        'theme/css/jquery-ui-1.9.2.custom.min.css',
        'theme/css/index.min.css',
        'theme/css/style.min.css',
        'theme/css/style3.min.css',
        'theme/css/bootstrap.min.css',
        'components/font-awesome/css/font-awesome.min.css',
        'components/bootstrap-tagsinput/css/bootstrap-tagsinput.css',
        'components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
        'css/sweetalert2.min.css',
        'bootstrap/css/style.css',
    ];
    public $js = [
        'theme/js/jquery.min.js',
        'theme/js/bootstrap.min.js',
        'theme/js/profile.js',
        'components/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js',
        'theme/js/moment.min.js',
        'components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        'js/sweetalert2.min.js',
        'theme/js/document.js',
        'theme/js/finance.js',
        'theme/js/message.js',
        'bootstrap/js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
