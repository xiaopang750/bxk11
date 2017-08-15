
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

						

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							功能&amp; 功能添加  <small>功能&amp; 服务商管理</small>

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

								<div class="caption"><i class="icon-cogs"></i>功能</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/service/doaction_add');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.action();'>
								<table class="table table-hover">

									<thead>

										<tr>
											<th colspan='8'>功能添加</th>
										</tr>

									</thead>

									<tbody>
										<tr style="display:none;" id='tag_name'>
											<td colspan='8'>
													<div class="alert alert-error">
														<button class="close" data-dismiss="alert"></button>
														<strong>错误!</strong>
														<span id='tag_error'>The daily cronjob has failed.</span>
													</div>
											
											</td>
											
										</tr>

										<tr>
													<td colspan='4' style='text-align:right;'  width='20%'><span>所属模块:</span></td>
													<td colspan='4'>
														<select class="header-option m-wrap medium" name='module_key' id='module_key' onchange="jsv.action_module()">
															
															<?php if(isset($module) && $module){foreach ($module as $key => $value) {?>
																<option value="<?php echo $value->module_key;?>" <?php if(isset($module_keys) && $value->module_key == $module_keys) echo "selected";?>><?php echo $value->module_name;?></option>
															<?php }}?>
														</select>	
													</td>
													
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>父级功能:</span></td>
											<td colspan='4'>

													<select name="action_pkey" id="action_pkey">
														<option value="0">顶级功能</option>
														<?php if($action && isset($action)){foreach ($action as $key => $value) {?>
															<option value="<?php echo $value['action_id'];?>">&nbsp;&nbsp;<?php echo $value['action_name'];?></option>
														<?php }}?>

													</select>	

											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能名:</span></td>
											<td colspan='4'><input name="action_name" id="action_name" type='text' class="m-wrap medium"></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能key:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='action_key' id='action_key'/></td>
										</tr>

										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>功能状态:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='action_status' id='action_status'>
									
														<option value="1" >正常显示</option>
														<option value="11" >开发中</option>
														<option value="12" >不显示</option>
														<option value="13">屏蔽</optionxz>
														<option value="99">删除</optionxz>
													</select>	
												</td>
												
										</tr>
										
										<tr >
											<td colspan='4' style='text-align:right;'><span>功能层级:</span></td>
											<td colspan='4'>
												<select name="action_depth">
													<option value="1">页面</option>
													<option value="2">控件&按钮</option>
													<option value="3">数据字段</option>
												</select>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能描述:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='action_description' id='action_description'/></td>
											
										</tr>
										
										<tr>
											<input type="hidden" name="action_addtime" value="<?php echo date('Y-m-d H:i:s');?>"> 
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
