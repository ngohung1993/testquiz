<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\AccountBank */
/* @var $form yii\widgets\ActiveForm */
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
                            <?= $form->field($model, 'account_name')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Nhập tên chủ tài khoản tại đây'
                            ])->label('Tên chủ tài khoản') ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($model, 'account_number')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Nhập số tài khoản tại đây'
                            ])->label('Số tài khoản') ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($model, 'name_bank')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Nhập tên ngân hàng tại đây'
                            ])->label('Tên ngân hàng') ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($model, 'bank_branch')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Nhập chi nhánh ngân hàng tại đây'
                            ])->label('Chi nhánh ngân hàng') ?>
                        </div>

                        <div class="clearfix"></div>
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
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

