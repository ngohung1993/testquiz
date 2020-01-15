<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $model common\models\SignupForm */

$this->title = Yii::t('backend', 'Thêm mới nhân viên');

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['user/staff']) ?>">Nhân viên</a></li>

        <li class="breadcrumb-item active">Thêm mới nhân viên</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user
    ]) ?>
</div>