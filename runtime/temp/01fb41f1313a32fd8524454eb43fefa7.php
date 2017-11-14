<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"./application/admin/view2/promotion\group_buy.html";i:1503927232;s:44:"./application/admin/view2/public\layout.html";i:1503927232;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
<script src="__PUBLIC__/js/myFormValidate.js"></script>
<script src="__PUBLIC__/js/myAjax2.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
						layer.closeAll();
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['70%', '80%'],
            content: $(obj).attr('data-url'), 
        });
    }
    
    function delAll(obj,name){
    	var a = [];
    	$('input[name*='+name+']').each(function(i,o){
    		if($(o).is(':checked')){
    			a.push($(o).val());
    		}
    	})
    	if(a.length == 0){
    		layer.alert('请选择删除项', {icon: 2});
    		return;
    	}
    	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
    			$.ajax({
    				type : 'get',
    				url : $(obj).attr('data-url'),
    				data : {act:'del',del_id:a},
    				dataType : 'json',
    				success : function(data){
						layer.closeAll();
    					if(data == 1){
    						layer.msg('操作成功', {icon: 1});
    						$('input[name*='+name+']').each(function(i,o){
    							if($(o).is(':checked')){
    								$(o).parent().parent().remove();
    							}
    						})
    					}else{
    						layer.msg(data, {icon: 2,time: 2000});
    					}
    				}
    			})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);	
    }
</script>  

