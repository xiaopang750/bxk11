<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/reg_step.css" />
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
	
	<div class="table-title clearfix"></div>
	<div class="form rel" script-bound="form_check">
		<img src="<{$smarty.const.APP_LINK}>img/main/reg/reg_sub.jpg" width="100%" />
		<div class="reg_suc">
			<div class="clearfix mb_20">
				<span class="reg-icon right fl">
					
				</span>
				<span class="fr font_18 text">
					您的认证申请已成功提交，我们将在1个工作日内完成认证审核，请及时查看系统消息。
				</span>
			</div>
			<div class="clearfix">
				<span class="reg-icon warning fl">
					
				</span>
				<span class="fr font_18 text">
					小贴士：如果您已经拥有<span class="red">【微信公众服务号】</span>，可以马上<a href="javascript:;" sc="bind_link">绑定微信公众号</a>如果您还没有，可以<a href="javascript:;" sc="apply" target="_blank">直接申请</a>，然后进行绑定。
				</span>
			</div>
			<div class="clearfix mt_40">
				<a class="btn btn-danger fr" href="javascript:;" sc="after-btn">以后再说</a>
			</div>
		</div>
	</div>
	
</div>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/reg_step.js');
</script>
</body>
</html>