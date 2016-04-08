<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C('WEB_SITE_TITLE');?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/css/tablestyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="/Public/Admin/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="/Public/Admin/js/js.js"></script>

</head>
<body>
<div class="container">
	<div class="head">
    	<div class="head1"><?php echo C('WEB_SITE_TITLE');?></div>
        <div class="head2">
			<a href="<?php echo (WEB_URL); ?>" target="_blank"><img src="/Public/Admin/images/ttb1.png" width="24" height="23" />网站首页</a>
        	<a href="<?php echo U('Index/deleteCache');?>" ><img src="/Public/Admin/images/ttb2.png" width="24" height="23" />更新缓存</a>
            <a href="<?php echo U('Config/index');?>"><img src="/Public/Admin/images/ttb2.png" width="24" height="23" />系统管理</a>
            <a href="<?php echo U('Index/help');?>"><img src="/Public/Admin/images/ttb3.png" width="24" height="23" />帮助中心</a>
            <a href="<?php echo U('Public/logout');?>"><img src="/Public/Admin/images/ttb4.png" width="24" height="23" />安全退出</a>
        </div>
    </div>
    <div class="main">
    	<div class="mleft">
        	<ul class="ul">
			<?php if(is_array($__MENU__)): $i = 0; $__LIST__ = $__MENU__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($val['name']);?>"><?php echo ($val['title']); ?></a>
				<?php if(!empty($val['child'])): ?><ul class="ul1">
						<?php if(is_array($val['child'])): $i = 0; $__LIST__ = $val['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li <?php if($__ACT__ == strtolower($v['name'])){echo 'class="xz"';}?>><a href="<?php echo U($v['name']);?>"><?php echo ($v['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="lt"></div>
                    </ul><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="mright">


        	<div class="mrtop">
            	<div class="breadCrumb">
                	您当前的位置： <a href="./admin.php">首页</a> &gt; <?php echo ($meta_head); ?> &gt; <?php echo ($meta_title); ?>
                </div>
                <div class="mrtr">
                	管理员：<?php echo get_username();?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="mrbot">
            	<div class="mrbot1">
                	<div class="mrbt1"><?php echo ($meta_title); ?></div>
                    <div class="mrnr1">
                    	<style media="screen">
    .ms select {
        padding:0px 10px;height:24px;border:solid 1px #d2d2d2;margin-right:10px; background:#fafafa
    }
    .select {width:400px;}
    .text1{height:100px;}
</style>

<style type="text/css">
/*.product-lists{width:100%; line-height:25px;}
.product-lists th{border:1px solid #aaa}
.product-lists td{text-align:center;border:1px solid #aaa}
.product-lists tr:hover{background-color:#FF9}*/
.product-lists{width:100%; background-color:#EFEFEF; line-height:25px;}
.product-lists th{background-color:#fff;}
.product-lists td{background-color:#fff; text-align:center;}
</style>
<form action="" method="post">
    <input type="hidden" name="order_id" value="<?php echo ($info['order_id']); ?>">
    <table width="900" border="0" cellspacing="0" cellpadding="0" class="table">
        <tr>
            <td class="upload-row">
                <table class="product-lists">
                    <tr>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>商品单价</th>
                        <th>商品数量</td>
                    </tr>
                    <?php if(is_array($info['order_info']['cart'])): $i = 0; $__LIST__ = $info['order_info']['cart'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                            <td><img src="<?php echo image($val['thumb']);?>" width="100" height="100" ></td>
                            <td><?php echo ($val['product_name']); ?></td>
                            <td><?php echo ($val['xian_price']); ?></td>
                            <td>*<?php echo ($val['num']); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td>总数量</td>
                        <td colspan="3">*<?php echo ($info['order_info']['count_num']); ?></td>
                    </tr>
                    <tr>
                        <td>总金额</td>
                        <td colspan="3">￥<?php echo ($info['order_info']['count_price']); ?></td>
                    </tr>
                    <tr>
                        <td>订单号</td>
                        <td colspan="3"><?php echo ($info['order_id']); ?></td>
                    </tr>
                    <tr>
                        <td>状态</td>
                        <td colspan="3"><?php echo ($info['status_text']); ?></td>
                    </tr>
                    <tr>
                        <td rowspan="2">收货信息</td>
                        <td colspan="3">
                            <?php echo ($info['consign']['consign_name']); ?>
                            <?php echo ($info['consign']['mobile']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?php echo ($info['consign']['province']); ?>
                            <?php echo ($info['consign']['city']); ?>
                            <?php echo ($info['consign']['area']); ?>
                            <?php echo ($info['consign']['address']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>备注</td>
                        <td colspan="3"><?php echo ((isset($info['order_info']['content']) && ($info['order_info']['content'] !== ""))?($info['order_info']['content']):'无'); ?></td>
                    </tr>

                    <tr>
                        <td>快递公司</td>
                        <td colspan="3"><input type="text" name="gs" value="<?php echo ((isset($info['order_info']['kuaidi']['gs']) && ($info['order_info']['kuaidi']['gs'] !== ""))?($info['order_info']['kuaidi']['gs']):''); ?>" class="inputt input" /></td>
                    </tr>
                    <tr>
                        <td>快递单号</td>
                        <td colspan="3"><input type="text" name="nu" value="<?php echo ((isset($info['order_info']['kuaidi']['nu']) && ($info['order_info']['kuaidi']['nu'] !== ""))?($info['order_info']['kuaidi']['nu']):''); ?>" class="inputt input" /></td>
                    </tr>
                    <tr>
                        <td>商家留言</td>
                        <td colspan="3"><textarea class="text1" name="ly"><?php echo ((isset($info['order_info']['kuaidi']['ly']) && ($info['order_info']['kuaidi']['ly'] !== ""))?($info['order_info']['kuaidi']['ly']):''); ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <?php switch($info['status']): case "1": ?><input type="button" class="tjanniu cr" value="等待付款" /><?php break;?>
                                <?php case "2": ?><input type="hidden" name="status" value="3">
                                    <input type="submit" class="tjanniu cr" value="发 货" />
                                    <input type="reset" class="czanniu cr" value="重 置" /><?php break;?>
                                <?php default: ?>
                                <input type="submit" class="tjanniu cr" value="修 改" />
                                <input type="reset" class="czanniu cr" value="重 置" /><?php endswitch;?>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</form>

                    </div>
                </div>
            </div>



            <div class="copyRight">北京金方时代科技有限公司&nbsp;&nbsp;&nbsp;版权所有 Inc All Rights Reserved&nbsp;&nbsp;&nbsp;联系电话：朝阳运营中心：010-51654311&nbsp;&nbsp;&nbsp;丰台运营中心：010-51654321&nbsp;&nbsp;&nbsp;海淀运营中心：010-51654300
			</div>
        </div>

        <div class="clear"></div>
    </div>
</div>
</body>
</html>