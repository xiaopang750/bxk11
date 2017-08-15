<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/personal.css" />
</head>

<body page-role="我的团购">
<!-- header -->
<?php loadInclude('inner_header.php'); ?>

<!-- content -->
<section class="content">
	<section class="personal_detail clearfix">
		<ul script-role="data_wrap">
			<li class="mb_5">
				<div class="clearfix inner">
					<span class="fl">韩式风格</span>
					<span class="fr">结束时间:2014-12-12</span>
				</div>
			</li>
		</ul>
	</section>
</section>
<!-- footer -->
<?php include loadInclude('footer.php'); ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data}}
<li class="mb_5">
	<div class="clearfix inner">
		<span class="fl"><a href="{{$value.act_url}}">{{$value.act_name}}</a></span>
		<span class="fr">结束时间:{{$value.act_end}}</span>
	</div>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/personal_group.js');
</script>
</body>
</html>