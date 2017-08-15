<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/goods.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body page-index="2">

<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/level2.php' ?>

<!-- sort -->
<section class="sort mb_20">
	<ul class="box" sc="select-wrap">
		
	</ul>
</section>
	
<!-- content -->
<section class="content mb_20">

	<!-- content -->
	<section class="content">
		<section class="goods clearfix">
			<ul sc="goods">
				
			</ul>
		</section>
	</section>

</section>


<!-- fenye -->
<?php include APP_STATIC.'model/type1/views/include/monsaryTip.php' ?>

<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/product_footer.php' ?>


<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/goods.js');
</script>
</body>
</html>