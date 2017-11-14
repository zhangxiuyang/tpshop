<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:40:"./application/admin/view2/ad\adList.html";i:1503927232;s:44:"./application/admin/view2/public\layout.html";i:1503927232;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
<script src="__PUBLIC__/js/myFormValidate.js"></script>
<script src="__PUBLIC__/js/myAjax2.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
						layer.closeAll();
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().parent().remove();
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
    
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['70%', '80%'],
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>广告列表</h3>
        <h5>广告索引与管理</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
    <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span title="收起提示" id="explanationZoom" style="display: block;"></span>
    </div>
    <ul>
      <li>只需要点击半透明广告图片即可更换广告.</li>
      <li>预览广告所在页面中选择更换你的广告</li>      
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>广告列表</h3>
        <h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>	   
	  <form class="navbar-form form-inline" action="<?php echo U('Ad/adList'); ?>" method="post">
      <div class="sDiv">             
        <div class="sDiv2">
         <select name="pid" class="form-control">
              <option value="0">==查看所有==</option>
              <?php if(is_array($ad_position_list) || $ad_position_list instanceof \think\Collection || $ad_position_list instanceof \think\Paginator): $k = 0; $__LIST__ = $ad_position_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?>
                <option value="<?php echo $item['position_id']; ?>"><?php echo $item['position_name']; ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>                  
         </select>
         <input type="text" name="keywords" class="qsbox" placeholder="请输入广告名称">         
         <input type="submit" class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox">
        <table cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="sign" axis="col0">
                <div style="width: 24px;"><i class="ico-check"></i></div>
              </th>
              <th align="left" abbr="article_title" axis="col3" class="">
                <div style="text-align: left; width: 50px;" class="">广告id</div>
              </th>
              <th align="left" abbr="ac_id" axis="col4" class="">
                <div style="text-align: left; width: 200px;" class="">广告位置</div>
              </th>
              <th align="center" abbr="article_show" axis="col5" class="">
                <div style="text-align: center; width: 100px;" class="">广告名称</div>
              </th>
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 100px;" class="">广告图片</div>
              </th>     
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 100px;" class="">广告链接</div>
              </th>     
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 50px;" class="">新窗口</div>
              </th>
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 50px;" class="">显示</div>
              </th>
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 50px;" class="">排序</div>
              </th>              
              <th align="center" axis="col1" class="handle">
                <div style="text-align: center; width: 100px;">操作</div>
              </th>
              <th style="width:100%" axis="col7">
                <div></div>
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="tDiv">
      <div class="tDiv2">
        <div class="fbutton"><a href="<?php echo U('Ad/ad'); ?>"><div class="add" title="新增广告"><span><i class="fa fa-plus"></i>新增广告</span></div></a></div>
          <div class="fbutton"><a href="<?php echo U('admin/ad/editAd',array('request_url'=>urlencode('home/user/login'))); ?>"><div class="add" title="登录页"><span><i class="fa fa-search"></i>登录页</span></div></a></div>
          <div class="fbutton"><a href="<?php echo U('admin/ad/editAd',array('request_url'=>urlencode('home/index/index'))); ?>"><div class="add" title="首页"><span><i class="fa fa-search"></i>首页</span></div></a></div>
        <div class="fbutton"><a href="<?php echo U('admin/ad/editAd',array('request_url'=>urlencode('mobile/index/index'))); ?>"><div class="add" title="手机首页"><span><i class="fa fa-search"></i>手机首页</span></div></a></div>
        <div class="fbutton"><a href="<?php echo U('admin/ad/editAd',array('request_url'=>urlencode('mobile/goods/categoryList'))); ?>"><div class="add" title="手机分类页"><span><i class="fa fa-search"></i>手机分类页</span></div></a></div>        
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
        <table>
          <tbody>
            <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
              <tr>
                <td class="no-data" align="center" axis="col0" colspan="50">
                  <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                </td>
              </tr>
              <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                <tr>
                  <td class="sign">
                    <div style="width: 24px;"><i class="ico-check"></i></div>
                  </td>
                  <td align="left" class="">
                    <div style="text-align: left; width: 50px;"><?php echo $vo[ad_id]; ?></div>
                  </td>
                  <td align="left" class="">
                    <div style="text-align: left; width: 200px;"><?php echo $ad_position_list[$vo[pid]][position_name]; ?></div>
                  </td>
                  <td align="left" class="">
                    <div style="text-align: left; width: 100px;"><?php echo $vo['ad_name']; ?></div>
                  </td>
                  <td align="center" class="">
                    <div style="text-align: center; width: 100px;"><img src="<?php echo $vo['ad_code']; ?>" width="80px" height="45px"></div>
                  </td>
                  <td align="center" class="">
                    <div style="text-align: center; width: 100px;">
                      <?php if($vo[target] == 1): ?>
                        <span class="yes" onClick="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','target',this)"><i class="fa fa-check-circle"></i>是</span>
                        <?php else: ?>
                        <span class="no" onClick="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','target',this)"><i class="fa fa-ban"></i>否</span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td align="center" class="">
                    <div style="text-align: center; width: 100px;">
                      <?php if($vo[enabled] == 1): ?>
                        <span class="yes" onClick="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','enabled',this)"><i class="fa fa-check-circle"></i>是</span>
                        <?php else: ?>
                        <span class="no" onClick="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','enabled',this)"><i class="fa fa-ban"></i>否</span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td align="center">
                    <div style="text-align: center; width: 100px;">
                      <input type="text" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')"
                             onblur="changeTableVal('ad','ad_id','<?php echo $vo['ad_id']; ?>','orderby',this)" size="4" value="<?php echo $vo['orderby']; ?>"/>
                    </div>
                  </td>
                  <td align="center" class="handle">
                    <div style="text-align: center; width: 100px;">
                      <a class="btn red" onClick="delfunc(this)" data-url="<?php echo U('Ad/adHandle'); ?>" data-id="<?php echo $vo['ad_id']; ?>"><i class="fa fa-trash-o"></i>删除</a>
                      <a href="<?php echo U('Ad/ad',array('act'=>'edit','ad_id'=>$vo['ad_id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                    </div>
                  </td>
                  <td align="" class="" style="width: 100%;">
                    <div>&nbsp;</div>
                  </td>
                </tr>
              <?php endforeach; endif; else: echo "" ;endif; endif; ?>
          </tbody>
        </table>
	 <!--分页位置--> 
    <?php echo $pager->show(); ?> </div>        
      </div>       
    </div>    
</div>
<script>	
    $(document).ready(function(){	
	    // 表格行点击选中切换
	    $('#flexigrid > table>tbody >tr').click(function(){
		    $(this).toggleClass('trSelected');
		});
		
		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});
		
	});
    function delfunc(obj){
      layer.confirm('确认删除？', {
                btn: ['确定','取消'] //按钮
              }, function(){
                // 确定
                $.ajax({
                  type : 'post',
                  url : $(obj).attr('data-url'),
                  data : {act:'del',del_id:$(obj).attr('data-id')},
                  dataType : 'json',
                  success : function(data){
                    layer.closeAll();
                    if(data.status==1){
                      layer.msg(data.msg, {icon: 1});
                      $(obj).parent().parent().parent('tr').remove();
                    }else{
                      layer.msg(data.msg, {icon: 2,time: 2000});
                    }
//   						layer.closeAll();
                  }
                })
              }, function(index){
                layer.close('网络连接失败，请稍后再试！');
              }
      );
    }
</script>
</body>
</html>