<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<?php echo APP_LINK ?>css/main/service.css" />
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
	
	<div class="location">
		<{$title}>
	</div>
	
	<div class="back clearfix mb_20">
		<a href="#" class="fr font_18">返回</a>
	</div>

	<div class="list">
		<table width="100%">
			<tr>
				<td width="10%">
					序号
				</td>
				<td width="30%">
					全景展厅
				</td>
				<td width="20%">
					时间
				</td>
				<td  width="20%">
					费用
				</td>
				<td  width="20%">
					操作
				</td>
			</tr>
		</table>
		<div class="reply-list mb_20">
			<table width="100%">
				<tr>
					<td width="10%">
					序号
					</td>
					<td width="30%">
						幻灯片图片(宽540高567)
					</td>
					<td width="20%">
						幻灯片跳转链接
					</td>
					<td  width="20%">
						操作
					</td>
					<td  width="20%">
						<a href="#">延长时间</a>
						<a href="#">删除</a>
					</td>
				</tr>
			</table>
		</div>

		<div class="fenye">
			<button class="btn btn-sm btn-primary">首页</button>
			<button class="btn btn-sm btn-primary">上一页</button>
			<span class="num">
				<button class="btn btn-sm btn-primary">1</button>
			</span>
			<button class="btn btn-sm btn-primary">首页</button>
			<button class="btn btn-sm btn-primary">上一页</button>
		</div>
	</div>
</div>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/service_detail.js');
</script>
</body>
</html>