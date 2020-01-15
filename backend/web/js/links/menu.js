$(document).on("click", ".box-links-for-menu .btn-add-to-menu", function (e) {
    e.preventDefault();
    let a = $(e.currentTarget).parents(".the-box"), n = '';

    $('.categories-selection').find('input:checked').each(function () {
        n += '<li data-id="' + $(this).val() + '" class="dd-item dd3-item">';
        n += '<div class="dd-handle dd3-handle"></div>';
        n += '<div class="dd3-content">';
        n += '<span class="text float-left" data-update="title">' + $(this).data('title') + '</span>';
        n += '<a href="#" class="show-item-details"><i class="fa fa-trash"></i></a>';
        n += "</div>";
        n += '<div class="clearfix"></div>';
        n += "</li>";

        $(this).prop('checked', false);
    });

    $(".nestable-menu > ol.dd-list").append(n);
    a.find(".list-item li.active").removeClass("active");
});

$(document).on("click", ".dd-item .dd3-content a.show-item-details", function (t) {
    t.preventDefault();
    let e = $(t.currentTarget).parent().parent().remove();
});