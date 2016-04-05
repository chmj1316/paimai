
var IsScroll = true;

function ShowIMG(PageIndex) {
    $("div.IMG" + PageIndex).lazyload({
        effect: "fadeIn"
    });
}

function SearchKey() {
    var obj = $1("Search");

    if (obj.style.display == "") {
        obj.style.display = "none";
    }
    else {
        obj.style.display = ""
    }
}

function SearchKey2() {
    var obj = $1("SearchBottom");

    if (obj.style.display == "") {
        obj.style.display = "none";
        $1("SHeigth").style.height = "80px";
    }
    else {
        obj.style.display = "";
        $1("SHeigth").style.height = "130px";
    }
}

var CID = RequestByName("CID");
CID = (CID == "") ? 0 : CID;
var So = [CID, ""];

function SearchProduct() {
    So[0] = "0";
    So[1] = $1("Key").value;
    var obj = $1("MoreDiv");
    NextPage(obj, "DefaultProduct");
}

function SearchProduct2() {
    So[0] = "0";
    So[1] = $1("Key2").value;
    var obj = $1("MoreDiv");
    NextPage(obj, "DefaultProduct");
    Scroll();
}

function SearchProductByCateID() {

    var CustID = RequestByName("CustID");

    if (CustID == "10477")
    {
        location.href = "Default.aspx?CID=" + CateID + "&CustID=" + CustID;
    }
    else
    {

        if (CustID == 10999) { //就爱我吧

            location.href = "/Mall/Html/" + CustID + "/ProductList.htm?CID=" + CateID;
        }
        else {

            CloseSelect();
            So[0] = CateID;
            So[1] = "";
            var obj = $1("MoreDiv");
            NextPage(obj, "DefaultProduct");
            Scroll();
        }
    }

}

  /*--配置多级产品分类菜单---*/
function ShowCateName() {

    var CustID = getCookie("custID");
    if (CustID == "10717")
    {
        location.href = "/Mall/shop/ProductType.aspx?CustID=" + CustID;
       
    } else if (CustID == "10731") {
        location.href = "/Mall/shop/ProductType.aspx?CustID=" + CustID;
    } else if (CustID == "100090") {
        location.href = "/Mall/shop/ProductType.aspx?CustID=" + CustID;
    }
    else if (CustID == "100086") {
        location.href = "/Mall/shop/ProductType.aspx?CustID=" + CustID;
    }
    else if (CustID == "100152") {   //策士云商
        location.href = "/Mall/shop/ProductType.aspx?CustID=" + CustID;
    }
    else if (CustID == "100239") {   
        location.href = "/Mall/shop/ProductType.aspx?CustID=" + CustID;
    }
    else {
        var obj = $1("CateName");
        obj.style.display = "";
        obj.className = "CateName animation";
    }
}
/*--End配置多级产品分类菜单---*/

var ParentCateObj = null;
var CateID = 0;
function ShowXilie(obj, XilieID, Level) {

    CateID = XilieID;

    if (ParentCateObj == null) {
        ParentCateObj = obj;
    }
    else {
        ParentCateObj.className = "";
    }

    obj.className = "current";
    ParentCateObj = obj;

    if (XilieID == 0) return;

    var UL = $1("UL" + XilieID);

    if (UL) {
        if (UL.style.display == "") {
            UL.style.display = "none";
        }
        else {
            UL.style.display = "";
        }
    }
    else {

      var Query = new Array
      (
            XilieID,
            Level
      );

        ExecAJ("ShowXilie", Query, "_ShowXilie", [obj, XilieID, Level]);
    }
}

function _ShowXilie(text, P) {
    var obj = P[0];
    var XilieID = P[1];
    var Level = P[2];
    InsertHTML(obj, 4, text);//新页的列表内容

}

function CloseSelect() {
    var obj = $1("CateName");
    obj.className = "CateName2 animation2";

    setTimeout(function () { obj.style.display = "none"; }, 1000);

}

function TabClick(obj, url, CateID) {

    /*
    CurrentTab("li", obj, "current");

    if (url != "") {
        if (IsHtml())
        {
            var Key = RegExpRegPlace(url, /[^\?]+\?/gi, "");
            Key = (Key != "") ? ("?" + Key) : "";
            location.href = "/Mall/Html/10005/ProductList.htm" + Key;
        }
        else
        {
            location.href = url;
        }
    }
    else {
        So[0] = CateID;
        So[1] = "";
        var obj = $1("MoreDiv");
        NextPage(obj, "DefaultProduct");
    }
    */

    if (IsHtml() && CateID!="0") {

        //var Key = RegExpRegPlace(url, /[^\?]+\?/gi, "");
        //Key = (Key != "") ? ("?" + Key) : "";

        location.href = "/Mall/Html/" + CustID + "/ProductList.htm?CID=" + CateID;
    }
    else {

        if (url == "") {
            So[0] = CateID;
            So[1] = "";
            var obj = $1("MoreDiv");
            NextPage(obj, "DefaultProduct");
        }
        else
        {
            location.href = url;
        }
    }
}

window.onscroll = function () {
    Scroll();
}

var ControlTag = "ctl02_";
function Scroll() {
   
    if (!IsScroll) return;

    var Y = GetObj_Y($1(ControlTag+"Entrance")) + 60;
    var Scroll = getScroll();

    if (Scroll >= Y)//显示
    {
        $("#EntranceBottom").animate({
            opacity: "show"
        }, "1000");
        $1("SHeigth").style.display = "";
        $1("TopDHHeight").style.display = "";
        $1(ControlTag + "TopDH").className = "TopDH TopDHFloat";
        $1("aFloatTools_Show").className = "QQ2";
    }
    else//隐藏
    {
        $("#EntranceBottom").animate({
            opacity: "hide"
        }, "500");

        $1("SearchBottom").style.display = "none";
        $1("SHeigth").style.display = "none";
        $1("TopDHHeight").style.display = "none";
        $1(ControlTag + "TopDH").className = "TopDH";
        $1("aFloatTools_Show").className = "QQ";
    }
}

//购物车
function ToShopCart() {
    location.href = "/Mall/Shop/ShopCart.aspx";
}

//个人中心
function Personalcenter() {
    location.href = "/Mall/User/Personalcenter.aspx";
}





