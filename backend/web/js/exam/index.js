function CancelError(id) {
    let r = confirm('Hủy bỏ lỗi câu hỏi này ?');
    if(r){
        $.ajax({
            type: 'POST',
            url: '/admin/ajax/change-status-report-question',
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

function QuestionError(id, question_id) {
    let r = confirm('Báo lỗi cho người tạo đề');
    if(r){
        $.ajax({
            type: 'POST',
            url: '/admin/ajax/notify-the-creator',
            data: {
                id: id,
                question_id : question_id,
            },
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}

function ReplaceQuestion(id_new, id_old, id_report) {
    let r = confirm('Thay thế câu hỏi lỗi');
    if(r){
        $.ajax({
            type: 'POST',
            url: '/admin/ajax/replace-question-error',
            data: {
                id_new: id_new,
                id_old : id_old,
                id_report : id_report
            },
            success: function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    }
}

function resendEdit(id) {
    let r = confirm('Gửi lại người tạo đề sửa lỗi này');
    if(r){
        $.ajax({
            type: 'POST',
            url: '/admin/ajax/resen-edit-question-error',
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

function adminDisableExam(id) {
    $('#exam_id_disable').val(id);
}

function disableExam() {
    let id = $('#exam_id_disable').val();
    let reason = $('#reason').val();

    if(!reason){
        $('.note').css('display','block');
        $('#reason-disable').css('display','block');
        return false;
    }
    $.ajax({
        type: 'POST',
        url: '/admin/ajax/admin-disable-exam',
        data: {
            id: id,
            reason : reason,
        },
        success: function (data) {
            if(data){
                window.location.reload();
            }
        }
    });
}