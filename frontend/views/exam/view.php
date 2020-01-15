<?php

use common\models\Exam;
use common\models\Question;
use frontend\assets\ExaminationAsset;

/* @var $status */
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

<div class="container clearfix box">
    <div class="row">
        <div class="col-md-12">
            <div class="exam-mondai-title">
                <div class="horizotalMenuItemFinal" style="padding-top: 0;">
                    <h2 style="margin-top: 0;"><?= $exam['title'] ?></h2>
                </div>
                <div class="heading-line"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9" >
            <?= $this->render('_view_header', ['exam' => $exam]) ?>
            <div class="clearfix"></div>
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
                                        <div class="game-main" style="margin: 0 -15px">
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
                                    <div class="answer pull-left" onclick="scrollToQuestion(<?= $key ?>)">
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
    </div>
</div>