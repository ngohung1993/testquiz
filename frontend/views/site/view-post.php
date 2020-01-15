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

/** @var $post \common\models\Post */

$this->title = $post['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $post['seoTool']['meta_description']
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $post['seoTool']['meta_keywords']
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'website'
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $post['seoTool']['seo_title']
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $post['seoTool']['meta_description']
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $post['avatar']
]);

?>
<div class="container">
    <div class="row">
        <div class="clearfix" style="margin-top:10px;">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8" style="background: #fff">
                <div class="clear"></div>
                <style>
                    .detail_c {
                        font-size: 14px;
                        line-height: 22px
                    }

                    .detail_c img {
                        max-width: 100%
                    }

                    .sidebar {
                        margin-top: 0 !important;
                    }
                </style>
                <div class="articles_detail" style="margin-top: 30px">
                    <h1 style="font-size: 20px"><?= $post['title'] ?></h1>
                    <div class="mt-10" style="margin-bottom: 10px; display: inline-block;">
                        <div class="fb-like pull-left fb_iframe_widget" style="margin-top:10px;"
                             data-href="" data-layout="button_count" data-action="like" data-show-faces="false"
                             data-share="yes"
                             fb-xfbml-state="rendered"
                             fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=0&amp;href=https%3A%2F%2Fexam.bigschool.vn%2Fexam.html%3Fcmd%3Ddetail%26id%3D88934&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=false">
                        <span style="vertical-align: bottom; width: 122px; height: 20px;">
                           <iframe src="https://www.facebook.com/plugins/like.php?href=<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId=304036757051650"
                                   width="450" height="80" style="border:none;overflow:hidden" scrolling="no"
                                   frameborder="0" allowTransparency="true" allow="encrypted-media">
                           </iframe>
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>&layout=button_count&size=small&appId=304036757051650&width=111&height=20"
                                    width="111" height="20" style="border:none;overflow:hidden" scrolling="no"
                                    frameborder="0" allowTransparency="true" allow="encrypted-media">
                            </iframe>
                        </span>
                        </div>
                    </div>
                </div>
                <p style="color:#999">
                    <span>Ngày đăng:<?= date('d/m/Y', $post['created_at']) ?></span>
                </p>
                <div class="detail_c">
                    <?= $post['content'] ?>
                </div>
                <div class="articles_other">
                    <h3>Bài viết liên quan: </h3>
                    <ul style="list-style:none; line-height:20px">
                        <?php foreach (FunctionHelper::get_post_by_category_slug($post['category']['slug'], 10) as $key => $value): ?>
                            <li>•
                                <a href="<?= $value->getLink() ?>"
                                   title="<?= $value['title'] ?>">
                                    <?= $value['title'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?= $this->render('sidebar') ?>
        </div>
    </div>
</div>
<style>
    @media (max-width: 768px) {
        .cleft {
            width: 100%;
            float: none;
        }

        .content-mobile {
            margin-top: 60px;
        }
    }
</style>

