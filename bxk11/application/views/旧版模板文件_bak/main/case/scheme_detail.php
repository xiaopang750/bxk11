<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/case/case.css')?>"/>
</head>
<body main_type="案例">
<?php loadInclude('/lib/global/header.php')?>
<div class="case_detail main_content" script-role="case_detail">
	<div class="flash_area mb_20" script-role="case_flash">
	  	
	</div>
	<!-- detail -->
	<div class="detail_content mb_20"  script-role="detail_main">
		
	</div>
	<!-- 产品 -->
	<div class="product mb_20" script-role="product_wrap">
		
	</div>

	<!-- 评论 -->
	<div class="product_arg" script-role="arg_wrap">
		
	</div>
</div>

<div style="display:none">
	<div id="carry_step_box_confirm" class="dialog">
		<a class="close_btn button178 fr pr_5 mt_5" script-role="close_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">关闭</a>
		<p class="pt_20 pl_20 pr_20 lineH_23">该操作需要消耗<span script-role="need"></span>积分，您目前积分为<span script-role="now"></span>，余额足够，是否继续操作？</p>
		<div class="ml_50 mt_30 pl_15 clearfix">
			<a class="cancel_btn button178 fl mr_5" script-role="cancel_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">
				<span>取消</span>
			</a>
			<a class="confirm_btn button178 fl" script-role="carry_confirm_btn" onfocus="this.blur()" href="javascript:;">
				<span>确定</span>
			</a>
		</div>
	</div>
</div>

<div style="display:none">
	<div id="carry_step_box_fail" class="dialog">
		<a class="close_btn button178 fr pr_5 mt_5" script-role="close_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">关闭</a>
		<p class="pt_20 pl_20 pr_20 lineH_23 tc" script-role="wrongtip"></p>
		<div class="mt_30" style="margin-left:110px">
			<a class="confirm_btn button178" script-role="confirm_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">
				<span>确定</span>
			</a>
		</div>
	</div>
</div>

<div style="display:none">
	<div id="carry_step_box_suc" class="dialog">
		<a class="close_btn button178 fr pr_5 mt_5" script-role="close_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">关闭</a>
		<p class="pt_20 pl_20 pr_20 lineH_23 tc" script-role="right_tip"></p>
		<div class="ml_40 mt_30">
			<a class="view_btn button178" onfocus="this.blur()" href="javascript:;" script-role="view_home" target="_blank">
				<span>预览我的家</span>
			</a>
			<a class="cancel_btn button178" script-role="confirm_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">
				<span>关闭</span>
			</a>
		</div>
	</div>
</div>

<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/tpl/case/case_flash.php')?>
<?php loadInclude('/tpl/case/scheme_detail.php')?>
<?php loadInclude('/tpl/case/product_list.php')?>
<?php loadInclude('/tpl/global/arg.php')?>
<?php loadInclude('/tpl/global/arg_list.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/case/case_detail.js');
</script>
</body>
</html>
