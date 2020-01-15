let generate_color_picker = function (selector) {
    $('#' + selector).ColorPicker({
        color: '#0000ff',
        onShow: function (s) {
            $(s).fadeIn(500);
            return false;
        },
        onHide: function (s) {
            $(s).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex) {
            $('#' + selector).css('backgroundColor', '#' + hex);
        }
    });

};

generate_color_picker('color-selector-background');
generate_color_picker('color-selector-header-text');
generate_color_picker('color-selector-text');
generate_color_picker('color-selector-button');
generate_color_picker('color-selector-button-text');