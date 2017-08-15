<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/home/home.css')?>"/>
</head>
<body>
<?php loadInclude('/lib/global/header.php')?>
<div id="user_home" class="main_content mt_20" page_type="楼盘方案">
	<!-- head_info -->
	<div script-role="user_head">
		
	</div>

	<div class="user_main">
		<div class="scheme_wrap list_wrap" script-role="scheme_wrap">
			
		</div>
	</div>
</div>

<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/tpl/home/info.php')?>
<?php loadInclude('/tpl/home/scheme_list.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/home/scheme.js');
</script>
</body>
</html>
