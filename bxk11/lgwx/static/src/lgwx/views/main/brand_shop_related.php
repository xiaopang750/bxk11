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
	
	<div class="brand-shop-related clearfix" sc="data-wrap">
			
	</div>
	<div class="table-bottom">
		<a class="btn btn-success fr mt_8 mr_10" href="javascript:;" sc="save">保存</a>
	</div>
</div>


<script type="text/html" id="bran-shop-list">
<div class="brand fl">
	<div class="table-title">
		<span class="icon-list-head icon1"></span>
		<span class="text">品牌列表</span>
	</div>
	<div class="data-list">
		<ul sc="no">
			{{each data.noselectdbrands}}
				<li sc="select-list" listid="{{$value.brand_id}}">{{$value.brand_name}}</li>
			{{/each}}
		</ul>
	</div>
</div>
<div class="mid fl">
	<div class="btn-area">
		<div class="clearfix mb_10">
			<a class="btn btn-default vsmall fl" href="javascript:;" sc="add">添加&gt;</a>
			<a class="btn btn-default vsmall fr" href="javascript:;" sc="addAll">全部添加&gt;&gt;</a>
		</div>
		
		<div class="clearfix mb_10">
			<a class="btn btn-default vsmall fl" href="javascript:;" sc="remove">&lt;移除</a>
			<a class="btn btn-default vsmall fr" href="javascript:;" sc="removeAll">全部移除&lt;&lt;</a>
		</div>
	</div>
</div>
<div class="shop fl">
	<div class="table-title">
		<span class="text">店铺经销品牌列表</span>
	</div>
	<div class="data-list">
		<ul sc="yes">
			{{each data.selectdbrands}}
				<li sc="select-list" listid="{{$value.brand_id}}">{{$value.brand_name}}</li>
			{{/each}}
		</ul>
	</div>
</div>	
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>

	//入口文件
	seajs.use('main/brand_shop_related.js');

</script>
</body>
</html>