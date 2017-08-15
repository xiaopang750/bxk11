<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/series.css" />
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
	
	<div class="table-title clearfix">
		<span class="icon-list-head icon10"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>
	<div class="form">
		<div class="series_add" script-bound="form_check">
			
		</div>
	</div>
</div>

<script type="text/html" id="series-add">
	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">系列所属品牌:</span>
		<span class="mt_5 fl">{{data.brand_name}}</span>
	</div>
	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">系列中文名称:</span>
		<input type="text" class="fl form-control col-3" name="series_name" form_check="sys" ischeck="true" tip="此项为必填" wrong="请输入不超过25个字的中文名称" re="(.{1,25})" value="{{data.series_name}}" />
	</div>
	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">系列英文名称:</span>
		<input type="text" class="fl form-control col-3" name="series_ename" form_check="sys" ischeck="true" tip="此项为必填" wrong="请输入不超过50个英文字母的英文名称" re="(.{1,25})" value="{{data.series_ename}}" />
	</div>

	<form action="/lgwx/index.php/upload/serviceSenes" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
		<div class="form-group">
			<label class="label-control fl col-1">系列缩略图片:</label>
			<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.series_img}}"/>
			<span class="uploadLoading" script-role="uploadLoading">
				<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				上传中...
			</span>
			<div class="mt_5">
				<label class="label-control fl col-1"></label>
				<div class="col-2 fl">
					<img src="{{if data.series_img}}{{data.series_img}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
				</div>	
			</div>
		</div>
		<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
	</form>

	<div class="form-group" script-role="check_wrap">
		<div class="mb_10">
			<span class="label-control col-1 fl"></span>
			<span class="blue">请填写200字以内的介绍:</span>
		</div>
		<div>
			<span class="label-control col-1 fl">系列文字介绍:</span>
			<textarea class="form-control col-3" name="series_seodesc" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写200字以内的描述" re="(.|\n){1,200}">{{data.series_seodesc}}</textarea>
		</div>
	</div>

	<div class="form-group">
		<span class="label-control col-1 fl"></span>
		<button class="btn btn-success" script-role="confirm_btn">确定</button>
	</div>
</script>

<!-- cutbox -->
<{include file="../include/cutbox.php"}>	

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/series_add.js');
</script>
</body>
</html>