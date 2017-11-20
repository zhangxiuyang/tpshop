<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:48:"./application/admin/view3/tc\addEditTcMonth.html";i:1510888632;s:48:"./application/admin/view3/public\min-header.html";i:1510814014;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
 

<!--以下是在线编辑器 代码 -->
<style>
    .ncap-btn-green{background-color: #4fc0e8;
        border-color: #3aa8cf; color: #ffffff;     display: inline-block;
        padding: 2px 9px;
        border: solid 1px;
        border-color: #DCDCDC #DCDCDC #B3B3B3 #DCDCDC;
        border-radius: 3px;
        cursor: pointer;
    }
    .first_ico{display: none}
    #goods_td{ padding-right: 0; padding-left: 0; }
    #goods_list_div .col-xs-10 table{ margin-bottom: 0; background-color: aliceblue;}
    .hidd{display: inline-block}
    .new_tab{display: table-cell}
    #goodsTotalShopPrice,#goodsTotalMarketPrice{
        display: inline-block;  padding-right: 6px;}
</style>
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
        editor.render("tc_month_content");  //  指定 textarea 的  id 为 goods_content

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
                    <h3 class="panel-title"><i class="fa fa-list"></i>月套餐详情</h3>
                </div>
                <div class="panel-body">
                    <!--表单数据-->
                    <form method="post" id="addEditTcMonthForm">
                    
                        <!--月套餐详情-->
                    <div class="tab-content">                 	  
                        <div class="tab-pane active" id="tab_tongyong">
                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>月套餐名称:</td>
                                    <td>
                                        <input type="text" value="<?php echo $info['tc_month_name']; ?>" name="tc_month_name" class="form-control" style="width:550px;"/>
                                        <span id="err_goods_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td>所属套餐:</td>
                                    <td>
                                      <div class="col-xs-3">
                                      <select name="tc_id" id="tc_id" class="form-control" style="width:250px;margin-left:-15px;">
                                        <option value="">请选所属套餐</option>
                                             <?php if(is_array($tcInfo) || $tcInfo instanceof \think\Collection || $tcInfo instanceof \think\Paginator): if( count($tcInfo)==0 ) : echo "" ;else: foreach($tcInfo as $k=>$v): ?>
                                               <option value="<?php echo $v['tc_id']; ?>" <?php if($v['tc_id'] == $info['tc_id']): ?>selected="selected"<?php endif; ?> >
                                               		<?php echo $v['tc_name']; ?>
                                               </option>
                                             <?php endforeach; endif; else: echo "" ;endif; ?>
                                      </select>
                                      </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>状态:</td>
                                    <td class="layui-form-item">
                                        <div class="layui-input-block">
                                            <input type="radio" id="r1" name="tc_status" value="1" <?php if($info['tc_status'] == 1): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;<label for="r1"> 开启</label>&nbsp;&nbsp;
                                            <input type="radio" id="r2" name="tc_status" value="0" <?php if($info['tc_status'] != 1): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;<label for="r2"> 关闭</label>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>添加商品:</td>
                                    <td>
                                        <dd class="opt">
                                            <a href="javascript:void(0);" onclick="selectGoods()" class="ncap-btn ncap-btn-green"><i class="fa fa-search"></i>添加商品</a>
                                        </dd>

                                    </td>
                                </tr>
                                <tr>
                                    <td>商品列表:</td>
                                    <td>
                                        <div class="ncap-order-details" id="goods_list_div" <?php if($info['tc_month_id'] == 0): ?>style="display: none" <?php else: ?>style="display: block"<?php endif; ?>>

                                        <div class="col-xs-10" id="goods_td" style="width: 100%" >
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <th align="left" abbr="order_sn" axis="col3" class="">
                                                                    <div style="text-align: left; width: 400px;" class="">商品名称</div>
                                                                </th>
                                                                <th align="left" abbr="consignee" axis="col4" class="">
                                                                    <div style="text-align: center; width: 80px;" class="">本店价格</div>
                                                                </th>
                                                                <th align="left" abbr="consignee" axis="col4" class="">
                                                                    <div style="text-align: center; width: 80px;" class="">市场价格</div>
                                                                </th>
                                                                <th align="left" abbr="consignee" axis="col4" class="">
                                                                    <div style="text-align: center; width: 80px;" class="">购买数量</div>
                                                                </th>
                                                                <th align="left" abbr="consignee" axis="col4" class="">
                                                                    <div style="text-align: center; width: 60px;" class="">操作</div>
                                                                </th>

                                                                </tr>
                                                                </thead>
                                                                <?php echo $info['goods_html']; ?>
                                                            </table>
                                                            <table class="table table-bordered" width="100%" style="background-color: #5c9ebf">
                                                                <thead>

                                                                <th align="right" width="120px"  axis="col4" class="">
                                                                    本店总价：
                                                                </th>
                                                                <th align=""  width="140px" axis="col4" class="">
                                                                    <span id="goodsTotalShopPrice">0.00</span>元
                                                                </th>
                                                                <th align="right" width="120px"  axis="col4" class="">
                                                                    市场总价：
                                                                </th>
                                                                <th align="" width="140px" axis="col4" class="">
                                                                    <span id="goodsTotalMarketPrice">0.00</span>元
                                                                </th>

                                                                <th align="right"  axis="col4" class="">
                                                                    <div style="text-align: center; width: 80px; color: #ffffff;" class="" >
                                                                        <a style="color: #ffffff;" href="javascript:;" onclick="getGoodsTotal()" >刷新</a>
                                                                    </div>
                                                                </th>

                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                            </div>

                                        </dd>
                                    </td>
                                </tr>





                                <tr>
                                    <td>商品详情描述:</td>
                                    <td width="85%">
										<textarea class="span12 ckeditor" id="tc_month_content" name="content" title=""><?php echo $info['content']; ?></textarea>
                                        <span id="err_goods_content" style="color:#F00; display:none;"></span>                                         
                                    </td>                                                                       
                                </tr>   
                                </tbody>                                
                                </table>
                        </div>

                        <!-- 商品相册-->
                    </div>
                    <div class="pull-right">
                        <input type="hidden" name="tc_month_id" value="<?php echo $info['tc_month_id']; ?>">
                        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />                        
                        <button class="btn btn-primary" onclick="ajax_submit_form('addEditTcMonthForm','<?php echo U('Tc/addEditTcMonth?is_ajax=1'); ?>');" title="" data-toggle="tooltip" type="button" data-original-title="保存">保存</button>
                    </div>
			    </form><!--表单数据-->
                </div>
            </div>
        </div>    <!-- /.content -->
    </section>
