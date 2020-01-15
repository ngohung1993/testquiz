<?php

use yii\helpers\Url;
use common\models\Exam;
use common\models\Question;
use yii\web\View;
use yii\widgets\ActiveForm;
use common\models\Topic;
use common\helpers\FunctionHelper;
use common\models\ReportQuestion;

/* @var $this yii\web\View */
/* @var $questions Question */
/* @var $exam common\models\Exam */

$this->title = Yii::t('backend', 'Chi tiết câu hỏi báo lỗi');


?>

<style>
    .ks-checkBox p {
        margin: 0;
    }

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

    .answerWrapper {
        padding-top: 20px;
        padding-bottom: 0;
        position: relative;
    }

    .dragWrapper {
        width: 100%;
        display: inline-block;
        margin: 0 auto 30px;
        left: 0;
        right: 0;
    }

    .dragWrapper ul li:nth-of-type(1) {
        margin-left: 0;
    }

    .dragWrapper ul li {
        list-style: none;
        border: 1px dashed #2c7b30;
        float: left;
        padding: 7px 7px;
        margin-left: 10px;
        cursor: pointer;
    }

    .content-report {
        border: 1px solid #f1f1f1;
        height: 100px;
        padding: 5px;
        margin-top: 18px;
        box-shadow: rgb(199, 197, 197) 0 0 3px 1px;
    }
</style>

