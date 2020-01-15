<?php

use common\models\Exam;
use common\models\Room;
use common\models\Question;
use common\helpers\FunctionHelper;
use frontend\assets\ExaminationAsset;

/* @var $exam Exam */
/* @var $room Room */
/* @var $questions Question */
/* @var $test_times integer */

ExaminationAsset::register($this);

$this->title = $exam->title;

$key4 = FunctionHelper::get_setting_by_key('key4');

$keyAnswer = ['A', 'B', 'C', 'D'];

?>

<div class="container clearfix box">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="exam-mondai-title">
                    <div class="horizotalMenuItemFinal">
                        <h2><?= $exam['title'] ?></h2>
                    </div>
                    <div class="heading-line"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <?= $this->render('_result_header', ['exam' => $exam, 'room' => $room, 'test_times' => $test_times]) ?>
                <div class="clearfix"></div>
                <div class="basic-game-view-main-panel">
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
            <div class="col-md-3 hidden-xs hidden-sm">
                <div class="game-answer-panel">
                    <div class="game-time-header">
                        <div class="game-time-label">
                            <span>Kết quả</span>
                        </div>
                        <div class="game-result">
                            <?= $room->scores ?>/<?= $exam->number_question ?>
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
                                            <?php elseif (isset($room->answers[$i]) && in_array($value, $room->answers[$i]['answers'])): ?>
                                                <div class="answer-text"
                                                     style="background: #ba1d2b;color: #fff;">
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
                    <div class="game-end-preview">
                        <div class="game-preview" style="border-top: 1px solid #ccc;margin-top: 10px;">
                            <div class="answered">
                                <div class="answer pull-left">
                                    <div class="answer-text" style="background:  #ba1d2b;"></div>
                                </div>
                                <div class="">
                                    <span>Sai</span>
                                    <div class="pull-right">
                                        <span class="count-preview"><?= $exam->number_question - $room->scores ?>/<?= $exam->number_question ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="answered">
                                <div class="answer pull-left">
                                    <div class="answer-text" style="background: #039449;"></div>
                                </div>
                                <div class="">
                                    <span>Đúng</span>
                                    <div class="pull-right">
                                        <span class="count-preview"><?= $room->scores ?>/<?= $exam->number_question ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <span>Kết quả</span>
                                </div>
                                <div class="game-result">
                                    <?= $room->scores ?>/<?= $exam->number_question ?>
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
                                                    <?php elseif (isset($room->answers[$i]) && in_array($value, $room->answers[$i]['answers'])): ?>
                                                        <div class="answer-text"
                                                             style="background: #ba1d2b;color: #fff;">
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
                            <div class="game-end-preview">
                                <div class="game-preview" style="border-top: 1px solid #ccc;margin-top: 10px;">
                                    <div class="answered">
                                        <div class="answer pull-left">
                                            <div class="answer-text" style="background:  #ba1d2b;"></div>
                                        </div>
                                        <div class="">
                                            <span>Sai</span>
                                            <div class="pull-right">
                                                <span class="count-preview"><?= $exam->number_question - $room->scores ?>/<?= $exam->number_question ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="answered">
                                        <div class="answer pull-left">
                                            <div class="answer-text" style="background: #039449;"></div>
                                        </div>
                                        <div class="">
                                            <span>Đúng</span>
                                            <div class="pull-right">
                                                <span class="count-preview"><?= $room->scores ?>/<?= $exam->number_question ?></span>
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
        <?= $this->render('_result_mobile', ['exam' => $exam, 'room' => $room]) ?>
    </div>
</div>