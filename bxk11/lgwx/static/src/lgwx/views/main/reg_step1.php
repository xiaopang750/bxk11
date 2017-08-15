<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/reg_step.css" />
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
	<{include file="../include/confirm.php"}>
	<div class="form"  script-bound="form_check">

	</div>
</div>

<script type="text/html" id="tpl-step1">
	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-2 fl">企业名称:</label>
		<div class="col-2 fl">
			<input type="text" class="form-control" name="join_name" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写30位以内的企业名称" re="(.{1,30})" value="{{data.join_name}}" />
			<p class="gray mt_5">请填写企业全称，与营业执照保持一致</p>
		</div>
		<label class="label-control col-1 fl pl_30 red">*</label>
	</div>

	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-2 fl">企业邮箱:</label>
		<div class="col-2 fl">
			<input type="text" class="form-control" name="join_email" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写格式正确的邮箱" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" value="{{data.join_email}}" />
			<p class="gray mt_5">请填写企业邮箱,方便接收对账等业务信息</p>
		</div>
		<label class="label-control col-1 fl pl_30 red">*</label>
	</div>

	<div class="form-group" script-role="check_wrap">
		
		<div script-role="check_wrap">
			<label class="label-control col-2 fl">营业执照注册号:</label>
			<div class="col-2 fl mr_20">
				<input type="text" class="form-control" name="join_license_code" form_check="sys" ischeck="true" tip="此项为必填" wrong="请输入15位的营业执照注册号" re="(.{15})" value="{{data.join_license_code}}" />
				<p class="gray mt_5">请输入15位的营业执照注册号</p>
			</div>
			
		</div>

		<form action="/lgwx/index.php/upload/serviceJoin" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
			<div script-role="check_wrap">
				<label class="label-control fl col-2">请上传有效营业执照清晰彩色原件扫描件，支持.jpg gif bmp格式照片，大小不超过2M(有效期内年检章齐全):</label>
				<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.join_license}}"/>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
					上传中...
				</span>
				<span class="red">*</span>
			</div>
			<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
			<div>
				<label class="label-control fl col-2"></label>
				<div class="col-2 fl">
					<img src="{{if data.join_license}}{{data.join_license}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
				</div>	
			</div>
		</form>

	</div>

	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-2 fl">组织机构代码:</label>
		<div class="col-2 fl">
			<input type="text" class="form-control" name="join_code" form_check="sys" ischeck="true" tip="此项为必填" wrong="组织机构代码格式不正确" re="[a-zA-Z0-9]{8}-[a-zA-Z0-9]" value="{{data.join_code}}" />
			<p class="gray mt_5">请输入9位组织机构代码,如12345678-9</p>
		</div>
		<label class="label-control col-1 fl pl_30 red">*</label>
	</div>

	<div class="form-group">
		
		<div script-role="check_wrap">
			<label class="label-control col-2 fl">负责人姓名:</label>
			<div class="col-2 fl pr_40">
				<input type="text" class="form-control" name="join_person" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写6位以内的负责人名称" re="(.{1,6})" value="{{data.join_person}}" />
				<p class="gray mt_5">请输入负责人姓名</p>
			</div>
		</div>
		
		<div script-role="check_wrap">
			<label class="label-control col-1 fl">职务:</label>
			<input type="text" class="form-control col-2 fl" name="join_person_work" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写10位以内的职务名称" re="(.{1,10})" value="{{data.join_person_work}}" />
			<label class="label-control col-1 fl pl_30 red">*</label>
		</div>
		
	</div>

	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-2 fl">手机号码:</label>
		<div class="col-2 fl">
			<input type="text" class="form-control" name="join_phone" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写格式正确的手机号码" re="(\d{8}|\d{11})" value="{{data.join_phone}}" />
			<p class="gray mt_5">请输入负责人手机号码</p>
		</div>
		<label class="label-control col-1 fl pl_30 red">*</label>
	</div>

	<div class="form-group">
		<label class="label-control col-2 fl"></label>
		<div class="col-2 fl mt_6">
			<a class="btn btn-success" script-role="confirm_btn" href="javascript:;"><span class="mr_10">下一步</span>》</a>
		</div>
	</div>	
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/reg_step.js');
</script>
</body>
</html>