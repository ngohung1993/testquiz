$(document).ready(function () {
    $('#class_avatar_img_exam').click(function () {
        $('#cropContainerModal_imgUploadField_exam').trigger('click');
    });
    $('#upload_avatar_button_exam').click(function () {
        $('#cropContainerModal_imgUploadField_exam').trigger('click');
    });
    $('.search #input-search').keyup(function (e) {
        if (e.keyCode === 13) {
            createExam.searchExam();
        }
    });
    $('#cropContainerModal_imgUploadField_exam').change(function () {

        let fd = new FormData();

        let files = event.target.files;
        console.log(files);

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
                    console.log(response);

                    $('#class_avatar_img_exam').attr('src', '/uploads/advertises/' + response[0]);

                    $('#classroom-avatar-exam').val('/uploads/advertises/' + response[0]);
                }
            });
        }
    });
});

function getClassroom(sel) {
    let id = sel.value;
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'ajax/show-subject',
        data: {id: id},
        success: function (data) {
            if (data) {
                $('#subject').html(data);
            }
        }
    });
}

/**
 *
 * @param sel
 */
function getTopic(sel) {
    let subject_id = sel.value;
    let classroom_id = $('#classroom').val();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'ajax/show-topic',
        data: {
            subject_id: subject_id,
            classroom_id: classroom_id,
        },
        success: function (data) {
            if (data) {
                $('#topic_user').html(data);
                $('#add-topic').css('display', 'block');
            }
        }
    });
}

let flag = true;

/**
 *
 * @returns {boolean}
 */
function validateForm() {

    if (!$('#classroom').val()) {
        $('.note').css('display', 'block');
        $('#note-class').css('display', 'block');
        return false;
    } else {
        $('#note-class').css('display', 'none');
    }

    if (!$('#subject').val()) {
        $('.note').css('display', 'block');
        $('#note-subject').css('display', 'block');
        return false;
    } else {
        $('#note-subject').css('display', 'none');
    }

    if (!$('#topic_user').val()) {
        $('.note').css('display', 'block');
        $('#note-topic').css('display', 'block');
        return false;
    } else {
        $('#note-topic').css('display', 'none');
    }

    if (!$('#title').val()) {
        $('.note').css('display', 'block');
        $('#note-title').css('display', 'block');
        return false;
    } else {
        $('#note-title').css('display', 'none');
    }

    if (!$('input[name="Exam[classify]"]:checked').val()) {
        $('.note').css('display', 'block');
        $('#note-classify').css('display', 'block');
        return false;
    } else {
        $('#note-classify').css('display', 'none');
    }

    if ($('input[name="Exam[classify]"]:checked').val() == 3) {
        if (!$(set_date_time).val()) {
            $('.note').css('display', 'block');
            $('#select-set-time').css('display', 'block');
            return false;
        } else {
            $('#select-set-time').css('display', 'none');
        }
    }
    if ($('input[name="Exam[classify]"]:checked').val() == 3) {
        if (!$(set_date_time_end).val()) {
            $('.note').css('display', 'block');
            $('#select-set-time-end').css('display', 'block');
            return false;
        } else {
            $('#select-set-time-end').css('display', 'none');
        }
    }

    if (!$('input[name="Exam[type]"]:checked').val()) {
        $('.note').css('display', 'block');
        $('#note-type').css('display', 'block');
        return false;
    } else {
        $('#note-type').css('display', 'none');
    }

    $('.note').css('display', 'none');
    return true;
}

$("form").keypress(function (e) {
    if (e.which === 13) {
        return false;
    }
});

