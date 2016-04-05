 
function IsWeiXin() {
    var ua = window.navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
        return true;
    } else {
        return false;
    }
}

function QQAlter() {
    ExecAJ("QQAlter", null, "funQQ");
}

function funQQ(text) {
    if (IsWeiXin())
    {
        if (text != "") {
            $1("floatTools").style.display = "";
            $1("floatTools").innerHTML = text;
            $("#aFloatTools_Show").click(function () {
                var dis = document.getElementById("divFloatToolsView").style.display;
                if (dis == "none") {
                    $('#divFloatToolsView').animate({ width: 'show', opacity: 'show' }, 100, function () { $('#divFloatToolsView').show(); });
                } else {
                    $('#divFloatToolsView').animate({ width: 'hide', opacity: 'hide' }, 100, function () { $('#divFloatToolsView').hide(); });
                }
            });
        }

    }   
}

QQAlter();