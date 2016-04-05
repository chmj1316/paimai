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
            <div class="grzx_main_top">
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
            <div class="fxyj_main">
                    <div class="fxyj_main_top">
                        <ol>
                            总收入：<?php echo ($user_info['fx_count']); ?><br />
                            当前：<?php echo ($user_info['fx_money']); ?>，可提：<?php echo ($user_info['fx_money']); ?>
                        </ol>
                        <ul><a href="<?php echo U('tixian');?>" title="">提现</a></ul>
                    </div>
                    <div class="fxyj_main_bottom">
                        <ol class="fix">
                            <li><a href="#" title="" class="xz">分销佣金</a></li>
                            <li><a href="#" title="">佣金明细</a></li>
                        </ol>
                        <ul>
                            <li class="fix">
                                <p>
                                    返现佣金：<em>￥31.92</em><br />
                                    返现状态：已返现<br />
                                    返现时间：2016/2/25  20:39:24<br />
                                    订单编号：VSHop201602250839081<br />
                                    订单时间：2016/2/25 20:39:24
                                </p>
                                <span>
                                    <img src="images/bg38.png" alt="">
                                    <em>情有独钟/85393140</em>
                                </span>
                            </li>
                            <li class="fix">
                                <p>
                                    返现佣金：<em>￥31.92</em><br />
                                    返现状态：已返现<br />
                                    返现时间：2016/2/25  20:39:24<br />
                                    订单编号：VSHop201602250839081<br />
                                    订单时间：2016/2/25 20:39:24
                                </p>
                                <span>
                                    <img src="images/bg38.png" alt="">
                                    <em>情有独钟/85393140</em>
                                </span>
                            </li>
                        </ul>
                    </div>
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