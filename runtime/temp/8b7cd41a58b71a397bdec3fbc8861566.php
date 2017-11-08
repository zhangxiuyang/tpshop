<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./application/admin/view3/tc\brandList.html";i:1510113606;s:48:"./application/admin/view3/public\min-header.html";i:1509601837;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
    <script src="__PUBLIC__/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
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
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-list"></i> 品牌列表</h3>
        </div>
        <div class="panel-body">    
		<div class="navbar navbar-default">                    
                <form id="search-form2" class="navbar-form form-inline"  method="post" action="<?php echo U('/Admin/Tc/brandList'); ?>">
                <div class="form-group">
                  <label for="input-order-id" class="control-label">名称:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="input-order-id" placeholder="搜索词" value="<?php echo \think\Request::instance()->param('keyword'); ?>" name="keyword">
                  </div>
                </div>
                <div class="form-group">    
                    <button class="btn btn-primary" id="button-filter search-order" type="submit"><i class="fa fa-search"></i> 筛选</button>    
                </div>                
                <button type="button" class="btn btn-primary pull-right"  onclick="location.href='<?php echo U('Admin/Tc/addEditBrand'); ?>'">
                 <i class="fa fa-plus"></i> 添加品牌
                </button>                
                </form>    
          </div>
                        
          <div id="ajax_return"> 
                 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="sorting text-left">ID</th>
                                <th class="sorting text-left">品牌名称</th>
                                <th class="sorting text-left">Logo</th>
                                <th class="sorting text-left">排序</th>
                                <th class="sorting text-left">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($brandList) || $brandList instanceof \think\Collection || $brandList instanceof \think\Paginator): $i = 0; $__LIST__ = $brandList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td class="text-right"><?php echo $list['id']; ?></td>
                                    <td class="text-left"><?php echo $list['name']; ?></td>
                                    <td class="text-left">
                                        <img width="40" height="30" src="<?php echo $list['logo']; ?>"/>                                    </td>

                                    <td class="text-left">                                                                       <input type="text" onchange="updateSort('brand','id','<?php echo $list['id']; ?>','sort',this)" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')"  size="4"   value="<?php echo $list['sort']; ?>" class="input-sm" />
                                    </td>
                                    <td class="text-left">
                                        <a href="<?php echo U('Admin/Tc/addEditBrand',array('id'=>$list['id'],'p'=>\think\Request::instance()->param('p'))); ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0);" onclick="del('<?php echo $list[id]; ?>')" id="button-delete6" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                
                <div class="row">
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right"><?php echo $show; ?></div>
                </div>
          
          </div>
        </div>
      </div>
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 
 <script>
 // 删除操作
function del(id)
{
	if(!confirm('确定要删除吗?'))
		return false;		
		$.ajax({
			url:"/index.php?m=Admin&c=tc&a=delBrand&id="+id,
			success: function(v){	
                            var v =  eval('('+v+')');                                 
                            if(v.hasOwnProperty('status') && (v.status == 1))
                               location.href='<?php echo U('Admin/tc/brandList'); ?>';
                            else                                
								layer.msg(v.msg, {icon: 2,time: 1000}); //alert(v.msg);
			}
		}); 
	 return false;
}
 

//修改指定表的指定字段值
function changeBrandField(field,id,obj)
{
 
     var isshow = $(obj).data('isshow');
     if(isshow == 1)
     {
         $(obj).data('isshow','0');    
         var value = 0;
         $(obj).attr('src','__PUBLIC__/images/cancel.png');
         
     }else{
         $(obj).data('isshow','1');
         var value = 1;
         $(obj).attr('src','__PUBLIC__/images/yes.png');
     }    
     
     $.ajax({
             url:'/index.php?m=Admin&c=tc&a=changeBrandField&field='+field+'&id='+id+'&value='+value,
             success: function(data){					                                                                      
                     //  
             }
     });		
     
}
 </script>
</body>
</html>