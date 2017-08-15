
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/series.css" />
</head>
<body>

<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>

<!-- main -->
<div class="layer-content">
	
	<div class="table-title clearfix">
		<span class="icon-list-head icon12"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>
	<div class="form">
		<div class="series">
			<div class="list" sc="series">
				
			</div>
		</div>	
	</div>
</div>

<script type="text/html" id="series">
{{each data.brand_list as $data index}}
<div sc="list-wrap">
	<div class="head clearfix font_14">
		<span class="fl">品牌{{index+1}}：{{$data.brand_name}}</span>
		<span class="fl ml_50">共计({{$data.series_count}}个系列 , {{$data.goods_count}}个商品)</span>
		<a href="{{data.series_add_url + '&brandid=' +$data.brand_id}}" class="ml_20 fr">添加系列</a>
		<a href="javascript:;" class="fr" sc="slide">收起</a>
	</div>
	<ul class="clearfix" sc="slide-content">
		{{each $data.series_list}}
			<li class="clearfix" sc="list">
				<span class="fl mr_15">系列{{if $index<10}}{{"0"+($index+1)}}{{else}}{{$index+1}}{{/if}}</span>
				<span class="fl">{{$value.series_name}}</span>
				<a class="fr mr_10" href="{{data.goods_add_url + '&series_id=' + $value.series_id}}">添加商品</a>
				<a class="fr mr_10" href="{{data.goods_list_url + '&series_id=' + $value.series_id + '&brand_id=' + $data.brand_id}}">查看系列商品</a>
				<a class="fr mr_10" href="{{data.series_del_url}}" sc="remove" removeid="{{$value.series_id}}">删除系列</a>
				<a class="fr mr_10" href="{{data.series_edit_url + '&seriesid=' + $value.series_id}}">编辑系列</a>
			</li>
		{{/each}}
	</ul>
</div>	
{{/each}}
</script>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/series.js');
</script>
</body>
</html>