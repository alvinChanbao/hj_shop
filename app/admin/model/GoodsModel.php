<?php


namespace app\admin\model;


use think\Model;

class GoodsModel extends Model
{
    public function getGoodsList($where = null)
    {
       $data = $this->where(function ($query) use ($where){
            if ($where){
                $query->where($where);
            }
        })->paginate(10);

       return $data;
    }
}