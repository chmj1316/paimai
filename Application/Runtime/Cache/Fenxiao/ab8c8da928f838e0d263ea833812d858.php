<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>购物车</title>
        <!--[if lt IE 9]>
            <script src="/Public/Fenxiao/jfsd/js/html5shiv.min.js"></script>
            <script src="/Public/Fenxiao/jfsd/js/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/common.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/style.css" />
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/myjs.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/swiper.min.js"></script>
    </head>

    <body>
        <section class="gwc_main auto">
            <div class="gwc_main_top">
            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><dl class="fix" data-id="<?php echo ($key); ?>">
                    <dt><a href="#" title=""><img src="<?php echo thumb($val['thumb'], 155, 207);?>" alt=""></a></dt>
                    <dd>
                        <a href="#" title=""><?php echo msubstr($val['product_name'], 0, 12);?></a>
                        <p class="fix">
                            <span>价格：<em>￥<?php echo ($val['xian_price']); ?></em></span>
                            <span>小计：<em>￥<?php echo ($val['xian_price'] * $val['num']); ?></em></span>
                        </p>
                        <div class="z_jiajian fix">
                            <div class="z_jian z_szanniu z_fs16 tc fl">-</div>
                            <div class="z_shu fl tc" data-num="1">
                                <input type="text" class="z_shu_input z_fs16 tc" value="<?php echo ($val['num']); ?>">
                            </div>
                            <div class="z_jia z_szanniu z_fs16 tc fl">+</div>
                        </div>
                        <div class="gb">
                            <a href="javascript:void(0);" title=""><img src="/Public/Fenxiao/jfsd/images/bg49.png" alt=""></a>
                        </div>
                    </dd>
                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="gwc_main_bottom fix">
                <ol>合计：<span>￥<?php echo ($count_price); ?></span></ol>
                <ul><a href="<?php echo U('Flow/submit');?>" title="">提交订单</a></ul>
            </div>
        </section>
        <script type="text/javascript">
            $(".z_jia").bind('click', function(){
                var product_id = $(this).closest("dl").data('id');
                $.ajax({
                    url: '<?php echo U('Flow/add');?>',
                    data: {product_id: product_id, num: 1},
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
            $(".z_jian").bind('click', function(){
                var product_id = $(this).closest("dl").data('id');
                $.ajax({
                    url: '<?php echo U('Flow/add');?>',
                    data: {product_id: product_id, num: -1},
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
            $(".gb").bind('click', function(){
                var product_id = $(this).closest("dl").data('id');
                $.ajax({
                    url: '<?php echo U('Flow/del');?>',
                    data: {product_id: product_id},
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
    </body>

</html>