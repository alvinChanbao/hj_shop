<?php

namespace app\admin\validate;
use think\Validate;
class UserValidate extends Validate
{
    protected $rule = [
        'user_login'  =>  'require|max:20',
        'user_password' =>  'require',
    ];
}