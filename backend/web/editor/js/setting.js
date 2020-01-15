let myCheckbox = $("[name='switch-checkbox']");

let loading = $('.loading');

myCheckbox.bootstrapSwitch();

myCheckbox.on('switchChange.bootstrapSwitch', function () {
    loading.css('display', 'block');

    $.ajax({
        url: base + $(this).data('api'),
        type: 'post',
        data: {
            id: $(this).data('id'),
            table: $(this).data('table'),
            api: $(this).data('api'),
            column: $(this).data('column')
        },
        success: function (response) {
            console.log(response);
            loading.css('display', 'none');
        }
    });
});

$('.tags').tagsinput();

$('.kv-file-drop-zone').change(function () {

    loading.css('display', 'block');

    let fd = new FormData();

    let auto = $(this).data('auto');

    let id = $(this).data('id');

    let column_parent_id = $(this).data('column-parent-id');

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
                if (response.length !== 0) {
                    if (auto === 1) {
                        $.ajax({
                            url: base + 'ajax/upload-image',
                            type: 'post',
                            data: {
                                images: JSON.stringify(response),
                                id: id,
                                column_parent_id: column_parent_id
                            },
                            success: function () {
                                loading.css('display', 'none');
                            }
                        });
                    }

                    for (i = 0; i < response.length; i++) {
                        let children = $('#list-img-temp');

                        children.children().children().find('img').attr('src', '/uploads/advertises/' + response[i]);
                        children.find('.caption').html(response[i]);
                        $('#list-img').append(children.html());
                    }
                }

                loading.css('display', 'none');
            }
        });
    }

    loading.css('display', 'none');
});

let deleteFile = function (event) {

    loading.css('display', 'block');

    let auto = 0;
    let id = 0;

    if ($(event.target).is('i')) {
        auto = $(event.target).parent().data('auto');
        id = $(event.target).parent().data('id');
    }
    else {
        auto = $(event.target).data('auto');
        id = $(event.target).data('id');
    }

    let url = $(event.target).closest(".file-preview-frame").find('img').attr('src');

    let r = confirm('Bạn có chắc chắn muốn xóa ' + url);

    if (r === true) {
        $.ajax({
            url: '/uploads/cms/delete.php',
            type: 'post',
            data: {path: url},
            success: function () {
                $(event.target).closest(".file-preview-frame").remove();

                if (auto) {
                    $.ajax({
                        url: '/uploads/cms/delete.php',
                        type: 'post',
                        data: {id: id},
                        success: function () {
                            $(event.target).closest(".file-preview-frame").remove();

                            if (auto) {
                                $.ajax({
                                    url: base + 'ajax/delete-image',
                                    type: 'post',
                                    data: {id: id},
                                    success: function () {

                                        loading.css('display', 'none');
                                    }
                                });

                                loading.css('display', 'none');
                            }
                        }
                    });
                }

                loading.css('display', 'none');
            }
        });
    }
    else {
        loading.css('display', 'none');
    }
};

let getImages = function () {
    let images = [];

    $('#list-img').find('.kv-file-content img').each(function () {

        let url = $(this).attr('src');

        images.push(url);

    });

    $('#images').val(JSON.stringify(images));

};

$('.form-group').each(function () {
    if ($(this).hasClass('required')) {
        $(this).find('.control-label').append('<b style="color: red;" > *</b>');
    }
});

$('.counter').keyup(function () {

    let content = $(this).val();

    $(this).closest('.parent').find('small span').text(content.length);
});

$('.title-preview').keyup(function () {

    let content = $(this).val();

    $('.page-title-seo').text(content);
    $('.page-slug-seo').text(string_to_slug(content));
});

$('.description-preview').keyup(function () {

    let content = $(this).val();

    $('.page-description-seo').text(content);
});