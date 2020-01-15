<?php

use yii\helpers\Url;
use common\models\Exam;
use yii\widgets\ActiveForm;
use frontend\assets\TinyAsset;
use frontend\assets\ProfileAsset;
use frontend\assets\CreateExamAsset;

TinyAsset::register($this);
CreateExamAsset::register($this);
ProfileAsset::register($this);

/* @var $this yii\web\View */
/* @var $classrooms common\models\Classroom */
/* @var $price_exams common\models\PriceExam */
/* @var $seo common\models\SeoTool */
/* @var $model common\models\Exam */
/* @var $topic */
/* @var $classroomDetail */
/* @var $topics common\models\Topic */
/* @var $categories common\models\Category */

$this->title = 'Chỉnh sửa thông tin';

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

        .form-control[disabled] {
            background-color: #fff;
        }
        @media (max-width: 768px) {
            .box-time {
                margin-top: 30px;
                text-align: center;
            }
        }

        .reponse-label {
            position: relative;
            top: 12px;
            left: 0;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }

        .represent {
            margin-top: 10px;

        }

        .click i {
            position: absolute;
            color: #1fb6ff;
            top: 150px;
        }
        .top_doc_type .list-unstyled li {
            float: none;
            margin-right: unset;
        }
        a:hover {
            color: #2f70dc;
        }
    </style>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return validateForm()"]]) ?>
    <div class="col-sm-9 response" style="margin-top: -20px;">
        <div class="tab-content">
            <h3 class="ad_user_name" style="margin-top: -10px;">
                Quản lý đề thi
            </h3>
            <div class="content_user_info bg_none">
                <div class="top_doc_type">
                    <ul class="breadcrumb breadcrumb-primary " style="background-color: #fff; border-radius: 0;margin: 4px 0 0 0">
                        <li style="margin-right: 0">
                            <i class="fa fa-info-circle" aria-hidden="true" style="color: #1fb6ff "></i>
                            Thông tin đề thi
                        </li>
                        <?php if($model->type  == Exam::UPLOAD):?>
                        <li class="active"  style="margin-right: 0; ">
                            <a href="<?=Url::to(['exam/upload','id'=> $model->id])?>" style="display: inline-block">
                                Đề thi upload file
                            </a>
                        </li>
                        <?php else:?>
                        <li>
                            <?php if($model->status == Exam::EXAM_ERROR):?>
                            <a href="<?=Url::to(['exam/edit-question','id'=> $model->id])?>" style="display: inline-block">
                                Đề thi tạo tay
                            </a>
                            <?php else:?>
                            <a href="<?=Url::to(['exam/question','id'=> $model->id])?>" style="display: inline-block">
                                Đề thi tạo tay
                            </a>
                            <?php endif;?>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="top_doc_type" style="height: 20%; padding: 15px;margin-top: -12px">
                    <div class="row">
                        <div class="form-group note" style="display: none">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" style="padding: 5px">
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
                                    <p id="note-topic" style="display: none">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <span class="sr-only">Lỗi:</span>
                                        Bạn chưa chọn chủ đề.
                                    </p>
                                    <p id="note-title" style="display: none">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <span class="sr-only">Lỗi:</span>
                                        Tên đề thi không được để trống.
                                    </p>
                                    <p id="note-classify" style="display: none">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <span class="sr-only">Lỗi:</span>
                                        Bạn chưa chọn hình thức thi như đề thi tự do, đề thi tính giờ, đề thi hẹn giờ.
                                    </p>
                                    <p id="select-set-time" style="display: none">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <span class="sr-only">Lỗi:</span>
                                        Bạn chọn đề thi hẹn giờ thì hẹn giờ thi không được để trống.
                                    </p>

                                    <p id="note-type" style="display: none">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <span class="sr-only">Lỗi:</span>
                                        Bạn chưa chọn dạng đề thi tạo bằng tay hoặc tải file.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="" class="label-topic-exam">Khối lớp</label>
                                <select class="form-control tp-select" name="classroom" id="classroom"
                                        onchange="getClassroom(this)" <?= $model->topic_id ? 'disabled' : '' ?>>
                                    <option value="-1" disabled="" selected="" style="display:none;">Chọn lớp
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
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="" class="label-topic-exam">Môn thi</label>
                                <select class="form-control tp-select" name="subject" id="subject"
                                        onchange="getTopic(this)" <?= $model->topic_id ? 'disabled' : '' ?>>
                                    <?php if (!$classroomDetail): ?>
                                        <option value="-1" disabled="" selected="" style="display:none;">Chọn
                                            môn thi
                                        </option>
                                    <?php else: ?>
                                        <option value="<?= $classroomDetail['subject_id'] ?>"><?= $classroomDetail['subject']['title'] ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">

                            <div class="form-group">
                                <label for="" class="label-topic-exam">Chủ đề</label>
                                <select class="form-control tp-select " name="Exam[topic_id]"
                                        onchange="getCategory(this)"
                                        id="topic_user" <?= $model->topic_id ? 'disabled' : '' ?>>
                                    <?php if ($model->topic_id): ?>
                                        <option value="<?= $model['topic']['id'] ?>"><?= $model['topic']['title'] ?></option>
                                    <?php else: ?>
                                        <option value="-1" disabled="" selected=""
                                                style="display:none;">Chọn chủ đề
                                        </option>
                                    <?php endif; ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="" class="label-topic-exam">Danh mục</label>
                                <select class="form-control tp-select" name="category" id="category" disabled>
                                    <option value="-1" disabled="" selected="" style="display:none;">Danh mục
                                    </option>
                                    <?php if ($model->topic && $topic): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <option <?= $category->id == $topic->category_id ? 'selected' : '' ?>
                                                    value="<?= $category->id ?>"> <?= $category->title ?> </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4" style="margin-bottom: 15px">
                            <div class="class-avatar-outer relative"
                                 style="padding-top: -10px; margin: 0 !important;">
                                <?php if (!$model['avatar']): ?>
                                    <img id="class_avatar_img_exam"
                                         src="/uploads/cms/img/default-exam.jpg"
                                         class="class-avatar img-responsive represent" alt="Image"
                                         style="width: 225px;height: 150px;">
                                    <a class="absolute block click" id="upload_avatar_button_exam"
                                       href="javascript:void(0)">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                <?php else: ?>
                                    <img id="class_avatar_img_exam" src="<?= $model['avatar']; ?>"
                                         class="class-avatar img-responsive represent" alt="Image"
                                         style="width: 220px;height: 100px;">
                                    <a class="absolute block click" id="upload_avatar_button_exam"
                                       href="javascript:void(0)">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>

                                <div id="cropContainerModal" style="display: none;">
                                    <div class="cropControls cropControlsUpload"></div>
                                    <input type="file" name="img"
                                           id="cropContainerModal_imgUploadField_exam">
                                    <?= $form->field($model, 'avatar')->hiddenInput(['id' => 'classroom-avatar-exam', 'value' => '/uploads/cms/img/default-exam.jpg'])->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-8">
                            <div class="form-group">
                                <label for="" class="label-topic-exam">Tên đề thi</label>
                                <div class="tp-input">
                                    <input class="" name="Exam[title]" id="title" type="text" placeholder=" Tên đề thi"
                                           value="<?= $model->title ?>">
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 0">
                                <label for="" class="label-topic-exam">Thẻ tags</label>
                                <input class="form-control" name="Exam[tags]" id="tags" type="text"
                                       data-role="tagsinput" value="<?= $model['tags'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 description-group" style="margin-top: 10px">
                            <label for="" class="label-topic-exam">Mô tả đề thi</label>
                            <div class="tp-input">
                                <?php if ($model['description']): ?>
                                    <textarea id="content" class="form-control" rows="5"
                                              name="Exam[description]"
                                              placeholder="Miêu tả đề thi."><?= $model['description'] ?></textarea>
                                <?php else: ?>
                                    <textarea id="content" class="form-control" rows="5"
                                              name="Exam[description]"
                                              placeholder="Miêu tả đề thi">
                                    </textarea>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12" style="padding: 0 10px;">
                            <p class="title_bal" style="margin-bottom: 0; padding: 0;text-transform: none;font-size: 15px; margin-left: 5px">Chọn kiểu đề
                                thi</p>
                            <div class="container">
                                <div class="row" id="set_time">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <label class="label--checkbox" >
                                            <input style="border: none" type="radio"
                                                   class="tp-checkbox col-sm-2 col-xs-2"
                                                   name="Exam[classify]" value="1"
                                                <?=$model->classify == 1 ? 'checked' : ''?>>
                                            <strong class="col-sm-10 col-xs-10 reponse-label" style="left: 0">
                                                Đề thi tự do
                                            </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 box-time">
                                        <label class="label--checkbox">
                                            <input style="border: none" type="radio"
                                                   class="tp-checkbox col-sm-2 col-xs-2"
                                                   name="Exam[classify]" value="2"
                                                <?=$model->classify == 2 ? 'checked' : ''?>>
                                            <strong class="col-sm-10 col-xs-10 reponse-label" style="left: 0;">
                                                Đề thi tính giờ
                                            </strong>
                                        </label>

                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 box-time">
                                        <label class="label--checkbox">
                                            <input style="border: none" type="radio"
                                                   class="tp-checkbox col-sm-2 col-xs-2"
                                                   name="Exam[classify]" value="3"
                                                <?=$model->classify == 3 ? 'checked' : ''?>>
                                            <strong class="col-sm-10 col-xs-10 reponse-label" style="left: 0;">
                                                Đề thi hẹn giờ
                                            </strong>
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 15px">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="label-topic-exam">Chọn giá (đồng)</label>
                                        <select class="form-control  " name="Exam[price]">
                                            <option value="0">Miễn phí</option>
                                            <?php foreach ($price_exams as $price_exam): ?>
                                                <option <?php if ($model['price'] == $price_exam['price']) {
                                                    echo 'selected';
                                                } ?> value="<?= $price_exam['price'] ?>"><?= number_format($price_exam['price'], 0, ',', '.') ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="label-topic-exam">Thời gian làm bài</label>
                                        <select class="form-control " name="Exam[time]">
                                            <option value="500">5 phút</option>
                                            <option value="1000">10 phút</option>
                                            <option value="1500">15 phút</option>
                                            <option value="2000">20 phút</option>
                                            <option value="3000">30 phút</option>
                                            <option value="4000">40 phút</option>
                                            <option value="4500">45 phút</option>
                                            <option value="10000">60 phút</option>
                                            <option value="13000">90 phút</option>
                                            <option value="20000">120 phút</option>
                                            <option value="23000">150 phút</option>
                                            <option value="30000">180 phút</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-3 col-xs-12" id="display-input-time" <?=$model->classify == 3 ? 'style="display: block"' : 'style="display: none"' ?>>
                                    <div class="form-group">
                                        <label for="" class="label-topic-exam">Thời gian bắt đầu</label>
                                        <div class='input-group date' id='datetimepicker2'>
                                            <input type='text' class="form-control" name="Exam[set_date_time]" id="set_date_time" value="<?= $model->set_date_time ? date('m/d/Y H:i', $model->set_date_time) : ''?>" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-12" id="display-input-time-end" <?=$model->classify == 3 ? 'style="display: block"' : 'style="display: none"' ?>>
                                    <div class="form-group">
                                        <label for="" class="label-topic-exam">Thời gian kết thúc</label>
                                        <div class='input-group date' id='datetimepicker3'>
                                            <input type='text' class="form-control" name="Exam[set_date_time_end]" id="set_date_time_end" value="<?= $model->set_date_time_end ? date('m/d/Y H:i', $model->set_date_time_end) : ''?>" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 ">
                            <p class="title_bal" style="margin-bottom: 0; padding: 0;text-transform: none; font-size: 15px">Chọn loại đề
                                thi</p>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <label class="label--checkbox" <?= $model->type == 2 ? 'style="display: none"' : '' ?>>
                                            <input style="border: none" type="radio"
                                                   class="tp-checkbox col-sm-2 col-xs-2" name="Exam[type]"
                                                   value="1" <?php if ($model['type'] == 1) {
                                                echo 'checked';
                                            } ?>>
                                            <strong class="col-sm-10 col-xs-10 reponse-label">Đề thi tạo tay</strong>
                                        </label>

                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 box-time">
                                        <label class="label--checkbox" <?= $model->type == 1 ? 'style="display: none"' : '' ?>>
                                            <input style="border: none" type="radio"
                                                   class="tp-checkbox col-sm-2 col-xs-2" name="Exam[type]" value="2"
                                                <?php if ($model['type'] == 2) {
                                                    echo 'checked';
                                                } ?>
                                            >
                                            <strong class="col-sm-10 col-xs-10 reponse-label">Đề thi tải file</strong>
                                        </label>

                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 box-time pull-right">
                                        <?php if($model->status == Exam::EXAM_ERROR):?>
                                            <a href="<?=Url::to(['edit-question','id'=> $model->id])?>" class="tp-btn green-btn"
                                                    style="padding: 10px 15px; color: #fff">Không có quyền sửa
                                            </a>
                                        <?php else:?>
                                        <button type="submit" class="tp-btn green-btn"
                                                style="padding: 10px 75px;">
                                            Tiếp tục
                                        </button>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>