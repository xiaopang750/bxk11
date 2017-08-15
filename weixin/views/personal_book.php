<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/personal.css" />
</head>

<body page-role="我的订阅">
<!-- header -->
<?php include './include/inner_header.php';?>

<!-- content -->
<section class="content">
	<section class="personal_detail clearfix">
		<ul script-role="data_wrap">
			<li class="mb_5">
				<div class="clearfix inner">
					<span class="fl">韩式风格</span>
					<span class="fr">取消订阅</span>
				</div>
			</li>
		</ul>
	</section>
</section>
<!-- footer -->
<?php include './include/footer.php' ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data}}
<li class="mb_5">
	<div class="clearfix inner">
		<span class="fl">{{$value.type}}</span>
		<span class="fr" script-role="book">取消订阅</span>
	</div>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/personal.js');
</script>
</body>
</html>