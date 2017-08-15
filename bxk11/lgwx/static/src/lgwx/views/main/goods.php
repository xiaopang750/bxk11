<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/goods.css" />
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
	<div class="bread">
		<span>您的位置:</span>
		<span sc="bread"></span>
	</div>
	
	<div script-role="data_wrap">
	
	</div>
</div>

<script type="text/html" id="goods-list">
<div class="table-title clearfix">
	<span class="icon-list-head icon7"></span>
	<span class="text">
		<{$title}>
	</span>
	<div class="clearfix fr mt_10 col-5">
		<select class="form-control col-4 fl mr_10" sc="brand">
			<option value="">选择品牌</option>
			{{each data.brandlist}}
				<option value="{{$value.brand_id}}" id="{{$value.brand_id}}" {{if $value.is_select == 1}}selected="selected"{{/if}}>{{$value.brand_name}}</option>
			{{/each}}
		</select>
		<select class="form-control col-4 fl mr_10" sc="series">
			<option value="">选择系列</option>
			{{each data.serieslist}}
				<option value="{{$value.series_id}}" id="{{$value.series_id}}" {{if $value.is_select == 1}}selected="selected"{{/if}}>{{$value.series_name}}</option>
			{{/each}}
		</select>
		<a href="javascript:;" class="btn btn-default" sc="search">查询</a>
	</div>
</div>

<div class="list">
	{{if data.goods_list}}
	<table width="100%">
		<tr>
			<td width="10%">
				序号
			</td>
			<td width="30%">
				商品名称
			</td>
			<td width="20%">
				商品编码
			</td>
			<td  width="20%">
				缩略图
			</td>
			<td  width="20%">
				操作
			</td>
		</tr>
	</table>
	<div class="reply-list">
		<table width="100%">
			{{each data.goods_list}}
			<tr sc="list">
				<td width="10%">
					{{$index+1}}
				</td>
				<td width="30%">
					{{$value.goods_name}}
				</td>
				<td width="20%">
					{{$value.goods_code}}
				</td>
				<td  width="20%">
					<img src="{{$value.goods_pic1}}" height="50">
				</td>
				<td  width="20%">
					<a href="{{data.goods_edit + '&goods_id=' + $value.goods_id}}">编辑</a>
					<a href="javascript:;" sc="remove" removeid="{{$value.goods_id}}">删除</a>
				</td>
			</tr>
			{{/each}}
		</table>
	</div>

	{{if $type=='goods'}}
		<div>{{$goods_name}}</div>
	{{else if $type=='brand'}}
		<div>{{$brand_name}}</div>
	{{/if}}	
	
</div>

<div class="table-bottom">
	<div class="fenye fl col-5 mt_8 ml_5" sc="fenye-wrap">
		<button class="btn btn-sm btn-primary" sc="first">首页</button>
		<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
		<span class="num" sc="num">
			
		</span>
		<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
		<button class="btn btn-sm btn-primary" sc="last">尾页</button>
	</div>
	<a class="btn btn-primary fr mt_5 mr_10 small" sc="user-add" href="{{data.goods_add}}">添加商品</a>
</div>
{{else}}
<div class="table-data-none">
	{{msg}}
</div>
<div class="table-bottom">
	<a class="btn btn-primary fr mt_5 mr_10 small" sc="user-add" href="{{data.goods_add}}">添加商品</a>
</div>
{{/if}}
</script>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/goods.js');
</script>
</body>
</html>