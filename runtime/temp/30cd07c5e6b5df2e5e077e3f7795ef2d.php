<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:47:"./application/admin/view3/article\category.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510128324;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">增加分类</h3>
                        </div>
                        <!-- /.box-header -->
                        <form action="<?php echo U('Article/categoryHandle'); ?>" method="post" class="form-horizontal">
                        <div class="box-body">                         
                                <div class="form-group">
                                    <label class="control-label col-sm-2">分类名称</label>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="名称" class="form-control" style="width:200px" name="cat_name" value="<?php echo $cat_info['cat_name']; ?>">
                                    </div>
                                    <div class="col-sm-4"><span class="help-inline text-warning">这将是该分类在站点上显示的名字。</span></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">上级分类</label>

                                    <div class="col-sm-8">
                                        <select class="small form-control"  style="width:200px" <?php if(in_array(($cat_info['cat_id']), is_array($article_system_id)?$article_system_id:explode(',',$article_system_id))): ?>disabled="disabled"<?php endif; ?>  tabindex="1" name="parent_id" id="parent_id">
                                            <option value="0">顶级分类</option>
                                            <?php echo $cat_select; ?>                                 
										</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">导航显示</label>
									
                                    <div class="col-sm-8">
                              			<label> <input type="radio" name="show_in_nav" <?php if($cat_info[show_in_nav] == 1): ?>checked<?php endif; ?> value="1"> 是</label>
                              			<label> <input type="radio" name="show_in_nav" <?php if($cat_info[show_in_nav] == 0): ?>checked<?php endif; ?> value="0"> 否</label>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="control-label col-sm-2">显示排序</label>

                                    <div class="col-sm-8">
                                        <input type="text" placeholder="50" class="form-control"  style="width:200px"  name="sort_order" value="<?php echo $cat_info['sort_order']; ?>">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="control-label col-sm-2">搜索关键字</label>

                                    <div class="col-sm-8">
                                        <input type="text" placeholder="关键字" class="form-control" style="width:400px"  name="keywords" value="<?php echo $cat_info['keywords']; ?>">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">搜索描述</label>
                                    <div class="col-sm-8">
                                        <input type="text" placeholder="描述" class="form-control" style="width:400px"  name="cat_desc" value="<?php echo $cat_info['cat_desc']; ?>">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                        </div>
                        <div class="box-footer">
                        	<input type="hidden" name="act" value="<?php echo $act; ?>">
                        	<input type="hidden" name="cat_id" value="<?php echo $cat_info['cat_id']; ?>">
                        	<button type="reset" class="btn btn-primary"><i class="icon-ok"></i>重填  </button>                       	                 
                            <button type="submit" class="btn btn-primary pull-right"><i class="icon-ok"></i>提交  </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
</div>
<script>

    <!-- 系统保留分类 start-->
    var article_top_system_id = <?php echo json_encode($article_top_system_id); ?>;
    $("#parent_id").change(function(){
        var v = parseInt($(this).val());
        if(jQuery.inArray(v, article_top_system_id) != -1){
            alert("系统保留分类，不允许在该分类添加新分类");
            $(this).val(0);
        }

    });
    <!-- 系统保留分类 end -->
</script>
</body>
</html>