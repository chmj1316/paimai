<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <title><?php echo ($info['product_name']); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, user-scalable=no">
        <script type="text/javascript" src="/Public/Fenxiao/js/jquery-1.8.3.min.js"></script>
        <link href="/Public/Fenxiao/css/Css.css" rel="stylesheet">
        <link href="/Public/Fenxiao/css/Css(1).css" rel="stylesheet">
        <link href="/Public/Fenxiao/js/Css.aspx" rel="stylesheet">
        <link href="/Public/Fenxiao/css/idangerous.swiper.css" rel="stylesheet">
        <link href="/Public/Fenxiao/css/shopInfoOne.css" rel="stylesheet">
        <link href="/Public/Fenxiao/css/Product.css" rel="stylesheet">
    </head>

    <body>

        <form method="post" action="http://milaijia.tyr88.com/Mall/Html/100553/Product/ProductInfo.aspx?CustID=100553&amp;ID=251552&amp;Tag=html" id="form1">
            <div class="TopTitle">
                <a class="return" href="javascript:back()"></a>
                <label class="Detailed">商品详情</label>
                <script type="text/javascript">
                    LoadMenu();
                </script>
            </div>
            <!--图片滚动开始-->
            <div class="RollIMG2 Shadow1 PaddingHeight">
                <div class="swiper-container" style="cursor: -webkit-grab;">
                    <div class="swiper-wrapper" id="IMGContent"></div>
                </div>
                <div class="pagination"><span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span></div>
            </div>
            <textarea id="IMGValue" style="display: none">
                <?php if(is_array($info['images'])): $i = 0; $__LIST__ = $info['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class='swiper-slide' style="background-image:url('<?php echo image($val);?>')"></div><?php endforeach; endif; else: echo "" ;endif; ?>

                <div class='swiper-slide' style="background-image:url('http://milaijia.tyr88.com/Upload_S/U_IMG/img_100553/100553_20160322/zp20160322010047879277087.png')"></div>
            </textarea>
            <script src="/Public/Fenxiao/js/idangerous.swiper-2.0.min.js"></script>
            <!--图片滚动结束-->
            <div id="ShareInfoDiv" style="margin: 0px 8px 0px 8px; padding-top: 5px; background: #FFFFFF">
                <div class="ShareInfo" id="ShareInfo">
                    <div class="ShareInfo">
                        <div class="IMG" style="width:50%;margin:12px 10px 15px 0px;padding-left:20px;color: #FFFFFF;" onclick="LoginUrl()">请点击登录</div><a id="UserA" href="http://milaijia.tyr88.com/Mall/Shop/Login.aspx"><span id="UserText">会员登录</span></a></div>
                </div>
                <script type="text/javascript">
                    ShareInfo();
                </script>
            </div>
            <div class="ProductInfo">
                <div class="ProductTitle"><?php echo ($info['product_name']); ?></div>
                <?php switch($info['product_type']): case "1": ?><div class="ProductPrice">
                            <label for="PriceType0">现价：<span>¥<?php echo ($info['xian_price']); ?></span><font class="font">原价：¥<?php echo ($info['yuan_price']); ?></font></label>
                            <a href="javascript:MallFavoritesAdd()" id="collect" class="collect0">
                                <span style="font-size: 1.2rem; color: #333333">收藏</span>
                            </a>
                        </div><?php break;?>
                    <?php case "2": ?><div class="ProductPrice">
                            <label for="PriceType0">积分：<span><?php echo ($info['jifen_price']); ?></span></label>
                            <a href="javascript:MallFavoritesAdd()" id="collect" class="collect0">
                                <span style="font-size: 1.2rem; color: #333333">收藏</span>
                            </a>
                        </div><?php break; endswitch;?>
                <div class="Split10"></div>
                <div class="SetCount">
                    <dd onclick="AddCount2('Count',-1)">-</dd>
                    <span id="Count">1</span>
                    <label onclick="AddCount2('Count',1)">+</label>
                </div>
                <div class="ProductPrice">
                    <label for="PriceType0">卖家包邮</label>
                </div>
                <div id="ProductTitle" class="ProductTitle">
                    <a href="<?php echo U('Index/tuiguang');?>">
                        <span style="font-weight: 700; color: Red; font-size: 14px; line-height: 14px;">我要推荐</span>
                    </a>
                </div>
                <div class="Split20"></div>
                <div class="ToBuyBorder"></div>

                <div id="ToBuyDiv" class="ToBuy" style="display: ">
                    <div id="ToBuyC"><a id="AddCartBt" class="L" href="javascript:Cart_INSERT([{ProductID:251552,CountObj:&quot;Count&quot;,BuyType:GetBuyType()}])">放入购物车</a><a class="R" href="javascript:Cart_INSERT([{ProductID:251552,CountObj:&quot;Count&quot;,Type:1,BuyType:GetBuyType()}])">立即购买</a></div>

                </div>

            </div>
            <div class="wwrry">
                <!-- 分享抢购 -->
            </div>
            <div id="PInfo" class="PInfo">
                <div class="ProductDetailed" id="ProductDetailed">
                    <ul>
                        <li class="current" style="width:100%;">商品介绍<span></span></li>
                    </ul>
                </div>
                <style media="screen">
                    .Content {
                        overflow: hidden;
                    }
                    .Content img {
                        width: 100%;
                    }
                </style>
                <div class="Content"><?php echo ($info['content']); ?></div>
            </div>
            <div class="circle"></div>
            <div class="Split10"></div>
            <div class="Split10"></div>
            <div class="Footer">Copyright © 2016，All Rights Reserved
                <br />
                <span id="DlsSet" onclick="javascript:" style="margin-left:10px;" class="DlsSet">
                    <a href="http://www.bjjfsd.com/" style="margin-right:0px"><span style="font-size:1.2rem;color:#333333">技术支持</span></a>
                </span>
                <span onclick="javascript:location.href=location.href" style="margin-left:10px;">刷新</span>
            </div>
            <div id="Car" class="Car" onclick="javascript:location.href=&#39;/Mall/Shop/ShopCart.aspx&#39;"></div>
            <script type="text/javascript">
                TabClick();
            </script>
            <div id="Split55" class="Split55" style="display: none"></div>

            <div id="FixedBuy" class="FixedBuy" style="display: none">
                <div id="BottonDiv"><a class="L" href="javascript:Cart_INSERT([{ProductID:251552,CountObj:&quot;Count&quot;,BuyType:GetBuyType()}])">放入购物车</a><a class="R" href="javascript:Cart_INSERT([{ProductID:251552,CountObj:&quot;Count&quot;,Type:1,BuyType:GetBuyType()}])">立即购买</a></div>
            </div>
        </form>
        <script type="text/javascript">
            document.write("<script type=\"text/javascript\" src=\"/Mall/Shop/JS/Html/Product_End.js?t=" + new Date().getSeconds() + "\"><\/script>") //清除缓存
        </script>
        <script type="text/javascript" src="/Public/Fenxiao/js/Product_End.js"></script>
        <div id="floatTools" class="rides-cs" style="display:none"></div>
        <div id="AttentionBottom" class="outBox" style="display:none"></div>
        <script type="text/javascript" src="/Public/Fenxiao/js/AttentionMsg.js"></script>
        <script type="text/javascript" src="/Public/Fenxiao/js/QQ.js"></script>
        <link href="/Public/Fenxiao/css/kefu.css" rel="stylesheet">



    </body>

</html>