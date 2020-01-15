function readMessage(id) {
    console.log(id);
    if(id){

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/change-message-status',
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data);
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