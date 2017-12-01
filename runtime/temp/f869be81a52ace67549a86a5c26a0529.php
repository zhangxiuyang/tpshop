<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:47:"./application/admin/view3/system\distribut.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
 


<link href="__PUBLIC__/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

<div class="wrapper">
    

    <section class="content">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
                <a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1021/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">           
                <div class="panel-body ">   
                   	<ul class="nav nav-tabs">
                        <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): if( count($group_list)==0 ) : echo "" ;else: foreach($group_list as $k=>$vo): ?>
                     		<li <?php if($k == 'distribut'): ?>class="active"<?php endif; ?>><a href="javascript:void(0)" data-url="<?php echo U('System/index',array('inc_type'=>$k)); ?>" data-toggle="tab" onclick="goset(this)"><?php echo $vo; ?></a></li>
                     	<?php endforeach; endif; else: echo "" ;endif; ?>                        
                    </ul>
                    <!--表单数据-->
                    <form method="post" id="handlepost" action="<?php echo U('System/handle'); ?>">                    
                        <!--通用信息-->
                    <div class="tab-content" style="padding:20px 0px;">                 	  
                        <div class="tab-pane active" id="tab_smtp">                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">分销开关：</td>
                                    <td class="col-sm-6">
                         				开:<input type="radio"  name="switch" value="1" <?php if($config['switch'] == 1): ?>checked="checked"<?php endif; ?> />
                         				关:<input type="radio"  name="switch" value="0" <?php if($config['switch'] == 0): ?>checked="checked"<?php endif; ?> />   
                                    </td>
                                    <td class="col-sm-7"></td>                                    
                                </tr>  
                                <tr>
                                    <td class="col-sm-2">成为分销商条件：</td>
                                    <td class="col-sm-6">
                         		<input type="radio"  name="condition" value="0" <?php if($config[condition] == 0): ?>checked="checked"<?php endif; ?> />
                                        直接成为分销商:
                                            &nbsp;&nbsp;&nbsp;<input type="radio"  name="condition" value="1" <?php if($config[condition] == 1): ?>checked="checked"<?php endif; ?> />   
                                        成功购买商品后成为分销商:
                                    </td>
                                    <td class="col-sm-7"></td>                                    
                                </tr>
                                <tr>
                                    <td class="col-sm-2">分销名称：</td>
                                    <td class="col-sm-6">
                         				<input type="text" class="form-control" name="name" value="<?php echo $config['name']; ?>" />
                                    </td>
                                    <td class="col-sm-7"></td>                                    
                                </tr>
                                <tr>
                                    <td>分销模式：</td>
                                    <td >
                                        <select class="form-control" name="pattern" id="distribut_pattern">
	                                       <option value="0" <?php if($config['pattern'] == 0): ?>selected="selected"<?php endif; ?>>按商品设置的分成金额</option>
	                                       <option value="1" <?php if($config['pattern'] == 1): ?>selected="selected"<?php endif; ?>>按订单设置的分成比例</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="distribut_order_rate" <?php if($config['pattern'] == 0): ?>style="display:none"<?php endif; ?>>
                                    <td class="col-sm-2">订单默认分成比例：</td>
                                    <td class="col-sm-3">
                         				<input type="text" class="form-control" name="order_rate" value="<?php echo $config['order_rate']; ?>" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')"/>                                        
                                    </td>
                                    <td class="col-sm-7">% 订单的百分之多少拿出来分成</td>
                                </tr>                                
                                <tr>
                                    <td>一级分销商名称：</td>
                                    <td >
                         				<input type="text" class="form-control" name="first_name" value="<?php echo $config['first_name']; ?>" >
                                    </td>
                                </tr>  
                                <tr>
                                    <td>一级分销商比例：</td>
                                    <td >
                         				<input type="text" class="form-control" name="first_rate" id="distribut_first_rate" value="<?php echo $config['first_rate']; ?>"onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" >
                                    </td>
                                    <td class="col-sm-7">%</td>                              
                                </tr>                                  
                            	<tr>
                                    <td>二级分销商名称：</td>
                                    <td >
                         				<input type="text" class="form-control" name="second_name" value="<?php echo $config['second_name']; ?>" >
                                    </td>
                                </tr>   
                                <tr>
                                    <td>二级分销商比例：</td>
                                    <td >
                         				<input type="text" class="form-control" name="second_rate" id="distribut_second_rate" value="<?php echo $config['second_rate']; ?>"onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" >
                                    </td>
                                    <td class="col-sm-7">%</td>                                    
                                </tr>                                   
                            	<tr>
                                    <td>三级分销商名称：</td>
                                    <td >
                         				<input type="text" class="form-control" name="third_name" value="<?php echo $config['third_name']; ?>" >
                                    </td>
                                </tr> 
                            	<tr>
                                    <td>三级分销商比例：</td>
                                    <td >
                         				<input type="text" class="form-control" name="third_rate" id="distribut_third_rate" value="<?php echo $config['third_rate']; ?>"onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" >
                                    </td>
                                    <td class="col-sm-7">%</td>                                    
                                </tr>
                            	<tr>
                                    <td>分成时间：</td>
                                    <td >
                                        <select class="form-control" name="date" id="distribut_date">
                                                <?php $__FOR_START_1129__=1;$__FOR_END_1129__=31;for($i=$__FOR_START_1129__;$i < $__FOR_END_1129__;$i+=1){ ?>          
                                                    <option value="<?php echo $i; ?>" <?php if($config[date] == $i): ?>selected="selected"<?php endif; ?>><?php echo $i; ?>天</option>
                                                <?php } ?>
                                        </select>
                                    </td>
                                    <td class="col-sm-7">订单收货确认后多少天可以分成</td>                                    
                                </tr>    
                                </tbody>
                                <tfoot>
                                	<tr>
                                	<td><input type="hidden" name="inc_type" value="<?php echo $inc_type; ?>"></td>
                                	<td class="text-right"><input class="btn btn-primary" type="button" onclick="adsubmit()" value="保存"></td></tr>
                                </tfoot>                               
                                </table>
                        </div>                           
                    </div>              
			    	</form><!--表单数据-->
                </div>
            </div>
        </div>
    </section>
</div>

<script>

$('#distribut_pattern').change(function(){
	 if($(this).val() == 1)
	    $('#distribut_order_rate').show();
	 else	
	    $('#distribut_order_rate').hide();	 
});

function adsubmit(){
	var distribut_first_rate  = $.trim($('#distribut_first_rate').val());
	var distribut_second_rate = $.trim($('#distribut_second_rate').val());
	var distribut_third_rate  = $.trim($('#distribut_third_rate').val());		
	
	var rate = parseInt(distribut_first_rate) + parseInt(distribut_second_rate) + parseInt(distribut_third_rate);
	if(rate > 100)
	{
		layer.msg('三个分销商比例总和不得超过100%', {icon: 2,time: 2000});//alert('少年，邮箱不能为空！');		
		// alert('三个分销商比例总和不得超过100%');
		return false;
	}
	
	$('#handlepost').submit();
}

$(document).ready(function(){
	get_province();
});

function goset(obj){
	window.location.href = $(obj).attr('data-url');
}
</script>
</body>
</html>