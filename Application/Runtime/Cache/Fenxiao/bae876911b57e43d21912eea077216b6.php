<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>积分转赠</title>
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
        <!--header end-->
        <section class="xzshdz_main auto">
            <div class="xzshdz_main">
                <span><a href="<?php echo U('User/zhuanInter');?>" class="xz">积分转赠</a></span>
                <span><a href="<?php echo U('User/zhuanMoney');?>" >资金转赠</a></span>
            </div>
            <ul>
                <li class="fix">
                    <p>累计数量：</p>
                    <span><?php echo ($user_info['fx_inter_lj']); ?></span>
                </li>
                <li class="fix">
                    <p>现有数量：</p>
                    <span id="nowmoney"><?php echo ($user_info['fx_inter']); ?></span>
                </li>
                <li class="fix">
                    <p>可用数量：</p>
                    <span id="myliveMoney" data-moneys="<?php echo ($user_info['fx_inter']); ?>"><?php echo ($user_info['fx_inter']); ?></span>
                </li>
                <li class="fix">
                    <p>获赠人ID：</p>
                    <span>
                        <input type="number" class="wbk" id="userId" placeholder="点击确认后会提示昵称">
                    </span>
                </li>
                <li class="fix">
                    <p>转赠数量：</p>
                    <span>
                        <input type="number" class="wbk" id="moneysAmount" placeholder="最多转赠数量：<?php echo ($user_info['fx_inter']); ?>">
                    </span>
                </li>
            </ul>
            <dl>
                <input type="button" name="button" id="btnBegin" value="确认转赠" class="btn" />
            </dl>
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

        <script type="text/javascript">
            $('#btnBegin').bind('click', function () {
                $("#btnBegin").attr('disabled', true)
                var liveMoney = $('#myliveMoney').data('moneys');
                var userId = $('#userId').val();
                var moneysAmount = $('#moneysAmount').val();
                if (moneysAmount % 100 != 0  || moneysAmount == 0) {
                    alert('转赠失败,转赠数量必需能整除100');
                    $("#btnBegin").attr('disabled', false)
                    return false;
                }
                if (isNaN(userId) || isNaN(moneysAmount) || userId < 1 || moneysAmount <= 0) {
                    alert('获赠人ID或转赠数量填写错误!');
                    $("#btnBegin").attr('disabled', false)
                    return false;
                }
                if (userId == '<?php echo ($user_info['user_id']); ?>') {
                    alert('囧，自己不能赠送给自己。');
                    $("#btnBegin").attr('disabled', false)
                    return false;
                }
                if (parseFloat(liveMoney) < parseFloat(moneysAmount)) {
                    alert('转赠数量不能大于您的可用数量。');
                    $('#moneysAmount').focus();
                    $("#btnBegin").attr('disabled', false)
                    return false;
                }
                $.ajax({
                    url: "<?php echo U('checkUser');?>",
                    data: {uid: userId},
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function() {
                        $("#btnBegin").attr('disabled', true);
                    },
                    success: function(msg) {
                        if (msg.status) {
                            if (confirm('确认转赠给' + msg.info)) {
                                $.ajax({
                                    data: {uid: userId, inter: moneysAmount},
                                    type: 'post',
                                    dataType: 'json',
                                    success: function(rep) {
                                        if (rep.status) {
                                            alert(rep.info)
                                            window.location.reload()
                                        } else {
                                            $("#btnBegin").attr('disabled', false)
                                            alert(rep.info)
                                        }
                                    },
                                    error: function() {
                                        $("#btnBegin").attr('disabled', false)
                                        alert('网络异常...')
                                    }
                                })
                            } else {
                                $("#btnBegin").attr('disabled', false)
                            }
                        } else {
                            $("#btnBegin").attr('disabled', false)
                            alert(msg.info)
                        }
                    },
                    error: function() {
                        $("#btnBegin").attr('disabled', false)
                        alert('网络异常...')
                    }
                })
            });
        </script>


    </body>

</html>