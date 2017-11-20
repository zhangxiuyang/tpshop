<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"./template/mobile/new2/activity\ajax_promote_goods.html";i:1503927242;}*/ ?>
<?php if(is_array($promote) || $promote instanceof \think\Collection || $promote instanceof \think\Paginator): if( count($promote)==0 ) : echo "" ;else: foreach($promote as $key=>$list): ?>
    <a href="<?php echo U('Activity/discount_list',array('id'=>$list[id])); ?>">
        <div class="banner">
            <img src="<?php echo $list[prom_img]; ?>"/>
        </div>
        <div class="cbaudience">
            <div class="maleri30">
                <p><?php echo $list[name]; ?></p>
                <p><?php echo date('Y.m',$list[start_time]); ?>————<?php echo date('Y.m',$list[end_time]); ?></p>
            </div>
        </div>
    </a>
<?php endforeach; endif; else: echo "" ;endif; ?>