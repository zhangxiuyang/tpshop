<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:51:"./application/admin/view3/article\categoryList.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510128324;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
       <div class="row">
       		<div class="col-xs-12">
	       		<div class="box">
	             <div class="box-header">
	             	<nav class="navbar navbar-default">	     
				        <div class="collapse navbar-collapse">
				        <form class="navbar-form form-inline" action="" method="post" id="catform">
				        	<div class="form-group">
								<button class="btn bg-navy" type="button" onclick="tree_open(this);"><i class="fa fa-angle-double-down"></i>展开</button>
				        	</div>
				           	<!--<div class="form-group">-->
				              	<!--<select name="cat_type" class="form-control" style="width:200px;" onchange="$('#catform').submit();">-->
				              		<!--<option value="">选择分组</option>-->
				           			<!--<option value="0">默认</option>-->
				           			<!--<option value="1">系统帮助</option>-->
				           			<!--<option value="2">系统公告</option>-->
				              	<!--</select>-->
				            <!--</div>-->
				            <div class="form-group pull-right">
					            <a href="<?php echo U('Article/category'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>新增分类</a>
				            </div>		          
				          </form>
				      	</div>
	    			</nav> 	               
	             </div><!-- /.box-header -->
	           <div class="box-body">
	           <div class="row">
	            <div class="col-sm-12">
	              <table id="list-table" class="table table-bordered table-striped">
	                 <thead>
	                   <tr role="row">
		                   <th  style="width: 350px;">分类名称</th>
		                   <!--<th>所属分组</th>-->
		                   <th>描述</th>
		                   <th>是否显示</th>
		                   <th>排序</th>
		                   <th>操作</th>
	                   </tr>
	                 </thead>
					<tbody>
					  <?php if(is_array($cat_list) || $cat_list instanceof \think\Collection || $cat_list instanceof \think\Paginator): if( count($cat_list)==0 ) : echo "" ;else: foreach($cat_list as $k=>$vo): ?>
					  	<tr role="row" align="center" class="<?php echo $vo['level']; ?>" id="<?php echo $vo['level']; ?>_<?php echo $vo['cat_id']; ?>">
	                     <td class="sorting_1" align="left" style="padding-left:<?php echo ($vo[level] * 4); ?>em"> 
	                      <?php if($vo['is_leaf'] != 1): ?>
		                      <span class="glyphicon glyphicon-minus btn-warning"  id="icon_<?php echo $vo['level']; ?>_<?php echo $vo['id']; ?>" aria-hidden="true" onclick="rowClicked(this)" ></span>&nbsp;				    
					      <?php endif; ?><span><?php echo $vo['name']; ?></span>
					     </td>					     
					     <!--<td><?php echo $type_arr[$vo[cat_type]]; ?></td>-->
					     <td><?php echo $vo['cat_desc']; ?></td>
	                     <td>
                             <?php if($vo[show_in_nav] == 1): ?> 显示    
                             <?php else: ?> 隐藏<?php endif; ?>
                         </td>
	                 	<td>                         
                            <input type="text"  class="input-sm" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onchange="updateSort('article_cat','cat_id','<?php echo $vo['cat_id']; ?>','sort_order',this)" size="4" value="<?php echo $vo['sort_order']; ?>" />
                         </td>
	                     <td>
	                      <a class="btn btn-primary" href="<?php echo U('Article/category',array('act'=>'edit','cat_id'=>$vo['cat_id'])); ?>"><i class="fa fa-pencil"></i></a>
							 <?php if(in_array(($vo['id']), is_array($article_system_id)?$article_system_id:explode(',',$article_system_id))): ?>
							  <a class="btn btn-default disabled" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a>
							 <?php endif; if(!in_array(($vo['id']), is_array($article_system_id)?$article_system_id:explode(',',$article_system_id))): ?>
								 <a class="btn btn-danger" href="javascript:void(0)" data-url="<?php echo U('Article/categoryHandle'); ?>" data-id="<?php echo $vo['cat_id']; ?>" onclick="delfun(this)"><i class="fa fa-trash-o"></i></a>
							 <?php endif; ?>
						</td>
	                   </tr>
	                  <?php endforeach; endif; else: echo "" ;endif; ?>
	                   </tbody>
	               </table></div></div>
		               <div class="row">
			               <div class="col-sm-5">
			               <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">分页</div></div>                                   
		               </div>
	             </div><!-- /.box-body -->
	           </div><!-- /.box -->
       		</div>
       </div>
     </section>
