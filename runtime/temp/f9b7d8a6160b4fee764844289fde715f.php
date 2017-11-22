<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"./template/mobile/new2/tc\error.html";i:1511327798;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>错误提示--定制龙江 | DZLJ</title>
    <script src="/public/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="/public/js/layer/layer.js"></script>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1">
</head>
<body >

</body>
<script>
    /**
     * 加载提示
     **/

    layer.msg('<?php echo $msg; ?>');

    setTimeout('history.go(-1);',3500);
</script>
</html>
