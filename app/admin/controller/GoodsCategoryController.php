<?php


namespace app\admin\controller;
use app\admin\model\GoodsCategoryModel;
use think\Controller;

class GoodsCategoryController extends AdminBaseController
{
    /*
    * @Date：2019-05-27
    * @Title:商品分类列表页
    * @Author：Frank_dai
    * */
    public function index()
    {
        $goodsCategoryModel = new GoodsCategoryModel();
        $data = $goodsCategoryModel->getList();
        $page = $data->render();
        $this->assign('list',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }

    /*
    * @Date：2019-05-27
    * @Title:添加分类开放接口
    * @Author：Frank_dai
    * */
    public function category_api()
    {
        $goodsCategoryModel = new GoodsCategoryModel();
        $data = $goodsCategoryModel->getList();
        $page = $data->render();
        $this->assign('list',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
}