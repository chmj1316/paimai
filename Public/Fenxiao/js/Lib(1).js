
function CurrentTab(Tag, CurrentObj, CurrentClass) {

    var List = $1(CurrentObj).parentNode.getElementsByTagName(Tag);

    for (var i = 0; i < List.length; i++) {
        List[i].className = "";
    }

    $1(CurrentObj).className = CurrentClass;
}


function SetTab(Tag, CurrentObj, CurrentClass, ShowObjTag) {

    var List = $1(CurrentObj).parentNode.getElementsByTagName(Tag);

    for (var i = 0; i < List.length; i++) {
        if (List[i] != CurrentObj) {
            List[i].className = "";
            $1(ShowObjTag + i).style.display = "none";
        }
        else {
            List[i].className = CurrentClass;
            $1(ShowObjTag + i).style.display = "";
        }
    }
}

function back() {
    if (history.length > 1) {
        history.back();
    }
    else {
        location.href = "/Mall/Shop/";
    }


}

function LoadMenu() {

    var RowString = "";

    //if (IsHtml() || IsHTML) {

    //    var CustID = getCookie("CustID");
    //    var Path = "/Mall/Html/" + CustID + "/";

    //    RowString = "<a onfocus=\"this.blur();\" class=\"SMenu\" href=\"javascript:Menu()\"></a><div id=\"Mlist\" class=\"Mlist\" style=\"display:none\"><ul><li><a href=\"" + Path + "Default.htm\">返回首页</a></li><li><a href=\"" + Path + "Personalcenter.htm\">会员中心</a></li><li><a href=\"/Mall/User/allorderlist.aspx\">我的订单</a></li><li><a  href=\"/Mall/Shop/ShopCart.aspx\"><span class=\"CarA\">购物车</span></a></li><li><a href=\"/Mall/Shop/AddressList.aspx\">收货地址</a></li><li class=\"end\"><a href=\"javascript:location.href=location.href\">刷新页面</a></li></ul></div>\r\n";

    //}
    //else {

    var UrlInfo = getCookie("UrlInfo");
    RowString = "<a onfocus=\"this.blur();\" class=\"SMenu\" href=\"javascript:Menu()\"></a><div id=\"Mlist\" class=\"Mlist\" style=\"display:none\"><ul><li><a href=\"/Mall/Shop/Default.aspx?" + UrlInfo + "\">返回首页</a></li><li><a href=\"/Mall/User/Personalcenter.aspx?" + UrlInfo + "\">会员中心</a></li><li><a href=\"/Mall/User/allorderlist.aspx\">我的订单</a></li><li><a  href=\"/Mall/Shop/ShopCart.aspx\"><span class=\"CarA\">购物车</span></a></li><li><a href=\"/Mall/Shop/AddressList.aspx\">收货地址</a></li><li class=\"end\"><a href=\"javascript:location.href=location.href\">刷新页面</a></li></ul></div>\r\n";

    //}
    document.write(RowString);

}

function Menu() {
    if (!$("#Mlist").is(":animated")) {
        $("#Mlist").toggle(400);
    }
}

function GoUrl(url) {
    location.href = url;
}


///下一页
function NextPage(obj) {

    var PageIndex = obj.getAttribute("PageIndex");//当前页数
    var Tag = obj.getAttribute("Tag");//标识
    var AjaxTag = obj.getAttribute("AjaxTag");
    var WhereTag = obj.getAttribute("WhereTag");
    var LoadStart = obj.getAttribute("LoadStart");
    var LoadComplete = obj.getAttribute("LoadComplete");
    var ContentObj = "";

    if (arguments.length == 2) {
        ContentObj = arguments[1];
        PageIndex = 1;
        $1(ContentObj).innerHTML = "<div class=\"LoadWait\">正在装载...</div>";

    }
    else {
        $1("MoreDiv" + Tag).innerHTML = "正在装载...";
    }



    var Query = [];

    if (WhereTag != "") {
        WhereStr = eval("this." + WhereTag);
        if (IsArray(WhereStr)) {
            Query = WhereStr.slice();//数组复制
            Query.unshift(PageIndex);
        }
        else {
            WhereStr = (WhereStr == null) ? "" : WhereStr;
            Query = new Array(PageIndex, WhereStr);
        }
    }
    else {

        Query = new Array(PageIndex, "");
    }

    if (LoadStart != "")//加载之前有执行函数
    {
        if (LoadStart.indexOf("(") == -1) {
            eval(LoadStart + "()");
        }
        else {
            eval(LoadStart);
        }
    }

    ExecAJ(AjaxTag, Query, "_LoadContent", [obj, PageIndex, LoadComplete, Tag, ContentObj]);
}

