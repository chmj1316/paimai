<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
		<title>已完成</title>
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
		<section class="ywc_main auto">
			<div class="ywc_main_top">
				<ol>
					<span><?php echo ($info['status_text']); ?></span> 订单金额（含运费）：￥<?php echo ($info['price']); ?>
					<br /> 运费：￥0
				</ol>
				<ul>
					<span><em>收货人：<?php echo ($info['consign']['consign_name']); ?></em>13912341234</span> 收货地址：<?php echo ($info['consign']['province']); ?>-<?php echo ($info['consign']['city']); ?>-<?php echo ($info['consign']['area']); ?>-<?php echo ($info['consign']['address']); ?>
				</ul>
			</div>
			<div class="ywc_main_center">
				<ul>
				<?php if(is_array($info['order_info']['cart'])): $i = 0; $__LIST__ = $info['order_info']['cart'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="fix">
						<p><img src="<?php echo thumb($val['thumb'],136,136);?>" alt="<?php echo ($val['product_name']); ?>"></p>
						<span><a href="#" title=""><?php echo ($val['product_name']); ?></a></span>
						<em>
		                	￥ <?php echo ($val['xian_price']); ?><br />
		                    *<?php echo ($val['num']); ?>
		                </em>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<dl>
					订单编号：<?php echo ($info['order_id']); ?><br>
					成交时间：<?php echo date('Y-m-d H:i:s', $info['create_time']);?><br>
					备注信息：<?php echo ((isset($info['order_info']['content']) && ($info['order_info']['content'] !== ""))?($info['order_info']['content']):'无'); ?>
				</dl>
				<ol>
					快递公司：<?php echo ((isset($info['order_info']['duaidi']['gs']) && ($info['order_info']['duaidi']['gs'] !== ""))?($info['order_info']['duaidi']['gs']):'无'); ?>
					<br> 快递单号：<?php echo ((isset($info['order_info']['duaidi']['dh']) && ($info['order_info']['duaidi']['dh'] !== ""))?($info['order_info']['duaidi']['dh']):'无'); ?>
					<br> 商家留言：<?php echo ((isset($info['order_info']['duaidi']['ly']) && ($info['order_info']['duaidi']['ly'] !== ""))?($info['order_info']['duaidi']['ly']):'无'); ?>
					<br>
				</ol>
			</div>
			<div class="ywc_main_bottom">
				<a href="javascript:history.go(-1);" title="返回">返回</a>
				<?php switch($info['status']): case "1": ?><a href="<?php echo U('WxJsApi/index', array('order_id'=>$info['order_id']));?>" class="xz">立即付款</a><?php break;?>
					<?php case "2": ?><a href="javascript:alert('等待商家发货处理...');" class="xz">待发货</a><?php break;?>
					<?php case "3": ?><a id="sign" href="javascript:void(0);">确认签收</a>
						<script>
						$(function(){
							$("#sign").bind('click', function(){
								$.get('<?php echo U('Order/sign', array('order_id'=>$info['order_id']));?>', function(res){
									if (res.status) {
										alert(res.info)
										location.reload()
									} else {
										alert(res.info)
									}
								})
							})
						})
						</script><?php break;?>
					<?php case "4": ?><a href="<?php echo U('index');?>" class="xz">再购买</a><?php break;?>
					<?php default: ?>
					<a href="javascript:alert('已作废...');" class="xz">已作废</a><?php endswitch;?>
			</div>
		</section>
	</body>

</html>