<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view3/tc\search_goods.html";i:1510888721;s:44:"./application/admin/view3/public\layout.html";i:1503927232;}*/ ?>
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
<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<style>
	body{min-width: 760px;}
	.page{min-width: 750px;}
    /*.new_tab{display: none}*/
</style>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="padding:10px">
  <div class="flexigrid" >
    <div class="mDiv">
      <div class="ftitle">
        <h3>商品列表</h3>
        <h5>(共<?php echo $totalSize; ?>条记录)</h5>
      </div>

	  <form class="navbar-form form-inline"  method="post" action="<?php echo U('Admin/Tc/search_goods'); ?>"  name="search-form2" id="search-form2">
      <div class="sDiv">
        <div class="sDiv2">	 
        	<select name="cat_id" id="cat_id" class="select">
                 <option value="">所有分类</option>
                 <?php if(is_array($categoryList) || $categoryList instanceof \think\Collection || $categoryList instanceof \think\Paginator): if( count($categoryList)==0 ) : echo "" ;else: foreach($categoryList as $k=>$v): ?>
					<option value="<?php echo $v['id']; ?>" <?php if($v[id] == $cat_id): ?>selected<?php endif; ?> ><?php echo  str_pad('',($v[level] * 3),'-',STR_PAD_LEFT);  ?> <?php echo $v['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
             </select>
        </div>
        <div class="sDiv2">	   
            <select name="brand_id" id="brand_id" class="select">
                <option value="">所有品牌</option>
                    <?php if(is_array($brandList) || $brandList instanceof \think\Collection || $brandList instanceof \think\Paginator): if( count($brandList)==0 ) : echo "" ;else: foreach($brandList as $k=>$v): ?>
                       <option value="<?php echo $v['id']; ?>" <?php if($v[id] == $brand_id): ?>selected<?php endif; ?> ><?php echo $v['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
             </select>
         </div>
         <div class="sDiv2" style="border:0px">	 
          <input type="text" name="keywords" value="<?php echo $keywords; ?>" placeholder="搜索词" id="input-order-id" class="input-txt">
        </div>
        <div class="sDiv2" style="border:0px">	 
          <input type="submit" class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox" id="ajax_return">
        <table cellspacing="0" cellpadding="0" id="table_head" style="width: 100%">
          <thead>
	        	<tr>
	              <th class="sign" axis="col0">
	                <div style="width: 24px;">
                        <!--<i class="ico-check"></i>-->
                    </div>
	              </th>
	              <th align="left" abbr="order_sn" axis="col3" class="">
	                <div style="text-align: left; width: 400px;" class="">商品名称</div>
	              </th>
                    <th align="left" abbr="consignee" axis="col4" class="">
						<div style="text-align: center; width: 80px;" class="">本店价格</div>
					</th>
                    <th align="left" abbr="consignee" axis="col4" class="">
                        <div style="text-align: center; width: 80px;" class="">市场价格</div>
                    </th>


	            </tr>
	          </thead>
        </table>
      </div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
      <table cellspacing="0" cellpadding="0" id="goos_table">
         <tbody>
      	<?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>


			<tr date-id="<?php echo $list['goods_id']; ?>">
	              <td class="sign first_ico" axis="col0">
	                <div style="width: 24px;"><i class="ico-check"></i></div>
                    <input type="hidden" name="goods_id_c" value="<?php echo $list['goods_id']; ?>" />
	              </td>
	              <td align="left" abbr="order_sn" axis="col3" class="">
	                <div style="text-align: left; width: 400px;" class=""><?php echo getSubstr($list['goods_name'],0,36); ?></div>

	              </td>
	              <td align="left" abbr="consignee" axis="col4" class="">
	                <div style="text-align: right; width: 80px;" class=""><?php echo $list[shop_price]; ?></div>
	              </td>
	              <td align="center" abbr="article_show" axis="col5" class="">
	                <div style="text-align: right; width: 80px;" class=""><?php echo $list[market_price]; ?></div>
	              </td>
                  <td align="center" abbr="article_show" axis="col5" class="" style="display:none;" >
                    <div style="text-align: center; width: 60px;" class=""   >
                        <input type="checkbox" data-goods-id="<?php echo $list['goods_id']; ?>" style="display:none;" data-shop_price="<?php echo $list[shop_price]; ?>" data-market_price="<?php echo $list[market_price]; ?>"  />
                    </div>
                  </td>


            </tr>


	    <?php endforeach; endif; else: echo "" ;endif; ?>
	    </tbody>
	    </table>
	    <div class="sDiv" style="float:left;margin-top:10px">
        <div class="sDiv2" style="border:0px">
			    <input type="button" onclick="select_goods()"  class="btn" value="确定">
        </div>
 </div>
 
      </div>
      <div class="iDiv" style="display: none;"></div>
    </div>
    <!--分页位置-->
      <?php echo $page; ?>
   	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){	
	
	$('#flexigrid > table>tbody >tr').click(function(){
	    $(this).toggleClass('trSelected');
	    
	    var checked = $(this).hasClass('trSelected');	
		 $(this).find('input[type="checkbox"]').attr('checked',checked); 
 
	});
	
	$('.ico-check ' , '.hDivBox').click(function(){
		$('tr' ,'.hDivBox').toggleClass('trSelected' , function(index,currentclass){
    		var hasClass = $(this).hasClass('trSelected');
    		$('tr' , '#flexigrid').each(function(){
    			if(hasClass){
    				$(this).addClass('trSelected');
    			}else{
    				$(this).removeClass('trSelected');
    			}
    		});  
    	});
	});
});
 
	
function select_goods()
{
	   if($("input[type='checkbox']:checked").length == 0)
	   {
		   layer.alert('请选择商品', {icon: 2}); //alert('请选择商品');
		   return false;
	   }
	  // 将没选中的复选框所在的  tr  remove  然后删除复选框
	    $("input[type='checkbox']").each(function(){
		   if($(this).is(':checked') == false)
		   {
			    $(this).parent().parent().parent().remove();
		   }
		   $(this).parent().parent().show();
		   $(this).siblings().show();
           $(this).parent().append('<input type="number" class="goods_num" name="goods_id['+$(this).attr('data-goods-id')+'][goods_num]" min="1" max="999" oninput="if(value.length>3)value=value.slice(0,3)" maxlength="3" data-shop_price="'+$(this).attr('data-shop_price')+'" data-market_price="'+$(this).attr('data-market_price')+'" onchange="getGoodsTotal()" value="1">'
           );
           $(this).parent().parent().parent().append('<td><a class="btn red " href="javascript:void(0);" onclick="javascript:$(this).parent().parent().remove();">删除</a></td>');
           $(this).remove();
	    });
		$(".btn-info").remove();
		var tabHtml = $('#goos_table').html();

		 javascript:window.parent.call_back(tabHtml);
}    
</script>
</body>
</html>