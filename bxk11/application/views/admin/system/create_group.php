
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

							管理组&amp; 管理组添加  <small>管理组&amp; 管理组管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">管理组管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">管理组列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>管理组列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/system/docreateGroup');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>管理组添加</th>
											

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
											<td colspan='4' style='text-align:right;'><span>管理组名称:</span></td>
											<td colspan='4'>
						
												<input type="text"  name="agroup_name" class="m-wrap medium" id="agroup_name"/>
											
											</td>
											
										</tr>
										
					
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>管理组描述:</span></td>
											<td colspan='4'><input type="text"  name="agroup_description" class="m-wrap medium" id="agroup_description"/></td>
											
										</tr>
										
									

										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>管理员状态:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap small" id='admin_status' name='admin_status'>
													<option value="">--请选择--</option>
													<option  value="0">停用</option>
													<option  value="1" selected>正常</option>
													<option  value="99">删除</option>
												</select>
							
											</td>										
										</tr>
										
										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>选择生效角色:</span></td>
												<td colspan='4'>
												<?php if(isset($system_role) && $system_role){foreach($system_role as $val){?>
												<span>
													<input type="checkbox" name="role_id[]" value="<?php if($val->role_id) echo $val->role_id;?>"/>
	
													<?php if($val->role_name) echo $val->role_name;?>
	
													
												</span>	
												
												<br/>
												<?php }}?>		
													<span> <input class="btn green" type="button" value="新增角色" onclick="jsv.go('<?php echo site_url('admin/system/create_role');?>')"></span>
												</td>								
											</tr>
										
										<tr>
											
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
