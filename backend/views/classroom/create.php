<?php

use yii\helpers\Url;
use common\models\Subject;
use common\models\Classroom;

/* @var $this yii\web\View */
/* @var $subjects Subject */
/* @var $model Classroom */
/* @var $seo common\models\SeoTool */

$this->title = Yii::t('app', 'Thêm mới');

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['classroom/index']) ?>">Danh sách lớp</a></li>

        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'subjects' => $subjects,
        'seo' => $seo,
    ]) ?>
</div>