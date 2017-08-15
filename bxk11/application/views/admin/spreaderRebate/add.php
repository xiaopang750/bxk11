
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

							返利选项&amp; 返利选项添加  <small>系统设置&amp; 管理中心</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">管理中心</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">系统设置 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>返利选项</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo U('admin/spreaderRebate/doadd');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>返利选项添加</th>
											

										</tr>

									</thead>

									<tbody>
										<tr style="display:none;" id='sys_key_id'>
											<td colspan='8'>
													<div class="alert alert-error">
														<button class="close" data-dismiss="alert"></button>
														<strong>错误!</strong>
														<span id='sys_key_error'>The daily cronjob has failed.</span>
													</div>
											
											</td>
										
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>返利类型:</span></td>
											<td colspan='4'>
												<input id='sr_type' type='text' class="m-wrap medium" name='sr_type'  />
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>返利单位:</span></td>
											<td colspan='4'><input id='sr_unit' type='text' name='sr_unit'  class="m-wrap medium"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>开放状态:</span></td>
											<td colspan='4'>
												<input id='sr_status' type='radio' name='sr_status'  class="m-wrap medium" value="1" checked/>开放
												<input id='sr_status' type='radio' name='sr_status'  class="m-wrap medium" value="0"/>关闭
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>返利数量:</span></td>
											<td colspan='4'><input id='sr_amount' type='text' name='sr_amount'  class="m-wrap medium"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>推广类型:</span></td>
											<td colspan='4'>
												<input id='ss_type' type='radio' name='ss_type'  class="m-wrap medium" value="1" checked/>微信
												<input id='ss_type' type='radio' name='ss_type'  class="m-wrap medium" value="2" />商户
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>返利描述:</span></td>
											<td colspan='4'>
												<textarea id='sr_desc' name='sr_desc'  class="m-wrap medium"></textarea>
											</td>
											
										</tr>

										<tr>
											<input type='hidden' value="" name='c_id' id='c_id'/>
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
