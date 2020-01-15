<?php

use common\models\Topic;
use common\models\SeoTool;
use yii\widgets\ActiveForm;
use common\models\Classroom;
use frontend\assets\TinyAsset;
use common\models\ClassroomDetail;
use frontend\assets\CreateExamAsset;

/* @var $status */
/* @var $seo SeoTool */
/* @var $model Topic */
/* @var $this yii\web\View */
/* @var $classrooms Classroom */
/* @var $classroomDetail ClassroomDetail */
/* @var $categories common\models\Category */

TinyAsset::register($this);
CreateExamAsset::register($this);

$this->title = 'Tạo chủ đề';

?>
<style>
    .form-control[disabled] {
        background: #fff;
    }

    .represent {
        margin-top: 50px;
    }

    .click i {
        position: absolute;
        color: #1fb6ff;
    }

    .bootstrap-tagsinput {
        position: relative;
    }

    .bootstrap-tagsinput {
        width: 100%;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }
</style>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return validateFormTopic()"]]) ?>
<div class="col-sm-9 response" style="margin-top: -20px;">
    <div class="tab-content">
        <h3 class="ad_user_name" style="margin-top: -10px; ">
            Quản lý chủ đề
        </h3>
        <div class="content_user_info bg_none">
            <div class="top_doc_type" style="height: 20%; padding: 15px">
                <div class="row">
                    <div class="form-group note" style="display: none">
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <p id="note-category" style="display: none">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    <span class="sr-only">Lỗi:</span>
                                    Bạn chưa chọn danh mục.
                                </p>
                                <p id="note-class" style="display: none">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    <span class="sr-only">Lỗi:</span>
                                    Bạn chưa chọn lớp.
                                </p>
                                <p id="note-subject" style="display: none">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    <span class="sr-only">Lỗi:</span>
                                    Bạn chưa chọn môn.
                                </p>
                                <p id="note-title" style="display: none">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    <span class="sr-only">Lỗi:</span>
                                    Tên chủ đề không được để trống.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <?php if (!$model['avatar']): ?>
                            <img id="class_avatar_img_topic" src="/uploads/cms/img/placeholder.png"
                                 class="class-avatar img-responsive represent" alt="Image" width="220" height="150">
                            <a class="absolute block click" id="upload_avatar_button_topic"
                               href="javascript:void(0)">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                            </a>
                        <?php else: ?>
                            <img id="class_avatar_img_topic" src="<?= $model['avatar']; ?>"
                                 class="class-avatar img-responsive represent" alt="Image"
                                 style="width: 340px;height: 150px; margin-top: 50px">
                            <a class="absolute block click" id="upload_avatar_button_topic"
                               href="javascript:void(0)">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                        <div id="cropContainerModal" style="display: none;">
                            <div class="cropControls cropControlsUpload"></div>
                            <input type="file" name="img" id="cropContainerModal_imgUploadField_topic">
                            <input type="hidden" id="classroom-avatar-topic" name="Topic[avatar]"
                                   value=<?= $model['avatar'] ? $model['avatar'] : '/uploads/cms/img/placeholder.png' ?>>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group" style="margin-bottom: 0">
                            <div class="wrapper">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="label-topic-exam">Danh mục</label>
                                            <select class="form-control tp-select " name="Topic[category_id]"
                                                    id="category_id"
                                                <?= $model->category_id ? 'disabled' : '' ?> >
                                                <option value="" selected="" style="display:none;">Chọn danh mục
                                                </option>
                                                <?php foreach ($categories as $key => $value): ?>
                                                    <option <?= $model->category_id == $value->id ? 'selected="selected"' : '' ?>
                                                            value="<?= $value->id ?>"><?= $value->title ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="label-topic-exam">Khối lớp</label>
                                            <select class="form-control tp-select " name="classroom" id="classroom"
                                                    onchange="getClassroom(this)" <?= $classroomDetail ? 'disabled' : '' ?>>
                                                <option value="-1" disabled="" selected="" style="display:none;">
                                                    Chọn lớp
                                                </option>
                                                <?php foreach ($classrooms as $key => $value): ?>
                                                    <?php if ($classroomDetail): ?>
                                                        <option <?php if ($classroomDetail['classroom_id'] == $value['id']) {
                                                            echo 'selected';
                                                        } ?> value="<?= $value->id ?>"><?= $value->title ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $value->id ?>"><?= $value->title ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="label-topic-exam">Môn thi</label>
                                            <select class="form-control tp-select " name="subject"
                                                    id="subject" <?= $classroomDetail ? 'disabled' : '' ?>
                                                    onchange="getTopic(this)">
                                                <?php if (!$classroomDetail): ?>
                                                    <option value="-1" disabled="" selected=""
                                                            style="display:none;">
                                                        Chọn môn thi
                                                    </option>
                                                <?php else: ?>
                                                    <option value="<?= $classroomDetail['subject_id'] ?>"><?= $classroomDetail['subject']['title'] ?></option>
                                                <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="label-topic-exam">Tên chủ đề</label>
                            <div class="tp-input">
                                <input class="" name="Topic[title]" id="title" type="text" placeholder="Tên chủ đề"
                                       value="<?= $model->title ?>">
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="" class="label-topic-exam">Thẻ tags</label>
                            <input class="form-control" name="Topic[tags]" id="tags" type="text"
                                   data-role="tagsinput" value="<?= $model['tags'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label-topic-exam">Mô tả chủ đề</label>
                            <textarea id="content" class="form-control" rows="5" name="Topic[description]"
                                      placeholder="Miêu tả đề thi."><?= $model->description ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-7 col-md-offset-5 col-xs-12">
                        <div class="col-xs-2 col-md-2 check-box">
                            <input style="border: none" type="checkbox" class="tp-checkbox col-sm-2 col-xs-6"
                                   name="Topic[status]"
                                   id="topic-status" value="0">
                        </div>
                        <div class="col-xs-8 col-md-8 text-sent">
                            <strong style="color: #999; font-size: 14px"
                                    class="col-sm-10">
                                Gửi admin duyệt
                            </strong>
                        </div>
                        <div class="col-xs-2 col-md-2">
                            <div class="pull-right">
                                <button type="submit" class="tp-btn green-btn button-save">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<style>
    @media (min-width: 768px) {
        .check-box {
            position: relative;
            left: 50px
        }

        .button-save {
            padding: 8px 80px;
        }

        .text-sent strong {
            margin-top: 10px;
        }
    }

    @media (max-width: 768px) {
        .button-save {
            margin-top: 5px;
        }

        .text-sent {
            padding-top: 10px;
        }
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
