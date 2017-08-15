<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<?php include '../include/meta.php' ?>
<?php include '../include/globalcss.php' ?>
<link rel="stylesheet" href="../../css/main/login.css" />
</head>
<body>

<div class="login_box">
	<div class="top">
		<div class="form-group pt_40">
			<label class="label-control fl col-2">用户名:</label>
			<input type="text" class="form-control fl col-4" />
		</div>

		<div class="form-group">
			<label class="label-control fl col-2">密码:</label>
			<input type="password" class="form-control fl col-4" />
		</div>

		<div class="form-group">
			<label class="label-control fl col-2">验证码:</label>
			<input type="text" class="form-control fl col-1" />
			<img src="" alt="" class="fl" height="34" />
		</div>
	</div>
	<div class="bottom">
		<button class="btn btn-success ml_50 mt_30 fl">登录</button>
		<a href="#" class="ml_30 pt_40 block fl">马上加盟</a>
	</div>
</div>

<script src="/seajs/sea.js"></script>
<script src="/seajs/config.js"></script>
<script>

	//入口文件
	//seajs.use('main/index.js');

</script>
</body>
</html>