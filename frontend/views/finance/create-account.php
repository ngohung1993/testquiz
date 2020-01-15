<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Quản lý tài chính';
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
                    <h4>Thêm tài khoản ngân hàng</h4>
                    <div id="act_buy" class="content_act">
                        <div class="container">
                            <div class="row">
                                <?= $this->render('_form', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
