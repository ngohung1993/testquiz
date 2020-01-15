<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use common\models\Exam;

/* @var $this yii\web\View */
/* @var $exams array common\models\Exam */
/* @var $status*/
/* @var $title*/
/* @var $user*/
/* @var $deal*/
/* @var $topic*/

$this->title = Yii::t('backend', 'Đề thi');
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
                        'action' => ['index'],
                        'method' => 'get',
                    ]); ?>
                    <div class="filter_list inline-block filter-items-wrap">
                        <div class="filter-item form-filter filter-item-default">
                            <input type="hidden" name="status" value="<?=$status?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Tên đề thi</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="title" value="<?=$title?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Thành viên tạo</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="user" value="<?=$user?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Tên chủ đề</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="topic" value="<?=$topic?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Hoạt động giao dịch</label>
                                    <div class="form-group">
                                        <select name="deal" id="" class="form-control" <?=$status != Exam::DUYET ? 'disabled' : ''?>>
                                            <option value="">Chọn trạng thái</option>
                                            <option <?= $deal== 1 ? 'selected' : ''?> value="1">Hoạt động</option>
                                            <option <?= $deal== 2 ? 'selected' : ''?> value="2">Ngừng hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row pull-right" style="margin-right: 0">
                                <button class="btn btn-primary btn-show-table-options" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Tìm kiếm
                                </button>
                                <a class="btn btn-default" href="<?=Url::to(['index','status'=> $status])?>">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                    Tải lại
                                </a>
                            </div>


                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="portlet light bordered portlet-no-padding">

            <div class="portlet-body">
                <div class="table-responsive">
                    <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="dt-buttons btn-group">
                            <a class="btn btn-default buttons-reload" href="<?= /** @var TYPE_NAME $status */
                            Url::to(['index','status' => $status]) ?>">
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
                                               class="btn btn-icon btn-sm btn-primary tip" title="Xem">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <?php if($value->status == Exam::DUYET): ?>
                                                <?php if($value->admin_show_hide == 1):?>
                                                    <button data-toggle="modal" data-target="#disableExam" onclick="adminDisableExam(<?=$value['id']?>)"
                                                            class="btn btn-icon btn-sm btn-danger tip" title="Ản đề thi">
                                                        <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                                    </button>
                                                <?php else:?>
                                                    <?= Html::a(Yii::t('backend', '<i class="fa fa-thumbs-o-up"></i>'), ['show', 'id' => $value->id, 'pages'=> $pages->page], [
                                                        'class' => 'btn btn-icon btn-sm btn-warning tip',
                                                        'title' => 'Hiện đề thi',
                                                        'data' => [
                                                            'confirm' => Yii::t('backend', 'Bạn có muốn bật lại giao dịch đề thi này?'),
                                                            'method' => 'post',
                                                        ],
                                                    ]) ?>

                                                <?php endif?>
                                            <?php endif;?>
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
    <?= $this->render('_disable') ?>
</div>