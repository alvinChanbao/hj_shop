<?php


namespace app\admin\controller;


use app\admin\model\SliderModel;
use think\Controller;
use think\facade\Request;

class SliderController extends AdminBaseController
{
    /*
     * @Date：2019-06-09
     * @Title: 幻灯片首页
     * @Author：Frank_dai
     * */
    public function index()
    {
        $sliderModel = new SliderModel();
        $list = $sliderModel->getList();
        $page =$list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch();
    }

    /*
    * @Date：2019-06-09
    * @Title: 添加幻灯片
    * @Author：Frank_dai
    * */
    public function add()
    {
        return $this->fetch();
    }

    /*
     * @Date：2019-06-10
     * @Title: 添加幻灯片提交
     * @Author：Frank_dai
     * */
    public function addPost()
    {
        $data = Request::param();
        $sliderModel = new SliderModel();
        $res = $sliderModel->save($data);
        if ($res !== false){
            $this->success("提交成功");
        }
    }

    /*
    * @Date：2019-06-10
    * @Title: 编辑添加幻灯片
    * @Author：Frank_dai
    * */
    public function edit()
    {
        $id = Request::param('id');
        $sliderModel = new SliderModel();
        $data = $sliderModel->where('id',$id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /*
    * @Date：2019-06-10
    * @Title: 编辑添加幻灯片
    * @Author：Frank_dai
    * */
    public function editPost()
    {
        $data = Request::param();
        $sliderModel = new SliderModel();
        $res = $sliderModel->where('id',$data['id'])->update($data);
        if ($res !== false){
            $this->success("更新成功");
        }
    }

}