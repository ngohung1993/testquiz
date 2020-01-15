<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\base\TransactionHistory */
/* @var $account common\models\AccountBank */

$this->title = Yii::t('app', 'Xử lý giao dịch', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaction Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Trang chủ</a></li>

        <li class="breadcrumb-item active"><a href="<?= Url::to(['transaction-history/index']) ?>">Quản lý giao dịch</a></li>

        <li class="breadcrumb-item active">Xử lý</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'account' => $account,
    ]) ?>

</div>
