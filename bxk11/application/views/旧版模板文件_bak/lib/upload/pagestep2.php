<?php loadInclude('/lib/upload/case_nav.php')?>

	<div class="upload_main case2">
		
		<div class="inner">
			<div class="show_project_wrap pb_10 ml_5" script-role="show_project_wrap">
				<span>方案名称：</span>
				<span script-role="show_project_name"></span>
			</div>
			<div class="form_top clearfix" script-role="form_top" script-bound="step2_check">
				<!-- 选择方案类型 -->
				<div class="input_area clearfix">
					<div class="label">
						<span>选择方案类型</span>
					</div>
					<div class="input fl mt_5 pr_17">
						<input type="radio" name="type" script-role="select_way" target="/index.php/scheme/addscheme" role-type="2d" />
						<span>平面效果方案</span>
						<input type="radio" name="type" script-role="select_way" target="/index.php/scheme/addscheme3d" role-type="3d" />
						<span>3D全景方案</span>
					</div>
					<div class="fl mt_5">
						提示：只有认证设计师才能上传3D全景方案
						<a href="#" class="ml_20 yellow">示例</a>
					</div>
				</div>

				<!-- 方案名称 方案造价 -->
				<div class="input_area clearfix">
					<div class="fl">
						<div class="label">
							<span>方案名称</span>
						</div>
						<div class="input">
							<input type="text" class="text project_input" form_check="sys" ischeck="true" name="scheme_name"  tip="方案名称不能为空" script-role="project_name" wrong="请输入10个字以内的方案名称" re="[(a-zA-Z0-9)|(\u4e00-\u9fa5)|\s]{1,20}" scheme_id="" pressUrl="/index.php/posts/scheme/checkscheme" param="scheme_name"/>
						</div>
					</div>

					<div class="fl">
						<div class="label">
							<span>方案造价</span>
						</div>
						<div class="input">
							<input type="text" class="text price_input" form_check="sys" ischeck="true" name="scheme_cost"  tip="方案造价不能为空" script-role="price" wrong="请输入6位数以内的价格" re="\d{1,6}"/>
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
						<textarea type="text" class="text think" form_check="sys" ischeck="true" name="scheme_thinking"  tip="设计思路不能空" script-role="need" wrong="请输入200个字以内的设计思路" re=".{1,200}"></textarea>
					</div>
				</div>

				<div class="clearfix">
					<div class="project_save_btn create" script-role="project_save_btn" offsetLoad="32">
						创建方案
					</div>
				</div>
			</div>
			
			<!-- 上传区域 -->
			<div class="type_upload_area" script-role="type_upload_area">
				<div class="red pb_10 font_14">户型为跃层或别墅显示增加楼层</div>
				<div class="type_upload_head clearfix">
					<ul class="head_list fl" script-role="floor_list">
						<!-- <li class="floor_btn" script-role="floor_btn">一层</li> -->
					</ul>
					<div class="type_add_btn fl" script-role="type_add_btn">
						+增加楼层
					</div>
				</div>
				<div class="type_upload_main">
					<div class="type_upload_inner" script-role="type_upload_inner">
						<!-- <div class="type_upload_list clearfix" script-role="type_upload_list">
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
						</div> -->
					</div>
				</div>

				<!-- 按钮区域 -->
				<div class="sub_area clearfix mt_10 pb_20" script-role="page_btn_area">
					<a class="confirm_btn fr ml_5" script-role="send_btn" onfocus="this.blur()" href="javascript:;">
						<span script-role="send_btn">发布</span>
					</a>
					<a class="view_btn fr ml_5" script-role="save_page_btn" onfocus="this.blur()" href="javascript:;">
						<span script-role="save_page_btn">保存草稿</span>
					</a>
					<a class="cancel_btn fr" script-role="cancel_page_btn" onfocus="this.blur()" href="javascript:;">
						<span script-role="cancel_page_btn">取消</span>
					</a>
				</div>
			</div>

		</div>
	</div>