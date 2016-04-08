<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>我的订单</title>
        <!--[if lt IE 9]>
            <script src="/Public/Fenxiao/jfsd/js/html5shiv.min.js"></script>
            <script src="/Public/Fenxiao/jfsd/js/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/common.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/style.css" />
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/myjs.js"></script>
    </head>

    <body>
        <!--header end-->
        <section class="grzx_main auto">
            <div class="grzx_main_top">
                <dl class="fix">
    <dt>
        <p onclick="syncUserInfo();">
            <img src="<?php echo ($user_info['user_avatar']); ?>" alt="">
            <em><a href="<?php echo U('index');?>" title=""><img src="/Public/Fenxiao/jfsd/images/bg2.png" alt=""></a></em>
        </p>
        <span><a href="<?php echo U('index');?>" title=""><?php echo get_fx_group($user_info['fx_group'], 'name');?></a></span>
    </dt>
    <dd>
        会员ID ：<?php echo ($user_info['user_id']); ?>
        <br /> 昵称 ：<?php echo ($user_info['user_name']); ?>
        <br /> 推荐人：
        <?php echo empty($user_info['fx_sup'])?'中华聚宝':get_shop_info($user_info['user_avatar'])?>
        <a href="<?php echo U('index');?>" title=""><img src="/Public/Fenxiao/jfsd/images/bg3.png" alt=""></a>
    </dd>
</dl>
<script type="text/javascript">
    var updateUserInfo = function() {
        $.ajax({
            url: '<?php echo U('syncUserInfo');?>',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    // alert(res.info)
                    location.href = res.url
                } else {
                    alert(res.info)
                }
            },
            error: function(){
                alert('网络异常...')
            }
        })
    }
</script>

            </div>
            <div class="yjkh_main">
                <div class="yjkh_main_top">
                    <ul class="fix">
                        <li><a href="<?php echo U('index', array('status'=>1));?>" <?php if(($souso['status']) == "1"): ?>class="xz"<?php endif; ?>>待付款</a></li>
                        <li><a href="<?php echo U('index', array('status'=>3));?>" <?php if(($souso['status']) == "3"): ?>class="xz"<?php endif; ?>>待签收</a></li>
                        <li><a href="<?php echo U('index');?>" <?php if(empty($souso['status'])): ?>class="xz"<?php endif; ?>>全部订单</a></li>
                    </ul>
                </div>
                <div class="qbdd_main">
                <ul>
                    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="fix">
                            <p><img onclick="location.href='<?php echo ($val['url']); ?>'" src="<?php echo ($val['thumb']); ?>" alt="<?php echo ($val['title']); ?>" width="136" height="136"></p>
                            <span>
                            	<a href="<?php echo ($val['url']); ?>" title=""><?php echo ($val['order_id']); ?></a>
                                价格：<?php echo ($val['price']); ?> 数量：<?php echo ($val['num']); ?><br />
                                点击订单号查看订单详情
                            </span>
                            <em class="style<?php echo ($val['status']); ?>"><a href="<?php echo ($val['url']); ?>" title=""><?php echo ($val['status_text']); ?></a></em>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            </div>
        </section>
        <!--foot start-->
<div style="height:120px;"></div>
<footer class="dbnr_main auto">
    <ul class="fix">
        <li>
            <a href="<?php echo U('Index/index');?>" title="">
                <img src="/Public/Fenxiao/jfsd/images/bg7.png" alt="">
                <span>聚宝商城</span>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Order/index');?>" title="">
                <img src="/Public/Fenxiao/jfsd/images/bg8.png" alt="">
                <span>我的订单</span>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Flow/index');?>" title="">
                <img src="/Public/Fenxiao/jfsd/images/bg9.png" alt="">
                <span>购物车</span>
            </a>
        </li>
        <li>
            <a href="<?php echo U('User/index');?>" title="">
                <img src="/Public/Fenxiao/jfsd/images/bg10.png" alt="">
                <span>个人中心</span>
            </a>
        </li>
    </ul>
</footer>
<!--footer end-->

    </body>

</html>