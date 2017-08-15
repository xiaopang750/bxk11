<!DOCTYPE html>
<html> <head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type"></meta>
<title>企业网站后台管理</title>
<link rel="stylesheet" type="text/css"
    href="<?php echo ADMIN_PUBLIC_URL.'style/admin.css';?>" />
<script type="text/javascript"
    src="<?php echo ADMIN_PUBLIC_URL.'js/jquery.js';?>"></script>
<script type="text/javascript">var domain = "<?php echo PUBLIC_URL;?>";</script>
<script type="text/javascript"
    src="<?php echo ADMIN_PUBLIC_URL.'js/admin.js';?>"></script>
</head>
<body>
    <div id="header">
        <div class="logo">
<img src="http://www.infidea.cn/static/build/img/lib/logo/logo.png" height="30">
        </div>

        <div id="topbar">
            <div id="topmenu">
                <!--  
                <dl class="first"></dl>
                <dl>
                    <dt>

                    </dt>
                    <dd>
                        <div>
                            <ul>
                                <li class="first"></li>
                                <li></li>
                                <li class="last"></li>
                            </ul>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <a href="<?php echo 'product/lists'?>">产品</a>
                    </dt>
                    <dd>
                        <div>
                            <ul>
                                <li class="first"><a href="<?php echo 'product/add';?>">添加产品</a></li>
                                <li><a href="<?php echo 'product/lists';?>">产品列表</a></li>
                                <li class="last"><a href="<?php echo 'product/cat';?>">产品类别</a></li>
                            </ul>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <a href="<?php echo 'user/mduser'?>">用户</a>
                    </dt>
                    <dd>
                        <div>
                            <ul>
                                <li class="first"><a href="<?php echo 'user/mduser';?>">修改账号</a></li>
                                <li class="last"><a href="<?php echo 'user/mdpwd';?>">修改密码</a></li>
                            </ul>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <a href="<?php echo 'system/env'?>">系统</a>
                    </dt>
                    <dd>
                        <div>
                            <ul>
                                <li><a href="<?php echo 'system/set';?>">网站设置</a></li>
                                <li><a href="<?php echo 'system/dbopt';?>">数据维护</a></li>
                                <li><a href="<?php echo 'system/env';?>">环境信息</a></li>
                                <li><a href="<?php echo 'nav/lists';?>">导航菜单</a></li>
                                <li><a href="<?php echo 'single/lists';?>">单页管理</a></li>
                                <li><a href="<?php echo 'system/model';?>">模块修改</a></li>
                            </ul>
                        </div>
                    </dd>
                </dl>
                -->
            </div>
            <div id="topinfo">
                <ul>
                    <li class=""><a href="/index.php/178admin/login/logout">退出登录</a></li>
                    <li class=""><a href="/index.php/admin/home" target="_brank">旧版后台</a></li>
                <li class=""><?php echo date('Y年m月d日');?></li>
                <li class=""><?php;?></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="middle">
        <div id="leftbar">
            <div class="sidebar_in">
                <i class=""></i>
            </div>
            <ul>
                <li class="start"><a href="<?php echo ADMIN_NEW_URL.'index/info';?>"><span title="点击回到首页"  style="font-size:16px;"><b>回到首页</b></span></a></li>
                <li class="has_sub"><a class="tit"><span   style="font-size:16px;"><b>广告投放</b></span><span class="arrow arrow_down"></span></a>
                    <ul>
                        <li><a href="<?php echo ADMIN_NEW_URL.'ad/page';?>">页面管理模块</a></li>
                        <li><a href="<?php echo ADMIN_NEW_URL.'ad/admanage';?>">广告管理</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <div id="right">
            <iframe name="main" width="100%" height="100%" frameborder="0" align="left" src="<?php echo ADMIN_NEW_URL.'index/info';?>"> </iframe>
        </div>
    </div>
</body>
</html>
