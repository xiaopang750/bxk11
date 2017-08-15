
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
								<form action="<?php echo site_url('admin/three_config/dothumb_add');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">

									<thead>

										<tr>

		
											<th colspan='8'>索引导航参数设置</th>
											

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
									 		<td colspan='4' style='text-align:right;'>索引图显示的宽度:</td>
											<td colspan='4'><input type="text" id="width" name="width" value="<?php echo $thumb['width']?>" checked>（索引图显示的宽度）</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>索引图显示的高度:</td>
											<td colspan='4'><input type="text" id="height" name="height" value='<?php echo $thumb['height']?>'>（索引图显示的高度）</td>
									 	</tr>
									 	<tr >
									 	 	<td colspan='4' style='text-align:right;'>显示的x坐标:</td>
											<td colspan='4'><input type="text" id="x" name="x" value="<?php echo $thumb['x']?>">（索引图在界面上显示的x坐标，单位为像素，值为正负数字，正数为离开左边的距离，负数为离开右边的距离）</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>显示的y坐标: </td>
										<td colspan='4'>
											<input type="text" id="y" name="y" value="<?php echo $thumb['y']?>">（索引图在界面上显示的y坐标，单位为像素，值为正负数字，正数为离开上边边的距离，负数为离开下边的距离）</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>是否显示索引图导航: </td>
										<td colspan='4'>
											<label class="radio">
												<input type="radio" class="input_blur"  name="initialShow" value='1' <?php if($thumb['initialShow'] == '1' ||!$thumb['initialShow']) echo "checked";?>>显示
											</label>
											<label class="radio">
												<input type="radio" class="input_blur" name="initialShow" value='0' <?php if($thumb['initialShow'] == '0') echo "checked";?>>隐藏</td>
									 	    </label>
									 	</tr>
										
										<tr>
									 		<td colspan='4' style='text-align:right;'>缩略图的宽度:</td>
											<td colspan='4'><input type="text" id="imageWidth" name="imageWidth" value="<?php echo $thumb['imageWidth']?>" checked>（每个缩略图的宽度，默认值120 ）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>缩略图的高度:</td>
											<td colspan='4'><input type="text" id="imageHeight" name="imageHeight" value="<?php echo $thumb['imageHeight']?>" checked>（每个缩略图的高度，默认值80）HTML5</td>
									 	</tr>
									 	
									 											<tr>
									 		<td colspan='4' style='text-align:right;'>缩略图导航的背景色:</td>
											<td colspan='4'><input type="text" id="bgColor" name="bgColor" value="<?php echo $thumb['bgColor']?>" checked>（缩略图导航的背景色，6位数色值，如：FFFFFF）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>缩略图导航的背景透明:</td>
											<td colspan='4'><input type="text" id="bgAlpha" name="bgAlpha" value="<?php echo $thumb['bgAlpha']?>" checked>（缩略图导航的背景透明的，值为0至1）HTML5</td>
									 	</tr>
									 	
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>指定左滑动箭头的标识路径 :</td>
											<td colspan='4'>
											<?php if($thumb['left']){?><img src="<?php echo $thumb['path'].$thumb['left'];?>" width='60' height='60'/><br/><?php }?>
											<input type="file" id="left" name="left" />
											<input type="hidden" name="leftcopy" value="<?php echo $thumb['left']?>" />
											（指定左滑动箭头的标识路径 png）HTML5</td>
									 	
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>指定右滑动箭头的标识路径:</td>
											<td colspan='4'>
							
											<?php if($thumb['right']){?><img src="<?php echo $thumb['path'].$thumb['right'];?>" width='60' height='60'/><br/><?php }?>
											<input type="file" id="right" name="right" />
											<input type="hidden" name="rightcopy" value="<?php echo $thumb['right']?>" />
											（指定右滑动箭头的标识路径，png）HTML5</td>
									 	</tr>
									 	
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>全景对应缩略图的激活边框的文件:</td>
											<td colspan='4'>
											<?php if($thumb['border']){?><img src="<?php echo $thumb['path'].$thumb['border'];?>" width='60' height='60'/><br/><?php }?>
											<input type="file" id="border" name="border" />
											<input type="hidden" name="bordercopy" value="<?php echo $thumb['border']?>" />
											
											（当前全景对应缩略图的激活边框的文件路径 png）HTML5</td>
									 	</tr>
									 	
									 	
										<tr>
											<input type="hidden" name="t_t_id" value="<?php echo $thumb['t_t_id']?>" />
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
