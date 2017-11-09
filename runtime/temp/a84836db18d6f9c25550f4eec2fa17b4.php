<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:40:"./application/admin/view3/tc\_goods.html";i:1510214426;s:48:"./application/admin/view3/public\min-header.html";i:1510128324;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
 

<!--物流配置 css -start-->
<style>
    ul.group-list {
        width: 96%;min-width: 1000px; margin: auto 5px;list-style: disc outside none;
    }
    ul.group-list li {
        white-space: nowrap;float: left;
        width: 150px; height: 25px;
        padding: 3px 5px;list-style-type: none;
        list-style-position: outside;border: 0px;margin: 0px;
    }
</style>
<!--物流配置 css -end-->

<!--以下是在线编辑器 代码 -->
<script type="text/javascript">
    /*
	 * 在线编辑器相 关配置 js 
	 *  参考 地址 http://fex.baidu.com/ueditor/
	 */
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
<script type="text/javascript" charset="utf-8" src="/public/plugins/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/plugins/Ueditor/ueditor.all.min.js"> </script>
 <script type="text/javascript" charset="utf-8" src="/public/plugins/Ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">  
  
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
        editor.render("goods_content");  //  指定 textarea 的  id 为 goods_content

    }); 
</script>
<!--以上是在线编辑器 代码  end-->
<div class="wrapper">
    

    <section class="content">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i>商品详情</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_tongyong" data-toggle="tab">通用信息</a></li>
                        <li><a href="#tab_goods_images" data-toggle="tab">商品相册</a></li>
                    </ul>
                    <!--表单数据-->
                    <form method="post" id="addEditGoodsForm">
                    
                        <!--通用信息-->
                    <div class="tab-content">                 	  
                        <div class="tab-pane active" id="tab_tongyong">
                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>商品名称:</td>
                                    <td>
                                        <input type="text" value="<?php echo $goodsInfo['goods_name']; ?>" name="goods_name" class="form-control" style="width:550px;"/>
                                        <span id="err_goods_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td>商品货号</td>
                                    <td>                                                                               
                                        <input type="text" value="<?php echo $goodsInfo['goods_sn']; ?>" name="goods_sn" class="form-control" style="width:350px;"/>
                                        <span id="err_goods_sn" style="color:#F00; display:none;"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>商品分类:</td>
                                    <td>
                                      <div class="col-xs-3">
                                      <select name="cat_id" id="cat_id" onchange="get_tc_category(this.value,'cat_id_2','0');" class="form-control" style="width:250px;margin-left:-15px;">
                                        <option value="0">请选择商品分类</option>                                      
                                             <?php if(is_array($cat_list) || $cat_list instanceof \think\Collection || $cat_list instanceof \think\Paginator): if( count($cat_list)==0 ) : echo "" ;else: foreach($cat_list as $k=>$v): ?>                                                                                          
                                               <option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $level_cat['1']): ?>selected="selected"<?php endif; ?> >
                                               		<?php echo $v['name']; ?>
                                               </option>
                                             <?php endforeach; endif; else: echo "" ;endif; ?>
                                      </select>
                                      </div>
                                      <div class="col-xs-3">
                                      <select name="cat_id_2" id="cat_id_2" onchange="get_tc_category(this.value,'cat_id_3','0');" class="form-control" style="width:250px;margin-left:-15px;">
                                        <option value="0">请选择商品分类</option>
                                      </select>  
                                      </div>
                                      <div class="col-xs-3">                        
                                      <select name="cat_id_3" id="cat_id_3" class="form-control" style="width:250px;margin-left:-15px;">
                                        <option value="0">请选择商品分类</option>
                                      </select> 
                                      </div>    
                                      <span id="err_cat_id" style="color:#F00; display:none;"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>商品品牌:</td>
                                    <td>
									<select name="brand_id" id="brand_id" class="form-control" style="width:250px;">
                                       		 <option value="">所有品牌</option>
                                            <?php if(is_array($brandList) || $brandList instanceof \think\Collection || $brandList instanceof \think\Paginator): if( count($brandList)==0 ) : echo "" ;else: foreach($brandList as $k=>$v): ?>
                                               <option value="<?php echo $v['id']; ?>"  <?php if($v['id'] == $goodsInfo['brand_id']): ?>selected="selected"<?php endif; ?>>
                                               		<?php echo $v['name']; ?>
                                               </option>
                                        	 <?php endforeach; endif; else: echo "" ;endif; ?>
                                      </select>                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td>本店售价:</td>
                                    <td>
                                        <input type="text" value="<?php echo $goodsInfo['shop_price']; ?>" name="shop_price" class="form-control" style="width:150px;" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" />
                                        <span id="err_shop_price" style="color:#F00; display:none;"></span>					                                        
                                    </td>
                                </tr>  
                                <tr>
                                    <td>市场价:</td>
                                    <td>
                                        <input type="text" value="<?php echo $goodsInfo['market_price']; ?>" name="market_price" class="form-control" style="width:150px;" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" />
                                        <span id="err_market_price" style="color:#F00; display:none;"></span>					                                        
                                    </td>
                                </tr>  
                                <tr>
                                    <td>成本价:</td>
                                    <td>
                                        <input type="text" value="<?php echo $goodsInfo['cost_price']; ?>" name="cost_price" class="form-control" style="width:150px;" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" />
                                        <span id="err_cost_price" style="color:#F00; display:none"></span>					                                        
                                    </td>
                                </tr>       

                                <tr>
                                    <td>上传商品图片:</td>
                                    <td>
                                        <input type="button" value="上传图片"  onclick="GetUploadify(1,'','tc','call_back');"/>
                                        <input type="text" class="input-sm"  name="original_img" id="original_img" value="<?php echo $goodsInfo['original_img']; ?>"/>
                                        <?php if($goodsInfo['original_img'] != null): ?>
                                            &nbsp;&nbsp;
                                            <a target="_blank" href="<?php echo $goodsInfo['original_img']; ?>" id="original_img2">
                                                <img width="25" height="25" src="/public/images/image_icon.jpg">
                                            </a>
                                        <?php endif; ?>
                                        <span id="err_original_img" style="color:#F00; display:none;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>商品详情描述:</td>
                                    <td width="85%">
										<textarea class="span12 ckeditor" id="goods_content" name="goods_content" title=""><?php echo $goodsInfo['goods_content']; ?></textarea>
                                        <span id="err_goods_content" style="color:#F00; display:none;"></span>                                         
                                    </td>                                                                       
                                </tr>   
                                </tbody>                                
                                </table>
                        </div>
                         <!--其他信息-->
                         
                        <!-- 商品相册-->
                        <div class="tab-pane" id="tab_goods_images">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>                                    
                                    <td>                                    
                                    <?php if(is_array($goodsImages) || $goodsImages instanceof \think\Collection || $goodsImages instanceof \think\Paginator): if( count($goodsImages)==0 ) : echo "" ;else: foreach($goodsImages as $k=>$vo): ?>
                                        <div style="width:100px; text-align:center; margin: 5px; display:inline-block;" class="goods_xc">
                                            <input type="hidden" value="<?php echo $vo['image_url']; ?>" name="goods_images[]">
                                            <a onclick="" href="<?php echo $vo['image_url']; ?>" target="_blank"><img width="100" height="100" src="<?php echo $vo['image_url']; ?>"></a>
                                            <br>
                                            <a href="javascript:void(0)" onclick="ClearPicArr2(this,'<?php echo $vo['image_url']; ?>')">删除</a>
                                        </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    
                                        <div class="goods_xc" style="width:100px; text-align:center; margin: 5px; display:inline-block;">
                                            <input type="hidden" name="goods_images[]" value="" />
                                            <a href="javascript:void(0);" onclick="GetUploadify(10,'','goods','call_back2');"><img src="/public/images/add-button.jpg" width="100" height="100" /></a>
                                            <br/>
                                            <a href="javascript:void(0)">&nbsp;&nbsp;</a>
                                        </div>                                        
                                    </td>
                                </tr>                                              
                                </tbody>
                            </table>
                        </div>
                        <!--商品相册-->
                        <!-- 商品规格-->
                        <!-- 商品规格-->
                        <!-- 商品属性-->
                        <!-- 商品属性-->
                        <!-- 商品物流-->
                        <!-- 商品物流-->
                    </div>              
                    <div class="pull-right">
                        <input type="hidden" name="goods_id" value="<?php echo $goodsInfo['goods_id']; ?>">
                        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />                        
                        <button class="btn btn-primary" onclick="ajax_submit_form('addEditGoodsForm','<?php echo U('Tc/addEditGoods?is_ajax=1'); ?>');" title="" data-toggle="tooltip" type="button" data-original-title="保存">保存</button>
                    </div>
			    </form><!--表单数据-->
                </div>
            </div>
        </div>    <!-- /.content -->
    </section>
