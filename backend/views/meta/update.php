<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Meta */

$this->title = Yii::t( 'app', 'Chỉnh sửa' );

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'meta/index' ] ) ?>">Mã mở rộng</a></li>

        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>
	<?= $this->render( '_form', [ 'model' => $model ] ) ?>
</div>