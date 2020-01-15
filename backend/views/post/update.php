<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $seo \common\models\SeoTool */
/* @var $images \common\models\Image */

$this->title = Yii::t( 'backend', 'Chỉnh sửa' );
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'post/index' ] ) ?>">Bài viết</a></li>

        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>

	<?= $this->render( '_form', [ 'model' => $model, 'seo' => $seo, 'images' => $images ] ) ?>
</div>