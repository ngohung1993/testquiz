<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\helpers\FunctionHelper;
use frontend\assets\CountdownAsset;

/* @var $pages LinkPager */
/* @var $exam common\models\Exam */
/* @var $user common\models\User */
/* @var $class common\models\Class */
/* @var $rooms array common\models\Room */
/* @var $subject common\models\Subject */

CountdownAsset::register($this);

$this->title = $exam->title;

?>

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

    .pagination {
        margin: 0;
    }

    .dataTables_empty {
        height: 200px !important;
        padding-top: 25px !important;
        padding-bottom: 180px !important;
        text-align: left !important;
        color: #777;
        font-size: 15px;
        background: url(/uploads/cms/img/table-no-data.png) no-repeat center;
        background-size: auto 161px;
    }

    .notify {
        text-align: center;
        margin-bottom: 10px;
    }

</style>
<div class="box-body">
    <div class="body-middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8" style="margin-top: 20px">
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
                    <div class="row game-header">
                        <div class="col-md-3">
                            <div>
                                <span class="game-result-title">Thời gian làm bài</span>
                            </div>
                            <div style="margin-top: 25px;border-right: 1.5px solid #ccc;">
                                <div>
                                    <span style="font-weight: bold;font-size: 45px;">
                                        <?= $exam->timeToMinutes() ?>
                                    </span>
                                    <span>phút</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-8 box-center">
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
                                        Người tạo
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
                                    <span style="color: #428bca;">Bạn đã thi <?= $test_times ?> lượt</span>
                                </div>
                                <div>
                                    <a style="width: 100%;"
                                       href="<?= Url::to(['room/create', 'exam_id' => $exam->id]) ?>"
                                       class="btn btn-primary">Thi lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"
                             style="border: 1px solid #E0E0E0; margin-top: 20px;background: #fff">
                            <div class="MMC this_is_main_scroll_panel_in_basic_game_view scroll-style"
                                 id="mainScrollPanelGame" style="overflow: auto; position: relative; zoom: 1;">
                                <div style="position: relative; zoom: 1;">
                                    <div class="NMC" style="width: 100%; height: 100%;">
                                        <div class="GMC gameContentPanel 1556769606692_35594889" style="opacity: 1;">
                                            <div id="mainViewPanel-0"
                                                 style="position: relative; width: 100%; padding: 10px 0;">
                                                <div id="act_rfds" class="content_act ">
                                                    <h6 style="text-transform: uppercase;font-weight: 600;color: #555;">
                                                        Lịch sử làm đề thi của bạn:
                                                    </h6>
                                                    <table class="table table-responsive">
                                                        <thead>
                                                        <tr>
                                                            <th>STT</th>
                                                            <th>Thời gian thi</th>
                                                            <th>Số câu đúng</th>
                                                            <th>Thời gian làm bài</th>
                                                            <th>Tác vụ</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($rooms as $key => $value): ?>
                                                            <tr>
                                                                <td><?= ++$key ?></td>
                                                                <td><?= date('H:i d/m/Y', $value['created_at']) ?></td>
                                                                <td>
                                                                    <?= ($value['scores'] ? $value['scores'] : 0) . '/' . $exam['number_question'] ?>
                                                                </td>
                                                                <td><?= $value['completion_time'] ?></td>
                                                                <td>
                                                                    <a href="<?= Url::to(['room/result', 'id' => $value->id]) ?>"
                                                                       class="btn btn-default"
                                                                       style="font-size: 13px; font-style: italic">
                                                                        Xem kết quả
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="clear"></div>
                                                <?php if (!count($rooms)): ?>
                                                    <div class="doc_list_cnt list_cnt_small list div_del"
                                                         style="height: auto">
                                                        <div class="dataTables_empty"></div>
                                                        <div class="notify">
                                                            <span>Không có dữ liệu</span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="paging text-center">
                                                    <?php echo LinkPager::widget([
                                                        'pagination' => $pages,
                                                        'maxButtonCount' => 5,
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 hidden-sm hidden-xs">
                    <div class="box-members">
                        <div class="box-list-members">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="exam-mondai-title">
                                        <div class="horizotalMenuItemFinal">
                                            <h3>Đề thi liên quan</h3>
                                        </div>
                                        <div class="heading-line"></div>
                                    </div>
                                </div>
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