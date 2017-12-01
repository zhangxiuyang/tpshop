<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:38:"./template/mobile/new2/cart\cart2.html";i:1512105197;s:41:"./template/mobile/new2/public\header.html";i:1503927242;s:45:"./template/mobile/new2/public\header_nav.html";i:1511227268;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>填写订单--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
            <a href="<?php echo U('mobile/Cart/index'); ?>"><img src="__STATIC__/images/return.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>填写订单</span>
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
<form name="cart2_form" id="cart2_form" method="post">
    <div class="edit_gtfix">
        <a href="<?php echo U('Mobile/User/address_list',array('source'=>'cart2')); ?>">
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
                <?php if(is_array($cartList) || $cartList instanceof \think\Collection || $cartList instanceof \think\Paginator): $i = 0; $__LIST__ = $cartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?>
                    <div class="shopprice">
                        <div class="img_or fl"><img src="<?php echo goods_thum_images($cart[goods_id],100,100); ?>"/></div>
                        <div class="fon_or fl">
                            <h2 class="similar-product-text"><?php echo $cart[goods_name]; ?></h2>
                            <div><?php echo $cart[spec_key_name]; ?></div>
                        </div>
                        <div class="price_or fr">
                            <p class="red"><span>￥</span><span><?php echo $cart[goods_fee]; ?></span></p>
                            <p class="ligfill">x<?php echo $cart[goods_num]; ?></p>
                        </div>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    <!--商品信息-e-->

    <!--支持配送,发票信息-s-->
    <div class="information_dr">
        <div class="maleri30">
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a class="takeoutps" href="javascript:void(0)">
                            <div class="order">
                                <div class="fl">
                                    <span>支持配送</span>
                                </div>
                                <div class="fr">
                                    <span id="postname" style="line-height: 1.2rem;">不选择，则按默认配送方式</span>
                                    <i class="Mright"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a class="invoiceclickin" href="javascript:void(0)">
                            <div class="order">
                                <div class="fl">
                                    <span>发票信息</span>
                                </div>
                                <div class="fr">
                                    <span>纸质发票-个人<br>非图书商品-不开发票</span>
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
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a class="remain" href="javascript:void(0);">
                            <div class="order">
                                <div class="fl">
                                    <span>使用余额/积分</span>
                                </div>
                                <div class="fr">
                                    <!--<i class="Mright"></i>-->
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <!--使用余额、积分-s-->
            <div id="balance-li" class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <label>
                            <div class="incorise">
                                <span>使用余额：</span>
                                <input id="user_money" name="user_money"  type="text"   placeholder="可用余额为:<?php echo $user['user_money']; ?>" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" />
                                <input name="validate_bonus" type="button" value="使用" onClick="wield(this);" class="usejfye" />
                            </div>
                        </label>
                    </div>
                </div>
                <div class="myorder p">
                    <div class="content30">
                        <label>
                            <div class="incorise">
                                <span>使用积分：</span>
                                <input id="pay_points" name="pay_points" type="text"   placeholder="可用积分为:<?php echo $user['pay_points']; ?>"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" />
                                <input name="validate_bonus" type="button" value="使用" onClick="wield(this);" class="usejfye"/>
                            </div>
                        </label>
                    </div>
                </div>
                <?php if(empty($checkconpon)): ?>
                    <div class="myorder p">
                        <div class="content30">
                            <label>
                                <div class="incorise">
                                    <span>使用券码：</span>
                                    <input id="couponCode" name="couponCode" type="text"   placeholder="填写优惠券券码"/>
                                    <input name="validate_bonus" type="button" value="使用" onClick="wield(this);$('#coupon_div').hide();" class="usejfye"/>
                                </div>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="myorder myorder-2 p" id="paypwd_view", style="display: none">
                    <div class="content30">
                        <label>
                            <div class="incorise">
                                <span>支付密码：</span>
                                <input style="display:none" type="password" name="paypwd"/>
                                <!--解决google浏览器识别text+password,自动填充已保存的账户密码-->
                                <input type="password" id="paypwd" name="paypwd"  placeholder="请输入支付密码"/>
                                <?php if(empty($user['paypwd'])): ?>
                                    <a class="go-set-password" href="<?php echo U('Mobile/User/paypwd'); ?>">去设置支付密码?</a>
                                <?php endif; ?>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        <!--使用余额、积分-e-->
        </div>
    </div>
