let frame = $('.frame-btn');

frame.fancybox({
    'width': 900,
    'height': 600,
    'type': 'iframe',
    'autoScale': false
});

function OnMessage(e) {
    let event = e.originalEvent;
    if (event.data.sender === 'responsivefilemanager') {
        if (event.data.field_id) {
            let fieldID = event.data.field_id;
            let url = event.data.url;

            $('#' + fieldID).val(url).trigger('change');
            $.fancybox.close();
            $(window).off('message', OnMessage);
        }
    }
}

function responsive_filemanager_callback(field_id) {
    let image = jQuery('#' + field_id);

    let url = image.val();

    image.attr('src', '/uploads/library/source/' + url);

    image.change();
}