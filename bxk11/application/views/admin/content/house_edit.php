
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

							楼盘编辑&amp;楼盘  <small>楼盘&amp; 内容管理</small>

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

							<li><a href="#">楼盘编辑 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>楼盘</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/house/doedit');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.house();">
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>楼盘添加</th>
											

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
											<td colspan='4' style='text-align:right;'  width='20%'><span>楼盘名:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='house_name' id='house_name' value="<?php if($re->house_name) echo $re->house_name;?>"/></td>
											
										</tr>
										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>楼盘介绍:</span></td>
												<td colspan='4'>
													<input type='text' class="m-wrap medium" name='house_explain' id='house_explain' value="<?php if($re->house_explain) echo $re->house_explain;?>"/ >
												</td>
												
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>省：</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap medium" name='house_province' id='house_province' onclick="return jsv.province();">
														<option value="0" >请选择</option>
														<?php if($house_province){
															foreach ($house_province as $value){
														?>
															<option value="<?php echo $value['district_code'];?>" <?php if($re->house_province == $value['district_code']) echo "selected";?>><?php echo $value['district_name'];?></option>
														<?php 	
															}
														}
														?>
												</select>
												
												
											</td>
	
										</tr>
										
										
											<tr>
											<td colspan='4' style='text-align:right;'><span>市：</span></td>
											<td colspan='4'>
												
					
												<select class="header-option m-wrap medium" name='house_city' id='house_city'>
														<option value="0" >请选择</option>
														<?php if($house_city_source){
															foreach ($house_city_source as $value){
														?>
															<option value="<?php echo $value['district_code'];?>" <?php if($re->house_city == $value['district_code']) echo "selected";?>><?php echo $value['district_name'];?></option>
														<?php 	
															}
														}
														?>
												</select>
											</td>
	
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>详细地址:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='house_address' id='house_address' value="<?php if($re->house_address) echo $re->house_address;?>"/>
											</td>
	
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>开盘日期:</span></td>
											<td colspan='4'>
											<input name='house_opendate' class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php if($re->house_opendate){echo $re->house_opendate;}else{echo date('Y-m-d',time());}?>" size="16" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'">
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>入住日期:</span></td>
											<td colspan='4'>
											<input name='house_checkdate' class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php if($re->house_checkdate){echo $re->house_checkdate;}else{echo date('Y-m-d',time());}?>" size="16" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'">
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>官方链接:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='house_url' id='house_url' value="<?php if($re->house_url) echo $re->house_url;?>"/>
											</td>
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>推荐设计师:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='house_designers' id='house_designers' value="<?php if($re->house_designers) echo $re->house_designers;?>"/>
											</td>
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>推荐方案:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='house_schemes' id='house_schemes' value="<?php if($re->house_schemes) echo $re->house_schemes;?>"/>
											</td>
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否热门:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="house_is_hot" value="1" <?php if($re->house_is_hot == 1) echo "checked";?> />

												是

												</label>

												<label class="radio">

												<input type="radio" name="house_is_hot" value="0"  <?php if($re->house_is_hot == 0 || !$re->house_is_hot) echo "checked";?> />

												否

												</label>  
											
											</td>
																							
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否推荐:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="house_is_recommend" value="1" <?php if($re->house_is_recommend == 1) echo "checked";?> />

												是

												</label>

												<label class="radio">

												<input type="radio" name="house_is_recommend" value="0"  <?php if($re->house_is_recommend == 0 || !$re->house_is_recommend) echo "checked";?>/>

												否

												</label>  
											
											</td>
											
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>状态:</span></td>
											<td colspan='4'>
	
												<select class="header-option m-wrap medium" name='house_status' id='house_status' >
														<option value="1" <?php if($re->house_status == 1) echo "selected";?>>正常</option>
														<option value="2" <?php if($re->house_status == 2) echo "selected";?>>隐藏</option>
														<option value="99" <?php if($re->house_status == 99) echo "selected";?>>删除</option>
												</select>
											
											</td>
										
												
										</tr>
										
										<tr id="zhuti">
											<td colspan='4' style='text-align:right;'><span>标签图片:</span></td>
											<td colspan='4'><input type="file"  name="userfile"></td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>排序:</span></td>
											<td colspan='4'>
													
												<input type='text' class="m-wrap medium" name='house_sort' id='house_sort' value="<?php if($re->house_sort) echo $re->house_sort;?>"/>
											</td>
									
												
										</tr>
										<tr>
											<input type='hidden' name="house_id"  value="<?php echo $re->house_id;?>">
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
