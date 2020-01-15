!function (t) {
    let e = {};

    function a(n) {
        if (e[n]) return e[n].exports;
        let l = e[n] = {i: n, l: !1, exports: {}};
        return t[n].call(l.exports, l, l.exports, a), l.l = !0, l.exports
    }

    a.m = t, a.c = e, a.d = function (t, e, n) {
        a.o(t, e) || Object.defineProperty(t, e, {configurable: !1, enumerable: !0, get: n})
    }, a.n = function (t) {
        let e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return a.d(e, "a", e), e
    }, a.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, a.p = "/", a(a.s = 91)
}({
    91: function (t, e, a) {
        t.exports = a(92)
    }, 92: function (t, e) {
        let a = function () {
            function t(t, e) {
                for (let a = 0; a < e.length; a++) {
                    let n = e[a];
                    n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n)
                }
            }

            return function (e, a, n) {
                return a && t(e.prototype, a), n && t(e, n), e
            }
        }();
        let n = function () {
            function t() {
                !function (t, e) {
                    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
                }(this, t);
                this.$nestable = $("#nestable");
            }

            return a(t, [{
                key: "setDataItem", value: function (t) {
                    t.each(function (t, e) {
                        let a = $(e);
                        a.data("id", a.attr("data-id")), a.data("title", a.attr("data-title")), a.data("related-id", a.attr("data-related-id")), a.data("type", a.attr("data-type")), a.data("custom-url", a.attr("data-custom-url")), a.data("class", a.attr("data-class")), a.data("target", a.attr("data-target"))
                    })
                }
            }, {
                key: "updatePositionForSerializedObj", value: function (t) {
                    let e = t, a = this;
                    return $.each(e, function (t, e) {
                        e.position = t;
                        void 0 === e.children && (e.children = []);
                        a.updatePositionForSerializedObj(e.children)
                    }), e
                }
            }, {
                key: "init", value: function () {
                    let t = parseInt(this.$nestable.attr("data-depth"));
                    t < 1 && (t = 5);
                    $(".nestable-menu").nestable({
                        group: 1,
                        maxDepth: t,
                        expandBtnHTML: "",
                        collapseBtnHTML: ""
                    });
                    this.handleNestableMenu()
                }
            }, {
                key: "handleNestableMenu", value: function () {
                    let t = this;
                    $(document).on("click", ".dd-item .dd3-content a.show-item-details", function (t) {
                        t.preventDefault();
                        let e = $(t.currentTarget).parent().parent();
                        $(t.currentTarget).toggleClass("active");
                        e.toggleClass("active")
                    });
                    $(document).on("change blur keyup", '.nestable-menu .item-details input[type="checkbox"], .nestable-menu .item-details input[type="text"], .nestable-menu .item-details select', function (e) {
                        e.preventDefault();
                        let a = $(e.currentTarget), n = a.closest("li.dd-item");
                        n.attr("data-" + a.attr("name"), a.val());
                        n.data(a.attr("name"), a.val());
                        n.find('> .dd3-content .text[data-update="' + a.attr("name") + '"]').text(a.val());
                        "" === a.val().trim() && n.find('> .dd3-content .text[data-update="' + a.attr("name") + '"]').text(a.attr("data-old"));
                    });
                    $(document).on("click", ".box-links-for-menu .btn-add-to-menu", function (e) {
                        e.preventDefault();
                        let a = $(e.currentTarget).parents(".the-box"), n = "";
                        if ('custom-field' === a.attr('data-field')) {
                            let l = $("#node-title").val(), i = $("#node-url").val(), s = $("#node-css").val(),
                                d = $("#node-icon").val(), o = $("#target").find("option:selected").val();
                            n += '<li data-type="custom-link" data-related-id="0" data-title="' + l + '" data-class="' + s + '" data-id="0" data-custom-url="' + i + '" data-icon-font="' + d + '" data-target="' + o + '" class="dd-item dd3-item">';
                            n += '<div class="dd-handle dd3-handle"></div>';
                            n += '<div class="dd3-content">';
                            n += '<span class="text float-left" data-update="title">Custom field</span>';
                            n += '<span class="text float-right">custom-field</span>';
                            n += '<a href="#" class="show-item-details"><i class="fa fa-angle-down"></i></a>';
                            n += '<div class="clearfix"></div>';
                            n += "</div>";
                            n += '<div class="item-details">';
                            n += '<label class="pad-bot-5">';
                            n += '<span class="text pad-top-5 dis-inline-block" data-update="title">Tiêu đề</span>';
                            n += '<input type="text" data-old="' + l + '" value="" name="title" class="form-control">';
                            n += "</label>";
                            n += '<label class="pad-bot-5"><span class="text pad-top-5 dis-inline-block" data-update="custom-url">Mô tả</span><input type="text" data-old="' + i + '" value="" name="custom-url"></label>';
                            n += '<label class="pad-bot-5 dis-inline-block"><span class="text pad-top-5" data-update="icon-font">Placeholder</span><input type="text" name="icon-font" value="" data-old="' + d + '" class="form-control"></label>';
                            n += '<label class="pad-bot-10">';
                            n += '<span class="text pad-top-5 dis-inline-block" data-update="class">Giá trị</span>';
                            n += '<input type="text" data-old="' + s + '" value="" name="class" class="form-control">';
                            n += "</label>";
                            n += '<label class="pad-bot-10">';
                            n += '<span class="text pad-top-5 dis-inline-block" data-update="class">Type</span>';
                            n += '<input type="text" data-old="' + s + '" value="1" name="class" class="form-control">';
                            n += "</label>";
                            n += '<div class="text-right">';
                            n += '<a class="btn red btn-remove" href="#">Remove</a>';
                            n += '<a class="btn blue btn-cancel" href="#">Cancel</a>';
                            n += "</div>";
                            n += "</div>";
                            n += '<div class="clearfix"></div>';
                            n += "</li>";
                            a.find('input[type="text"]').val('');
                        }
                        else if ('section' === a.attr('data-field')) {
                            n += '<li data-key="" data-title="" data-description="" data-type="2" data-id="0" class="dd-item dd3-item">';
                            n += '<div class="dd-handle dd3-handle"></div>';
                            n += '<div class="dd3-content">';
                            n += '<span class="text float-left" data-update="title">Section</span>';
                            n += '<span class="text float-right">section</span>';
                            n += '<a href="#" class="show-item-details"><i class="fa fa-angle-down"></i></a>';
                            n += '<div class="clearfix"></div>';
                            n += "</div>";
                            n += '<div class="item-details">';
                            n += '<label class="pad-bot-5">';
                            n += '<span class="text pad-top-5 dis-inline-block" data-update="title">Tiêu đề</span>';
                            n += '<input type="text" value="" name="title" class="form-control">';
                            n += "</label>";
                            n += '<label class="pad-bot-5">';
                            n += '<span class="text pad-top-5 dis-inline-block">Key</span>';
                            n += '<input type="text" value="" name="key" class="form-control">';
                            n += "</label>";
                            n += '<label class="pad-bot-5"><span class="text pad-top-5 dis-inline-block">Mô tả</span>';
                            n += '<input type="text" value="" name="description">';
                            n += '</label>';
                            n += '<div class="text-right">';
                            n += '<a class="btn red btn-remove" href="#">Remove</a>';
                            n += '<a class="btn blue btn-cancel" href="#">Cancel</a>';
                            n += "</div>";
                            n += "</div>";
                            n += '<div class="clearfix"></div>';
                            n += "</li>";
                            a.find('input[type="text"]').val('');
                        }

                        $(".nestable-menu > ol.dd-list").append(n);
                        t.setDataItem(t.$nestable.find("> ol.dd-list li.dd-item"));
                        a.find(".list-item li.active").removeClass("active");
                    });
                    $('.form-save-menu input[name="deleted_nodes"]').val("");
                    $(document).on("click", ".nestable-menu .item-details .btn-remove", function (t) {
                        t.preventDefault();
                        let e = $(t.currentTarget).parents(".item-details").parent(),
                            a = $('.form-save-menu input[name="deleted_nodes"]');
                        a.val(a.val() + " " + e.attr("data-id"));
                        let n = e.find("> .dd-list").html();
                        "" !== n && null != n && e.before(n);
                        e.remove();
                    });
                    $(document).on("click", ".nestable-menu .item-details .btn-cancel", function (t) {
                        t.preventDefault();
                        let e = $(t.currentTarget).parents(".item-details").parent();
                        e.find('input[type="text"]').each(function (t, e) {
                            $(e).val($(e).attr("data-old"))
                        });
                        e.find("select").each(function (t, e) {
                            $(e).val($(e).val())
                        });
                        e.find('input[type="text"]').trigger("change");
                        e.find("select").trigger("change");
                        e.removeClass("active")
                    });
                    $(document).on("change", ".box-links-for-menu .list-item li input[type=checkbox]", function (t) {
                        $(t.currentTarget).closest("li").toggleClass("active")
                    });
                    $(document).on("submit", ".form-save-menu", function () {
                        if (t.$nestable.length < 1) $("#nestable-output").val("[]"); else {
                            let e = t.$nestable.nestable("serialize"), a = t.updatePositionForSerializedObj(e);
                            $("#nestable-output").val(JSON.stringify(a))
                        }
                    });
                    let e = $("#accordion"), a = function (t) {
                        $(t.target).prev(".widget-heading").find(".narrow-icon").toggleClass("fa-angle-down fa-angle-up")
                    };
                    e.on("hidden.bs.collapse", a);
                    e.on("shown.bs.collapse", a);
                }
            }]), t
        }();
        $(window).on("load", function () {
            (new n).init()
        })
    }
});