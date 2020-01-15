<?php

use common\helpers\FunctionHelper;
use common\models\Exam;
use common\models\Topic;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\ExamQuestion;
use frontend\assets\ExaminationAsset;

/* @var $this yii\web\View */
/* @var $exam common\models\Exam */
/* @var $questionDetails ExamQuestion */

$this->title = $exam->title;

ExaminationAsset::register($this);

$this->title = $exam->title;

$key4 = FunctionHelper::get_setting_by_key('key4');

$keyAnswer = ['A', 'B', 'C', 'D'];


?>

<style>

</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['exam/index']) ?>">Đề thi</a></li>

        <li class="breadcrumb-item active"><?= $exam['title'] ?></li>
    </ol>
    <div class="clearfix"></div>

    <div>
        <?php /** @var TYPE_NAME $topic */
        if ($topic->status == Topic::CHO_DUYET):?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    Chủ đề này hiện "<strong class="current_language_text">Chờ duyệt</strong>"
                </p>
            </div>
        <?php endif; ?>
        <?php
        if ($topic->active == Topic::NO_ACTIVE):?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    Chủ đề này "<strong class="current_language_text">thành viên đã xóa</strong>"
                </p>
            </div>
        <?php endif; ?>
        <?php /** @var TYPE_NAME $topic */
        if ($topic->status == Topic::KHONG_DUYET):?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    Chủ đề này hiện "<strong class="current_language_text">Không được duyệt</strong>"
                    <a style="text-decoration: underline;" href="<?= Url::to(['topic/views', 'id' => $topic->id]) ?>">xem
                        chi tiết</a>
                </p>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4><span>Mô tả đề thi</span></h4>
                    </div>
                    <div class="widget-body">
                        <?=$exam->description?>
                    </div>
                </div>
                <?php if($exam->reason_reject):?>
                    <div class="widget meta-boxes" style="margin-top: 0">
                        <div class="widget-title">
                            <h4><span>Lý do không duyệt hoặc không hoạt động</span></h4>
                        </div>
                        <div class="widget-body">
                            <?=$exam->reason_reject?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-md-3 right-sidebar">

                <div class="widget meta-boxes" style="height: 285px">
                    <div class="widget-title">
                        <h4><span>Thông tin</span></h4>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Người tải đề</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <a href="">
                                        <?= $exam['user']['name'] ?>
                                        <span class="fa fa-external-link"></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Giá tiền</p>
                            </div>
                            <div class="col-md-6">
                                <p style="color: #d43f3a" class="font-bold">
                                    <?= number_format($exam['price'], 0, '.', '') ?> VNĐ
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Ngày tạo</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <?= date('d/m/Y', $exam['created_at']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Số câu</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <?= $exam['number_question'] ?> câu
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Thời gian</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <?= $exam['time'] ?> phút
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Trạng thái</p>
                            </div>
                            <div class="col-md-7">
                                <p>
                                    <?php if ($exam->status == Exam::CHO_DUYET || $exam->status == Exam::EXAM_ERROR ): ?>
                                        <button type="button" class="btn btn-icon tip <?= $exam->getStatusBg() ?>" style="color: #fff">
                                            <span class="fa fa-clock-o"></span>
                                            <?= $exam->getStatusLabel() ?>
                                        </button>
                                    <?php endif;?>

                                    <?php if($exam->status == Exam::DUYET ):?>
                                        <?php if($exam->admin_show_hide == Exam::ADMIN_HIDE):?>
                                            <span class="label pull-left bg-red">
                                            <span class="fa fa-clock-o"></span>
                                            Đề thi ẩn
                                        </span>
                                        <?php elseif($exam->disable == Exam::DISABLE): ?>
                                            <span class="label pull-left bg-red">
                                            <span class="fa fa-clock-o"></span>
                                            Thành viên xóa
                                        </span>
                                        <?php else:?>
                                            <span class="label pull-left bg-blue">
                                            <span class="fa fa-clock-o"></span>
                                            Duyệt
                                        </span>
                                        <?php endif;?>
                                    <?php endif;?>

                                    <?php if($exam['topic']['active'] == Topic::NO_ACTIVE): ?>
                                        <button type="button" class="btn btn-icon btn-danger tip">
                                            <span class="fa fa-clock-o"></span>
                                            Chủ đề bị xóa
                                        </button>
                                    <?php endif; ?>
                                    <?php if($exam->status == Exam::KHONG_DUYET): ?>
                                        <span class="label pull-left <?= $exam->getStatusBg() ?>">
                                        <span class="fa fa-clock-o"></span>
                                        <?= $exam->getStatusLabel() ?>
                                    </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3 right-sidebar">
                <?php if ($exam->status == Exam::CHO_DUYET && $topic->status== Topic::DUYET): ?>
                    <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                        <div class="widget-title">
                            <h4>
                                <span>Xét duyệt</span>
                            </h4>
                        </div>
                        <div class="widget-body" style="text-align: center;">
                            <?php $form = ActiveForm::begin(); ?>
                            <button type="submit" class="btn btn-icon btn-primary tip">
                                <i class="fa fa-check-circle"></i> Phê duyệt
                            </button>
                            <button type="button" class="btn btn-icon btn-danger" data-toggle="modal"
                                    data-target="#myModal">
                                <i class="fa fa-close" style="color: #fff"></i> Từ chối
                            </button>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4><span>Hình ảnh</span></h4>
                    </div>
                    <div class="widget-body">
                        <img style="width: 100%;" src="<?= $exam['avatar'] ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div data-ng-app="Application" ng-controller="examinationCtrl" class="ng-scope">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="tabbable-custom tabbable-tabdrop" style="height: auto">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_detail" data-toggle="tab" aria-expanded="false">ĐỀ THI </a>
                                    </li>
                                    <li class="" style="border-left: 1px solid #ddd;">
                                        <a href="#tab_note" data-toggle="tab" aria-expanded="false">ĐÁP ÁN</a>
                                    </li>
                                </ul>
                                <div class="">
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_detail">
                                        <div class="table-wrapper">
                                            <div class="portlet light bordered portlet-no-padding">
                                                <div class="portlet-body">
                                                    <div class="table-responsive">
                                                        <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                            <div class="leftMenuGame basic-game-view-left-panel">
                                                                <div class="this_is_main_scroll_panel_in_basic_game_view scroll-style">
                                                                    <div class="game-content-panel">
                                                                        <iframe id="exam" style="width: 100%;height: 100%;min-height: 820px;"
                                                                                src="<?= $exam->getFileExam() ?>"
                                                                                frameborder="0"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_note">
                                        <div class="table-wrapper">
                                            <div class="portlet light bordered portlet-no-padding">
                                                <div class="portlet-body">
                                                    <div class="table-responsive">
                                                        <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                            <div class="leftMenuGame basic-game-view-left-panel">
                                                                <div class="this_is_main_scroll_panel_in_basic_game_view scroll-style">
                                                                    <div class="game-content-panel">
                                                                        <iframe id="exam" style="width: 100%;height: 100%;min-height: 820px;"
                                                                                src="<?= $exam->getFileAnswer() ?>"
                                                                                frameborder="0"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm">
                            <div class="game-answer-panel">
                                <div class="game-time-header">
                                    <div class="game-time-label">
                                        <span>Số câu hỏi</span>
                                    </div>
                                    <div class="game-result">
                                        <?= $exam->number_question ?>
                                    </div>
                                </div>
                                <div class="game-answer-checkbox">
                                    <?php $answers = json_decode($exam->answer, true);  ?>
                                    <?php for ($i = 1; $i <= $exam->number_question; $i++): ?>
                                        <div class="answer-list">
                                            <div style="border-bottom: 1px solid #ededed;">
                                                <div class="answer pull-left">
                                                    <div class="question-number">
                                                        <span><?= $i ?>.</span>
                                                    </div>
                                                </div>
                                                <?php foreach ($keyAnswer as $key => $value): ?>
                                                    <div class="answer pull-left">
                                                        <?php if ($answers[$i] == $value): ?>

                                                            <div class="answer-text"
                                                                 style="background: #039449;color: #fff;">
                                                                <span><?= $value ?></span>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="answer-text">
                                                                <span><?= $value ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div id="game-answer-panel-mobile" class="modal fade" role="dialog">
                            <div class="modal-dialog" style="margin: 10px 0;">
                                <div class="modal-content">
                                    <div class="game-answer-panel">
                                        <div class="game-time-header">
                                            <div class="game-time-label">
                                                <span>Số câu hỏi</span>
                                            </div>
                                            <div class="game-result">
                                                <?= $exam->number_question ?>
                                            </div>
                                        </div>
                                        <div class="game-answer-checkbox">
                                            <?php $answers = json_decode($exam->answer, true); ?>
                                            <?php for ($i = 1; $i <= $exam->number_question; $i++): ?>
                                                <div class="answer-list">
                                                    <div style="border-bottom: 1px solid #ededed;">
                                                        <div class="answer pull-left">
                                                            <div class="question-number">
                                                                <span><?= $i ?>.</span>
                                                            </div>
                                                        </div>
                                                        <?php foreach ($keyAnswer as $key => $value): ?>
                                                            <div class="answer pull-left">
                                                                <?php if ($answers[$i] == $value): ?>
                                                                    <div class="answer-text"
                                                                         style="background: #039449;color: #fff;">
                                                                        <span><?= $value ?></span>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="answer-text">
                                                                        <span><?= $value ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <style>

                    .modal-dialog {
                        padding: 0 10px;
                    }

                    .modal-content {
                        border-radius: unset !important;
                    }

                    .fix-wrapper.anchor {
                        top: auto;
                        bottom: 100px;
                    }

                    .fix-wrapper {
                        position: fixed;
                        width: 80px;
                        height: auto;
                        right: 10px;
                        z-index: 10;
                    }

                    .fix-container {
                        position: relative;
                        width: 100%;
                        height: 100%;
                    }

                    .time-ver {
                        background: #428bca;
                        width: 100%;
                        height: 30px;
                        line-height: 30px;
                        -webkit-border-radius: 3px;
                        color: #fff;
                        text-align: center;
                        font-weight: 700;
                        letter-spacing: .05em;
                        opacity: .8;
                        margin-bottom: 5px;
                    }

                    .do-done {
                        width: 100%;
                        height: 30px;
                        line-height: 30px;
                        -webkit-border-radius: 3px;
                        position: relative;
                        overflow: hidden;
                        opacity: .8;
                        margin-bottom: 5px;
                    }

                    .do-done span:nth-of-type(1) {
                        background: #428bca;
                        width: 100%;
                        height: 100%;
                        text-align: center;
                    }

                    .do-done span {
                        position: absolute;
                        display: inline-block;
                        color: #fff;
                        font-weight: 700;
                        top: 0;
                    }

                    .do-done span:nth-of-type(2) {
                        background: #cef3fc;
                        transform: skewX(-22deg);
                        left: 50%;
                        width: 100%;
                        height: 100%;
                    }

                    .do-done span:nth-of-type(3) {
                        width: 50%;
                        height: 100%;
                        left: 0;
                        text-align: center;
                    }

                    .do-done span:nth-of-type(4) {
                        width: 50%;
                        height: 100%;
                        left: 50%;
                        text-align: center;
                        color: #000;
                    }

                    .choseNumber {
                        background: #fff;
                        width: 100%;
                        height: 30px;
                        line-height: 30px;
                        -webkit-border-radius: 3px;
                        position: relative;
                        overflow: hidden;
                        opacity: .8;
                        margin-bottom: 30px;
                        padding: 0;
                        cursor: pointer;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, .5);
                    }

                    .choseNumber span:nth-of-type(1) {
                        top: 0;
                        left: 0;
                    }

                    .choseNumber span {
                        display: inline-block;
                        width: 100%;
                        position: absolute;
                        height: 30px;
                        -webkit-transition: all, .3s;
                        transition: all, .3s;
                        text-align: center;
                        font-weight: 700;
                    }

                    .end-exam {
                        opacity: .8;
                    }

                    .end-exam a {
                        width: 100%;
                        height: 30px;
                        line-height: 30px;
                        -webkit-border-radius: 3px;
                        text-transform: uppercase;
                        text-align: center;
                        color: #fff;
                        padding: 0;
                        font-weight: 700;
                        font-size: 12px;
                    }

                    .bgred-btn {
                        background: #428bca;
                    }

                    .tp-btn {
                        position: relative;
                        overflow: hidden;
                        display: inline-block;
                        cursor: pointer;
                    }
                </style>

            </div>
        </div>
    </div>
    <?= $this->render('_reject', ['exam' => $exam]) ?>
</div>