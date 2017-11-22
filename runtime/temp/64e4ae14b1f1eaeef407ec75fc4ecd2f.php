<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"./template/mobile/new2/activity\discount_list.html";i:1503927242;s:41:"./template/mobile/new2/public\header.html";i:1503927242;s:45:"./template/mobile/new2/public\header_nav.html";i:1511227268;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>活动商品列表--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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

<div class="classreturn loginsignup ">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>活动商品列表</span>
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
    <!--商品详情s-->
    <div id="goods_list">
        <?php if(empty($prom_list) || (($prom_list instanceof \think\Collection || $prom_list instanceof \think\Paginator ) && $prom_list->isEmpty())): ?>
            <p class="goods_title" id="goods_title" style="line-height: 100px;text-align: center;margin-top: 30px;">抱歉暂时没有相关结果！</p>
        <?php else: if(is_array($prom_list) || $prom_list instanceof \think\Collection || $prom_list instanceof \think\Paginator): if( count($prom_list)==0 ) : echo "" ;else: foreach($prom_list as $key=>$good): ?>
            <div class="orderlistshpop p">
                <div class="maleri30">
                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$good[goods_id])); ?>" class="item">
                        <div class="sc_list se_sclist">
                            <div class="shopimg fl">
                                <img src="<?php echo goods_thum_images($good['goods_id'],400,400); ?>">
                            </div>
                            <div class="deleshow fr">
                                <div class="deletes">
                                    <span class="similar-product-text fl"><?php echo getSubstr($good['goods_name'],0,20); ?></span>
                                </div>
                                <div class="prices">
                                    <p class="sc_pri fl"><span>￥</span><span><?php echo $good[shop_price]; ?>元</span></p>
                                </div>
                                <p class="weight"><span><?php echo $good[comment_count]; ?></span><span>条评价</span></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
    <!--商品详情e-->

<script type="text/javascript">
    /**
     * ajax加载更多商品
     */
	 var  page = 1;
    function ajax_sourch_submit()
    {
        ++page;
        $.ajax({
            type : "GET",
            url:"/index.php?m=Mobile&c=Activity&a=discount_list&is_ajax=1&id="+<?php echo I('id'); ?>+"&p="+page,
            success: function(data){
                 if ($.trim(data) == '') {
                    $('#getmore').hide();
					return false;
                } else {
                    $("#goods_list").append(data);
                }
            }
        });
    }
</script>
	</body>
</html>
