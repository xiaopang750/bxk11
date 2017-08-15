
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

							产品分类&amp; 产品分类添加  <small>系统设置&amp; 管理中心</small>

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

								<div class="caption"><i class="icon-cogs"></i>产品分类</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/productClass/doadd');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.check_product();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>产品分类添加</th>
											

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
											<td colspan='4' style='text-align:right;' width='20%'><span>上级分类:</span></td>
											<td colspan='4'>
												<input  type='text' class="m-wrap medium"  value="<?php if($pc_pname) echo $pc_pname;?>" disabled="disabled"/>
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>*分类名称（名称不能为空）:</span></td>
											<td colspan='4'><input id='pc_name' type='text' name='pc_name'  class="m-wrap medium"  value=""/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>房间功能:</span></td>
											<td colspan='4'>

												<select class="header-option m-wrap small" name='pc_function'>
													
													<?php if($pc_functionR){foreach ($pc_functionR as $key => $value) {?>
									
													<option value="<?php echo $value['title']?>"><?php echo $value['title']?></option>
													<?php }}?>
												</select>

											</td>
											
										</tr>


										<tr>
											<input type='hidden' value="<?php if($pc_pid != '') echo $pc_pid;?>" name='pc_pid' id='pc_pid'/>
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
