<?php

namespace app\admin\model;
use think\Model;

class GoodsCategoryModel extends Model
{

    //获取缩进空白
    public function getBlankAttr($value,$data){
        $patt = '/-/';
        $res = preg_match_all($patt,$data['path']);
        return str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$res - 1);
    }

    //获取当前级别样式
    public function getLevelAttr($value,$data)
    {
        if ($data['parent_id'] == 0){
            return '';
        }
        else{
           $last_id = $this->where('parent_id',$data['parent_id'])->order('id desc')->value('id');

           if ($data['id'] == $last_id){
               return '└─ ';
           }
           else{
               return '├─';
           }
        }
    }

    public function getList($where = null)
    {
        $data = $this->where(function ($query) use ($where){
            if ($where){
                $query->where($query);
            }
        })->order('path')->paginate(10);
        return $data;
    }
}