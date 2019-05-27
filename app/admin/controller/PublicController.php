<?php


namespace app\admin\controller;

use app\admin\model\UserModel;
use app\admin\validate\UserValidate;
use think\facade\Request;
use think\facade\Session;

class PublicController extends AdminBaseController
{
    /*
    * @Date：2019-05-23
    * @Title: 用户登陆模块
    * @Author：Frank_dai
    * */
    public function login()
    {
        return $this->fetch(':login');
    }

    /*
    * @Date：2019-05-24
    * @Title: 用户登陆提交
    * @Author：Frank_dai
    * */
    public function loginPost()
    {
        $data = Request::post();
        $user = $data['user'];

        $userValidate = new UserValidate();
        $res = $userValidate->check($user);
        if (!$res){
            $this->error($userValidate->getError());
        }
        //获取传过来加密过后的Md5密码
        $password = getMd5($user['user_password']);
        $userModel = new UserModel();
        $info = $userModel->getUserInfoByUserLogin($user['user_login']);
        if (strcmp($info['user_password'],$password) === 0 ){
            session('admin_id',$info['id']);
            session('admin_user',json_encode($info));
            $this->success('登录成功！',url('admin/index/index'));
        }
        else{
            $this->error('用户帐号或密码错误！');
        }
    }

    /*
    * @Date：2019-05-24
    * @Title: 用户退出登录
    * @Author：Frank_dai
    * */
    public function exitLogin()
    {
        Session::delete('admin_id');
        Session::delete('admin_user');
        $this->redirect("admin/public/login");
    }
}