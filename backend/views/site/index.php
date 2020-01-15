<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;
use common\models\TransactionHistory;

/* @var $this yii\web\View */
/** @var TYPE_NAME $year */

$this->title = 'Bảng điều khiển';
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<style>
    .info-box{
        margin-bottom: 12px;
    }
    .info-box-content{
        margin-left: 0;
    }
    .info-box-text{
        font-weight: bold;
    }
    .info-box-number{
        color: red;
        font-size: 16px;
    }
    .img-user{
        border-radius: 50%;
        border: 1px solid #f5f5f5;
        padding: 5px;
    }
    .info-box-icon{
        background: #fff;
        width: 60px;
        height: 60px;
        margin-right: 10px;
    }
</style>
<div class="page-content " style="min-height: 602px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Bảng điều khiển</li>
    </ol>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="<?= Url::to( [ 'user/client' ] ) ?>">
                <div class="visual">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup">
                            <?= /** @var TYPE_NAME $classrooms */
                            count($user)?>
                        </span>
                    </div>
                    <div class="desc"> Thành viên</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="<?= Url::to( [ 'category/index' ] ) ?>">
                <div class="visual">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup">
                            <?= /** @var TYPE_NAME $subjects */
                            count($category)?>
                        </span>
                    </div>
                    <div class="desc">Danh mục</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue"
               href="<?= Url::to( [ 'topic/index','status'=> \common\models\Topic::DUYET ] ) ?>">
                <div class="visual">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup">
                            <?= /** @var TYPE_NAME $topics */
                             count($topics)?>
                        </span>
                    </div>
                    <div class="desc">Chủ đề duyệt</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="<?= Url::to( [ 'exam/index','status'=> \common\models\Exam::DUYET ] ) ?>">
                <div class="visual">
                    <i class="fa fa-files-o" aria-hidden="true"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup">
                            <?= /** @var TYPE_NAME $exams */
                            count($exams) ?>
                        </span>
                    </div>
                    <div class="desc">Đề thi duyệt</div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div id="list_widgets">
            <div class="col-md-9 col-sm-8 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Biểu đồ thống kê</span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto;">
                        <div id="container"></div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-spinner" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Thống kê số liệu</span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Doanh thu năm <?=$year?></span>
                                        <span class="info-box-number">
                                            <?= /** @var TYPE_NAME $totalMoneyCurrentYear */
                                            number_format($totalMoneyCurrentYear,0,',','.')?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Doanh thu trong ngày</span>
                                        <span class="info-box-number">
                                            <?= /** @var TYPE_NAME $totalMoneyDay */
                                            number_format($totalMoneyDay,0,',','.')?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Doanh thu năm <?=$year-1?></span>
                                        <span class="info-box-number">
                                            <?= /** @var TYPE_NAME $totalMoneyLastYear */
                                            number_format($totalMoneyLastYear,0,',','.')?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="portlet light bordered portlet-no-padding" style="padding-bottom: 7px">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-spinner" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Thống kê chi tiết theo ngày</span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <div class="col-md-12">
                                <div class="info-box" style="min-height: unset; margin-bottom: 23px">
                                    <input class="form-control" type="text" name="daterange" value="" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Doanh thu</span>
                                        <span class="info-box-number" id="filter_money">
                                            <?= /** @var TYPE_NAME $totalMoneyDay */
                                            number_format($totalMoneyDay,0,',','.')?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div id="list_widgets">
            <div class="col-md-3 col-sm-3 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Top 5 thành viên <strong>mua đề thi</strong></span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <?php /** @var TYPE_NAME $topUserSellExam */
                            foreach ($topUserSellExam as $key => $value):?>
                                <div class="col-md-12">
                                    <div class="info-box" style="min-height: 60px">
                                        <div class="info-box-icon font-white" style="">
                                            <?php if(!$value['user']['avatar']):?>
                                                <img class="img-user" src="/uploads/cms/img/avatar.png" width="100%" height="60px">
                                            <?php else:?>
                                                <?php if($value['user']['auth'] == 1): ?>
                                                    <img class="img-user" src="https://graph.facebook.com/<?=$value['user']['avatar']?>/picture?type=normal" width="100%" height="60px">
                                                <?php else:?>
                                                    <img class="img-user" src="<?=$value['user']['avatar']?>" width="100%" height="60px">
                                                <?php endif;?>
                                            <?php endif;?>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                <a href="<?=Url::to(['user/view','id'=> $value['user']['id']])?>">
                                                    <?=$value['user']['name']?>
                                                    <span class="fa fa-external-link"></span>
                                                </a>

                                            </span>
                                            <span class="info-box-number" style="color: blue; font-size: 14px">
                                                <?= FunctionHelper::countBuyOrSellExamUser($value['user']['id'], TransactionHistory::SELL_EXAM)?> đề
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Top 5 thành viên <strong>bán đề thi</strong></span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <?php /** @var TYPE_NAME $topUserBuyExam */
                            foreach ($topUserBuyExam as $key => $value):?>
                            <div class="col-md-12">
                                <div class="info-box" style="min-height: 60px">
                                    <div class="info-box-icon font-white" style="">
                                        <?php if(!$value['user']['avatar']):?>
                                            <img class="img-user" src="/uploads/cms/img/avatar.png" width="100%" height="60px">
                                        <?php else:?>
                                            <?php if($value['user']['auth'] == 1): ?>
                                                <img class="img-user" src="https://graph.facebook.com/<?=$value['user']['avatar']?>/picture?type=normal" width="100%" height="60px">
                                            <?php else:?>
                                            <img class="img-user" src="<?=$value['user']['avatar']?>" width="100%" height="60px">
                                            <?php endif;?>
                                        <?php endif;?>
                                    </div>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <a href="<?=Url::to(['user/view','id'=> $value['user']['id']])?>">
                                                <?=$value['user']['name']?>
                                                <span class="fa fa-external-link"></span>
                                            </a>
                                        </span>
                                        <span class="info-box-number" style="color: blue; font-size: 14px">
                                            <?= FunctionHelper::countBuyOrSellExamUser($value['user']['id'], TransactionHistory::BY_EXAM)?> lần
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Top 5 thành viên <strong>nạp tiền</strong></span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <?php
                            /** @var TYPE_NAME $topUserRecharge */
                            foreach ($topUserRecharge as $key => $value):?>
                                <div class="col-md-12">
                                    <div class="info-box" style="min-height: 60px">
                                        <div class="info-box-icon font-white" style="">
                                            <?php if(!$value['user']['avatar']):?>
                                                <img class="img-user" src="/uploads/cms/img/avatar.png" width="100%" height="60px">
                                            <?php else:?>
                                                <?php if($value['user']['auth'] == 1): ?>
                                                    <img class="img-user" src="https://graph.facebook.com/<?=$value['user']['avatar']?>/picture?type=normal" width="100%" height="60px">
                                                <?php else:?>
                                                    <img class="img-user" src="<?=$value['user']['avatar']?>" width="100%" height="60px">
                                                <?php endif;?>
                                            <?php endif;?>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                <a href="<?=Url::to(['user/view','id'=> $value['user']['id']])?>">
                                                    <?=$value['user']['name']?>
                                                    <span class="fa fa-external-link"></span>
                                                </a>

                                            </span>
                                            <span class="info-box-number" style="color: red; font-size: 14px">
                                                <?=number_format($value['tong'],0,',','.')?> đ
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Top 5 thành viên <strong>rút tiền</strong></span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <?php
                            /** @var TYPE_NAME $topUserWithdrawal */
                            foreach ($topUserWithdrawal as $key => $value):?>
                                <div class="col-md-12">
                                    <div class="info-box" style="min-height: 60px">
                                        <div class="info-box-icon font-white" style="">
                                            <?php if(!$value['user']['avatar']):?>
                                                <img class="img-user" src="/uploads/cms/img/avatar.png" width="100%" height="60px">
                                            <?php else:?>
                                                <?php if($value['user']['auth'] == 1): ?>
                                                    <img class="img-user" src="https://graph.facebook.com/<?=$value['user']['avatar']?>/picture?type=normal" width="100%" height="60px">
                                                <?php else:?>
                                                    <img class="img-user" src="<?=$value['user']['avatar']?>" width="100%" height="60px">
                                                <?php endif;?>
                                            <?php endif;?>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                <a href="<?=Url::to(['user/view','id'=> $value['user']['id']])?>">
                                                    <?=$value['user']['name']?>
                                                    <span class="fa fa-external-link"></span>
                                                </a>

                                            </span>
                                            <span class="info-box-number" style="color: red; font-size: 14px">
                                                <?=number_format($value['tong'],0,',','.')?> đ
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div id="list_widgets">
            <div class="col-md-9 col-sm-9 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Biểu đồ thống kê</span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto;">
                        <div id="container1"></div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>

            <div class="col-md-3 col-sm-4 col-xs-12 widget_item">
                <div class="portlet light bordered portlet-no-padding">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-spinner" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Thống kê số liệu</span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tổng đề thi giao dịch năm <?=$year?></span>
                                        <span class="info-box-number" style="color: blue">
                                            <?= /** @var TYPE_NAME $countExamYear */
                                            $countExamYear ?> đề
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tổng đề thi giao dịch năm <?=$year-1?></span>
                                        <span class="info-box-number" style="color: blue">
                                            <?= /** @var TYPE_NAME $countExamLastYear */
                                            $countExamLastYear ?> đề
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="portlet light bordered portlet-no-padding" style="padding-bottom: 7px">
                    <div class="portlet-title" style="padding-top: 10px">
                        <div class="caption">
                            <i class="fa fa-spinner" aria-hidden="true"></i>
                            <span class="caption-subject font-dark">Thống kê chi tiết theo ngày</span>
                        </div>
                    </div>
                    <div class="portlet-body widget-content" style="min-height: auto; padding-top: 10px">
                        <div class="portlet-body widget-content" style="min-height: auto;">
                            <div class="col-md-12">
                                <div class="info-box" style="min-height: unset;">
                                    <input class="form-control" type="text" name="daterangeExam" value="" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Số lượng đề</span>
                                        <span class="info-box-number" id="filter_exam" style="color: blue">
                                            <?= /** @var TYPE_NAME $countExamDay */
                                            $countExamDay ?> đề
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
        <div class="page-footer" style="position: fixed;margin-left: 250px;">
        <div class="page-footer-inner">
            <div class="row">
                <div class="col-md-6">
                    Copyright 2018 © TIGER CMS Technologies. Version:
                    <span>2.0</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Highcharts.chart('container', {

        title: {
            text: 'Thống kê doanh thu những tháng trong năm '+ <?= $year ?>
        },
        credits: {
            enabled: false
        },
        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: 'Số tiền'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 1
            }
        },

        series: [{
            name: 'Năm '+  <?= $year ?>,
            data: [<?php
                /** @var TYPE_NAME $arrayCurrentYear */
                foreach ($arrayCurrentYear as $value){
                        echo $value.',';
                    }
                ?>]
        }, {
            name: 'Năm '+  <?= $year-1 ?>,
            data: [<?php
                /** @var TYPE_NAME $arrayLastYear */
                foreach ($arrayLastYear as $value){
                    echo $value.',';
                }
                ?>]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
    Highcharts.chart('container1', {

        title: {
            text: 'Thống kê giao dịch đề thi những tháng trong năm '+ <?= $year ?>,

        },
        subtitle: {
            text: 'Ghi chú: Số đề thi mua và số đề thi bán của từng tháng là bằng nhau'
        },

        yAxis: {
            title: {
                text: 'Số lượng đề giao dịch'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 1
            }
        },

        series: [{
            name: 'Năm '+  <?= $year ?>,
            data: [<?php
                /** @var TYPE_NAME $arrayBuySellExamYear */
                foreach ($arrayBuySellExamYear as $value){
                    echo $value[3].',';
                }
                ?>]
        }, {
            name: 'Năm '+  <?= $year-1 ?>,
            data: [<?php
                /** @var TYPE_NAME $arrayBuySellExamLastYear */
                foreach ($arrayBuySellExamLastYear as $value){
                    echo $value[3].',';
                }
                ?>]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            let start_time =   start.format('YYYY-MM-DD');
            let end_time = end.format('YYYY-MM-DD');

            $.ajax({
                type: 'POST',
                url: '/admin/ajax/get-total-money',
                data: {
                    start_time: start_time,
                    end_time: end_time,
                },
                success: function (data) {
                    console.log(data);
                    $('#filter_money').text(formatNumber(data, '.', '.') + ' đ');
                }
            })
        });
    });
    $(function() {
        $('input[name="daterangeExam"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            let start_time =   start.format('YYYY-MM-DD');
            let end_time = end.format('YYYY-MM-DD');

            $.ajax({
                type: 'POST',
                url: '/admin/ajax/get-total-exam',
                data: {
                    start_time: start_time,
                    end_time: end_time,
                },
                success: function (data) {
                    console.log(data);
                    $('#filter_exam').text(data+' đề');
                }
            })
        });
    });
    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }
</script>