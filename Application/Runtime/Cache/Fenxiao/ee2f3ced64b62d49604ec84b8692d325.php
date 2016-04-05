<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>推广二维码</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <style type="text/css">
            #qrcode {
                width: 200px;
                height: 200px;
                background: #fff;
                margin: 50px auto 20px;
            }
            #qrcode img {
                width: 200px;
                height: 200px;
            }
        </style>
    </head>

    <body>
        <div id="divMyCartDataA">
            <div id="qrcode">
                <img src="<?php echo U('ewmSharePng', array('share_uid'=>$share_uid));?>" style="display: block;">
            </div>
            <div style="text-align: center;" id="findLink">
                <a href="<?php echo U('index', array('share_uid'=>$share_uid));?>" style="background:#44c218; text-decoration:none;margin-top:10px; padding:10px 20px; color:#fff; box-shadow:0px 2px 0px rgba(0,0,0,0.1); border-radius:5px;">点我直接访问</a>
            </div>
            <div style="padding: 10px 20px; margin: 15px; border-radius: 3px; text-align: center;">
                <p><span style="font-weight: 600; color: Red; font-size: 12px; line-height: 12px;">邀请朋友扫描我的二维码</span></p>
                <p><span style="font-weight: 600;">点击右上角按钮，分享至朋友圈</span></p>
            </div>
        </div>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
        <script>
        	var _shareInfo = {
        	    title: '<?php echo get_shop_info($share_uid);?> - 推广二维码',
        	    desc: '推广二维码 - 中华聚宝',
        	    imgUrl: '<?php echo get_shop_info($share_uid, 'user_avatar');?>',
        	    link: '<?php echo U('index', array('share_uid'=>$share_uid));?>'
        	};
        </script>
        <script>
            wx.config({
                debug: <?php if(C('DEVELOP_MODE') == 1): ?>true<?php else: ?>false<?php endif; ?>,
                appId: '<?php echo ($wx_config['appId']); ?>',
                nonceStr: '<?php echo ($wx_config['nonceStr']); ?>',
                timestamp: '<?php echo ($wx_config['timestamp']); ?>',
                signature: '<?php echo ($wx_config['signature']); ?>',
                jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'chooseImage', 'previewImage', 'uploadImage', 'downloadImage', 'openLocation', 'getLocation', 'scanQRCode', 'openProductSpecificView', 'chooseWXPay']
            });
        </script>
        <script>
        	wx.ready(function(){
        		wx.onMenuShareTimeline({
        		    title: _shareInfo.title, // 分享标题
        		    link: _shareInfo.link, // 分享链接
        		    imgUrl: _shareInfo.imgUrl, // 分享图标
        		    success: function () {
        		        // 用户确认分享后执行的回调函数
        		    },
        		    cancel: function () {
        		        // 用户取消分享后执行的回调函数
        		    }
        		});
        		wx.onMenuShareAppMessage({
        		    title: _shareInfo.title, // 分享标题
        		    desc: _shareInfo.desc, // 分享描述
        		    link: _shareInfo.link, // 分享链接
        		    imgUrl: _shareInfo.imgUrl, // 分享图标
        		    type: '', // 分享类型,music、video或link，不填默认为link
        		    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        		    success: function () {
        		        // 用户确认分享后执行的回调函数
        		    },
        		    cancel: function () {
        		        // 用户取消分享后执行的回调函数
        		    }
        		});

        	});
        </script>
    </body>
</html>