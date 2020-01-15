<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $accounts common\models\AccountBank */

$this->title = 'Tài khoản ngân hàng';
$this->registerJsFile('@web/theme/js/finance.js');
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

    .doc_man_hover {
        width: 100%;
        position: absolute;
        top: 0;
        left: -73px;
        display: block;
    }
</style>

<div class="col-sm-9 response" style="margin-top: -49px">
    <div class="tab-content">
        <div class="">
            <h3 class="ad_user_name">Quản lý tài chính</h3>
            <div class="row">
                <div class="pal_history_surplus" id="list_history_finance" style="margin-top: -10px">
                    <h4>Danh sách tài khoản
                        <a href="<?=Url::to(['create-account'])?>" class="ps-btn pull-right" title="Tạo tài khoản ngân hàng" style="background: #1fb6ff; color: #fff"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
                    </h4>
                    <p style="font-style: italic; color: red">(Vui lòng chọn 1 tài khoản mặc định)</p>
                    <div id="act_buy" class="content_act">
                        <table class="tb_tk_evenue">
                            <thead class="title_tk_eve">
                            <tr>
                                <td width="16%">Số tài khoản</td>
                                <td width="14%">Chủ tài khoản</td>
                                <td width="20%">Tên ngân hàng</td>
                                <td width="12%">Chi nhánh</td>
                                <td width="12%">Tác vụ</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($accounts as $account):?>
                                <tr>
                                    <td><?=$account->account_number?> <?=$account->status == 1 ? '<span class="label label-danger">Mặc định</span>' : ''?></td>
                                    <td><?=$account->account_name?></td>
                                    <td><?=$account->name_bank?></td>
                                    <td><?=$account->bank_branch?></td>
                                    <td>
                                        <a style="background: #1fb6ff; color: #fff" class="btn btn-info" href="<?=Url::to(['update-account','id'=> $account->id])?>" title="Sửa"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <?=Html::a(Yii::t('backend', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $account->id], [
                                            'class' => 'btn btn-danger tip text-center',
                                            'style' => ' color: #fff',
                                            'title'=>'Xóa',
                                            'data' => [
                                                'confirm' => Yii::t('backend', 'Bạn có chắc chắn muốn xóa?'),
                                                'method' => 'post',
                                            ],
                                        ])?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>