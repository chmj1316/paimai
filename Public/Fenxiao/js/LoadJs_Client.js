function LoadJs(Path, time) {
    if (time && time != "") {
        Path = Path + "?time=" + time;
    }
    document.write("<script type=\"text/javascript\" src=\"" + Path + "\"></script>");
}

function LoadCss(Path, time) {
    if (time != "") {
        Path = Path + "?time=" + time;
    }
    document.write("<link href=\"" + Path + "\" rel=\"stylesheet\" />");
}

var time = Math.floor(Math.random() * 100000000);
var time2 = "20151021100888888888";

// LoadJs("/Mall/Shop/JS/Lib/Ibayton.js", time2);
// LoadJs("/Mall/Shop/JS/Lib/Str.js", time2);
// LoadJs("/Mall/Shop/JS/Lib/Lib.js", time2);
// LoadJs("/Mall/Shop/JS/Lib/URL.js", time2);
// LoadJs("/Mall/Shop/JS/Lib/OpenWinDarg.js", time2);
// LoadJs("/Mall/Shop/JS/Lib/DivMove.js", time2);
// LoadJs("/Mall/Shop/JS/LIB/DoCookies.js", time2);
// LoadJs("/Mall/Shop/JS/LIB/jquery-1.8.3.min.js");
// LoadJs("/Mall/Shop/JS/LIB/jquery.lazyload.min.js");
// LoadJs("/Mall/Shop/JS/Web/Back.js");
// LoadJs("/Mall/Shop/JS/Web/AllList.js", time2);
// LoadJs("/Mall/Shop/JS/Html/HtmlJs.aspx", time);//HTML页面装载的JS
// LoadJs("/Mall/Shop/JS/Web/Lib.js", time);
// LoadJs("/Mall/Shop/JS/Web/Share.aspx?url=" + encodeURIComponent(location.href) + "&time=" + time,"");
// LoadJs("/Mall/Shop/JS/Web/Visit.js", time);
