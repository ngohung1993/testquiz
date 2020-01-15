<?php

use yii\helpers\Url;
$this->title = "Chi tiết nạp tiền";
?>
<style>
    .detail-info {
        padding: 7px 0;
    }

    .duong_ke {
        border-top: 1px dotted #f1f1f1;
        border-bottom: 1px dotted #f1f1f1;
        padding: 10px 0;
    }
</style>

<div class="col-sm-9 response" style="margin-top: -49px">
    <div class="tab-content">
        <div class="">
            <h3 class="ad_user_name">Quản lý tài chính</h3>
            <div class="row">
                <div class="config_withdrawal" style="height: auto; width: 100%" >
                    <h4>Thông tin chi tiết giao dịch <span style="font-weight: bold; color: #1fb6ff">nạp tiền</span></h4>
                    <div class="btn-set" style="padding: 0 30px">
                        <div class="row duong_ke">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <p style="color: #000; font-weight: bold; font-size: 14px">Chi tiết giao dịch</p>
                                <div class="pull-left" style=" font-size: 16px">
                                    <p class="detail-info">Số tiền</p>
                                    <p class="detail-info">Thời gian</p>
                                </div>
                                <div class="pull-right" style=" font-size: 16px">
                                    <p class="detail-info"
                                       style="float: right; color: blue; font-weight: bold"><?= number_format($model['amount'], 0, ',', '.') . ' đ' ?></p>
                                    <br>
                                    <p class="detail-info"
                                       style="float: right;"><?= date("d/m/Y H:i", $model['updated_at'])?></p>
                                    <br>
                                </div>
                            </div>

                        </div>
                        <div class="row duong_ke">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="pull-left" style=" font-size: 16px">
                                    <p class="detail-info" style="color: #000; font-weight: bold;">Thanh
                                        toán</p>
                                    <p class="detail-info" style="color: #000; font-weight: bold;">Trạng
                                        thái:

                                    </p>
                                </div>
                                <div class="pull-right">
                                    <p class="detail-info"
                                       style="color: #000; font-weight: bold; font-size: 16px; float: right"><?= number_format($model['amount'], 0, ',', '.') . ' đ' ?></p>
                                    <p>
                                         <span class="label <?= $model->getStatusBg() ?>">
                                            <span class="fa fa-clock-o"></span>
                                            <?= $model->getStatusLabel() ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
