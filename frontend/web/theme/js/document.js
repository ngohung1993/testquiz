function getIddeleteTopicUser(id) {
    $('#id_delete_topic').val(id);
}
function deleteTopicUser() {
    let id = $('#id_delete_topic').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/delete-topic-user',
            data: {
                id: id,
            },
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}

function getIdTopicAdmin(id) {
    $('#id_topic').val(id);
}
function sendTopicAdmin() {
    let id = $('#id_topic').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/send-admin-topic',
            data: {id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }

}
function getIdremoveTopicAdmin(id) {
    $('#id_topic_remove').val(id);
}
function removeTopicAdmin() {
    let id = $('#id_topic_remove').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL +  'ajax/remove-topic-admin',
            data: {id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}

function GetIdDelete(id) {
    $('#exam_id').val(id);
}
function deleteExamUser() {
    let id = $('#exam_id').val();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'ajax/delete-exam-user',
        data:{
            id:id,
        },
        success: function (data) {
            if(data){
                window.location.reload();
            }
        }
    });
}

function getIdSendAdmin(id) {
    $('#id_exam').val(id);
}

function sendAdminExam() {
    let id = $('#id_exam').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/send-admin-exam',
            data:{id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}
function GetIdRemoveExam(id) {
    $('#id_exam_remove').val(id);
}

function removeExamDown() {
    let id = $('#id_exam_remove').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/remove-exam-down',
            data:{id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}
function getIdExamBuy(id) {
    $('#exam_buy_id').val(id);
}
function deleteExamUserBuy() {
    let id = $('#exam_buy_id').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/remove-exam-user-buy',
            data:{id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}
function getIdHiddenTopicUser(id) {
    $('#id_display_topic').val(id);
}

function hiddenTopicUser() {
    let id = $('#id_display_topic').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/hidden-topic-user',
            data:{id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}
function getRemoveExamDuyet(id) {
    $('#id_exam_remove_duyet').val(id);
}

function removeExamDuyet() {
    let id = $('#id_exam_remove_duyet').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/remove-exam-duyet',
            data:{id:id},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}

function checkbox(id,display) {
    $('#onOffTopic').modal('toggle');
    $('#id_on_off').val(id);
    $('#display_topic').val(display);

    if(display == 0){
        $('#noti-on-off').text('Bật lại hoạt động chủ đề này');
        $('#note-active').text('Lưu ý: Chủ đề hiển thị lại trên trang giao dịch');

    }else{
        $('#noti-on-off').text('Tắt hoạt động chủ đề này');
        $('#note-active').text('Lưu ý: Chủ đề không hiển thị lại trên trang giao dịch');
    }

}
function onOffTopicActiove() {
    let id =  $('#id_on_off').val();
    let display = $('#display_topic').val();
    if(id){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/change-display-topic-user',
            data:{id:id, display: display},
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}

function sendAdminExamAll(status,number) {
    $('.send-admin').addClass('active_man');
    $('#draft').removeClass('active_man');
    if(number <= 0){
        alert('Số lượng đề thi gửi Admin duyệt đã hết. Vui lòng kiểm tra lại');
    }else{
        let r = confirm('Gửi Admin tất cả đề thi để duyệt');
        if(r){
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'ajax/send-admin-exam-all',
                data:{status: status},
                success: function (data) {
                    if(data){
                        window.location.reload();
                    }
                }
            });
        }
    }
}

function sendAdminExamTopicAll(topic_id,title, number) {
    $('.send-admin').addClass('active_man');
    $('#draft').removeClass('active_man');
    if(number <= 0){
        alert('Số lượng đề thi gửi Admin duyệt đã hết. Vui lòng kiểm tra lại');
    }else{
        let r = confirm('Gửi Admin tất cả đề thi của chủ đề: '+ title +' để duyệt');
        if(r){
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'ajax/send-admin-exam-topic-all',
                data:{topic_id: topic_id, title: title},
                success: function (data) {
                    if(data){
                        window.location.reload();
                    }
                }
            });
        }
    }
}
