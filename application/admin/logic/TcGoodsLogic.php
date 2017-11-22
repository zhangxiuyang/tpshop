<?php
namespace app\admin\logic;

use think\Model;
use think\db;
class TcGoodsLogic extends Model{

    /**
     * 获得指定分类下的子分类的数组
     * @access  public
     * @param   int     $cat_id     分类的ID
     * @param   int     $selected   当前选中分类的ID
     * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
     * @param   int     $level      限定返回的级数。为0时返回所有级数
     * @return  mix
     */
    public function tc_goods_cat_list($cat_id = 0, $selected = 0, $re_type = true, $level = 0)
    {
        global $goods_category, $goods_category2;
        $sql = "SELECT * FROM  __PREFIX__tc_goods_category ORDER BY parent_id , sort ASC";
        $goods_category = DB::query($sql);
        $goods_category = convert_arr_key($goods_category, 'id');

        foreach ($goods_category AS $key => $value)
        {
            if($value['level'] == 1)
                $this->get_cat_tree($value['id']);
        }

        return $goods_category2;
    }

    /**
     * 获取指定id下的 所有分类
     * @global type $goods_category 所有商品分类
     * @param type $id 当前显示的 菜单id
     * @return 返回数组 Description
     */
    public function get_cat_tree($id)
    {
        global $goods_category, $goods_category2;
        $goods_category2[$id] = $goods_category[$id];
        foreach ($goods_category AS $key => $value){
            if($value['parent_id'] == $id)
            {
                $this->get_cat_tree($value['id']);
                $goods_category2[$id]['have_son'] = 1; // 还有下级
            }
        }
    }

    /**
     *  获取选中的下拉框
     * @param type $cat_id
     */
    function find_parent_cat($cat_id)
    {
        if($cat_id == null)
            return array();

        $cat_list =  M('tc_goods_category')->getField('id,parent_id,level');
        $cat_level_arr[$cat_list[$cat_id]['level']] = $cat_id;

        // 找出他老爸
        $parent_id = $cat_list[$cat_id]['parent_id'];
        if($parent_id > 0)
            $cat_level_arr[$cat_list[$parent_id]['level']] = $parent_id;
        // 找出他爷爷
        $grandpa_id = $cat_list[$parent_id]['parent_id'];
        if($grandpa_id > 0)
            $cat_level_arr[$cat_list[$grandpa_id]['level']] = $grandpa_id;

        // 建议最多分 3级, 不要继续往下分太多级
        // 找出他祖父
        $grandfather_id = $cat_list[$grandpa_id]['parent_id'];
        if($grandfather_id > 0)
            $cat_level_arr[$cat_list[$grandfather_id]['level']] = $grandfather_id;

        return $cat_level_arr;
    }

    /**
     * 改变或者添加分类时 需要修改他下面的 level
     * @global type $cat_list 所有商品分类
     * @return 返回数组 Description
     */
    public function refresh_cat($id)
    {
        $GoodsCategory = M("TcGoodsCategory"); // 实例化User对象
        $cat = $GoodsCategory->where("id = $id")->find(); // 找出他自己

        if($cat['parent_id'] == 0) //有可能是顶级分类 他没有老爸
        {
            $parent_cat['level'] = 0;
        }
        else{
            $parent_cat = $GoodsCategory->where("id = {$cat['parent_id']}")->find(); // 找出他老爸
        }
        $replace_level = $cat['level'] - ($parent_cat['level'] + 1); // 看看他 相比原来的等级 升级了多少  ($parent_cat['level'] + 1) 他老爸等级加一 就是他现在要改的等级
        Db::execute("UPDATE `__PREFIX__tc_goods_category` SET level = (level - $replace_level) WHERE  id = '{$id}'");
        Db::execute("UPDATE `__PREFIX__tc_goods_category` SET level = (level - $replace_level) WHERE  parent_id = '{$id}'");
    }



    /**
     *  获取排好序的品牌列表
     */
    function getSortBrands(){
        $brandList = S('getSortBrands',$brandList);
        if(!empty($brandList))
            return $brandList;
        $brandList =  M("Brand")->cache(true)->select();
        $brandIdArr =  M("Brand")->cache(true)->where("name in (select `name` from `".C('database.prefix')."brand` group by name having COUNT(id) > 1)")->getField('id,cat_id');
        $goodsCategoryArr = M('goodsCategory')->cache(true)->where("level = 1")->getField('id,name');
        $nameList = array();
        foreach($brandList as $k => $v)
        {

            $name = getFirstCharter($v['name']) .'  --   '. $v['name']; // 前面加上拼音首字母

            if(array_key_exists($v[id],$brandIdArr) && $v[cat_id]) // 如果有双重品牌的 则加上分类名称
                $name .= ' ( '. $goodsCategoryArr[$v[cat_id]] . ' ) ';

            $nameList[] = $v['name'] = $name;
            $brandList[$k] = $v;
        }
        array_multisort($nameList,SORT_STRING,SORT_ASC,$brandList);

        S('getSortBrands',$brandList);
        return $brandList;
    }

    /**
     *  获取排好序的分类列表
     */
    function getSortCategory()
    {
        $categoryList = S('tcCategoryList');
        if($categoryList)
        {
            return $categoryList;
        }
        $categoryList =  M("TcGoodsCategory")->cache(true)->getField('id,name,parent_id,level');
        $nameList = array();
        foreach($categoryList as $k => $v)
        {

            //$str_pad = str_pad('',($v[level] * 5),'-',STR_PAD_LEFT);
            $name = getFirstCharter($v['name']) .' '. $v['name']; // 前面加上拼音首字母
            //$name = getFirstCharter($v['name']) .' '. $v['name'].' '.$v['level']; // 前面加上拼音首字母
            /*
            // 找他老爸
            $parent_id = $v['parent_id'];
            if($parent_id)
                $name .= '--'.$categoryList[$parent_id]['name'];
            // 找他 爷爷
            $parent_id = $categoryList[$v['parent_id']]['parent_id'];
            if($parent_id)
                $name .= '--'.$categoryList[$parent_id]['name'];
            */
            $nameList[] = $v['name'] = $name;
            $categoryList[$k] = $v;
        }
        array_multisort($nameList,SORT_STRING,SORT_ASC,$categoryList);

        S('categoryList',$categoryList);
        return $categoryList;
    }
}
