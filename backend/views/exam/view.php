<?php

use yii\helpers\Url;
use common\models\Exam;
use common\models\Topic;
use common\models\Question;
use yii\widgets\ActiveForm;
use frontend\assets\ExaminationAsset;

/* @var $status */
/* @var $topic Topic */
/* @var $exam Exam */
/* @var $this yii\web\View */
/* @var $questions array Question */

ExaminationAsset::register($this);

$keyAnswer = ['A', 'B', 'C', 'D'];

$this->title = $exam->title;

?>

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
        <?php if ($topic->status == Topic::CHO_DUYET): ?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    Vui lòng duyệt chủ đề xong rồi mới duyệt đề thi <a
                            href="<?= Url::to(['topic/view', 'id' => $topic->id]) ?>"><strong
                                class="current_language_text">duyệt chủ đề</strong></a>
                </p>
            </div>
        <?php endif; ?>
        <?php if ($topic->active == Topic::NO_ACTIVE): ?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    Chủ đề này "<strong class="current_language_text">thành viên đã xóa</strong>"
                </p>
            </div>
        <?php endif; ?>
        <?php if ($topic->status == Topic::KHONG_DUYET): ?>
            <div class="note note-danger text-center" style="border-left: none">
                <p style="color: red">
                    Chủ đề hiện tại này <a href="<?= Url::to(['topic/views', 'id' => $topic->id]) ?>"><strong
                                class="current_language_text">Không được duyệt</strong></a>. Vậy lên những đề thi thuộc
                    chủ đề này cũng "<strong class="current_language_text">Không được duyệt</strong>"

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
                        <?= $exam->description ?>
                    </div>
                </div>
                <?php if ($exam->reason_reject): ?>
                    <div class="widget meta-boxes" style="margin-top: 0">
                        <div class="widget-title">
                            <h4><span>Lý do không duyệt hoặc không hoạt động</span></h4>
                        </div>
                        <div class="widget-body">
                            <?= $exam->reason_reject ?>
                        </div>
                    </div>
                <?php endif; ?>
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
                                    <?php if ($exam->status == Exam::CHO_DUYET || $exam->status == Exam::EXAM_ERROR): ?>
                                        <button type="button" class="btn btn-icon tip <?= $exam->getStatusBg() ?>"
                                                style="color: #fff">
                                            <span class="fa fa-clock-o"></span>
                                            <?= $exam->getStatusLabel() ?>
                                        </button>
                                    <?php endif; ?>

                                    <?php if ($exam->status == Exam::DUYET): ?>
                                        <?php if ($exam->admin_show_hide == Exam::ADMIN_HIDE): ?>
                                            <span class="label pull-left bg-red">
                                            <span class="fa fa-clock-o"></span>
                                            Đề thi ẩn
                                        </span>
                                        <?php elseif ($exam->disable == Exam::DISABLE): ?>
                                            <span class="label pull-left bg-red">
                                            <span class="fa fa-clock-o"></span>
                                            Thành viên xóa
                                        </span>
                                        <?php else: ?>
                                            <span class="label pull-left bg-blue">
                                            <span class="fa fa-clock-o"></span>
                                            Duyệt
                                        </span>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($exam['topic']['active'] == Topic::NO_ACTIVE): ?>
                                        <button type="button" class="btn btn-icon btn-danger tip">
                                            <span class="fa fa-clock-o"></span>
                                            Chủ đề bị xóa
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($exam->status == Exam::KHONG_DUYET): ?>
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
                <?php if ($exam->status == Exam::CHO_DUYET && $topic->status == Topic::DUYET): ?>
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
        <hr>
        <div class="row">
            <div class="col-md-9">
                <div class="basic-game-view-main-panel">
                    <div class="leftMenuGame basic-game-view-left-panel">
                        <div class="this_is_main_scroll_panel_in_basic_game_view scroll-style">
                            <div class="game-content-panel">
                                <?php $number = 0; ?>
                                <?php foreach ($questions as $key => $question):$number++; ?>
                                    <?php $answers = json_decode($question['answer'], true); ?>
                                    <?php $correct = json_decode($question['answer_correct'], true); ?>
                                    <div id="question-<?= $question['id'] ?>">
                                        <div class="col-md-12" style="padding: 0;">
                                            <div class="game-main">
                                                <div class="game-number">
                                                    <span><b>Câu <?= $question->getNumber($number) ?></b></span>
                                                </div>
                                                <div class="game-content">
                                                    <?= $question['content'] ?>
                                                    <?= $question->getMedia('content') ?>
                                                    <?php if ($question['type'] == Question::TYPE_CHOOSE): ?>
                                                        <?php foreach ($answers as $key_a => $answer): ?>
                                                            <?php $background = isset($correct[$key_a]) ? 'background-color: rgba(0, 177, 132, 0.2);' : '' ?>
                                                            <?php $icon = isset($correct[$key_a]) ? 'fa-check-circle-o' : '' ?>
                                                            <div class="col-md-12"
                                                                 style="margin: 5px 0;">
                                                                <table class="tp-checkbox" style="<?= $background ?>">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td width="60px" style="padding-left: 10px;">
                                                                            <span class="fa <?= $icon ?>">
                                                                                <span class="answer-key"><?= $key_a . ' . ' ?></span>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <div class="answer-content">
                                                                                <?= $answer ?>
                                                                                <?= $question->getMedia('answer_' . $answer) ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php elseif ($question['type'] == Question::TYPE_FILL): ?>
                                                        <?php foreach (json_decode($question['answer']) as $key_a => $answer): ?>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="answer-content">
                                                                        <label style="font-size: 15px">
                                                                            Câu trả lời <?= $key_a ?>
                                                                        </label>
                                                                        <input disabled type="text" value="<?= $answer ?>"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <?php $correct = json_decode($question['answer'], true); ?>
                                                        <div class="col-md-12">
                                                            <table class="tp-checkbox">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="answer-content">
                                                                            <div class="answerWrapper">
                                                                                <div class="dragWrapper">
                                                                                    <ul id="sortable-list-<?= $question['id'] ?>"
                                                                                        class="list_unstyled">
                                                                                        <?php if (is_array($question['answer'])): ?>
                                                                                            <?php foreach ($question->answer as $key_a => $answer): ?>
                                                                                                <li data-answer="<?= $key_a ?>"
                                                                                                    data-parent="sortable-list-<?= $question['id'] ?>"
                                                                                                    data-ng-click="writeAnswer($event,<?= $question['id'] ?>,' <?= $key_a ?>')"><?= $answers[$answer] ?></li>
                                                                                                <li id="word-<?= $question['id'] ?>-<?= $key_a ?>"
                                                                                                    style="display:none;color: transparent;">
                                                                                                    <?= $answers[$answer] ?></li>
                                                                                            <?php endforeach; ?>
                                                                                        <?php endif; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="answerWrapper">
                                                                                <div class="dragWrapper">
                                                                                    <ul class="list_unstyled">
                                                                                        <?php foreach ($answers as $key_a => $answer): ?>
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
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="clearfix"></div>
                                                    <div class="game-explain ">
                                                        <p style="font-weight: bold;">Giải thích:</p>
                                                        <div class="game-explain-content">
                                                            <?= $question['explain'] ?>
                                                            <?= $question->getMedia('explain') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-xs hidden-sm">
                <div class="game-answer-panel">
                    <div class="game-time-header">
                        <div class="game-time-label">
                            <span>Tổng số câu hỏi</span>
                        </div>
                        <div class="game-result">
                            <?= $exam->number_question ?>
                        </div>
                    </div>
                    <div class="game-answer-checkbox">
                        <?php $number = 0; ?>
                        <?php foreach ($questions as $key => $value): $number++; ?>
                            <div class="answer-list">
                                <div class="answer pull-left" onclick="scrollToQuestion(<?= $key ?>)">
                                    <div ng-style="myStyle[<?= $key ?>]"
                                         class="answer-text">
                                        <span><?= $question->getNumber($number) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
                                <?php $number = 0; ?>
                                <?php foreach ($questions as $key => $value): $number++; ?>
                                    <div class="answer-list">
                                        <div class="answer pull-left"
                                             onclick="scrollToQuestion(<?= $key ?>)">
                                            <div ng-style="myStyle[<?= $key ?>]"
                                                 class="answer-text">
                                                <span ng-bind="listAnswer[<?= $key ?>]"><?= $question->getNumber($number) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <?= $this->render('_reject', ['exam' => $exam]) ?>
</div>