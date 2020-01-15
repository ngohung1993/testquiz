<?php
/* @var $this yii\web\View */
/* @var $exams \common\models\Exam */
/* @var $price */
/* @var $status */
/* @var $active */
/* @var $id */
/* @var $topic \common\models\Topic */

/** @var TYPE_NAME $pages */

use common\models\Topic;
use yii\helpers\Url;
use common\helpers\FunctionHelper;
use common\models\Exam;
use yii\web\View;
use yii\widgets\LinkPager;

$this->title = 'Danh sách đề thi';
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
        background: #fff;
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
        top: 187px;
        left: 0;
        display: none;
    }

    .page-course-1:hover .doc_man_hover {
        color: #00a888;
        /*background-position: -245px -362px;*/
        position: absolute;
        top: 186px;
        left: -39px;
        display: block;
    }

    @media only screen and (min-width: 320px) and (max-width: 425px) {
        .doc_man_hover {
            position: absolute;
            top: 187px;
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

</style>

<div class="col-sm-9 response" style="margin-top: -19px">
    <div class="tab-content">
        <?php if ($id): ?>
            <h3 class="ad_user_name" style="margin-top: -10px; ">Đề thi thuộc chủ đề: <a
                        href="<?= Url::to(['topic/index']) ?>"
                        style="display: inline-block"><span
                            style="font-weight: bolder; color: blue"><?= $topic->title ?></span></a></h3>
            <section class="doc_navicate" style="padding-top: 0">
                <ul>
                    <li>
                        <a href="<?= Url::to(['document', 'status' => 1]) ?>" title="trang chủ">Chủ đề</a>
                    </li>
                    <li class="cat_nav_pa" itemtype="   " itemscope="">
                        <i class="icon_nav_ctn"></i>
                        <a itemprop="url" class="cat_nav_top_a" href="#" title=""><span
                                    itemprop="title">Danh sách đề thi</span></a>
                    </li>

                </ul>
            </section>
        <?php else: ?>
            <h3 class="ad_user_name" style="margin-top: -10px; ">Danh sách đề thi
            </h3>
        <?php endif; ?>
        <div class="content_user_info bg_none">
            <div class="top_doc_type" style="">
                <ul class="">
                    <li>
                        <a form="man_radio" href="<?= Url::to(['index', 'status' => 1]) ?>">
                            <i class="icon_type_radio"></i>
                            <span>Được duyệt <em> (<?= FunctionHelper::countStatusExamUser(Exam::DUYET, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li>
                        <a form="man_radio" href="<?= Url::to(['index', 'status' => 3]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Nháp<em> (<?= FunctionHelper::countStatusExamUser(Exam::KHO_USER, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li>
                        <a form="man_radio" href="<?= Url::to(['index', 'status' => 0]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Chờ duyệt<em> (<?= FunctionHelper::countStatusExamUser(Exam::CHO_DUYET, $user) ?>)</em></span>
                        </a>
                    </li>
                    <li class="active_man">
                        <a for="man_radio">
                            <input type="hidden" name="man_radio" id="man_radio4" class="man_radio">
                            <i class="icon_type_radio"></i>
                            <span>Lọc nâng cao</span>
                        </a>
                    </li>
                </ul>
                <div>
                    <div class="search_md transition1">
                        <form id="user_find_doc" name="search_md" method="GET"
                              action="<?= Url::to(['exam/index', 'status' => $status]) ?>">
                            <input type="hidden" name="status" value="<?= $status ?>">
                            <input placeholder="Tìm kiếm..." value="" name="key">
                            <a href="javascript:;"
                               onclick="document.getElementById('user_find_doc').submit();"
                               class="icon_search_md icon"></a>
                        </form>
                    </div>
                    <a href="<?= Url::to(['profile/list-exam', 'status' => $status]) ?>"
                       style="display: inline-block; background: #fff; position: absolute; top: 11px; right: 32px; cursor: pointer; color: #337ab7"
                       title="Làm mới"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="doc_manager_filter">
                <form id="user_find_doc_advanced" name="search_md" method="GET"
                      action="<?= Url::to(['exam/filter']) ?>">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mn_list_document" style="width: 240px">
                        <h4>Duyệt tài liệu</h4>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="1" <?= $status == 1 ? 'checked="checked"' : '' ?>>
                            Được duyệt <?php if ($id): ?>
                                <span>(<?= FunctionHelper::countStatusExam($id, Exam::DUYET, $user) ?>)</span>
                            <?php else: ?>
                                <span>(<?= FunctionHelper::countStatusExamUser(Exam::DUYET, $user) ?>)</span>
                            <?php endif; ?>
                        </label>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="0" <?= $status == '0' ? 'checked="checked"' : '' ?>>
                            Chờ duyệt <?php if ($id): ?>
                                <span>(<?= FunctionHelper::countStatusExam($id, Exam::CHO_DUYET, $user) ?>)</span>
                            <?php else: ?>
                                <span>(<?= FunctionHelper::countStatusExamUser(Exam::CHO_DUYET, $user) ?>)</span>
                            <?php endif; ?>
                        </label>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="2" <?= $status == 2 ? 'checked="checked"' : '' ?>>
                            Không duyệt <?php if ($id): ?>
                                <span>(<?= FunctionHelper::countStatusExam($id, Exam::KHONG_DUYET, $user) ?>)</span>
                            <?php else: ?>
                                <span>(<?= FunctionHelper::countStatusExamUser(Exam::KHONG_DUYET, $user) ?>)</span>
                            <?php endif; ?>
                        </label>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="3" <?= $status == 3 ? 'checked="checked"' : '' ?>>
                            <i class="warn warning"></i>Nháp <?php if ($id): ?>
                                <span>(<?= FunctionHelper::countStatusExam($id, Exam::KHO_USER, $user) ?>)</span>
                            <?php else: ?>
                                <span>(<?= FunctionHelper::countStatusExamUser(Exam::KHO_USER, $user) ?>)</span>
                            <?php endif; ?>
                        </label>
                    </div>
                    <div class="mn_list_document" style="width: 240px">
                        <h4>Trạng thái chủ đề</h4>
                        <label onclick="controlDocCheck(this)" for="mn_attr_all">
                            <input type="radio" name="active" checked="checked" value="null" checked="checked">
                            Tất cả </label>
                        <label onclick="controlDocCheck(this)" for="mn_attr_all">
                            <input type="radio" name="active" value="1" <?= $active == 1 ? 'checked="checked"' : '' ?>>
                            Hoạt động </label>
                        <label onclick="controlDocCheck(this)" for="mn_attr_all">
                            <input type="radio" name="active"
                                   value="0" <?= $active == '0' ? 'checked="checked"' : '' ?>>
                            Không hoạt động </label>
                    </div>
                    <div class="mn_list_document_last" style="width: 240px">
                        <h4>Nhập giá bán</h4>
                        <input type="text" name="price" class="check_edit_price" value="<?= $price ?>"
                               placeholder="Nhập giá và chọn áp dụng">
                        <p>Ví dụ: 5000</p>
                    </div>
                    <div class="clear"></div>
                    <div class="line_ngang"></div>
                    <div class="btn_action">
                        <a href="javascript:;"
                           onclick="document.getElementById('user_find_doc_advanced').submit();"
                           class="mn_send_result" style="color: #fff">Áp dụng</a>
                        <a href="<?= Url::to(['exam/filter-exam']) ?>" style="color: #fff"
                           class="mn_send_result">Làm mới</a>
                    </div>
                    <div class="clear"></div>
                </form>
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
                                    <div class="col-md-3">
                                        <p><strong>Trạng thái</strong></p>
                                    </div>
                                    <div class="col-md-5">
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

                                                    <div class="col-md-4">
                                                        <p class="text-left"><?= $exam['topic']['title'] ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php if ($exam['status'] == Exam::KHO_USER): ?>
                                                            <span class="statusIcon ico-draft info-tooltip "
                                                                  data-toggle="tooltip" title=""
                                                                  data-original-title="Lưu nháp"><i
                                                                        class="fa fa-pencil"></i></span>
                                                        <?php elseif ($exam['status'] == Exam::CHO_DUYET): ?>
                                                            <span class="statusIcon ico-pending info-tooltip "
                                                                  data-toggle="tooltip" title=""
                                                                  data-original-title="Chờ duyệt"><i
                                                                        class="fa fa-bookmark-o"></i></span>
                                                        <?php elseif ($exam['status'] == Exam::DUYET): ?>
                                                            <span class="statusIcon ico-pending info-tooltip "
                                                                  data-toggle="tooltip" title=""
                                                                  data-original-title="duyệt"><i
                                                                        class="fa fa-thumbs-o-up"></i></span>
                                                        <?php else: ?>
                                                            <span class="statusIcon ico-pending info-tooltip "
                                                                  data-toggle="tooltip" title=""
                                                                  data-original-title="Không duyệt"><i
                                                                        class="fa fa-exclamation-circle"></i></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <a href="<?= Url::to(['exam/view', 'id' => $exam->id]) ?>"
                                                           title="Xem đề" class="btn btn-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if ($exam['status'] == Exam::KHO_USER || $exam['status'] == Exam::KHONG_DUYET): ?>
                                                            <a href="<?= Url::to(['exam/create', 'id' => $exam['id']]) ?>"
                                                               title="Sửa đề" class="btn btn-warning">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                            <a href="" title="Xóa đề" class="btn btn-danger"
                                                               data-toggle="modal" data-target="#myModal"
                                                               onclick="GetIdDelete(<?= $exam->id ?>)">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <?php if ($exam['status'] == Exam::KHO_USER) : ?>
                                                                <a href="" title="Gửi Admin duyệt"
                                                                   class="btn btn-success" data-toggle="modal"
                                                                   data-target="#sendAdmin"
                                                                   onclick="getIdSendAdmin(<?= $exam->id ?>)">
                                                                    <i class="fa fa-upload"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if ($exam['status'] == Exam::CHO_DUYET): ?>
                                                            <a href="" class="btn btn-info" title="Gỡ xuống"
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

<?= $this->render( 'modal') ?>
