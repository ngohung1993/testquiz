/**
 * Created by vietv on 3/10/2018.
 */

$(function () {

    let loading = $('.loading');

    $('#tree-5aa383cc537d1').nestable([]);

    $('.tree-5aa383cc537d1-save').click(function () {

        loading.css('display', 'block');

        let serialize = $('#tree-5aa383cc537d1').nestable('serialize');

        $.ajax({
            url: base + 'ajax/serial',
            type: 'post',
            data: {
                serialize: JSON.stringify(serialize)
            },
            success: function () {
                loading.css('display', 'none');
            }
        });
    });

    $('.tree-5aa383cc537d1-tree-tools').on('click', function (e) {
        let target = $(e.target),
            action = target.data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });

});