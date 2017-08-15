
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

							标签分类&amp; 标签分类添加  <small>标签分类&amp; 内容管理</small>

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

							<li><a href="#">标签分类 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>标签分类</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/type/dotype_add');?>" enctype="multipart/form-data" method="POST" 	onsubmit='return jsv.check_type();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>标签分类添加</th>
											

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
											<td colspan='4' style='text-align:right;' width='20%'><span>父标签名:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap small" name='s_class_id'>
													<option value="0">——根标签——</option>
													<?php foreach ($list as $val){?>
													
														<?php if($val->s_class_pid == 0){?>
															<option  value="<?php echo $val->s_class_id;?>">—<?php echo $val->s_class_name;?></option>
																<?php foreach ($list as $vals){?>
																	<?php if($vals->s_class_pid == $val->s_class_id){?>
																		<option  value="<?php echo $vals->s_class_id;?>">——<?php echo $vals->s_class_name;?></option>
																	<?php }?>	
																<?php }?>
														<?php }?>
														
													
													
													<?php }?>
												</select>
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>分类名:</span></td>
											<td colspan='4'><input id='s_class_name_one' type='text' class="m-wrap medium" name='s_class_name'  /></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>频道:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap small" name='s_class_type'>
													<option value="11" >美图</option>
													<option value="12" >产品</option>
													<option value="13" >方案案例 </option>
													<option value="99" >删除</option>
												</select>
											</td>
											
										</tr>
									
										<tr>

											<td colspan='4' style='text-align:right;'><span>分类描述:</span></td>
											<td colspan='4'><input type='text'  class="m-wrap medium" name='s_class_seodesc' /></td>
											
										</tr>
										
																			
										<tr>

											<td colspan='4' style='text-align:right;'><span>分类图片:</span></td>
											<td colspan='4'>
											
											<input type='file'   name='userfile' />
											<input type='hidden'   name='s_class_imgv' value='<?php if(isset($re->s_class_img)) echo $re->s_class_img;?>'/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>分类排序:</span></td>
											<td colspan='4'><input type="text"  name="s_class_sort" class="m-wrap medium" /></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>分类选择方式:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name=s_class_select>
														<option value="radio" >单选</option>
														<option value="checkbox">复选</option>
														<option value="one">复选且必选一项</option>
														<option value="select" >下拉菜单</option>
														<option value="text" >单行输入</option>
														<option value="textarea" >多行输入</option>
														<option value="span" >选择</option>
												</select>
											
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>分类验证正则:</span></td>
											<td colspan='4'><input type='text'  class="m-wrap medium" name='s_class_regex'/></td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>前台是否显示:</span></td>
											<td colspan='4'>
											
												<label class="radio">

												<input type="radio" name="s_class_view" value="1" />

												是

												</label>

												<label class="radio">

												<input type="radio" name="s_class_view" value="0" <?php echo 'checked';?> />

												否

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