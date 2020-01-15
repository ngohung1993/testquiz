<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\LinksAsset;
use backend\assets\NestableAsset;
use common\helpers\FunctionHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */
/* @var $form yii\widgets\ActiveForm */

NestableAsset::register($this);
LinksAsset::register($this);

?>

<style>
    .widget-menu {
        margin-top: 0;
    }

    .dd-item button {
        margin-left: 0;
        margin-top: 10px;
    }

    .widget-title {
        border: 1px solid #ddd;
        border-top: none;
        cursor: pointer !important;
        font-weight: bold !important;
    }

    .widget-body {
        border-right: 1px solid #ddd;
        border-left: 1px solid #ddd;
    }

    .the-box ul li {
        list-style: none;
        margin: 15px 2px;
    }

    .the-box ul {
        min-height: 42px;
        max-height: 210px;
        overflow: auto;
    }

    .the-box .select-all {
        float: left;
        margin-top: 5px;
        font-size: 13px;
        text-decoration: underline;
    }

    .location-menu li {
        list-style: none;
        margin: 5px 0;
    }

    .theme-location-set {
        color: #72777c;
        font-size: 12px;
    }
</style>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <div class="note note-success">
        <p>
            Bạn đang chỉnh sửa phiên bản "<strong class="current_language_text">Tiếng Việt</strong>"
        </p>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="main-form">
                <div class="form-body">
                    <?= $form->field($model, 'title')->textInput(['placeholder' => 'Nhập tiêu đề tại đây'])->label('Tiêu đề') ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php if (!$model->isNewRecord): ?>
                <div class="row widget-menu">
                    <div class="col-md-4">
                        <div class="panel-group" id="accordion">
                            <div class="widget meta-boxes">
                                <a data-toggle="collapse" data-parent="#accordion" href="#custom-field-image"
                                   class="collapsed" aria-expanded="false">
                                    <h4 class="widget-title" style="margin-top: 0">
                                        <span>Danh mục</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="custom-field-image" class="panel-collapse collapse in" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box">
                                                <ul class="categories-selection">
                                                    <?php foreach (FunctionHelper::get_categories_by_parent_id() as $key => $value): ?>
                                                        <li>
                                                            <input title="" type="checkbox"
                                                                   data-title="<?= $value['title'] ?>"
                                                                   value="<?= $value['id'] ?>">
                                                            <?= $value['title'] ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <div class="text-right">
                                                    <a href="#" class="select-all">Chọn toàn bộ</a>
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary">
                                                        <span class="text">
                                                            <i class="fa fa-plus"></i>
                                                            Thêm vào menu
                                                        </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget meta-boxes">
                                <a data-toggle="collapse" data-parent="#accordion" href="#custom-field-checkbox"
                                   class="collapsed" aria-expanded="false">
                                    <h4 class="widget-title" style="margin-top: 0">
                                        <span>Thêm đường dẫn</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="custom-field-checkbox" class="panel-collapse collapse" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box">
                                                <div class="text-right">
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary">
                                                        <span class="text">
                                                            <i class="fa fa-plus"></i>
                                                            Thêm vào menu
                                                        </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="widget meta-boxes">
                            <div class="widget-title">
                                <h4>
                                    <span>Cấu trúc menu</span>
                                </h4>
                            </div>
                            <div class="widget-body">
                                <p style="font-size: 13px;line-height: 1.5;">
                                    Kéo các mục tới vị trí bạn mong muốn. Nhấp chuột vào
                                    <span class="fa fa-trash"></span> bên phải để xóa mục tùy chỉnh.
                                </p>
                                <div class="dd nestable-menu" id="tree-5aa383cc537d1">
                                    <?php FunctionHelper::show_links_nestable($model) ?>
                                    <?= $form->field($model, 'items')->hiddenInput(['id' => 'items'])->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div style="border-top: 1px solid #eee;"></div>
                        <div class="widget meta-boxes">
                            <div class="widget-title">
                                <h4>
                                    <span>Thiết lập menu</span>
                                </h4>
                            </div>
                            <div class="widget-body">
                                <p style="font-size: 13px;line-height: 1.5;">
                                    Vị trí hiện thị cho menu này
                                </p>
                                <ul class="location-menu">
                                    <?php foreach (FunctionHelper::get_location_menus() as $key => $value): ?>
                                        <li>
                                            <input <?= $model->id == $value['menus_id'] ? 'checked' : '' ?>
                                                    title="" type="checkbox" value="<?= $value['id'] ?>">
                                            <?= $value['title'] ?>
                                            <?php if ($value['menus']): ?>
                                                <span class="theme-location-set">
                                                    (Hiện tại: <?= $value['menus']['title'] ?>)
                                                </span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                    <?= $form->field($model, 'location_menus')->hiddenInput(['id' => 'location-menus'])->label(false) ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3 right-sidebar">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Xuất bản</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set" style="text-align: center;">
                        <button type="submit" class="btn btn-success tree-5aa383cc537d1-save">
                            <i class="fa fa-check-circle"></i> Lưu & Thoát
                        </button>
                        <a href="<?= Url::to(['page/index']) ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-close"></i> Hủy
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes">
                <div class="widget-title">
                    <h4><span>Trạng thái</span></h4>
                </div>
                <div class="widget-body">
                    <div class="misc-pub-section">
                        <div class="form-group">
                            <?= $form->field($model, 'status')->checkbox(['class' => 'minimal none-action'])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>