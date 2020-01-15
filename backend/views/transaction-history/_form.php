<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\EditorAsset;
use backend\assets\NestableAsset;
use backend\assets\FancyboxAsset;
use common\models\TransactionHistory;

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
    <?php $form = ActiveForm::begin(); ?>


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
                                    <p style="color: #000; font-weight: bold; font-size: 14px">Thông tin khách hàng</p>
                                    <div class="pull-left">
                                        <p class="detail-info">Người nhận</p>
                                        <p class="detail-info">Số tài khoản</p>
                                        <p class="detail-info">Chi nhánh</p>
                                        <p class="detail-info">Tên ngân hàng</p>
                                    </div>
                                    <div class="pull-right">
                                        <p class="detail-info" style="float: right;"><?=$account['account_name']?></p><br>
                                        <p class="detail-info" style="float: right;"><?=$account['account_number']?></p><br>
                                        <p class="detail-info" style="float: right;"><?=$account['bank_branch']?></p><br>
                                        <p class="detail-info" style="float: right;"><?=$account['name_bank']?><br>
                                    </div>
                                </div>

                            </div>
                            <div class="row duong_ke">
                                <div class="col-md-12">
                                    <p style="color: #000; font-weight: bold; font-size: 14px">Chi tiết giao dịch</p>
                                    <div class="pull-left">
                                        <p class="detail-info">Số tiền</p>
                                        <p class="detail-info">Phí giao dịch</p>
                                    </div>
                                    <div class="pull-right">
                                        <p class="detail-info"><?=number_format($model['amount'],0,',','.').' đ'?></p>
                                        <p class="detail-info" style="float: right;">Miễn phí</p><br>
                                    </div>
                                </div>

                            </div>
                            <div class="row duong_ke">
                                <div class="col-md-12">
                                    <div class="">
                                        <p class="detail-info"style="color: #000; font-weight: bold; font-size: 14px">Nội dung</p>
                                        <p class="detail-info"><?=$model['message']?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row duong_ke">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <p class="detail-info"style="color: #000; font-weight: bold; font-size: 14px">Thanh toán</p>
                                    </div>
                                    <div class="pull-right">
                                        <p class="detail-info"style="color: #000; font-weight: bold; font-size: 14px"><?=number_format($model['amount'],0,',','.').' đ'?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Ghi chú</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <?= $form->field($model, 'note')->textarea(['rows' => '2','id'=>'textaria']) ->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 right-sidebar">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Xuất bản</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <?php if($model->status == TransactionHistory::ADMIN_HANDLING):?>
                    <div class="btn-set">
                        <button type="submit" class="btn btn-success" onclick="">
                            <i class="fa fa-check-circle"></i> Xác nhận
                        </button>
                        <button type="button" class="btn btn-danger" onclick="Transaction_cancel(<?=$model['id']?>)">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> Hủy giao dịch
                        </button>
                    </div>
                    <?php endif;?>
                    <?php if($model->status == TransactionHistory::SUCCESS || $model->status == TransactionHistory::FAILURE):?>
                        <div class="btn-set">
                            <a href="<?=Url::to(['view','id'=> $model->id])?>" class="btn btn-info" onclick="">
                                <i class="fa fa-eye" aria-hidden="true"></i> Đã xử lý
                            </a>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Hình ảnh</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <div class="class-avatar-outer relative" style="padding-top: -10px; margin: 0 !important;">
                            <?php if($model['images']=== null): ?>
                                <img id="class_avatar_img" src="/uploads/cms/img/default-image_580.png"
                                     class="class-avatar img-responsive" alt="Image" width="260" height="280" alt ="hoa_don">
                                <a class="absolute block" id="upload_avatar_button"
                                   href="javascript:void(0)"><i class="fa fa-lecture-create--content-add"></i>
                                    Hình ảnh hóa đơn giao dịch
                                </a>
                            <?php else: ?>
                                <img id="class_avatar_img" src="<?= $model['images']; ?>"
                                     class="class-avatar img-responsive" alt="Image" width="260" height="280"">
                                <a href="javascript:void(0)" id="upload_avatar_button" class="absolute block">
                                    <i class="fa fa-photo"></i>
                                    Hình ảnh hóa đơn giao dịch
                                </a>
                            <?php endif; ?>
                            <div id="cropContainerModal" style="display: none;">
                                <div class="cropControls cropControlsUpload"></div>
                                <input type="file" name="img" id="cropContainerModal_imgUploadField">
                                <?= $form->field($model, 'images')->hiddenInput(['id' => 'classroom-avatar'])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

