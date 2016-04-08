<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN" class="js cssanimations">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<title><?php echo C('WEB_SITE_TITLE');?></title>
<meta name="keywords">
<meta name="description">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<link rel="stylesheet" href="/Public/Home/css/libs/amazeui.min.css<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>">
<link rel="stylesheet" href="/Public/Home/css/common.css<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>">

<link rel="stylesheet" href="/Public/Home/css/pages/index_style.css<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>">
<link rel="stylesheet" href="/Public/Home/css/pages/swiper.min.css<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>">


<script>
	var _shareInfo = {
	    title: '<?php echo C('WEB_SITE_TITLE');?>',
	    desc: '<?php echo C('WEB_SITE_DESCRIPTION');?>',
	    imgUrl: 'http://static.ys.com/pai/img/logo_120.jpg',
	    link: '<?php echo C('WEB_SITE_URL');?>'
	};
</script>

</head>
<body class="">
<div class="am-container">
	
    <div class="am-g">
        <div class="top-banner top-banner1">
            <div class="swiper-container banner">
                <div class="swiper-wrapper">
                    <?php $_result=get_banner(1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="swiper-slide" style="background-image:url(<?php echo thumb($val['image']);?>);" onclick="location.href='<?php echo ($val['url']); ?>'"></div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination bnav"></div>
            </div>
            <!-- Swiper JS -->
            <script src="/Public/Home/js/widget/swiper.min.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper('.banner', {
                    pagination: '.bnav',
                    paginationClickable: true,
                    autoplay:5000,
                    loop:true,
                    autoplayDisableOnInteraction:false
                });
            </script>
        </div>
    </div>
    <div class="am-g bg-white">
        <header class="hdbt">
            活动专区
        </header>
        <section class="hdnr">
            <?php $_result=get_banner(2, 1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo ($val['url']); ?>"><img src="<?php echo thumb($val['image']);?>"><?php echo ($val['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </section>
    </div>
    <div class="am-g bg-white light-nav fix">
        <a href="<?php echo U('Index/lists', array('type'=>3));?>" class="bg-red font-white"><img src="/Public/Home/images/cate_1.png" height="66" width="101"><?php echo get_product_type(3);?>专区</a>
        <a href="<?php echo U('Index/lists', array('type'=>1));?>" class="bg-yellow font-white"><img src="/Public/Home/images/cate_2.png" height="66" width="101"><?php echo get_product_type(1);?>专区</a>
        <a href="<?php echo U('Index/lists', array('type'=>2));?>" class="bg-green font-white"><img src="/Public/Home/images/cate_3.png" height="66" width="101"><?php echo get_product_type(2);?>专区</a>
        <?php $_result=C('PRODUCT_CATE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/lists', array('cate'=>$key));?>" class="bg-gray"><img src="/Public/Home/images/cate_<?php echo $key+3;?>.png" height="66" width="101"><?php echo ($val); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="am-g bg-white" style="font-size:12px;">
        <header class="hdbt">
            精品秒杀
        </header>
        <section class="hdnr1">
            <ul class="am-avg-sm-4 am-avg-md-4 ys-grid goods-grid" id="item-list-active">
            <?php if(is_array($miaosha_list)): $i = 0; $__LIST__ = $miaosha_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="ys-grid-item">
                    <div class="ys-grid-item-inner item" id="item-<?php echo ($val['product_id']); ?>" data-page-url="<?php echo U('Index/product', array('id'=>$val['product_id']));?>">
                        <a class="img-center" href="<?php echo U('Index/product', array('id'=>$val['product_id']));?>">
                            <img alt="<?php echo ($val['product_name']); ?>" class="lazy" data-height="" data-original="<?php echo ($val['product_img']); ?>" data-width="" src="<?php echo ($val['product_img']); ?>">
                        </a>
                        <img src="/Public/Home/images/miaoshabiaozhi.png" height="40" width="40" style="width:40px;" class="miaoshabiaozhi">
                        <dl style="">
                            <dt><a href="<?php echo U('Index/product', array('id'=>$val['product_id']));?>"><?php echo ($val['product_name']); ?></a></dt>
                            <dd class="money" style="white-space: nowrap;">
                                <label>秒杀价:</label><i style="font-size:12px;">¥</i><em style="font-size:12px;"><?php echo ($val['range_price']); ?></em>
                            </dd>
                            <div>
                                <span class="light-time" style="color:#000;" data-endtime="<?php echo ($val['end_time']); ?>"><em>00</em></span>
                            </div>
                        </dl>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </section>
    </div>

    <div class="am-g bg-white">
        <header class="hdbt">
            特价活动
        </header>
        <section class="hdnr font-red">
            <?php $_result=get_banner(3, 1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo ($val['url']); ?>"><img src="<?php echo thumb($val['image']);?>"><?php echo ($val['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </section>
    </div>
    <div class="am-g bg-white" style="font-size:12px;">
        <header class="hdbt">
            推荐产品
        </header>
        <section class="hdnr1">
            <ul class="am-avg-sm-4 am-avg-md-4 ys-grid goods-grid" id="item-list-active">
            <?php if(is_array($position_list)): $i = 0; $__LIST__ = $position_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="ys-grid-item">
                    <div class="ys-grid-item-inner item" id="item-<?php echo ($val['product_id']); ?>" data-page-url="<?php echo U('Index/product', array('id'=>$val['product_id']));?>">
                        <a class="img-center" href="<?php echo U('Index/product', array('id'=>$val['product_id']));?>">
                            <img alt="<?php echo ($val['product_name']); ?>" class="lazy" data-height="" data-original="<?php echo ($val['product_img']); ?>" data-width="" src="<?php echo ($val['product_img']); ?>">
                        </a>
                        <img src="/Public/Home/images/tuijianbiaozhi.png" height="40" width="40" style="width:40px;" class="miaoshabiaozhi">
                        <dl style="">
                            <dt><a href="<?php echo U('Index/product', array('id'=>$val['product_id']));?>"><?php echo ($val['product_name']); ?></a></dt>
                            <dd class="money" style="white-space: nowrap;">
                                <label>当前价:</label><i style="font-size:12px;">¥</i><em style="font-size:12px;"><?php echo max_bid_price($val['product_id']);?></em>
                            </dd>
                            <div>
                                <span class="light-time" style="color:#000;" data-endtime="<?php echo ($val['end_time']); ?>"><em>00</em></span>
                            </div>
                        </dl>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </section>
    </div>
    <div class="am-g bg-white" style="font-size:12px;">
        <header class="hdbt">
            好店推荐
        </header>
        <style media="screen">
        .hdnr6{padding: 0 0 0 2px;}
        .hdnr6>a{float:left;width:16%;margin:1px;text-align: center;margin-top:15px;font-size: 0.5pc;line-height: 14px;white-space: nowrap;overflow: hidden;}
        .hdnr6 a img{display: block;width:100%;}
        .hdnr6 a span{display: block;width:100%;overflow:hidden;margin-bottom:3px;}
        </style>
        <section class="hdnr6">
            <?php if(is_array($shop_list)): $i = 0; $__LIST__ = $shop_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Shop/index',array('id'=>$val['user_id']));?>"><img src="<?php echo ($val['user_avatar']); ?>"><?php echo msubstr($val['user_name'],0,5,'utf-8','');?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </section>
    </div>
    <div class="am-g bg-white">
        <header class="hdbt">
            活动专区
        </header>
        <section class="hdnr">
            <div class="top-banner top-banner2">
                <div class="swiper-container banner1">
                    <div class="swiper-wrapper">
                        <?php $_result=get_banner(4);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="swiper-slide" style="background-image:url(<?php echo thumb($val['image']);?>);" onclick="location.href='<?php echo ($val['url']); ?>'"></div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination bnav1"></div>
                </div>
                <!-- Swiper JS -->
                <!-- Initialize Swiper -->
                 <script>
                var swiper1 = new Swiper('.banner1', {
                    pagination: '.bnav1',
                    paginationClickable: true,
                    autoplay:5000,
                    loop:true,
                    autoplayDisableOnInteraction:false
                });
                </script>
            </div>
        </section>

    </div>
    <div class="am-g bg-white">
        <header class="hdbt">
            新闻知识
        </header>
        <section class="hdnr3">
            <?php $_result=get_banner(5);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if(($i) == "1"): ?><a href="<?php echo ($val['url']); ?>" class="newsnr"><img src="<?php echo thumb($val['image']);?>" width="100%"><span><?php echo msubstr($val['title'],0,15);?></span></a>
                <?php else: ?>
                    <a href="<?php echo ($val['url']); ?>" class="newsk">
                        <img src="<?php echo thumb($val['image']);?>">
                        <div class="newsknr">
                            <span><?php echo msubstr($val['title'],0,15);?></span><?php echo msubstr($val['description'],0,60);?>
                        </div>
                        <div class="clear"></div>
                    </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </section>
    </div>
    <style media="screen">
    	.ui-list{
    		widht:98%;
    		margin: 10px auto;
    	}
    	.ui-list-item{
    		padding: 0 5px;
    	}
    	.goods-list .item {
    		height: auto;
    	}
    	.goods-list .item .am-img-thumbnail{
    		float: none;
    		width: auto;
    	}
    	.goods-list .item .info {
    		margin: 0;
    		padding: 0;
    		white-space: nowrap;
    		height: auto;
    	}
    	.goods-list .item .info .type{
    		top: 74%;
    	}
    	.goods-list .item .info .time{
    		top: 74%;
    		width: 83%;
    	}
    	.goods-list .item .info dt{
    		height: auto;
    		margin: 5px;
    	}
    </style>
    <div class="am-g bg-white">
        <header class="hdbt">
            更多拍品
        </header>
        <div class="ui-section-bd">
			<ul class="am-avg-sm-2 ui-list goods-list" id="item-list" style="margin-top:5px; padding:0 5px;"></ul>
		</div>
        <div class="loading" id="loading" style="display:none">
            <i class="am-icon-spinner am-icon-spin"></i>
        </div>
    </div>

	<!-- /.am-g -->
	<div class="am-g">
		<nav class="bottom-bar fixed-bottom" id="bottom-bar">
		<ul>
			<li class="home ">
			<a href="<?php echo U('Index/index');?>" title="首页">
			<i class="ys-icon-bottom-bar-home"></i><span>首页</span>
			</a>
			</li>
			<li class="auction ">
			<a href="<?php echo U('Bid/index');?>" title="我参加的拍卖">
			<i class="ys-icon-bottom-bar-auction"></i><span>我出价的</span>
			</a>
			</li>
			<li class="post active">
			<a class="post" href="javascript:;" title="发布拍品" data-am-modal="{target:&#39;#upload-actions&#39;}">
			<i class="ys-icon-bottom-bar-post"></i><span>发布</span>
			</a>
			</li>
			<li class="goods ">
			<a href="<?php echo U('Product/index');?>" title="拍品管理">
			<i class="ys-icon-bottom-bar-goods"></i><span>我上传的</span>
			</a>
			</li>
			<li class="user-home ">
			<a href="<?php echo U('User/index');?>" title="用户中心">
			<i class="ys-icon-bottom-bar-user"></i><span>我的</span>
			</a>
			</li>
		</ul>
		</nav>
		<div class="am-g">
			<div class="am-modal-actions" id="upload-actions">
				<div class="am-modal-actions-group">
					<ul class="am-list">
					<?php $_result=C('PRODUCT_TYPE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Product/add', array('type'=>$key));?>"><?php echo ($val); ?>发布</a></li><?php endforeach; endif; else: echo "" ;endif; ?>

					</ul>
				</div>
				<div class="am-modal-actions-group">
					<button class="am-btn am-btn-default am-btn-block" data-am-modal-close="">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
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
<script src="/Public/Home/js/libs/jquery.min.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/libs/jquery.cookie.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/libs/jquery.lazyload.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/libs/ejs.min.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/libs/amazeui.min.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/common.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/main.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>

<script type="text/javascript">
    var _page = 0;
    var _listApi = '<?php echo U('Index/lists');?>';
    function _listMoreHandler(data) {
        if (!window.$listWrap) {
            window.$listWrap = $('#item-list');
        }
        if (data.htmlString) {
            var $list = $(data.htmlString);
            $listWrap.append($list);
            // 设置倒计时
            initCountdown($list.find('[data-endtime]'));
            // 设置图片居中
            initImageCenter($list.find('.img-center'));
            // 设置图片懒加载
            initImageLazy($list.find('.lazy'));
        }
    }
</script>
<script src="/Public/Home/js/widget/scrollLoad.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>
<script src="/Public/Home/js/pages/index_js.js<?php if(C('DEVELOP_MODE') == 1): ?>?t=<?php echo time(); endif; ?>"></script>


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