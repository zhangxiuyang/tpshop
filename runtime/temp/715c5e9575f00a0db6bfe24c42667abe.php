<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"./application/admin/view2/promotion\prom_goods_info.html";i:1511150877;s:44:"./application/admin/view2/public\layout.html";i:1503927232;}*/ ?>
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
<style>
    dd.opt table{
        width: 100%;
    }
    dd.opt tr{
        border: 1px solid #f4f4f4;
        padding: 8px;
    }
    dd.opt tr td{
        border: 1px solid #f4f4f4;
    }
    .ys-btn-close {
        position: relative;
        top: -12px;
        left: -16px;
        width: 18px;
        height: 18px;
        border: 1px solid #ccc;
        line-height: 18px;
        text-align: center;
        display: inline-block;
        border-radius: 50%;
        z-index: 1;
        background-color: #fff;
        cursor: pointer;
    }
    .selected-group-goods {
        background-color: #FFF;
        width: 162px;
        padding: 9px;
        margin-bottom: 10px;
        border: solid 1px #E6E6E6;
        box-shadow: 2px 2px 0 rgba(153,153,153,0.1);
    }

</style>
<script type="text/javascript" src="__ROOT__/public/plugins/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/public/plugins/Ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__ROOT__/public/plugins/Ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<style type="text/css">
    html, body {
        overflow: visible;
    }
</style>

