<?php

use common\models\base\TopicSearch;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use common\models\Topic;
use common\helpers\FunctionHelper;
use common\models\Exam;

/* @var $this yii\web\View */
/* @var $searchModel common\models\base\TopicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $topics array common\models\Topics */
/* @var $pages yii\data\Pagination */

$this->title = Yii::t('app', 'Chủ đề');
$this->params['breadcrumbs'][] = $this->title;

?>
<style>


    .card-inverse .btn {
        border: 1px solid rgba(0, 0, 0, .05);
    }


    .profile-inline ~ .card-title {
        display: inline-block;
        margin-left: 4px;
        vertical-align: top;
    }


    .meta h5 {
        text-decoration: none;
        font-weight: normal;
    }

    .card-footer .icon {
        padding: 5px;
        font-size: 12px;
    }

    .card-footer .icon a {
        color: #ef6645;
    }

    .loader{
        opacity: 0.1;
    }
</style>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Chủ đề</li>
    </ol>
    <div class="clearfix"></div>

    <div class="table-wrapper">
        <div class="table-configuration-wrap" style="display: block; padding: 0">
            <div class=" portlet light bordered portlet-no-padding table-menus_wrapper"
                 style="padding: 10px; margin-bottom: 10px">
                <h4>Tìm kiếm</h4>
                <div class="theme-search">

                    <?php $form = ActiveForm::begin([
                        'action' => ['stop'],
                        'method' => 'get',
                    ]); ?>
                    <div class="filter_list inline-block filter-items-wrap">
                        <div class="filter-item form-filter filter-item-default">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Tên chủ đề</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="topic" value="<?=$topic?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Thành viên tạo</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="user" value="<?=$user?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Danh mục</label>
                                    <div class="form-group">
                                        <select name="category" id="" class="form-control">
                                            <option value="">Chọn danh mục</option>
                                            <?php /** @var TYPE_NAME $categories */
                                            foreach ($categories as $key => $value):?>
                                                <option <?= $category == $value->id ? 'selected' : ''?> value="<?=$value->id?>"><?=$value->title?></option>
                                            <?php endforeach;?>
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
                                            <a class="btn btn-default" href="<?=Url::to(['stop'])?>">
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

            <div class="portlet-body">
                <div class="table-responsive">
                    <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="dt-buttons btn-group">
                            <a class="btn btn-default buttons-reload" href="<?= Url::to(['index']) ?>">
                                <span><i class="fa fa-refresh"></i>
                                    Tải lại
                                </span>
                            </a>
                        </div>
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
                                    ID
                                </th>
                                <th class="column-key-image sorting" style="width: 50px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting" >
                                    Tiêu đề
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled">
                                    Danh mục
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled">
                                    Lớp - Môn
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled">
                                    Người tạo
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày ngừng hoạt động
                                </th>
                                <th width="100px" class="column-key-status sorting" style="width: 100px;">
                                    Trạng thái
                                </th>
                                <th class="text-center sorting_disabled" style="width: 50px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($topics as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <label>
                                            <input alt="" title="" type="checkbox" class="minimal">
                                        </label>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="column-key-image">
                                        <img src="<?= $value['avatar'] ? $value['avatar'] : '/uploads/cms/img/placeholder.png' ?>"
                                             width="50" alt="">
                                    </td>
                                    <td class="text-left column-key-name">
                                        <a class="text-left"
                                           href="<?= Url::to(['view', 'id' => $value['id']]) ?>">
                                            <?= $value['title'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=$value['category']['title']?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <?=FunctionHelper::get_classroom_by_topic_id($value->id)['title']?> - <?=FunctionHelper::get_subject_by_topic_id($value->id)['title']?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <a href="<?= Url::to(['user/view', 'id' => $value['user']['id']]) ?>">
                                            <?= $value['user']['name'] ?>
                                            <span class="fa fa-external-link"></span>
                                        </a>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('d/m/Y', $value['updated_at']) ?>
                                    </td>
                                    <td>
                                        <span class="label label-danger">
                                            <span class="fa fa-clock-o"></span>
                                            Thành viên đã xóa
                                        </span>
                                    </td>

                                    <td class="text-center" style="width: 50px;">
                                        <?php if($value->status == Topic::CHO_DUYET):?>
                                            <div class="table-actions">
                                                <a href="<?= Url::to(['view', 'id' => $value['id']]) ?>"
                                                   class="btn btn-icon btn-sm btn-primary tip">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        <?php else:?>
                                            <div class="table-actions">
                                                <a href="<?= Url::to(['views', 'id' => $value['id']]) ?>"
                                                   class="btn btn-icon btn-sm btn-primary tip">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($topics)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($topics)): ?>
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


<div id="loader" style="display: none">
    <img style="position: absolute; top: 200px; left: 45%;" src="/uploads/cms/img/preloader.gif" alt="">
</div>
