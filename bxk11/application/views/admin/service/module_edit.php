
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

							模块&amp; 模块编辑  <small>模块&amp; 服务商管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">模块管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">模块列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>模块</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/service/domodule_edit');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.modules();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>模块编辑</th>
											

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
											<td colspan='4' style='text-align:right;'  width='20%'><span>模块名:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='module_name' id='module_name' value="<?php if(!$re->module_name || empty($re->module_name)) echo "暂无";else echo  $re->module_name; ?>"/></td>
											
										</tr>
										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>模块状态:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='module_status' id='module_status'>
								
														<option value="1" <?php if($re->module_status == 1) echo "selected";?>>正常显示</option>
														<option value="11" <?php if($re->module_status == 11) echo "selected";?>>开发中</option>
														<option value="12" <?php if($re->module_status == 21) echo "selected";?>>不显示</option>
														<option value="13" <?php if($re->module_status == 12) echo "selected";?>>屏蔽</option>
														<option value="99" <?php if($re->module_status == 99) echo "selected";?>>删除 </option>
													</select>	
												</td>
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>模块key:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='module_key' id='module_key' value="<?php if(!$re->module_key || empty($re->module_key)) echo "暂无";else echo  $re->module_key; ?>"/></td>
										</tr>
										
										<tr >
											<td colspan='4' style='text-align:right;'><span>模块图标:</span></td>
											<td colspan='4'>
												<input type='file' name='module_img'>
												<img src="<?php echo $re->module_img;?>" width="60" height="60">
												<input type='hidden' value="<?php if(!$re->module_img || empty($re->module_img)) echo "暂无";else echo  $re->module_img; ?>" name='module_img_bak'>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>模块排序:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='module_sort' id='module_sort' value="<?php if(!$re->module_sort || empty($re->module_sort)) echo "暂无";else echo  $re->module_sort; ?>"/></td>
											
										</tr>
										
										<tr>
											<input name="module_id" value="<?php echo $re->module_id; ?>" id="module_id" type="hidden"/>
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
