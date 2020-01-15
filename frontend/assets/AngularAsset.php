<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@webroot/components/angular';
    public $js = [
        'angular.min.js',
        'angular-cookies.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}