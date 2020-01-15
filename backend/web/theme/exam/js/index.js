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

    $.ajax({
        type: 'POST',
        url: '/ajax/report-question',
        data: {
            question_id: $('#question-id').val(),
            content_report: $('#content-report').val(),
        },
        success: function (data) {

        }
    });
}