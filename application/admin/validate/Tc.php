<?php
namespace app\admin\Validate;
use think\Validate;
class Tc extends Validate{
    //验证规则
    protected $rule = array(
        'tc_name'            => 'require|max:90',
    );
    //错误信息
    protected $message = array(
        'tc_name.require'                            => '套餐名称必填',
        'tc_name.max'                                => '名称长度至多50个汉字',
    );

}