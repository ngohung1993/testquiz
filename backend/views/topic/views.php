    <?php

use common\helpers\FunctionHelper;
use common\models\Exam;
use common\models\Topic;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\Topic */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
    .ks-checkBox span.fa {
        width: 15px;
        height: 12px;
        margin: 0 auto;
        display: block;
        font-size: 15px;
    }

    .numberAnswerQuestion {
        padding: 6px 12px !important;
        margin: 6px;
        text-align: center;
    }

    .boxPanel {
        border: 1px solid #f4e3bd;
        padding: 8px 8px 8px 0;
        border-radius: 3px;
        background: #fff8e8;
        color: #b08e40;
        margin-bottom: 5px;
    }

    .radioButtonAnswer {
        border-radius: 100% !important;
    }

    .row:nth-of-type(odd) {
        background: #f5f5f5;
    }

    .examControl .row > .col-md-5 .row .col-md-6 p {
        padding: 5px;
        margin: 0;
    }

    .row > .col-md-6:nth-of-type(2) {
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .widget-body .row {
        margin: 0 -10px;
    }

    .widget-body p {
        margin: 8px 0;
    }

    .font-bold {
        font-weight: bold;
    }

    .GMC {
        width: 95%;
        margin: 0 auto;
    }
</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['topic/index','status'=> 0]) ?>">Chủ đề chờ duyệt</a></li>

        <li class="breadcrumb-item active"><?=$model->title?></li>
    </ol>
    <div class="clearfix"></div>

    <div>
        <div class="note note-success">
            <p>
                Bạn đang chỉnh sửa phiên bản "<strong class="current_language_text">Tiếng Việt</strong>"
            </p>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4><span>Mô tả chủ đề</span></h4>
                    </div>
                    <div class="widget-body">
                        <?=$model->description ?>
                    </div>
                </div>
                <?php if($model->status == Topic::KHONG_DUYET):?>
                    <div class="widget meta-boxes" style="margin-top: 0">
                        <div class="widget-title">
                            <h4><span>Lý do không duyệt</span></h4>
                        </div>
                        <div class="widget-body">
                            <?=$model->reason_reject?>
                        </div>
                    </div>
                <?php endif;?>

            </div>
            <div class="col-md-4">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4><span>Thông tin</span></h4>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Người tải chủ đề</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <a href="">
                                        <?= $model['user']['name'] ?>
                                        <span class="fa fa-external-link"></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Ngày tạo</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <?= date('d/m/Y', $model['created_at']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Lớp</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <?=FunctionHelper::get_classroom_by_topic_id($model->id)['title']?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Môn</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <?=FunctionHelper::get_subject_by_topic_id($model->id)['title']?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Số đề</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <?=FunctionHelper::countExamTopicAdmin($model->id,$model->user_id)?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Trạng thái</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <?php if($model->active == Topic::ACTIVE):?>
                                    <span class="label pull-left <?= $model->getStatusBg() ?>">
                                        <span class="fa fa-clock-o"></span>
                                            <?= $model->getStatusLabel() ?>
                                    </span>
                                    <?php else:?>
                                    <span class="label label-danger">
                                        <span class="fa fa-clock-o"></span>
                                            Thành viên đã xóa
                                    </span>
                                    <?php endif;?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 right-sidebar">

                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4><span>Hình ảnh</span></h4>
                    </div>
                    <div class="widget-body">
                        <img style="width: 100%;" src="<?= $model['avatar'] ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="portlet light bordered portlet-no-padding">
                <div class="portlet-title">
                    <div class="caption">
                        <div class="wrapper-action">
                            <h3 style="padding-top: 5px">Danh sách đề thi thuộc chủ đề : <span style="color: blue"><?=$model->title?></span></h3>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                            <div class="dt-buttons btn-group" style="display: -webkit-box;">
                                <?php $form = ActiveForm::begin([
                                    'action' => ['view','id'=>$model->id],
                                    'method' => 'get',
                                ]); ?>
                                <select name="status" id="" class="form-control" style="margin-top: -10px; height: 30px; width: 160px">
                                    <option  value="">Tất cả</option>
                                    <option <?= /** @var TYPE_NAME $status */
                                    $status == '0' ? 'selected': ''?> value="0">Chờ duyệt</option>
                                    <option <?=$status == Exam::DUYET ? 'selected': ''?> value="1">Duyệt</option>
                                    <option <?=$status == Exam::KHONG_DUYET ? 'selected': ''?> value="2">Không duyệt</option>
                                </select>
                                <button type="submit" class="btn btn-default buttons-reload">
                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                    Lọc
                                    </span>
                                </button>
                                <?php ActiveForm::end(); ?>
                                <?php if($model->active == Topic::ACTIVE): ?>
                                <button class="btn btn-default buttons-reload" onclick="approveAll()">
                                    <i class="fa fa-check-circle"></i>
                                    Phê duyệt tất cả
                                </button>
                                <?php endif;?>
                                <a class="btn btn-default buttons-reload" href="<?= Url::to(['view','id'=> $model->id]) ?>">
                                <span><i class="fa fa-refresh"></i>
                                    Tải lại
                                </span>
                                </a>

                            </div>
                            <input type="hidden" id="topic_id" value="<?=$model->id?>">
                            <input type="hidden" id="topic_status" value="<?=$model->status?>">
                            <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                                <thead>
                                <tr role="row">
                                    <th width="10px" class="text-left no-sort sorting_asc" style="width: 40px;text-align: center;">
                                        <label>
                                            <input style="margin-right: 10px;" title="" type="checkbox" id="check_all" class="minimal not_check">
                                        </label>
                                    </th>
                                    <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                        ID
                                    </th>
                                    <th class="column-key-image sorting" style="width: 100px;">
                                        Hình ảnh
                                    </th>
                                    <th class="text-left column-key-name sorting" style="width: 300px;">
                                        Tiêu đề
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
                                <?php /** @var TYPE_NAME $exams */
                                foreach ($exams as $key => $value):?>
                                    <tr role="row" class="odd">
                                        <td style="text-align: center;" class="text-left no-sort sorting_1">
                                            <label>
                                                <?php if($value->status == Exam::CHO_DUYET): ?>
                                                    <input  type="checkbox" class="minimal" name="check_input_order[]"
                                                            value="<?= $value->id ?>" id="check_input_order">
                                                <?php else:?>
                                                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                                                <?php endif;?>
                                            </label>
                                        </td>
                                        <td class="column-key-id"><?=++$key?></td>
                                        <td class="column-key-image">
                                            <img src="<?=$value->avatar?>" width="50" alt="">
                                        </td>
                                        <td class="text-left column-key-name">
                                            <a class="text-left" href="<?=Url::to(['exam/view','id'=> $value->id])?>">
                                                <?=$value->title?>
                                            </a>
                                        </td>
                                        <td class="column-key-created_at">
                                            <?=date('d/m/Y', $value->created_at)?>
                                        </td>
                                        <td>
                                            <?php if($value->status == Exam::CHO_DUYET ):?>
                                                <span class="label pull-left bg-yellow">
                                            <span class="fa fa-clock-o"></span>
                                            Chờ duyệt
                                        </span>
                                            <?php endif;?>
                                            <?php if($value->status == Exam::DUYET ):?>
                                                <?php if($value->admin_show_hide == Exam::ADMIN_HIDE):?>
                                                    <span class="label pull-left bg-danger">
                                                    <span class="fa fa-clock-o"></span>
                                                    Đề thi ẩn
                                                </span>
                                                <?php elseif($value->disable == Exam::DISABLE): ?>
                                                    <span class="label pull-left bg-red">
                                                    <span class="fa fa-clock-o"></span>
                                                    Thành viên xóa
                                                </span>
                                                <?php else:?>
                                                    <span class="label pull-left bg-blue">
                                                    <span class="fa fa-clock-o"></span>
                                                    Đã duyệt
                                                </span>
                                                <?php endif;?>
                                            <?php endif;?>
                                            <?php if($value->status == Exam::KHONG_DUYET ):?>
                                                <span class="label pull-left bg-red">
                                                <span class="fa fa-clock-o"></span>
                                                Không duyệt
                                            </span>
                                            <?php endif;?>
                                            <?php if($value->status == Exam::EXAM_ERROR ):?>
                                                <span class="label pull-left bg-red">
                                                <span class="fa fa-clock-o"></span>
                                                Đề thi lỗi
                                            </span>
                                            <?php endif;?>
                                        </td>
                                        <td class="text-center" style="width: 50px;">
                                            <div class="table-actions">
                                                <a href="<?=Url::to(['exam/view','id'=> $value->id])?>" class="btn btn-icon btn-sm btn-primary tip">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
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
                                    <div class="dataTables_paginate paging_simple_numbers">
                                    </div>
                                    <div class="dataTables_info" id="table-posts_info" role="status" aria-live="polite">
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
    <?= $this->render('_reject', ['model' => $model]) ?>
</div>
