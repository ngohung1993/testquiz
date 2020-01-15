<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $audit_logs common\models\AuditLog */

$this->title = 'Lịch sử hoạt động';

?>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Url::to( [ 'site/index' ] ) ?>">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Quản trị hệ thống</li>
        <li class="breadcrumb-item active">Lịch sử đăng nhập</li>
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
                            <a class="btn btn-default buttons-reload" href="<?= Url::to( [ 'index' ] ) ?>">
                                <span><i class="fa fa-refresh"></i>
                                    Tải lại
                                </span>
                            </a>
                        </div>
                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                            <thead>
                            <tr role="row">
                                <th width="10px" class="text-left no-sort sorting_asc">
                                    <div class="checkbox checkbox-primary">
                                        <div class="checker" style="">
                                            <span>
                                                <input title="" type="checkbox" class="group-checkable">
                                            </span>
                                        </div>
                                    </div>
                                </th>
                                <th width="20px" class="column-key-id sorting">
                                    ID
                                </th>
                                <th class="text-left column-key-action sorting">
                                    Hành động
                                </th>
                                <th class="text-left column-key-action sorting">
                                    Ip
                                </th>
                                <th class="text-left column-key-action sorting">
                                    Thời gian
                                </th>
                                <th class="text-left column-key-user_agent sorting">
                                    Trình duyệt
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ( $audit_logs as $key => $value ): ?>
                                <tr role="row" class="even">
                                    <td class="text-left no-sort sorting_1">
                                        <div class="text-left">
                                            <div class="checkbox checkbox-primary table-checkbox">
                                                <div class="checker">
                                                <span>
                                                    <input title="" type="checkbox" class="checkboxes">
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-key-id">
										<?= $key + 1 ?>
                                    </td>
                                    <td class="text-left column-key-action">
                                        <span class="log-icon log-icon-info"></span>
                                        <span>
                                            <a href="<?= Url::to( [ 'site/profile' ] ) ?>">
                                                <?= $value['user']['last_name'] ?>
                                            </a>
                                            đăng nhập vào hệ thống                         .
                                        </span>
                                    </td>
                                    <td class=" text-left column-key-user_agent">
										<?= $value['ip'] ?>
                                    </td>
                                    <td class=" text-left column-key-user_agent">
										<?= $value['time'] ?>
                                    </td>
                                    <td class=" text-left column-key-user_agent">
										<?= $value['browser'] ?>
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
</div>
