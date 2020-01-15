<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $parent_id integer */
/* @var $table string */
/* @var $model common\models\Tab */
/* @var $images \common\models\Image */
$this->title = 'Chỉnh sửa';
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'setting/index' ] ) ?>">Tab</a></li>

        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>
	<?= $this->render( '_form', [ 'model' => $model, 'table' => $table, 'parent_id' => $parent_id,'images' => $images ] ) ?>
</div>
