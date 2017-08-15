
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
<!-- 
						<div class="color-panel hidden-phone">

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

							WAP模版&amp; WAP模版添加  <small>WAP模版&amp;WAP模版管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">WAP模版管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">WAP模版添加 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>WAP模版添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo U('admin/wapTpl/doadd');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>WAP模版添加</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>模版名称:</span></td>
											<td colspan='4'>
												<input id='template_name' type='text' class="m-wrap medium" name='template_name'/>
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>模版目录:</span></td>
											<td colspan='4'>
												<input id='template_code' type='text' class="m-wrap medium" name='template_code'/>
											</td>
										</tr>

										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>服务商类型列表:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='service_type_id' id='service_type_id'>
														<?php if($service_type){foreach($service_type as $va){?>
															<option value="<?php echo $va->service_type_id;?>" ><?php echo $va->service_type;?></option>
														<?php } }?>
									
													</select>	
												</td>
												
										</tr>

										<tr style="display:none;">
											<td colspan='4' style='text-align:right;' width='20%'><span>服务商id:</span></td>
											<td colspan='4'>
												<input id='service_id' type='hidden' class="m-wrap medium" name='service_id' value='0'/>
											</td>
										</tr>


										<tr >
											<td colspan='4' style='text-align:right;'><span>模版状态:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap medium" name='template_status' id='template_status'>
														<option value="1" >正常开放</option>
														<option value="2" >未开放</option>
														<option value="81" >屏蔽</option>
														<option value="99" >删除</option>
												</select>
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否默认:</span></td>
											<td colspan='4'>
												<input type='radio' class="m-wrap medium" name='template_is_default' id='template_is_default' value="0" checked='true'/>否
												<input type='radio' class="m-wrap medium" name='template_is_default' id='template_is_default' value="1" />是
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>模版类型:</span></td>
											<td colspan='4'>
												<input type='radio' class="m-wrap medium" name='template_type' id='template_type' value="1" checked='true'/>系统模版
												
											</td>
											
										</tr>
																	
									
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>主菜单个数:</span></td>
											<td colspan='4'><input type="text" id='main_menu_count' name="main_menu_count" class="m-wrap medium" value="4" readonly="true" ></td>
											
										</tr>
									
											<tr>
											<!-- <td colspan='4' style='text-align:right;'><span>快捷方式个数:</span></td> -->
											<td colspan='4'><input type="hidden" id='shortcut_menu_count' name="shortcut_menu_count" value="" class="m-wrap medium" /></td>
											
										</tr> 
								
										<tr >


										<tr>
											<td colspan='4' style='text-align:right;'>
											
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

		<!-- END PAGE -->

		

