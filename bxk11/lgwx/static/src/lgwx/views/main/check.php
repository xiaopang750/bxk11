<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
			
			<div sc="fail" class="type">
				<div class="clearfix">
					<span class="reg-icon fail fl"></span>
					<span class="fr font_18 text">
						您的认证申请审核未通过
					</span>
				</div>
				<div class="reason">
					未通过原因：<span sc="fail-text"></span>
				</div>
				<div class="clearfix mt_40">
					<a class="btn btn-danger fr" href="javascript:;" sc="fail-link">马上修改</a>
				</div>
			</div>
			

			<div sc="suc" class="type">
				<div class="clearfix">
					<span class="reg-icon suc fl"></span>
					<span class="fr font_18 text">
						您的认证申请审核已通过，请不要重复申请，如果企业认证信息发生变更，请联系客户专员。
					</span>
				</div>
				<div class="clearfix mt_40">
					<a class="btn btn-danger fr" href="javascript:;" sc="close">关闭</a>
				</div>
			</div>
		</div>
	</div>
	
</div>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/check.js');
</script>
</body>
</html>