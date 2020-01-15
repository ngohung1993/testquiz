function validateFormReject() {

    if(!$('#reason').val()){
        $('.note').css('display','block');
        $('#note-reason').css('display', 'block');
        return false;
    }else{
        $('#note-reason').css('display', 'none');
    }
    $('.note').css('display','none');
    return true;
}
function changeStatus(id) {
    if(id){
        $.ajax({
            type: 'POST',
            url: '/admin/ajax/change-status-message',
            data: {
                id: id,
            },
            success: function (data) {
            }
        });
    }
}

function getMessage(id,status) {

    if(status === 0){
        let number = $('.number-message').text();
        number -= 1;
        $('.number-message').text(number);
    }

    if(id){
        $.ajax({
            type: 'POST',
            url: '/admin/ajax/change-status-message',
            data: {
                id: id,
            },
            success: function (data) {
                if(data){
                    $('#content-message').html(data.message);
                    $('#box-'+id).addClass('fa-envelope-open-o');
                    $('#box-'+id).removeClass('bold');
                    $('#message-inbox-'+id).removeClass('bold');
                }
            }
        });
    }
}



