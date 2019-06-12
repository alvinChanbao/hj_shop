<?php


namespace app\admin\controller;

use app\admin\model\GoodsModel;
use think\facade\Request;

class GoodsController extends AdminBaseController
{
    /*
     * @Date：2019-05-24
     * @Title:商品列表页
     * @Author：Frank_dai
     * */
    public function index()
    {
        $goodsModel = new GoodsModel();
        $list = $goodsModel->getGoodsList();
        $page = $list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch();
}

    /*
    * @Date：2019-05-24
    * @Title:添加商品页
    * @Author：Frank_dai
    * */
    public function add()
    {
        return $this->fetch();
    }

    /*
   * @Date：2019-05-24
   * @Title:添加商品提交
   * @Author：Frank_dai
   * */
    public function addPost()
    {
       $data = Request::post();
       $goodsModel = new GoodsModel();
       $res = $goodsModel->addData($data);

       if ($res != false){
           $this->success("添加成功");
       }

       /*保存思路 用到事务
         1.首先将商品保存到商品表中
           goods_name  商品名
           thumbnail   缩略图
           category_id 所属分类
           details     详情内容
           is_top      0置顶 1取消
           recommended 0推荐 1取消

        2.写入key到attr_key表

        3.逐个将多规格商品写入规格表tableData
          获取sku_id
          遍历sku规格写入到attr_value表中
          遍历sku规格关系写入relation表
          sku_id key_id value_id
       */
    }

    /*
  * @Date：2019-06-03
  * @Title:编辑商品
  * @Author：Frank_dai
  * */
    public function edit()
    {
        $id = Request::param('id');
        if(!$id){
            $this->error("id不能为空！");
        }

        $goodsModel = new GoodsModel();
        $data = $goodsModel->getAllDataById($id);
        $this->assign('data',$data);
        return $this->fetch();

    }

    /*
   * @Date：2019-06-08
   * @Title:设置商品提交
   * @Author：Frank_dai
   * */
    public function editPost()
    {
        $data = Request::param();
        //print_r($data);
        $goodsModel = new GoodsModel();
        $res = $goodsModel->editData($data);

        if ($res != false){
            $this->success("修改成功");
        }
    }

    /*
   * @Date：2019-06-03
   * @Title:设置商品上下架
   * @Author：Frank_dai
   * */
    public function setGoodsStatus()
    {
        $id = Request::param('id');
        if(!$id){
            $this->error("id不能为空！");
        }
        $goodsModel = new GoodsModel();
        $res = $goodsModel->setGoodsStatus($id);
        if ($res){
            $this->success('更新成功');
        }
        else{
            $this->error('更新失败');
        }
    }


}