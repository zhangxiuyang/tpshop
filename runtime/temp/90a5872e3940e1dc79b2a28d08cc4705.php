<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"./application/admin/view3/goods\ajaxSpecList.html";i:1503927232;}*/ ?>
<form method="post" enctype="multipart/form-data" target="_blank" id="form-goodsType">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>                
                <th class="sorting text-left">ID</th>
                <th class="sorting text-left">规格名称</th>
                <th class="sorting text-left">所属模型</th>
                <th class="sorting text-left">规格项</th>
                <th class="sorting text-center">筛选</th>
                <th class="sorting text-left">排序</th>
                <th class="sorting text-left">操作</th> 
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($specList) || $specList instanceof \think\Collection || $specList instanceof \think\Paginator): $i = 0; $__LIST__ = $specList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="selected[]" value="6">
                    </td>
                    <td class="text-right"><?php echo $list['id']; ?></td>
                    <td class="text-left"><?php echo $list['name']; ?></td>
                    <td class="text-left"><?php echo $goodsTypeList[$list[type_id]][name]; ?></td>
                    <td class="text-left"><?php echo $list['spec_item']; ?></td>
                    <td class="text-center">
                        <img width="20" height="20" src="__PUBLIC__/images/<?php if($list[search_index] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('spec','id','<?php echo $list['id']; ?>','search_index',this)"/>
                    </td>
                    <td class="text-right">
                        <input type="text" class="form-control input-sm" onchange="updateSort('spec','id','<?php echo $list['id']; ?>','order',this)" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')"  size="4" value="<?php echo $list['order']; ?>" />
                    </td>
                    <td class="text-right">                       
                        <a href="<?php echo U('Admin/goods/addEditSpec',array('id'=>$list['id'])); ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="编辑"><i class="fa fa-pencil"></i></a>
                        <a href="javascript:del_fun('<?php echo U('Goods/delGoodsSpec',array('id'=>$list['id'])); ?>');" id="button-delete6" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="删除"><i class="fa fa-trash-o"></i></a></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</form>
<div class="row">
    <div class="col-sm-6 text-left"></div>
    <div class="col-sm-6 text-right"><?php echo $page; ?></div>
</div>
<script>
    // 点击分页触发的事件
    $(".pagination  a").click(function(){
        cur_page = $(this).data('p');
        ajax_get_table('search-form2',cur_page);
    }); 
</script>