<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:36:"./template/mobile/new2/tc\index.html";i:1511242767;s:41:"./template/mobile/new2/public\header.html";i:1503927242;s:45:"./template/mobile/new2/public\header_nav.html";i:1511227268;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>套餐列表--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
<body class="[body]">

<div class="classreturn loginsignup ">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>套餐列表</span>
        </div>
       <!-- <div class="ds-in-bl menu">
            <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a>
        </div>-->
    </div>
</div>
<div class="flool tpnavf">
    <div class="footer">
        <ul>
            <li>
                <a class="yello" href="<?php echo U('Index/index'); ?>">
                    <div class="icon">
                        <i class="icon-shouye iconfont"></i>
                        <p>首页</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Goods/categoryList'); ?>">
                    <div class="icon">
                        <i class="icon-fenlei iconfont"></i>
                        <p>分类</p>
                    </div>
                </a>
            </li>
            <li>
                <!--<a href="shopcar.html">-->
                <a href="<?php echo U('Cart/index'); ?>">
                    <div class="icon">
                        <i class="icon-gouwuche iconfont"></i>
                        <p>购物车</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('User/index'); ?>">
                    <div class="icon">
                        <i class="icon-wode iconfont"></i>
                        <p>我的</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    #goods_list{    /*background: url(http://img4.imgtn.bdimg.com/it/u=1931659373,3162792411&fm=27&gp=0.jpg) repeat;*/}
    .cbaudience{height: 360px; background-color: #1e695e; text-align: center;  line-height: 360px;}
    .cbaudience p{font-size: .8rem; color: #ffffff;letter-spacing: .2rem; text-align: left;line-height: 260px; padding-left: 140px;font-family:"楷体";}
</style>
    <!--套餐列表-s-->
        <div id="goods_list">
            <?php if(is_array($tc_list) || $tc_list instanceof \think\Collection || $tc_list instanceof \think\Paginator): if( count($tc_list)==0 ) : echo "" ;else: foreach($tc_list as $key=>$list): ?>
                <a href="<?php echo U('Tc/tcInfo',array('id'=>$list[tc_id])); ?>">
                    <div class="cbaudience">
                            <p><?php echo $list[tc_name]; ?></p>
                    </div>
                </a>
                <br>
                <br>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    <!--套餐列表-e-->
</body>
<script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
<script>
    /**
     * 加载更多商品
     **/
    var  page = 1;
    function ajax_sourch_submit()
    {
        ++page;
       /* $.ajax({
            type : "GET",
            url:"/index.php?m=Mobile&c=Activity&a=promote_goods&is_ajax=1&p="+page,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
            success: function(data) {
                if ($.trim(data) == '') {
                    $('#getmore').hide();
                } else {
                    $("#goods_list").append(data);
                }
            }
        });*/
    }
    //滚动加载更多
    $(window).scroll(
        function() {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            if (scrollTop + windowHeight == scrollHeight) {
               // ajax_sourch_submit();//调用加载更多
            }
        }
    );
</script>
</html>
