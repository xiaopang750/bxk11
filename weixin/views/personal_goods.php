<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/personal.css" />
</head>

<body page-role="我收藏的商品">
<!-- header -->
<?php loadInclude('inner_header.php') ?>

<!-- content -->
<section class="content">
	<section class="personal_goods clearfix">
		<ul  script-role="data_wrap">
			<!-- <li class="mb_5">
				<dl>
					<dt><img src="../static/img/data/m2.jpg"></dt>
					<dd class="clearfix">
						<span class="fl">12312</span>
						<span class="fr">取消收藏</span>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
	<!-- fenye -->
	<?php loadInclude('/fenye.php') ?>
</section>
<!-- footer -->
<?php loadInclude('footer.php') ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.list}}
<li class="mb_10 sh">
	<dl>
		<dt><a href="{{$value.product_url}}"><img src="{{$value.product_pic}}"></a></dt>
		<dd class="clearfix">
			<span class="fl mr_10">{{$value.product_name.length > 8 ? $value.product_name.substring(0, 8) + '...' : $value.product_name}}</span>
			<span class="fl pink">{{$value.product_price}}</span>
			<span class="fr" script-role="fav" target="{{$value.like_url}}" is_like="1">取消收藏</span>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/personal_goods.js');
</script>
</body>
</html>