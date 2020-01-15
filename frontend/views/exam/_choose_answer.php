<?php

use common\models\Question;

/* @var $question Question */

?>

<div id="answer-main">
    <input type="hidden" id="type-question" value="choose_answer">
    <?php if ($question['id']): ?>
        <?php foreach (json_decode($question['answer']) as $key => $value): $correct = json_decode($question['answer_correct'], true); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="answer_a">Câu trả lời <?= $key ?></label>
                    <label>
                        <input <?= isset($correct[$key]) ? 'checked=""' : '' ?>
                                type="checkbox" class="tp-checkbox" name="answerCorrect[<?= $key ?>]"
                                value="<?= $key ?>">
                    </label>
                    <label title="" data-toggle="tooltip"
                           onclick="question.uploadFile('answer_<?= strtolower($key) ?>_media')"
                           class="tp-media tp-btn btn-default info-tooltip"
                           data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                        <?php if ($media = $question->getMedia('answer_' . strtolower($key), false)): ?>
                            <span><?= $media ?></span>
                        <?php else: ?>
                            <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                        <?php endif; ?>
                        <input type="file" id="answer_<?= strtolower($key) ?>_media"
                               name="Question[answer_<?= strtolower($key) ?>_media]">
                    </label>
                    <textarea id="answer_<?= $key ?>" class="form-control" rows="3"
                              name="answer[<?= $key ?>]"><?= $value ?></textarea>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="answer_A">Câu trả lời A</label>
                <label>
                    <input type="checkbox" class="tp-checkbox" name="answerCorrect[A]" value="A">
                </label>
                <label title="" data-toggle="tooltip" onclick="question.uploadFile('answer_a_media')"
                       class="tp-media tp-btn btn-default info-tooltip"
                       data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                    <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                    <input type="file" id="answer_a_media" name="Question[answer_a_media]">
                </label>
                <textarea id="answer_A" class="form-control" rows="3" name="answer[A]"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="answer_B">Câu trả lời B</label>
                <label>
                    <input type="checkbox" class="tp-checkbox" name="answerCorrect[B]" value="B">
                </label>
                <label title="" data-toggle="tooltip" onclick="question.uploadFile('answer_b_media')"
                       class="tp-media tp-btn btn-default info-tooltip"
                       data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                    <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                    <input type="file" id="answer_b_media" name="Question[answer_b_media]">
                </label>
                <textarea id="answer_B" class="form-control" rows="3" name="answer[B]"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="answer_C">Câu trả lời C</label>
                <label>
                    <input type="checkbox" class="tp-checkbox" name="answerCorrect[C]" value="C">
                </label>
                <label title="" data-toggle="tooltip" onclick="question.uploadFile('answer_c_media')"
                       class="tp-media tp-btn btn-default info-tooltip"
                       data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                    <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                    <input type="file" id="answer_c_media" name="Question[answer_c_media]">
                </label>
                <textarea id="answer_C" class="form-control" rows="3" name="answer[C]"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="answer_D">Câu trả lời D</label>
                <label>
                    <input type="checkbox" class="tp-checkbox" name="answerCorrect[D]" value="D">
                </label>
                <label title="" data-toggle="tooltip" onclick="question.uploadFile('answer_d_media')"
                       class="tp-media tp-btn btn-default info-tooltip"
                       data-original-title="Sử dụng ảnh (jpg, gif, png) hoặc âm thanh minh hoạ  có dung lượng không quá 3MB.">
                    <span>Thêm tệp tin<i class="fa fa-paperclip"></i></span>
                    <input type="file" id="answer_d_media" name="Question[answer_d_media]">
                </label>
                <textarea id="answer_D" class="form-control" rows="3" name="answer[D]"></textarea>
            </div>
        </div>
    <?php endif; ?>
</div>