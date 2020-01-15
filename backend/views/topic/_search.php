<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\TopicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="theme-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="filter_list inline-block filter-items-wrap">
        <div class="filter-item form-filter filter-item-default">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Tiêu đề</label>
                    <div class="form-group">
                        <?= $form->field($model, 'title')->textInput(['placeholder' => 'Tiêu đề', 'style' => 'border-radius: 4px;'])->label(false) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Tên thành viên</label>
                    <div class="form-group">
                        <?= $form->field($model, 'key_name')->textInput(['placeholder' => 'Tên thành viên', 'style' => 'border-radius: 4px;'])->label(false) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Trạng thái 1</label>
                    <div class="form-group">
                        <?= $form->field($model, 'status')->dropDownList([
                            '' => '--Chọn trạng thái--',
                            '1' => 'Chờ duyệt',
                            '2' => 'Duyệt',
                            '3' => 'Không duyệt',
                        ], ['style' => 'width:100%'])->label(false) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Trạng thái 2</label>
                    <div class="form-group">
                        <?= $form->field($model, 'active')->dropDownList([
                            '' => '--Chọn trạng thái--',
                            '1' => 'Hoạt động',
                            '0' => 'Ngừng hoạt đông',
                        ], ['style' => 'width:100%'])->label(false) ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 0; height: 32px">
                    <div class="pull-right">
                        <div class="form-group">
                            <button class="btn btn-primary btn-show-table-options" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Tìm kiếm
                            </button>
                            <a class="btn btn-default" href="<?=Url::to(['index'])?>">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                Làm mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
