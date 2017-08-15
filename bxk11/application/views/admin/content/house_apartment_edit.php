
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

							户型编辑&amp; 户型  <small>户型&amp; 内容管理</small>

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

							<li><a href="#">户型编辑 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>户型</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/house/dohouse_apartment_edit');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.apartment();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>户型添加</th>
											

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
											<td colspan='4' style='text-align:right;'  width='20%'><span>户型名:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name="apartment_name" id="apartment_name" value="<?php if($re->apartment_name) echo $re->apartment_name;?>"/></td>
											
										</tr>
										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>户型类别:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='apartment_category_id' id='apartment_category_id'>
														<option value="0" >请选择</option>
														<?php if($list){foreach($list as $value){?>
														<option value="<?php echo $value['tag_id'];?>" <?php if($re->apartment_category_id == $value['tag_id']) echo 'selected';?>><?php echo $value['tag_name'];?></option>
														<?php }}?>
													</select>
												</td>
												
										</tr>
										
										<tr>

											<td colspan='4' style='text-align:right;'><span>户型副标题:</span></td>
											<td colspan='4'>
											<input name='apartment_title' class="m-wrap medium" type="text"  value="<?php if($re->apartment_title) echo $re->apartment_title;?>" >
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>户型状态:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap medium" name='apartment_status' id='apartment_status'>
														<option value="1" <?php if($re->apartment_status == 1) echo 'selected';?>>正常</option>
														<option value="2" <?php if($re->apartment_status == 2) echo 'selected';?>>待审核</option>
														<option value="3" <?php if($re->apartment_status == 3) echo 'selected';?>>屏蔽</option>
														<option value="99" <?php if($re->apartment_status == 99) echo 'selected';?> >屏蔽</option>
												</select>
											
											</td>
											
												
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>类别 :</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="apartment_type" value="1" <?php if($re->apartment_type == 1) echo 'checked';?> />

												系统

												</label>

												<label class="radio">

												<input type="radio" name="apartment_type" value="2" <?php if($re->apartment_type == 2 || $re->apartment_type == '') echo 'checked';?>/>

												用户自定义

												</label>  
											
											</td>
												
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>面积:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='apartment_size' id='apartment_size'  value="<?php if($re->apartment_size) echo $re->apartment_size;?>"/>平方米
											</td>
												
										</tr>
										
										
										
									
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否热门:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="apartment_is_hot" value="1" <?php if($re->apartment_is_hot == 1) echo 'checked';?> />

												是

												</label>

												<label class="radio">

												<input type="radio" name="apartment_is_hot" value="0" <?php if($re->apartment_is_hot == 0 || $re->apartment_is_hot == '') echo 'checked';?>/>

												否

												</label>  
											
											</td>
											</td>
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否推荐:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="apartment_is_recommend" value="1" <?php if($re->apartment_is_recommend == 1) echo 'checked';?>/>

												是

												</label>

												<label class="radio">

												<input type="radio" name="apartment_is_recommend" value="0" <?php if($re->apartment_is_recommend == 0 || $re->apartment_is_recommend == '') echo 'checked';?>/>

												否

												</label>  
											
											</td>
										
												
										</tr>
										
										
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>一层户型图:</span></td>
											<td colspan='4'>
												<img width="60" height="60" src="<?php echo apartmenturl($re->apartment_id,$re->apartment_floor_pic1);?>">
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<input type='hidden' value='' name='apartment_floor_pic1'>
												<input type='hidden' value='<?php echo $re->apartment_floor_pic1?>' name='apartment_floor_pic1copy'>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>排序:</span></td>
											<td colspan='4'>
													
												<input type='text' class="m-wrap medium" name='apartment_sort' id='apartment_sort'  value="<?php if($re->apartment_sort) echo $re->apartment_sort;?>"/>
											</td>
										</tr>
										<tr>
										<input type='hidden' value="<?php echo $re->apartment_id;?>" name='apartment_id'>
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
		
		<script>
		var count = 0;
		upload({
			sId: 'uploadId',
			sRole: 'upload_btn',
			width: 106,
			height: 30,
			btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px #f00',
			target: '/index.php/upload/apartment',
			queueSizeLimit : 1,
			max: 1,
			queueId: 'upload_list',
			temp: '<li style="width:100px;height:50px;list-style:none;margin-bottom:10px" script-role="pic_list"><img src="" height="100" width="100"></li>',
			formData: {},
			onStart: function()
			{
				
			},
			onSelectErr: function()
			{
			},
			onsuc: function(file, data)
			{	
				var realData = eval('('+ data +')');

				var aList = $('[script-role = pic_list]');
				var oInput = $('[name = apartment_floor_pic1]');
				if(!realData.err)
				{	
					aList.eq(count).find('img').attr('src', realData.data);
					oInput.val(realData.data);						
				}
				else
				{	
					aList.eq(count).remove();

					count --;
				}

				count ++ ;
	
			}
		});
	
</script>
		

		<!-- END PAGE -->
