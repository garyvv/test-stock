var resize = {
    init: function () {
        window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function () {
            window.location.href = window.location.href
        }, false);
        var fs = $(window).width() / 6.4;
        if (fs >= 100) {
            fs = 100;
        }
        $("html").css('cssText','font-size:'+fs + 'px !important;');
    }
};
resize.init();
