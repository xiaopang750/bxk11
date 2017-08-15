<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/home.css" />
</head>
<body>

<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>


<!-- banner -->
<div sc="banner">
	
</div>


<!-- main -->
<div class="layer-content">
		
	<div class="divider">
		<span class="text">马上开始</span>
	</div>

	<div class="fast-layer mb_20">
		<div sc="module">
			
		</div>
	</div>

	<div class="divider">
		<span></span>
	</div>
	
	<div class="clearfix">

		<div class="industry-news fl">
			<dl class="news-contain">
				<dt>
					<span>行业资讯</span>
				</dt>
				<dd>
					<ul sc="news-info">
						 
					</ul>
				</dd>
			</dl>
		</div>

		<div class="active-news fr">
			<dl class="news-contain">
				<dt>
					<span>平台活动</span>
				</dt>
				<dd>
					<ul sc="news-act">
						
					</ul>
				</dd>
			</dl>
		</div>
	</div>
	
</div>

<!-- 分享 -->
<div class="share-box" sc="share-box">
	<a href="javascript:;" class="share-close" sc="close">关闭</a>
	<div class="inner">
		<h3 class="font_16 mb_10">分享给好友</h3>
		<textarea sc="copyed-input" readonly="readonly"></textarea>
		<div class="clearfix">
			<a href="javascript:;" class="btn btn-success fl mt_20" sc="copy">复制内容</a>
			<div class="fr mt_13">
				<div class="bdsharebuttonbox">
					<a href="#" class="bds_more" data-cmd="more"></a>
					<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
					<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
					<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
					<a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
					<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
				</div>

			</div>
		</div>
	</div>

</div>


<!-- 广告banner -->
<script type="text/html" id="banner">
	<a href="{{data.banner.imgurl}}">
		<img src="{{data.banner.pic}}" width="100%" class="mt_10"/>
	</a>
</script>

<!-- 马上开始 -->
<script type="text/html" id="module">
	<a class="reg list" href="{{data.menu[0].action_url}}">
		<span class="icon-normal reg"></span>
		<span class="text">{{data.menu[0].action_name}}</span>
	</a>
	<a class="manage-brand list" href="{{data.menu[1].action_url}}">
		<span class="icon-normal manage-brand"></span>
		<span class="text">{{data.menu[1].action_name}}</span>
	</a>
	<a class="manage-shop list" href="{{data.menu[2].action_url}}">
		<span class="icon-normal manage-shop"></span>
		<span class="text">{{data.menu[2].action_name}}</span>
	</a>
	<a class="bind-weixin list" href="{{data.menu[3].action_url}}">
		<span class="icon-normal bind-weixin"></span>
		<span class="text">{{data.menu[3].action_name}}</span>
	</a>
	<a class="share list" href="javascript:;" sc="show-share">
		<span class="icon-normal share"></span>
		<span class="text">{{data.menu[4].action_name}}</span>
	</a>
</script>

<!-- 行业资讯 -->
<script type="text/html" id="info">
	{{each data.industry_list}}
	<li class="clearfix">
		<span class="fl">
			<a href="{{$value.indu_url}}" target="_blank">{{$value.indu_title}}</a>
		</span>
		<span class="fr">{{$value.indu_time}}</span>
	</li>
	{{/each}}
</script>

<!-- 活动资讯 -->
<script type="text/html" id="act">
	{{each data.activities_list}}
	<li class="clearfix">
		<span class="fl">
			<a href="{{$value.pa_url}}" target="_blank">
				{{if $value.pa_title.length>10}}
					{{$value.pa_title.substring(0,10)+'...'}}
				{{else}}
					{{$value.pa_title}}
				{{/if}}
			</a>
		</span>
		<span class="fr">{{$value.pa_time}}</span>
	</li>
	{{/each}} 
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/index.js');
</script>
</body>
</html>