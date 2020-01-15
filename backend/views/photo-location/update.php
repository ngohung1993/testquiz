<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PhotoLocation */

$this->title = Yii::t( 'backend', 'Update photo location' );
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'photo-location/index' ] ) ?>">Vị trí ảnh</a></li>

        <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>
    <div class="clearfix"></div>
	<?= $this->render( '_form', [ 'model' => $model ] ) ?>
</div>