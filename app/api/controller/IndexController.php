<?php
namespace app\api\controller;

class IndexController extends RestBaseController
{

    public function index()
    {
        $this->success("部署成功",'',['msg' => 'Hello World']);
    }
}
