<?php

use yii\helpers\Url;

?>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Trang chủ</a></li>

        <li class="breadcrumb-item active"><a href="<?= Url::to(['transaction-history/index']) ?>">Quản lý giao dịch</a></li>

        <li class="breadcrumb-item active">Nạp tiền</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
//        'account' => $account,
    ]) ?>

</div>