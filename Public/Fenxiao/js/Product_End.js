


$(function () {
    $("img.ShowIMG").lazyload({
        effect: "fadeIn"
    });
});


// $(function () {

//window.onload = function () {

$1("IMGContent").innerHTML = $1("IMGValue").value;

var mySwiper = new Swiper('.swiper-container', {
    pagination: '.pagination',
    autoplay: 3000,
    loop: true,
    grabCursor: true,
    paginationClickable: true
});
//}
var showImg = window.location.search;
if (showImg === "?showimg=0") {
    $("#btn-buyNow").trigger('click');
}
function showForm1() {
    document.getElementById("float_img").style.display = "none";
    document.getElementById("form1").style.display = "block";
    mySwiper.reInit();
}

function GetSaleNumAndMCount() {

    $("#NownumCount").html("...");
    $("#salesnum").html("...");
    $("#MCount").html("...");

    var Query = new Array(
        PID,
        cid
        );
    ExecAJ("GetSaleNumAndMCount", Query, "funss");
}

function funss(text) {
    var p = text.split(",");
    if (p.length == 4) {
        $("#NownumCount").html(p[0]);
        $("#salesnum").html(p[1]);
        $("#MCount").html(p[2]);
        $("#ProductPricePV").html(p[3]);
    }
    else {
        $("#NownumCount").html("...");
        $("#salesnum").html("...");
        $("#MCount").html("...");
        $("#ProductPricePV").html("...");
    }
}


GetSaleNumAndMCount();//库存、销售、评论
loadSharLog();
GetShareBuyLogCount();  //分享抢购


function PurchaseProduct10716() {
    var Query = new Array(
      PID//产品ID
    );

    ExecAJ("PurchaseProduct10716", Query, "funReturn");
}

if (cid == "10716")//qy 新增 2015-10-20
{
    PurchaseProduct10716();
}

if (cid == "10290" && PID == "144046")//qy 新增 2015-10-20
{
    $("#PriceType0").parent().hide();
    $("#PriceType1").attr("checked", "checked");
    $("#PriceType0").removeAttr("checked");
}


function funReturn(text) { 
    if (text == "0") {
        document.getElementById("ToBuyC").style.display = "none";
        document.getElementById("BottonDiv").style.display = "none";
    } 
}

document.writeln("<div id=\"floatTools\" class=\"rides-cs\" style=\"display:none\" ></div>");
document.writeln("<div id=\"AttentionBottom\" class=\"outBox\" style=\"display:none\" ></div>");
LoadJs("/Mall/Shop/Control/AttentionMsg.js", time); /*关注弹出页面*/
LoadJs("/Mall/Shop/Control/QQ.js", time);/*QQ联系*/
LoadCss("/Mall/user/css/kefu.css", time2);


if (cid == "10477") { var prs = document.getElementById("pro"); prs.innerHTML = "售后保障<span></span>"; }
else { }



if (cid == 10530) {
    document.getElementById("UserText").innerHTML = "立即购买";

    if (document.getElementById("UserA")) {
        document.getElementById("UserA").setAttribute("href", "/mall/shop/ProductInfo.aspx?ID=5340&CustID=10530");
    }

    if (document.getElementById("AttentionBt")) {
        document.getElementById("AttentionBt").setAttribute("href", "/mall/shop/ProductInfo.aspx?ID=5340&CustID=10530");
    }


}

if (cid == 10438) {
    document.getElementById("UserText").innerHTML = "立即购买";

    if (document.getElementById("UserA")) {
        document.getElementById("UserA").setAttribute("href", "http://tiankaiguoji.tyr88.com/mall/shop/ProductInfo.aspx?ID=3012&CustID=10438");
    }

    if (document.getElementById("AttentionBt")) {
        document.getElementById("AttentionBt").setAttribute("href", "http://tiankaiguoji.tyr88.com/mall/shop/ProductInfo.aspx?ID=3012&CustID=10438");
    }

}

if (cid == 10296) {
    document.getElementById("UserText").innerHTML = "立即购买";

    if (document.getElementById("UserA")) {
        document.getElementById("UserA").setAttribute("href", "http://yzmi.tyr88.com/mall/shop/ProductInfo.aspx?custID=10296&ID=9304");
    }

    if (document.getElementById("AttentionBt")) {
        document.getElementById("AttentionBt").setAttribute("href", "http://yzmi.tyr88.com/mall/shop/ProductInfo.aspx?custID=10296&ID=9304");
    }

}


if (cid == 10245) {
    document.getElementById("UserText").innerHTML = "立即购买";

    if (document.getElementById("UserA")) {
        document.getElementById("UserA").setAttribute("href", "http://jibenfa.tyr88.com/mall/shop/ProductInfo.aspx?ID=2277&CustID=10245");
    }

    if (document.getElementById("AttentionBt")) {
        document.getElementById("AttentionBt").setAttribute("href", "http://jibenfa.tyr88.com/mall/shop/ProductInfo.aspx?ID=2277&CustID=10245");
    }

}

if (cid == 10571) {
    document.getElementById("UserText").innerHTML = "立即购买";

    if (document.getElementById("UserA")) {
        document.getElementById("UserA").setAttribute("href", "http://gzlyxk.tyr88.com/mall/shop/ProductInfo.aspx?custID=10571&ID=6563");
    }

    if (document.getElementById("AttentionBt")) {
        document.getElementById("AttentionBt").setAttribute("http://gzlyxk.tyr88.com/mall/shop/ProductInfo.aspx?custID=10571&ID=6563");
    }

}

//2015-06-12修改
if (cid == 10720) {
    document.getElementById("UserText").innerHTML = "立即购买";

    if (document.getElementById("UserA")) {
        document.getElementById("UserA").setAttribute("href", "http://cuiheng.tyr88.com/mall/shop/ProductInfo.aspx?custID=10720&ID=17485");
    }

    if (document.getElementById("AttentionBt")) {
        document.getElementById("AttentionBt").setAttribute("href", "http://cuiheng.tyr88.com/mall/shop/ProductInfo.aspx?custID=10720&ID=17485");
    }

}

function ShowWinmobi() {

    $1("DlsSet").className = "DlsSet";
    $1("DlsSet").setAttribute("onclick", "javascript:");
    $1("DlsSet").innerHTML = "<a href=\"http://m.tyr88.com/\" style=\"margin-right:0px\"><span style=\"font-size:1.2rem;color:#333333\">技术支持</span></a>";
}

ShowWinmobi();

