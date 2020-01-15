<?php
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use common\helpers\FunctionHelper;

$favicon = FunctionHelper::get_general_information()['favicon'];
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=0"/>
        <link rel="icon" href="<?= $favicon ?>" type="image/x-icon">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>