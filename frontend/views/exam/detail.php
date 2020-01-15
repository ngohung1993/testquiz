<?php

use yii\helpers\Url;
use common\models\Exam;
use common\models\Question;
use common\helpers\FunctionHelper;
use frontend\assets\CountdownAsset;

CountdownAsset::register($this);

/* @var $exam common\models\Exam */
/* @var $user common\models\User */
/* @var $class common\models\Class */
/* @var $subject common\models\Subject */

$this->title = $exam['title'];

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $exam['title']
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $exam['description']
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $exam['tags']
]);
$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'website'
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $exam['description']
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $exam['avatar']
]);
$keyAnswer = ['A', 'B', 'C', 'D'];
$exam_bought = FunctionHelper::check_exam_bought_by_user_id($user['id'], $exam['id']);
?>
<!--<link rel="stylesheet" href="/bootstrap/css/style.css">-->
<script type="text/javascript" async
        src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<style>
    .pull-right:focus {
        border: none !important;
    }

    @media (min-width: 1025px) {
        .button-buy {
            padding: 10px 60px;
            border-radius: 35px
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .button-buy {
            padding: 10px 60px;
            border-radius: 35px
        }
    }

    .box-hr {
        margin-top: 22px;
    }

    .sidebar-hr {
        margin-top: 23px;
    }

    span.fa-hourglass-1 {
        font-size: 15px;
        margin-right: 5px;
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

    .this_is_time_left_title_answer_sheet_panel {
        padding: 14px 0;
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

    .gwt-HTML p {
        margin: 0;
    }

    .bg-green {
        background-color: #069 !important;
    }

    @media (min-width: 1025px) {
        .wrap-price {
            margin-left: 53px;
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .wrap-price {
            margin-left: 53px;
        }
    }

    a {
        text-decoration: none !important;
    }

    .label {
        padding: 5px;
    }

    .clock-h, .clock-i, .clock-s {
        font-size: 15px;
        width: 30px;
    }

    .game-countdown {
        padding: 0 calc(50% - 90px);
    }

    .clock-label {
        width: 30px;
    }

</style>
<div class="box-body">
    <div class="body-middle">
        <div class="container">
            <div class="row">
                <!-- cột 9 -->
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8" style="margin-top: 20px">
                    <!--  -->
                    <div>
                        <h1 class="tieu-de-xanh" style="font-size: 26px; font-weight: 400;line-height: 34px;  ">
                            <?= $exam['title'] ?>
                        </h1>
                    </div>
                    <div class="row box-hr">
                        <hr style="margin-bottom: 0;margin-top: 0;">
                    </div>
                    <!-- dưới thanh ngang -->
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"
                         style="border: 1px solid #E0E0E0;  margin-top: 40px; padding:30px;background: #fff">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12" style="margin: 0 0 10px;">
                                <a href="<?= Url::to(['site/category', 'slug' => FunctionHelper::get_category_id($exam['topic']['category_id'])['slug']]) ?>"
                                   style="font-size: 20px; color: #3291cc ; text-decoration: none;"> Danh mục
                                    : <?= FunctionHelper::get_category_id($exam['topic']['category_id'])['title'] ?></a>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6">
                                <div class="wrap-price">
                                    <button class="box-price"><?= $exam->getPrice() ?></button>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-6">
                                <div class="pull-right">
                                    <button style="float: right;color: #ccc;background-color: transparent;border: none"
                                            data-toggle="tooltip" title="Lưu đề"
                                            onclick="likedExam(this,<?= $exam['id'] ?>)">
                                        <i class="fa fa-heart <?= FunctionHelper::get_style_exam_saved($exam['id']) ?>">
                                            <?= FunctionHelper::count_favorite($exam['id']) ?>
                                        </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- img dưới danh mục đề -->
                            <div class="col-sm-3 col-md-3 col-xs-12 col-lg-3 box-doc "
                                 style="padding-right: 10px; border-right: 1px solid #e0e0e0">
                                <div class="time-exam" style="font-size: 60px">
                                    <?= FunctionHelper::get_time_exam($exam['time']) ?>
                                </div>
                                <div class="time-exam" style="margin-top: -28px;font-size: 40px">Phút</div>
                            </div>
                            <!-- end img dưới danh mục đề  -->
                            <div class="col-sm-5 col-md-5 col-xs-12 thong-tin ">
                                <p> Chủ đề
                                    <a href="<?= Url::to(['site/topic', 'slug' => $exam['topic']['slug']]) ?>"
                                       style="padding-left: 71px;color: #333333">
                                        <?= $exam['topic']['title'] ?>
                                    </a>
                                </p>
                                <p> Số câu hỏi <i style="color: green;padding-left:47px; ">
                                        <?= $exam['number_question'] ?> câu
                                    </i>
                                </p>
                                <p> Lượt thi <i
                                            style="color: green;padding-left: 63px;"><?= FunctionHelper::count_exam_rounds_by_exam_id($exam['id']) ?></i>
                                </p>
                                <p> Người đăng <a
                                            href="<?= Url::to(['profile/personal', 'user_id' => $exam['user']['id']]) ?>"
                                            style="color: red;padding-left:35px;"><?= $exam['user']['name'] ?></a></p>
                            </div>
                            <div class="col-sm-4 col-md-4 col-xs-12" style="text-align: center;">
                                <?php if ($exam['classify'] == Exam::SET_TIME_EXAM) { ?>
                                    <?php if ($exam['set_date_time'] > time()) { ?>
                                        <p style="text-align: center;padding-top: 0;font-size: 17px;font-weight: bold;color: #767f86;">
                                            <i class="hl-pulse-1-1"></i>
                                            Sắp diễn ra
                                        </p>
                                        <div class="game-time-header">
                                            <div class="game-time-label">
                                                <span>Thời gian còn lại</span>
                                            </div>
                                            <div data-ng-app="Application" ng-controller="countdownCtrl"
                                                 class="game-countdown">
                                                <input id="seconds" type="hidden"
                                                       value="<?= $exam['set_date_time'] - time() ?>">
                                                <div class="clock-h ng-binding" ng-bind="day">--</div>
                                                <div class="clock-2dot">:</div>
                                                <div class="clock-h ng-binding" ng-bind="hour">--</div>
                                                <div class="clock-2dot">:</div>
                                                <div class="clock-i ng-binding" ng-bind="minute">--</div>
                                                <div class="clock-2dot">:</div>
                                                <div class="clock-s ng-binding" ng-bind="second">--</div>
                                                <div class="clearfix"></div>
                                                <div class="clock-label">Ngày</div>
                                                <div class="clock-text">:</div>
                                                <div class="clock-label">Giờ</div>
                                                <div class="clock-text">:</div>
                                                <div class="clock-label">Phút</div>
                                                <div class="clock-text">:</div>
                                                <div class="clock-label">Giây</div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <?php if ($exam['set_date_time_end'] > time()): ?>
                                            <p style="text-align: center;font-size: 17px;font-weight: bold;color: #767f86;">
                                                <i class="hl-pulse-1" style="left: 45%;"></i>
                                                Đang diễn ra
                                            </p>
                                            <p class="weeking-des">
                                                <i style="color: #03a9f4" class="fa fa-clock-o" aria-hidden="true"></i>
                                                <span><?= date('H:i:s d/m/Y', $exam['set_date_time']) ?></span>
                                                <br><i style="color: #03a9f4;margin-left: -4px" class="fa fa-clock-o"
                                                       aria-hidden="true"></i>
                                                <span><?= date('H:i:s d/m/Y', $exam['set_date_time_end']) ?></span>
                                            </p>
                                            <?php if ($user) : ?>
                                                <?php if ($exam_bought || $user['id'] == $exam['user_id']) : ?>
                                                    <a class="button btreg login_modal"
                                                       href="<?= Url::to(['room/create', 'exam_id' => $exam['id']]) ?>">
                                                        <button class="btvtn btn btn-primary btn-lg button-buy"
                                                                style="background-color: #f32424; border: none;margin-top: 5px">
                                                            Bắt đầu thi
                                                        </button>
                                                    </a>

                                                <?php else : ?>
                                                    <button id="by-exam" class="btvtn btn btn-primary btn-lg"
                                                            data-toggle="modal"
                                                            data-target="#myModal"
                                                            style="background-color: #f32424; border: none;margin-top: 5px">
                                                        Mua đề thi
                                                    </button>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <a href="<?= Url::to(['exam/buy-exam', 'exam_id' => $exam['id']]) ?>">
                                                    <button id="by-exam" class="btvtn btn btn-primary btn-lg"
                                                            data-toggle="modal"
                                                            data-target="#myModal"
                                                            style="background-color: #F93; border: none;margin-top: 5px">
                                                        Mua đề thi
                                                    </button>
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <p style="text-align: center;font-size: 17px;font-weight: bold;color: #767f86;">
                                                <i class="hl-pulse-1" style="left: 38%;"></i>
                                                Đề thi đã kết thúc
                                            </p>
                                            <p class="weeking-des">
                                                <i style="color: red" class="fa fa-clock-o" aria-hidden="true"></i>
                                                <span style="color: red">
                                                    <?= date('H:i:s d/m/Y', $exam['set_date_time']) ?>
                                                </span>
                                                <br>
                                                <i style="color: red;margin-left: -4px" class="fa fa-clock-o"
                                                   aria-hidden="true"></i>
                                                <span style="color: red">
                                                    <?= date('H:i:s d/m/Y', $exam['set_date_time_end']) ?>
                                                </span>
                                            </p>
                                        <?php endif; ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if ($user) : ?>
                                        <?php if ($exam_bought || $user['id'] == $exam['user_id']) : ?>
                                            <a class="button btreg login_modal"
                                               href="<?= Url::to(['room/create', 'exam_id' => $exam['id']]) ?>">
                                                <button class="btvtn btn btn-primary btn-lg button-buy"
                                                        style="background-color: #f32424; border: none;margin-top: 5px">
                                                    Bắt đầu thi
                                                </button>
                                            </a>

                                        <?php else : ?>
                                            <button id="by-exam" class="btvtn btn btn-primary btn-lg"
                                                    data-toggle="modal"
                                                    data-target="#myModal"
                                                    style="background-color: #f32424; border: none;margin-top: 5px">
                                                Mua đề thi
                                            </button>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="<?= Url::to(['exam/buy-exam', 'exam_id' => $exam['id']]) ?>">
                                            <button id="by-exam" class="btvtn btn btn-primary btn-lg"
                                                    data-toggle="modal"
                                                    data-target="#myModal"
                                                    style="background-color: #F93; border: none;margin-top: 5px">
                                                Mua đề thi
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- câu hỏi  -->
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"
                         style="border: 1px solid #E0E0E0; margin-top: 20px;background: #fff">
                        <div class="MMC this_is_main_scroll_panel_in_basic_game_view scroll-style"
                             id="mainScrollPanelGame"
                             style="overflow: auto; position: relative; zoom: 1;">
                            <div style="position: relative; zoom: 1;">
                                <div class="NMC" style="width: 100%; height: 100%;">
                                    <div aria-hidden="true" style="width: 100%; display: none;">
                                        <div class="gwt-HTML"
                                             style="margin: 0 auto; height: 10px; width: 110px; float: none;">
                                            <div class="bullet" style="background: #1e57a2;"></div>
                                            <div class="bullet" style="background: #1e57a2;"></div>
                                            <div class="bullet" style="background: #1e57a2;"></div>
                                        </div>
                                        <div class="gwt-HTML"
                                             style="text-align: center; font-size: 1.4em; color: rgb(30, 87, 162);">
                                            Đang tải câu hỏi, vui lòng chờ trong giây lát
                                        </div>
                                    </div>
                                    <div class="GMC gameContentPanel 1556769606692_35594889"
                                         style="opacity: 1;">
                                        <?php if (isset($questions)): ?>
                                            <?php foreach ($questions as $key => $question): ?>
                                                <?php if ($key < 5): ?>
                                                    <div id="mainViewPanel-0"
                                                         style="position: relative; width: 100%; padding: 10px 0;">
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
                                                                            /<?= $exam['number_question'] ?></b>
                                                                    </span>
                                                                        <span class="label bg-green"
                                                                              style="float: right;margin-bottom: 5px;"><?= $question->getTypeLabel() ?></span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <div style="padding-top: 10px; position: relative; background-color: white;border-top: 1px solid #e0e0e0">
                                                            <table id="gameViewPanel"
                                                                   style="width: 99%; margin: 0 auto;">
                                                                <colgroup>
                                                                    <col>
                                                                </colgroup>
                                                                <tbody>
                                                                <tr>
                                                                    <td align="center" colspan="0"
                                                                        style="vertical-align: top;text-align: left">
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
                                                                                                <?= $question['content'] ?>
                                                                                                <?= $question->getMedia('content') ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php if ($question['type'] == Question::TYPE_CHOOSE):
                                                                    $aw = json_decode($question['answer'], true);
                                                                    shuffle($aw); ?>
                                                                    <?php foreach ($aw as $key_a => $answer): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <table data-ng-click="setAnswer(<?= $question['id'] ?>,'<?= $key_a ?>')"
                                                                                   ng-style="myStyle[<?= $question['id'] ?>]['<?= $key_a ?>']"
                                                                                   cellspacing="0"
                                                                                   cellpadding="0"
                                                                                   class="ks-checkBox"
                                                                                   style="width: 100%; border-top: none; margin-top: 2px; border-radius: 2px;<?= isset($correct[$key_a]) ? 'background-color: rgb(238, 238, 238);' : '' ?>">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        width="50px"
                                                                                        style="vertical-align: middle;">
                                                                                        <?php if (isset($correct[$keyAnswer[$key_a]])): ?>
                                                                                            <span style="color: #00a65a;"
                                                                                                  class="fa fa-check-circle-o"><span
                                                                                                        style="margin-left:10px;font-weight: bold;"><?= $keyAnswer[$key_a] . '.' ?></span></span>
                                                                                        <?php else: ?>
                                                                                            <span class="fa fa-circle-o"><span
                                                                                                        style="margin-left:10px;font-weight: bold;"><?= $keyAnswer[$key_a] . '.' ?></span></span>
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
                                                                                                        <?= $question->getMedia('answer_' . $keyAnswer[$key_a]) ?>
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
                                                                <?php elseif ($question['type'] == Question::TYPE_FILL): ?>
                                                                    <?php foreach (json_decode($question['answer']) as $key_a => $answer): ?>
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
                                                                                                            <label>
                                                                                                                Câu trả
                                                                                                                lời <?= $key_a ?></label>
                                                                                                            <input name="fill[<?= $question['id'] ?>][<?= $key_a ?>]"
                                                                                                                   type="text"
                                                                                                                   disabled
                                                                                                                   class="form-control">
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
                                                                                                                <ul id="sortable-list-<?= $question['id'] ?>"
                                                                                                                    class="list_unstyled">
                                                                                                                    <?php $aw = json_decode($question['answer'], true);
                                                                                                                    shuffle($aw); ?>
                                                                                                                    <?php foreach ($aw as $key_a => $answer): ?>
                                                                                                                        <li data-answer="<?= $key_a ?>"
                                                                                                                            data-parent="sortable-list-<?= $question['id'] ?>"
                                                                                                                            data-ng-click="writeAnswer($event,<?= $question['id'] ?>,'<?= $key_a ?>')"><?= $answer ?></li>
                                                                                                                        <li id="word-<?= $question['id'] ?>-<?= $key_a ?>"
                                                                                                                            style="display:none;color: transparent;"><?= $answer ?></li>
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
                                                                                                                        Ghi
                                                                                                                        đáp
                                                                                                                        án:
                                                                                                                    </li>
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
                                                                </tbody>
                                                            </table>
                                                            <div align="right"
                                                                 style="font-size:13px; margin-top:10px;margin-bottom: 10px">
                                                                <span>
                                                                     <a href="javascript:void(0)" class="error-show">
                                                                        <span><i class="fa fa-exclamation-circle"></i> Báo sai sót</span>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <table cellspacing="5" cellpadding="0"
                                                               aria-hidden="true" class="widgetBoxShadow"
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

                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end câu hỏi   -->

                    <!-- xếp hạng -->
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin-top: 20px;background: #fff">
                        <div class="row" style="background: #f0f0f0">
                            <div class="tieu-de-xanh "
                                 style="font-size: 26px;font-weight: 400">
                                <P>Xếp hạng</P>
                                <div class="row box-hr">
                                    <hr style="margin-bottom: 10px;margin-top: 0;">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="background-color: #fff;margin-top: 10px">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p style="color: #055ca1">
                                    <span class="glyphicon glyphicon-user" style="color: #055ca1"></span> &nbsp
                                    <?= count($count = FunctionHelper::get_users_tested_of_exam_by_exam_id($exam['id'], 5)); ?>
                                    thành viên đã tham gia thi
                                </p>
                            </div>
                        </div>
                        <hr style="border: 1px solid #E0E0E0; ">
                        <?php $rank = 0 ?>
                        <?php foreach ($count as $key => $value): ?>
                            <?php $rank += 1; ?>
                            <div class="row" style="padding-bottom: 15px;padding-top: 15px;background: #fff">
                                <div class="col-md-1 col-sm-1 hidden-xs">
                                    <div class="number-user ">
                                        <div class="number-user-1 ">
                                            <span><?= $rank ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-2">
                                    <div class="number-user ">
                                        <div class="number-user-1 ">
                                            <span>
                                                <img style="width: 40px;margin-top: -5px;border-radius: 50%;height: 40px"
                                                     src="<?= FunctionHelper::getAvatar($value['user']) ?>"
                                                     alt="avatar">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="name-user-text ">
                                        <span><?= $value['user']['name'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 list-text-rank ">
                                    <p>Số Câu trả lời đúng <span style="color: red"><?= $value['scores'] ?></span></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2 list-text-rank">
                                    <p>% điểm:
                                        <span style="color: red">
                                            <?php $number_question = $value->exam['number_question'] ? $value->exam['number_question'] : 1; ?>
                                            <?= round(($value->scores * 100) / $number_question, 2) ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- END xếp hạng -->

                    <!-- Thông tin đề thi  -->
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
                        <div class="row ">
                            <div class="tieu-de-xanh ">
                                <p style="font-size: 26px;padding-top: 10px;font-weight: 400">
                                    Thông tin đề thi
                                </p>
                                <div class="row box-hr">
                                    <hr style="margin-bottom: 10px;margin-top: 0;">
                                </div>
                            </div>
                            <div style="border: 1px solid #E0E0E0;background: #fff">
                                <div style="padding: 10px ">
                                    <?= $exam['description'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end thông tin đề thi -->

                </div>
                <!-- end col 9 -->

                <!-- col 3 bên phải  -->
                <div class="col-md-5 col-lg-4 hidden-sm hidden-xs" style="margin-top: 25px; ">
                    <div class="box-members ">
                        <div class="box-list-members ">
                            <h4>Đề thi liên quan</h4>
                            <div class="sidebar-hr">
                                <hr style="margin-bottom: 0;margin-top: 0;">
                            </div>
                            <div class="content-members" style="padding-top: 15px">
                                <?php foreach (FunctionHelper::get_exam_by_topic_id_detail_page($exam['topic']['id'], 5) as $key => $value): ?>
                                    <div class="row" style="margin: 20px 0 0 0">
                                        <div class="col-md-2" style="padding-left: 8px;padding-right: 0; ">
                                            <div class="members-img">
                                                <img src="<?= $value['avatar'] ?>"
                                                     class="img-rounded" alt="Image">
                                            </div>
                                        </div>
                                        <div class="col-md-8" style="padding-left: 11px;padding-right: 6px; ">
                                            <div class="content-member-test">
                                                <p>
                                                    <span>
                                                        <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>">
                                                            <?= $value['title'] ?>
                                                        </a>
                                                    </span>
                                                    <br>
                                                    <span style="color: #563833;">Lượt mua:
                                                        <span style="color: #ce002d"><?= $value['count_bought'] ?>
                                                            lượt
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 rank">
                                            <button class="<?= FunctionHelper::get_class_color($key + 1) ?>">
                                                0<?= $key + 1 ?>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-members ">
                        <div class="box-list-members-2 ">
                            <div class="row " style="margin: 0 ">
                                <div class="col-md-12 col-sm-12 box-list-title ">
                                    <h4>Đề thi cùng người tạo</h4>
                                </div>
                            </div>
                            <div class="sidebar-hr">
                                <hr style="margin-bottom: 0;margin-top: 0;">
                            </div>
                            <div class="content-members">
                                <?php foreach (FunctionHelper::get_exams_by_user_id($user['id'], 5)['exams'] as $key => $value): ?>
                                    <div class="row" style="margin: 20px 0 0 0">
                                        <div class="col-md-2" style="padding-left: 8px;padding-right: 0; ">
                                            <div class="members-img">
                                                <img src="<?= $value['avatar'] ?>"
                                                     class="img-rounded" alt="Image">
                                            </div>
                                        </div>
                                        <div class="col-md-8" style="padding-left: 11px;padding-right: 6px; ">
                                            <div class="content-member-test">
                                                <p>
                                                    <span>
                                                        <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>">
                                                            <?= $value['title'] ?></a>
                                                    </span>
                                                    <br>
                                                    <span style="color: #563833;">
                                                        Lượt mua:
                                                        <span style="color: #ce002d"><?= $value['count_bought'] ?>
                                                            lượt
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 rank">
                                            <button class="<?= FunctionHelper::get_class_color($key + 1) ?>">
                                                0<?= $key + 1 ?>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (Yii::$app->session->hasFlash('not-login')): ?>
        <div class="alert">
            <div class="slickOverlay sm-animated closeModal sm-fadeIn"
                 style="background: rgba(0, 0, 0, 0.8);animation-duration: 0.3s;">
            </div>
            <div id="error-login" class="modal fade in" role="dialog" style="display: block;padding-right: 17px">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close add-close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="font-size: 18px;">
                                <?= Yii::$app->session->getFlash('not-login') ?>
                            </h4>
                        </div>
                        <div class="modal-body" style="font-size: 14px;font-family: inherit">
                            <p>Bạn cần đăng nhập để mua đề thi!</p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= Url::to(['site/login']) ?>">
                                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button"
                                        class="btn btn-success" data-dismiss="modal">
                                    Đăng nhập
                                </button>
                            </a>
                            <button type="button" class="btn btn-default add-close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert">
            <div class="slickOverlay sm-animated closeModal sm-fadeIn"
                 style="background: rgba(0, 0, 0, 0.8);animation-duration: 0.3s;">
            </div>
            <div id="buyExam" class="modal fade in" role="dialog" style="display: block;padding-right: 17px">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close add-close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="font-size: 18px;">
                                <?= Yii::$app->session->getFlash('success') ?>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p>Bạn đã mua đề thi <span style="color: red;font-weight: bold"><?= $exam['title'] ?></span>
                                thành công.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= Url::to(['room/create', 'exam_id' => $exam['id']]) ?>">
                                <button type="button" class="btn" style="background-color: #1fb6ff;color: #ffffff">
                                    Thi ngay
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('not_enough_money')): ?>
        <div class="alert">
            <div class="slickOverlay sm-animated closeModal sm-fadeIn"
                 style="background: rgba(0, 0, 0, 0.8);animation-duration: 0.3s;">
            </div>
            <div id="error-money" class="modal fade in" role="dialog" style="display: block;padding-right: 17px">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close add-close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="font-size: 18px;">
                                <?= Yii::$app->session->getFlash('not_enough_money') ?>
                            </h4>
                        </div>
                        <div class="modal-body" style="font-size: 14px;font-family: inherit">
                            <p>Số dư trong ví không đủ! Vui lòng nạp thêm tiền vào tài khoản!</p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= Url::to(['finance/index']) ?>">
                                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button"
                                        class="btn btn-success" data-dismiss="modal">
                                    Nạp tiền
                                </button>
                            </a>
                            <button type="button" class="btn btn-default add-close" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-size: 18px;">Mua đề thi</h4>
                </div>
                <div class="modal-body" style="font-size: 18px">
                    <h5>
                        Ví hiện có:
                        <span style="color: red">
                    <?= number_format($user['wallet'], '0', ',', '.') ?>
                </span> đ
                    </h5>

                    <h5>
                        Giá đề thi:
                        <span style="color: red">
                        <?= number_format($exam['price'], '0', ',', '.') ?>
                    </span>
                        đ
                    </h5>
                </div>
                <div class="modal-footer">
                    <a href="<?= Url::to(['exam/buy-exam', 'exam_id' => $exam['id']]) ?>">
                        <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button"
                                class="btn btn-success">
                            Xác nhận
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .signed-st-head .media-body a {
        font-size: 16px !important;
    }

    .nav-top li a {
        font-family: Roboto, sans-serif !important;
    }

    .modal {
        z-index: 60 !important;
    }

    .modal-backdrop {
        z-index: 59 !important;
    }

    .breadcrumbs {
        padding: 0;
    }

    .box {
        padding: 8px 15px;
    }

    a:hover {
        text-decoration: none;
    }

    .number {
        color: red;
    }

    .slickOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        content: "";
        z-index: 60;
    }

    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-size: 100%;
        background-image: url(/theme/images/modal.png) !important;
    }

    h5 {
        font-size: 14px;
        font-weight: bold;
    }

    @media (min-width: 600px) {
        .modal-dialog {
            margin: 150px auto;
        }

        .detail-exam {
            margin-top: 10px;
        }

        .box {
            width: 100% !important;
        }
    }

    @media (max-width: 768px) {
        .ul-mobile {
            display: inline-grid !important;
            line-height: 2 !important;
            margin-top: 0 !important;
        }

        .link-top {
            margin-top: 50px;
        }
    }

</style>
<script src="/theme/js/jquery.min.js"></script>
<script>
    $('.add-close').click(function () {
        $('.alert').css('display', 'none');
    });
</script>