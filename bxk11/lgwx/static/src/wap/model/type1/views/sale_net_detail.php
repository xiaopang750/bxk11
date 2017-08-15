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

<body page-index="2">
<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/main_nav.php' ?>
	

<!-- content -->
<section class="content">
	
	<div class="sale_net_detail mt_20">
		
		<div class="content mt_20 pb_20 rel" sc="sale_net_detail">
			
		</div>
		<div id="map">
			
		</div>
	</div>

</section>


<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=Z8RnXxB58RBxYYL9EXOE0DVh&v=1.0"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/sale_net_detail.js');
</script>
</body>
</html>