function _LoadContent(text, P) {

    //alert(text);

    var obj = P[0];
    var PageIndex = P[1];
    var LoadComplete = P[2];
    var Tag = P[3];
    var ContentObj = P[4];


    if (ContentObj == "") {
        obj.setAttribute("PageIndex", PageIndex * 1 + 1);//当前页数加1

        var title = $1("MoreDiv" + Tag).getAttribute("title");

        $1("MoreDiv" + Tag).innerHTML = (title == null || title == "") ? "显示更多" : title;//把 “正在加载...” 文本变成 “显示更多”

        InsertHTML(obj, 1, text);//新页的列表内容
        HideMoreDiv(Tag);//如果是最后一页即隐藏“显示更多”链接
    }
    else {
        $1(ContentObj).innerHTML = text;
    }



    if (LoadComplete != "")//加载完毕有执行函数
    {
        if (LoadComplete.indexOf("(") == -1) {
            eval(LoadComplete + "()");
        }
        else {
            eval(LoadComplete);
        }
    }
}

function HideMoreDiv(Tag) {
    if ($1("NoContent" + Tag)) {
        $1("MoreDiv" + Tag).style.display = "none";
    }
}



//数量加减1
function AddCount(CountObj, count) {

    var V = ($1(CountObj).value * 1) + count;

    if (V <= 0) {
        V = 1;
    }

    $1(CountObj).value = V;
}

function AddCount2(CountObj, count) {

    var V = ($1(CountObj).innerHTML * 1) + count;

    if (V <= 0) {
        V = 1;
    }

    $1(CountObj).innerHTML = V;
}

//放入购物车
function Cart_INSERT() {

    if (!IsLoginDefault()) {
        location.href = "/Mall/Shop/Login.aspx";
        return;
    }

    var Json = arguments[0][0];

    var ProductID = Json["ProductID"];
    var Count = Json["Count"];
    var CountObj = Json["CountObj"];
    var _AddCount = Json["AddCount"];
    var Type = Json["Type"];
    var BuyType = Json["BuyType"];//组合购买：0：纯金额，1：金额+积分，2：金额+代金券
    var CartID = Json["CartID"];
    var tag = 0;//已在购物车
    if (Type == 3 || Type == 2) {
        Count = (Count) ? Count : $1(CountObj).value;
    }
    else {
        Count = (Count) ? Count : $1(CountObj).innerHTML;
    }
    if (isNaN(Count)) {
        alert("请输入正确的购买数量！");
        return;
    }

    //alert($1(CountObj).innerHTML);
    //alert($1(CountObj).innerText);
    Type = (Type) ? Type * 1 : 0;
    var OldCount;
    if (Type == 3 || Type == 2) {
        OldCount = $1(CountObj).value;
    }
    else {
        OldCount = $1(CountObj).innerHTML;
    }
    var IsCumulative = 0;

    if (Type == 0 || Type == 1) {
        IsCumulative = 1;//累加
        tag = 0;
    }
    else if (Type == 2 || Type == 3) {
        IsCumulative = 0;//不累加
        tag = 1;
    }


    //改变数量
    if (Type == 2) {
        AddCount(CountObj, _AddCount * 1);

        Count = (Count * 1 + _AddCount * 1) * 1;

        //CartID=CountObj.replace("Count","");
    }

    if (Count * 1 < 1) {
        Count = 1;
        if (Type == 2 || Type == 3) {
            $1(CountObj).value = Count;
        }
    }
    var Query = new Array
       (
         0,
         0,
         ProductID,
         Count,
         IsCumulative,
         BuyType,
        tag
       );
    ExecAJ("Cart_INSERT", Query, "_Cart_INSERT", [Type, CartID, CountObj, OldCount, BuyType, _AddCount]);
}

