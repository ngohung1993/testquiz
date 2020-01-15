<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use common\helpers\FunctionHelper;

$user = Yii::$app->user->identity;
$this->registerJsFile('@web/theme/js/function-js.min.js');
?>

<div class="col-sm-9 content-mobile">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -30px">Thông tin cá nhân</h3>
        <div class="content_user_info">
            <div class="info_user_cnt" style="margin: 0 50px; width: 85%">
                <div class="edit_from_user">
                    <h4 class="title_user_info">
                        tên hiện thị
                        <?php if ($user['auth'] == null): ?>
                            <a href="javascript:void(0);" class="icon_edit_title filter icon"
                               onclick="edit_user(this); return">Sửa
                            </a>
                        <?php endif; ?>
                    </h4>
                    <div class="user_result">
                        <h3 class="ad_user_name edit_name"><?= isset($user['name']) ? $user['name'] : 'User-Name' ?></h3>
                    </div>
                    <div class="user_no_result">
                        <form method="POST" name="fr_name" class="fr_name"
                              action="">
                            <span class="ip_name_edit">
                                <input name="txtUsername"
                                       value="<?= isset($user['name']) ? $user['name'] : 'User-Name' ?>"
                                       class="edit_ip_name"
                                       onkeydown="CountLeft(this.form.txtUsername,this.form.cmt_disabled,0)"
                                       onkeyup="CountLeft(this.form.txtUsername,this.form.cmt_disabled,0)">
                                <em>
                                    <input disabled="disabled" name="cmt_disabled" class="number_cmt">/30</em>
                            </span>
                            <button type="button" name="frm_name" onclick="return Checklenght()"
                                    class="smt_edit_info" value="frm_name">
                                Lưu
                            </button>
                            <a href="javascript:;" class="smt_exit"
                               onclick="exit_user(this); return">
                                Huỷ
                            </a>
                        </form>
                    </div>
                </div>
                <div class="line_array"></div>
                <div class="edit_from_user">
                    <h4 class="title_user_info">
                        thông tin
                        <?php if ($user['auth'] == null): ?>
                            <a href="javascript:;" class="icon_edit_info filter icon"
                               onclick="edit_user(this); return">Sửa</a>
                        <?php endif; ?>
                    </h4>
                    <div class="user_result">
                        <p>
                            <span class="edit_info_left">Ngày sinh</span>
                            <span class="equal_info_right"><?= isset($user['birthday']) ? date('d/m/Y', strtotime($user['birthday'])) : date('d/m/Y', time() + 7 * 3600) ?></span>
                        </p>
                        <p>
                            <span class="edit_info_left">Số điện thoại</span>
                            <span class="equal_info_right"><?= $user['phone'] ?></span>
                        </p>
                        <p>
                            <span class="edit_info_left">Địa chỉ</span>
                            <span class="equal_info_right"><?= $user['address'] ?></span>
                        </p>
                    </div>
                    <div class="user_no_result">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <p>
                                <span class="edit_info_left">Ngày sinh</span>
                                <span class="equal_info_right">
                                                <input type="date" name="user_date_edit"
                                                       class="user_date_edit hasDatepicker"
                                                       value="<?= isset($user['birthday']) ? date('Y-m-d', strtotime($user['birthday'])) : date('Y-m-d', time() + 7 * 3600) ?>"
                                                       id="birthday">
                                            </span>
                            </p>
                            <p>
                                <span class="edit_info_left">Số điện thoại</span>
                                <span class="equal_info_right">
                                                <input type="text" name="txtPhone" id="phone"
                                                       value="<?= $user['phone'] ?>" class="user_address_edit"
                                                       placeholder="">
                                            </span>
                            </p>
                            <p>
                                <span class="edit_info_left">Địa chỉ</span>
                                <span class="equal_info_right">
                                                <input type="text" name="txtAdd" id="address"
                                                       value="<?= $user['address'] ?>"
                                                       class="user_address_edit" placeholder="">
                                            </span>
                            </p>
                            <button type="button" name="smt_name" class="smt_edit_info smt_info"
                                    onclick="save_profile()"
                                    value="smt_name">
                                Lưu
                            </button>
                            <a href="javascript:;" class="smt_exit smt_exit_right"
                               onclick="exit_user(this); return">Huỷ</a>
                        </form>
                    </div>
                </div>
                <div class="line_array"></div>
                <div class="edit_from_user">
                    <h4 class="title_user_info">
                        Mật khẩu
                        <?php if ($user['auth'] == null): ?>
                            <a href="<?= Url::to(['profile/re-password']) ?>"
                               class="icon_edit filter icon">Sửa</a>
                        <?php endif; ?>
                    </h4>
                    <p>
                        <span class="edit_info_left">Mật khẩu</span>
                        <span class="equal_info_right">****************</span>
                    </p>
                </div>
                <div class="line_array"></div>
                <div class="edit_from_user">
                    <h4 class="title_user_info">
                        Thông tin tài khoản rút tiền
                    </h4>
                    <div class="user_result">
                        <p>
                            <span class="edit_info_left">Số TK:</span>
                            <span class="equal_info_right"><?= FunctionHelper::get_account_bank_by_user_id($user['id'])['account_number'] ?></span>
                        </p>
                        <p>
                            <span class="edit_info_left">Email tài khoản</span>
                            <span class="equal_info_right"><?= $user['email'] ?></span>
                        </p>
                    </div>
                </div>
                <div class="line_array"></div>
            </div>
        </div>
    </div>
</div>
<style>
    @media (max-width: 768px) {
        .ad_user_name {
            margin-top: 0 !important;
        }

        .content-mobile {
            padding: 0 5px !important;
        }

        .info_user_cnt {
            width: 100% !important;
            margin: 0 !important;
            padding: 10px !important;
        }
    }
</style>