<!--支持配送,发票信息-s-->

<!--优惠券-s-->
    <div class="information_dr ma-to-20" id="coupon_div">
        <div class="maleri30">
            <div class="invoice list7">
                <div class="myorder p">
                    <div class="content30">
                        <a href="<?php echo U('mobile/User/checkcoupon',array('lid'=>$checkconpon['lid'])); ?>">
                            <div class="order">
                                <div class="fl">
                                    <span>优惠券</span>
                                    <span class="couponssl"><em><?php echo count($couponList); ?></em>张可用</span>
                                </div>
                                <div class="fr">
                                    <?php if(!empty($checkconpon)): ?>
                                        <span class="setalit"><?php echo $checkconpon['name']; ?></span>
                                        <input type="hidden" name="coupon_id"  value="<?php echo $checkconpon['lid']; ?>" />
                                    <?php else: ?>
                                        <span class="setalit">未使用</span>
                                   <?php endif; ?>
                                    <i class="Mright"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--优惠券-e-->

<!--卖家留言-s-->
    <div class="customer-messa">
        <div class="maleri30">
            <p>用户备注（50字）</p>
            <textarea class="tapassa" onkeyup="checkfilltextarea('.tapassa','50')" name="user_note" rows="" cols="" placeholder="选填"></textarea>
            <span class="xianzd"><em id="zero">50</em>/50</span>
        </div>
    </div>
<!--卖家留言-e-->

<!--订单金额-s-->
    <div class="information_dr ma-to-20">
        <div class="maleri30">
            <div class="xx-list">
                <p class="p">
                    <span class="fl">商品金额：</span>
                    <span class="fr red"><span>￥</span><span><?php echo $cartPriceInfo['total_fee']; ?></span>元</span>
                </p>
                <p class="p">
                    <span class="fl">配送费用：</span>
                    <span class="fr red" ><span>￥</span><span id="postFee">0</span>元</span>
                </p>
                <p class="p">
                    <span class="fl">使用优惠券：</span>
                    <span class="fr red" ><span>-￥</span><span id="couponFee">0</span>元</span>
                </p>
                <p class="p">
                    <span class="fl">使用积分：</span>
                    <span class="fr red" ><span>-￥</span><span id="pointsFee">0</span>元</span>
                </p>
                <p class="p">
                    <span class="fl">使用余额：</span>
                    <span class="fr red" ><span>-￥</span><span id="balance">0</span>元</span>
                </p>
                <p class="p">
                    <span class="fl">优惠活动：</span>
                    <span class="fr red" ><span>-￥</span><span id="order_prom_amount">0</span>元</span>
                </p>
            </div>
        </div>
    </div>
<!--订单金额-e-->

<!--提交订单-s-->
    <div class="mask-filter-div" style="display: none;"></div>
    <div class="payit fillpay ma-to-200">
        <div class="fr">
            <a href="javascript:void(0)" onclick="submit_order()">提交订单</a>
        </div>
        <div class="fl">
            <p><span class="pmo">应付金额：</span>￥<span id="payables"></span><span></span></p>
        </div>
    </div>
<!--提交订单-e-->

<!--配送弹窗-s-->
    <div class="losepay closeorder" style="display: ;">
        <div class="maleri30">
            <div class="l_top">
                <span>配送方式</span>
                <em class="turenoff"></em>
            </div>
            <div class="resonco">
                <?php if(is_array($shippingList) || $shippingList instanceof \think\Collection || $shippingList instanceof \think\Paginator): if( count($shippingList)==0 ) : echo "" ;else: foreach($shippingList as $k=>$v): ?>
                    <label >
                        <div class="radio">
                            <span class='che <?php if($k == 0): ?>check_t<?php endif; ?>' postname='<?php echo $v['name']; ?>'>
                                <i></i>
                                <input type="radio" id="<?php echo $v['code']; ?>" name="shipping_code" id="<?php echo $v['code']; ?>" value="<?php echo $v['code']; ?>" style="display: none;" <?php if($k == 0): ?> checked="checked" <?php endif; ?> onclick="ajax_order_price()" class="c_checkbox_t" />
                                <span><?php echo $v['name']; ?></span>
                                <span>￥<?php echo $v['freight']; ?></span>
                            </span>
                        </div>
                    </label>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="submits_de bagrr" >确认</div>
    </div>
