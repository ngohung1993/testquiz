<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = $model->title;
?>

<?php $form = ActiveForm::begin(['action' => Url::to(['topic/reject', 'id' => $model['id']]),'options'=> ['onsubmit' => "return validateFormReject()"]]); ?>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <strong>Từ chối duyệt chủ đề</strong>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group note" style="display: none">
                        <div class="alert alert-danger">
                            <p id="note-reason" style="display: none">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <span class="sr-only">Lỗi:</span>
                                Vui lòng cung cấp đầy đủ lý do không duyệt chủ đề.
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Lý do</label>
                        <textarea class="form-control" id="reason" name="Topic[reason_reject]" id="" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-icon btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-icon btn-danger">
                        <span class="fa fa-close"></span>
                        Từ chối
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>