let likedExam = function (event,exam_id) {
    $.ajax({
        url: '/ajax/save-exam',
        type: 'post',
        data: {
            'exam_id': exam_id,
        },
        success: function (data) {
            if (data === 0) {
                alert('Lỗi: Chưa đăng nhập');
            } else {
                if (data[0] == 1) {
                    $(event).children('i').html(' ' + data[1]);
                    $(event).children('i').css('color', 'red');
                    console.log(data);
                    console.log(data[1]);
                }
                if (data[0] == 0) {
                    $(event).children('i').html(' ' + data[1]);
                    $(event).children('i').css('color', '#ccc');
                    console.log(data);
                    console.log(data[1]);
                }
            }
        }
    });
}