
function AttentionMsg(img, url) {
    var RowString = "<div class=\"out\">" +
                    "<div class=\"outTop\"><div class=\"touXiang\"><img id=\"touXiang\" src=\"" + img + "\" /></div><div class=\"share\"><h1>请关注后分享</h1><p>快乐源自分享</p></div></div>" +
                    "<div class=\"outMid\"><p>关注公众号？</p></div>" +
                    "<div class=\"outBot\"><a href=\"" + url + "\" class=\"yes\">现在关注</a><a onclick=\"document.getElementById('AttentionBottom').style.display='none'\" href=\"javascript:\">下次关注</a></div>" +
                    "<div class=\"close\" onclick=\"document.getElementById('AttentionBottom').style.display='none'\"><a href=\"javascript:\"></a></div>" +
                    "</div>";

    $1("AttentionBottom").style.display = "";
    $1("AttentionBottom").innerHTML = RowString;
    //alert(RowString);
    //document.write(RowString);
}

function AttentionMsgAlter() { 
    ExecAJ("AttentionMsgAlter", null, "funMsg");
}

function funMsg(text) {
  
    var img = "";
    try {
        img = document.getElementById("AttentionDIV").getAttribute("img");
    }
    catch (e)
    { }
    
    if (text != "") {
        var array = new Array();
        array = text.split("@#@");
        if (IsWeiXin())
        {
            AttentionMsg(array[0], array[1]);
        }
    }

}

AttentionMsgAlter();

//是否微信登录
function IsWeiXin() {
    var ua = window.navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
        return true;
    } else {
        return false;
    }
}