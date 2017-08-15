<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title?>后台管理系统登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />

    <!-- Bootstrap core CSS -->
    <link href="/static/admin/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/static/admin/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/static/admin/js/html5shiv.js"></script>
      <script src="/static/admin/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div class="container">

	<form class="form-signin" method="post" action='<?php echo site_url("admin/login/check"); ?>' onsubmit="return chek.logins()">
	<h2 class="form-signin-heading">家一起吧后台管理系统</h2>
        <input id="username" name="username" type="text" class="form-control" placeholder="管理员帐号" autofocus /><br>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码" /></br>
          <input type="checkbox" value="remember-me"> 记住密码<br><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      </form>

    </div> <!-- /container -->

</body>
<script type='text/javascript'>
var chek={
	"logins":function(){

			if(document.getElementById('username').value == ''){
				alert("用户名不能为空");return false;
			}
			if(document.getElementById('password').value == ''){
				alert("密码不能为空");return false;
			}
			return true;
		}

		
}
</script>
</html>
<!-- Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
*        dinghaochenAuthor: 丁昊臣
*        Email: dotnet010@gmail.com
-->