function _Cart_INSERT(text, P) {
    var custId = getCookie("custID");// "100363";// //"100363";
    
    if (text == "Err") {
        if (P[5] > 0) {
            try {
                $1(P[2]).value = P[3];
            }
            catch (e)
            { }
        }
        alert("库存不足，暂时无法购买!");
    }
    else if (text == "Err2") {
        if (P[5] > 0) {
            try {
                $1(P[2]).value = P[3];
            }
            catch (e)
            { }
        }
        alert("购买失败,已超出了限购的数量！请查看购物车或登陆个人中心查看我的订单。");
    }
    else if (text == "Err3") {
        if (P[5] > 0) {
            try {
                $1(P[2]).value = P[3];
            }
            catch (e)
            { }
        }
        alert("很抱歉，您没有推荐人，不能下单哦！");
    } else if (custId == "100363" && (text == "Err4" || text == "Err5")) {
        if (text == "Err4") {
            if (P[5] > 0) {
                try {
                    $1(P[2]).value = P[3];
                }
                catch (e)
                { }
            }
            alert("粉丝不能购买非会员升级产品！");
            $1(P[2]).value = P[3];
        }
        if (text == "Err5") {
            if (P[5] > 0) {
                try {
                    $1(P[2]).value = P[3];
                }
                catch (e)
                { }
            }
            alert("您购买的福利产品数量不能超过您购买的会员卡数！");
            $1(P[2]).value = P[3];
        }
    }
    else {
        var Type = P[0];
        var CartID = P[1];

        if (Type == 1) {
            location.href = "/mall/shop/ShopCart.aspx";
        }
        else if (Type == 2 || Type == 3) {
            var Json = eval(text);
            $1("Total" + CartID).innerHTML = "¥" + Json[0]["T0"];
            var V = "¥" + Json[0]["T1"];

            if (typeof (shopTtile) != "undefined") {
                if (Json[0]["I1"] * 1 > 0) {
                    V += "+" + Json[0]["I1"] + shopTtile.split('$')[0];
                }
                if (Json[0]["B1"] * 1 > 0) {
                    V += "+" + Json[0]["B1"] + shopTtile.split('$')[0];
                }

                if (Json[0]["C1"] * 1 > 0) {
                    if (_custID == "10688") { V += "+" + Json[0]["C1"] + "优必"; }
                    else { V += "+" + Json[0]["C1"] + shopTtile.split('$')[0]; }

                }
            } else {
                if (Json[0]["I1"] * 1 > 0) {
                    V += "+" + Json[0]["I1"];
                }

                if (Json[0]["B1"] * 1 > 0) {
                    V += "+" + Json[0]["B1"];
                }

                if (Json[0]["C1"] * 1 > 0) {
                    if (_custID == "10688") { V += "+" + Json[0]["C1"] + "优必"; }
                    else { V += "+" + Json[0]["C1"]; }

                }
            }
            $1("TotalPrice").innerHTML = V;
            if ($1("Total_" + CartID)) {
                if (P[4] == 0) {
                    $1("Total_" + CartID).innerHTML = Json[0]["T0"];
                }
                else if (P[4] == 1) {
                    $1("Total_" + CartID).innerHTML = Json[0]["I0"];
                }
                else if (P[4] == 2) {
                    $1("Total_" + CartID).innerHTML = Json[0]["B0"];
                }
                else if (P[4] == 3) {
                    $1("Total_" + CartID).innerHTML = Json[0]["C0"];
                }
            }
        }
        else {
            alert("已放入购物车!");
        }
    }

}

function Cart_INSERT_100272() {
    
    if (!IsLoginDefault()) {
        location.href = "/Mall/Shop/Login.aspx";
        return;
    }
    var yunfei = $("#express").val();
    
    var Json = arguments[0][0];

    var ProductID = Json["ProductID"];
    var Count = Json["Count"];
    var CountObj = Json["CountObj"];
    var _AddCount = Json["AddCount"];
    var Type = Json["Type"];
    var BuyType = Json["BuyType"];//组合购买：0：纯金额，1：金额+积分，2：金额+代金券
    var CartID = Json["CartID"];
    var tag = 0;//已在购物车
    if (Type == 3 || Type == 2) {
        Count = (Count) ? Count : $1(CountObj).value;
    }
    else {
        Count = (Count) ? Count : $1(CountObj).innerHTML;
    }
    if (isNaN(Count)) {
        alert("请输入正确的购买数量！");
        return;
    }

    //alert($1(CountObj).innerHTML);
    //alert($1(CountObj).innerText);
    Type = (Type) ? Type * 1 : 0;
    var OldCount;
    if (Type == 3 || Type == 2) {
        OldCount = $1(CountObj).value;
    }
    else {
        OldCount = $1(CountObj).innerHTML;
    }
    var IsCumulative = 0;

    if (Type == 0 || Type == 1) {
        IsCumulative = 1;//累加
        tag = 0;
    }
    else if (Type == 2 || Type == 3) {
        IsCumulative = 0;//不累加
        tag = 1;
    }


    //改变数量
    if (Type == 2) {
        AddCount(CountObj, _AddCount * 1);

        Count = (Count * 1 + _AddCount * 1) * 1;

        //CartID=CountObj.replace("Count","");
    }

    if (Count * 1 < 1) {
        Count = 1;
        if (Type == 2 || Type == 3) {
            $1(CountObj).value = Count;
        }
    }
    var Query = new Array
       (
         0,
         0,
         ProductID,
         Count,
         IsCumulative,
         BuyType,
        tag,
        yunfei
       );
    ExecAJ("Cart_INSERT", Query, "_Cart_INSERT", [Type, CartID, CountObj, OldCount, BuyType, _AddCount]);
}



