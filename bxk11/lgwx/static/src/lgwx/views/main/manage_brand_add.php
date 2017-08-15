<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/manage.css" />
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/widget/form/calendar.css" />
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
		<span class="icon-list-head icon4"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>

	<div class="form"  script-bound="form_check">
		<!-- form -->
	</div>

</div>

<script type="text/html" id="brand-add">
<div class="form-group" script-role="check_wrap">
	<label class="label-control col-1 fl">品牌中文名称:</label>
	<div class="col-3 fl">
		<input type="text" class="form-control" name="apply_brand_name" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写10位以内的中文名称" re="([\u4e00-\u9fa5]{1,10})" value="{{data.apply_brand_name}}" />
		<p class="gray mt_5">请填写您公司持有或代理品牌的中文全称</p>
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group" script-role="check_wrap">
	<label class="label-control col-1 fl">品牌英文名称:</label>
	<div class="col-3 fl">
		<input type="text" class="form-control" name="apply_brand_ename" form_check="sys" ischeck="false" tip="此项为必填" wrong="请填写20位以内的英文名称" re="([a-zA-Z\-\_\.]{1,20})" value="{{data.apply_brand_ename}}" />
		<p class="gray mt_5">请填写您公司持有或代理品牌的英文全称</p>
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group" script-role="check_wrap">
	
	<div script-role="check_wrap">
		<label class="label-control col-1 fl">品牌有效期:</label>
		<div class="col-1 fl">
			<input type="text" readonly="readonly" sc="time-select" class="form-control" name="apply_license_begin" form_check="sys" ischeck="true" tip="此项为必填" wrong="日期格式不正确" re="([0-9]{4}\-[0-9]{2}\-[0-9]{2})" value="{{data.apply_license_begin}}" />
			<p class="gray mt_5">请输入经销品牌代理授权期</p>
		</div>
		
	</div>

	<div script-role="check_wrap">
		<label class="label-control fl pl_40">---</label>
		<input type="text" readonly="readonly" sc="time-select" class="form-control col-1 fl" name="apply_license_end" form_check="sys" ischeck="true" tip="此项为必填" wrong="日期格式不正确" re="([0-9]{4}\-[0-9]{2}\-[0-9]{2})" value="{{data.apply_license_end}}">
	</div>

	<form action="/lgwx/index.php/upload/serviceApplyBrand" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
		<div script-role="check_wrap">
			<label class="label-control fl col-2">
				<p class="mb_10">上传品牌资质:</p>
				<p class="gray">
					请上传加盖公章的商标注册或代理经销授权书的清晰彩色原件扫描件，支持jpg,gif,bmp格式照片，大小不超过512kb
				</p>
			</label>
			<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.apply_license_file}}"/>
			<span class="uploadLoading" script-role="uploadLoading">
				<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				上传中...
			</span>
		</div>
		<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
		<div>
			<label class="label-control fl col-2"></label>
			<div class="col-2 fl">
				<img src="{{if data.apply_license_file}}{{data.apply_license_file}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
			</div>	
		</div>
		
	</form>

</div>

<div class="form-group" script-role="check_wrap">
	<label class="label-control col-1 fl">品牌介绍:</label>
	<div class="col-3 fl">
		<textarea class="form-control" name="apply_brand_seodesc" form_check="sys" ischeck="true" tip="此项为必填" wrong="请输入不多于200字的品牌描述" re="((.|\n){1,200})">{{data.apply_brand_seodesc}}</textarea>
		<p class="gray mt_5">请输入不多于200字的品牌描述</p>
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group">
	
	<form action="/lgwx/index.php/upload/serviceApplyBrand" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
	<div script-role="check_wrap">
		<label class="label-control fl col-1">
			<p class="mb_10">上传品牌logo:</p>
			<p class="gray">
				上传大小不得超过于512kb的jpg,gif,png,bmp格式图片
			</p>
		</label>
		<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.apply_brand_img}}"/>
		<span class="uploadLoading" script-role="uploadLoading">
			<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
			上传中...
		</span>
		<span class="red">*</span>
	</div>
	<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
	
	<div class="mt_5">
		<div class="col-2 fl">
			<img src="{{if data.apply_brand_img}}{{data.apply_brand_img}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
		</div>	
	</div>
	
	</form>
	
</div>

<div class="form-group" script-role="check_wrap">
	<label class="label-control fl col-1">
		<p class="mb_10">品牌产品品类:</p>
		<p class="gray">
			最多选择6个品类
		</p>
	</label>
	<div class="col-7 fl mt_6" sc="brand-wrap" checkbox_group="true" name="brand_class" form_check="sys" ischeck="true" tip="请至少选择一个品类">
		{{each data.classlist}}
			<input type="checkbox" class="fl mr_3 mt_3" id="{{$value.class_id}}" {{if $value.select}}checked="checked"{{/if}} />
			<span class="fl mr_5">{{$value.class_name}}</span>
		{{/each}}
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group">
	<label class="label-control col-1 fl"></label>
	<div class="col-5 fl mt_6">
		<a class="btn btn-success" script-role="confirm_btn" href="javascript:;">保存</a>
	</div>
</div>

</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/manage_brand_add.js');
</script>
</body>
</html>