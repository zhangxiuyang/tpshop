<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./template/mobile/new2/tc\tcInfo.html";i:1511422214;s:41:"./template/mobile/new2/public\header.html";i:1503927242;s:43:"./template/mobile/new2/public\wx_share.html";i:1503927242;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>套餐详情--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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

<style>
    .plusshopcar-buy .dis{
        background: #ebebeb;
        color: #999;
        cursor: not-allowed;
        pointer-events:none;
    }
    .comment_de ul{text-align: center;}
    .comment_de ul li{float: none;line-height: normal;width: 90%; background-color: #93afcb; margin-left: auto; margin-right: auto;line-height: 2rem;  -webkit-border-radius: 1rem;
        -moz-border-radius: 1rem;
        border-radius: 1rem;}
</style>
<div class="he_sustain">
    <div class="classreturn loginsignup detail">
        <div class="content">
            <div class="ds-in-bl return">
                <a href="javascript:history.back(-1)"><img src="__STATIC__/images/return.png" alt="返回"></a>
            </div>
            <div class="ds-in-bl search center" id="topcenter">
                <span class="sxp">详情</span>
                <span>配送</span>
            </div>
            <div class="ds-in-bl menu">
               <!-- <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a>-->
            </div>
        </div>
    </div>
</div>

<!--商品抢购 start-->


<!--详情-s-->
<div class="xq_details" style="">
    <div class="sg">
        <div class="spxq p">
            <?php echo htmlspecialchars_decode($tc_info['content']); ?>
        </div>
    </div>
    <div class="sg" style="display: none;">
        <div class="spxq p">
            <table class="de_table" border="1" bordercolor="#cbcbcb" style="border-collapse:collapse;">
                <tr>
                    <th colspan="2">主体</th>
                </tr>
                <?php if(is_array($goods_attr_list) || $goods_attr_list instanceof \think\Collection || $goods_attr_list instanceof \think\Paginator): if( count($goods_attr_list)==0 ) : echo "" ;else: foreach($goods_attr_list as $k=>$v): ?>
                    <tr>
                        <td><?php echo $goods_attribute[$v[attr_id]]; ?></td>
                        <td><?php echo $v[attr_value]; ?></td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </div>
    </div>
</div>
<!--详情-e-->
<div class="xq_details" >
    <div class="spxq-ggcs comment_de p"  style="display:none;">
        <ul>
            <?php if(is_array($tc_month_list) || $tc_month_list instanceof \think\Collection || $tc_month_list instanceof \think\Paginator): if( count($tc_month_list)==0 ) : echo "" ;else: foreach($tc_month_list as $k=>$v): ?>
                <li onclick="openMonth('<?php echo $v['tc_month_id']; ?>');"> <?php echo $v['tc_month_name']; ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

<!--底部按钮-s-->
<div class="podee">
    <div class="cart-concert-btm p">

        <div class="fr" style="width:100%; max-width: 16rem;float: none; margin: auto;">
            <ul>
                <li class="o">
                    <a class="pb_plusshopcar button active_button" href="collect_tc;"> 收藏</a>
                </li>
                <li class="r">
                    <a class="choise_num" style="display:block;" href="javascript:void(0);">立即购买</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--底部按钮-e-->

<a onclick="$('html,body').animate({'scrollTop':0},300)" style="display: block;width: 1.5rem;height:1.5rem;position: fixed; bottom: 3rem;right:0.4rem; background-color: rgba(243,241,241,0.5);border: 1px solid #CCC;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;" id="topup">
    <img src="__STATIC__/images/topup.png" style="display: block;width: 1.45rem;height:1.45rem;">
