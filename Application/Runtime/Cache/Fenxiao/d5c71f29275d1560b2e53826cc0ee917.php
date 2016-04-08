<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title><?php echo C('WEB_SITE_TITLE');?></title>
        <!--[if lt IE 9]>
        <script src="/Public/Fenxiao/jfsd/js/html5shiv.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/common.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/style.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/swiper.min.css" />
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/myjs.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/swiper.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/jquery.SuperSlide.2.1.1.js"></script>
    </head>

    <body>
        <section class="index_banner auto">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                <?php $_result=get_banner(6);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                        <a href="<?php echo ($val['url']); ?>"><img src="<?php echo thumb($val['image'], 640, 340);?>" width="640" height="340" alt="<?php echo ($val['title']); ?>"></a>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <script>
                var swiper = new Swiper('.swiper-container', {
                    pagination: '.swiper-pagination',
                    paginationClickable: true,
                    spaceBetween: 30,
                    autoplay: 3000,
                    loop: true,
                });
            </script>
        </section>
        <!--banner end-->
        <section class="index_main auto">
            <div class="index_main_top">
                <div class="index_main_top1">
                    <ul class="fix">
    <li>
        <p>
            <a href="javascript:void(0);" class="showCateName"><img src="/Public/Fenxiao/jfsd/images/bg25.png" alt=""></a>
        </p>
        <span><a href="javascript:void(0);" title="">商品分类</a></span>
    </li>
    <li>
        <p>
            <a href="<?php echo U('Flow/index');?>" title=""><img src="/Public/Fenxiao/jfsd/images/bg26.png" alt=""></a>
        </p>
        <span><a href="<?php echo U('Flow/index');?>" title="">购物车</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg27.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">论坛</a></span>
    </li>
    <li>
        <p>
            <a href="<?php echo U('User/index');?>" title=""><img src="/Public/Fenxiao/jfsd/images/bg28.png" alt=""></a>
        </p>
        <span><a href="<?php echo U('User/index');?>" title="">个人中心</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg29.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">一元购</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg30.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">积分商城</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg31.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">秒杀</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg32.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">拍卖</a></span>
    </li>
</ul>

                </div>
                <div class="index_main_top2">
                    <div class="bd fix">
                        <ol class="fix"><img src="/Public/Fenxiao/jfsd/images/bg34.png" alt=""> 聚宝快讯：</ol>
                        <ul class="infoList">
                            <?php $_result=get_banner(7);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($val['url']); ?>" title="<?php echo ($val['title']); ?>"><?php echo ($val['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="bd fix">
                        <ol class="fix"><img src="/Public/Fenxiao/jfsd/images/bg34.png" alt=""> 聚宝快讯：</ol>
                        <ul class="infoList">
                            <?php $_result=get_banner(8);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($val['url']); ?>" title="<?php echo ($val['title']); ?>"><?php echo ($val['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        jQuery(".index_main_top2").slide({
                            mainCell: ".bd ul",
                            autoPlay: true,
                            effect: "leftMarquee",
                            vis: 1,
                            interTime: 50,
                            trigger: "click"
                        });
                    </script>
                </div>
            </div>
            <div class="index_main_bottom">
                <ul class="fix">
                    <?php if(is_array($position_list)): $i = 0; $__LIST__ = $position_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
                            <p>
                                <a href="<?php echo U('product', array('id'=>$val['product_id']));?>" title=""><img src="<?php echo image($val['thumb']);?>" alt=""></a>
                            </p>
                            <span>
                                <a href="<?php echo U('product', array('id'=>$val['product_id']));?>" title="<?php echo ($val['product_name']); ?>"><?php echo ($val['product_name']); ?></a>
                                <em class="fix">
                                    <b>￥<?php echo ($val['xian_price']); ?></b>
                                    <del>￥<?php echo ($val['yuan_price']); ?></del>
                                </em>
                            </span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ol>
                    <?php $_result=get_banner(9);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo ($val['url']); ?>" title="<?php echo ($val['title']); ?>"><img src="<?php echo thumb($val['image'], 600, 133);?>" alt="<?php echo ($val['title']); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
                <ul class="fix" id="item-lists"></ul>
                <dl id="loading">
                    <dt><img src="/Public/Fenxiao/jfsd/images/jiazai.gif" alt=""></dt>
                    <dd>正在加载...</dd>
                </dl>
            </div>
        </section>
        <section class="index_xf auto">
            <ul class="fix">
    <li>
        <p>
            <a href="javascript:void(0);" class="showCateName"><img src="/Public/Fenxiao/jfsd/images/bg25.png" alt=""></a>
        </p>
        <span><a href="javascript:void(0);" title="">商品分类</a></span>
    </li>
    <li>
        <p>
            <a href="<?php echo U('Flow/index');?>" title=""><img src="/Public/Fenxiao/jfsd/images/bg26.png" alt=""></a>
        </p>
        <span><a href="<?php echo U('Flow/index');?>" title="">购物车</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg27.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">论坛</a></span>
    </li>
    <li>
        <p>
            <a href="<?php echo U('User/index');?>" title=""><img src="/Public/Fenxiao/jfsd/images/bg28.png" alt=""></a>
        </p>
        <span><a href="<?php echo U('User/index');?>" title="">个人中心</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg29.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">一元购</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg30.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">积分商城</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg31.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">秒杀</a></span>
    </li>
    <li>
        <p>
            <a href="javascript:alert('完事开发中...')" title=""><img src="/Public/Fenxiao/jfsd/images/bg32.png" alt=""></a>
        </p>
        <span><a href="javascript:alert('完事开发中...')" title="">拍卖</a></span>
    </li>
