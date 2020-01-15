<?php
/* @var $this yii\web\View */
/* @var $topics \common\models\Topic */

/* @var $status */

use yii\helpers\Url;
use common\helpers\FunctionHelper;
use common\models\Topic;
use common\models\Exam;
use yii\web\View;
use yii\widgets\LinkPager;

$this->title = 'Quản lý chủ đề';
$this->registerJsFile('@web/components/tinymce/tinymce.min.js');
$this->registerJsFile('@web/theme/js/document.js');
//var_dump($active); die;
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

    .mn_list_document {
        width: 240px;
    }
</style>

<div class="col-sm-9 response" style="margin-top: -18px">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -10px">Quản lý tạo chủ đề
        </h3>

        <div class="content_user_info bg_none">
            <div class="top_doc_type">
                <ul class="">
                    <li>
                        <a for="man_radio" href="<?= Url::to(['index', 'status' => 1]) ?>">
                            <i class="icon_type_radio"></i>
                            <span>Được duyệt <em> (<?= FunctionHelper::countStatusTopic($user, Topic::DUYET) ?>)</em></span>
                        </a>
                    </li>
                    <li>
                        <a for="man_radio" href="<?= Url::to(['index', 'status' => 3]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Nháp<em> (<?= FunctionHelper::countStatusTopic($user, Topic::KHO_USER) ?>)</em></span>
                        </a>
                    </li>
                    <li>
                        <a for="man_radio" href="<?= Url::to(['index', 'status' => 0]) ?>">
                            <i class="icon_type_radio"></i>
                            <span><i class="warn warning"></i>Chờ duyệt<em> (<?= FunctionHelper::countStatusTopic($user, Topic::CHO_DUYET) ?>)</em></span>
                        </a>
                    </li>
                    <li onclick="clickActiveAdvanced(this)" class="active_man">
                        <label for="man_radio4">
                            <input type="hidden" name="man_radio" id="man_radio4" class="man_radio">
                            <i class="icon_type_radio"></i>
                            <span>Lọc nâng cao</span>
                        </label>
                    </li>
                </ul>
                <div class="search_md transition1">
                    <form id="user_find_doc" name="search_md" method="GET" action="<?= Url::to(['topic/index']) ?>">
                        <input type="hidden" name="status" value="<?= $status ?>">
                        <input placeholder="Tìm kiếm..." value="" name="key">
                        <a href="javascript:;" onclick="document.getElementById('user_find_doc').submit();"
                           class="icon_search_md icon"></a>
                    </form>
                </div>
                <a href="<?= Url::to(['topic/index', 'status' => $status]) ?>"
                   style="display: inline-block; background: #fff; position: relative; top: 0; left: 338px; cursor: pointer; color: #337ab7"
                   title="Làm mới"><i class="fa fa-refresh" aria-hidden="true"></i></a>

                <div class="clear"></div>
            </div>
            <div class="doc_manager_filter" style="display: block;">
                <form id="user_find_doc_advanced" name="search_md" method="GET"
                      action="<?= Url::to(['topic/filter-topic']) ?>">
                    <div class="mn_list_document">
                        <h4>Duyệt tài liệu</h4>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="1" <?= $status == 1 ? 'checked="checked"' : '' ?>>
                            Được duyệt (<span><?= FunctionHelper::countStatusTopic($user, Topic::DUYET) ?></span>)
                        </label>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="0" <?= $status == '0' ? 'checked="checked"' : '' ?>>
                            Chờ duyệt (<span><?= FunctionHelper::countStatusTopic($user, Topic::CHO_DUYET) ?></span>)
                        </label>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="2" <?= $status == 2 ? 'checked="checked"' : '' ?>>
                            Không duyệt (<span><?= FunctionHelper::countStatusTopic($user, Topic::KHONG_DUYET) ?></span>)
                        </label>
                        <label onclick="controlDocCheck(this)" for="all_mn_test">
                            <input type="radio" class="class_fa" name="status"
                                   value="3" <?= $status == 3 ? 'checked="checked"' : '' ?>>
                            <i class="warn warning"></i>Nháp
                            (<span><?= FunctionHelper::countStatusTopic($user, Topic::KHO_USER) ?></span>)
                        </label>
                    </div>
                    <div class="mn_list_document">
                        <h4>Trạng thái tài liệu</h4>
                        <label onclick="controlDocCheck(this)" for="mn_attr_all">
                            <input type="radio" name="active" value="null" checked="checked">
                            Tất cả
                        </label>
                        <label onclick="controlDocCheck(this)" for="mn_attr_all">
                            <input type="radio" name="active" value="1" <?= $active == 1 ? 'checked="checked"' : '' ?> >
                            Hoạt động
                        </label>
                        <label onclick="controlDocCheck(this)" for="mn_attr_all">
                            <input type="radio" name="active"
                                   value="0" <?= $active == '0' ? 'checked="checked"' : '' ?>>
                            Ngừng hoạt động
                        </label>
                    </div>
                    <div class="clear"></div>
                    <div class="line_ngang"></div>
                    <div class="btn_action">
                        <a href="javascript:;" style="color: #fff"
                           onclick="document.getElementById('user_find_doc_advanced').submit();" class="mn_send_result">Áp
                            dụng</a>
                        <a href="<?= Url::to(['profile/filter-topic']) ?>" style="color: #fff"
                           class="mn_send_result">Làm mới</a>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
            <div class="mn_doc_upload">

            </div>
            <div class="mn_list_view_more">
                <div class="list_doc_man">
                    <?php if (count($topics) > 0): ?>
                        <?php foreach ($topics as $key => $value): ?>
                            <div class="doc_list_cnt list_cnt_small list div_del">
                                <a class="doc_title_cnt" title="<?= $value->title ?>"
                                   href="<?= Url::to(['exam/topic', 'topic_id' => $value['id'], 'status' => Exam::DUYET]) ?>"><?= $value->title ?></a>
                                <?php if ($value['status'] == Topic::KHO_USER): ?>
                                    <button class="" data-toggle="modal" data-target="#modalSendTopicAdmin"
                                            style="position: relative;top: 21px;left: 30px; background-color: #00a888; color: #fff"
                                            onclick="getIdTopicAdmin(<?= $value['id'] ?>)"><i
                                                class="fa fa-share-square-o" aria-hidden="true"></i> Gửi
                                        Admin duyệt
                                    </button>
                                <?php endif; ?>
                                <?php if ($value['status'] == Topic::CHO_DUYET): ?>
                                    <button class="" data-toggle="modal" data-target="#modalRemoveTopic"
                                            style="position: relative;top: 21px;left: 40px; background-color: #00a888; color: #fff"
                                            onclick="getIdremoveTopicAdmin(<?= $value['id'] ?>)">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        Gỡ chủ đề
                                    </button>
                                <?php endif; ?>
                                <a style="cursor: pointer" class="doc_cnt_img"
                                   href="<?= Url::to(['profile/list-exam-topic', 'id' => $value['id'], 'status' => Exam::DUYET]) ?> "
                                   title="<?= $value->title ?>">
                                    <img src="<?= $value->avatar ?>" alt="<?= $value->title ?>">
                                </a>

                                <span class="doc_man_date">Ngày tải lên :<?= date('d/m/Y H:i', $value['created_at']) ?> </span>
                                <?php if ($value->status == Topic::DUYET): ?>
                                    <div class="form-group" style="position: absolute; top: 50px; right: -3px">
                                        <div class="col-sm-12">
                                            <input style="position: absolute; left: 28px;top: 6px;opacity: 0;"
                                                   type="checkbox" name="checkboxes<?= $value->id ?>"
                                                   onclick="checkbox(<?= $value->id ?>)" value="<?= $value->display ?>"
                                                   id="frm-test-<?= $value->id ?>"
                                                   autocomplete="off" <?= $value->display == 0 ? 'checked' : '' ?>>
                                            <?php if ($value->display == 1): ?>
                                                <div class="btn-group">
                                                    <label for="frm-test-elm-110-3" class="btn btn-info">
                                                        <span class="fa fa-check-square-o fa-lg"></span>
                                                        <span class="fa fa-square-o fa-lg"></span>
                                                        <span class="content">Hoạt động </span>
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <div class="btn-group">
                                                    <label for="frm-test-elm-110-3" class="btn btn-danger">
                                                        <span class="fa fa-check-square-o fa-lg"></span>
                                                        <span class="fa fa-square-o fa-lg"></span>
                                                        <span class="content">Ngừng Hoạt động </span>
                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="left_item_doc">
                                    <ul class="doc_tk_cnt">
                                        <li>
                                            Loại đề thi:
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['profile/list-exam-topic', 'id' => $value['id'], 'status' => Exam::DUYET]) ?>"
                                               style="cursor: pointer">
                                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                Duyệt(<?= FunctionHelper::countStatusExam($value['id'], Exam::DUYET, $user) ?>
                                                )
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['profile/list-exam-topic', 'id' => $value['id'], 'status' => Exam::CHO_DUYET]) ?>"
                                               style="cursor: pointer">
                                                <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                                Chờ duyệt
                                                (<?= FunctionHelper::countStatusExam($value['id'], Exam::CHO_DUYET, $user) ?>
                                                )
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['profile/list-exam-topic', 'id' => $value['id'], 'status' => Exam::KHONG_DUYET]) ?>"
                                               style="cursor: pointer">
                                                <i class="fa fa-times" aria-hidden="true"></i> Không duyệt
                                                (<?= FunctionHelper::countStatusExam($value['id'], Exam::KHONG_DUYET, $user) ?>
                                                )
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['profile/list-exam-topic', 'id' => $value['id'], 'status' => Exam::KHO_USER]) ?>"
                                               style="cursor: pointer">
                                                <i class="fa fa-exclamation-triangle"
                                                   aria-hidden="true"></i> Nháp
                                                (<?= FunctionHelper::countStatusExam($value['id'], Exam::KHO_USER, $user) ?>
                                                )
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="doc_man_hover" style="left: -70px;">
                                        <a href="<?= Url::to(['topic/view', 'slug' => $value['slug']]) ?>"
                                           style="position: absolute; top: 109px;right: -63px; font-size: 15px"> <i
                                                    class="fa fa-eye" aria-hidden="true"></i> Chi tiết</a>

                                        <?php if ($value['status'] == Topic::KHO_USER): ?>
                                            <a style="cursor: pointer" class="man_doc_del icon deleteitem"
                                               data-toggle="modal" data-target="#deleteTopicUser"
                                               onclick="getIddeleteTopicUser(<?= $value['id'] ?>)">Xoá </a>
                                            <a class="man_doc_edit icon"
                                               href="<?= Url::to(['topic/create', 'id' => $value['id']]) ?>">Sửa</a>
                                        <?php endif; ?>
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
