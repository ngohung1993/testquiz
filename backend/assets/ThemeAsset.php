<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/font-awesome/css/font-awesome.min.css',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
        'plugins/bootstrap-colorpicker-3.0.3/css/bootstrap-colorpicker.css',
        'plugins/fancybox/source/jquery.fancybox.css',
        'plugins/sweetalert2/dist/sweetalert2.css',
        'plugins/iCheck/all.css',
        'css/customer.css',
        'editor/css/theme-editor-main.min.css',
        'editor/css/customer.css',
    ];
    public $js = [
        'plugins/bootstrap-colorpicker-3.0.3/js/jquery-3.3.1.js',
        'plugins/jquery-ui/js/jquery-ui.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js',
        'plugins/bootstrap-colorpicker-3.0.3/js/bootstrap-colorpicker.js',
        'plugins/sweetalert2/dist/sweetalert2.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/fancybox/source/jquery.fancybox.js',
        'editor/js/theme.editor.js',
        'editor/js/fancybox.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
