<?php
/* @var $this yii\web\View */

use common\helpers\FunctionHelper;
use yii\helpers\Url;

$this->title = 'Thống kê';
?>

<style>
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

    .bold {
        font-weight: bold;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .left-box {
            margin: 0;
        }

        .response {
            padding-right: 10px !important;
        }
    }

    @media (max-width: 768px) and (min-width: 600px) {
        .tab-content {
            margin-top: -50px;
        }
        .ad_user_menu_left li a span{
            margin: 5px!important;
        }
    }
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<div class="col-sm-9 response" style="margin-top: -49px">
    <div class="tab-content">
        <div class="">
            <h3 class="ad_user_name">Thống kê</h3>
            <div class="row left-box">
                <div class="pal_history_surplus" id="list_history_finance"
                     style="border: 1px solid #e8e8e8; margin-top: 0; padding-bottom: 0">
                    <h4>Biểu đồ</h4>
                    <div id="act_rfd" class="content_act ">
                        <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="paging" style="margin: 0">

                    </div>
                </div>
            </div>
            <div class="row left-box">
                <div class="pal_history_surplus" id="list_history_finance"
                     style="border: 1px solid #e8e8e8; margin-top: 0; padding-bottom: 0;margin-top: 10px">
                    <h4>Top đề thi được mua nhiều nhất</h4>
                    <hr>
                    <div class="content_act ">
                        <div class="row">
                            <?php /** @var TYPE_NAME $topExam */
                            foreach ($topExam as $key => $value):?>
                            <div class="col-md-6">
                                <div class="box-de-thi" style="height: 100px">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="<?=Url::to(['exam/detail','slug'=> $value['exam']['slug']])?>">
                                                <img src="<?= $value['exam']['avatar']?>" class="media-object" style="width:80px"></a>
                                        </div>
                                        <div class="media-body">
                                            <a href="<?=Url::to(['exam/detail','slug'=> $value['exam']['slug']])?>" class="media-heading" style="font-weight: bold" title="<?=$value['exam']['title']?>"><?= FunctionHelper::cutString($value['exam']['title'])?></a>
                                            <p class="mt-10">
                                                <a href="" data-user-id="" data-user-group="" data-popup-user-id="" data-popup-user-name="" data-color="green">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <?=FunctionHelper::getUser($value['exam']['user_id'])['name']?>
                                                </a>
                                            </p>
                                            <div class="line-bt-exam"></div>
                                            <p class="luot-thi"><i class="fa fa-pencil-square-o"></i> <?=FunctionHelper::countNumberExam($value->exam_id)?> lượt thi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="paging" style="margin: 0">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Highcharts.chart('container1', {
        chart: {
            type: 'column',
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Thông kê chi tiết giao dịch từng tháng trong năm '+ <?= /** @var TYPE_NAME $year */
            $year ?>,
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Tháng 1',
                'Tháng 2',
                'Tháng 3',
                'Tháng 4',
                'Tháng 5',
                'Tháng 6',
                'Tháng 7',
                'Tháng 8',
                'Tháng 9',
                'Tháng 10',
                'Tháng 11',
                'Tháng 12'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Số tiền (đồng)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} đồng</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Bán đề',
            data: [
                <?php /** @var TYPE_NAME $arraySellExam */
                    foreach ($arraySellExam as $value){
                        echo $value.',';
                    }
                ?>
            ]

        }, {
            name: 'Mua đề',
            data: [
                <?php /** @var TYPE_NAME $arrayBuyExam */
                foreach ($arrayBuyExam as $value){
                    echo $value.',';
                }
                ?>
            ]

        }, {
            name: 'Nạp tiền',
            data: [
                <?php /** @var TYPE_NAME $arrayRecharge */
                foreach ($arrayRecharge as $value){
                    echo $value.',';
                }
                ?>
            ]

        }, {
            name: 'Rút tiền',
            data: [
                <?php /** @var TYPE_NAME $arrayWithdrawal */
                foreach ($arrayWithdrawal as $value){
                    echo $value.',';
                }
                ?>
            ]

        }]
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
