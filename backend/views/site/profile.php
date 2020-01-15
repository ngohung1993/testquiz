<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 4/21/2018
 * Time: 11:43 AM
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\SiteAsset;

SiteAsset::register( $this );

/* @var $this yii\web\View */
/* @var $model common\models\SignupForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t( 'backend', 'Thông tin cá nhân' );

?>

<style>
    .modal-header h4 {
        font-weight: 600;
        font-size: 13px;
    }

    .modal-title {
        margin: 0;
        line-height: 1.42857143;
    }

    .modal-header strong {
        color: #fff;
        float: left;
        line-height: 45px;
        margin: 0 0 0 15px;
    }

    .modal-title i {
        float: left;
        margin: 15px 5px 0 0;
    }

</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item active">Thông tin cá nhân</li>
    </ol>
    <div class="clearfix"></div>
	<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-9">
            <div class="main-form">
                <div class="form-body">
                    <div class="form-group">
						<?= $form->field( $model, 'username' )->textInput( [
							'disabled' => 'disabled'
						] ) ?>
                    </div>
                    <div class="form-group">
						<?= $form->field( $model, 'name' )->textInput( [ 'maxlength' => true ] ) ?>
                    </div>
                    <div class="form-group">
						<?= $form->field( $model, 'phone' )->textInput( [ 'maxlength' => true ] ) ?>
                    </div>
                    <div class="form-group">
						<?= $form->field( $model, 'address' )->textarea( [ 'rows' => 2 ] ) ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 right-sidebar">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Xuất bản</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <button type="submit" name="submit" class="btn btn-info">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Lưu & Thoát
                    </button>
                </div>
            </div>
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Cài đặt mật khẩu</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#compose-modal" style="width: 100%;">
                            <i class="fa fa-key"></i>
                            Đổi mật khẩu
                        </button>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes">
                <div class="widget-title">
                    <h4><span>Ảnh đại diện</span></h4>
                </div>
                <div class="widget-body">
                    <div class="image-box">
                        <div class="image-box-actions">
                            <div class="inside">
                                <img style="width: 100%;"
                                     src="<?= ! $model->avatar ? '/uploads/cms/img/placeholder.png' : $model->avatar ?>"
                                     class="fieldID attachment-266x266 size-266x266" alt="">
								<?= $form->field( $model, 'avatar' )->hiddenInput( [
									'id'    => 'fieldID',
									'value' => $model->avatar
								] )->label( false ) ?>
                                <a href="/uploads/library/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1"
                                   style="<?= $model->avatar ? 'display: none;' : '' ?>"
                                   class="thumbnail-fieldID frame-btn">Đặt ảnh dại diện</a>
                                <a href="javascript:void(0)" style="<?= $model->avatar ? '' : 'display: none;' ?>"
                                   class="remove-thumbnail-fieldID" onclick="remove_thumbnail('fieldID')">
                                    Xóa ảnh đại diện
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php ActiveForm::end(); ?>
</div>

<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <strong>
                        <i style="margin-right: 5px;" class="fa fa-repeat"></i>
                        Đổi mật khẩu
                    </strong>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><?= Yii::t( 'app', 'Mật khẩu cũ' ) ?></label>
                            <input title="" type="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><?= Yii::t( 'app', 'Mật khẩu mới' ) ?></label>
                            <input title="" type="password" id="new-password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><?= Yii::t( 'app', 'Nhập lại mật khẩu' ) ?></label>
                            <input title="" type="password" id="re-password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <input type="hidden" title="" id="id-user">
                <button onclick="change_password()" type="button" class="btn btn-primary pull-left">
                    <i class="fa fa-plus"></i>
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .opacity {
        background-color: #ababab;
        opacity: 0.5;
        display: none;
    }
</style>

<div id="loader" class="opacity loader">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>