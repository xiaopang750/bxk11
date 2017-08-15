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
	<div class="flash_area mb_20"  script-role="case_flash">
	  	
	</div>
	<!-- detail -->
	<div class="detail_content mb_20" script-role="detail_main">
		
	</div>
	<!-- 产品 -->
	<div class="product mb_20" script-role="product_wrap">
		
	</div>

	<!-- 评论 -->
	<div class="product_arg" script-role="arg_wrap">
		<span>发表评论</span>
	</div>
</div>

<div style="display:none">
	<div id="carry_step_box_confirm" class="dialog">
		<a class="close_btn button178 fr pr_5 mt_5" script-role="close_btn" onfocus="this.blur()" href="javascript:$.fancybox.close();">关闭</a>
		<p class="pt_20 pl_20 pr_20 lineH_23 tc pb_10">加入DIY方案</p>
		<div class="clearfix mb_10 ml_10">
			<input type="radio" name="add_project" class="mr_10 fl" checked="checked" script-role="diy_select_type" script-type="select" />
			<span class="fl pr_10">加入已有DIY方案</span>
			<select class="fl" script-role="diy_select">
				<option value="">请选择</option>
			</select>
		</div>
		<div class="clearfix mb_10 ml_10">
			<input type="radio" name="add_project" class="mr_10 fl" script-role="diy_select_type" script-type="create"  />
			<span class="fl pr_22">或新建DIY方案</span>
			<input type="text" class="add_input" disabled="disabled" script-role="diy_create"/>
		</div>
		<div class="ml_50 pl_10 clearfix">
			<a class="cancel_btn button178 fl mr_5" script-role="diy_cancel" onfocus="this.blur()" href="javascript:$.fancybox.close();">
				<span>取消</span>
			</a>
			<a class="confirm_btn button178 fl" script-role="diy_confirm" onfocus="this.blur()" href="javascript:;">
				<span>确定</span>
			</a>
		</div>
	</div>
</div>

<div style="display:none">
	<div id="carry_step_box_fail" class="dialog">
		<a class="close_btn button178 fr pr_5 mt_5" script-role="close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
		<p class="pt_20 pl_20 pr_20 lineH_23 tc">加入DIY方案成功!</p>
		<div class="ml_18 mt_40">
			<a class="view_btn button178" script-role="cancel_btn" onfocus="this.blur()" href="javascript:;">
				<span>立即查看我的DIY方案</span>
			</a>
			<a class="cancel_btn button178" script-role="confirm_btn" onfocus="this.blur()" href="javascript:;">
				<span>关闭</span>
			</a>
		</div>
	</div>
</div>

<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/tpl/case/case_flash.php')?>
<?php loadInclude('/tpl/case/room_detail.php')?>
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
