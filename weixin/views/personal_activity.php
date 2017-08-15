<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/personal.css" />
</head>

<body page-role="我参加的活动">
<!-- header -->
<?php loadInclude('inner_header.php') ?>

<!-- content -->
<section class="content">
	<section class="personal_detail clearfix">
		<ul script-role="data_wrap">
			<!-- <li class="mb_5">
				<div class="clearfix inner">
					<span class="fl">
						<span class="mr_10">活动</span>
						<span>韩式风格</span>
					</span>
					<span class="fr" scripr-role="foc" is_follow="1">取消关注</span>
				</div>
			</li> -->
		</ul>
	</section>
</section>
<!-- footer -->
<?php loadInclude('footer.php') ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data}}
<li class="mb_5">
	<div class="clearfix inner">
		<span class="fl">
			<span class="mr_10">{{$value.act_type}}</span>
			<a href="{{$value.act_url}}">{{$value.act_name}}</a>
		</span>
		<span class="fr" script-role="foc" is_follow="1" target="{{$value.act_like}}" type="{{$value.act_type}}">取消关注</span>
	</div>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/personal_activity.js');
</script>
</body>
</html>