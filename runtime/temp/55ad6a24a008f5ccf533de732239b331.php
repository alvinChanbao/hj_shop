<?php /*a:3:{s:61:"H:\project\hj_shop/public/themes/admin/default/goods\add.html";i:1558831855;s:63:"H:\project\hj_shop/public/themes/admin/default/public\head.html";i:1558831798;s:66:"H:\project\hj_shop/public/themes/admin/default/public\scripts.html";i:1558831798;}*/ ?>
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
    <title>添加商品-火箭商城管理系统</title>
    <style>
        .wrap_img {
            width: 150px;
        }

        .wrap_img img {
            width: 100%;
        }
    </style>
    </head>
    <body>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md10">
                <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <label for="goods_name" class="layui-form-label"><span class="x-red">*</span>商品名称</label>
                        <div class="layui-input-block">
                            <input type="text" id="goods_name" name="goods_name" required lay-verify="required"
                                   placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">缩略图</label>
                        <div class="layui-input-block">
                            <div onclick="uploadPic('#thumbnail')" class="wrap_img">
                                <img id="thumbnail_prev" src="http://hj_shop.com/themes/admin/default/public/assets/images/default-thumbnail.png" alt="">
                            </div>
                            <input type="hidden" id="thumbnail" name="thumbnail" required lay-verify="required"
                                   placeholder="请选择缩略图" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">商品详情</label>
                        <div class="layui-input-block">
                            <textarea id="details" style="display: none;"></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">推荐设置</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="like[write]" title="置顶">
                            <input type="checkbox" name="like[read]" title="推荐">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="sex" value="0" title="上架" checked>
                            <input type="radio" name="sex" value="1" title="下架">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    <script type="text/javascript" src="http://hj_shop.com/static/assets/js/vue.js"></script>
    <script>

        var uploadConfig = [];

        layui.use(['form', 'layer', 'jquery', 'layedit'],function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;
            var layedit = layui.layedit;
            layedit.build('details', {
                height: 150
            }); //建立编辑器
            //自定义验证规则
            form.verify({
                nikename: function (value) {
                    if (value.length < 5) {
                        return '昵称至少得5个字符啊';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                repass: function (value) {
                    if ($('#L_pass').val() != $('#L_repass').val()) {
                        return '两次密码不一致';
                    }
                }
            });

            //监听提交
            form.on('submit(add)',function (data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    layer.alert("增加成功", {
                            icon: 6
                        },
                        function () {
                            //关闭当前frame
                            xadmin.close();
                            // 可以对父窗口进行刷新
                            xadmin.father_reload();
                        });
                    return false;
                });
            });
        
        function  uploadPic(id,multi = '') {

            var url = "<?php echo url('admin/storage/add'); ?>";

            uploadConfig['multi'] = multi;

            layer.open({
                type: 2,
                area: ['600px', '400px'],
                title:'添加图片',
                content: [url, 'no'], //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                btn:['确认','取消'],
                fixed:true,
                resize:false,
                yes: function(index, layero){
                    //do something
                    //var body = layer.getChildFrame('body', index);
                    var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
                    var picStr = iframeWin.getJsonStr();
                    console.log(picStr);
                    $("#thumbnail_prev").attr('src',picStr);
                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            });
        }
            
    </script>
    </html>