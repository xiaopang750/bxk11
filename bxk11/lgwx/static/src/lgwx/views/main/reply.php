<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
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

<script type="text/html" id="info-list">

{{if data.err == 1}}
<div class="tc">{{data.msg}}</div>
{{else}}
	{{if data.informationlist.length}}
		<div class="table-title clearfix">
			<span class="icon-list-head icon10"></span>
			<span class="text">
				<{$title}>
			</span>
			<div class="fr col-6">
				<a class="btn btn-default mr_10 mt_8 small fr" href="javascript:;" sc="search">查询</a>
				<input type="text" class="mt_8 fr form-control col-3 mr_10" sc="search-input" value="{{data.keywords}}">
				<span class="gray mr_10 fr">输入关键字:</span>
				<select class="form-control col-2 mr_10 fr mt_8" sc="info-search">
					<option value="">选择资讯分类</option>
					{{each data.it_list}}
						<option value="{{$value.it_id}}" id="{{$value.it_id}}">{{$value.it_name}}</option>
					{{/each}}
				</select>
			</div>
		</div>
		<div class="list">
			<table width="100%">
				<tr>
					<td width="10%">
						序号
					</td>
					<td width="30%">
						关键字
					</td>
					<td  width="30%">
						时间
					</td>
					<td  width="30%">
						操作
					</td>
				</tr>
			</table>
			<div class="reply-list">
				<table width="100%">
					{{each data.informationlist}}
					<tr>
						<td width="10%">
							{{$index+1}}
						</td>
						<td width="30%">
							{{$value.si_title}}
						</td>
						<td  width="30%">
							{{$value.si_addtime}}
						</td>
						<td  width="30%">
							<a href="{{data.information_edit + $value.si_id}}" class="mr_10">编辑</a>
							<a href="javascript:;" sc="remove" removeid="{{$value.si_id}}">删除</a>
						</td>
					</tr>
					{{/each}}
				</table>
			</div>
			<div class="table-bottom">
				<div class="fenye fl col-5 mt_8 ml_5" sc="fenye-wrap">
					{{if data.informationlist.length}}
						<button class="btn btn-sm btn-primary" sc="first">首页</button>
						<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
						<span class="num" sc="num">
							
						</span>
						<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
						<button class="btn btn-sm btn-primary" sc="last">尾页</button>
					{{/if}}
				</div>
				<a class="btn btn-primary fr mr_10 mt_8 small" href="{{data.information_add}}">添加新资讯</a>	
			</div>
		</div>
	{{else}}
		<div class="noData">暂无数据</div>
		<div class="tc">
			<a class="btn btn-primary mr_10 mt_8 small" href="{{data.information_add}}">添加新资讯</a>
		</div>
	{{/if}}
{{/if}}

	
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/reply.js');
</script>
</body>
</html>