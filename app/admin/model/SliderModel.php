<?php


namespace app\admin\model;
use think\Model;

class SliderModel extends Model
{
    public function getList($where = null){

       $data = $this->where(function ($query) use ($where){
            if ($where){}
        })->paginate(10);

        return $data;

    }
}