function validateFormTopic() {

    if (!$('#category_id').val()) {
        $('.note').css('display', 'block');
        $('#note-category').css('display', 'block');
        return false;
    } else {
        $('#note-category').css('display', 'none');
    }

    if (!$('#classroom').val()) {
        $('.note').css('display', 'block');
        $('#note-class').css('display', 'block');
        return false;
    } else {
        $('#note-class').css('display', 'none');
    }

    if (!$('#subject').val()) {
        $('.note').css('display', 'block');
        $('#note-subject').css('display', 'block');
        return false;
    } else {
        $('#note-subject').css('display', 'none');
    }

    if (!$('#title').val()) {
        $('.note').css('display', 'block');
        $('#note-title').css('display', 'block');
        return false;
    } else {
        $('#note-title').css('display', 'none');

    }
    $('.note').css('display', 'none');
    return true;
}


$(document).ready(function () {
    $('#class_avatar_img_topic').click(function () {
        $('#cropContainerModal_imgUploadField_topic').trigger('click');
    });
    $('#upload_avatar_button_topic').click(function () {
        $('#cropContainerModal_imgUploadField_topic').trigger('click');
    });

    $('#cropContainerModal_imgUploadField_topic').change(function () {

        let fd = new FormData();

        let files = event.target.files;
        console.log(files);

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
                    console.log(response);

                    $('#class_avatar_img_topic').attr('src', '/uploads/advertises/' + response[0]);

                    $('#classroom-avatar-topic').val('/uploads/advertises/' + response[0]);
                }
            });
        }
    });
});

function insertTopic() {
    let title = $('#title-topic').val();
    let category_id = $('#category_id').val();
    let category_title = $("#category_id option:selected").text();
    console.log(category_title);
    let topic_status = '';
    if ($('#topic-status').is(':checked') === true) {
        topic_status = 0;
    } else {
        topic_status = 3;
    }
    if (!title) {
        $('#note-title-topic').html('Không được để trống').css('color', 'red');
        flag = false;
    } else {
        $('#note-title-topic').html('');
        flag = true;
    }
    if (!category_id) {
        $('#note-category').html('Không được để trống').css('color', 'red');
        flag = false;
    } else {
        $('#note-category').html('');
        flag = true;
    }
    if (flag === true) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ajax/insert-topic',
            data: {
                title: title,
                status: topic_status,
                category_id: category_id,
                avatar: $('#classroom-avatar-topic').val(),
                description: $('#descriptions').val(),
                classroom: $('#classroom').val(),
                subject: $('#subject').val(),

            },
            success: function (data) {
                console.log(data.id);
                if (data) {
                    // $('#myModal').modal('toggle');
                    let select = $('#topic_user');
                    select.append('<option value="' + data.id + '">' + title + '</option>');
                    select.val(data.id);

                    $('#category').append('<option value="' + data.category_id + '">' + category_title + '</option>');
                    $('#category').val(data.category_id);
                }
            }
        });
    }
}

var doc_upload = {};
$(document).ready(function () {
    $('#tmpBtnSelectFile').click(function () {
        $('#tmpFile').click();
    });
    $('#tmpBtnSelectFile2').click(function () {
        $('#tmpFile2').click();
    });
});

doc_upload.copyfilename = function (oFileInput, sTargetID) {

    var arrTemp = oFileInput.value.split('\\');
    document.getElementById(sTargetID).value = arrTemp[arrTemp.length - 1];
};

/**
 *
 * @returns {boolean}
 */
