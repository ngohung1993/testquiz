<?php

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use common\models\TransactionHistory;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var TYPE_NAME $pages */
/* @var $account common\models\AccountBank */
/* @var $transactions common\models\TransactionHistory */
/* @var $totalMoney */
/* @var $minimum_money */


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

    a, a:visited {
        color: #1fb6ff;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .box-mobile {
            width: 100%;
        }

        .number_money_bal {
            font-size: 24px;
        }

        .tab_pal_his {
            width: 100%;
            display: inline-table;
        }

        .tab_pal_his li {
            width: 100%;
        }

        .tb_tk_evenue td {
            padding: 15px 0 0 50%;
        }

        .left-box {
            margin: 0;
        }
    }

    .total-money {
        position: relative;
        top: 15px;
        font-weight: bold;
        font-size: 16px;
    }

    @media (min-width: 600px) and (max-width: 768px) {
        .response {
            padding-right: 10px !important;
        }

        .tab-content {
            margin-top: -50px;
        }

        .ad_user_menu_left li a span {
            margin: 5px !important;
        }
    }
</style>

<div class="col-sm-9 response" style="margin-top: -49px">
    <div class="tab-content">
        <div class="">
            <h3 class="ad_user_name">Quản lý tài chính</h3>
            <div class="row" style="margin-right: -9px">
                <div class="form-group note" style="display: none">
                    <div class="alert alert-danger" style="padding: 8px">
                        <p id="note-check-money" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Hãy đảm bảo rằng ô nhập số tiền phải là số nguyên và không chưa bất kỳ chữ cái nào.
                        </p>
                        <p id="note-account" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Bổ sung tài khoản ngân hàng.
                        </p>
                        <p id="note-money" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Ô nhập tiền không được để trống.
                        </p>
                        <p id="note-minimum-money" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Số tiền rút tối thiểu là 20.000 đồng
                        </p>
                        <p id="compare-money" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Số tiền giao dịch vượt quá số dư tài khoản. Vui lòng kiểm tra lại.
                        </p>
                        <p id="content-deal" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Nội dung giao dịch không được để trống.
                        </p>
                        <p id="minimum_amount_wallet_user" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Số dư tối thiểu trong tài khoản là <?=number_format($minimum_money->minimum_amount ,0,',','.')?> đồng .
                        </p>
                    </div>
                </div>
            </div>

            <div class="row left-box">
                <div class="account_balance" style="background: #f8f8f8">
                    <div class="account_balance" style="height: 160px; margin-bottom: 10px">
                        <h4>Thông tin số dư tài khoản</h4>
                        <p class="title_bal">Số dư tài khoản</p>
                        <p>
                            <span class="number_money_bal">
                                <?= number_format($user['wallet'], 0, ',', '.') ?> đ
                            </span>
                            <a class="send_bal" href="<?= Url::to(['finance/recharge']) ?>">
                                Nạp tiền
                            </a>
                        </p>
                    </div>
                    <div class="account_balance" style="height: 160px">
                        <h4>Thông tin tài khoản
                            <a href="<?= Url::to(['account']) ?>"
                               style="display: inline-block; font-style: italic; font-size: 12px; text-transform: none">(Chọn
                                tài khoản mặc định)</a>
                        </h4>
                        <p class="title_bal" style="margin-bottom: 0">Số tài khoản
                            <?php if ($account): ?>
                            <a  style=" font-weight: 100; font-style: italic; font-size: 12px;display: block; text-transform: none">(<?= $account->name_bank ?>)</a>
                            <?php endif;?>
                        </p>
                        <p>

                        <span class="number_money_bal">
                            <?php if (!$account): ?>
                                <span>Chọn một tài khoản mặc định</span>
                            <?php else: ?>
                                <?= $account->account_number ?>
                            <?php endif; ?>
                        </span>
                        </p>
                    </div>
                </div>

                <div class="config_withdrawal box-mobile">
                    <h4>Cấu hình rút tiền</h4>
                    <p class="title_bal edit_pal">Thành viên:
                        <span style="font-size: 16px;"><?= $user->name ?> (STK-ID: <?= $user->code ?>)</span>
                    </p>
                    <p class="title_bal" style="margin-bottom: 0">Đặt lệnh rút tiền</p>

                    <?php $form = ActiveForm::begin(['options' => ['onsubmit' => "return validateFormDeal()"]]); ?>
                    <div class="box_smt_money">
                        <p>
                            <?php if (!$account): ?>
                                <?= $form->field($model, 'account_id')->hiddenInput(['id' => 'account_user'])->label(false) ?>
                            <?php else: ?>
                                <?= $form->field($model, 'account_id')->hiddenInput(['value' => $account->id, 'id' => 'account_user'])->label(false) ?>
                            <?php endif; ?>
                            <input type="hidden" id="wallet_user" value="<?= $user['wallet'] ?>">
                            <input type="hidden" id="minimum_money_wallet" value="<?=$minimum_money ? $minimum_money->minimum_amount : ''?>">
                            <?= $form->field($model, 'amount')->textInput([
                                'placeholder' => 'Số tiền muốn rút', 'id' => 'currency-fields',
                                'onchange' => 'reformatText(this)'
                            ])->label(false) ?>
                        </p>
                        <p>
                            <?= $form->field($model, 'message')->textarea([
                                'placeholder' => 'Nội dung rút tiền',
                                'id' => 'content-message'
                            ])->label(false) ?>
                        </p>
                    </div>
                    <button type="submit" class="smt_edit_info">Lập lệnh</button>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="clear"></div>
                <div class="pal_history_surplus" id="list_history_finance">
                    <h4>Lịch sử biến động số dư</h4>
                    <ul class="tab_pal_his">
                        <li class="act_money <?= $type == TransactionHistory::WITHDRAWAL ? 'active_pal' : '' ?>"
                            data-tab="#act_money">
                            <a href="<?= Url::to(['index', 'type' => TransactionHistory::WITHDRAWAL]) ?>">Lịch sử rút
                                tiền</a>
                        </li>
                        <li class="act_money <?= $type == TransactionHistory::RECHARGE ? 'active_pal' : '' ?>"
                            data-tab="#act_money">
                            <a href="<?= Url::to(['index', 'type' => TransactionHistory::RECHARGE]) ?>">Lịch sử nạp
                                tiền</a>
                        </li>
                        <li class="act_finance <?= $type == TransactionHistory::BY_EXAM ? 'active_pal' : '' ?>"
                            data-tab="#act_finance">
                            <a href="<?= Url::to(['index', 'type' => TransactionHistory::BY_EXAM]) ?>">Lịch sử bán đề
                                thi</a>
                        </li>
                        <li class="act_buy <?= $type == TransactionHistory::SELL_EXAM ? 'active_pal' : '' ?>"
                            data-tab="#act_buy">
                            <a href="<?= Url::to(['index', 'type' => TransactionHistory::SELL_EXAM]) ?>">Lịch sử mua đề
                                thi</a>
                        </li>
                        </ul>
                    <div id="act_rfd" class="content_act <?= $type == TransactionHistory::WITHDRAWAL ? '' : 'hide' ?>">
                        <div class="pal_top_search">
                            <strong class="total-money">Tổng tiền đã rút: <span
                                        style="color: red;"><?= number_format($totalMoney, 0, ',', '.') ?> đ</span></strong>
                        </div>
                        <table class="tb_tk_evenue" style="width: 100%">
                            <thead class="title_tk_eve">
                            <tr>
                                <td>Mã giao dịch</td>
                                <td>Số tiền</td>
                                <td>Loại giao dịch</td>
                                <td>Thời gian</td>
                                <td>Trang thái</td>
                                <td>Chi tiết</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?= $transaction->code ?></td>
                                    <td
                                            style="color: red; font-weight: bold; font-size: 14px"><?= number_format($transaction->amount, 0, ',', '.') ?>
                                        đ
                                    </td>
                                    <td><span class="label label-success">Rút tiền</span></td>
                                    <td><?= date('H:i d/m/Y', $transaction->updated_at) ?></td>
                                    <td>
                                        <?php if ($transaction->status == 0): ?>
                                            <button class="bt btn-warning btn-xs"><i class="fa fa-hourglass-end"></i> Chờ xử
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
                                           href="<?= Url::to(['views', 'id' => $transaction->id]) ?>"
                                           style="color: #fff"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div id="act_rfds" class="content_act <?= $type == TransactionHistory::RECHARGE ? '' : 'hide' ?>">
                        <div class="pal_top_search">
                            <strong class="total-money">Tổng tiền đã nạp: <span
                                        style="color: red;"><?= number_format($totalMoney, 0, ',', '.') ?>
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
                                            <button class="bt btn-warning btn-xs"><i class="fa fa-hourglass-end"></i> Chờ xử
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
                    <div id="act_finance" class="content_act <?= $type == TransactionHistory::BY_EXAM ? '' : 'hide' ?>">
                        <div class="content_account_evenue">
                            <div class="pal_top_search">
                                <strong class="total-money">Tổng tiền mua đề: <span
                                            style="color: red;"><?= number_format($totalMoney, 0, ',', '.') ?> đ</span></strong>
                            </div>
                            <table class="tb_tk_evenue">
                                <thead class="title_tk_eve">
                                <tr>
                                    <td width="16%">Mã giao dịch</td>
                                    <td width="12%">Số tiền</td>
                                    <td width="20%">Đề thi đã Mua</td>
                                    <td width="14%">Thời gian</td>
                                    <td width="12%">Trang thái</td>

                                </tr>
                                </thead>
                                <?php foreach ($transactions as $transaction): ?>
                                    <tr>
                                        <td><?= $transaction->code ?></td>
                                        <td style="color: red; font-weight: bold; font-size: 14px">
                                            <?= $transaction->amount ? number_format($transaction->amount,0,',','.').' đ' : 'Miễn phí'?>
                                        </td>
                                        <td><?= $transaction['exam']['title'] ?></td>
                                        <td><?= date('H:i d/m/Y', $transaction->updated_at) ?></td>
                                        <td><span class="label label-success btn-xs">Thành công</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div id="act_buy" class="content_act <?= $type == TransactionHistory::SELL_EXAM ? '' : 'hide' ?>">
                        <div class="pal_top_search">
                            <strong class="total-money">Tổng tiền bán đề thi: <span
                                        style="color: red;"><?= number_format($totalMoney, 0, ',', '.') ?>
                                    đ</span></strong>
                        </div>
                        <table class="tb_tk_evenue">
                            <thead class="title_tk_eve">
                            <tr>
                                <td width="16%">Mã giao dịch</td>
                                <td width="12%">Số tiền</td>
                                <td width="20%">Đề thi đã bán</td>
                                <td width="14%">Thời gian</td>
                                <td width="12%">Trang thái</td>

                            </tr>
                            </thead>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?= $transaction->code ?></td>
                                    <td style="color: red; font-weight: bold; font-size: 14px">
                                        <?= $transaction->amount ? number_format($transaction->amount,0,',','.').' đ' : 'Miễn phí'?>
                                    </td>
                                    <td><?= $transaction['exam']['title'] ?></td>
                                    <td><?= date('H:i d/m/Y', $transaction->updated_at) ?></td>
                                    <td><span class="label label-success">Thành công</span></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <?php if (!count($transactions)): ?>
                        <div class="doc_list_cnt list_cnt_small list div_del" style="height: auto">
                            <div class="dataTables_empty"></div>
                            <div class="notify">
                                <span>Không có dữ liệu</span>
                            </div>
                        </div>
                    <?php endif; ?>
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