//qy 2015-11-12 放入购物车
function CartInsertDefault() {
    var Json = arguments[0][0];
    var CartId = Json["CartId"];
    var ProductID = Json["ProductID"];
    var CountObj = Json["CountObj"];
    var _AddCount = Json["AddCount"];
    var Type = Json["Type"];
    var BuyType = Json["BuyType"];//组合购买：0：纯金额，1：金额+积分，2：金额+代金券
    var CartID = Json["CartID"];
    var tag = 0;//已在购物车  
    Type = (Type) ? Type * 1 : 0;
    // var OldCount = $1(CountObj).innerText;
    var OldCount = 0;
    var IsCumulative = 0;
    if (Type == 0 || Type == 1) {
        IsCumulative = 1;//累加
        tag = 0;
    }
    else if (Type == 2) {
        IsCumulative = 0;//不累加
        tag = 1;
    }
    var Query = new Array
       (
         0,
         0,
         ProductID,
         CountObj,
         IsCumulative,
         BuyType,
        tag
       );
    ExecAJ("Cart_INSERT", Query, "_CartInsertDefault", ProductID);
}
function _CartInsertDefault(text, pid) {
    if (text == "1") {
        $("span[name='spanName_" + pid + "']").html('<img onclick=\"DeleteShopCartDefault(' + pid + ');\"  class="imgProductCart" src="/mall/shop/images/iconBtu2.png?time=' + Math.random() + '">');

    } else {
        if (text == "Err") {
            alert("库存不足，暂时无法购买!");
        }
        else if (text == "Err2") {
            alert("购买失败,已超出了限购的数量！请查看购物车或登陆个人中心查看我的订单。");
        } else
            alert("操作失败！错误信息：" + msg);
    }
}
function DeleteShopCartDefault(pid) {
    // if (!confirm("是否确定删除该商品？")) return;
    var Query = new Array
       (
        pid + ""
       );
    ExecAJ("ShopCart_D2", Query, "_DeleteShopCartDefault", pid);
}
function _DeleteShopCartDefault(text, pid) {
    $("span[name='spanName_" + pid + "']").html('<img onclick=\"CartInsertDefault([{ProductID:' + pid + ',CountObj:1,BuyType:0}])\" class="imgProductCart" src="/mall/shop/images/iconBtu1.png?time=' + Math.random() + '">');
}
//qy 2015-11-12 放入购物车

//删除购物车商品
function DeleteShopCart(CartID) {

    if (!confirm("是否确定删除该商品？")) return;

    var Query = new Array
       (
        CartID + ""
       );

    ExecAJ("ShopCart_D", Query, "_DeleteShopCart", CartID);
}

function _DeleteShopCart(text, CartID) {
    $("#C_" + CartID).animate({
        opacity: "hide"
    }, "500");

    $1("TotalPrice").innerHTML = text;

    if (text == "0") {
        location.href = location.href;
    }

}



