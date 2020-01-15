let helper = {
    prepare_transition: function (ele) {
        return jQuery(ele).each(function () {
            let t = jQuery(ele);
            t.one("TransitionEnd webkitTransitionEnd transitionend oTransitionEnd",
                function () {
                    t.removeClass("is-transitioning")
                });
            let n = ["transition-duration", "-moz-transition-duration", "-webkit-transition-duration",
                "-o-transition-duration"], i = 0;
            jQuery.each(n, function (e, n) {
                i || (i = parseFloat(t.css(n)))
            });
            t.addClass("is-transitioning");
            t[0].offsetWidth;
        })
    },
    check_config: function () {
        let iCheck = $('input[type="checkbox"].minimal, input[type="radio"].minimal');

        iCheck.iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'icheckbox_flat-blue'
        });

        iCheck.on('ifChanged', function (event) {
            $(event.target).change();
        });
    }
};

helper.check_config();

$('#cp2, #cp3a, #cp3b').colorpicker();

const toast = swal.mixin({
    toast: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000
});

let editor = {
    current_section: 1,
    origin_values: {},
    changes: 0,
    main: {
        open_section: function (sectionId) {
            $('.theme-editor__panel').removeClass('theme-editor__panel--is-visible theme-editor__panel--is-active');
            helper.prepare_transition($('#panel-' + sectionId)).addClass('theme-editor__panel--is-visible theme-editor__panel--is-active');
            this.current_section = sectionId;
        },
        close_section: function () {
            helper.prepare_transition($('.theme-editor__panel')).removeClass('theme-editor__panel--is-visible theme-editor__panel--is-active');
            this.current_section = -1;
        },
        change_theme_preview_mode: function (element) {
            let modePreview = $(element).attr('data-preview');
            this.previewSize = modePreview;
            this.viewportSize = modePreview;
            $(document).find("#theme-editor").removeClass("theme-editor--fullscreen");
            $(document).find('.theme-editor__iframe-wrapper').attr('data-preview-window', modePreview);
        },
        utf8_encode: function (arg_string) {

            if (arg_string === null || typeof arg_string === 'undefined') {
                return '';
            }

            let string = (arg_string + '');
            let utf_text = '', start, end, string_l;

            start = end = 0;
            string_l = string.length;

            for (let n = 0; n < string_l; n++) {
                let c1 = string.charCodeAt(n);
                let enc = null;

                if (c1 < 128) {
                    end++;
                } else if (c1 > 127 && c1 < 2048) {
                    enc = String.fromCharCode(
                        (c1 >> 6) | 192, (c1 & 63) | 128
                    );
                } else if ((c1 & 0xF800) !== 0xD800) {
                    enc = String.fromCharCode(
                        (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
                    );
                } else {
                    if ((c1 & 0xFC00) !== 0xD800) {
                        throw new RangeError('Unmatched trail surrogate at ' + n);
                    }
                    let c2 = string.charCodeAt(++n);
                    if ((c2 & 0xFC00) !== 0xDC00) {
                        throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
                    }
                    c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
                    enc = String.fromCharCode(
                        (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
                    );
                }
                if (enc !== null) {
                    if (end > start) {
                        utf_text += string.slice(start, end);
                    }
                    utf_text += enc;
                    start = end = n + 1;
                }
            }

            if (end > start) {
                utf_text += string.slice(start, string_l);
            }

            return utf_text;
        },
        add_setting_to_form_setting_theme: function (custom_field_id, custom_field_type, value, origin_value) {
            let $form_item = $("#form-settings-theme");

            let $custom_field = $form_item.find("#custom-field-" + custom_field_id);

            if ($custom_field.length !== 0) {
                $custom_field.remove();
                this.changes--;
            }

            if (value !== origin_value) {
                let html = "<input type='hidden' class='custom-field-value' name='CustomFields[" + custom_field_id + "]' value='" + value + "' id='custom-field-" + custom_field_id + "' data-id='" + custom_field_id + "' data-type='" + custom_field_type + "'/>";
                $form_item.append($(html));
                this.changes++;

                if (this.changes > 0) {
                    let btn_remove = $('.btn-remove-changes');
                    let btn_save = $('.btn-save-changes');

                    btn_remove.removeAttr('disabled');
                    btn_save.removeAttr('disabled');
                    btn_remove.removeClass('disabled');
                    btn_save.removeClass('disabled');
                }
            }
        },
        reload_frame_preview: function () {
            $('iframe').each(function () {
                this.contentWindow.location.reload(true);
            });
        },
        submit_setting_theme: function () {

            $('#btn-remove-setting').addClass("disabled is-loading");

            $.ajax({
                url: '/admin/ajax/submit-setting-theme',
                type: "POST",
                data: $("#form-settings-theme").serialize(),
                success: function (response) {
                    if (response) {
                        editor.main.reload_frame_preview();

                        setTimeout(function () {
                            $('#btn-remove-setting').removeClass("disabled is-loading");
                        }, 1000);

                        toast({
                            type: 'success',
                            title: 'Cập nhật thông tin thành công.'
                        });
                    }
                }
            });
        },
        override_theme_editor: function (custom_field_id, custom_field_type, element) {
            let origin_setting = {};
            let custom_field = $('#setting-' + custom_field_id);

            let start_value = custom_field.attr('data-start-value');

            origin_setting.origin_value = custom_field.attr('data-origin-value');
            origin_setting.setting_id = custom_field_id;
            origin_setting.setting_type = custom_field_type;
            origin_setting.start_value = start_value;

            let setting_type_different = ['collection', 'blog', 'page'];
            if ($.inArray(custom_field_type, setting_type_different) > -1) {
                origin_setting.start_text = custom_field.attr('start-text');
            } else {
                origin_setting.start_text = start_value;
            }

            let value = null;

            switch (custom_field_type) {
                case "type-image":
                    value = $(element).attr('src');

                    break;
                case "type-text":
                case "type-select":
                    value = $(element).val();

                    break;
                case "type-checkbox":
                    value = $(element).is(":checked") ? 1 : 0;

                    break;
                default:
                    break;
            }

            this.add_setting_to_form_setting_theme(custom_field_id, custom_field_type, value, origin_setting.origin_value);
        },
        get_custom_field: function (id) {
            $.ajax({
                url: '/admin/ajax/get-custom-field',
                type: "POST",
                data: {
                    id: id
                },
                success: function (result) {
                    if (result) {
                        CKEDITOR.instances['content'].setData(result['content']);
                        $('#custom-field-id').val(result['id'])
                    }
                }
            });
        },
        update_content_custom_field: function () {
            $('#btn-remove-setting').addClass("disabled is-loading");

            $.ajax({
                url: '/admin/ajax/update-content-custom-field',
                type: "POST",
                data: {
                    id: $('#custom-field-id').val(),
                    content: CKEDITOR.instances['content'].getData()
                },
                success: function (result) {
                    if (result) {

                        editor.main.reload_frame_preview();

                        setTimeout(function () {
                            $('#btn-remove-setting').removeClass("disabled is-loading");
                        }, 1000);

                        $('#content-form').modal('hide');

                        toast({
                            type: 'success',
                            title: 'Cập nhật thông tin thành công.'
                        });
                    }
                }
            });
        },
        copy_custom_field: function (id, event) {
            event.preventDefault();

            let r = confirm('Bác có chắc chắn sao chép bản ghi này?');
            if (r === true) {
                $.ajax({
                    url: '/admin/ajax/copy-custom-field',
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (result) {
                        if (result) {
                            toast({
                                type: 'success',
                                title: 'Cập nhật thông tin thành công.'
                            });
                        }
                    }
                });
            }
        },
        delete_custom_field: function (id, event) {
            event.preventDefault();

            $('#btn-remove-setting').addClass("disabled is-loading");

            let r = confirm('Bác có chắc chắn sao chép bản ghi này?');
            if (r === true) {
                $.ajax({
                    url: '/admin/ajax/delete-custom-field',
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function (result) {
                        if (result) {
                            setTimeout(function () {
                                $('#btn-remove-setting').removeClass("disabled is-loading");
                            }, 1000);
                        }
                    }
                });
            }
        }
    }
};