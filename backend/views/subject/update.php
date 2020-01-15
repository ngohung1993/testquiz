<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\base\Subject */
/* @var $seo common\models\SeoTool */
$this->title = Yii::t('app', 'Update Subject: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['category/index']) ?>">Danh sách môn thi</a></li>

        <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'seo' => $seo
    ]) ?>
</div>
