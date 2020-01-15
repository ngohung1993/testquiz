<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\LocationMenu */

$this->title = 'Chỉnh sửa';

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['location-menu/index']) ?>">Vị trí menu</a></li>

        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>