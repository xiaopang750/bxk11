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
	<div class="login">
		<div class="inner">
			<div class="title clearfix mb_22">
				<h2 class="font_24 blue pr_13 fl">马上登录家178</h2>
				<p>
					<span class="pr_5 fl mt_10">没有178帐号?</span>
					<a href="/index.php/user/regist" class="fl mt_10 blue">马上注册</a>
				</p>
			</div>
			<div class="area clearfix">
				<div class="area_left fl" script-role="formBeautyBound" script-bound="form_check">
					<!-- 邮箱 -->
					<div class="mail input_area" script-role="check_wrap">
						<input type="text" text="请输入邮箱" top="15" left="4" form_check="sys" ischeck="true" name="user_name"  tip="邮箱不能为空" wrong="请输入正确的邮箱格式" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" holder="true" script-role="enterLogin" />	
					</div>
					
					<!-- 密码 -->
					<div class="pass input_area" script-role="check_wrap">
						<input type="password" type="text" script-role="enterLogin" text="请设置密码" top="15" left="4" form_check="sys" ischeck="true" name="pass_word"  tip="密码不能为空" wrong="请输入6-16位的密码" re=".{6,16}" holder="true"/>	
					</div>
					<!-- 记住密码 -->
					<div class="remember_name clearfix mb_5 mt_5" is-form-beauty="true" form-beauty-type="checkbox">
						<input type="checkbox" class="fl mr_10" checked="true" value="1" script-role="issave" />
						<span class="fl">记住密码</span>
						<a href="#" class="fr">忘记登录密码?</a>
					</div>
					<div class="btn_wrap">
						<a class="login_btn button178" href="javascript:;" onfocus="this.blur()" script-role="confirm_btn">登录</a>
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
	<div class="shadow_1000 main_content"></div>
</div>

<?php loadInclude('/lib/global/footer.php')?>

<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/entry/login.js');
</script>
</body>
</html>
