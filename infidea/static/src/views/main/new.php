<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>灵感无限科技-领先的家居移动营销平台-最新动态</title>
<?php include '../include/meta.php' ?>
<?php include '../include/globalcss.php' ?>
<link rel="stylesheet" href="../../css/main/new.css" />
</head>
<body>

<!-- header -->
<?php include '../include/header.php' ?>

<div class="main clearfix">
	<div class="news fl" script-role="data_wrap">
		
	</div>
	
	<div class="func fr">
		<div class="search">
			<input type="text" placeholder="Search here..." sc="search-input" />
			<div class="line"></div>
			<div class="mirror" sc="search">
				<span class="icon-co mirror-btn"></span>
			</div>
		</div>
		<div class="classify">
			<h3>资讯分类 Category</h3>
			<ul sc="type">
				
			</ul>
		</div>
		<div class="hot">
			<h3>热点资讯 Hotspot</h3>
			<ul sc="hot-wrap">
				
			</ul>
		</div>
	</div>

</div>

<script type="text/html" id="data-new">
{{if data.informationlist}}
<ul>
	{{each data.informationlist}}
	<li sc="info-list">
		<dl>
			<dt>
				<a href="./list.php?{{$value.si_id}}" target="_blank"><img src="{{$value.si_pic}}" /></a>
			</dt>
			<dd class="clearfix">
				<div class="info fl">
					<div class="top">
						<i>{{$value.si_addtime.substring(8,10)}}</i>
						<span class="font_20">/{{$value.si_addtime.substring(5,7)}}月</span>
					</div>
					<div class="bot">
						<div class="mb_20 clearfix">
							<span class="icon-co view mt_2 fl mr_5"></span>
							<span class="mr_10 fl view-num">{{$value.si_views}}</span>
							<span class="fl">阅览</span>
						</div>
						<div>
							<span class="icon-co like fl mt_2 mr_5"></span>
							<span class="mr_10 fl view-num">{{$value.si_likes}}</span>
							<span class="fl">收藏</span>
						</div>
					</div>
				</div>
				<div class="detail fr">
					<h3 class="font_16 yahei bold mb_26">{{$value.si_title}}</h3>
					<p>{{$value.si_desc}}</p>
					<a href="./list.php?{{$value.si_id}}" target="_blank">详细阅读 >>
				</div>
			</dd>
		</dl>
	</li>
	{{/each}}
</ul>
<div class="fenye fl col-5 mt_8 ml_5 clearfix" sc="fenye-wrap">
	{{if data.informationlist.length}}
	<a class="btn btn-sm btn-default" href="#" sc="first">首页</a>
	<a class="btn btn-sm btn-default" href="#" sc="page-prev">上一页</a>
	<span class="num" sc="num">
		
	</span>
	<a class="btn btn-sm btn-default" href="#" sc="page-next">下一页</a>
	<a class="btn btn-sm btn-default" href="#" sc="last">尾页</a>
	{{/if}}
</div>
{{else}}
<div class="tc font_16">暂无数据</div>
{{/if}}	
</script>

<script type="text/html" id="data-hot">
{{each data.host_list}}
<li>
	<dl class="clearfix">
		<dt class="fl">
			<a href="./list.php?{{$value.si_id}}" target="_blank">
				<img src="{{$value.si_pic}}" />
			</a>
		</dt>
		<dd class="fr">
			<h4>{{$value.si_title}}</h4>
			<div>
				<span class="icon-co view mt_2 fl mr_5"></span>
				<span class="fl mr_10">{{$value.si_views}}</span>
				<span class="icon-co like fl mt_2 mr_5"></span>
				<span class="fl">{{$value.si_likes}}</span>
			</div>
		</dd>
	</dl>
</li>
{{/each}}
</script>


<script type="text/html" id="data-type">
{{each data.it_list}}
<li>
	<span class="mr_10">&gt;</span>
	<a href="#" class="black" select-id="{{$value.it_id}}" sc="select-type">{{$value.it_name}} （{{$value.si_count}}）</a>
</li>
{{/each}}
</script>


<!-- footer -->
<?php include '../include/footer.php' ?>

<script src="../../../../seajs/sea.js"></script>
<script src="../../../../seajs/config.js"></script>
<script>
	seajs.use('main/new.js');
</script>
</body>
</html>