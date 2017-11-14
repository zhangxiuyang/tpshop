<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"./application/admin/view3/coupon\ajax_get_user.html";i:1503927232;}*/ ?>
<div class="table-responsive">
     <table class="table table-bordered table-hover">
         <thead>
             <td class="text-left"><input type="checkbox" onclick="$('input[name*=\'user_id\']').prop('checked', this.checked);">全选</td>
             <td class="text-left">会员ID</td>            
             <td class="text-left">会员等级</td>
             <td class="text-left">会员昵称 </td>
             <td class="text-left">手机</td>
             <td class="text-left">邮箱</td>
             <td class="text-left">操作</td>
         </tr>
         </thead>
         <tbody id="goos_table">
             <?php if(is_array($userList) || $userList instanceof \think\Collection || $userList instanceof \think\Paginator): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                  <tr>
                  	<td class="text-left">                
                           <input type="checkbox" name="user_id[]" value="<?php echo $list['user_id']; ?>"/>
                      </td>
                      <td class="text-left"><?php echo $list['user_id']; ?></td>
                      <td class="text-left"><?php echo $user_level[$list[level]]; ?></td>
                      <td class="text-left">
                        <?php if($list[nickname] == null): if($list[oauth] == 'weixin'): ?>微信用户<?php endif; if($list[oauth] == 'weibo'): ?>微博用户<?php endif; if($list[oauth] == 'alipay'): ?>支付宝用户<?php endif; if($list[oauth] == 'qq'): ?>QQ用户<?php endif; else: ?>
                                <?php echo $list['nickname']; endif; ?>
                      </td>
                      <td class="text-left"><?php echo $list['mobile']; ?></td>
                      <td class="text-left"><?php echo $list['email']; ?></td>
                      <td><a href="javascript:void(0)" onclick="javascript:$(this).parent().parent().remove();">删除</a></td>
                  </tr>                              
         	<?php endforeach; endif; else: echo "" ;endif; ?>   
         </tbody>
     </table>
 </div>
 <div class="row">
    <div class="text-left col-sm-10">
       <?php echo $page; ?>
    </div>
   <div class="text-right col-sm-2">
                          
	</div>
</div>			    
<script>
    $(".pagination  a").click(function(){
        var page = $(this).data('p');
        ajax_get_table('search-form2',page);
    });
</script>