<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>优惠促销管理 - 添加与编辑商品促销活动</h3>
                <h5>网站系统编辑商品促销活动</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" id="handleposition" method="post">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
        <input type="hidden" id="coupon_count" value="<?php echo count($coupon_list); ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>促销活动名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="title" id="title" value="<?php echo $info['title']; ?>" class="input-txt">
                    <p class="notic">促销活动名称</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>促销活动类型</label>
                </dt>
                <dd class="opt">
                    <select id="prom_type" name="type">
                        <option value="0" <?php if($info[type] == 0): ?>selected<?php endif; ?>>直接打折</option>
                        <option value="1" <?php if($info[type] == 1): ?>selected<?php endif; ?>>减价优惠</option>
                        <option value="2" <?php if($info[type] == 2): ?>selected<?php endif; ?>>固定金额出售</option>
                        <option value="3" <?php if($info[type] == 3): ?>selected<?php endif; ?>>买就赠代金券</option>
                    </select>
                    <p class="notic">促销活动类型</p>
                </dd>
            </dl>
            <dl class="row" id="expression">
                <dt class="tit">
                    <label><em>*</em>折扣</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="expression"  value="<?php echo $info['expression']; ?>" class="input-txt">
                    <p class="notic">% 折扣值(1-100 如果打9折，请输入90)</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>开始时间</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="start_time" name="start_time" value="<?php echo $info['start_time']; ?>"  class="input-txt">
                    <p class="notic">优惠开始时间</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>结束时间</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="end_time" name="end_time" value="<?php echo $info['end_time']; ?>" class="input-txt">
                    <p class="notic">优惠结束时间</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>宣传图片</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show">
                        <span class="show">
                            <a id="img_a" target="_blank" class="nyroModal" rel="gal" href="<?php echo $info['prom_img']; ?>">
                                <i id="img_i" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['prom_img']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
           	            <span class="type-file-box">
                            <input type="text" id="prom_img" name="prom_img" value="<?php echo $info['prom_img']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','activity','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <span class="err"></span>
                    <p class="notic">请上传图片格式文件</p>
                </dd>
            </dl>
            <!--<dl class="row">-->
                <!--<dt class="tit">适合用户范围</dt>-->
                <!--<dd class="opt">-->
                    <!--<ul class="nc-row ncap-waybill-list">-->
                        <!--<?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$vo): ?>-->
                            <!--<li><label class="label">-->
                                <!--<input type="checkbox" <?php if(strripos($info['group'],$vo['level_id'].'') !== false): ?>checked<?php endif; ?> name="group[]" value="<?php echo $vo['level_id']; ?>">-->
                                <!--<?php echo $vo['level_name']; ?></label>-->
                            <!--</li>-->
                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                    <!--</ul>-->
                <!--</dd>-->
            <!--</dl>-->
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>选择优惠商品</label>
                </dt>
                <dd class="opt">
                    <div style="overflow: hidden;" id="selected_group_goods">
                        <?php if(is_array($prom_goods) || $prom_goods instanceof \think\Collection || $prom_goods instanceof \think\Paginator): $i = 0; $__LIST__ = $prom_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;if(empty($goods[SpecGoodsPrice]) || (($goods[SpecGoodsPrice] instanceof \think\Collection || $goods[SpecGoodsPrice] instanceof \think\Paginator ) && $goods[SpecGoodsPrice]->isEmpty())): ?>
                                <div style="float: left;margin-right: 20px">
                                    <input type="hidden" name="goods[<?php echo $goods['goods_id']; ?>][goods_id]" value="<?php echo $goods['goods_id']; ?>"/>
                                    <div class="ys-btn-close" style="top: 15px;left: 172px;">×</div>
                                    <div class="selected-group-goods">
                                        <div class="goods-thumb"><img style="width: 162px;height: 162px" src="<?php echo goods_thum_images($goods['goods_id'],162,162); ?>"/></div>
                                        <div class="goods-name">
                                            <a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>"><?php echo $goods['goods_name']; ?></a>
                                        </div>
                                        <div class="goods-price">商城价：￥<?php echo $goods['shop_price']; ?>库存:<?php echo $goods['store_count']; ?></div>
                                    </div>
                                </div>
                                <?php else: if(is_array($goods[SpecGoodsPrice]) || $goods[SpecGoodsPrice] instanceof \think\Collection || $goods[SpecGoodsPrice] instanceof \think\Paginator): $i = 0; $__LIST__ = $goods[SpecGoodsPrice];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$spec): $mod = ($i % 2 );++$i;if($spec['prom_type'] == 3 AND $spec['prom_id'] == $info['id']): ?>
                                        <div style="float: left;margin-right: 20px">
                                            <input type="hidden" name="goods[<?php echo $goods['goods_id']; ?>][goods_id]" value="<?php echo $goods['goods_id']; ?>"/>
                                            <input type="hidden" name="goods[<?php echo $goods['goods_id']; ?>][item_id][]" value="<?php echo $spec['item_id']; ?>"/>
                                            <div class="ys-btn-close" style="top: 15px;left: 172px;">×</div>
                                            <div class="selected-group-goods">
                                                <div class="goods-thumb"><img style="width: 162px;height: 162px" src="<?php echo $spec[spec_img]; ?>"/></div>
                                                <div class="goods-name">
                                                    <a target="_blank"
                                                       href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'],'item_id'=>$spec['item_id'])); ?>"><?php echo $goods['goods_name']; ?><?php echo $spec['key_name']; ?></a>
                                                </div>
                                                <div class="goods-price">商城价：￥<?php echo $spec['price']; ?>库存:<?php echo $spec['store_count']; ?></div>
                                            </div>
                                        </div>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <span class="err" id="err_goods" style="color:#F00; display:none;">请添加优惠商品</span>
                    <p class="notic">
                        <a onclick="selectGoods()" class="ncap-btn"><i class="fa fa-search"></i>选择商品</a>
                    </p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>活动描述</label>
                </dt>
                <dd class="opt">
                    <textarea class="span12 ckeditor" placeholder="请输入活动介绍" id="post_content" name="description" rows="6"><?php echo $info['description']; ?></textarea>
                    <p class="notic">活动描述</p>
                </dd>
            </dl>
            <div class="bot"><a id="submit" class="ncap-btn-big ncap-btn-green">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        $(document).on("click", '#submit', function (e) {
            var type = parseInt($("#prom_type").val());
            var expression = $("[name='expression']").val();
            if (type == 3 && expression == 0){
                layer.msg('请选择优惠券',{icon:2});return false;
            }
            verifyForm();
        })
    })
    function verifyForm(){
        $('span.err').hide();
        $.ajax({
            type: "POST",
            url: "<?php echo U('Admin/Promotion/prom_goods_save'); ?>",
            data: $('#handleposition').serialize(),
            async:false,
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
                        location.href = "<?php echo U('Admin/Promotion/prom_goods_list'); ?>";
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
    function call_back(goodsItem){
        var html = '';
        var item = goodsItem;
        //alert(goodsItem.goods_id);
        //$.each(goodsItem, function (index, item) {

            if (item.goods_id != 'on') {
                /*if (item.spec != null) {
                    //有规格
                    $.each(item.spec, function (i, o) {
                        html += '<div style="float: left;margin-right: 20px"><div class="ys-btn-close" style="top: 15px;left: 172px;">×</div>' +
                                '<input type="hidden" name="goods[' + item.goods_id + '][goods_id]" value="' + item.goods_id + '"/>' +
                                '<input type="hidden" name="goods[' + item.goods_id + '][item_id][' + i + ']" value="' + o.item_id + '"/>' +
                                '<div class="selected-group-goods"><div class="goods-thumb">' +
                                '<img style="width: 162px;height: 162px" src="' + o.spec_img + '"/></div> <div class="goods-name"> ' +
                                '<a target="_blank" href="/index.php?m=Home&c=Goods&a=goodsInfo&id=' + item.goods_id + '">' + item.goods_name + o.key_name + '</a> </div>' +
                                ' <div class="goods-price">商城价：￥' + o.price + '库存:' + o.store_count + '</div> </div></div>';
                    });
                } else {*/
                    html += '<div style="float: left;margin-right: 20px"><div class="ys-btn-close" style="top: 15px;left: 172px;">×</div>' +
                            '<input type="hidden" name="goods[' + item.goods_id + '][goods_id]" value="' + item.goods_id + '"/>' +
                            '<div class="selected-group-goods"><div class="goods-thumb">' +
                            '<img style="width: 162px;height: 162px" src="' + item.goods_image + '"/></div> <div class="goods-name"> ' +
                            '<a target="_blank" href="/index.php?m=Home&c=Goods&a=goodsInfo&id=' + item.goods_id + '">' + item.goods_name + '</a> </div>' +
                            ' <div class="goods-price">商城价：￥' + item.goods_price + '库存:' + item.store_count + '</div> </div></div>';
               // }
            }
        //});
        $('#selected_group_goods').append(html);
        layer.closeAll('iframe');
    }
    var url="<?php echo url('Admin/Ueditor/index',array('savePath'=>'activity')); ?>";
    var ue = UE.getEditor('post_content',{
        serverUrl :url,
        zIndex: 999,
        initialFrameWidth: "100%", //初化宽度
        initialFrameHeight: 350, //初化高度
        focus: false, //初始化时，是否让编辑器获得焦点true或false
        maximumWords: 99999, removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign',//允许的最大字符数 'fullscreen',
        pasteplain:false, //是否默认为纯文本粘贴。false为不使用纯文本粘贴，true为使用纯文本粘贴
        autoHeightEnabled: true
    });

    function img_call_back(fileurl_tmp) {
        $("#prom_img").val(fileurl_tmp);
        $("#img_a").attr('href', fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }

    function selectGoods(){
        var url = "<?php echo U('Promotion/search_goods',array('tpl'=>'select_goods','prom_type'=>3,'prom_id'=>$info[id])); ?>";
        layer.open({
            type: 2,
            title: '选择商品',
            shadeClose: true,
            shade: 0.3,
            area: ['70%', '80%'],
            content: url,
        });
    }

    $("#prom_type").on("change",function(){
        var type = parseInt($("#prom_type").val());
        var coupon_count = $('#coupon_count').val();
        if (type == 3 && coupon_count <= 0){
            layer.msg('没有可选择的优惠券',{icon:2});
        }
        var expression = '';
        switch(type){
            case 0:{
                expression = '<dt class="tit"><label><em>*</em>折扣</label></dt>'
                        + '<dd class="opt"><input type="text" name="expression" pattern="^\\d+$" value="" class="input-txt">'
                        + '<span class="err" id="err_expression"></span><p class="notic">% 折扣值(1-100 如果打9折，请输入90)</p></dd>';
                break;
            }
            case 1:{
                expression = '<dt class="tit"><label><em>*</em>立减金额</label></dt>'
                        + '<dd class="opt"><input type="text" name="expression" pattern="^\\d+(\\.\\d+)?$" value="" class="input-txt">'
                        + '<span class="err" id="err_expression"></span><p class="notic">立减金额（元）</p></dd>';
                break;
            }
            case 2:{
                expression = '<dt class="tit"><label><em>*</em>出售金额</label></dt>'
                        + '<dd class="opt"><input type="text" name="expression" pattern="^\\d+(\\.\\d+)?$" value="" class="input-txt">'
                        + '<span class="err" id="err_expression"></span><p class="notic">出售金额（元）</p></dd>';
                break;
            }
            case 3:{
                expression = '<dt class="tit"><label><em>*</em>代金券</label></dt><dd class="opt"><select name="expression"><option value="0">请选择</option>'
                        + '<?php if(is_array($coupon_list) || $coupon_list instanceof \think\Collection || $coupon_list instanceof \think\Paginator): if( count($coupon_list)==0 ) : echo "" ;else: foreach($coupon_list as $key=>$v): ?><option value="<?php echo $v['id']; ?>" <?php if($v[id] == $info[expression]): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>'
                        + '<span class="err" id="err_expression"></span><p class="notic">请选择代金券</p></dd>';
                break;
            }
            case 4:{
                expression = '<dt class="tit"><label><em>*</em>买M送N</label></dt>'
                        + '<dd class="opt"><input type="text" name="expression" pattern="\\d+\/\\d+" value="" class="input-txt">'
                        + '<span class="err" id="err_expression"></span><p class="notic">买几件送几件（如买3件送1件: 3/1）</p></dd>';
                break;
            }
        }
        $("#expression").html(expression);
    });

    $(document).ready(function(){
        $("#prom_type").trigger('change');
        $('input[name=expression]').val("<?php echo $info['expression']; ?>");

        $('#start_time').layDate();
        $('#end_time').layDate();
    })
    //商品删除按钮事件
    $(function () {
        $(document).on("click", '.ys-btn-close', function (e) {
            $(this).parent().remove();
        })
    })
</script>
</body>
</html>