<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/inspir/inspir.css')?>"/>
</head>
<body main_type="灵感">
<?php loadInclude('/lib/global/header.php')?>
<div class="main_content clearfix" script-role="page_type" page_type="精华推荐">
	<!-- left_nav -->
	<div class="inspir_leftnav fl" script-role="left_nav">
		<!-- left_nav模板 -->
	</div>
	<!-- right_area -->
	<div class="right_area fr">
		<!-- main_banner -->
		<div class="inpir_banner" script-role="inpir_banner">
			<!-- banner模板 -->
		</div>
		<div class="tag_area mb_15" script-role="tag_wrap">
			<!-- tag模板 -->
		</div>

		<!-- main_nav -->
		<?php loadInclude('/lib/inspir/nav.php')?>

		<!-- monsary -->
		<div class="monsary_wrap">
			<div class="inspir_wrap" script-role="monsary_wrap">
				<ul></ul>
				<ul></ul>
				<ul></ul>
				<ul></ul>
			</div>
		</div>
	</div>
</div>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/tpl/inspir/left_nav.php')?>
<?php loadInclude('/tpl/inspir/banner.php')?>
<?php loadInclude('/tpl/inspir/tag.php')?>
<?php loadInclude('/tpl/inspir/monsary.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/inspir/rec.js');
</script>
</body>
</html>
