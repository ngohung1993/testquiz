<?php

use backend\assets\EditorAsset;
use backend\assets\FancyboxAsset;
use backend\assets\NestableAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $model common\models\SignupForm */
EditorAsset::register($this);
FancyboxAsset::register($this);
NestableAsset::register($this)
?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-9">
        <div class="main-form">
            <div class="form-body">
                <div class="form-group">
                    <?= $form->field($model, 'permission')->dropDownList($user->roleLabel()) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'username')->textInput() ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 're_password')->passwordInput() ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
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
            <div class="widget-body" style="text-align: center;">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check-circle"></i> Lưu & Thoát
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-close"></i> Hũy
                </button>
            </div>
        </div>
        <div class="widget meta-boxes">
            <div class="widget-title">
                <h4><span>Ảnh đại diện</span></h4>
            </div>
            <div class="widget-body">
                <div class="image-box">
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
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<style>
    .opacity {
        background-color: #ababab;
        opacity: 0.5;
        display: none;
    }
</style>

<div id="loader" class="opacity loader">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>