<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>确认订单</title>
        <!--[if lt IE 9]>
            <script src="/Public/Fenxiao/jfsd/js/html5shiv.min.js"></script>
            <script src="/Public/Fenxiao/jfsd/js/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/common.css" />
        <link rel="stylesheet" href="/Public/Fenxiao/jfsd/css/style.css?c=31213" />
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/myjs.js"></script>
        <script src="/Public/Fenxiao/jfsd/js/swiper.min.js"></script>
    </head>

    <body>
        <section class="qrdd_main auto">
        <form action="">
            <div class="qrdd_main1">
                <h2><img src="/Public/Fenxiao/jfsd/images/bg50.png" alt=""> 收货信息</h2>
                <ol>
                <?php if(empty($consign_lists)): ?><a href="<?php echo U('User/address', array('type'=>1, 'redirct_url'=>base64_encode('Flow/submit')));?>" title="请完善收货信息">请完善收货信息</a>
                <?php else: ?>
                    <?php if(is_array($consign_lists)): $i = 0; $__LIST__ = $consign_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="fix">
                            <p>
                                <input id="radio-1-<?php echo ($val['address_id']); ?>" class="regular-radio big-radio" type="radio" name="address_id" value="<?php echo ($val['address_id']); ?>" <?php if(($val['is_default']) == "1"): ?>checked<?php endif; ?>/>
                                <label for="radio-1-<?php echo ($val['address_id']); ?>" style="margin-top:30px;"></label>
                            </p>
                            <a href="javascrip:void(0);"><?php echo ($val['consign_name']); ?>    <?php echo ($val['mobile']); ?><br /><?php echo ($val['province']); ?>-<?php echo ($val['city']); ?>-<?php echo ($val['area']); ?>-<?php echo ($val['address']); ?></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </ol>
            </div>
            <div class="qrdd_main2">
                <h2><img src="/Public/Fenxiao/jfsd/images/bg51.png" alt=""> 支付方式</h2>
                <ul>
                    <li class="fix">
                        <p>
                            <input id="radio-2-1" class="regular-radio big-radio" type="radio" name="pay_mode" value="1" checked/>
                            <label for="radio-2-1" style="margin-top:30px;"></label>
                        </p>
                        <span><img src="/Public/Fenxiao/jfsd/images/pic13.jpg" alt=""></span>
                        <em>微支付3.0</em>
                    </li>
                    <li class="fix">
                        <p>
                            <input id="radio-2-2" class="regular-radio big-radio" type="radio" name="pay_mode" value="2" />
                            <label for="radio-2-2" style="margin-top:30px;"></label>
                        </p>
                        <span><img src="/Public/Fenxiao/jfsd/images/pic14.jpg" alt=""></span>
                        <em>余额支付</em>
                    </li>
                </ul>
            </div>
            <div class="qrdd_main3">
                <h2><img src="/Public/Fenxiao/jfsd/images/bg52.png" alt=""> 订单信息</h2>
                <ul>
                    <li>商品金额：<?php echo ($count_price); ?></li>
                    <li>商品数量：<?php echo ($count_num); ?></li>
                    <li>订单运费：免运费</li>
                    <li>备注信息：
                        <input type="text" name="content" style="color: #515151; width: 350px; height: 63px; line-height: 63px; background: none; border: none; -webkit-appearance: none;">
                    </li>
                </ul>
            </div>
            <div class="gwc_main_bottom fix">
                <ol>合计：<span>￥<?php echo ($count_price); ?></span></ol>
                <ul><a href="javascript:void(0);" id="submit">提交订单</a></ul>
            </div>
        </form>
        </section>
        <script type="text/javascript">
            $(function(){
                var flag = true
                if (flag) {
                    $("#submit").bind('click', function(){
                        $.ajax({
                            url: '<?php echo U('Flow/submit');?>',
                            data: $("form").serialize(),
                            type: 'post',
                            dataType: 'json',
                            beforeSend: function(){
                                flag = false
                            },
                            success: function(res) {
                                if (res.status) {
                                    location.href = res.url
                                } else {
                                    flag = true
                                    alert(res.info)
                                }
                            },
                            error: function(){
                                flag = true
                                alert('网络异常...')
                            }
                        })
                    })
                }
            })
        </script>
    </body>

</html>