<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/upload/upload.css')?>"/>
</head>
<body main_type="案例">
<input type="button" value="11111" style="position:fixed;top:300px;right:100px" id="bguo1" />
<input type="button" value="22222" style="position:fixed;top:300px;right:0"  id="bguo2"/>

<?php loadInclude('/lib/global/header.php')?>
<div class="upload main_content" script-role="upload_type" upload_type="发布装修案例" step_type="2">
	<?php loadInclude('/lib/upload/case_nav.php')?>

	<div class="upload_main case2" script-bound="step2_check">
		
		<div class="inner">

			<!-- 选择方案类型 -->
			<div class="input_area clearfix">
				<div class="label">
					<span>选择方案类型</span>
				</div>
				<div class="input fl mt_5 pr_17" name="type" ischeck="false" radio_group="1">
					<input type="radio" name="type" checked="checked" />
					<span>平面效果方案</span>
					<input type="radio" name="type" />
					<span>3D全景方案</span>
				</div>
				<div class="fl mt_5">
					提示：只有认证设计师才能上传3D全景方案
					<a href="#" class="ml_20 yellow">示例</a>
				</div>
			</div>

			<!-- 方案名称 方案造价 -->
			<div class="input_area">
				<div class="input_area fl">
					<div class="label">
						<span>方案名称</span>
					</div>
					<div class="input">
						<input type="text" class="text project_input" form_check="sys" ischeck="true" name="project_name"  tip="方案名称不能为空" script-role="project_name" wrong="请输入10个字以内的方案名称" re="[(a-zA-Z0-9)|(\u4e00-\u9fa5)|\s]{1,10}"/>
					</div>
				</div>

				<div class="input_area fl">
					<div class="label">
						<span>方案造价</span>
					</div>
					<div class="input">
						<input type="text" class="text price_input" form_check="sys" ischeck="true" name="price"  tip="方案造价不能为空" script-role="price" wrong="您输入的格式不正确" re="/d{1,5}"/>
						<span class="ml_5 font_14">万元</span>
					</div>
				</div>
			</div>

			<!-- 设计思路 -->
			<div class="input_area clearfix">
				<div class="label">
					<span>设计思路</span>
				</div>
				<div class="input">
					<textarea type="text" class="text think" form_check="sys" ischeck="true" name="think"  tip="设计思路不能空" script-role="need" wrong="请输入200个字以内的设计思路" re=".{1,200}"></textarea>
				</div>
			</div>
			
			<!-- 上传区域 -->
			<div class="type_upload_area" script-role="type_upload_area">
				<div class="red pb_10 font_14">户型为跃层或别墅显示增加楼层</div>
				<div class="type_upload_head clearfix">
					<ul class="head_list fl">
						<!-- <li class="floor_btn" script-role="floor_btn">1123</li> -->
					</ul>
					<div class="type_add_btn fl" script-role="type_add_btn">
						+增加楼层
					</div>
				</div>
				<div class="type_upload_main">
					<div class="type_upload_inner" script-role="type_upload_inner">
						<div class="type_upload_list clearfix" script-role="type_upload_list">
							<div class="type_left_wrap">
								<div class="type_left" script-role="type_left">
									<a class="upload_btn_text button178 type_upload_btn" script-role="upload_typebox_btn" onfocus="this.blur()" href="javascript:;">
										<span>上传平面布置图</span>
									</a>
								</div>
								<div class="repeat_upload_btn" script-role="repeat_uploadbox_btn">
									重新上传平面布置图
								</div>
							</div>
							<div class="type_right_wrap">
								<div class="type_right" script-role="type_right">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/common_temp.php')?>
<!-- 裁切box -->
<div id="cutbox" script-role="cut_box">
	<a class="close_btn button178 fr mt_10 pr_10" script-role="cut_box_close" onfocus="this.blur()" href="javascript:;">关闭</a>
	<div class="inner clearfix">
		<div class="left">
			<h3 class="font_24 mb_10">上传平面布置图</h3>
			<p class="mb_10">提示：拖拽或伸缩虚线框选择平面图布置图显示区域</p>
			<div class="box_type_view_wrap" script-role="cutWrap">
				<div class="box_type_view" script-role="box_type_view">
					<img src="" alt="" / script-role="cut_image">
				</div>
				<a class="rotate_btn button178" script-role="rotate_btn" href="javascript:;">旋转</a>
			</div>
			<div class="arrange_btn" script-role="arrange_btn"></div>
		</div>
		<div class="right">
			<p>
				提示：系统默认平面图背景色为白色
			</p>
			<div class="right_view" script-role="right_view">
				
			</div>
			<div class="save_arrange" script-role="save_arrange" page-role="upload_lay_pic">保存并关闭</div>
		</div>
	</div>
