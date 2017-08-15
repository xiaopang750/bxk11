<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>最新资讯</title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/new.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body page-index="1" page-name="最新资讯">
<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/main_nav.php' ?>
	
<div class="banner">
	<img src="/lgwx/static/system/wap/news/news_bg.jpg">
</div>

<!-- content -->
<section class="content mb_20">
	
	<!-- new -->
	<div class="new clearfix mt_10">
		<ul sc="new-wrap">
			
		</ul>
	</div>

</section>

<!-- fenye -->
<?php include APP_STATIC.'model/type1/views/include/monsaryTip.php' ?>


<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/new.js');
</script>
</body>
</html>