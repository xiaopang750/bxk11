<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>灵感无限科技-领先的家居移动营销平台-最新动态</title>
<?php include '../include/meta.php' ?>
<?php include '../include/globalcss.php' ?>
<link rel="stylesheet" href="../../css/main/list.css" />
</head>
<body>

<!-- header -->
<?php include '../include/header.php' ?>

<div class="main clearfix">
	<div class="news fl" sc="data-wrap">
		
			
		
	</div>

</div>


<script type="text/html" id="info-list">
<ul>
<li>
	<dl>
		<dt>
			<img src="{{data.si_pic}}" />
		</dt>
		<dd class="clearfix">
			<div class="info fl">
				<div class="top">
					<i>{{data.si_addtime.substring(8,10)}}</i>
					<span class="font_20">/{{data.si_addtime.substring(5,7)}}月</span>
				</div>
				<div class="bot">
					<div class="mb_20 clearfix">
						<span class="icon-co view mt_2 fl mr_5"></span>
						<span class="mr_10 fl view-num">{{data.si_views}}</span>
						<span class="fl">阅览</span>
					</div>
					<div>
						<span class="icon-co like fl mt_2 mr_5"></span>
						<span class="mr_10 fl view-num">{{data.si_likes}}</span>
						<span class="fl">收藏</span>
					</div>
				</div>
			</div>
			<div class="detail fr">
				<h3 class="font_16 yahei bold mb_26 tc">{{data.si_title}}</h3>
				<p>{{=data.si_content}}</p>
			</div>
		</dd>
	</dl>
</li>
</ul>	
</script>



<!-- footer -->
<?php include '../include/footer.php' ?>

<script src="../../../../seajs/sea.js"></script>
<script src="../../../../seajs/config.js"></script>
<script>
	seajs.use('main/list.js');
</script>
</body>
</html>