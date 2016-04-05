document.write("<script type=\"text/javascript\" src=\"/mall/shop/JS/swiper/jquery-1.10.1.min.js\"></script>");
document.write("<script type=\"text/javascript\" src=\"http://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js\"></script>");




//是否微信登录
function IsWeiXin() {
    //alert(window.navigator.userAgent);
    return /MicroMessenger/i.test(window.navigator.userAgent);
}
//function IsWeiXin() {
//    var ua = window.navigator.userAgent.toLowerCase();
//    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
//        return true;
//    } else {
//        return false;
//    }
//}

function IsLogin() {
    //静态生成的页面
    var url = location.href;
    var IsPC = $.cookie("IsPC");
    if (!IsWeiXin() && !IsMatch(url, /(\/www.w8.com\/)/gi) && IsPC != "1")//判断不是微信登录//&& !IsMatch(url, /(\/www.w8.com\/)/gi)
    {

        if (IsMatch(url, /(\/Mall\/(User|MyUser)\/)/gi))//如果是商城会员中心
        {
            var OpenID = $.cookie("OpenID");
            var userID = $.cookie("userID");
            var custID = $.cookie("custID");

            //alert(OpenID);
            //alert(userID);
            //alert(custID);

            //if (custID == "100336")
            //{
            //    alert(window.navigator.userAgent);
            //}
            if (OpenID == null || OpenID == "" || userID == null || userID == "" || custID == null || custID == "") //判断没有登录
            {
                return false;
            } else {
                return true;
            }
        }
        else {
            return true;
        }
    }
    else {
        return true;
    }

}

function RedirectLogin() {
    if (!IsLogin()) {
        location.href = "/Mall/Shop/Login.aspx";
    }
}
RedirectLogin();