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

            </div>
            <div class="fxyj_main">
                <div class="fxyj_main_top">
                    <ol>
                        总收入：<?php echo ($user_info['fx_count']); ?>
                        <br /> 当前：<?php echo ($user_info['fx_money']); ?>，可提：<?php echo ($user_info['fx_money']); ?>
                    </ol>
                    <ul><a href="<?php echo U('tixian');?>" title="">提现</a></ul>
                </div>
                <div class="fxyj_main_bottom">
                    <ol class="fix">
                        <li><a href="javascript:void(0);" class="xz">分销佣金</a></li>
                        <li><a href="javascript:void(0);">佣金明细</a></li>
                    </ol>
                    <ul>
                        <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="fix">
                                <p>
                                    返现佣金：<em>￥<?php echo ($val['money']); ?></em><br>
                                    返现状态：已返现<br>
                                    返现时间：<?php echo date('Y/m/d H:i:s', $val['create_time']);?><br>
                                    订单编号：<?php echo ($val['order_id']); ?><br>
                                    订单时间：<?php echo date('Y/m/d H:i:s', $val['create_time']);?>
                                </p>
                                <!-- <span>
                                    <img src="images/bg38.png" alt="">
                                    <em>情有独钟/85393140</em>
                                </span> -->
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <ul style="display:none;">
                        <?php if(is_array($lists2)): $i = 0; $__LIST__ = $lists2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="fix">
                                <p>
                                    收支名称：<?php echo ($val['title']); ?><br>
                                    收支金额：<em>￥<?php echo ($val['money']); ?></em><br>
                                    当前余额：<em>￥<?php echo ($val['at_money']); ?></em><br>
                                    明细说明：<?php echo ($val['content']); ?><br>
                                    操作时间：<?php echo date('Y/m/d H:i:s', $val['create_time']);?>
                                </p>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        <script type="text/javascript">
            $(function(){
                var tabObj = $(".fxyj_main_bottom .fix li a");
                tabObj.each(function(index){
                    $(this).click(function(){
                        tabObj.removeClass("xz");
                        $(this).addClass("xz");
                        $(".fxyj_main_bottom ul").hide().eq(index).show();
                    })
                })
            })
        </script>
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