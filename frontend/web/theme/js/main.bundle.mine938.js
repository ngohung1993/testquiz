/*! jQuery v3.3.1 | (c) JS Foundation and other contributors | jquery.org/license */
function __add_banner(n) {
    AD_DATA[AD_DATA.length] = n
}

function __load_banners() {
    var n = new String, t, i;
    if (AD_DATA.length > 0) {
        for (t = 0; t < AD_DATA.length; t++) i = AD_DATA[t], n = n + "|" + i.type + "|" + i.id + "|" + i.output;
        n = n.substring(1, n.length), function (t, i, r) {
            if (!t.getElementById(r)) {
                var u, f = t.getElementsByTagName(i)[t.getElementsByTagName(i).length - 1];
                u = t.createElement(i);
                u.id = r;
                u.async = !0;
                u.src = "/cache.aspx?_path=" + AD_ROOT_PATH + "banner/&mod=lazy&data=" + n;
                f.parentNode.appendChild(u)
            }
        }(document, "script", "realclickjs")
    }
}

function __getEL(n) {
    return document.getElementById(n)
}

function __setRootPath(n) {
    AD_ROOT_PATH = n == "" || n == null ? "/" : n;
    AD_ROOT_PATH.lastIndexOf("/") < AD_ROOT_PATH.length - 1 && (AD_ROOT_PATH += "/")
}

function __hostName() {
    var n = location.host;
    return n == "" || n == null ? "" : n.toLowerCase()
}

function __pathName() {
    var n = location.pathname, t = n.lastIndexOf("/");
    return t >= 0 ? n.substring(0, t) : n
}

function __getThirdPartyClickLink(n, t, i) {
    return n != "" ? n.indexOf("?") >= 0 ? n + "&banner=" + t + "&from=" + escape(__hostName()) + "&path=" + escape(__pathName()) + "&url=" + escape(i) : n + "?banner=" + t + "&from=" + escape(__hostName()) + "&path=" + escape(__pathName()) + "&url=" + escape(i) : i
}

function __getClickLink(n) {
    return AD_CLICK_PATH.indexOf("?") >= 0 ? AD_CLICK_PATH + "&domain=" + __hostName() + "&type=click&banner=" + n + "&res=" + screen.width + "x" + screen.height : AD_CLICK_PATH + "?domain=" + __hostName() + "&type=click&banner=" + n + "&res=" + screen.width + "x" + screen.height
}

function __onClick(n) {
    __getEL("MetaNET_Click").innerHTML = "<img src='" + __getClickLink(n) + "' border=0 width='1' height='1'/>"
}

function __getViewLink() {
    return AD_BLANK_GIF
}

function IS_NO_LINK(n) {
    return n == "" || n == "#" || n == "javascript:void(0);" || n == "about:blank" || typeof n == "undefined"
}

function GET_ONE_AD(n) {
    return document.getElementById("MetaNET_ADV_NUMBER_" + n)
}

function GET_ALL_AD() {
    var n = [];
    for (i = 1; i <= AD_COUNT; i++) n[length] = GET_ONE_AD(i);
    return n
}

function __getCookie(n) {
    var i, t;
    for (ckA = document.cookie.split(";"), i = "", t = 0; t < ckA.length; t++) if (p = ckA[t].split("="), p[0] = p[0].replace(/^\s+/g, ""), p[0] == n) return p[1];
    return i
}

function __setCookie(n, t, i) {
    var r, u;
    i ? (r = new Date, r.setTime(r.getTime() + i * 864e5), u = "; expires=" + r.toGMTString()) : u = "";
    document.cookie = n + "=" + t + u + "; path=/"
}

function eraseCookie(n) {
    __setCookie(n, "", -1)
}

function __setOpacity(n, t) {
    try {
        t > 100 && (t = 100);
        t < 1 && (t = t * 100);
        n.style.opacity = t / 100;
        n.style.filter = "alpha(opacity='" + t + "')"
    } catch (i) {
    }
}

function __IsNull(n) {
    return typeof n == "undefined" || n == null
}

function __RepIfNull(n, t) {
    return typeof t == "undefined" || t == null ? n : t
}

function __RepIfNullElse(n, t, i) {
    return typeof i == "undefined" || i == null ? n : i
}

function MetaNET_AdObject(n) {
    var t;
    AD_COUNT++;
    this.__id = AD_COUNT;
    this.Id = "MetaNET_ADV_NUMBER_" + AD_COUNT;
    this.name = __RepIfNull(this.Id, n.name);
    this.imageUrl = __RepIfNull("", n.imageUrl);
    this.linkUrl = __RepIfNull("#", n.linkUrl);
    this.title = __RepIfNull("", n.title);
    this.domain = __RepIfNull("", n.domain);
    this.desc = __RepIfNull("", n.desc);
    this.width = __RepIfNull(0, n.width);
    this.height = __RepIfNull(0, n.height);
    this.cssClass = __RepIfNullElse("", " class='" + n.cssClass + "'", n.cssClass);
    this.style = __RepIfNullElse("", " style='" + n.style + "'", n.style);
    this.target = __RepIfNull("_blank", n.target);
    this.wmode = __RepIfNull("transparent", n.wmode);
    this.onclick = __RepIfNull("", n.onclick);
    this.__style = this.style == "" ? "" : __RepIfNull("", n.style);
    this.enableThirdPartyClick = __RepIfNull(!1, n.enableThirdPartyClick);
    this.thirdPartyClickUrl = __RepIfNull(AD_THIRD_PARTY_CLICK_PATH, n.thirdPartyClickUrl);
    this.onMouseOut = __RepIfNull("", n.onMouseOut);
    this.onMouseOver = __RepIfNull("", n.onMouseOver);
    this.enableThirdPartyClick && this.thirdPartyClickUrl != "" && !IS_NO_LINK(this.linkUrl) && (this.linkUrl = __getThirdPartyClickLink(this.thirdPartyClickUrl, this.name, this.linkUrl));
    __IsNull(n.adType) ? (t = new String(this.imageUrl), t = t.toLowerCase(), this.adType = t.lastIndexOf(".swf") >= 0 ? AD_TYPE_FLASH : t.lastIndexOf(".gif") >= 0 || t.lastIndexOf(".jpg") >= 0 || t.lastIndexOf(".png") >= 0 ? AD_TYPE_IMAGE : t.lastIndexOf(".htm") >= 0 || t.lastIndexOf(".asp") >= 0 || t.lastIndexOf(".php") >= 0 || t.lastIndexOf(".html") >= 0 || t.lastIndexOf(".aspx") >= 0 || t.lastIndexOf(".ashx") >= 0 ? AD_TYPE_HTML : AD_TYPE_TEXT) : this.adType = n.adType
}

function MetaNET_ExAdObject(n) {
    if (n.lenght = 2) AD_EX_COUNT++, this.Id = "MetaNET_EXADV_NUMBER_" + AD_COUNT, this.collapseAd = n[0], this.expandAd = n[1], this.widthMin = this.collapseAd.width, this.widthMax = this.expandAd.width, this.heightMin = this.collapseAd.height, this.heightMax = this.expandAd.height, this.mode = 0, this.showButtons = !1, this.closeFunction = this.Id + "__close();", this.expandFunction = this.Id + "__expand();", this.collapseFunction = this.Id + "__collapse();", this.__interval = 5; else return !1
}

function MetaNET_SharingAdObject(n, t) {
    var r;
    for (AD_SHARING_COUNT++, this.Id = "MetaNET_SHARING_AD_NUMBER_" + AD_SHARING_COUNT, this.adObjects = [], r = 0, this.width = "auto", this.height = "auto", i = 0; i < t.length; i++) this.adObjects[i] = t[i];
    this.interval = n;
    this.length = t.length;
    this.currentAdId = 0;
    this.direction = "DOC";
    this.padding = "0"
}

function MetaNET_SharingAdObject2(n, t) {
    var u, r;
    for (AD_SHARING_COUNT++, this.Id = "MetaNET_SHARING_AD_NUMBER_" + AD_SHARING_COUNT, this.adObjects = [], u = 0, i = 0; i < t.length; i++) this.adObjects[i] = t[i];
    this.interval = n;
    this.length = t.length;
    this.currentAdId = __getCookie(this.Id) == "" || __getCookie(this.Id) == null ? Math.floor(Math.random() * (this.length + 1)) : parseInt(__getCookie(this.Id)) + 1;
    this.currentAdId >= this.length && (this.currentAdId = 0);
    __setCookie(this.Id, this.currentAdId, 1);
    this.direction = "DOC";
    this.padding = "0";
    this.width = "auto";
    this.height = "auto";
    r = this.direction.toLowerCase();
    r == "doc" || r == "vertical" || r == "d" || r == "0" ? (this.padding = "0") && (this.padding = "3") : (r == "n" || r == "horizontal" || r == "ngang" || r == "1") && (this.padding = "0") && (this.padding = "3")
}

function showAds(n, t, i, r) {
    var u = new MetaNET_AdObject({imageUrl: i, linkUrl: r, width: n, height: t});
    u.renderOut()
}

function showSharingAds(n, t, i, r) {
    for (var s, e = r.split("|"), o = [], f, u = 0; u < e.length; u++) f = e[u].split("->"), o[u] = new MetaNET_AdObject({
        imageUrl: f[0],
        linkUrl: f[1],
        width: t,
        height: i
    });
    s = new MetaNET_SharingAdObject(n, o);
    s.renderOut()
}

function showExpandAds(n, t, i, r, u, f, e) {
    var o = MetaNET_ExAdObject([new MetaNET_AdObject({
        imageUrl: u,
        linkUrl: e,
        width: n,
        height: t
    }), new MetaNET_AdObject({imageUrl: f, linkUrl: e, width: i, height: r})]);
    o.renderOut()
}

function loadMetaAds(n, t) {
    function r(n) {
        var i = n.url + "?ref=" + u, r = n.categoryUrl + "?ref=" + u, t = "";
        return n.title && (t += n.title), n._listPrice ? (t += '<span class="adx-text"><span class="adx-text-title">Giá thị trường:<\/span><span class="adx-text-value strock">' + n._listPrice + "<\/span><\/span>", t += '<span class="adx-text"><span class="adx-text-title">Giá META:<\/span><span class="adx-text-value highlight">' + n._unitCost + "<\/span><\/span>", t += '<span class="adx-text"><span class="adx-text-title">Tiết kiệm:<\/span><span class="adx-text-value highlight2">' + n._savePrice + "<\/span><\/span>") : n._unitCost && (t += '<span class="adx-text"><span class="adx-text-title">Giá bán:<\/span><span class="adx-text-value highlight">' + n._unitCost + "<\/span><\/span>"), '<div class="breview-box"><p class="adx-item adx-title"><a rel="nofollow" href="' + i + '" target="_blank">' + n.name + '<\/a><\/p> <div class="adx-body"><p class="adx-item adx-image small"><a rel="nofollow" href="' + i + '" target="_blank"><img src="' + n.thumb + '" border="0" alt=""><\/a><\/p><div class="adx-item adx-content"><p>' + t + '<\/p><p class="adx-item adx-domain"><a rel="nofollow" href="' + i + '" target="_blank" class="lnk-domain">META.vn<\/a> | <a rel="nofollow" href="' + r + '" target="_blank" class="lnk-catalog">' + n.categories + "<\/a><\/p><\/div><\/div><\/div>"
    }

    var i;
    t || (t = {});
    var f = t.keywords || n.data("keywords") || n.data("kw") || "", e = t.ids || n.data("ids") || n.data("id") || "",
        o = t.top || n.data("top") || 5, u = t.ref || n.data("ref") || "textlink", s = t.min || n.data("min") || "-",
        h = t.max || n.data("max") || "-", c = t.dir || n.data("dir") || "ver",
        l = t.ajx || n.data("ajx") || "/ajx/Ajx_TopProducts2.aspx";
    n.html('<img src="data:image/gif;base64,R0lGODlhQABAAPcAAIDF3b/i7pXP4+r1+arY6NTs9FWy0mu710SqzWi617zg7f3+/kiszvj8/VCw0Ov2+o/M4ez2+vL5/Pb7/eLy91y109ft9Pz+/ozK4PT6/Mrn8UKpzXTA2s7p8oLG3t7w9lay0ozL4K7a6f7+/6LV5vv9/qTV51+21JbP40+v0Eytz0OpzeDx99Pr8+b0+EWqzUGozHG+2afX53nC21q007vg7ebz+Pn8/XrC2+/3+3O/2qPV5pPO4sjm8HC+2dbs9Nru9e73+u/4+57T5WK31WG31ff7/fL5+8vn8YvK4NTr81mz07rg7Wy82HjC21Kw0bHc6lGw0f7///P6/On1+bnf7PX6/F621KHU5pLO4sXk7+f0+Z3S5cbl8Nzv9uPy+OTz+Nnu9bLc6vr9/me61sDi7sXl8Njt9bDb6lm007jf7MLj79Xs9H/F3a3a6fH5++Xz+JnR5NDq8nK/2ZjQ4/D4++33+pjQ5F211KfX6Oj0+YbI35vS5N/w9pfQ42+92c7o8vX7/LPd69Hq81y11Mnm8a/a6o3L4d3v9oPH3o7L4Vez0qjX6KvZ6bTd68/p8nG/2bbe7Fiz0r3h7bPc6+Py94nJ38Pk78zo8YnJ4IrK4K3Z6Wu82Mfl8MHj7nXA2lu007be60CozP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDowMDA3NTlEOTk4REYxMUUzQTY5NkRERDBGNjQ2NTNFMiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDowMDA3NTlEQTk4REYxMUUzQTY5NkRERDBGNjQ2NTNFMiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjA4MTUwMjlFOThERDExRTNBNjk2REREMEY2NDY1M0UyIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjAwMDc1OUQ4OThERjExRTNBNjk2REREMEY2NDY1M0UyIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEBAMAAAAsAAAAAEAAQAAACMkARwkcSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2rcyLGjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qcSbOmzZs4c+okqSABAgQJFBDs+TPoUJ9AhZKEIKqpUwgCmTptCnWU1KlVQyqYOlXBVq5NvYINKzLBWFEJzI5NezaBSARnf8aFOxbB27l465ZtqxYs27Uiv4IVO5bw4JFXn0YFWzUx1ZJEkx4tqlRgZKM7M2vezLmz58+gQ4seTbq06dOoU6tezbq169c2AwIAIfkEBAMAAAAsEQAbAB8ACgAACJIAR42SgAKEKBUeKAgcWPBgwoUsklwxcCDPhIURaIjauJFBh1EZOXb8iGSJgZMndUwRqEMkxxQZWroUlQIOHpQ4FY1iMZPjkJ4bAeAcGoQJUFExjk4cihKQUaBJgS5lagAQT6A/gQqlaiDIKJkuYYIVWfMmU50gNYr0mNYl25JDVS4kaBChQoF0Hd7dKZGiRYEBAQAh+QQEAwAAACwRABsAIAAKAAAIkwBHCbQwgwGMCiQaCBxF0CBChQK98PDByQOTEgtHKVghqmPHBBM0cvQoCuQoLU0OqFQJAeMoFwhIesQAU2ZHmilXrnQj8I7Njgh4/BSFgIROnZAwchhakumMozrBjFo6NIFTqCul+vwZdGhRrAeSvoxpkyZZmTix8hS4UabJtiRNojzaMmPDgwkX3n24UCJFiy4DAgAh+QQEAwAAACwSABsAIAAKAAAIlABHjVoggsiGFz40CBxY8GDChaOsqDkEwJKbIAsX4BDFsaOMgRs7cvw4SggEAChR7qEg0IRIkS1cvuTYYhSXlDhDjBnxZCbHNj19AoCDs6icCD45SkoqChSSojgjIU26NKlTqCkj8UwKNOlQrCjljJI5M2bSmjeh6gQ586PGtgJNFl2ZsSFChQIJGrwLUSJFixhHBQQAIfkEBAMAAAAsEgAbACIACgAACKEARwl8EMKBKAchHggcRdAgQoULR+WowkcAFi0NIn4wKKrjwQ+jNnrs6ACkQDBxBKhUucOKwAsnRno8cSOmTFEnLoy6wWWlTygCe9z0iGVoxx6jlPhcGmSUCaOiOEDdMSrAUp9hRu2AqmNq1asrswo1WtQoUqVgBTSFOZSmTZk5d/a8ClSgyJElQ3L0mPdkSp8tIzY8mHDh4IcRJVK0iFFgQAAh+QQEAwAAACwTABsAIwAKAAAIoQBHCdQQ48WGIiIWCBxF0CBChQsFTkAChYAYTBMiyhDFseOMC6M2duT4MWKdigRSWnwjsMXIkTtcvuS4Y+EINSpzVhkxCsBMjlF8/ozCc5SLnEi3jKrwk+OSpqIGCPyBNKeFpVCfNpU6imrVlFeFzgzalKjAo18JKJU5M2bTmgJvft0pUOTIknY9glx4EqkYlgsbHkwYuOBgiBEnVryYcVRAACH5BAQDAAAALBQAGwAkAAoAAAigAEeNakCiAgwGTn4IHFjwYMKFEEdJ+aKhjCc5QRZOSCCqY8cNNUZt9PgxZMQRgwKoXFlJIAaSHhHYeAlTlMyILFbqDPAmA4KaHbP8BEoHohQtO1f+UAK0I5mmouZANJJ0ZSGmTZ82lbqQatUAhXw2Fdq06MKjXxXShClzLcmbEHNWfSOSI0mQdWHiPZlyZ0uBBA0iVAi44eCIZylaxCgwIAAh+QQEAwAAACwUABsAJwAKAAAIpABHCaTgQYUoEAIkCBxF0CBChQsjCrzxxUKBMFsuROzAQJRHj2kijOL4EaRIiQKtWCzAsgCQEgIzpCj5UYdMmh51oBy14EzLnywEosH5cQhRj0ElBvnJtMEoDEdFxYjKBKUNpj+FPI069WhViVexstQ69KjRo0kjLhVbwOlNnDZnwt3ZU2xakiVDjuyY9yRKlUxfRmx4MOFCwg93LqRoEaPGUQEBACH5BAQDAAAALAMAGwA6AAoAAAjOAEeNunAkwoAIU0YIXMhwoYIECBAkUMDwYcSJDTMKbJDjwYMcDRaOeTCgZEk7CzQuhCCqpUsIAlm6bAlTpUAJJk1OGSXFYM6SQmwqmDmzxlCiLWvYbPDTZAMjTU2WUJkAacsEVa0msJkj6oAcOL0aUYnAqqgVZa2ukKLS64AHYaOO1ZgWKVqza9t6fQDV61SNWZFiNbtVZdeoOXpGDaryKFKjZpWqZBo15MifKG2OkjmzJueXmkfF1bmQoEGECkNblEjRIUTWoTd2/BhyVEAAIfkEBAMAAAAsAwAbADoACgAACK8ARwkUmAMRGzYfjgxcOFACChCiVHig0PBhxIkMM2rM+KWAx49UNkagIapkSQYdRo00eTLlxpcL7XycWUCCRg4sTabIgDOnqJ0wgwKh+ZFFRhY+TQ5JWhJN0JcLiH48k7EGU1ExrmJ4ujGq1AJUGVplmpXpVq4ah0o1yhAp06VMnaLNKFOqzYw9c+7MyxLoXI5EQ2pcyRKlSpKFXf7NWPBgQpgOIUqkKDDyRcqLRwUEACH5BAQDAAAALAUAGwAnAAoAAAipAEcJFBjox6UAXbyUGMhwlAUnDGBUINFg4MOIEys2FLImgEePPTQyrLFClEmTCSaMInkSpcqBF8x8nPmooQ0ELU9iuJnTJAaGNmYKzcCQTk+TCLIcFYWAqEAgQmduYThnqSgyVpUMhBrV49SBVZdiXapVYNCuAZwKNHo06dKmMGVGrQkUZ8+ddnP+ZMhRaMiGK0u2TBk4J+GGBQ8mXAjYIUSJFC0+zigwIAAh+QQEAwAAACwIABsAJAAKAAAInQBHCRxVQkkoAobM1Bk4cIGIIhtexNDQ8GHEiQxH3ahCoGPHTTYYLsAhqqRJGaNGmjzJsJPHlyIaDDSxcmULmjVLthA44aVPCwJHRMlZEsBQogAEuvD5sovAB0RLLokqqoJSph6djoIadWpUq6N6YiUAdJTQqEbRDnTJNObMqDfhDtzoE6RIkjVRqsybseDBhAszOoQokaLAwRcNBwQAIfkEBAMAAAAsCgAbACMACgAACKUARwkcVQKJCQFxHFEZKPBBCAeiHIR4MNAhRIkUGY5pJKBjRxRABn6AKKpkxA+jRpos6QDlwAAeY/o5MurCiZUmT9y4iVPUiQsCb6CIGbPLqB49TWJJWrKHQBdEY0IZtYOpKA5WTTyN6nFqVaZYmWodJZSrAKNImS5l6lQgzKgza/LEqXPuyp8DNxIFKZKkyZYp/bJ0ObDgwYQLGVqMOLHiQ8YZAwIAIfkEBAMAAAAsDAAbACIACgAACJcARwkcdUSMJgBJBEkYOEqDjxcbiIhYMNAhRIkUGerJBKBjxyQPBMoQRbIkDoojS5I8OXABD48wBYxooVKlCZo1SZoYGAamTy8AcpJ80kaoqCcjBJbxCXMNDaOiFkGNoJSpR6dQpRqlOqqnVQBAjRIVm3SUS6sycea8aXTnwI0+QYrMyTKlSpYMCx5MuLDiw4gT/V4MPCogACH5BAQDAAAALA4AGwAgAAoAAAiVAEcJXDApUZM/WYAIHNWARAUYDGZYWNjwYcSJC0vwOMCxY4BRExKIGjlyhQKQIkmKMrmQUseXTShgUEkSgYuZNEXZHHWBw8uXXBDkHMlD6NA7o6j8fPlp6MiUQzkkXdqxqVOoOaX2pHogqNOiTpGOcrk0Jk6aNs+q3DlK49KPIWmyjKuS5UKCBhEqFFgRokSKDv1iDAgAIfkEBAMAAAAsDwAbACAACgAACJQARwk0wuiAATxJ+ggcRcGDClEgUEhY2PBhxIkLM3AwwJHjEg2jOjAQRZIkjQghR5YUdXIhhI4wCYFJsbIkhww0a4riIFAICJgwAegsOWQoSRYhgcK8YlRUjKZMkirlyNToU6NRfU41INRoUaNIR71UKjNnzZtmV/IUqBHox5Q1W4qMi3IhQYMIFQqsCFEiRYd9MQYEADs="/>');
    i = n.data("item-width");
    $.get(l, {top: o, kw: f, ids: e, min: s, max: h}, function (t) {
        var f, s, e, h, o, u, l;
        if (n.empty(), f = $('<div class="adx-zone"><\/div>'), f.appendTo(n), s = t.length, c == "hor") for (f.addClass("adx-horizontal"), e = $('<div class="adx-row"><\/div>'), e.appendTo(f), u = 0; u < s; u++) h = t[u], o = $('<div class="adx-cell"><\/div>'), i && o.css({width: i}), o.appendTo(e), o.html(r(h)); else for (f.addClass("adx-vertical"), u = 0; u < s; u++) {
            var h = t[u], e = $('<div class="adx-row"><\/div>'), o = $('<div class="adx-cell"><\/div>');
            e.appendTo(f);
            o.appendTo(e);
            u < s - 1 && (l = $('<div  class="adx-sep-h"><\/div>'), l.insertAfter(e));
            o.html(r(h))
        }
    }, "json").error(function () {
        n.empty()
    })
}

var slice, AD_BG_START, MetaNET_BgAds_Settings;
!function (n, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = n.document ? t(n, !0) : function (n) {
        if (!n.document) throw new Error("jQuery requires a window with a document");
        return t(n)
    } : t(n)
}("undefined" != typeof window ? window : this, function (n, t) {
    "use strict";

    function hr(n, t, i) {
        var r, u = (t = t || f).createElement("script");
        if (u.text = n, i) for (r in df) i[r] && (u[r] = i[r]);
        t.head.appendChild(u).parentNode.removeChild(u)
    }

    function it(n) {
        return null == n ? n + "" : "object" == typeof n || "function" == typeof n ? bt[or.call(n)] || "object" : typeof n
    }

    function hi(n) {
        var t = !!n && "length" in n && n.length, i = it(n);
        return !u(n) && !tt(n) && ("array" === i || 0 === t || "number" == typeof t && t > 0 && t - 1 in n)
    }

    function v(n, t) {
        return n.nodeName && n.nodeName.toLowerCase() === t.toLowerCase()
    }

    function li(n, t, r) {
        return u(t) ? i.grep(n, function (n, i) {
            return !!t.call(n, i, n) !== r
        }) : t.nodeType ? i.grep(n, function (n) {
            return n === t !== r
        }) : "string" != typeof t ? i.grep(n, function (n) {
            return wt.call(t, n) > -1 !== r
        }) : i.filter(t, n, r)
    }

    function wr(n, t) {
        while ((n = n[t]) && 1 !== n.nodeType) ;
        return n
    }

    function ne(n) {
        var t = {};
        return i.each(n.match(l) || [], function (n, i) {
            t[i] = !0
        }), t
    }

    function ut(n) {
        return n
    }

    function dt(n) {
        throw n;
    }

    function br(n, t, i, r) {
        var f;
        try {
            n && u(f = n.promise) ? f.call(n).done(t).fail(i) : n && u(f = n.then) ? f.call(n, t, i) : t.apply(void 0, [n].slice(r))
        } catch (n) {
            i.apply(void 0, [n])
        }
    }

    function ni() {
        f.removeEventListener("DOMContentLoaded", ni);
        n.removeEventListener("load", ni);
        i.ready()
    }

    function re(n, t) {
        return t.toUpperCase()
    }

    function y(n) {
        return n.replace(te, "ms-").replace(ie, re)
    }

    function at() {
        this.expando = i.expando + at.uid++
    }

    function ee(n) {
        return "true" === n || "false" !== n && ("null" === n ? null : n === +n + "" ? +n : ue.test(n) ? JSON.parse(n) : n)
    }

    function dr(n, t, i) {
        var r;
        if (void 0 === i && 1 === n.nodeType) if (r = "data-" + t.replace(fe, "-$&").toLowerCase(), "string" == typeof(i = n.getAttribute(r))) {
            try {
                i = ee(i)
            } catch (n) {
            }
            o.set(n, t, i)
        } else i = void 0;
        return i
    }

    function tu(n, t, r, u) {
        var s, h, c = 20, l = u ? function () {
                return u.cur()
            } : function () {
                return i.css(n, t, "")
            }, o = l(), e = r && r[3] || (i.cssNumber[t] ? "" : "px"),
            f = (i.cssNumber[t] || "px" !== e && +o) && vt.exec(i.css(n, t));
        if (f && f[3] !== e) {
            for (o /= 2, e = e || f[3], f = +o || 1; c--;) i.style(n, t, f + e), (1 - h) * (1 - (h = l() / o || .5)) <= 0 && (c = 0), f /= h;
            f *= 2;
            i.style(n, t, f + e);
            r = r || []
        }
        return r && (f = +f || +o || 0, s = r[1] ? f + (r[1] + 1) * r[2] : +r[2], u && (u.unit = e, u.start = f, u.end = s)), s
    }

    function oe(n) {
        var r, f = n.ownerDocument, u = n.nodeName, t = ai[u];
        return t || (r = f.body.appendChild(f.createElement(u)), t = i.css(r, "display"), r.parentNode.removeChild(r), "none" === t && (t = "block"), ai[u] = t, t)
    }

    function ft(n, t) {
        for (var e, u, f = [], i = 0, o = n.length; i < o; i++) (u = n[i]).style && (e = u.style.display, t ? ("none" === e && (f[i] = r.get(u, "display") || null, f[i] || (u.style.display = "")), "" === u.style.display && ti(u) && (f[i] = oe(u))) : "none" !== e && (f[i] = "none", r.set(u, "display", e)));
        for (i = 0; i < o; i++) null != f[i] && (n[i].style.display = f[i]);
        return n
    }

    function s(n, t) {
        var r;
        return r = "undefined" != typeof n.getElementsByTagName ? n.getElementsByTagName(t || "*") : "undefined" != typeof n.querySelectorAll ? n.querySelectorAll(t || "*") : [], void 0 === t || t && v(n, t) ? i.merge([n], r) : r
    }

    function vi(n, t) {
        for (var i = 0, u = n.length; i < u; i++) r.set(n[i], "globalEval", !t || r.get(t[i], "globalEval"))
    }

    function eu(n, t, r, u, f) {
        for (var e, o, p, a, w, v, h = t.createDocumentFragment(), y = [], l = 0, b = n.length; l < b; l++) if ((e = n[l]) || 0 === e) if ("object" === it(e)) i.merge(y, e.nodeType ? [e] : e); else if (fu.test(e)) {
            for (o = o || h.appendChild(t.createElement("div")), p = (ru.exec(e) || ["", ""])[1].toLowerCase(), a = c[p] || c._default, o.innerHTML = a[1] + i.htmlPrefilter(e) + a[2], v = a[0]; v--;) o = o.lastChild;
            i.merge(y, o.childNodes);
            (o = h.firstChild).textContent = ""
        } else y.push(t.createTextNode(e));
        for (h.textContent = "", l = 0; e = y[l++];) if (u && i.inArray(e, u) > -1) f && f.push(e); else if (w = i.contains(e.ownerDocument, e), o = s(h.appendChild(e), "script"), w && vi(o), r) for (v = 0; e = o[v++];) uu.test(e.type || "") && r.push(e);
        return h
    }

    function ri() {
        return !0
    }

    function et() {
        return !1
    }

    function su() {
        try {
            return f.activeElement
        } catch (n) {
        }
    }

    function yi(n, t, r, u, f, e) {
        var o, s;
        if ("object" == typeof t) {
            "string" != typeof r && (u = u || r, r = void 0);
            for (s in t) yi(n, s, r, u, t[s], e);
            return n
        }
        if (null == u && null == f ? (f = r, u = r = void 0) : null == f && ("string" == typeof r ? (f = u, u = void 0) : (f = u, u = r, r = void 0)), !1 === f) f = et; else if (!f) return n;
        return 1 === e && (o = f, (f = function (n) {
            return i().off(n), o.apply(this, arguments)
        }).guid = o.guid || (o.guid = i.guid++)), n.each(function () {
            i.event.add(this, t, f, u, r)
        })
    }

    function hu(n, t) {
        return v(n, "table") && v(11 !== t.nodeType ? t : t.firstChild, "tr") ? i(n).children("tbody")[0] || n : n
    }

    function ye(n) {
        return n.type = (null !== n.getAttribute("type")) + "/" + n.type, n
    }

    function pe(n) {
        return "true/" === (n.type || "").slice(0, 5) ? n.type = n.type.slice(5) : n.removeAttribute("type"), n
    }

    function cu(n, t) {
        var u, c, f, s, h, l, a, e;
        if (1 === t.nodeType) {
            if (r.hasData(n) && (s = r.access(n), h = r.set(t, s), e = s.events)) {
                delete h.handle;
                h.events = {};
                for (f in e) for (u = 0, c = e[f].length; u < c; u++) i.event.add(t, f, e[f][u])
            }
            o.hasData(n) && (l = o.access(n), a = i.extend({}, l), o.set(t, a))
        }
    }

    function we(n, t) {
        var i = t.nodeName.toLowerCase();
        "input" === i && iu.test(n.type) ? t.checked = n.checked : "input" !== i && "textarea" !== i || (t.defaultValue = n.defaultValue)
    }

    function ot(n, t, f, o) {
        t = er.apply([], t);
        var l, w, a, v, h, b, c = 0, y = n.length, d = y - 1, p = t[0], k = u(p);
        if (k || y > 1 && "string" == typeof p && !e.checkClone && ae.test(p)) return n.each(function (i) {
            var r = n.eq(i);
            k && (t[0] = p.call(this, i, r.html()));
            ot(r, t, f, o)
        });
        if (y && (l = eu(t, n[0].ownerDocument, !1, n, o), w = l.firstChild, 1 === l.childNodes.length && (l = w), w || o)) {
            for (v = (a = i.map(s(l, "script"), ye)).length; c < y; c++) h = l, c !== d && (h = i.clone(h, !0, !0), v && i.merge(a, s(h, "script"))), f.call(n[c], h, c);
            if (v) for (b = a[a.length - 1].ownerDocument, i.map(a, pe), c = 0; c < v; c++) h = a[c], uu.test(h.type || "") && !r.access(h, "globalEval") && i.contains(b, h) && (h.src && "module" !== (h.type || "").toLowerCase() ? i._evalUrl && i._evalUrl(h.src) : hr(h.textContent.replace(ve, ""), b, h))
        }
        return n
    }

    function lu(n, t, r) {
        for (var u, e = t ? i.filter(t, n) : n, f = 0; null != (u = e[f]); f++) r || 1 !== u.nodeType || i.cleanData(s(u)), u.parentNode && (r && i.contains(u.ownerDocument, u) && vi(s(u, "script")), u.parentNode.removeChild(u));
        return n
    }

    function yt(n, t, r) {
        var o, s, h, f, u = n.style;
        return (r = r || ui(n)) && ("" !== (f = r.getPropertyValue(t) || r[t]) || i.contains(n.ownerDocument, n) || (f = i.style(n, t)), !e.pixelBoxStyles() && pi.test(f) && be.test(t) && (o = u.width, s = u.minWidth, h = u.maxWidth, u.minWidth = u.maxWidth = u.width = f, f = r.width, u.width = o, u.minWidth = s, u.maxWidth = h)), void 0 !== f ? f + "" : f
    }

    function au(n, t) {
        return {
            get: function () {
                if (!n()) return (this.get = t).apply(this, arguments);
                delete this.get
            }
        }
    }

    function ge(n) {
        if (n in wu) return n;
        for (var i = n[0].toUpperCase() + n.slice(1), t = pu.length; t--;) if ((n = pu[t] + i) in wu) return n
    }

    function bu(n) {
        var t = i.cssProps[n];
        return t || (t = i.cssProps[n] = ge(n) || n), t
    }

    function ku(n, t, i) {
        var r = vt.exec(t);
        return r ? Math.max(0, r[2] - (i || 0)) + (r[3] || "px") : t
    }

    function wi(n, t, r, u, f, e) {
        var o = "width" === t ? 1 : 0, h = 0, s = 0;
        if (r === (u ? "border" : "content")) return 0;
        for (; o < 4; o += 2) "margin" === r && (s += i.css(n, r + w[o], !0, f)), u ? ("content" === r && (s -= i.css(n, "padding" + w[o], !0, f)), "margin" !== r && (s -= i.css(n, "border" + w[o] + "Width", !0, f))) : (s += i.css(n, "padding" + w[o], !0, f), "padding" !== r ? s += i.css(n, "border" + w[o] + "Width", !0, f) : h += i.css(n, "border" + w[o] + "Width", !0, f));
        return !u && e >= 0 && (s += Math.max(0, Math.ceil(n["offset" + t[0].toUpperCase() + t.slice(1)] - e - s - h - .5))), s
    }

    function du(n, t, r) {
        var f = ui(n), u = yt(n, t, f), s = "border-box" === i.css(n, "boxSizing", !1, f), o = s;
        if (pi.test(u)) {
            if (!r) return u;
            u = "auto"
        }
        return o = o && (e.boxSizingReliable() || u === n.style[t]), ("auto" === u || !parseFloat(u) && "inline" === i.css(n, "display", !1, f)) && (u = n["offset" + t[0].toUpperCase() + t.slice(1)], o = !0), (u = parseFloat(u) || 0) + wi(n, t, r || (s ? "border" : "content"), o, f, u) + "px"
    }

    function h(n, t, i, r, u) {
        return new h.prototype.init(n, t, i, r, u)
    }

    function bi() {
        fi && (!1 === f.hidden && n.requestAnimationFrame ? n.requestAnimationFrame(bi) : n.setTimeout(bi, i.fx.interval), i.fx.tick())
    }

    function tf() {
        return n.setTimeout(function () {
            st = void 0
        }), st = Date.now()
    }

    function ei(n, t) {
        var u, r = 0, i = {height: n};
        for (t = t ? 1 : 0; r < 4; r += 2 - t) i["margin" + (u = w[r])] = i["padding" + u] = n;
        return t && (i.opacity = i.width = n), i
    }

    function rf(n, t, i) {
        for (var u, f = (a.tweeners[t] || []).concat(a.tweeners["*"]), r = 0, e = f.length; r < e; r++) if (u = f[r].call(i, t, n)) return u
    }

    function no(n, t, u) {
        var f, y, w, c, b, h, o, l, k = "width" in t || "height" in t, v = this, p = {}, s = n.style,
            a = n.nodeType && ti(n), e = r.get(n, "fxshow");
        u.queue || (null == (c = i._queueHooks(n, "fx")).unqueued && (c.unqueued = 0, b = c.empty.fire, c.empty.fire = function () {
            c.unqueued || b()
        }), c.unqueued++, v.always(function () {
            v.always(function () {
                c.unqueued--;
                i.queue(n, "fx").length || c.empty.fire()
            })
        }));
        for (f in t) if (y = t[f], gu.test(y)) {
            if (delete t[f], w = w || "toggle" === y, y === (a ? "hide" : "show")) {
                if ("show" !== y || !e || void 0 === e[f]) continue;
                a = !0
            }
            p[f] = e && e[f] || i.style(n, f)
        }
        if ((h = !i.isEmptyObject(t)) || !i.isEmptyObject(p)) {
            k && 1 === n.nodeType && (u.overflow = [s.overflow, s.overflowX, s.overflowY], null == (o = e && e.display) && (o = r.get(n, "display")), "none" === (l = i.css(n, "display")) && (o ? l = o : (ft([n], !0), o = n.style.display || o, l = i.css(n, "display"), ft([n]))), ("inline" === l || "inline-block" === l && null != o) && "none" === i.css(n, "float") && (h || (v.done(function () {
                s.display = o
            }), null == o && (l = s.display, o = "none" === l ? "" : l)), s.display = "inline-block"));
            u.overflow && (s.overflow = "hidden", v.always(function () {
                s.overflow = u.overflow[0];
                s.overflowX = u.overflow[1];
                s.overflowY = u.overflow[2]
            }));
            h = !1;
            for (f in p) h || (e ? "hidden" in e && (a = e.hidden) : e = r.access(n, "fxshow", {display: o}), w && (e.hidden = !a), a && ft([n], !0), v.done(function () {
                a || ft([n]);
                r.remove(n, "fxshow");
                for (f in p) i.style(n, f, p[f])
            })), h = rf(a ? e[f] : 0, f, v), f in e || (e[f] = h.start, a && (h.end = h.start, h.start = 0))
        }
    }

    function to(n, t) {
        var r, f, e, u, o;
        for (r in n) if (f = y(r), e = t[f], u = n[r], Array.isArray(u) && (e = u[1], u = n[r] = u[0]), r !== f && (n[f] = u, delete n[r]), (o = i.cssHooks[f]) && "expand" in o) {
            u = o.expand(u);
            delete n[f];
            for (r in u) r in n || (n[r] = u[r], t[r] = e)
        } else t[f] = e
    }

    function a(n, t, r) {
        var o, s, h = 0, v = a.prefilters.length, e = i.Deferred().always(function () {
            delete l.elem
        }), l = function () {
            if (s) return !1;
            for (var o = st || tf(), t = Math.max(0, f.startTime + f.duration - o), i = 1 - (t / f.duration || 0), r = 0, u = f.tweens.length; r < u; r++) f.tweens[r].run(i);
            return e.notifyWith(n, [f, i, t]), i < 1 && u ? t : (u || e.notifyWith(n, [f, 1, 0]), e.resolveWith(n, [f]), !1)
        }, f = e.promise({
            elem: n,
            props: i.extend({}, t),
            opts: i.extend(!0, {specialEasing: {}, easing: i.easing._default}, r),
            originalProperties: t,
            originalOptions: r,
            startTime: st || tf(),
            duration: r.duration,
            tweens: [],
            createTween: function (t, r) {
                var u = i.Tween(n, f.opts, t, r, f.opts.specialEasing[t] || f.opts.easing);
                return f.tweens.push(u), u
            },
            stop: function (t) {
                var i = 0, r = t ? f.tweens.length : 0;
                if (s) return this;
                for (s = !0; i < r; i++) f.tweens[i].run(1);
                return t ? (e.notifyWith(n, [f, 1, 0]), e.resolveWith(n, [f, t])) : e.rejectWith(n, [f, t]), this
            }
        }), c = f.props;
        for (to(c, f.opts.specialEasing); h < v; h++) if (o = a.prefilters[h].call(f, n, c, f.opts)) return u(o.stop) && (i._queueHooks(f.elem, f.opts.queue).stop = o.stop.bind(o)), o;
        return i.map(c, rf, f), u(f.opts.start) && f.opts.start.call(n, f), f.progress(f.opts.progress).done(f.opts.done, f.opts.complete).fail(f.opts.fail).always(f.opts.always), i.fx.timer(i.extend(l, {
            elem: n,
            anim: f,
            queue: f.opts.queue
        })), f
    }

    function g(n) {
        return (n.match(l) || []).join(" ")
    }

    function nt(n) {
        return n.getAttribute && n.getAttribute("class") || ""
    }

    function ki(n) {
        return Array.isArray(n) ? n : "string" == typeof n ? n.match(l) || [] : []
    }

    function tr(n, t, r, u) {
        var f;
        if (Array.isArray(t)) i.each(t, function (t, i) {
            r || io.test(n) ? u(n, i) : tr(n + "[" + ("object" == typeof i && null != i ? t : "") + "]", i, r, u)
        }); else if (r || "object" !== it(t)) u(n, t); else for (f in t) tr(n + "[" + f + "]", t[f], r, u)
    }

    function af(n) {
        return function (t, i) {
            "string" != typeof t && (i = t, t = "*");
            var r, f = 0, e = t.toLowerCase().match(l) || [];
            if (u(i)) while (r = e[f++]) "+" === r[0] ? (r = r.slice(1) || "*", (n[r] = n[r] || []).unshift(i)) : (n[r] = n[r] || []).push(i)
        }
    }

    function vf(n, t, r, u) {
        function e(s) {
            var h;
            return f[s] = !0, i.each(n[s] || [], function (n, i) {
                var s = i(t, r, u);
                return "string" != typeof s || o || f[s] ? o ? !(h = s) : void 0 : (t.dataTypes.unshift(s), e(s), !1)
            }), h
        }

        var f = {}, o = n === ir;
        return e(t.dataTypes[0]) || !f["*"] && e("*")
    }

    function ur(n, t) {
        var r, u, f = i.ajaxSettings.flatOptions || {};
        for (r in t) void 0 !== t[r] && ((f[r] ? n : u || (u = {}))[r] = t[r]);
        return u && i.extend(!0, n, u), n
    }

    function lo(n, t, i) {
        for (var e, u, f, o, s = n.contents, r = n.dataTypes; "*" === r[0];) r.shift(), void 0 === e && (e = n.mimeType || t.getResponseHeader("Content-Type"));
        if (e) for (u in s) if (s[u] && s[u].test(e)) {
            r.unshift(u);
            break
        }
        if (r[0] in i) f = r[0]; else {
            for (u in i) {
                if (!r[0] || n.converters[u + " " + r[0]]) {
                    f = u;
                    break
                }
                o || (o = u)
            }
            f = f || o
        }
        if (f) return f !== r[0] && r.unshift(f), i[f]
    }

    function ao(n, t, i, r) {
        var h, u, f, s, e, o = {}, c = n.dataTypes.slice();
        if (c[1]) for (f in n.converters) o[f.toLowerCase()] = n.converters[f];
        for (u = c.shift(); u;) if (n.responseFields[u] && (i[n.responseFields[u]] = t), !e && r && n.dataFilter && (t = n.dataFilter(t, n.dataType)), e = u, u = c.shift()) if ("*" === u) u = e; else if ("*" !== e && e !== u) {
            if (!(f = o[e + " " + u] || o["* " + u])) for (h in o) if ((s = h.split(" "))[1] === u && (f = o[e + " " + s[0]] || o["* " + s[0]])) {
                !0 === f ? f = o[h] : !0 !== o[h] && (u = s[0], c.unshift(s[1]));
                break
            }
            if (!0 !== f) if (f && n.throws) t = f(t); else try {
                t = f(t)
            } catch (n) {
                return {state: "parsererror", error: f ? n : "No conversion from " + e + " to " + u}
            }
        }
        return {state: "success", data: t}
    }

    var k = [], f = n.document, bf = Object.getPrototypeOf, d = k.slice, er = k.concat, si = k.push, wt = k.indexOf,
        bt = {}, or = bt.toString, kt = bt.hasOwnProperty, sr = kt.toString, kf = sr.call(Object), e = {},
        u = function (n) {
            return "function" == typeof n && "number" != typeof n.nodeType
        }, tt = function (n) {
            return null != n && n === n.window
        }, df = {type: !0, src: !0, noModule: !0}, i = function (n, t) {
            return new i.fn.init(n, t)
        }, gf = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, b, ci, ar, vr, yr, pr, l, kr, gt, lt, ai, fu, st, fi, gu, nf, uf, ht,
        ff, ef, of, di, gi, yf, ct, fr, oi, pf, wf;
    i.fn = i.prototype = {
        jquery: "3.3.1", constructor: i, length: 0, toArray: function () {
            return d.call(this)
        }, get: function (n) {
            return null == n ? d.call(this) : n < 0 ? this[n + this.length] : this[n]
        }, pushStack: function (n) {
            var t = i.merge(this.constructor(), n);
            return t.prevObject = this, t
        }, each: function (n) {
            return i.each(this, n)
        }, map: function (n) {
            return this.pushStack(i.map(this, function (t, i) {
                return n.call(t, i, t)
            }))
        }, slice: function () {
            return this.pushStack(d.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (n) {
            var i = this.length, t = +n + (n < 0 ? i : 0);
            return this.pushStack(t >= 0 && t < i ? [this[t]] : [])
        }, end: function () {
            return this.prevObject || this.constructor()
        }, push: si, sort: k.sort, splice: k.splice
    };
    i.extend = i.fn.extend = function () {
        var o, e, t, r, s, h, n = arguments[0] || {}, f = 1, l = arguments.length, c = !1;
        for ("boolean" == typeof n && (c = n, n = arguments[f] || {}, f++), "object" == typeof n || u(n) || (n = {}), f === l && (n = this, f--); f < l; f++) if (null != (o = arguments[f])) for (e in o) t = n[e], n !== (r = o[e]) && (c && r && (i.isPlainObject(r) || (s = Array.isArray(r))) ? (s ? (s = !1, h = t && Array.isArray(t) ? t : []) : h = t && i.isPlainObject(t) ? t : {}, n[e] = i.extend(c, h, r)) : void 0 !== r && (n[e] = r));
        return n
    };
    i.extend({
        expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (n) {
            throw new Error(n);
        }, noop: function () {
        }, isPlainObject: function (n) {
            var t, i;
            return !(!n || "[object Object]" !== or.call(n)) && (!(t = bf(n)) || "function" == typeof(i = kt.call(t, "constructor") && t.constructor) && sr.call(i) === kf)
        }, isEmptyObject: function (n) {
            for (var t in n) return !1;
            return !0
        }, globalEval: function (n) {
            hr(n)
        }, each: function (n, t) {
            var r, i = 0;
            if (hi(n)) {
                for (r = n.length; i < r; i++) if (!1 === t.call(n[i], i, n[i])) break
            } else for (i in n) if (!1 === t.call(n[i], i, n[i])) break;
            return n
        }, trim: function (n) {
            return null == n ? "" : (n + "").replace(gf, "")
        }, makeArray: function (n, t) {
            var r = t || [];
            return null != n && (hi(Object(n)) ? i.merge(r, "string" == typeof n ? [n] : n) : si.call(r, n)), r
        }, inArray: function (n, t, i) {
            return null == t ? -1 : wt.call(t, n, i)
        }, merge: function (n, t) {
            for (var u = +t.length, i = 0, r = n.length; i < u; i++) n[r++] = t[i];
            return n.length = r, n
        }, grep: function (n, t, i) {
            for (var f, u = [], r = 0, e = n.length, o = !i; r < e; r++) (f = !t(n[r], r)) !== o && u.push(n[r]);
            return u
        }, map: function (n, t, i) {
            var e, u, r = 0, f = [];
            if (hi(n)) for (e = n.length; r < e; r++) null != (u = t(n[r], r, i)) && f.push(u); else for (r in n) null != (u = t(n[r], r, i)) && f.push(u);
            return er.apply([], f)
        }, guid: 1, support: e
    });
    "function" == typeof Symbol && (i.fn[Symbol.iterator] = k[Symbol.iterator]);
    i.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (n, t) {
        bt["[object " + t + "]"] = t.toLowerCase()
    });
    b = function (n) {
        function u(n, t, r, u) {
            var s, p, l, a, w, d, g, y = t && t.ownerDocument, v = t ? t.nodeType : 9;
            if (r = r || [], "string" != typeof n || !n || 1 !== v && 9 !== v && 11 !== v) return r;
            if (!u && ((t ? t.ownerDocument || t : c) !== i && b(t), t = t || i, h)) {
                if (11 !== v && (w = cr.exec(n))) if (s = w[1]) {
                    if (9 === v) {
                        if (!(l = t.getElementById(s))) return r;
                        if (l.id === s) return r.push(l), r
                    } else if (y && (l = y.getElementById(s)) && et(t, l) && l.id === s) return r.push(l), r
                } else {
                    if (w[2]) return k.apply(r, t.getElementsByTagName(n)), r;
                    if ((s = w[3]) && e.getElementsByClassName && t.getElementsByClassName) return k.apply(r, t.getElementsByClassName(s)), r
                }
                if (e.qsa && !lt[n + " "] && (!o || !o.test(n))) {
                    if (1 !== v) y = t, g = n; else if ("object" !== t.nodeName.toLowerCase()) {
                        for ((a = t.getAttribute("id")) ? a = a.replace(vi, yi) : t.setAttribute("id", a = f), p = (d = ft(n)).length; p--;) d[p] = "#" + a + " " + yt(d[p]);
                        g = d.join(",");
                        y = ni.test(n) && ri(t.parentNode) || t
                    }
                    if (g) try {
                        return k.apply(r, y.querySelectorAll(g)), r
                    } catch (n) {
                    } finally {
                        a === f && t.removeAttribute("id")
                    }
                }
            }
            return si(n.replace(at, "$1"), t, r, u)
        }

        function ti() {
            function n(r, u) {
                return i.push(r + " ") > t.cacheLength && delete n[i.shift()], n[r + " "] = u
            }

            var i = [];
            return n
        }

        function l(n) {
            return n[f] = !0, n
        }

        function a(n) {
            var t = i.createElement("fieldset");
            try {
                return !!n(t)
            } catch (n) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t);
                t = null
            }
        }

        function ii(n, i) {
            for (var r = n.split("|"), u = r.length; u--;) t.attrHandle[r[u]] = i
        }

        function wi(n, t) {
            var i = t && n, r = i && 1 === n.nodeType && 1 === t.nodeType && n.sourceIndex - t.sourceIndex;
            if (r) return r;
            if (i) while (i = i.nextSibling) if (i === t) return -1;
            return n ? 1 : -1
        }

        function ar(n) {
            return function (t) {
                return "input" === t.nodeName.toLowerCase() && t.type === n
            }
        }

        function vr(n) {
            return function (t) {
                var i = t.nodeName.toLowerCase();
                return ("input" === i || "button" === i) && t.type === n
            }
        }

        function bi(n) {
            return function (t) {
                return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === n : t.disabled === n : t.isDisabled === n || t.isDisabled !== !n && lr(t) === n : t.disabled === n : "label" in t && t.disabled === n
            }
        }

        function it(n) {
            return l(function (t) {
                return t = +t, l(function (i, r) {
                    for (var u, f = n([], i.length, t), e = f.length; e--;) i[u = f[e]] && (i[u] = !(r[u] = i[u]))
                })
            })
        }

        function ri(n) {
            return n && "undefined" != typeof n.getElementsByTagName && n
        }

        function ki() {
        }

        function yt(n) {
            for (var t = 0, r = n.length, i = ""; t < r; t++) i += n[t].value;
            return i
        }

        function pt(n, t, i) {
            var r = t.dir, u = t.next, e = u || r, o = i && "parentNode" === e, s = di++;
            return t.first ? function (t, i, u) {
                while (t = t[r]) if (1 === t.nodeType || o) return n(t, i, u);
                return !1
            } : function (t, i, h) {
                var c, l, a, y = [v, s];
                if (h) {
                    while (t = t[r]) if ((1 === t.nodeType || o) && n(t, i, h)) return !0
                } else while (t = t[r]) if (1 === t.nodeType || o) if (a = t[f] || (t[f] = {}), l = a[t.uniqueID] || (a[t.uniqueID] = {}), u && u === t.nodeName.toLowerCase()) t = t[r] || t; else {
                    if ((c = l[e]) && c[0] === v && c[1] === s) return y[2] = c[2];
                    if (l[e] = y, y[2] = n(t, i, h)) return !0
                }
                return !1
            }
        }

        function ui(n) {
            return n.length > 1 ? function (t, i, r) {
                for (var u = n.length; u--;) if (!n[u](t, i, r)) return !1;
                return !0
            } : n[0]
        }

        function yr(n, t, i) {
            for (var r = 0, f = t.length; r < f; r++) u(n, t[r], i);
            return i
        }

        function wt(n, t, i, r, u) {
            for (var e, o = [], f = 0, s = n.length, h = null != t; f < s; f++) (e = n[f]) && (i && !i(e, r, u) || (o.push(e), h && t.push(f)));
            return o
        }

        function fi(n, t, i, r, u, e) {
            return r && !r[f] && (r = fi(r)), u && !u[f] && (u = fi(u, e)), l(function (f, e, o, s) {
                var l, c, a, p = [], y = [], w = e.length, b = f || yr(t || "*", o.nodeType ? [o] : o, []),
                    v = !n || !f && t ? b : wt(b, p, n, o, s), h = i ? u || (f ? n : w || r) ? [] : e : v;
                if (i && i(v, h, o, s), r) for (l = wt(h, y), r(l, [], o, s), c = l.length; c--;) (a = l[c]) && (h[y[c]] = !(v[y[c]] = a));
                if (f) {
                    if (u || n) {
                        if (u) {
                            for (l = [], c = h.length; c--;) (a = h[c]) && l.push(v[c] = a);
                            u(null, h = [], l, s)
                        }
                        for (c = h.length; c--;) (a = h[c]) && (l = u ? nt(f, a) : p[c]) > -1 && (f[l] = !(e[l] = a))
                    }
                } else h = wt(h === e ? h.splice(w, h.length) : h), u ? u(null, e, h, s) : k.apply(e, h)
            })
        }

        function ei(n) {
            for (var o, u, r, s = n.length, h = t.relative[n[0].type], c = h || t.relative[" "], i = h ? 1 : 0, l = pt(function (n) {
                return n === o
            }, c, !0), a = pt(function (n) {
                return nt(o, n) > -1
            }, c, !0), e = [function (n, t, i) {
                var r = !h && (i || t !== ht) || ((o = t).nodeType ? l(n, t, i) : a(n, t, i));
                return o = null, r
            }]; i < s; i++) if (u = t.relative[n[i].type]) e = [pt(ui(e), u)]; else {
                if ((u = t.filter[n[i].type].apply(null, n[i].matches))[f]) {
                    for (r = ++i; r < s; r++) if (t.relative[n[r].type]) break;
                    return fi(i > 1 && ui(e), i > 1 && yt(n.slice(0, i - 1).concat({value: " " === n[i - 2].type ? "*" : ""})).replace(at, "$1"), u, i < r && ei(n.slice(i, r)), r < s && ei(n = n.slice(r)), r < s && yt(n))
                }
                e.push(u)
            }
            return ui(e)
        }

        function pr(n, r) {
            var f = r.length > 0, e = n.length > 0, o = function (o, s, c, l, a) {
                var y, nt, d, g = 0, p = "0", tt = o && [], w = [], it = ht, rt = o || e && t.find.TAG("*", a),
                    ut = v += null == it ? 1 : Math.random() || .1, ft = rt.length;
                for (a && (ht = s === i || s || a); p !== ft && null != (y = rt[p]); p++) {
                    if (e && y) {
                        for (nt = 0, s || y.ownerDocument === i || (b(y), c = !h); d = n[nt++];) if (d(y, s || i, c)) {
                            l.push(y);
                            break
                        }
                        a && (v = ut)
                    }
                    f && ((y = !d && y) && g--, o && tt.push(y))
                }
                if (g += p, f && p !== g) {
                    for (nt = 0; d = r[nt++];) d(tt, w, s, c);
                    if (o) {
                        if (g > 0) while (p--) tt[p] || w[p] || (w[p] = nr.call(l));
                        w = wt(w)
                    }
                    k.apply(l, w);
                    a && !o && w.length > 0 && g + r.length > 1 && u.uniqueSort(l)
                }
                return a && (v = ut, ht = it), tt
            };
            return f ? l(o) : o
        }

        var rt, e, t, st, oi, ft, bt, si, ht, w, ut, b, i, s, h, o, d, ct, et, f = "sizzle" + 1 * new Date,
            c = n.document, v = 0, di = 0, hi = ti(), ci = ti(), lt = ti(), kt = function (n, t) {
                return n === t && (ut = !0), 0
            }, gi = {}.hasOwnProperty, g = [], nr = g.pop, tr = g.push, k = g.push, li = g.slice, nt = function (n, t) {
                for (var i = 0, r = n.length; i < r; i++) if (n[i] === t) return i;
                return -1
            },
            dt = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            r = "[\\x20\\t\\r\\n\\f]", tt = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
            ai = "\\[" + r + "*(" + tt + ")(?:" + r + "*([*^$|!~]?=)" + r + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + tt + "))|)" + r + "*\\]",
            gt = ":(" + tt + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ai + ")*)|.*)\\)|)",
            ir = new RegExp(r + "+", "g"), at = new RegExp("^" + r + "+|((?:^|[^\\\\])(?:\\\\.)*)" + r + "+$", "g"),
            rr = new RegExp("^" + r + "*," + r + "*"), ur = new RegExp("^" + r + "*([>+~]|" + r + ")" + r + "*"),
            fr = new RegExp("=" + r + "*([^\\]'\"]*?)" + r + "*\\]", "g"), er = new RegExp(gt),
            or = new RegExp("^" + tt + "$"), vt = {
                ID: new RegExp("^#(" + tt + ")"),
                CLASS: new RegExp("^\\.(" + tt + ")"),
                TAG: new RegExp("^(" + tt + "|[*])"),
                ATTR: new RegExp("^" + ai),
                PSEUDO: new RegExp("^" + gt),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + r + "*(even|odd|(([+-]|)(\\d*)n|)" + r + "*(?:([+-]|)" + r + "*(\\d+)|))" + r + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + dt + ")$", "i"),
                needsContext: new RegExp("^" + r + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + r + "*((?:-\\d)?\\d*)" + r + "*\\)|)(?=[^-]|$)", "i")
            }, sr = /^(?:input|select|textarea|button)$/i, hr = /^h\d$/i, ot = /^[^{]+\{\s*\[native \w/,
            cr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ni = /[+~]/,
            y = new RegExp("\\\\([\\da-f]{1,6}" + r + "?|(" + r + ")|.)", "ig"), p = function (n, t, i) {
                var r = "0x" + t - 65536;
                return r !== r || i ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
            }, vi = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, yi = function (n, t) {
                return t ? "\0" === n ? "�" : n.slice(0, -1) + "\\" + n.charCodeAt(n.length - 1).toString(16) + " " : "\\" + n
            }, pi = function () {
                b()
            }, lr = pt(function (n) {
                return !0 === n.disabled && ("form" in n || "label" in n)
            }, {dir: "parentNode", next: "legend"});
        try {
            k.apply(g = li.call(c.childNodes), c.childNodes);
            g[c.childNodes.length].nodeType
        } catch (n) {
            k = {
                apply: g.length ? function (n, t) {
                    tr.apply(n, li.call(t))
                } : function (n, t) {
                    for (var i = n.length, r = 0; n[i++] = t[r++];) ;
                    n.length = i - 1
                }
            }
        }
        e = u.support = {};
        oi = u.isXML = function (n) {
            var t = n && (n.ownerDocument || n).documentElement;
            return !!t && "HTML" !== t.nodeName
        };
        b = u.setDocument = function (n) {
            var v, u, l = n ? n.ownerDocument || n : c;
            return l !== i && 9 === l.nodeType && l.documentElement ? (i = l, s = i.documentElement, h = !oi(i), c !== i && (u = i.defaultView) && u.top !== u && (u.addEventListener ? u.addEventListener("unload", pi, !1) : u.attachEvent && u.attachEvent("onunload", pi)), e.attributes = a(function (n) {
                return n.className = "i", !n.getAttribute("className")
            }), e.getElementsByTagName = a(function (n) {
                return n.appendChild(i.createComment("")), !n.getElementsByTagName("*").length
            }), e.getElementsByClassName = ot.test(i.getElementsByClassName), e.getById = a(function (n) {
                return s.appendChild(n).id = f, !i.getElementsByName || !i.getElementsByName(f).length
            }), e.getById ? (t.filter.ID = function (n) {
                var t = n.replace(y, p);
                return function (n) {
                    return n.getAttribute("id") === t
                }
            }, t.find.ID = function (n, t) {
                if ("undefined" != typeof t.getElementById && h) {
                    var i = t.getElementById(n);
                    return i ? [i] : []
                }
            }) : (t.filter.ID = function (n) {
                var t = n.replace(y, p);
                return function (n) {
                    var i = "undefined" != typeof n.getAttributeNode && n.getAttributeNode("id");
                    return i && i.value === t
                }
            }, t.find.ID = function (n, t) {
                if ("undefined" != typeof t.getElementById && h) {
                    var r, u, f, i = t.getElementById(n);
                    if (i) {
                        if ((r = i.getAttributeNode("id")) && r.value === n) return [i];
                        for (f = t.getElementsByName(n), u = 0; i = f[u++];) if ((r = i.getAttributeNode("id")) && r.value === n) return [i]
                    }
                    return []
                }
            }), t.find.TAG = e.getElementsByTagName ? function (n, t) {
                return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(n) : e.qsa ? t.querySelectorAll(n) : void 0
            } : function (n, t) {
                var i, r = [], f = 0, u = t.getElementsByTagName(n);
                if ("*" === n) {
                    while (i = u[f++]) 1 === i.nodeType && r.push(i);
                    return r
                }
                return u
            }, t.find.CLASS = e.getElementsByClassName && function (n, t) {
                if ("undefined" != typeof t.getElementsByClassName && h) return t.getElementsByClassName(n)
            }, d = [], o = [], (e.qsa = ot.test(i.querySelectorAll)) && (a(function (n) {
                s.appendChild(n).innerHTML = "<a id='" + f + "'><\/a><select id='" + f + "-\r\\' msallowcapture=''><option selected=''><\/option><\/select>";
                n.querySelectorAll("[msallowcapture^='']").length && o.push("[*^$]=" + r + "*(?:''|\"\")");
                n.querySelectorAll("[selected]").length || o.push("\\[" + r + "*(?:value|" + dt + ")");
                n.querySelectorAll("[id~=" + f + "-]").length || o.push("~=");
                n.querySelectorAll(":checked").length || o.push(":checked");
                n.querySelectorAll("a#" + f + "+*").length || o.push(".#.+[+~]")
            }), a(function (n) {
                n.innerHTML = "<a href='' disabled='disabled'><\/a><select disabled='disabled'><option/><\/select>";
                var t = i.createElement("input");
                t.setAttribute("type", "hidden");
                n.appendChild(t).setAttribute("name", "D");
                n.querySelectorAll("[name=d]").length && o.push("name" + r + "*[*^$|!~]?=");
                2 !== n.querySelectorAll(":enabled").length && o.push(":enabled", ":disabled");
                s.appendChild(n).disabled = !0;
                2 !== n.querySelectorAll(":disabled").length && o.push(":enabled", ":disabled");
                n.querySelectorAll("*,:x");
                o.push(",.*:")
            })), (e.matchesSelector = ot.test(ct = s.matches || s.webkitMatchesSelector || s.mozMatchesSelector || s.oMatchesSelector || s.msMatchesSelector)) && a(function (n) {
                e.disconnectedMatch = ct.call(n, "*");
                ct.call(n, "[s!='']:x");
                d.push("!=", gt)
            }), o = o.length && new RegExp(o.join("|")), d = d.length && new RegExp(d.join("|")), v = ot.test(s.compareDocumentPosition), et = v || ot.test(s.contains) ? function (n, t) {
                var r = 9 === n.nodeType ? n.documentElement : n, i = t && t.parentNode;
                return n === i || !(!i || 1 !== i.nodeType || !(r.contains ? r.contains(i) : n.compareDocumentPosition && 16 & n.compareDocumentPosition(i)))
            } : function (n, t) {
                if (t) while (t = t.parentNode) if (t === n) return !0;
                return !1
            }, kt = v ? function (n, t) {
                if (n === t) return ut = !0, 0;
                var r = !n.compareDocumentPosition - !t.compareDocumentPosition;
                return r || (1 & (r = (n.ownerDocument || n) === (t.ownerDocument || t) ? n.compareDocumentPosition(t) : 1) || !e.sortDetached && t.compareDocumentPosition(n) === r ? n === i || n.ownerDocument === c && et(c, n) ? -1 : t === i || t.ownerDocument === c && et(c, t) ? 1 : w ? nt(w, n) - nt(w, t) : 0 : 4 & r ? -1 : 1)
            } : function (n, t) {
                if (n === t) return ut = !0, 0;
                var r, u = 0, o = n.parentNode, s = t.parentNode, f = [n], e = [t];
                if (!o || !s) return n === i ? -1 : t === i ? 1 : o ? -1 : s ? 1 : w ? nt(w, n) - nt(w, t) : 0;
                if (o === s) return wi(n, t);
                for (r = n; r = r.parentNode;) f.unshift(r);
                for (r = t; r = r.parentNode;) e.unshift(r);
                while (f[u] === e[u]) u++;
                return u ? wi(f[u], e[u]) : f[u] === c ? -1 : e[u] === c ? 1 : 0
            }, i) : i
        };
        u.matches = function (n, t) {
            return u(n, null, null, t)
        };
        u.matchesSelector = function (n, t) {
            if ((n.ownerDocument || n) !== i && b(n), t = t.replace(fr, "='$1']"), e.matchesSelector && h && !lt[t + " "] && (!d || !d.test(t)) && (!o || !o.test(t))) try {
                var r = ct.call(n, t);
                if (r || e.disconnectedMatch || n.document && 11 !== n.document.nodeType) return r
            } catch (n) {
            }
            return u(t, i, null, [n]).length > 0
        };
        u.contains = function (n, t) {
            return (n.ownerDocument || n) !== i && b(n), et(n, t)
        };
        u.attr = function (n, r) {
            (n.ownerDocument || n) !== i && b(n);
            var f = t.attrHandle[r.toLowerCase()],
                u = f && gi.call(t.attrHandle, r.toLowerCase()) ? f(n, r, !h) : void 0;
            return void 0 !== u ? u : e.attributes || !h ? n.getAttribute(r) : (u = n.getAttributeNode(r)) && u.specified ? u.value : null
        };
        u.escape = function (n) {
            return (n + "").replace(vi, yi)
        };
        u.error = function (n) {
            throw new Error("Syntax error, unrecognized expression: " + n);
        };
        u.uniqueSort = function (n) {
            var r, u = [], t = 0, i = 0;
            if (ut = !e.detectDuplicates, w = !e.sortStable && n.slice(0), n.sort(kt), ut) {
                while (r = n[i++]) r === n[i] && (t = u.push(i));
                while (t--) n.splice(u[t], 1)
            }
            return w = null, n
        };
        st = u.getText = function (n) {
            var r, i = "", u = 0, t = n.nodeType;
            if (t) {
                if (1 === t || 9 === t || 11 === t) {
                    if ("string" == typeof n.textContent) return n.textContent;
                    for (n = n.firstChild; n; n = n.nextSibling) i += st(n)
                } else if (3 === t || 4 === t) return n.nodeValue
            } else while (r = n[u++]) i += st(r);
            return i
        };
        (t = u.selectors = {
            cacheLength: 50,
            createPseudo: l,
            match: vt,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (n) {
                    return n[1] = n[1].replace(y, p), n[3] = (n[3] || n[4] || n[5] || "").replace(y, p), "~=" === n[2] && (n[3] = " " + n[3] + " "), n.slice(0, 4)
                }, CHILD: function (n) {
                    return n[1] = n[1].toLowerCase(), "nth" === n[1].slice(0, 3) ? (n[3] || u.error(n[0]), n[4] = +(n[4] ? n[5] + (n[6] || 1) : 2 * ("even" === n[3] || "odd" === n[3])), n[5] = +(n[7] + n[8] || "odd" === n[3])) : n[3] && u.error(n[0]), n
                }, PSEUDO: function (n) {
                    var i, t = !n[6] && n[2];
                    return vt.CHILD.test(n[0]) ? null : (n[3] ? n[2] = n[4] || n[5] || "" : t && er.test(t) && (i = ft(t, !0)) && (i = t.indexOf(")", t.length - i) - t.length) && (n[0] = n[0].slice(0, i), n[2] = t.slice(0, i)), n.slice(0, 3))
                }
            },
            filter: {
                TAG: function (n) {
                    var t = n.replace(y, p).toLowerCase();
                    return "*" === n ? function () {
                        return !0
                    } : function (n) {
                        return n.nodeName && n.nodeName.toLowerCase() === t
                    }
                }, CLASS: function (n) {
                    var t = hi[n + " "];
                    return t || (t = new RegExp("(^|" + r + ")" + n + "(" + r + "|$)")) && hi(n, function (n) {
                        return t.test("string" == typeof n.className && n.className || "undefined" != typeof n.getAttribute && n.getAttribute("class") || "")
                    })
                }, ATTR: function (n, t, i) {
                    return function (r) {
                        var f = u.attr(r, n);
                        return null == f ? "!=" === t : !t || (f += "", "=" === t ? f === i : "!=" === t ? f !== i : "^=" === t ? i && 0 === f.indexOf(i) : "*=" === t ? i && f.indexOf(i) > -1 : "$=" === t ? i && f.slice(-i.length) === i : "~=" === t ? (" " + f.replace(ir, " ") + " ").indexOf(i) > -1 : "|=" === t && (f === i || f.slice(0, i.length + 1) === i + "-"))
                    }
                }, CHILD: function (n, t, i, r, u) {
                    var s = "nth" !== n.slice(0, 3), o = "last" !== n.slice(-4), e = "of-type" === t;
                    return 1 === r && 0 === u ? function (n) {
                        return !!n.parentNode
                    } : function (t, i, h) {
                        var p, d, y, c, a, w, b = s !== o ? "nextSibling" : "previousSibling", k = t.parentNode,
                            nt = e && t.nodeName.toLowerCase(), g = !h && !e, l = !1;
                        if (k) {
                            if (s) {
                                while (b) {
                                    for (c = t; c = c[b];) if (e ? c.nodeName.toLowerCase() === nt : 1 === c.nodeType) return !1;
                                    w = b = "only" === n && !w && "nextSibling"
                                }
                                return !0
                            }
                            if (w = [o ? k.firstChild : k.lastChild], o && g) {
                                for (l = (a = (p = (d = (y = (c = k)[f] || (c[f] = {}))[c.uniqueID] || (y[c.uniqueID] = {}))[n] || [])[0] === v && p[1]) && p[2], c = a && k.childNodes[a]; c = ++a && c && c[b] || (l = a = 0) || w.pop();) if (1 === c.nodeType && ++l && c === t) {
                                    d[n] = [v, a, l];
                                    break
                                }
                            } else if (g && (l = a = (p = (d = (y = (c = t)[f] || (c[f] = {}))[c.uniqueID] || (y[c.uniqueID] = {}))[n] || [])[0] === v && p[1]), !1 === l) while (c = ++a && c && c[b] || (l = a = 0) || w.pop()) if ((e ? c.nodeName.toLowerCase() === nt : 1 === c.nodeType) && ++l && (g && ((d = (y = c[f] || (c[f] = {}))[c.uniqueID] || (y[c.uniqueID] = {}))[n] = [v, l]), c === t)) break;
                            return (l -= u) === r || l % r == 0 && l / r >= 0
                        }
                    }
                }, PSEUDO: function (n, i) {
                    var e, r = t.pseudos[n] || t.setFilters[n.toLowerCase()] || u.error("unsupported pseudo: " + n);
                    return r[f] ? r(i) : r.length > 1 ? (e = [n, n, "", i], t.setFilters.hasOwnProperty(n.toLowerCase()) ? l(function (n, t) {
                        for (var e, u = r(n, i), f = u.length; f--;) n[e = nt(n, u[f])] = !(t[e] = u[f])
                    }) : function (n) {
                        return r(n, 0, e)
                    }) : r
                }
            },
            pseudos: {
                not: l(function (n) {
                    var t = [], r = [], i = bt(n.replace(at, "$1"));
                    return i[f] ? l(function (n, t, r, u) {
                        for (var e, o = i(n, null, u, []), f = n.length; f--;) (e = o[f]) && (n[f] = !(t[f] = e))
                    }) : function (n, u, f) {
                        return t[0] = n, i(t, null, f, r), t[0] = null, !r.pop()
                    }
                }), has: l(function (n) {
                    return function (t) {
                        return u(n, t).length > 0
                    }
                }), contains: l(function (n) {
                    return n = n.replace(y, p), function (t) {
                        return (t.textContent || t.innerText || st(t)).indexOf(n) > -1
                    }
                }), lang: l(function (n) {
                    return or.test(n || "") || u.error("unsupported lang: " + n), n = n.replace(y, p).toLowerCase(), function (t) {
                        var i;
                        do if (i = h ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (i = i.toLowerCase()) === n || 0 === i.indexOf(n + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1
                    }
                }), target: function (t) {
                    var i = n.location && n.location.hash;
                    return i && i.slice(1) === t.id
                }, root: function (n) {
                    return n === s
                }, focus: function (n) {
                    return n === i.activeElement && (!i.hasFocus || i.hasFocus()) && !!(n.type || n.href || ~n.tabIndex)
                }, enabled: bi(!1), disabled: bi(!0), checked: function (n) {
                    var t = n.nodeName.toLowerCase();
                    return "input" === t && !!n.checked || "option" === t && !!n.selected
                }, selected: function (n) {
                    return n.parentNode && n.parentNode.selectedIndex, !0 === n.selected
                }, empty: function (n) {
                    for (n = n.firstChild; n; n = n.nextSibling) if (n.nodeType < 6) return !1;
                    return !0
                }, parent: function (n) {
                    return !t.pseudos.empty(n)
                }, header: function (n) {
                    return hr.test(n.nodeName)
                }, input: function (n) {
                    return sr.test(n.nodeName)
                }, button: function (n) {
                    var t = n.nodeName.toLowerCase();
                    return "input" === t && "button" === n.type || "button" === t
                }, text: function (n) {
                    var t;
                    return "input" === n.nodeName.toLowerCase() && "text" === n.type && (null == (t = n.getAttribute("type")) || "text" === t.toLowerCase())
                }, first: it(function () {
                    return [0]
                }), last: it(function (n, t) {
                    return [t - 1]
                }), eq: it(function (n, t, i) {
                    return [i < 0 ? i + t : i]
                }), even: it(function (n, t) {
                    for (var i = 0; i < t; i += 2) n.push(i);
                    return n
                }), odd: it(function (n, t) {
                    for (var i = 1; i < t; i += 2) n.push(i);
                    return n
                }), lt: it(function (n, t, i) {
                    for (var r = i < 0 ? i + t : i; --r >= 0;) n.push(r);
                    return n
                }), gt: it(function (n, t, i) {
                    for (var r = i < 0 ? i + t : i; ++r < t;) n.push(r);
                    return n
                })
            }
        }).pseudos.nth = t.pseudos.eq;
        for (rt in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0}) t.pseudos[rt] = ar(rt);
        for (rt in{submit: !0, reset: !0}) t.pseudos[rt] = vr(rt);
        return ki.prototype = t.filters = t.pseudos, t.setFilters = new ki, ft = u.tokenize = function (n, i) {
            var e, f, s, o, r, h, c, l = ci[n + " "];
            if (l) return i ? 0 : l.slice(0);
            for (r = n, h = [], c = t.preFilter; r;) {
                (!e || (f = rr.exec(r))) && (f && (r = r.slice(f[0].length) || r), h.push(s = []));
                e = !1;
                (f = ur.exec(r)) && (e = f.shift(), s.push({
                    value: e,
                    type: f[0].replace(at, " ")
                }), r = r.slice(e.length));
                for (o in t.filter) (f = vt[o].exec(r)) && (!c[o] || (f = c[o](f))) && (e = f.shift(), s.push({
                    value: e,
                    type: o,
                    matches: f
                }), r = r.slice(e.length));
                if (!e) break
            }
            return i ? r.length : r ? u.error(n) : ci(n, h).slice(0)
        }, bt = u.compile = function (n, t) {
            var r, u = [], e = [], i = lt[n + " "];
            if (!i) {
                for (t || (t = ft(n)), r = t.length; r--;) (i = ei(t[r]))[f] ? u.push(i) : e.push(i);
                (i = lt(n, pr(e, u))).selector = n
            }
            return i
        }, si = u.select = function (n, i, r, u) {
            var o, f, e, l, a, c = "function" == typeof n && n, s = !u && ft(n = c.selector || n);
            if (r = r || [], 1 === s.length) {
                if ((f = s[0] = s[0].slice(0)).length > 2 && "ID" === (e = f[0]).type && 9 === i.nodeType && h && t.relative[f[1].type]) {
                    if (!(i = (t.find.ID(e.matches[0].replace(y, p), i) || [])[0])) return r;
                    c && (i = i.parentNode);
                    n = n.slice(f.shift().value.length)
                }
                for (o = vt.needsContext.test(n) ? 0 : f.length; o--;) {
                    if (e = f[o], t.relative[l = e.type]) break;
                    if ((a = t.find[l]) && (u = a(e.matches[0].replace(y, p), ni.test(f[0].type) && ri(i.parentNode) || i))) {
                        if (f.splice(o, 1), !(n = u.length && yt(f))) return k.apply(r, u), r;
                        break
                    }
                }
            }
            return (c || bt(n, s))(u, i, !h, r, !i || ni.test(n) && ri(i.parentNode) || i), r
        }, e.sortStable = f.split("").sort(kt).join("") === f, e.detectDuplicates = !!ut, b(), e.sortDetached = a(function (n) {
            return 1 & n.compareDocumentPosition(i.createElement("fieldset"))
        }), a(function (n) {
            return n.innerHTML = "<a href='#'><\/a>", "#" === n.firstChild.getAttribute("href")
        }) || ii("type|href|height|width", function (n, t, i) {
            if (!i) return n.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), e.attributes && a(function (n) {
            return n.innerHTML = "<input/>", n.firstChild.setAttribute("value", ""), "" === n.firstChild.getAttribute("value")
        }) || ii("value", function (n, t, i) {
            if (!i && "input" === n.nodeName.toLowerCase()) return n.defaultValue
        }), a(function (n) {
            return null == n.getAttribute("disabled")
        }) || ii(dt, function (n, t, i) {
            var r;
            if (!i) return !0 === n[t] ? t.toLowerCase() : (r = n.getAttributeNode(t)) && r.specified ? r.value : null
        }), u
    }(n);
    i.find = b;
    i.expr = b.selectors;
    i.expr[":"] = i.expr.pseudos;
    i.uniqueSort = i.unique = b.uniqueSort;
    i.text = b.getText;
    i.isXMLDoc = b.isXML;
    i.contains = b.contains;
    i.escapeSelector = b.escape;
    var rt = function (n, t, r) {
        for (var u = [], f = void 0 !== r; (n = n[t]) && 9 !== n.nodeType;) if (1 === n.nodeType) {
            if (f && i(n).is(r)) break;
            u.push(n)
        }
        return u
    }, cr = function (n, t) {
        for (var i = []; n; n = n.nextSibling) 1 === n.nodeType && n !== t && i.push(n);
        return i
    }, lr = i.expr.match.needsContext;
    ci = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
    i.filter = function (n, t, r) {
        var u = t[0];
        return r && (n = ":not(" + n + ")"), 1 === t.length && 1 === u.nodeType ? i.find.matchesSelector(u, n) ? [u] : [] : i.find.matches(n, i.grep(t, function (n) {
            return 1 === n.nodeType
        }))
    };
    i.fn.extend({
        find: function (n) {
            var t, r, u = this.length, f = this;
            if ("string" != typeof n) return this.pushStack(i(n).filter(function () {
                for (t = 0; t < u; t++) if (i.contains(f[t], this)) return !0
            }));
            for (r = this.pushStack([]), t = 0; t < u; t++) i.find(n, f[t], r);
            return u > 1 ? i.uniqueSort(r) : r
        }, filter: function (n) {
            return this.pushStack(li(this, n || [], !1))
        }, not: function (n) {
            return this.pushStack(li(this, n || [], !0))
        }, is: function (n) {
            return !!li(this, "string" == typeof n && lr.test(n) ? i(n) : n || [], !1).length
        }
    });
    vr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (i.fn.init = function (n, t, r) {
        var e, o;
        if (!n) return this;
        if (r = r || ar, "string" == typeof n) {
            if (!(e = "<" === n[0] && ">" === n[n.length - 1] && n.length >= 3 ? [null, n, null] : vr.exec(n)) || !e[1] && t) return !t || t.jquery ? (t || r).find(n) : this.constructor(t).find(n);
            if (e[1]) {
                if (t = t instanceof i ? t[0] : t, i.merge(this, i.parseHTML(e[1], t && t.nodeType ? t.ownerDocument || t : f, !0)), ci.test(e[1]) && i.isPlainObject(t)) for (e in t) u(this[e]) ? this[e](t[e]) : this.attr(e, t[e]);
                return this
            }
            return (o = f.getElementById(e[2])) && (this[0] = o, this.length = 1), this
        }
        return n.nodeType ? (this[0] = n, this.length = 1, this) : u(n) ? void 0 !== r.ready ? r.ready(n) : n(i) : i.makeArray(n, this)
    }).prototype = i.fn;
    ar = i(f);
    yr = /^(?:parents|prev(?:Until|All))/;
    pr = {children: !0, contents: !0, next: !0, prev: !0};
    i.fn.extend({
        has: function (n) {
            var t = i(n, this), r = t.length;
            return this.filter(function () {
                for (var n = 0; n < r; n++) if (i.contains(this, t[n])) return !0
            })
        }, closest: function (n, t) {
            var r, f = 0, o = this.length, u = [], e = "string" != typeof n && i(n);
            if (!lr.test(n)) for (; f < o; f++) for (r = this[f]; r && r !== t; r = r.parentNode) if (r.nodeType < 11 && (e ? e.index(r) > -1 : 1 === r.nodeType && i.find.matchesSelector(r, n))) {
                u.push(r);
                break
            }
            return this.pushStack(u.length > 1 ? i.uniqueSort(u) : u)
        }, index: function (n) {
            return n ? "string" == typeof n ? wt.call(i(n), this[0]) : wt.call(this, n.jquery ? n[0] : n) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (n, t) {
            return this.pushStack(i.uniqueSort(i.merge(this.get(), i(n, t))))
        }, addBack: function (n) {
            return this.add(null == n ? this.prevObject : this.prevObject.filter(n))
        }
    });
    i.each({
        parent: function (n) {
            var t = n.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (n) {
            return rt(n, "parentNode")
        }, parentsUntil: function (n, t, i) {
            return rt(n, "parentNode", i)
        }, next: function (n) {
            return wr(n, "nextSibling")
        }, prev: function (n) {
            return wr(n, "previousSibling")
        }, nextAll: function (n) {
            return rt(n, "nextSibling")
        }, prevAll: function (n) {
            return rt(n, "previousSibling")
        }, nextUntil: function (n, t, i) {
            return rt(n, "nextSibling", i)
        }, prevUntil: function (n, t, i) {
            return rt(n, "previousSibling", i)
        }, siblings: function (n) {
            return cr((n.parentNode || {}).firstChild, n)
        }, children: function (n) {
            return cr(n.firstChild)
        }, contents: function (n) {
            return v(n, "iframe") ? n.contentDocument : (v(n, "template") && (n = n.content || n), i.merge([], n.childNodes))
        }
    }, function (n, t) {
        i.fn[n] = function (r, u) {
            var f = i.map(this, t, r);
            return "Until" !== n.slice(-5) && (u = r), u && "string" == typeof u && (f = i.filter(u, f)), this.length > 1 && (pr[n] || i.uniqueSort(f), yr.test(n) && f.reverse()), this.pushStack(f)
        }
    });
    l = /[^\x20\t\r\n\f]+/g;
    i.Callbacks = function (n) {
        n = "string" == typeof n ? ne(n) : i.extend({}, n);
        var f, r, c, e, t = [], s = [], o = -1, l = function () {
            for (e = e || n.once, c = f = !0; s.length; o = -1) for (r = s.shift(); ++o < t.length;) !1 === t[o].apply(r[0], r[1]) && n.stopOnFalse && (o = t.length, r = !1);
            n.memory || (r = !1);
            f = !1;
            e && (t = r ? [] : "")
        }, h = {
            add: function () {
                return t && (r && !f && (o = t.length - 1, s.push(r)), function f(r) {
                    i.each(r, function (i, r) {
                        u(r) ? n.unique && h.has(r) || t.push(r) : r && r.length && "string" !== it(r) && f(r)
                    })
                }(arguments), r && !f && l()), this
            }, remove: function () {
                return i.each(arguments, function (n, r) {
                    for (var u; (u = i.inArray(r, t, u)) > -1;) t.splice(u, 1), u <= o && o--
                }), this
            }, has: function (n) {
                return n ? i.inArray(n, t) > -1 : t.length > 0
            }, empty: function () {
                return t && (t = []), this
            }, disable: function () {
                return e = s = [], t = r = "", this
            }, disabled: function () {
                return !t
            }, lock: function () {
                return e = s = [], r || f || (t = r = ""), this
            }, locked: function () {
                return !!e
            }, fireWith: function (n, t) {
                return e || (t = [n, (t = t || []).slice ? t.slice() : t], s.push(t), f || l()), this
            }, fire: function () {
                return h.fireWith(this, arguments), this
            }, fired: function () {
                return !!c
            }
        };
        return h
    };
    i.extend({
        Deferred: function (t) {
            var f = [["notify", "progress", i.Callbacks("memory"), i.Callbacks("memory"), 2], ["resolve", "done", i.Callbacks("once memory"), i.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", i.Callbacks("once memory"), i.Callbacks("once memory"), 1, "rejected"]],
                o = "pending", e = {
                    state: function () {
                        return o
                    }, always: function () {
                        return r.done(arguments).fail(arguments), this
                    }, "catch": function (n) {
                        return e.then(null, n)
                    }, pipe: function () {
                        var n = arguments;
                        return i.Deferred(function (t) {
                            i.each(f, function (i, f) {
                                var e = u(n[f[4]]) && n[f[4]];
                                r[f[1]](function () {
                                    var n = e && e.apply(this, arguments);
                                    n && u(n.promise) ? n.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[f[0] + "With"](this, e ? [n] : arguments)
                                })
                            });
                            n = null
                        }).promise()
                    }, then: function (t, r, e) {
                        function s(t, r, f, e) {
                            return function () {
                                var h = this, c = arguments, a = function () {
                                    var n, i;
                                    if (!(t < o)) {
                                        if ((n = f.apply(h, c)) === r.promise()) throw new TypeError("Thenable self-resolution");
                                        i = n && ("object" == typeof n || "function" == typeof n) && n.then;
                                        u(i) ? e ? i.call(n, s(o, r, ut, e), s(o, r, dt, e)) : (o++, i.call(n, s(o, r, ut, e), s(o, r, dt, e), s(o, r, ut, r.notifyWith))) : (f !== ut && (h = void 0, c = [n]), (e || r.resolveWith)(h, c))
                                    }
                                }, l = e ? a : function () {
                                    try {
                                        a()
                                    } catch (n) {
                                        i.Deferred.exceptionHook && i.Deferred.exceptionHook(n, l.stackTrace);
                                        t + 1 >= o && (f !== dt && (h = void 0, c = [n]), r.rejectWith(h, c))
                                    }
                                };
                                t ? l() : (i.Deferred.getStackHook && (l.stackTrace = i.Deferred.getStackHook()), n.setTimeout(l))
                            }
                        }

                        var o = 0;
                        return i.Deferred(function (n) {
                            f[0][3].add(s(0, n, u(e) ? e : ut, n.notifyWith));
                            f[1][3].add(s(0, n, u(t) ? t : ut));
                            f[2][3].add(s(0, n, u(r) ? r : dt))
                        }).promise()
                    }, promise: function (n) {
                        return null != n ? i.extend(n, e) : e
                    }
                }, r = {};
            return i.each(f, function (n, t) {
                var i = t[2], u = t[5];
                e[t[1]] = i.add;
                u && i.add(function () {
                    o = u
                }, f[3 - n][2].disable, f[3 - n][3].disable, f[0][2].lock, f[0][3].lock);
                i.add(t[3].fire);
                r[t[0]] = function () {
                    return r[t[0] + "With"](this === r ? void 0 : this, arguments), this
                };
                r[t[0] + "With"] = i.fireWith
            }), e.promise(r), t && t.call(r, r), r
        }, when: function (n) {
            var e = arguments.length, t = e, o = Array(t), f = d.call(arguments), r = i.Deferred(), s = function (n) {
                return function (t) {
                    o[n] = this;
                    f[n] = arguments.length > 1 ? d.call(arguments) : t;
                    --e || r.resolveWith(o, f)
                }
            };
            if (e <= 1 && (br(n, r.done(s(t)).resolve, r.reject, !e), "pending" === r.state() || u(f[t] && f[t].then))) return r.then();
            while (t--) br(f[t], s(t), r.reject);
            return r.promise()
        }
    });
    kr = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    i.Deferred.exceptionHook = function (t, i) {
        n.console && n.console.warn && t && kr.test(t.name) && n.console.warn("jQuery.Deferred exception: " + t.message, t.stack, i)
    };
    i.readyException = function (t) {
        n.setTimeout(function () {
            throw t;
        })
    };
    gt = i.Deferred();
    i.fn.ready = function (n) {
        return gt.then(n)["catch"](function (n) {
            i.readyException(n)
        }), this
    };
    i.extend({
        isReady: !1, readyWait: 1, ready: function (n) {
            (!0 === n ? --i.readyWait : i.isReady) || (i.isReady = !0, !0 !== n && --i.readyWait > 0 || gt.resolveWith(f, [i]))
        }
    });
    i.ready.then = gt.then;
    "complete" === f.readyState || "loading" !== f.readyState && !f.documentElement.doScroll ? n.setTimeout(i.ready) : (f.addEventListener("DOMContentLoaded", ni), n.addEventListener("load", ni));
    var p = function (n, t, r, f, e, o, s) {
        var h = 0, l = n.length, c = null == r;
        if ("object" === it(r)) {
            e = !0;
            for (h in r) p(n, t, h, r[h], !0, o, s)
        } else if (void 0 !== f && (e = !0, u(f) || (s = !0), c && (s ? (t.call(n, f), t = null) : (c = t, t = function (n, t, r) {
            return c.call(i(n), r)
        })), t)) for (; h < l; h++) t(n[h], r, s ? f : f.call(n[h], h, t(n[h], r)));
        return e ? n : c ? t.call(n) : l ? t(n[0], r) : o
    }, te = /^-ms-/, ie = /-([a-z])/g;
    lt = function (n) {
        return 1 === n.nodeType || 9 === n.nodeType || !+n.nodeType
    };
    at.uid = 1;
    at.prototype = {
        cache: function (n) {
            var t = n[this.expando];
            return t || (t = {}, lt(n) && (n.nodeType ? n[this.expando] = t : Object.defineProperty(n, this.expando, {
                value: t,
                configurable: !0
            }))), t
        }, set: function (n, t, i) {
            var r, u = this.cache(n);
            if ("string" == typeof t) u[y(t)] = i; else for (r in t) u[y(r)] = t[r];
            return u
        }, get: function (n, t) {
            return void 0 === t ? this.cache(n) : n[this.expando] && n[this.expando][y(t)]
        }, access: function (n, t, i) {
            return void 0 === t || t && "string" == typeof t && void 0 === i ? this.get(n, t) : (this.set(n, t, i), void 0 !== i ? i : t)
        }, remove: function (n, t) {
            var u, r = n[this.expando];
            if (void 0 !== r) {
                if (void 0 !== t) for (u = (t = Array.isArray(t) ? t.map(y) : (t = y(t)) in r ? [t] : t.match(l) || []).length; u--;) delete r[t[u]];
                (void 0 === t || i.isEmptyObject(r)) && (n.nodeType ? n[this.expando] = void 0 : delete n[this.expando])
            }
        }, hasData: function (n) {
            var t = n[this.expando];
            return void 0 !== t && !i.isEmptyObject(t)
        }
    };
    var r = new at, o = new at, ue = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, fe = /[A-Z]/g;
    i.extend({
        hasData: function (n) {
            return o.hasData(n) || r.hasData(n)
        }, data: function (n, t, i) {
            return o.access(n, t, i)
        }, removeData: function (n, t) {
            o.remove(n, t)
        }, _data: function (n, t, i) {
            return r.access(n, t, i)
        }, _removeData: function (n, t) {
            r.remove(n, t)
        }
    });
    i.fn.extend({
        data: function (n, t) {
            var f, u, e, i = this[0], s = i && i.attributes;
            if (void 0 === n) {
                if (this.length && (e = o.get(i), 1 === i.nodeType && !r.get(i, "hasDataAttrs"))) {
                    for (f = s.length; f--;) s[f] && 0 === (u = s[f].name).indexOf("data-") && (u = y(u.slice(5)), dr(i, u, e[u]));
                    r.set(i, "hasDataAttrs", !0)
                }
                return e
            }
            return "object" == typeof n ? this.each(function () {
                o.set(this, n)
            }) : p(this, function (t) {
                var r;
                if (i && void 0 === t) {
                    if (void 0 !== (r = o.get(i, n)) || void 0 !== (r = dr(i, n))) return r
                } else this.each(function () {
                    o.set(this, n, t)
                })
            }, null, t, arguments.length > 1, null, !0)
        }, removeData: function (n) {
            return this.each(function () {
                o.remove(this, n)
            })
        }
    });
    i.extend({
        queue: function (n, t, u) {
            var f;
            if (n) return t = (t || "fx") + "queue", f = r.get(n, t), u && (!f || Array.isArray(u) ? f = r.access(n, t, i.makeArray(u)) : f.push(u)), f || []
        }, dequeue: function (n, t) {
            t = t || "fx";
            var r = i.queue(n, t), e = r.length, u = r.shift(), f = i._queueHooks(n, t), o = function () {
                i.dequeue(n, t)
            };
            "inprogress" === u && (u = r.shift(), e--);
            u && ("fx" === t && r.unshift("inprogress"), delete f.stop, u.call(n, o, f));
            !e && f && f.empty.fire()
        }, _queueHooks: function (n, t) {
            var u = t + "queueHooks";
            return r.get(n, u) || r.access(n, u, {
                empty: i.Callbacks("once memory").add(function () {
                    r.remove(n, [t + "queue", u])
                })
            })
        }
    });
    i.fn.extend({
        queue: function (n, t) {
            var r = 2;
            return "string" != typeof n && (t = n, n = "fx", r--), arguments.length < r ? i.queue(this[0], n) : void 0 === t ? this : this.each(function () {
                var r = i.queue(this, n, t);
                i._queueHooks(this, n);
                "fx" === n && "inprogress" !== r[0] && i.dequeue(this, n)
            })
        }, dequeue: function (n) {
            return this.each(function () {
                i.dequeue(this, n)
            })
        }, clearQueue: function (n) {
            return this.queue(n || "fx", [])
        }, promise: function (n, t) {
            var u, e = 1, o = i.Deferred(), f = this, s = this.length, h = function () {
                --e || o.resolveWith(f, [f])
            };
            for ("string" != typeof n && (t = n, n = void 0), n = n || "fx"; s--;) (u = r.get(f[s], n + "queueHooks")) && u.empty && (e++, u.empty.add(h));
            return h(), o.promise(t)
        }
    });
    var gr = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, vt = new RegExp("^(?:([+-])=|)(" + gr + ")([a-z%]*)$", "i"),
        w = ["Top", "Right", "Bottom", "Left"], ti = function (n, t) {
            return "none" === (n = t || n).style.display || "" === n.style.display && i.contains(n.ownerDocument, n) && "none" === i.css(n, "display")
        }, nu = function (n, t, i, r) {
            var f, u, e = {};
            for (u in t) e[u] = n.style[u], n.style[u] = t[u];
            f = i.apply(n, r || []);
            for (u in t) n.style[u] = e[u];
            return f
        };
    ai = {};
    i.fn.extend({
        show: function () {
            return ft(this, !0)
        }, hide: function () {
            return ft(this)
        }, toggle: function (n) {
            return "boolean" == typeof n ? n ? this.show() : this.hide() : this.each(function () {
                ti(this) ? i(this).show() : i(this).hide()
            })
        }
    });
    var iu = /^(?:checkbox|radio)$/i, ru = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i, uu = /^$|^module$|\/(?:java|ecma)script/i,
        c = {
            option: [1, "<select multiple='multiple'>", "<\/select>"],
            thead: [1, "<table>", "<\/table>"],
            col: [2, "<table><colgroup>", "<\/colgroup><\/table>"],
            tr: [2, "<table><tbody>", "<\/tbody><\/table>"],
            td: [3, "<table><tbody><tr>", "<\/tr><\/tbody><\/table>"],
            _default: [0, "", ""]
        };
    c.optgroup = c.option;
    c.tbody = c.tfoot = c.colgroup = c.caption = c.thead;
    c.th = c.td;
    fu = /<|&#?\w+;/;
    !function () {
        var n = f.createDocumentFragment().appendChild(f.createElement("div")), t = f.createElement("input");
        t.setAttribute("type", "radio");
        t.setAttribute("checked", "checked");
        t.setAttribute("name", "t");
        n.appendChild(t);
        e.checkClone = n.cloneNode(!0).cloneNode(!0).lastChild.checked;
        n.innerHTML = "<textarea>x<\/textarea>";
        e.noCloneChecked = !!n.cloneNode(!0).lastChild.defaultValue
    }();
    var ii = f.documentElement, se = /^key/, he = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        ou = /^([^.]*)(?:\.(.+)|)/;
    i.event = {
        global: {}, add: function (n, t, u, f, e) {
            var p, v, k, y, w, h, s, c, o, b, d, a = r.get(n);
            if (a) for (u.handler && (u = (p = u).handler, e = p.selector), e && i.find.matchesSelector(ii, e), u.guid || (u.guid = i.guid++), (y = a.events) || (y = a.events = {}), (v = a.handle) || (v = a.handle = function (t) {
                if ("undefined" != typeof i && i.event.triggered !== t.type) return i.event.dispatch.apply(n, arguments)
            }), w = (t = (t || "").match(l) || [""]).length; w--;) o = d = (k = ou.exec(t[w]) || [])[1], b = (k[2] || "").split(".").sort(), o && (s = i.event.special[o] || {}, o = (e ? s.delegateType : s.bindType) || o, s = i.event.special[o] || {}, h = i.extend({
                type: o,
                origType: d,
                data: f,
                handler: u,
                guid: u.guid,
                selector: e,
                needsContext: e && i.expr.match.needsContext.test(e),
                namespace: b.join(".")
            }, p), (c = y[o]) || ((c = y[o] = []).delegateCount = 0, s.setup && !1 !== s.setup.call(n, f, b, v) || n.addEventListener && n.addEventListener(o, v)), s.add && (s.add.call(n, h), h.handler.guid || (h.handler.guid = u.guid)), e ? c.splice(c.delegateCount++, 0, h) : c.push(h), i.event.global[o] = !0)
        }, remove: function (n, t, u, f, e) {
            var y, k, h, v, p, s, c, a, o, b, d, w = r.hasData(n) && r.get(n);
            if (w && (v = w.events)) {
                for (p = (t = (t || "").match(l) || [""]).length; p--;) if (h = ou.exec(t[p]) || [], o = d = h[1], b = (h[2] || "").split(".").sort(), o) {
                    for (c = i.event.special[o] || {}, a = v[o = (f ? c.delegateType : c.bindType) || o] || [], h = h[2] && new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)"), k = y = a.length; y--;) s = a[y], !e && d !== s.origType || u && u.guid !== s.guid || h && !h.test(s.namespace) || f && f !== s.selector && ("**" !== f || !s.selector) || (a.splice(y, 1), s.selector && a.delegateCount--, c.remove && c.remove.call(n, s));
                    k && !a.length && (c.teardown && !1 !== c.teardown.call(n, b, w.handle) || i.removeEvent(n, o, w.handle), delete v[o])
                } else for (o in v) i.event.remove(n, o + t[p], u, f, !0);
                i.isEmptyObject(v) && r.remove(n, "handle events")
            }
        }, dispatch: function (n) {
            var t = i.event.fix(n), u, h, c, e, f, l, s = new Array(arguments.length),
                a = (r.get(this, "events") || {})[t.type] || [], o = i.event.special[t.type] || {};
            for (s[0] = t, u = 1; u < arguments.length; u++) s[u] = arguments[u];
            if (t.delegateTarget = this, !o.preDispatch || !1 !== o.preDispatch.call(this, t)) {
                for (l = i.event.handlers.call(this, t, a), u = 0; (e = l[u++]) && !t.isPropagationStopped();) for (t.currentTarget = e.elem, h = 0; (f = e.handlers[h++]) && !t.isImmediatePropagationStopped();) t.rnamespace && !t.rnamespace.test(f.namespace) || (t.handleObj = f, t.data = f.data, void 0 !== (c = ((i.event.special[f.origType] || {}).handle || f.handler).apply(e.elem, s)) && !1 === (t.result = c) && (t.preventDefault(), t.stopPropagation()));
                return o.postDispatch && o.postDispatch.call(this, t), t.result
            }
        }, handlers: function (n, t) {
            var f, h, u, e, o, c = [], s = t.delegateCount, r = n.target;
            if (s && r.nodeType && !("click" === n.type && n.button >= 1)) for (; r !== this; r = r.parentNode || this) if (1 === r.nodeType && ("click" !== n.type || !0 !== r.disabled)) {
                for (e = [], o = {}, f = 0; f < s; f++) void 0 === o[u = (h = t[f]).selector + " "] && (o[u] = h.needsContext ? i(u, this).index(r) > -1 : i.find(u, this, null, [r]).length), o[u] && e.push(h);
                e.length && c.push({elem: r, handlers: e})
            }
            return r = this, s < t.length && c.push({elem: r, handlers: t.slice(s)}), c
        }, addProp: function (n, t) {
            Object.defineProperty(i.Event.prototype, n, {
                enumerable: !0, configurable: !0, get: u(t) ? function () {
                    if (this.originalEvent) return t(this.originalEvent)
                } : function () {
                    if (this.originalEvent) return this.originalEvent[n]
                }, set: function (t) {
                    Object.defineProperty(this, n, {enumerable: !0, configurable: !0, writable: !0, value: t})
                }
            })
        }, fix: function (n) {
            return n[i.expando] ? n : new i.Event(n)
        }, special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    if (this !== su() && this.focus) return this.focus(), !1
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    if (this === su() && this.blur) return this.blur(), !1
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    if ("checkbox" === this.type && this.click && v(this, "input")) return this.click(), !1
                }, _default: function (n) {
                    return v(n.target, "a")
                }
            }, beforeunload: {
                postDispatch: function (n) {
                    void 0 !== n.result && n.originalEvent && (n.originalEvent.returnValue = n.result)
                }
            }
        }
    };
    i.removeEvent = function (n, t, i) {
        n.removeEventListener && n.removeEventListener(t, i)
    };
    i.Event = function (n, t) {
        if (!(this instanceof i.Event)) return new i.Event(n, t);
        n && n.type ? (this.originalEvent = n, this.type = n.type, this.isDefaultPrevented = n.defaultPrevented || void 0 === n.defaultPrevented && !1 === n.returnValue ? ri : et, this.target = n.target && 3 === n.target.nodeType ? n.target.parentNode : n.target, this.currentTarget = n.currentTarget, this.relatedTarget = n.relatedTarget) : this.type = n;
        t && i.extend(this, t);
        this.timeStamp = n && n.timeStamp || Date.now();
        this[i.expando] = !0
    };
    i.Event.prototype = {
        constructor: i.Event,
        isDefaultPrevented: et,
        isPropagationStopped: et,
        isImmediatePropagationStopped: et,
        isSimulated: !1,
        preventDefault: function () {
            var n = this.originalEvent;
            this.isDefaultPrevented = ri;
            n && !this.isSimulated && n.preventDefault()
        },
        stopPropagation: function () {
            var n = this.originalEvent;
            this.isPropagationStopped = ri;
            n && !this.isSimulated && n.stopPropagation()
        },
        stopImmediatePropagation: function () {
            var n = this.originalEvent;
            this.isImmediatePropagationStopped = ri;
            n && !this.isSimulated && n.stopImmediatePropagation();
            this.stopPropagation()
        }
    };
    i.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function (n) {
            var t = n.button;
            return null == n.which && se.test(n.type) ? null != n.charCode ? n.charCode : n.keyCode : !n.which && void 0 !== t && he.test(n.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : n.which
        }
    }, i.event.addProp);
    i.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (n, t) {
        i.event.special[n] = {
            delegateType: t, bindType: t, handle: function (n) {
                var u, f = this, r = n.relatedTarget, e = n.handleObj;
                return r && (r === f || i.contains(f, r)) || (n.type = e.origType, u = e.handler.apply(this, arguments), n.type = t), u
            }
        }
    });
    i.fn.extend({
        on: function (n, t, i, r) {
            return yi(this, n, t, i, r)
        }, one: function (n, t, i, r) {
            return yi(this, n, t, i, r, 1)
        }, off: function (n, t, r) {
            var u, f;
            if (n && n.preventDefault && n.handleObj) return u = n.handleObj, i(n.delegateTarget).off(u.namespace ? u.origType + "." + u.namespace : u.origType, u.selector, u.handler), this;
            if ("object" == typeof n) {
                for (f in n) this.off(f, t, n[f]);
                return this
            }
            return !1 !== t && "function" != typeof t || (r = t, t = void 0), !1 === r && (r = et), this.each(function () {
                i.event.remove(this, n, r, t)
            })
        }
    });
    var ce = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
        le = /<script|<style|<link/i, ae = /checked\s*(?:[^=]|=\s*.checked.)/i,
        ve = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
    i.extend({
        htmlPrefilter: function (n) {
            return n.replace(ce, "<$1><\/$2>")
        }, clone: function (n, t, r) {
            var u, c, o, f, h = n.cloneNode(!0), l = i.contains(n.ownerDocument, n);
            if (!(e.noCloneChecked || 1 !== n.nodeType && 11 !== n.nodeType || i.isXMLDoc(n))) for (f = s(h), u = 0, c = (o = s(n)).length; u < c; u++) we(o[u], f[u]);
            if (t) if (r) for (o = o || s(n), f = f || s(h), u = 0, c = o.length; u < c; u++) cu(o[u], f[u]); else cu(n, h);
            return (f = s(h, "script")).length > 0 && vi(f, !l && s(n, "script")), h
        }, cleanData: function (n) {
            for (var u, t, f, s = i.event.special, e = 0; void 0 !== (t = n[e]); e++) if (lt(t)) {
                if (u = t[r.expando]) {
                    if (u.events) for (f in u.events) s[f] ? i.event.remove(t, f) : i.removeEvent(t, f, u.handle);
                    t[r.expando] = void 0
                }
                t[o.expando] && (t[o.expando] = void 0)
            }
        }
    });
    i.fn.extend({
        detach: function (n) {
            return lu(this, n, !0)
        }, remove: function (n) {
            return lu(this, n)
        }, text: function (n) {
            return p(this, function (n) {
                return void 0 === n ? i.text(this) : this.empty().each(function () {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = n)
                })
            }, null, n, arguments.length)
        }, append: function () {
            return ot(this, arguments, function (n) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || hu(this, n).appendChild(n)
            })
        }, prepend: function () {
            return ot(this, arguments, function (n) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = hu(this, n);
                    t.insertBefore(n, t.firstChild)
                }
            })
        }, before: function () {
            return ot(this, arguments, function (n) {
                this.parentNode && this.parentNode.insertBefore(n, this)
            })
        }, after: function () {
            return ot(this, arguments, function (n) {
                this.parentNode && this.parentNode.insertBefore(n, this.nextSibling)
            })
        }, empty: function () {
            for (var n, t = 0; null != (n = this[t]); t++) 1 === n.nodeType && (i.cleanData(s(n, !1)), n.textContent = "");
            return this
        }, clone: function (n, t) {
            return n = null != n && n, t = null == t ? n : t, this.map(function () {
                return i.clone(this, n, t)
            })
        }, html: function (n) {
            return p(this, function (n) {
                var t = this[0] || {}, r = 0, u = this.length;
                if (void 0 === n && 1 === t.nodeType) return t.innerHTML;
                if ("string" == typeof n && !le.test(n) && !c[(ru.exec(n) || ["", ""])[1].toLowerCase()]) {
                    n = i.htmlPrefilter(n);
                    try {
                        for (; r < u; r++) 1 === (t = this[r] || {}).nodeType && (i.cleanData(s(t, !1)), t.innerHTML = n);
                        t = 0
                    } catch (n) {
                    }
                }
                t && this.empty().append(n)
            }, null, n, arguments.length)
        }, replaceWith: function () {
            var n = [];
            return ot(this, arguments, function (t) {
                var r = this.parentNode;
                i.inArray(this, n) < 0 && (i.cleanData(s(this)), r && r.replaceChild(t, this))
            }, n)
        }
    });
    i.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (n, t) {
        i.fn[n] = function (n) {
            for (var u, f = [], e = i(n), o = e.length - 1, r = 0; r <= o; r++) u = r === o ? this : this.clone(!0), i(e[r])[t](u), si.apply(f, u.get());
            return this.pushStack(f)
        }
    });
    var pi = new RegExp("^(" + gr + ")(?!px)[a-z%]+$", "i"), ui = function (t) {
        var i = t.ownerDocument.defaultView;
        return i && i.opener || (i = n), i.getComputedStyle(t)
    }, be = new RegExp(w.join("|"), "i");
    !function () {
        function r() {
            if (t) {
                o.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0";
                t.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%";
                ii.appendChild(o).appendChild(t);
                var i = n.getComputedStyle(t);
                s = "1%" !== i.top;
                a = 12 === u(i.marginLeft);
                t.style.right = "60%";
                l = 36 === u(i.right);
                h = 36 === u(i.width);
                t.style.position = "absolute";
                c = 36 === t.offsetWidth || "absolute";
                ii.removeChild(o);
                t = null
            }
        }

        function u(n) {
            return Math.round(parseFloat(n))
        }

        var s, h, c, l, a, o = f.createElement("div"), t = f.createElement("div");
        t.style && (t.style.backgroundClip = "content-box", t.cloneNode(!0).style.backgroundClip = "", e.clearCloneStyle = "content-box" === t.style.backgroundClip, i.extend(e, {
            boxSizingReliable: function () {
                return r(), h
            }, pixelBoxStyles: function () {
                return r(), l
            }, pixelPosition: function () {
                return r(), s
            }, reliableMarginLeft: function () {
                return r(), a
            }, scrollboxSize: function () {
                return r(), c
            }
        }))
    }();
    var ke = /^(none|table(?!-c[ea]).+)/, vu = /^--/,
        de = {position: "absolute", visibility: "hidden", display: "block"},
        yu = {letterSpacing: "0", fontWeight: "400"}, pu = ["Webkit", "Moz", "ms"], wu = f.createElement("div").style;
    i.extend({
        cssHooks: {
            opacity: {
                get: function (n, t) {
                    if (t) {
                        var i = yt(n, "opacity");
                        return "" === i ? "1" : i
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function (n, t, r, u) {
            if (n && 3 !== n.nodeType && 8 !== n.nodeType && n.style) {
                var f, h, o, c = y(t), l = vu.test(t), s = n.style;
                if (l || (t = bu(c)), o = i.cssHooks[t] || i.cssHooks[c], void 0 === r) return o && "get" in o && void 0 !== (f = o.get(n, !1, u)) ? f : s[t];
                "string" == (h = typeof r) && (f = vt.exec(r)) && f[1] && (r = tu(n, t, f), h = "number");
                null != r && r === r && ("number" === h && (r += f && f[3] || (i.cssNumber[c] ? "" : "px")), e.clearCloneStyle || "" !== r || 0 !== t.indexOf("background") || (s[t] = "inherit"), o && "set" in o && void 0 === (r = o.set(n, r, u)) || (l ? s.setProperty(t, r) : s[t] = r))
            }
        },
        css: function (n, t, r, u) {
            var f, e, o, s = y(t);
            return vu.test(t) || (t = bu(s)), (o = i.cssHooks[t] || i.cssHooks[s]) && "get" in o && (f = o.get(n, !0, r)), void 0 === f && (f = yt(n, t, u)), "normal" === f && t in yu && (f = yu[t]), "" === r || r ? (e = parseFloat(f), !0 === r || isFinite(e) ? e || 0 : f) : f
        }
    });
    i.each(["height", "width"], function (n, t) {
        i.cssHooks[t] = {
            get: function (n, r, u) {
                if (r) return !ke.test(i.css(n, "display")) || n.getClientRects().length && n.getBoundingClientRect().width ? du(n, t, u) : nu(n, de, function () {
                    return du(n, t, u)
                })
            }, set: function (n, r, u) {
                var s, f = ui(n), h = "border-box" === i.css(n, "boxSizing", !1, f), o = u && wi(n, t, u, h, f);
                return h && e.scrollboxSize() === f.position && (o -= Math.ceil(n["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(f[t]) - wi(n, t, "border", !1, f) - .5)), o && (s = vt.exec(r)) && "px" !== (s[3] || "px") && (n.style[t] = r, r = i.css(n, t)), ku(n, r, o)
            }
        }
    });
    i.cssHooks.marginLeft = au(e.reliableMarginLeft, function (n, t) {
        if (t) return (parseFloat(yt(n, "marginLeft")) || n.getBoundingClientRect().left - nu(n, {marginLeft: 0}, function () {
            return n.getBoundingClientRect().left
        })) + "px"
    });
    i.each({margin: "", padding: "", border: "Width"}, function (n, t) {
        i.cssHooks[n + t] = {
            expand: function (i) {
                for (var r = 0, f = {}, u = "string" == typeof i ? i.split(" ") : [i]; r < 4; r++) f[n + w[r] + t] = u[r] || u[r - 2] || u[0];
                return f
            }
        };
        "margin" !== n && (i.cssHooks[n + t].set = ku)
    });
    i.fn.extend({
        css: function (n, t) {
            return p(this, function (n, t, r) {
                var f, e, o = {}, u = 0;
                if (Array.isArray(t)) {
                    for (f = ui(n), e = t.length; u < e; u++) o[t[u]] = i.css(n, t[u], !1, f);
                    return o
                }
                return void 0 !== r ? i.style(n, t, r) : i.css(n, t)
            }, n, t, arguments.length > 1)
        }
    });
    i.Tween = h;
    h.prototype = {
        constructor: h, init: function (n, t, r, u, f, e) {
            this.elem = n;
            this.prop = r;
            this.easing = f || i.easing._default;
            this.options = t;
            this.start = this.now = this.cur();
            this.end = u;
            this.unit = e || (i.cssNumber[r] ? "" : "px")
        }, cur: function () {
            var n = h.propHooks[this.prop];
            return n && n.get ? n.get(this) : h.propHooks._default.get(this)
        }, run: function (n) {
            var t, r = h.propHooks[this.prop];
            return this.pos = this.options.duration ? t = i.easing[this.easing](n, this.options.duration * n, 0, 1, this.options.duration) : t = n, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), r && r.set ? r.set(this) : h.propHooks._default.set(this), this
        }
    };
    h.prototype.init.prototype = h.prototype;
    h.propHooks = {
        _default: {
            get: function (n) {
                var t;
                return 1 !== n.elem.nodeType || null != n.elem[n.prop] && null == n.elem.style[n.prop] ? n.elem[n.prop] : (t = i.css(n.elem, n.prop, "")) && "auto" !== t ? t : 0
            }, set: function (n) {
                i.fx.step[n.prop] ? i.fx.step[n.prop](n) : 1 !== n.elem.nodeType || null == n.elem.style[i.cssProps[n.prop]] && !i.cssHooks[n.prop] ? n.elem[n.prop] = n.now : i.style(n.elem, n.prop, n.now + n.unit)
            }
        }
    };
    h.propHooks.scrollTop = h.propHooks.scrollLeft = {
        set: function (n) {
            n.elem.nodeType && n.elem.parentNode && (n.elem[n.prop] = n.now)
        }
    };
    i.easing = {
        linear: function (n) {
            return n
        }, swing: function (n) {
            return .5 - Math.cos(n * Math.PI) / 2
        }, _default: "swing"
    };
    i.fx = h.prototype.init;
    i.fx.step = {};
    gu = /^(?:toggle|show|hide)$/;
    nf = /queueHooks$/;
    i.Animation = i.extend(a, {
        tweeners: {
            "*": [function (n, t) {
                var i = this.createTween(n, t);
                return tu(i.elem, n, vt.exec(t), i), i
            }]
        }, tweener: function (n, t) {
            u(n) ? (t = n, n = ["*"]) : n = n.match(l);
            for (var i, r = 0, f = n.length; r < f; r++) i = n[r], a.tweeners[i] = a.tweeners[i] || [], a.tweeners[i].unshift(t)
        }, prefilters: [no], prefilter: function (n, t) {
            t ? a.prefilters.unshift(n) : a.prefilters.push(n)
        }
    });
    i.speed = function (n, t, r) {
        var f = n && "object" == typeof n ? i.extend({}, n) : {
            complete: r || !r && t || u(n) && n,
            duration: n,
            easing: r && t || t && !u(t) && t
        };
        return i.fx.off ? f.duration = 0 : "number" != typeof f.duration && (f.duration = f.duration in i.fx.speeds ? i.fx.speeds[f.duration] : i.fx.speeds._default), null != f.queue && !0 !== f.queue || (f.queue = "fx"), f.old = f.complete, f.complete = function () {
            u(f.old) && f.old.call(this);
            f.queue && i.dequeue(this, f.queue)
        }, f
    };
    i.fn.extend({
        fadeTo: function (n, t, i, r) {
            return this.filter(ti).css("opacity", 0).show().end().animate({opacity: t}, n, i, r)
        }, animate: function (n, t, u, f) {
            var s = i.isEmptyObject(n), o = i.speed(t, u, f), e = function () {
                var t = a(this, i.extend({}, n), o);
                (s || r.get(this, "finish")) && t.stop(!0)
            };
            return e.finish = e, s || !1 === o.queue ? this.each(e) : this.queue(o.queue, e)
        }, stop: function (n, t, u) {
            var f = function (n) {
                var t = n.stop;
                delete n.stop;
                t(u)
            };
            return "string" != typeof n && (u = t, t = n, n = void 0), t && !1 !== n && this.queue(n || "fx", []), this.each(function () {
                var s = !0, t = null != n && n + "queueHooks", o = i.timers, e = r.get(this);
                if (t) e[t] && e[t].stop && f(e[t]); else for (t in e) e[t] && e[t].stop && nf.test(t) && f(e[t]);
                for (t = o.length; t--;) o[t].elem !== this || null != n && o[t].queue !== n || (o[t].anim.stop(u), s = !1, o.splice(t, 1));
                !s && u || i.dequeue(this, n)
            })
        }, finish: function (n) {
            return !1 !== n && (n = n || "fx"), this.each(function () {
                var t, e = r.get(this), u = e[n + "queue"], o = e[n + "queueHooks"], f = i.timers, s = u ? u.length : 0;
                for (e.finish = !0, i.queue(this, n, []), o && o.stop && o.stop.call(this, !0), t = f.length; t--;) f[t].elem === this && f[t].queue === n && (f[t].anim.stop(!0), f.splice(t, 1));
                for (t = 0; t < s; t++) u[t] && u[t].finish && u[t].finish.call(this);
                delete e.finish
            })
        }
    });
    i.each(["toggle", "show", "hide"], function (n, t) {
        var r = i.fn[t];
        i.fn[t] = function (n, i, u) {
            return null == n || "boolean" == typeof n ? r.apply(this, arguments) : this.animate(ei(t, !0), n, i, u)
        }
    });
    i.each({
        slideDown: ei("show"),
        slideUp: ei("hide"),
        slideToggle: ei("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (n, t) {
        i.fn[n] = function (n, i, r) {
            return this.animate(t, n, i, r)
        }
    });
    i.timers = [];
    i.fx.tick = function () {
        var r, n = 0, t = i.timers;
        for (st = Date.now(); n < t.length; n++) (r = t[n])() || t[n] !== r || t.splice(n--, 1);
        t.length || i.fx.stop();
        st = void 0
    };
    i.fx.timer = function (n) {
        i.timers.push(n);
        i.fx.start()
    };
    i.fx.interval = 13;
    i.fx.start = function () {
        fi || (fi = !0, bi())
    };
    i.fx.stop = function () {
        fi = null
    };
    i.fx.speeds = {slow: 600, fast: 200, _default: 400};
    i.fn.delay = function (t, r) {
        return t = i.fx ? i.fx.speeds[t] || t : t, r = r || "fx", this.queue(r, function (i, r) {
            var u = n.setTimeout(i, t);
            r.stop = function () {
                n.clearTimeout(u)
            }
        })
    }, function () {
        var n = f.createElement("input"), t = f.createElement("select").appendChild(f.createElement("option"));
        n.type = "checkbox";
        e.checkOn = "" !== n.value;
        e.optSelected = t.selected;
        (n = f.createElement("input")).value = "t";
        n.type = "radio";
        e.radioValue = "t" === n.value
    }();
    ht = i.expr.attrHandle;
    i.fn.extend({
        attr: function (n, t) {
            return p(this, i.attr, n, t, arguments.length > 1)
        }, removeAttr: function (n) {
            return this.each(function () {
                i.removeAttr(this, n)
            })
        }
    });
    i.extend({
        attr: function (n, t, r) {
            var f, u, e = n.nodeType;
            if (3 !== e && 8 !== e && 2 !== e) return "undefined" == typeof n.getAttribute ? i.prop(n, t, r) : (1 === e && i.isXMLDoc(n) || (u = i.attrHooks[t.toLowerCase()] || (i.expr.match.bool.test(t) ? uf : void 0)), void 0 !== r ? null === r ? void i.removeAttr(n, t) : u && "set" in u && void 0 !== (f = u.set(n, r, t)) ? f : (n.setAttribute(t, r + ""), r) : u && "get" in u && null !== (f = u.get(n, t)) ? f : null == (f = i.find.attr(n, t)) ? void 0 : f)
        }, attrHooks: {
            type: {
                set: function (n, t) {
                    if (!e.radioValue && "radio" === t && v(n, "input")) {
                        var i = n.value;
                        return n.setAttribute("type", t), i && (n.value = i), t
                    }
                }
            }
        }, removeAttr: function (n, t) {
            var i, u = 0, r = t && t.match(l);
            if (r && 1 === n.nodeType) while (i = r[u++]) n.removeAttribute(i)
        }
    });
    uf = {
        set: function (n, t, r) {
            return !1 === t ? i.removeAttr(n, r) : n.setAttribute(r, r), r
        }
    };
    i.each(i.expr.match.bool.source.match(/\w+/g), function (n, t) {
        var r = ht[t] || i.find.attr;
        ht[t] = function (n, t, i) {
            var f, e, u = t.toLowerCase();
            return i || (e = ht[u], ht[u] = f, f = null != r(n, t, i) ? u : null, ht[u] = e), f
        }
    });
    ff = /^(?:input|select|textarea|button)$/i;
    ef = /^(?:a|area)$/i;
    i.fn.extend({
        prop: function (n, t) {
            return p(this, i.prop, n, t, arguments.length > 1)
        }, removeProp: function (n) {
            return this.each(function () {
                delete this[i.propFix[n] || n]
            })
        }
    });
    i.extend({
        prop: function (n, t, r) {
            var f, u, e = n.nodeType;
            if (3 !== e && 8 !== e && 2 !== e) return 1 === e && i.isXMLDoc(n) || (t = i.propFix[t] || t, u = i.propHooks[t]), void 0 !== r ? u && "set" in u && void 0 !== (f = u.set(n, r, t)) ? f : n[t] = r : u && "get" in u && null !== (f = u.get(n, t)) ? f : n[t]
        }, propHooks: {
            tabIndex: {
                get: function (n) {
                    var t = i.find.attr(n, "tabindex");
                    return t ? parseInt(t, 10) : ff.test(n.nodeName) || ef.test(n.nodeName) && n.href ? 0 : -1
                }
            }
        }, propFix: {"for": "htmlFor", "class": "className"}
    });
    e.optSelected || (i.propHooks.selected = {
        get: function (n) {
            var t = n.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        }, set: function (n) {
            var t = n.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    });
    i.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        i.propFix[this.toLowerCase()] = this
    });
    i.fn.extend({
        addClass: function (n) {
            var o, t, r, f, e, s, h, c = 0;
            if (u(n)) return this.each(function (t) {
                i(this).addClass(n.call(this, t, nt(this)))
            });
            if ((o = ki(n)).length) while (t = this[c++]) if (f = nt(t), r = 1 === t.nodeType && " " + g(f) + " ") {
                for (s = 0; e = o[s++];) r.indexOf(" " + e + " ") < 0 && (r += e + " ");
                f !== (h = g(r)) && t.setAttribute("class", h)
            }
            return this
        }, removeClass: function (n) {
            var o, r, t, f, e, s, h, c = 0;
            if (u(n)) return this.each(function (t) {
                i(this).removeClass(n.call(this, t, nt(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ((o = ki(n)).length) while (r = this[c++]) if (f = nt(r), t = 1 === r.nodeType && " " + g(f) + " ") {
                for (s = 0; e = o[s++];) while (t.indexOf(" " + e + " ") > -1) t = t.replace(" " + e + " ", " ");
                f !== (h = g(t)) && r.setAttribute("class", h)
            }
            return this
        }, toggleClass: function (n, t) {
            var f = typeof n, e = "string" === f || Array.isArray(n);
            return "boolean" == typeof t && e ? t ? this.addClass(n) : this.removeClass(n) : u(n) ? this.each(function (r) {
                i(this).toggleClass(n.call(this, r, nt(this), t), t)
            }) : this.each(function () {
                var t, o, u, s;
                if (e) for (o = 0, u = i(this), s = ki(n); t = s[o++];) u.hasClass(t) ? u.removeClass(t) : u.addClass(t); else void 0 !== n && "boolean" !== f || ((t = nt(this)) && r.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === n ? "" : r.get(this, "__className__") || ""))
            })
        }, hasClass: function (n) {
            for (var t, r = 0, i = " " + n + " "; t = this[r++];) if (1 === t.nodeType && (" " + g(nt(t)) + " ").indexOf(i) > -1) return !0;
            return !1
        }
    });
    of = /\r/g;
    i.fn.extend({
        val: function (n) {
            var t, r, e, f = this[0];
            return arguments.length ? (e = u(n), this.each(function (r) {
                var u;
                1 === this.nodeType && (null == (u = e ? n.call(this, r, i(this).val()) : n) ? u = "" : "number" == typeof u ? u += "" : Array.isArray(u) && (u = i.map(u, function (n) {
                    return null == n ? "" : n + ""
                })), (t = i.valHooks[this.type] || i.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, u, "value") || (this.value = u))
            })) : f ? (t = i.valHooks[f.type] || i.valHooks[f.nodeName.toLowerCase()]) && "get" in t && void 0 !== (r = t.get(f, "value")) ? r : "string" == typeof(r = f.value) ? r.replace(of, "") : null == r ? "" : r : void 0
        }
    });
    i.extend({
        valHooks: {
            option: {
                get: function (n) {
                    var t = i.find.attr(n, "value");
                    return null != t ? t : g(i.text(n))
                }
            }, select: {
                get: function (n) {
                    for (var e, t, o = n.options, u = n.selectedIndex, f = "select-one" === n.type, s = f ? null : [], h = f ? u + 1 : o.length, r = u < 0 ? h : f ? u : 0; r < h; r++) if (((t = o[r]).selected || r === u) && !t.disabled && (!t.parentNode.disabled || !v(t.parentNode, "optgroup"))) {
                        if (e = i(t).val(), f) return e;
                        s.push(e)
                    }
                    return s
                }, set: function (n, t) {
                    for (var r, u, f = n.options, e = i.makeArray(t), o = f.length; o--;) ((u = f[o]).selected = i.inArray(i.valHooks.option.get(u), e) > -1) && (r = !0);
                    return r || (n.selectedIndex = -1), e
                }
            }
        }
    });
    i.each(["radio", "checkbox"], function () {
        i.valHooks[this] = {
            set: function (n, t) {
                if (Array.isArray(t)) return n.checked = i.inArray(i(n).val(), t) > -1
            }
        };
        e.checkOn || (i.valHooks[this].get = function (n) {
            return null === n.getAttribute("value") ? "on" : n.value
        })
    });
    e.focusin = "onfocusin" in n;
    di = /^(?:focusinfocus|focusoutblur)$/;
    gi = function (n) {
        n.stopPropagation()
    };
    i.extend(i.event, {
        trigger: function (t, e, o, s) {
            var k, c, l, d, v, y, a, p, w = [o || f], h = kt.call(t, "type") ? t.type : t,
                b = kt.call(t, "namespace") ? t.namespace.split(".") : [];
            if (c = p = l = o = o || f, 3 !== o.nodeType && 8 !== o.nodeType && !di.test(h + i.event.triggered) && (h.indexOf(".") > -1 && (h = (b = h.split(".")).shift(), b.sort()), v = h.indexOf(":") < 0 && "on" + h, t = t[i.expando] ? t : new i.Event(h, "object" == typeof t && t), t.isTrigger = s ? 2 : 3, t.namespace = b.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = o), e = null == e ? [t] : i.makeArray(e, [t]), a = i.event.special[h] || {}, s || !a.trigger || !1 !== a.trigger.apply(o, e))) {
                if (!s && !a.noBubble && !tt(o)) {
                    for (d = a.delegateType || h, di.test(d + h) || (c = c.parentNode); c; c = c.parentNode) w.push(c), l = c;
                    l === (o.ownerDocument || f) && w.push(l.defaultView || l.parentWindow || n)
                }
                for (k = 0; (c = w[k++]) && !t.isPropagationStopped();) p = c, t.type = k > 1 ? d : a.bindType || h, (y = (r.get(c, "events") || {})[t.type] && r.get(c, "handle")) && y.apply(c, e), (y = v && c[v]) && y.apply && lt(c) && (t.result = y.apply(c, e), !1 === t.result && t.preventDefault());
                return t.type = h, s || t.isDefaultPrevented() || a._default && !1 !== a._default.apply(w.pop(), e) || !lt(o) || v && u(o[h]) && !tt(o) && ((l = o[v]) && (o[v] = null), i.event.triggered = h, t.isPropagationStopped() && p.addEventListener(h, gi), o[h](), t.isPropagationStopped() && p.removeEventListener(h, gi), i.event.triggered = void 0, l && (o[v] = l)), t.result
            }
        }, simulate: function (n, t, r) {
            var u = i.extend(new i.Event, r, {type: n, isSimulated: !0});
            i.event.trigger(u, null, t)
        }
    });
    i.fn.extend({
        trigger: function (n, t) {
            return this.each(function () {
                i.event.trigger(n, t, this)
            })
        }, triggerHandler: function (n, t) {
            var r = this[0];
            if (r) return i.event.trigger(n, t, r, !0)
        }
    });
    e.focusin || i.each({focus: "focusin", blur: "focusout"}, function (n, t) {
        var u = function (n) {
            i.event.simulate(t, n.target, i.event.fix(n))
        };
        i.event.special[t] = {
            setup: function () {
                var i = this.ownerDocument || this, f = r.access(i, t);
                f || i.addEventListener(n, u, !0);
                r.access(i, t, (f || 0) + 1)
            }, teardown: function () {
                var i = this.ownerDocument || this, f = r.access(i, t) - 1;
                f ? r.access(i, t, f) : (i.removeEventListener(n, u, !0), r.remove(i, t))
            }
        }
    });
    var pt = n.location, sf = Date.now(), nr = /\?/;
    i.parseXML = function (t) {
        var r;
        if (!t || "string" != typeof t) return null;
        try {
            r = (new n.DOMParser).parseFromString(t, "text/xml")
        } catch (n) {
            r = void 0
        }
        return r && !r.getElementsByTagName("parsererror").length || i.error("Invalid XML: " + t), r
    };
    var io = /\[\]$/, hf = /\r?\n/g, ro = /^(?:submit|button|image|reset|file)$/i,
        uo = /^(?:input|select|textarea|keygen)/i;
    i.param = function (n, t) {
        var r, f = [], e = function (n, t) {
            var i = u(t) ? t() : t;
            f[f.length] = encodeURIComponent(n) + "=" + encodeURIComponent(null == i ? "" : i)
        };
        if (Array.isArray(n) || n.jquery && !i.isPlainObject(n)) i.each(n, function () {
            e(this.name, this.value)
        }); else for (r in n) tr(r, n[r], t, e);
        return f.join("&")
    };
    i.fn.extend({
        serialize: function () {
            return i.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var n = i.prop(this, "elements");
                return n ? i.makeArray(n) : this
            }).filter(function () {
                var n = this.type;
                return this.name && !i(this).is(":disabled") && uo.test(this.nodeName) && !ro.test(n) && (this.checked || !iu.test(n))
            }).map(function (n, t) {
                var r = i(this).val();
                return null == r ? null : Array.isArray(r) ? i.map(r, function (n) {
                    return {name: t.name, value: n.replace(hf, "\r\n")}
                }) : {name: t.name, value: r.replace(hf, "\r\n")}
            }).get()
        }
    });
    var fo = /%20/g, eo = /#.*$/, oo = /([?&])_=[^&]*/, so = /^(.*?):[ \t]*([^\r\n]*)$/gm, ho = /^(?:GET|HEAD)$/,
        co = /^\/\//, cf = {}, ir = {}, lf = "*/".concat("*"), rr = f.createElement("a");
    return rr.href = pt.href, i.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: pt.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(pt.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": lf,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": i.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (n, t) {
            return t ? ur(ur(n, i.ajaxSettings), t) : ur(i.ajaxSettings, n)
        },
        ajaxPrefilter: af(cf),
        ajaxTransport: af(ir),
        ajax: function (t, r) {
            function b(t, r, f, c) {
                var v, rt, b, p, g, l = r;
                s || (s = !0, d && n.clearTimeout(d), a = void 0, k = c || "", e.readyState = t > 0 ? 4 : 0, v = t >= 200 && t < 300 || 304 === t, f && (p = lo(u, e, f)), p = ao(u, p, e, v), v ? (u.ifModified && ((g = e.getResponseHeader("Last-Modified")) && (i.lastModified[o] = g), (g = e.getResponseHeader("etag")) && (i.etag[o] = g)), 204 === t || "HEAD" === u.type ? l = "nocontent" : 304 === t ? l = "notmodified" : (l = p.state, rt = p.data, v = !(b = p.error))) : (b = l, !t && l || (l = "error", t < 0 && (t = 0))), e.status = t, e.statusText = (r || l) + "", v ? tt.resolveWith(h, [rt, l, e]) : tt.rejectWith(h, [e, l, b]), e.statusCode(w), w = void 0, y && nt.trigger(v ? "ajaxSuccess" : "ajaxError", [e, u, v ? rt : b]), it.fireWith(h, [e, l]), y && (nt.trigger("ajaxComplete", [e, u]), --i.active || i.event.trigger("ajaxStop")))
            }

            "object" == typeof t && (r = t, t = void 0);
            r = r || {};
            var a, o, k, v, d, c, s, y, g, p, u = i.ajaxSetup({}, r), h = u.context || u,
                nt = u.context && (h.nodeType || h.jquery) ? i(h) : i.event, tt = i.Deferred(),
                it = i.Callbacks("once memory"), w = u.statusCode || {}, rt = {}, ut = {}, ft = "canceled", e = {
                    readyState: 0, getResponseHeader: function (n) {
                        var t;
                        if (s) {
                            if (!v) for (v = {}; t = so.exec(k);) v[t[1].toLowerCase()] = t[2];
                            t = v[n.toLowerCase()]
                        }
                        return null == t ? null : t
                    }, getAllResponseHeaders: function () {
                        return s ? k : null
                    }, setRequestHeader: function (n, t) {
                        return null == s && (n = ut[n.toLowerCase()] = ut[n.toLowerCase()] || n, rt[n] = t), this
                    }, overrideMimeType: function (n) {
                        return null == s && (u.mimeType = n), this
                    }, statusCode: function (n) {
                        var t;
                        if (n) if (s) e.always(n[e.status]); else for (t in n) w[t] = [w[t], n[t]];
                        return this
                    }, abort: function (n) {
                        var t = n || ft;
                        return a && a.abort(t), b(0, t), this
                    }
                };
            if (tt.promise(e), u.url = ((t || u.url || pt.href) + "").replace(co, pt.protocol + "//"), u.type = r.method || r.type || u.method || u.type, u.dataTypes = (u.dataType || "*").toLowerCase().match(l) || [""], null == u.crossDomain) {
                c = f.createElement("a");
                try {
                    c.href = u.url;
                    c.href = c.href;
                    u.crossDomain = rr.protocol + "//" + rr.host != c.protocol + "//" + c.host
                } catch (n) {
                    u.crossDomain = !0
                }
            }
            if (u.data && u.processData && "string" != typeof u.data && (u.data = i.param(u.data, u.traditional)), vf(cf, u, r, e), s) return e;
            (y = i.event && u.global) && 0 == i.active++ && i.event.trigger("ajaxStart");
            u.type = u.type.toUpperCase();
            u.hasContent = !ho.test(u.type);
            o = u.url.replace(eo, "");
            u.hasContent ? u.data && u.processData && 0 === (u.contentType || "").indexOf("application/x-www-form-urlencoded") && (u.data = u.data.replace(fo, "+")) : (p = u.url.slice(o.length), u.data && (u.processData || "string" == typeof u.data) && (o += (nr.test(o) ? "&" : "?") + u.data, delete u.data), !1 === u.cache && (o = o.replace(oo, "$1"), p = (nr.test(o) ? "&" : "?") + "_=" + sf++ + p), u.url = o + p);
            u.ifModified && (i.lastModified[o] && e.setRequestHeader("If-Modified-Since", i.lastModified[o]), i.etag[o] && e.setRequestHeader("If-None-Match", i.etag[o]));
            (u.data && u.hasContent && !1 !== u.contentType || r.contentType) && e.setRequestHeader("Content-Type", u.contentType);
            e.setRequestHeader("Accept", u.dataTypes[0] && u.accepts[u.dataTypes[0]] ? u.accepts[u.dataTypes[0]] + ("*" !== u.dataTypes[0] ? ", " + lf + "; q=0.01" : "") : u.accepts["*"]);
            for (g in u.headers) e.setRequestHeader(g, u.headers[g]);
            if (u.beforeSend && (!1 === u.beforeSend.call(h, e, u) || s)) return e.abort();
            if (ft = "abort", it.add(u.complete), e.done(u.success), e.fail(u.error), a = vf(ir, u, r, e)) {
                if (e.readyState = 1, y && nt.trigger("ajaxSend", [e, u]), s) return e;
                u.async && u.timeout > 0 && (d = n.setTimeout(function () {
                    e.abort("timeout")
                }, u.timeout));
                try {
                    s = !1;
                    a.send(rt, b)
                } catch (n) {
                    if (s) throw n;
                    b(-1, n)
                }
            } else b(-1, "No Transport");
            return e
        },
        getJSON: function (n, t, r) {
            return i.get(n, t, r, "json")
        },
        getScript: function (n, t) {
            return i.get(n, void 0, t, "script")
        }
    }), i.each(["get", "post"], function (n, t) {
        i[t] = function (n, r, f, e) {
            return u(r) && (e = e || f, f = r, r = void 0), i.ajax(i.extend({
                url: n,
                type: t,
                dataType: e,
                data: r,
                success: f
            }, i.isPlainObject(n) && n))
        }
    }), i._evalUrl = function (n) {
        return i.ajax({url: n, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0})
    }, i.fn.extend({
        wrapAll: function (n) {
            var t;
            return this[0] && (u(n) && (n = n.call(this[0])), t = i(n, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                for (var n = this; n.firstElementChild;) n = n.firstElementChild;
                return n
            }).append(this)), this
        }, wrapInner: function (n) {
            return u(n) ? this.each(function (t) {
                i(this).wrapInner(n.call(this, t))
            }) : this.each(function () {
                var t = i(this), r = t.contents();
                r.length ? r.wrapAll(n) : t.append(n)
            })
        }, wrap: function (n) {
            var t = u(n);
            return this.each(function (r) {
                i(this).wrapAll(t ? n.call(this, r) : n)
            })
        }, unwrap: function (n) {
            return this.parent(n).not("body").each(function () {
                i(this).replaceWith(this.childNodes)
            }), this
        }
    }), i.expr.pseudos.hidden = function (n) {
        return !i.expr.pseudos.visible(n)
    }, i.expr.pseudos.visible = function (n) {
        return !!(n.offsetWidth || n.offsetHeight || n.getClientRects().length)
    }, i.ajaxSettings.xhr = function () {
        try {
            return new n.XMLHttpRequest
        } catch (n) {
        }
    }, yf = {
        0: 200,
        1223: 204
    }, ct = i.ajaxSettings.xhr(), e.cors = !!ct && "withCredentials" in ct, e.ajax = ct = !!ct, i.ajaxTransport(function (t) {
        var i, r;
        if (e.cors || ct && !t.crossDomain) return {
            send: function (u, f) {
                var o, e = t.xhr();
                if (e.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields) for (o in t.xhrFields) e[o] = t.xhrFields[o];
                t.mimeType && e.overrideMimeType && e.overrideMimeType(t.mimeType);
                t.crossDomain || u["X-Requested-With"] || (u["X-Requested-With"] = "XMLHttpRequest");
                for (o in u) e.setRequestHeader(o, u[o]);
                i = function (n) {
                    return function () {
                        i && (i = r = e.onload = e.onerror = e.onabort = e.ontimeout = e.onreadystatechange = null, "abort" === n ? e.abort() : "error" === n ? "number" != typeof e.status ? f(0, "error") : f(e.status, e.statusText) : f(yf[e.status] || e.status, e.statusText, "text" !== (e.responseType || "text") || "string" != typeof e.responseText ? {binary: e.response} : {text: e.responseText}, e.getAllResponseHeaders()))
                    }
                };
                e.onload = i();
                r = e.onerror = e.ontimeout = i("error");
                void 0 !== e.onabort ? e.onabort = r : e.onreadystatechange = function () {
                    4 === e.readyState && n.setTimeout(function () {
                        i && r()
                    })
                };
                i = i("abort");
                try {
                    e.send(t.hasContent && t.data || null)
                } catch (n) {
                    if (i) throw n;
                }
            }, abort: function () {
                i && i()
            }
        }
    }), i.ajaxPrefilter(function (n) {
        n.crossDomain && (n.contents.script = !1)
    }), i.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /\b(?:java|ecma)script\b/},
        converters: {
            "text script": function (n) {
                return i.globalEval(n), n
            }
        }
    }), i.ajaxPrefilter("script", function (n) {
        void 0 === n.cache && (n.cache = !1);
        n.crossDomain && (n.type = "GET")
    }), i.ajaxTransport("script", function (n) {
        if (n.crossDomain) {
            var r, t;
            return {
                send: function (u, e) {
                    r = i("<script>").prop({charset: n.scriptCharset, src: n.url}).on("load error", t = function (n) {
                        r.remove();
                        t = null;
                        n && e("error" === n.type ? 404 : 200, n.type)
                    });
                    f.head.appendChild(r[0])
                }, abort: function () {
                    t && t()
                }
            }
        }
    }), fr = [], oi = /(=)\?(?=&|$)|\?\?/, i.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var n = fr.pop() || i.expando + "_" + sf++;
            return this[n] = !0, n
        }
    }), i.ajaxPrefilter("json jsonp", function (t, r, f) {
        var e, o, s,
            h = !1 !== t.jsonp && (oi.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && oi.test(t.data) && "data");
        if (h || "jsonp" === t.dataTypes[0]) return e = t.jsonpCallback = u(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, h ? t[h] = t[h].replace(oi, "$1" + e) : !1 !== t.jsonp && (t.url += (nr.test(t.url) ? "&" : "?") + t.jsonp + "=" + e), t.converters["script json"] = function () {
            return s || i.error(e + " was not called"), s[0]
        }, t.dataTypes[0] = "json", o = n[e], n[e] = function () {
            s = arguments
        }, f.always(function () {
            void 0 === o ? i(n).removeProp(e) : n[e] = o;
            t[e] && (t.jsonpCallback = r.jsonpCallback, fr.push(e));
            s && u(o) && o(s[0]);
            s = o = void 0
        }), "script"
    }), e.createHTMLDocument = function () {
        var n = f.implementation.createHTMLDocument("").body;
        return n.innerHTML = "<form><\/form><form><\/form>", 2 === n.childNodes.length
    }(), i.parseHTML = function (n, t, r) {
        if ("string" != typeof n) return [];
        "boolean" == typeof t && (r = t, t = !1);
        var s, u, o;
        return t || (e.createHTMLDocument ? ((s = (t = f.implementation.createHTMLDocument("")).createElement("base")).href = f.location.href, t.head.appendChild(s)) : t = f), u = ci.exec(n), o = !r && [], u ? [t.createElement(u[1])] : (u = eu([n], t, o), o && o.length && i(o).remove(), i.merge([], u.childNodes))
    }, i.fn.load = function (n, t, r) {
        var f, s, h, e = this, o = n.indexOf(" ");
        return o > -1 && (f = g(n.slice(o)), n = n.slice(0, o)), u(t) ? (r = t, t = void 0) : t && "object" == typeof t && (s = "POST"), e.length > 0 && i.ajax({
            url: n,
            type: s || "GET",
            dataType: "html",
            data: t
        }).done(function (n) {
            h = arguments;
            e.html(f ? i("<div>").append(i.parseHTML(n)).find(f) : n)
        }).always(r && function (n, t) {
            e.each(function () {
                r.apply(this, h || [n.responseText, t, n])
            })
        }), this
    }, i.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (n, t) {
        i.fn[t] = function (n) {
            return this.on(t, n)
        }
    }), i.expr.pseudos.animated = function (n) {
        return i.grep(i.timers, function (t) {
            return n === t.elem
        }).length
    }, i.offset = {
        setOffset: function (n, t, r) {
            var v, o, s, h, f, c, y, l = i.css(n, "position"), a = i(n), e = {};
            "static" === l && (n.style.position = "relative");
            f = a.offset();
            s = i.css(n, "top");
            c = i.css(n, "left");
            (y = ("absolute" === l || "fixed" === l) && (s + c).indexOf("auto") > -1) ? (h = (v = a.position()).top, o = v.left) : (h = parseFloat(s) || 0, o = parseFloat(c) || 0);
            u(t) && (t = t.call(n, r, i.extend({}, f)));
            null != t.top && (e.top = t.top - f.top + h);
            null != t.left && (e.left = t.left - f.left + o);
            "using" in t ? t.using.call(n, e) : a.css(e)
        }
    }, i.fn.extend({
        offset: function (n) {
            if (arguments.length) return void 0 === n ? this : this.each(function (t) {
                i.offset.setOffset(this, n, t)
            });
            var r, u, t = this[0];
            if (t) return t.getClientRects().length ? (r = t.getBoundingClientRect(), u = t.ownerDocument.defaultView, {
                top: r.top + u.pageYOffset,
                left: r.left + u.pageXOffset
            }) : {top: 0, left: 0}
        }, position: function () {
            if (this[0]) {
                var n, r, u, t = this[0], f = {top: 0, left: 0};
                if ("fixed" === i.css(t, "position")) r = t.getBoundingClientRect(); else {
                    for (r = this.offset(), u = t.ownerDocument, n = t.offsetParent || u.documentElement; n && (n === u.body || n === u.documentElement) && "static" === i.css(n, "position");) n = n.parentNode;
                    n && n !== t && 1 === n.nodeType && ((f = i(n).offset()).top += i.css(n, "borderTopWidth", !0), f.left += i.css(n, "borderLeftWidth", !0))
                }
                return {
                    top: r.top - f.top - i.css(t, "marginTop", !0),
                    left: r.left - f.left - i.css(t, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                for (var n = this.offsetParent; n && "static" === i.css(n, "position");) n = n.offsetParent;
                return n || ii
            })
        }
    }), i.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (n, t) {
        var r = "pageYOffset" === t;
        i.fn[n] = function (i) {
            return p(this, function (n, i, u) {
                var f;
                if (tt(n) ? f = n : 9 === n.nodeType && (f = n.defaultView), void 0 === u) return f ? f[t] : n[i];
                f ? f.scrollTo(r ? f.pageXOffset : u, r ? u : f.pageYOffset) : n[i] = u
            }, n, i, arguments.length)
        }
    }), i.each(["top", "left"], function (n, t) {
        i.cssHooks[t] = au(e.pixelPosition, function (n, r) {
            if (r) return r = yt(n, t), pi.test(r) ? i(n).position()[t] + "px" : r
        })
    }), i.each({Height: "height", Width: "width"}, function (n, t) {
        i.each({padding: "inner" + n, content: t, "": "outer" + n}, function (r, u) {
            i.fn[u] = function (f, e) {
                var o = arguments.length && (r || "boolean" != typeof f),
                    s = r || (!0 === f || !0 === e ? "margin" : "border");
                return p(this, function (t, r, f) {
                    var e;
                    return tt(t) ? 0 === u.indexOf("outer") ? t["inner" + n] : t.document.documentElement["client" + n] : 9 === t.nodeType ? (e = t.documentElement, Math.max(t.body["scroll" + n], e["scroll" + n], t.body["offset" + n], e["offset" + n], e["client" + n])) : void 0 === f ? i.css(t, r, s) : i.style(t, r, f, s)
                }, t, o ? f : void 0, o)
            }
        })
    }), i.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (n, t) {
        i.fn[t] = function (n, i) {
            return arguments.length > 0 ? this.on(t, null, n, i) : this.trigger(t)
        }
    }), i.fn.extend({
        hover: function (n, t) {
            return this.mouseenter(n).mouseleave(t || n)
        }
    }), i.fn.extend({
        bind: function (n, t, i) {
            return this.on(n, null, t, i)
        }, unbind: function (n, t) {
            return this.off(n, null, t)
        }, delegate: function (n, t, i, r) {
            return this.on(t, n, i, r)
        }, undelegate: function (n, t, i) {
            return 1 === arguments.length ? this.off(n, "**") : this.off(t, n || "**", i)
        }
    }), i.proxy = function (n, t) {
        var f, e, r;
        if ("string" == typeof t && (f = n[t], t = n, n = f), u(n)) return e = d.call(arguments, 2), r = function () {
            return n.apply(t || this, e.concat(d.call(arguments)))
        }, r.guid = n.guid = n.guid || i.guid++, r
    }, i.holdReady = function (n) {
        n ? i.readyWait++ : i.ready(!0)
    }, i.isArray = Array.isArray, i.parseJSON = JSON.parse, i.nodeName = v, i.isFunction = u, i.isWindow = tt, i.camelCase = y, i.type = it, i.now = Date.now, i.isNumeric = function (n) {
        var t = i.type(n);
        return ("number" === t || "string" === t) && !isNaN(n - parseFloat(n))
    }, "function" == typeof define && define.amd && define("jquery", [], function () {
        return i
    }), pf = n.jQuery, wf = n.$, i.noConflict = function (t) {
        return n.$ === i && (n.$ = wf), t && n.jQuery === i && (n.jQuery = pf), i
    }, t || (n.jQuery = n.$ = i), i
}), function () {
    var t, n;
    t = this.jQuery || window.jQuery;
    n = t(window);
    t.fn.stick_in_parent = function (i) {
        var s, e, a, h, c, v, r, u, o, l, f;
        for (null == i && (i = {}), f = i.sticky_class, c = i.inner_scrolling, l = i.recalc_every, o = i.parent, u = i.offset_top, r = i.spacer, e = i.bottoming, null == u && (u = 0), null == o && (o = void 0), null == c && (c = !0), null == f && (f = "is_stuck"), s = t(document), null == e && (e = !0), a = function (i, h, a, v, y, p, w, b) {
            var it, ot, nt, et, st, k, d, rt, ut, ft, g, tt;
            if (!i.data("sticky_kit")) {
                if (i.data("sticky_kit", !0), st = s.height(), d = i.parent(), null != o && (d = d.closest(o)), !d.length) throw"failed to find stick parent";
                if (it = nt = !1, (g = null != r ? r && i.closest(r) : t("<div />")) && g.css("position", i.css("position")), rt = function () {
                    var n, t, e;
                    if (!b && (st = s.height(), n = parseInt(d.css("border-top-width"), 10), t = parseInt(d.css("padding-top"), 10), h = parseInt(d.css("padding-bottom"), 10), a = d.offset().top + n + t, v = d.height(), nt && (it = nt = !1, null == r && (i.insertAfter(g), g.detach()), i.css({
                        position: "",
                        top: "",
                        width: "",
                        bottom: ""
                    }).removeClass(f), e = !0), y = i.offset().top - (parseInt(i.css("margin-top"), 10) || 0) - u, p = i.outerHeight(!0), w = i.css("float"), g && g.css({
                        width: i.outerWidth(!0),
                        height: p,
                        display: i.css("display"),
                        "vertical-align": i.css("vertical-align"),
                        float: w
                    }), e)) return tt()
                }, rt(), p !== v) return et = void 0, k = u, ft = l, tt = function () {
                    var o, ut, t, tt;
                    if (!b && (t = !1, null != ft && (--ft, 0 >= ft && (ft = l, rt(), t = !0)), t || s.height() === st || rt(), t = n.scrollTop(), null != et && (ut = t - et), et = t, nt ? (e && (tt = t + p + k > v + a, it && !tt && (it = !1, i.css({
                        position: "fixed",
                        bottom: "",
                        top: k
                    }).trigger("sticky_kit:unbottom"))), t < y && (nt = !1, k = u, null == r && ("left" !== w && "right" !== w || i.insertAfter(g), g.detach()), o = {
                        position: "",
                        width: "",
                        top: ""
                    }, i.css(o).removeClass(f).trigger("sticky_kit:unstick")), c && (o = n.height(), p + u > o && !it && (k -= ut, k = Math.max(o - p, k), k = Math.min(u, k), nt && i.css({top: k + "px"})))) : t > y && (nt = !0, o = {
                        position: "fixed",
                        top: k
                    }, o.width = "border-box" === i.css("box-sizing") ? i.outerWidth() + "px" : i.width() + "px", i.css(o).addClass(f), null == r && (i.after(g), "left" !== w && "right" !== w || g.append(i)), i.trigger("sticky_kit:stick")), nt && e && (null == tt && (tt = t + p + k > v + a), !it && tt))) return it = !0, "static" === d.css("position") && d.css({position: "relative"}), i.css({
                        position: "absolute",
                        bottom: h,
                        top: "auto"
                    }).trigger("sticky_kit:bottom")
                }, ut = function () {
                    return rt(), tt()
                }, ot = function () {
                    return b = !0, n.off("touchmove", tt), n.off("scroll", tt), n.off("resize", ut), t(document.body).off("sticky_kit:recalc", ut), i.off("sticky_kit:detach", ot), i.removeData("sticky_kit"), i.css({
                        position: "",
                        bottom: "",
                        top: "",
                        width: ""
                    }), d.position("position", ""), nt ? (null == r && ("left" !== w && "right" !== w || i.insertAfter(g), g.remove()), i.removeClass(f)) : void 0
                }, n.on("touchmove", tt), n.on("scroll", tt), n.on("resize", ut), t(document.body).on("sticky_kit:recalc", ut), i.on("sticky_kit:detach", ot), setTimeout(tt, 0)
            }
        }, h = 0, v = this.length; h < v; h++) i = this[h], a(t(i));
        return this
    }
}.call(this);
/*! jQuery UI - v1.12.1 - 2018-05-24
* http://jqueryui.com
* Includes: widget.js, position.js, keycode.js, unique-id.js, widgets/autocomplete.js, widgets/menu.js
* Copyright jQuery Foundation and other contributors; Licensed MIT */
(function (n) {
    "function" == typeof define && define.amd ? define(["jquery"], n) : n(jQuery)
})(function (n) {
    n.ui = n.ui || {};
    n.ui.version = "1.12.1";
    var i = 0, t = Array.prototype.slice;
    n.cleanData = function (t) {
        return function (i) {
            for (var r, u, f = 0; null != (u = i[f]); f++) try {
                r = n._data(u, "events");
                r && r.remove && n(u).triggerHandler("remove")
            } catch (e) {
            }
            t(i)
        }
    }(n.cleanData);
    n.widget = function (t, i, r) {
        var f, u, o, h = {}, e = t.split(".")[0], s;
        return t = t.split(".")[1], s = e + "-" + t, r || (r = i, i = n.Widget), n.isArray(r) && (r = n.extend.apply(null, [{}].concat(r))), n.expr[":"][s.toLowerCase()] = function (t) {
            return !!n.data(t, s)
        }, n[e] = n[e] || {}, f = n[e][t], u = n[e][t] = function (n, t) {
            return this._createWidget ? (arguments.length && this._createWidget(n, t), void 0) : new u(n, t)
        }, n.extend(u, f, {
            version: r.version,
            _proto: n.extend({}, r),
            _childConstructors: []
        }), o = new i, o.options = n.widget.extend({}, o.options), n.each(r, function (t, r) {
            return n.isFunction(r) ? (h[t] = function () {
                function n() {
                    return i.prototype[t].apply(this, arguments)
                }

                function u(n) {
                    return i.prototype[t].apply(this, n)
                }

                return function () {
                    var t, i = this._super, f = this._superApply;
                    return this._super = n, this._superApply = u, t = r.apply(this, arguments), this._super = i, this._superApply = f, t
                }
            }(), void 0) : (h[t] = r, void 0)
        }), u.prototype = n.widget.extend(o, {widgetEventPrefix: f ? o.widgetEventPrefix || t : t}, h, {
            constructor: u,
            namespace: e,
            widgetName: t,
            widgetFullName: s
        }), f ? (n.each(f._childConstructors, function (t, i) {
            var r = i.prototype;
            n.widget(r.namespace + "." + r.widgetName, u, i._proto)
        }), delete f._childConstructors) : i._childConstructors.push(u), n.widget.bridge(t, u), u
    };
    n.widget.extend = function (i) {
        for (var r, u, e = t.call(arguments, 1), f = 0, o = e.length; o > f; f++) for (r in e[f]) u = e[f][r], e[f].hasOwnProperty(r) && void 0 !== u && (i[r] = n.isPlainObject(u) ? n.isPlainObject(i[r]) ? n.widget.extend({}, i[r], u) : n.widget.extend({}, u) : u);
        return i
    };
    n.widget.bridge = function (i, r) {
        var u = r.prototype.widgetFullName || i;
        n.fn[i] = function (f) {
            var s = "string" == typeof f, o = t.call(arguments, 1), e = this;
            return s ? this.length || "instance" !== f ? this.each(function () {
                var t, r = n.data(this, u);
                return "instance" === f ? (e = r, !1) : r ? n.isFunction(r[f]) && "_" !== f.charAt(0) ? (t = r[f].apply(r, o), t !== r && void 0 !== t ? (e = t && t.jquery ? e.pushStack(t.get()) : t, !1) : void 0) : n.error("no such method '" + f + "' for " + i + " widget instance") : n.error("cannot call methods on " + i + " prior to initialization; attempted to call method '" + f + "'")
            }) : e = void 0 : (o.length && (f = n.widget.extend.apply(null, [f].concat(o))), this.each(function () {
                var t = n.data(this, u);
                t ? (t.option(f || {}), t._init && t._init()) : n.data(this, u, new r(f, this))
            })), e
        }
    };
    n.Widget = function () {
    };
    n.Widget._childConstructors = [];
    n.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {classes: {}, disabled: !1, create: null},
        _createWidget: function (t, r) {
            r = n(r || this.defaultElement || this)[0];
            this.element = n(r);
            this.uuid = i++;
            this.eventNamespace = "." + this.widgetName + this.uuid;
            this.bindings = n();
            this.hoverable = n();
            this.focusable = n();
            this.classesElementLookup = {};
            r !== this && (n.data(r, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function (n) {
                    n.target === r && this.destroy()
                }
            }), this.document = n(r.style ? r.ownerDocument : r.document || r), this.window = n(this.document[0].defaultView || this.document[0].parentWindow));
            this.options = n.widget.extend({}, this.options, this._getCreateOptions(), t);
            this._create();
            this.options.disabled && this._setOptionDisabled(this.options.disabled);
            this._trigger("create", null, this._getCreateEventData());
            this._init()
        },
        _getCreateOptions: function () {
            return {}
        },
        _getCreateEventData: n.noop,
        _create: n.noop,
        _init: n.noop,
        destroy: function () {
            var t = this;
            this._destroy();
            n.each(this.classesElementLookup, function (n, i) {
                t._removeClass(i, n)
            });
            this.element.off(this.eventNamespace).removeData(this.widgetFullName);
            this.widget().off(this.eventNamespace).removeAttr("aria-disabled");
            this.bindings.off(this.eventNamespace)
        },
        _destroy: n.noop,
        widget: function () {
            return this.element
        },
        option: function (t, i) {
            var r, u, f, e = t;
            if (0 === arguments.length) return n.widget.extend({}, this.options);
            if ("string" == typeof t) if (e = {}, r = t.split("."), t = r.shift(), r.length) {
                for (u = e[t] = n.widget.extend({}, this.options[t]), f = 0; r.length - 1 > f; f++) u[r[f]] = u[r[f]] || {}, u = u[r[f]];
                if (t = r.pop(), 1 === arguments.length) return void 0 === u[t] ? null : u[t];
                u[t] = i
            } else {
                if (1 === arguments.length) return void 0 === this.options[t] ? null : this.options[t];
                e[t] = i
            }
            return this._setOptions(e), this
        },
        _setOptions: function (n) {
            for (var t in n) this._setOption(t, n[t]);
            return this
        },
        _setOption: function (n, t) {
            return "classes" === n && this._setOptionClasses(t), this.options[n] = t, "disabled" === n && this._setOptionDisabled(t), this
        },
        _setOptionClasses: function (t) {
            var i, u, r;
            for (i in t) r = this.classesElementLookup[i], t[i] !== this.options.classes[i] && r && r.length && (u = n(r.get()), this._removeClass(r, i), u.addClass(this._classes({
                element: u,
                keys: i,
                classes: t,
                add: !0
            })))
        },
        _setOptionDisabled: function (n) {
            this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !!n);
            n && (this._removeClass(this.hoverable, null, "ui-state-hover"), this._removeClass(this.focusable, null, "ui-state-focus"))
        },
        enable: function () {
            return this._setOptions({disabled: !1})
        },
        disable: function () {
            return this._setOptions({disabled: !0})
        },
        _classes: function (t) {
            function r(r, f) {
                for (var o, e = 0; r.length > e; e++) o = u.classesElementLookup[r[e]] || n(), o = t.add ? n(n.unique(o.get().concat(t.element.get()))) : n(o.not(t.element).get()), u.classesElementLookup[r[e]] = o, i.push(r[e]), f && t.classes[r[e]] && i.push(t.classes[r[e]])
            }

            var i = [], u = this;
            return t = n.extend({
                element: this.element,
                classes: this.options.classes || {}
            }, t), this._on(t.element, {remove: "_untrackClassesElement"}), t.keys && r(t.keys.match(/\S+/g) || [], !0), t.extra && r(t.extra.match(/\S+/g) || []), i.join(" ")
        },
        _untrackClassesElement: function (t) {
            var i = this;
            n.each(i.classesElementLookup, function (r, u) {
                -1 !== n.inArray(t.target, u) && (i.classesElementLookup[r] = n(u.not(t.target).get()))
            })
        },
        _removeClass: function (n, t, i) {
            return this._toggleClass(n, t, i, !1)
        },
        _addClass: function (n, t, i) {
            return this._toggleClass(n, t, i, !0)
        },
        _toggleClass: function (n, t, i, r) {
            r = "boolean" == typeof r ? r : i;
            var u = "string" == typeof n || null === n,
                f = {extra: u ? t : i, keys: u ? n : t, element: u ? this.element : n, add: r};
            return f.element.toggleClass(this._classes(f), r), this
        },
        _on: function (t, i, r) {
            var f, u = this;
            "boolean" != typeof t && (r = i, i = t, t = !1);
            r ? (i = f = n(i), this.bindings = this.bindings.add(i)) : (r = i, i = this.element, f = this.widget());
            n.each(r, function (r, e) {
                function o() {
                    if (t || u.options.disabled !== !0 && !n(this).hasClass("ui-state-disabled")) return ("string" == typeof e ? u[e] : e).apply(u, arguments)
                }

                "string" != typeof e && (o.guid = e.guid = e.guid || o.guid || n.guid++);
                var s = r.match(/^([\w:-]*)\s*(.*)$/), h = s[1] + u.eventNamespace, c = s[2];
                c ? f.on(h, c, o) : i.on(h, o)
            })
        },
        _off: function (t, i) {
            i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace;
            t.off(i).off(i);
            this.bindings = n(this.bindings.not(t).get());
            this.focusable = n(this.focusable.not(t).get());
            this.hoverable = n(this.hoverable.not(t).get())
        },
        _delay: function (n, t) {
            function r() {
                return ("string" == typeof n ? i[n] : n).apply(i, arguments)
            }

            var i = this;
            return setTimeout(r, t || 0)
        },
        _hoverable: function (t) {
            this.hoverable = this.hoverable.add(t);
            this._on(t, {
                mouseenter: function (t) {
                    this._addClass(n(t.currentTarget), null, "ui-state-hover")
                }, mouseleave: function (t) {
                    this._removeClass(n(t.currentTarget), null, "ui-state-hover")
                }
            })
        },
        _focusable: function (t) {
            this.focusable = this.focusable.add(t);
            this._on(t, {
                focusin: function (t) {
                    this._addClass(n(t.currentTarget), null, "ui-state-focus")
                }, focusout: function (t) {
                    this._removeClass(n(t.currentTarget), null, "ui-state-focus")
                }
            })
        },
        _trigger: function (t, i, r) {
            var u, f, e = this.options[t];
            if (r = r || {}, i = n.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), i.target = this.element[0], f = i.originalEvent) for (u in f) u in i || (i[u] = f[u]);
            return this.element.trigger(i, r), !(n.isFunction(e) && e.apply(this.element[0], [i].concat(r)) === !1 || i.isDefaultPrevented())
        }
    };
    n.each({show: "fadeIn", hide: "fadeOut"}, function (t, i) {
        n.Widget.prototype["_" + t] = function (r, u, f) {
            "string" == typeof u && (u = {effect: u});
            var o, e = u ? u === !0 || "number" == typeof u ? i : u.effect || i : t;
            u = u || {};
            "number" == typeof u && (u = {duration: u});
            o = !n.isEmptyObject(u);
            u.complete = f;
            u.delay && r.delay(u.delay);
            o && n.effects && n.effects.effect[e] ? r[t](u) : e !== t && r[e] ? r[e](u.duration, u.easing, f) : r.queue(function (i) {
                n(this)[t]();
                f && f.call(r[0]);
                i()
            })
        }
    });
    n.widget, function () {
        function f(n, t, i) {
            return [parseFloat(n[0]) * (c.test(n[0]) ? t / 100 : 1), parseFloat(n[1]) * (c.test(n[1]) ? i / 100 : 1)]
        }

        function i(t, i) {
            return parseInt(n.css(t, i), 10) || 0
        }

        function l(t) {
            var i = t[0];
            return 9 === i.nodeType ? {
                width: t.width(),
                height: t.height(),
                offset: {top: 0, left: 0}
            } : n.isWindow(i) ? {
                width: t.width(),
                height: t.height(),
                offset: {top: t.scrollTop(), left: t.scrollLeft()}
            } : i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {top: i.pageY, left: i.pageX}
            } : {width: t.outerWidth(), height: t.outerHeight(), offset: t.offset()}
        }

        var u, r = Math.max, t = Math.abs, e = /left|center|right/, o = /top|center|bottom/,
            s = /[\+\-]\d+(\.[\d]+)?%?/, h = /^\w+/, c = /%$/, a = n.fn.position;
        n.position = {
            scrollbarWidth: function () {
                if (void 0 !== u) return u;
                var r, i,
                    t = n("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'><\/div><\/div>"),
                    f = t.children()[0];
                return n("body").append(t), r = f.offsetWidth, t.css("overflow", "scroll"), i = f.offsetWidth, r === i && (i = t[0].clientWidth), t.remove(), u = r - i
            }, getScrollInfo: function (t) {
                var i = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"),
                    r = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"),
                    u = "scroll" === i || "auto" === i && t.width < t.element[0].scrollWidth,
                    f = "scroll" === r || "auto" === r && t.height < t.element[0].scrollHeight;
                return {width: f ? n.position.scrollbarWidth() : 0, height: u ? n.position.scrollbarWidth() : 0}
            }, getWithinInfo: function (t) {
                var i = n(t || window), r = n.isWindow(i[0]), u = !!i[0] && 9 === i[0].nodeType, f = !r && !u;
                return {
                    element: i,
                    isWindow: r,
                    isDocument: u,
                    offset: f ? n(t).offset() : {left: 0, top: 0},
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: i.outerWidth(),
                    height: i.outerHeight()
                }
            }
        };
        n.fn.position = function (u) {
            if (!u || !u.of) return a.apply(this, arguments);
            u = n.extend({}, u);
            var w, c, v, p, y, k, d = n(u.of), nt = n.position.getWithinInfo(u.within),
                tt = n.position.getScrollInfo(nt), b = (u.collision || "flip").split(" "), g = {};
            return k = l(d), d[0].preventDefault && (u.at = "left top"), c = k.width, v = k.height, p = k.offset, y = n.extend({}, p), n.each(["my", "at"], function () {
                var t, i, n = (u[this] || "").split(" ");
                1 === n.length && (n = e.test(n[0]) ? n.concat(["center"]) : o.test(n[0]) ? ["center"].concat(n) : ["center", "center"]);
                n[0] = e.test(n[0]) ? n[0] : "center";
                n[1] = o.test(n[1]) ? n[1] : "center";
                t = s.exec(n[0]);
                i = s.exec(n[1]);
                g[this] = [t ? t[0] : 0, i ? i[0] : 0];
                u[this] = [h.exec(n[0])[0], h.exec(n[1])[0]]
            }), 1 === b.length && (b[1] = b[0]), "right" === u.at[0] ? y.left += c : "center" === u.at[0] && (y.left += c / 2), "bottom" === u.at[1] ? y.top += v : "center" === u.at[1] && (y.top += v / 2), w = f(g.at, c, v), y.left += w[0], y.top += w[1], this.each(function () {
                var a, k, o = n(this), s = o.outerWidth(), h = o.outerHeight(), it = i(this, "marginLeft"),
                    rt = i(this, "marginTop"), ut = s + it + i(this, "marginRight") + tt.width,
                    ft = h + rt + i(this, "marginBottom") + tt.height, e = n.extend({}, y),
                    l = f(g.my, o.outerWidth(), o.outerHeight());
                "right" === u.my[0] ? e.left -= s : "center" === u.my[0] && (e.left -= s / 2);
                "bottom" === u.my[1] ? e.top -= h : "center" === u.my[1] && (e.top -= h / 2);
                e.left += l[0];
                e.top += l[1];
                a = {marginLeft: it, marginTop: rt};
                n.each(["left", "top"], function (t, i) {
                    n.ui.position[b[t]] && n.ui.position[b[t]][i](e, {
                        targetWidth: c,
                        targetHeight: v,
                        elemWidth: s,
                        elemHeight: h,
                        collisionPosition: a,
                        collisionWidth: ut,
                        collisionHeight: ft,
                        offset: [w[0] + l[0], w[1] + l[1]],
                        my: u.my,
                        at: u.at,
                        within: nt,
                        elem: o
                    })
                });
                u.using && (k = function (n) {
                    var i = p.left - e.left, a = i + c - s, f = p.top - e.top, y = f + v - h, l = {
                        target: {element: d, left: p.left, top: p.top, width: c, height: v},
                        element: {element: o, left: e.left, top: e.top, width: s, height: h},
                        horizontal: 0 > a ? "left" : i > 0 ? "right" : "center",
                        vertical: 0 > y ? "top" : f > 0 ? "bottom" : "middle"
                    };
                    s > c && c > t(i + a) && (l.horizontal = "center");
                    h > v && v > t(f + y) && (l.vertical = "middle");
                    l.important = r(t(i), t(a)) > r(t(f), t(y)) ? "horizontal" : "vertical";
                    u.using.call(this, n, l)
                });
                o.offset(n.extend(e, {using: k}))
            })
        };
        n.ui.position = {
            fit: {
                left: function (n, t) {
                    var h, e = t.within, u = e.isWindow ? e.scrollLeft : e.offset.left, o = e.width,
                        s = n.left - t.collisionPosition.marginLeft, i = u - s, f = s + t.collisionWidth - o - u;
                    t.collisionWidth > o ? i > 0 && 0 >= f ? (h = n.left + i + t.collisionWidth - o - u, n.left += i - h) : n.left = f > 0 && 0 >= i ? u : i > f ? u + o - t.collisionWidth : u : i > 0 ? n.left += i : f > 0 ? n.left -= f : n.left = r(n.left - s, n.left)
                }, top: function (n, t) {
                    var h, o = t.within, u = o.isWindow ? o.scrollTop : o.offset.top, e = t.within.height,
                        s = n.top - t.collisionPosition.marginTop, i = u - s, f = s + t.collisionHeight - e - u;
                    t.collisionHeight > e ? i > 0 && 0 >= f ? (h = n.top + i + t.collisionHeight - e - u, n.top += i - h) : n.top = f > 0 && 0 >= i ? u : i > f ? u + e - t.collisionHeight : u : i > 0 ? n.top += i : f > 0 ? n.top -= f : n.top = r(n.top - s, n.top)
                }
            }, flip: {
                left: function (n, i) {
                    var o, s, r = i.within, y = r.offset.left + r.scrollLeft, c = r.width,
                        h = r.isWindow ? r.scrollLeft : r.offset.left, l = n.left - i.collisionPosition.marginLeft,
                        a = l - h, v = l + i.collisionWidth - c - h,
                        u = "left" === i.my[0] ? -i.elemWidth : "right" === i.my[0] ? i.elemWidth : 0,
                        f = "left" === i.at[0] ? i.targetWidth : "right" === i.at[0] ? -i.targetWidth : 0,
                        e = -2 * i.offset[0];
                    0 > a ? (o = n.left + u + f + e + i.collisionWidth - c - y, (0 > o || t(a) > o) && (n.left += u + f + e)) : v > 0 && (s = n.left - i.collisionPosition.marginLeft + u + f + e - h, (s > 0 || v > t(s)) && (n.left += u + f + e))
                }, top: function (n, i) {
                    var o, s, r = i.within, y = r.offset.top + r.scrollTop, c = r.height,
                        h = r.isWindow ? r.scrollTop : r.offset.top, l = n.top - i.collisionPosition.marginTop,
                        a = l - h, v = l + i.collisionHeight - c - h, p = "top" === i.my[1],
                        u = p ? -i.elemHeight : "bottom" === i.my[1] ? i.elemHeight : 0,
                        f = "top" === i.at[1] ? i.targetHeight : "bottom" === i.at[1] ? -i.targetHeight : 0,
                        e = -2 * i.offset[1];
                    0 > a ? (s = n.top + u + f + e + i.collisionHeight - c - y, (0 > s || t(a) > s) && (n.top += u + f + e)) : v > 0 && (o = n.top - i.collisionPosition.marginTop + u + f + e - h, (o > 0 || v > t(o)) && (n.top += u + f + e))
                }
            }, flipfit: {
                left: function () {
                    n.ui.position.flip.left.apply(this, arguments);
                    n.ui.position.fit.left.apply(this, arguments)
                }, top: function () {
                    n.ui.position.flip.top.apply(this, arguments);
                    n.ui.position.fit.top.apply(this, arguments)
                }
            }
        }
    }();
    n.ui.position;
    n.ui.keyCode = {
        BACKSPACE: 8,
        COMMA: 188,
        DELETE: 46,
        DOWN: 40,
        END: 35,
        ENTER: 13,
        ESCAPE: 27,
        HOME: 36,
        LEFT: 37,
        PAGE_DOWN: 34,
        PAGE_UP: 33,
        PERIOD: 190,
        RIGHT: 39,
        SPACE: 32,
        TAB: 9,
        UP: 38
    };
    n.fn.extend({
        uniqueId: function () {
            var n = 0;
            return function () {
                return this.each(function () {
                    this.id || (this.id = "ui-id-" + ++n)
                })
            }
        }(), removeUniqueId: function () {
            return this.each(function () {
                /^ui-id-\d+$/.test(this.id) && n(this).removeAttr("id")
            })
        }
    });
    n.ui.safeActiveElement = function (n) {
        var t;
        try {
            t = n.activeElement
        } catch (i) {
            t = n.body
        }
        return t || (t = n.body), t.nodeName || (t = n.body), t
    };
    n.widget("ui.menu", {
        version: "1.12.1",
        defaultElement: "<ul>",
        delay: 300,
        options: {
            icons: {submenu: "ui-icon-caret-1-e"},
            items: "> *",
            menus: "ul",
            position: {my: "left top", at: "right top"},
            role: "menu",
            blur: null,
            focus: null,
            select: null
        },
        _create: function () {
            this.activeMenu = this.element;
            this.mouseHandled = !1;
            this.element.uniqueId().attr({role: this.options.role, tabIndex: 0});
            this._addClass("ui-menu", "ui-widget ui-widget-content");
            this._on({
                "mousedown .ui-menu-item": function (n) {
                    n.preventDefault()
                }, "click .ui-menu-item": function (t) {
                    var i = n(t.target), r = n(n.ui.safeActiveElement(this.document[0]));
                    !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(t), t.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(t) : !this.element.is(":focus") && r.closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                }, "mouseenter .ui-menu-item": function (t) {
                    if (!this.previousFilter) {
                        var r = n(t.target).closest(".ui-menu-item"), i = n(t.currentTarget);
                        r[0] === i[0] && (this._removeClass(i.siblings().children(".ui-state-active"), null, "ui-state-active"), this.focus(t, i))
                    }
                }, mouseleave: "collapseAll", "mouseleave .ui-menu": "collapseAll", focus: function (n, t) {
                    var i = this.active || this.element.find(this.options.items).eq(0);
                    t || this.focus(n, i)
                }, blur: function (t) {
                    this._delay(function () {
                        var i = !n.contains(this.element[0], n.ui.safeActiveElement(this.document[0]));
                        i && this.collapseAll(t)
                    })
                }, keydown: "_keydown"
            });
            this.refresh();
            this._on(this.document, {
                click: function (n) {
                    this._closeOnDocumentClick(n) && this.collapseAll(n);
                    this.mouseHandled = !1
                }
            })
        },
        _destroy: function () {
            var t = this.element.find(".ui-menu-item").removeAttr("role aria-disabled"),
                i = t.children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show();
            i.children().each(function () {
                var t = n(this);
                t.data("ui-menu-submenu-caret") && t.remove()
            })
        },
        _keydown: function (t) {
            var i, u, r, f, e = !0;
            switch (t.keyCode) {
                case n.ui.keyCode.PAGE_UP:
                    this.previousPage(t);
                    break;
                case n.ui.keyCode.PAGE_DOWN:
                    this.nextPage(t);
                    break;
                case n.ui.keyCode.HOME:
                    this._move("first", "first", t);
                    break;
                case n.ui.keyCode.END:
                    this._move("last", "last", t);
                    break;
                case n.ui.keyCode.UP:
                    this.previous(t);
                    break;
                case n.ui.keyCode.DOWN:
                    this.next(t);
                    break;
                case n.ui.keyCode.LEFT:
                    this.collapse(t);
                    break;
                case n.ui.keyCode.RIGHT:
                    this.active && !this.active.is(".ui-state-disabled") && this.expand(t);
                    break;
                case n.ui.keyCode.ENTER:
                case n.ui.keyCode.SPACE:
                    this._activate(t);
                    break;
                case n.ui.keyCode.ESCAPE:
                    this.collapse(t);
                    break;
                default:
                    e = !1;
                    u = this.previousFilter || "";
                    f = !1;
                    r = t.keyCode >= 96 && 105 >= t.keyCode ? "" + (t.keyCode - 96) : String.fromCharCode(t.keyCode);
                    clearTimeout(this.filterTimer);
                    r === u ? f = !0 : r = u + r;
                    i = this._filterMenuItems(r);
                    i = f && -1 !== i.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : i;
                    i.length || (r = String.fromCharCode(t.keyCode), i = this._filterMenuItems(r));
                    i.length ? (this.focus(t, i), this.previousFilter = r, this.filterTimer = this._delay(function () {
                        delete this.previousFilter
                    }, 1e3)) : delete this.previousFilter
            }
            e && t.preventDefault()
        },
        _activate: function (n) {
            this.active && !this.active.is(".ui-state-disabled") && (this.active.children("[aria-haspopup='true']").length ? this.expand(n) : this.select(n))
        },
        refresh: function () {
            var u, t, f, i, e, r = this, s = this.options.icons.submenu, o = this.element.find(this.options.menus);
            this._toggleClass("ui-menu-icons", null, !!this.element.find(".ui-icon").length);
            f = o.filter(":not(.ui-menu)").hide().attr({
                role: this.options.role,
                "aria-hidden": "true",
                "aria-expanded": "false"
            }).each(function () {
                var t = n(this), i = t.prev(), u = n("<span>").data("ui-menu-submenu-caret", !0);
                r._addClass(u, "ui-menu-icon", "ui-icon " + s);
                i.attr("aria-haspopup", "true").prepend(u);
                t.attr("aria-labelledby", i.attr("id"))
            });
            this._addClass(f, "ui-menu", "ui-widget ui-widget-content ui-front");
            u = o.add(this.element);
            t = u.find(this.options.items);
            t.not(".ui-menu-item").each(function () {
                var t = n(this);
                r._isDivider(t) && r._addClass(t, "ui-menu-divider", "ui-widget-content")
            });
            i = t.not(".ui-menu-item, .ui-menu-divider");
            e = i.children().not(".ui-menu").uniqueId().attr({tabIndex: -1, role: this._itemRole()});
            this._addClass(i, "ui-menu-item")._addClass(e, "ui-menu-item-wrapper");
            t.filter(".ui-state-disabled").attr("aria-disabled", "true");
            this.active && !n.contains(this.element[0], this.active[0]) && this.blur()
        },
        _itemRole: function () {
            return {menu: "menuitem", listbox: "option"}[this.options.role]
        },
        _setOption: function (n, t) {
            if ("icons" === n) {
                var i = this.element.find(".ui-menu-icon");
                this._removeClass(i, null, this.options.icons.submenu)._addClass(i, null, t.submenu)
            }
            this._super(n, t)
        },
        _setOptionDisabled: function (n) {
            this._super(n);
            this.element.attr("aria-disabled", n + "");
            this._toggleClass(null, "ui-state-disabled", !!n)
        },
        focus: function (n, t) {
            var i, r, u;
            this.blur(n, n && "focus" === n.type);
            this._scrollIntoView(t);
            this.active = t.first();
            r = this.active.children(".ui-menu-item-wrapper");
            this._addClass(r, null, "ui-state-active");
            this.options.role && this.element.attr("aria-activedescendant", r.attr("id"));
            u = this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper");
            this._addClass(u, null, "ui-state-active");
            n && "keydown" === n.type ? this._close() : this.timer = this._delay(function () {
                this._close()
            }, this.delay);
            i = t.children(".ui-menu");
            i.length && n && /^mouse/.test(n.type) && this._startOpening(i);
            this.activeMenu = t.parent();
            this._trigger("focus", n, {item: t})
        },
        _scrollIntoView: function (t) {
            var e, o, i, r, u, f;
            this._hasScroll() && (e = parseFloat(n.css(this.activeMenu[0], "borderTopWidth")) || 0, o = parseFloat(n.css(this.activeMenu[0], "paddingTop")) || 0, i = t.offset().top - this.activeMenu.offset().top - e - o, r = this.activeMenu.scrollTop(), u = this.activeMenu.height(), f = t.outerHeight(), 0 > i ? this.activeMenu.scrollTop(r + i) : i + f > u && this.activeMenu.scrollTop(r + i - u + f))
        },
        blur: function (n, t) {
            t || clearTimeout(this.timer);
            this.active && (this._removeClass(this.active.children(".ui-menu-item-wrapper"), null, "ui-state-active"), this._trigger("blur", n, {item: this.active}), this.active = null)
        },
        _startOpening: function (n) {
            clearTimeout(this.timer);
            "true" === n.attr("aria-hidden") && (this.timer = this._delay(function () {
                this._close();
                this._open(n)
            }, this.delay))
        },
        _open: function (t) {
            var i = n.extend({of: this.active}, this.options.position);
            clearTimeout(this.timer);
            this.element.find(".ui-menu").not(t.parents(".ui-menu")).hide().attr("aria-hidden", "true");
            t.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)
        },
        collapseAll: function (t, i) {
            clearTimeout(this.timer);
            this.timer = this._delay(function () {
                var r = i ? this.element : n(t && t.target).closest(this.element.find(".ui-menu"));
                r.length || (r = this.element);
                this._close(r);
                this.blur(t);
                this._removeClass(r.find(".ui-state-active"), null, "ui-state-active");
                this.activeMenu = r
            }, this.delay)
        },
        _close: function (n) {
            n || (n = this.active ? this.active.parent() : this.element);
            n.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false")
        },
        _closeOnDocumentClick: function (t) {
            return !n(t.target).closest(".ui-menu").length
        },
        _isDivider: function (n) {
            return !/[^\-\u2014\u2013\s]/.test(n.text())
        },
        collapse: function (n) {
            var t = this.active && this.active.parent().closest(".ui-menu-item", this.element);
            t && t.length && (this._close(), this.focus(n, t))
        },
        expand: function (n) {
            var t = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
            t && t.length && (this._open(t.parent()), this._delay(function () {
                this.focus(n, t)
            }))
        },
        next: function (n) {
            this._move("next", "first", n)
        },
        previous: function (n) {
            this._move("prev", "last", n)
        },
        isFirstItem: function () {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        },
        isLastItem: function () {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        },
        _move: function (n, t, i) {
            var r;
            this.active && (r = "first" === n || "last" === n ? this.active["first" === n ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[n + "All"](".ui-menu-item").eq(0));
            r && r.length && this.active || (r = this.activeMenu.find(this.options.items)[t]());
            this.focus(i, r)
        },
        nextPage: function (t) {
            var i, r, u;
            return this.active ? (this.isLastItem() || (this._hasScroll() ? (r = this.active.offset().top, u = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () {
                return i = n(this), 0 > i.offset().top - r - u
            }), this.focus(t, i)) : this.focus(t, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]())), void 0) : (this.next(t), void 0)
        },
        previousPage: function (t) {
            var i, r, u;
            return this.active ? (this.isFirstItem() || (this._hasScroll() ? (r = this.active.offset().top, u = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () {
                return i = n(this), i.offset().top - r + u > 0
            }), this.focus(t, i)) : this.focus(t, this.activeMenu.find(this.options.items).first())), void 0) : (this.next(t), void 0)
        },
        _hasScroll: function () {
            return this.element.outerHeight() < this.element.prop("scrollHeight")
        },
        select: function (t) {
            this.active = this.active || n(t.target).closest(".ui-menu-item");
            var i = {item: this.active};
            this.active.has(".ui-menu").length || this.collapseAll(t, !0);
            this._trigger("select", t, i)
        },
        _filterMenuItems: function (t) {
            var i = t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"), r = RegExp("^" + i, "i");
            return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function () {
                return r.test(n.trim(n(this).children(".ui-menu-item-wrapper").text()))
            })
        }
    });
    n.widget("ui.autocomplete", {
        version: "1.12.1",
        defaultElement: "<input>",
        options: {
            appendTo: null,
            autoFocus: !1,
            delay: 300,
            minLength: 1,
            position: {my: "left top", at: "left bottom", collision: "none"},
            source: null,
            change: null,
            close: null,
            focus: null,
            open: null,
            response: null,
            search: null,
            select: null
        },
        requestIndex: 0,
        pending: 0,
        _create: function () {
            var t, i, r, u = this.element[0].nodeName.toLowerCase(), f = "textarea" === u, e = "input" === u;
            this.isMultiLine = f || !e && this._isContentEditable(this.element);
            this.valueMethod = this.element[f || e ? "val" : "text"];
            this.isNewMenu = !0;
            this._addClass("ui-autocomplete-input");
            this.element.attr("autocomplete", "off");
            this._on(this.element, {
                keydown: function (u) {
                    if (this.element.prop("readOnly")) return t = !0, r = !0, i = !0, void 0;
                    t = !1;
                    r = !1;
                    i = !1;
                    var f = n.ui.keyCode;
                    switch (u.keyCode) {
                        case f.PAGE_UP:
                            t = !0;
                            this._move("previousPage", u);
                            break;
                        case f.PAGE_DOWN:
                            t = !0;
                            this._move("nextPage", u);
                            break;
                        case f.UP:
                            t = !0;
                            this._keyEvent("previous", u);
                            break;
                        case f.DOWN:
                            t = !0;
                            this._keyEvent("next", u);
                            break;
                        case f.ENTER:
                            this.menu.active && (t = !0, u.preventDefault(), this.menu.select(u));
                            break;
                        case f.TAB:
                            this.menu.active && this.menu.select(u);
                            break;
                        case f.ESCAPE:
                            this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(u), u.preventDefault());
                            break;
                        default:
                            i = !0;
                            this._searchTimeout(u)
                    }
                }, keypress: function (r) {
                    if (t) return t = !1, (!this.isMultiLine || this.menu.element.is(":visible")) && r.preventDefault(), void 0;
                    if (!i) {
                        var u = n.ui.keyCode;
                        switch (r.keyCode) {
                            case u.PAGE_UP:
                                this._move("previousPage", r);
                                break;
                            case u.PAGE_DOWN:
                                this._move("nextPage", r);
                                break;
                            case u.UP:
                                this._keyEvent("previous", r);
                                break;
                            case u.DOWN:
                                this._keyEvent("next", r)
                        }
                    }
                }, input: function (n) {
                    return r ? (r = !1, n.preventDefault(), void 0) : (this._searchTimeout(n), void 0)
                }, focus: function () {
                    this.selectedItem = null;
                    this.previous = this._value()
                }, blur: function (n) {
                    return this.cancelBlur ? (delete this.cancelBlur, void 0) : (clearTimeout(this.searching), this.close(n), this._change(n), void 0)
                }
            });
            this._initSource();
            this.menu = n("<ul>").appendTo(this._appendTo()).menu({role: null}).hide().menu("instance");
            this._addClass(this.menu.element, "ui-autocomplete", "ui-front");
            this._on(this.menu.element, {
                mousedown: function (t) {
                    t.preventDefault();
                    this.cancelBlur = !0;
                    this._delay(function () {
                        delete this.cancelBlur;
                        this.element[0] !== n.ui.safeActiveElement(this.document[0]) && this.element.trigger("focus")
                    })
                }, menufocus: function (t, i) {
                    var r, u;
                    return this.isNewMenu && (this.isNewMenu = !1, t.originalEvent && /^mouse/.test(t.originalEvent.type)) ? (this.menu.blur(), this.document.one("mousemove", function () {
                        n(t.target).trigger(t.originalEvent)
                    }), void 0) : (u = i.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", t, {item: u}) && t.originalEvent && /^key/.test(t.originalEvent.type) && this._value(u.value), r = i.item.attr("aria-label") || u.value, r && n.trim(r).length && (this.liveRegion.children().hide(), n("<div>").text(r).appendTo(this.liveRegion)), void 0)
                }, menuselect: function (t, i) {
                    var r = i.item.data("ui-autocomplete-item"), u = this.previous;
                    this.element[0] !== n.ui.safeActiveElement(this.document[0]) && (this.element.trigger("focus"), this.previous = u, this._delay(function () {
                        this.previous = u;
                        this.selectedItem = r
                    }));
                    !1 !== this._trigger("select", t, {item: r}) && this._value(r.value);
                    this.term = this._value();
                    this.close(t);
                    this.selectedItem = r
                }
            });
            this.liveRegion = n("<div>", {
                role: "status",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).appendTo(this.document[0].body);
            this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible");
            this._on(this.window, {
                beforeunload: function () {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _destroy: function () {
            clearTimeout(this.searching);
            this.element.removeAttr("autocomplete");
            this.menu.element.remove();
            this.liveRegion.remove()
        },
        _setOption: function (n, t) {
            this._super(n, t);
            "source" === n && this._initSource();
            "appendTo" === n && this.menu.element.appendTo(this._appendTo());
            "disabled" === n && t && this.xhr && this.xhr.abort()
        },
        _isEventTargetInWidget: function (t) {
            var i = this.menu.element[0];
            return t.target === this.element[0] || t.target === i || n.contains(i, t.target)
        },
        _closeOnClickOutside: function (n) {
            this._isEventTargetInWidget(n) || this.close()
        },
        _appendTo: function () {
            var t = this.options.appendTo;
            return t && (t = t.jquery || t.nodeType ? n(t) : this.document.find(t).eq(0)), t && t[0] || (t = this.element.closest(".ui-front, dialog")), t.length || (t = this.document[0].body), t
        },
        _initSource: function () {
            var i, r, t = this;
            n.isArray(this.options.source) ? (i = this.options.source, this.source = function (t, r) {
                r(n.ui.autocomplete.filter(i, t.term))
            }) : "string" == typeof this.options.source ? (r = this.options.source, this.source = function (i, u) {
                t.xhr && t.xhr.abort();
                t.xhr = n.ajax({
                    url: r, data: i, dataType: "json", success: function (n) {
                        u(n)
                    }, error: function () {
                        u([])
                    }
                })
            }) : this.source = this.options.source
        },
        _searchTimeout: function (n) {
            clearTimeout(this.searching);
            this.searching = this._delay(function () {
                var t = this.term === this._value(), i = this.menu.element.is(":visible"),
                    r = n.altKey || n.ctrlKey || n.metaKey || n.shiftKey;
                t && (!t || i || r) || (this.selectedItem = null, this.search(null, n))
            }, this.options.delay)
        },
        search: function (n, t) {
            return n = null != n ? n : this._value(), this.term = this._value(), n.length < this.options.minLength ? this.close(t) : this._trigger("search", t) !== !1 ? this._search(n) : void 0
        },
        _search: function (n) {
            this.pending++;
            this._addClass("ui-autocomplete-loading");
            this.cancelSearch = !1;
            this.source({term: n}, this._response())
        },
        _response: function () {
            var t = ++this.requestIndex;
            return n.proxy(function (n) {
                t === this.requestIndex && this.__response(n);
                this.pending--;
                this.pending || this._removeClass("ui-autocomplete-loading")
            }, this)
        },
        __response: function (n) {
            n && (n = this._normalize(n));
            this._trigger("response", null, {content: n});
            !this.options.disabled && n && n.length && !this.cancelSearch ? (this._suggest(n), this._trigger("open")) : this._close()
        },
        close: function (n) {
            this.cancelSearch = !0;
            this._close(n)
        },
        _close: function (n) {
            this._off(this.document, "mousedown");
            this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", n))
        },
        _change: function (n) {
            this.previous !== this._value() && this._trigger("change", n, {item: this.selectedItem})
        },
        _normalize: function (t) {
            return t.length && t[0].label && t[0].value ? t : n.map(t, function (t) {
                return "string" == typeof t ? {label: t, value: t} : n.extend({}, t, {
                    label: t.label || t.value,
                    value: t.value || t.label
                })
            })
        },
        _suggest: function (t) {
            var i = this.menu.element.empty();
            this._renderMenu(i, t);
            this.isNewMenu = !0;
            this.menu.refresh();
            i.show();
            this._resizeMenu();
            i.position(n.extend({of: this.element}, this.options.position));
            this.options.autoFocus && this.menu.next();
            this._on(this.document, {mousedown: "_closeOnClickOutside"})
        },
        _resizeMenu: function () {
            var n = this.menu.element;
            n.outerWidth(Math.max(n.width("").outerWidth() + 1, this.element.outerWidth()))
        },
        _renderMenu: function (t, i) {
            var r = this;
            n.each(i, function (n, i) {
                r._renderItemData(t, i)
            })
        },
        _renderItemData: function (n, t) {
            return this._renderItem(n, t).data("ui-autocomplete-item", t)
        },
        _renderItem: function (t, i) {
            return n("<li>").append(n("<div>").text(i.label)).appendTo(t)
        },
        _move: function (n, t) {
            return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(n) || this.menu.isLastItem() && /^next/.test(n) ? (this.isMultiLine || this._value(this.term), this.menu.blur(), void 0) : (this.menu[n](t), void 0) : (this.search(null, t), void 0)
        },
        widget: function () {
            return this.menu.element
        },
        _value: function () {
            return this.valueMethod.apply(this.element, arguments)
        },
        _keyEvent: function (n, t) {
            (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(n, t), t.preventDefault())
        },
        _isContentEditable: function (n) {
            if (!n.length) return !1;
            var t = n.prop("contentEditable");
            return "inherit" === t ? this._isContentEditable(n.parent()) : "true" === t
        }
    });
    n.extend(n.ui.autocomplete, {
        escapeRegex: function (n) {
            return n.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
        }, filter: function (t, i) {
            var r = RegExp(n.ui.autocomplete.escapeRegex(i), "i");
            return n.grep(t, function (n) {
                return r.test(n.label || n.value || n)
            })
        }
    });
    n.widget("ui.autocomplete", n.ui.autocomplete, {
        options: {
            messages: {
                noResults: "No search results.",
                results: function (n) {
                    return n + (n > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
                }
            }
        }, __response: function (t) {
            var i;
            this._superApply(arguments);
            this.options.disabled || this.cancelSearch || (i = t && t.length ? this.options.messages.results(t.length) : this.options.messages.noResults, this.liveRegion.children().hide(), n("<div>").text(i).appendTo(this.liveRegion))
        }
    });
    n.ui.autocomplete
}), function (n) {
    function t(t) {
        var f = n(this), r = null, u = [], e = null, o = null, i = n.extend({
            rowSelector: "> li",
            submenuSelector: "*",
            submenuDirection: "right",
            tolerance: 75,
            enter: n.noop,
            exit: n.noop,
            activate: n.noop,
            deactivate: n.noop,
            exitMenu: n.noop
        }, t), c = 3, l = 300, a = function (n) {
            u.push({x: n.pageX, y: n.pageY});
            u.length > c && u.shift()
        }, v = function () {
            o && clearTimeout(o);
            i.exitMenu(this) && (r && i.deactivate(r), r = null)
        }, y = function () {
            o && clearTimeout(o);
            i.enter(this);
            h(this)
        }, p = function () {
            i.exit(this)
        }, w = function () {
            s(this)
        }, s = function (n) {
            n != r && (r && i.deactivate(r), i.activate(n), r = n)
        }, h = function (n) {
            var t = b();
            t ? o = setTimeout(function () {
                h(n)
            }, t) : s(n)
        }, b = function () {
            function v(n, t) {
                return (t.y - n.y) / (t.x - n.x)
            }

            var h, c;
            if (!r || !n(r).is(i.submenuSelector)) return 0;
            var t = f.offset(), y = {x: t.left, y: t.top - i.tolerance}, w = {x: t.left + f.outerWidth(), y: y.y},
                p = {x: t.left, y: t.top + f.outerHeight() + i.tolerance}, a = {x: t.left + f.outerWidth(), y: p.y},
                s = u[u.length - 1], o = u[0];
            if (!s || (o || (o = s), o.x < t.left || o.x > a.x || o.y < t.top || o.y > a.y) || e && s.x == e.x && s.y == e.y) return 0;
            h = w;
            c = a;
            i.submenuDirection == "left" ? (h = p, c = y) : i.submenuDirection == "below" ? (h = a, c = p) : i.submenuDirection == "above" && (h = y, c = w);
            var b = v(s, h), k = v(s, c), d = v(o, h), g = v(o, c);
            return b < d && k > g ? (e = s, l) : (e = null, 0)
        };
        f.mouseleave(v).find(i.rowSelector).mouseenter(y).mouseleave(p).click(w);
        n(document).mousemove(a)
    }

    n.fn.menuAim = function (n) {
        return this.each(function () {
            t.call(this, n)
        }), this
    }
}(jQuery);
!function (n) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], n) : "undefined" != typeof exports ? module.exports = n(require("jquery")) : n(jQuery)
}(function (n) {
    "use strict";
    var t = window.Slick || {};
    (t = function () {
        var t = 0;
        return function (i, r) {
            var f, u = this;
            u.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: n(i),
                appendDots: n(i),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous<\/button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next<\/button>',
                autoplay: !1,
                autoplaySpeed: 3e3,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (t, i) {
                    return n('<button type="button" />').text(i + 1)
                },
                dots: !1,
                dotsClass: "slick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: .35,
                fade: !1,
                focusOnSelect: !1,
                focusOnChange: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnFocus: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !0,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3
            };
            u.initials = {
                animating: !1,
                dragging: !1,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                scrolling: !1,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: !1,
                slideOffset: 0,
                swipeLeft: null,
                swiping: !1,
                $list: null,
                touchObject: {},
                transformsEnabled: !1,
                unslicked: !1
            };
            n.extend(u, u.initials);
            u.activeBreakpoint = null;
            u.animType = null;
            u.animProp = null;
            u.breakpoints = [];
            u.breakpointSettings = [];
            u.cssTransitions = !1;
            u.focussed = !1;
            u.interrupted = !1;
            u.hidden = "hidden";
            u.paused = !0;
            u.positionProp = null;
            u.respondTo = null;
            u.rowCount = 1;
            u.shouldClick = !0;
            u.$slider = n(i);
            u.$slidesCache = null;
            u.transformType = null;
            u.transitionType = null;
            u.visibilityChange = "visibilitychange";
            u.windowWidth = 0;
            u.windowTimer = null;
            f = n(i).data("slick") || {};
            u.options = n.extend({}, u.defaults, r, f);
            u.currentSlide = u.options.initialSlide;
            u.originalSettings = u.options;
            void 0 !== document.mozHidden ? (u.hidden = "mozHidden", u.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (u.hidden = "webkitHidden", u.visibilityChange = "webkitvisibilitychange");
            u.autoPlay = n.proxy(u.autoPlay, u);
            u.autoPlayClear = n.proxy(u.autoPlayClear, u);
            u.autoPlayIterator = n.proxy(u.autoPlayIterator, u);
            u.changeSlide = n.proxy(u.changeSlide, u);
            u.clickHandler = n.proxy(u.clickHandler, u);
            u.selectHandler = n.proxy(u.selectHandler, u);
            u.setPosition = n.proxy(u.setPosition, u);
            u.swipeHandler = n.proxy(u.swipeHandler, u);
            u.dragHandler = n.proxy(u.dragHandler, u);
            u.keyHandler = n.proxy(u.keyHandler, u);
            u.instanceUid = t++;
            u.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;
            u.registerBreakpoints();
            u.init(!0)
        }
    }()).prototype.activateADA = function () {
        this.$slideTrack.find(".slick-active").attr({"aria-hidden": "false"}).find("a, input, button, select").attr({tabindex: "0"})
    };
    t.prototype.addSlide = t.prototype.slickAdd = function (t, i, r) {
        var u = this;
        if ("boolean" == typeof i) r = i, i = null; else if (i < 0 || i >= u.slideCount) return !1;
        u.unload();
        "number" == typeof i ? 0 === i && 0 === u.$slides.length ? n(t).appendTo(u.$slideTrack) : r ? n(t).insertBefore(u.$slides.eq(i)) : n(t).insertAfter(u.$slides.eq(i)) : !0 === r ? n(t).prependTo(u.$slideTrack) : n(t).appendTo(u.$slideTrack);
        u.$slides = u.$slideTrack.children(this.options.slide);
        u.$slideTrack.children(this.options.slide).detach();
        u.$slideTrack.append(u.$slides);
        u.$slides.each(function (t, i) {
            n(i).attr("data-slick-index", t)
        });
        u.$slidesCache = u.$slides;
        u.reinit()
    };
    t.prototype.animateHeight = function () {
        var n = this, t;
        1 === n.options.slidesToShow && !0 === n.options.adaptiveHeight && !1 === n.options.vertical && (t = n.$slides.eq(n.currentSlide).outerHeight(!0), n.$list.animate({height: t}, n.options.speed))
    };
    t.prototype.animateSlide = function (t, i) {
        var u = {}, r = this;
        r.animateHeight();
        !0 === r.options.rtl && !1 === r.options.vertical && (t = -t);
        !1 === r.transformsEnabled ? !1 === r.options.vertical ? r.$slideTrack.animate({left: t}, r.options.speed, r.options.easing, i) : r.$slideTrack.animate({top: t}, r.options.speed, r.options.easing, i) : !1 === r.cssTransitions ? (!0 === r.options.rtl && (r.currentLeft = -r.currentLeft), n({animStart: r.currentLeft}).animate({animStart: t}, {
            duration: r.options.speed,
            easing: r.options.easing,
            step: function (n) {
                n = Math.ceil(n);
                !1 === r.options.vertical ? (u[r.animType] = "translate(" + n + "px, 0px)", r.$slideTrack.css(u)) : (u[r.animType] = "translate(0px," + n + "px)", r.$slideTrack.css(u))
            },
            complete: function () {
                i && i.call()
            }
        })) : (r.applyTransition(), t = Math.ceil(t), u[r.animType] = !1 === r.options.vertical ? "translate3d(" + t + "px, 0px, 0px)" : "translate3d(0px," + t + "px, 0px)", r.$slideTrack.css(u), i && setTimeout(function () {
            r.disableTransition();
            i.call()
        }, r.options.speed))
    };
    t.prototype.getNavTarget = function () {
        var i = this, t = i.options.asNavFor;
        return t && null !== t && (t = n(t).not(i.$slider)), t
    };
    t.prototype.asNavFor = function (t) {
        var i = this.getNavTarget();
        null !== i && "object" == typeof i && i.each(function () {
            var i = n(this).slick("getSlick");
            i.unslicked || i.slideHandler(t, !0)
        })
    };
    t.prototype.applyTransition = function (n) {
        var t = this, i = {};
        i[t.transitionType] = !1 === t.options.fade ? t.transformType + " " + t.options.speed + "ms " + t.options.cssEase : "opacity " + t.options.speed + "ms " + t.options.cssEase;
        !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(n).css(i)
    };
    t.prototype.autoPlay = function () {
        var n = this;
        n.autoPlayClear();
        n.slideCount > n.options.slidesToShow && (n.autoPlayTimer = setInterval(n.autoPlayIterator, n.options.autoplaySpeed))
    };
    t.prototype.autoPlayClear = function () {
        var n = this;
        n.autoPlayTimer && clearInterval(n.autoPlayTimer)
    };
    t.prototype.autoPlayIterator = function () {
        var n = this, t = n.currentSlide + n.options.slidesToScroll;
        n.paused || n.interrupted || n.focussed || (!1 === n.options.infinite && (1 === n.direction && n.currentSlide + 1 === n.slideCount - 1 ? n.direction = 0 : 0 === n.direction && (t = n.currentSlide - n.options.slidesToScroll, n.currentSlide - 1 == 0 && (n.direction = 1))), n.slideHandler(t))
    };
    t.prototype.buildArrows = function () {
        var t = this;
        !0 === t.options.arrows && (t.$prevArrow = n(t.options.prevArrow).addClass("slick-arrow"), t.$nextArrow = n(t.options.nextArrow).addClass("slick-arrow"), t.slideCount > t.options.slidesToShow ? (t.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.prependTo(t.options.appendArrows), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.appendTo(t.options.appendArrows), !0 !== t.options.infinite && t.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : t.$prevArrow.add(t.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    };
    t.prototype.buildDots = function () {
        var i, r, t = this;
        if (!0 === t.options.dots) {
            for (t.$slider.addClass("slick-dotted"), r = n("<ul />").addClass(t.options.dotsClass), i = 0; i <= t.getDotCount(); i += 1) r.append(n("<li />").append(t.options.customPaging.call(this, t, i)));
            t.$dots = r.appendTo(t.options.appendDots);
            t.$dots.find("li").first().addClass("slick-active")
        }
    };
    t.prototype.buildOut = function () {
        var t = this;
        t.$slides = t.$slider.children(t.options.slide + ":not(.slick-cloned)").addClass("slick-slide");
        t.slideCount = t.$slides.length;
        t.$slides.each(function (t, i) {
            n(i).attr("data-slick-index", t).data("originalStyling", n(i).attr("style") || "")
        });
        t.$slider.addClass("slick-slider");
        t.$slideTrack = 0 === t.slideCount ? n('<div class="slick-track"/>').appendTo(t.$slider) : t.$slides.wrapAll('<div class="slick-track"/>').parent();
        t.$list = t.$slideTrack.wrap('<div class="slick-list"/>').parent();
        t.$slideTrack.css("opacity", 0);
        !0 !== t.options.centerMode && !0 !== t.options.swipeToSlide || (t.options.slidesToScroll = 1);
        n("img[data-lazy]", t.$slider).not("[src]").addClass("slick-loading");
        t.setupInfinite();
        t.buildArrows();
        t.buildDots();
        t.updateDots();
        t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0);
        !0 === t.options.draggable && t.$list.addClass("draggable")
    };
    t.prototype.buildRows = function () {
        var t, i, r, f, c, u, e, n = this, o, s, h;
        if (f = document.createDocumentFragment(), u = n.$slider.children(), n.options.rows > 1) {
            for (e = n.options.slidesPerRow * n.options.rows, c = Math.ceil(u.length / e), t = 0; t < c; t++) {
                for (o = document.createElement("div"), i = 0; i < n.options.rows; i++) {
                    for (s = document.createElement("div"), r = 0; r < n.options.slidesPerRow; r++) h = t * e + (i * n.options.slidesPerRow + r), u.get(h) && s.appendChild(u.get(h));
                    o.appendChild(s)
                }
                f.appendChild(o)
            }
            n.$slider.empty().append(f);
            n.$slider.children().children().children().css({
                width: 100 / n.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    };
    t.prototype.checkResponsive = function (t, i) {
        var f, u, e, r = this, o = !1, s = r.$slider.width(), h = window.innerWidth || n(window).width();
        if ("window" === r.respondTo ? e = h : "slider" === r.respondTo ? e = s : "min" === r.respondTo && (e = Math.min(h, s)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
            u = null;
            for (f in r.breakpoints) r.breakpoints.hasOwnProperty(f) && (!1 === r.originalSettings.mobileFirst ? e < r.breakpoints[f] && (u = r.breakpoints[f]) : e > r.breakpoints[f] && (u = r.breakpoints[f]));
            null !== u ? null !== r.activeBreakpoint ? (u !== r.activeBreakpoint || i) && (r.activeBreakpoint = u, "unslick" === r.breakpointSettings[u] ? r.unslick(u) : (r.options = n.extend({}, r.originalSettings, r.breakpointSettings[u]), !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t)), o = u) : (r.activeBreakpoint = u, "unslick" === r.breakpointSettings[u] ? r.unslick(u) : (r.options = n.extend({}, r.originalSettings, r.breakpointSettings[u]), !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t)), o = u) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t), o = u);
            t || !1 === o || r.$slider.trigger("breakpoint", [r, o])
        }
    };
    t.prototype.changeSlide = function (t, i) {
        var f, e, o, r = this, u = n(t.currentTarget), s;
        switch (u.is("a") && t.preventDefault(), u.is("li") || (u = u.closest("li")), o = r.slideCount % r.options.slidesToScroll != 0, f = o ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, t.data.message) {
            case"previous":
                e = 0 === f ? r.options.slidesToScroll : r.options.slidesToShow - f;
                r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - e, !1, i);
                break;
            case"next":
                e = 0 === f ? r.options.slidesToScroll : f;
                r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + e, !1, i);
                break;
            case"index":
                s = 0 === t.data.index ? 0 : t.data.index || u.index() * r.options.slidesToScroll;
                r.slideHandler(r.checkNavigable(s), !1, i);
                u.children().trigger("focus");
                break;
            default:
                return
        }
    };
    t.prototype.checkNavigable = function (n) {
        var t, i, r;
        if (t = this.getNavigableIndexes(), i = 0, n > t[t.length - 1]) n = t[t.length - 1]; else for (r in t) {
            if (n < t[r]) {
                n = i;
                break
            }
            i = t[r]
        }
        return n
    };
    t.prototype.cleanUpEvents = function () {
        var t = this;
        t.options.dots && null !== t.$dots && (n("li", t.$dots).off("click.slick", t.changeSlide).off("mouseenter.slick", n.proxy(t.interrupt, t, !0)).off("mouseleave.slick", n.proxy(t.interrupt, t, !1)), !0 === t.options.accessibility && t.$dots.off("keydown.slick", t.keyHandler));
        t.$slider.off("focus.slick blur.slick");
        !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow && t.$prevArrow.off("click.slick", t.changeSlide), t.$nextArrow && t.$nextArrow.off("click.slick", t.changeSlide), !0 === t.options.accessibility && (t.$prevArrow && t.$prevArrow.off("keydown.slick", t.keyHandler), t.$nextArrow && t.$nextArrow.off("keydown.slick", t.keyHandler)));
        t.$list.off("touchstart.slick mousedown.slick", t.swipeHandler);
        t.$list.off("touchmove.slick mousemove.slick", t.swipeHandler);
        t.$list.off("touchend.slick mouseup.slick", t.swipeHandler);
        t.$list.off("touchcancel.slick mouseleave.slick", t.swipeHandler);
        t.$list.off("click.slick", t.clickHandler);
        n(document).off(t.visibilityChange, t.visibility);
        t.cleanUpSlideEvents();
        !0 === t.options.accessibility && t.$list.off("keydown.slick", t.keyHandler);
        !0 === t.options.focusOnSelect && n(t.$slideTrack).children().off("click.slick", t.selectHandler);
        n(window).off("orientationchange.slick.slick-" + t.instanceUid, t.orientationChange);
        n(window).off("resize.slick.slick-" + t.instanceUid, t.resize);
        n("[draggable!=true]", t.$slideTrack).off("dragstart", t.preventDefault);
        n(window).off("load.slick.slick-" + t.instanceUid, t.setPosition)
    };
    t.prototype.cleanUpSlideEvents = function () {
        var t = this;
        t.$list.off("mouseenter.slick", n.proxy(t.interrupt, t, !0));
        t.$list.off("mouseleave.slick", n.proxy(t.interrupt, t, !1))
    };
    t.prototype.cleanUpRows = function () {
        var t, n = this;
        n.options.rows > 1 && ((t = n.$slides.children().children()).removeAttr("style"), n.$slider.empty().append(t))
    };
    t.prototype.clickHandler = function (n) {
        !1 === this.shouldClick && (n.stopImmediatePropagation(), n.stopPropagation(), n.preventDefault())
    };
    t.prototype.destroy = function (t) {
        var i = this;
        i.autoPlayClear();
        i.touchObject = {};
        i.cleanUpEvents();
        n(".slick-cloned", i.$slider).detach();
        i.$dots && i.$dots.remove();
        i.$prevArrow && i.$prevArrow.length && (i.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.prevArrow) && i.$prevArrow.remove());
        i.$nextArrow && i.$nextArrow.length && (i.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.nextArrow) && i.$nextArrow.remove());
        i.$slides && (i.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
            n(this).attr("style", n(this).data("originalStyling"))
        }), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.detach(), i.$list.detach(), i.$slider.append(i.$slides));
        i.cleanUpRows();
        i.$slider.removeClass("slick-slider");
        i.$slider.removeClass("slick-initialized");
        i.$slider.removeClass("slick-dotted");
        i.unslicked = !0;
        t || i.$slider.trigger("destroy", [i])
    };
    t.prototype.disableTransition = function (n) {
        var t = this, i = {};
        i[t.transitionType] = "";
        !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(n).css(i)
    };
    t.prototype.fadeSlide = function (n, t) {
        var i = this;
        !1 === i.cssTransitions ? (i.$slides.eq(n).css({zIndex: i.options.zIndex}), i.$slides.eq(n).animate({opacity: 1}, i.options.speed, i.options.easing, t)) : (i.applyTransition(n), i.$slides.eq(n).css({
            opacity: 1,
            zIndex: i.options.zIndex
        }), t && setTimeout(function () {
            i.disableTransition(n);
            t.call()
        }, i.options.speed))
    };
    t.prototype.fadeSlideOut = function (n) {
        var t = this;
        !1 === t.cssTransitions ? t.$slides.eq(n).animate({
            opacity: 0,
            zIndex: t.options.zIndex - 2
        }, t.options.speed, t.options.easing) : (t.applyTransition(n), t.$slides.eq(n).css({
            opacity: 0,
            zIndex: t.options.zIndex - 2
        }))
    };
    t.prototype.filterSlides = t.prototype.slickFilter = function (n) {
        var t = this;
        null !== n && (t.$slidesCache = t.$slides, t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.filter(n).appendTo(t.$slideTrack), t.reinit())
    };
    t.prototype.focusHandler = function () {
        var t = this;
        t.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function (i) {
            i.stopImmediatePropagation();
            var r = n(this);
            setTimeout(function () {
                t.options.pauseOnFocus && (t.focussed = r.is(":focus"), t.autoPlay())
            }, 0)
        })
    };
    t.prototype.getCurrent = t.prototype.slickCurrentSlide = function () {
        return this.currentSlide
    };
    t.prototype.getDotCount = function () {
        var n = this, i = 0, r = 0, t = 0;
        if (!0 === n.options.infinite) if (n.slideCount <= n.options.slidesToShow) ++t; else for (; i < n.slideCount;) ++t, i = r + n.options.slidesToScroll, r += n.options.slidesToScroll <= n.options.slidesToShow ? n.options.slidesToScroll : n.options.slidesToShow; else if (!0 === n.options.centerMode) t = n.slideCount; else if (n.options.asNavFor) for (; i < n.slideCount;) ++t, i = r + n.options.slidesToScroll, r += n.options.slidesToScroll <= n.options.slidesToShow ? n.options.slidesToScroll : n.options.slidesToShow; else t = 1 + Math.ceil((n.slideCount - n.options.slidesToShow) / n.options.slidesToScroll);
        return t - 1
    };
    t.prototype.getLeft = function (n) {
        var f, r, i, e, t = this, u = 0;
        return t.slideOffset = 0, r = t.$slides.first().outerHeight(!0), !0 === t.options.infinite ? (t.slideCount > t.options.slidesToShow && (t.slideOffset = t.slideWidth * t.options.slidesToShow * -1, e = -1, !0 === t.options.vertical && !0 === t.options.centerMode && (2 === t.options.slidesToShow ? e = -1.5 : 1 === t.options.slidesToShow && (e = -2)), u = r * t.options.slidesToShow * e), t.slideCount % t.options.slidesToScroll != 0 && n + t.options.slidesToScroll > t.slideCount && t.slideCount > t.options.slidesToShow && (n > t.slideCount ? (t.slideOffset = (t.options.slidesToShow - (n - t.slideCount)) * t.slideWidth * -1, u = (t.options.slidesToShow - (n - t.slideCount)) * r * -1) : (t.slideOffset = t.slideCount % t.options.slidesToScroll * t.slideWidth * -1, u = t.slideCount % t.options.slidesToScroll * r * -1))) : n + t.options.slidesToShow > t.slideCount && (t.slideOffset = (n + t.options.slidesToShow - t.slideCount) * t.slideWidth, u = (n + t.options.slidesToShow - t.slideCount) * r), t.slideCount <= t.options.slidesToShow && (t.slideOffset = 0, u = 0), !0 === t.options.centerMode && t.slideCount <= t.options.slidesToShow ? t.slideOffset = t.slideWidth * Math.floor(t.options.slidesToShow) / 2 - t.slideWidth * t.slideCount / 2 : !0 === t.options.centerMode && !0 === t.options.infinite ? t.slideOffset += t.slideWidth * Math.floor(t.options.slidesToShow / 2) - t.slideWidth : !0 === t.options.centerMode && (t.slideOffset = 0, t.slideOffset += t.slideWidth * Math.floor(t.options.slidesToShow / 2)), f = !1 === t.options.vertical ? n * t.slideWidth * -1 + t.slideOffset : n * r * -1 + u, !0 === t.options.variableWidth && (i = t.slideCount <= t.options.slidesToShow || !1 === t.options.infinite ? t.$slideTrack.children(".slick-slide").eq(n) : t.$slideTrack.children(".slick-slide").eq(n + t.options.slidesToShow), f = !0 === t.options.rtl ? i[0] ? -1 * (t.$slideTrack.width() - i[0].offsetLeft - i.width()) : 0 : i[0] ? -1 * i[0].offsetLeft : 0, !0 === t.options.centerMode && (i = t.slideCount <= t.options.slidesToShow || !1 === t.options.infinite ? t.$slideTrack.children(".slick-slide").eq(n) : t.$slideTrack.children(".slick-slide").eq(n + t.options.slidesToShow + 1), f = !0 === t.options.rtl ? i[0] ? -1 * (t.$slideTrack.width() - i[0].offsetLeft - i.width()) : 0 : i[0] ? -1 * i[0].offsetLeft : 0, f += (t.$list.width() - i.outerWidth()) / 2)), f
    };
    t.prototype.getOption = t.prototype.slickGetOption = function (n) {
        return this.options[n]
    };
    t.prototype.getNavigableIndexes = function () {
        var i, n = this, t = 0, r = 0, u = [];
        for (!1 === n.options.infinite ? i = n.slideCount : (t = -1 * n.options.slidesToScroll, r = -1 * n.options.slidesToScroll, i = 2 * n.slideCount); t < i;) u.push(t), t = r + n.options.slidesToScroll, r += n.options.slidesToScroll <= n.options.slidesToShow ? n.options.slidesToScroll : n.options.slidesToShow;
        return u
    };
    t.prototype.getSlick = function () {
        return this
    };
    t.prototype.getSlideCount = function () {
        var i, r, t = this;
        return r = !0 === t.options.centerMode ? t.slideWidth * Math.floor(t.options.slidesToShow / 2) : 0, !0 === t.options.swipeToSlide ? (t.$slideTrack.find(".slick-slide").each(function (u, f) {
            if (f.offsetLeft - r + n(f).outerWidth() / 2 > -1 * t.swipeLeft) return i = f, !1
        }), Math.abs(n(i).attr("data-slick-index") - t.currentSlide) || 1) : t.options.slidesToScroll
    };
    t.prototype.goTo = t.prototype.slickGoTo = function (n, t) {
        this.changeSlide({data: {message: "index", index: parseInt(n)}}, t)
    };
    t.prototype.init = function (t) {
        var i = this;
        n(i.$slider).hasClass("slick-initialized") || (n(i.$slider).addClass("slick-initialized"), i.buildRows(), i.buildOut(), i.setProps(), i.startLoad(), i.loadSlider(), i.initializeEvents(), i.updateArrows(), i.updateDots(), i.checkResponsive(!0), i.focusHandler());
        t && i.$slider.trigger("init", [i]);
        !0 === i.options.accessibility && i.initADA();
        i.options.autoplay && (i.paused = !1, i.autoPlay())
    };
    t.prototype.initADA = function () {
        var t = this, f = Math.ceil(t.slideCount / t.options.slidesToShow),
            r = t.getNavigableIndexes().filter(function (n) {
                return n >= 0 && n < t.slideCount
            }), i, u;
        for (t.$slides.add(t.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({tabindex: "-1"}), null !== t.$dots && (t.$slides.not(t.$slideTrack.find(".slick-cloned")).each(function (i) {
            var u = r.indexOf(i);
            n(this).attr({role: "tabpanel", id: "slick-slide" + t.instanceUid + i, tabindex: -1});
            -1 !== u && n(this).attr({"aria-describedby": "slick-slide-control" + t.instanceUid + u})
        }), t.$dots.attr("role", "tablist").find("li").each(function (i) {
            var u = r[i];
            n(this).attr({role: "presentation"});
            n(this).find("button").first().attr({
                role: "tab",
                id: "slick-slide-control" + t.instanceUid + i,
                "aria-controls": "slick-slide" + t.instanceUid + u,
                "aria-label": i + 1 + " of " + f,
                "aria-selected": null,
                tabindex: "-1"
            })
        }).eq(t.currentSlide).find("button").attr({
            "aria-selected": "true",
            tabindex: "0"
        }).end()), i = t.currentSlide, u = i + t.options.slidesToShow; i < u; i++) t.$slides.eq(i).attr("tabindex", 0);
        t.activateADA()
    };
    t.prototype.initArrowEvents = function () {
        var n = this;
        !0 === n.options.arrows && n.slideCount > n.options.slidesToShow && (n.$prevArrow.off("click.slick").on("click.slick", {message: "previous"}, n.changeSlide), n.$nextArrow.off("click.slick").on("click.slick", {message: "next"}, n.changeSlide), !0 === n.options.accessibility && (n.$prevArrow.on("keydown.slick", n.keyHandler), n.$nextArrow.on("keydown.slick", n.keyHandler)))
    };
    t.prototype.initDotEvents = function () {
        var t = this;
        !0 === t.options.dots && (n("li", t.$dots).on("click.slick", {message: "index"}, t.changeSlide), !0 === t.options.accessibility && t.$dots.on("keydown.slick", t.keyHandler));
        !0 === t.options.dots && !0 === t.options.pauseOnDotsHover && n("li", t.$dots).on("mouseenter.slick", n.proxy(t.interrupt, t, !0)).on("mouseleave.slick", n.proxy(t.interrupt, t, !1))
    };
    t.prototype.initSlideEvents = function () {
        var t = this;
        t.options.pauseOnHover && (t.$list.on("mouseenter.slick", n.proxy(t.interrupt, t, !0)), t.$list.on("mouseleave.slick", n.proxy(t.interrupt, t, !1)))
    };
    t.prototype.initializeEvents = function () {
        var t = this;
        t.initArrowEvents();
        t.initDotEvents();
        t.initSlideEvents();
        t.$list.on("touchstart.slick mousedown.slick", {action: "start"}, t.swipeHandler);
        t.$list.on("touchmove.slick mousemove.slick", {action: "move"}, t.swipeHandler);
        t.$list.on("touchend.slick mouseup.slick", {action: "end"}, t.swipeHandler);
        t.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, t.swipeHandler);
        t.$list.on("click.slick", t.clickHandler);
        n(document).on(t.visibilityChange, n.proxy(t.visibility, t));
        !0 === t.options.accessibility && t.$list.on("keydown.slick", t.keyHandler);
        !0 === t.options.focusOnSelect && n(t.$slideTrack).children().on("click.slick", t.selectHandler);
        n(window).on("orientationchange.slick.slick-" + t.instanceUid, n.proxy(t.orientationChange, t));
        n(window).on("resize.slick.slick-" + t.instanceUid, n.proxy(t.resize, t));
        n("[draggable!=true]", t.$slideTrack).on("dragstart", t.preventDefault);
        n(window).on("load.slick.slick-" + t.instanceUid, t.setPosition);
        n(t.setPosition)
    };
    t.prototype.initUI = function () {
        var n = this;
        !0 === n.options.arrows && n.slideCount > n.options.slidesToShow && (n.$prevArrow.show(), n.$nextArrow.show());
        !0 === n.options.dots && n.slideCount > n.options.slidesToShow && n.$dots.show()
    };
    t.prototype.keyHandler = function (n) {
        var t = this;
        n.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === n.keyCode && !0 === t.options.accessibility ? t.changeSlide({data: {message: !0 === t.options.rtl ? "next" : "previous"}}) : 39 === n.keyCode && !0 === t.options.accessibility && t.changeSlide({data: {message: !0 === t.options.rtl ? "previous" : "next"}}))
    };
    t.prototype.lazyLoad = function () {
        function f(i) {
            n("img[data-lazy]", i).each(function () {
                var i = n(this), r = n(this).attr("data-lazy"), f = n(this).attr("data-srcset"),
                    e = n(this).attr("data-sizes") || t.$slider.attr("data-sizes"), u = document.createElement("img");
                u.onload = function () {
                    i.animate({opacity: 0}, 100, function () {
                        f && (i.attr("srcset", f), e && i.attr("sizes", e));
                        i.attr("src", r).animate({opacity: 1}, 200, function () {
                            i.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                        });
                        t.$slider.trigger("lazyLoaded", [t, i, r])
                    })
                };
                u.onerror = function () {
                    i.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error");
                    t.$slider.trigger("lazyLoadError", [t, i, r])
                };
                u.src = r
            })
        }

        var u, i, r, t = this;
        if (!0 === t.options.centerMode ? !0 === t.options.infinite ? r = (i = t.currentSlide + (t.options.slidesToShow / 2 + 1)) + t.options.slidesToShow + 2 : (i = Math.max(0, t.currentSlide - (t.options.slidesToShow / 2 + 1)), r = t.options.slidesToShow / 2 + 1 + 2 + t.currentSlide) : (i = t.options.infinite ? t.options.slidesToShow + t.currentSlide : t.currentSlide, r = Math.ceil(i + t.options.slidesToShow), !0 === t.options.fade && (i > 0 && i--, r <= t.slideCount && r++)), u = t.$slider.find(".slick-slide").slice(i, r), "anticipated" === t.options.lazyLoad) for (var e = i - 1, o = r, s = t.$slider.find(".slick-slide"), h = 0; h < t.options.slidesToScroll; h++) e < 0 && (e = t.slideCount - 1), u = (u = u.add(s.eq(e))).add(s.eq(o)), e--, o++;
        f(u);
        t.slideCount <= t.options.slidesToShow ? f(t.$slider.find(".slick-slide")) : t.currentSlide >= t.slideCount - t.options.slidesToShow ? f(t.$slider.find(".slick-cloned").slice(0, t.options.slidesToShow)) : 0 === t.currentSlide && f(t.$slider.find(".slick-cloned").slice(-1 * t.options.slidesToShow))
    };
    t.prototype.loadSlider = function () {
        var n = this;
        n.setPosition();
        n.$slideTrack.css({opacity: 1});
        n.$slider.removeClass("slick-loading");
        n.initUI();
        "progressive" === n.options.lazyLoad && n.progressiveLazyLoad()
    };
    t.prototype.next = t.prototype.slickNext = function () {
        this.changeSlide({data: {message: "next"}})
    };
    t.prototype.orientationChange = function () {
        var n = this;
        n.checkResponsive();
        n.setPosition()
    };
    t.prototype.pause = t.prototype.slickPause = function () {
        var n = this;
        n.autoPlayClear();
        n.paused = !0
    };
    t.prototype.play = t.prototype.slickPlay = function () {
        var n = this;
        n.autoPlay();
        n.options.autoplay = !0;
        n.paused = !1;
        n.focussed = !1;
        n.interrupted = !1
    };
    t.prototype.postSlide = function (t) {
        var i = this;
        i.unslicked || (i.$slider.trigger("afterChange", [i, t]), i.animating = !1, i.slideCount > i.options.slidesToShow && i.setPosition(), i.swipeLeft = null, i.options.autoplay && i.autoPlay(), !0 === i.options.accessibility && (i.initADA(), i.options.focusOnChange && n(i.$slides.get(i.currentSlide)).attr("tabindex", 0).focus()))
    };
    t.prototype.prev = t.prototype.slickPrev = function () {
        this.changeSlide({data: {message: "previous"}})
    };
    t.prototype.preventDefault = function (n) {
        n.preventDefault()
    };
    t.prototype.progressiveLazyLoad = function (t) {
        t = t || 1;
        var r, u, f, e, o, i = this, s = n("img[data-lazy]", i.$slider);
        s.length ? (r = s.first(), u = r.attr("data-lazy"), f = r.attr("data-srcset"), e = r.attr("data-sizes") || i.$slider.attr("data-sizes"), (o = document.createElement("img")).onload = function () {
            f && (r.attr("srcset", f), e && r.attr("sizes", e));
            r.attr("src", u).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading");
            !0 === i.options.adaptiveHeight && i.setPosition();
            i.$slider.trigger("lazyLoaded", [i, r, u]);
            i.progressiveLazyLoad()
        }, o.onerror = function () {
            t < 3 ? setTimeout(function () {
                i.progressiveLazyLoad(t + 1)
            }, 500) : (r.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), i.$slider.trigger("lazyLoadError", [i, r, u]), i.progressiveLazyLoad())
        }, o.src = u) : i.$slider.trigger("allImagesLoaded", [i])
    };
    t.prototype.refresh = function (t) {
        var r, u, i = this;
        u = i.slideCount - i.options.slidesToShow;
        !i.options.infinite && i.currentSlide > u && (i.currentSlide = u);
        i.slideCount <= i.options.slidesToShow && (i.currentSlide = 0);
        r = i.currentSlide;
        i.destroy(!0);
        n.extend(i, i.initials, {currentSlide: r});
        i.init();
        t || i.changeSlide({data: {message: "index", index: r}}, !1)
    };
    t.prototype.registerBreakpoints = function () {
        var u, f, i, t = this, r = t.options.responsive || null;
        if ("array" === n.type(r) && r.length) {
            t.respondTo = t.options.respondTo || "window";
            for (u in r) if (i = t.breakpoints.length - 1, r.hasOwnProperty(u)) {
                for (f = r[u].breakpoint; i >= 0;) t.breakpoints[i] && t.breakpoints[i] === f && t.breakpoints.splice(i, 1), i--;
                t.breakpoints.push(f);
                t.breakpointSettings[f] = r[u].settings
            }
            t.breakpoints.sort(function (n, i) {
                return t.options.mobileFirst ? n - i : i - n
            })
        }
    };
    t.prototype.reinit = function () {
        var t = this;
        t.$slides = t.$slideTrack.children(t.options.slide).addClass("slick-slide");
        t.slideCount = t.$slides.length;
        t.currentSlide >= t.slideCount && 0 !== t.currentSlide && (t.currentSlide = t.currentSlide - t.options.slidesToScroll);
        t.slideCount <= t.options.slidesToShow && (t.currentSlide = 0);
        t.registerBreakpoints();
        t.setProps();
        t.setupInfinite();
        t.buildArrows();
        t.updateArrows();
        t.initArrowEvents();
        t.buildDots();
        t.updateDots();
        t.initDotEvents();
        t.cleanUpSlideEvents();
        t.initSlideEvents();
        t.checkResponsive(!1, !0);
        !0 === t.options.focusOnSelect && n(t.$slideTrack).children().on("click.slick", t.selectHandler);
        t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0);
        t.setPosition();
        t.focusHandler();
        t.paused = !t.options.autoplay;
        t.autoPlay();
        t.$slider.trigger("reInit", [t])
    };
    t.prototype.resize = function () {
        var t = this;
        n(window).width() !== t.windowWidth && (clearTimeout(t.windowDelay), t.windowDelay = window.setTimeout(function () {
            t.windowWidth = n(window).width();
            t.checkResponsive();
            t.unslicked || t.setPosition()
        }, 50))
    };
    t.prototype.removeSlide = t.prototype.slickRemove = function (n, t, i) {
        var r = this;
        if (n = "boolean" == typeof n ? !0 === (t = n) ? 0 : r.slideCount - 1 : !0 === t ? --n : n, r.slideCount < 1 || n < 0 || n > r.slideCount - 1) return !1;
        r.unload();
        !0 === i ? r.$slideTrack.children().remove() : r.$slideTrack.children(this.options.slide).eq(n).remove();
        r.$slides = r.$slideTrack.children(this.options.slide);
        r.$slideTrack.children(this.options.slide).detach();
        r.$slideTrack.append(r.$slides);
        r.$slidesCache = r.$slides;
        r.reinit()
    };
    t.prototype.setCSS = function (n) {
        var r, u, t = this, i = {};
        !0 === t.options.rtl && (n = -n);
        r = "left" == t.positionProp ? Math.ceil(n) + "px" : "0px";
        u = "top" == t.positionProp ? Math.ceil(n) + "px" : "0px";
        i[t.positionProp] = n;
        !1 === t.transformsEnabled ? t.$slideTrack.css(i) : (i = {}, !1 === t.cssTransitions ? (i[t.animType] = "translate(" + r + ", " + u + ")", t.$slideTrack.css(i)) : (i[t.animType] = "translate3d(" + r + ", " + u + ", 0px)", t.$slideTrack.css(i)))
    };
    t.prototype.setDimensions = function () {
        var n = this, t;
        !1 === n.options.vertical ? !0 === n.options.centerMode && n.$list.css({padding: "0px " + n.options.centerPadding}) : (n.$list.height(n.$slides.first().outerHeight(!0) * n.options.slidesToShow), !0 === n.options.centerMode && n.$list.css({padding: n.options.centerPadding + " 0px"}));
        n.listWidth = n.$list.width();
        n.listHeight = n.$list.height();
        !1 === n.options.vertical && !1 === n.options.variableWidth ? (n.slideWidth = Math.ceil(n.listWidth / n.options.slidesToShow), n.$slideTrack.width(Math.ceil(n.slideWidth * n.$slideTrack.children(".slick-slide").length))) : !0 === n.options.variableWidth ? n.$slideTrack.width(5e3 * n.slideCount) : (n.slideWidth = Math.ceil(n.listWidth), n.$slideTrack.height(Math.ceil(n.$slides.first().outerHeight(!0) * n.$slideTrack.children(".slick-slide").length)));
        t = n.$slides.first().outerWidth(!0) - n.$slides.first().width();
        !1 === n.options.variableWidth && n.$slideTrack.children(".slick-slide").width(n.slideWidth - t)
    };
    t.prototype.setFade = function () {
        var i, t = this;
        t.$slides.each(function (r, u) {
            i = t.slideWidth * r * -1;
            !0 === t.options.rtl ? n(u).css({
                position: "relative",
                right: i,
                top: 0,
                zIndex: t.options.zIndex - 2,
                opacity: 0
            }) : n(u).css({position: "relative", left: i, top: 0, zIndex: t.options.zIndex - 2, opacity: 0})
        });
        t.$slides.eq(t.currentSlide).css({zIndex: t.options.zIndex - 1, opacity: 1})
    };
    t.prototype.setHeight = function () {
        var n = this, t;
        1 === n.options.slidesToShow && !0 === n.options.adaptiveHeight && !1 === n.options.vertical && (t = n.$slides.eq(n.currentSlide).outerHeight(!0), n.$list.css("height", t))
    };
    t.prototype.setOption = t.prototype.slickSetOption = function () {
        var u, f, e, i, r, t = this, o = !1;
        if ("object" === n.type(arguments[0]) ? (e = arguments[0], o = arguments[1], r = "multiple") : "string" === n.type(arguments[0]) && (e = arguments[0], i = arguments[1], o = arguments[2], "responsive" === arguments[0] && "array" === n.type(arguments[1]) ? r = "responsive" : void 0 !== arguments[1] && (r = "single")), "single" === r) t.options[e] = i; else if ("multiple" === r) n.each(e, function (n, i) {
            t.options[n] = i
        }); else if ("responsive" === r) for (f in i) if ("array" !== n.type(t.options.responsive)) t.options.responsive = [i[f]]; else {
            for (u = t.options.responsive.length - 1; u >= 0;) t.options.responsive[u].breakpoint === i[f].breakpoint && t.options.responsive.splice(u, 1), u--;
            t.options.responsive.push(i[f])
        }
        o && (t.unload(), t.reinit())
    };
    t.prototype.setPosition = function () {
        var n = this;
        n.setDimensions();
        n.setHeight();
        !1 === n.options.fade ? n.setCSS(n.getLeft(n.currentSlide)) : n.setFade();
        n.$slider.trigger("setPosition", [n])
    };
    t.prototype.setProps = function () {
        var n = this, t = document.body.style;
        n.positionProp = !0 === n.options.vertical ? "top" : "left";
        "top" === n.positionProp ? n.$slider.addClass("slick-vertical") : n.$slider.removeClass("slick-vertical");
        void 0 === t.WebkitTransition && void 0 === t.MozTransition && void 0 === t.msTransition || !0 === n.options.useCSS && (n.cssTransitions = !0);
        n.options.fade && ("number" == typeof n.options.zIndex ? n.options.zIndex < 3 && (n.options.zIndex = 3) : n.options.zIndex = n.defaults.zIndex);
        void 0 !== t.OTransform && (n.animType = "OTransform", n.transformType = "-o-transform", n.transitionType = "OTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (n.animType = !1));
        void 0 !== t.MozTransform && (n.animType = "MozTransform", n.transformType = "-moz-transform", n.transitionType = "MozTransition", void 0 === t.perspectiveProperty && void 0 === t.MozPerspective && (n.animType = !1));
        void 0 !== t.webkitTransform && (n.animType = "webkitTransform", n.transformType = "-webkit-transform", n.transitionType = "webkitTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (n.animType = !1));
        void 0 !== t.msTransform && (n.animType = "msTransform", n.transformType = "-ms-transform", n.transitionType = "msTransition", void 0 === t.msTransform && (n.animType = !1));
        void 0 !== t.transform && !1 !== n.animType && (n.animType = "transform", n.transformType = "transform", n.transitionType = "transition");
        n.transformsEnabled = n.options.useTransform && null !== n.animType && !1 !== n.animType
    };
    t.prototype.setSlideClasses = function (n) {
        var u, i, r, f, t = this, e;
        (i = t.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), t.$slides.eq(n).addClass("slick-current"), !0 === t.options.centerMode) ? (e = t.options.slidesToShow % 2 == 0 ? 1 : 0, u = Math.floor(t.options.slidesToShow / 2), !0 === t.options.infinite && (n >= u && n <= t.slideCount - 1 - u ? t.$slides.slice(n - u + e, n + u + 1).addClass("slick-active").attr("aria-hidden", "false") : (r = t.options.slidesToShow + n, i.slice(r - u + 1 + e, r + u + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === n ? i.eq(i.length - 1 - t.options.slidesToShow).addClass("slick-center") : n === t.slideCount - 1 && i.eq(t.options.slidesToShow).addClass("slick-center")), t.$slides.eq(n).addClass("slick-center")) : n >= 0 && n <= t.slideCount - t.options.slidesToShow ? t.$slides.slice(n, n + t.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : i.length <= t.options.slidesToShow ? i.addClass("slick-active").attr("aria-hidden", "false") : (f = t.slideCount % t.options.slidesToShow, r = !0 === t.options.infinite ? t.options.slidesToShow + n : n, t.options.slidesToShow == t.options.slidesToScroll && t.slideCount - n < t.options.slidesToShow ? i.slice(r - (t.options.slidesToShow - f), r + f).addClass("slick-active").attr("aria-hidden", "false") : i.slice(r, r + t.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
        "ondemand" !== t.options.lazyLoad && "anticipated" !== t.options.lazyLoad || t.lazyLoad()
    };
    t.prototype.setupInfinite = function () {
        var i, r, u, t = this;
        if (!0 === t.options.fade && (t.options.centerMode = !1), !0 === t.options.infinite && !1 === t.options.fade && (r = null, t.slideCount > t.options.slidesToShow)) {
            for (u = !0 === t.options.centerMode ? t.options.slidesToShow + 1 : t.options.slidesToShow, i = t.slideCount; i > t.slideCount - u; i -= 1) r = i - 1, n(t.$slides[r]).clone(!0).attr("id", "").attr("data-slick-index", r - t.slideCount).prependTo(t.$slideTrack).addClass("slick-cloned");
            for (i = 0; i < u + t.slideCount; i += 1) r = i, n(t.$slides[r]).clone(!0).attr("id", "").attr("data-slick-index", r + t.slideCount).appendTo(t.$slideTrack).addClass("slick-cloned");
            t.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
                n(this).attr("id", "")
            })
        }
    };
    t.prototype.interrupt = function (n) {
        var t = this;
        n || t.autoPlay();
        t.interrupted = n
    };
    t.prototype.selectHandler = function (t) {
        var i = this, u = n(t.target).is(".slick-slide") ? n(t.target) : n(t.target).parents(".slick-slide"),
            r = parseInt(u.attr("data-slick-index"));
        r || (r = 0);
        i.slideCount <= i.options.slidesToShow ? i.slideHandler(r, !1, !0) : i.slideHandler(r)
    };
    t.prototype.slideHandler = function (n, t, i) {
        var u, f, s, e, o, h = null, r = this;
        if (t = t || !1, !(!0 === r.animating && !0 === r.options.waitForAnimate || !0 === r.options.fade && r.currentSlide === n)) if (!1 === t && r.asNavFor(n), u = n, h = r.getLeft(u), e = r.getLeft(r.currentSlide), r.currentLeft = null === r.swipeLeft ? e : r.swipeLeft, !1 === r.options.infinite && !1 === r.options.centerMode && (n < 0 || n > r.getDotCount() * r.options.slidesToScroll)) !1 === r.options.fade && (u = r.currentSlide, !0 !== i ? r.animateSlide(e, function () {
            r.postSlide(u)
        }) : r.postSlide(u)); else if (!1 === r.options.infinite && !0 === r.options.centerMode && (n < 0 || n > r.slideCount - r.options.slidesToScroll)) !1 === r.options.fade && (u = r.currentSlide, !0 !== i ? r.animateSlide(e, function () {
            r.postSlide(u)
        }) : r.postSlide(u)); else {
            if (r.options.autoplay && clearInterval(r.autoPlayTimer), f = u < 0 ? r.slideCount % r.options.slidesToScroll != 0 ? r.slideCount - r.slideCount % r.options.slidesToScroll : r.slideCount + u : u >= r.slideCount ? r.slideCount % r.options.slidesToScroll != 0 ? 0 : u - r.slideCount : u, r.animating = !0, r.$slider.trigger("beforeChange", [r, r.currentSlide, f]), s = r.currentSlide, r.currentSlide = f, r.setSlideClasses(r.currentSlide), r.options.asNavFor && (o = (o = r.getNavTarget()).slick("getSlick")).slideCount <= o.options.slidesToShow && o.setSlideClasses(r.currentSlide), r.updateDots(), r.updateArrows(), !0 === r.options.fade) return !0 !== i ? (r.fadeSlideOut(s), r.fadeSlide(f, function () {
                r.postSlide(f)
            })) : r.postSlide(f), void r.animateHeight();
            !0 !== i ? r.animateSlide(h, function () {
                r.postSlide(f)
            }) : r.postSlide(f)
        }
    };
    t.prototype.startLoad = function () {
        var n = this;
        !0 === n.options.arrows && n.slideCount > n.options.slidesToShow && (n.$prevArrow.hide(), n.$nextArrow.hide());
        !0 === n.options.dots && n.slideCount > n.options.slidesToShow && n.$dots.hide();
        n.$slider.addClass("slick-loading")
    };
    t.prototype.swipeDirection = function () {
        var i, r, u, n, t = this;
        return i = t.touchObject.startX - t.touchObject.curX, r = t.touchObject.startY - t.touchObject.curY, u = Math.atan2(r, i), (n = Math.round(180 * u / Math.PI)) < 0 && (n = 360 - Math.abs(n)), n <= 45 && n >= 0 ? !1 === t.options.rtl ? "left" : "right" : n <= 360 && n >= 315 ? !1 === t.options.rtl ? "left" : "right" : n >= 135 && n <= 225 ? !1 === t.options.rtl ? "right" : "left" : !0 === t.options.verticalSwiping ? n >= 35 && n <= 135 ? "down" : "up" : "vertical"
    };
    t.prototype.swipeEnd = function () {
        var t, i, n = this;
        if (n.dragging = !1, n.swiping = !1, n.scrolling) return n.scrolling = !1, !1;
        if (n.interrupted = !1, n.shouldClick = !(n.touchObject.swipeLength > 10), void 0 === n.touchObject.curX) return !1;
        if (!0 === n.touchObject.edgeHit && n.$slider.trigger("edge", [n, n.swipeDirection()]), n.touchObject.swipeLength >= n.touchObject.minSwipe) {
            switch (i = n.swipeDirection()) {
                case"left":
                case"down":
                    t = n.options.swipeToSlide ? n.checkNavigable(n.currentSlide + n.getSlideCount()) : n.currentSlide + n.getSlideCount();
                    n.currentDirection = 0;
                    break;
                case"right":
                case"up":
                    t = n.options.swipeToSlide ? n.checkNavigable(n.currentSlide - n.getSlideCount()) : n.currentSlide - n.getSlideCount();
                    n.currentDirection = 1
            }
            "vertical" != i && (n.slideHandler(t), n.touchObject = {}, n.$slider.trigger("swipe", [n, i]))
        } else n.touchObject.startX !== n.touchObject.curX && (n.slideHandler(n.currentSlide), n.touchObject = {})
    };
    t.prototype.swipeHandler = function (n) {
        var t = this;
        if (!(!1 === t.options.swipe || "ontouchend" in document && !1 === t.options.swipe || !1 === t.options.draggable && -1 !== n.type.indexOf("mouse"))) switch (t.touchObject.fingerCount = n.originalEvent && void 0 !== n.originalEvent.touches ? n.originalEvent.touches.length : 1, t.touchObject.minSwipe = t.listWidth / t.options.touchThreshold, !0 === t.options.verticalSwiping && (t.touchObject.minSwipe = t.listHeight / t.options.touchThreshold), n.data.action) {
            case"start":
                t.swipeStart(n);
                break;
            case"move":
                t.swipeMove(n);
                break;
            case"end":
                t.swipeEnd(n)
        }
    };
    t.prototype.swipeMove = function (n) {
        var f, e, r, u, i, o, t = this;
        return i = void 0 !== n.originalEvent ? n.originalEvent.touches : null, !(!t.dragging || t.scrolling || i && 1 !== i.length) && (f = t.getLeft(t.currentSlide), t.touchObject.curX = void 0 !== i ? i[0].pageX : n.clientX, t.touchObject.curY = void 0 !== i ? i[0].pageY : n.clientY, t.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(t.touchObject.curX - t.touchObject.startX, 2))), o = Math.round(Math.sqrt(Math.pow(t.touchObject.curY - t.touchObject.startY, 2))), !t.options.verticalSwiping && !t.swiping && o > 4 ? (t.scrolling = !0, !1) : (!0 === t.options.verticalSwiping && (t.touchObject.swipeLength = o), e = t.swipeDirection(), void 0 !== n.originalEvent && t.touchObject.swipeLength > 4 && (t.swiping = !0, n.preventDefault()), u = (!1 === t.options.rtl ? 1 : -1) * (t.touchObject.curX > t.touchObject.startX ? 1 : -1), !0 === t.options.verticalSwiping && (u = t.touchObject.curY > t.touchObject.startY ? 1 : -1), r = t.touchObject.swipeLength, t.touchObject.edgeHit = !1, !1 === t.options.infinite && (0 === t.currentSlide && "right" === e || t.currentSlide >= t.getDotCount() && "left" === e) && (r = t.touchObject.swipeLength * t.options.edgeFriction, t.touchObject.edgeHit = !0), t.swipeLeft = !1 === t.options.vertical ? f + r * u : f + r * (t.$list.height() / t.listWidth) * u, !0 === t.options.verticalSwiping && (t.swipeLeft = f + r * u), !0 !== t.options.fade && !1 !== t.options.touchMove && (!0 === t.animating ? (t.swipeLeft = null, !1) : void t.setCSS(t.swipeLeft))))
    };
    t.prototype.swipeStart = function (n) {
        var i, t = this;
        if (t.interrupted = !0, 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow) return t.touchObject = {}, !1;
        void 0 !== n.originalEvent && void 0 !== n.originalEvent.touches && (i = n.originalEvent.touches[0]);
        t.touchObject.startX = t.touchObject.curX = void 0 !== i ? i.pageX : n.clientX;
        t.touchObject.startY = t.touchObject.curY = void 0 !== i ? i.pageY : n.clientY;
        t.dragging = !0
    };
    t.prototype.unfilterSlides = t.prototype.slickUnfilter = function () {
        var n = this;
        null !== n.$slidesCache && (n.unload(), n.$slideTrack.children(this.options.slide).detach(), n.$slidesCache.appendTo(n.$slideTrack), n.reinit())
    };
    t.prototype.unload = function () {
        var t = this;
        n(".slick-cloned", t.$slider).remove();
        t.$dots && t.$dots.remove();
        t.$prevArrow && t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove();
        t.$nextArrow && t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove();
        t.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    };
    t.prototype.unslick = function (n) {
        var t = this;
        t.$slider.trigger("unslick", [t, n]);
        t.destroy()
    };
    t.prototype.updateArrows = function () {
        var n = this;
        Math.floor(n.options.slidesToShow / 2);
        !0 === n.options.arrows && n.slideCount > n.options.slidesToShow && !n.options.infinite && (n.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), n.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === n.currentSlide ? (n.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), n.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : n.currentSlide >= n.slideCount - n.options.slidesToShow && !1 === n.options.centerMode ? (n.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), n.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : n.currentSlide >= n.slideCount - 1 && !0 === n.options.centerMode && (n.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), n.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    };
    t.prototype.updateDots = function () {
        var n = this;
        null !== n.$dots && (n.$dots.find("li").removeClass("slick-active").end(), n.$dots.find("li").eq(Math.floor(n.currentSlide / n.options.slidesToScroll)).addClass("slick-active"))
    };
    t.prototype.visibility = function () {
        var n = this;
        n.options.autoplay && (n.interrupted = document[n.hidden] ? !0 : !1)
    };
    n.fn.slick = function () {
        for (var u, i = this, r = arguments[0], f = Array.prototype.slice.call(arguments, 1), e = i.length, n = 0; n < e; n++) if ("object" == typeof r || void 0 === r ? i[n].slick = new t(i[n], r) : u = i[n].slick[r].apply(i[n].slick, f), void 0 !== u) return u;
        return i
    }
});
slice = [].slice, function (n, t) {
    var i;
    return t.Starrr = i = function () {
        function t(t, i) {
            if (this.options = n.extend({}, this.defaults, i), this.$el = t, this.createStars(), this.syncRating(), !this.options.readOnly) {
                this.$el.on("mouseover.starrr", "a", function (n) {
                    return function (t) {
                        return n.syncRating(n.getStars().index(t.currentTarget) + 1)
                    }
                }(this));
                this.$el.on("mouseout.starrr", function (n) {
                    return function () {
                        return n.syncRating()
                    }
                }(this));
                this.$el.on("click.starrr", "a", function (n) {
                    return function (t) {
                        return t.preventDefault(), n.setRating(n.getStars().index(t.currentTarget) + 1)
                    }
                }(this));
                this.$el.on("starrr:change", this.options.change)
            }
        }

        return t.prototype.defaults = {
            rating: void 0,
            max: 5,
            readOnly: !1,
            emptyClass: "fa fa-star-o",
            fullClass: "fa fa-star",
            change: function () {
            }
        }, t.prototype.getStars = function () {
            return this.$el.find("a")
        }, t.prototype.createStars = function () {
            var n, t, i;
            for (i = [], n = 1, t = this.options.max; 1 <= t ? n <= t : n >= t; 1 <= t ? n++ : n--) i.push(this.$el.append("<a href='#' />"));
            return i
        }, t.prototype.setRating = function (n) {
            return this.options.rating === n && (n = void 0), this.options.rating = n, this.syncRating(), this.$el.trigger("starrr:change", n)
        }, t.prototype.getRating = function () {
            return this.options.rating
        }, t.prototype.syncRating = function (n) {
            var f, t, i, r, u;
            for (n || (n = this.options.rating), f = this.getStars(), u = [], t = i = 1, r = this.options.max; 1 <= r ? i <= r : i >= r; t = 1 <= r ? ++i : --i) u.push(f.eq(t - 1).removeClass(n >= t ? this.options.emptyClass : this.options.fullClass).addClass(n >= t ? this.options.fullClass : this.options.emptyClass));
            return u
        }, t
    }(), n.fn.extend({
        starrr: function () {
            var r, t;
            return t = arguments[0], r = 2 <= arguments.length ? slice.call(arguments, 1) : [], this.each(function () {
                var u;
                return u = n(this).data("starrr"), u || n(this).data("starrr", u = new i(n(this), t)), typeof t == "string" ? u[t].apply(u, r) : void 0
            })
        }
    })
}(window.jQuery, window);
/*!
 * JavaScript Cookie v2.2.0
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
(function (n) {
    var t = !1, r, i;
    typeof define == "function" && define.amd && (define(n), t = !0);
    typeof exports == "object" && (module.exports = n(), t = !0);
    t || (r = window.Cookies, i = window.Cookies = n(), i.noConflict = function () {
        return window.Cookies = r, i
    })
})(function () {
    function n() {
        for (var n = 0, r = {}, t, i; n < arguments.length; n++) {
            t = arguments[n];
            for (i in t) r[i] = t[i]
        }
        return r
    }

    function t(i) {
        function r(t, u, f) {
            var o, c, l, s, v, e, h;
            if (typeof document != "undefined") {
                if (arguments.length > 1) {
                    f = n({path: "/"}, r.defaults, f);
                    typeof f.expires == "number" && (c = new Date, c.setMilliseconds(c.getMilliseconds() + f.expires * 864e5), f.expires = c);
                    f.expires = f.expires ? f.expires.toUTCString() : "";
                    try {
                        o = JSON.stringify(u);
                        /^[\{\[]/.test(o) && (u = o)
                    } catch (w) {
                    }
                    u = i.write ? i.write(u, t) : encodeURIComponent(String(u)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
                    t = encodeURIComponent(String(t));
                    t = t.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
                    t = t.replace(/[\(\)]/g, escape);
                    l = "";
                    for (s in f) f[s] && (l += "; " + s, f[s] !== !0) && (l += "=" + f[s]);
                    return document.cookie = t + "=" + u + l
                }
                t || (o = {});
                for (var y = document.cookie ? document.cookie.split("; ") : [], p = /(%[0-9A-Z]{2})+/g, a = 0; a < y.length; a++) {
                    v = y[a].split("=");
                    e = v.slice(1).join("=");
                    this.json || e.charAt(0) !== '"' || (e = e.slice(1, -1));
                    try {
                        if (h = v[0].replace(p, decodeURIComponent), e = i.read ? i.read(e, h) : i(e, h) || e.replace(p, decodeURIComponent), this.json) try {
                            e = JSON.parse(e)
                        } catch (w) {
                        }
                        if (t === h) {
                            o = e;
                            break
                        }
                        t || (o[h] = e)
                    } catch (w) {
                    }
                }
                return o
            }
        }

        return r.set = r, r.get = function (n) {
            return r.call(r, n)
        }, r.getJSON = function () {
            return r.apply({json: !0}, [].slice.call(arguments))
        }, r.defaults = {}, r.remove = function (t, i) {
            r(t, "", n(i, {expires: -1}))
        }, r.withConverter = t, r
    }

    return t(function () {
    })
});
/*!
 * The Final Countdown for jQuery v2.0.4 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2014 Edson Hilios
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
!function (n) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], n) : n(jQuery)
}(function (n) {
    "use strict";

    function f(n) {
        if (n instanceof Date) return n;
        if (String(n).match(t)) return String(n).match(/^[0-9]*$/) && (n = Number(n)), String(n).match(/\-/) && (n = String(n).replace(/\-/g, "/")), new Date(n);
        throw new Error("Couldn't cast `" + n + "` to a date object.");
    }

    function e(n) {
        return function (t) {
            var e = t.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi), f, s;
            if (e) for (f = 0, s = e.length; s > f; ++f) {
                var r = e[f].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/), c = new RegExp(r[0]), h = r[1] || "",
                    l = r[3] || "", i = null;
                r = r[2];
                u.hasOwnProperty(r) && (i = u[r], i = Number(n[i]));
                null !== i && ("!" === h && (i = o(l, i)), "" === h && 10 > i && (i = "0" + i.toString()), t = t.replace(c, i.toString()))
            }
            return t.replace(/%%/, "%")
        }
    }

    function o(n, t) {
        var i = "s", r = "";
        return n && (n = n.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === n.length ? i = n[0] : (r = n[0], i = n[1])), 1 === Math.abs(t) ? r : i
    }

    var s = 100, i = [], t = [], u, r;
    t.push(/^[0-9]*$/.source);
    t.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    t.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    t = new RegExp(t.join("|"));
    u = {Y: "years", m: "months", w: "weeks", d: "days", D: "totalDays", H: "hours", M: "minutes", S: "seconds"};
    r = function (t, r, u) {
        this.el = t;
        this.$el = n(t);
        this.interval = null;
        this.offset = {};
        this.instanceNumber = i.length;
        i.push(this);
        this.$el.data("countdown-instance", this.instanceNumber);
        u && (this.$el.on("update.countdown", u), this.$el.on("stoped.countdown", u), this.$el.on("finish.countdown", u));
        this.setFinalDate(r);
        this.start()
    };
    n.extend(r.prototype, {
        start: function () {
            null !== this.interval && clearInterval(this.interval);
            var n = this;
            this.update();
            this.interval = setInterval(function () {
                n.update.call(n)
            }, s)
        }, stop: function () {
            clearInterval(this.interval);
            this.interval = null;
            this.dispatchEvent("stoped")
        }, pause: function () {
            this.stop.call(this)
        }, resume: function () {
            this.start.call(this)
        }, remove: function () {
            this.stop();
            i[this.instanceNumber] = null;
            delete this.$el.data().countdownInstance
        }, setFinalDate: function (n) {
            this.finalDate = f(n)
        }, update: function () {
            return 0 === this.$el.closest("html").length ? void this.remove() : (this.totalSecsLeft = this.finalDate.getTime() - (new Date).getTime(), this.totalSecsLeft = Math.ceil(this.totalSecsLeft / 1e3), this.totalSecsLeft = this.totalSecsLeft < 0 ? 0 : this.totalSecsLeft, this.offset = {
                seconds: this.totalSecsLeft % 60,
                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                hours: Math.floor(this.totalSecsLeft / 3600) % 24,
                days: Math.floor(this.totalSecsLeft / 86400) % 7,
                totalDays: Math.floor(this.totalSecsLeft / 86400),
                weeks: Math.floor(this.totalSecsLeft / 604800),
                months: Math.floor(this.totalSecsLeft / 2592e3),
                years: Math.floor(this.totalSecsLeft / 31536e3)
            }, void(0 === this.totalSecsLeft ? (this.stop(), this.dispatchEvent("finish")) : this.dispatchEvent("update")))
        }, dispatchEvent: function (t) {
            var i = n.Event(t + ".countdown");
            i.finalDate = this.finalDate;
            i.offset = n.extend({}, this.offset);
            i.strftime = e(this.offset);
            this.$el.trigger(i)
        }
    });
    n.fn.countdown = function () {
        var t = Array.prototype.slice.call(arguments, 0);
        return this.each(function () {
            var e = n(this).data("countdown-instance"), u, f;
            void 0 !== e ? (u = i[e], f = t[0], r.prototype.hasOwnProperty(f) ? u[f].apply(u, t.slice(1)) : null === String(f).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? (u.setFinalDate.call(u, f), u.start()) : n.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, f))) : new r(this, t[0], t[1])
        })
    }
});
$(function () {
    var i = $(window), n = $("body"), b = $("<div class='overlay'><\/div>").appendTo("body"),
        ft = $(".searchBox form #q"), c, l, v, et, k, d, g, u, nt, ot, tt, y, a, st, bt, kt, dt, it, ct, f, t, vt, r,
        yt, pt, rt, p, ut, w;
    if (ft.length > 0) try {
        ft.autocomplete({
            delay: 600, source: function (n, t) {
                $.get("/s/", {q: n.term, count: 3, datatype: "json"}, function (n) {
                    var i = [];
                    $.each(n.Taxonomies, function (n, t) {
                        var r = {
                            Name: t.Name,
                            Type: "Taxonomy",
                            Slug: t.Url,
                            ThumbnailUrl: t.ThumbnailUrl,
                            TotalViews: "Chuyên mục"
                        };
                        i.push(r)
                    });
                    $.each(n.Posts, function (n, t) {
                        var r = {
                            Name: t.Name,
                            Type: t.Type,
                            Slug: t.Url,
                            ThumbnailUrl: t.ThumbnailUrl,
                            TotalViews: t.TotalViews > 1 ? t.TotalViews.toLocaleString() : ""
                        };
                        i.push(r)
                    });
                    t($.map(i, function (n) {
                        return {
                            label: n.Name,
                            value: n.Name,
                            slug: n.Slug,
                            image: n.ThumbnailUrl,
                            view: n.TotalViews,
                            type: n.Type
                        }
                    }))
                }, "json")
            }, minLength: 2, select: function (n, t) {
                window.location = t.item.slug
            }, open: function () {
                navigator.userAgent.match(/(iPod|iPhone|iPad)/) && $(".ui-autocomplete").off("menufocus hover mouseover")
            }
        }).autocomplete("instance")._renderItem = function (n, t) {
            return $("<li>").append("<a class='clearfix type-" + (t.type + "").toLowerCase() + "' href='" + t.slug + "'>" + (t.image == "null" || t.image == "" || t.image == null ? "<img src='https://i.vietnamdoc.net/data/image/Icon/2018/cources-size-32x32-znd.png' />" : "<span class='imgSearch'><img src='" + t.image + "' /><\/span>") + "<span class='titleSearch'>" + t.label + "<\/span><span class='viewSearch'>" + t.view.toLocaleString() + "<\/span><\/a>").appendTo(n)
        }
    } catch (wt) {
        console && $.isFunction(console.log) && console.log(wt.message)
    }
    if (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent)) {
        $(".searchBox form").append("<a class='iconClear'><\/a>");
        $(".searchBox #q").keyup(function () {
            var n = $(this);
            $(".iconClear").toggle(Boolean(n.val()))
        });
        $(".iconClear").hide($("#q").val());
        $(".iconClear").click(function () {
            $("#q").val("").focus();
            $(this).hide()
        });
        $(".searchBox #q").on("focus click", function () {
            $("#q").val().length > 0 && $(".iconClear").css("display", "inline")
        })
    }
    if ($(".textview>table").each(function () {
        var n = $(this);
        n.width() > $(".textview").width() && n.wrap('<div class="blockbox"><\/div>')
    }), $(".mainNav .item.all").hover(function () {
        $(".overlay").addClass("show")
    }, function () {
        $(".theme .overlay").removeClass("show")
    }), $("body").append("<a id='scrolltop'><\/a>"), $("#scrolltop").click(function (n) {
        $("html, body").animate({scrollTop: 0}, 1e3);
        n.preventDefault()
    }), $(".mainNav .navigation").load("/post/mainnavigation .navbar .navigation>li", function () {
        var r, t, n;
        i.width() >= 728 && (r = $(".navigation"), t = $(".navigation ul"), r.menuAim({
            activate: function (n) {
                $(n).addClass("hover");
                t.css({width: i.width() - 317});
                i.width() < 1299 && t.css({width: i.width() - 301})
            }, deactivate: function (n) {
                $(n).removeClass("hover")
            }, enter: function () {
                this.activate()
            }, exitMenu: function () {
                return !0
            }
        }), $("li .hover ul").mouseover(function () {
            $(this).addClass("active")
        }), $("li .hover ul").mouseleave(function () {
            $(this).removeClass("active")
        }));
        i.width() < 728 && ($(".navigation>li>ul").parent().prepend('<i class="icon-navigation"><\/i>'), $(".icon-navigation").click(function () {
            var n, t, i;
            $(this).parent().hasClass("active") ? $(this).parent().removeClass("active") : ($(this).parent().addClass("active"), n = $(this).parent(), n.has("ul") && (t = $(".header").height(), i = n.position().top + t, $(".mainNav").animate({scrollTop: i}, 1e3)))
        }), $(".navigation").length > 0 && (n = $(".breadcrumbs>.breadcrumb:eq(1)>a").attr("href"), typeof n == "undefined" && $(".breadcrumbs a").length > 0 && (n = location.pathname), console.log(n), $(".navigation>li a[href*='" + n + "']").parents("li").addClass("active")))
    }), c = parseInt($("[data-itemid][data-itemtype='post']").attr("data-itemid")), c > 0 && (typeof $.fn.starrr == "function" && $(".rating[data-rating]").starrr({
        rating: $(".rating").attr("data-rating"),
        change: function (n, t) {
            parseInt(t) > 0 && ($.post("/service/rate", {
                postid: c,
                value: t
            }), alert("Cám ơn bạn đã đánh giá " + t + " sao"))
        }
    }), $(".section.postbox[data-itemid]").length > 0 && $.post("/service/track", {
        postid: c,
        type: "Views"
    }, function (n) {
        console.log(n)
    }), $("a[data-downurl]").click(function (n) {
        var t = $(this);
        window.open(t.attr("data-downurl"));
        $.post("/service/track", {postid: c, type: "Downloads"});
        setTimeout(function () {
            location.href = t.attr("href")
        }, 1e3);
        n.preventDefault()
    })), typeof $.fn.slick == "function" && $(".slider>.slides").slick({
        dots: !0,
        autoplay: !0,
        arrows: !0,
        autoplaySpeed: 2e3,
        pauseOnFocus: !1,
        pauseOnHover: !0,
        pauseOnDotsHover: !1,
        variableWidth: !0
    }), $(".toc-navbar").length > 0 && ($(".tocbox .toc-navbar>li.collapse.priority").length > 0 && $(".tocbox .toc-navbar>li.collapse.priority").addClass("show").parents(".tocbox li.collapse").addClass("show"), $(".toc-navbar>li.collapse a,.toc-navbar>li.collapse .icon-collapse").click(function () {
        var t = $(".toc-navbar"), n = $(this).parent();
        n.has("ul") && (n.toggleClass("show"), n.find("li").removeClass("hide"))
    }), $(".sidenav.toc .toc-navbar").length > 0 && ($(".toc-navbar a[href*='" + location.pathname + "']").parents("li.collapse").addClass("show") && $(".sidenav.toc a[href*='" + location.pathname + "']").addClass("active"), l = $(".toc-navbar"), v = $(".toc-navbar .collapse.show a.active"), v.length > 0 && v.has("ul") && (et = l.scrollTop() + v.position().top - l.position().top - l.height() / 2, l.animate({scrollTop: et})))), $(".taxbox-six .container .list-level-first").parent().addClass("collapse-six"), $(".collapse-six").prepend('<i class="toggle-six"><\/i>'), $(".toggle-six").click(function (n) {
        n.preventDefault();
        $(this).parents(".taxbox-six").toggleClass("close-six")
    }), $(".taxbox-five .container .list-items").parent().addClass("collapse-five"), $(".collapse-five").prepend('<i class="toggle-five"><\/i>'), $(".toggle-five").click(function (n) {
        n.preventDefault();
        $(this).parents(".taxbox-five").toggleClass("close-five")
    }), $(".theme.seven").length > 0 && $('<a class="btn btn-down btn-edit" title="Chỉnh sửa trực tuyến nội dung để in luôn">Sửa để in<\/a>').appendTo(".maincontent>.downbox").click(function () {
        window.open(location.pathname + "?theme=edit")
    }), $(".sidenav.toc").length > 0 && (k = function () {
        var n, t, i;
        $(".toc-navbar li:not(.notfound)").removeClass("hide show");
        $(".toc-navbar a[href*='" + location.pathname + "']").parents("li.collapse").addClass("show") && $(".sidenav.toc a[href*='" + location.pathname + "']").addClass("active");
        n = $(".toc-navbar");
        t = $(".toc-navbar .collapse.show a.active");
        t.length > 0 && t.has("ul") && (i = n.scrollTop() + t.position().top - n.position().top - n.height() / 2, n.animate({scrollTop: i}))
    }, $(".sidenav.toc .toc-head").append('<span class="toggle-list"><\/span>'), $(".toggle-list").click(function (t) {
        n.removeClass("showuser");
        n.removeClass("open-sidenav");
        n.toggleClass("close-sidenav");
        t.preventDefault()
    }), $(".toc-navbar li a").length > 0)) {
        d = $(".toc-navbar .active").parent().next().children("a[href]");
        g = $(".toc-navbar .active").parent().prev().children("a[href]");
        d.length > 0 && (u = $('<div class="next-post"><div class="title">Bài kế tiếp<\/div><ul class="list-items"><li><\/li><\/ul><\/div>'), d.clone().wrapInner("<span class='name'><\/span>").prepend("<span class='icon'><\/span>").appendTo(u.find("ul>li")), $(".postbox .maincontent.textview>.relatedposts").length > 0 ? u.insertBefore($(".postbox .maincontent.textview>.relatedposts")) : u.appendTo(".postbox .maincontent.textview"));
        g.length > 0 && (u = $('<div class="prev-post"><div class="title">Bài trước<\/div><ul class="list-items"><li><\/li><\/ul><\/div>'), g.clone().wrapInner("<span class='name'><\/span>").prepend("<span class='icon'><\/span>").appendTo(u.find("ul>li")), $(".postbox .maincontent.textview>.relatedposts").length > 0 ? u.insertBefore(".postbox .maincontent.textview>.relatedposts") : u.appendTo(".postbox .maincontent.textview"));
        $(".sidebox .toc-head").append('<span class="toggle-search" title="Tìm bài trong mục này"><\/span>');
        $(".sidebox .toc-head").append('<input type="text" name="q" id="fil" placeholder="Tìm bài" x-webkit-speech="">');
        $(".sidebox .toc-head .toggle-search").click(function () {
            $(".sidenav.toc").toggleClass("filter");
            $(".sidenav.toc").hasClass("filter") ? setTimeout(function () {
                $("#fil").focus()
            }, 500) : ($(".sidebox .toc-head #fil").val(""), k())
        });
        $(".toc-navbar li a").each(function () {
            var n = $(this).text().replace(/\s+/g, "").toLowerCase();
            $(this).attr("data-title", n)
        });
        nt = $("<li  class='notfound' >Không tìm thấy<\/li>").hide().appendTo(".toc-navbar");
        $(".sidebox .toc-head #fil").on("keyup", function () {
            var i = $(this), n = i.val().replace(/\s+/g, "").toLowerCase(), t;
            n != "" && n.length > 0 ? ($(".toc-navbar li:not(.notfound)").removeClass("show").addClass("hide"), t = $(".toc-navbar li:not(.notfound) a[data-title*='" + n + "']"), t.parents(".toc-navbar li:not(.notfound)").removeClass("hide").addClass("show"), $(".toc-navbar li.show:not(.notfound)").length < 1 ? nt.show() : nt.hide()) : k()
        })
    }
    ot = $(".toggle.search");
    tt = $(".searchBox #q");
    ot.on("click", function (t) {
        if (n.removeClass("showuser"), n.toggleClass("showsearch"), n.hasClass("showsearch") && (tt.focus(), /iPhone|iPad/ig.test(navigator.userAgent))) {
            var i = $("<input type='text' class='shide'/>");
            i.prependTo(".searchBox").focus();
            setTimeout(function () {
                tt.focus();
                i.remove()
            }, 1)
        }
        t.preventDefault()
    });
    y = i.scrollTop();
    i.scroll(function () {
        var t = i.scrollTop();
        y > t && !n.hasClass("scrollup") && (n.addClass("scrollup"), n.removeClass("scrolldown"));
        y < t && !n.hasClass("scrolldown") && (n.addClass("scrolldown"), n.removeClass("scrollup"));
        i.scrollTop() == 0 && n.removeClass("scrollup scrolldown");
        i.scrollTop() + i.height() == $(document).height() && n.removeClass("scrolldown scrollup");
        y = t
    });
    a = function () {
        var t = !1, n = !1, i;
        Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector);
        var r = function (i) {
            !1 !== n && i.target.closest(t) || i.preventDefault()
        }, u = function (n) {
            n.targetTouches.length === 1 && (i = n.targetTouches[0].clientY)
        }, f = function (t) {
            if (t.targetTouches.length === 1) {
                var r = t.targetTouches[0].clientY - i;
                n.scrollTop === 0 && r > 0 && t.preventDefault();
                n.scrollHeight - n.scrollTop <= n.clientHeight && r < 0 && t.preventDefault()
            }
        };
        return function (i, e) {
            typeof e != "undefined" && (t = e, n = document.querySelector(e));
            !0 === i ? (!1 !== n && (n.addEventListener("touchstart", u, !1), n.addEventListener("touchmove", f, !1)), document.body.addEventListener("touchmove", r, !1)) : (!1 !== n && (n.removeEventListener("touchstart", u, !1), n.removeEventListener("touchmove", f, !1)), document.body.removeEventListener("touchmove", r, !1))
        }
    }();
    $(".sidenav.toc").length > 0 && (st = $('<a class="toggle-sidenav"><\/a>').appendTo("body"), bt = function () {
        function t() {
            function t() {
                n.removeClass("open-sidenav");
                /iPhone|iPad/ig.test(navigator.userAgent) && a(!1, ".toc-navbar")
            }

            var i = document.querySelector(".overlay");
            st.click(function () {
                n.removeClass("close-sidenav");
                n.addClass("open-sidenav");
                /iPhone|iPad/ig.test(navigator.userAgent) && (a(!0, ".toc-navbar"), i.removeEventListener("click", t), i.addEventListener("click", t))
            });
            b.on("click touchstart", function (n) {
                n.stopPropagation();
                t()
            })
        }

        t()
    }());
    kt = function () {
        function t() {
            function t() {
                n.removeClass("showmenu");
                /iPhone|iPad/ig.test(navigator.userAgent) && a(!1, ".mainNav")
            }

            var i = document.querySelector(".overlay"), r = $(".toggle.menu");
            r.click(function () {
                n.addClass("showmenu");
                /iPhone|iPad/ig.test(navigator.userAgent) && (a(!0, ".mainNav"), i.removeEventListener("click", t), i.addEventListener("click", t))
            });
            b.on("click touchstart", function (n) {
                n.stopPropagation();
                t()
            })
        }

        t()
    }();
    b.on("click touchstart", function (t) {
        $(this).removeClass("show");
        n.removeClass("showsearch showuser close-sidenav");
        document.activeElement.blur();
        t.preventDefault()
    });
    if ($.get("/account/navigation", function (t) {
        if ($(t).first().is("[data-loaded]")) {
            $(".header .topnav").html(t);
            $(".topnav .user-info").on("touchend", function (t) {
                t.preventDefault();
                n.toggleClass("showuser")
            });
            if ($(t).hasClass("user-info") && ($.getScript("/account/so.ashx"), typeof localStorage == "object" && $(".user-info").attr("data-uid") > 0)) try {
                localStorage.uid = $(".user-info").attr("data-uid")
            } catch (t) {
                console.log(t)
            }
        }
    }), $(".theme.post.two").length > 0 && $(".toc ul").length > 0 && $(".toc").wrapInner("<div class='sticky-left'><\/div>"), $(".maincontent.textview .toc li").each(function (n) {
        n >= 10 && $(this).addClass("hide")
    }), $(".maincontent.textview .toc li").length > 10 && (dt = $('<a class="viewmore-li"><span title="Xem thêm">Xem thêm<\/span><\/a>').appendTo(".maincontent .toc"), $(".viewmore-li").click(function () {
        $(".maincontent.textview .toc li").removeClass("hide");
        $(this).css("display", "none")
    })), $(".theme.post.two").length > 0 && window.innerWidth >= 728) {
        $(window).on("scroll", function () {
            var i = $(window).scrollTop() - 90, n, t;
            $(".maincontent.textview [id]").each(function (r, u) {
                var f = Math.abs($(u).position().top - i);
                n ? f < n && ($(".toc a").removeClass("active"), n = f, t = u) : (n = f, t = u)
            });
            $(".toc a[href*='#" + $(t).attr("id") + "']").addClass("active")
        });
        $(window).on("scroll", function () {
            var n = $(".sticky-left>ul");
            $(".toc").each(function () {
                setTimeout(function () {
                    if ($(".toc a").hasClass("active")) {
                        n.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function () {
                            n.stop()
                        });
                        n.animate({scrollTop: $(".toc a.active").position().top + $(".sticky-left>ul").scrollTop() - 207}, 50)
                    } else if ($(window).scrollTop() == 0) {
                        n.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function () {
                            n.stop()
                        });
                        n.animate({scrollTop: 0}, 10)
                    } else {
                        n.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function () {
                            n.stop()
                        });
                        n.animate({scrollTop: 0}, 50)
                    }
                }, 2e3)
            })
        })
    }
    if (typeof $.fn.stick_in_parent == "function") {
        var e = $(".section.box-sidebar .sidebar"), o = $(".section.box-sidenav .sidebar"),
            s = $(".section.box-sidenav .sidenav.toc"), ht = function () {
                var t = window.innerWidth, n, i;
                e.length > 0 && e.has(".sticky") && (t >= 728 ? (e.css("height", e.parent().height()), e.find(".sticky").stick_in_parent(), console.log("sidebar.sticky_kit:stick_in_parent")) : (e.css("height", ""), e.find(".sticky").trigger("sticky_kit:detach"), console.log("sidebar.sticky_kit:detach")));
                o.length > 0 && o.has(".sticky") && (t >= 1224 ? (o.css("height", o.parent().height()), o.find(".sticky").stick_in_parent(), console.log("sidebar.sticky_kit:stick_in_parent")) : (o.css("height", ""), o.find(".sticky").trigger("sticky_kit:detach"), console.log("sidebar.sticky_kit:detach")));
                s.length > 0 && s.has(".sticky") && (window.innerWidth >= 728 ? (s.css("height", s.parent().height()), s.find(".sticky").stick_in_parent(), console.log("sidenav.sticky_kit:stick_in_parent")) : (s.css("height", ""), s.find(".sticky").trigger("sticky_kit:detach"), console.log("sidenav.sticky_kit:detach")));
                $(".theme.post.two").length > 0 && $(".toc ul").length > 0 && $(".toc").has(".sticky-left") && (n = $(".toc"), i = $(".section.box-sidenav .sidebar"), window.innerWidth >= 728 ? (n.css("height", i.parent().height()), n.find(".sticky-left").stick_in_parent(), console.log("toc-stick")) : (n.css("height", ""), $(".toc>.sticky-left").contents().unwrap(), n.find(".sticky-left").trigger("sticky_kit:detach"), console.log("toc.nostick")))
            };
        setTimeout(function () {
            i.resize(ht);
            ht()
        }, 3e3)
    }
    $("a[data-popurl]").on("click", function (n) {
        window.open($(this).attr("data-popurl"));
        n.preventDefault()
    });
    if (it = $(".post .postbox .textview a[href*='/test/'][href$='-doc'],.postbox .textview a[href*='://" + location.hostname + "/test/'][href$='-doc']")[0], typeof it != "undefined" && (ct = $('<a id="playtest" class="btn playtest" target="_blank" rel="nofollow"><span>Làm trắc nghiệm<\/span><\/a>').attr("href", $(it).attr("href")), $(".post .postbox .downbox:first").append(ct)), window.ga) {
        if ($(".theme.post").length > 0) {
            $("a[data-downurl]").on("click", function () {
                ga("send", "event", "Downloads", $("h1").text(), $(this).attr("href"))
            });
            $(".docviewer").on("click", function () {
                ga("send", "event", "docviewer", $("h1").text(), $(this).attr("href"))
            });
            $(".playtest").on("click", function () {
                ga("send", "event", "playtest", $("h1").text(), $(this).attr("href"))
            })
        }
        if ($(".searchBox>form").length > 0) $(".searchBox>form").on("submit", function () {
            ga("send", "event", "SearchBox", "Tất cả", $(".searchBox>form>#q").val())
        });
        $(".toggle-sidenav,.toggle-search,.toggle-list,.toggle").on("click", function () {
            ga("send", "event", "Toggle", $(this).attr("class"), location.href)
        });
        $("#scrolltop").on("click", function () {
            ga("send", "event", "Toggle", "scrolltop", location.href)
        });
        $(".fb-share,.zalo-share,.gplus-share,.twitter-share").on("click", function () {
            ga("send", "event", "ShareBox", $(this).attr("class"), location.href)
        })
    }
    if (typeof JSON == "object" && typeof localStorage == "object") try {
        if (localStorage.ti = localStorage.ti ? localStorage.ti : "[]", f = JSON.parse(localStorage.ti), $(".navbox .listnav li").length > 0 && $(".navbox .listnav li").each(function () {
            var t = $(this).find("img").attr("src"), i = $(this).find("a").attr("title"),
                n = $(this).find("a").attr("href"), r;
            if (typeof t == "string" && typeof i == "string" && n.length > 0 && $.grep(f, function (t) {
                return t.u == n
            }).length <= 0) {
                for (r = {u: n, n: i, p: t}; f.length >= 12;) f.shift();
                f.push(r);
                localStorage.ti = JSON.stringify(f)
            }
        }), localStorage.hi = localStorage.hi ? localStorage.hi : "[]", t = JSON.parse(localStorage.hi), $(".section.postbox").length > 0) {
            var lt = $(".section.postbox").attr("data-icon"), at = $(".section.postbox h1").text(),
                gt = $(".section.postbox").attr("data-itemid"), ni = location.pathname;
            if (typeof lt == "string" && typeof at == "string" && $.grep(t, function (n) {
                return n.u == ni
            }).length <= 0) {
                for (vt = {i: gt, n: at, p: lt, u: location.pathname}; t.length >= 12;) t.shift();
                t.push(vt);
                localStorage.hi = JSON.stringify(t)
            }
        }
        localStorage.ri = localStorage.ri ? localStorage.ri : "[]";
        r = JSON.parse(localStorage.ri);
        $(".section.postbox").length > 0 && $(".relatedposts .list-items li").each(function () {
            var t = $(this).find("img").attr("src"), i = $(this).find("a").attr("title"),
                n = $(this).find("a").attr("href"), u;
            if (typeof t == "string" && typeof i == "string" && n.length > 0 && $.grep(r, function (t) {
                return t.u == n
            }).length <= 0) {
                for (u = {u: n, n: i, p: t}; r.length >= 12;) r.shift();
                r.push(u);
                localStorage.ri = JSON.stringify(r)
            }
        });
        yt = r.slice(-6);
        t.length < 6 && r.length > 6 ? t = t.concat(r.slice(0, -6)) : t.length >= 6 && (t = t.slice(-6));
        var ti = t.concat(yt), ii = function (n, t) {
            for (var r = [], u, f, e = function (n) {
                if (n[t] === u) return !0
            }, i = 0; i < n.length; i++) u = n[i][t], f = r.filter(e), f.length === 0 && r.push(n[i]);
            return r
        }, h = ii(ti, "u");
        h = h.slice(0, 12);
        pt = function (n) {
            for (var t = n.length, r, i; t;) i = Math.floor(Math.random() * t--), r = n[t], n[t] = n[i], n[i] = r;
            return n
        };
        h = pt(h);
        h.length > 3 && $(".theme.index").length > 0 && (rt = '<div class="section taxbox-fivehistory"><div class= "container box-taxbox clearfix"><a class="title-header"><span>Có thể bạn quan tâm<\/span><\/a><ul class="list-items">', p = "", $.each(h, function (n, t) {
            if (typeof t.n == "string" && typeof t.u == "string" && typeof t.p == "string") {
                var i = '<li><a title="' + t.n + '"href="' + t.u + '?utm_source=vndoc.com&utm_medium=home&utm_campaign=suggestion"><span class="icon"><img src="' + t.p + '"/><\/span><span class="name">' + t.n + "<\/span><\/a><\/li>";
                p = i + p
            }
        }), rt += p + "<\/ul><\/div><\/div>", $("body>.footer").before(rt));
        f.length > 3 && $(".theme.index").length > 0 && (ut = '<div class="section navbox-history"><div class= "container navbar-list clearfix"><ul class="listnav">', w = "", $.each(f, function (n, t) {
            if (typeof t.n == "string" && typeof t.u == "string" && typeof t.p == "string") {
                var i = '<li><a title="' + t.n + '"href="' + t.u + '?utm_source=vndoc.com&utm_medium=home&utm_campaign=suggestion"><img src="' + t.p + '"/><span>' + t.n + "<\/span><\/a><\/li>";
                w = i + w
            }
        }), ut += w + "<\/ul><\/div><\/div>", $("body>.footer").before(ut))
    } catch (ri) {
        console.log(ri)
    }
});
$(function () {
    var n = $(".pdfviewer[data-pages]"), e, r;
    if (n.length > 0) {
        var t = n.attr("data-pages"), u = n.attr("data-path"), f = n.children("div[data-page-no]").length,
            i = $('<a class="btn showmore"><i>' + f + "/" + t + "<\/i> Xem thêm<\/a>");
        n.children("div[data-page-no]").length < t && i.insertAfter(n);
        e = (n.width() - 3) / n.children("div[data-page-no]").width();
        n.children("div[data-page-no]").css("zoom", e);
        r = function (r) {
            var e = n.children("div[data-page-no]").length + 1, f, o, s;
            for (e < 1 && (e = 1), f = e + r - 1, f >= t && (f = t, i.remove()), i.html("<i>" + f + "/" + t + "<\/i> Xem thêm"), o = e; o <= f; o++) s = $('<div class="pf pf-loading" data-page-no="' + o + '"  data-loaded="false"><\/div>'), n.append(s);
            n.children("div[data-page-no]").each(function () {
                var t = $(this), i;
                t.attr("data-loaded") == "false" && (i = t.attr("data-page-no"), $.get(u + "/p." + i + ".htm", function (i) {
                    var r = $(i), f;
                    t.replaceWith(r);
                    r.find("img").each(function () {
                        $(this).attr("src", u + "/" + $(this).attr("src"));
                        console.log('$(this).attr("src")', $(this).attr("src"))
                    });
                    r.removeAttr("data-loaded");
                    f = (n.width() - 3) / r.width();
                    r.css("zoom", f)
                }))
            })
        };
        f < 1 && r(3);
        i.on("click", function () {
            r(3)
        })
    }
});
$(function () {
    var u = $("body"), n;
    if ($(".quizpage").length > 0) {
        n = parseInt($("[data-itemid][data-itemtype='quiz']").attr("data-itemid"));
        $("#astart").on("click", function () {
            var t, i, r;
            if ($(".quizpage").addClass("q-progress").removeClass("q-start"), t = $("<div class='countdown'><\/div>"), i = parseFloat($(".q-time").attr("data-time")), i > 0) {
                $(".quizpage").append(t);
                r = new Date((new Date).getTime() + i * 6e4);
                console.log("finaldate", r);
                t.countdown(r).on("update.countdown", function (n) {
                    var t = "%H:%M:%S";
                    n.offset.days > 0 && (t = "%-d ngày %!d " + t);
                    n.offset.weeks > 0 && (t = "%-w tuần %!w " + t);
                    $(this).html(n.strftime(t))
                }).on("finish.countdown", function () {
                    alert("Bạn đã hết thời gian làm bài");
                    console.log("Đã hết thời gian làm bài");
                    t.remove();
                    $("#q-form").submit()
                })
            }
            console.log(n);
            n > 0 && $.post("ajax/attempts", {quizid: n})
        });
        $("#aviewresult").on("click", function () {
            $(".quizpage").addClass("q-viewresult")
        });
        if (typeof $.fn.starrr == "function" && $(".rating[data-rating]").starrr({
            rating: $(".rating").attr("data-rating"),
            change: function (t, i) {
                n > 0 && parseInt(i) > 0 && ($.post("ajax/rate", {
                    quizid: n,
                    value: i
                }), alert("Cám ơn bạn đã đánh giá " + i + " sao"))
            }
        }), $(".quizpage.simple").length > 0) {
            var r = $(".quizpage .q-toolbox #asave").addClass("hide"),
                t = $('<a id="anext" class="button next hide">Tiếp theo<\/a>'),
                i = $('<a id="apreview" class="button preview hide">Quay lại<\/a>');
            $(".quizpage .q-toolbox").prepend(t).prepend(i);
            t.on("click", function () {
                var n = $(".q-item.show");
                n.next().length > 0 && (n = n.removeClass("show").next(".q-item").addClass("show"));
                n.next().length < 1 && ($(this).addClass("hide"), r.removeClass("hide"));
                i.removeClass("hide")
            });
            i.on("click", function () {
                var n = $(".q-item.show");
                n.prev().length > 0 && (n = n.removeClass("show").prev(".q-item").addClass("show"));
                n.prev().length < 1 && $(this).addClass("hide");
                t.removeClass("hide")
            });
            $("#astart,#aviewresult").on("click", function () {
                $(".q-brief,.q-heading").addClass("hide");
                $(".q-item:first").addClass("show");
                t.removeClass("hide");
                $("html, body").animate({scrollTop: $("h1").offset().top}, 1e3)
            })
        }
        if ($("#qshare").length > 0) $("#qshare").on("click", function (n) {
            $(".quizpage .q-resultname").length > 0 ? FB.ui({
                method: "share",
                href: location.protocol + "//" + location.hostname + location.pathname,
                quote: $(".quizpage .q-resultname").text() + "\n" + $(".quizpage  .q-resultdesc").text(),
                name: $("h1").text(),
                picture: $("img.q-resultimg").attr("src"),
                description: $(".quizpage .q-resultdesc").text()
            }, function () {
            }) : FB.ui({
                method: "share",
                href: location.protocol + "//" + location.hostname + location.pathname,
                quote: $(".q-result").text()
            }, function () {
            });
            n.preventDefault()
        })
    }
    (function (n, t, i) {
        var r, u = n.getElementsByTagName(t)[0];
        n.getElementById(i) || (r = n.createElement(t), r.id = i, r.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=1562489507328808", u.parentNode.insertBefore(r, u))
    })(document, "script", "facebook-jssdk")
});
var AD_TYPE_IMAGE = 1, AD_TYPE_TEXT = 2, AD_TYPE_FLASH = 3, AD_TYPE_HTML = 4, AD_TYPE_IFRAME = 4, AD_COUNT = 0,
    AD_EX_COUNT = 0, AD_SHARING_COUNT = 0, AD_POSITION_ORDER = -2, AD_POSITION_RANDOM_CHANGE = -1,
    AD_POSITION_RANDOM_BLINK = 1e3, AD_POSITION_RANDOM_SHOW = 0, AD_ROOT_PATH = "http://realclick.vn/client/",
    AD_BLANK_GIF = "https://realclick.vn/data/file/b.gif", AD_CLICK_PATH = "http://realclick.vn/client/ck/",
    AD_THIRD_PARTY_CLICK_PATH = "http://realclick.vn/client/click/", AD_IS_INSTALL = !0, AD_CSS_CLASS = "__ad_spot",
    AD_DATA = [], __click = !1;
MetaNET_AdObject.prototype = {
    renderHTML: function () {
        var n = "",
            t = this.onclick == "" ? "onclick=\"__onClick('" + this.name + "')\"" : "onclick=\"__onClick('" + this.name + "');" + this.onclick + '"',
            i = this.onMouseOut == "" ? "" : ' onMouseOut="' + this.onMouseOut + '" ',
            r = this.onMouseOver == "" ? "" : ' onMouseOver="' + this.onMouseOver + '" ', f = !1, u;
        return this.adType == AD_TYPE_IMAGE ? n = IS_NO_LINK(this.linkUrl) ? "<div><img " + r + " " + i + " src='" + this.imageUrl + "' " + t + " width='" + this.width + "' height='" + this.height + "' border=0><\/div>" : "<div><a  " + r + " " + i + " href = '" + this.linkUrl + "' " + t + " target='" + this.target + "' id='" + this.Id + "' " + this.cssClass + this.style + "><img src='" + this.imageUrl + "' width='" + this.width + "' height='" + this.height + "' border=0><\/a><\/div>" : this.adType == AD_TYPE_FLASH ? IS_NO_LINK(this.linkUrl) ? n = "<div  " + r + " " + i + "  style='width:" + this.width + "px; height:" + this.height + "px;' id='" + this.Id + "' " + t + "><object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0'  width=" + this.width + " height=" + this.height + " id='" + this.Id + "_FLASH' align='middle'> <param name='allowScriptAccess' value='sameDomain' /> <param name='movie' value='" + this.imageUrl + "'/> <param name='wmode' value='" + this.wmode + "' /> <param name='linkUrl' value='" + this.linkUrl + "' /> <param name='quality' value='high' /><embed src='" + this.imageUrl + "' quality='high' width=" + this.width + " height=" + this.height + " id='" + this.Id + "_FLASH' name='" + this.Id + "_FLASH' align='middle' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' wmode='" + this.wmode + "' linkUrl='" + this.linkUrl + "' pluginspage='http://www.macromedia.com/go/getflashplayer' /> <\/object><\/div>" : (f = !0, n = "<div style='width:" + this.width + "px; height:" + this.height + "px;'><div style='position:relative;width:" + this.width + "px; height:" + this.height + "px;' id='" + this.Id + "'><a  " + r + " " + i + "  href='" + this.linkUrl + "' " + t + " target='" + this.target + "'><div style='position:absolute; top:0px; left:0px;cursor:pointer;width:" + this.width + "px; height:" + this.height + "px;z-index:1;display:block;background-color:Transparent'><\/div><\/a><div style='position:absolute; top:0px; left:0px;cursor:pointer;width:" + this.width + "px; height:" + this.height + "px;z-index:1;background-color:transparent;" + this.__style + "' " + this.cssClass + "><object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'  codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0'  width=" + this.width + " height=" + this.height + " id='" + this.Id + "_FLASH' align='middle'> <param name='allowScriptAccess' value='sameDomain' /> <param name='movie' value='" + this.imageUrl + "'/> <param name='wmode' value='" + this.wmode + "' /> <param name='linkUrl' value='" + this.linkUrl + "' /> <param name='quality' value='high' /><embed src='" + this.imageUrl + "' quality='high' width=" + this.width + " height=" + this.height + " id='" + this.Id + "_FLASH' name='" + this.Id + "_FLASH' align='middle' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' wmode='" + this.wmode + "' linkUrl='" + this.linkUrl + "' pluginspage='http://www.macromedia.com/go/getflashplayer' /> <\/object><\/div><\/div><\/div>") : this.adType == AD_TYPE_HTML ? n = "<div><iframe style='width:" + this.width + "px; height:" + this.height + "px;' height='" + this.height + "' frameborder='0' width='" + this.width + "' scrolling='no' src='" + this.imageUrl + "' marginwidth='0' marginheight='0' vspace='0' hspace='0' allowtransparency='true'><\/iframe><\/div>" : (u = "<a href = '" + this.linkUrl + "' " + t + "  target='" + this.target + "'>", n = '<div class="breview-box" ' + r + " " + i + ' id="' + this.Id + '"><p class="adx-item adx-title">' + u + this.title + '<\/a><\/p><p class="adx-item adx-domain">' + u + this.domain + '<\/a><\/p><div class="adx-body"><p class="adx-item adx-image">' + u + '<img src="' + this.imageUrl + '" border="0" alt=""/><\/a><\/p><div class="adx-item adx-content">' + this.desc + "<\/div><\/div><\/div>"), !f, __click || (n += "<div name='MetaNET_Click' id='MetaNET_Click' style='font-size:0px;line-height:0px;position:absolute;top:0px;left:0px;z-index:2;width:1px;height:1px'><\/div>", __click = !0), __rendered = 1, n
    }, show: function () {
        if (__rendered == 1) {
            var n = __getEL(this.Id);
            n.style.display = "inline"
        }
    }, hide: function () {
        try {
            var n = __getEL(this.Id);
            n.style.display = "none"
        } catch (t) {
        }
    }, renderIn: function (n) {
        var t = __getEL(n);
        t && (t.innerHTML = this.renderHTML())
    }
};
MetaNET_ExAdObject.prototype = {
    renderHTML: function () {
        var t = this.widthMin, i = this.heightMin, n;
        return this.mode == 1 && (t = this.widthMin, i = this.heightMax), this.showButtons == !1 && (this.collapseAd.onMouseOver = this.expandFunction, this.expandAd.onMouseOut = this.collapseFunction), n = "<div id='" + this.Id + "'><table cellpadding=0 cellspacing=0 border=0><tr><td valign=top id='" + this.Id + "_TD' width=" + t + " height=" + i + ">", n += this.mode == 1 ? this.expandAd.renderHTML() : this.collapseAd.renderHTML(), n += "<\/td><\/tr><\/table>", this.showButtons == !0 ? (n += this.mode == 1 ? "<font face='arial,verdana,tahoma' size=1><div class='exAdBtnBar'><a class='expandAdBtn' id='" + this.Id + "__EXPAND' style='display:none' href='javascript:" + this.Id + "__expand();'>M&#7903; r&#7897;ng<\/a><a class='collapseAdBtn' id='" + this.Id + "__COLLAPSE' href='javascript:" + this.Id + "__collapse();'>Thu nh&#7887;<\/a>" : "<font face='arial,verdana,tahoma' size=1><div class='exAdBtnBar'><a class='expandAdBtn' id='" + this.Id + "__EXPAND' href='javascript:" + this.Id + "__expand();'>+<\/a><a class='collapseAdBtn' id='" + this.Id + "__COLLAPSE'  style='display:none' href='javascript:" + this.Id + "__collapse();'>-<\/a>", n += " | <a class='closeAdBtn' id='" + this.Id + "__CLOSE' href='javascript:" + this.Id + "__close();'>x<\/a><\/div>", n += "<\/div><\/font>") : (n += this.mode == 1 ? "<font face='arial,verdana,tahoma' size=1><div style='display:none' class='exAdBtnBar'><a class='expandAdBtn' id='" + this.Id + "__EXPAND' style='display:none' href='javascript:" + this.Id + "__expand();'>M&#7903; r&#7897;ng<\/a><a class='collapseAdBtn' id='" + this.Id + "__COLLAPSE' href='javascript:" + this.Id + "__collapse();'>Thu nh&#7887;<\/a>" : "<font face='arial,verdana,tahoma' size=1><div style='display:none' class='exAdBtnBar'><a class='expandAdBtn' id='" + this.Id + "__EXPAND' href='javascript:" + this.Id + "__expand();'>+<\/a><a class='collapseAdBtn' id='" + this.Id + "__COLLAPSE'  style='display:none' href='javascript:" + this.Id + "__collapse();'>-<\/a>", n += " | <a class='closeAdBtn' id='" + this.Id + "__CLOSE' href='javascript:" + this.Id + "__close();'>x<\/a><\/div>", n += "<\/div><\/font>"), n += "<div id='" + this.Id + "_HIDDEN' style='display:none; visiblity:hidden; z-index:-1000;'>", n += this.mode == 1 ? this.collapseAd.renderHTML() : this.expandAd.renderHTML(), n += "<\/div>", __rendered = 1, n
    }, show: function () {
        if (__rendered == 1) {
            var n = __getEL(this.Id);
            n.style.display = "inline"
        }
    }, hide: function () {
        try {
            var n = __getEL(this.Id);
            n.style.display = "none"
        } catch (t) {
        }
    }, renderIn: function (n) {
        var t = __getEL(n);
        t && (t.innerHTML = this.renderHTML())
    }
};
MetaNET_SharingAdObject.prototype = {
    renderHTML: function () {
        var n = "", t = 0, i, r;
        if (this.length == 0) return "";
        if (this.interval > 0) {
            if (n += "<div id='" + this.Id + "'>", this.length > 1) {
                for (t = 0; t < this.length; t++) n += "<div id='" + this.Id + "_SLIDE_" + t + "' style='display:none;'>", n += this.adObjects[t].renderHTML(), n += "<\/div>";
                n += "<script type='text/javascript'>";
                n += "" + this.Id + "__play();";
                n += "<\/script>"
            }
            return n += "<\/div>", __rendered = 1, n
        }
        if (this.interval < 0) {
            if (i = this.direction.toLowerCase(), i == "doc" || i == "vertical" || i == "d" || i == "0" ? i = "v" : (i == "n" || i == "horizontal" || i == "ngang" || i == "1") && (i = "h"), n += "<div id='" + this.Id + "'>", n += '<div class="adx-zone">', i == "h") {
                for (n += '<div class="adx-row">', t = 0; t < this.length; t++) n += '<div class="adx-cell">', n += this.adObjects[t].renderHTML(), n += "<\/div>", this.padding > 0 && t < this.length - 1 && (n += '<div style="width:' + this.padding + 'px" class="adx-sep-h"><\/div>');
                n += "<\/div>"
            } else if (i == "v") for (t = 0; t < this.length; t++) n += '<div class="adx-row"><div class="adx-cell">', n += this.adObjects[t].renderHTML(), n += "<\/div><\/div>", this.padding > 0 && t < this.length - 1 && (n += '<div style=":height:' + this.padding + 'px" class="adx-sep-v"><\/div>');
            return n += "<\/div>", n += "<\/div>", __rendered = 1, n
        }
        return r = this.currentAdId, n += '<div id="' + this.Id + '" >', n += this.adObjects[this.currentAdId].renderHTML(), n += "<\/div>", __rendered = 1, n
    }, show: function () {
        if (__rendered == 1) {
            var n = __getEL(this.Id);
            n.style.display = "inline"
        }
    }, hide: function () {
        try {
            var n = __getEL(this.Id);
            n.style.display = "none"
        } catch (t) {
        }
    }, renderIn: function (n) {
        var t = __getEL(n);
        t && (t.innerHTML = this.renderHTML())
    }
};
MetaNET_SharingAdObject2.prototype = {
    renderHTML: function () {
        var n = "", i = 0, r, u, t;
        if (this.length == 0) return "";
        if (this.interval > 0) {
            if (n += this.adObjects[0].width > 0 && this.adObjects[0].height > 0 ? "<div id='" + this.Id + "' >" : "<div id='" + this.Id + "'>", n += "<div style='position:relative;height:auto;width:auto;'>", this.length > 1) {
                for (i = 0; i < this.length; i++) n += "<div id='" + this.Id + "_SLIDE_" + i + "' style='position:absolute;top:0px;left:0px;display:none;'>", n += this.adObjects[i].renderHTML(), n += "<\/div>";
                n += "<script type='text/javascript'>";
                n += "" + this.Id + "__play();";
                n += "<\/script>"
            }
            return n += "<\/div><\/div>", __rendered = 1, n
        }
        if (this.interval < 0) {
            if (r = this.direction.toLowerCase(), r == "doc" || r == "vertical" || r == "d" || r == "0" ? r = "v" : (r == "n" || r == "horizontal" || r == "ngang" || r == "1") && (r = "h"), u = this.length, u > 4 && (u = 4), n += "<div id='" + this.Id + "'>", t = this.currentAdId, n += '<div class="adx-zone">', r == "h") {
                for (n += '<div class="adx-row">', i = 0; i < u; i++) n += this.adObjects[t].width > 0 && this.adObjects[t].height > 0 ? '<div class="adx-cell" >' : '<div class="adx-cell">', n += this.adObjects[t].renderHTML(), n += "<\/div>", this.padding > 0 && i < u - 1 && (n += '<div style="width:' + this.padding + '" class="adx-sep-v"><\/div>'), t++, t >= this.length && (t = 0);
                n += "<\/div>"
            } else if (r == "v") for (i = 0; i < u; i++) n += this.adObjects[t].width > 0 && this.adObjects[t].height > 0 ? '<div class="adx-row"><div class="adx-cell" >' : '<div class="adx-row"><div class="adx-cell" >', n += this.adObjects[t].renderHTML(), n += "<\/div><\/div>", this.padding > 0 && i < u - 1 && (n += '<div  style="height:' + this.padding + '" class="adx-sep-h"><\/div>'), t++, t >= this.length && (t = 0);
            return n += "<\/div>", n += "<\/div>", __rendered = 1, n
        }
        return t = this.currentAdId, n += this.adObjects[t].width > 0 && this.adObjects[t].height > 0 ? '<div id="' + this.Id + '" >' : "<div id='" + this.Id + "'>", n += this.adObjects[t].renderHTML(), n += "<\/div>", __rendered = 1, n
    }, show: function () {
        if (__rendered == 1) {
            var n = __getEL(this.Id);
            n.style.display = "inline"
        }
    }, hide: function () {
        try {
            var n = __getEL(this.Id);
            n.style.display = "none"
        } catch (t) {
        }
    }, renderIn: function (n) {
        var t = __getEL(n);
        t && (t.innerHTML = this.renderHTML())
    }
};
AD_BG_START = !1;
MetaNET_BgAds_Settings = {
    fixedType: "top",
    centerWidth: 1e3,
    leftOffset: 1,
    rightOffset: 1,
    topOffset: 1,
    bottomOffset: 1,
    zIndex: 100,
    isFixed: !0,
    bgColor: "",
    height: 0,
    leftBannerId: "BG_leftBanner",
    rightBannerId: "BG_rightBanner"
};
MetaNET_BgAds = function (n, t, i) {
    var r, e;
    if (n != null || t != null) {
        r = MetaNET_BgAds_Settings;
        i == null || typeof i == "undefined" ? i = r : ((i.fixedType == null || typeof i.fixedType == "undefined") && (i.fixedType = r.fixedType), (i.centerWidth == null || typeof i.centerWidth == "undefined") && (i.centerWidth = r.centerWidth), (i.leftOffset == null || typeof i.leftOffset == "undefined") && (i.leftOffset = r.leftOffset), (i.rightOffset == null || typeof i.rightOffset == "undefined") && (i.rightOffset = r.rightOffset), (i.topOffset == null || typeof i.topOffset == "undefined") && (i.topOffset = r.topOffset), (i.bottomOffset == null || typeof i.bottomOffset == "undefined") && (i.bottomOffset = r.bottomOffset), (i.zIndex == null || typeof i.zIndex == "undefined") && (i.zIndex = r.zIndex), (i.isFixed == null || typeof i.isFixed == "undefined") && (i.isFixed = r.isFixed), (i.bgColor == null || typeof i.bgColor == "undefined") && (i.bgColor = r.bgColor), (i.leftBannerId == null || typeof i.leftBannerId == "undefined") && (i.leftBannerId = r.leftBannerId), (i.rightBannerId == null || typeof i.rightBannerId == "undefined") && (i.rightBannerId = r.rightBannerId));
        e = "top:0px";
        i.fixedType == "bottom" && (e = "bottom:" + i.bottomOffset + "px");
        var b = '<div style="position:relative;width:100%;height:100%;display:block"><div style="position:absolute;right:' + i.rightOffset + "px;" + e + '">' + (n == null ? "" : n.renderHTML()) + "<\/div><\/div>",
            k = '<div style="position:relative;width:100%;height:100%;display:block"><div style="position:absolute;left:' + i.leftOffset + "px;" + e + '">' + (t == null ? "" : t.renderHTML()) + "<\/div><\/div>",
            s = i.leftBannerId, h = i.rightBannerId, c = i.centerWidth, l = $(window).width(),
            a = i.height == 0 ? $(window).height() : i.height, d = i.leftOffset, g = i.rightOffset, nt = i.zIndex,
            tt = i.topOffset, v = i.isFixed, o = i.bgColor, y = (l - c) / 2, p = !1, w = !1,
            u = document.createElement("div"), f = document.createElement("div");
        document.getElementById(s) && (u = document.getElementById(s), p = !0);
        document.getElementById(h) && (f = document.getElementById(h), w = !0);
        o != "" && $("body").css("background-color", o);
        l <= c + 100 ? ($(u).css("display", "none"), $(f).css("display", "none")) : ($(u).css("display", ""), $(f).css("display", ""));
        try {
            $.browser.msie && $.browser.version.substr(0, 1) < 7 && (v = !1)
        } catch (it) {
        }
        v ? ($(u).css("position", "fixed"), $(f).css("position", "fixed")) : ($(u).css("position", "absolute"), $(f).css("position", "absolute"));
        $(u).css("top", "0").css("left", "0").css("height", a).css("width", y).css("background", o).css("overflow", "hidden").attr("id", s);
        $(f).css("top", "0").css("right", "0").css("height", a).css("width", y).css("background", o).css("overflow", "hidden").attr("id", h);
        p || $(u).appendTo("body");
        w || $(f).appendTo("body");
        AD_BG_START || ($(u).append(b), $(f).append(k));
        AD_BG_START = !0
    }
};
MetaNET_BgAds2 = function (n, t) {
    if (n.length > 2) {
        var i = "__BGADS_";
        this.currentAdId = 0;
        this.currentAdId = __getCookie(i) == "" || __getCookie(i) == null ? Math.floor(Math.random() * (n.length / 2)) : parseInt(__getCookie(i)) + 1;
        this.currentAdId >= n.length / 2 && (this.currentAdId = 0);
        __setCookie(i, this.currentAdId, 1);
        MetaNET_BgAds(n[this.currentAdId * 2], n[this.currentAdId * 2 + 1], t)
    } else MetaNET_BgAds(n[0], n[1], t)
}, function (n, t) {
    typeof define == "function" && define.amd ? define(t) : typeof exports == "object" ? module.exports = t(require, exports, module) : n.ouibounce = t()
}(this, function () {
    return function (n, t) {
        "use strict";

        function e(n, t) {
            return typeof n == "undefined" ? t : n
        }

        function y(n) {
            var i = n * 864e5, t = new Date;
            return t.setTime(t.getTime() + i), "; expires=" + t.toUTCString()
        }

        function it() {
            s() || (r.addEventListener("mouseleave", p), r.addEventListener("mouseenter", w), r.addEventListener("keydown", b))
        }

        function p(n) {
            n.clientY > g || (u = setTimeout(h, c))
        }

        function w() {
            u && (clearTimeout(u), u = null)
        }

        function b(n) {
            o || n.metaKey && n.keyCode === 76 && (o = !0, u = setTimeout(h, c))
        }

        function rt(n, t) {
            return ut()[n] === t
        }

        function ut() {
            for (var t, i = document.cookie.split("; "), r = {}, n = i.length - 1; n >= 0; n--) t = i[n].split("="), r[t[0]] = t[1];
            return r
        }

        function s() {
            return rt(f, "true") && !d
        }

        function h() {
            s() || (n && (n.style.display = "block"), tt(), k())
        }

        function k(n) {
            var t = n || {};
            typeof t.cookieExpire != "undefined" && (l = y(t.cookieExpire));
            t.sitewide === !0 && (v = ";path=/");
            typeof t.cookieDomain != "undefined" && (a = ";domain=" + t.cookieDomain);
            typeof t.cookieName != "undefined" && (f = t.cookieName);
            document.cookie = f + "=true" + l + a + v;
            r.removeEventListener("mouseleave", p);
            r.removeEventListener("mouseenter", w);
            r.removeEventListener("keydown", b)
        }

        var i = t || {}, d = i.aggressive || !1, g = e(i.sensitivity, 20), nt = e(i.timer, 1e3), c = e(i.delay, 0),
            tt = i.callback || function () {
            }, l = y(i.cookieExpire) || "", a = i.cookieDomain ? ";domain=" + i.cookieDomain : "",
            f = i.cookieName ? i.cookieName : "_vom", v = i.sitewide === !0 ? ";path=/" : "", u = null,
            r = document.documentElement, o;
        return setTimeout(it, nt), o = !1, {fire: h, disable: k, isDisabled: s}
    }
}), function () {
    var t, n;
    if (!($(window).width() < 800) && !($(window).height() < 500)) {
        $('<link rel="stylesheet" href="/scripts/outbounce/ouibounce.min.css" />').appendTo("head");
        t = '<div id="ouibounce-modal"><div class="underlay"><\/div><div class="modal"><a class="outclose" title="Đóng lại">Đóng X<\/a><div class="modal-body"><div id="adsoutbounce" data-realclickzone="405"><\/div><\/div><\/div><\/div>';
        $("body").append(t);
        n = ouibounce(document.getElementById("ouibounce-modal"), {
            cookieExpire: 1, timer: 0, callback: function () {
                n.disable({cookieExpire: 1, sitewide: !0});
                console.log("ouiBounce fired!")
            }
        });
        $(".underlay,.outclose").on("click", function () {
            $("#ouibounce-modal").hide();
            n.disable({cookieExpire: 1, sitewide: !0})
        });
        $("#ouibounce-modal .modal").on("click", function () {
            $("#ouibounce-modal").hide()
        });
        setTimeout(function () {
            $("#adsoutbounce").children().length < 1 && (n.disable({
                cookieExpire: 1,
                sitewide: !0
            }), $("#ouibounce-modal").remove())
        }, 5e3)
    }
}();
$(".meta-ads").each(function () {
    $(this).data("ajx", "/cache.aspx?_path=http://meta.vn/ajx/Ajx_TopProducts2.aspx");
    loadMetaAds($(this))
});
$("div[data-realclickzone]").each(function () {
    var n = $(this), t = n.attr("data-realclickzone");
    n.is("[id]") || n.attr("id", "adzid" + t);
    n.is("[data-minwidth]") && parseInt(n.attr("data-minwidth")) > $(window).width() || n.is("[data-maxwidth]") && parseInt(n.attr("data-maxwidth")) < $(window).width() ? (n.remove(), console.log("NotDisplayZone:" + t)) : __add_banner({
        type: "zone",
        id: t,
        output: n.attr("id")
    })
});
__load_banners();
/*! PhotoSwipe - v4.1.2 - 2017-04-05
* http://photoswipe.com
* Copyright (c) 2017 Dmitry Semenov; */
!function (n, t) {
    "function" == typeof define && define.amd ? define(t) : "object" == typeof exports ? module.exports = t() : n.PhotoSwipe = t()
}(this, function () {
    "use strict";
    return function (n, t, i, r) {
        var f = {
            features: null, bind: function (n, t, i, r) {
                var f = (r ? "remove" : "add") + "EventListener", u;
                for (t = t.split(" "), u = 0; u < t.length; u++) t[u] && n[f](t[u], i, !1)
            }, isArray: function (n) {
                return n instanceof Array
            }, createEl: function (n, t) {
                var i = document.createElement(t || "div");
                return n && (i.className = n), i
            }, getScrollY: function () {
                var n = window.pageYOffset;
                return void 0 !== n ? n : document.documentElement.scrollTop
            }, unbind: function (n, t, i) {
                f.bind(n, t, i, !0)
            }, removeClass: function (n, t) {
                var i = new RegExp("(\\s|^)" + t + "(\\s|$)");
                n.className = n.className.replace(i, " ").replace(/^\s\s*/, "").replace(/\s\s*$/, "")
            }, addClass: function (n, t) {
                f.hasClass(n, t) || (n.className += (n.className ? " " : "") + t)
            }, hasClass: function (n, t) {
                return n.className && new RegExp("(^|\\s)" + t + "(\\s|$)").test(n.className)
            }, getChildByClass: function (n, t) {
                for (var i = n.firstChild; i;) {
                    if (f.hasClass(i, t)) return i;
                    i = i.nextSibling
                }
            }, arraySearch: function (n, t, i) {
                for (var r = n.length; r--;) if (n[r][i] === t) return r;
                return -1
            }, extend: function (n, t, i) {
                for (var r in t) if (t.hasOwnProperty(r)) {
                    if (i && n.hasOwnProperty(r)) continue;
                    n[r] = t[r]
                }
            }, easing: {
                sine: {
                    out: function (n) {
                        return Math.sin(n * (Math.PI / 2))
                    }, inOut: function (n) {
                        return -(Math.cos(Math.PI * n) - 1) / 2
                    }
                }, cubic: {
                    out: function (n) {
                        return --n * n * n + 1
                    }
                }
            }, detectFeatures: function () {
                var o, i, s, r, e, l;
                if (f.features) return f.features;
                var a = f.createEl(), v = a.style, t = "", n = {};
                (n.oldIE = document.all && !document.addEventListener, n.touch = "ontouchstart" in window, window.requestAnimationFrame && (n.raf = window.requestAnimationFrame, n.caf = window.cancelAnimationFrame), n.pointerEvent = navigator.pointerEnabled || navigator.msPointerEnabled, n.pointerEvent) || (o = navigator.userAgent, /iP(hone|od)/.test(navigator.platform) && (i = navigator.appVersion.match(/OS (\d+)_(\d+)_?(\d+)?/), i && i.length > 0 && (i = parseInt(i[1], 10), i >= 1 && i < 8 && (n.isOldIOSPhone = !0))), s = o.match(/Android\s([0-9\.]*)/), r = s ? s[1] : 0, r = parseFloat(r), r >= 1 && (r < 4.4 && (n.isOldAndroid = !0), n.androidVersion = r), n.isMobileOpera = /opera mini|opera mobi/i.test(o));
                for (var u, h, y = ["transform", "perspective", "animationName"], p = ["", "webkit", "Moz", "ms", "O"], c = 0; c < 4; c++) {
                    for (t = p[c], e = 0; e < 3; e++) u = y[e], h = t + (t ? u.charAt(0).toUpperCase() + u.slice(1) : u), !n[u] && h in v && (n[u] = h);
                    t && !n.raf && (t = t.toLowerCase(), n.raf = window[t + "RequestAnimationFrame"], n.raf && (n.caf = window[t + "CancelAnimationFrame"] || window[t + "CancelRequestAnimationFrame"]))
                }
                return n.raf || (l = 0, n.raf = function (n) {
                    var t = (new Date).getTime(), i = Math.max(0, 16 - (t - l)), r = window.setTimeout(function () {
                        n(t + i)
                    }, i);
                    return l = t + i, r
                }, n.caf = function (n) {
                    clearTimeout(n)
                }), n.svg = !!document.createElementNS && !!document.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect, f.features = n, n
            }
        }, si, uf, ff, et;
        f.detectFeatures();
        f.features.oldIE && (f.bind = function (n, t, i, r) {
            t = t.split(" ");
            for (var u, e = (r ? "detach" : "attach") + "Event", o = function () {
                i.handleEvent.call(i)
            }, f = 0; f < t.length; f++) if (u = t[f]) if ("object" == typeof i && i.handleEvent) {
                if (r) {
                    if (!i["oldIE" + u]) return !1
                } else i["oldIE" + u] = o;
                n[e]("on" + u, i["oldIE" + u])
            } else n[e]("on" + u, i)
        });
        var u = this, pe = 25, dt = 3, e = {
            allowPanToNext: !0,
            spacing: .12,
            bgOpacity: 1,
            mouseUsed: !1,
            loop: !0,
            pinchToClose: !0,
            closeOnScroll: !0,
            closeOnVerticalDrag: !0,
            verticalDragRange: .75,
            hideAnimationDuration: 333,
            showAnimationDuration: 333,
            showHideOpacity: !1,
            focus: !0,
            escKey: !0,
            arrowKeys: !0,
            mainScrollEndFriction: .35,
            panEndFriction: .35,
            isClickableElement: function (n) {
                return "A" === n.tagName
            },
            getDoubleTapZoom: function (n, t) {
                return n ? 1 : t.initialZoomLevel < .7 ? 1 : 1.33
            },
            maxSpreadZoom: 1.33,
            modal: !0,
            scaleMode: "fit"
        };
        f.extend(e, r);
        var gi, we, of, h, be, vt, lr, eu, b, l, hi, sf, hf, cf, ou, y, ke, su, hu, ar, cu, nr, gt, yt, lu, lf, de, ge,
            af, ci, a, vf, no, au, vr, yf, yr, pr, ct, pf, li, tr, vu, ai, ot, pt, to, io, s, wt, d, ni, wf, yu, pu, wu,
            bu, ti = function () {
                return {x: 0, y: 0}
            }, ii = ti(), ir = ti(), o = ti(), k = {}, ri = 0, rr = {}, rt = ti(), ht = 0, ku = !0, bf = [], wr = {},
            vi = !1, br = function (n, t) {
                f.extend(u, t.publicMethods);
                bf.push(n)
            }, du = function (n) {
                var t = ft();
                return n > t - 1 ? n - t : n < 0 ? t + n : n
            }, kr = {}, v = function (n, t) {
                return kr[n] || (kr[n] = []), kr[n].push(t)
            }, c = function (n) {
                var i = kr[n], r, t;
                if (i) for (r = Array.prototype.slice.call(arguments), r.shift(), t = 0; t < i.length; t++) i[t].apply(u, r)
            }, lt = function () {
                return (new Date).getTime()
            }, bt = function (n) {
                pu = n;
                u.bg.style.opacity = n * e.bgOpacity
            }, ro = function (n, t, i, r, f) {
                (!vi || f && f !== u.currItem) && (r /= f ? f.fitRatio : u.currItem.fitRatio);
                n[nr] = sf + t + "px, " + i + "px" + hf + " scale(" + r + ")"
            }, p = function (n) {
                wt && (n && (l > u.currItem.fitRatio ? vi || (di(u.currItem, !1, !0), vi = !0) : vi && (di(u.currItem), vi = !1)), ro(wt, o.x, o.y, l))
            }, dr = function (n) {
                n.container && ro(n.container.style, n.initialPosition.x, n.initialPosition.y, n.initialZoomLevel, n)
            }, ur = function (n, t) {
                t[nr] = sf + n + "px, 0px" + hf
            }, gu = function (n, t) {
                if (!e.loop && t) {
                    var r = h + (rt.x * ri - n) / rt.x, i = Math.round(n - kt.x);
                    (r < 0 && i > 0 || r >= ft() - 1 && i < 0) && (n = kt.x + i * e.mainScrollEndFriction)
                }
                kt.x = n;
                ur(n, be)
            }, kf = function (n, t) {
                var i = iu[n] - rr[n];
                return ir[n] + ii[n] + i - i * (t / hi)
            }, g = function (n, t) {
                n.x = t.x;
                n.y = t.y;
                t.id && (n.id = t.id)
            }, uo = function (n) {
                n.x = Math.round(n.x);
                n.y = Math.round(n.y)
            }, df = null, gf = function () {
                df && (f.unbind(document, "mousemove", gf), f.addClass(n, "pswp--has_mouse"), e.mouseUsed = !0, c("mouseUsed"));
                df = setTimeout(function () {
                    df = null
                }, 100)
            }, os = function () {
                f.bind(document, "keydown", u);
                a.transform && f.bind(u.scrollWrap, "click", u);
                e.mouseUsed || f.bind(document, "mousemove", gf);
                f.bind(window, "resize scroll orientationchange", u);
                c("bindEvents")
            }, ss = function () {
                f.unbind(window, "resize scroll orientationchange", u);
                f.unbind(window, "scroll", b.scroll);
                f.unbind(document, "keydown", u);
                f.unbind(document, "mousemove", gf);
                a.transform && f.unbind(u.scrollWrap, "click", u);
                ct && f.unbind(window, lr, u);
                clearTimeout(vf);
                c("unbindEvents")
            }, ne = function (n, t) {
                var i = uu(u.currItem, k, n);
                return t && (s = i), i
            }, fo = function (n) {
                return n || (n = u.currItem), n.initialZoomLevel
            }, eo = function (n) {
                return n || (n = u.currItem), n.w > 0 ? e.maxSpreadZoom : 1
            }, oo = function (n, t, i, r) {
                return r === u.currItem.initialZoomLevel ? (i[n] = u.currItem.initialPosition[n], !0) : (i[n] = kf(n, r), i[n] > t.min[n] ? (i[n] = t.min[n], !0) : i[n] < t.max[n] && (i[n] = t.max[n], !0))
            }, hs = function () {
                if (nr) {
                    var t = a.perspective && !yt;
                    return sf = "translate" + (t ? "3d(" : "("), void(hf = a.perspective ? ", 0px)" : ")")
                }
                nr = "left";
                f.addClass(n, "pswp--ie");
                ur = function (n, t) {
                    t.left = n + "px"
                };
                dr = function (n) {
                    var i = n.fitRatio > 1 ? 1 : n.fitRatio, t = n.container.style, r = i * n.w, u = i * n.h;
                    t.width = r + "px";
                    t.height = u + "px";
                    t.left = n.initialPosition.x + "px";
                    t.top = n.initialPosition.y + "px"
                };
                p = function () {
                    if (wt) {
                        var n = wt, t = u.currItem, i = t.fitRatio > 1 ? 1 : t.fitRatio, r = i * t.w, f = i * t.h;
                        n.width = r + "px";
                        n.height = f + "px";
                        n.left = o.x + "px";
                        n.top = o.y + "px"
                    }
                }
            }, cs = function (n) {
                var t = "";
                e.escKey && 27 === n.keyCode ? t = "close" : e.arrowKeys && (37 === n.keyCode ? t = "prev" : 39 === n.keyCode && (t = "next"));
                t && (n.ctrlKey || n.altKey || n.shiftKey || n.metaKey || (n.preventDefault ? n.preventDefault() : n.returnValue = !1, u[t]()))
            }, ls = function (n) {
                n && (tr || li || d || yr) && (n.preventDefault(), n.stopPropagation())
            }, so = function () {
                u.setScrollOffset(0, f.getScrollY())
            }, ut = {}, fr = 0, gr = function (n) {
                ut[n] && (ut[n].raf && lf(ut[n].raf), fr--, delete ut[n])
            }, te = function (n) {
                ut[n] && gr(n);
                ut[n] || (fr++, ut[n] = {})
            }, nu = function () {
                for (var n in ut) ut.hasOwnProperty(n) && gr(n)
            }, tu = function (n, t, i, r, u, f, e) {
                var o, h = lt(), s;
                te(n);
                s = function () {
                    if (ut[n]) {
                        if (o = lt() - h, o >= r) return gr(n), f(i), void(e && e());
                        f((i - t) * u(o / r) + t);
                        ut[n].raf = lu(s)
                    }
                };
                s()
            }, as = {
                shout: c, listen: v, viewportSize: k, options: e, isMainScrollAnimating: function () {
                    return d
                }, getZoomLevel: function () {
                    return l
                }, getCurrentIndex: function () {
                    return h
                }, isDragging: function () {
                    return ct
                }, isZooming: function () {
                    return pt
                }, setScrollOffset: function (n, t) {
                    rr.x = n;
                    ci = rr.y = t;
                    c("updateScrollOffset", rr)
                }, applyZoomPan: function (n, t, i, r) {
                    o.x = t;
                    o.y = i;
                    l = n;
                    p(r)
                }, init: function () {
                    var i, o, s, r;
                    if (!gi && !we) {
                        for (u.framework = f, u.template = n, u.bg = f.getChildByClass(n, "pswp__bg"), de = n.className, gi = !0, a = f.detectFeatures(), lu = a.raf, lf = a.caf, nr = a.transform, af = a.oldIE, u.scrollWrap = f.getChildByClass(n, "pswp__scroll-wrap"), u.container = f.getChildByClass(u.scrollWrap, "pswp__container"), be = u.container.style, u.itemHolders = y = [{
                            el: u.container.children[0],
                            wrap: 0,
                            index: -1
                        }, {el: u.container.children[1], wrap: 0, index: -1}, {
                            el: u.container.children[2],
                            wrap: 0,
                            index: -1
                        }], y[0].el.style.display = y[2].el.style.display = "none", hs(), b = {
                            resize: u.updateSize,
                            orientationchange: function () {
                                clearTimeout(vf);
                                vf = setTimeout(function () {
                                    k.x !== u.scrollWrap.clientWidth && u.updateSize()
                                }, 500)
                            },
                            scroll: so,
                            keydown: cs,
                            click: ls
                        }, o = a.isOldIOSPhone || a.isOldAndroid || a.isMobileOpera, a.animationName && a.transform && !o || (e.showAnimationDuration = e.hideAnimationDuration = 0), i = 0; i < bf.length; i++) u["init" + bf[i]]();
                        for (t && (s = u.ui = new t(u, f), s.init()), c("firstUpdate"), h = h || e.index || 0, (isNaN(h) || h < 0 || h >= ft()) && (h = 0), u.currItem = oi(h), (a.isOldIOSPhone || a.isOldAndroid) && (ku = !1), n.setAttribute("aria-hidden", "false"), e.modal && (ku ? n.style.position = "fixed" : (n.style.position = "absolute", n.style.top = f.getScrollY() + "px")), void 0 === ci && (c("initialLayout"), ci = ge = f.getScrollY()), r = "pswp--open ", e.mainClass && (r += e.mainClass + " "), e.showHideOpacity && (r += "pswp--animate_opacity "), r += yt ? "pswp--touch" : "pswp--notouch", r += a.animationName ? " pswp--css_animation" : "", r += a.svg ? " pswp--svg" : "", f.addClass(n, r), u.updateSize(), vt = -1, ht = null, i = 0; i < dt; i++) ur((i + vt) * rt.x, y[i].el.style);
                        af || f.bind(u.scrollWrap, eu, u);
                        v("initialZoomInEnd", function () {
                            u.setContent(y[0], h - 1);
                            u.setContent(y[2], h + 1);
                            y[0].el.style.display = y[2].el.style.display = "block";
                            e.focus && n.focus();
                            os()
                        });
                        u.setContent(y[1], h);
                        u.updateCurrItem();
                        c("afterInit");
                        ku || (cf = setInterval(function () {
                            fr || ct || pt || l !== u.currItem.initialZoomLevel || u.updateSize()
                        }, 1e3));
                        f.addClass(n, "pswp--visible")
                    }
                }, close: function () {
                    gi && (gi = !1, we = !0, c("close"), ss(), ko(u.currItem, null, !0, u.destroy))
                }, destroy: function () {
                    c("destroy");
                    bi && clearTimeout(bi);
                    n.setAttribute("aria-hidden", "true");
                    n.className = de;
                    cf && clearInterval(cf);
                    f.unbind(u.scrollWrap, eu, u);
                    f.unbind(window, "scroll", u);
                    ue();
                    nu();
                    kr = null
                }, panTo: function (n, t, i) {
                    i || (n > s.min.x ? n = s.min.x : n < s.max.x && (n = s.max.x), t > s.min.y ? t = s.min.y : t < s.max.y && (t = s.max.y));
                    o.x = n;
                    o.y = t;
                    p()
                }, handleEvent: function (n) {
                    n = n || window.event;
                    b[n.type] && b[n.type](n)
                }, goTo: function (n) {
                    n = du(n);
                    var t = n - h;
                    ht = t;
                    h = n;
                    u.currItem = oi(h);
                    ri -= t;
                    gu(rt.x * ri);
                    nu();
                    d = !1;
                    u.updateCurrItem()
                }, next: function () {
                    u.goTo(h + 1)
                }, prev: function () {
                    u.goTo(h - 1)
                }, updateCurrZoomItem: function (n) {
                    if (n && c("beforeChange", 0), y[1].el.children.length) {
                        var t = y[1].el.children[0];
                        wt = f.hasClass(t, "pswp__zoom-wrap") ? t.style : null
                    } else wt = null;
                    s = u.currItem.bounds;
                    hi = l = u.currItem.initialZoomLevel;
                    o.x = s.center.x;
                    o.y = s.center.y;
                    n && c("afterChange")
                }, invalidateCurrItems: function () {
                    ou = !0;
                    for (var n = 0; n < dt; n++) y[n].item && (y[n].item.needsUpdate = !0)
                }, updateCurrItem: function (n) {
                    var t, i, r, f;
                    if (0 !== ht && (i = Math.abs(ht), !(n && i < 2))) {
                        for (u.currItem = oi(h), vi = !1, c("beforeChange", ht), i >= dt && (vt += ht + (ht > 0 ? -dt : dt), i = dt), r = 0; r < i; r++) ht > 0 ? (t = y.shift(), y[dt - 1] = t, vt++, ur((vt + 2) * rt.x, t.el.style), u.setContent(t, h - i + r + 1 + 1)) : (t = y.pop(), y.unshift(t), vt--, ur(vt * rt.x, t.el.style), u.setContent(t, h + i - r - 2));
                        wt && 1 === Math.abs(ht) && (f = oi(ke), f.initialZoomLevel !== l && (uu(f, k), di(f), dr(f)));
                        ht = 0;
                        u.updateCurrZoomItem();
                        ke = h;
                        c("afterChange")
                    }
                }, updateSize: function (t) {
                    var w, v, i, r, a;
                    if (!ku && e.modal) {
                        if (w = f.getScrollY(), ci !== w && (n.style.top = w + "px", ci = w), !t && wr.x === window.innerWidth && wr.y === window.innerHeight) return;
                        wr.x = window.innerWidth;
                        wr.y = window.innerHeight;
                        n.style.height = wr.y + "px"
                    }
                    if (k.x = u.scrollWrap.clientWidth, k.y = u.scrollWrap.clientHeight, so(), rt.x = k.x + Math.round(k.x * e.spacing), rt.y = k.y, gu(rt.x * ri), c("beforeResize"), void 0 !== vt) {
                        for (a = 0; a < dt; a++) v = y[a], ur((a + vt) * rt.x, v.el.style), r = h + a - 1, e.loop && ft() > 2 && (r = du(r)), i = oi(r), i && (ou || i.needsUpdate || !i.bounds) ? (u.cleanSlide(i), u.setContent(v, r), 1 === a && (u.currItem = i, u.updateCurrZoomItem(!0)), i.needsUpdate = !1) : v.index === -1 && r >= 0 && u.setContent(v, r), i && i.container && (uu(i, k), di(i), dr(i));
                        ou = !1
                    }
                    hi = l = u.currItem.initialZoomLevel;
                    s = u.currItem.bounds;
                    s && (o.x = s.center.x, o.y = s.center.y, p(!0));
                    c("resize")
                }, zoomTo: function (n, t, i, r, u) {
                    var h, e, c, s, a;
                    t && (hi = l, iu.x = Math.abs(t.x) - o.x, iu.y = Math.abs(t.y) - o.y, g(ir, o));
                    h = ne(n, !1);
                    e = {};
                    oo("x", h, e, n);
                    oo("y", h, e, n);
                    c = l;
                    s = {x: o.x, y: o.y};
                    uo(e);
                    a = function (t) {
                        1 === t ? (l = n, o.x = e.x, o.y = e.y) : (l = (n - c) * t + c, o.x = (e.x - s.x) * t + s.x, o.y = (e.y - s.y) * t + s.y);
                        u && u(t);
                        p(1 === t)
                    };
                    i ? tu("customZoomTo", 0, 1, i, r || f.easing.sine.inOut, a) : a(1)
                }
            }, ho = 30, ie = 10, nt = {}, yi = {}, tt = {}, it = {}, er = {}, ui = [], pi = {}, wi = [], or = {}, nf = 0,
            tf = ti(), re = 0, kt = ti(), iu = ti(), sr = ti(), vs = function (n, t) {
                return n.x === t.x && n.y === t.y
            }, ys = function (n, t) {
                return Math.abs(n.x - t.x) < pe && Math.abs(n.y - t.y) < pe
            }, co = function (n, t) {
                return or.x = Math.abs(n.x - t.x), or.y = Math.abs(n.y - t.y), Math.sqrt(or.x * or.x + or.y * or.y)
            }, ue = function () {
                vu && (lf(vu), vu = null)
            }, lo = function () {
                ct && (vu = lu(lo), gs())
            }, ps = function () {
                return !("fit" === e.scaleMode && l === u.currItem.initialZoomLevel)
            }, ao = function (n, t) {
                return !(!n || n === document) && !(n.getAttribute("class") && n.getAttribute("class").indexOf("pswp__scroll-wrap") > -1) && (t(n) ? n : ao(n.parentNode, t))
            }, fe = {}, vo = function (n, t) {
                return fe.prevent = !ao(n.target, e.isClickableElement), c("preventDragEvent", n, t, fe), fe.prevent
            }, yo = function (n, t) {
                return t.x = n.pageX, t.y = n.pageY, t.id = n.identifier, t
            }, po = function (n, t, i) {
                i.x = .5 * (n.x + t.x);
                i.y = .5 * (n.y + t.y)
            }, ws = function (n, t, i) {
                if (n - au > 50) {
                    var r = wi.length > 2 ? wi.shift() : {};
                    r.x = t;
                    r.y = i;
                    wi.push(r);
                    au = n
                }
            }, wo = function () {
                var n = o.y - u.currItem.initialPosition.y;
                return 1 - Math.abs(n / (k.y / 2))
            }, ru = {}, bs = {}, fi = [], ee = function (n) {
                for (; fi.length > 0;) fi.pop();
                return gt ? (bu = 0, ui.forEach(function (n) {
                    0 === bu ? fi[0] = n : 1 === bu && (fi[1] = n);
                    bu++
                })) : n.type.indexOf("touch") > -1 ? n.touches && n.touches.length > 0 && (fi[0] = yo(n.touches[0], ru), n.touches.length > 1 && (fi[1] = yo(n.touches[1], bs))) : (ru.x = n.pageX, ru.y = n.pageY, ru.id = "", fi[0] = ru), fi
            }, bo = function (n, t) {
                var f, c, a, i, y = 0, r = o[n] + t[n], p = t[n] > 0, h = kt.x + t.x, v = kt.x - pi.x;
                return f = r > s.min[n] || r < s.max[n] ? e.panEndFriction : 1, r = o[n] + t[n] * f, !e.allowPanToNext && l !== u.currItem.initialZoomLevel || (wt ? "h" !== ni || "x" !== n || li || (p ? (r > s.min[n] && (f = e.panEndFriction, y = s.min[n] - r, c = s.min[n] - ir[n]), (c <= 0 || v < 0) && ft() > 1 ? (i = h, v < 0 && h > pi.x && (i = pi.x)) : s.min.x !== s.max.x && (a = r)) : (r < s.max[n] && (f = e.panEndFriction, y = r - s.max[n], c = ir[n] - s.max[n]), (c <= 0 || v > 0) && ft() > 1 ? (i = h, v > 0 && h < pi.x && (i = pi.x)) : s.min.x !== s.max.x && (a = r))) : i = h, "x" !== n) ? void(d || ai || l > u.currItem.fitRatio && (o[n] += t[n] * f)) : (void 0 !== i && (gu(i, !0), ai = i !== pi.x), s.min.x !== s.max.x && (void 0 !== a ? o.x = a : ai || (o.x += t.x * f)), void 0 !== i)
            }, ks = function (n) {
                var i, t, r;
                if (!("mousedown" === n.type && n.button > 0)) {
                    if (hr) return void n.preventDefault();
                    pr && "mousedown" === n.type || ((vo(n, !0) && n.preventDefault(), c("pointerDown"), gt) && (i = f.arraySearch(ui, n.pointerId, "id"), i < 0 && (i = ui.length), ui[i] = {
                        x: n.pageX,
                        y: n.pageY,
                        id: n.pointerId
                    }), t = ee(n), r = t.length, ot = null, nu(), ct && 1 !== r || (ct = wf = !0, f.bind(window, lr, u), yf = wu = yu = yr = ai = tr = pf = li = !1, ni = null, c("firstTouchStart", t), g(ir, o), ii.x = ii.y = 0, g(it, t[0]), g(er, it), pi.x = rt.x * ri, wi = [{
                        x: it.x,
                        y: it.y
                    }], au = no = lt(), ne(l, !0), ue(), lo()), !pt && r > 1 && !d && !ai && (hi = l, li = !1, pt = pf = !0, ii.y = ii.x = 0, g(ir, o), g(nt, t[0]), g(yi, t[1]), po(nt, yi, sr), iu.x = Math.abs(sr.x) - o.x, iu.y = Math.abs(sr.y) - o.y, to = io = co(nt, yi)))
                }
            }, ds = function (n) {
                var i, r, t, u;
                (n.preventDefault(), gt) && (i = f.arraySearch(ui, n.pointerId, "id"), i > -1 && (r = ui[i], r.x = n.pageX, r.y = n.pageY));
                ct && (t = ee(n), ni || tr || pt ? ot = t : kt.x !== rt.x * ri ? ni = "h" : (u = Math.abs(t[0].x - it.x) - Math.abs(t[0].y - it.y), Math.abs(u) >= ie && (ni = u > 0 ? "h" : "v", ot = t)))
            }, gs = function () {
                var r, f, n, y, a, v, w;
                if (ot && (r = ot.length, 0 !== r)) if (g(nt, ot[0]), tt.x = nt.x - it.x, tt.y = nt.y - it.y, pt && r > 1) {
                    if (it.x = nt.x, it.y = nt.y, !tt.x && !tt.y && vs(ot[1], yi)) return;
                    g(yi, ot[1]);
                    li || (li = !0, c("zoomGestureStarted"));
                    f = co(nt, yi);
                    n = uh(f);
                    n > u.currItem.initialZoomLevel + u.currItem.initialZoomLevel / 15 && (wu = !0);
                    var t = 1, i = fo(), h = eo();
                    n < i ? e.pinchToClose && !wu && hi <= u.currItem.initialZoomLevel ? (y = i - n, a = 1 - y / (i / 1.2), bt(a), c("onPinchClose", a), yu = !0) : (t = (i - n) / i, t > 1 && (t = 1), n = i - t * (i / 3)) : n > h && (t = (n - h) / (6 * i), t > 1 && (t = 1), n = h + t * i);
                    t < 0 && (t = 0);
                    to = f;
                    po(nt, yi, tf);
                    ii.x += tf.x - sr.x;
                    ii.y += tf.y - sr.y;
                    g(sr, tf);
                    o.x = kf("x", n);
                    o.y = kf("y", n);
                    yf = n > l;
                    l = n;
                    p()
                } else {
                    if (!ni) return;
                    if (wf && (wf = !1, Math.abs(tt.x) >= ie && (tt.x -= ot[0].x - er.x), Math.abs(tt.y) >= ie && (tt.y -= ot[0].y - er.y)), it.x = nt.x, it.y = nt.y, 0 === tt.x && 0 === tt.y) return;
                    if ("v" === ni && e.closeOnVerticalDrag && !ps()) return ii.y += tt.y, o.y += tt.y, v = wo(), yr = !0, c("onVerticalDrag", v), bt(v), void p();
                    ws(lt(), nt.x, nt.y);
                    tr = !0;
                    s = u.currItem.bounds;
                    w = bo("x", tt);
                    w || (bo("y", tt), uo(o), p())
                }
            }, nh = function (n) {
                var i, h, b, r, v, t, s, k, y, w, nt;
                if (a.isOldAndroid) {
                    if (pr && "mouseup" === n.type) return;
                    n.type.indexOf("touch") > -1 && (clearTimeout(pr), pr = setTimeout(function () {
                        pr = 0
                    }, 600))
                }
                if (c("pointerUp"), vo(n, !1) && n.preventDefault(), gt && (h = f.arraySearch(ui, n.pointerId, "id"), h > -1 && ((i = ui.splice(h, 1)[0], navigator.pointerEnabled) ? i.type = n.pointerType || "mouse" : (b = {
                    4: "mouse",
                    2: "touch",
                    3: "pen"
                }, i.type = b[n.pointerType], i.type || (i.type = n.pointerType || "mouse")))), v = ee(n), t = v.length, "mouseup" === n.type && (t = 0), 2 === t) return ot = null, !0;
                if (1 === t && g(er, v[0]), 0 !== t || ni || d || (i || ("mouseup" === n.type ? i = {
                    x: n.pageX,
                    y: n.pageY,
                    type: "mouse"
                } : n.changedTouches && n.changedTouches[0] && (i = {
                    x: n.changedTouches[0].pageX,
                    y: n.changedTouches[0].pageY,
                    type: "touch"
                })), c("touchRelease", n, i)), s = -1, 0 === t && (ct = !1, f.unbind(window, lr, u), ue(), pt ? s = 0 : re !== -1 && (s = lt() - re)), re = 1 === t ? lt() : -1, r = s !== -1 && s < 150 ? "zoom" : "swipe", pt && t < 2 && (pt = !1, 1 === t && (r = "zoomPointerUp"), c("zoomGestureEnded")), ot = null, tr || li || d || yr) if (nu(), vr || (vr = th()), vr.calculateSwipeSpeed("x"), yr) k = wo(), k < e.verticalDragRange ? u.close() : (y = o.y, w = pu, tu("verticalDrag", 0, 1, 300, f.easing.cubic.out, function (n) {
                    o.y = (u.currItem.initialPosition.y - y) * n + y;
                    bt((1 - w) * n + w);
                    p()
                }), c("onVerticalDrag", 1)); else {
                    if ((ai || d) && 0 === t) {
                        if (nt = rh(r, vr), nt) return;
                        r = "zoomPointerUp"
                    }
                    if (!d) return "swipe" !== r ? void fh() : void(!ai && l > u.currItem.fitRatio && ih(vr))
                }
            }, th = function () {
                var t, i, n = {
                    lastFlickOffset: {},
                    lastFlickDist: {},
                    lastFlickSpeed: {},
                    slowDownRatio: {},
                    slowDownRatioReverse: {},
                    speedDecelerationRatio: {},
                    speedDecelerationRatioAbs: {},
                    distanceOffset: {},
                    backAnimDestination: {},
                    backAnimStarted: {},
                    calculateSwipeSpeed: function (r) {
                        wi.length > 1 ? (t = lt() - au + 50, i = wi[wi.length - 2][r]) : (t = lt() - no, i = er[r]);
                        n.lastFlickOffset[r] = it[r] - i;
                        n.lastFlickDist[r] = Math.abs(n.lastFlickOffset[r]);
                        n.lastFlickSpeed[r] = n.lastFlickDist[r] > 20 ? n.lastFlickOffset[r] / t : 0;
                        Math.abs(n.lastFlickSpeed[r]) < .1 && (n.lastFlickSpeed[r] = 0);
                        n.slowDownRatio[r] = .95;
                        n.slowDownRatioReverse[r] = 1 - n.slowDownRatio[r];
                        n.speedDecelerationRatio[r] = 1
                    },
                    calculateOverBoundsAnimOffset: function (t, i) {
                        n.backAnimStarted[t] || (o[t] > s.min[t] ? n.backAnimDestination[t] = s.min[t] : o[t] < s.max[t] && (n.backAnimDestination[t] = s.max[t]), void 0 !== n.backAnimDestination[t] && (n.slowDownRatio[t] = .7, n.slowDownRatioReverse[t] = 1 - n.slowDownRatio[t], n.speedDecelerationRatioAbs[t] < .05 && (n.lastFlickSpeed[t] = 0, n.backAnimStarted[t] = !0, tu("bounceZoomPan" + t, o[t], n.backAnimDestination[t], i || 300, f.easing.sine.out, function (n) {
                            o[t] = n;
                            p()
                        }))))
                    },
                    calculateAnimOffset: function (t) {
                        n.backAnimStarted[t] || (n.speedDecelerationRatio[t] = n.speedDecelerationRatio[t] * (n.slowDownRatio[t] + n.slowDownRatioReverse[t] - n.slowDownRatioReverse[t] * n.timeDiff / 10), n.speedDecelerationRatioAbs[t] = Math.abs(n.lastFlickSpeed[t] * n.speedDecelerationRatio[t]), n.distanceOffset[t] = n.lastFlickSpeed[t] * n.speedDecelerationRatio[t] * n.timeDiff, o[t] += n.distanceOffset[t])
                    },
                    panAnimLoop: function () {
                        if (ut.zoomPan && (ut.zoomPan.raf = lu(n.panAnimLoop), n.now = lt(), n.timeDiff = n.now - n.lastNow, n.lastNow = n.now, n.calculateAnimOffset("x"), n.calculateAnimOffset("y"), p(), n.calculateOverBoundsAnimOffset("x"), n.calculateOverBoundsAnimOffset("y"), n.speedDecelerationRatioAbs.x < .05 && n.speedDecelerationRatioAbs.y < .05)) return o.x = Math.round(o.x), o.y = Math.round(o.y), p(), void gr("zoomPan")
                    }
                };
                return n
            }, ih = function (n) {
                return n.calculateSwipeSpeed("y"), s = u.currItem.bounds, n.backAnimDestination = {}, n.backAnimStarted = {}, Math.abs(n.lastFlickSpeed.x) <= .05 && Math.abs(n.lastFlickSpeed.y) <= .05 ? (n.speedDecelerationRatioAbs.x = n.speedDecelerationRatioAbs.y = 0, n.calculateOverBoundsAnimOffset("x"), n.calculateOverBoundsAnimOffset("y"), !0) : (te("zoomPan"), n.lastNow = lt(), void n.panAnimLoop())
            }, rh = function (n, t) {
                var r, o, l, a, v, i, s, y;
                return d || (nf = h), "swipe" === n && (l = it.x - er.x, a = t.lastFlickDist.x < 10, l > ho && (a || t.lastFlickOffset.x > 20) ? o = -1 : l < -ho && (a || t.lastFlickOffset.x < -20) && (o = 1)), o && (h += o, h < 0 ? (h = e.loop ? ft() - 1 : 0, v = !0) : h >= ft() && (h = e.loop ? 0 : ft() - 1, v = !0), v && !e.loop || (ht += o, ri -= o, r = !0)), s = rt.x * ri, y = Math.abs(s - kt.x), r || s > kt.x == t.lastFlickSpeed.x > 0 ? (i = Math.abs(t.lastFlickSpeed.x) > 0 ? y / Math.abs(t.lastFlickSpeed.x) : 333, i = Math.min(i, 400), i = Math.max(i, 250)) : i = 333, nf === h && (r = !1), d = !0, c("mainScrollAnimStart"), tu("mainScroll", kt.x, s, i, f.easing.cubic.out, gu, function () {
                    nu();
                    d = !1;
                    nf = -1;
                    (r || nf !== h) && u.updateCurrItem();
                    c("mainScrollAnimComplete")
                }), r && u.updateCurrItem(!0), r
            }, uh = function (n) {
                return 1 / io * n * hi
            }, fh = function () {
                var n = l, t = fo(), r = eo(), e, o, i;
                return l < t ? n = t : l > r && (n = r), o = 1, i = pu, yu && !yf && !wu && l < t ? (u.close(), !0) : (yu && (e = function (n) {
                    bt((o - i) * n + i)
                }), u.zoomTo(n, 0, 200, f.easing.cubic.out, e), !0)
            };
        br("Gestures", {
            publicMethods: {
                initGestures: function () {
                    var n = function (n, t, i, r, u) {
                        su = n + t;
                        hu = n + i;
                        ar = n + r;
                        cu = u ? n + u : ""
                    };
                    gt = a.pointerEvent;
                    gt && a.touch && (a.touch = !1);
                    gt ? navigator.pointerEnabled ? n("pointer", "down", "move", "up", "cancel") : n("MSPointer", "Down", "Move", "Up", "Cancel") : a.touch ? (n("touch", "start", "move", "end", "cancel"), yt = !0) : n("mouse", "down", "move", "up");
                    lr = hu + " " + ar + " " + cu;
                    eu = su;
                    gt && !yt && (yt = navigator.maxTouchPoints > 1 || navigator.msMaxTouchPoints > 1);
                    u.likelyTouchDevice = yt;
                    b[su] = ks;
                    b[hu] = ds;
                    b[ar] = nh;
                    cu && (b[cu] = b[ar]);
                    a.touch && (eu += " mousedown", lr += " mousemove mouseup", b.mousedown = b[su], b.mousemove = b[hu], b.mouseup = b[ar]);
                    yt || (e.allowPanToNext = !1)
                }
            }
        });
        var bi, ei, oe, hr, oi, ft, eh, ko = function (t, i, r, s) {
            var a, v, y, w;
            if (bi && clearTimeout(bi), hr = !0, oe = !0, t.initialLayout ? (a = t.initialLayout, t.initialLayout = null) : a = e.getThumbBoundsFn && e.getThumbBoundsFn(h), v = r ? e.hideAnimationDuration : e.showAnimationDuration, y = function () {
                gr("initialZoom");
                r ? (u.template.removeAttribute("style"), u.bg.removeAttribute("style")) : (bt(1), i && (i.style.display = "block"), f.addClass(n, "pswp--animated-in"), c("initialZoom" + (r ? "OutEnd" : "InEnd")));
                s && s();
                hr = !1
            }, !v || !a || void 0 === a.x) return c("initialZoom" + (r ? "Out" : "In")), l = t.initialZoomLevel, g(o, t.initialPosition), p(), n.style.opacity = r ? 0 : 1, bt(1), void(v ? setTimeout(function () {
                y()
            }, v) : y());
            w = function () {
                var s = of, i = !u.currItem.src || u.currItem.loadError || e.showHideOpacity;
                t.miniImg && (t.miniImg.style.webkitBackfaceVisibility = "hidden");
                r || (l = a.w / t.w, o.x = a.x, o.y = a.y - ge, u[i ? "template" : "bg"].style.opacity = .001, p());
                te("initialZoom");
                r && !s && f.removeClass(n, "pswp--animated-in");
                i && (r ? f[(s ? "remove" : "add") + "Class"](n, "pswp--animate_opacity") : setTimeout(function () {
                    f.addClass(n, "pswp--animate_opacity")
                }, 30));
                bi = setTimeout(function () {
                    if (c("initialZoom" + (r ? "Out" : "In")), r) {
                        var e = a.w / t.w, u = {x: o.x, y: o.y}, h = l, w = pu, b = function (t) {
                            1 === t ? (l = e, o.x = a.x, o.y = a.y - ci) : (l = (e - h) * t + h, o.x = (a.x - u.x) * t + u.x, o.y = (a.y - ci - u.y) * t + u.y);
                            p();
                            i ? n.style.opacity = 1 - t : bt(w - t * w)
                        };
                        s ? tu("initialZoom", 0, 1, v, f.easing.cubic.out, b, y) : (b(1), bi = setTimeout(y, v + 20))
                    } else l = t.initialZoomLevel, g(o, t.initialPosition), p(), bt(1), i ? n.style.opacity = 1 : bt(1), bi = setTimeout(y, v + 20)
                }, r ? 25 : 90)
            };
            w()
        }, st = {}, ki = [], oh = {
            index: 0,
            errorMsg: '<div class="pswp__error-msg"><a href="%url%" target="_blank">The image<\/a> could not be loaded.<\/div>',
            forceProgressiveLoading: !1,
            preload: [1, 1],
            getNumItemsFn: function () {
                return ei.length
            }
        }, go = function () {
            return {center: {x: 0, y: 0}, max: {x: 0, y: 0}, min: {x: 0, y: 0}}
        }, sh = function (n, t, i) {
            var r = n.bounds;
            r.center.x = Math.round((st.x - t) / 2);
            r.center.y = Math.round((st.y - i) / 2) + n.vGap.top;
            r.max.x = t > st.x ? Math.round(st.x - t) : r.center.x;
            r.max.y = i > st.y ? Math.round(st.y - i) + n.vGap.top : r.center.y;
            r.min.x = t > st.x ? 0 : r.center.x;
            r.min.y = i > st.y ? n.vGap.top : r.center.y
        }, uu = function (n, t, i) {
            var r, u, f, o;
            return n.src && !n.loadError ? (r = !i, (r && (n.vGap || (n.vGap = {
                top: 0,
                bottom: 0
            }), c("parseVerticalMargin", n)), st.x = t.x, st.y = t.y - n.vGap.top - n.vGap.bottom, r) && (u = st.x / n.w, f = st.y / n.h, n.fitRatio = u < f ? u : f, o = e.scaleMode, "orig" === o ? i = 1 : "fit" === o && (i = n.fitRatio), i > 1 && (i = 1), n.initialZoomLevel = i, n.bounds || (n.bounds = go())), !i) ? void 0 : (sh(n, n.w * i, n.h * i), r && i === n.initialZoomLevel && (n.initialPosition = n.bounds.center), n.bounds) : (n.w = n.h = 0, n.initialZoomLevel = n.fitRatio = 1, n.bounds = go(), n.initialPosition = n.bounds.center, n.bounds)
        }, rf = function (n, t, i, r, f, e) {
            t.loadError || r && (t.imageAppended = !0, di(t, r, t === u.currItem && vi), i.appendChild(r), e && setTimeout(function () {
                t && t.loaded && t.placeholder && (t.placeholder.style.display = "none", t.placeholder = null)
            }, 500))
        }, ns = function (n) {
            n.loading = !0;
            n.loaded = !1;
            var t = n.img = f.createEl("pswp__img", "img"), i = function () {
                n.loading = !1;
                n.loaded = !0;
                n.loadComplete ? n.loadComplete(n) : n.img = null;
                t.onload = t.onerror = null;
                t = null
            };
            return t.onload = i, t.onerror = function () {
                n.loadError = !0;
                i()
            }, t.src = n.src, t
        }, ts = function (n, t) {
            if (n.src && n.loadError && n.container) return t && (n.container.innerHTML = ""), n.container.innerHTML = e.errorMsg.replace("%url%", n.src), !0
        }, di = function (n, t, i) {
            if (n.src) {
                t || (t = n.container.lastChild);
                var r = i ? n.w : Math.round(n.w * n.fitRatio), u = i ? n.h : Math.round(n.h * n.fitRatio);
                n.placeholder && !n.loaded && (n.placeholder.style.width = r + "px", n.placeholder.style.height = u + "px");
                t.style.width = r + "px";
                t.style.height = u + "px"
            }
        }, is = function () {
            if (ki.length) {
                for (var n, t = 0; t < ki.length; t++) n = ki[t], n.holder.index === n.index && rf(n.index, n.item, n.baseDiv, n.img, !1, n.clearPlaceholder);
                ki = []
            }
        };
        br("Controller", {
            publicMethods: {
                lazyLoadItem: function (n) {
                    n = du(n);
                    var t = oi(n);
                    t && (!t.loaded && !t.loading || ou) && (c("gettingData", n, t), t.src && ns(t))
                }, initController: function () {
                    f.extend(e, oh, !0);
                    u.items = ei = i;
                    oi = u.getItemAt;
                    ft = e.getNumItemsFn;
                    eh = e.loop;
                    ft() < 3 && (e.loop = !1);
                    v("beforeChange", function (n) {
                        for (var i = e.preload, r = null === n || n >= 0, f = Math.min(i[0], ft()), o = Math.min(i[1], ft()), t = 1; t <= (r ? o : f); t++) u.lazyLoadItem(h + t);
                        for (t = 1; t <= (r ? f : o); t++) u.lazyLoadItem(h - t)
                    });
                    v("initialLayout", function () {
                        u.currItem.initialLayout = e.getThumbBoundsFn && e.getThumbBoundsFn(h)
                    });
                    v("mainScrollAnimComplete", is);
                    v("initialZoomInEnd", is);
                    v("destroy", function () {
                        for (var n, t = 0; t < ei.length; t++) n = ei[t], n.container && (n.container = null), n.placeholder && (n.placeholder = null), n.img && (n.img = null), n.preloader && (n.preloader = null), n.loadError && (n.loaded = n.loadError = !1);
                        ki = null
                    })
                }, getItemAt: function (n) {
                    return n >= 0 && void 0 !== ei[n] && ei[n]
                }, allowProgressiveImg: function () {
                    return e.forceProgressiveLoading || !yt || e.mouseUsed || screen.width > 1200
                }, setContent: function (n, t) {
                    var l, o, i, r, v, s;
                    if (e.loop && (t = du(t)), l = u.getItemAt(n.index), l && (l.container = null), i = u.getItemAt(t), !i) return void(n.el.innerHTML = "");
                    c("gettingData", t, i);
                    n.index = t;
                    n.item = i;
                    r = i.container = f.createEl("pswp__zoom-wrap");
                    (!i.src && i.html && (i.html.tagName ? r.appendChild(i.html) : r.innerHTML = i.html), ts(i), uu(i, k), !i.src || i.loadError || i.loaded) ? i.src && !i.loadError && (o = f.createEl("pswp__img", "img"), o.style.opacity = 1, o.src = i.src, di(i, o), rf(t, i, r, o, !0)) : ((i.loadComplete = function (i) {
                        if (gi) {
                            if (n && n.index === t) {
                                if (ts(i, !0)) return i.loadComplete = i.img = null, uu(i, k), dr(i), void(n.index === h && u.updateCurrZoomItem());
                                i.imageAppended ? !hr && i.placeholder && (i.placeholder.style.display = "none", i.placeholder = null) : a.transform && (d || hr) ? ki.push({
                                    item: i,
                                    baseDiv: r,
                                    img: i.img,
                                    index: t,
                                    holder: n,
                                    clearPlaceholder: !0
                                }) : rf(t, i, r, i.img, d || hr, !0)
                            }
                            i.loadComplete = null;
                            i.img = null;
                            c("imageLoadComplete", t, i)
                        }
                    }, f.features.transform) && (v = "pswp__img pswp__img--placeholder", v += i.msrc ? "" : " pswp__img--placeholder--blank", s = f.createEl(v, i.msrc ? "img" : ""), i.msrc && (s.src = i.msrc), di(i, s), r.appendChild(s), i.placeholder = s), i.loading || ns(i), u.allowProgressiveImg() && (!oe && a.transform ? ki.push({
                        item: i,
                        baseDiv: r,
                        img: i.img,
                        index: t,
                        holder: n
                    }) : rf(t, i, r, i.img, !0, !0)));
                    oe || t !== h ? dr(i) : (wt = r.style, ko(i, o || i.img));
                    n.el.innerHTML = "";
                    n.el.appendChild(r)
                }, cleanSlide: function (n) {
                    n.img && (n.img.onload = n.img.onerror = null);
                    n.loaded = n.loading = n.img = n.imageAppended = !1
                }
            }
        });
        uf = {};
        ff = function (n, t, i) {
            var r = document.createEvent("CustomEvent"),
                u = {origEvent: n, target: n.target, releasePoint: t, pointerType: i || "touch"};
            r.initCustomEvent("pswpTap", !0, !0, u);
            n.target.dispatchEvent(r)
        };
        br("Tap", {
            publicMethods: {
                initTap: function () {
                    v("firstTouchStart", u.onTapStart);
                    v("touchRelease", u.onTapRelease);
                    v("destroy", function () {
                        uf = {};
                        si = null
                    })
                }, onTapStart: function (n) {
                    n.length > 1 && (clearTimeout(si), si = null)
                }, onTapRelease: function (n, t) {
                    var i, r;
                    if (t && !tr && !pf && !fr) {
                        if (i = t, si && (clearTimeout(si), si = null, ys(i, uf))) return void c("doubleTap", i);
                        if ("mouse" === t.type) return void ff(n, t, "mouse");
                        if (r = n.target.tagName.toUpperCase(), "BUTTON" === r || f.hasClass(n.target, "pswp__single-tap")) return void ff(n, t);
                        g(uf, i);
                        si = setTimeout(function () {
                            ff(n, t);
                            si = null
                        }, 300)
                    }
                }
            }
        });
        br("DesktopZoom", {
            publicMethods: {
                initDesktopZoom: function () {
                    af || (yt ? v("mouseUsed", function () {
                        u.setupDesktopZoom()
                    }) : u.setupDesktopZoom(!0))
                }, setupDesktopZoom: function (t) {
                    var r, e, i, o;
                    et = {};
                    r = "wheel mousewheel DOMMouseScroll";
                    v("bindEvents", function () {
                        f.bind(n, r, u.handleMouseWheel)
                    });
                    v("unbindEvents", function () {
                        et && f.unbind(n, r, u.handleMouseWheel)
                    });
                    u.mouseZoomedIn = !1;
                    i = function () {
                        u.mouseZoomedIn && (f.removeClass(n, "pswp--zoomed-in"), u.mouseZoomedIn = !1);
                        l < 1 ? f.addClass(n, "pswp--zoom-allowed") : f.removeClass(n, "pswp--zoom-allowed");
                        o()
                    };
                    o = function () {
                        e && (f.removeClass(n, "pswp--dragging"), e = !1)
                    };
                    v("resize", i);
                    v("afterChange", i);
                    v("pointerDown", function () {
                        u.mouseZoomedIn && (e = !0, f.addClass(n, "pswp--dragging"))
                    });
                    v("pointerUp", o);
                    t || i()
                }, handleMouseWheel: function (n) {
                    if (l <= u.currItem.fitRatio) return e.modal && (!e.closeOnScroll || fr || ct ? n.preventDefault() : nr && Math.abs(n.deltaY) > 2 && (of = !0, u.close())), !0;
                    if (n.stopPropagation(), et.x = 0, "deltaX" in n) 1 === n.deltaMode ? (et.x = 18 * n.deltaX, et.y = 18 * n.deltaY) : (et.x = n.deltaX, et.y = n.deltaY); else if ("wheelDelta" in n) n.wheelDeltaX && (et.x = -.16 * n.wheelDeltaX), et.y = n.wheelDeltaY ? -.16 * n.wheelDeltaY : -.16 * n.wheelDelta; else {
                        if (!("detail" in n)) return;
                        et.y = n.detail
                    }
                    ne(l, !0);
                    var t = o.x - et.x, i = o.y - et.y;
                    (e.modal || t <= s.min.x && t >= s.max.x && i <= s.min.y && i >= s.max.y) && n.preventDefault();
                    u.panTo(t, i)
                }, toggleDesktopZoom: function (t) {
                    t = t || {x: k.x / 2 + rr.x, y: k.y / 2 + rr.y};
                    var r = e.getDoubleTapZoom(!0, u.currItem), i = l === r;
                    u.mouseZoomedIn = !i;
                    u.zoomTo(i ? u.currItem.initialZoomLevel : r, t, 333);
                    f[(i ? "remove" : "add") + "Class"](n, "pswp--zoomed-in")
                }
            }
        });
        var se, rs, fu, ef, he, us, w, cr, ce, le, at, ae, hh = {history: !0, galleryUID: 1}, ve = function () {
            return at.hash.substring(1)
        }, fs = function () {
            se && clearTimeout(se);
            fu && clearTimeout(fu)
        }, es = function () {
            var u = ve(), n = {}, t, i, r, f;
            if (u.length < 5) return n;
            for (i = u.split("&"), t = 0; t < i.length; t++) i[t] && (r = i[t].split("="), r.length < 2 || (n[r[0]] = r[1]));
            if (e.galleryPIDs) {
                for (f = n.pid, n.pid = 0, t = 0; t < ei.length; t++) if (ei[t].pid === f) {
                    n.pid = t;
                    break
                }
            } else n.pid = parseInt(n.pid, 10) - 1;
            return n.pid < 0 && (n.pid = 0), n
        }, ye = function () {
            var t, i, n, r;
            if (fu && clearTimeout(fu), fr || ct) return void(fu = setTimeout(ye, 500));
            ef ? clearTimeout(rs) : ef = !0;
            t = h + 1;
            i = oi(h);
            i.hasOwnProperty("pid") && (t = i.pid);
            n = w + "&gid=" + e.galleryUID + "&pid=" + t;
            cr || at.hash.indexOf(n) === -1 && (le = !0);
            r = at.href.split("#")[0] + "#" + n;
            ae ? "#" + n !== window.location.hash && history[cr ? "replaceState" : "pushState"]("", document.title, r) : cr ? at.replace(r) : at.hash = n;
            cr = !0;
            rs = setTimeout(function () {
                ef = !1
            }, 60)
        };
        br("History", {
            publicMethods: {
                initHistory: function () {
                    var n, t;
                    (f.extend(e, hh, !0), e.history) && (at = window.location, le = !1, ce = !1, cr = !1, w = ve(), ae = "pushState" in history, w.indexOf("gid=") > -1 && (w = w.split("&gid=")[0], w = w.split("?gid=")[0]), v("afterChange", u.updateURL), v("unbindEvents", function () {
                        f.unbind(window, "hashchange", u.onHashChange)
                    }), n = function () {
                        us = !0;
                        ce || (le ? history.back() : w ? at.hash = w : ae ? history.pushState("", document.title, at.pathname + at.search) : at.hash = "");
                        fs()
                    }, v("unbindEvents", function () {
                        of && n()
                    }), v("destroy", function () {
                        us || n()
                    }), v("firstUpdate", function () {
                        h = es().pid
                    }), t = w.indexOf("pid="), t > -1 && (w = w.substring(0, t), "&" === w.slice(-1) && (w = w.slice(0, -1))), setTimeout(function () {
                        gi && f.bind(window, "hashchange", u.onHashChange)
                    }, 40))
                }, onHashChange: function () {
                    return ve() === w ? (ce = !0, void u.close()) : void(ef || (he = !0, u.goTo(es().pid), he = !1))
                }, updateURL: function () {
                    fs();
                    he || (cr ? se = setTimeout(ye, 800) : ye())
                }
            }
        });
        f.extend(u, as)
    }
});
/*! PhotoSwipe Default UI - 4.1.2 - 2017-04-05
* http://photoswipe.com
* Copyright (c) 2017 Dmitry Semenov; */
!function (n, t) {
    "function" == typeof define && define.amd ? define(t) : "object" == typeof exports ? module.exports = t() : n.PhotoSwipeUI_Default = t()
}(this, function () {
    "use strict";
    return function (n, t) {
        var e, u, a, c, rt, ut, s, ft, b, f, et, ot, st, ht, i, y, yt, k, d, r = this, g = !1, h = !0, o = !0, pt = {
            barsSize: {top: 44, bottom: "auto"},
            closeElClasses: ["item", "caption", "zoom-wrap", "ui", "top-bar"],
            timeToIdle: 4e3,
            timeToIdleOutside: 1e3,
            loadingIndicatorDelay: 1e3,
            addCaptionHTMLFn: function (n, t) {
                return n.title ? (t.children[0].innerHTML = n.title, !0) : (t.children[0].innerHTML = "", !1)
            },
            closeEl: !0,
            captionEl: !0,
            fullscreenEl: !0,
            zoomEl: !0,
            shareEl: !0,
            counterEl: !0,
            arrowEl: !0,
            preloaderEl: !0,
            tapToClose: !1,
            tapToToggleControls: !0,
            clickToCloseNonZoomable: !0,
            shareButtons: [{
                id: "facebook",
                label: "Share on Facebook",
                url: "https://www.facebook.com/sharer/sharer.php?u={{url}}"
            }, {
                id: "twitter",
                label: "Tweet",
                url: "https://twitter.com/intent/tweet?text={{text}}&url={{url}}"
            }, {
                id: "pinterest",
                label: "Pin it",
                url: "http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}"
            }, {id: "download", label: "Download image", url: "{{raw_image_url}}", download: !0}],
            getImageURLForShare: function () {
                return n.currItem.src || ""
            },
            getPageURLForShare: function () {
                return window.location.href
            },
            getTextForShare: function () {
                return n.currItem.title || ""
            },
            indexIndicatorSep: " / ",
            fitControlsWidth: 1200
        }, ct = function (n) {
            var e;
            if (y) return !0;
            n = n || window.event;
            i.timeToIdle && i.mouseUsed && !b && it();
            for (var r, f, o = n.target || n.srcElement, s = o.getAttribute("class") || "", u = 0; u < w.length; u++) r = w[u], r.onTap && s.indexOf("pswp__" + r.name) > -1 && (r.onTap(), f = !0);
            f && (n.stopPropagation && n.stopPropagation(), y = !0, e = t.features.isOldAndroid ? 600 : 30, yt = setTimeout(function () {
                y = !1
            }, e))
        }, wt = function () {
            return !n.likelyTouchDevice || i.mouseUsed || screen.width > i.fitControlsWidth
        }, l = function (n, i, r) {
            t[(r ? "add" : "remove") + "Class"](n, "pswp__" + i)
        }, lt = function () {
            var n = 1 === i.getNumItemsFn();
            n !== ht && (l(u, "ui--one-slide", n), ht = n)
        }, at = function () {
            l(s, "share-modal--hidden", o)
        }, v = function () {
            return o = !o, o ? (t.removeClass(s, "pswp__share-modal--fade-in"), setTimeout(function () {
                o && at()
            }, 300)) : (at(), setTimeout(function () {
                o || t.addClass(s, "pswp__share-modal--fade-in")
            }, 30)), o || kt(), !1
        }, bt = function (t) {
            t = t || window.event;
            var i = t.target || t.srcElement;
            return n.shout("shareLinkClick", t, i), !!i.href && (!!i.hasAttribute("download") || (window.open(i.href, "pswp_share", "scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=550,height=420,top=100,left=" + (window.screen ? Math.round(screen.width / 2 - 275) : 100)), o || v(), !1))
        }, kt = function () {
            for (var n, f, r, e, o, t = "", u = 0; u < i.shareButtons.length; u++) n = i.shareButtons[u], r = i.getImageURLForShare(n), e = i.getPageURLForShare(n), o = i.getTextForShare(n), f = n.url.replace("{{url}}", encodeURIComponent(e)).replace("{{image_url}}", encodeURIComponent(r)).replace("{{raw_image_url}}", r).replace("{{text}}", encodeURIComponent(o)), t += '<a href="' + f + '" target="_blank" class="pswp__share--' + n.id + '"' + (n.download ? "download" : "") + ">" + n.label + "<\/a>", i.parseShareButtonOut && (t = i.parseShareButtonOut(n, t));
            s.children[0].innerHTML = t;
            s.children[0].onclick = bt
        }, nt = function (n) {
            for (var r = 0; r < i.closeElClasses.length; r++) if (t.hasClass(n, "pswp__" + i.closeElClasses[r])) return !0
        }, tt = 0, it = function () {
            clearTimeout(d);
            tt = 0;
            b && r.setIdle(!1)
        }, vt = function (n) {
            n = n ? n : window.event;
            var t = n.relatedTarget || n.toElement;
            t && "HTML" !== t.nodeName || (clearTimeout(d), d = setTimeout(function () {
                r.setIdle(!0)
            }, i.timeToIdleOutside))
        }, dt = function () {
            i.fullscreenEl && !t.features.isOldAndroid && (e || (e = r.getFullscreenAPI()), e ? (t.bind(document, e.eventK, r.updateFullscreen), r.updateFullscreen(), t.addClass(n.template, "pswp--supports-fs")) : t.removeClass(n.template, "pswp--supports-fs"))
        }, gt = function () {
            i.preloaderEl && (p(!0), f("beforeChange", function () {
                clearTimeout(st);
                st = setTimeout(function () {
                    n.currItem && n.currItem.loading ? (!n.allowProgressiveImg() || n.currItem.img && !n.currItem.img.naturalWidth) && p(!1) : p(!0)
                }, i.loadingIndicatorDelay)
            }), f("imageLoadComplete", function (t, i) {
                n.currItem === i && p(!0)
            }))
        }, p = function (n) {
            ot !== n && (l(et, "preloader--active", !n), ot = n)
        }, ni = function (n) {
            var r = n.vGap, f, e;
            wt() ? (f = i.barsSize, i.captionEl && "auto" === f.bottom ? (c || (c = t.createEl("pswp__caption pswp__caption--fake"), c.appendChild(t.createEl("pswp__caption__center")), u.insertBefore(c, a), t.addClass(u, "pswp__ui--fit")), i.addCaptionHTMLFn(n, c, !0)) ? (e = c.clientHeight, r.bottom = parseInt(e, 10) || 44) : r.bottom = f.top : r.bottom = "auto" === f.bottom ? 0 : f.bottom, r.top = f.top) : r.top = r.bottom = 0
        }, ti = function () {
            i.timeToIdle && f("mouseUsed", function () {
                t.bind(document, "mousemove", it);
                t.bind(document, "mouseout", vt);
                k = setInterval(function () {
                    tt++;
                    2 === tt && r.setIdle(!0)
                }, i.timeToIdle / 2)
            })
        }, ii = function () {
            f("onVerticalDrag", function (n) {
                h && n < .95 ? r.hideControls() : !h && n >= .95 && r.showControls()
            });
            var n;
            f("onPinchClose", function (t) {
                h && t < .9 ? (r.hideControls(), n = !0) : n && !h && t > .9 && r.showControls()
            });
            f("zoomGestureEnded", function () {
                n = !1;
                n && !h && r.showControls()
            })
        }, w = [{
            name: "caption", option: "captionEl", onInit: function (n) {
                a = n
            }
        }, {
            name: "share-modal", option: "shareEl", onInit: function (n) {
                s = n
            }, onTap: function () {
                v()
            }
        }, {
            name: "button--share", option: "shareEl", onInit: function (n) {
                ut = n
            }, onTap: function () {
                v()
            }
        }, {name: "button--zoom", option: "zoomEl", onTap: n.toggleDesktopZoom}, {
            name: "counter",
            option: "counterEl",
            onInit: function (n) {
                rt = n
            }
        }, {name: "button--close", option: "closeEl", onTap: n.close}, {
            name: "button--arrow--left",
            option: "arrowEl",
            onTap: n.prev
        }, {name: "button--arrow--right", option: "arrowEl", onTap: n.next}, {
            name: "button--fs",
            option: "fullscreenEl",
            onTap: function () {
                e.isFullscreen() ? e.exit() : e.enter()
            }
        }, {
            name: "preloader", option: "preloaderEl", onInit: function (n) {
                et = n
            }
        }], ri = function () {
            var n, e, r, o = function (u) {
                var s, f, o;
                if (u) for (s = u.length, f = 0; f < s; f++) for (n = u[f], e = n.className, o = 0; o < w.length; o++) r = w[o], e.indexOf("pswp__" + r.name) > -1 && (i[r.option] ? (t.removeClass(n, "pswp__element--disabled"), r.onInit && r.onInit(n)) : t.addClass(n, "pswp__element--disabled"))
            }, f;
            o(u.children);
            f = t.getChildByClass(u, "pswp__top-bar");
            f && o(f.children)
        };
        r.init = function () {
            t.extend(n.options, pt, !0);
            i = n.options;
            u = t.getChildByClass(n.scrollWrap, "pswp__ui");
            f = n.listen;
            ii();
            f("beforeChange", r.update);
            f("doubleTap", function (t) {
                var r = n.currItem.initialZoomLevel;
                n.getZoomLevel() !== r ? n.zoomTo(r, t, 333) : n.zoomTo(i.getDoubleTapZoom(!1, n.currItem), t, 333)
            });
            f("preventDragEvent", function (n, t, i) {
                var r = n.target || n.srcElement;
                r && r.getAttribute("class") && n.type.indexOf("mouse") > -1 && (r.getAttribute("class").indexOf("__caption") > 0 || /(SMALL|STRONG|EM)/i.test(r.tagName)) && (i.prevent = !1)
            });
            f("bindEvents", function () {
                t.bind(u, "pswpTap click", ct);
                t.bind(n.scrollWrap, "pswpTap", r.onGlobalTap);
                n.likelyTouchDevice || t.bind(n.scrollWrap, "mouseover", r.onMouseOver)
            });
            f("unbindEvents", function () {
                o || v();
                k && clearInterval(k);
                t.unbind(document, "mouseout", vt);
                t.unbind(document, "mousemove", it);
                t.unbind(u, "pswpTap click", ct);
                t.unbind(n.scrollWrap, "pswpTap", r.onGlobalTap);
                t.unbind(n.scrollWrap, "mouseover", r.onMouseOver);
                e && (t.unbind(document, e.eventK, r.updateFullscreen), e.isFullscreen() && (i.hideAnimationDuration = 0, e.exit()), e = null)
            });
            f("destroy", function () {
                i.captionEl && (c && u.removeChild(c), t.removeClass(a, "pswp__caption--empty"));
                s && (s.children[0].onclick = null);
                t.removeClass(u, "pswp__ui--over-close");
                t.addClass(u, "pswp__ui--hidden");
                r.setIdle(!1)
            });
            i.showAnimationDuration || t.removeClass(u, "pswp__ui--hidden");
            f("initialZoomIn", function () {
                i.showAnimationDuration && t.removeClass(u, "pswp__ui--hidden")
            });
            f("initialZoomOut", function () {
                t.addClass(u, "pswp__ui--hidden")
            });
            f("parseVerticalMargin", ni);
            ri();
            i.shareEl && ut && s && (o = !0);
            lt();
            ti();
            dt();
            gt()
        };
        r.setIdle = function (n) {
            b = n;
            l(u, "ui--idle", n)
        };
        r.update = function () {
            h && n.currItem ? (r.updateIndexIndicator(), i.captionEl && (i.addCaptionHTMLFn(n.currItem, a), l(a, "caption--empty", !n.currItem.title)), g = !0) : g = !1;
            o || v();
            lt()
        };
        r.updateFullscreen = function (i) {
            i && setTimeout(function () {
                n.setScrollOffset(0, t.getScrollY())
            }, 50);
            t[(e.isFullscreen() ? "add" : "remove") + "Class"](n.template, "pswp--fs")
        };
        r.updateIndexIndicator = function () {
            i.counterEl && (rt.innerHTML = n.getCurrentIndex() + 1 + i.indexIndicatorSep + i.getNumItemsFn())
        };
        r.onGlobalTap = function (u) {
            u = u || window.event;
            var f = u.target || u.srcElement;
            if (!y) if (u.detail && "mouse" === u.detail.pointerType) {
                if (nt(f)) return void n.close();
                t.hasClass(f, "pswp__img") && (1 === n.getZoomLevel() && n.getZoomLevel() <= n.currItem.fitRatio ? i.clickToCloseNonZoomable && n.close() : n.toggleDesktopZoom(u.detail.releasePoint))
            } else if (i.tapToToggleControls && (h ? r.hideControls() : r.showControls()), i.tapToClose && (t.hasClass(f, "pswp__img") || nt(f))) return void n.close()
        };
        r.onMouseOver = function (n) {
            n = n || window.event;
            var t = n.target || n.srcElement;
            l(u, "ui--over-close", nt(t))
        };
        r.hideControls = function () {
            t.addClass(u, "pswp__ui--hidden");
            h = !1
        };
        r.showControls = function () {
            h = !0;
            g || r.update();
            t.removeClass(u, "pswp__ui--hidden")
        };
        r.supportsFullscreen = function () {
            var n = document;
            return !!(n.exitFullscreen || n.mozCancelFullScreen || n.webkitExitFullscreen || n.msExitFullscreen)
        };
        r.getFullscreenAPI = function () {
            var t, r = document.documentElement, u = "fullscreenchange";
            return r.requestFullscreen ? t = {
                enterK: "requestFullscreen",
                exitK: "exitFullscreen",
                elementK: "fullscreenElement",
                eventK: u
            } : r.mozRequestFullScreen ? t = {
                enterK: "mozRequestFullScreen",
                exitK: "mozCancelFullScreen",
                elementK: "mozFullScreenElement",
                eventK: "moz" + u
            } : r.webkitRequestFullscreen ? t = {
                enterK: "webkitRequestFullscreen",
                exitK: "webkitExitFullscreen",
                elementK: "webkitFullscreenElement",
                eventK: "webkit" + u
            } : r.msRequestFullscreen && (t = {
                enterK: "msRequestFullscreen",
                exitK: "msExitFullscreen",
                elementK: "msFullscreenElement",
                eventK: "MSFullscreenChange"
            }), t && (t.enter = function () {
                return ft = i.closeOnScroll, i.closeOnScroll = !1, "webkitRequestFullscreen" !== this.enterK ? n.template[this.enterK]() : void n.template[this.enterK](Element.ALLOW_KEYBOARD_INPUT)
            }, t.exit = function () {
                return i.closeOnScroll = ft, document[this.exitK]()
            }, t.isFullscreen = function () {
                return document[this.elementK]
            }), t
        }
    }
}), function (n) {
    n.fn.photoSwipe = function (t) {
        var i = n.extend({
            minWidth: 0,
            minHeight: 0,
            bgOpacity: .87,
            history: !1,
            className: "lightbox",
            galleryUID: 1,
            getThumbBoundsFn: function (t) {
                var i = n(n.fn.photoSwipe.items[t].el);
                return {x: i.offset().left, y: i.offset().top, w: i.width()}
            }
        }, t), r = n(".pswp"), u;
        return r.length < 1 && (r = n('<div class="pswp" tabindex=-1 role=dialog aria-hidden=true><div class=pswp__bg><\/div><div class=pswp__scroll-wrap><div class=pswp__container><div class=pswp__item><\/div><div class=pswp__item><\/div><div class=pswp__item><\/div><\/div><div class="pswp__ui pswp__ui--hidden"><div class=pswp__top-bar><div class=pswp__counter><\/div><button class="pswp__button pswp__button--close" title="Close (Esc)"><\/button> <button class="pswp__button pswp__button--share" title=Share><\/button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"><\/button> <button class="pswp__button pswp__button--zoom" title="Zoom in/out"><\/button><div class=pswp__preloader><div class=pswp__preloader__icn><div class=pswp__preloader__cut><div class=pswp__preloader__donut><\/div><\/div><\/div><\/div><\/div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class=pswp__share-tooltip><\/div><\/div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"><\/button> <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"><\/button><div class=pswp__caption><div class=pswp__caption__center><\/div><\/div><\/div><\/div><\/div>'), n("body").append(r)), u = r[0], n.fn.photoSwipe.items = [], this.filter("img[src]").on("load", function () {
            var t = n(this), r = {
                src: t.attr("src"),
                w: parseInt(t.prop("naturalWidth")),
                h: parseInt(t.prop("naturalHeight")),
                title: t.attr("alt"),
                el: this,
                i: parseInt(t.attr("data-i"))
            };
            (r.w > i.minWidth || r.h > i.minHeight) && (n.fn.photoSwipe.items.push(r), n.fn.photoSwipe.items.sort(function (n, t) {
                return parseFloat(n.i) - parseFloat(t.i)
            }), t.addClass("lightbox"), t.off("click").click(function (r) {
                var f = 0, e, o;
                n.each(n.fn.photoSwipe.items, function (n, i) {
                    i.src == t.attr("src") && (f = n)
                });
                e = {
                    history: i.history,
                    bgOpacity: i.bgOpacity,
                    galleryUID: i.galleryUID,
                    index: f,
                    getThumbBoundsFn: i.getThumbBoundsFn
                };
                o = new PhotoSwipe(u, PhotoSwipeUI_Default, n.fn.photoSwipe.items, e);
                o.init();
                r.preventDefault();
                console.log(f);
                console.log(n.fn.photoSwipe.items)
            }))
        }).each(function (t) {
            n(this).attr("data-i", t);
            this.complete && n(this).trigger("load");
            console.log("reload")
        }), this
    }
}(jQuery);
$(function () {
    $(".textview img[src]").photoSwipe({minWidth: 200, minHeight: 200})
});
$(function () {
    if ($(".sharebox .more-share,.sharebox .zalo-share,.sharebox ,.sharebox .twitter-share,.sharebox .fb-share").length != 0) {
        var i = "579745863508352884", n = $("body"), r = $("link[rel=canonical]").attr("href"),
            t = typeof r == "string" ? r : location.protocol + "//" + location.hostname + location.pathname, u = "",
            f = "";
        if (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent) || (u = '<div id="qrcode" class="hide" ><center><img alt="Mã QR Code" src="https://chart.apis.google.com/chart?cht=qr&amp;chs=100x100&amp;chld=L|0&amp;chl=' + encodeURIComponent(t + (t.indexOf("?") > 0 ? "&" : "?") + "utm_source=desktop&utm_medium=qrcode&utm_campaign=share") + '"/><\/center><p>Bạn có thể dùng ứng dụng đọc <a href="//tip.down.vn/huong-dan-su-dung-qr-code-tren-dien-thoai-150" target="_blank">QR Code<\/a> trên điện thoại để mở đường dẫn này<br><a href="//tip.down.vn/huong-dan-su-dung-qr-code-tren-dien-thoai-150" target="_blank">Xem hướng dẫn tại đây<\/a>.<\/p><\/div>', f = '<a class="qrcode-share" title="Sử dụng ứng dụng quét QR Code để mở trên điện thoại"><span class="icon-share icon-qrcode"><\/span><i>Quét bằng  QR Code<\/i><\/a>', $(".sharebox .qrcode-share").removeClass("hide")), $("<div class='overlay-share'><\/div>").appendTo("body"), $("<div class='toggle-share' title='Chia sẻ'><\/div>").appendTo("body"), $('<div class="dialog-share"><div class="share-title">Chia sẻ<\/div><a class="fb-share" title="Chia sẻ Facebook"><span class="icon-share icon-fb"><\/span><i>Chia sẻ Facebook<\/i><\/a><a class="zalo-share zalo-share-button" title="Chia sẻ Zalo"><span class="icon-share icon-zalo "><\/span><i>Chia sẻ Zalo<\/i><\/a><a class="twitter-share" title="Chia sẻ qua Twitter"><span class="icon-share icon-twitter"><\/span><i>Chia sẻ Twitter<\/i><\/a>' + f + "" + u + '<div class="close-box-share">Đóng<\/div><\/div>').appendTo("body"), $(".more-share , .toggle-share").click(function () {
            n.toggleClass("share")
        }), $(".overlay-share , .close-box-share").click(function () {
            n.removeClass("share")
        }), $(".zalo-share").attr("data-href", t).attr("data-oaid", i).attr("data-layout", "icon-text").attr("data-customize", "true").addClass("zalo-share-button").click(function () {
            var u = window.btoa(JSON.stringify({url: t})),
                r = "https://sp.zalo.me/share?v=2&oa=" + i + "&d=" + encodeURIComponent(u);
            r = "https://id.zalo.me/account?continue=" + encodeURIComponent(r);
            window.open(r);
            n.removeClass("share")
        }), $(".sharebox>.qrcode-share").click(function () {
            n.addClass("share");
            $(".dialog-share  #qrcode").removeClass("hide")
        }), $(".dialog-share .qrcode-share").click(function () {
            $(".dialog-share  #qrcode").toggleClass("hide")
        }), $(".fb-share").click(function () {
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(t));
            n.removeClass("share")
        }), $(".twitter-share").click(function () {
            window.open("http://twitter.com/intent/tweet?url=" + encodeURIComponent(t) + "&text=" + encodeURIComponent(document.title));
            n.removeClass("share")
        }), typeof ga == "function") $(".zalo-share,.fb-share,.twitter-share").on("click", function () {
            var n = $(this);
            ga("send", "event", "Share", n.attr("class"), location.href)
        })
    }
});