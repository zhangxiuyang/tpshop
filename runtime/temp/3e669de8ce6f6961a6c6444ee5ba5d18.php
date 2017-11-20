<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"./application/admin/view3/promotion\prom_goods_info.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
 

<script type="text/javascript">
    window.UEDITOR_Admin_URL = "__ROOT__/public/plugins/Ueditor/";
    var URL_upload = "<?php echo $URL_upload; ?>";
    var URL_fileUp = "<?php echo $URL_fileUp; ?>";
    var URL_scrawlUp = "<?php echo $URL_scrawlUp; ?>";
    var URL_getRemoteImage = "<?php echo $URL_getRemoteImage; ?>";
    var URL_imageManager = "<?php echo $URL_imageManager; ?>";
    var URL_imageUp = "<?php echo $URL_imageUp; ?>";
    var URL_getMovie = "<?php echo $URL_getMovie; ?>";
    var URL_home = "<?php echo $URL_home; ?>";    
</script>
<script type="text/javascript" src="__ROOT__/public/plugins/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/public/plugins/Ueditor/ueditor.all.js"></script>
<link href="__PUBLIC__/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<div class="wrapper">
    

    <section class="content ">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            	<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1015/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 编辑商品促销活动  </h3>
                </div>
                <div class="panel-body ">   
                    <!--表单数据-->
                    <form method="post" id="promotion" action="<?php echo U('Admin/Promotion/prom_goods_save'); ?>">                    
                        <!--通用信息-->
                    <div class="tab-content col-md-10">                 	  
                        <div class="tab-pane active" id="tab_tongyong">                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">促销活动名称：</td>
                                    <td class="col-sm-8">
                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $info['name']; ?>" >
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-2">促销活动类型：</td>
                                    <td class="col-xs-8">
	                      				 <select id="prom_type" name="type" class="form-control" style="witdh:150px;">
								            <option value="0" <?php if($info[type] == 0): ?>selected<?php endif; ?>>直接打折</option>
								            <option value="1" <?php if($info[type] == 1): ?>selected<?php endif; ?>>减价优惠</option>
								            <option value="2" <?php if($info[type] == 2): ?>selected<?php endif; ?>>固定金额出售</option>
								            <option value="3" <?php if($info[type] == 3): ?>selected<?php endif; ?>>买就赠代金券</option>
								          </select>
                                    </td>
                                </tr>
                                <tr id="expression">
                                	<td class="col-sm-2">折扣：</td>
                                	<td><input type="text" name="expression"  value="<?php echo $info['expression']; ?>" class="" style="witdh:150px"><label>% 折扣值(1-100 如果打9折，请输入90)</label> </td>
                                </tr>
                                <tr>
                                    <td>开始时间：</td>
                                    <td>
                               			<input type="text" class="form-control" id="start_time" name="start_time" value="<?php echo $info['start_time']; ?>">
                                    </td>
                                  
                                </tr>                                
                                <tr>
                                    <td>结束时间：</td>
                                    <td>
                      					<input type="text" class="form-control" id="end_time" name="end_time" value="<?php echo $info['end_time']; ?>">   
                                    </td>
                                </tr>
                                <tr>
                                    <td>适合用户范围：</td>
                                    <td>
                                    	<?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$vo): ?>
                      						<input type="checkbox" <?php if(strripos($info['group'],$vo['level_id'].'') !== false): ?>checked<?php endif; ?> name="group[]" value="<?php echo $vo['level_id']; ?>"><?php echo $vo['level_name']; endforeach; endif; else: echo "" ;endif; ?>
                                    </td>        
                                </tr>   
                                <tr>
                                    <td>选择商品:</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-xs-2">                                        
	                                            <a class="btn btn-primary" href="javascript:void(0);" onclick="selectGoods()" ><i class="fa fa-search"></i>添加商品</a>
                                            </div>                                                            
                                            <div class="col-xs-2">
                                                <span id="err_goods" style="color:#F00; display:none;">请添加下单商品</span>
                                            </div>                                            
                                        </div>                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"> 
                                       <div class="form-group">
                                       		<table class="table table-bordered">
                                       			<thead>
                                       			<tr>
                                       				<th style="display:none">选择</th>
									                <th class="text-left">商品名称</th>
									                <th class="text-left">价格</th>         
									                <th class="text-left">库存</th>								                
									                <th class="text-left">操作</th>
									            </tr>
									            </thead>
									            <tbody id="goods_list">
									            <?php if(is_array($prom_goods) || $prom_goods instanceof \think\Collection || $prom_goods instanceof \think\Paginator): if( count($prom_goods)==0 ) : echo "" ;else: foreach($prom_goods as $key=>$vo): ?>
									            	<tr>
									            		<td style="display:none"><input type="checkbox" name="goods_id[]" checked="checked" value="<?php echo $vo['goods_id']; ?>"/></td>
									                	<td class="text-left"><?php echo $vo['goods_name']; ?></td>            
									                	<td class="text-left"><?php echo $vo['shop_price']; ?></td>
									                	<td class="text-left"><?php echo $vo['store_count']; ?></td>
									                	<td class="text-left"><a href="javascript:void(0)" onclick="javascript:$(this).parent().parent().remove();">删除</a></td>
									           		</tr>
									           <?php endforeach; endif; else: echo "" ;endif; ?>
									           </tbody>
                                       		</table>
                                         </div>                                                                               
                                    </td>
                                </tr> 
			                    <tr>
				                    <td class="col-sm-2">活动描述：</td>
				                    <td class="col-sm-8">
							        <textarea class="span12 ckeditor" id="post_content" name="description" title="">
							            <?php echo $info['description']; ?>
							        </textarea>
				                    </td>
			                    </tr>       
                                </tbody> 
                                <tfoot>
                                	<tr>
                                	<td><input class="btn btn-default" type="reset" value="重置">
                                		<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                                	</td>
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

	var editor;
    $(function () {
        //具体参数配置在  editor_config.js 中
        var options = {
            zIndex: 999,
            initialFrameWidth: "100%", //初化宽度
            initialFrameHeight: 350, //初化高度
            focus: false, //初始化时，是否让编辑器获得焦点true或false
            maximumWords: 99999, removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign',//允许的最大字符数 'fullscreen',
            pasteplain: true, autoHeightEnabled: true,
            autotypeset: {
                mergeEmptyline: true,        //合并空行
                removeClass: true,           //去掉冗余的class
                removeEmptyline: false,      //去掉空行
                textAlign: "left",           //段落的排版方式，可以是 left,right,center,justify 去掉这个属性表示不执行排版
                imageBlockLine: 'center',    //图片的浮动方式，独占一行剧中,左右浮动，默认: center,left,right,none 去掉这个属性表示不执行排版
                pasteFilter: false,          //根据规则过滤没事粘贴进来的内容
                clearFontSize: false,        //去掉所有的内嵌字号，使用编辑器默认的字号
                clearFontFamily: false,      //去掉所有的内嵌字体，使用编辑器默认的字体
                removeEmptyNode: false,      //去掉空节点
                removeTagNames: {"font": 1},
                indent: false,               // 行首缩进
                indentValue: '0em'           //行首缩进的大小
            },
        	toolbars: [
                   ['fullscreen', 'source', '|', 'undo', 'redo','|', 'bold', 'italic', 'underline', 'fontborder',
                       'strikethrough', 'superscript', 'subscript','removeformat', 'formatmatch', 'autotypeset',
                       'blockquote', 'pasteplain', '|', 'forecolor','backcolor', 'insertorderedlist',
                       'insertunorderedlist', 'selectall', 'cleardoc', '|','rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                       'customstyle', 'paragraph', 'fontfamily', 'fontsize','|', 'directionalityltr', 'directionalityrtl',
                       'indent', '|', 'justifyleft', 'justifycenter','justifyright', 'justifyjustify', '|', 'touppercase',
                       'tolowercase', '|', 'link', 'unlink', 'anchor', '|','imagenone', 'imageleft', 'imageright', 'imagecenter',
                       '|', 'insertimage', 'emotion', 'insertvideo','attachment', 'map', 'gmap', 'insertframe',
                       'insertcode', 'webapp', 'pagebreak', 'template','background', '|', 'horizontal', 'date', 'time',
                       'spechars', 'wordimage', '|','inserttable', 'deletetable','insertparagraphbeforetable', 'insertrow', 'deleterow',
                       'insertcol', 'deletecol', 'mergecells', 'mergeright','mergedown', 'splittocells', 'splittorows',
                       'splittocols', '|', 'print', 'preview', 'searchreplace']
               ]
        };
        editor = new UE.ui.Editor(options);
        editor.render("post_content");
    });

