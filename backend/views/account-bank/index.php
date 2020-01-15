<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách tài khoản ngân hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .dataTables_wrapper td .table-actions {
        min-width: 75px !important;
        text-align: center;
    }
</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Tài khoản ngân hàng</li>
    </ol>
    <div class="clearfix"></div>

    <div class="table-wrapper">
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
                            <a class="btn btn-default buttons-reload" href="<?= Url::to(['create']) ?>">
                                <span><i class="fa fa-plus" aria-hidden="true"></i>
                                    Thêm mới
                                </span>
                            </a>
                            <a class="btn btn-default buttons-reload" href="<?= Url::to(['index']) ?>">
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
                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                    Tên tài khoản
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                    Số tài khoản
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                    Tên ngân hàng
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled" style="width: 100px;">
                                    Chi nhánh
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
                            <?php
                            /** @var TYPE_NAME $accountBanks */
                            foreach ($accountBanks as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input alt="" title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="text-left column-key-name" title="">
                                        <?= $value->account_name?>
                                    </td>
                                    <td class="text-left">
                                        <?= $value->account_number?>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= $value->account_number ?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <?= $value->bank_branch ?>
                                    </td>
                                    <td>
                                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini" style="border:none">
                                            <input data-id="<?= $value->id ?>" data-api="ajax/released"
                                                   data-table="account-bank" data-column="status"
                                                   type="checkbox" <?= $value->status ? 'checked="checked"' : ''?>
                                                   title="" name="switch-checkbox">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-icon btn-sm btn-primary tip" href="<?=Url::to([
                                            'account-bank/update',
                                            'id' => $value->id
                                        ])?>"><i class="fa fa-edit"></i></a>
                                        <?=Html::a(Yii::t('backend', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $value->id], [
                                            'class' => 'btn btn-danger tip text-center',
                                            'title'=>'Xóa',
                                            'data' => [
                                                'confirm' => Yii::t('backend', 'Bạn có chắc chắn muốn xóa?'),
                                                'method' => 'post',
                                            ],
                                        ])?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($accountBanks)): ?>
                        <div class="dataTables_empty"></div>
                        <div class="notify">
                            <span>Không có dữ liệu</span>
                        </div>
                        <?php endif;?>
                        <div class="datatables__info_wrap">
                            <div class="dataTables_paginate paging_simple_numbers">
                            </div>
                            <div class="dataTables_info" id="table-posts_info" role="status"
                                 aria-live="polite">
                                    <span class="dt-length-records">
                                        <i class="fa fa-globe"></i>
                                        <span class="hidden-xs">Hiển thị từ</span> 1 đến 10 trong
                                        <span class="badge bold badge-dt">17</span>
                                        <span class="hidden-xs">bản ghi</span>
                                    </span>
                            </div>
                            <div class="dataTables_paginate paging_simple_numbers">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
