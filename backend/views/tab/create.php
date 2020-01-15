<?php

use yii\helpers\Url;
use common\models\Post;

/* @var $this yii\web\View */
/* @var $parent_id integer */
/* @var $table string */
/* @var $model common\models\Tab */

$this->title = 'Create Tab';

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

		<?php if ( $table == 'post' ): ?>
            <li class="breadcrumb-item">
                <a href="<?= Url::to( [ 'post/index' ] ) ?>">
                    Bài viết
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= Url::to( [ 'category/tab', 'post_id' => $parent_id ] ) ?>">
					<?= Post::findOne( $parent_id )['title'] ?>
                </a>
            </li>
		<?php endif; ?>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'setting/index' ] ) ?>">Tab</a></li>

        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="clearfix"></div>
	<?= $this->render( '_form', [ 'model' => $model, 'table' => $table, 'parent_id' => $parent_id ] ) ?>
</div>