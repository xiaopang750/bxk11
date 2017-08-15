<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../static/css/main/teambuy.css" />
</head>

<body page-role="团购详情">
<!-- inner_nav -->
<?php loadInclude('inner_header.php');?>

<!-- content -->
<section class="content">
	<section class="teambuy clearfix">
		<ul script-role="data_wrap">
			<!-- <li class="mb_10">
				<dl>
					<dt>
						<a href=""><img src="../static/img/data/m2.jpg" alt=""></a>
					</dt>
					<dd>
						<div class="top clearfix mb_5">
							<div class="inner">
								<h3 class="font_10 mb_5">团购产品、系列、品牌、品类、全店</h3>
								<span class="fl">
									<span class="font_09 pink mr_5">距离开团:  5天</span>
									<span class="font_08">已有15人参加</span>
								</span>
								<span class="fr button b_pink">
									参加团购
								</span>
							</div>
						</div>
						<div class="bottom font_09">
							<div class="inner">
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
						<span class="font_09 pink mr_5">距离开团:  {{data.act_numday}}天</span>
						<span class="font_08">已有{{data.act_joins}}人参加</span>
					</span>
					<span class="fr button b_pink" script-role="group" is_join="{{data.is_join}}" followUrl="{{data.follow_url}}">
						{{if data.is_join == 1}}已参加{{else data.is_join == 0}}参加团购{{/if}}
					</span>
				</div>
			</div>
			<div class="bottom font_09">
				<div class="inner">
					<p>活动有效期：{{data.act_begin}} - {{data.act_end}}</p>
					<p>活动说明：{{data.act_content}}</p>
				</div>
			</div>
		</dd>
	</dl>
</li>
</script>
<script>
	seajs.use('main/teambuy.js');
</script>
</body>
</html>