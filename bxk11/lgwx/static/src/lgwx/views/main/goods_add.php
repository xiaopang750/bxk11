<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/series.css" />
<script src="../../static/editor/ueditor.config.js"></script>
<script src="../../static/editor/ueditor.all.min.js"></script>
<script src="../../static/editor/lang/zh-cn/zh-cn.js"></script>
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
		<div class="goods_add" script-bound="form_check">
			
		</div>	
	</div>
</div>

<script type="text/html" id="goods-add">
	<div class="form-group">
		<span class="label-control col-1 fl">基本信息:</span>
		<span class="fl mt_6">品牌:{{data.brand_name}}, 系列:{{data.series_name}}</span>
	</div>

	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">商品类别:</span>
		<div class="fl col-2 mr_10">
			<select class="fl form-control" script-role="main-type">
				<option value="" id="">请选择品类</option>
				{{each data.class_plist}}
				<option value="{{$value.class_name}}" id="{{$value.class_id}}" {{if $value.is_select == 1}}selected="selected"{{/if}}>{{$value.class_name}}</option>	
				{{/each}}
			</select>
		</div>
		<div class="fl col-2" script-role="check_wrap">
			<select class="fl form-control" name="class_id" form_check="sys" ischeck="true" tip="子类别不能为空" wrong="" re=".+" script-role="sub-type">
				<option value="" id="">请选择子品类</option>
				{{each data.class_sonlist}}
				<option value="{{$value.class_name}}" id="{{$value.class_id}}" {{if $value.is_select == 1}}selected="selected"{{/if}}>{{$value.class_name}}</option>	
				{{/each}}
			</select>
		</div>
	</div>

	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">商品名称:</span>
		<input type="text" class="form-control col-2" name="goods_title" form_check="sys" ischeck="true" tip="此项为必填" wrong="商品名称不能超过60个字" re="(.{1,60})" value="{{data.goods_title}}" />
	</div>

	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">产品型号:</span>
		<input type="text" class="form-control col-2" name="goods_model_number" form_check="sys" ischeck="true" tip="此项为必填" wrong="产品型号不能超过25个字" re="(.{1,25})" value="{{data.goods_model_number}}" />
	</div>

	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">商品编码:</span>
		<input type="text" class="form-control col-2" name="goods_code" form_check="sys" ischeck="true" tip="此项为必填" wrong="商品编码不能超过25个字" re="(.{1,25})" value="{{data.goods_code}}" />
	</div>

	<div class="form-group">
		<span class="label-control col-1 fl">商品价格:</span>
		<div script-role="check_wrap fl" class="col-1 mr_40 pr_15 fl">
			<input type="text" class="form-control" name="goods_price" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写正确的商品价格" re="((\d|\.){1,25})" value="{{data.goods_price}}" sc="goods-price"/>
		</div>
		<div class="col-4 fl" script-role="check_wrap">
			<span class="label-control col-2 fl">计价单位:</span>
			<select class="form-control col-2" name="pu_id" form_check="sys" ischeck="true" tip="请选计价单位" wrong="" re=".+">
				<option value="" id="">请选择</option>
				{{each data.unitlist}}
					<option value="{{$value.pu_name}}" id="{{$value.pu_id}}" {{if $value.is_select == 1}}selected="selected"{{/if}}>{{$value.pu_name}}</option>	
				{{/each}}
			</select>
		</div>
	</div>

	<div class="form-group">
		<span class="label-control col-1 fl">会员价格:</span>
		<div script-role="check_wrap fl" class="col-1 mr_40 pr_15 fl">
			<input type="text" class="form-control" name="goods_member_price" form_check="sys" ischeck="true" tip="此项为必填" wrong="请填写正确的商品价格" re="((\d|\.){1,25})" value="{{data.goods_member_price}}"/>
		</div>
		<div class="col-4 fl" script-role="check_wrap">
			<span class="label-control col-2 fl">不显示价格:</span>
			<input type="checkbox" class="fl mt_7" sc="is-show" {{if data.goods_price_is_show == 1}}checked="checked"{{/if}}>
		</div>
	</div>

	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">尺寸（厘米）:</span>
		<input type="text" class="form-control col-2" name="goods_size" form_check="sys" ischeck="true" tip="此项为必填" wrong="商品规格不能超过25个字" re="(.{1,25})" value="{{data.goods_size}}" />
	</div>
	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl">商品材质:</span>
		<input type="text" class="form-control col-2" name="goods_material" form_check="sys" ischeck="true" tip="此项为必填" wrong="商品材质不能超过25个字" re="(.{1,25})" value="{{data.goods_material}}" />
	</div>

	<div class="form-group" script-role="check_wrap">
		<div class="label-control col-1 fl">
			<p>上传商品缩略图:</p>
			<p class="gray">最多上传5张</p>
		</div>
		<div class="uploads-wrap fl">
			<ul class="goods-upload fl" sc="item-wrap" nowitem="{{if !data.pic_list}}0{{else}}{{data.pic_list.length}}{{/if}}" max="5">
				{{include 'goods-tpl'}}
			</ul>
			<form action="/lgwx/index.php/upload/serviceGoodsthumb" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
				<input type="file" class="mt_5 file-input" name="userfile" script-role="upload-file" iamgeurl="{{if $value!==''}}{{$value}}{{/if}}" {{if data.pic_list}}{{if data.pic_list.length>=5}}disabled="disabled"{{/if}}{{/if}}/>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
					上传中...
				</span>
				<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
			</form>
		</div>	
	</div>

	<div class="form-group" script-role="check_wrap">
		<div class="label-control col-1 fl">
			<p>商品相关推荐:</p>
			<p class="gray">最多推荐10个</p>
		</div>
		<div class="uploads-wrap fl">
			<ul class="goods-upload fl selected-table" sc="goods-list-show-wrap">
				{{include 'goods-list'}}
			</ul>
			<a class="btn btn-success small" sc="match-add">添加相关推荐</a>
		</div>
	</div>

	<div class="form-group">
		<span class="label-control col-1 fl">商品描述:</span>
		<div class="fl col-2">
			<p class="blue mt_6 mb_6">请填写2000字以内的商品描述</p>
			<div id="editor" type="text/plain" style="width:600px;height:300px" uploadsdir="../../../../uploads/service/goods/ueditor"></div>
		</div>
	</div>

	<div class="form-group">
		<span class="label-control col-1 fl"></span>
		<button class="btn btn-success" script-role="confirm_btn">确定</button>
	</div>
</script>

<script type="text/html" id="goods-tpl">
{{if data.pic_list}}
	{{each data.pic_list}}
	<li sc="item" iamgeurl="{{$value}}">
		<img src="{{$value}}" script-role="view_image" width="60" height="40">
		<div class="close" sc="item-close">x</div>
	</li>
	{{/each}}
{{/if}}
</script>

<script type="text/html" id="goods-list">
{{if data.gm_selection_list}}
	{{each data.gm_selection_list}}
	<li gid="{{$value.goods_id}}" sc="goods-item">
		<dl>
			<dt class="mb_10">
				<img src="{{$value.goods_pic1}}"  width="60" height="40">
				<div class="close" gid="{{$value.goods_id}}" sc="goods-remove">X</div>
			</dt>
		</dl>
	</li>
	{{/each}}
{{/if}}
</script>

<!-- cutbox -->
<{include file="../include/cutbox.php"}>

<!-- shopbox -->
<{include file="../include/goods_select_multi.php"}>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/goods_add.js');
</script>
</body>
</html>

