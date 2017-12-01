<?php
namespace app\mobile\controller;
use app\common\logic\CartLogic;
class TcBuy extends MobileBase{
    /**
     * 点击购买 进入套餐信息
     * 展示购买套餐信息，选择开始配送月份，最近为次月开始
     */
     public function buy1()
    {
        $address_id = I('address_id/d');
        $tc_id = I('tc_id/d');
        if($this->user_id == 0){
            header("location:" . U('Mobile/User/login',array('sourse'=>'buy1','tc_id'=>$tc_id)));
        }
        //套餐调取 及 状态检测
        $tcInfo = M('tc')->where("tc_id", $tc_id)->find();
        if($tcInfo['tc_status'] != 1){
            $this->error('该套餐已下架',U('Mobile/Tc/index'));
            exit;
        }
        if($address_id){
            $address = M('user_address')->where("address_id", $address_id)->find();
        } else {
            $address = M('user_address')->where(['user_id'=>$this->user_id,'is_default'=>1])->find();
        }
        if(empty($address)){
            $count = M('user_address')->where(['user_id'=>$this->user_id])->count();
            if($count>0){
                header("Location: ".U('Mobile/User/address_list',array('source'=>'buy1','tc_id'=>$tc_id)));
            }else{
                header("Location: ".U('Mobile/User/add_address',array('source'=>'buy1','tc_id'=>$tc_id)));
            }
            exit;
        }else{
            $this->assign('address',$address);
        }


        $this->assign('tcInfo', $tcInfo); // 购物车的商品
        return $this->fetch();
    }

    /**
     * ajax 提交 订单
     */
    public function buy2(){

        if($this->user_id == 0){
            exit(json_encode(array('status'=>-100,'msg'=>"登录超时请重新登录!",'result'=>null))); // 返回结果状态
        }
        $address_id = I("address_id/d"); //  收货地址id
        $user_note = trim(I('user_note'));   //买家留言

        if(!$address_id) exit(json_encode(array('status'=>-3,'msg'=>'请先填写收货人信息','result'=>null))); // 返回结果状态

        // 提交订单
        if($_REQUEST['act'] == 'submit_order') {
            if(empty($coupon_id) && !empty($couponCode)){
                $coupon_id = M('CouponList')->where("code", $couponCode)->getField('id');
            }
            $orderLogic = new OrderLogic();
            $result = $orderLogic->addOrder($this->user_id,$address_id,$shipping_code,$invoice_title,$coupon_id,$car_price,$user_note,$pay_name); // 添加订单
            exit(json_encode($result));
        }
    }
}