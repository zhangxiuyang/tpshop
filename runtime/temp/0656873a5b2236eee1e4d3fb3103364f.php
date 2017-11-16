<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./application/admin/view3/tc\tc_edit.html";i:1510640348;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
    window.UEDITOR_Admin_URL = "/public/plugins/Ueditor/";
    var URL_upload = "<?php echo $URL_upload; ?>";
    var URL_fileUp = "<?php echo $URL_fileUp; ?>";
    var URL_scrawlUp = "<?php echo $URL_scrawlUp; ?>";
    var URL_getRemoteImage = "<?php echo $URL_getRemoteImage; ?>";
    var URL_imageManager = "<?php echo $URL_imageManager; ?>";
    var URL_imageUp = "<?php echo $URL_imageUp; ?>";
    var URL_getMovie = "<?php echo $URL_getMovie; ?>";
    var URL_home = "<?php echo $URL_home; ?>";
</script>

<script type="text/javascript" src="__PUBLIC__/plugins/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugins/Ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/plugins/Ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/plugins/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/plugins/Ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/public/plugins/Ueditor/lang/zh-cn/zh-cn.js"></script>

<script>
    var editor;
    $(function () {
        //具体参数配置在  editor_config.js  中
        var options = {
            zIndex: 999,
            initialFrameWidth: "95%", //初化宽度
            initialFrameHeight: 400, //初化高度
            focus: false, //初始化时，是否让编辑器获得焦点true或false
            maximumWords: 99999, removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign'
            , //允许的最大字符数 'fullscreen',
            pasteplain:false, //是否默认为纯文本粘贴。false为不使用纯文本粘贴，true为使用纯文本粘贴
            autoHeightEnabled: true
            /*   autotypeset: {
             mergeEmptyline: true,        //合并空行
             removeClass: true,           //去掉冗余的class
             removeEmptyline: false,      //去掉空行
             textAlign: "left",           //段落的排版方式，可以是 left,right,center,justify 去掉这个属性表示不执行排版
             imageBlockLine: 'center',    //图片的浮动方式，独占一行剧中,左右浮动，默认: center,left,right,none 去掉这个属性表示不执行排版
             pasteFilter: false,          //根据规则过滤没事粘贴进来的内容
             clearFontSize: false,        //去掉所有的内嵌字号，使用编辑器默认的字号
             clearFontFamily: false,      //去掉所有的内嵌字体，使用编辑器默认的字体
             removeEmptyNode: false,      //去掉空节点
             //可以去掉的标签
             removeTagNames: {"font": 1},
             indent: false,               // 行首缩进
             indentValue: '0em'           //行首缩进的大小
             }*/,
            toolbars: [
                ['fullscreen', 'source', '|', 'undo', 'redo',
                    '|', 'bold', 'italic', 'underline', 'fontborder',
                    'strikethrough', 'superscript', 'subscript',
                    'removeformat', 'formatmatch', 'autotypeset',
                    'blockquote', 'pasteplain', '|', 'forecolor',
                    'backcolor', 'insertorderedlist',
                    'insertunorderedlist', 'selectall', 'cleardoc', '|',
                    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                    'customstyle', 'paragraph', 'fontfamily', 'fontsize',
                    '|', 'directionalityltr', 'directionalityrtl',
                    'indent', '|', 'justifyleft', 'justifycenter',
                    'justifyright', 'justifyjustify', '|', 'touppercase',
                    'tolowercase', '|', 'link', 'unlink', 'anchor', '|',
                    'imagenone', 'imageleft', 'imageright', 'imagecenter',
                    '|', 'insertimage', 'emotion', 'insertvideo',
                    'attachment', 'map', 'gmap', 'insertframe',
                    'insertcode', 'webapp', 'pagebreak', 'template',
                    'background', '|', 'horizontal', 'date', 'time',
                    'spechars', 'wordimage', '|',
                    'inserttable', 'deletetable',
                    'insertparagraphbeforetable', 'insertrow', 'deleterow',
                    'insertcol', 'deletecol', 'mergecells', 'mergeright',
                    'mergedown', 'splittocells', 'splittorows',
                    'splittocols', '|', 'print', 'preview', 'searchreplace']
            ]
        };
        editor = new UE.ui.Editor(options);
        editor.render("post_content");  //  指定 textarea 的  id 为 goods_content

    });
</script>
<div class="wrapper">
    

   	<section class="content">
       <div class="row">
			<div class="col-md-12">
			
			<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">套餐编辑</h3>
                  <a href="<?php echo U('Tc/tcList'); ?>" data-toggle="tooltip" title="" class="btn btn-default pull-right" data-original-title="返回"><i class="fa fa-reply"></i></a>
                </div>
                <form class="form-horizontal" action="<?php echo U('Tc/addEditTc'); ?>" id="add_post" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">套餐名称</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo $info['tc_name']; ?>" name="tc_name" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="text" class="col-sm-2 control-label">状态</label>
                      <div class="col-sm-5">
                        <div class="col-sm-2" style="min-width: 80px;">
                           <label><input type="radio" name="tc_status" value="1"<?php if($info[tc_status] == 1): ?> checked="checked"<?php endif; ?>> 可用 </label>
                        </div>
                         <div class="col-sm-3">
                           <label><input type="radio" name="tc_status" value="0"<?php if($info[tc_status] == 0): ?> checked="checked"<?php endif; ?>> 不可用</label>
                        </div>
                      </div>
                    </div>    

                    <div class="form-group">
	                    <label class="control-label col-sm-2">套餐内容</label>
	                    <div class="col-sm-8">

                            <textarea class="span12 ckeditor" id="post_content" name="content" title=""><?php echo $info['content']; ?></textarea>
	                    </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">              
                    		<input type="hidden" name="act" value="<?php echo $act; ?>">
	                  	 	<input type="hidden" name="tc_id" value="<?php echo $info['tc_id']; ?>"></label>
                    	 <div class="col-sm-8">
                    	 	<button type="reset" class="btn btn-default">重置</button>
                    	  	<button type="button"  onclick="checkForm()" class="btn btn-info pull-right">提交</button>
                    	 </div>
                    </div>
                  </div>
                  <div class="box-footer row">

                  </div>
                </form>
              </div>

          </div>
	   </div>
	</section>
</div>

<script type="text/javascript">
	function checkForm(){
		if( $('input[name="tc_name"]').val() == ''){
			alert("请填写套餐名称");
			return false;
		}else if($('input[name="tc_name"]').val().length>90){
            alert("名称必须小于90字符");
            return false;
        }
		$('#add_post').submit();
	}


</script>
</body>
</html>