</ul>

        </section>
        <!---->
        <div id="CateName" class="CateName">
            <div class="Select">
                <div class="Select1">
                    <div class="Select1_Top">
                        <ol class="fix">
                            <input name="keyword" class="wbk" type="text" id="search" placeholder="请输入关键字" />
                        </ol>
                        <ul class="level0">
                            <li data-val="">全部分类</li>
                            <?php $_result=C('FX_PRODUCT_CATE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li data-val="<?php echo ($key); ?>"><?php echo ($val); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div id="Btn" class="Btn" style="display: ">
                        <div>
                            <a href="javascript:void(0);" class="hideCateName left"><span style="color: #FFFFFF">关闭选择</span></a>
                            <a href="javascript:void(0);" class="right selects"><span style="color: #FFFFFF">确定选择</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function(){
                $(".showCateName").click(function(){
                    $("#CateName").show().addClass('animation')
                })
                $(".hideCateName").click(function(){
                    $("#CateName").removeClass('animation').hide()
                })
                $(".level0 li").each(function(i){
                    $(this).click(function(){
                        $(".level0 li").removeClass("current")
                        $(this).addClass("current")
                    })
                })
                $(".selects").click(function(){
                    var _keyword = $("input[name=keyword]").val(),
                        _cate = $(".level0 li.current").data('val');
                    if (_keyword == undefined || _keyword == '') {
                        _keyword = 0
                    }
                    if (_cate == null || _cate == '') {
                        _cate = 0
                    }
                    window.location.href = '/Fenxiao/Index/lists/keyword/' + _keyword + '/cate/' + _cate;
                })

            })
	        var _page = 1,
	            _tag = true,
				scrollLoad = function() {
					$.ajax({
						url: '<?php echo U('lists', $souso);?>',
						data: {page: _page},
						type: 'post',
						dateType: 'html',
						beforeSend: function(){
							_tag = false;
							$("#loading").show();
						},
						success: function(res) {
							if (res !== '') {
								$("#loading").hide();
								$("#item-lists").append(res);
								_page++;
								_tag = true;
							} else {
								$("#loading").find("dd").html("没有更多数据...");
							}
						},
						error: function() {
							alert('网络异常...')
						}
					})
				}
	    	//首页加载
			scrollLoad();
	    	$(window).scroll(function () {
	    		if (_tag && $(window).scrollTop() >= ($(document).height() - $(window).height()) * 0.99) {
					scrollLoad()
	    		}
	    	});
        </script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
        <script>
            var _shareInfo = {
                title: '<?php echo C('WEB_SITE_TITLE');?>',
                desc: '<?php echo C('WEB_SITE_DESCRIPTION');?>',
                imgUrl: '<?php echo C('WEB_SITE_URL');?>/Public/Fenxiao/jfsd/images/logo.png',
                link: '<?php echo U('index', array('share_uid'=>$user_info['user_id']));?>'
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