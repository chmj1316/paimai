<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>我的财富</title>
        <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/common.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/style.css" />
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/myjs.js"></script>
    </head>

    <body>
        <!-- <header class="grzx_header auto">个人中心<a href="javascript:history.go(-1);" title="">< 返回</a></header> -->
        <!--header end-->
        <section class="wdcf_main auto">
            <ul>
                <li class="fix"><a href="javascript:void(0);" title=""><em>1.累计分销积分</em><span>￥<?php echo ($user_info['fx_inter_lj']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>2.可用分销积分</em><span>￥<?php echo ($user_info['fx_inter']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>3.已用分销积分</em><span>￥<?php echo ($user_info['fx_inter_lj'] - $user_info['fx_inter']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>4.累计分销资金</em><span>￥<?php echo ($user_info['fx_count']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>5.我的资金</em><span>￥<?php echo ($user_info['fx_money']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>6.已用资金</em><span>￥<?php echo ($user_info['fx_count'] - $user_info['fx_money']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>7.累计红包总数</em><span>￥<?php echo ($user_info['fx_hb_lj']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>8.我的红包数</em><span>￥<?php echo ($user_info['fx_hb']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>9.总消费累计</em><span>￥<?php echo ($user_info['fx_hb_zxf_lj']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>10.已领取红包消费累计</em><span>￥<?php echo ($user_info['fx_hb_ylqxf_lj']); ?></span></a></li>
                <li class="fix"><a href="javascript:void(0);" title=""><em>10.未领取红包消费累计</em><span>￥<?php echo ($user_info['fx_hb_wlqxf_lj']); ?></span></a></li>
            </ul>
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