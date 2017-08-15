<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/weishop.css" />
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
	<div sc="slider-wrap">

	</div>
</div>

<script type="text/html" id="slider">
<div class="table-title clearfix">
	<span class="icon-list-head icon15"></span>
	<span class="text">
		<{$title}>
	</span>
	<div class="clearfix fl mt_7 col-3 ml_10">
		<select class="form-control col-4 fl mr_10" sc="shop-search">
			<option value="">选择店铺</option>
			{{each data.shop_list}}
				<option value="{{$value.shop_id}}" id="{{$value.shop_id}}" {{if $value.selected == 1}}selected="selected"{{/if}}>{{$value.shop_name}}</option>
			{{/each}}
		</select>
	</div>
</div>

<div class="list">
	{{if data.slide_list}}
	<table width="100%">
		<tr>
			<td width="10%">
				序号
			</td>
			<td width="30%">
				幻灯片图片
			</td>
			<td width="30%">
				幻灯片名称
			</td>
			<td  width="30%">
				操作
			</td>
		</tr>
	</table>
	<div class="reply-list">
		<table width="100%">
			{{each data.slide_list}}
			<tr sc="list">
				<td width="10%">
					{{$index+1}}
				</td>
				<td width="30%">
					<img src="{{$value.slide_pic}}" height="50" sc="hoverImage">
				</td>
				<td width="30%">
					{{$value.slide_title}}
				</td>
				<td  width="30%">
					<a href="{{data.edit_url + $value.slide_id}}">编辑</a>
					<a href="javascript:;" scid="{{$value.slide_id}}" sc="remove">删除</a>
				</td>
			</tr>
			{{/each}}
		</table>
	</div>
	{{else}}
	<div class="table-data-none">
		无相关数据
	</div>
	{{/if}}
	<div class="table-bottom">
		{{if data.slide_list.length < 5}}
			<a class="btn btn-primary fr mt_5 mr_10 small" sc="slider-add" href="{{data.add_url}}">添加幻灯片</a>
		{{/if}}
	</div>
</div>	
</script>

<div sc="lay" class="none">
	<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif" sc="lay-img">
</div>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/slider.js');
</script>
</body>
</html>