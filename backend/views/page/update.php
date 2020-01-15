<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t( 'backend', 'Chỉnh sửa trang' );
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'page/index' ] ) ?>">Trang</a></li>

        <li class="breadcrumb-item active">Chỉnh sửa trang</li>
    </ol>
    <div class="clearfix"></div>

	<?= $this->render( '_form', [ 'model' => $model ] ) ?>
</div>