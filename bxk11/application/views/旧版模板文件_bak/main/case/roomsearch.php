<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/case/case.css')?>"/>
</head>
<body main_type="案例">
<?php loadInclude('/lib/global/header.php')?>
<div class="case_search main_content" script-role="case_search">
	<!-- 搜索条件 -->
	<div class="search_top mb_40" script-role="search_wrap">
		<div class="inner">
			<!-- <div class="header_top clearfix pb_10">
				<span class="icon_block icon178 mr_5 fl"></span>
				<span class="mr_5 font_16 blue fl">整体家居设计方案</span>
				<span class="fl mt_4">3D全景体验专业的家居配套设计方案</span>
			</div> -->
			<div class="search_tip">
				<div class="tag_wrap" script-role="tag_wrap">
					<!-- <div class="tiplist clearfix">
						<span class="pr_20 fl">1</span>
						<ul class="fl">
							<li><a href="javascript:;">13</a></li>
						</ul>
					</div> -->
				</div>
				<div class="search_detail clearfix pt_10">
					<div class="fl">
						<a href="javascript:;" class="hot fl mr_12" location_type="sort" value="1">近期热门</a>
						<a href="javascript:;" class="new fl" location_type="sort" value="2">最新发布</a>
					</div>
					<div class="fr">
						<div class="search_input_wrap">
							<input type="text" script-role="case_search_area" />
							<span>|</span>
							<a class="header_search_btn button178" script-role="case_search_btn" onfocus="this.blur()" href="javascript:;" location_type="keyword">搜索</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 搜索结果 -->
	<div class="search_result rec_main" script-role="monsary_wrap">
		<ul class="clearfix">
			
		</ul>
	</div>
</div>

<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/tpl/case/room_search.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/case/case_search.js');
</script>
</body>
</html>
