/**
 * Created by vietv on 3/10/2018.
 */

$(function () {

    let loading = $('.loading');

    $('#tree-5aa383cc537d1').nestable({'maxDepth': 1});

    $('.tree-5aa383cc537d1-save').click(function () {
        loading.css('display', 'block');

        let serialize = $('#tree-5aa383cc537d1').nestable('serialize');

        let items = [];

        for (let i = 0; i < serialize.length; i++) {
            let item = {};
            item.serial = i + 1;
            item.category_id = serialize[i]['id'];

            items.push(item);
        }

        $('#items').val(JSON.stringify(items));

        let locations = [];
        $('.location-menu').find('input:checked').each(function () {
            locations.push($(this).val());
        });

        $('#location-menus').val(JSON.stringify(locations));
    });
});