<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $images common\models\Image */

$this->title = Yii::t( 'backend', 'Update setting' );
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'setting/index' ] ) ?>">Cấu hình</a></li>

        <li class="breadcrumb-item active">Thêm mới chỉnh sửa</li>
    </ol>
    <div class="clearfix"></div>

	<?= $this->render( '_update', [ 'model' => $model, 'images' => $images ] ) ?>
</div>