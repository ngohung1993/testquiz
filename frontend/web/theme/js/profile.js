$(document).ready(function () {
    $('#class_avatar_img').click(function () {
        $('#cropContainerModal_imgUploadField').trigger('click');
    });

    $('#cropContainerModal_imgUploadField').change(function () {
        let fd = new FormData();

        let files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            fd.append('files[]', files[i]);
        }

        if (files) {
            $.ajax({
                url: '/uploads/cms/upload.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response);
                    let avatar = '/uploads/advertises/' + response[0];
                    save_avatar_user(avatar);

                    $('#class_avatar_img').attr('src', '/uploads/advertises/' + response[0]);
                    $('#avatar-top').attr('src', '/uploads/advertises/' + response[0]);

                    $('#user-avatar').val('/uploads/advertises/' + response[0]);
                }
            });
        }
    });
});
let save_avatar_user = function (avatar) {
    $.ajax({
        url: '/ajax/save-avatar-user',
        type: 'POST',
        data: {
            avatar: avatar,
        },
        success: function (e) {
            console.log(e);
        }
    });
};
let save_profile = function () {
    let birthday = $('#birthday').val();
    let phone = $('#phone').val();
    let address = $('#address').val();
    $.ajax({
        url: '/ajax/save-profile',
        type: 'POST',
        data: {
            birthday: birthday,
            phone: phone,
            address: address
        },
        success: function () {
            location.reload();
        }
    });
};
let save_description_in_user = function () {
    let description = tinyMCE.activeEditor.getContent();
    console.log(description);
    $.ajax({
        url: '/ajax/save-profile',
        type: 'POST',
        data: {
            description: description,
        },
        success: function () {
            location.reload();
        }
    });
};

