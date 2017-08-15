<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/show.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body page-index="3">
<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/main_nav.php' ?>
	

<!-- content -->
<section class="content mb_20">
	
	<!-- show_detail -->
	<section class="show mt_20 clearfix">
		<ul sc="show_detail">
			
		</ul>
	</section>

</section>


<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/product_footer.php' ?>



<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/show_detail.js');
</script>
</body>
</html>