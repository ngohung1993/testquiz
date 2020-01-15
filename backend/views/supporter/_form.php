<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Supporter */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-shield"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to(['index']) ?>"><?= Yii::t('backend', 'Supporter') ?></a>
            </span>
            <span>/</span>
            <span class="title">
                <?= Yii::t('backend', 'Create') ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('app', 'Submit'), ['class' => 'btn btn-primary pull-right', 'onclick' => 'getImages()',]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <h4>Thông tin hỗ trợ viên</h4>
            <p class="text-muted">Nhập tên và các mô tả cho hỗ trợ viên</p>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?= Yii::t('app', 'Basic information') ?>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Hiển thị</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $form->field($model, 'status')->checkbox(['class' => 'minimal none-action'])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <h4>Hình ảnh</h4>
            <p class="text-muted">Thêm hình ảnh nếu có</p>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Images') ?></h3>
                </div>
                <div class="box-body">
                    <div id="list-img-temp" class="thumbnails ui-sortable" style="display: none">
                        <div class="file-preview-frame krajee-default  kv-preview-thumb">
                            <div class="kv-file-content">
                                <img src="" class="kv-preview-data file-preview-image">
                            </div>
                            <div class="file-thumbnail-footer">
                                <div class="file-footer-caption">
                                    <span class="caption"></span>
                                </div>
                                <div class="file-upload-indicator" title="Not uploaded yet">
                                    <i class="glyphicon glyphicon-hand-down text-warning"></i>
                                </div>
                                <div class="file-actions">
                                    <div class="file-footer-buttons">
                                        <button type="button" class="kv-file-zoom btn btn-xs btn-default"
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
                        <?php if (isset($model['avatar'])): ?>
                            <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                <div class="kv-file-content">
                                    <img src="<?= $model['avatar'] ?>" class="kv-preview-data file-preview-image">
                                </div>
                                <div class="file-thumbnail-footer">
                                    <div class="file-footer-caption" title="kitchen_adventurer_lemon.jpg">
                                        <?= $model['avatar'] ?>
                                    </div>
                                    <div class="file-upload-indicator" title="Not uploaded yet">
                                        <i class="glyphicon glyphicon-hand-down text-warning"></i>
                                    </div>
                                    <div class="file-actions">
                                        <div class="file-footer-buttons">
                                            <button type="button" class="btn btn-xs btn-default"
                                                    onclick="deleteFile(event)">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="spanButtonPlaceholder block-upload-item"
                         style="position: relative; overflow: hidden;margin: 10px;">
                        <p>(Click để tải ảnh<br> hoặc kéo thả ảnh vào đây)</p>
                        <input class="kv-file-drop-zone" multiple="multiple" type="file" name="file">
                    </div>
                    <div class="droptext">Đăng ảnh thật nhanh bằng cách kéo và thả ảnh vào khung. Thay đổi vị trí của
                        ảnh bằng cách kéo ảnh vào vị trí mà bạn muốn!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'avatar')->hiddenInput(['id' => 'images'])->label(false) ?>
    </div>
    <div class="form-group" style="margin-right: 10px;">
        <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('app', 'Submit'), ['class' => 'btn btn-primary pull-right', 'onclick' => 'getImages()']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>