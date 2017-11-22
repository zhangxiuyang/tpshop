<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"./template/mobile/new2/activity\ajax_flash_sale.html";i:1503927242;}*/ ?>
<?php if(is_array($flash_sale_goods) || $flash_sale_goods instanceof \think\Collection || $flash_sale_goods instanceof \think\Paginator): if( count($flash_sale_goods)==0 ) : echo "" ;else: foreach($flash_sale_goods as $key=>$vo): ?>
    <li>
        <div class="img czg"><img src="<?php echo goods_thum_images($vo[goods_id],400,400); ?>" alt="" /></div>
        <div class="fon">
            <div class="similar-product-text"><?php echo $vo[goods_name]; ?></div>
            <div class="ms p">
                <div class="redmon">￥<span><?php echo $vo[price]; ?></span></div>
                <div class="qums">
                    <?php if($vo['percent'] < 100): ?>
                        <a href="<?php echo U('Goods/goodsInfo',array('id'=>$vo[goods_id],'item_id'=>$vo[spec_goods_price][item_id])); ?>" <?php if(($vo['end_time'] - time()) > 7200): ?>style="background-color: #666" <?php endif; ?>>
                            <?php if(($vo['end_time'] - time()) > 7200): ?>未开场<?php else: ?>去秒杀<?php endif; ?>
                        </a>
                    <?php else: ?>
                        <a style="background-color: #aaa">已售馨</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ce">
                <div class="redmon">￥<?php if(empty($vo[spec_goods_price]) || (($vo[spec_goods_price] instanceof \think\Collection || $vo[spec_goods_price] instanceof \think\Paginator ) && $vo[spec_goods_price]->isEmpty())): ?><?php echo $vo['goods']['shop_price']; else: ?><?php echo $vo['spec_goods_price']['price']; endif; ?></div>
                <div class="jd">
                    <div class="ymper">已秒<span><?php echo !empty($vo['percent']) && $vo['percent']>100?100 : $vo['percent']; ?>%</span></div>
                    <div class="jdtred">
                        <div class="percent" style="width: <?php echo $vo['percent']; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </li>
<?php endforeach; endif; else: echo "" ;endif; ?>