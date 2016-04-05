<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
    <title>排行榜</title>
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
<!--<header class="grzx_header auto">个人中心<a href="javascript:history.go(-1);" title="">< 返回</a></header>-->
<!--header end-->
<section class="phb_main auto">
    <ul>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="fix">
                <span>
                    <dl class="fix">
                        <dt><a href="javascript:void(0);"><img src="<?php echo ($val['user_avatar']); ?>" alt="<?php echo ($val['user_name']); ?>" width="108" height="108"></a></dt>
                        <dd>
                            <a href="javascript:void(0);"><?php echo ($val['user_name']); ?></a>
                            推荐人：<?php echo ($val['fx_sup']); ?>
                            <p class="fix">
                                <b><?php echo get_fx_group($val['fx_group'], 'name');?></b>
                                <i>￥<?php echo ($val['fx_count']); ?></i>
                            </p>
                        </dd>
                    </dl>
                </span>
                <em><?php echo ($i); ?></em>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
    <ol>
        <p><img src="/Public/Fenxiao/jfsd/images/jiazai.gif" alt=""></p>
        <span>最多显示前100名...</span>
    </ol>
</section>
<!---->
<!-- <footer class="dbnr_main auto">
    <ul class="fix">
        <li>
            <a href="#" title="">
                <img src="images/bg7.png" alt="">
                <span>聚宝商城</span>
            </a>
        </li>
        <li>
            <a href="#" title="">
                <img src="images/bg8.png" alt="">
                <span>我的订单</span>
            </a>
        </li>
        <li>
            <a href="#" title="">
                <img src="images/bg9.png" alt="">
                <span>购物车</span>
            </a>
        </li>
        <li>
            <a href="#" title="">
                <img src="images/bg10.png" alt="">
                <span>个人中心</span>
            </a>
        </li>
    </ul>
</footer> -->
<!--footer end-->
</body>
</html>