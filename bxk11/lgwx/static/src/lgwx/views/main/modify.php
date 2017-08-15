<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/modify.css" />
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
		<label class="label-control col-1 fl">用户ID:</label>
		<input type="text" readonly="readonly" class="form-control col-3 fl" name="service_user_id" value="{{data.service_user_id}}" />
	</div>
	
	<div class="form-group">
		<label class="label-control col-1 fl">绑定手机号:</label>
		<input type="text"  class="form-control col-3 fl" name="user_phone" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写格式正确的手机号" re="(\d{11})" value="{{data.service_user_phone}}" />
	</div>

	<div class="form-group">
		<label class="label-control col-1 fl">绑定邮箱:</label>
		<input type="text"  class="form-control col-3 fl" name="user_email" form_check="sys" ischeck="true" tip="此项为必填" wrong="邮箱格式不正确" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" value="{{data.service_user_email}}" />
	</div>
		

	<div class="form-group">
		<label class="label-control col-1 fl"></label>
		<div class="col-5 fl mt_6">
			<a class="btn btn-default small" sc="modify-pass" href="javascript:;">修改密码</a>
			<a class="btn btn-success small" script-role="confirm_btn" href="javascript:;">保存</a>
		</div>
	</div>
	
</script>

<div sc="modify-pass-lay" class="modify-pass">
	<div class="table-title clearfix">
		<span class="icon-list-head icon17"></span>
		<span class="text">
			密码修改
		</span>
	</div>
	<div class="form" script-bound="pass_modify">

		<div class="form-group" script-role="check_wrap">
			<label class="label-control col-2 fl">原始密码:</label>
			<input type="password" class="form-control col-3 fl" name="oldPassWord" form_check="sys" ischeck="true" tip="原始密码不能为空" wrong="请输入6-16位的原始密码" re="(\w{6,16})" />
		</div>
		<div class="form-group" script-role="check_wrap">
			<label class="label-control col-2 fl">输入新密码:</label>
			<input type="password" class="form-control col-3 fl" sc = "pass-new" name="newPassWord" form_check="sys" ischeck="true" tip="新密码不能为空" wrong="请输入6-16位的新密码" re="(\w{6,16})" />
		</div>
		<div class="form-group" script-role="check_wrap">
			<label class="label-control col-2 fl">再次输入新密码:</label>
			<input type="password" class="form-control col-3 fl" sc="re-new-pass" name="reNewPassWord" form_check="self" ischeck="true" tip="新密码不能为空" wrong="两次输入的密码不一致" re="(\w{6,16})" />
		</div>

		<div class="form-group">
			<label class="label-control col-2 fl"></label>
			<div class="col-5 fl mt_6">
				<a class="btn btn-success small" script-role="pass_btn" href="javascript:;">保存</a>
				<a class="btn btn-danger small" sc="close" href="javascript:;">取消</a>
			</div>
		</div>

	</div>
</div>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/modify.js');
</script>
</body>
</html>