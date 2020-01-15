tinymce.init({
    selector: '#content,#explain,#answer_A,#answer_B,#answer_C,#answer_D,#answer_E,#answer_F,#answer_G,#answer_H',
    menubar: false,
    plugins: 'image code tiny_mce_wiris',
    height: 100,
    toolbar: "undo redo | bold italic underline | responsivefilemanager | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry",
    images_upload_url: '/theme/upload.php',
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/theme/upload.php');

        xhr.onload = function () {
            var json;

            if (xhr.status !== 200) {
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