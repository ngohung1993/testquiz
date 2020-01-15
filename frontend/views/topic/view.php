<?php
/* @var $this yii\web\View */
/* @var $topic \common\models\Topic */
/** @var  $pages */
/* @var $classroomDetail \common\models\ClassroomDetail */

/* @var $exams */

use yii\helpers\Url;
use common\models\Topic;
use common\models\Exam;
use yii\widgets\LinkPager;

$this->title = 'Quản lý chủ đề';
$this->registerJsFile('@web/components/tinymce/tinymce.min.js');
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

    .examsResult ul li:nth-of-type(odd) .wrapper-5 {
        background: #f7f7f7;
        overflow: visible;
    }

    .wrapper-5 {
        padding: 5px;
    }

    .result-info {
        position: relative;
    }

    .examsResult .wrapper-5 {
        min-height: 60px;
    }

    .ava-2-80 span {
        width: 40px;
        height: 40px;
    }

    .ava-2-80 img {
        height: 50px;
        width: 50px;
    }

    .ava-2-80 {
        width: 60px;
    }

    .ava-2-80, .ava-2-60 {
        display: inline-block;
        position: relative;
        float: left;
    }

    .examsResult ul li > .row > .col-md-4, .col-md-8 {
        padding-left: 5px;
        padding-right: 5px;
    }

    .teacherResult > .row, .examsResult > .row {
        margin-left: 0;
        margin-right: 0;
        border-bottom: 2px solid #ededed;
        margin-bottom: 5px;
    }

    .examsResult a {
        color: #fff;
    }

    .statusIcon {
        border: 1px solid #e7e7e7;
        width: 40px;
        height: 40px;
        line-height: 40px;
        display: inline-block;
        text-align: center;
    }

    @media (min-width: 600px) and (max-width: 768px) {
        .response {
            padding-right: 10px !important;
        }

        .tab-content {
            margin-top: -31px;
        }

        .ad_user_menu_left li a span {
            margin: 5px !important;
        }
    }
