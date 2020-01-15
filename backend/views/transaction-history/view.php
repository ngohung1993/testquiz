<?php

use common\models\TransactionHistory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\base\TransactionHistory */

$this->title = 'Chi tiết giao dịch rút tiền';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaction Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Trang chủ</a></li>

        <li class="breadcrumb-item active"><a href="<?= Url::to(['transaction-history/index']) ?>">Quản lý giao dịch</a></li>

        <li class="breadcrumb-item active">Hóa đơn</li>
    </ol>
    <div class="clearfix"></div>
    <div class="col-md-8 col-lg-offset-2 col-xs-12 col-sm-12">
        <div class="tabbable-custom tabbable-tabdrop">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        Hóa đơn giao dịch<span style="color: blue">rút tiền</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
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
                                    <p class="detail-info" style="float: right;"><?=$account['name_bank']?></p>
                                </div>
                            </div>

                        </div>
                        <div class="row duong_ke">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <p style="color: #000; font-weight: bold; font-size: 14px">Chi tiết giao dịch</p>
                                <div class="pull-left">
                                    <p class="detail-info">Số tiền</p>
                                    <p class="detail-info">Thời gian</p>
                                    <p class="detail-info">Phí giao dịch</p>
                                    <p class="detail-info">Ghi chú</p>
                                </div>
                                <div class="pull-right">
                                    <p class="detail-info" style="float: right;"><?=number_format($model['amount'],0,',','.').' đ'?></p><br>
                                    <p class="detail-info" style="float: right;"><?= date("Y/m/d H:i", strtotime($model['updated_at']))?></p><br>
                                    <p class="detail-info" style="float: right;">Miễn phí</p><br>
                                    <p class="detail-info" style="float: right;"><?=$model['note']?></p><br>
                                </div>
                            </div>

                        </div>
                        <div class="row duong_ke">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="pull-left">
                                    <p class="detail-info"style="color: #000; font-weight: bold; font-size: 14px">Thanh toán</p>
                                    <p class="detail-info"style="color: #000; font-weight: bold; font-size: 14px">Trạng thái:

                                    </p>
                                </div>
                                <div class="pull-right">
                                    <p class="detail-info"style="color: #000; font-weight: bold; font-size: 14px; float: right"><?=number_format($model['amount'],0,',','.').' đ'?></p>
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
        <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
            <div class="widget-title">
                <h4>
                    <span>Hình ảnh đính kèm</span>
                </h4>
            </div>
            <div class="widget-body">
                <div class="btn-set">
                    <img src="<?=$model['images']?>" alt="" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
</div>
