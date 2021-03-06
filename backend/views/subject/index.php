<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\base\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $subjects common\models\Subject */

$this->title = Yii::t('app', 'Môn thi');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .dataTables_wrapper td, .dataTables_wrapper th {
        text-align: unset;
    }
</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Danh sách môn thi</li>
    </ol>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-custom tabbable-tabdrop">
                <div class="">
                    <?php if($_GET): ?>
                        <div class="alert alert-danger" style="padding: 10px">
                            <span>
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                Môn chứa chủ đề đề thi không được xóa.
                            </span>
                        </div>
                    <?php endif;?>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_detail">
                        <div class="table-wrapper">
                            <div class="portlet light bordered portlet-no-padding">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <div class="wrapper-action">
                                            <h2>Danh sách môn thi</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">

                                        <div id="table-menus_wrapper"
                                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                            <div class="dt-buttons btn-group">
                                                <a class="btn btn-default action-item"
                                                   href="<?= Url::to( [ 'create' ] ) ?>">
                                                    <span>
                                                        <span>
                                                            <i class="fa fa-plus"></i> Tạo mới
                                                        </span>
                                                    </span>
                                                </a>
                                                <a class="btn btn-default buttons-collection" tabindex="0"
                                                   aria-controls="table-menus"
                                                   href="#">
                                                    <span>
                                                        <img src="/uploads/cms/img/vn.png"
                                                             title="Tiếng Việt" alt="Tiếng Việt">
                                                        <span>
                                                            Ngôn ngữ
                                                            <span class="caret"></span>
                                                        </span>
                                                    </span>
                                                </a>
                                                <a class="btn btn-default buttons-reload"
                                                   href="<?= Url::to( [ 'index' ] ) ?>" style="margin-right: 20px;">
                                                    <span>
                                                        <i class="fa fa-refresh"></i>
                                                        Tải lại
                                                    </span>
                                                </a>
                                            </div>
                                            <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                                                <thead>
                                                <tr role="row">

                                                    <th width="20px" class="column-key-id sorting"
                                                        style="width: 20px;">
                                                        STT
                                                    </th>
                                                    <th class="text-left column-key-name sorting"
                                                        style="width: 232px;">
                                                        Tên môn
                                                    </th>
                                                    <th class="text-left column-key-name sorting"
                                                        style="width: 232px;">
                                                        Icon
                                                    </th>
                                                    <th width="100px" class="column-key-status sorting"
                                                        style="width: 100px;">
                                                        Trạng thái
                                                    </th>
                                                    <th width="134px" class="text-center sorting_disabled"
                                                        style="width: 158px;">Tác vụ
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($subjects as $key => $subject): ?>
                                                    <tr>
                                                        <td><?= ++$key ?></td>
                                                        <td><?=$subject->title?></td>
                                                        <td>
                                                            <img src="<?=$subject['avatar']?>" alt="<?=$subject['title']?>"></td>
                                                        <td>
                                                            <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini" style="border:none">
                                                                <input data-id="<?= $subject->id ?>" data-api="ajax/released"
                                                                       data-table="subject" data-column="status"
                                                                       type="checkbox" <?= $subject->status ? 'checked="checked"' : ''?>
                                                                       title="" name="switch-checkbox">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-icon btn-sm btn-primary tip" href="<?=Url::to([
                                                                'subject/update',
                                                                'id' => $subject['id']
                                                            ])?>"><i class="fa fa-edit"></i></a>
                                                            <?=Html::a(Yii::t('backend', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $subject->id], [
                                                                'class' => 'btn btn-icon btn-sm btn-danger tip text-center',
                                                                'title'=>'Xóa chủ đề',
                                                                'data' => [
                                                                    'confirm' => Yii::t('backend', 'Bạn có chắc chắn muốn xóa?'),
                                                                    'method' => 'post',
                                                                ],
                                                            ])?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <?php if (!count($subjects)): ?>
                                                <div class="dataTables_empty"></div>
                                                <div class="notify">
                                                    <span>Không có dữ liệu</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (count($subjects)): ?>
                                                <div class="datatables__info_wrap text-center">
                                                    <div class="dataTables_info" style="margin-top: 10px">
                                                        <div class="paging">
                                                            <div class="dataTables_paginate">
                                                                <?php /** @var TYPE_NAME $pages */
                                                                echo LinkPager::widget([
                                                                    'pagination' => $pages,
                                                                    'maxButtonCount' => 5,
                                                                ]); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
