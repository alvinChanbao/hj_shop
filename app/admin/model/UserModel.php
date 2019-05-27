<?php

namespace app\admin\model;
use think\Model;
class UserModel extends Model
{
    function getUserInfoByUserLogin($user_login)
    {
       $data = $this->where(function ($query) use ($user_login){
            if ($user_login){
                $query->where('user_login',$user_login);
            }
       })->find();

       return $data;
    }
}