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
    let thumbnail = jQuery('.' + field_id);

    let url = image.val();
    image.val('/uploads/library/source/' + url);

    $('.thumbnail-' + field_id).css('display', 'none');
    $('.remove-thumbnail-' + field_id).css('display', 'block');

    thumbnail.attr('src', '/uploads/library/source/' + url);
    thumbnail.css('display', 'block');
}

let remove_thumbnail = function (field_id) {
    $('.thumbnail-' + field_id).css('display', 'block');
    $('.remove-thumbnail-' + field_id).css('display', 'none');

    let image = jQuery('#' + field_id);
    let thumbnail = jQuery('.' + field_id);

    image.val('/uploads/cms/img/placeholder.png');
    thumbnail.attr('src', '/uploads/cms/img/placeholder.png');
};