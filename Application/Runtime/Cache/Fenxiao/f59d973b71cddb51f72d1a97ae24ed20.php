<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>产品列表</title>
        <!--[if lt IE 9]>
        <script src="/Public/Fenxiao/jfsd/js/html5shiv.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/common.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/style.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/swiper.min.css" />
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/myjs.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/DoCookies.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/Default.js"></script>
    </head>

    <body>
        <!--banner end-->
        <section class="index_main auto" style="padding-bottom:0;">
            <div class="index_main_bottom">
                <!-- <ol>
                    <a href="#" title=""><img src="/Public/Fenxiao/jfsd/images/pic6.jpg" alt=""></a>
                </ol> -->
                <ul class="fix" id="item-lists">
                </ul>
                <dl id="loading">
                    <dt><img src="/Public/Fenxiao/jfsd/images/jiazai.gif" alt=""></dt>
                    <dd>正在加载...</dd>
                </dl>
            </div>
        </section>
        <script type="text/javascript">
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
    </body>
</html>