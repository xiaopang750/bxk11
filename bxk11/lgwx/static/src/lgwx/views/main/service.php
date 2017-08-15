<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/service.css" />
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
	
	<div script-role="data_wrap">
	
	</div>

</div>

<script type="text/html" id="service-list">
{{if !err}}
<div class="table-title clearfix">
	<span class="icon-list-head icon8"></span>
	<span class="text">
		<?php echo $title; ?>
	</span>
	<ul class="fr service-list">
		<li class="fl br-n {{if data.type == 'vas'}}active{{/if}}" sc="select-type" select-type="vas">服务列表</li>
		<li class="fl {{if data.type == 'apv'}}active{{/if}}" sc="select-type" select-type="apv">已购买</li>
	</ul>
</div>

<div class="list">

	{{if data.list.length}}

	{{if data.type == 'vas'}}
	<table width="100%">
		<tr>
			<td width="10%">
				服务编号
			</td>
			<td width="30%">
				服务名称
			</td>
			<td width="20%">
				服务价格
			</td>
			<td  width="20%">
				单位
			</td>
			<td  width="20%">
				服务状态
			</td>
		</tr>
	</table>
	<div class="reply-list">
		<table width="100%">
			{{each data.list}}
			<tr sc="list">
				<td width="10%">
					{{$index+1}}
				</td>
				<td width="30%">
					{{$value.vas_name}}
				</td>
				<td width="20%">
					{{$value.vas_price}}
				</td>
				<td  width="20%">
					{{$value.vas_unit}}
				</td>
				<td  width="20%">
					{{$value.vas_status}}
				</td>
			</tr>
			{{/each}}
		</table>
	</div>
	{{else if data.type == 'apv'}}
	<table width="100%">
		<tr>
			<td width="10%">
				服务编号
			</td>
			<td width="30%">
				服务名称
			</td>
			<td width="20%">
				购买价格
			</td>
			<td  width="20%">
				单位
			</td>
			<td  width="20%">
				服务状态
			</td>
		</tr>
	</table>
	<div class="reply-list">
		<table width="100%">
			{{each data.list}}
			<tr sc="list">
				<td width="10%">
					{{$index+1}}
				</td>
				<td width="30%">
					{{$value.vas_name}}
				</td>
				<td width="20%">
					{{$value.vas_price}}
				</td>
				<td  width="20%">
					{{$value.vas_unit}}
				</td>
				<td  width="20%">
					{{$value.vas_status}}
				</td>
			</tr>
			{{/each}}
		</table>
	</div>	
	{{/if}}

	<div class="table-bottom">
		<div class="fenye pt_10 pb_10 pl_20" sc="fenye-wrap">
			{{if data.list}}
				<button class="btn btn-sm btn-primary" sc="first">首页</button>
				<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
				<span class="num" sc="num">
					
				</span>
				<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
				<button class="btn btn-sm btn-primary" sc="last">尾页</button>
			{{/if}}
		</div>
	</div>
	{{else}}
		<div class="tc">暂无数据</div>
	{{/if}}
</div>
{{/if}}
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/service.js');
</script>
</body>
</html>