</div>
<script>
    $(document).ready(function(){
        $(":checkbox[cka]").click(function(){
            var $cks = $(":checkbox[ck='"+$(this).attr("cka")+"']");
            if($(this).is(':checked')){
                $cks.each(function(){$(this).prop("checked",true);});
            }else{
                $cks.each(function(){$(this).removeAttr('checked');});
            }
        });
    });

    function choosebox(o){
        var vt = $(o).is(':checked');
        if(vt){
            $('input[type=checkbox]').prop('checked',vt);
        }else{
            $('input[type=checkbox]').removeAttr('checked');
        }
    }
    /*
     * 以下是图片上传方法
     */
    // 上传商品图片成功回调函数
    function call_back(fileurl_tmp){
        $("#original_img").val(fileurl_tmp);
    	$("#original_img2").attr('href', fileurl_tmp);
    }
 
    // 上传商品相册回调函数
    function call_back2(paths){
        
        var  last_div = $(".goods_xc:last").prop("outerHTML");	
        for (i=0;i<paths.length ;i++ )
        {                    
            $(".goods_xc:eq(0)").before(last_div);	// 插入一个 新图片
                $(".goods_xc:eq(0)").find('a:eq(0)').attr('href',paths[i]).attr('onclick','').attr('target', "_blank");// 修改他的链接地址
            $(".goods_xc:eq(0)").find('img').attr('src',paths[i]);// 修改他的图片路径
                $(".goods_xc:eq(0)").find('a:eq(1)').attr('onclick',"ClearPicArr2(this,'"+paths[i]+"')").text('删除');
            $(".goods_xc:eq(0)").find('input').val(paths[i]); // 设置隐藏域 要提交的值
        } 			   
    }
    /*
     * 上传之后删除组图input     
     * @access   public
     * @val      string  删除的图片input
     */
    function ClearPicArr2(obj,path)
    {
    	$.ajax({
                    type:'GET',
                    url:"<?php echo U('Admin/Uploadify/delupload'); ?>",
                    data:{action:"del", filename:path},
                    success:function(){
                           $(obj).parent().remove(); // 删除完服务器的, 再删除 html上的图片				 
                    }
		});
		// 删除数据库记录
    	$.ajax({
                    type:'GET',
                    url:"<?php echo U('Admin/Tc/del_goods_images'); ?>",
                    data:{filename:path},
                    success:function(){
                          //		 
                    }
		});		
    }
