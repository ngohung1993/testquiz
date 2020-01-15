<?php

use yii\widgets\ActiveForm;
use backend\assets\FancyboxAsset;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralInformation */
/* @var $form yii\widgets\ActiveForm */

FancyboxAsset::register( $this );

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Thông tin chung</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">Cấu hình những thông tin cài đặt website.</p>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field" for="site_title">Tên trang</label>
					<?= $form->field( $model, 'site_name' )->textInput( [
						'maxlength' => true,
						'class'     => 'next-input'
					] )->label( false ) ?>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Tiêu đề trang chủ</label>
					<?= $form->field( $model, 'home_page_header' )->textInput( [ 'class' => 'next-input' ] )->label( false ) ?>
                    <small class="charcounter">(400 kí tự còn lại)</small>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Mô tả trang chủ</label>
					<?= $form->field( $model, 'home_page_description' )->textarea( [
						'rows'  => 2,
						'class' => 'next-input'
					] )->label( false ) ?>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Meta keyword</label>
                    <?= $form->field( $model, 'meta_keyword' )->textarea( [
                        'rows'  => 2,
                        'class' => 'next-input'
                    ] )->label( false ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Hình ảnh</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">Hình ảnh về website</p>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="row">
                    <div class="col-md-6" style="border-right: 1px solid #f1f1f1;">
                        <div class="form-group">
                            <label class="text-title-field" for="enable_multi_language_in_admin">
                                Logo website
                            </label>
                            <div class="admin-logo-image-setting">
                                <div class="image-box">
                                    <img style="width: 150px;height: 127px;"
                                         src="<?= ! $model->logo ? '/uploads/cms/img/placeholder.png' : $model->logo ?>"
                                         class="fieldID attachment-266x266 size-266x266" alt="">
									<?= $form->field( $model, 'logo' )->hiddenInput( [
										'id'    => 'fieldID',
										'value' => $model->logo
									] )->label( false ) ?>
                                    <a href="/uploads/library/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1"
                                       style="<?= $model->logo ? 'display: none;' : '' ?>"
                                       class="thumbnail-fieldID frame-btn">Đặt ảnh đại diện</a>
                                    <a href="javascript:void(0)" style="<?= $model->logo ? '' : 'display: none;' ?>"
                                       class="remove-thumbnail-fieldID" onclick="remove_thumbnail('fieldID')">
                                        Xóa ảnh đại diện
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-title-field" for="enable_multi_language_in_admin">
                                Favicon website
                            </label>
                            <div class="admin-logo-image-setting">
                                <div class="image-box">
                                    <img style="width: 150px;height: 127px;"
                                         src="<?= ! $model->favicon ? '/uploads/cms/img/placeholder.png' : $model->favicon ?>"
                                         class="favicon attachment-266x266 size-266x266">
									<?= $form->field( $model, 'favicon' )->hiddenInput( [
										'id'    => 'favicon',
										'value' => $model->favicon
									] )->label( false ) ?>
                                    <a href="/uploads/library/filemanager/dialog.php?type=1&field_id=favicon&relative_url=1"
                                       style="<?= $model->favicon ? 'display: none;' : '' ?>"
                                       class="thumbnail-favicon frame-btn">Đặt ảnh favicon</a>
                                    <a href="javascript:void(0)" style="<?= $model->favicon ? '' : 'display: none;' ?>"
                                       class="remove-thumbnail-favicon" onclick="remove_thumbnail('favicon')">
                                        Xóa ảnh favicon
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Thông tin liên hệ</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">Thông tin để khách hàng và chúng tôi liên hệ với bạn.</p>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field" for="site_title">Email nhận thông báo</label>
					<?= $form->field( $model, 'email_notify' )->textInput( [
						'maxlength' => true,
						'class'     => 'next-input'
					] )->label( false ) ?>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Số điện thoại</label>
					<?= $form->field( $model, 'phone' )->textInput( [ 'class' => 'next-input' ] )->label( false ) ?>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Địa chỉ làm việc</label>
					<?= $form->field( $model, 'address' )->textarea( [
						'rows'  => 2,
						'class' => 'next-input'
					] )->label( false ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Thống kê và chiến dịch</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">Nhập mã theo dõi của google và mã chiến dịch quảng cáo facebook của bạn.</p>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field" for="site_title">Google Analytics</label>
					<?= $form->field( $model, 'google_analytics' )->textarea( [
						'rows'        => 2,
						'class'       => 'next-input',
						'placeholder' => 'Nhập mã Google Analytics tại đây'
					] )->label( false ) ?>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Facebook pixel</label>
					<?= $form->field( $model, 'facebook_pixel' )->textarea( [
						'rows'        => 2,
						'class'       => 'next-input',
						'placeholder' => 'Nhập mã Facebook pixel tại đây'
					] )->label( false ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Thông tin khác</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">Cung cấp thông tin fanpage facebook và video giới thiệu để khách hàng theo
                    dõi.</p>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field" for="site_title">Fanpage facebook</label>
					<?= $form->field( $model, 'page_facebook' )->textInput( [
						'class' => 'next-input'
					] )->label( false ) ?>
                </div>
                <div class="form-group">
                    <label class="text-title-field" for="admin_title">Video giới thiệu</label>
					<?= $form->field( $model, 'video_intro' )->textInput( [
						'class' => 'next-input'
					] )->label( false ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section">
        <div class="flexbox-annotated-section-annotation">
            <div class="annotated-section-title pd-all-20">
                <h2>Số dư tối thiểu</h2>
            </div>
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">Số tiền dư tối thiểu trong tài khoản .</p>
            </div>
        </div>
        <div class="flexbox-annotated-section-content">
            <div class="wrapper-content pd-all-20">
                <div class="form-group">
                    <label class="text-title-field" for="site_title">Số dư tối thiểu (đồng)</label>
                    <?= $form->field( $model, 'minimum_amount' )->textInput( [
                        'class' => 'next-input'
                    ] )->label( false ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="flexbox-annotated-section" style="border: none">
        <div class="flexbox-annotated-section-annotation">
            &nbsp;
        </div>
        <div class="flexbox-annotated-section-content">
            <button class="btn btn-info" type="submit">
                <span class="fa fa-cog"></span>
                Lưu cài đặt
            </button>
        </div>
    </div>

<?php ActiveForm::end(); ?>