<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/chosen.css" />
</head>

<body page-role="产品精选">
<!-- header -->
<?php loadInclude('inner_header.php');?>

<section class="focus">
	<div widget-role="focus-wrap" widget-width="540" widget-height="567" widget-scale="1" style="margin:0 auto">
		<ul class="focus_wrap" widget-role="focus-data-wrap">
			
		</ul>
		<div class="dot_wrap" widget-role="focus-dot-wrap">
			
		</div>
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
			<span class="mr_10 fl">
			{{$value.product_name.length > 15 ? $value.product_name.substring(0, 15) + '...' : $value.product_name}}
			</span>
			<span class="fr">
				<span class="sale" {{if $value.is_sale == 0}}style="display:none"{{/if}}>
					促销
					<span class="top"></span>
				</span>
				<span class="{{if $value.is_sale == 1}}pink{{/if}} ml_10">￥{{if $value.is_sale == 0}}{{$value.product_upset}}{{else if $value.is_sale == 1}}{{$value.product_price}}{{/if}}</span>
			</span>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/chosen.js');
</script>
</body>
</html>