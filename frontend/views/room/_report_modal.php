<div id="report-question" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: 18px;">Báo lỗi câu hỏi</h4>
            </div>
            <div class="modal-body">
                <label for="">
                    Nội dung báo lỗi
                </label>
                <input type="hidden" id="question-id">
                <textarea class="form-control" name="" id="content-report" cols="30" rows="5"></textarea>
                <span id="note"></span>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="answers" id="answers">
                <button onclick="reportQuestion()" type="submit" class="btn btn-primary modal-submit" data-dismiss="" >
                    <span class="fa fa-external-link"></span>
                    Gửi yêu cầu
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<div id="notificationResult" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: 18px;">Thông báo</h4>
            </div>
            <div class="modal-body">
                <h5 style="color: red">Gửi báo lỗi sai sót câu hỏi thành công. </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>