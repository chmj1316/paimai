<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <title>信息提示</title>
    </head>

    <body>
        <script type="text/javascript">
            (function() {
                alert('<?php echo $error;?>')
                location.href = '<?php echo($jumpUrl); ?>'
            })();
        </script>
    </body>

</html>