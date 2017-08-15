<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/weixin.css" />
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

<script type="text/html" id="weixin-manage-list">
	{{if !data.weixin_list}}
		<div class="tc font_20">{{msg}}</div>
		<div class="search clearfix mb_10 tc">
			<a class="btn btn-primary ml_10" href="{{data.wx_add_url}}">添加微信公众号</a>	
		</div>
	{{else}}

		<div class="table-title clearfix">
			<span class="icon-list-head icon1"></span>
			<span class="text">
				<?php echo $title; ?>
			</span>
		</div>
		
		<div class="list">
			<table width="100%">
				<tr>
					<td width="25%">
						序号
					</td>
					<td width="25%">
						服务号类型
					</td>
					<td  width="25%">
						公众号名称
					</td>
					<td  width="25%">
						操作
					</td>
				</tr>
			</table>
			<div class="reply-list">
				<table width="100%">
					{{each data.weixin_list}}
						<tr sc="list">
							<td width="25%">
								{{$index+1}}
							</td>
							<td width="25%">
								{{$value.wx_typeName}}
							</td>
							<td  width="25%">
								{{$value.wx_name}}
							</td>
							<td  width="25%">
								<a href="{{data.wx_edit_url + $value.wid}}" class="mr_10">编辑</a>
								<a href="{{data.wx_setReply_url + $value.service_token}}" class="mr_10">设置回复</a>
								<a href="javascript:;" sc="remove" removeid="{{$value.wid}}" class="mr_10">删除</a>
								<a href="javascript:;" class="mr_10 default none">微信回复</a>
								{{if $value.wx_type == 1}}
									<a href="{{data.diy_menu_list_url + '&wid=' + $value.wid  + '&token=' + $value.service_token}}" class="mr_10">自定义菜单</a>
								{{/if}}
							</td>
						</tr>
					{{/each}}
				</table>
			</div>
			<div class="table-bottom">
				<a class="btn btn-primary fr mr_10 mt_5 small" href="{{data.wx_add_url}}">添加微信公众号</a>
			</div>
		</div>
	{{/if}}
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/weixin_manage.js');
</script>
</body>
</html>