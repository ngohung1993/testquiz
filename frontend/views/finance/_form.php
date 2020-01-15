<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<style>
    .form-group input[type="checkbox"] {
        position: unset;

    }
</style>
<?php $form = ActiveForm::begin(); ?>
<div class="col-md-6" >
    <div class="form-group">
        <label for="">Số tài khoản</label>
        <?= $form->field($model, 'account_number')->textInput([
            'maxlength' => true,
            'required'=> true,
            'placeholder' => 'Nhập số tài khoản '
        ])->label(false) ?>
    </div>
    <div class="form-group">
        <label for="">Tên tài khoản</label>
        <?= $form->field($model, 'account_name')->textInput([
            'maxlength' => true,
            'required'=> true,
            'placeholder' => 'Nhập tên tài khoản '
        ])->label(false) ?>
    </div>
    <div class="form-group">
        <label for="">Tên ngân hàng</label>
        <?= $form->field($model, 'name_bank')->textInput([
            'maxlength' => true,
            'required'=> true,
            'placeholder' => 'Nhập tên ngân hàng '
        ])->label(false) ?>
    </div>
    <div class="form-group">
        <label for="">Tên chi nhánh</label>
        <?= $form->field($model, 'bank_branch')->textInput([
            'maxlength' => true,
            'required'=> true,
            'placeholder' => 'Nhập tên chi nhánh '
        ])->label(false) ?>
    </div>


</div>
<div class="col-md-6">
    <div class="form-group" style="margin-top: 24px ">
        <?= $form->field($model, 'status')->checkbox(['label' => 'Mặc định'])->label(false) ?>
    </div>
    <div class="form-group" style="margin-top: 24px ">
        <button class="btn btn-success">Lưu</button>
        <a class="btn btn-default" href="<?=Url::to(['account'])?>">Hủy</a>
    </div>

</div>
<?php ActiveForm::end(); ?>
