<?php

use common\models\Exam;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use common\helpers\FunctionHelper;
use common\models\TransactionHistory;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model \common\models\User */
/* @var $topics \common\models\Topic */
/* @var $transactions \common\models\TransactionHistory */


$this->title = 'Thông tin chi tiết thành viên';

?>
<style>
    .ks-checkBox span.fa {
        width: 15px;
        height: 12px;
        margin: 0 auto;
        display: block;
        font-size: 15px;
    }

    .numberAnswerQuestion {
        padding: 6px 12px !important;
        margin: 6px;
        text-align: center;
    }

    .boxPanel {
        border: 1px solid #f4e3bd;
        padding: 8px 8px 8px 0;
        border-radius: 3px;
        background: #fff8e8;
        color: #b08e40;
        margin-bottom: 5px;
    }

    .radioButtonAnswer {
        border-radius: 100% !important;
    }

    .row:nth-of-type(odd) {
        background: #f5f5f5;
    }

    .examControl .row > .col-md-5 .row .col-md-6 p {
        padding: 5px;
        margin: 0;
    }

    .row > .col-md-6:nth-of-type(2) {
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .widget-body .row {
        margin: 0 -10px;
    }

    .widget-body p {
        margin: 8px 0;
    }

    .font-bold {
        font-weight: bold;
    }

    .GMC {
        width: 95%;
        margin: 0 auto;
    }

    .fix-height {
        height: 100%;
    }

    .pagination > li > a {
        padding: 2px 8px;
        border: 1px solid #f1f1f1;
    }

    .pagination > .active > a, .pagination > .active > a:hover {
        background-color: #337ab7;
        cursor: pointer;
    }
</style>

<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= Url::to(['site/index']) ?>">Bảng điều khiển</a>
        </li>

        <li class="breadcrumb-item">
            <a onclick="goBack()">Danh sách thành viên</a>
        </li>

        <li class="breadcrumb-item active"><?= $model->name ?></li>
    </ol>
    <div class="clearfix"></div>

    <div>

        <div class="row">
            <div class="col-md-5">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4>
                            <span>
                            <i class="fa fa-user" aria-hidden="true"></i>
                                Thông tin cá nhân
                            </span>
                        </h4>
                    </div>
                    <div class="widget-body fix-height" style="height: 100%">
                        <div class="row">
                            <div class="col-md-5">
                                <p>SKD-ID: </p>
                            </div>
                            <div class="col-md-7">
                                <p class="pull-right">
                                    <span style="font-weight: bold"><?= $model->code ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Họ tên</p>
                            </div>
                            <div class="col-md-7">
                                <p class="pull-right">
                                    <span style="font-weight: bold"><?= $model->name ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Địa chỉ Email</p>
                            </div>
                            <div class="col-md-7">
                                <p class="font-bold pull-right">
                                    <span style="font-weight: bold"><?= $model->email ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Ngày sinh</p>
                            </div>
                            <div class="col-md-7">
                                <p class="font-bold pull-right">
                                    <span style="font-weight: bold">
                                        <?= $model['birthday'] ? date('d/m/Y', strtotime($model['birthday'])) : '' ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Số điện thoại</p>
                            </div>
                            <div class="col-md-7">
                                <p class="font-bold pull-right">
                                    <span style="font-weight: bold"><?= $model->phone ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Ngày tham gia</p>
                            </div>
                            <div class="col-md-7">
                                <p class="font-bold pull-right">
                                    <span style="font-weight: bold"><?= date('d/m/Y', $model->created_at) ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p>Trạng thái</p>
                            </div>
                            <div class="col-md-7">
                                <p class="font-bold pull-right">
                                    <span class="label <?= $model->getStatusBg() ?>">
                                            <?= $model->getStatusLabel() ?>
                                        </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4>
                            <span>
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Thông tin tài chính
                            </span>
                        </h4>
                    </div>
                    <div class="widget-body fix-height" style="height: 100%">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Số dư tài khoản </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span style="font-weight: bold; color: red"><?= number_format($model->wallet, 0, ',', '.') ?>
                                        đ</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tổng chủ đề duyệt</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span style="font-weight: bold"><?= FunctionHelper::countTopicUser($model->id) ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tổng đề thi duyệt</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <span style="font-weight: bold"><?= FunctionHelper::countExamUser($model->id) ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tổng số tiền nạp</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <span style="font-weight: bold; color: red">
                                        <?= number_format(FunctionHelper::memberRevenueStatistics($model->id, TransactionHistory::RECHARGE), 0, ',', '.') ?>
                                        đ
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tổng số tiền rút</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <span style="font-weight: bold; color: red">
                                        <?= number_format(FunctionHelper::memberRevenueStatistics($model->id, TransactionHistory::WITHDRAWAL), 0, ',', '.') ?>
                                        đ
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Doanh thu bán đề</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <span style="font-weight: bold; color: red">
                                        <?= number_format(FunctionHelper::memberRevenueStatistics($model->id, TransactionHistory::BY_EXAM), 0, ',', '.') ?>
                                        đ
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Số tiền mua đề</p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-bold">
                                    <span style="font-weight: bold; color: red">
                                        <?= number_format(FunctionHelper::memberRevenueStatistics($model->id, TransactionHistory::SELL_EXAM), 0, ',', '.') ?>
                                        đ
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 right-sidebar">
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4><span>Ảnh đại diện</span></h4>
                    </div>
                    <div class="widget-body" style="height: 282px">
                        <?php if ($model->auth == User::AUTH_FACEBOOK): ?>
                            <img style="width: 100%; height: 100%" src="<?= $model->getAvatar() ?>" alt="">
                        <?php else: ?>
                            <img style="width: 100%; height: 100%" src="<?= $model->avatar ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="background: #eef1f5">
            <div class="col-md-12">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4><span>Giới thiệu về bản thân</span></h4>
                    </div>
                    <div class="widget-body fix-height">
                        <?= $model->description ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="portlet light bordered portlet-no-padding">
                <div class="portlet-body">
                    <div class="table-responsive">
                        <div id="table-menus_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="" style="padding: 5px 15px">
                                <ul class="nav nav-tabs">
                                    <li class="<?= $type == TransactionHistory::RECHARGE ? 'active' : '' ?>">
                                        <a href="<?= Url::to(['view', 'id' => $model->id, 'type' => TransactionHistory::RECHARGE]) ?>">
                                            Lịch sử nạp tiền
                                        </a>
                                    </li>
                                    <li class="<?= $type == TransactionHistory::WITHDRAWAL ? 'active' : '' ?>">
                                        <a href="<?= Url::to(['view', 'id' => $model->id, 'type' => TransactionHistory::WITHDRAWAL]) ?>">
                                            Lịch sử rút tiền
                                        </a>
                                    </li>
                                    <li class="<?= $type == TransactionHistory::BY_EXAM ? 'active' : '' ?>">
                                        <a href="<?= Url::to(['view', 'id' => $model->id, 'type' => TransactionHistory::BY_EXAM]) ?>">
                                            Lịch sử bán đề thi
                                        </a>
                                    </li>
                                    <li class="<?= $type == TransactionHistory::SELL_EXAM ? 'active' : '' ?>">
                                        <a href="<?= Url::to(['view', 'id' => $model->id, 'type' => TransactionHistory::SELL_EXAM]) ?>">
                                            Lịch sử mua đề thi
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home"
                                         class="tab-pane fade <?= $type == TransactionHistory::RECHARGE ? 'in active' : '' ?>">
                                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                                            <thead>
                                            <tr role="row">
                                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                                    ID
                                                </th>
                                                <th class="column-key-image sorting" style="width: 50px;">
                                                    Số tiền
                                                </th>
                                                <th class="text-left column-key-name sorting" style="width: 50px;">
                                                    Thời gian
                                                </th>
                                                <th width="100px" class="column-key-status sorting"
                                                    style="width: 50px;">
                                                    Trạng thái
                                                </th>
                                                <th class="text-center sorting_disabled" style="width: 50px;">
                                                    Tác vụ
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php /** @var TYPE_NAME $transactions */
                                            foreach ($transactions as $key => $value):?>
                                                <tr>
                                                    <td><?= ++$key ?></td>
                                                    <td style="color: red"><?= number_format($value->amount, 0, ',', '.') ?>
                                                        đ
                                                    </td>
                                                    <td><?= date('H:i d/m/Y', $value->created_at) ?></td>
                                                    <td>
                                                        <?php if ($value->status == 0): ?>
                                                            <button class="bt btn-warning btn-xs"><i
                                                                        class="fa fa-hourglass-end"></i>Admin xử
                                                                lý
                                                            </button>
                                                        <?php elseif ($value->status == 1): ?>
                                                            <button class="bt btn-success btn-xs">
                                                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                                Thành công
                                                            </button>
                                                        <?php else: ?>
                                                            <button class="bt btn-danger btn-xs">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                                Thất bại
                                                            </button>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info btn-xs"
                                                           href="<?= Url::to(['transaction-history/views', 'id' => $value->id]) ?>"
                                                           style="color: #fff"><i class="fa fa-eye"
                                                                                  aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php if (!count($transactions)): ?>
                                            <div class="dataTables_empty"></div>
                                            <div class="notify">
                                                <span>Không có dữ liệu</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clear"></div>
                                        <div class="paging" style="margin-top: 10px; text-align: center">
                                            <?php /** @var TYPE_NAME $transactionPage */
                                            echo LinkPager::widget([
                                                'pagination' => $transactionPage,
                                                'maxButtonCount' => 5,
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div id="menu1"
                                         class="tab-pane fade <?= $type == TransactionHistory::WITHDRAWAL ? 'in active' : '' ?>">
                                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                                            <thead>
                                            <tr role="row">
                                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                                    ID
                                                </th>
                                                <th class="column-key-image sorting" style="width: 50px;">
                                                    Số tiền
                                                </th>
                                                <th class="text-left column-key-name sorting" style="width: 50px;">
                                                    Thời gian
                                                </th>
                                                <th width="100px" class="column-key-status sorting"
                                                    style="width: 50px;">
                                                    Trạng thái
                                                </th>
                                                <th class="text-center sorting_disabled" style="width: 50px;">
                                                    Tác vụ
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($transactions as $key => $value): ?>
                                                <tr>
                                                    <td><?= ++$key ?></td>
                                                    <td style="color: red"><?= number_format($value->amount, 0, ',', '.') ?>
                                                        đ
                                                    </td>
                                                    <td><?= date('H:i d/m/Y', $value->created_at) ?></td>
                                                    <td>
                                                        <?php if ($value->status == 0): ?>
                                                            <button class="bt btn-warning btn-xs"><i
                                                                        class="fa fa-hourglass-end"></i>Admin xử
                                                                lý
                                                            </button>
                                                        <?php elseif ($value->status == 1): ?>
                                                            <button class="bt btn-success btn-xs">
                                                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                                Thành công
                                                            </button>
                                                        <?php else: ?>
                                                            <button class="bt btn-danger btn-xs">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                                Thất bại
                                                            </button>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info btn-xs"
                                                           href="<?= Url::to(['transaction-history/view', 'id' => $value->id]) ?>"
                                                           style="color: #fff"><i class="fa fa-eye"
                                                                                  aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php if (!count($transactions)): ?>
                                            <div class="dataTables_empty"></div>
                                            <div class="notify">
                                                <span>Không có dữ liệu</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clear"></div>
                                        <div class="paging" style="margin-top: 10px; text-align: center">
                                            <?php echo LinkPager::widget([
                                                'pagination' => $transactionPage,
                                                'maxButtonCount' => 5,
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div id="menu2"
                                         class="tab-pane fade <?= $type == TransactionHistory::BY_EXAM ? 'in active' : '' ?>">

                                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                                            <thead>
                                            <tr role="row">
                                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                                    ID
                                                </th>
                                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                                    Số tiền
                                                </th>
                                                <th class="column-key-created_at sorting" style="width: 120px;">
                                                    Tên đề thi
                                                </th>
                                                <th width="100px" class="column-key-status sorting"
                                                    style="width: 100px;">
                                                    Thời gian bán
                                                </th>
                                                <th class="text-center sorting_disabled" style="width: 50px;">
                                                    trạng thái
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($transactions as $key => $value): ?>
                                                <tr>
                                                    <td><?= ++$key ?></td>
                                                    <td style="color: red">
                                                        <?= $value->amount ? number_format($value->amount, 0, ',', '.') . ' đ' : 'Miễn phí' ?>
                                                    </td>
                                                    <td><?= $value['exam']['title'] ?></td>
                                                    <td><?= date('H:i d/m/Y', $value->created_at) ?></td>
                                                    <td class="text-center">
                                                        <button class="bt btn-success btn-xs">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                            Thành công
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php if (!count($transactions)): ?>
                                            <div class="dataTables_empty"></div>
                                            <div class="notify">
                                                <span>Không có dữ liệu</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clear"></div>
                                        <div class="paging" style="margin-top: 10px; text-align: center">
                                            <?php echo LinkPager::widget([
                                                'pagination' => $transactionPage,
                                                'maxButtonCount' => 5,
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div id="menu3"
                                         class="tab-pane fade <?= $type == TransactionHistory::SELL_EXAM ? 'in active' : '' ?>">

                                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                                            <thead>
                                            <tr role="row">
                                                <th width="20px" class="column-key-id sorting" style="width: 40px;">
                                                    ID
                                                </th>
                                                <th class="text-left column-key-name sorting" style="width: 100px;">
                                                    Số tiền
                                                </th>
                                                <th class="column-key-created_at sorting" style="width: 300px;">
                                                    Tên đề thi
                                                </th>
                                                <th width="100px" class="column-key-status sorting"
                                                    style="width: 100px;">
                                                    Thời gian bán
                                                </th>
                                                <th class="text-center sorting_disabled" style="width: 50px;">
                                                    trạng thái
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($transactions as $key => $value): ?>
                                                <tr>
                                                    <td><?= ++$key ?></td>

                                                    <td style="color: red">
                                                        <?= $value->amount ? number_format($value->amount, 0, ',', '.') . 'đ' : 'Miễn phí' ?>
                                                    </td>
                                                    <td><?= $value['exam']['title'] ?></td>
                                                    <td><?= date('H:i d/m/Y', $value->created_at) ?></td>
                                                    <td class="text-center">
                                                        <button class="bt btn-success btn-xs">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                            Thành công
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php if (!count($transactions)): ?>
                                            <div class="dataTables_empty"></div>
                                            <div class="notify">
                                                <span>Không có dữ liệu</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clear"></div>
                                        <div class="paging" style="margin-top: 10px; text-align: center">
                                            <?php echo LinkPager::widget([
                                                'pagination' => $transactionPage,
                                                'maxButtonCount' => 5,
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4><span>Chủ đề đã duyệt</span></h4>
                    </div>
                    <div class="widget-body fix-height">
                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                            <thead>
                            <tr role="row">
                                <th width="20px" class="column-key-id sorting" style="width: 20px;">
                                    STT
                                </th>
                                <th class="column-key-image sorting" style="width: 60px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 250px;">
                                    Tiêu đề
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled" style="width: 200px">
                                    Danh mục
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled">
                                    Lớp - Môn
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tạo
                                </th>
                                <th class="text-center sorting_disabled" style="width: 50px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($topics as $key => $value): ?>
                                <tr role="row" class="odd">
                                    <td class="column-key-id"><?= $key + 1 ?></td>
                                    <td class="column-key-image">
                                        <img src="<?= $value['avatar'] ? $value['avatar'] : '/uploads/cms/img/placeholder.png' ?>"
                                             width="50" alt="">
                                    </td>
                                    <td class="text-left column-key-name">
                                        <?= $value['title'] ?>
                                    </td>
                                    <td>
                                        <?= $value['category']['title'] ?>
                                    </td>
                                    <td class=" no-sort column-key-updated_at">
                                        <?= FunctionHelper::get_classroom_by_topic_id($value->id)['title'] ?>
                                        - <?= FunctionHelper::get_subject_by_topic_id($value->id)['title'] ?>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('d/m/Y', $value['created_at']) ?>
                                    </td>

                                    <td class="text-center" style="width: 50px;">
                                        <div class="table-actions">
                                            <a href="<?= Url::to(['topic/views', 'id' => $value['id']]) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
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
                        <div class="clear"></div>
                        <div class="paging" style="margin-top: 10px; text-align: center">
                            <?php echo LinkPager::widget([
                                'pagination' => $topicPages,
                                'maxButtonCount' => 5,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget meta-boxes" style="margin-top: 0">
                    <div class="widget-title">
                        <h4><span>Đề thi đã duyệt</span></h4>
                    </div>
                    <div class="widget-body fix-height">
                        <table class="table table-striped table-hover vertical-middle dataTable no-footer">
                            <thead>
                            <tr role="row">
                                <th width="20px" class="column-key-id sorting" style="width: 20px;">
                                    STT
                                </th>
                                <th class="column-key-image sorting" style="width: 60px;">
                                    Hình ảnh
                                </th>
                                <th class="text-left column-key-name sorting" style="width: 250px;">
                                    Tiêu đề
                                </th>
                                <th class="no-sort column-key-updated_at sorting_disabled" style="width: 120px;">
                                    Chuyên mục
                                </th>
                                <th class="no-sort column-key-updated_at " style="width: 100px;">
                                    Giá
                                </th>
                                <th class="column-key-created_at sorting" style="width: 100px;">
                                    Ngày tạo
                                </th>
                                <th class="text-center sorting_disabled" style="width: 50px;">
                                    Tác vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($exams as $key => $value): ?>
                                <tr role="row" class="odd">
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
                                    <td class=" no-sort column-key-updated_at">
                                        <?= $value['topic']['title'] ?>
                                    </td>
                                    <td>
                                        <?= $value->price ? number_format($value->price, 0, ',', '.') . 'đ' : 'Miễn phí' ?>
                                    </td>
                                    <td class="column-key-created_at">
                                        <?= date('d/m/Y', $value['created_at']) ?>
                                    </td>
                                    <td class="text-center" style="width: 50px;">
                                        <div class="table-actions">
                                            <a href="<?= Url::to(['exam/view', 'id' => $value['id']]) ?>"
                                               class="btn btn-icon btn-sm btn-primary tip" title="Xem">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!count($exams)): ?>
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        <?php endif; ?>
                        <div class="clear"></div>
                        <div class="paging" style="margin-top: 10px; text-align: center">
                            <?php echo LinkPager::widget([
                                'pagination' => $examPages,
                                'maxButtonCount' => 5,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>