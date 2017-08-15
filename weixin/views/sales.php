<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/sales.css" />
</head>

<body page-role="促销活动">
<!-- inner_nav -->
<?php include loadInclude('inner_header.php');?>

<!-- content -->
<section class="content">
	<section class="sales clearfix">
		<ul script-role="data_wrap">
			<!-- <li class="mb_10">
				<dl>
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
					</dt>
					<dd>
						<div class="top clearfix mb_5">
							<div class="inner">
								<h3 class="font_10 mb_5">特价产品或者套餐名称点击图片进入产品或套餐详情</h3>
								<span class="fl">
									<span class="font_08">特价</span>
									<span class="pink">￥188</span>
									<span class="font_08 thr">￥388</span>
								</span>
								<span class="fr button b_pink">
									+关注
								</span>
							</div>
						</div>
						<div class="bottom font_09">
							<div class="inner">
								<p>活动名称：</p>
								<p>活动有效期：</p>
								<p>活动说明：活动说1231231231231</p>
							</div>
						</div>
					</dd>
				</dl>
			</li> -->
		</ul>
	</section>
</section>
<!-- footer -->
<?php loadInclude('footer.php') ?>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
<li class="mb_10">
	<dl>
		<dt>
			<img src="{{data.act_pic}}">
		</dt>
		<dd>
			<div class="top clearfix mb_5">
				<div class="inner">
					<h3 class="font_10 mb_5">{{data.act_name}}</h3>
					<span class="fl">
						<span class="font_08">特价</span>
						<span class="pink">￥{{data.act_price}}</span>
						<span class="font_08 thr">￥{{data.act_listprice}}</span>
					</span>
					<span class="fr button b_pink" script-role="foc" is_follow="{{data.is_follow}}" focUrl="{{data.follow_url}}">
						{{if data.is_follow == 1}}已关注{{else if data.is_follow == 0}}+关注{{/if}}
					</span>
				</div>
			</div>
			<div class="bottom font_09">
				<div class="inner">
					<p>活动名称：{{data.act_name}}</p>
					<p>活动有效期：{{data.act_begin}} - {{data.act_end}}</p>
					<p>活动说明：{{data.act_content}}</p>
				</div>
			</div>
		</dd>
	</dl>
</li>
</script>
<script>
	seajs.use('main/sales.js');
</script>
</body>
</html>