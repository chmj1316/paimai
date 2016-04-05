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
                    	<div style="min-height:500px;">
    <style media="screen">
        .table {line-height: 30px; font-size: 16px; margin: 20px; border:none;}
        .table th {font-weight: bold;  border-bottom: 1px solid #eee;}
        .table td {padding-left:30px; border-bottom: 1px solid #eee;}
    </style>
    <table class="table">
        <tr>
            <th>服务器操作系统</th>
            <td><?php echo (PHP_OS); ?></td>
        </tr>
        <tr>
            <th>ThinkPHP版本</th>
            <td><?php echo (THINK_VERSION); ?></td>
        </tr>
        <tr>
            <th>CMS版本</th>
            <?php if($new_version['status']): ?><td><?php echo (CMS_VERSION); ?> <a style="font-size:18px; color:#F00;font-weight:bold;" href="javascript:alert('请到金方时代官方网站下载...');">有新版本<?php echo ($new_version['version']); ?></a></td>
            <?php else: ?>
            <td><?php echo (CMS_VERSION); ?></td><?php endif; ?>
        </tr>
        <tr>
            <th>运行环境</th>
            <td><?php echo ($_SERVER['SERVER_SOFTWARE']); ?></td>
        </tr>
        <tr>
            <th>MYSQL版本</th>
            <?php $system_info_mysql = M()->query("select version() as v;"); ?>
            <td><?php echo ($system_info_mysql["0"]["v"]); ?></td>
        </tr>
        <tr>
            <th>上传限制</th>
            <td><?php echo ini_get('upload_max_filesize');?></td>
        </tr>
        <tr>
            <th>定时任务</th>
            <td>
                <?php
 if(file_exists(WEB_ROOT .'/cron-run')){ echo '运行中<button id="end">关闭</button>'; } else { echo '关闭中<button id="start">开启</button>'; } ?>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $("#start").click(function(){
        $.get('<?php echo U('Home/Cron/start');?>',function(){
            location.reload()
        });
    })
    $("#end").click(function(){
        $.get('<?php echo U('Home/Cron/end');?>',function(){
            location.reload()
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