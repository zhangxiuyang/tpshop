<?php
namespace app\mobile\controller;
class Tc extends MobileBase{
    public function index(){
        $tc_list = M("Tc")->where('tc_status=1')->select();
        $this->assign("tc_list",$tc_list);
        return $this->fetch();
    }
}