<?php

use common\models\Question;

/* @var $question Question */

?>

<div id="answer-temp" style="display:none;">
    <div class="col-md-6">
        <div class="form-group">
            <label for="answer_a">Câu trả lời A</label>
            <input type="text" class="form-control" name="answer[A]">
        </div>
    </div>
</div>
<div id="answer-main">
    <?php if ($question['id']): ?>
        <?php foreach (json_decode($question['answer']) as $key => $value): ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="answer_a">Câu trả lời <?= $key ?></label>
                    <input type="text" class="form-control" name="answer[A]" value="<?= $value ?>">
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="answer_a">Câu trả lời A</label>
                <input type="text" class="form-control" name="answer[A]">
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-md-12">
        <a title="Thêm trả lời" class="btn-left tp-btn he30-btn info-tooltip add-answer" onclick="question.addAnswer()">
            <i class="fa fa-plus"></i> Thêm câu trả lời
        </a>
    </div>
</div>