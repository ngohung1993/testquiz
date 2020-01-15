<?php

use yii\widgets\ActiveForm;
use common\helpers\FunctionHelper;

$logo = FunctionHelper::get_general_information()['logo'];
?>
<link rel="stylesheet" href="/theme/css/theme.account.css">
<div id="main">
    <div id="header"><a href="/" id="logo" style="background: url(<?= $logo ?>) no-repeat center"></a></div>
    <div id="contentMain" class="loginpage  clearfix">
        <div class="content">
            <div class="wbox mageta recovery">
                <h1 class="whd">
                    <a>Lấy Lại Mật Khẩu</a>
                </h1>
                <div class="wbd clearfix">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <p>
                        Bạn đã quên mật khẩu?
                    </p>
                    <p>
                        Nhập địa chỉ email đã đăng ký vào ô bên dưới.
                        Sau đó kiểm tra email để nhận lại mật khẩu tài khoản của bạn.
                    </p>
                    <p>
                        <label for="Email">Email tài khoản</label>
                        <?= $form->field($model, 'email')->textInput([
                            'autofocus' => true,
                            'class' => 'textfield',
                            'maxlength' => '32'
                        ])->label(false) ?>
                    </p>
                    <p class="toolbar">
                        <button type="submit" class="btn btn-submit">Tiếp theo</button>
                    </p>
                    <?php ActiveForm::end(); ?>
                </div>
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
