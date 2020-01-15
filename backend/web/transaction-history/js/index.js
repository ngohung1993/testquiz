$(document).ready(function () {
    $('#upload_avatar_button').click(function () {
        $('#cropContainerModal_imgUploadField').trigger('click');
    });

    $('#cropContainerModal_imgUploadField').change(function () {


        let fd = new FormData();

        let files = event.target.files;
        console.log(files);

        for (let i = 0; i < files.length; i++) {
            fd.append('files[]', files[i]);
        }
        console.log(fd);
        if (files) {
            $.ajax({
                url: '/uploads/cms/upload.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);

                    $('#class_avatar_img').attr('src', '/uploads/advertises/' + response[0]);

                    $('#classroom-avatar').val('/uploads/advertises/' + response[0]);
                }
            });
        }
    });
});

function Transaction_cancel(id) {
    let r = confirm('Hủy giao dịch?');
    if(r){
        $.ajax({
            type: 'post',
            url:  '/admin/ajax/cancel-transaction',
            data: {id: id, note: $('textarea#textaria').val()},
            success: function (data) {
                if(data){}
                window.location.href = '/admin/transaction-history/index';
            }
        });
    }
}

function validateFormRecharge() {
    let money = $('#money').val();

    if(!money){
        $('.note').css('display','block');
        $('#note-money').css('display', 'block');
        return false;
    }else{
        $('#note-money').css('display', 'none');
    }

    if(money <= 20000){
        $('.note').css('display','block');
        $('#note-compare').css('display', 'block');
        return false;
    }else{
        $('#note-comparey').css('display', 'none');
        $('.note').css('display','none');
    }

    if(!$('#content-message').val()){
        $('.notes').css('display','block');
        $('#note-content').css('display', 'block');
        return false;
    }else{
        $('#note-content').css('display', 'none');
        $('.notes').css('display','none');
    }


    return true;
}