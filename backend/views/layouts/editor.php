<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use backend\assets\ThemeAsset;
use backend\assets\EditorAsset;
use backend\assets\NestableAsset;
use backend\assets\ComponentAsset;
use common\models\User;

/* @var $content string */
/* @var $this \yii\web\View */

ThemeAsset::register($this);
EditorAsset::register($this);
NestableAsset::register($this);
ComponentAsset::register($this);

$user = null;

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

$domain = str_replace('admin/../..', '', Url::to(['@domain'], true));

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html class="no-js" lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <style>
            .te-top-bar__branding {
                background: none;
            }

            .te-brand-link, .te-brand-logo {
                height: 100%;
                width: 100%;
                position: unset;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }

            .te-brand-link {
                font-size: 25px;
            }

            body {
                overflow-y: hidden;
            }
        </style>
    </head>
    <body class="body-theme-editor theme-editor sfe-next fresh-ui next-ui" id="theme-editor">
    <?php $this->beginBody() ?>

    <div class="ui-flash-container">
        <div class="ui-flash-wrapper" id="UIFlashWrapper">
            <div class="ui-flash ui-flash--nav-offset" id="UIFlashMessage"><p class="ui-flash__message"></p>
                <div class="ui-flash__close-button">
                    <button class="ui-button ui-button--transparent ui-button--icon-only ui-button-flash-close"
                            aria-label="Close message" type="button" name="button">
                        <svg class="next-icon next-icon--color-white next-icon--size-12">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#next-remove">
                                <svg id="next-remove" width="100%" height="100%">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                        <path d="M18.263 16l10.07-10.07c.625-.625.625-1.636 0-2.26s-1.638-.627-2.263 0L16 13.737 5.933 3.667c-.626-.624-1.637-.624-2.262 0s-.624 1.64 0 2.264L13.74 16 3.67 26.07c-.626.625-.626 1.636 0 2.26.312.313.722.47 1.13.47s.82-.157 1.132-.47l10.07-10.068 10.068 10.07c.312.31.722.468 1.13.468s.82-.157 1.132-.47c.626-.625.626-1.636 0-2.26L18.262 16z"></path>
                                    </svg>
                                </svg>
                            </use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <main class="theme-editor__wrapper">
        <div class="notifications">
            <div class="ajax-notification">
                <span class="ajax-notification-message"></span>
                <a class="close-notification">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <form id="form-settings-theme" method="post" novalidate="novalidate">
            <input type="hidden" name="theme_id" value="683264">
            <input type="hidden" name="current_section" value="-1">
        </form>

        <div id="theme-editor-sidebar">
            <div class="modal" data-tg-refresh="modal" id="modal_container" style="display: none;" aria-hidden="true"
                 aria-labelledby="ModalTitle" tabindex="-1"></div>
            <div class="modal-bg" data-tg-refresh="modal" id="modal_backdrop"></div>
            <form class="theme-editor__sidebar" id="theme-settings-form" autocomplete="off"
                  novalidate="novalidate">
                <section class="theme-editor__index">
                    <header class="te-top-bar">
                        <div class="te-top-bar__branding">
                            <a title="Về trang quản trị" class="te-brand-link" href="<?= Url::to(['site/index']) ?>">
                                <span class="fa fa-dashboard"></span>
                            </a>
                        </div>
                        <div class="te-top-bar__list">
                            <div class="te-top-bar__item te-top-bar__item--fill">
                                <span class="te-theme-name">
                                    Giao diện mặc định
                                </span>
                            </div>
                            <div class="te-top-bar__item te-status-indicator--live mobile-only">
                                Live
                            </div>
                        </div>
                    </header>
                    <div class="theme-editor__panel-body">
                        <div class="ui-stack ui-stack--vertical next-tab__panel--grow">
                            <div class="ui-stack-item ui-stack-item--fill">
                                <section class="next-card theme-editor__card">
                                    <?= $this->render('component/action-list') ?>
                                </section>
                                <hr class="theme-editor__panel-separator">
                                <div class="theme-editor__presets">
                                    <a href="<?= Url::to(['theme/index']) ?>" class="btn btn--full-width">
                                        Thiết lập mẫu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?= $this->render('component/panel') ?>

                </section>
                <div class="theme-editor__footer">
                    <div class="ui-stack ui-stack--wrap">
                        <div>
                            <div class="ui-stack-item ui-stack-item--fill">
                                <div class="dropup ui-popover__container">
                                    <button class="ui-button" type="button"
                                            onclick="editor.main.submit_setting_theme()">
                                        Xác nhận
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="ui-stack-item ui-stack-item--fill type--right action-setting-themes">
                            <button class="btn btn-danger" id="btn-remove-setting" type="button">
                                <span class="fa fa-check"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <section class="theme-editor__preview te-preview__container">
            <header class="te-context-bar">
                <div class="te-top-bar__branding desktop-only hide">
                    <a title="Navigate to themes" class="te-brand-link" href="<?= Url::to(['site/index']) ?>">
                        <svg class="ui-inline-svg te-brand-logo" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 36 42">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-sapo"></use>
                        </svg>
                    </a>
                </div>
                <div class="te-top-bar__list te-preview-context-bar__inner" data-bind-class="">
                    <div class="te-top-bar__item te-top-bar__item--fill te-top-bar__item--bleed">
                        <ul class="segmented te-top-bar__button te-viewport-selector desktop-only">
                            <li>
                                <button class="ui-button ui-button--transparent ui-button--icon-only is-selected"
                                        onclick="editor.main.change_theme_preview_mode(this)" data-preview="desktop"
                                        type="button" name="button">
                                    <span class="fa fa-desktop"></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="te-top-bar__item te-status-indicator--live desktop-only">
                        Live
                    </div>
                </div>
            </header>
            <div class="theme-editor__iframe-wrapper">
                <iframe id="theme-editor-frame" class="theme-editor__iframe"
                        src="<?= $domain ?>">
                </iframe>
            </div>
        </section>

        <div class="theme-editor__spinner">
            <div class="next-spinner">
                <svg class="next-icon next-icon--size-24">
                    <use xlink:href="#next-spinner"></use>
                </svg>
            </div>
        </div>
    </main>

    <?= $this->render('component/content-form') ?>

    <div>
        <div class="section-footer">
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>