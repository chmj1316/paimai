<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <!-- Set render engine for 360 browser -->
        <meta name="renderer" content="webkit">
        <script type="text/javascript" src="/Public/Fenxiao/js/jquery-1.10.1.min.js"></script>
        <link href="/Public/Fenxiao/css/Css.css" rel="stylesheet">
        <link href="/Public/Fenxiao/css/Css(1).css?1111" rel="stylesheet">
        <title>余额转赠</title>
        <style type="text/css">
            .topTab {
                height: 35px;
                line-height: 35px;
                margin: 10px 10px 3px 10px;
            }

            .topTab > .Tab {
                background: #FFFFFF;
                float: left;
                text-align: center;
                width: 50%;
            }

            .topTab > .Tab.active {
                background: #6DB248;
                color: #FFFFFF;
            }

            .divCard {
                display: none;
            }

            .OpenArea {
                background-color: rgba(0, 0, 0, 0.5);
                height: 100%;
                left: 0px;
                position: fixed;
                top: 0px;
                width: 100%;
            }

            .AddressAddInfo .RowDiv .left {
                width: 99px !important;
            }

            .AddressAddInfo .RowDiv .right {
                margin-left: 97px !important;
            }

            .sel {
                height: 40px;
                width: 99px;
            }

            .SelectArea {
                background-color: rgba(255, 255, 255, 1);
                border-radius: 3px;
                bottom: 40px;
                box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
                font-size: 1.4rem;
                left: 20px;
                overflow: auto;
                padding: 8px;
                position: absolute;
                right: 20px;
                top: 40px;
            }

            .SelectArea li {
                border-bottom: 1px #E0E0E0 dotted;
                padding: 8px 0px 8px 0px;
            }

            .SelectArea .Level0 {
                color: #333333;
                text-indent: 10px;
            }

            .SelectArea .Level1 li {
                color: #666666;
                text-indent: 25px;
            }

            .SelectArea .Level2 li {
                color: #999999;
                text-indent: 40px;
            }

            .SelectArea .Level3 li {
                text-indent: 55px;
            }
        </style>
    </head>

    <body>
        <div class="TopTitle">
            <a class="return" href="<?php echo U('User/index');?>"></a>
            <label class="Detailed" style="margin-right:60px;">余额转赠</label>
        </div>
        <div class="topTab">
            <div class="Tab" data-href="">积分转赠</div>
            <div class="Tab active" data-href="">余额转赠</div>
        </div>
        <div class="AddressAddInfo active">
            <div class="RowDiv">
                <div class="left">累计数量：</div>
                <div class="right"><span><?php echo ($user_info['fx_count']); ?></span></div>
            </div>
            <div class="RowDiv">
                <div class="left">现有数量：</div>
                <div class="right"><span id="nowmoney"><?php echo ($user_info['fx_money']); ?></span></div>
            </div>
            <div class="RowDiv">
                <div class="left">可用数量：</div>
                <div class="right"><span data-moneys="<?php echo ($user_info['fx_money']); ?>" id="myliveMoney"><?php echo ($user_info['fx_money']); ?></span></div>
            </div>

            <div class="RowDiv">
                <div class="left">获赠人ID：</div>
                <div class="right">
                    <input type="number" id="userId" placeholder="点击确认后会提示昵称">
                </div>
            </div>
            <div class="RowDiv">
                <div class="left">转赠数量：</div>
                <div class="right">
                    <input type="number" id="moneysAmount" placeholder="最多转赠数量：<?php echo ($user_info['fx_money']); ?>">
                </div>
            </div>
        </div>
        <button class="AddAddress" id="btnBegin">确认转赠</button>
        <script type="text/javascript">
            $('[data-href]').click(function() {
                var href = $(this).data('href');
                window.location.href = href;
            });

            $('#btnBegin').bind('click', function () {
                $("#btnBegin").attr('disabled', true)
                var type = $('#type').val();
                var liveMoney = $('#myliveMoney').data('moneys');
                var userId = $('#userId').val();
                var moneysAmount = $('#moneysAmount').val();
                if (moneysAmount % 100 != 0  || moneysAmount == 0) {
                    alert('转赠失败,转赠数量必需能整除100');
                    return false;
                }
                if (isNaN(userId) || isNaN(moneysAmount) || userId < 1 || moneysAmount <= 0) {
                    alert('获赠人ID或转赠数量填写错误!');
                    return;
                }
                if (userId == '<?php echo ($user_info['user_id']); ?>') {
                    alert('囧，自己不能赠送给自己。');
                    return;
                }
                if (parseFloat(liveMoney) < parseFloat(moneysAmount)) {
                    alert('转赠数量不能大于您的可用数量。');
                    $('#moneysAmount').focus();
                    return;
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
                                    data: {uid: userId, money: moneysAmount},
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