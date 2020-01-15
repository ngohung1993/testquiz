<?php
/**
 * Created by PhpStorm.
 * User: eragon9x
 * Date: 6/7/2019
 * Time: 11:54 AM
 */

use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\helpers\FunctionHelper;

?>
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
                                        Tin tức
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row box-hr">
                            <hr style="margin-bottom: 0;margin-top: 0;">
                        </div>
                        <div class="row">
                            <?php foreach (FunctionHelper::get_post(0)['posts'] as $key => $value): ?>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px">
                                    <div class="box-exam ">
                                        <div class="exam ">
                                            <div class="row ">
                                                <div class="col-md-4 col-sm-4 col-xs-4 ">
                                                    <div class="exam-img">
                                                        <a href="<?= Url::to(['site/post', 'slug' => $value['slug']]) ?>"
                                                           rel="noopener noreferrer ">
                                                            <img class="img-post" src="<?= $value['avatar'] ?>"
                                                                 alt="Image ">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-8 ">
                                                    <a href="<?= Url::to(['site/post', 'slug' => $value['slug']]) ?>">
                                                        <h5><?= $value['title'] ?> </h5>
                                                    </a>
                                                    <div class="description">
                                                        <?= $value['describe'] ?>
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
                                <?= LinkPager::widget(['pagination' => FunctionHelper::get_post(0)['pages']]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->render('sidebar') ?>
            </div>
        </div>
    </div>
</div>
<style>
    .exam p {
        color: #b1b1b1;
    }

    .exam p:hover {
        color: inherit;
    }
</style>

