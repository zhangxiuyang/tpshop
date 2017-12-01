<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"./template/mobile/new2/tc_buy\buy1.html";i:1512113674;s:41:"./template/mobile/new2/public\header.html";i:1503927242;s:45:"./template/mobile/new2/public\header_nav.html";i:1511227268;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>确认订单--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
<body class="g4">

<div class="classreturn loginsignup ">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="<?php echo U('mobile/Tc/index'); ?>"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>确认订单</span>
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
    .img_tc img{margin-top: 0.64rem}
    .img_tc,.img_tc img{width: 100%;}
    .infoText{font-size: .6rem;margin-top: .64rem;}
    .ord_list{background-color: aliceblue;}
</style>
<form name="buy1_form" id="buy1_form" method="post">
    <div class="edit_gtfix">
        <a href="<?php echo U('Mobile/User/address_list',array('source'=>'buy1','tc_id'=>$tcInfo[tc_id])); ?>">
            <div class="namephone fl">
                <div class="top">
                    <div class="le fl"><?php echo $address['consignee']; ?></div>
                    <div class="lr fl"><?php echo $address['mobile']; ?></div>
                </div>
                <div class="bot">
                    <i class="dwgp"></i>
                    <span><?php echo $address['address']; ?></span>
                </div>
                <input type="hidden" value="<?php echo $address['address_id']; ?>" name="address_id" /> <!--收货地址id-->
            </div>
            <div class="fr youjter">
                <i class="Mright"></i>
            </div>
            <div class="ttrebu">
                <img src="__STATIC__/images/tt.png"/>
            </div>
        </a>
    </div>

    <!--商品信息-s-->
        <div class="ord_list fill-orderlist p">
            <div class="maleri30">
                    <div class="shopprice">
                        <div class="img_tc"><img src="<?php echo $tcInfo[tc_image]; ?>"/></div>
                        <div class="infoText fl">
                            <?php echo $tcInfo[tc_name]; ?>
                        </div>
                        <div class="infoText fr">
                            <span class="red"><span>￥</span><span><?php echo $tcInfo[price]; ?></span></span>
                        </div>
                    </div>
            </div>
        </div>
    <!--商品信息-e-->

    <!--支持配送,发票信息-s-->
    <div class="information_dr">
        <div class="maleri30">
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a class="invoiceclickin" href="javascript:void(0)">
                            <div class="order">
                                <div class="fl">
                                    <span>发票信息</span>
                                </div>
                                <div class="fr">
                                    <span style="line-height: 1.2rem;">申请</span>
                                    <input class="txt1" style='display:none;' type="text" name="invoice_title" />
                                    <i class="Mright"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="invoice" class="invoice list7" style="display: none;">
                <div class="myorder p">
                    <div class="content30">
                        <div class="incorise">
                            <span>发票抬头：</span>
                            <input type="text" name="" id="" value="" placeholder="xx单位或xx个人" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--支持配送,发票信息-e-->


<!--卖家留言-s-->
    <div class="customer-messa">
        <div class="maleri30">
            <p>用户备注（50字）</p>
            <textarea class="tapassa" onkeyup="checkfilltextarea('.tapassa','50')" name="user_note" rows="" cols="" placeholder="选填"></textarea>
            <span class="xianzd"><em id="zero">50</em>/50</span>
        </div>
    </div>
<!--卖家留言-e-->


<!--提交订单-s-->
    <div class="mask-filter-div" style="display: none;"></div>
    <div class="payit fillpay ma-to-200">
        <div class="fr">
            <a href="javascript:void(0)" onclick="submit_order()">提交订单</a>
        </div>
        <div class="fl">
            <p><span class="pmo">应付金额：</span>￥<span id="payables"><?php echo $tcInfo[price]; ?></span><span></span></p>
        </div>
    </div>
<!--提交订单-e-->


</form>
<script type="text/javascript">
    // 提交订单
    ajax_return_status = 1; // 标识ajax 请求是否已经回来 可以进行下一次请求
    function submit_order() {
        if (ajax_return_status == 0)
            return false;
        ajax_return_status = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo U('Mobile/TcBuy/buy2'); ?>",//+tab,
            data: $('#buy1_form').serialize() + "&act=submit_order",// 你的formid
            dataType: "json",
            success: function (data) {
                if (data.status != '1') {
                    showErrorMsg(data.msg);  //执行有误
                    // 登录超时
                    if (data.status == -100)
                        location.href = "<?php echo U('Mobile/User/login'); ?>";
                    ajax_return_status = 1; // 上一次ajax 已经返回, 可以进行下一次 ajax请求
                    return false;
                }
                showErrorMsg('订单提交成功，跳转支付页面!');
                location.href = "/index.php?m=Mobile&c=TcBuy&a=buy3&order_id=" + data.result;
            }
        });
    }

    $(function(){
        //显示隐藏使用发票信息
        $('.invoiceclickin').click(function(){
            $('#invoice').toggle(300);
        })
    })
</script>
</body>
</html>
