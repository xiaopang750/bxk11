<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/personal.css" />
</head>

<body page-role="用户中心">
<!-- header -->
<?php loadInclude('header.php');?>

<!-- content -->
<section class="content">
	<section class="info_wrap m_b">
		<section class="info_bg"></section>
		<section class="info">
			<div class="inner clearfix">
				<span class="fl">账户:<span script-role="user_name"></span></span>
				<!-- <span class="fr button b_white">登出</span> -->
			</div>
		</section>
	</section>
	<section class="personal clearfix m_b">
		<ul script-role="data_wrap">
			
		</ul>
	</section>
	<section class="personal clearfix">
		<ul>
			<li>
				<a href="javascript:;" class="clearfix">
					<span class="icon myhome fl"></span>
					<span class="fl">我的户型</span>
					<span class="fr font_16">></span>
				</a>
			</li>
		</ul>
	</section>
</section>
<!-- footer -->
<?php loadInclude('footer.php');?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
<li>
	<a href="{{data.productLikeUrl}}" class="clearfix">
		<span class="icon fl"></span>
		<span class="fl">我收藏的商品</span>
		<span class="fr font_16">></span>
	</a>
</li>
<li>
	<a href="{{data.dealerUrl}}" class="clearfix">
		<span class="icon fl"></span>
		<span class="fl">我关注的店铺</span>
		<span class="fr font_16">></span>
	</a>
</li>
<li>
	<a href="{{data.actsLikeUrl}}" class="clearfix">
		<span class="icon fl"></span>
		<span class="fl">我关注的活动</span>
		<span class="fr font_16">></span>
	</a>
</li>
<li>
	<a href="javascript:;" class="clearfix">
		<span class="icon fl"></span>
		<span class="fl">我订阅的杂志</span>
		<span class="fr font_16">></span>
	</a>
</li>
<li>
	<a href="{{data.tuanLikesUrl}}" class="clearfix">
		<span class="icon fl"></span>
		<span class="fl">我参加的团购</span>
		<span class="fr font_16">></span>
	</a>
</li>
</script>
<script>
	seajs.use('main/personal.js');
</script>
</body>
</html>