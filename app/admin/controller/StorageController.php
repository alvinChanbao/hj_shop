<?php


namespace app\admin\controller;

class StorageController extends AdminBaseController
{

    /*
    * @Date：2019-05-23
    * @Title: 添加图片入口
    * @Author：Frank_dai
    * */
    public function add()
    {
        return $this->fetch();
    }

    /*
    * @Date：2019-05-23
    * @Title: 添加图片提交
    * @Author：Frank_dai
    * */
    public function addpost()
    {
        $file = request()->file('file');
        $path = "/public/uploads/";
        $info = $file->move( APP_ROOT.$path);
        if($info){
            // 成功上传后 获取上传信息
            $this->success("上传成功",'',['filename'=> $info->getFilename(),'path'=> $info->getSaveName()]);
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}