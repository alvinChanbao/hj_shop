<?php


namespace app\admin\controller;


use app\admin\model\SliderItemModel;
use app\admin\model\SliderModel;
use think\facade\Request;

class SliderItemController extends AdminBaseController
{

    /*
     * @Date：2019-06-11
     * @Title: 幻灯片列表首页
     * @Author：Frank_dai
     * */
    public function index()
    {
        $slide_id = Request::param('slide_id');
        if (!$slide_id){
            $this->error("slder_id不存在！");
        }
        $where = ['slide_id' => $slide_id];
        $sliderItemModel = new SliderItemModel();
        $list            = $sliderItemModel->getList($where);
        $page            = $list->render();
        $this->assign('slide_id', $slide_id);
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch();
    }

    /*
    * @Date：2019-06-11
    * @Title: 添加幻灯片列表页
    * @Author：Frank_dai
    * */
    public function add()
    {
        $slide_id = Request::param('slide_id');
        $this->assign('slide_id', $slide_id);
        return $this->fetch();
    }

    /*
    * @Date：2019-06-11
    * @Title: 提交幻灯片列表页
    * @Author：Frank_dai
    * */
    public function addPost()
    {
        $data            = Request::param();
        $sliderItemModel = new SliderItemModel();
        $res             = $sliderItemModel->save($data);
        if ($res !== false) {
            $this->success('添加成功');
        }
    }

    /*
    * @Date：2019-06-11
    * @Title: 编辑幻灯片列表页
    * @Author：Frank_dai
    * */
    public function edit()
    {
        $id = Request::param('id');
        if (!$id){
            $this->error("id不存在！");
        }
        $slide_id = Request::param('slide_id');
        if (!$slide_id){
            $this->error("slder_id不存在！");
        }
        $this->assign('slide_id', $slide_id);
        $sliderItemModel = new SliderItemModel();
        $data = $sliderItemModel->where('id',$id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /*
    * @Date：2019-06-11
    * @Title: 编辑幻灯片列表页提交
    * @Author：Frank_dai
    * */
    public function editPost()
    {
        $data = Request::param();
        $sliderItemModel = new SliderItemModel();
        $res = $sliderItemModel->where('id',$data['id'])->update($data);
        if ($res !== false){
            $this->success('编辑成功');
        }
    }
}