<script type="text/javascript" async
        src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to(['exam/index']) ?>">Đề thi</a></li>

        <li class="breadcrumb-item active"><?= $exam['title'] ?></li>
    </ol>
    <div class="clearfix"></div>

    <div>
        <div class="note note-success">
            <p>
                Bạn đang chỉnh sửa phiên bản "<strong class="current_language_text">Tiếng Việt</strong>"
            </p>
        </div>
        <?php /** @var TYPE_NAME $topic */
        if ($topic->status == Topic::CHO_DUYET):?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: blue">
                    Chủ đề này hiện "<strong class="current_language_text">Chờ duyệt</strong>"
                    <a style="text-decoration: underline" href="<?= Url::to(['topic/view', 'id' => $topic->id]) ?>">duyệt
                        chủ đề</a>
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
        <?php
        if ($topic->status == Topic::KHONG_DUYET):?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    Bạn đang chỉnh sửa phiên bản "<strong class="current_language_text">Tiếng Việt</strong>"
                </p>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="main-form">
                    <div class="form-body">
                        <div class="gwt-SplitLayoutPanel split-bar"
                             style="width:100%;float:left;">
                            <div style="overflow: hidden; left: 4px; top: 0; right: 4px; bottom: 0;">
                                <div class="LMB">
                                    <div class="KMB">
                                        <div class="NMB">
                                            <div class="LMC basic-game-view-main-panel">
                                                <div class="KMC leftMenuGame basic-game-view-left-panel"
                                                     style="">
                                                    <div class="MMC this_is_main_scroll_panel_in_basic_game_view scroll-style"
                                                         id="mainScrollPanelGame"
                                                         style="overflow: auto; position: relative; zoom: 1;">
                                                        <div style="position: relative; zoom: 1;">
                                                            <div class="NMC" style="width: 100%; height: 100%;">
                                                                <div class="GMC gameContentPanel"
                                                                     style="opacity: 1;">
                                                                    <?php /** @var TYPE_NAME $reportQuestion */
                                                                    foreach ($reportQuestion as $key => $value): $correct = json_decode(FunctionHelper::getQuestion($value['question_id'])['answer_correct'], true); ?>
                                                                        <div id="mainViewPanel-0"
                                                                             style="position: relative; width: 100%; padding: 10px 0;">
                                                                            <table cellspacing="0"
                                                                                   cellpadding="0"
                                                                                   style="border-top: none; width: 100%;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="vertical-align: middle;">
                                                                                        <div class="gwt-HTML"
                                                                                             style="min-width: 50px; text-align: center; white-space: nowrap;">
                                                                                            <span style="text-align:center;float:left">
                                                                                                <b>Câu <?= $key + 1 ?>/<?= $exam['number_question'] ?></b>
                                                                                            </span>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <div style="padding-top: 10px; position: relative; background-color: white; box-shadow: rgb(199, 197, 197) 0 0 3px 1px;">
                                                                                <table id="gameViewPanel"
                                                                                       style="width: 99%; margin: 0 auto;">
                                                                                    <colgroup>
                                                                                        <col>
                                                                                    </colgroup>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td align="center"
                                                                                            colspan="0"
                                                                                            style="vertical-align: top;">
                                                                                            <div>
                                                                                                <table cellspacing="0"
                                                                                                       cellpadding="0"
                                                                                                       class="cardQuestion"
                                                                                                       style="position: relative; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51);">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center"
                                                                                                            style="vertical-align: middle;">
                                                                                                            <div style="width: 100%;">
                                                                                                                <div class="card-game-content"
                                                                                                                     id="dictMode73832"
                                                                                                                     style="padding: 10px; word-break: break-word; text-align: justify; font-size: 1.1em;">
                                                                                                                    <?= FunctionHelper::getQuestion($value['question_id'])['content'] ?>

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php if (FunctionHelper::getQuestion($value['question_id'])['type'] == Question::TYPE_CHOOSE): ?>
                                                                                        <?php foreach (json_decode(FunctionHelper::getQuestion($value['question_id'])['answer']) as $key_a => $answer): ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table cellspacing="0"
                                                                                                           cellpadding="0"
                                                                                                           class="ks-checkBox"
                                                                                                           style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;<?= isset($correct[$key_a]) ? 'background-color: rgb(238, 238, 238);' : '' ?>">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                width="50px"
                                                                                                                style="vertical-align: middle;">
                                                                                                                <?php if (isset($correct[$key_a])): ?>
                                                                                                                    <span style="color: #00a65a;"
                                                                                                                          class="fa fa-check-circle-o"><span
                                                                                                                                style="margin-left:10px;font-weight: bold;"><?= $key_a . '.' ?></span></span>
                                                                                                                <?php else: ?>
                                                                                                                    <span class="fa fa-circle-o"><span
                                                                                                                                style="margin-left:10px;font-weight: bold;"><?= $key_a . '.' ?></span></span>
                                                                                                                <?php endif; ?>
                                                                                                            </td>
                                                                                                            <td align="left"
                                                                                                                style="vertical-align: middle;">
                                                                                                                <table cellspacing="0"
                                                                                                                       cellpadding="0"
                                                                                                                       style="width: 100%; margin-top: 7px; margin-bottom: 7px;">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td align="left"
                                                                                                                            width="-40px"
                                                                                                                            style="vertical-align: middle;">
                                                                                                                            <div class="gwt-HTML"
                                                                                                                                 style="padding: 5px; cursor: default; font-size: 1.1em;margin-top: 4px;margin-left: 10px;">
                                                                                                                                <?= $answer ?>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php endforeach; ?>
                                                                                    <?php elseif (FunctionHelper::getQuestion($value['question_id'])['type'] == Question::TYPE_FILL): ?>
                                                                                        <?php foreach (json_decode(FunctionHelper::getQuestion($value['question_id'])['answer']) as $key_a => $answer): ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table cellspacing="0"
                                                                                                           cellpadding="0"
                                                                                                           class="ks-checkBox"
                                                                                                           style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                style="vertical-align: middle;">
                                                                                                                <table cellspacing="0"
                                                                                                                       cellpadding="0"
                                                                                                                       style="width: 50%; margin-top: 7px; margin-bottom: 7px;">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td align="left"
                                                                                                                            width="-40px"
                                                                                                                            style="vertical-align: middle;">
                                                                                                                            <div class="gwt-HTML"
                                                                                                                                 style="padding: 5px; cursor: default; font-size: 1.1em;margin-top: 4px;margin-left: 10px;">
                                                                                                                                <label>Câu
                                                                                                                                    trả
                                                                                                                                    lời <?= $key_a ?></label>
                                                                                                                                <input disabled
                                                                                                                                       type="text"
                                                                                                                                       class="form-control"
                                                                                                                                       value="<?= $answer ?>">
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php endforeach; ?>
                                                                                    <?php else: ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table cellspacing="0"
                                                                                                       cellpadding="0"
                                                                                                       class="ks-checkBox"
                                                                                                       style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td align="left"
                                                                                                            style="vertical-align: middle;">
                                                                                                            <table cellspacing="0"
                                                                                                                   cellpadding="0"
                                                                                                                   style="width: 100%; margin-top: 7px; margin-bottom: 7px;">
                                                                                                                <tbody>
                                                                                                                <tr>
                                                                                                                    <td align="left"
                                                                                                                        width="-40px"
                                                                                                                        style="vertical-align: middle;">
                                                                                                                        <div class="gwt-HTML"
                                                                                                                             style="padding: 5px; cursor: default; font-size: 1.1em;margin-top: 4px;margin-left: 10px;">
                                                                                                                            <div class="answerWrapper">
                                                                                                                                <div class="dragWrapper">
                                                                                                                                    <ul id="sortable-list-9978"
                                                                                                                                        class="list_unstyled">
                                                                                                                                        <?php foreach (json_decode(FunctionHelper::getQuestion($value['question_id'])['answer']) as $key_a => $answer): ?>
                                                                                                                                            <li><?= $answer ?></li>
                                                                                                                                        <?php endforeach; ?>
                                                                                                                                    </ul>
                                                                                                                                </div>
                                                                                                                                <div class="clearfix"></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php endif; ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <?php if (FunctionHelper::getQuestion($value['question_id'])['explain']): ?>
                                                                                                <div class="gwt-HTML"
                                                                                                     id="dictMode67938"
                                                                                                     aria-hidden="true"
                                                                                                     style="font-style: italic; padding: 0 15px; text-align: justify;">
                                                                                                    <span style="font-weight: bold;">Giải thích: </span><br>
                                                                                                    <?= FunctionHelper::getQuestion($value['question_id'])['explain'] ?>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="questionOptionPanel"
                                                                                                 style="float: right; margin-top: 10px;">
                                                                                                <div style="width: initial; height: initial; display: inline-block; vertical-align: middle;"
                                                                                                     data-original-title=""
                                                                                                     title="">
                                                                                                    <table cellspacing="0"
                                                                                                           cellpadding="0"
                                                                                                           style="width: 100%; cursor: pointer;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center"
                                                                                                                style="vertical-align: top;">
                                                                                                                <table cellspacing="5"
                                                                                                                       cellpadding="0"
                                                                                                                       style="width: 100%; height: 100%;">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td align="left"
                                                                                                                            style="vertical-align: top;">
                                                                                                                            <div class="boxPanel"
                                                                                                                                 style="border: none; background: #fff">
                                                                                                                                <?php if ($value['status'] == ReportQuestion::STATUS_ERROR): ?>
                                                                                                                                    <a class="boxPanel"
                                                                                                                                       style="padding-left: 8px; margin-right: 2px">
                                                                                                                                        <span class="fa fa-warning"
                                                                                                                                              onclick="QuestionError(<?= $value['id'] ?>,<?= $value['question_id'] ?>)"> Báo lỗi</span>
                                                                                                                                    </a>
                                                                                                                                    <a class="boxPanel"
                                                                                                                                       style="padding-left: 8px;">
                                                                                                                                        <span class="fa fa-times-circle"
                                                                                                                                              onclick="CancelError(<?= $value['id'] ?>)"> Hủy</span>
                                                                                                                                    </a>
                                                                                                                                <?php endif; ?>
                                                                                                                                <?php if ($value['status'] == ReportQuestion::STATUS_WARNING_HENDLE): ?>
                                                                                                                                    <a class="boxPanel"
                                                                                                                                       style="padding-left: 8px;">
                                                                                                                                        <span class="fa fa-hourglass-half"
                                                                                                                                              onclick="CancelError(<?= $value['id'] ?>)"> Chờ xử lý</span>
                                                                                                                                    </a>
                                                                                                                                <?php endif; ?>
                                                                                                                                <?php if ($value['status'] == ReportQuestion::STATUS_PROCESSED): ?>
                                                                                                                                    <a class="boxPanel"
                                                                                                                                       style="padding-left: 8px;">
                                                                                                                                        <span class="fa fa-hourglass-half"
                                                                                                                                              > Đã xử lý</span>
                                                                                                                                    </a>
                                                                                                                                <?php endif; ?>
                                                                                                                                <?php if ($value['status'] == ReportQuestion::STATUS_SUCCESS): ?>
                                                                                                                                    <a class="boxPanel"
                                                                                                                                       style="padding-left: 8px;">
                                                                                                                                        <span class="fa fa-check-square-o"> Hoàn thành</span>
                                                                                                                                    </a>
                                                                                                                                <?php endif; ?>
                                                                                                                            </div>

                                                                                                                        </td>
                                                                                                                        <td align="left"
                                                                                                                            style="vertical-align: middle;">
                                                                                                                            <div class="gwt-HTML"></div>

                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="content-report">
                                                                                <p style="border-bottom: 1px solid #f1f1f1">
                                                                                    Nội dung báo lỗi</p>
                                                                                <p><?= $value['content_report'] ?></p>
                                                                            </div>
                                                                            <?php if ($value['status'] == ReportQuestion::STATUS_PROCESSED): ?>
                                                                            <?php $err_chil = FunctionHelper::get_question_err_by_parent_question_id($value['question_id']);
                                                                                $correct_copy = json_decode($err_chil['answer_correct'])
                                                                                ?>
                                                                            <?php if ($err_chil): ?>

                                                                                <table cellspacing="0"
                                                                                       cellpadding="0"
                                                                                       style="border-top: none; width: 100%;">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td align="left"
                                                                                            style="vertical-align: middle;">
                                                                                            <div class="gwt-HTML"
                                                                                                 style="min-width: 50px; text-align: center; white-space: nowrap;">
                                                                                            <span style="text-align:center;float:left">
                                                                                                <b>Câu <?= $key + 1 ?>/<?= $exam['number_question'] ?> Câu hỏi sau khi sửa</b>
                                                                                            </span>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <div style="padding-top: 10px; position: relative; background-color: white; box-shadow: rgb(199, 197, 197) 0 0 3px 1px;">
                                                                                    <table id="gameViewPanel"
                                                                                           style="width: 99%; margin: 0 auto;">
                                                                                        <colgroup>
                                                                                            <col>
                                                                                        </colgroup>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="center"
                                                                                                colspan="0"
                                                                                                style="vertical-align: top;">
                                                                                                <div>
                                                                                                    <table cellspacing="0"
                                                                                                           cellpadding="0"
                                                                                                           class="cardQuestion"
                                                                                                           style="position: relative; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51);">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center"
                                                                                                                style="vertical-align: middle;">
                                                                                                                <div style="width: 100%;">
                                                                                                                    <div class="card-game-content"
                                                                                                                         id="dictMode73832"
                                                                                                                         style="padding: 10px; word-break: break-word; text-align: justify; font-size: 1.1em;">
                                                                                                                        <?= $err_chil['content'] ?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php if ($err_chil['type'] == Question::TYPE_CHOOSE): ?>
                                                                                            <?php foreach (json_decode($err_chil['answer']) as $key_a1 => $answer1): ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <table cellspacing="0"
                                                                                                               cellpadding="0"
                                                                                                               class="ks-checkBox"
                                                                                                               style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;<?= isset($correct_copy->$key_a1) ? 'background-color: rgb(238, 238, 238);' : '' ?>">
                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td align="left"
                                                                                                                    width="50px"
                                                                                                                    style="vertical-align: middle;">
                                                                                                                    <?php if (isset($correct_copy->$key_a1)): ?>
                                                                                                                        <span style="color: #00a65a;"
                                                                                                                              class="fa fa-check-circle-o"><span
                                                                                                                                    style="margin-left:10px;font-weight: bold;"><?= $key_a1 . '.' ?></span></span>
                                                                                                                    <?php else: ?>
                                                                                                                        <span class="fa fa-circle-o"><span
                                                                                                                                    style="margin-left:10px;font-weight: bold;"><?= $key_a1 . '.' ?></span></span>
                                                                                                                    <?php endif; ?>
                                                                                                                </td>
                                                                                                                <td align="left"
                                                                                                                    style="vertical-align: middle;">
                                                                                                                    <table cellspacing="0"
                                                                                                                           cellpadding="0"
                                                                                                                           style="width: 100%; margin-top: 7px; margin-bottom: 7px;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td align="left"
                                                                                                                                width="-40px"
                                                                                                                                style="vertical-align: middle;">
                                                                                                                                <div class="gwt-HTML"
                                                                                                                                     style="padding: 5px; cursor: default; font-size: 1.1em;margin-top: 4px;margin-left: 10px;">
                                                                                                                                    <?= $answer1 ?>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endforeach; ?>
                                                                                        <?php elseif ($err_chil['type'] == Question::TYPE_FILL): ?>
                                                                                            <?php foreach (json_decode($err_chil['answer']) as $key_a2 => $answer2): ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <table cellspacing="0"
                                                                                                               cellpadding="0"
                                                                                                               class="ks-checkBox"
                                                                                                               style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;">
                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td align="left"
                                                                                                                    style="vertical-align: middle;">
                                                                                                                    <table cellspacing="0"
                                                                                                                           cellpadding="0"
                                                                                                                           style="width: 50%; margin-top: 7px; margin-bottom: 7px;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td align="left"
                                                                                                                                width="-40px"
                                                                                                                                style="vertical-align: middle;">
                                                                                                                                <div class="gwt-HTML"
                                                                                                                                     style="padding: 5px; cursor: default; font-size: 1.1em;margin-top: 4px;margin-left: 10px;">
                                                                                                                                    <label>Câu
                                                                                                                                        trả
                                                                                                                                        lời <?= $key_a2 ?></label>
                                                                                                                                    <input disabled
                                                                                                                                           type="text"
                                                                                                                                           class="form-control"
                                                                                                                                           value="<?= $answer2 ?>">
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endforeach; ?>
                                                                                        <?php else: ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table cellspacing="0"
                                                                                                           cellpadding="0"
                                                                                                           class="ks-checkBox"
                                                                                                           style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                style="vertical-align: middle;">
                                                                                                                <table cellspacing="0"
                                                                                                                       cellpadding="0"
                                                                                                                       style="width: 100%; margin-top: 7px; margin-bottom: 7px;">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td align="left"
                                                                                                                            width="-40px"
                                                                                                                            style="vertical-align: middle;">
                                                                                                                            <div class="gwt-HTML"
                                                                                                                                 style="padding: 5px; cursor: default; font-size: 1.1em;margin-top: 4px;margin-left: 10px;">
                                                                                                                                <div class="answerWrapper">
                                                                                                                                    <div class="dragWrapper">
                                                                                                                                        <ul id="sortable-list-9978"
                                                                                                                                            class="list_unstyled">
                                                                                                                                            <?php foreach (json_decode($err_chil['answer']) as $key_a3 => $answer3): ?>
                                                                                                                                                <li><?= $answer3 ?></li>
                                                                                                                                            <?php endforeach; ?>
                                                                                                                                        </ul>
                                                                                                                                    </div>
                                                                                                                                    <div class="clearfix"></div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php endif; ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php if ($err_chil['explain']): ?>
                                                                                                    <div class="gwt-HTML"
                                                                                                         id="dictMode67938"
                                                                                                         aria-hidden="true"
                                                                                                         style="font-style: italic; padding: 0 15px; text-align: justify;">
                                                                                                        <span style="font-weight: bold;">Giải thích: </span><br>
                                                                                                        <?= $err_chil['explain'] ?>
                                                                                                    </div>
                                                                                                <?php endif; ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="questionOptionPanel"
                                                                                                     style="float: right; margin-top: 10px;">
                                                                                                    <div style="width: initial; height: initial; display: inline-block; vertical-align: middle;"
                                                                                                         data-original-title=""
                                                                                                         title="">
                                                                                                        <table cellspacing="0"
                                                                                                               cellpadding="0"
                                                                                                               style="width: 100%; cursor: pointer;">
                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center"
                                                                                                                    style="vertical-align: top;">
                                                                                                                    <table cellspacing="5"
                                                                                                                           cellpadding="0"
                                                                                                                           style="width: 100%; height: 100%;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td align="left"
                                                                                                                                style="vertical-align: top;">
                                                                                                                                <div class="boxPanel"
                                                                                                                                     style="border: none; background: #fff">
                                                                                                                                    <?php if ($value['status'] == ReportQuestion::STATUS_PROCESSED): ?>
                                                                                                                                        <a class="boxPanel"
                                                                                                                                           style="padding-left: 8px; margin-right: 2px">
                                                                                                                                        <span class="fa fa-warning"
                                                                                                                                              onclick="ReplaceQuestion(<?= $err_chil['id'] ?>,<?= $value['question_id'] ?>,<?= $value['id'] ?>)"> Thay thế</span>
                                                                                                                                        </a>
                                                                                                                                        <a class="boxPanel"
                                                                                                                                           style="padding-left: 8px;">
                                                                                                                                        <span class="fa fa-times-circle"
                                                                                                                                              onclick="resendEdit(<?= $value['id'] ?>)"> Gửi lại sửa</span>
                                                                                                                                        </a>
                                                                                                                                    <?php endif; ?>
                                                                                                                                </div>

                                                                                                                            </td>
                                                                                                                            <td align="left"
                                                                                                                                style="vertical-align: middle;">
                                                                                                                                <div class="gwt-HTML"></div>

                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <?php endif;?>
                                                                        </div>
                                                                        <hr>
                                                                    <?php endforeach; ?>

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
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 right-sidebar">
                <?php if ($exam->status == Exam::EXAM_ERROR): ?>
                    <?php /** @var TYPE_NAME $countErrorSuccess */
                    if(count($reportQuestion) - $countErrorSuccess === 0):?>
                    <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                        <div class="widget-title">
                            <h4>
                                <span>Xét duyệt</span>
                            </h4>
                        </div>
                        <div class="widget-body" style="text-align: center;">
                            <div class="btn-set">
                                <?php $form = ActiveForm::begin(['action' => Url::to(['exam/work', 'id' => $exam['id']])]) ?>
                                <input type="hidden" name="Exam[status]" value="4">
                                <button type="submit" class="btn btn-primary"
                                   style="color: #fff">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    Bật hoạt động
                                </button>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                <?php endif; ?>
                <div class="widget meta-boxes">
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
                                    <a href="<?= Url::to(['user/view', 'id' => $exam['user']['id']]) ?>">
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
                                <p>Tổng số câu</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <?= $exam['number_question'] ?> câu
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Số lỗi của câu</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold" style="color: red;">
                                    <?= count($reportQuestion) ?> lỗi
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Lỗi đã xử lý</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold" style="color: red;">
                                    <?=$countErrorSuccess?> lỗi
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
                            <div class="col-md-6">
                                <p>Trạng thái</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                <span class="label pull-right <?= $exam->getStatusBg() ?>">
                                    <span class="fa fa-clock-o"></span>
                                    <?= $exam->getStatusLabel() ?>
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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
    </div>
    <?= $this->render('_reject', ['exam' => $exam]) ?>
</div>