//提交订单,加了优惠券
function OrderForm() {
    var customName = "";//光明博士
    var d = document.getElementById("aOrderForm");
    if (d.innerHTML != "确认付款") {
        return;
    }
    if ($(".Pay11").length > 0 && $(".Pay11").html() == "请选择店铺") {
        alert("请选择对应的店铺!");
        return;
    } else
        customName = $(".Pay11").html();

    var Query = new Array
       (
         0,
         0,
         "",
         CneeID,
         GetRadioListValue("PayType"),
         GetRadioListText("TimeType"),
         $1("Note").value,
     GetCoupon(),
     0,//香爵身份
     customName,//店铺名称 光明博士
        cookieVal
    );
    if (CneeID * 1 == 0) {
        alert("请完善收货信息!");
    }
    else if (Query[4] == "") {
        alert("请选择支付方式!");
    }
    else {
        d.innerHTML = "提交中.....";;
        ExecAJ("OrderForm", Query, "_OrderForm", GetRadioListValue("PayType"));
    }

}

function _OrderForm(text,dtype) {
    var d = document.getElementById("aOrderForm");
    d.innerHTML = "确认付款";
    if ($("#aOrderFormGoUp").length > 0)
        $("#aOrderFormGoUp").hide();
    if (text == "Err") {
        alert("您的购物车存在库存不足的商品，请调整购买数量重新购买!");
        location.href = "/Mall/Shop/ShopCart.aspx";
    }
    else if (text == "Err2") {
        alert("您的购物车存在已下架的商品，请删除已下架的商品重新购买!");
        location.href = "/Mall/Shop/ShopCart.aspx";
    }
    else if (text == "Err3") {
        alert("提交订单失败,存在超出了限购数量的商品，请删除或修改限购商品重新购买!");
        location.href = "/Mall/Shop/ShopCart.aspx";
    } else if (text == "Err5") {//100363
        alert("提交订单失败,您购买的福利产品数量不能超过您购买的会员卡数!");
        location.href = "/Mall/Shop/ShopCart.aspx";
    }
    else if (text.indexOf("Err:") != -1) {

        // if (!confirm("系统繁忙，点击“确认”确认支付，点击“取消”返回？")) return;
        if (!confirm(text)) return;
        OrderForm();
        //alert(text.replace("Err:", ""));
    }
    else {
        if (dtype == '9')
        {
            alert("支付成功！");
        }
        location.href = text;
    }
}



//是否HTML静态页面
function IsHtml() {
    var IsHTML = false;
    var url = location.href;

    if (IsMatch(url, /(\/mall\/Html\/)/gi))//如果是静态页面
    {
        IsHTML = true;
    }
    return IsHTML;
}

//获得分享信息
function ShareInfo() {

    var Query = new Array
       (
       );

    ExecAJ("ShareInfo", Query, "_ShareInfo");

}
function ShareInfo2(type) {
    // alert(type);
    var Query = new Array
       (
        type + ""
       );

    ExecAJ("ShareInfo2", Query, "_ShareInfo");

}
function _ShareInfo(text) {
    if (IsLoginDefault()) {
        $1("ShareInfo").innerHTML = text;
    } else {
        $1("ShareInfo").innerHTML = '<div class="ShareInfo"> <div class="IMG"  style="width:50%;margin:12px 10px 15px 0px;padding-left:20px;color: #FFFFFF;" onclick="LoginUrl()">请点击登录</div><a id="UserA" href="/Mall/Shop/Login.aspx"><span id="UserText">会员登录</span></a></div>';
    }
}
function LoginUrl() {
    location.href = "/Mall/Shop/Login.aspx";
}


////是否微信登录
//function IsWeiXinDefault() {
//    var ua = window.navigator.userAgent.toLowerCase();
//    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
//        return true;
//    } else {
//        return false;
//    }
//}


function IsLoginDefault() {
    //静态生成的页面
    var url = location.href;
    var IsPC = getCookie("IsPC");
    var resault = true;
    if (!IsWeiXin() && !IsMatch(url, /(\/www.w8.com\/)/gi) && IsPC != "1")//判断不是微信登录
    {
        var OpenID = getCookie("OpenID");
        var userID = getCookie("userID");
        var custID = getCookie("custID");
        if (OpenID == null || OpenID == "" || userID == null || userID == "" || custID == null || custID == "") //判断没有登录
        {
            return false;
        }
    }
    return resault;
}





function HomeTopTitle() {
    var Query = new Array
     (
     );

    ExecAJ("HomeTopTitle", Query, "_HomeTopTitle");
}
function _HomeTopTitle(text) {
    $1("ctl02_HomeTopTitle").innerHTML = text;
}



//产品类别/暂时，在HtmlJs.js也有
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


