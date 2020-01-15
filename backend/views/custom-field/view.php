<?php

use yii\helpers\Url;
use backend\assets\NestableAsset;
use backend\assets\ComponentAsset;
use common\helpers\FunctionHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Component */

NestableAsset::register($this);
ComponentAsset::register($this);

$this->title = $model->title;

?>

<style>
    .widget-menu {
        margin-top: 0;
    }

    .dd-item button {
        margin-left: 0;
        margin-top: 10px;
    }

    #accordion .meta-boxes {
        margin-bottom: 20px;
    }

    .next-label {
        color: #000 !important;
        font-size: 13px !important;
    }
</style>

<div class="page-content-wrapper">
    <div class="page-content " style="min-height: 986px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="<?= Url::to(['custom-field/index']) ?>">Thành phần</a></li>
            <li class="breadcrumb-item active"><?= $this->title ?></li>
        </ol>
        <div class="clearfix"></div>
        <div class="note note-success">
            <p>
                Bạn đang chỉnh sửa phiên bản "<strong class="current_language_text">Tiếng Việt</strong>"
            </p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row widget-menu">
                    <div class="col-md-4">
                        <div class="panel-group" id="accordion">
                            <div class="widget meta-boxes">
                                <a data-toggle="collapse" class="collapsed">
                                    <h4 class="widget-title" style="margin-top: 0;font-size: 14px;font-weight: 700;">
                                        <span>Custom filed</span>
                                    </h4>
                                </a>
                            </div>
                            <div class="widget meta-boxes">
                                <a data-toggle="collapse" data-parent="#accordion" href="#custom-field-image"
                                   class="collapsed" aria-expanded="false">
                                    <h4 class="widget-title" style="margin-top: 0">
                                        <span>Hình ảnh</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="custom-field-image" class="panel-collapse collapse" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box">
                                                <div class="theme-setting theme-setting--checkbox">
                                                    <div class="next-input-wrapper">
                                                        <div class="checkbox" id="setting-checkbox-favicon-enable">
                                                            <label class="next-label next-label--switch">
                                                                <input checked style="margin-right: 12px;" title=""
                                                                       type="checkbox" class="minimal">
                                                                Dùng favicon
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="theme-setting theme-setting--image">
                                                    <label class="next-label" for="setting-logo_png">
                                                        Favicon
                                                    </label>
                                                    <div class="next-grid next-grid--no-padding next-grid--vertically-centered"
                                                         style="margin: 5px 0;">
                                                        <div class="next-grid__cell theme-setting__image-preview">
                                                            <div class="next-grid next-grid--no-padding next-grid--center-aligned next-grid--vertically-centered theme-setting__image-wrapper">
                                                                <div class="next-grid__cell next-grid__cell--no-flex">
                                                                    <img src="/uploads/cms/img/favicon.ico"
                                                                         style="width:28px;height: 28px;"
                                                                         id="img-setting-favicon-png">
                                                                    <button class="btn btn--plain btn-replace-image"
                                                                            style="background: none;color: blue;"
                                                                            type="button" name="button">
                                                                        <span class="fa fa-sign-out"></span>
                                                                        <span class="next-icon__text">Thay thế</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="next-input__help-text" style="font-size: 13px;">
                                                        Đề nghị 16 x 16px .png
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary">
                                                            <span class="text">
                                                                <i class="fa fa-plus"></i>
                                                                Thêm vào trình đơn
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
                                        <span>Kích hoạt</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="custom-field-checkbox" class="panel-collapse collapse" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box">
                                                <div class="theme-setting theme-setting--checkbox">
                                                    <div class="next-input-wrapper">
                                                        <div class="checkbox" id="setting-checkbox-favicon-enable">
                                                            <label class="next-label next-label--switch">
                                                                <input checked style="margin-right: 12px;" title=""
                                                                       type="checkbox" class="minimal">
                                                                Dùng favicon
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary">
                                                            <span class="text">
                                                                <i class="fa fa-plus"></i>
                                                                Thêm vào trình đơn
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
                                <a data-toggle="collapse" data-parent="#accordion" href="#custom-field-text-field"
                                   class="collapsed" aria-expanded="false">
                                    <h4 class="widget-title" style="margin-top: 0">
                                        <span>Nhập giá trị</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="custom-field-text-field" class="panel-collapse collapse" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box">
                                                <div class="theme-setting theme-setting--text" style="margin: 10px 0;">
                                                    <label class="next-label" for="setting-email">
                                                        Email
                                                    </label>
                                                    <input title="" type="text" class="next-input" value="">
                                                </div>
                                                <div class="text-right">
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary">
                                                            <span class="text">
                                                                <i class="fa fa-plus"></i>
                                                                Thêm vào trình đơn
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
                                <a data-toggle="collapse" data-parent="#accordion" href="#custom-field-text-area"
                                   class="collapsed" aria-expanded="false">
                                    <h4 class="widget-title" style="margin-top: 0;">
                                        <span>Nhập văn bản</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="custom-field-text-area" class="panel-collapse collapse" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box">
                                                <div class="theme-setting theme-setting--text" style="margin: 10px 0;">
                                                    <label class="next-label" for="setting-email">
                                                        Địa chỉ
                                                    </label>
                                                    <textarea class="next-input" title="" name="" id="" cols="30"
                                                              rows="3"></textarea>
                                                </div>
                                                <div class="text-right">
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary">
                                                            <span class="text">
                                                                <i class="fa fa-plus"></i>
                                                                Thêm vào trình đơn
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
                                <a data-toggle="collapse" data-parent="#accordion" href="#section"
                                   class="collapsed" aria-expanded="false">
                                    <h4 class="widget-title" style="margin-top: 0;">
                                        <span>Section</span>
                                        <i class="fa fa-angle-down narrow-icon"></i>
                                    </h4>
                                </a>
                                <div id="section" class="panel-collapse collapse" style="">
                                    <div class="widget-body">
                                        <div class="box-links-for-menu">
                                            <div class="the-box" data-field="section">
                                                <div class="theme-setting theme-setting--checkbox">
                                                    <div class="next-input-wrapper">
                                                        <div class="checkbox" id="setting-checkbox-favicon-enable">
                                                            <label class="next-label next-label--switch">
                                                                <input checked style="margin-right: 12px;" title=""
                                                                       type="checkbox" class="minimal">
                                                                Hiển thị phần này
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="theme-setting theme-setting--image">
                                                    <label class="next-label" for="setting-logo_png">
                                                        Ảnh đại diện
                                                    </label>
                                                    <div class="next-grid next-grid--no-padding next-grid--vertically-centered"
                                                         style="margin: 5px 0;">
                                                        <div class="next-grid__cell theme-setting__image-preview">
                                                            <div class="next-grid next-grid--no-padding next-grid--center-aligned next-grid--vertically-centered theme-setting__image-wrapper">
                                                                <div class="next-grid__cell next-grid__cell--no-flex">
                                                                    <img src="/uploads/cms/img/favicon.ico"
                                                                         style="width:28px;height: 28px;"
                                                                         id="img-setting-favicon-png">
                                                                    <button class="btn btn--plain btn-replace-image"
                                                                            style="background: none;color: blue;"
                                                                            type="button" name="button">
                                                                        <span class="fa fa-sign-out"></span>
                                                                        <span class="next-icon__text">Thay thế</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="next-input__help-text" style="font-size: 13px;">
                                                        Đề nghị 16 x 16px .png
                                                    </p>
                                                </div>
                                                <div class="theme-setting theme-setting--text" style="margin: 10px 0;">
                                                    <label class="next-label" for="setting-email">
                                                        Tiêu đề
                                                    </label>
                                                    <input title="" type="text" class="next-input" value="">
                                                </div>
                                                <div class="theme-setting theme-setting--text" style="margin: 10px 0;">
                                                    <label class="next-label" for="setting-email">
                                                        Mô tả
                                                    </label>
                                                    <textarea class="next-input" title="" name="" id="" cols="30"
                                                              rows="3"></textarea>
                                                </div>
                                                <div class="theme-setting theme-setting--text" style="margin: 10px 0;">
                                                    <label class="next-label" for="setting-email">
                                                        Nội dung
                                                    </label>
                                                    <div data-image-actions=""
                                                         style="display:block;text-align: center;">
                                                        <a href=""
                                                           style="background: #fff!important;-webkit-appearance: none;"
                                                           class="btn btn--plain btn-replace-image" data-toggle="modal"
                                                           data-target="#content-form" type="button" name="button">
                                                            <span class="fa fa-edit"></span>
                                                            <span class="next-icon__text">Chỉnh sửa nội dung</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="btn-group btn-group-devided">
                                                        <a href="#"
                                                           class="btn-add-to-menu btn btn-primary">
                                                            <span class="text">
                                                                <i class="fa fa-plus"></i>
                                                                Thêm vào trình đơn
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
                                    <span><?= $this->title ?></span>
                                </h4>
                            </div>
                            <div class="widget-body">
                                <div class="box-header" style="padding: 0;">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm tree-5aa383cc537d1-tree-tools"
                                           data-action="expand">
                                            <i class="fa fa-plus-square-o"></i>
                                            Mở rộng
                                        </a>
                                        <a class="btn btn-primary btn-sm tree-5aa383cc537d1-tree-tools"
                                           data-action="collapse">
                                            <i class="fa fa-minus-square-o"></i>
                                            Thu gọn
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-sm tree-5aa383cc537d1-save"
                                           data-parent-id="<?= $model['id'] ?>">
                                            <i class="fa fa-save"></i>
                                            Lưu và làm mới
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="<?= Url::to(['component/create']) ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-refresh"></i>
                                            Làm mới
                                        </a>
                                    </div>
                                </div>
                                <div class="dd nestable-menu" id="tree-5aa383cc537d1">
                                    <?php FunctionHelper::show_custom_fields_nestable(FunctionHelper::get_custom_fields(), $model->id) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-confirm-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title"><i class="til_img"></i><strong>Confirm delete</strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body with-padding">
                        <div>Do you really want to delete this record?</div>
                    </div>

                    <div class="modal-footer">
                        <button class="float-left btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button class="float-right btn btn-danger delete-crud-entry">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
        <div class="modal fade delete-many-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title"><i class="til_img"></i><strong>Confirm delete</strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body with-padding">
                        <div>Do you really want to delete selected record(s)?</div>
                    </div>

                    <div class="modal-footer">
                        <button class="float-left btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button class="float-right btn btn-danger delete-many-entry-button">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
        <div class="modal fade modal-bulk-change-items" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title"><i class="til_img"></i><strong>Bulk changes</strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body with-padding">
                        <div>
                            <div class="modal-bulk-change-content"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="float-left btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button class="float-right btn btn-info confirm-bulk-change-button"
                                data-load-url="https://cms.botble.com/tables/bulk-change/data">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
        <div class="page-footer">
            <div class="page-footer-inner">
                <div class="row">
                    <div class="col-md-6">
                        Copyright 2018 © Botble Technologies. Version: <span>3.3</span>
                    </div>
                    <div class="col-md-6 text-right">
                        Page loaded in 0.71s
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>