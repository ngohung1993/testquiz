<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;

/* @var $this yii\web\View */
/* @var $search common\models\Exam */

$general = FunctionHelper::get_general_information();

$this->title = $general['site_name'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $general['home_page_description']
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $general['meta_keyword']
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => Url::to(['site/index'], true)
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'homepage'
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $general['site_name']
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $general['home_page_description']
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => Url::to([$general['logo']], true)
]);

$key1 = FunctionHelper::get_setting_by_key('key1');
$key4 = FunctionHelper::get_setting_by_key('key4');
$key5 = FunctionHelper::get_setting_by_key('key5');
$post = FunctionHelper::get_post(1, 1, 1);
?>
<div class="box-body">
    <div class="body-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12" style="margin-top: 20px">
                    <div class="slide-show">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php foreach (FunctionHelper::get_post(5, 1)['posts'] as $key => $value): ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>"
                                        class="<?= $key == 0 ? 'active' : '' ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php foreach (FunctionHelper::get_post(5, 1)['posts'] as $key => $value): ?>
                                    <div class="item <?= $key == 0 ? 'active' : '' ?>">
                                        <a href="<?= $value->getLink() ?>"
                                           target="_blank">
                                            <img src="<?= $value['avatar'] ?>"
                                                 class="img-responsive avatar-post"
                                                 alt="avatar<?= $key ?>">
                                            <div class="carousel-caption">
                                                <h4><?= $value['title'] ?></h4>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 hidden-sm hidden-xs" style="margin-top: 20px">
                    <div class="test-box">
                        <div class="box-list">
                            <div style="border-left: 2px solid red">
                                <h3 style="margin: 0 0 5px 5px;">ĐỀ THI MỚI</h3>
                            </div>
                            <div class="content">
                                <ul>
                                    <?php foreach ($exam_new = FunctionHelper::get_exam_new(4) as $key => $value): ?>
                                        <li style="padding-bottom: 2px;border-bottom: #f4f4f4">
                                            <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>">
                                                <p style="margin: 0"><?= FunctionHelper::cutString($value['title'], 70, '...') ?></p>
                                                <span style="color: #889d7a"><?= FunctionHelper::intToStringTimeFormat($value['time']) ?>
                                                    | <?= $value['number_question'] ?> câu</span>
                                            </a>
                                        </li>
                                        <?php $count_exam_new = count($exam_new) ?>
                                        <?php if ($key != $count_exam_new - 1): ?>
                                            <hr style="margin: 0 0 10px 0">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 hidden-sm hidden-xs" style="margin-top: 20px">
                    <div class="test-box">
                        <div class="box-list">
                            <div style="border-left: 2px solid red">
                                <h3 style="margin: 0 0 5px 5px;">ĐỀ THI HOT</h3>
                            </div>
                            <div class="content">
                                <ul>
                                    <?php foreach ($exam_hot = FunctionHelper::get_exam_hot(4) as $key => $value): ?>
                                        <li style="padding-bottom: 2px;border-bottom: #f4f4f4">
                                            <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>">
                                                <p style="margin: 0"><?= FunctionHelper::cutString($value['title'], 70, '...') ?></p>
                                                <span style="color: #889d7a"><?= FunctionHelper::intToStringTimeFormat($value['time']) ?>
                                                    | <?= $value['count_bought'] ?>
                                                    lượt mua</span>
                                            </a>
                                        </li>
                                        <?php $count_exam_hot = count($exam_hot) ?>
                                        <?php if ($key != $count_exam_hot - 1): ?>
                                            <hr style="margin: 0 0 10px 0">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12 col-sm-12 col-xs-12 wrap-posts">
                    <?php foreach ($posts = FunctionHelper::get_post(5, 0, 1)['posts'] as $key => $value): ?>
                        <?php $count_post = count($posts) ?>
                        <div class="col-xs-12 col-md-3 box-post <?= $key == $count_post - 1 ? 'last' : '' ?>">
                            <div class="pull-right">
                                <button class="post-hot">
                                    HOT
                                </button>
                            </div>
                            <div class="title">
                                <a href="<?= $value->getLink() ?>">
                                    <h3 style="margin-top: 30px"><?= FunctionHelper::cutString($value['title'], 60, '...') ?></h3>
                                </a>
                                <p>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <span><?= date('d/m/Y', $value['created_at']) ?></span>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="body-middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8" style="margin-top: 20px">
                    <?php if (!isset($search)) { ?>
                        <?php foreach (FunctionHelper::get_categories_by_parent_id(null, 0) as $key => $value): ?>
                            <?php $exams = FunctionHelper::get_exam_by_category_id($value['id'])['exams']; ?>
                            <?php if (count($exams) > 0): ?>
                                <div style="margin-top: 20px">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-8 ">
                                            <div class="body-middle-titel">
                                                <div class="middle-titel">
                                                    <a href="<?= Url::to(['site/category', 'slug' => $value['slug']]) ?>">
                                                        <?= $value['title'] ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-4">
                                            <div class="body-middle-link">
                                                <div class="middle-link">
                                                    <a href="<?= Url::to(['site/category', 'slug' => $value['slug']]) ?>"
                                                       rel="noopener noreferrer">
                                                        Xem tất cả <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row box-hr">
                                        <hr style="margin-bottom: 0;margin-top: 0;">
                                    </div>
                                    <div class="row">
                                        <?php foreach (FunctionHelper::get_exam_by_category_id($value['id'])['exams'] as $key_ex => $value_ex): ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 30px">
                                                <div class="box-exam ">
                                                    <div class="exam ">
                                                        <div class="row ">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                <a href="<?= Url::to(['exam/detail', 'slug' => $value_ex['slug']]) ?>"
                                                                   data-toggle="tooltip" data-placement="top"
                                                                   title="<?= $value_ex['title'] ?>">
                                                                    <h5 class="hidden-xs"><?= FunctionHelper::cutString($value_ex['title'], 35, '...') ?> </h5>
                                                                    <h5 class="hidden-sm hidden-md hidden-lg"><?= FunctionHelper::cutString($value_ex['title'], 80, '...') ?> </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12" style="color: #808080">
                                                                <i class="fa fa-clock-o"
                                                                   aria-hidden="true"></i> <?= FunctionHelper::intToStringTimeFormat($value_ex['time']) ?>
                                                                <button class="box-price <?= $value_ex->getPrice() == 'Miễn phí' ? '' : 'have-price' ?>"><?= $value_ex->getPrice() ?></button>
                                                                <button style="float: right;color: #ccc;background-color: transparent;border: none"
                                                                        data-toggle="tooltip" title="Lưu đề"
                                                                        onclick="likedExam(this,<?= $value_ex['id'] ?>)">
                                                                    <i class="fa fa-heart <?= FunctionHelper::get_style_exam_saved($value_ex['id']) ?>">
                                                                        <?= FunctionHelper::count_favorite($value_ex['id']) ?>
                                                                    </i>
                                                                </button>
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
                                                                            <div class="exam-img-user">
                                                                                <img style="width: 100%;height: 100%;border-radius: 50%"
                                                                                     src="<?= $value_us->getAvatar() ?>"
                                                                                     alt="">
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
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <div style="margin-top: 20px">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="body-middle-titel">
                                        <div class="middle-titel">
                                            <?php if (count($search) == 0) { ?>
                                                <span style="font-size: 26px;color: #444444">Không có đề thi phù hợp!</span>
                                            <?php } else { ?>
                                                <span style="font-size: 26px;color: #444444">Có <?= count($search) ?> đề thi được tìm thấy!</span>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-bottom: 0;margin-top: 0;">
                            <div class="row">
                                <?php foreach ($search as $key_ex => $value_ex): ?>
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
                                                <div class="row">
                                                    <div class="col-xs-12" style="color: #808080">
                                                        <i class="fa fa-clock-o"
                                                           aria-hidden="true"></i> <?= FunctionHelper::intToStringTimeFormat($value_ex['time']) ?>
                                                        <button class="box-price <?= $value_ex->getPrice() == 'Miễn phí' ? '' : 'have-price' ?>"><?= $value_ex->getPrice() ?></button>
                                                        <button style="float: right;color: #ccc;background-color: transparent;border: none"
                                                                data-toggle="tooltip" title="Lưu đề"
                                                                onclick="likedExam(this,<?= $value['id'] ?>)">
                                                            <i class="fa fa-heart <?= FunctionHelper::get_style_exam_saved($value['id']) ?>">
                                                                <?= FunctionHelper::count_favorite($value['id']) ?>
                                                            </i>
                                                        </button>
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
                                                                    <div class="exam-img-user">
                                                                        <img style="width: 100%;height: 100%;border-radius: 50%"
                                                                             src="<?= $value_us->getAvatar() ?>"
                                                                             alt="">
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
                        </div>
                    <?php } ?>
                </div>
                <?= $this->render('sidebar') ?>
            </div>
        </div>
    </div>
</div>