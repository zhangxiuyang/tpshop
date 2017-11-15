<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view3/order\search_goods.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510128324;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="__PUBLIC__/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="__PUBLIC__/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="__PUBLIC__/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="__PUBLIC__/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="__PUBLIC__/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />   
    <!-- jQuery 2.1.4 -->
    <script src="__PUBLIC__/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/myFormValidate.js"></script>    
    <script src="__PUBLIC__/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="__PUBLIC__/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
						layer.closeAll();
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    //全选
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['90%', '90%'],
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
  <body style="background-color:#ecf0f5;">
 

<div class="wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="navbar navbar-default">
              <form action="<?php echo U('Admin/Order/search_goods'); ?>" id="search-form2" class="navbar-form form-inline" method="post">
                <div class="form-group">
                  <select name="cat_id" id="cat_id" class="form-control">
                    <option value="">所有分类</option>
                        <?php if(is_array($categoryList) || $categoryList instanceof \think\Collection || $categoryList instanceof \think\Paginator): if( count($categoryList)==0 ) : echo "" ;else: foreach($categoryList as $k=>$v): ?>
                           <option value="<?php echo $v['id']; ?>" <?php if($v[id] == $cat_id): ?>selected<?php endif; ?> ><?php echo  str_pad('',($v[level] * 5),'-',STR_PAD_LEFT);  ?> <?php echo $v['name']; ?></option>
			 			<?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <div class="form-group">
                  <select name="brand_id" id="brand_id" class="form-control">
                    <option value="">所有品牌</option>
                        <?php if(is_array($brandList) || $brandList instanceof \think\Collection || $brandList instanceof \think\Paginator): if( count($brandList)==0 ) : echo "" ;else: foreach($brandList as $k=>$v): ?>
                           <option value="<?php echo $v['id']; ?>" <?php if($v[id] == $brand_id): ?>selected<?php endif; ?> ><?php echo $v['name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>                         
                <div class="form-group">
                    <select name="intro" class="form-control">
                        <option value="0">全部</option>
                        <option value="is_new">新品</option>
                        <option value="is_recommend">推荐</option>
                    </select>                
                </div>                  

                <div class="form-group">
                  <label class="control-label" for="input-order-id">关键词</label>
                  <div class="input-group">
                    <input type="text" name="keywords" value="<?php echo $keywords; ?>" placeholder="搜索词" id="input-order-id" class="form-control">
                  </div>
                </div>
                <button type="submit" id="button-filter search-order" class="btn btn-primary"><i class="fa fa-search"></i>查找</button>
              </form>
          </div>
          <div id="ajax_return"> 
			    <div class="table-responsive">
			        <table class="table table-bordered table-hover" id="goos_table">
			            <thead>
			            <tr>
			                <td class="text-left">商品名称</td>            
			                <td class="text-left">价格</td>
			                <td class="text-left">库存</td>
			                <td class="text-left">选择</td>
			                <td class="text-left">操作</td>
			            </tr>
			            </thead>
			            <tbody>
			            <?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                        
                            <!--如果有商品规格-->
                            <?php if($list['spec_goods'] != null): if(is_array($list['spec_goods']) || $list['spec_goods'] instanceof \think\Collection || $list['spec_goods'] instanceof \think\Paginator): $i = 0; $__LIST__ = $list['spec_goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$spec_goods): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td class="text-left"><?php echo getSubstr($list['goods_name'],0,33); ?>&nbsp;&nbsp;&nbsp;(&nbsp;<?php echo $spec_goods[key_name]; ?>&nbsp;)</td>
                                        <td class="text-left"><?php echo $spec_goods[price]; ?></td>
                                        <td class="text-left"><?php echo $spec_goods[store_count]; ?></td>             
                                        <td class="text-left">
                                            <input type="text" name="goods_id[<?php echo $list['goods_id']; ?>][<?php echo $spec_goods[key]; ?>][goods_num]"  value="1" class="input-sm" style="display:none;" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onpaste="this.value=this.value.replace(/[^\d.]/g,'')"/>
                                            <input type="checkbox"/>
                                        </td>
                                        <td><a href="javascript:void(0)" onclick="javascript:$(this).parent().parent().remove();">删除</a></td>
                                    </tr>
                                   <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                <tr>
                                    <td class="text-left"><?php echo getSubstr($list['goods_name'],0,33); ?></td>
                                    <td class="text-left"><?php echo $list['shop_price']; ?></td>
                                    <td class="text-left"><?php echo $list['store_count']; ?></td>             
                                    <td class="text-left">          
                                         <input type="text" name="goods_id[<?php echo $list['goods_id']; ?>][key][goods_num]" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" value="1" class="input-sm" style="display:none;" />                                        
                                         <input type="checkbox"/>
                                    </td>
                                    <td><a href="javascript:void(0)" onclick="javascript:$(this).parent().parent().remove();">删除</a></td>
                                </tr>                                
                             <?php endif; endforeach; endif; else: echo "" ;endif; ?>
	                        <tr>
			                    <td class="text-right" colspan="5">
			                        <a href="javascript:void(0)" onclick="select_goods();" class="btn btn-info">确定</a>			                       
								</td>
                           </tr>     
			            </tbody>
			        </table>
			    </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
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
			    $(this).parent().parent().remove();
		   }
		   $(this).siblings().show();
		   $(this).remove();
	    });
		$(".btn-info").remove();
        javascript:window.parent.call_back($('#goos_table').html().replace(/选择/,'购买数量'));
  }    
  </script>
</div>
</body>
</html>