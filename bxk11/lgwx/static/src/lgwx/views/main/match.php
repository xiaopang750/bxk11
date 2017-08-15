<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/match.css" />
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
		<span class="icon-list-head icon13"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>
	<div class="form" sc="data-wrap" script-bound="form_check">
	
	</div>
</div>

<div sc="lay" class="none">
	<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif" sc="lay-img">
</div>

<script type="text/html" id="info">
	<div class="form-group" script-role="check_wrap">
		<label class="label-control fl col-1">套餐名称:</label>
		<input type="text" class="form-control fl col-2"  name="gm_name" form_check="sys" ischeck="true" tip="套餐名称名称不能为空" wrong="请输入2-16位套餐名称" re="(\S{2,16})" value="{{data.gm_name}}" />
	</div>
	<div class="form-group" script-role="check_wrap">
		<form action="/lgwx/index.php/upload/goodsmatch" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
			<div script-role="check_wrap">
				<label class="label-control fl col-1">
					<p class="mb_10">套餐配封面:</p>
				</label>
				<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.gm_pic}}"/>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
					上传中...
				</span>
			</div>
			<div class="mt_5">
				<label class="label-control fl col-1"></label>
				<div class="col-2 fl">
					<img src="{{if data.gm_pic}}{{data.gm_pic}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
				</div>	
			</div>
			<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
		</form>
	</div>
	<div class="form-group" script-role="check_wrap">
		<label class="label-control fl col-1">套餐价格:</label>
		<input type="text" class="form-control fl col-2"  name="gm_price" form_check="sys" ischeck="true" tip="套餐价格不能为空" wrong="套餐价格格式不正确" re="((\d+\.\d+)|(\d+))" value="{{data.gm_price}}" />
		<a class="btn btn-success small fl ml_15" sc="match-add">添加套餐商品</a>
		<label class="label-control fl gray">套餐原价:</label>
		<span sc="org-price" class="fl mt_6">{{data.countPrice}}</span>
		<div class="clearfix"></div>
		<ul class="mt_20 selected-table clearfix" sc="goods-list-show-wrap">
			{{include 'goods-list'}}
		</ul>
	</div>

	<div class="form-group">
		<label class="label-control col-1 fl"></label>
		<div class="col-5 fl mt_6">
			<a class="btn btn-success" href="javascript:;" script-role="confirm_btn">保存</a>
		</div>
	</div>


</script>

<script type="text/html" id="goods-list">
{{each data.gm_selection_list}}
<li gid="{{$value.goods_id}}" sc="goods-item">
	<dl>
		<dt class="mb_10">
			<img src="{{$value.goods_pic1}}"  width="110" height="73">
			<div class="close" gid="{{$value.goods_id}}" sc="goods-remove" price="{{$value.goods_price}}">X</div>
		</dt>
		<dd class="tc">
			{{$value.goods_name}}
		</dd>
	</dl>
</li>
{{/each}}
</script>

<!-- cutbox -->
<{include file="../include/cutbox.php"}>

<!-- shopbox -->
<{include file="../include/goods_select_multi.php"}>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/match.js');
</script>
</body>
</html>