<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\UserExam;
use common\helpers\FunctionHelper;

/* @var $type integer */
/* @var $pages LinkPager */
/* @var $user common\models\User */
/* @var $exams array common\models\Exam */

$logo = FunctionHelper::get_general_information()['logo'];
$user = Yii::$app->user->identity;
$this->title = 'Kho đề thi';

?>
<style>
    .pagination li.active a {
        color: #fff;
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

    .examsResult ul li:nth-of-type(odd) .wrapper-5 {
        background: #f7f7f7;
        overflow: visible;
    }

    .wrapper-5 {
        padding: 5px;
    }

    .result-info {
        position: relative;
    }

    .examsResult .wrapper-5 {
        min-height: 80px;
    }

    .ava-2-80 span {
        width: 40px;
        height: 40px;
    }

    .ava-2-80 img {
        height: 50px;
        width: 50px;
    }

    .ava-2-80 {
        width: 60px;
    }

    .ava-2-80, .ava-2-60 {
        display: inline-block;
        position: relative;
        float: left;
    }

    .examsResult ul li > .row > .col-md-4, .col-md-8 {
        padding-left: 5px;
        padding-right: 5px;
    }

    .teacherResult > .row, .examsResult > .row {
        margin-left: 0;
        margin-right: 0;
        border-bottom: 2px solid #ededed;
        margin-bottom: 5px;
    }

    .examsResult a {
        color: #fff;
    }

    .statusIcon {
        border: 1px solid #e7e7e7;
        width: 40px;
        height: 40px;
        line-height: 40px;
        display: inline-block;
        text-align: center;
    }

    @media (max-width: 768px) {
        .header-desktop {
            display: none;
        }

        .action-mobile {
            text-align: center;
        }

        .examsResult .wrapper-5 {
            min-height: 90px;
        }
    }

    @media (min-width: 600px) and (max-width: 768px) {
        .examsResult .wrapper-5 {
            min-height: 75px;
        }

        .ad_user_menu_left li a span {
            margin: 5px !important;
        }
    }
</style>
<div class="col-sm-9 col-xs-12 response" style="margin-top: -20px;">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -10px; ">
            Kho đề thi
        </h3>
        <div class="content_user_info bg_none">
            <div class="top_doc_type" style="">
                <ul class="">
                    <li class="<?= $type == UserExam::BOUGHT ? 'active_man' : '' ?>">
                        <a form="man_radio" href="<?= Url::to(['bought']) ?>">
                            <i class="icon_type_radio"></i>
                            <span>
                                Đề đã mua
                                <em> (<?= FunctionHelper::countUserExamByType($user['id'], UserExam::BOUGHT) ?>)</em>
                            </span>
                        </a>
                    </li>
                    <li class="<?= $type == UserExam::SAVE ? 'active_man' : '' ?>">
                        <a form="man_radio" href="<?= Url::to(['bought', 'type' => UserExam::SAVE]) ?>">
                            <i class="icon_type_radio"></i>
                            <span>
                                Đề đã lưu
                                <em> (<?= FunctionHelper::countUserExamByType($user['id'], UserExam::SAVE) ?>)</em>
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="mn_doc_upload"></div>
            <div class="mn_list_view_more">
                <div class="list_doc_man">
                    <div class="row">
                        <?php foreach ($exams as $key => $value): ?>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 30px;">
                                <div class="box-exam">
                                    <div class="exam">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <a href="<?= Url::to(['exam/detail', 'slug' => $value['exam']['slug']]) ?>"
                                                   title="<?= $value['exam']['title'] ?>">
                                                    <h5><?= FunctionHelper::cutString($value['exam']['title'], 35, '...') ?> </h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12" style="color: #808080">
                                                <i class="fa fa-clock-o"></i> <?= FunctionHelper::intToStringTimeFormat($value['exam']['time']) ?>
                                                <button class="box-price"><?= FunctionHelper::get_price_exam($value['exam']['id']) ?></button>
                                                <button style="float: right;color: #fff;background-color: #d9534f;padding: 5px 12px;border-radius: 4px;"
                                                        data-toggle="modal"
                                                        onclick="getIdExam(<?= $value['exam']['id'] ?>)"
                                                        data-target="#myModal" title="Xóa đề">
                                                    <a href="javascript:void(0)">
                                                        <i class="fa fa-trash-o" style="color: #fff"></i>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <div class="exam-img ">
                                                    <a href="<?= Url::to(['exam/detail', 'slug' => $value['exam']['slug']]) ?>"
                                                       rel="noopener noreferrer ">
                                                        <img src="<?= $value['exam']['avatar'] ?>"
                                                             alt="Image">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-7 col-xs-7 exam-content-text ">
                                                <div class="row">
                                                    <?php foreach (FunctionHelper::get_users_bought_exam_by_exam_id($value['exam']['id'], 2) as $key_us => $value_us): ?>
                                                        <div class="col-md-3 col-sm-3 col-xs-3"
                                                             style="padding-left: 0;padding-right: 0;margin-right: 10px">
                                                            <div class="exam-img-user">
                                                                <img style="width: 100%;height: 100%;border-radius: 50%"
                                                                     src="<?= $value_us->getAvatar() ?>"
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <?php $count = count(FunctionHelper::get_users_bought_exam_by_exam_id($value['exam']['id'], 2)); ?>

                                                    <div class="col-md-3 col-sm-3 col-xs-3 ">
                                                        <div class="exam-user-number ">
                                                            <span>+ <?= $a = FunctionHelper::count_exam_bought($value['exam']['id']) - $count ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12 col-xs-12 "
                                                 style="font-size: 14px;text-align: end;padding-top: 12px;margin-bottom: -3px; ">
                                                <?php if (FunctionHelper::get_class_by_exam_id($value['exam']['id'])): ?>
                                                    <div class="pull-left box-classroom">
                                                        <a href="<?= Url::to(['site/class', 'slug' => FunctionHelper::get_class_by_exam_id($value['exam']['id'])['slug']]) ?>">
                                                            <button><?= FunctionHelper::get_class_by_exam_id($value['exam']['id'])['title'] ?></button>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="pull-right box-detail">
                                                    <a href="<?= Url::to(['exam/detail', 'slug' => $value['exam']['slug']]) ?>">
                                                        <button>
                                                            Chi tiết
                                                            <i class="fa fa-angle-right"
                                                               aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="pull-right" style="margin-top: 10px; ">
                                                <a href="<?= Url::to(['room/history', 'exam_id' => $value['exam']['id']]) ?>"
                                                   title="Xem lại lịch sử"
                                                   style="color: #1fb6ff; font-size: 14px; margin-right: 12px; font-style: italic">
                                                    Bạn đã làm
                                                    <span style="color: #000;">
                                                        <?= FunctionHelper::getNumberRoomExamBuyUser($value['exam']['id'], $user['id']) ?>
                                                    </span> lượt
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!count($exams)) : ?>
                        <div class="doc_list_cnt list_cnt_small list div_del" style="height: auto">
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    <?php else: ?>
                        <div class="paging">
                            <?php echo LinkPager::widget([
                                'pagination' => $pages,
                                'maxButtonCount' => 5,
                            ]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }
</style>
<div id="myModal" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="exam_id">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px; ">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <h5 style="color: red">Bạn chắc chắn muốn xóa đề thi?</h5>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success"
                        data-dismiss="modal" onclick="deleteExamSave()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs > li {
        float: none;
    }

    .menu .active {
        background-color: #00a888;
    }

    .menu .active a {
        background-color: #00a888 !important;
        color: #fff !important;
    }

    .ck_man_doc_t input {
        margin-top: 64px !important;
    }

    .deleteitem {
        right: 30px;
    }

    @media screen and (max-width: 600px) {
        .doc_title_cnt {
            width: initial !important;
        }

        .exam {
            top: 95px;
        }
    }

    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }
</style>

<script>
    let getIdExam = function (exam_id) {
        $('#exam_id').val(exam_id);
    };
    let deleteExamSave = function () {
        let exam_id = $('#exam_id').val();
        $.ajax({
            type: 'POST',
            url: '/ajax/delete-exam-save',
            data: {
                exam_id: exam_id,
                user_id: <?= $user['id']?>
            },
            success: function () {
                window.location.reload();
            }
        });
    }
</script>