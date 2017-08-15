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
			<h3 class="mb_10 font_16">客户愿景：拥有自己的移动官网，手机用户能够随时随地访问、了解企业信息</h3>
		</div>
	</div>
	<div class="form"  script-bound="form_check">
		<div class="main">
			<div class="title-text">
				免费进行企业认证，审核通过即刻免费获得移动官网，一个能够运行在手机移动端的企业官方网站，它具备企业宣传展示、资讯发布的功能，企业可自主进行管理，实现步骤：
			</div>
			<div class="main-text">
				<div class="list">
					<h3>为与微信等社交平台对接，需要核实企业注册信息，需要准备以下材料：</h3>
					<ul>
						<li>1、企业认证需要企业营业执照、组织机构代码的照片或者电子扫描件</li>
						<li>2、做为一个提供正规产品销售的企业，提供经营品牌信息</li>
						<li>3、至少准备一张实体店铺照片</li>
					</ul>
				</div>
				<div class="list">
					<h3 class="pt_25">只需三步，提交认证，1个工作日审核通过后，<a href="#">马上认证</a></h3>
				</div>
				<div class="list">
					<h3 class="pt_25">企业移动官网通过接入微信公众号，可以和4亿微信用户无缝对接，<a href="#">马上绑定</a></h3>
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