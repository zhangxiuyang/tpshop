<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view3/coupon\send_coupon.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510128324;}*/ ?>
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
              <form action="<?php echo U('Coupon/send_coupon'); ?>" id="search-form" class="navbar-form form-inline" method="post">
                <div class="form-group">
                  <select name="level_id" id="level_id" class="form-control">
                    <option value="0">所有会员</option>
                    <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$vo): ?>
                       <option value="<?php echo $vo['level_id']; ?>" <?php if($vo[level_id] == $level_id): ?>selected<?php endif; ?>> <?php echo $vo['level_name']; ?></option>
	 			    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <input type="hidden" name="cid" id="cid" value="<?php echo $cid; ?>">
                <button type="submit" id="button-filter" class="btn btn-info">确定发送优惠券</button>
              </form>
          </div>
          <div class="navbar navbar-default">
             <form action="" id="search-form2" class="navbar-form form-inline" method="post" onsubmit="return false">
               <div class="form-group">
                   <label class="control-label" for="input-mobile">手机号码</label>
                   <div class="input-group">
                       <input type="text" name="mobile" value="" placeholder="手机号码" id="input-mobile" class="form-control">
                   </div>
               </div>

               <div class="form-group">
                   <label class="control-label" for="input-email">email</label>
                   <div class="input-group">
                       <input type="text" name="email" value="" placeholder="email" id="input-email" class="form-control">                      
                   </div>
               </div>
               <div class="form-group">
                  <label class="control-label" for="input-order-id">昵称关键词</label>
                  <div class="input-group">
                    <input type="text" name="nickname" value="<?php echo $nickname; ?>" placeholder="搜索词" id="input-order-id" class="form-control">
                  </div>
                </div>
                <button type="button" onclick="ajax_get_table('search-form2',1)" id="button-filter search-order" class="btn btn-primary"><i class="fa fa-search"></i>查找</button>
              	<button type="button" onclick="doconfirm()" id="button-filter" class="btn btn-info pull-right">确定发送优惠券</button>	  
              </form>
          </div>
          <form method="post" action="" id="form-user">
           <input type="hidden" name="cid" id="cid" value="<?php echo $cid; ?>">
	          <div id="ajax_return"> 
		
	          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<script>
    $(document).ready(function(){
        ajax_get_table('search-form2',1);

    });

    // ajax 抓取页面
    function ajax_get_table(tab,page){
        cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type : "POST",
                url:"/index.php/Admin/Coupon/ajax_get_user/p/"+page,//+tab,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#ajax_return").html('');
                    $("#ajax_return").append(data);
                }
            });
    }

    function doconfirm(){
  	   if($("input[type='checkbox']:checked").length == 0)
 	   {
 		   layer.alert('请选择会员', {icon: 2}); //alert('请选择商品');
 		   return false;
 	   }else{
 		   $('#form-user').submit();
 	   }
     }
</script>
</div>
</body>
</html>