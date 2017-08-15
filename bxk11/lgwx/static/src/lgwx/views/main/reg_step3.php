<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/reg_step.css" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=lnADWlHIBtkvu71Vr1x7O9by"></script>
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

<script type="text/html" id="tpl-step3">

<div class="form-group">
	<label class="label-control col-1 fl">从已添加列表中选择参与认证的门店:</label>
	<select class="fl form-control col-3" name="province_code" form_check="sys" sc="select">
		<option id="" value="">请选择</option>
		{{each data.shop_list}}
		<option id="{{$value.shop_id}}">{{$value.shop_name}}</option>
		{{/each}}
	</select>
</div>

<div class="form-group" script-role="check_wrap">
	<label class="label-control col-1 fl">实体店名称:</label>
	<div class="col-2 fl">
		<input type="text" class="form-control" name="shop_name" form_check="sys" ischeck="true" tip="实体店名称不能为空" wrong="请输入30位以内的实体店名称" re="(.{1,30})" value="{{data.shop_name}}" />
		<p class="gray mt_5">请填写实体店全称,与店面实景照片门头一致</p>
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group">
	<label class="label-control fl col-1">实体店地址:</label>
	<div class="fl col-1 mr_10" script-role="check_wrap">
		<select class="fl form-control " name="shop_province" form_check="sys" ischeck="true" tip="省不能为空" wrong="" re=".+" script-role="province">
			<option value="">省</option>
			{{each data.shop_area.province}}
				<option value="{{$value.district_name}}" id="{{$value.district_code}}" {{if $value.select}}selected="selected"{{/if}}>{{$value.district_name}}</option>
			{{/each}}
		</select>
	</div>
	<div class="fl col-1 pr_20" script-role="check_wrap">
		<select class="fl form-control" name="shop_city" form_check="sys" ischeck="true" tip="市不能为空" wrong="" re=".+" script-role="city">
			<option value="">市</option>
			{{each data.shop_area.city}}
				<option value="{{$value.district_name}}" id="{{$value.district_code}}" {{if $value.select}}selected="selected"{{/if}}>{{$value.district_name}}</option>
			{{/each}}
		</select>
	</div>

	<div class="fl col-2" script-role="check_wrap">
		<input type="text" class="form-control"  name="shop_address" form_check="sys" ischeck="true" tip="门店详细地址不能为空" wrong="请输入50位以内的门店详细地址" re="(\S{1,50})" value="{{data.shop_address}}" />
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group"  script-role="check_wrap">
	<label class="label-control col-1 fl">联系电话:</label>
	<input type="text" class="form-control col-2 fl" name="shop_tel" form_check="sys" ischeck="true" tip="联系电话不能为空" wrong="请输入正确格式的电话号码" re="(1[3|4|5|8]\d{9})|(\d{8})|(\d{11})" value="{{data.shop_tel}}" />
</div>

<div class="form-group">
	<form action="/lgwx/index.php/upload/serviceShop" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
		<div script-role="check_wrap">
			<label class="label-control fl col-1">店面实景照片1:</label>
			<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.shop_pic1}}"/>
			<span class="uploadLoading" script-role="uploadLoading">
				<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				上传中...
			</span>
			<span class="red">*请至少上传一张门店实景图</span>
		</div>
		<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>

		<div class="mt_5">
			<label class="label-control fl col-1"></label>
			<div class="col-2 fl">
				<img src="{{if data.shop_pic1}}{{data.shop_pic1}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
			</div>	
		</div>

	</form>
</div>

<div class="form-group">
	<form action="/lgwx/index.php/upload/serviceShop" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
		<div script-role="check_wrap">
			<label class="label-control fl col-1">店面实景照片2:</label>
			<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.shop_pic2}}"/>
			<span class="uploadLoading" script-role="uploadLoading">
				<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				上传中...
			</span>
		</div>
		<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>

		<div class="mt_5">
			<label class="label-control fl col-1"></label>
			<div class="col-2 fl">
				<img src="{{if data.shop_pic2}}{{data.shop_pic2}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
			</div>	
		</div>

	</form>
</div>

<div class="form-group">
	<form action="/lgwx/index.php/upload/serviceShop" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
		<div script-role="check_wrap">
			<label class="label-control fl col-1">店面实景照片3:</label>
			<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.shop_pic3}}"/>
			<span class="uploadLoading" script-role="uploadLoading">
				<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				上传中...
			</span>
		</div>
		<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>

		<div class="mt_5">
			<label class="label-control fl col-1"></label>
			<div class="col-2 fl">
				<img src="{{if data.shop_pic3}}{{data.shop_pic3}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
			</div>	
		</div>

	</form>
</div>

<div class="form-group" script-role="check_wrap">
	<label class="label-control col-1 fl">店面描述:</label>
	<div class="col-5 fl mt_6">
		<textarea class="form-control" name="shop_explain" form_check="sys" ischeck="true" tip="门店描述不能为空" wrong="请填写200字以内的描述" re="((.|\n){1,200})">{{data.shop_explain}}</textarea>
		<p class="mt_5 gray">请填写200字以内的描述</p>
	</div>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group" script-role="check_wrap">
	<label class="label-control col-1 fl">地图导航设置:</label>
	<div class="col-2 fl pr_40">
		<input readonly="readonly" type="text" class="form-control" name="shop_longitude" form_check="sys" ischeck="true" tip="请在地图中点击选择" wrong="请在地图中点击选择" re="(.+)" value="{{data.shop_longitude}}" sc="lng" />
		<p class="mt_5 gray">标注地图位置可以在手机上为用户提供店铺导航服务</p>
	</div>
	<div class="col-2 fl">
		<input readonly="readonly" type="text" class="form-control" name="shop_latitude" form_check="sys" ischeck="true" tip="请在地图中点击选择" wrong="请在地图中点击选择" re="(.+)" value="{{data.shop_latitude}}" sc="lat" />
	</div>
	<a href="javascript:;" class="ml_40 fl btn btn-default" sc="map-btn">在地图中查看</a>
	<label class="label-control col-1 fl pl_30 red">*</label>
</div>

<div class="form-group">
	<label class="label-control col-1 fl"></label>
	<div class="col-5 fl mt_6">
		<a class="btn btn-danger small" sc="back" href="javascript:;"><span class="mr_10">《上一步</span></a>
		<a class="btn btn-primary small" script-role="confirm_btn" href="javascript:;"><span class="mr_10">提交验证</span>》</a>
	</div>
</div>
</script>

<div class="map" sc="map">
	<h3 class="red tc pb_10">请点击地图选择您的地理位置</h3>
	<div id="map"></div>
	<div class="tc pt_15">
		<a class="btn btn-success" sc="close" href="javascript:;">确定</a>
	</div>
</div>

<!-- cutbox -->
<{include file="../include/cutbox.php"}>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>

	seajs.use('main/reg_step.js');

</script>
</body>
</html>