</div>
<script type="text/javascript">
	function  tree_open(obj)
	{
		var tree = $('#list-table tr[id^="1_"],#list-table tr[id^="2_"], #list-table tr[id^="3_"] '); //,'table-row'
		if(tree.css('display')  == 'table-row')
		{
			$(obj).html("<i class='fa fa-angle-double-down'></i>展开");
			tree.css('display','none');
			$("span[id^='icon_']").removeClass('glyphicon-minus');
			$("span[id^='icon_']").addClass('glyphicon-plus');
		}else
		{
			$(obj).html("<i class='fa fa-angle-double-up'></i>收缩");
			tree.css('display','table-row');
			$("span[id^='icon_']").addClass('glyphicon-minus');
			$("span[id^='icon_']").removeClass('glyphicon-plus');
		}
	}
     
// 以下是 bootstrap 自带的  js
function rowClicked(obj)
{
  span = obj;

  obj = obj.parentNode.parentNode;

  var tbl = document.getElementById("list-table");

  var lvl = parseInt(obj.className);

  var fnd = false;
  
  var sub_display = $(span).hasClass('glyphicon-minus') ? 'none' : '' ? 'block' : 'table-row' ;
  //console.log(sub_display);
  if(sub_display == 'none'){
	  $(span).removeClass('glyphicon-minus btn-info');
	  $(span).addClass('glyphicon-plus btn-warning');
  }else{
	  $(span).removeClass('glyphicon-plus btn-info');
	  $(span).addClass('glyphicon-minus btn-warning');
  }

  for (i = 0; i < tbl.rows.length; i++)
  {
      var row = tbl.rows[i];
      
      if (row == obj)
      {
          fnd = true;         
      }
      else
      {
          if (fnd == true)
          {
              var cur = parseInt(row.className);
              var icon = 'icon_' + row.id;
              if (cur > lvl)
              {
                  row.style.display = sub_display;
                  if (sub_display != 'none')
                  {
                      var iconimg = document.getElementById(icon);
                      $(iconimg).removeClass('glyphicon-plus btn-info');
                      $(iconimg).addClass('glyphicon-minus btn-warning');
                  }else{               	    
                      $(iconimg).removeClass('glyphicon-minus btn-info');
                      $(iconimg).addClass('glyphicon-plus btn-warning');
                  }
              }
              else
              {
                  fnd = false;
                  break;
              }
          }
      }
  }

  for (i = 0; i < obj.cells[0].childNodes.length; i++)
  {
      var imgObj = obj.cells[0].childNodes[i];
      if (imgObj.tagName == "IMG")
      {
          if($(imgObj).hasClass('glyphicon-plus btn-info')){
        	  $(imgObj).removeClass('glyphicon-plus btn-info');
        	  $(imgObj).addClass('glyphicon-minus btn-warning');
          }else{
        	  $(imgObj).removeClass('glyphicon-minus btn-warning');
        	  $(imgObj).addClass('glyphicon-plus btn-info');
          }
      }
  }

}

function delfun(obj){
	if(confirm('确认删除')){		
		$.ajax({
			type : 'post',
			url : $(obj).attr('data-url'),
			data : {act:'del',cat_id:$(obj).attr('data-id')},
			dataType : 'json',
			success : function(data){
				if(data==1){
					$(obj).parent().parent().remove();
				}else{
					layer.alert(data, {icon: 2});  //alert(data);
				}
			}
		})
	}
	return false;
}
</script>
</body>
</html>