<?php

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\LinkPager;
use common\models\Exam;

/* @var $this yii\web\View */
/* @var $exams array common\models\Exam */
/* @var  $pages */
/* @var  $status */

$this->title = Yii::t('backend', 'Exams');

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
        <li class="breadcrumb-item"><a href="<?= Url::to(['topic/index']) ?>">Chủ đề</a></li>
        <?php if($status == Exam::KHONG_DUYET):?>
        <li class="breadcrumb-item active">Đề thi không được duyệt</li>
        <?php elseif($status == Exam::DUYET):?>
        <li class="breadcrumb-item active">Đề thi đã duyệt</li>
        <?php else:?>
        <li class="breadcrumb-item active">Đề thi chờ duyệt</li>
        <?php endif;?>
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
                                <th class="column-key-image sorting" style="width: 50px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting">
                                    Tiêu đề
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled">
                                    Chuyên mục
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled">
                                    Người tạo
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tạo
                                </th>
                                <th width="100px" class="column-key-status sorting" style="width: 100px;">
                                    Trạng thái
                                </th>
                                <th class="text-center sorting_disabled" style="width: 50px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($exams as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input alt="" title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="column-key-image">
                                        <img src="<?= $value['avatar'] ? $value['avatar'] : '/uploads/cms/img/placeholder.png' ?>"
                                             width="50" alt="">
                                    </td>
                                    <td class="text-left column-key-name">
                                        <a class="text-left"
                                           href="<?= Url::to(['view', 'id' => $value['id']]) ?>">
                                            <?= $value['title'] ?>
                                        </a>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <?= $value['topic']['title'] ?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <a href="<?= Url::to(['user/view', 'id' => $value['user']['id']]) ?>">
                                            <?= $value['user']['name'] ?>
                                            <span class="fa fa-external-link"></span>
                                        </a>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('d/m/Y', $value['created_at']) ?>
                                    </td>
                                    <td>
                                        <span class="label pull-left <?= $value->getStatusBg() ?>">
                                            <span class="fa fa-clock-o"></span>
                                            <?= $value->getStatusLabel() ?>
                                        </span>
                                    </td>
                                    <td class="text-center" style="width: 50px;">
                                        <div class="table-actions">
                                            <a href="<?= Url::to(['view', 'id' => $value['id']]) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($exams)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($exams)): ?>
                            <div class="datatables__info_wrap">

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
                                    <?php echo LinkPager::widget([
                                        'pagination' => $pages,
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