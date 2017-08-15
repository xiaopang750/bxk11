<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/latest.css" />
</head>

<body page-role="品牌动态">
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
<section class="content" script-role="content">
	<section class="latest">
		<ul script-role="data_wrap">
			<!-- <li class="mb_10">
				<dl>
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
						<div class="time">
						    <span class="fanwei"></span>
							<span class="ml_10">剩4天</span>
						</div>
					</dt>
					<dd>
						<span class="mr_10 font_12 fl"style="font-size:1em">促销</span>
						<span class="mr_10 coffee fl">|</span>
						<span class="fl" style="font-size:0.5em">促销包括特价、折扣、返券、套餐</span>
						<span class="fr" style="font-size:0.5em">已有120人报名</span>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
	<!-- fenye -->
	<?php loadInclude('fenye.php') ?>
</section>
<!-- footer -->
<?php loadInclude('footer.php') ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.act_list}}
<li class="mb_10 sh">
	<dl>
		<dt>
			<a href="{{if $value.act_type == 3}}javascript:;{{else}}{{$value.act_url}}{{/if}}"><img src="{{$value.act_pic}}"></a>
			<div class="time" {{if $value.act_type != 2}}style="display:none"{{/if}}>
			    <span class="icon"></span>
				<span class="ml_10">剩{{$value.act_day}}天</span>
			</div>
		</dt>
		<dd>
			<span class="mr_10 font_12 fl" style="font-size:1em">
				{{if $value.act_type == 1}}促销
				{{else if $value.act_type == 2}}团购
				{{else if $value.act_type == 3}}导购
				{{/if}}
			</span>
			<span class="mr_10 coffee fl">|</span>
			<span class="fl" style="font-size:0.7em">{{$value.act_name.length > 15 ? $value.act_name.substring(0, 15) + '...' : $value.act_name}}</span>
			<span class="fr" style="font-size:0.7em" {{if $value.act_type == 1}}style="display:none"{{/if}}>
				{{if $value.act_type==2}}已有{{$value.sum}}人报名
				{{else if $value.act_type==3}}{{$value.time}}
				{{/if}}
			</span>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/latest.js');
</script>
</body>
</html>