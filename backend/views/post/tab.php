<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post \common\models\Post */
/* @var $tabs array common\models\Post */
/* @var $categories array common\models\Category */

$this->title = Yii::t( 'backend', 'Posts' );

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>

        <li class="breadcrumb-item">
            <a href="<?= Url::to( [ 'post/tab', 'post_id' ] ) ?>">
				<?= $post['title'] ?>
            </a>
        </li>

        <li class="breadcrumb-item active">Tab</li>
    </ol>
    <div class="clearfix"></div>
	<?php if ( ! count( $tabs ) ): ?>
        <div class="text-center col-xs-12">
            <h1>
                Tab
            </h1>
            <p class="text-info-displayTmpl">
                Thêm tab cho website để hiện thị các thông tin hiệu quả.
            </p>
            <div class="empty-displayTmpl-pdtop">
                <div class="empty-displayTmpl-image">
                    <img src="/uploads/cms/img/idea.png" alt="">
                </div>
            </div>
            <div class="empty-displayTmpl-btn">
                <a class="btn btn-success"
                   href="<?= Url::to( [ 'tab/create', 'parent_id' => $post['id'], 'table' => 'post' ] ) ?>">
                    <span class="fa fa-plus"></span>
                    Thêm mới tab
                </a>
            </div>
        </div>
	<?php endif; ?>
	<?php if ( count( $tabs ) ): ?>
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
                                <a class="btn btn-default action-item" href="<?= Url::to( [
									'tab/create',
									'parent_id' => $post['id'],
									'table'     => 'post'
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
                                    <img src="https://cms.botble.com/vendor/core/images/flags/vn.png"
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
                                    <th width="10px" class="text-left no-sort sorting_asc" rowspan="1" colspan="1"
                                        style="width: 40px;" aria-label="">
                                        <div class="checkbox checkbox-primary">
                                            <div class="checker" style=""><span>
                                                <input title="" type="checkbox" class="group-checkable"
                                                       data-set=".dataTable .checkboxes"></span>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="20px" class="column-key-id sorting" tabindex="0"
                                        aria-controls="table-menus"
                                        rowspan="1" colspan="1" style="width: 20px;" aria-label="IDorderby asc">ID
                                    </th>
                                    <th class="column-key-image sorting" tabindex="0" aria-controls="table-posts"
                                        rowspan="1" colspan="1" style="width: 46px;" aria-label="Hình ảnhorderby asc">
                                        Hình ảnh
                                    </th>
                                    <th class="text-left column-key-name sorting" tabindex="0"
                                        aria-controls="table-menus"
                                        rowspan="1" colspan="1" style="width: 232px;" aria-label="Tênorderby asc">Tên
                                    </th>
                                    <th width="100px" class="column-key-status sorting" tabindex="0"
                                        aria-controls="table-menus" rowspan="1" colspan="1" style="width: 100px;"
                                        aria-label="Trạng tháiorderby asc">Trạng thái
                                    </th>
                                    <th width="134px" class="text-center sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 158px;" aria-label="Tác vụ">Tác vụ
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
													'table'     => 'post',
													'parent_id' => $value['post_id']
												] ) ?>"
                                                   class="btn btn-icon btn-sm btn-primary tip">
                                                    <i class="fa fa-edit"></i>
                                                </a>
												<?= Html::a( Yii::t( 'backend', '<i class="fa fa-trash-o"></i>' ), [
													'tab/delete',
													'id'    => $value->id,
													'table' => 'post'
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
                            <div class="datatables__info_wrap">
                                <div class="dataTables_paginate paging_simple_numbers">
                                </div>
                                <div class="dataTables_info" id="table-posts_info" role="status" aria-live="polite">
                                    <span class="dt-length-records">
                                        <i class="fa fa-globe"></i>
                                        <span class="hidden-xs">Show from</span> 1 to 10 in
                                        <span class="badge bold badge-dt">17</span>
                                        <span class="hidden-xs">records</span>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php endif; ?>
</div>