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

                <ul class="fix">
                    <li>
                        <a href="<?php echo U('moneyLog');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg4.png" alt="">
                            <span>佣金：<?php echo ($user_info['fx_money']); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('interLog');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg5.png" alt="">
                            <span>积分：<?php echo ($user_info['fx_inter']); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('hongbao');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg6.png" alt="">
                            <span>返利红包：<?php echo ($user_info['fx_hb']); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="grzx_main_bottom">
                <ul class="fix">
                    <li>
                        <a href="<?php echo U('fenxiao');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg11.png" alt="">
                            <span>我的分销</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('caifu');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg12.png" alt="">
                            <span>我的财富</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('zhuanMoney');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg13.png" alt="">
                            <span>转币管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('collect');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg14.png" alt="">
                            <span>我的收藏</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('moneyLog');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg15.png" alt="">
                            <span>我的提现</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('address');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg54.png" alt="">
                            <span>收货地址</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('tuiguang');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg17.png" alt="">
                            <span>二维码</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('ranking');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg18.png" alt="">
                            <span>排行榜</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:alert('二期开发项目');" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg19.png" alt="">
                            <span>积分商城</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:alert('二期开发项目');" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg20.png" alt="">
                            <span>一元购</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Home/Index/index');?>" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg21.png" alt="">
                            <span>秒杀现场</span>
                        </a>
                    </li>
                    <li>
                        <a href="/bbs/" title="">
                            <img src="/Public/Fenxiao/jfsd/images/bg22.png" alt="">
                            <span>论坛</span>
                        </a>
                    </li>
                </ul>
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