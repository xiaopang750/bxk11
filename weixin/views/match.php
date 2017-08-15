<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/match.css" />
</head>

<body page-role="搭配套餐">
<!-- header -->
<?php loadInclude('inner_header.php') ?>

<!-- content -->
<section class="content">
	<section class="match clearfix m_t" script-role="data_wrap">
		<!-- <div class="main">
			<div class="list">
				<div class="header">
					<ul class="box white font_09">
						<li class="flex1 left">
							<span class="number">1</span>
							<span class="font_08">卧室五件套  原价</span>
							<span class="thr font_09">￥ 129032</span>   
						<span>套餐价￥99999</span></li>
						<li class="flex1 button b_pink">+加收藏</li>
					</ul>
				</div>
				<ul class="main">
					<li>
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
					</li>
				</ul>
			</div>
		</div> -->
	</section>
</section>

<!-- product_footer -->
<?php loadInclude('product_footer.php') ?>


<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.list}}
<div class="main">
	<div class="list">
		<div class="header">
			<ul class="box white font_09">
				<li class="flex1 left">
					<span class="number">{{$index}}</span>
					<span>{{$value.pack_name}}</span>
					<span class="font_08">原价</span>
					<span class="thr font_09">￥ {{$value.product_price}}</span>   
					<span>套餐价￥{{$value.goods_upset}}</span>
				</li>
			</ul>
		</div>
		<ul class="main">
			{{each $value.product_list}}
			<li>
				<dl class="clearfix">
					<dt>
						<a href="{{$value.product_url}}"><img src="{{$value.product_pic}}"></a>
					</dt>
					<dd class="clearfix font_08">
						<div class="inner">
							<p>产品名称：{{$value.poduct_name}}</p>
							<p>价格：￥{{$value.product_price}}元</p>
						</div>
					</dd>
				</dl>
			</li>
			{{/each}}
		</ul>
	</div>
</div>
{{/each}}
</script>
<script>
	seajs.use('main/match.js');
</script>
</body>
</html>