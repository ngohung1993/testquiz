<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */

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
            <div class="main-form">
                <div class="form-body">
					<?= $form->field( $model, 'title' )->textInput( [
						'maxlength'   => true,
						'placeholder' => 'Nhập tiêu đề tại đây'
					] )->label( 'Tiêu đề' ) ?>
                    <div class="form-group">
						<?= $form->field( $model, 'key' )->textInput() ?>
                    </div>
                    <div class="form-group">
						<?= $form->field( $model, 'describe' )->textarea() ?>
                    </div>
                    <div class="form-group">
						<?= $form->field( $model, 'released' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
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
        </div>
    </div>

	<?php ActiveForm::end(); ?>
</div>