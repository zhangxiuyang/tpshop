<?php
namespace app\admin\controller;
use app\admin\logic\TcGoodsLogic;
use app\admin\logic\GoodsLogic;
use app\admin\logic\SearchWordLogic;
use think\AjaxPage;
use think\Loader;
use think\Page;
use think\Db;
class Tc extends Base{
/*套餐商品 开始*/

    /**
     * 套餐商品列表
     */
    public function tcGoodsList(){
        $TcGoodsLogic = new TcGoodsLogic();
        $brandList = $TcGoodsLogic->getSortBrands();
        $categoryList = $TcGoodsLogic->getSortCategory();
        $this->assign('categoryList',$categoryList);
        $this->assign('brandList',$brandList);
        return $this->fetch();
    }
    /**
     *  商品列表
     */
    public function ajaxGoodsList(){

        $where = ' 1 = 1 '; // 搜索条件
        I('intro')    && $where = "$where and ".I('intro')." = 1" ;
        I('brand_id') && $where = "$where and brand_id = ".I('brand_id') ;
        (I('is_on_sale') !== '') && $where = "$where and is_on_sale = ".I('is_on_sale') ;
        $cat_id = I('cat_id');
        // 关键词搜索
        $key_word = I('key_word') ? trim(I('key_word')) : '';
        if($key_word)
        {
            $where = "$where and (goods_name like '%$key_word%' or goods_sn like '%$key_word%')" ;
        }

        if($cat_id > 0)
        {
            $grandson_ids = getCatGrandson($cat_id);
            $where .= " and cat_id in(".  implode(',', $grandson_ids).") "; // 初始化搜索条件
        }

        $count = M('TcGoods')->where($where)->count();
        $Page  = new AjaxPage($count,10);
        /**  搜索条件下 分页赋值
        foreach($condition as $key=>$val) {
        $Page->parameter[$key]   =   urlencode($val);
        }
         */
        $show = $Page->show();
        $order_str = "`{$_POST['orderby1']}` {$_POST['orderby2']}";
        $goodsList = M('TcGoods')->where($where)->order($order_str)->limit($Page->firstRow.','.$Page->listRows)->select();

        $catList = D('tc_goods_category')->select();
        $catList = convert_arr_key($catList, 'id');
        $this->assign('catList',$catList);
        $this->assign('goodsList',$goodsList);
        $this->assign('page',$show);// 赋值分页输出
        return $this->fetch();
    }

