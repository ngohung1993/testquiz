<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\base\TransactionHistory */

$this->title = Yii::t('app', 'Create Transaction History');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaction Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
