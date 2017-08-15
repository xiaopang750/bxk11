<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/product_detail.css" />
</head>

<body page-role="产品详情">
<!-- header -->
<?php loadInclude('inner_header.php');?>

<!-- content -->
<section class="content">
	<section class="product_detail clearfix">
		<ul script-role="data_wrap">
			<!-- <li class="mb_10">
				<dl>
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
						<input type="checkbox" class="fav">
					</dt>
					<dd>
						<p>商品编号：1232</p>
						<p>
							会员价：<span class="pink font_14">￥1899</span><span class="thr ml_5 font_09">￥3999</span>
						</p>
						<p>规格尺寸：</p>
						<p class="pink">促销活动：</p>
						<p class="pink">在线团购：已有120人报名</p>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
</section>

<!-- product_footer -->
<?php loadInclude('product_footer.php');?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
<li class="mb_10">
	<dl>
		<dt>
			{{each data.product_piclist}}
			<img src="{{$value.product_pic}}">
			{{/each}}
			<input type="checkbox" class="fav {{if data.is_like == 1}}active{{/if}}" script-role="fav" is_like="{{data.is_like}}" target="{{data.like_url}}">
		</dt>
		<dd>
			<p>商品编号：{{data.product_code}}</p>
			<p>
				会员价：<span class="pink font_14">￥{{data.product_upset}}</span><span class="thr ml_5 font_09">￥{{data.product_upset}}</span>
			</p>
			<p>规格尺寸：{{data.product_size}}</p>
			<p class="pink">促销活动：{{data.sales}}</p>
			<p class="pink" {{if !data.tuans}}style="display:none"{{/if}}>在线团购：{{==data.tuans}}</p>
		</dd>
	</dl>
</li>
</script>
<script>
	seajs.use('main/product_detail.js');
</script>
</body>
</html>