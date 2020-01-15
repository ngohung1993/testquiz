<?php

use common\models\Category;
use common\models\Classroom;
use common\models\PriceExam;
use common\models\SeoTool;
use common\models\Topic;
use yii\helpers\Url;
use common\models\Exam;
use yii\web\View;
use yii\widgets\ActiveForm;
use frontend\assets\ProfileAsset;
use frontend\assets\CreateExamAsset;

ProfileAsset::register($this);
CreateExamAsset::register($this);

/* @var $id */
/* @var $classroomDetail */
/* @var $this yii\web\View */
/* @var $seo common\models\SeoTool */
/* @var $topics common\models\Topic */
/* @var $categories common\models\Category */
/* @var $classrooms common\models\Classroom */
/* @var $price_exams common\models\PriceExam */

$this->title = 'Cập nhật thông tin đề thi';

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

        .reponse-label {
            position: relative;
            top: 12px;
            left: 0;
        }
    </style>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'onsubmit' => "return validateFormUpload()"]]) ?>
    <div class="col-sm-9 response" style="margin-top: -20px;">
        <div class="tab-content">
            <h3 class="ad_user_name" style="margin-top: -10px; ">Quản lý đề thi
            </h3>
        </div>
        <div class="top_doc_type" style="height: 20%; padding-bottom: 20px">
            <ul class="breadcrumb breadcrumb-primary " style="background-color: #fff; border-radius: 0;margin: 4px 0 0 0">
                <li style="margin-right: 0">
                    <a href="<?=Url::to(['exam/update','id'=>$model->id])?>">
                        <i class="fa fa-info-circle" aria-hidden="true" style="color: #1fb6ff "></i>
                        Thông tin đề thi
                    </a>

                </li>
                <li class="active" style="margin-right: 0; ">
                    Tải lên đề thi
                </li>
            </ul>
        </div>
        <div id="taode" class="card-wrapper" style="margin-top: -12px; padding-bottom: 20px">
            <div class="tab-content form-horizontal" style="margin-top: 15px">
                <div class="form-group note-upload" style="display: none">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <p id="note-number-question" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Bạn chưa điền số lượng câu hỏi.
                            </p>
                            <p id="note-exam-empty" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Tập tin đề bài không để trống.
                            </p>
                            <p id="note-exam" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Tập tin đề bài không đúng định dạng (.doc, .docx, .pdf, .png, .jpg).
                            </p>
                            <p id="note-list-answer" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Bạn chưa điền đáp án đúng cho từng câu.
                            </p>
                            <p id="note-answer-empty" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Tập tin đáp án không để trống.
                            </p>
                            <p id="note-answer" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Tập tin đáp án không đúng định dạng (.doc, .docx, .pdf, .png, .jpg).
                            </p>
                            <p id="note-count-question" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Số lượng câu hỏi và số câu trong đáp án đúng không bằng nhau.
                            </p>
                            <p id="note-excess-semi-colon" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Trường đáp án đúng. Bạn đang nhập sai cú pháp dấu (;). Vui lòng kiểm tra lại .
                            </p>
                            <p id="note-colon" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Trường đáp án đúng. Bạn đang nhập sai cú pháp dấu (:). Vui lòng kiểm tra lại .
                            </p>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" style="color: #999">Số câu hỏi</label>
                    <div class="col-sm-10">
                        <input type="text" id="number-question" class="form-control" name="Exam[number_question]"
                               value="<?= $model['number_question'] ?>">
                    </div>
                </div>
                <div class="form-group file-attachment-group">
                    <label class="col-sm-2 control-label" style="color: #999">Tệp tin đề bài</label>

                    <div class="col-sm-10">
                        <div class="input-group disabled">
                            <input type="text" id="tmpFileFake" class="form-control"
                                   placeholder="Chỉ chấp nhận tập tin .doc, .docx, .pdf, .jpg, .png! Dung lượng tối đa 10 MB"
                                   disabled="" value="<?= substr($model['file_exam'], 25) ?>">
                            <span class="input-group-btn">
	                          <button class="btn green-btn" type="button" id="tmpBtnSelectFile"><i
                                          class="fa fa-upload"></i>&nbsp; Chọn tệp tin
	                          </button>
	                        </span>
                        </div>
                        <input type="file" onchange="doc_upload.copyfilename(this, &#39;tmpFileFake&#39;);"
                               id="tmpFile" class="hidden" name="Exam[fileUploadExam]" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" style="color: #999">Đáp án đúng</label>
                    <div class="col-sm-10">
                        <input id="answer-question" type="text" class="form-control" name="Exam[answer]" value="<?php
                        $data = '';
                        if (json_decode($model['answer'])) {
                            foreach (json_decode($model['answer']) as $key => $value) {
                                $data .= $key . ':' . $value . ';';
                            }
                            echo $data;
                        }
                        ?>">
                        <p class="help-block">Đáp án cho từng câu, có dạng: 1:A;2:B;3:C; ...</p>
                    </div>
                </div>
                <div class="form-group file-attachment-group">
                    <label class="col-sm-2 control-label" style="color: #999">Tệp tin đáp án</label>

                    <div class="col-sm-10">
                        <div class="input-group disabled">
                            <input type="text" id="tmpFileFake2" class="form-control"
                                   placeholder="Chỉ chấp nhận tập tin .doc, .docx, .pdf, .jpg, .png! Dung lượng tối đa 10 MB"
                                   disabled="" value="<?= substr($model['file_answer'], 25) ?>">
                            <span class="input-group-btn">
	                          <button class="btn green-btn" type="button" id="tmpBtnSelectFile2"><i
                                          class="fa fa-upload"></i>&nbsp; Chọn tệp tin
	                          </button>
	                        </span>
                        </div>
                        <input type="file" onchange="doc_upload.copyfilename(this, &#39;tmpFileFake2&#39;);"
                               id="tmpFile2" class="hidden" name="Exam[fileUploadAnswer]" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 "></div>
                    <div class="col-sm-3 col-sm-offset-4">
                        <button type="submit" class="tp-btn green-btn btn-lg btn-block">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu đề
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>