
		<!-- BEGIN PAGE -->
<div class="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div id="portlet-config" class="modal hide">

				<div class="modal-header">

					<button data-dismiss="modal" class="close" type="button"></button>

					<h3>portlet Settings</h3>

				</div>

				<div class="modal-body">

					<p>Here will be a configuration form</p>

				</div>

			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN STYLE CUSTOMIZER -->

						<!--<div class="color-panel hidden-phone">

							<div class="color-mode-icons icon-color"></div>

							<div class="color-mode-icons icon-color-close"></div>

							<div class="color-mode">

								<p>THEME COLOR</p>

								<ul class="inline">

									<li class="color-black current color-default" data-style="default"></li>

									<li class="color-blue" data-style="blue"></li>

									<li class="color-brown" data-style="brown"></li>

									<li class="color-purple" data-style="purple"></li>

									<li class="color-grey" data-style="grey"></li>

									<li class="color-white color-light" data-style="light"></li>

								</ul>

								<label>

									<span>Layout</span>

									<select class="layout-option m-wrap small">

										<option value="fluid" selected="">Fluid</option>

										<option value="boxed">Boxed</option>

									</select>

								</label>

								<label>

									<span>Header</span>

									<select class="header-option m-wrap small">

										<option value="fixed" selected="">Fixed</option>

										<option value="default">Default</option>

									</select>

								</label>

								<label>

									<span>Sidebar</span>

									<select class="sidebar-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected="">Default</option>

									</select>

								</label>

								<label>

									<span>Footer</span>

									<select class="footer-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected="">Default</option>

									</select>

								</label>

							</div>

						</div>-->

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							标签分类&amp; 标签分类添加  <small>标签分类&amp; 内容管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">内容管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">标签分类 </a></li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->


				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN SAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-cogs"></i>3D索引图导航</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/three_config/docontrol_add');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">

									<thead>

										<tr>

		
											<th colspan='8'>控制面板的设置</th>
											

										</tr>

									</thead>

									<tbody>
				
										<tr style="display:none;" id='s_class_name'>
											<td colspan='8'>
													<div class="alert alert-error">
														<button class="close" data-dismiss="alert"></button>
														<strong>错误!</strong>
														<span id='s_class_error'>The daily cronjob has failed.</span>
													</div>
											
											</td>
										
											
										</tr>
										
										<tr>
									 		<td colspan='4' style='text-align:right;'>控制面板文件类型:</td>
											<td colspan='4'>
											
											<select name='type' >
												<option value='control1' <?php if($control['type'] == 'control1') echo "selected";?>>control1</option>
												<option value='control2' <?php if($control['type'] == 'control2') echo "selected";?>>control2</option>
												<option value='control3' <?php if($control['type'] == 'control3') echo "selected";?>>control3</option>
												<option value='control4' <?php if($control['type'] == 'control4') echo "selected";?>>control4</option>
												<option value='control5' <?php if($control['type'] == 'control5') echo "selected";?>>control5</option>
											</select>（控制面板文件路径）
											
											
											</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>推荐控制面板文件类型:</td>
											<td colspan='4'>
											
											<select name='type_recommend' >
												<option value='control6' <?php if($control['type_recommend'] == 'control6') echo "selected";?>>control6</option>
											</select>（控制面板文件路径）
											
											
											</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>控制面板的宽度:</td>
											<td colspan='4'><input type="text" id="width" name="width" value='<?php echo $control['width']?>'>（控制面板的宽度，单位像素或百分比）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>控制面板的高度:</td>
											<td colspan='4'><input type="text" id="height" name="height" value='<?php echo $control['height']?>'>（控制面板的高度，单位像素）HTML5</td>
									 	</tr>
									 	<tr >
									 	 	<td colspan='4' style='text-align:right;'>控制面板在界面上显示的x坐标:</td>
											<td colspan='4'><input type="text" id="x" name="x" value="<?php echo $control['x']?>">（控制面板在界面上显示的x坐标，可以是百分比和正负数字，百分比为50%，则居中）</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>控制面板在界面上显示的y坐标: </td>
										<td colspan='4'>
											<input type="text" id="y" name="y" value="<?php echo $control['y']?>">（索引图在界面上显示的y坐标，单位为像素，值为正负数字，正数为离开上边边的距离，负数为离开下边的距离）</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>初始是否显示: </td>
										<td colspan='4'>
											<label class="radio">
												<input type="radio" class="input_blur"  name="initialShow" value='1' <?php if($control['initialShow'] == '1' ||!$control['initialShow']) echo "checked";?>>显示
											</label>
											<label class="radio">
												<input type="radio" class="input_blur" name="initialShow" value='0' <?php if($control['initialShow'] == '0') echo "checked";?>>隐藏</td>
									 	    </label>
									 	</tr>
										
										<tr>
									 		<td colspan='4' style='text-align:right;'>按钮宽度:</td>
											<td colspan='4'><input type="text" id="buttonWidth" name="buttonWidth" value="<?php echo $control['buttonWidth']?>">（按钮宽度 ）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>按钮高度:</td>
											<td colspan='4'><input type="text" id="buttonHeight" name="buttonHeight" value="<?php echo $control['buttonHeight']?>">（按钮高度）HTML5</td>
									 	</tr>
									 	
									 											<tr>
									 		<td colspan='4' style='text-align:right;'>控制面板的背景色:</td>
											<td colspan='4'><input type="text" id="bgColor" name="bgColor" value="<?php echo $control['bgColor']?>" checked>（控制面板背景颜色，6位色值，如：FFFFFF）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>控制面板背景透明度:</td>
											<td colspan='4'><input type="text" id="bgAlpha" name="bgAlpha" value="<?php echo $control['bgAlpha']?>">（缩略图导航的背景透明的，值为0至1）HTML5</td>
									 	</tr>
									 	
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>左转按钮的左上角坐标:</td>
											<td colspan='4'>
		
											<input type="text" id="left" name="left" value="<?php echo $control['left']?>" />

											（左转按钮的左上角坐标）HTML5</td>
									 	
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>右转按钮的左上角坐标:</td>
											<td colspan='4'>
							
											
											<input type="text" id="right" name="right" value="<?php echo $control['right']?>"/>
											
											（右转按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>上转按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="up" name="up" value="<?php echo $control['up']?>"/>
										
											（上转按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>下转按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="down" name="down" value="<?php echo $control['down']?>"/>
										
											（下转按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>放大按钮左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="zoomin" name="zoomin" value="<?php echo $control['zoomin']?>"/>
										
											（放大按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>缩小按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="zoomout" name="zoomout" value="<?php echo $control['zoomout']?>"/>
										
											（缩小按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>全屏按钮左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="full" name="full" value="<?php echo $control['full']?>"/>
										
											（全屏按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>退出全屏按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="eixtFull" name="eixtFull" value="<?php echo $control['eixtFull']?>"/>
										
											（退出全屏按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>上一个全景按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="prev" name="prev" value="<?php echo $control['prev']?>"/>
										
											（上一个全景按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>下一个全景按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="next" name="next" value="<?php echo $control['next']?>"/>
										
											（下一个全景按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	
									 					 	<tr>
									 		<td colspan='4' style='text-align:right;'>显示/隐藏缩略图按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="thumb" name="thumb" value="<?php echo $control['thumb']?>"/>
										
											（显示/隐藏缩略图按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>显示/隐藏地图按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="map " name="map" value="<?php echo $control['map']?>"/>
										
											（显示/隐藏地图按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>显示控制面板按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="show " name="show" value="<?php echo $control['show']?>"/>
										
											（显示控制面板按钮的左上角坐标）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>隐藏所有控制面板、缩略图导航和地图按钮的左上角坐标:</td>
											<td colspan='4'>

											<input type="text" id="next " name="hide" value="<?php echo $control['hide']?>"/>
										
											（隐藏所有控制面板、缩略图导航和地图按钮的左上角坐标）HTML5</td>
									 	</tr>
										<tr>
											<input type="hidden" name="t_c_id" value="<?php echo $control['t_c_id']?>" />
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消'></td>	
										</tr>
										
									</tbody>

								</table>
							</form>
							</div>

						</div>

						<!-- END SAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT-->

			</div>

			<!-- END PAGE CONTAINER--> 

		</div>

		<!-- END PAGE -->
