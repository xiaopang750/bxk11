<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<?php include APP_STATIC.'views/include/meta.php' ?>
<?php include APP_STATIC.'views/include/globalcss.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="<?php echo APP_LINK ?>/css/main/login.css" />
</head>
<body>

<?php include APP_STATIC.'views/include/entry_header.php' ?>

<div class="box-wrap clearfix" sc="box-wrap">
	
	<div class="phone fl">
		<div class="slide-wrap">
			<ul>
				<li><img src="/lgwx/static/system/lgwx/login_slide/1.jpg"></li>
			</ul>
		</div>
	</div>

	<div class="login_box fr" script-bound="form_check" sc="box-show" formName="oLoginForm">
		<div class="title">
			<img src="<?php echo APP_LINK ?>/img/lib/logo/entry_bg.png" />
		</div>
		<div class="top clearfix">

			<div class="form-group"  script-role="check_wrap">
				<label class="label-control fl col-2">登录名</label>
				<input type="text" class="form-control fl col-5" text="移动电话/电子邮箱/用户ID" top="17" left="180" holder="true" name="user_login_code" form_check="sys" ischeck="true" tip="登录名不能为空" wrong="请输入格式正确的邮箱或手机号" re="(\d{8}|\d{11})|([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" />
			</div>

			<div class="form-group" script-role="check_wrap">
				<label class="label-control fl col-2">输入密码</label>
				<input type="password" class="form-control fl col-5" name="pass_word" form_check="sys" ischeck="true" tip="密码不能为空" wrong="请输入6-16位密码" re="(\w{6,16})" />
				<!-- <a href="#" class="fl mt_5 ml_10">忘记密码</a> -->
			</div>

			<div class="form-group" script-role="check_wrap">
				<label class="label-control fl col-2">验证码</label>
				<input type="text" class="form-control fl col-1 mr_5 check-code" name="verify_code" form_check="sys" ischeck="true" tip="验证码不能为空" wrong="请输入4位数的验证码" re="([0-9|a-z|A-Z]{4})" />
				<img src="/lgwx/application/libraries/CaptchaClass.php" alt="" class="fl" height="36" script-role="refesh-image" />
				<a class="ml_10 black fl mt_8" script-role="refesh-btn" href="javascript:;">点击刷新</a>
			</div>

		</div>
		<div class="bottom clearfix">
			<span class="mt_37 fl black" href="">没有账号,马上<a href="<?php echo $reg_url ?>" class="underline">注册</a></span>
			<button class="btn btn-primary mt_30 fr pl_50 pr_50" script-role="confirm_btn">
				<span class="pr_20">登</span>
				<span>录</span>
			</button>
		</div>
	</div>
	
</div>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/config.js"></script>
<script>
	seajs.use('main/login.js');
</script>

</body>
</html>