</style>
<div class="col-sm-9 response" style="margin-top: -19px">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -10px">Chi tiết chủ đề : <a
                    href="<?= Url::to(['topic/index', 'status' => $topic->status]) ?>"
                    style="display: inline-block;"><span style="color: #1fb6ff"><?= $topic->title ?></span></a>
        </h3>

        <div class="content_user_info bg_none">
            <div class="mn_list_view_more">
                <div class="list_doc_man">
                    <div class="container" style="background: #fff; border: 1px solid #e8e8e8;">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="relative">
                                                <img src="<?= $topic->avatar ?>"
                                                     class="bs-lecture--detail-thumbnail img-responsive"
                                                     style="width: 100%">
                                                <?php if ($topic->status == 0): ?>
                                                    <div class="lecture-status"><i
                                                                class="fa fa-hourglass-half"></i> Chờ duyệt
                                                    </div>
                                                <?php elseif ($topic->status == 1): ?>
                                                    <div class="lecture-status"><i
                                                                class="fa fa-thumbs-o-up"></i> Duyệt
                                                    </div>
                                                <?php elseif ($topic->status == 2): ?>
                                                    <div class="lecture-status"><i class="fa fa-times"></i>
                                                        Không duyệt
                                                    </div>
                                                <?php else: ?>
                                                    <div class="lecture-status"><i
                                                                class="fa fa-exclamation-triangle"></i> Nháp
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <h5 class="bs-page-title text-break"
                                                style="font-size: 23px;font-weight: bold; color:  blue">
                                                <?= $topic->title ?>
                                            </h5>

                                            <div class="bs-lecture--detail-statistic">
                                                <div class="div-table" style="font-weight: bold">
                                                    <div class="div-table-row">
                                                        <div class="div-table-cell">Danh mục:</div>
                                                        <div class="div-table-cell"><?= $topic['category']['title'] ?></div>
                                                    </div>
                                                    <div class="div-table-row">
                                                        <div class="div-table-cell">Khối:</div>
                                                        <div class="div-table-cell"><?= $classroomDetail['classroom']['title'] ?></div>
                                                    </div>
                                                    <div class="div-table-row">
                                                        <div class="div-table-cell">Môn thi:</div>
                                                        <div class="div-table-cell"><?= $classroomDetail['subject']['title'] ?></div>
                                                    </div>
                                                    <div class="div-table-row">
                                                        <div class="div-table-cell">Tổng số đề thi:</div>
                                                        <div class="div-table-cell"><?= count($exams) ?></div>
                                                    </div>
                                                    <?php if ($topic->status == Topic::DUYET): ?>
                                                        <div class="div-table-row">
                                                            <div class="div-table-cell">Trạng thái:</div>
                                                            <div class="div-table-cell">
                                                                <?php if($topic->display == 1):?>
                                                                    <span class="label label-success">Hoạt động</span>
                                                                <?php else:?>
                                                                    <span class="label label-danger">Dừng hoạt động</span>
                                                                <?php endif;?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="m-t-md m-b" style="margin-top: 14px">
                                                    <?php if ($topic->status == Topic::DUYET): ?>
                                                        <button class="btn btn-primary" data-toggle="tooltip" title="Thay đổi hoạt động"
                                                                onclick="checkbox(<?= $topic->id ?>,<?=$topic->display?>)" id="frm-test-<?= $topic->id ?>">
                                                            <i class="fa fa-spinner" aria-hidden="true"></i> Thay đổi hoạt động
                                                        </button>
                                                    <?php elseif ($topic->status == Topic::CHO_DUYET): ?>
                                                        <button class="" data-toggle="modal"
                                                                data-target="#modalRemoveTopic"
                                                                style="position: relative;top: 21px;left: 40px; background-color: #00a888; color: #fff"
                                                                onclick="getIdremoveTopicAdmin(<?= $topic['id'] ?>)">
                                                            <i class="fa fa-download" aria-hidden="true"></i>
                                                            Gỡ chủ đề
                                                        </button>
                                                    <?php else: ?>
                                                        <a href="<?= Url::to(['topic/create', 'id' => $topic['id']]) ?>"
                                                           class="btn btn-info" style="color: #fff">
                                                            <b>Sửa chủ đề</b> &nbsp;
                                                            <i class="fa fa-pencil-square-o"></i>
                                                        </a>
                                                        <button class="btn btn-success" data-toggle="modal"
                                                                data-target="#modalSendTopicAdmin"
                                                                style=" color: #fff"
                                                                onclick="getIdTopicAdmin(<?= $topic['id'] ?>)"><i
                                                                    class="fa fa-share-square-o" aria-hidden="true"></i>
                                                            Gửi
                                                            Admin duyệt
                                                        </button>
                                                    <?php endif; ?>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="bs-lecture--detail-content m-y-lg">
                                        <div class="bs-lecture--detail-title">Mô tả chủ đề</div>
                                        <div class="bs-lecture--detail-section text-break">
                                            <?= $topic->description ?>
                                        </div>
                                        <div class="bs-lecture--detail-title">Danh sách đề thi</div>
                                        <div class="bs-lecture--detail-section text-break">
                                            <div class="mn_list_view_more">
                                                <div class="list_doc_man">
                                                    <div class="container" style="background: #fff;">
                                                        <div class="examsResult" style="font-size: 14px">
                                                            <div class="row hidden-sm hidden-xs">
                                                                <div class="col-md-4">
                                                                    <p><strong>Tên đề thi</strong></p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="col-md-4">
                                                                        <p><strong>Chủ đề</strong></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p><strong>Thời gian</strong></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p><strong>Trạng thái</strong></p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p><strong>Tác vụ</strong></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul>
                                                                <?php foreach ($exams as $key => $exam): ?>
                                                                    <li>
                                                                        <div class="row" style="margin: 0">
                                                                            <div class="col-md-4 col-xs-12">

                                                                                <div class="wrapper-5">
                                                                                    <a href="" class="ava-2-80">
                                                                                        <span>
                                                                                            <img src="<?= $exam['avatar'] ?>"
                                                                                                 alt="">
                                                                                        </span>
                                                                                    </a>
                                                                                    <p>
                                                                                        <strong><?= $exam['title'] ?></strong>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-8 col-xs-12">
                                                                                <div class="wrapper-5 result-info">

                                                                                    <div class="col-md-4 col-sm-3">
                                                                                        <p class="text-left"><?= $exam['topic']['title'] ?></p>
                                                                                    </div>
                                                                                    <div class="col-md-2 col-xs-6 sm-center">
                                                                                        <p class="text-left"><?= date('d/m/Y H:i', $exam['created_at']) ?></p>
                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-3">
                                                                                        <?php if ($exam['status'] == Exam::KHO_USER): ?>
                                                                                            <span class="statusIcon ico-draft info-tooltip "
                                                                                                  data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="Lưu nháp"><i
                                                                                                        class="fa fa-pencil"></i></span>
                                                                                        <?php elseif ($exam['status'] == Exam::CHO_DUYET): ?>
                                                                                            <span class="statusIcon ico-pending info-tooltip "
                                                                                                  data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="Chờ duyệt"><i
                                                                                                        class="fa fa-bookmark-o"></i></span>
                                                                                        <?php elseif ($exam['status'] == Exam::DUYET): ?>
                                                                                            <span class="statusIcon ico-pending info-tooltip "
                                                                                                  data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="duyệt"><i
                                                                                                        class="fa fa-thumbs-o-up"></i></span>
                                                                                        <?php else: ?>
                                                                                            <span class="statusIcon ico-pending info-tooltip "
                                                                                                  data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="Không duyệt"><i
                                                                                                        class="fa fa-exclamation-circle"></i></span>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-6">
                                                                                        <a href="<?= Url::to(['exam/view', 'id' => $exam->id]) ?>"
                                                                                           title="Xem đề"
                                                                                           class="btn btn-primary btn-sm">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </a>
                                                                                        <?php if ($exam['status'] == Exam::KHO_USER || $exam['status'] == Exam::KHONG_DUYET): ?>
                                                                                            <a href="<?= Url::to(['exam/update', 'id' => $exam['id']]) ?>"
                                                                                               title="Sửa đề"
                                                                                               class="btn btn-warning btn-sm">
                                                                                                <i class="fa fa-edit"></i>
                                                                                            </a>

                                                                                            <a href="" title="Xóa đề"
                                                                                               class="btn btn-danger btn-sm"
                                                                                               data-toggle="modal"
                                                                                               data-target="#myModal"
                                                                                               onclick="GetIdDelete(<?= $exam->id ?>)">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </a>
                                                                                            <?php if ($exam['status'] == Exam::KHO_USER) : ?>
                                                                                                <a href=""
                                                                                                   title="Gửi Admin duyệt"
                                                                                                   class="btn btn-success btn-sm    "
                                                                                                   data-toggle="modal"
                                                                                                   data-target="#sendAdmin"
                                                                                                   onclick="getIdSendAdmin(<?= $exam->id ?>)">
                                                                                                    <i class="fa fa-upload"></i>
                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        <?php endif; ?>
                                                                                        <?php if ($exam['status'] == Exam::CHO_DUYET): ?>
                                                                                            <a href=""
                                                                                               class="btn btn-info"
                                                                                               title="Gỡ xuống"
                                                                                               data-toggle="modal"
                                                                                               data-target="#removeExam"
                                                                                               onclick="GetIdRemoveExam(<?= $exam->id ?>)">
                                                                                                <i class="fa fa-download"></i>
                                                                                            </a>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <?php if (!count($exams)): ?>
                                                            <div class="doc_list_cnt list_cnt_small list div_del"
                                                                 style="height: auto">
                                                                <div class="dataTables_empty"></div>
                                                                <div class="notify">
                                                                    <span>Không có dữ liệu</span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="paging">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }
</style>
<?= $this->render('modal') ?>
<div id="myModal" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="exam_id">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px; ">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <h5 style="color: red">Bạn có đồng ý xóa đề thi này không?</h5>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success"
                        data-dismiss="modal" onclick="deleteExamUser()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="sendAdmin" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_exam">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Gửi đề thi Admin duyệt.</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Đề thi của bạn sẽ chuyển qua trạng thái chờ
                    duyệt</p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success"
                        data-dismiss="modal" onclick="sendAdminExam()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="removeExam" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_exam_remove">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Gỡ đề thi xuống.</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Đề thi chỉ được gỡ khi đề thi đang <span
                            style="font-weight: bold; color: blue">chờ Admin duyệt</span></p>
                <p style="font-style: italic; font-size: 14px">- Đề thi gỡ xuống sẽ chuyển về <span
                            style="font-weight: bold; color: blue">Nháp</span> </span></p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success"
                        data-dismiss="modal" onclick="removeExamDown()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>