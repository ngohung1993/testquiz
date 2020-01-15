<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class TinyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'components/tinymce/tinymce.min.js',
        'theme/exam/js/tiny-config.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}