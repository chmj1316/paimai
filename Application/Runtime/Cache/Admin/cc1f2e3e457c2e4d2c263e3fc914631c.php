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
	<a href="<?php echo U('add');?>" class="tja">添加商品</a>
	<div class="hdtright">
		<form action="" method="get">
		<span>名  称：</span><input type="text" name="title" value="<?php echo ((isset($search['title']) && ($search['title'] !== ""))?($search['title']):''); ?>" class="inputt input1" />
		<span>商品类型：</span>
		<select name="type" class="easyui-combobox" style="width:130px;height:25px">
			<option value="">全部</option>
			<?php $_result=C('FX_PRODUCT_TYPE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($key) == $search['product_type']): ?>selected="selected"<?php endif; ?>><?php echo ($val); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<span>商品分类：</span>
		<select name="cate" class="easyui-combobox" style="width:130px;height:25px">
			<option value="">全部</option>
			<?php $_result=C('FX_PRODUCT_CATE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($key) == $search['product_cate']): ?>selected="selected"<?php endif; ?>><?php echo ($val); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
		<td align="center"><input type="checkbox" class="allcheck">ID</td>
		<td align="center">商品名称</td>
		<td align="center">商品类型</td>
		<td align="center">商品分类</td>
		<td align="center">商品图片</td>
		<td align="center">商品价格</td>
		<td align="center">更新时间</td>
		<td align="center">推荐位</td>
		<td align="center">排序</td>
		<td align="center">操作</td>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
			<td align="center"><input type="checkbox" name="product_id" value="<?php echo ($v['product_id']); ?>"><?php echo ($v['product_id']); ?></td>
			<td align="center"><?php echo ($v['product_name']); ?></td>
			<td align="center"><?php echo get_fx_product_type($v['product_type']);?></td>
			<td align="center"><?php echo get_fx_product_cate($v['product_cate']);?></td>
			<td align="center"><img src="<?php echo image($v['thumb']);?>" width="50" height="50"/></td>
			<?php switch($v['product_type']): case "1": ?><td align="center"><?php echo ($v['xian_price']); ?></td><?php break;?>
				<?php case "2": ?><td align="center"><?php echo ($v['jifen_price']); ?></td><?php break; endswitch;?>
			<td align="center"><?php echo date('Y-m-d H:i:s', $v['update_time']);?></td>
			<td align="center">
				<?php if(is_array($positions)): $i = 0; $__LIST__ = $positions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if($v[$key]): ?><a href="<?php echo U('position',array('product_id'=>$v['product_id'],'position'=>$key,'status'=>0));?>" class="xga"><?php echo ($val); ?></a>
					<?php else: ?>
					<a href="<?php echo U('position',array('product_id'=>$v['product_id'],'position'=>$key,'status'=>1));?>" class="xga2"><?php echo ($val); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</td>
			<td align="center"><input style="width:20px;text-align:center;" onchange="Tool.sort(<?php echo ($v['product_id']); ?>,this.value)" type="text" name="sort" value="<?php echo ($v['sort']); ?>"></td>
			<td align="center">
				<a href="<?php echo U('edit?product_id='. $v['product_id']);?>" class="xga">修改</a>
				<a href="javascript:if(confirm('确认要执行该操作吗?')){location.href='<?php echo U('del?product_id='. $v['product_id']);?>'}" class="xga">删除</a>
			</td>


		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<style media="screen">
	.position {
		margin-top: 12px;
		height: 25px;
		background-color: #FF9A1A;
		border: 1px solid #E5EB1B;
		color: #FFF;
	}
</style>
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

Tool.sort = function(product_id, sort){
	$.ajax({
		url: '<?php echo U('sort');?>',
		type: 'post',
		data: {product_id: product_id, sort: sort},
		dataType: 'json',
		success: function(data){
			if (data.status) {
				// alert(data.info);
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
$(function(){
	$("#del").click(function(){
		var xx = confirm('是否确认操作！');
		if(xx){
			var ids = [];
			$("[name=product_id]:checkbox:checked").each(function(){
				ids.push($(this).val());
			});
			if (ids.length == 0) {
				alert('请选择操作对象');
				return false;
			}
			$.ajax({
				url: '<?php echo U('del');?>',
				type: 'post',
				data: {product_id: ids},
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
	$(".position").change(function(){
		var ids = [];
		$("[name=product_id]:checkbox:checked").each(function(){
			ids.push($(this).val());
		});
		if (ids.length == 0) {
			alert('请选择操作对象');
			return false;
		}
		$.ajax({
			url: '<?php echo U('position');?>',
			type: 'post',
			data: {pid: $(this).val(), product_id: ids},
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