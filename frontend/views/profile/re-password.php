<?php
/**
 * Created by PhpStorm.
 * User: thuc
 * Date: 11/1/2018
 * Time: 1:51 PM
 */

use yii\helpers\Url;

?>
<link rel="stylesheet" href="/theme/css/loaders.css">
<link rel="stylesheet" href="/theme/css/jquery-confirm.css">
<link rel="stylesheet" href="/theme/css/messenger.css">
<link rel="stylesheet" href="/theme/css/messenger-theme-flat.css">
<link rel="stylesheet" href="/theme/css/messenger-theme-future.css">

<div class="col-sm-9">
    <div class="tab-content">
        <form id="doi-mat-khau-form" class="form-horizontal">
            <h3 class="ad_user_name" style="margin-top: -30px">Đổi mật khẩu</h3>
            <div class="content_user_info">
                <div class="form-group field-doimatkhauform-pass_new_again required">
                    <label class="control-label col-sm-4 col-md-4 col-lg-4" for="doimatkhauform-pass_old">
                        Mật khẩu cũ
                    </label>
                    <div class="col-sm-6">
                        <input type="password" id="password" class="form-control"
                               name="DoiMatKhauForm[pass_old]" placeholder="...." aria-required="true">
                        <p class="help-block help-block-error "></p>
                    </div>
                </div>
                <div class="form-group field-doimatkhauform-pass_new required">
                    <label class="control-label col-sm-4 col-md-4 col-lg-4" for="doimatkhauform-pass_new">
                        Mật khẩu mới
                    </label>
                    <div class="col-sm-6">
                        <input type="password" id="new-password" class="form-control"
                               name="DoiMatKhauForm[pass_new]" placeholder="...." aria-required="true">
                        <p class="help-block help-block-error "></p>
                    </div>
                </div>
                <div class="form-group field-doimatkhauform-pass_new_again required">
                    <label class="control-label col-sm-4 col-md-4 col-lg-4" for="doimatkhauform-pass_new_again">
                        Nhập lại mật khẩu mới
                    </label>
                    <div class="col-sm-6">
                        <input type="password" id="re-password" class="form-control"
                               name="DoiMatKhauForm[pass_new_again]" placeholder="...." aria-required="true">
                        <p class="help-block help-block-error "></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4">
                        <button onclick="change_password()" type="button" class="btn btn-success"
                                name="login-button">Đổi mật khẩu
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="loader" class="opacity loader">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<style>
    .opacity {
        background-color: #ababab;
        opacity: 0.5;
        display: none;
    }

    @media (min-width: 768px) {
        .content_user_info {
            padding-top: 25px;
        }
    }

    @media (max-width: 768px) {
        .ad_user_name {
            margin-top: 0 !important;
        }

        .content_user_info {
            padding: 10px !important;
        }
    }
</style>
<script src="/theme/js/jquery-3.3.1.min.js"></script>
<script src="/theme/js/messenger.min.js"></script>
<script src="/theme/js/messenger-theme-flat.js"></script>
<script src="/theme/js/messenger-theme-future.js"></script>
<script src="/theme/js/jquery-confirm.js"></script>
<script>
    function showErrorMessage(msg) {
        Messenger({
            extraClasses: 'messenger-fixed messenger-on-right messenger-on-top',
            theme: 'flat'
        }).post({
            message: msg,
            type: 'error',
            showCloseButton: true
        });
    }

    function showSuccess(msg) {
        Messenger({
            extraClasses: 'messenger-fixed messenger-on-right messenger-on-top',
            theme: 'flat'
        }).post(msg);
    }

    let check_required = function (id) {

        let tag = $('#' + id);

        if (tag.val() === '' || tag.val() === '0') {
            tag.css('border', '1px solid #da3535');
            return 1;
        } else {
            tag.css('border', '1px solid #ccc');
            return 0;
        }
    };

    let change_password = function () {

        let error = 0;

        error += check_required('password');
        error += check_required('new-password');
        error += check_required('re-password');

        if (error === 0) {
            $('#loader').css('display', 'block');

            let password_old = $('#password').val();
            let password = $('#new-password').val();
            let re_password = $('#re-password').val();

            let data = {};

            if (password_old)
                data.password_old = password_old;

            if (password) {
                data.password = password;
            }

            if (re_password) {
                data.re_password = re_password;
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/change-password',
                data: data,
                error: function () {

                },
                success: function (response) {
                    $('#loader').css('display', 'none');

                    if (response === true) {
                        alert('Đổi mật khẩu thành công.Hệ thống sẽ tự động đăng xuất!');
                        location.href = '/site/logout';
                    } else {
                        showErrorMessage(response);
                    }
                }
            });
        } else {
            showErrorMessage('Yêu cầu nhập đầy đủ thông tin.');
        }
    };
</script>


