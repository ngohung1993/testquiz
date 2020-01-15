<?php
/* @var $this yii\web\View */
/* @var $exams \common\models\Exam */
/* @var $status */
/* @var $key */
/* @var $active */
/* @var TYPE_NAME $pages */

/* @var $topic \common\models\Topic */


use common\models\Topic;
use yii\helpers\Url;
use common\helpers\FunctionHelper;
use common\models\Exam;
use yii\web\View;
use yii\widgets\LinkPager;
$this->title = 'Danh sách đề thi';
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

    .course-items .content-course {
        border: 1px solid #ddd;
        box-shadow: 5px 5px 10px #ddd;
        min-height: 320px;
    }

    .header-classes {
        position: relative;
    }

    .header-classes img {
        width: 100%;
        height: 150px;
        cursor: pointer;
    }

    .header-hover-classes {
        display: none;
    }

    .panelButtonClass {
        position: absolute;
        top: 40%;
        width: 100%;
    }

    .content-classes {
        padding: 10px 10px 0 10px;
        text-align: left;
    }

    .des-course {
        height: 60px;
    }

    .course-items {
        padding-bottom: 20px;
    }

    .name-course-ngoai-ngu {
        font-weight: 700;
        width: calc(100% - 15px);
        height: 40px;

    }

    .money-course {
        border-radius: 5px;
        color: red;
        font-weight: bold;
        font-size: 13px;
        text-align: center;
        display: inline-block;
        padding: 3px;
        margin-bottom: 3px;
    }


    .app-view {
        text-align: center;
        top: 7px;
        left: 20px;
        opacity: .87;
        position: absolute;
        font-size: 12px;
        overflow: hidden;
        display: block;
    }

    .doc_man_hover {
        position: absolute;
        top: 180px;
        left: 0;
        display: none;
    }

    .page-course-1:hover .doc_man_hover {
        color: #00a888;
        /*background-position: -245px -362px;*/
        position: absolute;
        top: 185px;
        left: -39px;
        display: block;
    }

    @media only screen and (min-width: 320px) and (max-width: 425px) {
        .doc_man_hover {
            position: absolute;
            top: 166px;
            left: 0;
            display: block;
        }
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
</style>

<div class="col-sm-9 response" style="margin-top: -19px">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -10px; ">Đề thi thuộc chủ đề: <a
                    href="<?= Url::to(['topic/index', 'status' => $topic->status]) ?>"
                    style="display: inline-block"><span
                        style="font-weight: bolder; color: blue"><?= $topic->title ?></span></a></h3>
        <div class="content_user_info bg_none">
            <div class="top_doc_type" style="">
                <ul class="">
                    <li <?= $status == Exam::DUYET ? 'class="active_man"' : '' ?>>
                        <a for="man_radio" href="<?= Url::to(['topic', 'id' => $topic->id, 'status' => Exam::DUYET]) ?>">
                            <i class="icon_type_radio"></i>
                            <span>Được duyệt <em> (<?= FunctionHelper::countStatusExam($topic->id, Exam::DUYET, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li id="draft" <?= $status == Exam::KHO_USER ? 'class="active_man"' : '' ?>>
                        <a for="man_radio" href="<?= Url::to(['topic', 'id' => $topic->id, 'status' => Exam::KHO_USER]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Nháp<em> (<?= FunctionHelper::countStatusExam($topic->id, Exam::KHO_USER, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li <?= $status == Exam::CHO_DUYET ? 'class="active_man"' : '' ?>>
                        <a for="man_radio" href="<?= Url::to(['topic', 'id' => $topic->id, 'status' => Exam::CHO_DUYET ]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Chờ duyệt<em> (<?= FunctionHelper::countStatusExam($topic->id, Exam::CHO_DUYET, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li <?= $status == Exam::KHONG_DUYET ? 'class="active_man"' : '' ?>>
                        <a for="man_radio" href="<?= Url::to(['topic', 'id' => $topic->id, 'status' => Exam::KHONG_DUYET]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Không duyệt<em> (<?= FunctionHelper::countStatusExam($topic->id, Exam::KHONG_DUYET, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li <?= $status == Exam::EXAM_ERROR ? 'class="active_man"' : '' ?>>
                        <a for="man_radio" href="<?= Url::to(['topic', 'id' => $topic->id, 'status' => Exam::EXAM_ERROR]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Đề thi báo lỗi<em> (<?= FunctionHelper::countStatusExam($topic->id, Exam::KHONG_DUYET, $user) ?>)</em></span>
                        </a>
                    </li>
<!--                    <li class="">-->
<!--                        <a for="man_radio" href="--><!--">-->
<!--                            <i class="icon_type_radio"></i>-->
<!--                            <span>Lọc nâng cao</span>-->
<!--                        </a>-->
<!--                    </li>-->
                </ul>
                <div>
                    <div class="search_md transition1">
                        <form id="user_find_doc" name="search_md" method="GET"
                              action="<?= Url::to(['profile/list-exam-topic', 'id' => $topic->id, 'status' => $status]) ?>">
                            <input type="hidden" name="id" value="<?= $topic->id ?>">
                            <input type="hidden" name="status" value="<?= $status ?>">
                            <input placeholder="Tìm kiếm..." value="<?= $key ?>" name="key">
                            <a href="javascript:;" onclick="document.getElementById('user_find_doc').submit();"
                               class="icon_search_md icon"></a>
                        </form>
                    </div>
                    <a href="<?= Url::to(['profile/list-exam-topic', 'id' => $topic->id, 'status' => $status]) ?>"
                       style="display: inline-block; background: #fff; position: absolute; top: 11px; right: 32px; cursor: pointer; color: #337ab7"
                       title="Làm mới"><i class="fa fa-refresh" aria-hidden="true"></i></a>

                </div>

                <div class="clear"></div>
            </div>

            <div class="mn_doc_upload"></div>
            <div class="mn_list_view_more">
                <div class="list_doc_man">
                    <div class="container" style="background: #fff;">
                        <div class="examsResult" style="font-size: 14px">
                            <div class="row">
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
                                                    <!--                                                                <input style="margin-right: 10px; position: absolute; z-index: 1; top: 20px;left: -3px" title="" type="checkbox" class="minimal">-->
                                                    <a href="" class="ava-2-80">
                                                                <span>
                                                                    <img src="<?= $exam['avatar'] ?>" alt="">
                                                                </span>
                                                    </a>
                                                    <p><strong><?= $exam['title'] ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="wrapper-5 result-info">
                                                    <div class="col-md-4 col-xs-12 action">
                                                        <p class="text-left"><?= $exam['topic']['title'] ?></p>
                                                    </div>
                                                    <div class="col-md-2 col-xs-6 sm-center">
                                                        <p class="text-left"><?= date('H:i d/m/Y', $exam['created_at']) ?></p>
                                                    </div>
                                                    <div class="col-md-2 col-xs-6 sm-center">
                                                        <span class="statusIcon ico-pending info-tooltip"
                                                              data-toggle="tooltip" title=""
                                                              data-original-title="<?= $exam->getStatusLabel() ?>">
                                                            <i class="<?= $exam->getStatusIcon() ?>"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4 col-xs-6 sm-center">
                                                        <a href="<?= Url::to(['exam/view', 'id' => $exam->id]) ?>"
                                                           title="Xem đề" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if($exam['status'] == Exam::EXAM_ERROR):?>
                                                            <a href="<?= Url::to(['edit-question', 'id' => $exam->id]) ?>"
                                                               title="Sửa đề" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        <?php endif;?>
                                                        <?php if($exam['status'] == Exam::DUYET):?>
                                                            <a href="" title="Xóa đề" class="btn btn-danger btn-sm"
                                                               data-toggle="modal" data-target="#removeExamDuyet"
                                                               onclick="getRemoveExamDuyet(<?= $exam->id ?>)">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        <?php endif;?>
                                                        <?php if ($exam['status'] == Exam::KHO_USER || $exam['status'] == Exam::KHONG_DUYET): ?>
                                                            <a href="<?= Url::to(['update', 'id' => $exam['id']]) ?>"
                                                               title="Sửa đề" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                            <a href="" title="Xóa đề" class="btn btn-danger btn-sm"
                                                               data-toggle="modal" data-target="#myModal"
                                                               onclick="GetIdDelete(<?= $exam->id ?>)">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <?php if ($exam['status'] == Exam::KHO_USER || $exam['status'] == Exam::KHONG_DUYET) : ?>
                                                                <a href="" title="Gửi Admin duyệt"
                                                                   class="btn btn-success btn-sm" data-toggle="modal"
                                                                   data-target="#sendAdmin"
                                                                   onclick="getIdSendAdmin(<?= $exam->id ?>)">
                                                                    <i class="fa fa-upload"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if ($exam['status'] == Exam::CHO_DUYET): ?>
                                                            <a href="" class="btn btn-info btn-sm" title="Gỡ xuống"
                                                               data-toggle="modal" data-target="#removeExam"
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
                            <div class="doc_list_cnt list_cnt_small list div_del" style="height: auto">
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

<?= $this->render('modal') ?>
