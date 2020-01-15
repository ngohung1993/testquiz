<?php

use common\models\AccountBank;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use common\models\TransactionHistory;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $account common\models\AccountBank */
/* @var $transactions common\models\TransactionHistory */
/* @var $account_admin common\models\AccountBank */
/** @var TYPE_NAME $pages */


$this->title = 'Quản lý tài chính';
?>
<style>
    .dataTables_empty {
        height: 200px !important;
        padding-top: 25px !important;
        padding-bottom: 180px !important;
        text-align: left !important;
        color: #777;
        font-size: 15px;
        background: url(/uploads/cms/img/table-no-data.png) no-repeat center;
        background-size: auto 161px;
    }

    .notify {
        text-align: center;
        margin-bottom: 10px;
    }

    .pagination > li > a, .pagination > li > span {
        margin-right: 7px;
    }

    .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #1fb6ff;
        border-color: #1fb6ff;
    }

    @media (max-width: 768px) {
        .response {
            padding-right: 10px !important;
        }

        .ad_user_menu_left li a span {
            margin: 5px !important;
        }

        .right-box {
            margin: 0;
        }

        .tb_tk_evenue td {
            padding: 10px 0 0 50%;
        }
    }

    @media (min-width: 600px) and (max-width: 768px) {
        .tab-content {
            margin-top: -50px;
        }
    }
</style>

<div class="col-sm-9 response" style="margin-top: -49px">
    <div class="tab-content">
        <div class="">
            <h3 class="ad_user_name">Quản lý tài chính</h3>

            <div class="row right-box">
                <div class="config_withdrawal" style="height: auto; width: 100%">
                    <h4>Thông tin tài khoản</h4>

                    <p class="title_bal edit_pal" style="margin-bottom: 0">Thành viên:
                        <span style="font-size: 16px;"><?= $user->name ?> (STK-ID: <?= $user->code ?>)</span>
                    </p>
                    <p class="title_bal edit_pal" style="margin-bottom: 0">Số dư hiện tại:
                        <span style="font-size: 16px; color: #1fb6ff"> <?= number_format($user->wallet, 0, ',', '.') ?>
                            đ </span>
                    </p>
                    <h4>Hướng dẫn nạp tiền</h4>
                    <p class="title_bal" style="margin-bottom: 0">Quý khách vui lòng chuyển đến một trong số các tài
                        khoản sau</p>
                    <p class="title_bal" style="margin-bottom: 0">Ví dụ nội dung chuyển tiền: <span
                                style="color: red"><?= $user->name ?> (STK-ID: <?= $user->code ?>)</span></p>

                    <div class="container">
                        <div class="row">
                            <?php /** @var TYPE_NAME $account_admins */
                            foreach ($account_admins as $value):?>
                                <div class="col-md-6">
                                    <p class="title_bal"
                                       style="font-size: 16px; display: block; color: #000"><?= $value->name_bank ?></p>
                                    <p class="title_bal" style="font-size: 14px; display: block; padding-top: 0">
                                        STK: <?= $value->account_number ?></p>
                                    <p class="title_bal" style="font-size: 14px; display: block; padding-top: 0">Chủ tài
                                        khoản: <?= $value->account_name ?></p>
                                    <p class="title_bal" style="font-size: 14px; display: block; padding-top: 0">Chi
                                        nhánh: <?= $value->bank_branch ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="pal_history_surplus" id="list_history_finance">
                    <h4>Lịch sử biến động số dư</h4>
                    <ul class="tab_pal_his">
                        <li class="act_finance active_pal" data-tab="#act_finance">
                            <a href="javascript:;">Lịch sử nạp tiền</a>
                        </li>
                    </ul>
                    <div id="act_rfds" class="content_act">
                        <div class="pal_top_search" style="margin-top: 10px">
                            <strong class="total-money">Tổng tiền đã nạp: <span
                                        style="color: red;font-size: 16px;"><?= number_format($totalMoney, 0, ',', '.') ?>
                                    đ</span></strong>
                        </div>
                        <table class="tb_tk_evenue">
                            <thead class="title_tk_eve">
                            <tr>
                                <td width="16%">Mã giao dịch</td>
                                <td width="12%">Số tiền</td>
                                <td width="14%">Loại giao dịch</td>
                                <td width="14%">Thời gian</td>
                                <td width="12%">Trang thái</td>
                                <td width="12%">Chi tiết</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?= $transaction->code ?></td>
                                    <td style="color: red; font-weight: bold; font-size: 14px"><?= number_format($transaction->amount, 0, ',', '.') ?>
                                        đ
                                    </td>
                                    <td><span class="label label-success">Nạp tiền</span></td>
                                    <td><?= date('H:i d/m/Y', $transaction->updated_at) ?></td>
                                    <td>
                                        <?php if ($transaction->status == 0): ?>
                                            <button class="bt btn-warning"><i class="fa fa-hourglass-end"></i> Admin xử
                                                lý
                                            </button>
                                        <?php elseif ($transaction->status == 1): ?>
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
                                    <td>
                                        <a class="btn btn-info btn-xs"
                                           href="<?= Url::to(['view', 'id' => $transaction->id]) ?>"
                                           style="color: #fff"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="paging">
                        <?php echo LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount' => 5,
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3c8dbc;
            color: white;
            font-weight: bold;
        }

        td, th {
            padding: 6px;
            border: 1px solid #ccc;
            text-align: left;
        }

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 15px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;

            }

            table.table-bordered.dataTable tbody td {
                padding-left: 140px !important;
            }

            /*
            Label the data
            */
            td:nth-of-type(1):before {
                content: "Mã Giao Dịch";
                font-weight: bold;
            }

            td:nth-of-type(2):before {
                content: "Số tiền";
                font-weight: bold;
            }

            td:nth-of-type(3):before {
                content: "Loại Giao Dịch";
                font-weight: bold;
            }

            td:nth-of-type(4):before {
                content: "Thời Gian";
                font-weight: bold;
            }

            td:nth-of-type(5):before {
                content: "Trạng Thái";
                font-weight: bold;
            }

            td:nth-of-type(6):before {
                content: "Chi Tiết";
                font-weight: bold;
            }
        }
    </style>