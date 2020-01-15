<?php

use yii\helpers\Url;
use common\models\Room;
use common\models\Exam;
use common\models\Question;
use yii\widgets\ActiveForm;
use common\helpers\FunctionHelper;
use frontend\assets\ExaminationAsset;

/* @var $exam Exam */
/* @var $room Room */
/* @var $questions Question */

ExaminationAsset::register($this);

$this->title = $exam->title;

$key4 = FunctionHelper::get_setting_by_key('key4');

$keyAnswer = ['A', 'B', 'C', 'D'];

?>

<script type="text/javascript" async
        src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

<div data-ng-app="Application" ng-controller="examinationCtrl">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container clearfix box">
        <input type="hidden" id="number-question" value="<?= $exam->number_question ?>">
        <input type="hidden" id="seconds" name="seconds"
               value="<?= strtotime($exam['time']) - strtotime('00:00:00') ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="exam-mondai-title">
                    <div class="horizotalMenuItemFinal">
                        <h3><?= $exam['title'] ?></h3>
                    </div>
                    <div class="heading-line"></div>
                </div>
            </div>
        </div>
        <div class="row" id="action-scroll">
            <div class="col-md-9 answer-sticky">
                <div class="basic-game-view-main-panel">
                    <div class="leftMenuGame basic-game-view-left-panel">
                        <div class="this_is_main_scroll_panel_in_basic_game_view scroll-style">
                            <div class="game-content-panel">
                                <?php $number = 0; ?>
                                <?php foreach ($room['questions'] as $key => $value): $number++; ?>
                                    <?php $question = $questions[$key]; ?>
                                    <?php $answers = json_decode($question['answer'], true); ?>
                                    <?php $correct = json_decode($question['answer_correct'], true); ?>
                                    <div class="row" id="question-<?= $question['id'] ?>">
                                        <div class="col-md-12">
                                            <div class="game-main">
                                                <div class="game-number">
                                                    <span><b>Câu <?= $question->getNumber($number) ?></b></span>
                                                </div>
                                                <div class="game-content">
                                                    <?= $question['content'] ?>
                                                    <?= $question->getMedia('content') ?>
                                                    <div class="clearfix"></div>
                                                    <?php if ($question['type'] == Question::TYPE_CHOOSE): ?>
                                                        <?php foreach ($room['questions'][$question['id']] as $key_a => $answer): ?>
                                                            <div class="col-md-12" style="margin: 5px 0;">
                                                                <table data-ng-click="setAnswer(<?= $question['id'] ?>,'<?= $keyAnswer[$key_a] ?>')"
                                                                       ng-style="myStyle[<?= $question['id'] ?>]['<?= $keyAnswer[$key_a] ?>']"
                                                                       class="tp-checkbox">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td width="60px"
                                                                            style="padding-left: 10px;">
                                                                            <span data-ng-class="myClass[<?= $question['id'] ?>]['<?= $keyAnswer[$key_a] ?>']"
                                                                                  class="fa fa-circle-o">
                                                                                <span class="answer-key"><?= $keyAnswer[$key_a] . '.' ?></span>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <div class="answer-content">
                                                                                <?= $answers[$answer] ?>
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
                                                                    <table class="tp-checkbox">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="answer-content">
                                                                                    <label>
                                                                                        Câu trả lời <?= $key_a ?>
                                                                                    </label>
                                                                                    <input name="fill[<?= $question['id'] ?>][<?= $key_a ?>]"
                                                                                           type="text"
                                                                                           data-ng-model="myValue"
                                                                                           data-ng-change="fillAnswer(<?= $question['id'] ?>)"
                                                                                           class="form-control">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <div class="col-md-12">
                                                            <div class="answer-content">
                                                                <div class="answerWrapper">
                                                                    <div class="dragWrapper">
                                                                        <ul id="sortable-list-<?= $question['id'] ?>"
                                                                            class="list_unstyled">
                                                                            <?php foreach ($room['questions'][$question['id']] as $key_a => $answer): ?>
                                                                                <li data-answer="<?= $key_a ?>"
                                                                                    data-parent="sortable-list-<?= $question['id'] ?>"
                                                                                    data-ng-click="matchingAnswer($event,<?= $question['id'] ?>,'<?= $key_a ?>')"><?= $answers[$answer] ?></li>
                                                                                <li id="word-<?= $question['id'] ?>-<?= $key_a ?>"
                                                                                    style="display:none;color: transparent;"><?= $answers[$answer] ?></li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="answerWrapper">
                                                                    <div class="dragWrapper">
                                                                        <ul id="sortable-answer-<?= $question['id'] ?>"
                                                                            class="list_unstyled">
                                                                            <li style="font-weight: bold;background: #2c7b30;color: #fff;">
                                                                                Ghi đáp án:
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="clearfix"></div>
                                                    <div id="explain-<?= $question['id'] ?>"
                                                         class="game-explain hidden">
                                                        <p>Giải thích:</p>
                                                        <div class="game-explain-content">
                                                            <?= $question['explain'] ?>
                                                            <?= $question->getMedia('explain') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div align="right" style="font-size:13px; margin-top:10px">
                                                    <span>
                                                        <a href="" class="error-show"
                                                           onclick="showModelReport(<?= $question['id'] ?>)">
                                                            <span><i class="fa fa-exclamation-circle"></i> Báo sai sót</span>
                                                        </a>
                                                    </span>
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
            <div class="col-md-3 hidden-xs hidden-sm answer-sticky">
                <div class="game-answer-panel">
                    <div class="game-time-header">
                        <div class="game-time-label">
                            <span>Thời gian còn lại</span>
                        </div>
                        <div class="game-countdown">
                            <div class="clock-h" ng-bind="hour">--</div>
                            <div class="clock-2dot">:</div>
                            <div class="clock-i" ng-bind="minute">--</div>
                            <div class="clock-2dot">:</div>
                            <div class="clock-s" ng-bind="second">--</div>
                            <div class="clearfix"></div>
                            <div class="clock-label">Giờ</div>
                            <div class="clock-text">:</div>
                            <div class="clock-label">Phút</div>
                            <div class="clock-text">:</div>
                            <div class="clock-label">Giây</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="game-answer-checkbox">
                        <?php $number = 0; ?>
                        <?php foreach ($room['questions'] as $key => $value): $number++; ?>
                            <?php $question = $questions[$key]; ?>
                            <div class="answer-list">
                                <div class="answer pull-left" onclick="scrollToQuestion(<?= $question['id'] ?>)">
                                    <div data-ng-style="myStylePreview[<?= $question['id'] ?>]" class="answer-text">
                                        <span>
                                            <?= $number < 9 ? '0' . ($number) : $number ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                        <div class="game-end">
                            <button type="button" class="btn btn-primary"
                                    style="width: calc(100% - 94px);background: #428bca;"
                                    data-toggle="modal" data-target="#myModal">
                                Nộp bài
                            </button>
                            <a class="btn btn-default" href="">Thoát</a>
                        </div>
                        <div class="game-preview" style="border-top: 1px solid #ccc;margin-top: 10px;">
                            <div class="answered">
                                <div class="answer pull-left">
                                    <div class="answer-text" style="background: #2f70dc;"></div>
                                </div>
                                <div class="">
                                    <span>Đã trả lời</span>
                                    <div class="pull-right">
                                        <span class="count-preview">
                                            <span ng-bind="answered">0</span>/<?= $exam->number_question ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="answered">
                                <div class="answer pull-left">
                                    <div class="answer-text"></div>
                                </div>
                                <div class="">
                                    <span>Chưa trả lời</span>
                                    <div class="pull-right">
                                        <span class="count-preview">
                                            <span ng-bind="notAnswered">0</span>/<?= $exam->number_question ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px 0;">
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-default"
                           style="width: 100%;border-radius: 3px!important;">
                            <span class="fa fa-arrow-circle-left"></span>
                            Quay lại trang chủ đề
                        </a>
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
                                    <span>Thời gian còn lại</span>
                                </div>
                                <div class="game-countdown">
                                    <div class="clock-h" ng-bind="hour">--</div>
                                    <div class="clock-2dot">:</div>
                                    <div class="clock-i" ng-bind="minute">--</div>
                                    <div class="clock-2dot">:</div>
                                    <div class="clock-s" ng-bind="second">--</div>
                                    <div class="clearfix"></div>
                                    <div class="clock-label">Giờ</div>
                                    <div class="clock-text">:</div>
                                    <div class="clock-label">Phút</div>
                                    <div class="clock-text">:</div>
                                    <div class="clock-label">Giây</div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="game-answer-checkbox">
                                <?php $number = 0; ?>
                                <?php foreach ($room['questions'] as $key => $value): $number++; ?>
                                    <?php $question = $questions[$key]; ?>
                                    <div class="answer-list">
                                        <div class="answer pull-left"
                                             onclick="scrollToQuestion(<?= $question['id'] ?>)">
                                            <div data-ng-style="myStylePreview[<?= $question['id'] ?>]"
                                                 class="answer-text">
                                        <span>
                                            <?= $number < 9 ? '0' . ($number) : $number ?>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="clearfix"></div>
                                <div class="game-end">
                                    <button type="button" class="btn btn-primary"
                                            style="width: calc(100% - 94px);background: #428bca;"
                                            data-toggle="modal" data-target="#myModal">
                                        Nộp bài
                                    </button>
                                    <a class="btn btn-default" data-dismiss="modal">Thoát</a>
                                </div>
                                <div class="game-preview" style="border-top: 1px solid #ccc;margin-top: 10px;">
                                    <div class="answered">
                                        <div class="answer pull-left">
                                            <div class="answer-text" style="background: #2f70dc;"></div>
                                        </div>
                                        <div class="">
                                            <span>Đã trả lời</span>
                                            <div class="pull-right">
                                        <span class="count-preview">
                                            <span ng-bind="answered">0</span>/<?= $exam->number_question ?>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="answered">
                                        <div class="answer pull-left">
                                            <div class="answer-text"></div>
                                        </div>
                                        <div class="">
                                            <span>Chưa trả lời</span>
                                            <div class="pull-right">
                                        <span class="count-preview">
                                            <span ng-bind="notAnswered">0</span>/<?= $exam->number_question ?>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('_time_mobile', ['exam' => $exam]) ?>
    <?= $this->render('_submit_modal') ?>
    <?php ActiveForm::end(); ?>
    <?= $this->render('_report_modal') ?>
</div>