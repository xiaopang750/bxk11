
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

							第三方同步管理&amp; 第三方同步管理 <small>第三方同步管理&amp; 系统管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">系统管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">第三方同步管理 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>第三方同步管理</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/sys_recommend/dosyncSet');?>" method="POST">
								<table class="table table-hover">

									<thead>
										<tr>
											<th colspan='8'>第三方同步管理</th>
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
											<td colspan='4' style='text-align:right;'><span>开启同步登录功能:</span></td>
											<td colspan='4'>

							                      <input type="checkbox" name="open[]" value="1" <?php if($re['sina']['open'] == '1') echo 'checked';?>/>新浪微博
							                      <input type="checkbox" name="open[]" value="1" <?php if($re['qq']['open'] == '1') echo 'checked';?>/>腾讯微博
							                      <input type="checkbox" name="open[]" value="1" <?php if($re['renren']['open'] == '1') echo 'checked';?>/>人人网
											                
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>新浪微博KEY:</span></td>
											<td colspan='4'> <input name="sina_wb_akey" type="text" maxlenth="100" style="width:300px" value="<?php if($re['sina']['key']) echo $re['sina']['key'];?>"/></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>新浪微博密匙:</span></td>
											<td colspan='4'>
												<input name="sina_wb_skey" type="text"  maxlenth="100" style="width:300px" value="<?php if($re['sina']['secret']) echo $re['sina']['secret'];?>" />
            									<p>申请地址：<a href="http://open.weibo.com/" target="_blank">http://open.weibo.com/</a></p>
											</td>
											
										</tr>
									
										<tr>

											<td colspan='4' style='text-align:right;'><span>QQ互联KEY：</span></td>
											<td colspan='4'> <input name="qzone_key" type="text"  maxlenth="100" style="width:300px" value="<?php if($re['qq']['key']) echo $re['qq']['key'];?>"/></td>
											
										</tr>
										
																			
										<tr>

											<td colspan='4' style='text-align:right;'><span>QQ互联密匙:</span></td>
											<td colspan='4'>
											
											 <input name="qzone_secret" type="text" maxlenth="100" style="width:300px" value="<?php if($re['qq']['secret']) echo $re['qq']['secret'];?>"/>
           									 <p>申请地址：<a href="http://connect.qq.com" target="_blank">http://connect.qq.com</a></p>
											</td>
											
										</tr>
										
										
									   <tr>
											<td colspan='4' style='text-align:right;'><span>人人网KEY：</span></td>
											<td colspan='4'> <input name="renren_key" type="text" maxlenth="100" style="width:300px" value="<?php if($re['renren']['key']) echo $re['renren']['key'];?>"/></td>
										</tr>
										
																			
										<tr>

											<td colspan='4' style='text-align:right;'><span>人人网密匙:</span></td>
											<td colspan='4'>
											
											<input name="renren_secret" type="text" maxlenth="100" style="width:300px" value="<?php if($re['renren']['secret']) echo $re['renren']['secret'];?>"/>
            								<p>申请地址：<a href="http://dev.renren.com" target="_blank">http://dev.renren.com</a></p>
											</td>
											
										</tr>
										

										<tr>
											<input type="hidden"  name='sys_key' value="<?php if($sync_key) echo $sync_key;?>"/>
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
