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
}