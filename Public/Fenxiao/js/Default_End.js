document.writeln("<div id=\"floatTools\" class=\"rides-cs\" style=\"display:none\" ></div>");

document.writeln("<div id=\"AttentionBottom\" class=\"outBox\" style=\"display:none\" ></div>");

LoadJs("/Mall/Shop/Control/AttentionMsg.js", time); /*关注弹出页面*/
LoadJs("/Mall/Shop/Control/QQ.js", time);/*QQ联系*/
LoadCss("/Mall/user/css/kefu.css", time2);


function ShowWinmobi() {

    $1("DlsSet").className = "DlsSet";
    $1("DlsSet").setAttribute("onclick", "javascript:");
    $1("DlsSet").innerHTML = "<a href=\"http://m.tyr88.com/\" style=\"margin-right:0px\"><span style=\"font-size:1.2rem;color:#333333\">技术支持</span></a>";
}

ShowWinmobi();
//快捷菜单
(function () {
    var stop = true;
    $('#list1').on('click', function () {
        var sop = ['/mall/shop/images/001.png', '/mall/shop/images/002.png'];
        if (stop) {
            $('.poslist').show();
            $(this).find('img').prop('src', sop[1]);
            stop = false;
        } else {
            $('.poslist').hide();
            $(this).find('img').prop('src', sop[0]);
            stop = true;
        }
    });

    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        $('#list2').click(function () {
            $('html,body').stop().animate({ scrollTop: 0 }, 500)
        })
    })
})();

DefaultShortcutMenu();
//快捷菜单
function DefaultShortcutMenu() {
    ExecAJ("DefaultShortcutMenu", null, "ShortcutMenuFun", "STM");
}

function ShortcutMenuFun(text, DoType) { 
    if (text != "") {
        $(".ulst").html(text);
        $("#DefaultShortcutMenu").show();
    }
}




if (getCookie("custID") == "100279") {
    LoadJs("http://kefu5.kuaishang.cn/bs/ks.j?cI=409834&fI=64543&ism=1", time2); //订制客服
}
