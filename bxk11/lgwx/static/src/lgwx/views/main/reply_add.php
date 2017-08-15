<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/reply.css" />
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
	<div class="table-title clearfix">
		<span class="icon-list-head icon1"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>

	<div class="form" script-bound="form_check">
		
	</div>
</div>

<script type="text/html" id="reply-add">
	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-1 fl">标题:</label>
		<input type="text" class="form-control col-2 fl" name="si_title" form_check="sys" ischeck="true" tip="此项为必填" wrong="资讯标题不能超过25个字" re="(\S{1,25})" value="{{data.si_title}}" />
	</div>

	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-1 fl">作者:</label>
		<input type="text" class="form-control col-2 fl" name="si_author" form_check="sys" ischeck="true" tip="此项为必填" wrong="资讯标题不能超过10个字" re="(\S{1,10})" value="{{data.si_author}}" />
	</div>

	<div class="form-group" script-role="check_wrap">
		<label class="label-control col-1 fl">摘要:</label>
		<textarea class="form-control col-2 fl h_200"  name="si_desc" form_check="sys" ischeck="true" tip="此项为必填" wrong="摘要不能超过100个字" re="((.|\n){1,100})">{{data.si_desc}}</textarea>
	</div>

	<div class="form-group">
		<label class="label-control col-1 fl">分类:</label>
		<select class="fl form-control col-3" name="it_id" ischeck="true" form_check="sys" sc="select" tip="请至少选择一个分类">
			<option id="" value="">请选择</option>
			{{if data.it_list}}
				{{each data.it_list}}
					<option id="{{$value.it_id}}" {{if $value.select == 1}}selected="selected"{{/if}}>{{$value.it_name}}</option>
				{{/each}}
			{{/if}}
		</select>
	</div>

	<div class="form-group">
	
		<form action="/lgwx/index.php/upload/information" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
		<div script-role="check_wrap">
			<label class="label-control fl col-1">
				<p class="mb_10">上传封面图片:</p>
				<p class="gray">
					上传大小不得超过于512kb的jpg,gif,png,bmp格式图片
				</p>
			</label>
			<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.si_pic}}"/>
			<span class="uploadLoading" script-role="uploadLoading">
				<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				上传中...
			</span>
			<span class="red"></span>
		</div>
		<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
		
		<div class="mt_5">
			<div class="col-2 fl">
				<img src="{{if data.si_pic}}{{data.si_pic}}{{else}}<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif{{/if}}" script-role="view_image" height="50">
			</div>	
		</div>
		
		</form>
		
	</div>

	<div class="form-group">
		<span class="label-control col-1 fl">图文详细页内容:</span>
		<div class="fl col-2">
			<p class="blue mt_6 mb_6">请填写500字以内的图文详细页内容</p>
			<div id="editor" type="text/plain" style="width:600px;height:300px" uploadsdir="../../../../uploads/service/information"></div>
		</div>
	</div>


	<div class="form-group" script-role="check_wrap">
		<span class="label-control col-1 fl"></span>
		<div class="fl mt_6" checkbox_group="true" name="isshow" form_check="sys" ischeck="false" >
			<span class="mr_10">此条资讯不显示在微官网中:</span>
			<input type="checkbox" {{if data.is_show == 1}}checked="checked"{{/if}} sc="isshow" />	
		</div>
	</div>

	<div class="form-group">
		<label class="label-control col-1 fl"></label>
		<button class="btn btn-success" script-role="confirm_btn">保存</button>
	</div>
</script>

<!-- cutbox -->
<{include file="../include/cutbox.php"}>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/reply_add.js');
</script>
</body>
</html>