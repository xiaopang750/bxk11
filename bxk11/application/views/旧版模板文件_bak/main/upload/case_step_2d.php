<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/upload/upload.css')?>"/>
</head>
<body main_type="案例">
<?php loadInclude('/lib/global/header.php')?>
<div class="upload main_content" script-role="upload_type" upload_type="发布装修案例" step_type="2" type="2d">
	<?php loadInclude('/lib/upload/pagestep2.php')?>
</div>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/common_temp.php')?>
<!-- 裁切box -->
<?php loadInclude('/lib/upload/cut_box.php')?>

<!-- 房间效果图 -->
<div style="display:none">
	<div id="flat3d" class="upload_flat_3d" style="margin-top:50px">
		<div class="inner">
			<div class="head">
				<!-- tag -->
				<div class="tag_area" script-role="flat_area">
					
				</div>
				
				<div class="clearfix mt_10">
					<div class="input_area fl">
						<div class="label">
							<span>房间大小:</span>
						</div>
						<div class="input">
							<input type="text" class="text flat_square" form_check="sys" ischeck="true" name="flat_price"  tip="房间大小不能为空" script-role="flat_price" wrong="您输入的格式不正确" re="/d{1,5}"/>
							<span class="ml_5">平米</span>
						</div>
					</div>

					<div class="input_area fl">
						<div class="label">
							<span>增加关键词</span>
						</div>
						<div class="input">
							<div class="tag_left">
								<input type="text" class="boxupload" script-role="tag_input" />
								<span class="ml_5">(输入关键词，按空格结束)</span>
								<div class="tag_left_inner" script-role="tag_wrap">	
									<div class="tag_tip" script-role="tag_tip">
										<div class="tip_head">
											<span class="tip_name fl pl_11" script-role="tip_name">热门标签(每次15个热门标签)</span>
											<a class="change_btn" href="javascript:;" script-role="change_btn">换一组</a>
											<a class="close_btn button178" script-role="close_related_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
										</div>
										<div class="tag_result" script-role="relate_wrap">
											<!-- <a script-role="relate_tag" href="javascript:;">11</a> -->
										</div>
										<div class="tag_bot">
											提示：热门标签有助于灵感被浏览（点击自动选中）
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				
				<div class="tag_area result">
					<div class="tag_list clearfix">
						<span class="in_bl name">当前关键词:</span>
						<span class="in_bl pl_10" script-role="flat_tag_result">
							
						</span>
						<span class="in_bl" script-role="result_wrap">
							<span script-role="result_tag">
								
							</span>
						</span>
					</div>
				</div>
				
				<!-- 上传区域 -->
				<div class="flat_upload_area mb_10">
					<div class="inner">
						<div class="upload_head clearfix mb_10">
							<div class="flat_upload_btn fl" script-role="flat_upload_btn">
							
							</div>
							<div class="flat_upload_tip">jpg、gif、png格式，单张图片不超过10MB，一次最多上传6张。</div>

						</div>
						<div class="upload_main">
							<ul class="clearfix" id="flat_list">
								<!-- <li>
									<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
									<dl>
										<dt><img src="" alt="" width="154" height="112" /></dt>
										<dd contenteditable="true">
											
										</dd>
									</dl>
								</li> -->
							</ul>
						</div>
					</div>
				</div>

				<!-- 上传按钮 -->
				<div class="clearfix">
					<div class="fl red pl_10" script-role="flat_wrong"></div>
					<a class="confirm_btn button178 fr ml_5" script-role="flat_confirm_btn" onfocus="this.blur()" href="javascript:;">
						<span>完成</span>
					</a>
					<a class="cancel_btn button178 fr" script-role="flat_cancel_btn" onfocus="this.blur()" href="javascript:;">
						<span>取消</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/upload/case_step2.js');
</script>
</body>
</html>