function adsubmit(){
	if($('#name').val() ==''){
		layer.msg('活动名称不能为空',{icon:2});return false;
	}
	if($('input[name=expression]').val() ==''){
		layer.msg('优惠不能为空',{icon:2});return false;
	}
	var pg = []; 
	//过滤选择重复商品
	$('input[name*="goods_id"]').each(function(i,o){
		pg.push($(o).val());
	});
	if(pg.length==0){
		layer.msg('请选择商品',{icon:2});
		return false;
	}
	$('#promotion').submit();
}

function selectGoods(){
	var goods_id = []; 
	//过滤选择重复商品
	$('input[name*="goods_id"]').each(function(i,o){
		goods_id.push($(o).val());
	});
    var url = '/index.php?m=Admin&c=Promotion&a=search_goods&goods_id='+goods_id+'&t='+Math.random();
    layer.open({
        type: 2,
        title: '选择商品',
        shadeClose: true,
        shade: 0.3,
        area: ['70%', '80%'],
        content: url, 
    });
}

function call_back(table_html)
{
	layer.closeAll('iframe');
	$('#goods_list').append(table_html);
}

$("#prom_type").on("change",function(){
	  var type = parseInt($("#prom_type").val());
	  var expression = '';
	  switch(type){
	    case 0:{
	      expression = '<td><b class="red">*</b>折扣：</td> <td> <input name="expression" type="text" class="small"  pattern="int" value=""> <label>% 折扣值(1-100 如果打9折，请输入90)</label> </td>';
	      break;
	    }
	    case 1:{
	      expression = '<td><b class="red">*</b>立减金额：</td> <td> <input name="expression" type="text" class="small"  pattern="float" value=""> <label>立减金额（元）</label> </td>';
	      break;
	    }
	    case 2:{
	      expression = '<td><b class="red">*</b>出售金额：</td> <td> <input name="expression" type="text" class="small"  pattern="float" value=""> <label>出售金额（元）</label> </td>';
	      break;
	    }
	    case 3:{
	      expression = '<td><b class="red">*</b>代金券：</td> <td><select name="expression"><?php
                                   
                                $md5_key = md5("select * from __PREFIX__coupon where type=0");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__coupon where type=0"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $key=>$v): ?><option value="<?php echo $v['id']; ?>" <?php if($v[id] == $info[expression]): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option><?php endforeach; ?></select></td>';
	      break;
	    }
	    case 4:{
	      expression = '<td><b class="red">*</b>买M送N：</td> <td> <input name="expression" type="text" class="small"  pattern="\\d+\/\\d+" value=""> <label>买几件送几件（如买3件送1件: 3/1）</label> </td>';
	      break;
	    }
	  }
	  $("#expression").html(expression);
});

$(document).ready(function(){
	$("#prom_type").trigger('change');
	$('input[name=expression]').val("<?php echo $info['expression']; ?>");
	
	$('#start_time').daterangepicker({
		format:"YYYY-MM-DD",
		singleDatePicker: true,
		showDropdowns: true,
		minDate:'<?php echo $min_date; ?>',
		maxDate:'2030-01-01',
		startDate:'<?php echo $min_date; ?>',
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});
	
	$('#end_time').daterangepicker({
		format:"YYYY-MM-DD",
		singleDatePicker: true,
		showDropdowns: true,
		minDate:'<?php echo $min_date; ?>',
		maxDate:'2030-01-01',
		startDate:'<?php echo $min_date; ?>',
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});
})
</script>
</body>
</html>