<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/slider.css" />
</head>
<body>
<div class="shadow" sc="shadow"></div>
<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>	

<!-- main -->
<div class="layer-content" script-bound="form_check">
	
</div>

<script type="text/html" id="tpl-slider">
	<div class="table-title clearfix">
		<span class="icon-list-head icon15"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>
	<div class="form">
		<div class="form-group" script-role="check_wrap">
			<label class="label-control fl col-1">店铺橱窗名称:</label>
			<span class="mt_6 fl col-2" sc="shop-name">{{data.shop_name}}</span>
		</div>
		<div class="form-group" script-role="check_wrap">
			<label class="label-control fl col-1">幻灯片标题:</label>
			<input type="text" class="form-control fl col-2"  name="slide_title" form_check="sys" ischeck="true" tip="幻灯片标题不能为空" wrong="请输入1-25位幻灯片标题" re="(.{1,25})" value="{{data.slide_title}}" />
		</div>
		<div class="form-group" script-role="check_wrap">
			<label class="label-control fl col-1">选择指向类型:</label>
			<ul class="select-type clearfix">
				<li sc="select-type" type="1" {{if data.slide_type == 1}}class="active"{{/if}}>
					<span class="icon-list-head icon10"></span>
					<p class="font_14">资&nbsp;&nbsp;讯</p>
				</li>
				<li sc="select-type" type="2" {{if data.slide_type == 2}}class="active"{{/if}}>
					<span class="icon-list-head icon12"></span>
					<p class="font_14">商&nbsp;&nbsp;品</p>
				</li>
			</ul>
		</div>

		<div class="form-group" script-role="check_wrap">
			<label class="label-control fl col-1">幻灯片指向地址:</label>
			<input type="text" class="form-control fl col-2" sc="slider-address" name="slide_url" readonly="readonly" form_check="sys" ischeck="true" tip="幻灯片指向地址不能为空" wrong="幻灯片指向地址不能为空" re="(\S+)" value="{{data.slide_url}}" select-type="{{data.slide_type}}" />
			<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif" sc="slider-view" height="50" class="ml_50">
		</div>

		<div class="form-group">
			<form action="/lgwx/index.php/upload/flashpic" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
			<div script-role="check_wrap">
				<label class="label-control fl col-1">
					<p class="mb_10">上传幻灯片图片:</p>
				</label>
				<input type="file" class="mt_5" name="userfile" sc="slider_pic" iamgeurl="{{data.slide_pic}}" script-role="upload-file"/>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
					上传中...
				</span>
			</div>
			<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>

			<div class="mt_5">
				<label class="label-control fl col-1"></label>
				<div class="col-2 fl">
					<img src="{{if data.slide_pic}}{{data.slide_pic}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
				</div>	
			</div>

			</form>
		</div>

		<div class="form-group">
			<label class="label-control col-1 fl"></label>
			<div class="col-5 fl mt_6">
				<a class="btn btn-success" href="javascript:;" script-role="confirm_btn">保存</a>
			</div>
		</div>
	</div>
</script>

<!-- cutbox -->
<{include file="../include/cutbox.php"}>

<!-- shopbox -->
<{include file="../include/goods_select_single.php"}>

<!-- infobox -->
<{include file="../include/info_box.php"}>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/slider_edit.js');
</script>
</body>
</html>