    /**
     * 删除商品
     */
    public function delGoods()
    {
        $goods_id = input('id');
        $error = '';

        if($error)
        {
            $return_arr = array('status' => -1,'msg' =>$error,'data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
            $this->ajaxReturn($return_arr);
        }

        // 删除此商品
        M("TcGoods")->where('goods_id ='.$goods_id)->delete();  //商品表

        M("goods_images")->where('goods_id ='.$goods_id)->delete();  //商品相册

        $return_arr = array('status' => 1,'msg' => '操作成功','data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
        $this->ajaxReturn($return_arr);
    }

    /**
     * 添加修改商品
     */
    public function addEditGoods()
    {
        $GoodsLogic = new TcGoodsLogic();
        $Goods = new \app\admin\model\TcGoods();
        $goods_id = I('goods_id');
        $type = $goods_id > 0 ? 2 : 1; // 标识自动验证时的 场景 1 表示插入 2 表示更新
        //ajax提交验证
        if ((I('is_ajax') == 1) && IS_POST) {
            // 数据验证
            $is_distribut = input('is_distribut');
            $return_url = $is_distribut > 0 ? U('admin/Distribut/goods_list') : U('admin/Tc/tcGoodsList');
            $data = input('post.');
            $validate = \think\Loader::validate('TcGoods');
            if (!$validate->batch()->check($data)) {
                $error = $validate->getError();
                $error_msg = array_values($error);
                $return_arr = array(
                    'status' => -1,
                    'msg' => $error_msg[0],
                    'data' => $error,
                );
                $this->ajaxReturn($return_arr);
            }
            $Goods->data($data, true); // 收集数据
            $Goods->on_time = time(); // 上架时间
            I('cat_id_2') && ($Goods->cat_id = I('cat_id_2'));
            I('cat_id_3') && ($Goods->cat_id = I('cat_id_3'));

            if ($type == 2) {
                $Goods->isUpdate(true)->save(); // 写入数据到数据库
                // 修改商品后购物车的商品价格也修改一下
               /* M('cart')->where("goods_id = $goods_id and spec_key = ''")->save(array(
                    'market_price' => I('market_price'), //市场价
                    'goods_price' => I('shop_price'), // 本店价
                    'member_goods_price' => I('shop_price'), // 会员折扣价
                ));*/
            } else {
                $Goods->save(); // 写入数据到数据库
                $goods_id = $insert_id = $Goods->getLastInsID();
            }
            $Goods->afterSave($goods_id);
            $GoodsLogic->saveGoodsAttr($goods_id, I('goods_type')); // 处理商品 属性
            $return_arr = array(
                'status' => 1,
                'msg' => '操作成功',
                'data' => array('url' => $return_url),
            );
            $this->ajaxReturn($return_arr);
        }

        $goodsInfo = M('TcGoods')->where('goods_id=' . I('GET.id', 0))->find();
        $level_cat = $GoodsLogic->find_parent_cat($goodsInfo['cat_id']); // 获取分类默认选中的下拉框
        $level_cat2 = $GoodsLogic->find_parent_cat($goodsInfo['extend_cat_id']); // 获取分类默认选中的下拉框
        $cat_list = M('tc_goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
        $brandList = $GoodsLogic->getSortBrands();
        $goodsType = M("GoodsType")->select();
        $suppliersList = M("suppliers")->select();
        $plugin_shipping = M('plugin')->where(array('type' => array('eq', 'shipping')))->select();//插件物流
        $shipping_area = D('Shipping_area')->getShippingArea();//配送区域
        $goods_shipping_area_ids = explode(',', $goodsInfo['shipping_area_ids']);
        $this->assign('goods_shipping_area_ids', $goods_shipping_area_ids);
        $this->assign('shipping_area', $shipping_area);
        $this->assign('plugin_shipping', $plugin_shipping);
        $this->assign('suppliersList', $suppliersList);
        $this->assign('level_cat', $level_cat);
        $this->assign('level_cat2', $level_cat2);
        $this->assign('cat_list', $cat_list);
        $this->assign('brandList', $brandList);
        $this->assign('goodsType', $goodsType);
        $this->assign('goodsInfo', $goodsInfo);  // 商品详情
        $goodsImages = M("GoodsImages")->where('goods_id =' . I('GET.id', 0))->select();
        $this->assign('goodsImages', $goodsImages);  // 商品相册
        return $this->fetch('_goods');
    }



    /*套餐商品 结束*/

    /**
     * 品牌列表
     */
    public function brandList(){
        $model = M("Brand");
        $where = "";
        $keyword = I('keyword');
        $where = $keyword ? " name like '%$keyword%' " : "";
        $count = $model->where($where)->count();
        $Page = $pager = new Page($count,10);
        $brandList = $model->where($where)->order("`sort` asc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $show  = $Page->show();
        $cat_list = M('goods_category')->where("parent_id = 0")->getField('id,name'); // 已经改成联动菜单
        $this->assign('cat_list',$cat_list);
        $this->assign('pager',$pager);
        $this->assign('show',$show);
        $this->assign('brandList',$brandList);
        return $this->fetch('brandList');
    }

    /**
     * 添加修改编辑  商品品牌
     */
    public  function addEditBrand(){
        $id = I('id');
        if(IS_POST){
            $data = I('post.');
            $brandVilidate = Loader::validate('Brand');

            if(!$brandVilidate->batch()->check($data)){
                $return = array('status'=>0,'msg'=>'操作失败','result'=>$brandVilidate->getError());
                $this->ajaxReturn($return);
            }
            if($id){
                M("Brand")->update($data);
            }else{
                M("Brand")->insert($data);
            }

            $this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','result'=>array('return_url'=>U('Admin/Tc/brandList'))));
        }
        //$cat_list = M('goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
        //$this->assign('cat_list',$cat_list);
        $brand = M("Brand")->find($id);
        $this->assign('brand',$brand);
        return $this->fetch('_brand');
    }

    /**
     * 删除品牌
     */
    public function delBrand()
    {
        // 判断此品牌是否有商品在使用
        $goods_count = M('Goods')->where("brand_id = {$_GET['id']}")->count('1');
        $tc_goods_count = M('TcGoods')->where("brand_id = {$_GET['id']}")->count('1');
        if($goods_count || $tc_goods_count)
        {
            $return_arr = array('status' => -1,'msg' => '此品牌有商品在用不得删除!','data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
            $this->ajaxReturn($return_arr);
        }

        $model = M("Brand");
        $model->where('id ='.$_GET['id'])->delete();
        $return_arr = array('status' => 1,'msg' => '操作成功','data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
        $this->ajaxReturn($return_arr);
    }


/*套餐商品分类开始*/
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

        /**
         * 删除分类
         */
        public function delGoodsCategory(){
            $id = $this->request->param('id');
            // 判断子分类
            $GoodsCategory = M("tc_goods_category");
            $count = $GoodsCategory->where("parent_id = {$id}")->count("id");
            $count > 0 && $this->error('该分类下还有分类不得删除!',U('Admin/Tc/tcGoodsCategory'));
            // 判断是否存在商品
            $goods_count = M('TcGoods')->where("cat_id = {$id}")->count('1');
            $goods_count > 0 && $this->error('该分类下有商品不得删除!',U('Admin/Tc/tcGoodsCategory'));
            // 删除分类
            DB::name('tc_goods_category')->where('id',$id)->delete();
            $this->success("操作成功!!!",U('Admin/Tc/tcGoodsCategory'));
        }
/*套餐商品分类 结束*/

/*套餐商品列表 开始*/



/*套餐商品列表 结束*/
    //套餐列表

}