<?php /*a:2:{s:63:"H:\project\hj_shop/public/themes/admin/default/storage\add.html";i:1558830779;s:63:"H:\project\hj_shop/public/themes/admin/default/public\head.html";i:1558677994;}*/ ?>
<!doctype html>
<html class="x-admin-sm" lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="http://hj_shop.com/themes/admin/default/public/assets/css/font.css">
    <link rel="stylesheet" href="http://hj_shop.com/themes/admin/default/public/assets/css/xadmin.css">
    <!-- <link rel="stylesheet" href="http://hj_shop.com/themes/admin/default/public/assets/css/theme5.css"> -->
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://hj_shop.com/themes/admin/default/public/assets/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://hj_shop.com/themes/admin/default/public/assets/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
    <style>
        .td-manage i{
            font-size: 20px !important;
        }
    </style>
<title>系统首页-火箭商城管理系统</title>
<style>

    body{
        height: 100%;
    }

    .layui-content{
        height: 100%;
        padding: 15px;
        margin-bottom: 0;
        box-sizing: border-box;
    }

    .layui-flex-content{
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-sizing: border-box;
    }

    #layui-row-content{
        display: none;
        padding: 10px 0px;
        overflow: auto;
    }

    #layui-row-content .wrap_img{
        margin: 10px;
        height: 120px;
        width: auto;
        text-align: center;
        line-height: 120px;
        background: #f5f5f5;
        display: block;
    }

    #layui-row-content img{
        max-width: 100%;
        max-height: 100%;
    }

    .text-center{
        text-align: center;
    }

    #multi{
        display: none;
    }
</style>
</head>
<body>
<div id="layui-flex-content" class="layui-card layui-content layui-flex-content">
    <form id="form" method="post" action="<?php echo url('admin/storage/addPost'); ?>" enctype="multipart/form-data">
    <label for="file">
        <div class="text-center">
            <img src="http://hj_shop.com/themes/admin/default/public/assets/images/add.png" alt="">
        </div>
        <div class="text-center">
            <div class="layui-btn layui-btn-normal">选择图片</div>
        </div>
    </label>
    <input onchange="submitChange()" style="display: none" id="file" type="file" name="file" value="">
    </form>
</div>

<div id="layui-row-content" class="layui-card layui-content">
    <div class="layui-row">
        <div id="pic_content">

        </div>
        <div id="multi" class="layui-col-xs4 layui-col-sm4 layui-col-md4">
            <label for="file" class="wrap_img">
                <i class="icon iconfont">&#xe6b9;</i>
            </label>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://hj_shop.com/themes/admin/default/public/assets/js/jquery.form.js"></script>
<script>
   var  uploadConfig = [],picJson = eval('([])');
    $(function () {
        uploadConfig = window.parent.uploadConfig;
        console.log(uploadConfig);
        if (uploadConfig['multi'] === true){
            $("#multi").show();
        }
    });

    var submitChange=function () {
        $("#form").ajaxSubmit({
            success: function (res) {
                console.log(res);
                if (res.code == 1){
                    $("#layui-flex-content").hide();
                    $("#layui-row-content").show();

                    var str = `
                        <div class="layui-col-xs4 layui-col-sm4 layui-col-md4">
                            <div class="wrap_img">
                                <img src="/uploads/`+res.data.path+`" alt="">
                            </div>
                        </div>
                    `;
                    picJson.push("/uploads/"+res.data.path);
                    $("#pic_content").append(str);
                }
            }
        });
        return false;
    }

    function getJsonStr() {
        var jsonStr = picJson.join(',');
        console.log(jsonStr);
        return jsonStr;
    }
</script>
</body>
</html>