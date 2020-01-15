<?php
/* @var $exam \common\models\Exam */
/* @var $exam_storages \common\models\Exam */
/* @var $question_default \common\models\Question */
/* @var $amount_question_exam_storage \common\models\ExamQuestion */


use backend\assets\ExaminationAsset;
use frontend\assets\CreateExamAsset;
use yii\helpers\Url;

CreateExamAsset::register($this);
ExaminationAsset::register($this);

/* @var $this yii\web\View */
/* @var $id */
?>

<style>
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
</style>

<style>
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
</style>

<main>
    <input type="hidden" data-exam="<?= $exam->id ?>">
    <div class="content-wrapper">
        <div class="container" style="padding: 0 1px">
            <div class="breadcrumb-outer">
                <div class="container">
                    <ul class="breadcrumb breadcrumb-primary "
                        style="background-color: #fff; border-radius: 0">
                        <li>
                            <a href="<?= Url::to(['site/profile']) ?>">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Trang cá nhân
                            </a>
                        </li>
                        <li class="active">Tạo đề thi</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
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
                                                        <div style="position: relative; width: 100%; padding: 10px 0;">
                                                            <div class="search" style="float:right">
                                                                <input id="input-search" placeholder="Nhập tên đề thi">
                                                                <a onclick="createExam.searchExam()" style="color:gray;text-decoration: none"><i class="fa fa-search"></i></a>
                                                            </div>
                                                            <ul id="list-exam">
                                                                <?php if ($question_default == 0 && count($exam_storages) == 0): ?>
                                                                    <li>
                                                                        Kho dữ liệu của bạn chưa có dữ liệu
                                                                    </li>
                                                                <?php endif ?>
                                                                <?php if ($question_default != 0): ?>
                                                                <li>
                                                                    <a href="<?= Url::to(['exam-question-from-exam', 'exam_destination_id' => $exam->id, 'exam_storage_id' => 'default']) ?>">
                                                                        <div class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-4 col-sm-offset-1 col-sm-4 col-xs-12">
                                                                            <img src="/uploads/advertises/default.jpg" height="250px" width="150px" alt="Ảnh default">
                                                                        </div>
                                                                        <div class="col-lg-offset-1 col-lg-6 col-md-offset-1 col-md-6 col-sm-offset-1 col-sm-6 col-xs-12">
                                                                            <p><b>Tên:</b> <i class="name-exam">Câu hỏi chưa được sử dụng</i></p>
                                                                            <p><b>Mô tả:</b> <i>Bao gồm những câu hỏi do bạn dùng tạo ra nhưng chưa được sử dụng trong các đè thi</i></p>
                                                                            <p><b>Số lượng câu hỏi:</b> <i><?=$question_default?></i></p>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <?php endif; ?>
                                                                <?php foreach ($exam_storages as $exam_storage): ?>
                                                                <li>
                                                                    <a href="<?= Url::to(['exam-question-from-exam', 'exam_destination_id' => $exam->id, 'exam_storage_id' => $exam_storage->id]) ?>">
                                                                        <div class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-4 col-sm-offset-1 col-sm-4 col-xs-12">
                                                                            <img src="/uploads/advertises/default.jpg" height="250px" width="150px" alt="Ảnh default">
                                                                        </div>
                                                                        <div class="col-lg-offset-1 col-lg-6 col-md-offset-1 col-md-6 col-sm-offset-1 col-sm-6 col-xs-12">
                                                                            <p><b>Tên đề thi:</b><i class="name-exam"<?=$exam_storage->title?></i></p>
                                                                            <p><b>Mô tả:</b><i<?=$exam_storage->description?></i></p>
                                                                            <p><b>Số lượng câu hỏi:</b><i<?=$amount_question_exam_storage[$exam_storage->id]?></i></p>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <?php endforeach; ?>
                                                            </ul>
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
