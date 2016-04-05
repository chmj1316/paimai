

var CustID = getCookie("custID");
var UserId =getCookie("userID");
var type = 0;

function loadSharLog() {

    var arrys = new Array(
        PID,
       CustID,
        0
        );
    ExecAJ("GetShareBuyLogCount1", arrys, "funIsok");
}

function funIsok(txt) {
   
    if (txt!="") {
        //判断是否是分享抢购的活动产品
        var Arry = txt.split(",");
        //隐藏原有购物车
        document.getElementById("ToBuyDiv").style.display = "none";
        //判断是否下架
        var IsupDown = "                           <a class=\"ide_a fl\" href='javascript:Cart_INSERT([{ProductID:" + PID + ",CountObj:\"Count\",BuyType:GetBuyType()}])' id=\"addCar\">放入购物车</a><a  href='javascript:Cart_INSERT([{ProductID:" + PID + ",CountObj:\"Count\",Type:1,BuyType:GetBuyType()}])' class=\"ide_a fr ide_a_1\" id=\"addBuy\">申请购买</a>\r\n" +
                    "                            <a class=\"ide_a_goumai\" href=\"/Mall/User/allorderlist.aspx\" id=\"buyIsOk\" style=\"display:none\">你已成功购买</a>\r\n";
        if (Arry[8]=="0") {
            IsupDown = "                            <a class=\"ide_a_goumai\" href=\"/Mall/User/allorderlist.aspx\" id=\"buyIsOk\">活动已结束</a>\r\n";
        }
        type = Arry[9];
        var TempDiv = 0;
       // 判断使用模板
        if (type == "2") {
            TempDiv = 1;
        }
        var template = "";
        var SharLogJs = " <div class=\"qiangQian\">\r\n" +
                "                <h2>" + Arry[0] + "</h2>\r\n" +
                "            </div>\r\n" +
                "            <div class=\"center\">\r\n" +
                "                <div class=\"baise_qianjing\">\r\n" +
                "                    <div class=\"center\">\r\n" +
                "                        <p>" + Arry[1] + "</p>\r\n" +
                "                        <p>" + Arry[2] + "</p>    \r\n" +
                "                        <p>" + Arry[3] + "</p>\r\n" +
                "                        " + Arry[4] + "\r\n" +
                "                        <div class=\"ide_opk clear\">\r\n" + IsupDown +    //加载是否下架
                "                              </div>\r\n" +
                "                    </div>\r\n" +
                "                </div>\r\n";
        if (TempDiv == 0) {

            //基础版本
            template = "                <div class=\"baise_qianjing baise_qianjing_1\" >\r\n" +
                        "                    <div class=\"center\">\r\n" +
                        "                        <ul class=\"ul_a clear ul_a_1\">\r\n" +
                        "                            <li>\r\n" +
                        "                                <a class=\"dosn_fenxiang_4\"  onclick=\"openGuide()\">[推广名片]<br /><i style=\"font-size:10px;\">生成分享给朋友</i></a>\r\n" +
                        "                            </li>\r\n" +
                        "                            <li>\r\n" +
                        "                                <a class=\"dosn_fenxiang_3\">" + Arry[5] + "</a>\r\n" +
                        "                            </li>\r\n" +
                        "                            <li>\r\n" +
                        "                                 <a class=\"dosn_fenxiang_2\">" + Arry[6] + "</a>\r\n" +
                        "                            </li>\r\n" +
                        "                            <li>\r\n" +
                        "                                <a class=\"dosn_fenxiang_1\">" + Arry[7] + "</a>\r\n" +
                        "                            </li>\r\n" +
                        "                        </ul>\r\n" +
                        "                    </div>\r\n" +
                        "                </div>\r\n" +
                        "                <div class=\"baise_qianjing\">\r\n" +
                        "                    <div class=\"center\">\r\n" +
                        "                        <a class=\"fonts_im_text\">\r\n" +
                        "                       分享任务完成[申请购买]自动显示[您已成功购买]<br/>分享优惠也是对朋友的一份爱，快快行动吧！\r\n" +
                        "                            </a>\r\n" +
                        "                    </div>\r\n" +
                        "                </div>                                                                                          \r\n" +
                        "            </div>\r\n";
        } else {
            var Link;
            if (CustID==10880) {
                Link = "				<a href=\"http://mp.weixin.qq.com/s?__biz=MjM5MjIyNjY3NA==&mid=402584901&idx=1&sn=f0254085ed514407fd257baa05527006#rd\"  style=\"font-size:12px;\">\r\n";
            } else {
                Link = "				<a href=\"http://mp.weixin.qq.com/s?__biz=MzAxODE3MDAwNw==&mid=402508206&idx=1&sn=66e47a9b45bd663823eba9d20ac0d64c#rd\"  style=\"font-size:12px;\">\r\n";
            }
            
            //安如版
            template = "<div class=\"bg_blue navBox-flex\" >\r\n" +
                        "			<div class=\"navBox-flex-fl\" >\r\n" +
                        "				<a href=\"Javascript:openGuide()\" style=\"font-size:12px;\">\r\n" +
                        "					<span class=\"navBox-flex-fl nav-box-flex-width\" >[下载推广名片]</span>\r\n" +
                        "					<span class=\"navBox-flex-fl nav-box-flex-width\">群发给所有朋友</span>\r\n" +
                        "				</a>\r\n" +
                        "			</div>\r\n" +
                        "			<div class=\"navBox-flex-fl\">\r\n" + Link+
                        "					<span class=\"navBox-flex-fl nav-box-flex-width\">[操作说明]</span>\r\n" +
                        "					<span class=\"navBox-flex-fl nav-box-flex-width\">查阅操作方法</span>\r\n" +
                        "				</a>\r\n" +
                        "			</div> \r\n" +
                        "		</div>\r\n" +
                        "		<div class=\"baise_qianjing baise_qianjing_1\">\r\n" +
                        "			<div class=\"bav_imgs\">\r\n" +
                        "				<h2 class=\"center dai_photo_h2\">*请上传群发截图</h2>\r\n" +
                        "				<div class=\"bg\">\r\n" +
                        "					<div class=\"center clear\" >\r\n" +
                        "						<div class=\"div11 fl\" id=\"ChaImg\"  >\r\n" +
                        "							<a href=\"javascript:ChooseImage();\"style=\"font-size:14px;\">+<img src=\"/Mall/shop/images/up.png\" width=\"30\" height=\"20\">点击上传图片</a>	\r\n" +
                        "						</div>\r\n" +
                        "						<div class=\"div22 fr\" id=\"errImg\" >\r\n" +
                        "							<img src=\"/Mall/shop/images/err.png\" />  <a class=\"Upstate\">你还未上传群发图片</a>\r\n" + //你还未上传群发图片
                        "						</div>\r\n" +
                        "					</div>\r\n" +
                        "				</div>\r\n" +
                        "			</div>\r\n" +
                        "			<div class=\"center\">\r\n" +
                        "			<a class=\"fonts_im_text\">\r\n" +
                        "			分享任务完成[申请购买]自动显示[您已成功购买]<br/>\r\n" +
                        "			分享优惠也是对朋友的一份爱，快快行动吧！\r\n" +
                        "			</a>\r\n" +
                        "			</div>\r\n" +
                        "		</div>\r\n";
        }
        $(".wwrry").html(SharLogJs + template);
        
    }

}
function GetShareBuyLogCount() {

    var ArryShar = new Array(
         PID,
        UserId,
        CustID,
        0
        );
   
    ExecAJ("GetShareBuyLogCount", ArryShar, "funShar");
}
function funShar(txt) {
   // alert(txt);
    var p = txt.split(",");

    if (txt!="") {
       
        if (p[7] == '2') {
            var dis;
            var err
            if (p[8] > 0 && p[9] == 0) {
                // 是否显示购买还是已完成
                document.getElementById("addCar").style.display = "none";
                document.getElementById("addBuy").style.display = "none"
                document.getElementById("buyIsOk").style.display = "block";
                $("#buyIsOk").html('申请中');
                // 判断是否上传图片
                if (p[6] != '') {
                    dis = "<a href=\"javascript:ChooseImage();\">+<img src=\"/Mall/shop/images/seecoe.png\" width=\"30\" height=\"20\">重新上传图片</a>	\r\n";
                      err = "<a class=\"Upstate\">[待审核]</a>\r\n";
                } else {
                      dis = "<a href=\"javascript:ChooseImage();\">+<img src=\"/Mall/shop/images/up.png\" width=\"30\" height=\"20\">点击上传图片</a>	\r\n";
                }
            } else if (p[8] > 0 && p[9] == 2) {
                document.getElementById("addCar").style.display = "none";
                document.getElementById("addBuy").style.display = "none"
                document.getElementById("buyIsOk").style.display = "block";
                $("#buyIsOk").html('待审核');
                  dis = "<a href=\"javascript:ChooseImage();\" style=\"font-size:14px;\">+<img src=\"/Mall/shop/images/seecoe.png\" width=\"30\" height=\"20\">重新上传图片</a>	\r\n";
                  err = "<img src=\"/Mall/shop/images/err.png\" /> <a class=\"Upstate\">您上传图片未通过,请重新上传</a>\r\n";
            }
            else if (p[8] > 0 && p[9] ==1) {
                document.getElementById("addCar").style.display = "none";
                document.getElementById("addBuy").style.display = "none"
                document.getElementById("buyIsOk").style.display = "block";
                $("#buyIsOk").html('您已成功购买');
                dis = "<a href=\"javascript:ChooseImage();\" style=\"font-size:14px;\">+<img src=\"/Mall/shop/images/seecoe.png\" width=\"30\" height=\"20\">重新上传图片</a>	\r\n";
                err = "<a class=\"Upstate\">您已通过审核 等待收货</a>\r\n";
            }
            document.getElementById('ChaImg').innerHTML = dis;
            document.getElementById('errImg').innerHTML = err;
        } else {
            //基础版
            if (p[0] > 1) {
                // 是否显示购买还是已完成
                document.getElementById("addCar").style.display = "none";
                document.getElementById("addBuy").style.display = "none"
                document.getElementById("buyIsOk").style.display = "block";
            } else {
                document.getElementById("addCar").style.display = "block";
                document.getElementById("addBuy").style.display = "block";
                document.getElementById("buyIsOk").style.display = "none";
            }
        }
    //完成任务人数
    $(".dosn_fenxiang_2").html('完成' + p[4] + '人');
    //任务状态
    $(".dosn_fenxiang_1").html(p[1]);
    //分享提示
    $(".fonts_im_text").html(p[3]);

    }

    //图片审核状态
    //Upstate
    if (p[5]!='') {
     //   $(".Upstate").html(p[5]);
    }
  
    //调用微信
    if (type == "2") {
        ObtainCofig();
    }
}
 //分享名片链接
