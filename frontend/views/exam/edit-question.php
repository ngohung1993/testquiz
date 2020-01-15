<?php

use yii\helpers\Url;
use common\models\Exam;
use common\models\Question;
use yii\widgets\ActiveForm;
use frontend\assets\TinyAsset;
use backend\assets\ExaminationAsset;
use frontend\assets\CreateExamAsset;
use common\helpers\FunctionHelper;

/* @var $id */
/* @var $exam Exam */
/* @var $this yii\web\View */
/* @var $question Question */
/* @var $questions array Question */
/* @var $viewFormQuestion boolean */

TinyAsset::register($this);
CreateExamAsset::register($this);

$this->title = 'Sửa câu hỏi lỗi';

?>

<style>
    #container {
        margin-top: 60px!important;
    }

    .tp-checkbox:before {
        width: 20px;
        height: 20px;
    }

    .tp-checkbox {
        position: relative;
        bottom: 18px;
        left: 8px;
    }

    .tp-checkbox:checked:before {
        width: 20px;
        height: 10px;
    }

    .tp-checkbox:before {
        width: 20px;
        height: 20px;
    }

    .tp-checkbox {
        position: relative;
        bottom: 18px;
        left: 8px;
    }

    .tp-checkbox:checked:before {
        width: 20px;
        height: 10px;
    }

    a {
        text-decoration: unset !important;
    }

    .gwt-HTML p {
        margin: 0;
    }

    .ks-checkBox span.fa {
        width: 15px;
        height: 12px;
        margin: 0 auto;
        display: block;
        font-size: 15px;
    }

    .tox-statusbar__branding {
        display: none;
    }

    .tox .tox-toolbar {
        background: #f1f1f1;
    }

    .tp-checkbox:after {
        background: unset;
    }

    .btn-left {
        float: left;
    }

    .questionDescription {
        height: 34px;
        display: inline-block;
        line-height: 34px;
        margin-left: 0;
    }

    .questionWrapper {
        border-bottom: 1px solid #ededed;
    }

    .content-wrapper {
        box-shadow: none;
    }

    .content-wrapper .container {
        padding: 16px 0;
    }

    .form-group input[type="checkbox"] {
        position: relative;
        top: auto;
        left: auto;
        z-index: auto;
    }

    .bg-green {
        background-color: #3c8dbc !important;
    }

    .GMC {
        width: 100%;
        padding: 0 20px;
    }

    .tp-media {
        float: right;
    }

    label {
        margin-bottom: 15px;
    }

    .tp-btn.btn-default {
        background-color: #e6e6e6;
    }

    .modal-header {
        background: #1fb6ff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }

    .modal-header h4 {
        color: #fff;
    }

    .modal-body h5 {
        font-size: 14px;
        font-weight: bold;
    }

    .modal-content {
        border-radius: unset;
    }

    .modal-dialog {
        margin: 150px auto;
    }
</style>

<script type="text/javascript" async
        src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

<main>
    <div class="content-wrapper">
        <div class="breadcrumb-outer">
            <div class="container">
                <ul class="breadcrumb breadcrumb-primary "
                    style="background-color: #fff; border-radius: 0">
                    <li>
                        <a href="<?= Url::to(['exam/index']) ?>">
                            <i class="fa fa-graduation-cap"></i>
                            Đề thi đã tạo
                        </a>
                    </li>
                    <li class="active"><?= $exam['title'] ?></li>
                    <li class="active">Sửa câu hỏi lỗi</li>
                </ul>
            </div>
        </div>
        <div class="container" style="margin-top: -40px">
            <div id="taode" class="card-wrapper">
                <div class="row">
                    <div class="listTab col-md-12">
                        <ul role="tablist">
                            <li>
                                <a href="<?= Url::to(['update', 'id' => $exam->id]) ?>">Thông tin đề thi</a>
                            </li>
                            <li class="active">
                                <a href="<?= Url::to(['question', 'id' => $exam->id]) ?>">Sửa câu hỏi lỗi</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content form-horizontal">
                    <ul class="builderControl">
                        <li>
                            <a href="<?= Url::to('index') ?>" class="tp-btn he30-btn info-tooltip bgred-btn">
                                <i class="fa fa-check-square"></i>
                                Hoàn thành
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to('index') ?>" class="tp-btn he30-btn info-tooltip bgbrown-btn">
                                <i class="fa fa-eye"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if ($viewFormQuestion): ?>
                <div class="card-wrapper">
                    <ul class="question-group list-unstyled tab-content">
                        <li class="tab-pane fade in  active">
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return question.validateForm()"]]) ?>
                            <div class="questionWrapper">
                                <span style="font-weight: bold;" class="questionDescription">
                                    <?= $question->getTypeLabel() ?>
                                </span>
                                <button type="submit" style="float:right;border-radius: 3px;margin-top: 2px;"
                                        class="tp-btn btn-primary info-tooltip btn-update-1">
                                    <i class="fa fa-save"></i>
                                    Xác nhận
                                </button>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="content">Nội dung câu hỏi</label>
                                        <label title="" data-toggle="tooltip"
                                               onclick="question.uploadFile('content_media')"
                                               class="tp-media tp-btn btn-default info-tooltip"
                                               data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                                            <?php if ($media = $question->getMedia('content', false)): ?>
                                                <span><?= $media ?></span>
                                            <?php else: ?>
                                                <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                                            <?php endif; ?>
                                            <input type="file" id="content_media"
                                                   name="Question[content_media]">
                                        </label>
                                        <textarea id="content" class="form-control" rows="4"
                                                  name="Question[content]"><?= $question['content'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="explain">Giải thích</label>
                                        <label title="" data-toggle="tooltip"
                                               onclick="question.uploadFile('explain_media')"
                                               class="tp-media tp-btn btn-default info-tooltip"
                                               data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                                            <?php if ($media = $question->getMedia('explain', false)): ?>
                                                <span><?= $media ?></span>
                                            <?php else: ?>
                                                <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                                            <?php endif; ?>
                                            <input type="file" id="explain_media"
                                                   name="Question[explain_media]">
                                        </label>
                                        <textarea id="explain" class="form-control" rows="4"
                                                  name="Question[explain]"><?= $question['explain'] ?></textarea>
                                    </div>
                                </div>
                                <?= $this->render($question->getTypeView(), ['question' => $question]) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="gwt-SplitLayoutPanel split-bar" style="width:100%;float:left;">
                <div style="overflow: hidden; left: 4px; top: 0; right: 4px; bottom: 0;">
                    <div class="LMB">
                        <div class="KMB">
                            <div class="NMB">
                                <div class="LMC basic-game-view-main-panel">
                                    <div class="KMC leftMenuGame basic-game-view-left-panel">
                                        <div class="MMC this_is_main_scroll_panel_in_basic_game_view scroll-style"
                                             id="mainScrollPanelGame"
                                             style="overflow: auto; position: relative; zoom: 1;">
                                            <div style="position: relative; zoom: 1;">
                                                <div class="NMC" style="width: 100%; height: 100%;">
                                                    <div class="GMC gameContentPanel" style="opacity: 1;">
                                                        <?php if (!count($questions)): ?>
                                                            <div class="alert alert-danger">
                                                                <p>
                                                                    <i class="fa fa-exclamation-triangle"
                                                                       aria-hidden="true"></i>
                                                                    Câu hỏi lỗi đã được sửa xong. Vui lòng chờ Admin
                                                                    duyệt lại
                                                                </p>
                                                            </div>
                                                        <?php else: ?>
                                                            <?php foreach ($questions as $key => $value): $correct = json_decode(FunctionHelper::getParentIdQuestion($value['question_id'])['answer_correct'], true); ?>
                                                                <div style="position: relative; width: 100%; padding: 10px 0;">
                                                                    <table cellspacing="0" cellpadding="0"
                                                                           style="border-top: none; width: 100%;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="vertical-align: middle;">
                                                                                <div class="gwt-HTML"
                                                                                     style="min-width: 50px; text-align: center; white-space: nowrap;">
                                                                                <span style="text-align:center;float:left">
                                                                                    <b>Câu <?= $key + 1 ?>
                                                                                        /<?= count($questions) ?></b>
																					<span class="label bg-green">
																						<?= FunctionHelper::getParentIdQuestion($value['question_id'])->getTypeLabel() ?>
																					</span>
                                                                                </span>
                                                                                </div>
                                                                            </td>
                                                                            <td align="right">
                                                                                <a href="<?= Url::to(['edit-question', 'id' => $exam->id, 'question_id' => FunctionHelper::getParentIdQuestion($value['question_id'])['id']]) ?>"
                                                                                   class="btn btn-primary"
                                                                                   style="margin-bottom: 5px;">
                                                                                    <i class="fa fa-edit"></i> Chỉnh sửa
                                                                                </a>
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
                                                                                <td align="center" colspan="0"
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
                                                                                                            <?= FunctionHelper::getParentIdQuestion($value['question_id'])['content'] ?>
                                                                                                            <?= FunctionHelper::getParentIdQuestion($value['question_id'])->getMedia('content') ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <?php if (FunctionHelper::getParentIdQuestion($value['question_id'])['type'] == Question::TYPE_CHOOSE): ?>
                                                                                <?php foreach (json_decode(FunctionHelper::getParentIdQuestion($value['question_id'])['answer']) as $key_a => $answer): ?>
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
                                                                                                                        <?= FunctionHelper::getParentIdQuestion($value['question_id'])->getMedia('answer_' . $key_a) ?>
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
                                                                            <?php elseif (FunctionHelper::getParentIdQuestion($value['question_id'])['type'] == Question::TYPE_FILL): ?>
                                                                                <?php foreach (json_decode(FunctionHelper::getParentIdQuestion($value['question_id'])['answer']) as $key_a => $answer): ?>
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
                                                                                                                                <?php foreach (json_decode(FunctionHelper::getParentIdQuestion($value['question_id'])['answer']) as $key_a => $answer): ?>
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
                                                                                    <div class="GMC gameContentPanel"
                                                                                         style="margin: 10px auto 15px auto;opacity: 1;">
                                                                                        <b>Giải thích:</b>
                                                                                        <?= FunctionHelper::getParentIdQuestion($value['question_id'])['explain'] ?>
                                                                                        <?= FunctionHelper::getParentIdQuestion($value['question_id'])->getMedia('explain') ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <table cellspacing="5" cellpadding="0"
                                                                           aria-hidden="true"
                                                                           class="widgetBoxShadow"
                                                                           style="width: 100%; position: absolute; background-color: rgb(199, 199, 199); height: 100px; z-index: 100; display: none; bottom: 0;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="vertical-align: top;">
                                                                                <div class="widget_not_handler"
                                                                                     style="width: 100%; padding: 10px 5px;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="vertical-align: top;">
                                                                                <div class="NDB"
                                                                                     style="width: 100%; max-height: 457px;">
                                                                                    <div class="IDB"
                                                                                         style="width: 100%; padding-left: 5px; transition-duration: 0ms; transform: translate(0px, 0px);"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="vertical-align: top;">
                                                                                <div style="width: 100%;">
                                                                                    <table cellspacing="0"
                                                                                           cellpadding="0"
                                                                                           style="width: 100%; padding: 10px 3px;">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="left" width="25%"
                                                                                                style="vertical-align: middle;">
                                                                                                <div style="background-color: rgb(214, 214, 215); border-radius: 2px;">
                                                                                                    <div style="height: 5px; border-radius: 5px;"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td align="left"
                                                                                                style="vertical-align: middle;">
                                                                                                <div class="gwt-HTML"
                                                                                                     style="text-align: center;">
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="alert alert-danger">
                                                                        <p style="font-weight: bold">Nội dung báo
                                                                            lỗi</p>
                                                                        <hr>
                                                                        <p>
                                                                            <?= $value['content_report'] ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
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
    </div>
</main>

<div id="errorQuestion" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close add-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    Thông báo
                </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default add-close" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
