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
	{{if data.matchlist.length}}
		<div class="table-title clearfix">
			<span class="icon-list-head icon13"></span>
			<span class="text">
				<{$title}>
			</span>
		</div>
		<div class="list">
			<div class="reply-list">
				<table width="100%">
					{{each data.matchlist}}
					<tr sc="list">
						<td width="10%">
							{{$index+1}}
						</td>
						<td width="20%">
							<img src="{{$value.gm_pic}}" height="60">
							<p>{{$value.gm_name}}</p>
						</td>
						<td  width="40%">
							<div class="roll-wrap clearfix">
								<div class="left-btn"></div>
								<div class="roller">
									{{each $value.goods_list}}
										<img src="{{$value.goods_pic1}}" height="30">
									{{/each}}
								</div>
								<div class="right-bnt"></div>
							</div>
						</td>
						<td  width="30%">
							<a href="{{data.match_edit + '&gm_id=' + $value.gm_id}}" class="mr_10">编辑</a>
							<a href="javascript:;" sc="remove" removeid="{{$value.gm_id}}">删除</a>
						</td>
					</tr>
					{{/each}}
				</table>
			</div>
			<div class="table-bottom">
				<div class="fenye fl col-5 mt_8 ml_5" sc="fenye-wrap">
					{{if data.matchlist.length}}
						<button class="btn btn-sm btn-primary" sc="first">首页</button>
						<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
						<span class="num" sc="num">
							
						</span>
						<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
						<button class="btn btn-sm btn-primary" sc="last">尾页</button>
					{{/if}}
				</div>
				<a class="btn btn-primary fr mr_10 mt_8 small" href="{{data.match_add}}">添加优惠套餐</a>	
			</div>
		</div>
	{{else}}
		<div class="noData">暂无数据</div>
		<div class="tc">
			<a class="btn btn-primary mr_10 mt_8 small" href="{{data.match_add}}">添加优惠套餐</a>
		</div>
	{{/if}}
{{/if}}

	
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/matchlist.js');
</script>
</body>
</html>