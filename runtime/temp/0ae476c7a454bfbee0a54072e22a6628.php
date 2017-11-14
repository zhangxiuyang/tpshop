<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./application/admin/view3/report\index.html";i:1503927232;s:48:"./application/admin/view3/public\min-header.html";i:1510128324;s:48:"./application/admin/view3/public\breadcrumb.html";i:1509608949;}*/ ?>
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
 

<link href="__PUBLIC__/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<div class="wrapper">
    

		<section class="content">
		  <div class="row">
		  	<div class="col-md-12">
		  		<div class="box box-info">
		  			<div class="box-header with-border">
		  				<div class="row">
		  					<div class="col-md-10">
		  						<form action="" method="post">
				  					<div class="col-xs-5">         
					                    <div class="input-group margin">
					                      <div class="input-group-addon">
					                       		选择时间  <i class="fa fa-calendar"></i>
					                      </div>
					                      <input type="text" class="form-control pull-right" name="timegap" value="<?php echo $timegap; ?>" id="start_time">
					                    </div>
				  					</div>		  					
		                   		 	<div class="col-xs-1"><input class="btn btn-block btn-info margin" type="submit" value="确定"></div>
	                   		 	</form>
                   		 	</div>
		  				</div>
		  			</div>
		  			<div class="box-body">
		  				<div class="row">
				  			<div class="col-sm-3 col-xs-6">
				  				今日销售总额：￥<?php if(empty($today['today_amount']) || (($today['today_amount'] instanceof \think\Collection || $today['today_amount'] instanceof \think\Paginator ) && $today['today_amount']->isEmpty())): ?>0<?php else: ?><?php echo $today['today_amount']; endif; ?>
				  			</div>
				  				<div class="col-sm-3 col-xs-6">
				  				人均客单价：￥<?php echo $today['sign']; ?>
				  			</div>
				  				<div class="col-sm-3 col-xs-6">
				  				今日订单数：<?php echo $today['today_order']; ?>
				  			</div>
				  				<div class="col-sm-3 col-xs-6">
				  				今日取消订单：<?php echo $today['cancel_order']; ?>
				  			</div>
			  			</div>
		  			</div>
		  		</div>
		  	</div>
		  </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">销售额走势</h3>
                  <div class="box-tools"></div>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    	<div id="statistics" style="height: 400px;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
            <div class="panel panel-default">
            	<div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 销售表格概览</h3>
                </div>
                <div class="panel-body">
	            	<table id="list-table" class="table table-bordered table-striped">
			               <thead>
			                   <tr>
			                   	   <th>时间</th>
				                   <th>订单数</th>
				                   <th>销售总额</th>			                   
				                   <th>客单价</th>
			                  	   <th>查看</th>
			                   </tr>
			                </thead>
							<tbody>
	                         <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
	                          <tr role="row" align="center">
	                          	 <td><?php echo $vo['day']; ?></td>
	                          	 <td><?php echo $vo['order_num']; ?></td>
	                             <td><?php echo $vo['sign']; ?></td>
			                     <td><?php echo $vo['amount']; ?></td>
			                     <td><a href="<?php echo U('Report/saleList',array('begin'=>$vo['day'],'end'=>$vo['end'])); ?>">订单列表</a></td>
			                   </tr>
			                  <?php endforeach; endif; else: echo "" ;endif; ?>
			                </tbody>
			        </table>
		        </div>
		      </div>
            </div>
            <!--  
            <div class="col-md-6">        
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">地区数据</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart"> 
                  	<div id="area" style="height:400px;"></div>  
                  </div>
                </div>
              </div>
             </div>
             <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">用户访问终端</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <div id="pie" style="height:400px;"></div>  
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </section>
</div>
<script src="__PUBLIC__/js/echart/echarts.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/echart/macarons.js"></script>
<script src="__PUBLIC__/js/echart/china.js"></script>
<script src="__PUBLIC__/dist/js/app.js" type="text/javascript"></script>
<script type="text/javascript">
var res = <?php echo $result; ?>;
var myChart = echarts.init(document.getElementById('statistics'),'macarons');
option = {
	    tooltip : {
	        trigger: 'axis'
	    },
	    toolbox: {
	        show : true,
	        feature : {
	            mark : {show: true},
	            dataView : {show: true, readOnly: false},
	            magicType: {show: true, type: ['line', 'bar']},
	            restore : {show: true},
	            saveAsImage : {show: true}
	        }
	    },
	    calculable : true,
	    legend: {
	        data:['交易金额','订单数','客单价']
	    },
	    xAxis : [
	        {
	            type : 'category',
	            data : res.time
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	            name : '金额',
	            axisLabel : {
	                formatter: '{value} ￥'
	            }
	        },
	        {
	            type : 'value',
	            name : '客单价',
	            axisLabel : {
	                formatter: '{value} ￥'
	            }
	        }
	    ],
	    series : [
	        {
	            name:'交易金额',
	            type:'bar',
	            data:res.amount
	        },
	        {
	            name:'订单数',
	            type:'bar',
	            data:res.order
	        },
	        {
	            name:'客单价',
	            type:'line',
	            yAxisIndex: 1,
	            data:res.sign
	        }
	    ]
	};
	myChart.setOption(option);
	/*
	var areachart = echarts.init(document.getElementById('area'),'macarons');
	areachart.setOption({
			    title : {
			        text: '订单分布',
			        subtext: '纯属虚构',
			        left: 'center'
			    },
			    tooltip : {
			        trigger: 'item'
			    },
			    legend: {
			        orient: 'vertical',
			        left: 'left',
			        data:['订单数','消费金额','访问人数']
			    },
			    visualMap: {
			        min: 0,
			        max: 2500,
			        left: 'left',
			        top: 'bottom',
			        text:['高','低'],           // 文本，默认为数值文本
			        calculable : true
			    },
			    toolbox: {
			        show: true,
			        orient : 'vertical',
			        left: 'right',
			        top: 'center',
			        feature : {
			            mark : {show: true},
			            dataView : {show: true, readOnly: false},
			            restore : {show: true},
			            saveAsImage : {show: true}
			        }
			    },
			    series : [
			        {
			            name: '订单数',
			            type: 'map',
			            mapType: 'china',
			            roam: false,
			            itemStyle:{
			                normal:{label:{show:true}},
			                emphasis:{label:{show:true}}
			            },
			            data:[
			                {name: '北京',value: Math.round(Math.random()*1000)},
			                {name: '天津',value: Math.round(Math.random()*1000)},
			                {name: '上海',value: Math.round(Math.random()*1000)},
			                {name: '重庆',value: Math.round(Math.random()*1000)},
			                {name: '河北',value: Math.round(Math.random()*1000)},
			                {name: '河南',value: Math.round(Math.random()*1000)},
			                {name: '云南',value: Math.round(Math.random()*1000)},
			                {name: '辽宁',value: Math.round(Math.random()*1000)},
			                {name: '黑龙江',value: Math.round(Math.random()*1000)},
			                {name: '湖南',value: Math.round(Math.random()*1000)},
			                {name: '安徽',value: Math.round(Math.random()*1000)},
			                {name: '山东',value: Math.round(Math.random()*1000)},
			                {name: '新疆',value: Math.round(Math.random()*1000)},
			                {name: '江苏',value: Math.round(Math.random()*1000)},
			                {name: '浙江',value: Math.round(Math.random()*1000)},
			                {name: '江西',value: Math.round(Math.random()*1000)},
			                {name: '湖北',value: Math.round(Math.random()*1000)},
			                {name: '广西',value: Math.round(Math.random()*1000)},
			                {name: '甘肃',value: Math.round(Math.random()*1000)},
			                {name: '山西',value: Math.round(Math.random()*1000)},
			                {name: '内蒙古',value: Math.round(Math.random()*1000)},
			                {name: '陕西',value: Math.round(Math.random()*1000)},
			                {name: '吉林',value: Math.round(Math.random()*1000)},
			                {name: '福建',value: Math.round(Math.random()*1000)},
			                {name: '贵州',value: Math.round(Math.random()*1000)},
			                {name: '广东',value: Math.round(Math.random()*1000)},
			                {name: '青海',value: Math.round(Math.random()*1000)},
			                {name: '西藏',value: Math.round(Math.random()*1000)},
			                {name: '四川',value: Math.round(Math.random()*1000)},
			                {name: '宁夏',value: Math.round(Math.random()*1000)},
			                {name: '海南',value: Math.round(Math.random()*1000)},
			                {name: '台湾',value: Math.round(Math.random()*1000)},
			                {name: '香港',value: Math.round(Math.random()*1000)},
			                {name: '澳门',value: Math.round(Math.random()*1000)}
			            ]
			        },
			        {
			            name: '消费金额',
			            type: 'map',
			            mapType: 'china',
			            itemStyle:{
			                normal:{label:{show:true}},
			                emphasis:{label:{show:true}}
			            },
			            data:[
			                {name: '北京',value: Math.round(Math.random()*1000)},
			                {name: '天津',value: Math.round(Math.random()*1000)},
			                {name: '上海',value: Math.round(Math.random()*1000)},
			                {name: '重庆',value: Math.round(Math.random()*1000)},
			                {name: '河北',value: Math.round(Math.random()*1000)},
			                {name: '安徽',value: Math.round(Math.random()*1000)},
			                {name: '新疆',value: Math.round(Math.random()*1000)},
			                {name: '浙江',value: Math.round(Math.random()*1000)},
			                {name: '江西',value: Math.round(Math.random()*1000)},
			                {name: '山西',value: Math.round(Math.random()*1000)},
			                {name: '内蒙古',value: Math.round(Math.random()*1000)},
			                {name: '吉林',value: Math.round(Math.random()*1000)},
			                {name: '福建',value: Math.round(Math.random()*1000)},
			                {name: '广东',value: Math.round(Math.random()*1000)},
			                {name: '西藏',value: Math.round(Math.random()*1000)},
			                {name: '四川',value: Math.round(Math.random()*1000)},
			                {name: '宁夏',value: Math.round(Math.random()*1000)},
			                {name: '香港',value: Math.round(Math.random()*1000)},
			                {name: '澳门',value: Math.round(Math.random()*1000)}
			            ]
			        },
			        {
			            name: '访问人数',
			            type: 'map',
			            mapType: 'china',
			            itemStyle:{
			                normal:{label:{show:true}},
			                emphasis:{label:{show:true}}
			            },
			            data:[
			                {name: '北京',value: Math.round(Math.random()*1000)},
			                {name: '天津',value: Math.round(Math.random()*1000)},
			                {name: '上海',value: Math.round(Math.random()*1000)},
			                {name: '广东',value: Math.round(Math.random()*1000)},
			                {name: '台湾',value: Math.round(Math.random()*1000)},
			                {name: '香港',value: Math.round(Math.random()*1000)},
			                {name: '澳门',value: Math.round(Math.random()*1000)}
			            ]
			        }
			    ]
			});
	var piechart = echarts.init(document.getElementById('pie'),'macarons');
	
	piechart.setOption({
		    title : {
		        text: '网站用户访问来源',
		        subtext: '纯属虚构',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        data: ['PC','APP','WAP','微信','其他']
		    },
		    series : [
		        {
		            name: '访问来源',
		            type: 'pie',
		            radius : '55%',
		            center: ['50%', '60%'],
		            data:[
		                {value:335, name:'PC'},
		                {value:310, name:'APP'},
		                {value:234, name:'WAP'},
		                {value:135, name:'微信'},
		                {value:1548, name:'其他'}
		            ],
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
		});
	*/
	$(document).ready(function() {
		$('#start_time').daterangepicker({
			format:"YYYY-MM-DD",
			singleDatePicker: false,
			showDropdowns: true,
			minDate:'2016-01-01',
			maxDate:'2030-01-01',
			startDate:'2016-01-01',
	        showWeekNumbers: true,
	        timePicker: false,
	        timePickerIncrement: 1,
	        timePicker12Hour: true,
	        ranges: {
	           '今天': [moment(), moment()],
	           '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
	           '最近7天': [moment().subtract('days', 6), moment()],
	           '最近30天': [moment().subtract('days', 29), moment()],
	           '上一个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
	        },
	        opens: 'right',
	        buttonClasses: ['btn btn-default'],
	        applyClass: 'btn-small btn-primary',
	        cancelClass: 'btn-small',
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
		
		/*
		$('#end_time').daterangepicker({
			format:"YYYY-MM-DD",
			singleDatePicker: true,
			showDropdowns: true,
			minDate:'2016-01-01',
			maxDate:'2030-01-01',
			startDate:'2016-01-01',
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
		*/
	});
</script>
</body>
</html>