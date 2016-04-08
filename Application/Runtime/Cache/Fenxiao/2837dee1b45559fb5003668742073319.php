<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>产品详细信息</title>
        <!--[if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
            <script src="js/respond.min.js"></script>
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
                <?php if(is_array($info['images'])): $i = 0; $__LIST__ = $info['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img src="<?php echo thumb($val, 640, 340);?>" width="640" height="340" alt="<?php echo ($info['product_name']); ?>"></div><?php endforeach; endif; else: echo "" ;endif; ?>
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
        <section class="cpxx_main auto">
            <div class="cpxx_main1 fix">
                <ol class="fix">
                    <?php if($user_info['fx_sup'] > 0): ?><p>
                            <img src="<?php echo get_user_info($user_info['fx_sup'], 'user_avatar');?>" alt="">
                            <em><a href="javascript:void(0);" title=""><img src="/Public/Fenxiao/jfsd/images/bg44.png" alt=""></a></em>
                        </p>
                        <span>
                            来自 <?php echo get_user_info($user_info['fx_sup'], 'user_name');?> 的分享
                            <em>快乐源自分享</em>
                        </span>
                    <?php else: ?>
                        <p>
                            <img src="/Public/Fenxiao/jfsd/images/logo.png" alt="">
                            <em><a href="javascript:void(0);" title=""><img src="/Public/Fenxiao/jfsd/images/bg44.png" alt=""></a></em>
                        </p>
                        <span>
                            来自 中华聚宝 的分享
                            <em>快乐源自分享</em>
                        </span><?php endif; ?>
                </ol>
                <ul><a href="<?php echo U('User/index');?>" title="<?php echo ($user_info['user_name']); ?>">会员中心</a></ul>
            </div>
            <div class="cpxx_main2">
                <div class="cpxx_main2_1"><?php echo ($info['product_name']); ?></div>
                <div class="cpxx_main2_2 fix">
                    <span>现价：<em>￥<?php echo ($info['xian_price']); ?></em><del>原价：￥<?php echo ($info['yuan_price']); ?></del></span>
                    <a href="javascript:ajaxPost('<?php echo U('User/collect', array('type'=>1,'product_id'=>$info['product_id']));?>');" title=""><img src="/Public/Fenxiao/jfsd/images/bg45.png" alt=""> 收藏</a>
                </div>
                <div class="cpxx_main2_3 fix">
                    <div class="z_jiajian fix">
                        <div class="z_jian z_szanniu z_fs16 tc fl">-</div>
                        <div class="z_shu fl tc" data-num="1">
                            <input type="text" id="num" class="z_shu_input z_fs16 tc" value="1">
                        </div>
                        <div class="z_jia z_szanniu z_fs16 tc fl">+</div>
                    </div>
                    <!-- <div class="kcys">库存：496<br />已售：62</div> -->
                </div>
                <div class="cpxx_main2_4">卖家包邮</div>
                <div class="cpxx_main2_5">我要推荐</div>
                <div class="cpxx_main2_6 fix">
                    <input type="button" id="add-cart" value="放入购物车" class="btn1" />
                    <input type="submit" id="buy" id="button" value="立即购买" class="btn2" />
                </div>
            </div>
            <div class="cpxx_main3">
                <h2 class="fix"><a href="javascript:void(0);" title="">商品介绍</a></h2>
                <ul><?php echo ($info['content']); ?></ul>
            </div>
        </section>
        <script type="text/javascript">
            var ajaxPost = function(url, data){

            }
            $("#add-cart").bind('click', function(){
                var data = {
                    product_id: <?php echo ($info['product_id']); ?>,
                    num: $("#num").val()
                }
                $.ajax({
                    url: '<?php echo U('Flow/add');?>',
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            alert(res.info)
                        } else {
                            alert(res.info)
                        }
                    },
                    error: function(){
                        alert('网络异常...')
                    }
                })
            })
            $("#buy").bind('click', function(){
                var data = {
                    product_id: <?php echo ($info['product_id']); ?>,
                    num: $("#num").val()
                }
                $.ajax({
                    url: '<?php echo U('Flow/add');?>',
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            location.href = '<?php echo U('Flow/index');?>'
                        } else {
                            alert(res.info)
                        }
                    },
                    error: function(){
                        alert('网络异常...')
                    }
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