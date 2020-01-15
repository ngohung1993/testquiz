<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $users array common\models\User */

$this->title = Yii::t('backend', 'Lịch sử nạp tiền');

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= Url::to(['site/index']) ?>">
                Bảng điều khiển
            </a>

        </li>
        <li class="breadcrumb-item">
            <a href="<?= Url::to(['recharge/index']) ?>">
                Thành viên
            </a>
        </li>
        <li class="breadcrumb-item active"><?=$user->name?></li>
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
                                <th class="column-key-image sorting" style="width: 100px;">
                                    Tên thành viên
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 150px;">
                                    Email
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                    Số tiền
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày giao dịch
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Trạng thái
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /** @var TYPE_NAME $transactions */
                            foreach ($transactions as $key => $value):?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input alt="" title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class=" no-sort column-key-updated_at">
                                        <a href="<?= Url::to(['user/view', 'id' => $value['user']['id']]) ?>">
                                            <?=$value['user']['name']?>
                                            <span class="fa fa-external-link"></span>
                                        </a>
                                    </td>
                                    <td class="column-key-id"><?= $value['user']['email'] ?></td>
                                    <td class="column-key-id" style="font-weight: bold; color: red"><?= number_format($value->amount, 0, ',', '.') ?> đ</td>
                                    <td class="column-key-id"><?=date('d/m/Y H:i', $value->updated_at)?></td>
                                    <td ><span class="label label-success">Thành công</span></td>

                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php if (!count($transactions)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($transactions)): ?>
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
                                    <?php /** @var TYPE_NAME $pages */
                                    echo LinkPager::widget([
                                        'pagination' => $pages,
                                        'maxButtonCount' => 5,
                                    ]); ?>
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
