<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tab */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'category_id',
            'setting_id',
            'classified_id',
            'product_id',
            'post_id',
            'serial',
            'avatar',
            'describe:ntext',
            'content:ntext',
            'status',
            'slug',
            'images:ntext',
            'code:ntext',
        ],
    ]) ?>

</div>