function validateFormUpload() {
    let uploadExam = $('#tmpFileFake').val();
    let numberQuestion = $('#number-question').val();
    let uploadAnswer = $('#tmpFileFake2').val();
    let answerQuestion = $('#answer-question').val();

    if (numberQuestion <= 0) {
        $('.note-upload').css('display', 'block');
        $('#note-number-question').css('display', 'block');
        return false;
    }
    else {
        $('#note-number-question').css('display', 'none');
    }
    if (!uploadExam) {
        $('.note-upload').css('display', 'block');
        $('#note-exam-empty').css('display', 'block');
        return false;
    }
    else if ((uploadExam.substr(-4) === 'docx') || (uploadExam.substr(-4) === '.doc') || (uploadExam.substr(-4) === '.pdf') || (uploadExam.substr(-4) === '.jpg') || (uploadExam.substr(-4) === '.png')) {
        $('#note-exam').css('display', 'none');
        $('#note-exam-empty').css('display', 'none');
        // flag = true;
    } else {
        $('.note-upload').css('display', 'block');
        $('#note-exam').css('display', 'block');
        $('#note-exam-empty').css('display', 'none');
        return false;
    }

    if (!answerQuestion) {
        $('.note-upload').css('display', 'block');
        $('#note-list-answer').css('display', 'block');
        return false;
    }

    let countColon = 0;
    for (let i = 0; i < answerQuestion.length; i++) {
        if (answerQuestion.charAt(i) === ':') {
            countColon++;
        }
    }
    if (countColon < numberQuestion) {
        $('.note-upload').css('display', 'block');
        $('#note-colon').css('display', 'block');
        return false;
    }
    else if (countColon > numberQuestion) {
        $('.note-upload').css('display', 'block');
        $('#note-colon').css('display', 'block');
        return false;
    } else {
        $('#note-excess-colon').css('display', 'none');
        $('#note-colon').css('display', 'none');
        $('#note-list-answer').css('display', 'none');
        // flag = true;
        console.log(':');
    }
    let countSemiColon = 0;

    for (let i = 0; i < answerQuestion.length; i++) {
        if (answerQuestion.charAt(i) === ';') {
            countSemiColon++;
        }
    }
    if (countSemiColon < numberQuestion) {
        $('.note-upload').css('display', 'block');
        $('#note-excess-semi-colon').css('display', 'block');
        return false;
    }
    else if (countSemiColon > numberQuestion) {
        $('.note-upload').css('display', 'block');
        $('#note-excess-semi-colon').css('display', 'block');
        return false;
    } else {
        $('#note-excess-semi-colon').css('display', 'none');
        $('#note-list-answer').css('display', 'none');
    }

    let arr = answerQuestion.split(';');
    console.log(arr.length, Number(numberQuestion));
    if (arr.length !== Number(numberQuestion) + 1) {
        $('.note-upload').css('display', 'block');
        $('#note-count-question').css('display', 'block');
        return false;
    } else {
        $('#note-count-question').css('display', 'none');
    }

    if (!uploadAnswer) {
        $('.note-upload').css('display', 'block');
        $('#note-answer-empty').css('display', 'block');
        return false;
    } else {
        $('#note-answer-empty').css('display', 'none');
    }

    $('.note-upload').css('display', 'none');
    return true;
}

function getCategory(sel) {
    let topic_id = sel.value;
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'ajax/show-category',
        data: {
            topic_id: topic_id,
        },
        success: function (data) {
            if (data) {
                $('#category').html(data);
            }
        }
    });
}

$(function () {
    $('#set_time input[type=radio]').change(function () {
        if ($(this).val() == 3) {
            $('#display-input-time').css('display', 'block');
            $('#display-input-time-end').css('display', 'block');
        } else {
            $('#display-input-time').css('display', 'none');
            $('#display-input-time-end').css('display', 'none');
            $('#set_date_time').val('');
            $('#set_date_time_end').val('');
        }
    });
});

$(function () {
    $('#datetimepicker2').datetimepicker({
        locale: 'ru',
        format: 'MM/DD/YYYY HH:mm'
    });
});

$(function () {
    $('#datetimepicker3').datetimepicker({
        locale: 'ru',
        format: 'MM/DD/YYYY HH:mm'
    });
});

tinymce.init({
    selector: '#introduce',
    plugins: 'image code',
    height: 300,
    toolbar1: "undo redo | print save | fontselect |  fontsizeselect | formatselect bold italic strikethrough  underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | wordcount | hr anchor| ",
    toolbar2: "responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | preview code | table | fullscreen | ",

    // without images_upload_url set, Upload tab won't show up
    images_upload_url: '/theme/upload.php',

    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/theme/upload.php');

        xhr.onload = function () {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    },
});

