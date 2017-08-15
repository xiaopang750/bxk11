<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/show.css" />
</head>

<body page-role="实景展厅">
<!-- header -->
<?php loadInclude('header.php');?>

<!-- content -->
<section class="content">
	<section class="show m_t clearfix">
		<ul script-role="data_wrap">
			<!-- <li class="mb_10">
				<dl>
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
						<div class="play">
							<div class="trangle"></div>
						</div>
					</dt>
					<dd class="clearfix">
						<span class="mr_10 fl font_09">润泽庄园3期23平米卧室</span>
						<span class="blue fl font_08"><a href="product.php" class="blue">商品清单（包含19款商品）</a></span>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
	<!-- fenye -->
	<?php loadInclude('fenye.php')?>
</section>
<!-- footer -->
<?php loadInclude('footer.php')?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.serires_list}}
<li class="mb_10 sh">
	<dl>
		<dt>
			<a href="{{$value.room_url}}"><img src="{{$value.room_pic}}"></a>
			<div class="play" {{if $value.room_type == 1}}style="display:none"{{/if}}>
				<div class="trangle"></div>
			</div>
		</dt>
		<dd class="clearfix">
			<span class="mr_10 fl font_09">{{$value.room_name.length > 15 ? $value.room_name.substring(0, 15) + '...' : $value.room_name}}</span>
			<span class="blue fr font_08"><a href="{{$value.room_producturl}}" class="blue">产品清单</a></span>
		</dd>
	</dl>
</li>
{{/each}}
</script>
<script>
	seajs.use('main/show.js');
</script>
</body>
</html>