<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"./template/mobile/new2/tc\tcMonthInfo.html";i:1511332678;s:41:"./template/mobile/new2/public\header.html";i:1503927242;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>配送详情--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <link rel="stylesheet" href="__STATIC__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <!--<script src="__STATIC__/js/zepto-1.2.0-min.js" type="text/javascript" charset="utf-8"></script>-->
    <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__STATIC__/js/layer.js"  type="text/javascript" ></script>
    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body class="">

<!--详情-s-->
<div class="xq_details" style="">
    <div class="sg">
        <div class="spxq p">
            <?php echo htmlspecialchars_decode($res['content']); ?>
        </div>
    </div>
</div>
<!--详情-e-->


<a onclick="layer.closeAll();" style="display: block;width: 1.5rem;height:1.5rem;position: fixed; top: .5rem;right:0.4rem; background-color: rgba(243,241,241,0.5);border: 1px solid #CCC;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;" id="topup">
    <img src="__STATIC__/images/33.png" style="display: block;width: 1.45rem;height:1.45rem;">
</a>
<script type="text/javascript" src="__STATIC__/js/mobile-location.js"></script>

</body>
</html>
