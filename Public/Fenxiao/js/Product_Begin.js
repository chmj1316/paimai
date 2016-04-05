
$(document).ready(function () {
    $("#uIntegral").text(shopTitle.split('$')[0]); $("#yintg").text("赠送" + shopTitle.split('$')[0] + "：");
    $("#uVoucher").text(shopTitle.split('$')[1]);
    $("#hy01").text(shopTitle.split('$')[2]);
    if (cid == "10688") { $("#hy01").text("优必"); $("#yintg").text("赠送优必："); }
    //广州尚德网络培训隐藏购物信息
    if (cid == "100518") { $(".SetCount").hide(); }
    //if (cid == "100518") { $(".ProductTitle").hide(); $(".SelectTag").hide(); $(".Split5").hide(); $(".ProductPrice").hide(); $(".ProductTitle").hide(); $(".stock").hide(); $(".SetCount").hide(); }
})

var IsLoadC = true;
function Tab1(obj) {
    SetTab("li", obj, "current", "Info");

    if (obj.id == "ToC" && IsLoadC)
    {
        IsLoadC = false;
        LoadMCommentHTMLList();
    }
}

function TabClick() {
    var List = $1("ProductDetailed").getElementsByTagName("li");

    for (i = 0; i < List.length; i++) {
        List[i].onclick = function () {
            Tab1(this);
        }
    }
}

var So = [PID + ""];//10007
//addLoadEvent(TabClick); hy01

window.onscroll = function () {
    if (IsupDown == "0") return;

    var Y = GetObj_Y($1("AddCartBt")) + 30;
    var Scroll = getScroll();

    if (Scroll >= Y)//显示
    {
        //$1("FixedBuy").style.display = "";
        $("#FixedBuy").animate({
            opacity: "show"
        }, "1000");

        $1("Split55").style.display = "";
        $1("Car").className = "Car2";
        $1("aFloatTools_Show").className = "QQ2";

    }
    else//隐藏
    {
        //$1("FixedBuy").style.display = "none";
        $("#FixedBuy").animate({
            opacity: "hide"
        }, "500");

        $1("Split55").style.display = "none";
        $1("Car").className = "Car";
        $1("aFloatTools_Show").className = "QQ";
    }
}

function MallFavoritesAdd() {
    var Query = new Array
       (
        PID + ""
       );

    ExecAJ("MallFavoritesAdd", Query, "_MallFavoritesAdd");
}

function _MallFavoritesAdd(text) {
    if (text == "1") {
        $1("collect").className = "collect1";
    }
    else {
        $1("collect").className = "collect0";
    }
}

function GetBuyType() {
    var T = 0;

    if ($1("PriceType0").checked) {
        T = 0;
    }
    else if ($1("PriceType1").checked) {
        T = 1;
    }
    else if ($1("PriceType2").checked) {
        T = 2;
    }
    else if ($1("PriceType3").checked) {
        T = 3;
    }

    return T;
}

function Tag(v1, v2) {
    location.href = "/Mall/Shop/ToProduct.aspx?Tag=" + ClassTag + "&v1=" + v1 + "&v2=" + v2;
}

function LoadMCommentHTMLList() {

    $1("Info2").innerHTML = "<div style='text-align:center;padding:20px'>正在加载 ... </div>";
    var ProductID = $1("ToC").getAttribute("value");
    var Query = new Array
       (
        1,
        ProductID
       );

    ExecAJ("MComment", Query, "_LoadMCommentHTMLList");
}

function _LoadMCommentHTMLList(text) {
    $1("Info2").innerHTML = text;
}