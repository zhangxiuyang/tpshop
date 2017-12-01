<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:45:"./template/mobile/new2/user\address_list.html";i:1512111494;s:41:"./template/mobile/new2/public\header.html";i:1503927242;s:45:"./template/mobile/new2/public\header_nav.html";i:1511227268;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>收货地址管理--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
<body class="pore_add">

<div class="classreturn loginsignup ">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>收货地址管理</span>
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
    <!--地址-s-->
    <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <div class="jd_listaddless p">
            <div class="maleri30">
                <?php if(\think\Request::instance()->param('source') == 'cart2'): ?>
                <!--从确认订单页进来-->
               <a href="<?php echo U('/Mobile/Cart/cart2',array('address_id'=>$list['address_id'])); ?>">
                    <div class="name fl">
                        <h1><?php echo $list[consignee]; ?></h1>
                        <?php if($list[is_default] == 1): ?>
                            <span>默认</span>
                        <?php endif; ?>
                    </div>
                    <div class="numberaddress fl">
                        <span class="number">电话：<?php echo $list[mobile]; ?></span>
                        <span class="similars"><?php echo $region_list[$list['province']]; ?>,<?php echo $region_list[$list['city']]; ?>,<?php echo $region_list[$list['district']]; ?>,<?php echo $region_list[$list['twon']]; ?><?php echo $list['address']; ?></span>
                    </div>
                </a>
                <!--从确认订单页进来-->
                <?php elseif(\think\Request::instance()->param('source') == 'pre_sell_cart'): ?>
                <!--从确认订单页进来-->
                <a href="<?php echo U('/Mobile/Cart/pre_sell_cart',array('address_id'=>$list['address_id'],'act_id'=>\think\Request::instance()->param('act_id'),'goods_num'=>\think\Request::instance()->param('goods_num'))); ?>">
                    <div class="name fl">
                        <h1><?php echo $list[consignee]; ?></h1>
                        <?php if($list[is_default] == 1): ?>
                            <span>默认</span>
                        <?php endif; ?>
                    </div>
                    <div class="numberaddress fl">
                        <span class="number">电话：<?php echo $list[mobile]; ?></span>
                        <span class="similars"><?php echo $region_list[$list['province']]; ?>,<?php echo $region_list[$list['city']]; ?>,<?php echo $region_list[$list['district']]; ?>,<?php echo $region_list[$list['twon']]; ?><?php echo $list['address']; ?></span>
                    </div>
                </a>
                <?php elseif(\think\Request::instance()->param('source') == 'buy1'): ?>
                    <!--从套餐购买进来-->
                    <a href="<?php echo U('/Mobile/TcBuy/buy1',array('address_id'=>$list['address_id'],'tc_id'=>\think\Request::instance()->param('tc_id'))); ?>">
                        <div class="name fl">
                            <h1><?php echo $list[consignee]; ?></h1>
                            <?php if($list[is_default] == 1): ?>
                                <span>默认</span>
                            <?php endif; ?>
                        </div>
                        <div class="numberaddress fl">
                            <span class="number">电话：<?php echo $list[mobile]; ?></span>
                            <span class="similars"><?php echo $region_list[$list['province']]; ?>,<?php echo $region_list[$list['city']]; ?>,<?php echo $region_list[$list['district']]; ?>,<?php echo $region_list[$list['twon']]; ?><?php echo $list['address']; ?></span>
                        </div>
                    </a>
                 <!--从确认订单页进来-->
                 <?php else: ?>
                    <div class="name fl">
                        <h1><?php echo $list[consignee]; ?></h1>
                        <?php if($list[is_default] == 1): ?>
                            <span>默认</span>
                        <?php endif; ?>
                    </div>
                    <div class="numberaddress fl">
                        <span class="number">电话：<?php echo $list[mobile]; ?></span>
                        <span class="similars"><?php echo $region_list[$list['province']]; ?>,<?php echo $region_list[$list['city']]; ?>,<?php echo $region_list[$list['district']]; ?>,<?php echo $region_list[$list['twon']]; ?><?php echo $list['address']; ?></span>
                    </div>
                <?php endif; ?>
                <div class="editdiv fl">
                    <a href="<?php echo U('/Mobile/User/edit_address',array('id'=>$list[address_id],'source'=>\think\Request::instance()->param('source'),'tc_id'=>\think\Request::instance()->param('tc_id'))); ?>">
                        <i class="eedit"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
<!--地址-e-->
    <div class="hek">
        <div class="createnew">
            <?php if(\think\Request::instance()->param('source') == 'buy1'): ?>
                <a href="<?php echo U('/Mobile/User/add_address',array('source'=>\think\Request::instance()->param('source'),'tc_id'=>\think\Request::instance()->param('tc_id'))); ?>">+新建地址</a>
            <?php else: ?>
                <a href="<?php echo U('/Mobile/User/add_address',array('source'=>\think\Request::instance()->param('source'))); ?>">+新建地址</a>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>
