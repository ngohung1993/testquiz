<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\WidgetsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widgets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'background_color') ?>

    <?= $form->field($model, 'title_color') ?>

    <?= $form->field($model, 'text_color') ?>

    <?php // echo $form->field($model, 'button_color') ?>

    <?php // echo $form->field($model, 'button_text') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
