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
		<div class="reply-wrap clearfix">
			<div class="content-wrap fl">

				<div class="text-wrap mr_20">
					<div class="text-title">
						<div class="text-logo">
							<div class="pt_5 pl_5">
								<span class="icon-text-logo"></span>
								<span>文字</span>
							</div>
						</div>
					</div>
					<div class="text-content">
						<textarea sc="text-input"></textarea>
					</div>
					<div class="text-bottom">
						<span class="fr mr_10 mt_4 gray">您还可以输入<span sc="text-tip"></span>字</span>
					</div>
					<a href="javascript:;" sc="remove-text" class="btn btn-default mt_20 small">删除</a>
					<a href="javascript:;" sc="save-text" class="btn btn-success mt_20 small">保存</a>
				</div>

			</div>
			<div class="navlist fl">
				<ul sc="text-nav">
					
				</ul>
			</div>

		</div>
	</div>
</div>

<script type="text/html" id="text-nav">
{{each data.reply_nav}}
	<li>
		<a href="{{$value.url}}" {{if $value.selected == 1}}class="active"{{/if}}>{{$value.text}}</a>
	</li>
{{/each}}
</script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/reply_message.js');
</script>
</body>
</html>