<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $keyword string */
/* @var $this yii\web\View */
/* @var $pagination yii\data\Pagination */
/* @var $links array common\models\Links */

$this->title = 'Menu';

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Menu</li>
    </ol>
    <div class="clearfix"></div>
    <div class="table-wrapper">
        <div class="table-configuration-wrap" style="display: none;">
            <span class="configuration-close-btn btn-show-table-options">
                <i class="fa fa-times"></i>
            </span>
            <div class="wrapper-filter">
                <p>Tìm kiếm</p>
                <form method="GET" action="<?= Url::to(['post/index']) ?>" accept-charset="UTF-8"
                      class="filter-form">
                    <div class="filter_list inline-block filter-items-wrap">
                        <div class="filter-item form-filter filter-item-default">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input name="keyword" title="" type="text" class="form-control"
                                               value="<?= $keyword ?>" placeholder="Nhập từ khóa tìm kiếm">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary" style="height: 34px;">
                                            <span class="fa fa-search"></span>
                                            Tìm kiếm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="portlet light bordered portlet-no-padding">
            <div class="portlet-title">
                <div class="caption">
                    <div class="wrapper-action">
                        <div class="btn-group">
                            <a class="btn btn-danger" href="#" style="margin-top: 2px;">
                                <span class="fa fa-trash"></span>
                                Xóa bản ghi
                            </a>
                        </div>
                        <button class="btn btn-primary btn-show-table-options">
                            <span class="fa fa-search"></span>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="dt-buttons btn-group">
                            <a class="btn btn-default action-item" href="<?= Url::to(['create']) ?>">
                                <span>
                                    <span>
                                        <i class="fa fa-plus"></i> Tạo mới
                                    </span>
                                </span>
                            </a>
                            <a class="btn btn-default buttons-collection" tabindex="0" aria-controls="table-menus"
                               href="#">
                                <span>
                                    <img src="/uploads/cms/img/vn.png"
                                         title="Tiếng Việt" alt="Tiếng Việt">
                                    <span>
                                        Ngôn ngữ
                                        <span class="caret"></span>
                                    </span>
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
                                    <input style="margin-right: 12px;" title="" type="checkbox" class="minimal">
                                </th>
                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                    ID
                                </th>
                                <th class="text-left column-key-name sorting">
                                    Tiêu đề
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tạo
                                </th>
                                <th width="100px" class="column-key-status sorting" style="width: 100px;">
                                    Trạng thái
                                </th>
                                <th class="text-center sorting_disabled" style="width: 158px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($links as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <input title="" type="checkbox" class="minimal">
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="text-left column-key-name">
                                        <a class="text-left"
                                           href="<?= Url::to(['update', 'id' => $value['id']]) ?>">
                                            <?= $value['title'] ?>
                                        </a>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('d/m/Y', strtotime($value['created_at'])) ?>
                                    </td>
                                    <td class="column-key-status">
                                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                             style="border:none">
                                            <input data-id="<?= $value['id'] ?>" data-api="ajax/enable-column"
                                                   data-table="post" data-column="status"
                                                   type="checkbox" <?= $value['status'] ? 'checked="checked"' : '' ?>
                                                   title="" name="switch-checkbox">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="<?= Url::to(['update', 'id' => $value['id']]) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <?= Html::a(Yii::t('backend', '<i class="fa fa-trash-o"></i>'), [
                                                'delete',
                                                'id' => $value->id
                                            ], [
                                                'class' => 'btn btn-icon btn-sm btn-danger tip',
                                                'data' => [
                                                    'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($links)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($links)): ?>
                            <div class="datatables__info_wrap">
                                <div class="dataTables_paginate paging_simple_numbers">
                                </div>
                                <div class="dataTables_info" id="table-posts_info" role="status"
                                     aria-live="polite">
                                    <span class="dt-length-records">
                                        <i class="fa fa-globe"></i>
                                        <span class="hidden-xs">Hiển thị từ</span> 1 đến <?= count($links) ?> trong
                                        <span class="badge bold badge-dt"><?= count($links) ?></span>
                                        <span class="hidden-xs">bản ghi</span>
                                    </span>
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