</a>
<script type="text/javascript" src="__STATIC__/js/mobile-location.js"></script>
<script type="text/javascript">
    /**
     * 顶部导航切换
     */
    $(document).on('click','.detail .search span',function(){
        $(this).addClass('sxp').siblings().removeClass('sxp');
        var a = $('.detail .search span').index(this);
        $('.xq_details').eq(a).show().siblings('.xq_details').hide();
        $('.xq_details').eq(1).show();
        if($('.detail .search span').eq(1).hasClass('sxp')){
            $('.comment_de').show();
        }else{
            $('.comment_de').hide();
        }
        if($('.detail .search span').eq(0).hasClass('sxp')){
            $('.tab-con-wrapper').hide();
            $('.comment_con').hide();
        }else{
            $('.tab-con-wrapper').show();
            $('.comment_con').show();
        }
    });
    //配送详情展示
    function openMonth(id) {
        layer.open({type: 2});
        $.ajax({url:'/index.php/Mobile/Tc/tcMonthInfo/id/'+id,success:function(result){
            var pageii = layer.open({
                type: 1
                ,content: result
                ,anim: 'up'
                ,style: 'position:fixed; left:0; top:0; width:100%; height:100%; overflow: scroll; border: none; -webkit-animation-duration: .5s; animation-duration: .5s;'
            });
        }});
    }
    //点击收藏商品
    function collect_tc(tc_id){
        $.ajax({
            type : "GET",
            dataType: "json",
            url:"/index.php?m=Mobile&c=tc&a=collect_tc&tc_id="+tc_id,//+tab,
            success: function(data){
                layer.open({content:data.msg, time:2});
            }
        });
    }


    //时间戳转换
    function add0(m){return m<10?'0'+m:m }
    function  formatDate(now)   {
        var time = new Date(now);
        var y = time.getFullYear();
        var m = time.getMonth()+1;
        var d = time.getDate();
        var h = time.getHours();
        var mm = time.getMinutes();
        var s = time.getSeconds();
        return y+'/'+add0(m)+'/'+add0(d)+' '+add0(h)+':'+add0(mm)+':'+add0(s);
    }
</script>

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript">
<?php if(ACTION_NAME == 'goodsInfo'): ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo $goods[goods_id]; ?>"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>"; // 分享图标
<?php else: ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $tpshop_config['shop_info_store_logo']; ?>"; //分享图标
<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);
// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}

$(function() {
	if(isWeiXin() && parseInt(user_id)>0){
		$.ajax({
			type : "POST",
			url:"/index.php?m=Mobile&c=Index&a=ajaxGetWxConfig&t="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{
				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){
		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareTimeline({
		        title: "<?php echo (isset($goods['goods_name']) && ($goods['goods_name'] !== '')?$goods['goods_name']:$tpshop_config['shop_info_store_title']); ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo (isset($goods['goods_name']) && ($goods['goods_name'] !== '')?$goods['goods_name']:$tpshop_config['shop_info_store_desc']); ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo (isset($goods['goods_name']) && ($goods['goods_name'] !== '')?$goods['goods_name']:$tpshop_config['shop_info_store_desc']); ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo (isset($goods['goods_name']) && ($goods['goods_name'] !== '')?$goods['goods_name']:$tpshop_config['shop_info_store_desc']); ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});

		   <?php if(CONTROLLER_NAME == 'User'): ?> 
				wx.hideOptionMenu();  // 用户中心 隐藏微信菜单
		   <?php endif; ?>	
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
<!--微信关注提醒 start-->
<?php if(\think\Session::get('subscribe') == 0): endif; ?>
<button class="guide" style="display:none;" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:1rem;height:4rem;text-align: center;border-radius: 0.2rem ;font-size:0.5rem;padding:0.2rem 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 0.1rem;bottom: 10rem;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:0.1rem;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 0.2rem;}
</style>
<script type="text/javascript">
  //关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo $wx_qr; ?>" width="100%">',
		style: ''
	});
}
  
$(function(){
	if(isWeiXin()){
		var subscribe = getCookie('subscribe'); // 是否已经关注了微信公众号		
		if(subscribe == 0)
			$('.guide').show();
	}else{
		$('.guide').hide();
	}
})
 
</script> 

<!--微信关注提醒  end-->
</body>
</html>
