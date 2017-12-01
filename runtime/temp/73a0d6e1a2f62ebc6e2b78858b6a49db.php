<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:40:"./application/admin/view3/ad\adList.html";i:1509605306;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
  <body  style="background-color:#ecf0f5;">
 

<div class="wrapper">
	

	<section class="content">
       <div class="row">
       		<div class="col-xs-12">
	       		<div class="box">
	             <div class="box-header">
	               	<nav class="navbar navbar-default">	     
				        <div class="collapse navbar-collapse">
				          <form class="navbar-form form-inline" action="<?php echo U('Ad/adList'); ?>" method="post">
				            <div class="form-group">
				              	<input type="text" name="keywords" class="form-control" placeholder="请输入广告名称">
				            </div>
				            <div class="form-group">                       
				            	 <select name="pid" class="form-control">
                                            <option value="0">==查看所有==</option>
                                      <?php if(is_array($ad_position_list) || $ad_position_list instanceof \think\Collection || $ad_position_list instanceof \think\Paginator): $k = 0; $__LIST__ = $ad_position_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?>
                                            <option value="<?php echo $item['position_id']; ?>"><?php echo $item['position_name']; ?></option>
                                      <?php endforeach; endif; else: echo "" ;endif; ?>                  
                                 </select>   
				            </div>
				            <button type="submit" class="btn btn-primary">查询</button>
				            <div class="form-group pull-right">
					            <a href="<?php echo U('Ad/ad'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> 新增广告</a>
				            </div>		          
				          </form>
				      	</div>
	    			</nav>
	    			<nav class="navbar navbar-default">	     
				      <div class="collapse navbar-collapse">
	    				<div class="navbar-form form-inline">
				            <div class="form-group">
				            	<p class="text-success margin blod">预览广告所在页面:</p>
				            </div>
				             <div class="form-group">
                                 <a class="btn btn-default" href="<?php echo U('/Home/Index/index',array('edit_ad'=>1)); ?>">首页</a>&nbsp;&nbsp;&nbsp;&nbsp;                                            
                                 <a class="btn btn-default" href="<?php echo U('/Mobile/Index/index',array('edit_ad'=>1)); ?>" >手机首页</a>&nbsp;&nbsp;&nbsp;&nbsp;                                            
                                 <a class="btn btn-default" href="<?php echo U('/Mobile/Goods/categoryList',array('edit_ad'=>1)); ?>" >手机分类页</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                 
                                    <select class="form-control" name="intro" onchange="if(this.value != 0) location.href='/index.php?m=Home&c=Channel&a=index&edit_ad=1&id='+this.value;">
                                        <option value="0">请选择频道页广告</option>
                                        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__goods_category` where `level` = 1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__goods_category` where `level` = 1"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
	                                        <option value="<?php echo $v[id]; ?>"><?php echo $v[name]; ?></option>
                                      	<?php endforeach; ?>
                                    </select>
                                   
                                 <!-- <a class="btn btn-default" href="<?php echo U('/Mobile/Index/index',array('edit_ad'=>1)); ?>">手机首页</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
				            </div>			          
				          </div>
				       </div>
	    		 </nav>	
	             </div>
	             <div class="box-body">
	           	 <div class="row">
	            	<div class="col-sm-12">
		              <table id="list-table" class="table table-bordered table-striped dataTable">
		                 <thead>
		                   <tr role="row">
                                           <th>广告id</th>
                                           <th>广告位置</th>
			                   <th>广告名称</th>	
			                   <th>广告图片</th>	                   
			                   <th>广告链接</th>
                                           <th>新窗口</th>
			                   <th>是否显示</th>
		                  	   <th>排序</th>
		                  	   <th>操作</th>
		                   </tr>
		                 </thead>
						<tbody>
                          <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                             <tr role="row">    
                                     <td><?php echo $vo[ad_id]; ?></td>
                                     <td><?php echo $ad_position_list[$vo[pid]][position_name]; ?></td>
		                     <td><?php echo $vo['ad_name']; ?></td>	                    
		                     <td><img alt="" src="<?php echo $vo['ad_code']; ?>" width="80px" height="50px"></td>
		                     <td><?php echo $vo['ad_link']; ?></td>
		                     <td>
                                         <img width="20" height="20" src="__PUBLIC__/images/<?php if($vo[target] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','target',this)"/>
		                     </td>                                     
		                     <td>
                                         <img width="20" height="20" src="__PUBLIC__/images/<?php if($vo[enabled] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','enabled',this)"/>
		                     </td>
		                     <td>
                                        <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onchange="updateSort('ad','ad_id','<?php echo $vo['ad_id']; ?>','orderby',this)" size="4" value="<?php echo $vo['orderby']; ?>" class="input-sm" />		                     	
		                     </td>
		                     <td>
		                      <a class="btn btn-primary" href="<?php echo U('Ad/ad',array('act'=>'edit','ad_id'=>$vo['ad_id'])); ?>"><i class="fa fa-pencil"></i></a>
		                      <a class="btn btn-danger" onclick="delfunc(this)" data-url="<?php echo U('Ad/adHandle'); ?>" data-id="<?php echo $vo['ad_id']; ?>"><i class="fa fa-trash-o"></i></a>
				     </td>
		                   </tr>
		                  <?php endforeach; endif; else: echo "" ;endif; ?>
		                   </tbody>
		                 <tfoot>
		                 
		                 </tfoot>
		               </table>
	               </div>
	          </div>
              <div class="row">
              	    <div class="col-sm-6 text-left">
              	    	<button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
              	    </div>
                    <div class="col-sm-6 text-right"><?php echo $page; ?></div>		
              </div>
	          </div>
	        </div>
       	</div>
       </div>
   </section>
<script>

</script>
</div>
</body>
</html>   
