<?php

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
        <div id="action-scroll" class="row">
            <div class="answer-sticky">
                <div class="col-md-9">
                    <div class="basic-game-view-main-panel">
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
                <div class="col-md-3 hidden-xs hidden-sm">
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
                                                <div data-ng-click="setOneAnswer(<?= $i ?>,'<?= $value ?>')"
                                                     ng-style="myOneStyle[<?= $i ?>]['<?= $value ?>']"
                                                     class="answer-text">
                                                    <span><?= $value ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="game-end-preview">
                            <div class="game-end">
                                <button type="button" class="btn btn-primary"
                                        style="width: calc(100% - 94px);"
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
                            <a href="" class="btn btn-default" style="width: 100%;border-radius: 3px!important;">
                                <span class="fa fa-arrow-circle-left"></span>
                                Quay lại trang chủ đề
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
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
                                                    <div data-ng-click="setOneAnswer(<?= $i ?>,'<?= $value ?>')"
                                                         ng-style="myOneStyle[<?= $i ?>]['<?= $value ?>']"
                                                         class="answer-text">
                                                        <span><?= $value ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="game-end-preview">
                                <div class="game-end">
                                    <button type="button" class="btn btn-primary"
                                            style="width: calc(100% - 94px);"
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
</div>