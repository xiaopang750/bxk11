
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

							标签&amp; 标签添加  <small>标签&amp; 内容管理</small>

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

							<li><a href="#">导入 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>分类标签导入</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/system_disable/doimport');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.check();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>分类标签导入</th>
											

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
											<td colspan='4' style='text-align:right;' width='20%'><span>内容类型:</span></td>
											<td colspan='4'>
												<select id='sdisable_type' class="header-option m-wrap small" name='sdisable_type'>
													<?php if($type_config){
														foreach($type_config as $key=>$value){
													?>						
													<option value="<?php echo $value['type'];?>" ><?php echo $value['type_content'];?></option>
													<?php }}?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>上传:</span></td>
											<td colspan='4'><input type="file"  name="userfile"></td>
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
