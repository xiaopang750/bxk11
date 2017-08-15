<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/about.css" />
</head>

<body page-role="关于我们">
<!-- header -->
<?php loadInclude('inner_header.php');?>

<section class="focus m_b">
	<div widget-role="focus-wrap" widget-width="540" widget-height="567" widget-scale="1" style="margin:0 auto">
		<ul class="focus_wrap" widget-role="focus-data-wrap">
			
		</ul>
		<div class="dot_wrap" widget-role="focus-dot-wrap">
			
		</div>
	</div>
</section>

<!-- content -->
<section class="content">
	<div class="about">
		<h2 class="mb_10 font_12">品时家居</h2>
		<p>
			品时家居，中国最专业的在线家装平台，由专业设计师与品牌建材商提供全面的家装服务，3D引擎在线生成家装解决方案，帮助你寻找家装灵感、实现家装梦想、分享家装效果。
		</p>
	</div>
	<div id="map"></div>
</section>

<!-- footer -->
<?php loadInclude('/footer.php') ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script>
	seajs.use('main/about.js');
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=OoP0zzGRby6NPt5036WGyd1a&v=1.0"></script>
<script>
	// 百度地图API功能

		var map = new BMap.Map("map");            // 创建Map实例
		var point = new BMap.Point(116.431464,40.082822);    // 创建点坐标
		map.centerAndZoom(point,18);                     // 初始化地图,设置中心点坐标和地图级别。
		map.addControl(new BMap.ZoomControl());          //添加地图缩放控件
</script>
</body>
</html>