<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/detail/detail.css')?>"/>
</head>
<body main_type="灵感">
<?php loadInclude('/lib/global/header.php')?>
<div class="main_content clearfix" script-role="content_list_jia178">
	<div class="detail_top mb_20" script-role="detail_head">
		<!-- 详情页头部模板 -->
	</div>
	<div class="detail_mid">
		<div class="fl recent_view">
			<div class="inner">
				<h3 class="font_16 tc mb_10 pt_10">最近浏览</h3>
				<ul script-role="recent_list">
					<!-- 最近浏览模板 -->
				</ul>
			</div>
		</div>
		<div class="inspir_new_wrap fr">
			<ul script-role="monsary_wrap">
				<!-- 文章详情模板 -->
			</ul>
		</div>
	</div>
</div>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/tpl/detail/head.php')?>
<?php loadInclude('/tpl/detail/content.php')?>
<?php loadInclude('/tpl/detail/recent_view.php')?>
<?php loadInclude('/tpl/global/add_project.php')?>
<?php loadInclude('/tpl/global/arg.php')?>
<?php loadInclude('/tpl/global/arg_list.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/detail/detail.js');
</script>
</body>
</html>
