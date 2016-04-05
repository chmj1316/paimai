var _Url = "";
var OpenCount = 0;
var ZIndex = 100000;
function OpenWin() {

    /*
       [{Obj:"",Top:0,Left:0,WinWidth:700,WinHeight:480,ChangeSize:false,WinTitle:"选择",WinContent:"",Url:"",IsMid:true,Tag:"",Scrolling:"no",IsShowHeader:true,IsLoad:false}]
    */

    var Json = arguments[0][0];

    var obj = Json["Obj"];
    var top = Json["Top"];
    var left = Json["Left"];
    var winWidth = Json["WinWidth"];
    var winHeight = Json["WinHeight"];
    var changeSize = Json["ChangeSize"];
    var wintitle = Json["WinTitle"];
    var winContent = Json["WinContent"];
    var Url = Json["Url"];
    var IsMid = Json["IsMid"];
    var Tag = Json["Tag"];
    var scrolling = Json["Scrolling"];
    var IsShowHeader = Json["IsShowHeader"];
    var IsLoad = Json["IsLoad"];


    top = (top) ? top : 0;//顶距
    left = (left) ? left : 0;//左距
    winWidth = (winWidth) ? winWidth : 700;//宽度
    winHeight = (winHeight) ? winHeight : 480;//高度
    changeSize = (changeSize) ? changeSize : false;//是否每次弹出都改变宽度
    wintitle = (wintitle) ? wintitle : "选择";//窗口标题
    winContent = (winContent) ? winContent : "";//显示内容
    Url = (Url) ? Url : "";//Iframe Url
    IsMid = (IsMid) ? IsMid : true;//居中显示
    Tag = (Tag) ? Tag : "";//窗口标识
    scrolling = (scrolling) ? scrolling : "no";//滚动
    IsShowHeader = (IsShowHeader) ? IsShowHeader : true;//是否显示头部
    IsLoad = (IsLoad) ? IsLoad : false;//重新装载
    IsLoad = (Url && Url == "") ? true : IsLoad;



    this.OpenCount++;
    var _win = $1("OpenWin" + Tag);
    if (_win == null) {
        AddDragDiv(Tag, IsShowHeader);
        _win = $1("OpenWin" + Tag);
    }

    if (_win.getAttribute("IsLoad") != "1" || IsLoad || changeSize) {


        winWidth = (winWidth == "" || winWidth == null || winWidth == 0) ? document.body.offsetWidth : winWidth;
        winHeight = (winHeight == "" || winHeight == null || winHeight == 0) ? document.body.scrollHeight : winHeight;



        $1("OpenWin" + Tag).style.height = winHeight + "px";
        $1("OpenWin" + Tag).style.width = winWidth + "px";

    }

    if (IsMid) {
        Middle("OpenWin" + Tag);
    }
    else {
        top = (top == "" || top == null) ? 0 : top;
        left = (left == "" || left == null) ? 0 : left;
        if (obj == "" || obj == null) {
            var PObj = $1("OpenWin" + Tag);
            PObj.style.display = "";
            PObj.style.top = top + "px";
            PObj.style.left = left + "px";

        }
        else {
            SetPoint2(obj, "OpenWin" + Tag, top, left);
        }

    }

    OpenMask();


    if (wintitle != "") {
        $1("WinTitle" + Tag).innerHTML = wintitle;
    }

    if (_win.getAttribute("IsLoad") != "1" || IsLoad) {

        _win.setAttribute("IsLoad", "1");

        var Left = (winWidth / 2 - 16) * 1;

        if (Url != "") {
            var iframe = '<div style="left:' + Left + 'px" class="LoadingImg" id="LoadingImg' + Tag + '" ><img src="/Meal/Images/Loading.gif" /></div><iframe id="Iframe' + Tag + '" src="" scrolling="' + scrolling + '" width="' + winWidth + 'px" height="' + (winHeight - 30) * 1 + 'px" frameborder="0" allowTransparency="true"></iframe>';
            $1("WinContent" + Tag).innerHTML = iframe;
            //Timeout = setTimeout("LoadIframe('" + Url + "')", 500);
            Timeout = setTimeout("LoadIframe('" + Url + "','" + Tag + "')", 0);//500
        }
        else {
            if ($1("WinContent" + Tag).innerHTML == "" || IsLoad) {
                $1("WinContent" + Tag).innerHTML = GetwinContent(winContent);
            }
        }

    }
    else//已装载
    {
        if (this._Url != Url) {
            Timeout = setTimeout("LoadIframe('" + Url + "','" + Tag + "')", 0);
        }
    }

    ClickTop(Tag);

    return;

}


