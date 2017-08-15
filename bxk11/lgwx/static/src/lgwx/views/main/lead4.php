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
			<h3 class="mb_10 font_16">客户愿景：更新企业最新动态、资讯、活动信息并发布</h3>
		</div>
	</div>
	<div class="form"  script-bound="form_check">
		<div class="main">
			<div class="title-text">
				企业轻松编辑发布日常的资讯新闻，企业动态，促销活动等，并分享到各个社交平台，实现步骤：
			</div>
			<div class="main-text">
				<div class="list">
					<h3>做为营销平台的统一资讯中心：</h3>
					<ul>
						<li>1、编辑单图文资讯，<a href="#">马上进行</a></li>
						<li>2、编辑多图文微杂志，<a href="#">马上进行</a></li>
					</ul>
				</div>
				<div class="list">
					<h3 class="pt_25">管理图文资讯所应用的图片素材<a href="#">马上进行</a></h3>
				</div>
				<div class="list">
					<h3>将图文资讯应用到移动官网首页模块中：</h3>
					<ul>
						<li>1、设置首页菜单，<a href="#">马上进行</a></li>
						<li>2、设置首页幻灯片， <a href="#">马上进行</a></li>
						<li>3、设置首页快捷方式，<a href="#">马上进行</a></li>
					</ul>
				</div>
				<div class="list">
					<h3>微信用户通过公众号阅读资讯并分享到朋友圈</h3>
					<ul class="pt_20">
						<li>1、设置微信公众号自定义菜单，<a href="#">马上进行</a></li>
						<li>2、设置微信公众号自动回复，<a href="#">马上进行</a></li>
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