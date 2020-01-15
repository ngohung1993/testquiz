<?php

use yii\helpers\Html;
use common\helpers\FunctionHelper;
use frontend\assets\ExamAsset;

$favicon = FunctionHelper::get_general_information()['favicon'];
ExamAsset::register($this);
?>
<?php $this->beginPage() ?>
<html class="wf-tahoma-n4-inactive wf-inactive">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="body-main" class="portrait">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