</div>

<!-- 房间效果图 -->
<div id="flat" class="upload_flat_3d" style="margin-top:50px">
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
							<input type="text" script-role="tag_input" />
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
			<div class="flat_upload_btn clearfix">
				<div class="fl red pl_10" script-role="flat_wrong">
				</div>
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

<!-- 3d效果图 -->
<div id="preserve" class="upload_flat_3d" style="margin-top:50px">
	<div class="inner">
		<div class="head">
			<!-- tag -->
			<div class="tag_area" script-role="preserve_area">
				
			</div>
			
			<div class="clearfix mt_10">
				<div class="input_area fl">
					<div class="label">
						<span>房间大小:</span>
					</div>
					<div class="input">
						<input type="text" class="text flat_square"  script-role="preserve_price" />
						<span class="ml_5">平米</span>
					</div>
				</div>

				<div class="input_area fl">
					<div class="label">
						<span>增加关键词</span>
					</div>
					<div class="input">
						<div class="tag_left">
							<input type="text" script-role="tag_input2" />
							<div class="tag_left_inner" script-role="tag_wrap2">	
								<div class="tag_tip" script-role="tag_tip2">
									<div class="tip_head">
										<span class="tip_name fl pl_11" script-role="tip_name2">热门标签(每次15个热门标签)</span>
										<a class="change_btn" href="javascript:;" script-role="change_btn2">换一组</a>
										<a class="close_btn button178" script-role="close_related_btn2" onfocus="this.blur()" href="javascript:;">关闭</a>
									</div>
									<div class="tag_result" script-role="relate_wrap2">
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
					<span class="in_bl pl_10" script-role="preserve_tag_result">
						
					</span>
					<span class="in_bl" script-role="result_wrap2">
						<span script-role="result_tag2">
							
						</span>
					</span>
				</div>
			</div>

			<!-- 上传区域 -->
			<div class="flat_upload_area mb_10">
				<div class="inner">
					<div class="upload_head clearfix mb_10">
						<div class="flat_upload_btn fl" script-role="preserve_upload_btn">
						
						</div>
						<div class="flat_upload_tip">jpg、gif、png格式，单张图片不超过10MB，一次最多上传6张。</div>

					</div>
					<div class="upload_main">
						<ul class="clearfix" script-role="preserve3d_list">
							<li>
								<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
								<dl>
									<dt><img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112"  script-role="preserve3d_img" img_type="UP" /></dt>
									<dd class="tc mt_10">
										上_UP
									</dd>
								</dl>
							</li>
							<li>
								<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
								<dl>
									<dt><img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112" script-role="preserve3d_img" img_type="DN" /></dt>
									<dd class="tc mt_10">
										下_DN
									</dd>
								</dl>
							</li>
							<li>
								<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
								<dl>
									<dt><img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112" script-role="preserve3d_img" img_type="LF" /></dt>
									<dd class="tc mt_10">
										左_LF
									</dd>
								</dl>
							</li>
							<li>
								<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
								<dl>
									<dt><img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112" script-role="preserve3d_img" img_type="RT"/></dt>
									<dd class="tc mt_10">
										右_RT
									</dd>
								</dl>
							</li>
							<li>
								<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
								<dl>
									<dt><img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112" script-role="preserve3d_img" img_type="FR" /></dt>
									<dd class="tc mt_10">
										前_FR
									</dd>
								</dl>
							</li>
							<li>
								<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">关闭</a>
								<dl>
									<dt><img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112" script-role="preserve3d_img"  img_type="BK"/></dt>
									<dd class="tc mt_10">
										后_BK
									</dd>
								</dl>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<!-- 上传按钮 -->
			<div class="flat_upload_btn clearfix">
				<div class="fl red pl_10" script-role="preserve_wrong">
				</div>
				<a class="confirm_btn button178 fr ml_5" script-role="preserve_confirm_btn" onfocus="this.blur()" href="javascript:;">
					<span>完成</span>
				</a>
				<a class="cancel_btn button178 fr" script-role="preserve_cancel_btn" onfocus="this.blur()" href="javascript:;">
					<span>预览</span>
				</a>
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



