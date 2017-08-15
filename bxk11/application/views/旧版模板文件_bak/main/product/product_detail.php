<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/product/detail.css')?>"/>
</head>
<body main_type="产品">
<?php loadInclude('/lib/global/header.php')?>
<div id="product_detail" class="main_content">
	<div script-role="product_detail_wrap">
		<!--  -->
	</div>

	<div class="scheme mb_15">
		<div class="inner">
			<div class="clearfix pb_14">
				<span class="effect icon178 fl pr_14"></span>
				<span class="font_18 fl">实景搭配效果</span>
			</div>
			<div class="scheme_wrap">
				<ul script-role="scheme_list_wrap">
					
				</ul>
			</div>
		</div>
	</div>
</div>

<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/tpl/product/detail.php')?>
<?php loadInclude('/tpl/product/brand_list.php')?>
<?php loadInclude('/tpl/case/room_search.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/product/detail.js');
</script>
</body>
</html>
