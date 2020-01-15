<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $general common\models\GeneralInformation */

$this->title = Yii::t( 'backend', 'Cài đặt hệ thống' );
?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a>
        </li>
        <li class="breadcrumb-item active">Cài đặt hệ thống</li>
    </ol>
    <div class="clearfix"></div>

	<?php if ( Yii::$app->session->hasFlash( 'success' ) ): ?>
        <div class="note note-success">
            <p>
                <span class="fa fa-check-circle-o" style="color: green;"></span>
                Cập nhật dữ liệu thành công
            </p>
        </div>
	<?php endif; ?>

	<?= $this->render( '_form', [ 'model' => $general ] ) ?>

    <div class="page-footer">
        <div class="page-footer-inner">
            <div class="row">
                <div class="col-md-6">
                    Bản quyền 2018 © Tigerweb Technologies. Phiên bản:
                    <span>2.0</span>
                </div>
                <div class="col-md-6 text-right">
                    Trang tải xong trong 0.4s
                </div>
            </div>
        </div>
    </div>
</div>