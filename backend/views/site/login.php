<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
?>

<style>
    .required:after {
        content: '';
    }

    .content {
        margin: 60px auto 0 auto !important;
    }
</style>

<div class="content">
    <h3 class="form-title font-green">Đăng nhập vào hệ thống</h3>
    <div class="content-wrapper">
		<?php $form = ActiveForm::begin( [ 'id' => 'login-form' ] ); ?>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span></span>
        </div>
		<?= $form->field( $model, 'username' )->textInput( [
			'autofocus' => true,
			'class'     => 'form-control form-control-solid placeholder-no-fix'
		] ) ?>

		<?= $form->field( $model, 'password' )->passwordInput( [ 'class' => 'form-control form-control-solid placeholder-no-fix' ] ) ?>

        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <div class="checkbox checkbox-primary">
                        <label class="check mt-checkbox mt-checkbox-outline">
							<?= $form->field( $model, 'rememberMe' )->checkbox() ?>
                        </label>
                    </div>
                </div>
                <div class="col-xs-6 text-right">
                    <a class="lost-pass-link" href="https://cms.botble.com/admin/password/reset"
                       title="Lost password">Lost your password?</a>
                </div>
            </div>
        </div>

        <div class="form-group form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-sign-in"></i>
                Đăng nhập
            </button>
        </div>

		<?php ActiveForm::end(); ?>
    </div>
</div>

<div class="copyright">
    <p>
        Copyright 2018 © Tigerweb Technologies. Version:
        <span>2.0</span>
    </p>
    <p>
        <span class="active">
            <a href="https://cms.botble.com/admin-language/en">
                <img src="<?= '/admin/cms/img/us.png' ?>" title="English" alt="English">
                <span>English</span>
            </a>
        </span>
        <span>
            <a href="https://cms.botble.com/admin-language/vi">
                <img src="<?= '/admin/cms/img/vn.png' ?>" title="Tiếng Việt" alt="Tiếng Việt">
                <span>Tiếng Việt</span>
            </a>
        </span>
    </p>
</div>