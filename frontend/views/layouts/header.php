<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;

$user = Yii::$app->user->identity;
$logo = FunctionHelper::get_general_information()['logo'];
?>
<div class="box-header">
    <div class="header">
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="box-logo" style="margin-top: -10px;">
                        <a href="/">
                            <img src="<?= $logo ?>"
                                 style="height: 56px;" class="img-responsive" alt="Image">
                        </a>
                    </div>
                </div>
                <div class="hidden-lg hidden-md hidden-sm col-xs-6" style="text-align: end;">
                    <div class="pull-right">
                        <div class="box-login">
                            <?php if ($user): ?>
                                <a href="<?= Url::to(['profile/introduce']) ?>">
                                    <img src="<?= $user->getAvatar() ?>" alt="avatar"
                                         style="width: 40px;height:40px;border-radius: 50%">
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
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input id="search" type="text" class="form-control"
                                       placeholder="Nhập đề thi cần tìm kiếm ">
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
                                <a href="<?= Url::to(['site/login']) ?>" style="color: inherit">
                                    Đăng Nhập
                                </a>
                            </button>
                        </div>
                    <?php } else { ?>
                        <div class="topnav">
                            <a href="<?= Url::to(['profile/introduce']) ?>" class="user-info">
                                        <span class="user-avatar">
                                <img style="border-radius: 50%!important;" src="<?= $user->getAvatar() ?>" alt="avatar">
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
    <div class="box-menu">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default box-menu-list" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu-list" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left menu-font-size">
                            <?php foreach (FunctionHelper::get_categories_by_parent_id(null, 0) as $key => $value): ?>
                                <li>
                                    <a href="<?= Url::to(['site/category', 'slug' => $value['slug']]) ?>">
                                        <span><?= $value['title'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li class="hidden-sm hidden-md hidden-lg" style="border-top: 1px solid #ccc">
                                <?php if (!$user) { ?>
                                    <a style="font-size: 16px;text-decoration: none;color: #fff"
                                       href="<?= Url::to(['site/login']) ?>">Đăng nhập</a>
                                <?php } else { ?>
                                    <a style="font-size: 16px;text-decoration: none;"
                                       href="<?= Url::to(['profile/introduce']) ?>">
                                        Trang cá nhân
                                    </a>
                                    <a style="font-size: 16px;text-decoration: none;"
                                       href="<?= Url::to(['site/logout']) ?>">
                                        Đăng Xuất
                                    </a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<script>
    $('#search').on('keypress', function (e) {
        if (e.which == 13) {
            searchIndex();
        }
    });
    let searchIndex = function () {
        let keyword = $('#search').val();
        location.href = '/site/index?keyword=' + keyword;
    }
    let pathname = window.location.pathname;
    $("ul li a").each(function () {
        if (pathname === $(this).attr('href')) {
            $(this).addClass('active');
        }
    });
</script>