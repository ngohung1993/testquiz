<?php

use yii\web\View;
use yii\helpers\Html;
use frontend\assets\ThemeAsset;
use common\helpers\FunctionHelper;

/* @var $this View */
/* @var $content string */
$favicon = FunctionHelper::get_general_information()['favicon'];
$gg_analytics = FunctionHelper::get_general_information()['google_analytics'];
$facebook_pixel = FunctionHelper::get_general_information()['facebook_pixel'];
ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" style="overflow-x: hidden">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=0"/>
        <link rel="icon" href="<?= $favicon ?>" type="image/x-icon">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="/theme/js/jquery-3.3.1.min.js"></script>
        <div id="fb-root"></div>
        <script>
            function scrollToQuestion(id) {
                console.log(id);
                $('html, body').animate({
                    scrollTop: $("#cau" + id).offset().top
                }, 1000)
            }
        </script>
        <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=304036757051650&autoLogAppEvents=1">
        </script>
        <?= htmlspecialchars_decode($gg_analytics) ?>
        <?= htmlspecialchars_decode($facebook_pixel) ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?= $this->render('header') ?>

    <?= $content ?>

    <?= $this->render('footer') ?>

    <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage() ?>