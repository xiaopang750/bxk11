<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/index.css" />
</head>
<body page-role="首页">
<!-- header -->
<?php loadInclude('header.php');?>
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
	<section class="rec m_b" script-role="data_title">
		
	</section>
	<section class="list">
		<ul script-role="data_wrap">
			<!-- <li class="m_b">
					<dl>
						<dt><a href=""><img src="../static/img/data/m2.jpg" alt=""></a></dt>
						<dd>
							<p class="mb_5">
								<span class="font_13 mr_2">QTHOME林肯庄园系列</span>
								<span>2014-02上市</span>
							</p>
							<p><a href="#">林肯庄园系列是纯正的美式风格，全系美国进口橡木打造，做工细致彰显低调奢华...欢迎品鉴>></a></p>
						</dd>
					</dl>
				</li> -->	
		</ul>
	</section>

	<section class="more">
		<ul class="box">
			<li class="flex1 backtop" script-role="backtop"><span></span></li>
			<li class="flex2"><a href="javascript:;" script-role="loadBtn">查看更多在售商品</a></li>
		</ul>
	</section>

</section>
<!-- footer -->
<?php loadInclude('footer.php') ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_title" type="text/html">
<h2 class="font_14">
	<span>今日推荐</span>
	<span class="line"></span>
</h2>																   
<h3 class="font_12" style="overflow:hidden;height:2.5rem;text-overflow: ellipsis;">{{data.followmsg}}</h3>
<div class="foc_btn_wrap">
	<a class="foc_btn button b_pink" href="javascript:;" script-role="foc" is_follow="{{data.is_follow}}" target="{{data.follow_url}}">
		{{if data.is_follow == 1 }} 已关注
		{{else if data.is_follow == 0 }} +关注
		{{/if}}
	</a>
</div>
</script>
<script id="data_list" type="text/html">
{{each data.series_list}}
<li class="m_b sh">
	<dl>
		<dt><a href="{{$value.series_piceries_url}}"><img src="{{$value.series_pic}}" alt=""></a></dt>
		<dd>
			<p class="mb_5">
				<span class="font_13 mr_2">{{$value.series_name.length > 8 ? $value.series_name.substring(0, 8) + '...' : $value.series_name}}</span>
				<span>{{$value.series_adddate}}上市</span>
			</p>
			<p><a href="{{$value.series_piceries_url}}">{{$value.series_desc}}>></a></p>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/index.js');
</script>
</body>
</html>