<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/home/home.css')?>"/>
</head>
<body>
<?php loadInclude('/lib/global/header.php')?>
<div id="user_home" class="main_content mt_20" page_type="灵感辑">
	<!-- head_info -->
	<div script-role="user_head">
		
	</div>

	<div class="user_main">
		<div class="home_inspir_wrap list_wrap" script-role="home_inspir_wrap">
			<ul script-role="inspir_wrap">
				
			</ul>			
		</div>
	</div>
</div>

<div id="inspir_box" script-role="inspir_box">
	<div class="box_main">
		<a class="close_btn button178" script-role="inspir_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
		<div class="left_area fl">
			<div class="pic_wrap mb_20">
				<img src="" width="859" height="545" script-role="detail_pic" />
				<div class="shadow"></div>
				<div class="text">
					<span class="pl_10">灵感图片描述：<span script-role="dec"></span></span>
				</div>
			</div>
			<div class="info clearfix">
				<div class="fl">
					<div class="mb_5">
						灵感辑名称:<span class="ml_5 mr_15" script-role="pic_name">1232</span>
						<span class="ml_5 mr_15" script-role="pic_num"></span>
						<span>
							<a href="javascript:;" script-role="prev_btn">上一张</a>
							<span>/</span>
							<a href="javascript:;" script-role="next_btn">下一张</a>
						</span>
					</div>
					<div>
						<span>关键词:</span>
						<span script-role="keyword" class="keyword"></span>
					</div>
				</div>
				<a class="like_btn home_bg fr" href="javascript:;" script-role="fav">
					<span class="white ml_50 font_14" script-role="fav_name">喜欢</span>
				</a>
			</div>
		</div>
		<div class="right_area fr">
			<a class="up_btn button178 ml_25" script-role="up_btn" href="javascript:;">上</a>
			<ul class="mt_10" script-role="pic_list_wrap">
				
			</ul>
			<a class="down_btn button178 ml_25" script-role="down_btn" href="javascript:;">上</a>
		</div>
	</div>
</div>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/tpl/home/info.php')?>
<?php loadInclude('/tpl/home/inspir_list.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/home/inspir.js');
</script>
</body>
</html>
