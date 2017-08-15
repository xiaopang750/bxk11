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
		<span class="icon-list-head icon7"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>
	<div class="form"  script-bound="form_check">

	</div>
	
</div>

<script type="text/html" id="user-info">

	<div class="form-group">
		<label class="label-control col-1 fl">企业名称:</label>
		<input type="text" {{if data.join_status === '23' || data.join_status === '1'}}readonly="readonly"{{/if}} class="form-control col-2 fl" name="service_company" form_check="sys" ischeck="{{if data.join_status === '23' || data.join_status === '1'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请填写30位以内的企业名称" re="(.{1,30})" value="{{data.service_company}}" />
		<label class="label-control col-1 fl pl_30 red">*</label>
	</div>
	
	<div class="form-group">
		<label class="label-control col-1 fl">企业邮箱:</label>
		<input type="text" {{if data.join_status === '23'}}readonly="readonly"{{/if}} class="form-control col-2 fl" name="service_email" form_check="sys" ischeck="{{if data.join_status === '23'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请填写格式正确的邮箱" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" value="{{data.service_email}}" />

		<label class="label-control col-1 fl pl_30 red">*</label>
	</div>

	<div class="form-group">
	
		<div script-role="check_wrap">
			<label class="label-control col-1 fl">营业执照注册号:</label>
			<div class="col-2 fl pr_40">
				<input type="text" {{if data.join_status === '23' || data.join_status === '1'}}readonly="readonly"{{/if}} class="form-control" name="service_license_code" form_check="sys" ischeck="{{if data.join_status === '23' || data.join_status === '1'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请输入15位的营业执照注册号" re="(.{15})" value="{{data.service_license_code}}" />
				<p class="gray mt_5">请输入15位的营业执照注册号</p>
			</div>
		</div>
		
		<div script-role="check_wrap">
			<label class="label-control col-1 fl">组织机构代码:</label>
			<div class="col-2 fl">
				<input type="text" {{if data.join_status === '23' || data.join_status === '1'}}readonly="readonly"{{/if}} class="form-control" name="service_organization_code" form_check="sys" ischeck="{{if data.join_status === '23' || data.join_status === '1'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请输入9位组织机构代码,如12345679-9" re="(\d{8}\-\d{1})" value="{{data.service_organization_code}}" />
				<p class="gray mt_5">请输入9位组织机构代码,如12345678-9</p>
			</div>
			<label class="label-control col-1 fl pl_30 red">*</label>
		</div>
		
	</div>

	<div class="form-group">

		<div script-role="check_wrap">
			<label class="label-control col-1 fl">负责人姓名:</label>
			<div class="col-2 fl pr_40">
				<input type="text" {{if data.join_status === '23' || data.join_status === '1'}}readonly="readonly"{{/if}} class="form-control" name="service_person" form_check="sys" ischeck="{{if data.join_status === '23' || data.join_status === '1'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请填写6位以内的负责人名称" re="(.{1,6})" value="{{data.service_person}}" />
			</div>
		</div>

		<div script-role="check_wrap">
			<label class="label-control col-1 fl">职务:</label>
			<input type="text" {{if data.join_status === '23'}}readonly="readonly"{{/if}} class="form-control col-2 fl" name="service_person_work" form_check="sys" ischeck="{{if data.join_status === '23'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请填写10位以内的职务名称" re="(.{1,10})" value="{{data.service_person_work}}" />
			<label class="label-control col-1 fl pl_30 red">*</label>
		</div>
		
	</div>
	<div class="form-group">
		<label class="label-control col-1 fl">手机号码:</label>
				<input type="text" {{if data.join_status === '23' || data.join_status === '1'}}readonly="readonly"{{/if}} class="form-control col-2 fl" name="service_person_phone" form_check="sys" ischeck="{{if data.join_status === '23' || data.join_status === '1'}}false{{else}}true{{/if}}" tip="此项为必填" wrong="请填写格式正确的手机号码" re="(\d{11})" value="{{data.service_person_phone}}" />
		<label class="label-control col-1 fl pl_30 red">*</label>		

	</div>

	<div class="form-group">
	
		<form action="/lgwx/index.php/upload/serviceLogo" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
			<div script-role="check_wrap">
				<label class="label-control fl col-1">
					<p class="mb_10">修改企业logo:</p>
				</label>
				<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.service_logo}}"/>
				<span class="gray">请上传大小为256*256，格式为jpg，gif，png的图片</span>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
					上传中...
				</span>
				<span class="red">*</span>
			</div>
			<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
			
			<div class="mt_5">
				<label class="label-control fl col-1"></label>
				<div class="col-2 fl">
					<img src="{{if data.service_logo}}{{data.service_logo}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
				</div>	
			</div>
		
		</form>
		
	</div>
	
	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-1 fl">企业概述:</label>
		<div class="col-3 fl">
			<textarea class="form-control" name="service_desc" form_check="sys" ischeck="true" tip="此项为必填" wrong="请输入不多于200字的品牌描述" re="((.|\n){1,200})">{{data.service_desc}}</textarea>
			<p class="gray mt_5">请输入不多于200字的企业概述，内容将显示在官网中。</p>
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
	seajs.use('main/manage_info.js');
</script>
</body>
</html>