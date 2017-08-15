<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/login.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body>


<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/level2.php' ?>

<!-- content -->
<section class="content mb_20">
	<div class="top">
		<h3 class="pt_20 pb_20">登录后可以在电脑上与手机同步浏览</h3>
		<h4 class="mb_10">通过第三方帐号登录</h4>
		<a class="weixin-btn mb_30 hide" href="<?php echo $urllist['weixin_code_url']; ?>" sc="weixin">
			<span class="weixin login-icon mr_10"></span>
			一键式微信登录
		</a>
		<div class="not-weixin mb_30 hide" sc="not-weixin">
			<a class="sina login-icon mr_20" href="<?php echo $urllist['sina_code_url']; ?>"></a>
			<a class="qq login-icon ml_20" href="<?php echo $urllist['qzone_code_url']; ?>"></a>
		</div>
	</div>
	<div class="mid mb_20">
		<div class="line"></div>
		<div class="login-icon or"></div>
	</div>
	<div class="bottom">
		<h3 class="mb_20">JIA178.COM会员，请直接登录</h3>
		<form class="pb_40" sc="login-form">
			<ul class="mb_20">
				<li class="mb_20">
					<input type="text" sc="name" placeholder="输入用户名">
				</li>
				<li>
					<input type="password" sc="pass" placeholder="输入密码">
				</li>			
			</ul>
			<input type="submit" value="登录">
		</form>
	</div>
</section>


<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/login.js');
</script>
</body>
</html>