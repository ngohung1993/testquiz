let original = $('.BNC');
let orgElementPos = original.offset();
let orgElementTop = orgElementPos.top;

function stickIt() {
    if ($(window).scrollTop() >= (orgElementTop)) {
        original.addClass('exam-results-fixed');
    } else {
        original.removeClass('exam-results-fixed');
    }
}

scrollIntervalID = setInterval(stickIt, 10);

document.addEventListener('DOMContentLoaded', function () {

});

function showModelReport(id) {
    $('#report-question').modal();

    $('#question-id').val(id);
}

function reportQuestion() {
    $('#report-question').modal();
    let content_report =  $('#content-report').val();
    if(!content_report){
        $('#note').html('Vui lòng không được để trống').css('color','red');
        $('.modal-submit').attr('data-dismiss','');
        return false;
    }else{
        $('.modal-submit').attr('data-dismiss','modal');
        $.ajax({
            type: 'POST',
            url: '/ajax/report-question',
            data: {
                question_id: $('#question-id').val(),
                content_report : content_report
            },
            success: function (data) {
                if(data){
                    console.log(data);
                    $('#notificationResult').modal();
                    $('#content-report').val('');
                }
            }
        });
    }

}