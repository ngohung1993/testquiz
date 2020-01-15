<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;
use yii\widgets\LinkPager;

/* @var $pages LinkPager */
/* @var $user /common/models/User */
/* @var $exams array /common/models/Exam */

$this->title = $user['name'];

?>
<div class="box-body">
    <div class="body-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3 col-xs-12" style="margin-top: 30px">
                    <!-- from ảnh đại diện -->
                    <div style="border: 1px solid #E0E0E0;width: 100%;height: 210px;">
                        <a href="javascript:void(0)">
                            <img alt="" style="width: 100%; height: 100%;" src="<?= $user->getAvatar() ?>">
                        </a>
                    </div>
                    <!-- end from ảnh đại diện -->
                    <div class="tieu-de-xanh col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <h1 style="text-align: center;"><?= $user['name'] ?></h1>
                    </div>
                    <div class="row " style="margin-bottom: 10px; text-align: center">
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 un-t"
                             style=" padding: 0; border-right: 1px solid #E0E0E0;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p>Tổng lượt bán</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><?= FunctionHelper::countExamBuy($user['id']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 un-t"
                             style="padding: 0;border-right: 1px solid #E0E0E0;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p>Tổng đề thi</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><?= FunctionHelper::count_exam_user($user['id']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 un-t" style="padding: 0;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p>Tổng chủ đề</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><?= FunctionHelper::countTopicUser($user['id']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Giới thiệu -->
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12"
                         style="border: 1px solid #E0E0E0;width: 100%;">
                        <div style="padding: 10px">
                            <?= $user['description'] ?>
                        </div>
                    </div>
                    <!-- end giới thiệu -->
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9 col-xs-12" style="margin-top: 30px">
                    <div class="row">
                        <div class="col-sm-12 col-md-9 col-lg-9 col-xs-12">
                            <span style="color: green; padding-right: 20px;">
                                <a href="<?= Url::to(['profile/personal', 'user_id' => $user['id']]) ?>">
                                    Tất cả (<?= FunctionHelper::count_exam_user($user['id']) ?>)
                                </a>
                            </span>
                            <span style="padding-right: 25px;">
                                <a href="<?= Url::to(['profile/personal', 'user_id' => $user['id'], 'price' => 'free']) ?>">
                                    Miễn phí (<?= FunctionHelper::countExamFreeUser($user['id']) ?>)
                                </a>
                            </span>
                            <span style="padding-right: 25px;">
                                <a href="<?= Url::to(['profile/personal', 'user_id' => $user['id'], 'price' => 'paid']) ?>">
                                    Trả phí (<?= FunctionHelper::count_exam_user($user['id']) - FunctionHelper::countExamFreeUser($user['id']) ?>
                                    )
                                </a>
                            </span>
                        </div>
                    </div>
                    <hr style="border: 1px solid #E0E0E0;margin: 0">
                    <!-- nội dung thanh 9 -->
                    <div>
                        <div class="row">
                            <?php foreach ($exams as $key_ex => $value_ex): ?>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 30px">
                                    <div class="box-exam ">
                                        <div class="exam ">
                                            <div class="row ">
                                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                    <a href="<?= Url::to(['exam/detail', 'slug' => $value_ex['slug']]) ?>"
                                                       title="<?= $value_ex['title'] ?>">
                                                        <h5><?= FunctionHelper::cutString($value_ex['title'], 35, '...') ?> </h5>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-xs-12" style="color: #808080">
                                                    <i class="fa fa-clock-o"
                                                       aria-hidden="true"></i> <?= FunctionHelper::intToStringTimeFormat($value_ex['time']) ?>
                                                    <button class="box-price <?= $value_ex->getPrice() == 'Miễn phí' ? '' : 'have-price' ?>"><?= $value_ex->getPrice() ?></button>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-5 col-sm-5 col-xs-5">
                                                    <div class="exam-img ">
                                                        <a href="<?= Url::to(['exam/detail', 'slug' => $value_ex['slug']]) ?>"
                                                           rel="noopener noreferrer ">
                                                            <img src="<?= $value_ex['avatar'] ?>"
                                                                 alt="Image">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-7 col-xs-7 exam-content-text ">
                                                    <div class="row">
                                                        <?php foreach (FunctionHelper::get_users_bought_exam_by_exam_id($value_ex['id'], 2) as $key_us => $value_us): ?>
                                                            <div class="col-md-3 col-sm-3 col-xs-3"
                                                                 style="padding-left: 0;padding-right: 0;margin-right: 10px">
                                                                <div class="exam-img-user"
                                                                     style="background: url(<?= $value_us->getAvatar() ?>)">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <?php $count = count(FunctionHelper::get_users_bought_exam_by_exam_id($value_ex['id'], 2)); ?>

                                                        <div class="col-md-3 col-sm-3 col-xs-3 ">
                                                            <div class="exam-user-number ">
                                                                <span>+ <?= $a = FunctionHelper::count_exam_bought($value_ex['id']) - $count ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-12 col-sm-12 col-xs-12 "
                                                     style="font-size: 14px;text-align: end;padding-top: 12px;margin-bottom: -3px; ">
                                                    <div class="pull-left box-classroom">
                                                        <a href="<?= Url::to(['site/class', 'slug' => FunctionHelper::get_class_by_exam_id($value_ex['id'])['slug']]) ?>">
                                                            <button><?= FunctionHelper::get_class_by_exam_id($value_ex['id'])['title'] ?></button>
                                                        </a>
                                                    </div>
                                                    <div class="pull-right box-detail">
                                                        <a href="<?= Url::to(['exam/detail', 'slug' => $value_ex['slug']]) ?>">
                                                            <button>
                                                                Chi tiết
                                                                <i class="fa fa-angle-right"
                                                                   aria-hidden="true"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row">
                            <div class="center" style="text-align: center">
                                <?= LinkPager::widget(['pagination' => $pages]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>