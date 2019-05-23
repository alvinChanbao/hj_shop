<?php


namespace app\admin\controller;
use think\Controller;

class AdminBaseController extends Controller
{
    /**
     * 前置方法
     * 获取默认主题
     * @Author:Frank Dai
     * date:  2019-02-13
     **/
    protected $beforeActionList = [
        'getTheme',
        'getTmpl',
        'isLogin'=>  ['except'=>'login']
    ];

    //获取主题路径
    protected function getTheme()
    {
        define('ADMIN_THEME','admin/default/');
        //获取默认模板路径
        $view_path = config('template.view_path').'admin/default/';
        //切换视图路径
        $this->view->config('view_path', $view_path);
    }

    //修改静态路径地址
    protected function getTmpl()
    {
        //获取项目host
       $host = request()->server()['REQUEST_SCHEME'].'://'.request()->host();
       $tmpl =  $host.'/themes/'.ADMIN_THEME.'public';
       $arr = [
           '__TMPL__'=> $tmpl
       ];
        //重新渲染列表
       $this->view->config('tpl_replace_string',  $arr);
    }

    //判断用户是否登陆
    protected function isLogin()
    {
        $is_login = session('?admin_id');
        //没有登陆跳转到登陆页面
        if (!$is_login){
            $this->redirect('admin/index/login');
        }
    }

}