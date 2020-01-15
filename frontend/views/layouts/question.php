<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ProfileAsset;
use common\helpers\FunctionHelper;

/* @var $this View */
/* @var $content string */

ProfileAsset::register($this);
$favicon = FunctionHelper::get_general_information()['favicon'];
$logo = FunctionHelper::get_general_information()['logo'];
$user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=0"/>
        <link rel="icon" href="<?= $favicon ?>" type="image/x-icon">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            body {
                background-color: #f8f8f8;
            }

            .header .topnav .user-info .user-name {
                display: inline-block;
                margin-left: 5px;
            }

            .signed-one-fa {
                font-size: 19px;
                color: rgba(0, 0, 0, .3);
            }

            .nav-top:after {
                right: 16px;
            }

            .nav-top li:hover {
                background-color: #f5f5f5;
            }

            .nav-top .bd-bt-1:hover {
                background: #fff;
            }

            .nav-top li a {
                color: #888;
            }

            .nav-top li a:hover {
                color: #888;
            }

            .nav-top:after {
                top: -9px;
            }

            .nav-top li span.pull-right {
                margin: 10px 10px 0 0;
            }

            .header-logo {
                padding: 0;
            }

            .header .topnav {
                top: -10px;
            }

            .header .container {
                padding: 0;
            }

            .logo a {
                margin-left: 0;
            }

            .ad_user_menu_left li a {
                padding: 12px 0 10px 0;
            }

            .ad_user_menu_left li a span {
                margin: 0 20px;
            }

            .top_doc_type ul {
                margin: 8px 0 0 15px;
            }

            .top_doc_type .search_md {
                right: 60px;
                top: 0;
            }

            .tp-coin {
                background: url(/uploads/cms/img/coin-30.png) no-repeat;
                background-size: auto 100%;
                padding-left: 25px;
                margin-left: 5px;
            }

            .profile-follow .btn {
                padding: 2px 12px;
            }

            .profile-follow .btn-primary {
                border-color: #1fb6ff;
                background-color: #1fb6ff;
            }

            a.bcoin {
                font-size: 14px;
                color: #2f70dc !important;
                font-weight: bold;
            }

            .signed-st-head .media-body p {
                font-size: 12px;
                color: #888;
                margin-bottom: 0;
            }

            .mt-5 {
                padding-left: 10px;
            }

            @media (max-width: 768px) {
                .ad_user_list_view {
                    top: 65px !important;
                    left: 20% !important;
                    right: unset !important;
                }
            }

            .nav-top li a {
                color: #888888;
                font-size: 14px;
            }

            .nav-top li a {
                padding: 0;
            }

            .nav-top li a {
                padding-left: 10px;
            }

            .nav-top li span.pull-right {
                font-size: 13px;
            }

            .profile-follow {
                float: none;
            }
        </style>
    </head>
    <body style="padding: 0">
    <?php $this->beginBody() ?>
    <div id="container" style="padding-top: 60px">
        <div class="box-header">
            <div class="header">
                <div class="container">
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <div class="box-logo" style="margin-top: -10px;">
                                    <a href="/">
                                        <img src="<?= $logo ?>"
                                             style="height: 56px;" class="img-responsive" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-4" style="text-align: end;">

                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-2" style="text-align: end;">
                                <div class="box-login">
                                    <?php if ($user): ?>
                                        <a href="<?= Url::to(['profile/introduce']) ?>">
                                            <img src="<?= $user->getAvatar() ?>" alt="avatar"
                                                 style="width: 100%;border-radius: 50%">
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= Url::to(['site/login']) ?>">
                                            <button class="btn btn-default" type="button">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 ">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input id="search" type="text" class="form-control"
                                                   placeholder="Nhập từ khóa tìm kiếm ">
                                            <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="searchIndex()">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 hidden-xs" style="text-align: center;">
                                <div class="box-create-topic">
                                    <a href="<?= Url::to(['exam/create']) ?>">
                                        <button class="btn btn-default" type="button"><span>Tạo đề</span></button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 hidden-xs" style="text-align: end;padding: 0;">
                                <?php if (!$user) { ?>
                                    <div class="box-login">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="<?= Url::to(['site/login']) ?>">
                                                Đăng Nhập
                                            </a>
                                        </button>
                                    </div>
                                <?php } else { ?>
                                    <div class="topnav">
                                        <a href="<?= Url::to(['profile/introduce']) ?>" class="user-info">
                                        <span class="user-avatar">
                                <img style="border-radius: 50%!important;" src="<?= $user->getAvatar() ?>" alt="">
                            </span>
                                            <span class="user-name profile">
                                        <i class="fa fa-bell signed-one-fa" style="font-size: 18px"></i>
                                    </span>
                                        </a>
                                        <ul class="nav-top">
                                            <li class="bd-bt-1">
                                                <div class="media signed-st-head">
                                                    <div class="media-left">
                                                        <img src="<?= $user->getAvatar() ?>"
                                                             class="media-object img-rounded"
                                                             style="width:60px ; height: 60px" alt="">
                                                    </div>
                                                    <div class="media-body">
                                                        <a style="text-decoration: none!important;"
                                                           href="<?= Url::to(['profile/introduce']) ?>">
                                                            <?= $user['name'] ?>
                                                        </a>
                                                        <p class="mt-5">STK-ID: <?= $user['code'] ?></p>
                                                        <a href="<?= Url::to(['finance/index']) ?>" class="bcoin"
                                                           title="Xem chi tiết tài khoảnn / Nạp tiền">
                                                            <?= number_format($user['wallet'], '0', ',', '.') ?>
                                                            đ
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="border-bot">
                                                <a href="<?= Url::to(['topic/index']) ?>">
                                                    Chủ đề đã tạo
                                                </a>
                                            </li>
                                            <li class="border-bot">
                                                <a href="<?= Url::to(['exam/index']) ?>">
                                                    Đề thi đã tạo
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= Url::to(['exam/bought']) ?>">
                                                    Đề thi đã mua
                                                </a>
                                            </li>
                                            <li class="border-bot">
                                                <a href="<?= Url::to(['profile/information']) ?>">
                                                    <span class="pull-right fa fa-user" style="color: #888"></span>
                                                    Thông tin cá nhân
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= Url::to(['message/index']) ?>">
                                            <span class="pull-right fa fa-bell signed-one-fa"
                                                  style="color: #888"></span>
                                                    Thông báo
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= Url::to(['site/logout']) ?>">
                                                    Đăng xuất
                                                    <span class="pull-right fa fa fa-sign-out" aria-hidden="true"
                                                          style="color: #888"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="ad_user" style="background: #1fb6ff url('/theme/images/bg_tab.png') repeat-x;"></div>
            <div class="ad_user_menu" style="height: 75px">
                <div class="ad_user_parent_top">
                    <h3 class="ad_user_name" style="padding-top: 0;margin-top: 4px">
                        <?= $user['name'] ?>
                        <div class="profile-follow">
                            <a href="<?= Url::to(['trans/index']) ?>" target="_blank" class="btn btn-primary btn-follow"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="Xem lịch sử giao dịch">
                                <strong class="tp-coin">
                                    <?= number_format($user->wallet, 0, ',', '.') ?>
                                </strong> đ
                            </a>
                            <a href="<?= Url::to(['finance/recharge']) ?>" target="_blank" class="btn btn-default"
                               data-toggle="tooltip" data-placement="top" title="" data-original-title="Nạp tiền">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </h3>
                    <div class="ad_user_list_view">
                        <ul>
                            <li>
                                <span class="ad_user_title">Tổng lượt mua</span>
                                <span class="ad_user_number"
                                      style="color: red"> <?= FunctionHelper::countExamBuy($user->id) ?></span>
                            </li>
                            <li>
                                <span class="ad_user_title">Tổng đề thi</span>
                                <span class="ad_user_number"
                                      style="color: red"> <?= FunctionHelper::countExamUser($user->id) ?></span>
                            </li>
                            <li>
                                <span class="ad_user_title">Tổng chủ đề</span>
                                <span class="ad_user_number"
                                      style="color: red"> <?= FunctionHelper::countTopicUser($user->id) ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ad_user_content">
                <div class="ad_user_side_left left_info">
                    <div class="ad_user_avatar_small">
                        <img id="class_avatar_img"
                             src="<?= $user->getAvatar() ?>"
                             class="class-avatar img-responsive" alt="Image" width="220" height="100">
                        <a class="absolute block" id="upload_avatar_button" href="javascript:void(0)">
                            <i class="fa fa-camera" title="Thay đổi ảnh cá nhân"
                               style="position: relative; top: -20px;left: 7px;color: #f5f5f5;"></i>
                        </a>
                        <div id="cropContainerModal" style="display: none;">
                            <div class="cropControls cropControlsUpload"></div>
                            <input type="file" name="img" id="cropContainerModal_imgUploadField">
                            <input type="hidden" id="user-avatar">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div>
            <?= $content ?>
        </div>
    </div>
    <style>
        .media-left {
            display: table-cell;
            vertical-align: top;
            padding-right: 10px;
        }

        @media (min-width: 768px) {
            .signed-st-head {
                margin: 10px !important;
            }

            .media-body {
                display: table-cell;
                vertical-align: top;
                line-height: 20px;
                padding-left: 5px;
            }

            .nav-top {
                width: 220px;
            }

            .btn_yellow {
                background-color: #fa0;
                padding: 5px !important;
                color: #fff !important;
                text-align: center;
                font-size: 15px !important;
            }

            .nav-top li a {
                padding-left: 10px;
            }
        }

        .nav-tabs > li {
            float: none;
        }

        .menu .active {
            background-color: #1fb6ff;
        }

        .menu .active a {
            background-color: #1fb6ff !important;
            color: #fff !important;
            text-decoration: none;
        }

        #upload_avatar_button i:hover {
            cursor: pointer;
            background-color: #333;
        }

        .breadcrumb-primary > li + li:before {
            content: "\f105";
            font-family: FontAwesome, serif;
            padding: 0 8px;
        }

        .nav-tabs > li > a {
            margin-right: 0 !important;
        }

        a {
            text-decoration: none !important;
        }

        input[type=checkbox]:focus, input[type=file]:focus, input[type=radio]:focus {
            outline: none;
            outline-offset: unset;
        }

        .ps-btn {
            background-color: rgba(0, 0, 0, .6);
            padding: 0 12px;
            color: #fff;
            border: 0;
            font-size: 12px;
            line-height: 30px;
            border-radius: 3px;
            opacity: .6;
            font-weight: 500;
        }

        .edit-link-cover-photo:hover {
            background: rgba(0, 0, 0, .8);
        }
    </style>
    <?php $this->endBody() ?>
    <script>
        let BASE_URL = "<?= Yii::$app->getHomeUrl() ?>";

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        let url = window.location.href;
        let origin = window.location.origin;

        url = url.substring(0, (url.indexOf("#") === -1) ? url.length : url.indexOf("#"));
        url = url.substring(0, (url.indexOf("?") === -1) ? url.length : url.indexOf("?"));

        console.log(url);

        $('.menu li').each(function () {
            let href = $(this).find('a').attr('href');

            if (url === (origin + href)) {
                $(this).addClass('active');
            }
        });
    </script>
    </body>
    </html>
<?php $this->endPage() ?>