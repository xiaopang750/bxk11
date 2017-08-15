<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php echo $title ?></title>
<?php include APP_STATIC.'global/include/globalcss.php' ?>
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/layer.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/index.css">
<link rel="stylesheet" href="<?php echo APP_LINK; ?>model/type1/css/skin/<?php echo $template_code; ?>.css">
</head>

<body page-index="1">

<!-- nav -->
<?php include APP_STATIC.'model/type1/views/include/main_nav.php' ?>

<div class="index-bg" sc="index-bg">
	<!-- index-module -->
	<div class="module clearfix" id="module">
		<ul sc="module-wrap" class="clearfix">
			
		</ul>
	</div>
</div>

<!-- banner -->
<!-- <section class="focus">
	<div widget-role="focus-wrap" widget-width="540" widget-height="300" widget-scale="1" style="margin:0 auto">
		<ul class="focus_wrap" widget-role="focus-data-wrap">
			
		</ul>
		<div class="dot_wrap" widget-role="focus-dot-wrap">
			
		</div>
	</div>
</section> -->

<!-- index-new -->
<!-- <div class="rec mb_20" sc="index-new">
			
</div> -->

<!-- content -->
<!-- <section class="content mb_20"> -->
	
	

<!-- </section> -->
<!-- footer -->
<?php include APP_STATIC.'model/type1/views/include/footer.php' ?>

<script src="<?php echo APP_SEAJS; ?>seajs/sea.js"></script>
<script src="<?php echo APP_SEAJS; ?>seajs/configWap.js"></script>
<script>
	seajs.use('model/type1/js/main/index.js');
</script>
</body>
</html>