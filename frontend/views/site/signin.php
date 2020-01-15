<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\FunctionHelper;

$logo = FunctionHelper::get_general_information()['logo'];
?>
<link rel="stylesheet" href="/theme/css/theme.account.css">
<link rel="stylesheet" href="/theme/css/bootstrap.min.css">
<div id="main">
    <div id="header">
        <a href="<?= Url::to(['site/index']) ?>" id="logo" style="background: url(<?= $logo ?>) no-repeat center"></a>
    </div>
    <div id="contentMain" class="loginpage  clearfix">
        <div class="content">
            <h1 style="font-size: 22px;margin-top: 10px">ĐĂNG NHẬP TÀI KHOẢN</h1>
            <div class="socialLogin">
                <div class="row">
                    <div class="col-md-6 col-xs-12 col-left">
                        <a class="btn facebook" href="<?= Url::to(['site/auth?authclient=facebook']) ?>">
                            <span class="fa fa-facebook"></span>
                            Facebook
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-12 col-right">
                        <a class="btn google" href="<?= Url::to(['site/auth?authclient=google']) ?>">
                            <span class="fa fa-google"></span>
                            Google
                        </a>
                    </div>
                </div>
            </div>
            <?php $form = ActiveForm::begin() ?>
            <div class="form-login">
                <p style="margin: 15px 0;">
                    <label class="title">Đăng nhập bằng email</label>
                    <?= $form->field($model, 'username')->textInput(
                        [
                            'placeholder' => 'Nhập email',
                            'class' => 'textfield',
                            'maxlength' => '32',
                            'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$'
                        ]
                    )->label(false) ?>
                </p>
                <p>
                    <?= $form->field($model, 'password')->passwordInput(
                        [
                            'placeholder' => 'Nhập mật khẩu',
                            'id' => 'password',
                            'class' => 'textfield',
                            'maxlength' => '32'
                        ]
                    )->label(false) ?>
                </p>
                <p>
                    <button type="submit" class="btn btn-login meta">Đăng nhập</button>
                </p>
            </div>
            <?php ActiveForm::end() ?>
            <div class="actions">
                <p>
                    Bạn chưa có tài khoản? <a href="<?= Url::to(['site/signup']) ?>">Đăng ký</a>
                </p>
                <p>
                    <a class="btn-forget" href="<?= Url::to(['site/account-recovery']) ?>">Quên mật khẩu?</a>
                </p>
            </div>
        </div>
    </div>
    <div id="footer"></div>
</div>
<style>
    .help-block {
        color: red !important;
    }

    html, body {
        height: 100% !important;
    }

    #main {
        height: 100%;
        background: url('/theme/images/pngtree-Bookcase-Library-Furniture-Furnishing-background-photo-355205.jpg') no-repeat;
        background-size: cover
    }
</style>