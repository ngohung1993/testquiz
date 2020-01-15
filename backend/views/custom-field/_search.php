<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\CustomFieldSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="custom-field-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'theme_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'frame') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'serial') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'key') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'released') ?>

    <?php // echo $form->field($model, 'placeholder') ?>

    <?php // echo $form->field($model, 'explain') ?>

    <?php // echo $form->field($model, 'value') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'alt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
