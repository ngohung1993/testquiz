$(document).ready(function () {
    $('#uploads_avatar_button').click(function () {
        $('#cropContainerModal_imgUploadFields').trigger('click');
    });

    $('#cropContainerModal_imgUploadFields').change(function () {
        let fd = new FormData();

        let files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            fd.append('files[]', files[i]);
        }

        if (files) {
            $.ajax({
                url: '/uploads/core/upload.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response);
                    let avatar = '/uploads/advertises/' + response[0];
                    save_avatar_user(avatar);

                    $('#class_avatar_imgs').attr('src', '/uploads/advertises/' + response[0]);

                    $('#user-avatar').val('/uploads/advertises/' + response[0]);
                }
            });
        }
    });

    let save_avatar_user = function (avatar) {
        $.ajax({
            url: 'admin/ajax/save-avatar-user',
            type: 'POST',
            data: {
                avatar: avatar,
                id_user: id_user
            },
            success: function (e) {
                console.log(e);
            }
        });
    }
});