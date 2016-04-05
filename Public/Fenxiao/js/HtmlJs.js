var IsHTML = true;

//是否微信登录
function IsWeiXin() {
    var ua = window.navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
        return true;
    } else {
        return false;
    }
}

function WX() {
    var OpenID = getCookie("WeiXinOpenID");
    var userID = getCookie("userID");
    var custID = getCookie("custID");

    //alert(OpenID + "," + userID + "," + custID);

    if (OpenID == null || OpenID == "" || userID == null || userID == "" || custID == null || custID == "") {
        if (IsWeiXin()) {
            location.href = "/Mall/Shop/JS/Html/MyShare.aspx?CustID=" + CustID + "&Url=" + location.href;
        }
        else {
            //location.href = "/Login.aspx";
        }
    }
}

WX();



//购物车
function ToShopCart()
{
    location.href = "/Mall/Shop/ShopCart.aspx";
}

//个人中心
function Personalcenter()
{
    location.href = "/Mall/User/Personalcenter.aspx";
}

//产品类别
function ToCateUrl(Url, CateID) {

    if (Url != "") {
        location.href = Url;
    }
    else {

        if (IsHtml()) {
            var CustID = getCookie("custID");
            var url = "/Mall/Html/" + CustID + "/ProductList.htm?CID=" + CateID;
            location.href = url;
        }
        else {
            var url = "/Mall/Shop/ProductList.aspx?CID=" + CateID;
            location.href = url;
        }
    }
}