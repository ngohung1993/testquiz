<?php

use yii\helpers\Url;
use common\models\Exam;
use common\models\Topic;
use yii\widgets\LinkPager;
use common\helpers\FunctionHelper;

/* @var $key */
/* @var $status */
/* @var $pages */
/* @var $topics array Topic */
/* @var $this yii\web\View */

$this->title = 'Quản lý chủ đề';

$this->registerJsFile('@web/theme/js/document.js');

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


        @media (min-width: 768px) {
            .check-action {
                position: absolute;
                top: 50px;
                right: -3px
            }

            .detail-topic {
                position: absolute;
                top: 15px;
                right: 10px;
                font-size: 15px
            }

            .deleteitem {
                right: -50px !important;
                top: 15px !important;
            }
        }

        @media (max-width: 768px) {
            .top_doc_type {
                height: auto !important;
            }

            .check-action {
                position: absolute;
                top: 80%;
            }

            .detail-topic {
                position: absolute;
                top: -26px;
                right: -120px;
                font-size: 15px
            }

            .deleteitem {
                top: -27px !important;
                left: 305px !important;
            }
        }

        @media (min-width: 600px) and (max-width: 768px) {
            .response {
                padding-right: 10px !important;
            }

            .detail-topic {
                position: absolute;
                top: 8px;
                right: -50px;
                font-size: 15px;
            }

            .button-left {
                text-align: right;
            }

            .tab-content {
                margin-top: -31px;
            }

            .ad_user_menu_left li a span {
                margin: 5px !important;
            }

            .send-admin {
                position: relative;
                top: 50px;
                right: 14px;
            }
        }

        @media (min-width: 320px) and (max-width: 425px) {
            .send-admin {
                position: relative;
                top: 129px;
                right: 14px;
            }
        }
        .box-de-thi {
            margin-left: 15px;
            margin-right: 15px;
            border-bottom: 1px solid #f5f5f5;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .media-left, .media-right {
            display: table-cell;
            vertical-align: top;
        }
        .box-de-thi a.media-heading {
            font-weight: bold;
            color: #555;
        }
        .media-heading {
            margin-top: 0;
            margin-bottom: 5px;
        }
        .bs-user-list-teacher{
            background: #fff;
            margin-top: -9px;
            border: 1px solid #e8e8e8;
        }
    </style>

    <div class="col-sm-9 response" style="margin-top: -20px;">
        <div class="tab-content">
            <h3 class="ad_user_name" style="margin-top: -10px">
                Quản lý chủ đề
            </h3>
            <div class="content_user_info bg_none">
                <div class="top_doc_type">
                    <ul class="">
                        <li <?= $status == Topic::DUYET ? 'class="active_man"' : '' ?>>
                            <a href="<?= Url::to(['index', 'status' => 1]) ?>">
                                <i class="icon_type_radio"></i>
                                <span>Được duyệt <em> (<?= FunctionHelper::countStatusTopic($user, Topic::DUYET) ?>
                                        )</em></span>
                            </a>
                        </li>
                        <li <?= $status == Topic::KHO_USER ? 'class="active_man"' : '' ?>>
                            <a href="<?= Url::to(['index', 'status' => 3]) ?>">
                                <i class="icon_type_radio"></i>
                                <span><i class="warn warning"></i>Nháp<em> (<?= FunctionHelper::countStatusTopic($user, Topic::KHO_USER) ?>
                                        )</em></span>
                            </a>
                        </li>
                        <li <?= $status == Topic::CHO_DUYET ? 'class="active_man"' : '' ?>>
                            <a href="<?= Url::to(['index', 'status' => 0]) ?>">
                                <i class="icon_type_radio"></i>
                                <span><i class="warn warning"></i>Chờ duyệt<em> (<?= FunctionHelper::countStatusTopic($user, Topic::CHO_DUYET) ?>
                                        )</em></span>
                            </a>
                        </li>
                        <li <?= $status == Topic::KHONG_DUYET ? 'class="active_man"' : '' ?>>
                            <a href="<?= Url::to(['index', 'status' => 2]) ?>">
                                <i class="icon_type_radio"></i>
                                <span><i class="warn warning"></i>Không duyệt<em> (<?= FunctionHelper::countStatusTopic($user, Topic::KHONG_DUYET) ?>
                                        )</em></span>
                            </a>
                        </li>
                    </ul>
                    <div>
                        <div class="search_md transition1">
                            <form id="user_find_doc" name="search_md" method="GET" action="<?= Url::to(['index']) ?>">
                                <input type="hidden" name="status" value="<?= $status ?>">
                                <label>
                                    <input placeholder="Tìm kiếm..." value="<?= $key ?>" name="key">
                                </label>
                                <a href="javascript:" onclick="document.getElementById('user_find_doc').submit();"
                                   class="icon_search_md icon"></a>
                            </form>
                        </div>
                        <a href="<?= Url::to(['index', 'status' => $status]) ?>"
                           style="display: inline-block; background: #fff; position: absolute; top: 11px; right: 32px; cursor: pointer; color: #337ab7"
                           title="Làm mới"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="mn_doc_upload">

                </div>
                <div class="mn_list_view_more">
                    <div class="list_doc_man">
                        <div class="container" style="padding: 0; background: #fff">
                        <?php if (count($topics) > 0): ?>
                            <?php foreach ($topics as $key => $value): ?>
                                <div class="box-de-thi ">
                                    <div class="media">
                                        <div class="row">
                                            <div class=" col-md-2 col-sm-4">
                                                <a href="<?= Url::to(['exam/topic', 'id' => $value['id'], 'status' => Exam::DUYET]) ?>">
                                                    <img src="<?=$value->avatar?>" class="media-object" style="width:100px; height: 100px">
                                                </a>
                                            </div>
                                            <div class=" col-md-6 col-sm-4">
                                                <a href="<?= Url::to(['exam/topic', 'id' => $value['id'], 'status' => Exam::DUYET]) ?>" class="media-heading" title="<?=$value->title?>"><?=$value->title?></a>

                                                <div class="line-bt-exam"></div>
                                                <p class="mon-lop"><?=FunctionHelper::get_classroom_by_topic_id($value->id)['title']?> - <?=FunctionHelper::get_subject_by_topic_id($value->id)['title']?></p>
                                                <p class="luot-thi">
                                                    <i class="fa fa-files-o" aria-hidden="true"></i>
                                                    <?=FunctionHelper::countExamTopic($value->id,$value->user_id)?>
                                                    đề thi
                                                </p>
                                                <?php if ($value->status == Topic::DUYET): ?>
                                                <p class="mon-lop">
                                                    <?php if($value->display == 1):?>
                                                        <span class="label label-success">Hoạt động</span>
                                                    <?php else:?>
                                                        <span class="label label-danger">Dừng hoạt động</span>
                                                    <?php endif;?>
                                                </p>
                                                <?php endif;?>
                                            </div>
                                            <div class=" col-md-4 col-sm-4" style="margin-top: 10px">
                                                <p class="mt-10 text-center">
                                                    <a href="" >
                                                        Ngày tạo: <?=date('d/m/Y H:i',$value->created_at)?>
                                                    </a>
                                                </p>
                                                <div class="text-center">
                                                    <a class="btn btn-info" href="<?= Url::to(['topic/view', 'id' => $value->id]) ?>" data-toggle="tooltip" title="Xem chi tiết" style="background: #fff; color: blue">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <?php if ($value['status'] == Topic::CHO_DUYET): ?>
                                                    <span data-toggle="modal" data-target="#modalRemoveTopic" onclick="getIdremoveTopicAdmin(<?= $value['id'] ?>)">
                                                        <button class="btn btn-success" title="Gỡ chủ đề" data-toggle="tooltip" >
                                                            <i class="fa fa-download" aria-hidden="true"></i>
                                                        </button>
                                                    </span>
                                                    <?php endif;?>
                                                    <?php if ($value['status'] == Topic::KHO_USER || $value['status'] == Topic::KHONG_DUYET): ?>
                                                    <span data-toggle="modal"  data-target="#modalSendTopicAdmin" onclick="getIdTopicAdmin(<?= $value['id'] ?>)">
                                                        <button class="btn btn-success" title="Gửi Admin Duyệt" data-toggle="tooltip">
                                                            <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                                        </button>
                                                    </span>

                                                    <span data-toggle="modal" data-target="#deleteTopicUser" onclick="getIddeleteTopicUser(<?= $value['id'] ?>)">
                                                        <button class="btn btn-danger" title="Xóa chủ đề" data-toggle="tooltip">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                    </span>

                                                    <a class="btn btn-info" data-toggle="tooltip" title="Sửa chủ đề" href="<?= Url::to(['topic/create', 'id' => $value['id']]) ?>"  style="color: #fff">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    <?php endif;?>

                                                    <?php if ($value->status == Topic::DUYET): ?>
                                                        <button class="btn btn-primary" data-toggle="tooltip" title="Thay đổi hoạt động"
                                                                onclick="checkbox(<?= $value->id ?>,<?=$value->display?>)" id="frm-test-<?= $value->id ?>">
                                                            <i class="fa fa-spinner" aria-hidden="true"></i>
                                                        </button>
                                                        <span data-toggle="modal" data-target="#hiddenTopicUser" onclick="getIdHiddenTopicUser(<?= $value['id'] ?>)">
                                                        <button class="btn btn-danger" title="Xóa chủ đề" data-toggle="tooltip">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                        </span>

                                                    <?php endif;?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="doc_list_cnt list_cnt_small list div_del" style="height: auto">
                                <div class="dataTables_empty"></div>
                                <div class="notify">
                                    <span>Không có dữ liệu</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        </div>
                        <div class="clear"></div>
                        <div class="paging">
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
        </div>
    </div>
<?= $this->render('modal') ?>