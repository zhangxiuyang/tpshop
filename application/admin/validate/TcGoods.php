<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class TcGoods extends Validate
{

    // 验证规则
    protected $rule = [
        'goods_id'              =>'checkGoodsId',
        'goods_name'            => 'require|min:3|max:150|unique:goods',
        'cat_id'                => 'number|gt:0',
        'goods_sn'              =>'unique:goods|max:20',
        'shop_price'            =>['require','regex'=>'([1-9]\d*(\.\d*[1-9])?)|(0\.\d*[1-9])'],
        'market_price'          =>'require|regex:\d{1,10}(\.\d{1,2})?$|checkMarketPrice',
    ];
    //错误信息
    protected $message  = [
        'goods_name.require'                            => '商品名称必填',
        'goods_name.min'                                => '名称长度至少3个字符',
        'goods_name.max'                                => '名称长度至多50个汉字',
        'goods_name.unique'                             => '商品名称重复',
        'cat_id.number'                                 => '商品分类必须填写',
        'cat_id.gt'                                     => '商品分类必须选择',
        'goods_sn.unique'                               => '商品货号重复',
        'goods_sn.max'                                  => '商品货号超过长度限制',
        'shop_price.require'                            => '本店售价必须',
        'shop_price.regex'                              => '本店售价格式不对',
        'market_price.require'                          => '市场价格必填',
        'market_price.regex'                            => '市场价格式不对',
        'market_price.checkMarketPrice'                 => '市场价不得小于本店价',
    ];

    /**
     * 检查市场价
     * @param $value
     * @param $rule
     * @param $data
     * @return bool
     */
    protected function  checkMarketPrice($value,$rule,$data){
        if($value < $data['shop_price']){
            return false;
        }else{
            return true;
        }
    }
}