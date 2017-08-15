<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/manage.css" />
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
		<span class="icon-list-head icon2"></span>
		<span class="text">
			<{$title}>
		</span>
		<div class="select fr w_500">
			<span class="mr_10 font_14 fl">按认证状态查询</span>
			<select class="form-control fl col-4 mt_5" sc="user-search">
				
			</select>
			<a class="btn btn-default fl ml_10 mr_10 mt_5" sc="user-btn" href="javascript:;">查询</a>
		</div>
	</div>

	<div class="list" sc="user-shop">
		
	</div>

</div>

<!-- 查询列表 -->
<script type="text/html" id="user-search">
{{each data.shop_search}}
	<option value="{{$value.name}}" id="{{$value.id}}">{{$value.name}}</option>
{{/each}}
</script>

<!-- 门店列表 -->
<script type="text/html" id="user-shop">
{{if data.shoplist}}
<table width="100%">
	<tr>
		<td width="10%">
			序号
		</td>
		<td width="30%">
			门店名称
		</td>
		<td width="20%">
			门店地址
		</td>
		<td  width="20%">
			状态
		</td>
		<td  width="20%">
			操作
		</td>
	</tr>
</table>
<div class="reply-list">
	<table width="100%">
		{{each data.shoplist}}
			<tr id="{{$value.shop_id}}" sc="list">
				<td width="10%">
				{{$index+1}}
				</td>
				<td width="30%">
					{{$value.shop_name}}
				</td>
				<td width="20%">
					{{$value.shop_address}}
				</td>
				<td width="20%">
					{{$value.shop_status}}
				</td>
				<td  width="20%">
					{{=$value.shop_action}}
				</td>
			</tr>
		{{/each}}
	</table>
</div>
<div class="table-bottom">
	<a class="btn btn-primary fr mt_5 mr_10 small" sc="user-add" href="{{data.shop_add}}" join_status="btn">添加门店</a>
</div>
{{else}}
<div class="table-data-none">
	{{msg}}
</div>
<div class="table-bottom">
	<a class="btn btn-primary fr mt_5 mr_10 small" sc="user-add" href="{{data.shop_add}}" join_status="btn">添加门店</a>
</div>
{{/if}}
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/manage_shop.js');
</script>
</body>
</html>