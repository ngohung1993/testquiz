<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\assets\PostAsset;
use backend\assets\FancyboxAsset;
use backend\assets\EditorAsset;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $seo common\models\SeoTool */
/* @var $images common\models\Image */
/* @var $form yii\widgets\ActiveForm */

PostAsset::register($this);
FancyboxAsset::register($this);
EditorAsset::register($this);

?>

<style>
    .required:after {
        content: '';
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
            <div class="tabbable-custom tabbable-tabdrop">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="form-group">
                            <?= $form->field($model, 'title')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Nhập tiêu đề tại đây'
                            ])->label('Tiêu đề') ?>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <?= $form->field($model, 'link')->textInput()->label('Link lên kết box slide') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <?= $form->field($model, 'describe')->textarea(['id' => 'describe'])->label('Mô tả') ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="meta-box-sortables">
                <div id="gallery_wrap" class="widget meta-boxes">
                    <div class="widget-body">
                        <?= $form->field($model, 'content')->textarea(['id' => 'content'])->label('Nội dung') ?>
                    </div>
                </div>
            </div>

            <div class="meta-box-sortables">
                <div id="gallery_wrap" class="widget meta-boxes">
                    <div class="widget-title">
                        <h4><span>Thư viện ảnh</span></h4>
                    </div>
                    <div class="widget-body">
                        <input id="gallery-data" class="form-control" name="gallery" type="hidden">
                        <div>
                            <div class="list-photos-gallery">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="post-body-content"
                                             style="position: relative;padding: 10px 0;background: #fff;">
                                            <div>
                                                <div class="inside">
                                                    <div id="list-img-temp" class="thumbnails ui-sortable"
                                                         style="display: none">
                                                        <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                                            <div class="kv-file-content">
                                                                <img src="" class="kv-preview-data file-preview-image">
                                                            </div>
                                                            <div class="file-thumbnail-footer">
                                                                <div class="file-footer-caption">
                                                                    <span class="caption"></span>
                                                                </div>
                                                                <div class="file-upload-indicator">
                                                                </div>
                                                                <div class="file-actions">
                                                                    <div class="file-footer-buttons">
                                                                        <button type="button" <?= $model->isNewRecord ? '' : 'data-auto="1"' ?>
                                                                                class="kv-file-zoom btn btn-xs btn-default"
                                                                                onclick="deleteFile(event)">
                                                                            <i class="glyphicon glyphicon-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="list-img" class="thumbnails ui-sortable">
                                                        <?php if (isset($images)): foreach ($images as $key => $value): ?>
                                                            <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                                                <div class="kv-file-content">
                                                                    <img src="<?= $value['avatar'] ?>"
                                                                         class="kv-preview-data file-preview-image">
                                                                </div>
                                                                <div class="file-thumbnail-footer">
                                                                    <div class="file-footer-caption" title="">
                                                                        <a href="#" class="editable"
                                                                           data-name="image#title" data-type="text"
                                                                           data-pk="<?= $value['id'] ?>"
                                                                           data-title="Enter title"
                                                                           data-url="<?= Url::to(['ajax/edit-column']) ?>">
                                                                            <?= $value['title'] ?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="file-upload-indicator">
                                                                        <button type="button"
                                                                                class="btn btn-xs btn-default"
                                                                                data-toggle="modal"
                                                                                data-target="#content-image">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="file-actions">
                                                                        <div class="file-footer-buttons">
                                                                            <button type="button" <?= $model->isNewRecord ? '' : 'data-auto="1" data-id="' . $value['id'] . '"' ?>
                                                                                    class="btn btn-xs btn-default"
                                                                                    onclick="deleteFile(event)">
                                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; endif; ?>
                                                    </div>
                                                    <div class="spanButtonPlaceholder block-upload-item"
                                                         style="position: relative; overflow: hidden;margin: 10px;">
                                                        <p>(Click để tải ảnh<br> hoặc kéo thả ảnh vào đây)</p>
                                                        <?php if ($model->isNewRecord): ?>
                                                            <input class="kv-file-drop-zone" multiple="multiple"
                                                                   type="file" name="file">
                                                        <?php endif; ?>
                                                        <?php if (!$model->isNewRecord): ?>
                                                            <input data-auto="1" data-id="<?= $model['id'] ?>"
                                                                   data-column-parent-id="post_id"
                                                                   class="kv-file-drop-zone" multiple="multiple"
                                                                   type="file" name="file">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="droptext">
                                                        Đăng ảnh thật nhanh bằng cách kéo và thả ảnh vào khung.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="seo_wrap" class="widget meta-boxes">
                    <div class="widget-title">
                        <h4><span>Tối ưu hóa công cụ tìm kiếm (SEO)</span></h4>
                    </div>
                    <div class="widget-body">
                        <a href="javascript:void(0);" class="btn-trigger-show-seo-detail">
                            Chỉnh sửa
                        </a>
                        <div class="seo-preview">
                            <p class="default-seo-description">
                                Thiết lập tiêu đề và mô tả meta để làm cho trang web của bạn dễ dàng được phát hiện trên
                                các công cụ tìm kiếm như Google
                            </p>
                            <div class="existed-seo-meta">
                                <span class="page-title-seo">Tiêu đề</span>
                                <div class="page-url-seo ws-nm">
                                    <p>https://cms.botble.com</p>
                                </div>
                                <div class="page-description-seo ws-nm">Mô tả</div>
                            </div>
                        </div>
                        <div class="seo-edit-section">
                            <hr>
                            <div class="form-group">
                                <?= $form->field($seo, 'seo_title')->textInput() ?>
                                <small class="charcounter">(120 kí tự còn lại)</small>
                            </div>
                            <div class="form-group">
                                <?= $form->field($seo, 'meta_description')->textarea(['rows' => 2]) ?>
                                <small class="charcounter">(120 kí tự còn lại)</small>
                            </div>
                            <div class="form-group">
                                <?= $form->field($seo, 'meta_keywords')->textarea(['rows' => 2]) ?>
                                <small class="charcounter">(Phân cách các thẻ bằng dấu phẩy.)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 right-sidebar">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Xuất bản</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <button type="submit" class="btn btn-info" onclick="getImages()">
                            <i class="fa fa-save"></i> Lưu
                        </button>
                        <button type="submit" class="btn btn-success" onclick="getImages()">
                            <i class="fa fa-check-circle"></i> Lưu & Thoát
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-actions form-actions-fixed-top">
                <div class="btn-set">
                    <button type="submit" class="btn btn-info" onclick="getImages()">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <button type="submit" class="btn btn-success" onclick="getImages()">
                        <i class="fa fa-check-circle"></i> Lưu & Thoát
                    </button>
                </div>
            </div>
            <div class="widget meta-boxes">
                <div class="widget-title">
                    <h4><span>Cài đặt</span></h4>
                </div>
                <div class="widget-body">
                    <span>
                        <i class="fa fa-tags"></i> Danh mục
                    </span>
                    <div class="margin-top-10">
                        <?= $form->field($model, 'category_id')->dropDownList(
                            ArrayHelper::map(Category::find()->where([
                                '=',
                                'status',
                                1
                            ])->all(), 'id', 'title'),
                            [
                                'prompt' => '-- ' . Yii::t('backend', 'Select category') . ' --',
                            ]
                        )->label(false) ?>
                    </div>
                    <div class="misc-pub-section">
                        <div class="form-group">
                            <?= $form->field($model, 'status')->checkbox(['class' => 'minimal none-action'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'display_homepage')->checkbox(['class' => 'minimal none-action'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'featured')->checkbox(['class' => 'minimal none-action'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'images')->hiddenInput(['id' => 'images'])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes">
                <div class="widget-title">
                    <h4><span>Hình ảnh</span></h4>
                </div>
                <div class="widget-body">
                    <div class="image-box">
                        <div class="image-box-actions">
                            <div class="inside">
                                <img style="width: 100%;"
                                     src="<?= !$model->avatar ? '/uploads/cms/img/placeholder.png' : $model->avatar ?>"
                                     class="fieldID attachment-266x266 size-266x266" alt="">
                                <?= $form->field($model, 'avatar')->hiddenInput([
                                    'id' => 'fieldID',
                                    'value' => $model->avatar
                                ])->label(false) ?>
                                <a href="/uploads/library/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1"
                                   style="<?= $model->avatar ? 'display: none;' : '' ?>"
                                   class="thumbnail-fieldID frame-btn">Đặt ảnh dại diện</a>
                                <a href="javascript:void(0)" style="<?= $model->avatar ? '' : 'display: none;' ?>"
                                   class="remove-thumbnail-fieldID" onclick="remove_thumbnail('fieldID')">
                                    Xóa ảnh đại diện
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
