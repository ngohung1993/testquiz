<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;

$key2 = FunctionHelper::get_setting_by_key('key2');
$key3 = FunctionHelper::get_setting_by_key('key3');
$key6 = FunctionHelper::get_setting_by_key('key6');
?>
<div class="box-footer" style="padding-top: 10px">
    <div class="container">
        <div class="row" style="padding-bottom: 20px;">
            <div class="col-md-12">
                <div class="col-md-4 col-sm-4 col-xs-12 footer-content">
                    <div class="footer-titel">
                        <div class="footer-titel-2">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>LIÊN HỆ</h4>
                                    <p>
                                        <i aria-hidden="true" class="fa fa-map-marker"></i>
                                        <?= FunctionHelper::get_general_information()['address'] ?>
                                    </p>
                                    <p>
                                        <i aria-hidden="true" class="fa fa-envelope-o"></i>
                                        <?= FunctionHelper::get_general_information()['email_notify'] ?>
                                    </p>
                                    <p>
                                        <i aria-hidden="true" class="fa fa-phone"></i>
                                        <?= FunctionHelper::get_general_information()['phone'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-content">
                    <div class="footer-titel">
                        <div class="footer-titel-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>SITE MAP</h4>
                                    <?php foreach (FunctionHelper::get_categories_by_parent_id(null, 5) as $key => $value): ?>
                                        <a href="<?= Url::to(['site/category', 'slug' => $value['slug']]) ?>">
                                            <p><?= $value['title'] ?></p>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-content">
                    <div class="footer-titel">
                        <div class="footer-titel-1">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>ĐĂNG KÍ NHẬN TIN</h4>
                                    <p>Nhập Email của bạn để đăng kí tin mới nhất</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="" id="email"
                                               aria-describedby="helpId" placeholder="Địa chỉ Email ...">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <a name="" id="" style="text-decoration: none" class="btn btn-primary"
                                       href="javascript:void(0)" onclick="sendMail()"
                                       role="button">Gửi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="lds-spinner">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<div class="slickOverlay sm-animated closeModal sm-fadeIn"
     style="background: rgba(0, 0, 0, 0.8);animation-duration: 0.3s;display: none">
</div>
<style>
    .lds-spinner {
        color: official;
        position: fixed;
        width: 64px;
        height: 64px;
        top: 30%;
        left: 50%;
        z-index: 61;
        display: none;
    }

    .lds-spinner div {
        transform-origin: 32px 32px;
        animation: lds-spinner 1.2s linear infinite;
    }

    .lds-spinner div:after {
        content: " ";
        display: block;
        position: absolute;
        top: 3px;
        left: 29px;
        width: 5px;
        height: 14px;
        border-radius: 20%;
        background: #fff;
    }

    .lds-spinner div:nth-child(1) {
        transform: rotate(0deg);
        animation-delay: -1.1s;
    }

    .lds-spinner div:nth-child(2) {
        transform: rotate(30deg);
        animation-delay: -1s;
    }

    .lds-spinner div:nth-child(3) {
        transform: rotate(60deg);
        animation-delay: -0.9s;
    }

    .lds-spinner div:nth-child(4) {
        transform: rotate(90deg);
        animation-delay: -0.8s;
    }

    .lds-spinner div:nth-child(5) {
        transform: rotate(120deg);
        animation-delay: -0.7s;
    }

    .lds-spinner div:nth-child(6) {
        transform: rotate(150deg);
        animation-delay: -0.6s;
    }

    .lds-spinner div:nth-child(7) {
        transform: rotate(180deg);
        animation-delay: -0.5s;
    }

    .lds-spinner div:nth-child(8) {
        transform: rotate(210deg);
        animation-delay: -0.4s;
    }

    .lds-spinner div:nth-child(9) {
        transform: rotate(240deg);
        animation-delay: -0.3s;
    }

    .lds-spinner div:nth-child(10) {
        transform: rotate(270deg);
        animation-delay: -0.2s;
    }

    .lds-spinner div:nth-child(11) {
        transform: rotate(300deg);
        animation-delay: -0.1s;
    }

    .lds-spinner div:nth-child(12) {
        transform: rotate(330deg);
        animation-delay: 0s;
    }

    @keyframes lds-spinner {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    .slickOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        content: "";
        z-index: 60;
    }
</style>
<script type="text/javascript">
    function isValidEmail(emailText) {
        let pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailText);
    };

    function sendMail() {

        if ($('#email').val() == "" || !isValidEmail($('#email').val())) {
            alert("Email phải hợp lệ !");
            return false;
        }

        else {
            $('.slickOverlay').css('display', 'block');
            $('.lds-spinner').css('display', 'block');
            let email = $('#email').val();
            let content =
                `<table>
                <tr style="border: 1px solid black;">
                    <td style="padding: 10px">Email</td>
                    <td style="padding: 10px;color: red">${email}</td>
                </tr>

            </table>`;

            let form = new FormData();
            form.append("title", "Đăng Ký Nhận Tin");
            form.append("email_root", "<?=FunctionHelper::get_general_information()['email_notify']?>");
            form.append("email_guest", email);
            form.append("content", content);
            let settings = {
                "url": "admin/ajax/send-mail",
                "method": "POST",
                "headers": {
                    "cache-control": "no-cache",
                    "postman-token": "be3c982f-e715-6816-b350-f47f8bb109d8"
                },
                "processData": false,
                "contentType": false,
                "data": form,
                "mimeType": "multipart/form-data"
            };
            $.ajax(settings).fail(function (err) {
                alert('Không tồn tại email nhận!');
                $('.lds-spinner').css('display', 'none');
                $('.slickOverlay').css('display', 'none');
            });
            $.ajax(settings).done(function () {
                $('.lds-spinner').css('display', 'none');
                alert("Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên lạc lại trong thời gian sớm nhất!");
                $('.slickOverlay').css('display', 'none');
                location.reload();
            });
        }
    }
</script>