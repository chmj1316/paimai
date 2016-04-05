
function GetLinkUrl() {
    var url = location.href;

    if (IsMatch(url, /(\/mall\/Shop\/)/gi))//如果是商城前台页面
    {
        if (!IsMatch(url, /(\/Shop\/(Default|ProductInfo)\.aspx)/gi))//如果不是商城首页和产品详细页面
        {
            url = lineLink_Default;
        }
    }
    else if (IsMatch(url, /(\/mall\/User\/)/gi))//如果是商城会员中心
    {
        if (!IsMatch(url, /(\/mall\/User\/Personalcenter\.aspx)/gi))//如果不是商城会员中心首页
        {
            url = lineLink_User;
        }
    }
    else if (IsMatch(url, /(\/mall\/Html\/)/gi))//如果是商城会员中心
    {

        //if (getCookie("custID") == "11018") {

        if (!IsMatch(lineLink_Share, /(OpenID=)/gi)) {
            lineLink_Share = RegExpRegPlace(lineLink_Share, /MyShare\.aspx\?/gi, "MyShare.aspx?OpenID=" + getCookie("WeiXinOpenID") + "&");
        }

        //}



        url = lineLink_Share;


    }


    //if (getCookie("custID") == "100248") {

    //    var mytime = Math.floor(Math.random() * 100000000);
    //    if (url.indexOf('?')) {
    //        url = url + "&FromTimeForMe=" + mytime;
    //    }
    //    else {
    //        url = url + "?FromTimeForMe=" + mytime;
    //    }



    //}

    //if (getCookie("custID") == "100248") {
    //    alert(url);
    //}

    return url;
}

function GetTitle() {
    return document.title;
}


wx.ready(function () {
    wx.onMenuShareAppMessage({
        title: GetTitle(),
        desc: descContent,
        link: GetLinkUrl(),
        imgUrl: imgUrl,
        trigger: function (res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
            //alert('用户点击发送给朋友');
        },
        success: function (res) {
            //alert('已分享');
        },
        cancel: function (res) {
            //alert('已取消');
        },
        fail: function (res) {
            //alert(JSON.stringify(res));
        }
    });

    wx.onMenuShareTimeline({
        title: descContent,
        desc: descContent,
        link: GetLinkUrl(),
        imgUrl: imgUrl,
        trigger: function (res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
            //alert('用户点击分享到朋友圈');
        },
        success: function (res) {
            //alert('已分享');
        },
        cancel: function (res) {
            //alert('已取消');
        },
        fail: function (res) {
            //alert(JSON.stringify(res));
        }
    });
});