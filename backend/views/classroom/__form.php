<?php

use backend\assets\EditorAsset;
use backend\assets\FancyboxAsset;
use backend\assets\NestableAsset;
use common\models\Classroom;
use common\models\Subject;
use yii\widgets\ActiveForm;

EditorAsset::register($this);
FancyboxAsset::register($this);
NestableAsset::register($this)

/* @var $this yii\web\View */
/* @var $subjects Subject */
/* @var $model Classroom */
/** @var  $classroomDetailTopic */
/* @var $form yii\widgets\ActiveForm */
/* @var $classroomDetails array ClassroomDetail */

?>

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
                            ])->label('Tên lớp') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn môn thi theo lớp</label>
                            <div class="row">
                                <?php foreach ($subjects as $key => $value): ?>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <label for="subjects"></label>
                                            <input type="checkbox" class="custom-control-input"
                                                   name="subjects[]"
                                                   value="<?= $value->id ?>" <?= in_array($value->id, $classroomDetails) ? 'checked' : '' ?>
                                                <?= in_array($value->id, $classroomDetailTopic) ? 'disabled="disabled"' : '' ?> >
                                            <label style="font-weight: 500;" class="custom-control-label">
                                                <?= $value->title ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'description')->textarea(['id' => 'describe'])->label('Mô tả') ?>
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
                            Thiết lập tiêu đề và mô tả để website của bạn dễ dàng được phát hiện trên
                            các công cụ tìm kiếm như Google
                        </p>
                    </div>
                    <div class="seo-edit-section">
                        <hr>
                        <div class="form-group parent">
                            <?= $form->field($seo, 'seo_title')->textInput([
                                'class' => 'form-control counter',
                                'data-counter' => 120
                            ]) ?>
                            <small class="charcounter">(120 kí tự còn lại)</small>
                        </div>
                        <div class="form-group parent">
                            <?= $form->field($seo, 'meta_description')->textarea([
                                'rows' => 2,
                                'class' => 'form-control counter',
                                'data-counter' => 120
                            ]) ?>
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
        <div class="col-md-3 right-sidebar">
            <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                <div class="widget-title">
                    <h4>
                        <span>Xuất bản</span>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="btn-set">
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-save"></i> Lưu
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i> Lưu & Thoát
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-actions form-actions-fixed-top">
                <div class="btn-set">
                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Lưu & Thoát
                    </button>
                </div>
            </div>
            <div class="widget meta-boxes">
                <div class="widget-title">
                    <h4><span>Cài đặt</span></h4>
                </div>
                <div class="widget-body">
                    <div class="misc-pub-section">
                        <div class="form-group">
                            <?= $form->field($model, 'status')->checkbox(['label' => 'Kích hoạt'])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget meta-boxes">
                <div class="widget-title">
                    <h4><span>Biểu tượng (icon)</span></h4>
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
                                   class="thumbnail-fieldID frame-btn">Đặt biểu tượng (icon)</a>
                                <a href="javascript:void(0)" style="<?= $model->avatar ? '' : 'display: none;' ?>"
                                   class="remove-thumbnail-fieldID" onclick="remove_thumbnail('fieldID')">
                                    Xóa biểu tượng (icon)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
