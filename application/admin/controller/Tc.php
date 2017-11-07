<?php

namespace app\admin\controller;
use app\admin\logic\TcGoodsLogic;
use think\AjaxPage;
class Tc extends Base{
    //套餐商品列表
    public function tcGoodsList(){

    }
    /**
     * 套餐商品分类
     */
    public function tcGoodsCategory(){
        $GoodsLogic = new TcGoodsLogic();
        $cat_list = $GoodsLogic->tc_goods_cat_list();
        $this->assign('cat_list',$cat_list);
        return $this->fetch();
    }

        /**
         * 添加修改商品分类
         */
        public function addEditGoodsCategory(){


            $TcGoodsLogic = new TcGoodsLogic();
            if(IS_GET)
            {
                $goods_category_info = D('TcGoodsCategory')->where('id='.I('GET.id',0))->find();
                $level_cat = $TcGoodsLogic->find_parent_cat($goods_category_info['id']); // 获取分类默认选中的下拉框

                $cat_list = M('tc_goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
                $this->assign('cat_list',$cat_list);
                $this->assign('goods_category_info',$goods_category_info);
                return $this->fetch('_tc_category');
                exit;
            }
           // die(123);
            $GoodsCategory = D('TcGoodsCategory'); //

            $type = I('id') > 0 ? 2 : 1; // 标识自动验证时的 场景 1 表示插入 2 表示更新

            //ajax提交验证
            if(I('is_ajax') == 1)
            {
                // 数据验证
                $validate = \think\Loader::validate('TcGoodsCategory');
                if(!$validate->batch()->check(input('post.')))
                {
                    $error = $validate->getError();
                    $error_msg = array_values($error);
                    $return_arr = array(
                        'status' => -1,
                        'msg' => $error_msg[0],
                        'data' => $error,
                    );
                    $this->ajaxReturn($return_arr);
                } else {

                    $GoodsCategory->data(input('post.'),true); // 收集数据
                    $GoodsCategory->parent_id = I('parent_id_1');
                    input('parent_id_2') && ($GoodsCategory->parent_id = input('parent_id_2'));
                    //编辑判断
                    if($GoodsCategory->id > 0 && $GoodsCategory->parent_id == $GoodsCategory->id)
                    {
                        //  编辑
                        $return_arr = array(
                            'status' => -1,
                            'msg'   => '上级分类不能为自己',
                            'data'  => '',
                        );
                        $this->ajaxReturn($return_arr);
                    }


                    if ($type == 2)
                    {
                        $GoodsCategory->isUpdate(true)->save(); // 写入数据到数据库
                        $TcGoodsLogic->refresh_cat(I('id'));
                    }
                    else
                    {
                        //排序 默认 50
                        if($GoodsCategory->sort==''){
                            $GoodsCategory->sort='50';
                        }
                        $GoodsCategory->save(); // 写入数据到数据库
                        $insert_id = $GoodsCategory->getLastInsID();
                        $TcGoodsLogic->refresh_cat($insert_id);
                    }
                    $return_arr = array(
                        'status' => 1,
                        'msg'   => '操作成功',
                        'data'  => array('url'=>U('Admin/Tc/tcGoodsCategory')),
                    );
                    $this->ajaxReturn($return_arr);

                }
            }

        }
        /**
         * 获取下级分类
         */
        public function get_tc_category(){
            $parent_id = I('parent_id'); // 商品分类 父id
            $list = M('tc_goods_category')->where("parent_id", $parent_id)->select();
            $html="";
            foreach($list as $k => $v)
                $html .= "<option value='{$v['id']}'>{$v['name']}</option>";
            exit($html);
        }
    function delGoodsCategory(){}

    //套餐列表
    //套餐相册
}