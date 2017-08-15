<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/about_us.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body>
<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/level2.php' ?>
	

<!-- content -->
<section class="content">
	
	<div class="about_us mt_20">
		<!-- <div id="map">
			
		</div> -->
		<div class="content about_area" sc="about_us">
			
		</div>
	</div>

</section>


<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=Z8RnXxB58RBxYYL9EXOE0DVh&v=1.0"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/about_us.js');
</script>
</body>
</html>