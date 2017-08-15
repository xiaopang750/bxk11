<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/index/index.css')?>"/>
</head>
<body main_type="首页">
<?php loadInclude('/lib/global/header.php')?>
<div class="banner178">
	<div class="banner_inner" script-role="widget-focus-wrap" widget-width="1400" widget-height="550">
		<a class="banner_left_btn button178" href="javascript:;" onfocus="this.blur()" script-role="widget-focus-left" widget-index="3">prev</a>
		<div class="banner_wrap" script-role="widget-focus-outer">
			<ul script-role="widget-focus-inner">
				
			</ul>
		</div>
		<a class="banner_right_btn button178" href="javascript:;" onfocus="this.blur()" script-role="widget-focus-right" widget-index="3">next</a>
		<div class="banner_lay"></div>
	</div>
</div>
<div class="main_content" script-role="index_main_content">
	<!-- main_nav -->
	<div class="main_nav178">
		<ul class="clearfix">
			<li>
				<div>
					<h3><a href="/index.php/user/regist" target="_blank">加入一起吧</a></h3>
					<p><a href="/index.php/user/regist" target="_blank">只需三步完成注册一起装修吧</a></p>
				</div>
			</li>
			<li>
				<div>
					<h3><a href="/index.php/tag/index" target="_blank">收藏生活灵感</a></h3>
					<p><a href="/index.php/tag/index" target="_blank">将喜欢的家居美图博文加入灵感集</a></p>
				</div>
			</li>
			<li>
				<div>
					<h3><a href="#">参观家装案例</a></h3>
					<p><a href="#">案例整体设计装修方案应用至我的项目</a></p>
				</div>
			</li>
			<li>
				<div>
					<h3><a href="#">体验家居产品</a></h3>
					<p><a href="#">在线体验家居产品为自己量身定制搭配方案</a></p>
				</div>
			</li>
			<li>
				<div>
					<h3><a href="#">实体店铺采购</a></h3>
					<p><a href="#">在线下实体店铺体验采购，享受品牌服务</a></p>
				</div>
			</li>
		</ul>
	</div>
	<div class="shadow_1000"></div>
	<!-- 3d -->
	<div class="threed">
		<iframe src="/index.php/room/xml3dRecommend?sid=852" frameborder="0" width="1000" height="500"></iframe>
	</div>
	<div class="shadow_1000"></div>
	
	<!-- main -->
	<div class="main clearfix">
		<div class="index_left_content fl" script-role="index_content_wrap">
			<ul>
				<!-- 文章模板 -->
			</ul>
		</div>
		<div class="index_right_content fr">
			<!-- 每日之星 -->
			<div class="section_star mb_30" script-role="content_list_jia178">
				<!-- 每日之星模板 -->
			</div>
			<!-- 设计师 -->
			<div class="designer mb_30">
				<div class="designer_inner ml_30 pt_27">
					<h3 class="font_16 bold mb_30">设计师人气榜</h3>
					<ul class="clearfix"  script-role="design_wrap">
						<!-- 设计师模板 -->
					</ul>
				</div>
			</div>
			<!-- 推荐 -->
			<div class="recommend mb_30"  script-role="recommend_wrap">
				<!-- 今日推荐模板 -->
			</div>
			<!-- 问题 -->
			<div class="question">
				<div class="question_inner ml_30 pt_27">
					<h3 class="font_16 bold mb_30">热点装修问题</h3>
					<ul class="pb_20"  script-role="question_wrap">
						<!-- 装修问题模板 -->
					</ul>
				</div>
			</div>
		</div>
		</div>
	</div>

<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/tpl/index/index_banner.php')?>
<?php loadInclude('/tpl/index/index_star.php')?>
<?php loadInclude('/tpl/index/index_question.php')?>
<?php loadInclude('/tpl/index/index_content.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/index/index.js');
</script>
</body>
</html>
