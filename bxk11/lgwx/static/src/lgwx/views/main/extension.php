<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>灵感无限</title>
<style>
* {margin:0;padding:0}
img {border:none}
ul,ol,li {list-style:none}

li {display: none;}

.btn {
	position: absolute;
	z-index: 50;
	bottom:5%;
	left:0;
	background: url('/lgwx/static/src/lgwx/img/main/extension/regist.png') no-repeat;
	width: 136px;
	height: 40px;
	margin-left:-68px;
	left:50%;
}
</style>
</head>

<body>
<!-- banner -->
<section class="focus">
	<div widget-role="focus-wrap" widget-width="100%" widget-height="100%" widget-scale="1" style="margin:0 auto">
		<ul class="focus_wrap" widget-role="focus-data-wrap">
			<li><img src="<{$smarty.const.APP_LINK}>/img/main/extension/1.jpg" link=""/></li>
			<li><img src="<{$smarty.const.APP_LINK}>/img/main/extension/2.jpg" link=""/></li>
			<li>
				<img src="<{$smarty.const.APP_LINK}>/img/main/extension/3.jpg" link=""/>
				<div class="btn" sc="link" href="<{$text_url}>"></div>
			</li>
		</ul>
		<div class="dot_wrap" widget-role="focus-dot-wrap">
			
		</div>
	</div>
</section>

new ActiveXObject('Microsoft.XMLHTTP')
<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/extention');
</script>
</body>
</html>