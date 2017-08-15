
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

						<!-- <div class="color-panel hidden-phone">

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

						</div> -->

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							wap站菜单&amp; wap站菜单编辑  <small>wap站菜单&amp;wap站菜单管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">wap站菜单管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">wap站菜单编辑 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>wap站菜单编辑</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo U('admin/wapTpl/doWapMenuEdit');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>wap站菜单编辑</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>选项名称:</span></td>
											<td colspan='4'>
												<input id='menu_name' type='text' class="m-wrap medium" name='menu_name' value="<?php if($re->menu_name) echo $re->menu_name;?>"/>
											</td>
										</tr>

										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>服务商类型列表:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='service_type_id' id='service_type_id'>
														<?php if($service_type){foreach($service_type as $va){?>
															<option value="<?php echo $va->service_type_id;?>" <?php if($re->service_type_id && $va->service_type_id == $re->service_type_id) echo "selected";?>><?php echo $va->service_type;?></option>
														<?php } }?>
									
													</select>	
												</td>
												
										</tr>


										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>选项功能url:</span></td>
											<td colspan='4'>
												<input id='menu_url' type='text' class="m-wrap medium" name='menu_url' value="<?php if($re->menu_url) echo $re->menu_url;?>"/>
											</td>
										</tr>

										


										<tr>
											<td colspan='4' style='text-align:right;'>
											<input type='hidden' name='menu_id' value="<?php if($re->menu_id) echo $re->menu_id;?>">
											<input class="btn red" type="submit" value="提交">
											
											</td>
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

		
