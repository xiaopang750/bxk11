<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/product.css" />
</head>

<body page-role="方案">
<!-- header -->
<?php loadInclude('inner_header.php');?>

<!-- content -->
<section class="content">
	<section class="product clearfix m_t">
		<div class="header">
			<ul class="white font_09"  script-role="data_title">
				<!-- <li class="flex1">方案包括19款商品</li>
				<li class="flex1 left">总价￥99999</li>
				<li class="flex1 button b_pink" script-role="fav">+加收藏</li> -->
			</ul>
		</div>
		<ul class="main" script-role="data_wrap">
			<!-- <li>
				<dl class="clearfix">
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
					</dt>
					<dd class="clearfix font_08">
						<div class="inner">
							<p>产品名称：进口实木双人大床大床大床</p>
							<p>价格：￥3899元</p>
						</div>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
</section>

<!-- product_footer -->
<?php loadInclude('footer.php');?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.product_list}}
<li>
	<dl class="clearfix">
		<dt>
			<a href="{{$value.product_url}}"><img src="{{$value.product_picurl}}"></a>
		</dt>
		<dd class="clearfix font_08">
			<div class="inner">
				<p>产品名称：{{$value.product_name}}</p>
				<p>价格：￥{{$value.product_price}}元</p>
			</div>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script id="data_title" type="text/html">
<li class="fl">方案包括{{data.product_count}}款商品</li>
<li class="fr left">总价￥{{data.product_countPrice}}</li>
</script>
<script>
	seajs.use('main/product.js');
</script>
</body>
</html>