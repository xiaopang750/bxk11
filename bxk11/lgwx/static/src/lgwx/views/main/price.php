<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/price.css" />
</head>
<body>

<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>	


<!-- main -->
<div class="layer-content">
	<div class="table-title clearfix">
		<div class="ml_20 mt_10">
			<h3 class="font_16">新手上路:这里有许多企业愿景等待你完成,加油!</h3>
			<p>当前级别:<span>体验版</span><span class="ml_40">积分:</span><span class="red">500</span></p>
			<p>
				升级至
				<span class="ml_5">黄金版</span>
				<span class="ml_5">还需要</span>
				<span class="ml_5 red">500</span>
				<span class="ml_5">积分,</span>
				<span class="ml_5">您通过<a href="#">分享</a>给15个好友并注册认证成功即可升级</span>
			</p>
		</div>
	</div>
	<div class="form"  script-bound="form_check">
		<table class="price" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td colspan="2">平台功能</td>
					<td>非认证会员<img src="/lgwx/static/system/lgwx/member/level1.png"></td>
					<td>体验版会员<img src="/lgwx/static/system/lgwx/member/level2.png"></td>
					<td>黄金版会员<img src="/lgwx/static/system/lgwx/member/level3.png"></td>
					<td>白金版会员<img src="/lgwx/static/system/lgwx/member/level4.png"></td>
					<td colspan="2">钻石版会员<img src="/lgwx/static/system/lgwx/member/level5.png"></td>
				</tr>
				<tr>
					<td colspan="2">所需积分</td>
					<td>0</td>
					<td>500</td>
					<td>2000</td>
					<td>5000</td>
					<td colspan="2">10000</td>
				</tr>
				<tr>
					<td colspan="2">企业站点</td>
					<td>手机版</td>
					<td>手机版</td>
					<td>手机+PC电脑版</td>
					<td>手机+Pad平板+PC电脑版</td>
					<td colspan="2">手机+Pad平板+PC电脑+TV版</td>
				</tr>

				<!-- 平台中心 start -->
				<tr>
					<td rowspan="5" colspan="1">平台中心</td>
					<td class="tl pl_20">平台认证</td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">用户桌面</td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">企业信息设置</td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes" colspan="2">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">帐户管理</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">多用户权限管理</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<!-- 平台中心 end -->
			
				<!-- 移动官网 start -->
				<tr>
					<td rowspan="6" colspan="1">移动官网</td>
					<td class="tl pl_20">经营品牌管理</td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes" colspan="2">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">经销网点管理</td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">官网模版设置</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">主菜单设置</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">幻灯片设置</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">快捷方式设置</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<!-- 平台中心 end -->

	
				<!-- 移动商城 start -->
				<tr>
					<td rowspan="10" colspan="1">移动商城</td>
					<td class="tl pl_20">商品管理</td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">产品搭配</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">商品相册</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">新品发布</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">人气排行</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">促销活动（限时特价、优惠套餐、在线团购）</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">二维码管理（商品、店铺、活动）</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">全景展厅</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">小区集采</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">店面导购系统</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<!-- 移动商城 end -->



				<!-- 移动运营 start -->
				<tr>
					<td rowspan="7" colspan="1">移动运营</td>
					<td class="tl pl_20">微信公众号运营</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">新浪微博运营</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">QQ运营(QQ空间、腾讯微博)</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">广告管理</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">营销工具（大转盘、刮刮卡、调查问卷）</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="2"></td>	
				</tr>
				<tr>
					<td class="tl pl_20">图文采编</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">素材管理</td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<!-- 移动运营 end -->


				<!-- 移动销售 start -->
				<tr>
					<td rowspan="9" colspan="1">移动销售</td>
					<td class="tl pl_20">粉丝管理</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">预约体验</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">客户跟踪</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="yes">√</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">客户反馈（微信留言、调查）</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">在线销售管理（接入销售店员的手机、微信号）</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">消息管理</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">群发消息</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">自动回复设置</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">快捷回复设置</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<!-- 移动销售 end -->


				<!-- 移动销售 start -->
				<tr>
					<td rowspan="4" colspan="1">数据分析</td>
					<td class="tl pl_20">展示分析（展示投放终端）</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>
				</tr>
				<tr>
					<td class="tl pl_20">传播分析</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">互动分析</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<tr>
					<td class="tl pl_20">销售分析</td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td><span class="no">×</span></td>
					<td colspan="2"><span class="yes">√</span></td>	
				</tr>
				<!-- 移动销售 end -->
			</tbody>
		</table>

	</div>
	
</div>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/price.js');
</script>
</body>
</html>