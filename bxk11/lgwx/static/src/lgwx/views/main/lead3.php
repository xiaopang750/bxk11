<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/lead.css" />
</head>
<body>

<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>	


<!-- main -->
<div class="layer-content step-detail">
	<div class="table-title clearfix">
		<div class="text">
			<h3 class="mb_10 font_16">客户愿景：自定义管理企业移动官网</h3>
		</div>
	</div>
	<div class="form"  script-bound="form_check">
		<div class="main">
			<div class="title-text">
				认证通过的企业可以自主管理企业移动官网、自定义官网的首页、菜单、快捷方式等，实现步骤：
			</div>
			<div class="main-text">
				<div class="list">
					<h3>移动官网中显示的信息均为企业自主设定，务必完善如实填写企业基本资料：</h3>
					<ul>
						<li>1、企业基本信息，<a href="#">马上进行</a></li>
						<li>2、企业经营的品牌信息，<a href="#">马上进行</a></li>
						<li>3、经销网店（实体店铺）信息，<a href="#">马上进行</a></li>
					</ul>
				</div>
				<div class="list">
					<h3 class="pt_25">企业可以自主选择匹配企业品牌形象的模版，<a href="#">马上选择</a></h3>
				</div>
				<div class="list">
					<h3>移动官网首页中显示的模块可自由设置：</h3>
					<ul>
						<li>1、首页菜单，<a href="#">马上进行</a></li>
						<li>2、首页幻灯片， <a href="#">马上进行</a></li>
						<li>3、首页快捷方式 ，<a href="#">马上进行</a></li>
					</ul>
				</div>
				<div class="list">
					<ul class="pt_20">
						<li>1、使用个人微信号关注已绑定的微信公众号，<a href="#">马上关注</a></li>
						<li>2、使用微信‘扫一扫’移动官网二维码，<a href="#">查看二维码</a></li>
					</ul>
				</div>
			</div>
			<div class="step-way">
				<div class="title">准备相关资料</div>
				<div class="trangle"></div>
				<div class="title">提交企业认证</div>
				<div class="trangle"></div>
				<div class="title">绑定微信公众号</div>
				<div class="trangle"></div>
				<div class="title">马上访问移动官网</div>
			</div>
			<div class="earth"></div>
		</div>
	</div>
	
</div>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/lead.js');
</script>
</body>
</html>