<?php
namespace app\admin\controller;

use think\App;
use think\Controller;

class IndexController extends AdminBaseController
{
    /*
     * @Date：2019-05-23
     * @Title: 首页入口
     * @Author：Frank_dai
     * */

    public function index()
    {
        return $this->fetch();
    }

    /*
    * @Date：2019-05-23
    * @Title: main首页入口
    * @Author：Frank_dai
    * */
    public function main()
    {
        return $this->fetch();
    }

    /*
    * @Date：2019-05-23
    * @Title: 用户登陆模块
    * @Author：Frank_dai
    * */
    public function login()
    {
        return $this->fetch(':login');
    }
}
