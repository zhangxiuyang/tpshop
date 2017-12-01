<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./template/mobile/new2/user\message_notice.html";i:1503927244;s:41:"./template/mobile/new2/public\header.html";i:1503927242;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>消息中心--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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

<div class="classreturn loginsignup">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>消息中心</span>
        </div>
        <div class="ds-in-bl menu newsset" style="display: none">
            <a href="<?php echo U('Mobile/User/set_notice'); ?>"><img src="__STATIC__/images/newsset.png" alt="菜单"></a>
        </div>
    </div>
</div>
<nav class="storenav grst p">
    <ul>
        <li class="red"  onclick="ajax_message_notice(0)">
            <a href="javascript:">
                <span >全部消息</span>
            </a>
        </li>
        <li onclick="ajax_message_notice(1)">
            <a href="javascript:">
                <span >系统消息</span>
            </a>
        </li>
        <li onclick="ajax_message_notice(2)">
            <a href="javascript:" >
                <span>活动通知</span>
            </a>
        </li>
    </ul>
</nav>
<div class="news_center">
    <!--<div class="news_list_fll">-->
        <!--<div class="maleri30">-->
            <!--<div class="fl news_c_img">-->
                <!--<img src="__STATIC__/images/news1.png"/>-->
                <!--&lt;!&ndash;<i class="tip_n">3</i>&ndash;&gt;-->
            <!--</div>-->
            <!--<div class="fl  news_c_tit">-->
                <!--<p><span class="news_h fl">商城咚咚</span><span class="yestertime fr"></span></p>-->
                <!--<p>点击查看你与客服的沟通记录</p>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="news_list_fll">-->
        <!--<div class="maleri30">-->
            <!--<div class="fl news_c_img">-->
                <!--<img src="__STATIC__/images/news2.png"/>-->
                <!--<i class="tip_n">3</i>-->
            <!--</div>-->
            <!--<div class="fl  news_c_tit">-->
                <!--<p><span class="news_h fl">商城咚咚</span><span class="yestertime fr">昨天</span></p>-->
                <!--<p>点击查看你与客服的沟通记录</p>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(function(){
        ajax_message_notice(0);
        $('.storenav li').click(function () {
            $(this).addClass('red').siblings('li').removeClass('red');
        });
    })
    function ajax_message_notice(type){
        $.ajax({
            type:"POST",
            url:"<?php echo U('Mobile/User/ajax_message_notice'); ?>",
            data: {type: type},
            success:function(data){
                if($.trim(data)==''){
                    $('.news_center').html('');
                }else{
                    $('.news_center').html(data);
                }
            }
        })
    }
</script>
</body>
</html>