function openGuide() { location.href = "/mall/shop/TemporaryQRCode.aspx?CustID=" +CustID + "&UID=" + UserId; }

//动态获取微信签名
function ObtainCofig() {
    var Query = new Array(1, 2);
    ExecAJ("weixiConfig", Query, "Signature");
}
//签名
var access_token = "";
function Signature(txt) {
    if (txt != "") {
        var Arry = txt.split(",");
        // string   token=appid+","+secret+","+access_token+","+Ticket;
        var appid = Arry[0];
        access_token =Arry[2];
        var Ticket = Arry[3];
        var createNonceStr = "jrcihnztnh"; //Math.random().toString(36).substr(2, 15);
        var createTimestamp = "1430272394";//parseInt(new Date().getTime() / 1000);
        var raw = function (args) {
            var keys = Object.keys(args);
            keys = keys.sort()
            var newArgs = {};
            keys.forEach(function (key) {
                newArgs[key.toLowerCase()] = args[key];
            });
            var string = '';
            for (var k in newArgs) {
                string += '&' + k + '=' + newArgs[k];
            }
            string = string.substr(1);
            return string;
        };
        //synopsis 签名算法  哈希算法
        var sign = function () {
            var ret = {
                jsapi_ticket:Ticket,
                nonceStr: createNonceStr,//createNonceStr(),"jrcihnztnh"
                timestamp: createTimestamp,//createTimestamp(),1430272394
                url: window.location.href//获取当前页面路径
            };
            var str = raw(ret);
            return hex_sha1(str);
        };
        //通过config接口注入权限验证配置
        wx.config({
            debug: false,
            appId:appid,
            nonceStr: createNonceStr,//createNonceStr(),"jrcihnztnh"
            timestamp: createTimestamp,//createTimestamp(),1430272394
            signature: sign(),
            jsApiList: [
              'chooseImage',   //初始化
              'uploadImage',
              'onMenuShareTimeline',
              'onMenuShareAppMessage'
            ]
        });
        //通过error接口处理失败验证
        wx.error(function (res) {
            alert(res.errMsg);
        })
    }
}
// 5 图片接口
// 5.1 拍照、本地选图
var images = {
    localId: [],
    serverId: []
};
//选择图片
function ChooseImage() {
    wx.chooseImage({
        success: function (res) {
            images.localId = res.localIds;
            var image = document.createElement("img");
            image.src = res.localIds;
            // document.querySelector("#imageList").appendChild(image);
            // alert(res.localIds);
            //  上传图片
            if (images.localId.length <= 0) {
                alert("请选择照片");
                return false;
            }
            var i = 0, len = images.localId.length;
            if (len <=1)//只允许上传1张
            {
                function upload() {
                    wx.uploadImage({
                        localId: images.localId[i],
                        isShowProgressTips: 1,
                        success: function (res) {
                            i++;
                          //在腾讯服务器下载图片
                            RegisterImgFile(res.serverId);
                            images.serverId.push(res.serverId);
                            if (i < len) {
                                upload();
                            }
                        },
                        fail: function (res) {
                            alert(JSON.stringify(res));
                        }
                    })
                }
                upload();
            } else {
                alert("只允最多上传1张");
                return false;
            }
        }
    });
}
//保存数据
function RegisterImgFile(serverId) {
    
    var accesstoken = access_token;
    var Query = new Array(accesstoken, serverId, UserId, PID);
     ExecAJ("ShareBuyLog_upload", Query, "_DoAJAXDATA");
}
//上传图
function _DoAJAXDATA(txt) {
    
    if (txt==1) { //上传成功
        alert('上传成功，请耐心等待审核');
        $(".Upstate").html('[待审核]');
        var dis = "							<a href=\"javascript:ChooseImage();\">+<img src=\"/Mall/shop/images/seecoe.png\" width=\"30\" height=\"20\">重新上传图片</a>	\r\n";
        document.getElementById('ChaImg').innerHTML = dis;
    }
    else if (txt ==0) {
        alert('您还没购买，请购买！');
    }else {
        alert('上传失败，请重新上传！');
    }

}

