<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./application/admin/view3/plugin\index.html";i:1509609140;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
	


    <!-- Main content -->
    <section class="content">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i>插件列表</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a id="tab_plugin_payment" href="#tab_pay" data-toggle="tab">支付插件</a></li>
                        <!--                        <li><a href="#tab_goods_desc" data-toggle="tab">描述信息</a></li>-->
                        <li><a id="tab_plugin_login" href="#tab_login" data-toggle="tab">登录插件</a></li>
                        <li><a id="tab_plugin_shipping" href="#tab_shipping" data-toggle="tab">物流插件</a></li>
                    </ul>
                    <!--表单数据-->
                    <form method="post" id="addEditGoodsForm">

                        <div class="tab-content">
                            <!--支付插件-->
                            <div class="tab-pane active" id="tab_pay">
                                <div class="row">
                                    <?php if(is_array($payment) || $payment instanceof \think\Collection || $payment instanceof \think\Paginator): $i = 0; $__LIST__ = $payment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                                        <div class="col-sm-2">
                                            <div class="thumbnail">
                                                <img  style="width:150px; height:60px;" src="/plugins/payment/<?php echo $p['code']; ?>/<?php echo $p['icon']; ?>" alt="...">
                                                <div class="caption">
                                                    <h4><?php echo $p['name']; ?></h4>
                                                    <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $p['desc']; ?></p>
                                                    <?php if($p['status'] == 0): ?>
                                                        <p><a onclick="installPlugin('<?php echo $p['type']; ?>','<?php echo $p['code']; ?>',1)" href="#" class="btn btn-primary" role="button">一键安装</a> </p>
                                                        <?php else: ?>
                                                        <p><a onclick="installPlugin('<?php echo $p['type']; ?>','<?php echo $p['code']; ?>',0)" href="#" class="btn btn-danger" role="button">卸载</a>
                                                            <a href="<?php echo U('Admin/Plugin/setting',array('type'=>$p['type'],'code'=>$p['code'])); ?>" class="btn btn-primary" role="button">配置</a>
                                                        </p>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>


                                </div>
                            </div>
                            <!--支付插件-->

                            <!-- 登录插件-->
                            <div class="tab-pane" id="tab_login">
                                <div class="row">
                                    <?php if(is_array($login) || $login instanceof \think\Collection || $login instanceof \think\Paginator): $i = 0; $__LIST__ = $login;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
                                        <div class="col-sm-2">
                                            <div class="thumbnail">
                                                <img style="width:150px; height:60px;" src="/plugins/login/<?php echo $l['code']; ?>/<?php echo $l['icon']; ?>">
                                                <div class="caption">
                                                    <h4><?php echo $l['name']; ?></h4>
                                                    <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $l['desc']; ?></p>
                                                    <?php if($l['status'] == 0): ?>
                                                        <p><a onclick="installPlugin('<?php echo $l['type']; ?>','<?php echo $l['code']; ?>',1)" href="#" class="btn btn-primary" role="button">一键安装</a> </p>
                                                        <?php else: ?>
                                                        <p><a onclick="installPlugin('<?php echo $l['type']; ?>','<?php echo $l['code']; ?>',0)" href="#" class="btn btn-danger" role="button">卸载</a> <a href="<?php echo U('Admin/Plugin/setting',array('type'=>$l['type'],'code'=>$l['code'])); ?>" class="btn btn-primary" role="button">配置</a></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <!--登录插件-->
                            <!-- 物流插件-->
                            <div class="tab-pane" id="tab_shipping">
                                <div class="row">
                                    <?php if(is_array($shipping) || $shipping instanceof \think\Collection || $shipping instanceof \think\Paginator): $i = 0; $__LIST__ = $shipping;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
                                        <div class="col-sm-2"  style="width:260px;">
                                            <div class="thumbnail">
                                                <img style="width:150px; height:60px;" src="/plugins/shipping/<?php echo $l['code']; ?>/<?php echo $l['icon']; ?>">
                                                <div class="caption">
                                                    <h4><?php echo $l['name']; ?></h4>
                                                    <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $l['desc']; ?></p>
                                                    <?php if($l['status'] == 0): ?>
                                                        <p>
                                                            <a onclick="installPlugin('<?php echo $l['type']; ?>','<?php echo $l['code']; ?>',1)" href="#" class="btn btn-primary" role="button">一键安装</a>
                                                            <a onclick="if(confirm('确定要删除吗?')) del_shipping('<?php echo $l['code']; ?>');" href="#" class="btn btn-danger" role="button"><i class="fa fa-trash-o"></i></a>
                                                        </p>
                                                        <?php else: ?>
                                                        <p>
                                                            <a onclick="installPlugin('<?php echo $l['type']; ?>','<?php echo $l['code']; ?>',0)" href="#" class="btn btn-danger" role="button">卸载</a>
                                                            <a href="<?php echo U('Admin/Plugin/shipping_list',array('type'=>'shipping','code'=>$l['code'])); ?>" class="btn btn-primary" role="button">配置</a>
                                                            <a href="<?php echo U('Admin/Plugin/shipping_print',array('type'=>'shipping','code'=>$l['code'])); ?>" class="btn btn-primary" role="button">模板编辑</a>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <div style="width:260px;" class="col-sm-2">
                                        <div class="thumbnail" style="height:203px;">
                                            <img src="__PUBLIC__/images/wuliu.png" style="width:150px; height:100px;">
                                            <div class="caption">
                                                <p></p>
                                                <p></p>
                                                <p align="center">
                                                    <a class="btn btn-primary" href="/index.php/Admin/Plugin/add_shipping">添加物流</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 物流插件-->
                            <!-- 功能插件-->
                            <div class="tab-pane" id="tab_function">
                            <div class="row">
                                    <?php if(is_array($function) || $function instanceof \think\Collection || $function instanceof \think\Paginator): $i = 0; $__LIST__ = $function;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
                                        <div class="col-sm-2"  style="width:260px;">
                                            <div class="thumbnail">
                                                <img style="width:150px; height:60px;" src="/plugins/function/<?php echo $l['code']; ?>/<?php echo $l['icon']; ?>">
                                                <div class="caption">
                                                    <h4><?php echo $l['name']; ?></h4>
                                                    <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $l['desc']; ?></p>
                                                    <?php if($l['status'] == 0): ?>
                                                        <p><a onclick="installPlugin('<?php echo $l['type']; ?>','<?php echo $l['code']; ?>',1)" href="#" class="btn btn-primary" role="button">一键安装</a> </p>
                                                        <?php else: ?>
                                                        <p>
                                                            <a onclick="installPlugin('<?php echo $l['type']; ?>','<?php echo $l['code']; ?>',0)" href="#" class="btn btn-danger" role="button">卸载</a>                                                                                                                        
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <!-- 功能插件-->

                            <!-- 云插件-->
                            <div class="tab-pane" id="tab_cloud">
                                <table class="table table-bordered" id="goods_attr_table">
                                    <tr>
                                        <td>暂无:</td>
                                        <td>
                                            暂无
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- 云插件-->
                        </div>

                    </form><!--表单数据-->
                </div>
            </div>
        </div>    <!-- /.content -->
    </section>
    <!-- /.content -->
</div>
<script>
    $(document).ready(function(){
        var type = "<?php echo $type; ?>";
        if(type !== ''){
            $('#tab_plugin_'+type).trigger('click');
        }
    });

    // 删除物流
    function del_shipping(code)
    {
        $.ajax({
            type : "POST",
            url:"<?php echo U('Admin/Plugin/del_shipping'); ?>",//+tab,
            dataType: "json",
            data : {code:code},
            success: function(data){
                layer.alert(data.msg, {icon: 2} ,function(index){
                    layer.close(index);
                    //location.href = location.href;
                    location.reload();
                });

            }
        });
    }

    //插件安装(卸载)
    function installPlugin(type,code,type2){

        var url = '/index.php?m=Admin&c=Plugin&a=install&type='+type+'&code='+code+'&install='+type2;

        $.get(url,function(data){
            var obj = JSON.parse(data);
            alert(obj.msg);
            //layer.alert(obj.msg, {icon: 2});  
            if(obj.status == 1){
                window.location.href='/index.php?m=Admin&c=Plugin&a=index&type='+type;
            }
        })
    }

</script>
</body>
</html>