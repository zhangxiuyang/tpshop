<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./application/admin/view3/ad\positionList.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
	               		<div class="pull-right navbar-form">
	               			<label><a class="btn btn-block btn-primary" href="<?php echo U('Admin/Ad/position'); ?>">新增广告位</a></label>
	               		</div>
	               	</nav>	            
	             </div>
	             <div class="box-body">
		           <div class="row">
		            	<div class="col-sm-12">
			              <table id="list-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
			                 <thead>
			                   <tr role="row">
			                   	   <th>广告ID</th>
				                   <th>广告位名称</th>
				                   <th>广告位宽度</th>
				                   <th>广告位高度</th>
				                   <th>广告位描述</th>
				                   <th>状态</th>
				                   <th>操作</th>
			                   </tr>
			                 </thead>
							<tbody>
							  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
							  	<tr role="row">
							  	 <td><?php echo $vo['position_id']; ?></td>
			                     <td><?php echo $vo['position_name']; ?></td>
			                     <td><?php echo $vo['ad_width']; ?></td>
			                     <td><?php echo $vo['ad_height']; ?></td>
			                     <td><?php echo $vo['position_desc']; ?></td>
			                     <td>
                                                 <img width="20" height="20" src="__PUBLIC__/images/<?php if($vo[is_open] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('ad_position','position_id','<?php echo $vo['position_id']; ?>','is_open',this)"/>                                                                
                                             </td>
			                     <td>
			                      <a class="btn btn-info" href="<?php echo U('Admin/Ad/adList',array('pid'=>$vo['position_id'])); ?>">查看广告</a>
			                      <a class="btn btn-primary" href="<?php echo U('Admin/Ad/position',array('act'=>'edit','position_id'=>$vo['position_id'])); ?>"><i class="fa fa-pencil"></i></a>
			                     
								</td>
			                   </tr>
			                  <?php endforeach; endif; else: echo "" ;endif; ?>
			                   </tbody>
			               </table>
		               </div>
		          </div>
		         	
	              <div class="row">
	              	    <div class="col-sm-6 text-left"></div>
	                    <div class="col-sm-6 text-right"><?php echo $page; ?></div>		
	              </div>
	          </div>
	        </div>
       	</div>
       </div>
   </section>
</div>
</body>
</html>