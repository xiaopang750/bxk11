<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/fast_menu.css" />
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
		<span class="icon-list-head icon5"></span>
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
					快捷指向功能
				</td>
				<td width="20%">
					显示名称
				</td>
				<td  width="20%">
					图标
				</td>
				<td  width="20%">
					操作
				</td>
			</tr>
		</table>
		<div class="reply-list">
			<table width="100%" sc="menu-fast">
				
			</table>
		</div>
		<div class="table-bottom">
			<a class="btn btn-success fr mt_5 mr_10 small" sc="save" href="javascript:;">保存</a>
		</div>
	</div>

</div>

<!-- tpl -->
<script type="text/html" id="fast-menu">
{{each data.shortcutlist}}
<tr sc="list" menu_url="{{$value.menu_url}}">
	<td width="10%" sc="menu-index">
		{{$index+1}}
	</td>
	<td width="30%">
		<select class="form-control col-4 auto" sc="select-dir">
			{{each $value.menulist}}
				<option id="{{$value.menu_id}}" url="{{$value.menu_url}}" {{if $value.select == 1}}selected="selected"{{/if}}>{{$value.menu_name}}</option>
			{{/each}}
		</select>
		{{$value.menu_name}}
	</td>
	<td width="20%">
		<div>
			<span sc="ui-modify">{{$value.title}}</span>
			<a href="javascript:;" class="ml_10" sc="ui-modify-btn">修改</a>
		</div>
	</td>
	<td width="20%">
		<select sc="ui-select">
			{{each $value.pic}}
				<option ui-html="<img src='{{$value.name}}'>" value="{{$value.name}}" {{if $value.select == 1}}selected="selected"{{/if}}></option>
			{{/each}}
		</select>
	</td>
	<td  width="20%">
		<a href="javascript:;" sc="up">上移</a>
		<a href="javascript:;" sc="down">下移</a>
	</td>
</tr>
{{/each}}
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	//入口文件
	seajs.use('main/fast_menu.js');
</script>
</body>
</html>