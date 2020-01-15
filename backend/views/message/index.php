<?php
/* @var $this yii\web\View */

use common\helpers\FunctionHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager; ?>
<style>


    .card-inverse .btn {
        border: 1px solid rgba(0, 0, 0, .05);
    }


    .profile-inline ~ .card-title {
        display: inline-block;
        margin-left: 4px;
        vertical-align: top;
    }


    .meta h5 {
        text-decoration: none;
        font-weight: normal;
    }

    .card-footer .icon {
        padding: 5px;
        font-size: 12px;
    }

    .card-footer .icon a {
        color: #ef6645;
    }

    .loader{
        opacity: 0.1;
    }
    .bold{
        font-weight: bold;
        font-size: 14px;
        color: #000;
    }
</style>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Chủ đề</li>
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
                            <?php $form = ActiveForm::begin([
                                'action' => ['index'],
                                'method' => 'get',
                            ]); ?>
                            <input class="pull-left form-control" name="user" type="text" style="margin-right: 15px; height: 30px" placeholder="Lọc theo tên người gửi">
                            <button type="submit" class="btn btn-default buttons-reload">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                                Lọc
                                </span>
                            </button>
                            <a class="btn btn-default buttons-reload" href="<?= Url::to(['index']) ?>">
                                <span><i class="fa fa-refresh"></i>
                                    Tải lại
                                </span>
                            </a>
                            <?php ActiveForm::end(); ?>
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
                                <th width="20px" class="column-key-id sorting" style="width: 50px;">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </th>
                                <th class="column-key-image sorting" style="width: 400px;">
                                    Nội dung
                                </th>
                                <th class="text-left column-key-name " style="width: 100px;" >
                                    Người gửi
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled" style="width: 80px;" >
                                    Thời gian
                                </th>
                                <th class="text-center sorting_disabled" style="width: 30px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input alt="" title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id">
                                        <?php if($message->status == 0):?>
                                            <i id="box-<?=$message->id?>" style="font-weight: bold" class="fa fa-envelope-o bold" aria-hidden="true"></i>
                                        <?php else:?>
                                            <i " class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                        <?php endif;?>
                                    </td>
                                    <td id="message-inbox-<?=$message->id?>" class=<?=$message->status ? "" : "bold" ?>  onclick="changeStatus(<?=$message->id?>,<?=$message->status?>)"><?=$message->message?></td>
                                    <td class=" no-sort column-key-updated_at">
                                        <a href="<?= Url::to(['user/view', 'id' => $message['user']['id']]) ?>">
                                            <?= $message['user']['name'] ?>
                                            <span class="fa fa-external-link"></span>
                                        </a>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('H:i d/m/Y', $message['created_at']) ?>
                                    </td>
                                    <td  class="text-center">
                                        <a onclick="getMessage(<?=$message->id?>,<?=$message->status?>)" class="btn btn-info btn-xs" style="display: inline-block; margin-right: 10px" data-toggle="modal" data-target="#modalReadMessage"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <?=Html::a(Yii::t('backend', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $message->id], [
                                            'class' => 'btn btn-danger btn-xs',
                                            'title'=>'Xóa',
                                            'data' => [
                                                'confirm' => Yii::t('backend', 'Bạn có chắc chắn muốn xóa?'),
                                                'method' => 'post',
                                            ],
                                        ])?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php if (!count($messages)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($messages)): ?>
                            <div class="datatables__info_wrap">
                                <div class="dataTables_paginate paging_simple_numbers">
                                </div>
                                <div class="dataTables_info" id="table-posts_info" role="status"
                                     aria-live="polite">
                                    <span class="dt-length-records">
                                        <i class="fa fa-globe"></i>
                                        <span class="hidden-xs">Hiển thị từ</span> 1 đến 15 trong
                                        <span class="badge bold badge-dt"><?=$count?></span>
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
<div id="modalReadMessage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <strong>Thông báo</strong>
                </h4>
            </div>
            <div class="modal-body" style="font-size: 16px;">
                <div style="border: 2px solid #f5f5f5; padding: 10px; height: 200px; background: #f1f1f1" id="content-message">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-icon btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>