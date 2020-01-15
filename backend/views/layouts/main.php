<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use backend\assets\CmsAsset;
use common\models\User;
use common\models\Message;
use common\helpers\FunctionHelper;

/* @var $this \yii\web\View */
/* @var $content string */

CmsAsset::register($this);

$user = null;
$count_messages = Message::find()->where(['status'=> 0])->andWhere(['type'=> Message::SEND_ADMIN])->count();
if (!Yii::$app->user->isGuest) {
    try {
        $user = findModel(Yii::$app->user->identity->getId());
    } catch (NotFoundHttpException $e) {
    }
}

/**
 * @param $id
 *
 * @return User|null
 * @throws NotFoundHttpException
 */
function findModel($id)
{
    if (($model = User::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="pace-done">
    <?php $this->beginBody() ?>
    <div class="pace loading" style="display: none;">
        <div class="pace-progress" data-progress-text="100%" data-progress="99"
             style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <div class="page-wrapper new-style-theme-wrapper">
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header page-logo">
                <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>">
                    <span>TIGER</span>CMS 2.0
                </a>
                <div class="sidebar-toggle menu-toggler responsive-toggler visible-xs" data-toggle="collapse"
                     data-target=".navbar-collapse">
                    <span></span>
                </div>
                <div class="sidebar-toggle menu-toggler hidden-xs">
                    <span></span>
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
                <li class="dropdown">
                    <a class="dropdown-toggle dropdown-header-name" style="padding-right: 10px"
                       href="<?= Url::to(['@domain'], true) ?>" target="_blank">
                        <i class="fa fa-globe"></i>
                        <span class="hidden-xs">Xem website</span>
                    </a>
                </li>
<!--                <li class="language dropdown">-->
<!--                    <a href="javascript:void(0);" class="dropdown-toggle dropdown-header-name" data-toggle="dropdown"-->
<!--                       data-hover="dropdown" data-close-others="true">-->
<!--                        <img src="/uploads/cms/img/vn.png" title="Tiếng Việt" alt="Tiếng Việt">-->
<!--                        <span class="hidden-xs">Tiếng Việt</span>-->
<!--                        <i class="fa fa-angle-down"></i>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu dropdown-menu-right icons-right">-->
<!--                        <li class="active">-->
<!--                            <a href="--><?//= Url::to(['site/index']) ?><!--">-->
<!--                                <img src="/uploads/cms/img/us.png" title="English" alt="English">-->
<!--                                <span>English</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?//= Url::to(['site/index']) ?><!--">-->
<!--                                <img src="/uploads/cms/img/vn.png" title="Tiếng Việt" alt="Tiếng Việt">-->
<!--                                <span>Tiếng Việt</span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="<?= Url::to(['message/index']) ?>" class="dropdown-toggle"
                       data-close-others="true" aria-expanded="false" style="margin-left: 8px;">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span class="badge badge-default number-message"><?=$count_messages?></span>
                    </a>
                    <ul class="dropdown-menu">

                    </ul>
                </li>
                <li class="dropdown dropdown-user" style="margin-right: 20px;">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img class="img-circle" src="/uploads/cms/img/default-avatar.jpg">
                        <span class="username username-hide-on-mobile">
                            <?= $user['name'] ?>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= Url::to(['site/profile']) ?>">
                                <i class="icon-user"></i>
                                Thông tin cá nhân
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['site/logout']) ?>" class="btn-logout">
                                <i class="icon-key"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="page-container col-md-12">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <div class="sidebar">
                        <div class="sidebar-content animated fadeIn" style="display: block;">
                            <ul class="page-sidebar-menu page-header-fixed navigation" data-keep-expanded="true"
                                data-auto-scroll="true" data-slide-speed="200">
                                <?php FunctionHelper::show_utilities_menu(FunctionHelper::get_utilities_by_parent_id($user['permission'])) ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content-wrapper">
                <?= $content ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <script>
        let base = "<?= Yii::$app->getHomeUrl() ?>";
        console.log(base);
    </script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>