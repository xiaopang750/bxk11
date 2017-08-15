
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

								<div class="caption"><i class="icon-cogs"></i>信息面板</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/three_config/doface_add');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">

									<thead>

										<tr>

		
											<th colspan='8'>logo设置</th>
											

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
									 		<td colspan='4' style='text-align:right;'>界面元素的宽度:</td>
											<td colspan='4'><input type="text" id="width" name="width" value="<?php echo $face['width']?>" checked></td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>界面元素的高度:</td>
											<td colspan='4'><input type="text" id="height" name="height" value='<?php echo $face['height']?>'></td>
									 	</tr>
									 	<tr >
									 	 	<td colspan='4' style='text-align:right;'>X位置:</td>
											<td colspan='4'><input type="text" id="x" name="x" value="<?php echo $face['x']?>"></td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>Y位置: </td>
										<td colspan='4'>
											<input type="text" id="y" name="y" value="<?php echo $face['y']?>"></td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>界面元素url: </td>
										<td colspan='4'>
											<input type="text" id="url" name="url" value="<?php echo $face['url']?>"></td>
									 	</tr>
										
										<tr >
									 	<td colspan='4' style='text-align:right;'>界面元素LOGO: </td>
										<td colspan='4'>
											<?php if($face['file']){?><img src="<?php echo $face['path'].$face['file'];?>" width='60' height='60'/><br/><?php }?>
											<input type="file" class="input_blur" size="50"  id="file" name="file">（（jpg\png\gif\swf）
											<input type='hidden' name="filecopy" value="<?php echo $face['file'];?>">
										</td>
									 	</tr>
										<tr>
											<input type="hidden" name="t_face_id" value="<?php echo $face['t_face_id']?>" />
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
