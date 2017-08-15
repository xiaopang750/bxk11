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
<div id="user_home" class="main_content mt_20" page_type="最新动态">
	<!-- head_info -->
	<div script-role="user_head">
		
	</div>

	<div class="user_main clearfix">
		<div class="list_wrap clearfix">
			<div class="inspir_new_left fl">
				<div class="design_tab ml_15" script-role="design_wrap">
					<div class="bot" script-role="design_list">
					</div>
				</div>
				<div class="monsary_wrap">
					<div class="inspir_new_wrap" script-role="monsary_wrap">
						<ul>
							<!-- 最新文章模板 -->
						</ul>
					</div>
				</div>
			</div>
			<div class="inspir_new_right fr">
				<!-- message -->
				<div class="message_area pt_20">
					<div class="inner">
						<div class="top clearfix pb_10">
							<h3 class="font_14 fl">最新到访</h3>
							<a href="javascript:;" class="yellow fr" script-role="start_message">我要留言</a>
						</div>
						<div script-role="send_area" class="send_area">
							<textarea script-role="input_area"></textarea>
							<a class="yellow_btn fr pt_10" script-role="send_btn" href="javascript:;">
								<span class="head button178 fl"></span>
								<span class="mid button178 fl" script-role="message_send">发表留言</span>
								<span class="end button178 fl"></span>
							</a>
							<div class="clear"></div>
						</div>
					</div>
					<!-- message -->
					<ul class="mt_10 mb_10" script-role="message_list_wrap">
						
					</ul>
				</div>
				<!-- fans -->
				<h3 class="title font_14 bold">Ta的圈子</h3>
				<div class="fans">
					<div class="list pb_10">
						<h4 class="pb_10">Ta的粉丝</h4>
						<div class="border"></div>
						<ul class="clearfix" script-role="fans_wrap">
							
						</ul>
					</div>

					<div class="list pb_10">
						<h4 class="pb_10">Ta的关注</h4>
						<div class="border"></div>
						<ul class="clearfix" script-role="focus_wrap">
							
						</ul>
					</div>
				</div>
				<h3 class="title bold font_14">Ta的方案</h3>
				<div class="scheme_list">
					<!-- scheme -->
					<ul class="clearfix" script-role="scheme_wrap">
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/tpl/home/info.php')?>

<?php loadInclude('/tpl/inspir/artical.php')?>
<?php loadInclude('/tpl/global/arg.php')?>
<?php loadInclude('/tpl/global/arg_list.php')?>
<?php loadInclude('/tpl/global/add_project.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/home/new.js');
</script>
</body>
</html>
