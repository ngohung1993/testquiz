<style>
    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }
</style>
<div id="myModal" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="exam_id">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px; ">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <h5 style="color: red">Bạn có đồng ý xóa đề thi này không?</h5>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="deleteExamUser()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="sendAdmin" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_exam">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Gửi đề thi Admin duyệt.</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Đề thi của bạn sẽ chuyển qua trạng thái chờ duyệt</p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="sendAdminExam()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="removeExam" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_exam_remove">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Gỡ đề thi xuống.</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Đề thi chỉ được gỡ khi đề thi đang <span style="font-weight: bold; color: blue">chờ Admin duyệt</span></p>
                <p style="font-style: italic; font-size: 14px">- Đề thi gỡ xuống sẽ chuyển về <span style="font-weight: bold; color: blue">Nháp</span> </span></p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="removeExamDown()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="removeExamDuyet" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_exam_remove_duyet">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Bạn có muốn xóa đề thi này ?</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Đề thi này sẽ bị xóa và không được giao dịch <span style="font-weight: bold; color: blue">bán đề</span></p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="removeExamDuyet()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>