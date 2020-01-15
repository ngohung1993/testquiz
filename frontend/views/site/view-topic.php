<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 3/9/2018
 * Time: 11:19 PM
 */

use yii\helpers\Url;
use common\helpers\FunctionHelper;
use yii\widgets\LinkPager;

/** @var $topic \common\models\Topic */

$this->title = $topic['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $topic['seoTool']['meta_description']
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $topic['seoTool']['meta_keywords']
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'website'
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $topic['seoTool']['seo_title']
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $topic['seoTool']['meta_description']
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $topic['avatar']
]);

?>
<style>
    .box-hr {
        margin-top: 15px;
    }
</style>
<div class="box-body">
    <div class="body-middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
                    <div style="margin-top: 20px">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="body-middle-titel">
                                    <div class="middle-titel">
                                        <a href="<?= Url::to(['site/topic', 'slug' => $topic['slug']]) ?>">
                                            <?= $topic['title'] ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row box-hr">
                            <hr style="margin-bottom: 0;margin-top: 0;">
                        </div>
                        <div class="row">
                            <?php foreach (FunctionHelper::get_exam_by_topic_id($topic['id'])['exams'] as $key => $value): ?>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 30px">
                                    <div class="box-exam ">
                                        <div class="exam ">
                                            <div class="row ">
                                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                    <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>">
                                                        <h5><?= FunctionHelper::cutString($value['title'], 35, '...') ?> </h5>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-xs-12" style="color: #808080">
                                                    <i class="fa fa-clock-o"
                                                       aria-hidden="true"></i> <?= FunctionHelper::intToStringTimeFormat($value['time']) ?>
                                                    <button class="box-price <?= $value->getPrice() == 'Miễn phí' ? '' : 'have-price' ?>"><?= $value->getPrice() ?></button>
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
                                                        <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>"
                                                           rel="noopener noreferrer ">
                                                            <img src="<?= $value['avatar'] ?>"
                                                                 alt="Image">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-7 col-xs-7 exam-content-text ">
                                                    <div class="row">
                                                        <?php foreach (FunctionHelper::get_users_bought_exam_by_exam_id($value['id'], 2) as $key_us => $value_us): ?>
                                                            <div class="col-md-3 col-sm-3 col-xs-3"
                                                                 style="padding-left: 0;padding-right: 0;margin-right: 10px">
                                                                <div class="exam-img-user">
                                                                    <img style="width: 100%;height: 100%;border-radius: 50%"
                                                                         src="<?= $value_us->getAvatar() ?>"
                                                                         alt="">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <?php $count = count(FunctionHelper::get_users_bought_exam_by_exam_id($value['id'], 2)); ?>

                                                        <div class="col-md-3 col-sm-3 col-xs-3 ">
                                                            <div class="exam-user-number ">
                                                                <span>+ <?= $a = FunctionHelper::count_exam_bought($value['id']) - $count ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-12 col-sm-12 col-xs-12 "
                                                     style="font-size: 14px;text-align: end;padding-top: 12px;margin-bottom: -3px; ">
                                                    <div class="pull-left box-classroom">
                                                        <button><?= FunctionHelper::get_class_by_exam_id($value['id'])['title'] ?></button>
                                                    </div>
                                                    <div class="pull-right box-detail">
                                                        <a href="<?= Url::to(['exam/detail', 'slug' => $value['slug']]) ?>">
                                                            <button>
                                                                Chi tiết <i class="fa fa-angle-right"
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
                                <?= LinkPager::widget(['pagination' => FunctionHelper::get_exam_by_topic_id($topic['id'])['pages']]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->render('sidebar') ?>
            </div>
        </div>
    </div>
</div>


