<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $setting \common\models\Post */
/* @var $tabs array common\models\Post */
/* @var $categories array common\models\Category */

$this->title = Yii::t( 'backend', 'Bài viết con' );

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'setting/index' ] ) ?>">Cấu hình</a></li>

        <li class="breadcrumb-item">
            <a href="<?= Url::to( [ 'setting/tab', 'id' => $setting['id'] ] ) ?>">
				<?= $setting['title'] ?>
            </a>
        </li>

        <li class="breadcrumb-item active">Tab</li>
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
                    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="dt-buttons btn-group">
                            <a class="btn btn-default action-item" href="<?= Url::to( [
								'tab/create',
								'parent_id' => $setting['id'],
								'table'     => 'setting'
							] ) ?>">
                                <span>
                                    <span>
                                        <i class="fa fa-plus"></i> Tạo mới
                                    </span>
                                </span>
                            </a>
                            <a class="btn btn-default buttons-collection" tabindex="0" aria-controls="table-menus"
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
                                    style="width: 40px;">
                                    <div class="checkbox checkbox-primary">
                                        <div class="checker" style="">
                                            <span>
                                                <input title="" type="checkbox" class="group-checkable"
                                                       data-set=".dataTable .checkboxes"></span>
                                        </div>
                                    </div>
                                </th>
                                <th width="20px" class="column-key-id sorting" style="width: 20px;">
                                    ID
                                </th>
                                <th class="column-key-image sorting" style="width: 46px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 232px;">
                                    Tiêu đề
                                </th>
                                <th width="100px" class="column-key-status sorting" style="width: 100px;">Trạng thái
                                </th>
                                <th width="134px" class="text-center sorting_disabled" style="width: 158px;">Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ( $tabs as $key => $value ): ?>
                                <tr role="row" class="odd">
                                    <td class="text-left no-sort sorting_1">
                                        <div class="text-left">
                                            <div class="checkbox checkbox-primary table-checkbox">
                                                <div class="checker">
                                                        <span>
                                                            <input title="" type="checkbox" class="checkboxes"
                                                                   name="id[]" value="10">
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="column-key-image">
                                        <img src="<?= $value['avatar'] ? $value['avatar'] : '/uploads/cms/img/placeholder.png' ?>"
                                             width="50">
                                    </td>
                                    <td class="text-left column-key-name">
                                        <a class="text-left" href="">
											<?= $value['title'] ?>
                                        </a>
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
                                            <a href="<?= Url::to( [
												'tab/update',
												'id'        => $value['id'],
												'table'     => 'setting',
												'parent_id' => $value['setting_id']
											] ) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-edit"></i>
                                            </a>
											<?= Html::a( Yii::t( 'backend', '<i class="fa fa-trash-o"></i>' ), [
												'tab/delete',
												'id'    => $value->id,
												'table' => 'setting'
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
						<?php if ( ! count( $tabs ) ): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
						<?php endif; ?>
						<?php if ( count( $tabs ) ): ?>
                            <div class="datatables__info_wrap">
                                <div class="dataTables_paginate paging_simple_numbers">
                                </div>
                                <div class="dataTables_info" id="table-posts_info" role="status"
                                     aria-live="polite">
                                    <span class="dt-length-records">
                                        <i class="fa fa-globe"></i>
                                        <span class="hidden-xs">Show from</span> 1 to 10 in
                                        <span class="badge bold badge-dt">17</span>
                                        <span class="hidden-xs">records</span>
                                    </span>
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