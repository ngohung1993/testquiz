<?php

use yii\helpers\Url;
use common\models\User;

/* @var $user User */
/* @var $this yii\web\View */
/* @var $model common\models\SignupForm */

$this->title = Yii::t('backend', 'Update user');

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item active">Thông tin cá nhân</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_update', ['model' => $model, 'user' => $user]) ?>
</div>