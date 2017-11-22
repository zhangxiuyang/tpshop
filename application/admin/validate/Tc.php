<?php
namespace app\admin\Validate;
use think\Validate;
class Tc extends Validate{
    //验证规则
    protected $rule = array(
        'tc_name'            => 'require|max:90',
        'price'              => 'require|number|egt:0.00|elt:99999.99',
    );
    //错误信息
    protected $message = array(
        'tc_name.require'                            => '套餐名称必填',
        'tc_name.max'                                => '名称长度至多50个汉字',
        'price.require'                              => '价格必须填写',
        'price.number'                               => '价格必须为数字',
        'price.egt'                                  => '价格必须大于等于0.00',
        'price.elt'                                  => '价格必须小于等于99999.99',
    );

}