<?php

use yii\widgets\ActiveForm;
use backend\assets\EditorAsset;
use backend\assets\NestableAsset;
use backend\assets\FancyboxAsset;
use yii\helpers\Url;

EditorAsset::register($this);
FancyboxAsset::register($this);
NestableAsset::register($this);

/* @var $this yii\web\View */
/* @var $account common\models\AccountBank */

?>
<style>
    .detail-info{
        padding: 7px 0;
    }
    .duong_ke{
        border-top: 1px dotted #f1f1f1;
        border-bottom: 1px dotted #f1f1f1;
        padding: 10px 0;
    }
</style>
<div>
    <?php $form = ActiveForm::begin(['options' => ['onsubmit' => "return validateFormRecharge()"]]); ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-md-8">
            <div class="tabbable-custom tabbable-tabdrop">
                <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                    <div class="widget-title">
                        <h4>
                            <span>Thông tin giao dịch</span>
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="btn-set">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="color: #000; font-weight: bold; font-size: 14px">Thông tin thành viên</p>
                                    <div class="pull-left">
                                        <p class="detail-info">Mã</p>
                                        <p class="detail-info">Người nhận</p>
                                        <p class="detail-info">Địa chỉ Email</p>
                                        <p class="detail-info">Số dư TK:</p>
                                    </div>
                                    <div class="pull-right">
                                        <p class="detail-info" style="float: right;">STK-ID: <?=$model->code?></p><br>
                                        <p class="detail-info" style="float: right;"><?=$model->name?></p><br>
                                        <p class="detail-info" style="float: right;"><?=$model->email?></p><br>
                                        <p class="detail-info" style="float: right; color: blue; font-weight: bold"><?=number_format($model->wallet, 0, ',', '.')?> đ<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 right-sidebar">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Số tiền nạp</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <div class="alert-info note" style="display: none">
                            <p id="note-money" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Trường nạp tiền không được để trống.
                            </p>
                            <p id="note-compare" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Số tiền nhập phải lớn hơn 20.000 vnđ.
                            </p>
                        </div>
                        <div class="class-avatar-outer relative" style="padding-top: -10px; margin: 0 !important;">
                            <input type="text" class="form-control" id="money" name="money" value="" placeholder="100.000">
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Nội dung giao dịch</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <div class="alert-info notes" style="display: none">
                            <p id="note-content" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Nội dung giao dịch không được để trống.
                            </p>
                        </div>
                        <div class="class-avatar-outer relative" style="padding-top: -10px; margin: 0 !important;">
                            <textarea  id="content-message" class="form-control" placeholder="" rows="2" name="message-transaction"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Xuất bản</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <button type="submit" class="btn btn-success" onclick="">
                            <i class="fa fa-check-circle"></i> Xác nhận
                        </button>
                        <a href="<?=Url::to(['index'])?>" class="btn btn-danger">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> Hủy giao dịch
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

