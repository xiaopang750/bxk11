<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/entry/entry.css')?>"/>
</head>
<body>
<?php loadInclude('/lib/global/header_lead.php')?>
<div class="regist_login_wrap">
	<div class="regist">
		<div class="inner">
			<div class="title clearfix mb_22">
				<h2 class="font_24 blue pr_13 fl">免费注册家178</h2>
				<p>
					<span class="pr_5 fl mt_10">已有帐号?</span>
					<a href="/index.php/user/login" class="fl mt_10 blue">马上登录</a>
				</p>
			</div>
			<div class="area clearfix">
				<div class="area_left fl" script-role="formBeautyBound" script-bound="form_check">
					<!-- 邮箱 -->
					<div class="mail input_area" script-role="check_wrap">
						<input type="text" text="请输入邮箱"  top="15" left="4" form_check="sys" ischeck="true" name="reguser_name"  tip="用户名不能为空" wrong="请输入正确的邮箱格式" re="([0-9A-Za-z\-_\.]{1,32})@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" holder="true" script-role="enterRegist" />	
					</div>
					<!-- 密码 -->
					<div class="pass input_area" script-role="check_wrap">
						<input type="password" type="text" text="请设置密码" top="15" left="4" form_check="sys" ischeck="true" name="regpass_word"  tip="密码不能为空" wrong="请输入6-16位的密码" re=".{6,16}" holder="true" script-role="enterRegist" />	
					</div>
					<!-- 验证码 -->
					<div class="check_code mb_15" script-role="check_wrap">
							<input type="text" type="text" form_check="sys" ischeck="true" name="check_code" tip="验证码不能为空" wrong="验证码格式不正确" re="[0-9]{1,4}" holder="true" text="请输入验证码" top="13" left="4" script-role="enterRegist"/>
							<img width="85" height="39" class="check_image" src="/images.php" script-role="check_image" />
							<a class="refresh_btn button178" href="javascript:;" onfocus="this.blur()" script-role="refresh_btn" title="刷新验证码">刷新验证码</a>
					</div>
					<div class="select_type mb_16">
						<ul is-form-beauty="true" form-beauty-type="radio" form_check="sys" ischeck="false" name="group_id" radio_group="radio1">
							<li class="clearfix mb_5">
								<input type="radio" value="1" checked="true" />
								<span class="pl_5 text">我是普通用户，装修房子</span>
							</li>
							<li class="clearfix">
								<input type="radio" value="21"/>
								<span class="pl_5 text">我是家居装修专业人士，提供专业服务</span>
							</li>
						</ul>
					</div>
					<div class="arg mb_5 clearfix" is-form-beauty="true" form-beauty-type="checkbox">
						<input type="checkbox" class="fl mr_5" checked="true" value="1" script-role="agree" />
						<span class="text">
							<span class="fl ml_5">我已阅读并同意</span>
							<a class="fl blue" href="#">《家一起吧注册协议》</a>
						</span>
					</div>
					<div class="btn_wrap">
						<a class="regist_btn button178" href="javascript:;" onfocus="this.blur()" script-role="confirm_btn">注册</a>
					</div>
				</div>
				<div class="area_mid fl">
					<span class="c666 yahei">或</span>
				</div>
				<div class="area_right fl">
					<p class="c666 mb_19">使用社交网络登录</p>
					<ul>
						<li>
							<a class="weibo_btn button178 other_way" href="<?php echo $authorizeURL['sina_code_url']; ?>" target="_blank" onfocus="this.blur()" script-role="weibo_btn"><span>使用新浪微博登录</span></a>
						</li>
						<li>
							<a class="qq_btn button178 other_way" href="<?php echo $authorizeURL['renren_code_url']; ?>" onfocus="this.blur()" target="_blank" script-role="qq_btn"><span>使用人人账号登录</span></a>
						</li>
						<li>
							<a class="renren_btn button178 other_way" href="<?php echo $authorizeURL['qzone_code_url']; ?>" onfocus="this.blur()" target="_blank" script-role="renren_btn"><span>使用QQ账号登录</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="shadow_1000 main_content png_shadow"></div>
</div>

<?php loadInclude('/lib/global/footer.php')?>

<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/entry/regist.js');
</script>
</body>
</html>
