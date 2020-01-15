<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Url;
use common\helpers\FunctionHelper;

$this->title = 'Lấy lại mật khẩu';
$this->params['breadcrumbs'][] = $this->title;
$logo = FunctionHelper::get_general_information()['logo'];
?>
<link rel="stylesheet" href="/theme/css/ressetpassword.css">
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
                    <p>
                        Vui lòng kiểm tra email để lấy lại mật khẩu tài khoản của bạn!
                    </p>
                    <p>

                    </p>
                    <p class="toolbar">
                        <a href="<?= Url::to(['site/login']) ?>">
                            <button type="button" class="btn btn-submit">Đăng nhập lại</button>
                        </a>
                    </p>
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