<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<?php include APP_STATIC.'views/include/meta.php' ?>
<?php include APP_STATIC.'views/include/globalcss.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="<?php echo APP_LINK ?>css/main/regist.css" />
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

	<div class="login_box fr" script-bound="form_check_regist" sc="box-show" formName="oRegistForm">
		<div class="title">
			<img src="<?php echo APP_LINK ?>/img/lib/logo/entry_bg.png" />
		</div>
		<div class="top clearfix">
			<div class="form-group"  script-role="check_wrap">
				<label class="label-control fl col-2">公司简称</label>
				<input type="text" class="form-control fl col-4" name="service_name" form_check="sys" ischeck="true" tip="公司简称不能为空" wrong="请输入20位以内的公司简称" re="(\S{1,30})" text="输入30字以内的公司名称" top="10" left="180" holder="true" />
			</div>

			<div class="form-group"  script-role="check_wrap">
				<label class="label-control fl col-2">移动电话</label>
				<input type="text" class="form-control fl col-4" name="user_phone" form_check="sys" ischeck="true" tip="用户手机号不能为空" wrong="请填写格式正确的手机号" re="(\d{8}|\d{11})" text="请如实填写用于登录和密码找回" top="10" left="180" holder="true" />
			</div>
		

			<div class="form-group"  script-role="check_wrap">
				<label class="label-control fl col-2">电子邮箱</label>
				<input type="text" class="form-control fl col-4" name="user_email" form_check="sys" ischeck="true" tip="用户邮箱不能为空" wrong="请填写正确的邮箱格式" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" text="请如实填写用于登录和密码找回" top="10" left="180" holder="true" />
			</div>

			<div class="form-group" script-role="check_wrap">
				<label class="label-control fl col-2">设置密码</label>
				<input type="password" class="form-control fl col-4" sc="pass" name="user_password" form_check="sys" ischeck="true" tip="密码不能为空" wrong="请输入6-16位密码" re="(\w{6,26})" text="6-20位字符，可使用数字和字母组合" top="10" left="180" holder="true" />
			</div>

			<div class="form-group" script-role="check_wrap">
				<label class="label-control fl col-2">重复输入密码</label>
				<input type="password" class="form-control fl col-4" sc="re-pass" name="reply_password" form_check="self" ischeck="true" tip="密码不能为空" wrong="两次输入的密码不一致" re="(\w{6,16})" />
			</div>

			<div class="form-group" script-role="check_wrap">
				<label class="label-control fl col-2">验证码</label>
				<input type="text" class="form-control fl col-1 mr_5 check-code" name="verify_code" form_check="sys" ischeck="true" tip="验证码不能为空" wrong="请输入4位数的验证码" re="([0-9|a-z|A-Z]{4})" />
				<img src="/lgwx/application/libraries/CaptchaClass.php" alt="" class="fl" height="34" script-role="refesh-image" />
				<a class="ml_10 black fl mt_8" script-role="refesh-btn" href="javascript:;">点击刷新</a>
			</div>

		</div>
		<div class="bottom clearfix">
			<span class="mt_37 fl black">已有账号，直接<a href="<?php echo $login_url ?>" class="underline">登录</a></span>
			<button class="btn btn-primary mt_30 fr pl_50 pr_50" script-role="confirm_btn_regist">
				<span class="pr_20">注</span>
				<span>册</span>
			</button>
		</div>
	</div>
</div>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/config.js"></script>
<script>
	seajs.use('main/regist.js');
</script>
</body>
</html>