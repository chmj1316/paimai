<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台登录</title>
<link type="text/css" rel="stylesheet" href="__ADMIN__css/login.css" />
<script  src="__ADMIN__js/jquery-1.9.1.min.js"></script>
<script  src="__ADMIN__js/myjs.js"></script>
</head>

<body>
<div class="layout">
<form class="" action="" method="post">
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="td_01">
                <img src="__ADMIN__images/login_01.jpg" width="47" height="47" />
                <input type="text" name="username" placeholder="管理员帐号" class="put_01" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <img src="__ADMIN__images/login_02.jpg" width="47" height="47" />
                <input type="password" name="password" placeholder="管理员密码" class="put_01" />
            </td>
        </tr>
        <tr>
            <td><img src="__ADMIN__images/login_03.jpg" width="47" height="47" /><input type="text" name="verify" placeholder="验证码" class="put_02" /></td>
            <td><img id="verify" src="{:U('verify')}" width="148" height="47" class="img" /></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="登  录" class="sub" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(function(){
        $("#verify").click(function(){
            $(this).attr("src", "{:U('verify')}");
        });
    })
</script>
</div>
</body>
</html>
