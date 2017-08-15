<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/info.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body page-index="1">

<div class="login-top mb_2">
	<a href="<?php echo $backurl;?>">
		<span class="back login-icon" sc="back"></span>
	</a>
	<span>会员中心</span>	
</div>

<!-- content -->
<section class="content">
	
	<div sc="info">

	</div>

</section>


<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/info.js');
</script>
</body>
</html>