</div>
<script>
    //选择商品
    function selectGoods(){
        var url = "/index.php/Admin/Tc/search_goods";
        layer.open({
            type: 2,
            title: '选择商品',
            shadeClose: true,
            shade: 0.8,
            area: ['86%', '80%'],
            content: url,
        });
    }
    // 选择商品返回
    function call_back(table_html){
        $('#goods_list_div').show();
//alert(table_html);
        var thead = '';
        $('#goods_td').find('.table-bordered').append(table_html);

        //过滤选择重复商品
        var new_arr = [];
        $('input[name="goods_id_c"]').each(function(i,o){
            var items = $(o).val();
            if($.inArray(items,new_arr)==-1) {
                new_arr.push(items);
            }else{
                $(o).parent().parent().remove();
            }
        });
        layer.closeAll('iframe');
        $(".n_showbtn").show();
        getGoodsTotal();
    }
    //计算商品价格
    function getGoodsTotal() {
        var goods_num_info = $(".goods_num");

        var shop_price_total = 0;
        var market_price_total = 0;
        if(goods_num_info.length>0){
            goods_num_info.each(function (i,o) {
                shop_price_total += parseFloat(o.value)*parseFloat($(o).attr('data-shop_price'));
                market_price_total += parseInt(o.value)*parseFloat($(o).attr('data-market_price'));
                //alert(market_price_total);
            });

        }
        $("#goodsTotalShopPrice").html((shop_price_total));
        $("#goodsTotalMarketPrice").html((market_price_total));
    }
    $(function () {
        getGoodsTotal();
    });
</script>
</body>
</html>