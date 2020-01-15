<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MetaLocation;

/* @var $this yii\web\View */
/* @var $model common\models\MetaLocation */
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
            You are editing "<strong class="current_language_text">English</strong>" version
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
					<?= $form->field( $model, 'meta_location_id' )->dropDownList(
						ArrayHelper::map( MetaLocation::find()->asArray()->all(), 'id', 'title' )
					)->label( 'Vị trí' ) ?>
                    <div class="form-group">
						<?= $form->field( $model, 'content' )->textarea() ?>
                    </div>
                    <div class="form-group">
						<?= $form->field( $model, 'status' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
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