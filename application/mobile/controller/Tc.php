<?php
namespace app\mobile\controller;
class Tc extends MobileBase{
    public function index(){
        $tc_list = M("Tc")->where('tc_status=1')->select();
        $this->assign("tc_list",$tc_list);
        return $this->fetch();
    }

    public function tcInfo(){
        $tc_id = I('id');
        if(!is_numeric($tc_id)){
            $msg = "参数错误";
            $this->assign('msg',$msg);
            return $this->fetch("error");
        }
        $tc_info = M('tc')->where(array('tc_id'=>$tc_id,'tc_status'=>1))->find();

        if(!$tc_info){
            $this->assign("msg","该套餐已下架");
            return $this->fetch("error");
        }
        $tc_month_list = M('tc_month')->where(array('tc_id'=>$tc_id,'tc_status'=>1))->select();
        $this->assign("tc_info",$tc_info);
        $this->assign("tc_month_list",$tc_month_list);
        return $this->fetch();
    }

    /**
     * 套餐 月 配送信息详情
     */
    public function tcMonthInfo(){
        $tc_month_id = I('id');
        $res = M('tcMonth')->where(array('tc_month_id'=>$tc_month_id,'tc_status'=>1))->find();
        if($res){
            $this->assign('res',$res);
            return $this->fetch();
        }else{
            $msg = "该月配送异常，请刷新重试！";
            $this->assign('msg',$msg);
            return $this->fetch("error");
        }
    }

}