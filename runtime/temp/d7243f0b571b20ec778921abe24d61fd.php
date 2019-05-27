<?php /*a:3:{s:63:"H:\project\hj_shop/public/themes/admin/default/index\index.html";i:1558677431;s:63:"H:\project\hj_shop/public/themes/admin/default/public\head.html";i:1558831798;s:62:"H:\project\hj_shop/public/themes/admin/default/public\nav.html";i:1558674303;}*/ ?>
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
    </head>
    <body class="index">
    <!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="./index.html">火箭商城</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav left fast-add" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                        <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
                <dd>
                    <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                        <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                <dd>
                    <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                        <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                <dd>
                    <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                        <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                <dd>
                    <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                        <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><?php echo htmlentities($adminUser['user_login']); ?></a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a href="#">个人信息</a></dd>
                <dd>
                    <a href="<?php echo url('admin/public/login'); ?>">切换帐号</a></dd>
                <dd>
                    <a href="<?php echo url('admin/public/exitLogin'); ?>">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="/">前台首页</a></li>
    </ul>
</div>
<!-- 顶部结束 -->
    <!-- 中部开始 -->
    <!-- 左侧菜单开始 -->
    <div class="left-nav">
        <div id="side-nav">
            <ul id="nav">
                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="系统设置">&#xe6ae;</i>
                        <cite>系统设置</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>公告管理</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('订单列表','order-list.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>模板管理</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>导航管理</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>轮播管理</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>友情链接</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>文件存储</cite></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="用户管理">&#xe6b8;</i>
                        <cite>用户管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                                <cite>管理员</cite>
                                <i class="iconfont nav_right">&#xe697;</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a onclick="">
                                        <i class="iconfont">&#xe6a7;</i>
                                        <cite>角色管理</cite></a>
                                </li>
                                <li>
                                    <a onclick="">
                                        <i class="iconfont">&#xe6a7;</i>
                                        <cite>管理员</cite></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <cite>用户组</cite>
                                <i class="iconfont nav_right">&#xe697;</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a onclick="">
                                        <i class="iconfont">&#xe6a7;</i>
                                        <cite>本站用户</cite></a>
                                </li>
                                <li>
                                    <a onclick="">
                                        <i class="iconfont">&#xe6a7;</i>
                                        <cite>第三方用户</cite></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="商品管理">&#xe723;</i>
                        <cite>商品管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('商品管理','<?php echo url('admin/goods/index'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商品管理</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('分类管理','<?php echo url('admin/goods/index'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>分类管理</cite></a>
                            </li>
                        </ul>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="iconfont left-nav-li" lay-tips="订单管理">&#xe723;</i>
                        <cite>订单管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a onclick="xadmin.add_tab('订单列表','order-list.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>订单列表</cite></a>
                        </li>
                        <li>
                            <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>订单列表1</cite></a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-allowclose="false" lay-filter="xbs_tab">
            <ul class="layui-tab-title">
                <li class="home">
                    <i class="layui-icon">&#xe68e;</i>我的桌面
                </li>
            </ul>
            <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                <dl>
                    <dd data-type="this">关闭当前</dd>
                    <dd data-type="other">关闭其它</dd>
                    <dd data-type="all">关闭全部</dd>
                </dl>
            </div>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe class="x-iframe" frameborder="0" scrolling="yes" src="<?php echo url('main'); ?>"></iframe>
                </div>
            </div>
            <div id="tab_show"></div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <style id="theme_style"></style>
    <!-- 右侧主体结束 -->
    </body>
</html>