function ClickTop(Tag) {

    this.ZIndex++;

    var obj = $1("OpenWin" + Tag);

    obj.style.zIndex = this.ZIndex;

}

function GetwinContent(winContent) {
    if (typeof (winContent) == typeof ("")) {
        return winContent;
    }
    else {
        if (winContent.innerHTML != "") {
            var C = winContent.innerHTML;
            winContent.innerHTML = "";
            return C;
        }

    }
}

var Timeout = null;
function LoadIframe(Url, Tag) {

    var iframe = $1("Iframe" + Tag);
    $1("LoadingImg" + Tag).style.display = "";

    //注册事件
    if (iframe.attachEvent) {
        iframe.attachEvent("onload", function () {
            document.getElementById("LoadingImg" + Tag).style.display = "none";

            $1("OpenWin" + Tag).style.height = iframe.contentWindow.document.getElementById("MHeight").offsetHeight + "px";


        });
    } else {
        iframe.onload = function () {
            document.getElementById("LoadingImg" + Tag).style.display = "none";
            $1("OpenWin" + Tag).height = iframe.contentWindow.document.getElementById("MHeight").offsetHeight;
            $1("OpenWin" + Tag).style.height = iframe.contentWindow.document.getElementById("MHeight").offsetHeight + "px";
        };
    }

    this._Url = Url;
    $1("Iframe" + Tag).src = Url;
    clearTimeout(Timeout);
    return;

}

function CloseWin(_obj) {
    this.OpenCount--;
    if (this.OpenCount < 0) {
        this.OpenCount = 0;
    }
    var obj = _obj.parentNode.parentNode;
    obj.style.display = "none";
    if (this.OpenCount <= 0) {
        $1("mask").style.display = "none";
        document.onmousemove = null;
        document.onmouseup = null;
    }
    return;
}

function CloseWin2(tag) {
    this.OpenCount--;
    if (this.OpenCount < 0) {
        this.OpenCount = 0;
    }
    var obj = $1("OpenWin" + tag);
    obj.style.display = "none";
    if (this.OpenCount <= 0) {
        $1("mask").style.display = "none";
        document.onmousemove = null;
        document.onmouseup = null;
    }
    return;
}

function BeginDrag(t) {
    this.IsDrag = (t == 1) ? true : false;
}

function AddDragDiv(Tag, IsShowHeader) {
    var mask = "";
    var IsFirst = "0";
    var Style = (IsShowHeader) ? "" : "display:none";

    if ($1("mask") == null) {
        mask = "<div id=\"mask\" style=\"display:\"></div>";
    }

    var DragDiv = mask + "<div  class=\"OpenWin\" id=\"OpenWin" + Tag + "\" style=\"display:;position:absolute;\">" +
                              "<div onclick=\"ClickTop('" + Tag + "')\" style=\"" + Style + "\"  onmouseover=\"Drag($1('OpenWin" + Tag + "'),this)\" class=\"WinHeader\" id=\"WinHeader" + Tag + "\"><span><span id=\"WinTitle" + Tag + "\">提示信息</span></span><a onclick=\"CloseWin(this)\"  onmouseover=\"BeginDrag(0)\"  onmouseout=\"BeginDrag(1)\" href=\"javascript:\"  id=\"CloseImg" + Tag + "\" title=\"关闭\"></a></div>" +//<img   src=\"Images/noc_close.png\" />
                              "<div class=\"WinContent\"  id=\"WinContent" + Tag + "\"></div>" +
                              "</div>";

    InsertHTML(document.body, 3, DragDiv);

}

function OpenMask() {

    if ($1("mask") != null) {
        $1("mask").style.display = "";
        $1("mask").style.height = document.documentElement.scrollHeight + "px";
    }

}