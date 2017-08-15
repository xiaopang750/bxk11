
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

							功能&amp; 功能添加  <small>功能&amp; 功能管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">功能管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">功能列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>功能列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/system/doadd_one');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.checksystemadd();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>功能添加</th>
											

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
											<td colspan='4' style='text-align:right;' width='20%'><span>功能组:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" id='group_id' name='group_id' onchange="jsv.system_action_group_add();">
													<option value="">--请选择--</option>
													<?php foreach ($system_action_group as $val){?>
															<option  value="<?php echo $val->group_id;?>" <?php if(($system_action->group_id) == ($val->group_id)) echo "selected";?>> <?php echo $val->group_name;?></option>
													<?php }?>
													<option value="creat_group">--创建功能组--</option>
												</select>
											
												<span id="group_name" style="display:none"><input  type='text'  name='group_name' id='group_name' ></span>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>功能名称:</span></td>
											<td colspan='4'>
						
												<input type="text"  name="action_name" class="m-wrap medium" id="action_name"/>
											
											</td>
											
										</tr>
										
					
										<tr>
											<td colspan='4' style='text-align:right;'><span> 功能key:</span></td>
											<td colspan='4'><input type="text"  name="action_key" class="m-wrap medium" id="action_key"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 功能描述:</span></td>
											<td colspan='4'><input type="text"  name="action_description" class="m-wrap medium" id="action_description"/></td>
											
										</tr>
										
									

										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能状态:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="action_status" value="1" checked/>

												生效

												</label>

												<label class="radio">

												<input type="radio" name="action_status" value="0" />

												不生效

												</label>  
											
											</td>
																							
										</tr>
										
									

										<tr>
											<input name='action_pkey' type="hidden" value="<?php echo $action_id;?>">
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
