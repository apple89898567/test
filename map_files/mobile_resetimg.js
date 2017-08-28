$(function () {
    var wh = 0;

    $(".infocontent img").each(function () {
        if ($(this).width() > $(document.body).width()) {
            $(this).css("width", "100%");
            $(this).css("height", "auto");
            $(this).css("display", "block");
            $(this).css("margin", "0");
            if ($(this).parent().prop("nodeName") != "A") {
                $(this).wrap("<a href=\"" + $(this).attr("src") + "\" target=\"_blank\"></a>");
            }
        }
    });
    $(".infocontent table").each(function () {
        $(this).attr("width", "98%");
        $("td", this).attr("background", "");
        $("td", this).attr("height", "");
    });

    $("#mapbarframe").each(function () {
        wh = $(".infocontent").innerWidth();
        $(this).attr("width", "98%");
        var w = $(this).innerWidth();
        $(this).attr("height", wh);
        var newurl = "http://searchbox.mapbar.com/publish/template/template1010/index.jsp?CID=ddshuanglong&tid=tid1010&showSearchDiv=1&cityName=%E4%B8%B9%E4%B8%9C%E5%B8%82&nid=MAPBYNJBYWSICEQMXRHMX&width=" + w + "&height=" + wh + "&infopoi=2&zoom=10&control=1";
        $(this).attr("src", newurl);
    });

    //document.body.style.height = document.body.clientHeight + document.getElementById("botmenu").offsetHeight + "px";
    //$(document.body).height() = $(document.body).scrollHeight() + $("#menu1").scrollHeight();
    //alert($("#menu1").height());
    //alert(document.body.clientHeight);
    //$(".nr").css("paddingBottom", $("#botmenu").css('height'));

    //if ($(".nr").height() < window.screen.height) {
    //    document.body.style.height = window.screen.height + document.getElementById("botmenu").offsetHeight + wh + "px";
    //}
    //else {
        $(".nr").css("paddingBottom", $("#botmenu").css('height'));
    //}
    document.body.style.paddingBottom = document.getElementById("botmenu").Height + "px";
});

function iFrameHeight(iframeid) {
    var ifm = document.getElementById(iframeid);
    var subWeb = document.frames ? document.frames[iframeid].document : ifm.contentDocument;
    if (ifm != null && subWeb != null) {
        ifm.height = subWeb.body.scrollHeight + 50;
        ifm.width = subWeb.body.scrollWidth;
    }
}