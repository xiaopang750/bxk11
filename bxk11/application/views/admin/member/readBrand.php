
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

						</div>

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							品牌预览&amp; 服务商  <small>品牌预览&amp; 产品管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">产品管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">品牌预览 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>品牌预览</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/member/doedit');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.memberSub()">
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>品牌<?php if(isset($result->apply_brand_name) && $result->apply_brand_name) echo $result->apply_brand_name;?>预览</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>品牌中文名:</span></td>
											<td colspan='4'>
												<?php if(isset($result->apply_brand_name) && $result->apply_brand_name) echo $result->apply_brand_name;else "无";?>
											</td>
											
										</tr>	

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>品牌英文名:</span></td>
											<td colspan='4'>
												<?php if(isset($result->apply_brand_ename) && $result->apply_brand_ename) echo $result->apply_brand_ename;else "无";?>
											</td>
											
										</tr>
									
										<tr  >
											<td colspan='4' style='text-align:right;'><span>品牌logo:</span></td>
											<td colspan='4'>
												
												<img src="<?php if($result->apply_brand_img) echo $result->apply_brand_img;?>"  >
											</td>
										</tr>
									
										<tr >
											<td colspan='4' style='text-align:right;'><span>授权文件:</span>
				
											</td>
											<td colspan='4'>
										
												<img src="<?php if($result->apply_license_file) echo $result->apply_license_file;?>" >
												
											</td>
										</tr>
								
										

										
										<tr>
											<td colspan='4' style='text-align:right;'><span>经销商状态:</span></td>
											<td colspan='4'>
											

												<?php 

													if($result->apply_status){
														if($result->apply_status == 1){  
															echo "已认证";
														}elseif ($result->apply_status == 2) {
															echo "未认证";
														}elseif ($result->apply_status == 3) {
															echo "下架";
														}elseif ($result->apply_status == 4) {
															echo "参与企业认证";
														}elseif ($result->apply_status == 11) {
															echo "审核中";
														}elseif ($result->apply_status == 12) {
															echo "认证已到期";
														}elseif ($result->apply_status == 13) {
															echo "认证审核失败";
														}elseif ($result->apply_status == 81) {
															echo "屏蔽";
														}elseif ($result->apply_status == 99) {
															echo "删除";
														}else{
															echo "暂无";
														}
													}else{
														echo "暂无";
													}
												?>	
											
											</td>

											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>授权有效开始时间:</span></td>
									
											<td colspan='4'>

												<?php if(isset($result->apply_license_begin) && $result->apply_license_begin) echo $result->apply_license_begin;else "无";?>	

											</td>
							
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>授权有效结束时间:</span></td>
									
											<td colspan='4'>

												<?php if(isset($result->apply_license_end) && $result->apply_license_end) echo $result->apply_license_end;else "无";?>	

											</td>
							
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
