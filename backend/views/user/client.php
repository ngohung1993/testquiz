<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $users array common\models\User */
/* @var $name */
/* @var $email */
/* @var $status */

$this->title = Yii::t('backend', 'Người dùng');

?>
<style>
    .img-user{
        border-radius: 50%;
        border: 1px solid #f5f5f5;
        padding: 5px;
    }
</style>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Thành viên</li>
    </ol>
    <div class="clearfix"></div>

    <div class="table-wrapper">
        <div class="table-configuration-wrap" style="display: block; padding: 0">
            <div class=" portlet light bordered portlet-no-padding table-menus_wrapper"
                 style="padding: 10px; margin-bottom: 10px">
                <h4>Tìm kiếm</h4>
                <div class="theme-search">

                    <?php $form = ActiveForm::begin([
                        'action' => ['staff'],
                        'method' => 'get',
                    ]); ?>
                    <div class="filter_list inline-block filter-items-wrap">
                        <div class="filter-item form-filter filter-item-default">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Họ tên</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="name" value="<?=$name?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Địa chỉ Email</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="email" value="<?=$email?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Trạng thái</label>
                                    <div class="form-group">
                                        <select name="status" id="" class="form-control">
                                            <option value="">Chọn</option>
                                            <option <?= $status== 10 ? 'selected' : ''?> value="10">Hoạt động</option>
                                            <option <?= $status== '0' ? 'selected' : ''?> value="0">Ngừng hoạt động</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="text-center" style="margin-top: 25px">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-show-table-options" type="submit">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                Tìm kiếm
                                            </button>
                                            <a class="btn btn-default" href="<?=Url::to(['client'])?>">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                                Tải lại
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="portlet light bordered portlet-no-padding">
            <div class="portlet-title">
                <div class="caption">
                    <div class="wrapper-action"></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                            <thead>
                            <tr role="row">
                                <th width="10px" class="text-left no-sort sorting_asc"
                                    style="width: 40px;text-align: center;">
                                    <label>
                                        <input style="margin-right: 10px;" title="" type="checkbox" class="minimal">
                                    </label>
                                </th>
                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                    STT
                                </th>
                                <th class="column-key-image sorting" style="width: 60px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 150px">
                                    Họ và tên
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled"
                                    style="width: 100px;">
                                    Email
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tham gia
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Chức vụ
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Trạng thái
                                </th>
                                <th class="text-center sorting_disabled" style="width: 158px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="column-key-image">
                                        <?php if(!$value['avatar']):?>
                                            <img class="img-user" src="/uploads/cms/img/avatar.png" width="100%" height="60px">
                                        <?php else:?>
                                            <?php if($value['auth'] == 1): ?>
                                                <img class="img-user" src="https://graph.facebook.com/<?=$value['avatar']?>/picture?type=normal" width="100%" height="60px">
                                            <?php else:?>
                                                <img class="img-user" src="<?=$value['avatar']?>" width="100%" height="60px">
                                            <?php endif;?>
                                        <?php endif;?>
                                    </td>
                                    <td class="text-left column-key-name">
                                        <a class="text-left"
                                           href="<?= Url::to(['update', 'id' => $value['id']]) ?>">
                                            <?= $value['name'] ?>
                                        </a>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <?= $value['email'] ?>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('d/m/Y', $value['created_at']) ?>
                                    </td>
                                    <td class="column-key-created_at">
                                        <span class="label <?= $value->getRoleBg() ?>">
                                            <?= $value->getRoleLabel() ?>
                                        </span>
                                    </td>
                                    <td class="column-key-created_at">
                                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                             style="border:none">
                                            <label>
                                                <input data-id="<?= $value->id ?>"
                                                       data-api="ajax/released"
                                                       data-table="user" data-column="status"
                                                       type="checkbox" <?= $value->status ? 'checked="checked"' : '' ?>
                                                       title="" name="switch-checkbox">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="<?= Url::to(['view', 'id' => $value['id']]) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?= Url::to(['update', 'id' => $value['id']]) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($users)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($users)): ?>
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