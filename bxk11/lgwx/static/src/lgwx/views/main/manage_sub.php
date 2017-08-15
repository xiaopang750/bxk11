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
		<span class="text">
			<{$title}>
		</span>
	</div>

	<div class="list">
		<table width="100%">
			<tr>
				<td width="10%">
					序号
				</td>
				<td width="30%">
					子账号名称
				</td>
				<td width="20%">
					负责门店
				</td>
				<td  width="20%">
					权限
				</td>
				<td  width="20%">
					操作
				</td>
			</tr>
		</table>
		<div class="reply-list">
			<table width="100%" sc="user-sub">
				
			</table>
		</div>
		<div class="table-bottom">
			<a class="btn btn-primary fr mr_10 mt_5 small" href="" sc="sub-add">添加子账号</a>
		</div>

	</div>

</div>

<script type="text/html" id="user-sub">
{{each data.list}}
	<tr>
		<td width="10%">
			{{$index+1}}
		</td>
		<td width="30%">
			{{$value.user_name}}
		</td>
		<td width="20%">
			{{each $value.user_shop}}
				<span class="mr_15 pb_10">{{$value}}</span>
			{{/each}}
		</td>
		<td  width="20%">
			{{each $value.user_module}}
				{{$value.module_name}}
			{{/each}}
		</td>
		<td  width="20%">
			{{=$value.user_action}}
		</td>
	</tr>
{{/each}}	
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/manage_sub.js');
</script>
</body>
</html>