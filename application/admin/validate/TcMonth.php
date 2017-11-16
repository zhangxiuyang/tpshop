<?php
namespace app\admin\Validate;
use think\Validate;
class TcMonth extends Validate{
    //验证规则
    protected $rule = array(
        'tc_month_name'            => 'require|max:90',
        'tc_id'                    => 'require',
        'goods_id'                 => 'require',
    );
    //错误信息
    protected $message = array(
        'tc_name.require'                            => '套餐名称必填',
        'tc_name.max'                                => '名称长度至多90个汉字',
        'tc_id.require'                              => '月套餐所属套餐分类必填',
        'goods_id.require'                           => '未选择月套餐商品',
    );
}