<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item active">Lỗi</li>
    </ol>
    <div class="clearfix"></div>

    <div class="site-error">

        <h1><?= Html::encode( $this->title ) ?></h1>

        <div class="alert alert-danger">
			<?= nl2br( Html::encode( $message ) ) ?>
        </div>

        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p>

    </div>
</div>


