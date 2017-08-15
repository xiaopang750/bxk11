
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

						
							推荐&amp; 推荐项编辑  <small>系统设置&amp; 管理中心</small>

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

							<li><a href="#">系统设置  </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>编辑项</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/sys_recommend/dosys_recommend');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>系统编辑</th>
											

										</tr>

									</thead>

									<tbody>

									
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>设置项:</span></td>
											<td colspan='4'>
											<input type='text' class="m-wrap medium" name='v' id='sys_keys' disabled  value='<?php echo $re->sys_key;?>'/>
											<input type='hidden' name='sys_key' value='<?php echo $re->sys_key;?>'/>
											</td>
											
										</tr>

										<tr>
												<td colspan='4' style='text-align:right;'><span>设置项中文说明:</span></td>
												<td colspan='4'>
													<input type='text' class="m-wrap medium" name='sys_key_cn' id='sys_key_cn'   value='<?php echo $re->sys_key_cn;?>'/>	
												</td>
												
										</tr>
										<?php if($re->sys_key == 'baidu_key')?>
										<tr>
												<td colspan='4' style='text-align:right;'><span>设置值:</span></td>
												<td colspan='4'>
													<input type='text' class="m-wrap medium" name='sys_value' id='sys_value'   value='<?php echo $re->sys_value;?>'/>	
												</td>
												
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>是否主题:</span></td>
											<td colspan='4'>
											
												<label class="radio">

												<input type="radio" name="sys_group" value="0" <?php if($re->sys_group == 0 || !$re->sys_group) echo 'checked';?>/>
												第一组
												</label>

												<label class="radio">

												<input type="radio" name="sys_group" value="1" <?php if($re->sys_group == 1 ) echo 'checked';?> />
												第二组
												</label>  
											
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
