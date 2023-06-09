!function(a) {
    jQuery.fn[a] = function(e) {
        return e ? this.bind("resize", (t = e,
                function() {
                    var e = this, a = arguments;
                    i ? clearTimeout(i) : n && t.apply(e, a),
                        i = setTimeout(function() {
                            n || t.apply(e, a),
                                i = null
                        }, o || 100)
                }
        )) : this.trigger(a);
        var t, o, n, i
    }
}((jQuery,"smartresize"));

const CURRENT_URL = window.location.href.split("#")[0].split("?")[0];
const $BODY = $("body");
const $MENU_TOGGLE = $("#menu_toggle");
const $SIDEBAR_MENU = $("#sidebar-menu");
const $SIDEBAR_FOOTER = $(".sidebar-footer");
const $LEFT_COL = $(".left_col");
const $RIGHT_COL = $(".right_col");
const $NAV_MENU = $(".nav_menu");
const $FOOTER = $("footer");


function t() {
    $RIGHT_COL.css("min-height", $(window).height());
    let e = $BODY.outerHeight();
    let a = $BODY.hasClass("footer_fixed") ? -10 : $FOOTER.height();
    let t = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height();
    let o = e < t ? t : e;
    o -= $NAV_MENU.height() + a;
    $RIGHT_COL.css("min-height", o);
}
function o() {
    $SIDEBAR_MENU.find("li").removeClass("active active-sm");
    $SIDEBAR_MENU.find("li ul").slideUp();
}

$SIDEBAR_MENU.find("a").on("click", function(e) {
    var a = $(this).parent();
    a.is(".active") ? (
        a.removeClass("active active-sm"),
        $("ul:first", a).slideUp(function() {
            t()
        })
    ) : (
        a.parent().is(".child_menu") ? $BODY.is("nav-sm") && (a.parent().is("child_menu") || o()) : o(),
        a.addClass("active"),
        $("ul:first", a).slideDown(function() {
            t()
        })
    )
});
$MENU_TOGGLE.on("click", function() {
    $BODY.hasClass("nav-md") ? ($SIDEBAR_MENU.find("li.active ul").hide(),
        $SIDEBAR_MENU.find("li.active").addClass("active-sm").removeClass("active")) : ($SIDEBAR_MENU.find("li.active-sm ul").show(),
        $SIDEBAR_MENU.find("li.active-sm").addClass("active").removeClass("active-sm")),
        $BODY.toggleClass("nav-md nav-sm"),
        t(),
        $(".dataTable").each(function() {
            $(this).dataTable().fnDraw()
        })
});
$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent("li").addClass("current-page");
$SIDEBAR_MENU.find("a").filter(function() {
    return this.href == CURRENT_URL
}).parent("li").addClass("current-page").parents("ul").slideDown(function() {
    t()
}).parent().addClass("active");
$(window).smartresize(function() {
    t()
});
t();

$.fn.mCustomScrollbar && $(".menu_fixed").mCustomScrollbar({
    autoHideScrollbar: !0,
    theme: "minimal",
    mouseWheel: {
        preventDefault: !0
    }
});

$(".collapse-link").on("click", function() {
    var e = $(this).closest(".x_panel");
    var a = $(this).find("i");
    var t = e.find(".x_content");

    if (e.attr("style")){
        t.slideToggle(200, function() { e.removeAttr("style") })
    }else{
        t.slideToggle(200);
        e.css("height", "auto")
    }

    a.toggleClass("fa-chevron-up fa-chevron-down")

});

$(".close-link").click(function() {
    $(this).closest(".x_panel").remove()
});

$('[data-toggle="tooltip"]').tooltip({
    container: "body"
})



