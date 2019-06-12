<?php


namespace app\admin\model;


use think\Model;

class SliderItemModel extends Model
{
    //获取幻灯片列表页
    public function getList($where = null)
    {
        $data = $this->where(function ($query) use ($where){
            if ($where){
                if ($where['slide_id']){
                    $query->where('slide_id',$where['slide_id']);
                }
            }
        })->order('list_order desc,id desc')->paginate(10);
        return $data;
    }
}