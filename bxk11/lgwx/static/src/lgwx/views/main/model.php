<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/model.css" />
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

	<div class="model">
		<div class="table-title clearfix">
			
		</div>
	</div>

	<div class="form" sc="data-wrap">
		
	</div>
</div>

<script type="text/html" id="model">
<div class="head">
	<span class="ml_30">
		当前模板:
		<span sc="view-name">{{data.mine_template.template_name}}</span>
	</span>
</div>
<div class="model-wrap clearfix">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="30%" class="model-main">
				<div>
					<img src="{{data.mine_template.template_cover}}" sc="view-img" />
					<p class="main-name mt_5" sc="view-name">{{data.mine_template.template_name}}</p>
				</div>
			</td>
			<td width="70%">
				<div class="model-view">
					{{each data.template_list}}
					<span>
						<dl>
							<dt>
								<img src="{{$value.template_cover}}">
							<dd>
								{{$value.template_name}}
								<input type="radio" name="radio1" temp-id="{{$value.template_id}}" sc="model-select" {{if $value.is_select == 1}}checked="checked"{{/if}} temp-img="{{$value.template_cover}}" temp-name="{{$value.template_name}}" />
							</dd>
						</dl>
					</span>
					{{/each}}
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="model-bottom">
	<div class="btn-wrap">
		<a class="btn btn-danger small" script-role="confirm_btn" href="javascript:;" tmpId="{{data.mine_template.template_id}}">应用</a>
		<span class="model-upload">
			<a class="btn btn-success small" href="javascript:;">更换背景</a>
			<form action="/lgwx/index.php/upload/wap_template_pic" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
				<input type="file" class="mt_5" name="userfile" script-role="upload-file" iamgeurl="{{data.apply_license_file}}"/>
				<span class="uploadLoading" script-role="uploadLoading">
					<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
				</span>
				<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
			</form>
		</span>
		<a class="btn btn-danger small" script-role="reduction" href="javascript:;" tmpId="{{data.mine_template.template_id}}">还原默认</a>
	</div>
</div>	
</script>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/model.js');
</script>
</body>
</html>