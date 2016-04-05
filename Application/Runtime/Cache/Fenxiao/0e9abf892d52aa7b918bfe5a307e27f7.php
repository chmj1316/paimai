<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>个人中心</title>
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
            <div class="grzx_main_top" style="height:246px;">
                <dl class="fix">
                    <dt>
                        <p>
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
            </div>
            <div class="wdfx_main">
                <ul>
                    <li class="fix"><a href="javascript:void(0);" style=" background:none;"><span>我的客户</span></a></li>
                    <li class="fix"><a href="javascript:void(0);"><span>全部客户</span><?php echo ($fenxiao[1]['count'] + $fenxiao[2]['count'] + $fenxiao[3]['count']); ?></a></li>
                    <li class="fix"><a href="javascript:void(0);"><span>一层客户</span><?php echo ($fenxiao[1]['count']); ?></a></li>
                    <li class="fix"><a href="javascript:void(0);"><span>二层客户</span><?php echo ($fenxiao[2]['count']); ?></a></li>
                    <li class="fix"><a href="javascript:void(0);"><span>三层客户</span><?php echo ($fenxiao[3]['count']); ?></a></li>
                    <li class="fix"><a href="javascript:void(0);" style=" background:none;"><span>客户统计</span></a></li>
                </ul>
                <ol>
                    <li class="fix"><a href="#" title=""><span>我的订单</span></a></li>
                </ol>
            </div>
        </section>
        <!--foot start-->
<footer class="dbnr_main auto">
    <ul class="fix">
        <li>
            <a href="<?php echo U('Index/index');?>" title="">
                <img src="/Public/Fenxiao/jfsd/images/bg7.png" alt="">
                <span>聚宝商城</span>
            </a>
        </li>
        <li>
            <a href="#" title="">
                <img src="/Public/Fenxiao/jfsd/images/bg8.png" alt="">
                <span>我的订单</span>
            </a>
        </li>
        <li>
            <a href="#" title="">
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