<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"./template/mobile/new2/user\ajax_message_notice.html";i:1503927244;}*/ ?>
<?php if(empty($messages) || (($messages instanceof \think\Collection || $messages instanceof \think\Paginator ) && $messages->isEmpty())): ?>
    <p class="norecode" style="font-size: 16px;color: #999999;padding:100px;text-align: center;">抱歉，您暂时没有要处理的消息！</p>
    <?php else: if(is_array($messages) || $messages instanceof \think\Collection || $messages instanceof \think\Paginator): if( count($messages)==0 ) : echo "" ;else: foreach($messages as $k=>$v): ?>
        <div class="news_list_fll">
            <div class="maleri30">
                <div class="fl news_c_img">
                </div>
                <div class="fl  news_c_tit">
                    <p>
                        <span class="news_h fl">系统消息 ：<?php echo date('Y-m-d',$v['send_time']); ?></span>
                    </p><p><?php echo $v['message']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; endif; else: echo "" ;endif; endif; ?>