/** 以下 商品属性相关 js*/
/** 以下 商品规格相关 js*/
/** 以下是编辑时默认选中某个商品分类*/
$(document).ready(function(){

	<?php if($level_cat['2'] > 0): ?>
		 // 商品分类第二个下拉菜单
		 get_category('<?php echo $level_cat[1]; ?>','cat_id_2','<?php echo $level_cat[2]; ?>');	
	<?php endif; if($level_cat['3'] > 0): ?>
		// 商品分类第二个下拉菜单
		 get_category('<?php echo $level_cat[2]; ?>','cat_id_3','<?php echo $level_cat[3]; ?>');	 
	<?php endif; ?>

    //  扩展分类
	<?php if($level_cat2['2'] > 0): ?>
		 // 商品分类第二个下拉菜单
		 get_category('<?php echo $level_cat2[1]; ?>','extend_cat_id_2','<?php echo $level_cat2[2]; ?>');	
	<?php endif; if($level_cat2['3'] > 0): ?>
		// 商品分类第二个下拉菜单
		 get_category('<?php echo $level_cat2[2]; ?>','extend_cat_id_3','<?php echo $level_cat2[3]; ?>');	 
	<?php endif; ?>

});
    function get_tc_category(id,next,select_id){
        var url = "/index.php/admin/Tc/get_tc_category"+"?parent_id="+id;
        $.ajax({
            type : "GET",
            url  : url,
            error: function(request) {
                alert("服务器繁忙, 请联系管理员!");
                return;
            },
            success: function(v) {
                v = "<option value='0'>请选择商品分类</option>" + v;
                $('#'+next).empty().html(v);
                //alert(v);
                (select_id > 0) && $('#'+next).val(select_id);//默认选中
            }
        });
	}

</script>
</body>
</html>