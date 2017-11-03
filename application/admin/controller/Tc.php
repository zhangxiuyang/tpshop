<?php

namespace app\admin\controller;
class Tc extends Base{
    //套餐商品列表
    public function tcGoodsList(){

    }
    //套餐商品分类
    public function tcGoodsCategory(){
        $GoodsLogic = new GoodsLogic();
        $cat_list = $GoodsLogic->goods_cat_list();
        $this->assign('cat_list',$cat_list);
        return $this->fetch();
    }
    //套餐列表
    //套餐相册
}