<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;
use common\models\Exam;

$banner = FunctionHelper::get_setting_by_key('key5');
$fb = FunctionHelper::get_setting_by_key('key3');
?>
<div class="col-md-5 col-lg-4 hidden-sm hidden-xs sidebar" style="margin-top: 25px; ">
    <div class="box-members">
        <div class="box-list-members">
            <h4 style="text-align: left">Xếp hạng</h4>
            <p>Bảng xếp hạng thành viên tham gia nhiều lượt thi nhất</p>
            <div class="sidebar-hr">
                <hr style="margin-bottom: 0;margin-top: 0;">
            </div>
            <div class="content-members ">
                <?php foreach (FunctionHelper::get_user_make_exam_more(5) as $key => $value): ?>
                    <div class="row" style="margin: 20px 0 0 0">
                        <div class="col-md-2" style="padding-left: 8px;padding-right: 0; ">
                            <div class="members-img">
                                <img src="<?= FunctionHelper::getAvatar($value['user']) ?>"
                                     class="img-rounded" alt="Image">
                            </div>
                        </div>
                        <div class="col-md-8" style="padding-left: 11px;padding-right: 6px; ">
                            <div class="content-member-test">
                                <p>
                                    <span>
                                        <a href="<?= Url::to(['profile/personal', 'user_id' => $value['user']['id']]) ?>">
                                            <?= $value['user']['name'] ?></a>
                                    </span>
                                    <br>
                                    <span style="color: #563833;">Số lượt đã thi:
                                        <span style="color: #ce002d">
                                            <?= FunctionHelper::count_number_exam_test_of_user_by_user_id($value['user']['id']) ?>
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
    <div class="box-members">
        <div class="box-list-members-2 ">
            <div class="row" style="margin: 0 ">
                <h4>Đề thi hot</h4>
            </div>
            <div class="sidebar-hr">
                <hr style="margin-bottom: 0;margin-top: 0;">
            </div>
            <div class="content-members ">
                <?php foreach (FunctionHelper::get_exam_hot(5) as $key => $value): ?>
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
                                            <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>"
                                               title="<?= $value['title'] ?>">
                                                <?= FunctionHelper::cutString($value['title'], 35, '...') ?>
                                            </a>
                                        </span>
                                    <br>
                                    <span style="color: #563833;">Số lượt mua đề:
                                            <span style="color: #ce002d"><?= $value['count_bought'] ?> lượt</span>
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
    <div class="box-members">
        <div class="box-list-members-2 ">
            <div class="row" style="margin: 0 ">
                <h4>Đề thi online</h4>
            </div>
            <div class="sidebar-hr">
                <hr style="margin-bottom: 0;margin-top: 0;">
            </div>
            <div class="content-members ">
                <?php foreach (FunctionHelper::get_exam_online(5) as $key => $value): ?>
                    <div class="row" style="margin: 20px 0 0 0">
                        <div class="col-md-2" style="padding-left: 8px;padding-right: 0; ">
                            <div class="members-img avatar-exam-online">
                                <img src="<?= $value['avatar'] ?>"
                                     class="img-rounded" alt="Image">
                            </div>
                        </div>
                        <div class="col-md-8" style="padding-left: 11px;padding-right: 6px; ">
                            <div class="content-member-test content-exam-online">
                                <p>
                                    <span>
                                            <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>"
                                               title="<?= $value['title'] ?>">
                                                <?= FunctionHelper::cutString($value['title'], 35, '...') ?>
                                            </a>
                                        </span>
                                    <br>
                                    <span>
                                        <?php if ($value['classify'] == Exam::SET_TIME_EXAM && $value['set_date_time'] > time()): ?>
                                            <i class="hl-pulse-1-1"></i>
                                            <span style="color: rgb(3, 169, 244);margin-left: 10px">Sắp diễn ra </span>
                                            <br>
                                            <i style="color: black" class="fa fa-clock-o" aria-hidden="true"></i>
                                            <span style="color: black"><?= date('H:i:s d/m/Y', $value['set_date_time']) ?></span>
                                            <br>
                                            <i style="color: black" class="fa fa-clock-o" aria-hidden="true"></i>
                                            <span style="color: black"><?= date('H:i:s d/m/Y', $value['set_date_time_end']) ?></span>
                                        <?php else: ?>
                                            <i class="hl-pulse-1"></i>
                                            <span style=" color: #f41100;margin-left: 10px">Đang diễn ra </span><br>
                                            <i style="color: black" class="fa fa-clock-o" aria-hidden="true"></i>
                                            <span style="color: black"><?= date('H:i:s d/m/Y', $value['set_date_time']) ?></span>
                                            <br>
                                            <i style="color: black" class="fa fa-clock-o" aria-hidden="true"></i>
                                            <span style="color: black"><?= date('H:i:s d/m/Y', $value['set_date_time_end']) ?></span>
                                        <?php endif; ?>

                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2 rank exam-online">
                            <button class="<?= $key + 1 == 1 ? 'one' : ($key + 1 == 2 ? 'tow' : ($key + 1 == 3 ? ' three' : ($key + 1 == 4 ? 'four' : 'fine'))) ?>">
                                0<?= $key + 1 ?>
                            </button>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php if ($banner): ?>
        <div class="baner-right">
            <img style="width: 100%" src="<?= $banner['avatar'] ?>" alt="banner-right">
        </div>
    <?php endif; ?>
    <div class="box-members">
        <div class="box-list-members-2 ">
            <div class="row" style="margin: 0 ">
                <h4>Fanpage</h4>
            </div>
            <div class="sidebar-hr">
                <hr style="margin-bottom: 0;margin-top: 0;">
            </div>
            <div class="content-members ">
                <div class="row" style="margin: 35px 0 0 0">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=<?= FunctionHelper::get_general_information()['page_facebook'] ?>&tabs&width=340&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=304036757051650"
                            width="340" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                            allowTransparency="true" allow="encrypted-media">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media (min-width: 1441px) {
        .hl-pulse-1-1, .hl-pulse-1 {
            top: 26px;
            left: 65px;
        }
    }

    @media (min-width: 768px) and (max-width: 1440px) {
        .hl-pulse-1-1, .hl-pulse-1 {
            top: 34px;
            left: 65px;
        }
    }
</style>