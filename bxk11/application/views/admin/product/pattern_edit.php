
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

							款式&amp; 款式添加  <small>产品款式&amp; 产品管理</small>

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

							<li><a href="#">产品款式列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>产品款式编辑</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/product/dopattern_edit');?>" enctype="multipart/form-data" method="POST" 	onsubmit='return jsv.checkpattern_add();'>
								<table class="table table-hover">

									<thead>

										<tr>
											<th colspan='8'>产品款式编辑</th>
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
											<td colspan='4' style='text-align:right;'><span>款式名称:</span></td>
											<td colspan='4'><input id='pattern_type' type='text' class="m-wrap medium" name='pattern_type' value="<?php if($re->pattern_type)echo $re->pattern_type;?>" /></td>
											
										</tr>
																	
										
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>款式图片:</span></td>
											<td colspan='4'>
											
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<img src="<?php echo $thumb_3.$re->pattern_img;?>" width="60" height='60'/>
												<input type='hidden' value='' name='pattern_img'>
												
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>排序:</span></td>
											<td colspan='4'><input type="text"  name="pattern_sort" class="m-wrap medium" value="<?php if($re->pattern_sort)echo $re->pattern_sort;?>"/></td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>款式描述:</span></td>
											<td colspan='4'><input type='text'  class="m-wrap medium" name='pattern_seodesc' value="<?php if($re->pattern_seodesc)echo $re->pattern_seodesc;?>" /></td>
											
										</tr>

										<tr>
											<input type='hidden'   name='pattern_id' value="<?php echo $re->pattern_id;?>"/>
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
		
		<script type="text/javascript">
		(function(){
			
			upload({
				sId: 'uploadId',
				sRole: 'upload_btn',
				width: 106,
				height: 30,
				btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px #f00',
				target: '/index.php/upload/product_admin/',
				queueSizeLimit : 1,
				max: 1,
				queueId: 'upload_list',
				temp: '',
				formData: {},
				onStart: function()
				{
					
				},
				onSelectErr: function()
				{
				},
				onsuc: function(file, data)
				{	if(data){
						if(data != ''){
							var oInput = $('[name = pattern_img]');
							oInput.val(data);
						}
					}else{
						alert("上传效果图片失败,最小尺寸100*100！");
					}
					
				}
			});
		})();
	
		</script>

		<!-- END PAGE -->
