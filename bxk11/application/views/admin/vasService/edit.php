
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

						</div>
 -->
						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							微信选项&amp; 微信选项编辑  <small>系统设置&amp; 管理中心</small>

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

								<div class="caption"><i class="icon-cogs"></i>微信选项</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/vasService/doedit');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.check_Vas();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>微信选项编辑</th>
											

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
											<td colspan='4' style='text-align:right;' width='20%'><span>服务名称:</span></td>
											<td colspan='4'>
												<input id='vas_name' type='text' class="m-wrap medium" name='vas_name' value="<?php if($vas_name != '') echo $vas_name;?>" />
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>购买价格:</span></td>
											<td colspan='4'><input id='vas_price' type='text' name='vas_price'  class="m-wrap medium"  value="<?php if($vas_price != '') echo $vas_price;?>"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>单位:</span></td>
											<td colspan='4'><input id='vas_unit' type='text' name='vas_unit'  class="m-wrap medium" value="<?php if($vas_unit != '') echo $vas_unit;?>"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>服务状态:</span></td>
											<td colspan='4'>

												<select class="header-option m-wrap small" name='vas_status'>
													
													<option value="1" <?php if($vas_status == 1) echo "selected";?>>正常</option>
													<option value="2" <?php if($vas_status == 2) echo "selected";?>>无效</option>
													<option value="98" <?php if($vas_status == 98) echo "selected";?>>屏蔽 </option>
													<option value="99" <?php if($vas_status == 99) echo "selected";?>>删除</option>
												</select>

											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>服务详情:</span></td>
											<td colspan='4'><textarea id='vas_content' type='text' name='vas_content'><?php if($vas_content != '') echo $vas_content;?></textarea></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>显示排序:</span></td>
											<td colspan='4'><input id='vas_sort' type='text' name='vas_sort'  class="m-wrap medium" value="<?php if($vas_sort != '') echo $vas_sort;?>"/></td>
											
										</tr>

										<tr>
											<input type='hidden' value="<?php if($vas_id != '') echo $vas_id;?>" name='vas_id' id='vas_id'/>
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
