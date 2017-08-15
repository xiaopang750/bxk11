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
<div class="layer-content step1">
	<div class="table-title clearfix">
		<span class="icon-list-head icon7"></span>
		<div class="text">
			<h3 class="mb_10 font_16">新手上路：这里有许多企业愿景等待你来达成，加油！</h3>
			<div class="how-to-get gray">
				升级到黄金版会员还需要
				<span class="ml_5 mr_5 red">1500</span>
				积分
				<a href="#" class="ml_5">如何获取积分功能</a>
				<a href="#" class="ml_5">会员功能</a>
			</div>
		</div>
	</div>
	<div class="form"  script-bound="form_check">
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="38" class="tc">
					<div>体验版</div>
				</td>
				<td>
					<ul>
						<li>
							<a href="#">1 拥有自己的移动官网，手机用户能够随时随地访问企业、了解企业信息</a>
						</li>
						<li>
							<a href="#">2 自定义管理企业移动官网</a>
						</li>
						<li>
							<a href="#">3 发布企业最新动态、资讯、活动信息</a>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td class="tc">
					<div>黄金版</div>
				</td>
				<td></td>
			</tr>
			<tr>
				<td class="tc">
					<div>白金版</div>
				</td>
				<td></td>
			</tr>
			<tr>
				<td class="tc">
					<div>钻石版</div>
				</td>
				<td></td>
			</tr>
		</table>
	</div>
	
</div>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/lead.js');
</script>
</body>
</html>