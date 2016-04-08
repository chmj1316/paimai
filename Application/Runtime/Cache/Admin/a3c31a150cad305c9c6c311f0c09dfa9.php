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
                    	<div class="hdtop">
	<a href="javascript:void(0);" class="tja">订单列表</a>
	<div class="hdtright">
		<form action="" method="get">
		<span>订单ID：</span><input type="text" name="order_id" value="<?php echo ((isset($search['order_id']) && ($search['order_id'] !== ""))?($search['order_id']):''); ?>" class="inputt input1" />
		<span>等级：</span>
		<select name="status" class="easyui-combobox" style="width:130px;height:25px">
			<option value="">全部</option>
			<?php $_result=C('FX_ORDER_STATUS');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($key) == $search['status']): ?>selected="selected"<?php endif; ?>><?php echo ($val); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<input type="hidden" name="m" value="Admin" />
		<input type="hidden" name="c" value="<?php echo ($class_name); ?>" />
		<input type="hidden" name="a" value="index" />
		<input type="submit" value="查 询" class="button" />
		</form>
	</div>
	<div class="clear"></div>
</div>

<div class="hdbot">
<style media="screen">
	.head910 td {
		background-color:#08a3bb;
		line-height: 33px;
		color: #fff;
		font-size: 14px;
	}
</style>
<table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab">
	<tr class="head910">
		<td align="center"><input type="checkbox" class="allcheck">订单ID</td>
		<td align="center">购买用户</td>
		<td align="center">价格</td>
		<td align="center">更新时间</td>
		<td align="center">状态</td>
		<td align="center">操作</td>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
			<td align="center"><input type="checkbox" name="user_id" value="<?php echo ($v['order_id']); ?>"><?php echo ($v['order_id']); ?></td>
			<td align="center"><?php echo ($v['user_id']); ?></td>
			<td align="center"><?php echo ($v['price']); ?></td>
			<td align="center"><?php echo date('Y-m-d H:i:s', $v['update_time']);?></td>
			<td align="center"><?php echo ($v['status_text']); ?></td>
			<td align="center">
				<a href="<?php echo U('edit',array('order_id'=>$v['order_id']));?>" class="xga">修改</a>|
				<a href="javascript:if(confirm('确认要执行该操作吗?')){location.href='<?php echo U('del?order_id='. $v['order_id']);?>'}" class="xga">删除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

<div class="tableb">
	<input type="checkbox" class="allcheck">
	<input type="button" id="del" value="删除" class="scanniu cr">
	<div class="tablebnr page">
		<?php echo ($_page); ?>
	</div>
</div>
</div>
<script type="text/javascript">
var Tool = {};
$(function(){
	$("#del").click(function(){
		var xx = confirm('是否确认操作！');
		if(xx){
			var ids = [];
			$("[name=order_id]:checkbox:checked").each(function(){
				ids.push($(this).val());
			});
			if (ids.length == 0) {
				alert('请选择操作对象');
				return false;
			}
			$.ajax({
				url: '<?php echo U('del');?>',
				type: 'post',
				data: {order_id: ids},
				dataType: 'json',
				success: function(data){
					if (data.status) {
						alert(data.info);
						location.reload();
					} else {
						alert(data.info);
					}
				},
				error: function(){
					alert('网络异常...');
				}
			});
		}
	});

})
</script>

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