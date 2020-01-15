<style>
    .modal-header {
        background: #1fb6ff;
        color: #fff;
        background-image: url(/theme/images/modal.png) !important;
        background-size: 100%;
    }
</style>
<div id="modalSendTopicAdmin" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_topic">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Gửi chủ đề Admin duyệt.</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Chủ đề của bạn sẽ chuyển qua trạng thái chờ duyệt</p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="sendTopicAdmin()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="modalRemoveTopic" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_topic_remove">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px;">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px; color: red">
                <h5>Gỡ đề chủ đề.</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Chủ đề chỉ được gỡ khi đề thi đang <span style="font-weight: bold; color: blue">chờ Admin duyệt</span></p>
                <p style="font-style: italic; font-size: 14px">- Chủ đề gỡ xuống sẽ chuyển về <span style="font-weight: bold; color: blue">Nháp</span> </span></p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="removeTopicAdmin()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="deleteTopicUser" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_delete_topic">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px; ">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <h5 style="color: red">Bạn có đồng ý xóa chủ đề này không?</h5>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="deleteTopicUser()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<div id="onOffTopic" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_on_off">
            <input type="hidden" id="display_topic">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px; ">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <h5 style="color: red" id="noti-on-off">Bạn có đồng ý xóa chủ đề này không?</h5>
                <span id="note-active"></span>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="onOffTopicActiove()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<div id="hiddenTopicUser" class="modal fade in" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="id_display_topic">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="font-size: 18px; ">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    Thông báo
                </h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                <h5 style="color: red">Bạn có đồng ý xóa chủ đề này không?</h5>
                <p style="font-style: italic; font-size: 14px">Lưu ý: Chủ đề và những đề thi thuộc chủ đề sẽ không được giao dịch <span style="font-weight: bold; color: blue">bán đề</span></p>
            </div>
            <div class="modal-footer">
                <button style="background-color: #1fb6ff;border-color: #1fb6ff" type="button" class="btn btn-success" data-dismiss="modal" onclick="hiddenTopicUser()">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>