<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LocationMenu */
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
            <div class="main-form">
                <div class="form-body">
                    <?= $form->field($model, 'title')->textInput(['placeholder' => 'Nhập tiêu đề tại đây'])->label('Tiêu đề') ?>
                    <div class="form-group">
                        <?= $form->field($model, 'key')->textInput() ?>
                    </div>
                    <div class="clearfix"></div>
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
                    <div class="btn-set" style="text-align: center;">
                        <button type="submit" class="btn btn-success">
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
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>