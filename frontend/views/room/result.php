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

<script type="text/javascript" async
        src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

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
                                <?php $number = 0; ?>
                                <?php foreach ($room['questions'] as $key => $value):
                                    $number++; ?>
                                    <?php $question = $questions[$key]; ?>
                                    <?php $answers = json_decode($question['answer'], true); ?>
                                    <?php $correct = json_decode($question['answer_correct'], true); ?>
                                    <div class="row" id="question-<?= $question['id'] ?>">
                                        <div class="col-md-12" style="padding: 0;">
                                            <div class="game-main">
                                                <div class="game-number">
                                                    <span><b>Câu <?= $question->getNumber($number) ?></b></span>
                                                </div>
                                                <div class="game-content">
                                                    <?= $question['content'] ?>
                                                    <?= $question->getMedia('content') ?>
                                                    <?php if ($question['type'] == Question::TYPE_CHOOSE): ?>
                                                        <?php foreach ($value as $key_a => $answer): ?>
                                                            <?php $background = isset($room['answers'][$key]) && in_array($keyAnswer[$key_a], $room['answers'][$key]['answers']) ? 'background-color: rgba(254,107,67,0.2)!important;' : '' ?>
                                                            <?php $background = isset($correct[$answer]) ? 'background-color: rgba(0, 177, 132, 0.2);' : $background ?>
                                                            <?php $icon = isset($room['answers'][$key]) && in_array($keyAnswer[$key_a], $room['answers'][$key]['answers']) ? 'fa-close' : 'fa-circle-o' ?>
                                                            <?php $icon = isset($correct[$answer]) ? 'fa-check-circle-o' : $icon ?>
                                                            <div class="col-md-12" style="margin: 5px 0;">
                                                                <table class="tp-checkbox"
                                                                       style="<?= $background ?>">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td width="60px" style="padding-left: 10px;">
                                                                            <span class="fa <?= $icon ?>">
                                                                                <span class="answer-key"><?= $keyAnswer[$key_a] . ' . ' ?></span>
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
                                                                    <div class="answer-content">
                                                                        <label>
                                                                            Câu trả lời <?= $key_a ?>
                                                                        </label>
                                                                        <input name="fill[<?= $question['id'] ?>][<?= $key_a ?>]"
                                                                               type="text" class="form-control">
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
                                                                                        <?php foreach ($room['questions'][$question['id']] as $key_a => $answer): ?>
                                                                                            <li data-answer="<?= $key_a ?>"
                                                                                                data-parent="sortable-list-<?= $question['id'] ?>"
                                                                                                data-ng-click="writeAnswer($event,<?= $question['id'] ?>,' <?= $key_a ?>')"><?= $answers[$answer] ?></li>
                                                                                            <li id="word-<?= $question['id'] ?>-<?= $key_a ?>"
                                                                                                style="display:none;color: transparent;"><?= $answers[$answer] ?></li>
                                                                                        <?php endforeach; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="answerWrapper">
                                                                                <div class="dragWrapper">
                                                                                    <ul class="list_unstyled">
                                                                                        <li style="font-weight: bold;background: #2c7b30;color: #fff;">
                                                                                            Đáp án:
                                                                                        </li>
                                                                                        <?php foreach ($answers as $key_a => $answer): ?>
                                                                                            <li><?= $answer ?></li>
                                                                                        <?php endforeach; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="dragWrapper">
                                                                                    <ul class="list_unstyled">
                                                                                        <li style="font-weight: bold;background: #2c7b30;color: #fff;width: 78px;">
                                                                                            Trả lời:
                                                                                        </li>
                                                                                        <?php if (isset($room['answers'][$question['id']])): ?>
                                                                                            <?php foreach ($room['answers'][$question['id']]['answers'] as $k => $v): ?>
                                                                                                <li><?= $answers[$room['questions'][$question['id']][$v]] ?></li>
                                                                                            <?php endforeach; ?>
                                                                                        <?php endif; ?>
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
                                                        <p>Giải thích:</p>
                                                        <div class="game-explain-content">
                                                            <?= $question['explain'] ?>
                                                            <?= $question->getMedia('explain') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div align="right" style="font-size:13px; margin-top:10px">
                                                    <span>
                                                        <a style="margin-right: 10px;" href="" class="question-show">
                                                            <span><i class="fa fa-compass"></i> Gợi ý trả lời</span>
                                                        </a>
                                                        <a href="" class="error-show">
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
                        <?php $number = 0; ?>
                        <?php foreach ($room['questions'] as $key => $value): $number++; ?>
                            <div class="answer-list">
                                <div class="answer pull-left" onclick="scrollToQuestion(<?= $key ?>)">
                                    <div ng-style="myStyle[<?= $key ?>]"
                                         class="answer-text answer-text-<?= isset($room['answers'][$key]) && $room['answers'][$key]['result'] ? 'correct' : 'wrong' ?>">
                                        <span ng-bind="listAnswer[<?= $key ?>]"><?= $question->getNumber($number) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
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
                                    <span>Kết quả</span>
                                </div>
                                <div class="game-result">
                                    <?= $room->scores ?>/<?= $exam->number_question ?>
                                </div>
                            </div>
                            <div class="game-answer-checkbox">
                                <?php $number = 0; ?>
                                <?php foreach ($room['questions'] as $key => $value): $number++; ?>
                                    <div class="answer-list">
                                        <div class="answer pull-left" onclick="scrollToQuestion(<?= $key ?>)">
                                            <div ng-style="myStyle[<?= $key ?>]"
                                                 class="answer-text answer-text-<?= isset($room['answers'][$key]) && $room['answers'][$key]['result'] ? 'correct' : 'wrong' ?>">
                                                <span ng-bind="listAnswer[<?= $key ?>]"><?= $question->getNumber($number) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="clearfix"></div>
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
                                <div class="clearfix"></div>
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