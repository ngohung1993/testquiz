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
        <a href="<?= Url::to(['site/index']) ?>" id="logo" style="background: url(<?= $logo ?>) no-repeat center;background-size: contain"></a>
    </div>
    <div id="contentMain" class="loginpage  clearfix">
        <div class="content">
            <h1 style="font-size: 22px;margin-top: 10px">ĐĂNG KÝ TÀI KHOẢN</h1>

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
            <div class="form-register">
                <p style="margin: 15px 0;">
                    <label class="title">Nhập email đăng ký</label>
                    <?= $form->field($model, 'email')->textInput(
                        [
                            'placeholder' => 'Nhập email',
                            'class' => 'textfield',
                            'style' => 'margin-bottom: 10px',
                            'required' => 'required',
                            'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$'
                        ]
                    )->label(false) ?>

                    <label class="title">Tên hiển thị</label>
                    <?= $form->field($model, 'name')->textInput(
                        [
                            'placeholder' => 'Nhập tên',
                            'class' => 'textfield',
                            'style' => 'margin-bottom: 10px',
                            'required' => 'required',
                        ]
                    )->label(false) ?>
                    <span class="field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
                    <label class="title">Mật khẩu</label>
                    <?= $form->field($model, 'password')->passwordInput(
                        [
                            'placeholder' => 'Nhập mật khẩu',
                            'class' => 'textfield',
                            'style' => 'margin-bottom: 10px',
                            'required' => 'required'
                        ]
                    )->label(false) ?>
                    <label class="title">Nhập lại mật khẩu</label>
                    <?= $form->field($model, 're_password')->passwordInput(
                        [
                            'placeholder' => 'Nhập lại mật khẩu',
                            'class' => 'textfield',
                            'required' => 'required'
                        ]
                    )->label(false) ?>
                </p>
                <p>
                    <button id="btnnext" class="btn btn-next meta">Đăng ký</button>
                </p>
            </div>
            <?php ActiveForm::end() ?>
            <div class="actions">
                Đã có tài khoản
                <a href="<?= Url::to(['site/login']) ?>">
                    Đăng nhập
                </a>
            </div>
        </div>
    </div>
    <div id="footer"></div>
</div>
<style type="text/css">
    iframe#_hjRemoteVarsFrame {
        display: none !important;
        width: 1px !important;
        height: 1px !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }

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