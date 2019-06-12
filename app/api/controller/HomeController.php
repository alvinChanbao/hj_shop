<?php


namespace app\api\controller;


use app\admin\model\SliderItemModel;

class HomeController extends RestBaseController
{
    public function slider()
    {
        $sliderItemModel = new SliderItemModel();
        $where = array('slide_id'=>1);
        $data = $sliderItemModel->getList($where);
        $this->success('获取成功','',['data'=>$data]);
    }
}