</head>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>团购管理 - 编辑团购</h3>
                <h5>网站系统抢购活动详情页</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" id="handleposition" method="post">
        <input type="hidden" id="goods_id" name="goods_id" value="<?php echo $info['goods_id']; ?>">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
        <input type="hidden" name="act" value="<?php echo $act; ?>">
        <input type="hidden" name="item_id" value="<?php echo $info['item_id']; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>团购标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="title" id="title" value="<?php echo $info['title']; ?>" class="input-txt">
                    <span class="err" id="err_title"></span>
                    <p class="notic">请填写团购标题</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>开始时间</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="start_time" name="start_time" value="<?php echo $info['start_time']; ?>"  class="input-txt">
                    <span class="err" id="err_start_time"></span>
                    <p class="notic">团购开始时间</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>结束时间</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="end_time" name="end_time" value="<?php echo $info['end_time']; ?>" class="input-txt">
                    <span class="err" id="err_end_time"></span>
                    <p class="notic">团购结束时间</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>选择团购商品</label>
                </dt>
                <dd class="opt">
                    <input type="text" readonly  id="goods_name" name="goods_name" value="<?php echo $info['goods_name']; ?>" class="input-txt">
                    <div style="overflow: hidden" id="selected_group_goods">
                        <?php if($info['goods_id'] > 0): ?>
                            <div style="float: left;margin-right: 10px" class="selected-group-goods">
                                <div class="goods-thumb"><img style="width: 162px;height: 162px"  <?php if(!(empty($info['specGoodsPrice']) || (($info['specGoodsPrice'] instanceof \think\Collection || $info['specGoodsPrice'] instanceof \think\Paginator ) && $info['specGoodsPrice']->isEmpty()))): ?>src="<?php echo $info['specGoodsPrice']['spec_img']; ?>"<?php else: ?>src="<?php echo goods_thum_images($info['goods_id'],162,162); ?>"<?php endif; ?>/></div>
                                <div class="goods-name">
                                    <a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$info['goods_id'])); ?>"><?php echo $info['goods_name']; ?></a>
                                </div>
                                <div class="goods-price">
                                    <?php if(!(empty($info['specGoodsPrice']) || (($info['specGoodsPrice'] instanceof \think\Collection || $info['specGoodsPrice'] instanceof \think\Paginator ) && $info['specGoodsPrice']->isEmpty()))): ?>
                                        商城价：￥<?php echo $info['specGoodsPrice']['price']; ?>库存:<?php echo $info['specGoodsPrice']['store_count']; else: ?>
                                        商城价：￥<?php echo $info['goods']['shop_price']; ?>库存:<?php echo $info['goods']['store_count']; endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <span class="err" id="err_goods_name"></span>
                    <p class="notic">
                        <a onclick="selectGoods()" class="ncap-btn"><i class="fa fa-search"></i>选择商品</a>
                    </p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>团购价格</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="price" name="price" value="<?php echo $info['price']; ?>"  onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" class="input-txt">
                    <input type="hidden" id="goods_price" name="goods_price" value="<?php echo $info['goods_price']; ?>">
                    <span class="err" id="err_price"></span>
                    <p class="notic">商品团购价格,单位：元</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>参团数量</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="goods_num" id="goods_num" value="<?php echo $info['goods_num']; ?>" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" class="input-txt">
                    <span class="err" id="err_goods_num"></span>
                    <p class="notic">此抢购活动最多允许抢购的商品数量</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>虚拟购买数</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="virtual_num" name="virtual_num" value="<?php echo $info['virtual_num']; ?>" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')"  class="input-txt">
                    <span class="err" id="err_virtual_num"></span>
                    <p class="notic">虚拟已购买参团人数</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>团购介绍</label>
                </dt>
                <dd class="opt">
                    <textarea placeholder="请输入活动介绍" name="intro" rows="6" class="tarea"><?php echo $info['intro']; ?></textarea>
                    <span class="err" id="err_intro"></span>
                    <p class="notic">团购描述介绍</p>
                </dd>
            </dl>
            <div class="bot"><a onclick="verifyForm()" class="ncap-btn-big ncap-btn-green">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#start_time').layDate();
        $('#end_time').layDate();
    })
    function verifyForm(){
        $('span.err').hide();
        $.ajax({
            type: "POST",
            url: "<?php echo U('Admin/Promotion/groupbuyHandle'); ?>",
            data: $('#handleposition').serialize(),
            dataType: "json",
            error: function () {
                layer.alert("服务器繁忙, 请联系管理员!");
            },
            success: function (data) {
                if (data.status == 1) {
                    layer.msg(data.msg, {
                        icon: 1,
                        time: 1000
                    }, function(){
                        location.href = "<?php echo U('Admin/Promotion/group_buy_list'); ?>";
                    });
                } else {
                    layer.msg(data.msg, {icon: 2,time: 1000});
                    $.each(data.result, function (index, item) {
                        $('#err_' + index).text(item).show();
                    });
                }
            }
        });
    }
    function selectGoods(){
        var url = "<?php echo U('Promotion/search_goods',array('tpl'=>'select_goods','prom_type'=>2,'prom_id'=>$info[id])); ?>";
        layer.open({
            type: 2,
            title: '选择商品',
            shadeClose: true,
            shade: 0.2,
            area: ['75%', '75%'],
            content: url,
        });
    }

    function call_back(goodsItem){
        $('#goods_id').val(goodsItem.goods_id);
        var html = '';
        if(goodsItem.spec != null){
            //有规格
            html = '<div style="float: left;margin: 10px auto;" class="selected-group-goods"><div class="goods-thumb">' +
                    '<img style="width: 162px;height: 162px" src="'+goodsItem.spec.spec_img+'"/></div> <div class="goods-name"> ' +
                    '<a target="_blank" href="/index.php?m=Home&c=Goods&a=goodsInfo&id='+goodsItem.goods_id+'">'+goodsItem.goods_name+goodsItem.spec.key_name+'</a> </div>' +
                    ' <div class="goods-price">商城价：￥'+goodsItem.spec.price+'库存:'+goodsItem.spec.store_count+'</div> </div>';
            $('input[name=item_id]').val(goodsItem.spec.item_id)
            $('input[name=goods_name]').val(goodsItem.goods_name + goodsItem.spec.key_name);
        }else{
            html = '<div style="float: left;margin: 10px auto;" class="selected-group-goods"><div class="goods-thumb">' +
                    '<img style="width: 162px;height: 162px" src="'+goodsItem.goods_image+'"/></div> <div class="goods-name"> ' +
                    '<a target="_blank" href="/index.php?m=Home&c=Goods&a=goodsInfo&id='+goodsItem.goods_id+'">'+goodsItem.goods_name+'</a> </div>' +
                    ' <div class="goods-price">商城价：￥'+goodsItem.goods_price+'库存:'+goodsItem.store_count+'</div> </div>';
            $('input[name=goods_name]').val(goodsItem.goods_name);
        }
        $('#select_goods_button').attr('data-goods-id',goodsItem.goods_id);
        $('#selected_group_goods').empty().html(html);
        $('.selected-group-goods').show();
        layer.closeAll('iframe');
    }
</script>
</body>
</html>