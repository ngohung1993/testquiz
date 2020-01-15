<?php

use yii\helpers\Url;
use common\models\Room;
use common\models\Exam;

/* @var $exam Exam */
/* @var $room Room */
/* @var $test_times integer */

?>

<div class="row game-header">
    <div class="col-md-3">
        <div>
            <span class="game-result-title">Thời gian làm bài</span>
        </div>
        <div style="margin-top: 25px;border-right: 1.5px solid #ccc;">
            <div>
                <span style="font-weight: bold;font-size: 25px;">
                    <?= $room->timeToMinutes() ?>/<?= $exam->timeToMinutes() ?>
                </span> phút
            </div>
            <div>
                <span style="color: #2979b1;">Điểm đạt được</span>
            </div>
            <div>
                <span style="font-size: 20px;color: #f32424;font-weight: bold"><?= round(($room->scores * 100) / $exam->number_question, 2) ?>
                    %</span>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="col-md-8 box-center">
            <div class="row">
                <div class="col-md-4">
                    Người làm đề
                </div>
                <div class="col-md-8">
                    <a href="<?= Url::to(['profile/personal', 'user_id' => $room['user_id']]) ?>">
                        <span style="color: #f32424;"><?= $room['user']['name'] ?></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Chủ đề
                </div>
                <div class="col-md-8">
                    <a href="<?= Url::to(['site/topic', 'slug' => $exam['topic']['slug']]) ?>">
                        <span><?= $exam['topic']['title'] ?></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Số câu hỏi
                </div>
                <div class="col-md-8">
                    <span style="color: #28b371;"><?= $exam->number_question ?> câu</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Lượt thi
                </div>
                <div class="col-md-8">
                    <span style="color: #28b371;"><?= $exam->getTimesExam() ?> lượt</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Người tạo đề
                </div>
                <div class="col-md-8">
                    <a href="<?= Url::to(['profile/personal', 'user_id' => $exam['user_id']]) ?>">
                        <span><?= $exam['user']['name'] ?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="text-align: center;">
            <div style="margin-top: 5px;">
                <span class="free-exam-label" style="background:<?= $exam->getPriceBg() ?>">
                    <?= $exam->getPrice() ?>
                </span>
            </div>
            <div style="margin-top: 40px;margin-bottom: 10px;">
                <a href="<?= Url::to(['room/history', 'exam_id' => $exam['id']]) ?>">
                    <span style="color: #428bca;">Bạn đã thi <?= $test_times ?> lượt</span>
                </a>
            </div>
            <div>
                <a style="width: 100%;" href="<?= Url::to(['room/create', 'exam_id' => $exam->id]) ?>"
                   class="btn btn-primary">Thi lại</a>
            </div>
        </div>
    </div>
</div>