
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

							资讯分类&amp; 资讯分类编辑  <small>资讯分类&amp;资讯分类管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">资讯分类管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">资讯分类编辑 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>资讯分类编辑</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo U('admin/information/doEdit');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>资讯分类编辑</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>分类名称:</span></td>
											<td colspan='4'>
												<input id='it_name' type='text' class="m-wrap medium" name='it_name' value="<?php if($re->it_name) echo $re->it_name;?>"/>
											</td>
										</tr>

										<tr style="display:none;">
											<td colspan='4' style='text-align:right;' width='20%'><span>服务商id:</span></td>
											<td colspan='4'>
												<input id='service_id' type='hidden' class="m-wrap medium" name='service_id' value="<?php if($re->service_id) echo $re->service_id;?>"/>
											</td>
										</tr>


										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>分类类型:</span></td>
											<td colspan='4'>
												<input type='radio' class="m-wrap medium" name='it_type' id='it_type' value="1" <?php if($re->it_type == 1) echo "checked"; ?> />系统
												<input type='radio' class="m-wrap medium" name='it_type' id='it_type' value="2" <?php if($re->it_type == 2) echo "checked"; ?> disabled/>服务商自定义
	
											</td>
											
										</tr>

										


										<tr>
											<td colspan='4' style='text-align:right;'>
											<input type='hidden' name='it_id' value="<?php if($re->it_id) echo $re->it_id;?>">
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

		
