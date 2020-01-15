<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Quản lý thông báo';
?>

<style>
    .pagination > li > a, .pagination > li > span {
        margin-right: 7px;
    }

    .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #1fb6ff;
        border-color: #1fb6ff;
    }

    .bold {
        font-weight: bold;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .left-box {
            margin: 0;
        }

        .response {
            padding-right: 10px !important;
        }
    }

    @media (max-width: 768px) and (min-width: 600px) {
        .tab-content {
            margin-top: -50px;
        }
        .ad_user_menu_left li a span{
            margin: 5px!important;
        }
    }
</style>
<div class="col-sm-9 response" style="margin-top: -49px">
    <div class="tab-content">
        <div class="">
            <h3 class="ad_user_name">Quản lý thông báo</h3>
            <div class="row left-box">
                <div class="pal_history_surplus" id="list_history_finance"
                     style="border: 1px solid #e8e8e8; margin-top: 0; padding-bottom: 0">
                    <h4>Danh sách thông báo</h4>
                    <div id="act_rfd" class="content_act ">
                        <table class="table table-striped">
                            <thead class="title_tk_eve">
                            <tr>
                                <th width="5%"><i class="fa fa-envelope-o" aria-hidden="true"></i></th>
                                <th width="50%">Nội dung</th>
                                <th width="14%">Thời gian</th>
                                <th width="12%">Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($messages as $key => $value): ?>
                                <tr>
                                    <td>
                                        <?php if ($value->status == 0): ?>
                                            <i id="box-<?= $value->id ?>" class="fa fa-envelope-o bold"
                                               aria-hidden="true"></i>
                                        <?php else: ?>
                                            <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td id="message-inbox-<?=$value->id?>" class=<?=$value->status ? "" : "bold" ?> >
                                        <?=$value->cutString($value->message)?>
                                    </td>
                                    <td><?= date('d/m/Y H:i', $value->updated_at) ?></td>
                                    <td>
                                        <a onclick="readMessage(<?= $value->id ?>,<?= $value->status ?>)"
                                           class="btn btn-info btn-xs" style="display: inline-block; margin-right: 10px"
                                           data-toggle="modal" data-target="#modalReadMessage">
                                            <i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <?= Html::a(Yii::t('backend', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $value->id], [
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Xóa',
                                            'data' => [
                                                'confirm' => Yii::t('backend', 'Bạn có chắc chắn muốn xóa?'),
                                                'method' => 'post',
                                            ],
                                        ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="paging" style="margin: 0">
                        <?php /** @var TYPE_NAME $pages */
                        echo LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount' => 5,
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }
</style>
<div id="modalReadMessage" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_topic">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                    Nôi dung thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 16px;">
                <div style="border: 2px solid #f5f5f5; padding: 10px; height: 200px; background: #f1f1f1"
                     id="content-message">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>