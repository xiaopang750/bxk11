<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/sale_net.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body page-index="1">
<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/main_nav.php' ?>
<div class="banner">
	<img src="/lgwx/static/system/wap/news/net_bg.jpg" width="100%">
</div>	

<!-- content -->
<section class="content">
	
	<div class="sale_net mt_20">
		<div class="content">
			<ul class="clearfix" sc="sale_net">
				
			</ul>
		</div>
	</div>

</section>

<!-- fenye -->
<?php include APP_STATIC.'model/type1/views/include/monsaryTip.php' ?>

<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/sale_net.js');
</script>
</body>
</html>