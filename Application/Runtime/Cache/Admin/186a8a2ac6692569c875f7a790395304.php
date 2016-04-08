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

<form action="" method="post">
<table width="900" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
        <td class="td1" align="right">广告位：</td>
        <td class="ms">
            <select class="select" name="bid">
                <option value="<?php echo ($banner_info['id']); ?>"><?php echo ($banner_info['name']); ?></option>
            </select>
            （广告位）
        </td>
    </tr>
    <tr>
        <td class="td1" align="right">标题：</td>
        <td class="ms">
            <input type="text" name="title" value="<?php echo ((isset($info['title']) && ($info['title'] !== ""))?($info['title']):''); ?>" class="inputt input" />
            （标题）
        </td>
    </tr>
    <?php if(($banner_info['allow_image']) == "1"): ?><tr>
        <td align="right">图片：</td>
        <td class="upload-row">
            <input type="text" name="image" value="<?php echo ((isset($info['image']) && ($info['image'] !== ""))?($info['image']):''); ?>" readonly="readonly" class="inputt input3">
            <input type="button" class="button1 cr" value="上 传">建议图片尺寸：<?php echo ($banner_info['width']); ?>*<?php echo ($banner_info['height']); ?>px;
        </td>
    </tr><?php endif; ?>
    <?php if(($banner_info['id']) == "2"): ?><tr>
        <td align="right">视频上传：</td>
        <td class="upload-video">
            <input type="text" name="video" value="<?php echo ((isset($info['video']) && ($info['video'] !== ""))?($info['video']):''); ?>" class="inputt input3">
            <input type="button" class="button1 cr" value="上 传">上传MP4格式视频;
        </td>
    </tr><?php endif; ?>
    <?php if(($banner_info['allow_url']) == "1"): ?><tr>
        <td class="td1" align="right">超链接：</td>
        <td class="ms">
            <input type="text" name="url" value="<?php echo ((isset($info['url']) && ($info['url'] !== ""))?($info['url']):''); ?>" class="inputt input" />
            （超链接 ）
        </td>
    </tr><?php endif; ?>
    <?php if(($banner_info['allow_desc']) == "1"): ?><tr>
        <td class="td1" align="right">描述：</td>
        <td class="ms">
            <textarea class="text1" name="description"><?php echo ((isset($info['description']) && ($info['description'] !== ""))?($info['description']):''); ?></textarea>
            （描述）
        </td>
    </tr><?php endif; ?>
    <tr>
        <td class="td1" align="right">排序：</td>
        <td class="ms">
            <input type="text" name="sort" value="<?php echo ((isset($info['sort']) && ($info['sort'] !== ""))?($info['sort']):0); ?>" class="inputt input" />
            （排序sort desc, id desc）
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
             <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
             <input type="submit" class="tjanniu cr" value="提 交" /><input type="reset" class="czanniu cr" value="重 置" />
        </td>
    </tr>
</table>
</form>

<!-- 图片上传 -->
<script type="text/javascript">
    var Tool = {};
    $(function(){
        // 上传处理
        Tool.uploadSend = function(){
            $(".upload-row").each(function(i){
                $(this).find(".button1").click(function(){
                    window.open('<?php echo U('Tool/uploadImage', '', '');?>&id='+ i, '文件上传', 'height=100, width=400, top='+(screen.availHeight-100)/2+', left='+(screen.availWidth-400)/2+', toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no');
                })
            });
            $(".upload-video").each(function(i){
                $(this).find(".button1").click(function(){
                    window.open('<?php echo U('Tool/uploadVideo', '', '');?>&id='+ i, '视频上传', 'height=100, width=400, top='+(screen.availHeight-100)/2+', left='+(screen.availWidth-400)/2+', toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no');
                })
            })
        }
        // 绑定
        Tool.uploadSend();
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