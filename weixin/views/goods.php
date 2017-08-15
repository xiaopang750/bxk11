<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/goods.css" />
</head>

<body page-role="全部商品">
<!-- header -->
<?php loadInclude('header.php');?>

<section class="focus">
	<div widget-role="focus-wrap" widget-width="540" widget-height="567" widget-scale="1" style="margin:0 auto">
		<ul class="focus_wrap" widget-role="focus-data-wrap">
			
		</ul>
		<div class="dot_wrap" widget-role="focus-dot-wrap">
			
		</div>
	</div>
</section>
<!-- sort -->
<section class="sort m_b">
	<div class="inner">
		<ul class="box">
			<li class="flex1">
				<input type="checkbox"  script-role="data_select" id="sale" name="sale" svalue="">
				<label for="sale">仅显示优惠</label>
			</li>
			<li class="flex1 center relative" script-role="data_select" name="class_id" svalue="">
				筛  选
				<span class="triangle" script-role="triangle"></span>
			</li>
			<li class="flex1 center"  script-role="data_select" name="order" type="price" svalue="asc">
				价格
				<span class="sort_icon" script-role="rotate_icon"></span>
			</li>
			<li class="flex1 center"  script-role="data_select" name="order" type="discount" svalue="asc">
				折扣
				<span class="sort_icon" script-role="rotate_icon"></span>
			</li>
		</ul>
	</div>
</section>
<!-- content -->
<section class="content">
	<section class="goods clearfix">
		<ul script-role="data_wrap">
			<!-- <li class="mb_10">
				<dl>
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
						<input type="checkbox" class="fav">
					</dt>
					<dd>
						<span class="mr_10 fl">产品名称：2.0*2.0米实木双人床</span>
						<span class="pink fr ml_10">￥3899</span>
						<span class="fr sale">
							促销
							<span class="top"></span>
						</span>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
	<!-- fenye -->
	<?php loadInclude('/fenye.php') ?>
</section>
<!-- footer -->
<?php loadInclude('/footer.php') ?>

<!-- 筛选 -->
<div class="select_wrap" script-role="select_wrap">
	<div class="select box" script-role="select_content">
		<div class="type flex1">
			<ul class="type" script-role="type_wrap">
				<li script-role="data_select" name="">
					<span>按产品分类</span>
				</li>
			</ul>
		</div>
		<div class="type_detail flex1" script-role="myscroll">
			<ul script-role="type_detail">
				
			</ul>
		</div>
	</div>
</div>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.product_list}}
<li class="mb_10 sh">
	<dl>
		<dt>
			<a href="{{$value.product_url}}"><img src="{{$value.product_pic}}"></a>
			<span class="fav{{if $value.is_like == 1}} active{{/if}}" script-role="fav" target="{{$value.likeurl}}"></span>
		</dt>
		<dd>	
			<span class="mr_10 fl">{{$value.product_name.length > 15 ? $value.product_name.substring(0, 15) + '...' : $value.product_name}}</span>
			<span class="{{if $value.is_sale == 1}}pink{{/if}} fr ml_10">￥{{if $value.is_sale == 0}}{{$value.product_upset}}{{else if $value.is_sale == 1}}{{$value.product_price}}{{/if}}</span>
			<span class="fr sale" {{if $value.is_sale == 0}}style="display:none"{{/if}}>
				促销
				<span class="top"></span>
			</span>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script id="goods_list" type="text/html">
{{each data}}
<li script-role="data_select" value="{{$value.class_id}}" name="class_list" class="clearfix">
	<span class="fl">{{$value.class_name}}</span>
	<span class="fr mr_10 none" script-role="right_icon">√</span>	
</li>
{{/each}}
</script>
<script>
	seajs.use('main/goods.js');
</script>
</body>
</html>