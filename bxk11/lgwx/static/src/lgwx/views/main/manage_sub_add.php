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
		<span class="icon-list-head icon1"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>

	<div class="back clearfix">
		<a href="#" class="fr font_18 none" sc="shop_add">添加门店</a>
	</div>

	<div class="form" script-bound="form_check">
		
	</div>

</div>

<script type="text/html" id="sub-add">
	<div class="form-group" script-role="check_wrap">
			<label class="label-control col-2 fl">子账户名称:</label>
			<input type="text" class="form-control col-2 fl" name="user_name" form_check="sys" ischeck="true" tip="子账户名称不能为空" wrong="请输入2-16位子账户名称" re="(.{2,16})" value="{{data.user_name}}" {{if data.user_name}}disabled="disabled"{{/if}} />
		</div>
		<div class="form-group"  script-role="check_wrap">
			<label class="label-control col-2 fl">子账户密码:</label>
			<input type="password" class="form-control col-2 fl" {{if !data.is_manage}} name="user_password" form_check="sys" ischeck="true" tip="密码不能为空" wrong="请输入6-16位的密码" re="(\w{6,16})"{{/if}} sc="confirm-pass" />
		</div>
		<div class="form-group"  script-role="check_wrap">
			<label class="label-control col-2 fl">确认密码:</label>
			<input type="password" class="form-control col-2 fl" name="reply_password" form_check="self" ischeck="true" tip="确认密码不能为空" wrong="两次输入的密码不一致" re="(\w{6,16})" sc="confirm-reply-pass" />
		</div>

		<form action="/lgwx/index.php/upload/serviceUser" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
			<div class="form-group">
				<label class="label-control fl col-2">用户头像:</label>
				<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.user_photo}}"/>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
					上传中...
				</span>
			</div>
			<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
			<div class="form-group" {{if !data.user_photo}}style="display:none"{{/if}}>
				<label class="label-control fl col-2"></label>
				<div class="col-2 fl">
					<img src="{{data.user_photo}}" script-role="view_image" height="50">
				</div>	
			</div>
		</form>

		{{if data.is_manage=="0" || !data.is_manage}}
		<div class="form-group"  script-role="check_wrap">
			<label class="label-control col-2 fl">子帐号负责门店:</label>
			<div class="col-6 fl mt_6" checkbox_group="true" name="user_shop" form_check="sys" ischeck="true" tip="请至少选择一个门店" wrong="请输入2-16位的门店名称" re="(\w{2,16})">
				{{each data.user_shop}}
					<input type="checkbox"  class="fl mr_3 mt_3" id="{{$value.shop_id}}" {{if $value.select}}checked="checked"{{/if}} />
					<span class="fl mr_5">{{$value.shop_name}}</span>
				{{/each}}
			</div>
		</div>

		
		<div class="form-group"  script-role="check_wrap">
			<label class="label-control col-2 fl">子账户权限:</label>
			<div class="col-6 fl mt_6" checkbox_group="true" name="user_module" form_check="sys" ischeck="true" tip="请至少选择一项权限">
				{{each data.user_module}}
					<input type="checkbox"  class="fl mr_3 mt_3" id="{{$value.module_key}}" {{if $value.select}}checked="checked"{{/if}} />
					<span class="fl mr_5">{{$value.module_name}}</span>
				{{/each}}
			</div>
		</div>
		{{/if}}


		<div class="form-group"  script-role="check_wrap">
			<label class="label-control col-2 fl">子账户负责人:</label>
			<input type="text" class="form-control col-2 fl" name="user_realname" form_check="sys" ischeck="true" tip="负责人名称不能为空" wrong="请输入2-16位子账负责人名称" re="(.{2,16})" value="{{data.user_realname}}"  />
		</div>
		<div class="form-group"  script-role="check_wrap">
			<label class="label-control col-2 fl">子账户负责人电话:</label>
			<input type="text" class="form-control col-2 fl" name="user_phone" form_check="sys" ischeck="true" tip="负责人联系电话不能为空" wrong="请输入正确格式的电话号码" re="(1[3|4|5|8]\d{9})|(\d{8})|(\d{11})" value="{{data.user_phone}}" />
		</div>

		<div class="form-group">
			<label class="label-control col-2 fl"></label>
			<div class="col-2 fl mt_6">
				<button class="btn btn-success" script-role="confirm_btn">确定</button>
			</div>
		</div>
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/manage_sub_add.js');
</script>
</body>
</html>