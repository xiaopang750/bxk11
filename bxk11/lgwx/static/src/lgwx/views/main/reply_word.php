<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/reply_weixin.css" />
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

	<div class="form"  script-bound="form_check">
		<div class="reply-wrap clearfix pb_20">
			<div class="content-wrap fl mr_40">
				
				<div class="add-wrap">
					<div class="top clearfix mb_10">
						<h3 class="fl font_14">关键词自动回复</h3>
						<a href="javascript:;" class="btn btn-default small fr add-rule-btn" sc="add-rule">添加关键词</a>
					</div>
					<div class="mid" sc="list-wrap">
						
					</div>
				</div>

			</div>
			<div class="navlist fl">
				<ul sc="text-nav">
					
				</ul>
			</div>

		</div>
	</div>
</div>


<div class="info-box" sc="info-box">
	<a href="javascript:;" class="weixin-menu-close" sc="close">关闭</a>
	<div class="info-box-inner mb_15">
		<ul class="clearfix" sc="info-box-wrap">
			
		</ul>
	</div>
	<a href="javascript:;" sc="confirm" role="save-btn" class="fr btn btn-success add small mr_10 confirm-info-btn">确认</a>
</div>

<script type="text/html" id="text-nav">
{{each data.reply_nav}}
	<li>
		<a href="{{$value.url}}" {{if $value.selected == 1}}class="active"{{/if}}>{{$value.text}}</a>
	</li>
{{/each}}
</script>

<script type="text/html" id="list">
{{if data.reply_text_list}}
{{each data.reply_text_list}}
<div class="lister" sc="list">
	<div class="list-title">
		<span class="ml_20 fl">关键字{{if $value.reply_type_mes}}({{$value.reply_type_mes}}){{/if}}</span>
		<a href="javascript:;" class="mr_20 fr" sc="slide-btn" is-slide="no">展开</a>
	</div>

	<div class="key-word">
		<input type="text" class="form-control col-5 ml_20 mt_16" value="{{$value.reply_keyword}}" sc="key" />
	</div>
	<div class="slide-wrap" sc="slide-wrap">
		<div class="list-title">
			<span class="ml_20">回复</span>
		</div>
		<div class="select">
			<ul class="ml_20 clearfix">
				<li sc="text-add" type="1">
					<span class="icon text"></span>
					<span>文字</span>
				</li>
				<li sc="pic-add" type="2" reply_id="{{$value.reply_id}}">
					<span class="icon pic"></span>
					<span>图片</span>
				</li>
			</ul>
		</div>
		<div class="show-wrap" sc="show-wrap">
			<textarea class="form-control {{if $value.reply_type == 1}}active{{/if}}" type="1" sc="area">{{$value.reply_content}}</textarea>
			<div class="{{if $value.reply_type == 2}}active{{/if}}" type="2" sc="info-link-wrap" idlist="{{$value.reply_content_selected}}">
			
				{{include 'photo-list' $value}}

			</div>
		</div>
		<div class="save-area">
			<div class="mr_20 mt_5 fr">
				<a href="javascript:;" class="btn btn-danger small" sc="remove" data-id="{{$value.reply_id}}">删除</a>
				<a href="javascript:;" class="btn btn-success small" sc="save" data-id="{{$value.reply_id}}" type="{{$value.reply_type}}">保存</a>
			</div>
		</div>
	</div>
</div>
{{/each}}
{{/if}}	
</script>

<script type="text/html" id="photo-list">
{{if reply_type == 2 && reply_content.length}}
<div class="photo-view" sc="photo-view">
	<h3 class="mb_10">{{reply_content[0].si_addtime}}</h3>
	<div class="img-wrap mb_20">
		<img src="{{reply_content[0].si_pic}}" />
		<div class="shadow-lay"></div>
		<div class="shadow-text">
			<span class="ml_5">{{reply_content[0].si_title}}</span>
		</div>
	</div>
	<div class="photo-sub-list">
		{{if reply_content.length > 1}}
		<ul>
			{{each reply_content}}
				{{if $index >= 1}}
					<li class="clearfix">
						<span class="fl">{{$value.si_title}}</span>
						<img src="{{$value.si_pic}}" class="fr" width="50" height="50" />
					</li>
				{{/if}}
			{{/each}}
		</ul>
		{{/if}}
	</div>
</div>	
{{/if}}
</script>


<script type="text/html" id="info-box-list">
{{each data.informationlist}}
<li sc="info-select-list" sid="{{$value.si_id}}">
	<h4 class="font_14 mb_10">{{$value.si_addtime}}</h4>
	<p class="mb_5">{{$value.si_title}}</p>
	<img src="{{$value.si_pic}}" class="mb_5" width="208" height="208" />
	<div class="mark"></div>
</li>
{{/each}}
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/reply_word.js');
</script>
</body>
</html>