<!--配送弹窗-e-->
</form>
<script type="text/javascript">
    $(document).ready(function(){
        showPostName();
        //显示隐藏支付密码
        $(document).on('change', '#pay_points,#user_money', function() {
            var user_money = $.trim($('#user_money').val());
            var pay_points = $.trim($('#pay_points').val());
            if ((user_money !== '' && user_money >0) || (pay_points !== '' || pay_points >0)) {
                $('#paypwd_view').show();
            } else {
                $('#paypwd_view').hide();
            }
        });
        //有使用余额，积分就得用密码
        if($('#user_money').val() > 0 || $('#pay_points').val() > 0){
            $('#paypwd_view').show();
        }
        $('.radio .che').bind('click',function(){
            //选择配送方式
            $(this).addClass('check_t')
                    .parent().parent().siblings('label').find('.che').removeClass('check_t');
            //选择配送方式显示到支持配送栏
            showPostName()
        });
        ajax_order_price(); // 计算订单价钱
    });

    //显示选择的物流公司
    function showPostName(){
        $('#postname').text($('.radio .check_t').attr('postname'));
    }
    function wield(obj){
        if($.trim($(obj).prev().val()) !=''){
            showErrorMsg('正在计算金额...');
            ajax_order_price(); // 计算订单价钱
        }
    }
    // 获取订单价格
    function ajax_order_price()
    {
        $.ajax({
            type : "POST",
            url:'/index.php?m=Mobile&c=Cart&a=cart3&act=order_price&t='+Math.random(),
            data : $('#cart2_form').serialize(),
            dataType: "json",
            success: function(data){
                if(data.status != 1)
                { //执行有误
                    $('#coupon_div').show();
                    showErrorMsg(data.msg);
                    // 登录超时
                    if(data.status == -100)
                        location.href ="<?php echo U('Mobile/User/login'); ?>";
                    return false;
                }
              $("#balance").text(data.result.balance);// 余额
              $("#pointsFee").text(data.result.pointsFee);// 积分支付
                $("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动
                $("#postFee").text(data.result.postFee); // 物流费
                if(data.result.couponFee == null){
                    $("#couponFee").text(0);// 优惠券
                }else{
                    $("#couponFee").text(data.result.couponFee);// 优惠券
                }
                $("#payables").text(data.result.payables);// 应付
            }
        });
    }

    // 提交订单
    ajax_return_status = 1; // 标识ajax 请求是否已经回来 可以进行下一次请求
    function submit_order() {
        if (ajax_return_status == 0)
            return false;
        ajax_return_status = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo U('Mobile/Cart/cart3'); ?>",//+tab,
            data: $('#cart2_form').serialize() + "&act=submit_order",// 你的formid
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
                $("#postFee").text(data.result.postFee); // 物流费
                if(data.result.couponFee == null){
                    $("#couponFee").text(0);// 优惠券
                }else{
                    $("#couponFee").text(data.result.couponFee);// 优惠券
                }
                $("#balance").text(data.result.balance);// 余额
                $("#pointsFee").text(data.result.pointsFee);// 积分支付
                $("#payables").text(data.result.payables);// 应付
                $("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动
                showErrorMsg('订单提交成功，跳转支付页面!');
                location.href = "/index.php?m=Mobile&c=Cart&a=cart4&order_id=" + data.result;
            }
        });
    }

    $(function(){
        //显示配送弹窗
        $('.takeoutps').click(function(){
            cover()
            $('.mask-filter-div').show();
            $('.losepay').show();
        })
        //关闭选择物流
        $('.turenoff').click(function(){
            undercover()
            $('.mask-filter-div').hide();
            $('.losepay').hide();
        })

        $('.submits_de').click(function(){
            $('.mask-filter-div').hide();
            $('.losepay').hide();
        })

        //显示隐藏使用发票信息
        $('.invoiceclickin').click(function(){
            $('#invoice').toggle(300);
        })
//        //显示隐藏使用余额/积分
//        $('.remain').click(function(){
//            $('#balance-li').toggle(300);
//        })
    })
</script>
</body>
</html>
