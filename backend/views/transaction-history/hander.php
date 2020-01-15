<?php

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use common\models\TransactionHistory;

/* @var $this yii\web\View */
/* @var TYPE_NAME $pages */
/* @var $exams array common\models\Exam */
/* @var $transactions array common\models\Transactions */
/* @var $user */
/* @var $status */
/* @var $type */
/* @var $start */
/* @var $end */


$this->title = Yii::t('backend', 'Giao dịch đã xử lý');

?>

<style>
    .dataTables_wrapper td .table-actions {
        min-width: 75px!important;
        text-align: center;
    }
</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Đề thi tải lên</li>
    </ol>
    <div class="clearfix"></div>

    <div class="table-wrapper">
        <div class="table-configuration-wrap" style="display: block; padding: 0">
            <div class=" portlet light bordered portlet-no-padding table-menus_wrapper"
                 style="padding: 10px; margin-bottom: 10px">
                <h4>Tìm kiếm</h4>
                <div class="theme-search">

                    <?php $form = ActiveForm::begin([
                        'action' => ['hander'],
                        'method' => 'get',
                    ]); ?>
                    <div class="filter_list inline-block filter-items-wrap">
                        <div class="filter-item form-filter filter-item-default">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Tên người yêu cầu</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="user" value="<?=$user?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Trạng thái</label>
                                    <div class="form-group">
                                        <select name="status" id="" class="form-control" >
                                            <option value="">Chọn</option>
                                            <option <?= $status == TransactionHistory::SUCCESS ? 'selected' : '' ?> value="<?=TransactionHistory::SUCCESS?>">Thành công</option>
                                            <option <?= $status == TransactionHistory::FAILURE ? 'selected' : '' ?> value="<?=TransactionHistory::FAILURE?>">Thất bại</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Loại giao dịch</label>
                                    <div class="form-group">
                                        <select name="type" id="" class="form-control">
                                            <option value="">Chọn</option>
                                            <option <?=$type == TransactionHistory::WITHDRAWAL ? 'selected' : '' ?> value="<?=TransactionHistory::WITHDRAWAL?>">Rút tiền</option>
                                            <option <?=$type == TransactionHistory::RECHARGE ? 'selected' : '' ?> value="<?=TransactionHistory::RECHARGE?>">Nạp tiền</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Từ ngày</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" name="start" value="<?=$start?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Đến ngày</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" name="end" value="<?=$end?>">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group" style="margin-top: 24px">
                                        <button class="btn btn-primary btn-show-table-options" type="submit" style="height: 34px" title="Tìm kiếm">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="portlet light bordered portlet-no-padding">
            <div class="portlet-title">
                <div class="caption">
                    <div class="wrapper-action"></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="dt-buttons btn-group">
                            <a class="btn btn-default buttons-reload" href="<?= Url::to(['hander']) ?>">
                                <span><i class="fa fa-refresh"></i>
                                    Tải lại
                                </span>
                            </a>
                        </div>
                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                            <thead>
                            <tr role="row">
                                <th width="10px" class="text-left no-sort sorting_asc"
                                    style="width: 40px;text-align: center;">
                                    <label>
                                        <input style="margin-right: 10px;" title="" type="checkbox" class="minimal">
                                    </label>
                                </th>
                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                    ID
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 150px;">
                                    Nội dung
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 50px;">
                                    Loại giao dịch
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                    Số tiền
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled" style="width: 100px;">
                                    Người yêu cầu
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tạo
                                </th>
                                <th width="100px" class="column-key-status sorting" style="width: 50px;">
                                    Trạng thái
                                </th>
                                <th class="text-center sorting_disabled" style="width: 50px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transactions as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input alt="" title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="text-left column-key-name" title="<?=$value['message']?>">
                                        <?=substr($value['message'],0,30).'...'?>
                                    </td>
                                    <td>
                                        <?php if($value['type']==1):?>
                                            <span class="label label-info">Rút tiền</span>
                                        <?php endif;?>
                                        <?php if($value['type']==2):?>
                                            <span class="label label-warning">Nạp tiền</span>
                                        <?php endif;?>
                                    </td>
                                    <td class="column-key-created_at" style="color: red; font-weight: bold">
                                        <?= number_format($value->amount, 0, ',', '.').' đ' ?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <a href="<?= Url::to(['user/view', 'id' => $value['user']['id']]) ?>">
                                            <?=$value['user']['name']?>
                                            <span class="fa fa-external-link"></span>
                                        </a>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('H:i d/m/Y', $value['created_at']) ?>
                                    </td>
                                    <td>
                                         <span class="label pull-left <?= $value->getStatusBg() ?>">
                                            <span class="<?=$value->getStatusIcon()?>"></span>
                                            <?= $value->getStatusLabel() ?>
                                        </span>
                                    </td>
                                    <td class="text-center" style="width: 50px;">
                                        <?php if($value->type == 1):?>
                                            <div class="table-actions">
                                                <a href="<?= Url::to(['view', 'id' => $value['id']]) ?>"
                                                   class="btn btn-icon btn-sm btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        <?php endif;?>
                                        <?php if($value->type == 2):?>
                                            <div class="table-actions">
                                                <a href="<?= Url::to(['views', 'id' => $value['id']]) ?>"
                                                   class="btn btn-icon btn-sm btn-warning">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($transactions)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($transactions)): ?>
                            <div class="datatables__info_wrap text-center">
                                <div class="dataTables_info" style="margin-top: 10px">
                                    <div class="paging">
                                        <div class="dataTables_paginate">
                                            <?php /** @var TYPE_NAME $pages */
                                            echo LinkPager::widget([
                                                'pagination' => $pages,
                                                'maxButtonCount' => 5,
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>