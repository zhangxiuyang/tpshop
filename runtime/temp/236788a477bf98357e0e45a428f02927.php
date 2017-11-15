<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./application/admin/view3/index\index.html";i:1503927232;s:44:"./application/admin/view3/public\header.html";i:1509601701;s:42:"./application/admin/view3/public\left.html";i:1509608386;s:44:"./application/admin/view3/public\footer.html";i:1509600710;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap 3.3.4 -->
    <link href="__PUBLIC__/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="__PUBLIC__/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="__PUBLIC__/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="__PUBLIC__/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" /> 
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->   
    <!-- jQuery 2.1.4 -->
    <script src="__PUBLIC__/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/upgrade.js"></script>
	<script src="__PUBLIC__/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/--> 
    <style type="text/css">
    	#riframe{min-height:inherit !important}
    </style>
  </head>
<body class="skin-green-light sidebar-mini" style="overflow-y:hidden;">
<div class="wrapper">
  <header class="main-header">
      <!-- Logo -->
      <a href="/index.php/Admin/Index/index" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <b>DZLJ</b>
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>


        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
           <li>
               <a target="rightContent" href="<?php echo U('/Admin/System/cleanCache'); ?>">
                   <i class="glyphicon glyphicon glyphicon-refresh"></i>
                   <span>清除缓存</span>
               </a>
           </li>      
           <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!--  <img src="__PUBLIC__/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                <i class="glyphicon glyphicon-user"></i>
                <span class="hidden-xs">欢迎：<?php echo $admin_info['user_name']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <div class="pull-left">
                  	<a href="<?php echo U('Index/index'); ?>" data-url="" class="btn btn-default btn-flat model-map">后台首页</a>
                   	<a href="<?php echo U('Admin/admin_info',array('admin_id'=>$admin_info['admin_id'])); ?>" target="rightContent" class="btn btn-default btn-flat">修改密码</a>
                   	<a href="<?php echo U('Admin/logout'); ?>" class="btn btn-default btn-flat">安全退出</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-street-view"></i>换肤</a></li>
          </ul>
        </div>
     </nav>
</header> 

<aside class="main-sidebar" style="overflow-y:auto;">
      <section class="sidebar">
        <ul class="sidebar-menu"> 
	      <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $k=>$vo): if(!(empty($vo['sub_menu']) || (($vo['sub_menu'] instanceof \think\Collection || $vo['sub_menu'] instanceof \think\Paginator ) && $vo['sub_menu']->isEmpty()))): ?>
        	<li class="treeview">
        	    <a href="javascript:void(0)">
	              <i class="fa <?php echo $vo['icon']; ?>"></i><span><?php echo $vo['name']; ?></span><i class="fa fa-angle-left pull-right"></i>
	            </a>
	            <ul class="treeview-menu">
	            	<?php if(is_array($vo['sub_menu']) || $vo['sub_menu'] instanceof \think\Collection || $vo['sub_menu'] instanceof \think\Paginator): if( count($vo['sub_menu'])==0 ) : echo "" ;else: foreach($vo['sub_menu'] as $kk=>$vv): ?>
	            	<li onclick="makecss(this)" data-id="<?php echo $vv['act']; ?>_<?php echo $vv['control']; ?>">
	            		<a href='<?php echo U("$vv[control]/$vv[act]"); ?>' target='rightContent'><i class="fa fa-circle-o"></i><?php echo $vv['name']; ?></a>
	            	</li>
	            	<?php endforeach; endif; else: echo "" ;endif; ?>
	            </ul>
        	</li>
        	<?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </section>
</aside>

<section class="content-wrapper right-side" id="riframe" style="margin:0px;padding:0px;margin-left:230px;">
    <iframe id='rightContent' name='rightContent' src="<?php echo U('Admin/Index/welcome'); ?>" width='100%' frameborder="0"></iframe>
</section>

	<footer class="main-footer">
	</footer>

     <!-- Control Sidebar -->
     <aside class="control-sidebar control-sidebar-dark">
       <!-- Create the tabs -->
       <!--
       <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
         <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-at"></i></a></li>
         <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
       </ul>
       -->
       <!-- Tab panes -->
       <div class="tab-content">
      	<!-- Home tab content -->
         <div class="tab-pane" id="control-sidebar-home-tab">
         </div><!-- /.tab-pane -->
         <!-- Stats tab content -->
         <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
         <!-- Settings tab content -->
         <div class="tab-pane" id="control-sidebar-settings-tab">
         </div>
       </div>
     </aside>
   <div class="control-sidebar-bg"></div>
</div>

<script src="__PUBLIC__/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/dist/js/app.js" type="text/javascript"></script>
<script src="__PUBLIC__/dist/js/demo.js" type="text/javascript"></script>
 
<script type="text/javascript">
$(document).ready(function(){
	$("#riframe").height($(window).height()-100);//浏览器当前窗口可视区域高度
	$("#rightContent").height($(window).height()-100);
	$('.main-sidebar').height($(window).height()-50);
});

var tmpmenu = 'index_Index';
function makecss(obj){
	$('li[data-id="'+tmpmenu+'"]').removeClass('active');
	$(obj).addClass('active');
	tmpmenu = $(obj).attr('data-id');
}

function callUrl(url){
	layer.closeAll('iframe');
	rightContent.location.href = url;
}
    var now_num = 0; //现在的数量
    var is_close=0;
    function ajaxOrderNotice(){
        var url = '<?php echo U("Order/ajaxOrderNotice"); ?>';
        if(is_close > 0) return;
        $.get(url,function(data){
            //有新订单且数量不跟上次相等 弹出提示
            if(data > 0 && data != now_num){
                now_num = data;
                if(document.getElementById('ordfoo').style.display == 'none'){
                    $('#orderAmount').text(data);
                    $('#ordfoo').show();
                }
            }
        })
//        setTimeout('ajaxOrderNotice()',5000);
    }
//setTimeout('ajaxOrderNotice()',5000);
</script>
</body>
</html>