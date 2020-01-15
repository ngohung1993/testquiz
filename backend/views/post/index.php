<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $posts array common\models\Post */
/* @var $categories array common\models\Category */

$this->title = Yii::t( 'backend', 'Posts' );

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Bài viết</li>
    </ol>
    <div class="clearfix"></div>

    <div class="table-wrapper">
        <div class="portlet light bordered portlet-no-padding">
            <div class="portlet-title">
                <div class="caption">
                    <div class="wrapper-action"></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"
                         style="width: 1085px;">
                        <div class="dt-buttons btn-group">
                            <a class="btn btn-default action-item" href="<?= Url::to( [ 'create' ] ) ?>">
                                <span>
                                    <span>
                                        <i class="fa fa-plus"></i> Tạo mới
                                    </span>
                                </span>
                            </a>
                            <a class="btn btn-default buttons-reload" href="<?= Url::to( [ 'index' ] ) ?>">
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
                                    <input style="margin-right: 10px;" title="" type="checkbox" class="minimal">
                                </th>
                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                    ID
                                </th>
                                <th class="column-key-image sorting" style="width: 50px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting">
                                    Tiêu đề
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled"
                                    style="width: 100px;">
                                    Chuyên mục
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tạo
                                </th>
                                <th width="100px" class="column-key-status sorting" style="width: 100px;">
                                    Trạng thái
                                </th>
                                <th class="text-center sorting_disabled" style="width: 158px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ( $posts as $key => $value ): ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="text-left no-sort sorting_1">
                                        <input title="" type="checkbox" class="minimal">
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="column-key-image">
                                        <img src="<?= $value['avatar'] ? $value['avatar'] : '/uploads/cms/img/placeholder.png' ?>"
                                             width="50">
                                    </td>
                                    <td class="text-left column-key-name">
                                        <?= $value['title'] ?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
										<?= $value['category']['title'] ?>
                                    </td>
                                    <td class="column-key-created_at">
										<?= date( 'd/m/Y', $value['created_at']) ?>
                                    </td>
                                    <td class="column-key-status">
                                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                             style="border:none">
                                            <input data-id="<?= $value['id'] ?>" data-api="ajax/enable-column"
                                                   data-table="post" data-column="status"
                                                   type="checkbox" <?= $value['status'] ? 'checked="checked"' : '' ?>
                                                   title="" name="switch-checkbox">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="<?= Url::to( [ 'update', 'id' => $value['id'] ] ) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-edit"></i>
                                            </a>
											<?= Html::a( Yii::t( 'backend', '<i class="fa fa-trash-o"></i>' ), [
												'delete',
												'id' => $value->id
											], [
												'class' => 'btn btn-icon btn-sm btn-danger tip',
												'data'  => [
													'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
													'method'  => 'post',
												],
											] ) ?>
                                        </div>
                                    </td>
                                </tr>
							<?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($posts)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <?php if (count($posts)): ?>
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