function LoadProductHTMLList() {

    $1("DefaultProduct").innerHTML = "<div style='text-align:center;padding:20px'>正在加载 ... </div>";

    var Query = new Array
       (
        1,
        CID,
        ""
       );

    ExecAJ("Product", Query, "_LoadProductHTMLList");
}

function _LoadProductHTMLList(text) {
    $1("DefaultProduct").innerHTML = text;
    ShowIMG(1);
}


//是否微信登录
//function IsWeiXin() {
//    var ua = window.navigator.userAgent.toLowerCase();
//    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
//        return true;
//    } else {
//        return false;
//    }
//}
function IsWeiXin() {
    return /MicroMessenger/i.test(window.navigator.userAgent);
}


//function IsLogin() {
//    //静态生成的页面
//    var tag = RequestByName("Tag");

//    if (!IsWeiXin())//判断不是微信登录
//    {
//        if (IsMatch(url, /(\/Mall\/(User|MyUser)\/)/gi))//如果是商城会员中心
//        {
//            var OpenID = getCookie("OpenID");
//            var userID = getCookie("userID");
//            var custID = getCookie("custID");

//            if (OpenID == null || OpenID == "" || userID == null || userID == "" || custID == null || custID == "") //判断没有登录
//            {
//                if (tag == "html") {
//                    return true;
//                }
//                else {
//                    return false;
//                }
//            } else {
//                return true;
//            }
//        } else {
//            return true;
//        }
//    }
//    else {
//        return true;
//    }

//}
//绿众
function Cart_INSERT_11018() {
    if (!IsLoginDefault()) {
        location.href = "/Mall/Shop/Login.aspx";
        return;
    }
    var Json = arguments[0][0];
    var ProductID = Json["ProductID"];

    var arrPro = new Array(ProductID, "0", "0");
    ExecAJ("IsHaiWai", arrPro, "IsHaiWaiMsg", Json)

    //console.log('商品详情');
    //console.log(ProductID);
}
function IsHaiWaiMsg(text, Json) {
    var strs = text.split('$'); //字符分割 
    if (strs[0] != "0") {
        if (window.confirm(strs[1])) {
            location.href = "/Mall/Shop/AddressList.aspx";
        } else {
            //alert("取消");
            return false;
        }
        return;
    }
    else {
        if (!IsLoginDefault()) {
            location.href = "/Mall/Shop/Login.aspx";
            return;
        }
        var ProductID = Json["ProductID"];
        var Count = Json["Count"];
        var CountObj = Json["CountObj"];
        var _AddCount = Json["AddCount"];
        var Type = Json["Type"];
        var BuyType = Json["BuyType"];//组合购买：0：纯金额，1：金额+积分，2：金额+代金券
        var CartID = Json["CartID"];
        var tag = 0;//已在购物车
        if (Type == 3 || Type == 2) {
            Count = (Count) ? Count : $1(CountObj).value;
        }
        else {
            Count = (Count) ? Count : $1(CountObj).innerHTML;
        }
        if (isNaN(Count)) {
            alert("请输入正确的购买数量！");
            return;
        }

        //alert($1(CountObj).innerHTML);
        //alert($1(CountObj).innerText);
        Type = (Type) ? Type * 1 : 0;
        var OldCount;
        if (Type == 3 || Type == 2) {
            OldCount = $1(CountObj).value;
        }
        else {
            OldCount = $1(CountObj).innerHTML;
        }
        var IsCumulative = 0;

        if (Type == 0 || Type == 1) {
            IsCumulative = 1;//累加
            tag = 0;
        }
        else if (Type == 2 || Type == 3) {
            IsCumulative = 0;//不累加
            tag = 1;
        }


        //改变数量
        if (Type == 2) {
            AddCount(CountObj, _AddCount * 1);

            Count = (Count * 1 + _AddCount * 1) * 1;

            //CartID=CountObj.replace("Count","");
        }

        if (Count * 1 < 1) {
            Count = 1;
            if (Type == 2 || Type == 3) {
                $1(CountObj).value = Count;
            }
        }
        var Query = new Array
           (
             0,
             0,
             ProductID,
             Count,
             IsCumulative,
             BuyType,
            tag

           );

        ExecAJ("Cart_INSERT", Query, "_Cart_INSERT", [Type, CartID, CountObj, OldCount, BuyType, _AddCount]);
    }

}