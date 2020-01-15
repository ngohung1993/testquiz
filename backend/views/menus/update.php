<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Links */

$this->title = 'Cập nhật';
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['page/index']) ?>">Menu</a></li>

        <li class="breadcrumb-item active">Cập nhật</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>
