<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:45:"./application/admin/view3/wechat\setting.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
    <!-- Content Header (Page header) -->
  

    <section class="content" style="padding:0px 15px;">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body ">

                    <!--表单数据-->
                    <form method="post" id="handlepost" action="">
                        <!--通用信息-->
                        <div class="tab-content col-md-10">
                            <div class="tab-pane active" id="tab_tongyong">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>URL(服务器地址)：</td>
                                        <td >
                                            <input readonly type="text" class="form-control"  placeholder="请先以下信息保存后显示" value="<?php echo $apiurl; ?>" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Token：</td>
                                        <td >
                                            <input type="text" class="form-control" name="w_token" value="<?php echo $wechat['w_token']; ?>" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-2">公众号名称：</td>
                                        <td class="col-sm-8 ">
                                            <input type="text" class="form-control" name="wxname" value="<?php echo $wechat['wxname']; ?>" required />
                                            <span id="err_attr_name" style="color:#F00; display:none;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>公众号原始id：</td>
                                        <td >
                                            <input type="text" class="form-control" name="wxid" value="<?php echo $wechat['wxid']; ?>" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>微信号：</td>
                                        <td >
                                            <input type="text" class="form-control" name="weixin" value="<?php echo $wechat['weixin']; ?>" required />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>头像地址：</td>
                                        <td >
                                            <input type="text" id="headerpic" class="form-control" name="headerpic" value="<?php echo $wechat['headerpic']; ?>" required />
                                            <input onclick="GetUploadify(1,'headerpic','weixin');"  type="button" value="上传头像"/>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>AppID：</td>
                                        <td >
                                            <input type="text" class="form-control" name="appid" value="<?php echo $wechat['appid']; ?>" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>AppSecret：</td>
                                        <td >
                                            <input type="text" class="form-control" name="appsecret" value="<?php echo $wechat['appsecret']; ?>" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>二维码：</td>
                                        <td >
                                            <input type="text" class="form-control" id="qr" name="qr" value="<?php echo $wechat['qr']; ?>" required />
                                            <input onclick="GetUploadify(1,'qr','weixin');"  type="button" value="上传头像"/>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>微信号类型：</td>
                                        <td >
                                            <select name="type">
                                                <option <?php if($wechat['type'] == 1): ?>selected<?php endif; ?> value="1">订阅号</option>
                                                <option <?php if($wechat['type'] == 2): ?>selected<?php endif; ?> value="2">认证订阅号</option>
                                                <option <?php if($wechat['type'] == 3): ?>selected<?php endif; ?> value="3">服务号</option>
                                                <option <?php if($wechat['type'] == 4): ?>selected<?php endif; ?> value="4">认证服务号</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>微信接入状态：</td>
                                        <td >
                                            <input type="radio" name="wait_access" value="0" <?php if($wechat['wait_access'] == 0): ?>checked="checked"<?php endif; ?>/> 等待接入
                                            <input type="radio" name="wait_access" value="1" <?php if($wechat['wait_access'] == 1): ?>checked="checked"<?php endif; ?>/> 已接入
                                        </td>
                                    </tr>                                   
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><input type="hidden" name="id" value="<?php echo $wechat['id']; ?>"></td>
                                        <td class="text-right"><input class="btn btn-primary" type="submit" value="保存"></td></tr>
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
</body>
</html>