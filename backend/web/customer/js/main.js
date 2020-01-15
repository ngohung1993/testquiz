tinymce.init({
    selector: 'textarea.answer',
    height: 20,
    plugins: [
        "codemirror advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality"
    ],
    toolbar1: "undo redo bold italic underline",
    image_advtab: true,
    menubar: false,
    toolbar_items_size: 'small',
    relative_urls: false,
    remove_script_host: false,
    filemanager_title: "Media Manager"
});
