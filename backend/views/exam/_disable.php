<div id="disableExam" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <strong>Ngừng giao dịch đề thi</strong>
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group notes" style="display: none">
                    <div class="alert alert-danger">
                        <p id="reason-disable" style="display: none">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span class="sr-only">Lỗi:</span>
                            Vui lòng cung cấp đầy đủ lý do ngừng đề thi đề thi.
                        </p>
                    </div>
                </div>
                <input type="hidden" id="exam_id_disable">
                <div class="form-group">
                    <label for="">Lý do</label>
                    <textarea class="form-control" id="reason" cols="30" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-icon btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-icon btn-danger" onclick="disableExam()">
                    <span class="fa fa-close"></span>
                    Từ chối
                </button>
            </div>
        </div>
    </div>
</div>
