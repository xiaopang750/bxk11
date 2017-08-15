
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

							产品品牌系列&amp; 产品品牌系列添加  <small>产品品牌系列&amp; 产品管理</small>

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

							<li><a href="#">产品品牌系列添加 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>产品品牌系列添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/product/dobrands_series_add');?>" enctype="multipart/form-data" method="POST" 	onsubmit='return jsv.checkbrands_series_add();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>产品品牌系列添加</th>
											

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
											<td colspan='4' style='text-align:right;' width='20%'><span>品牌:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap small" name='s_c_tag_id' id="s_c_tag_id" onchange="jsv.changeSeriesC()">
						
													<option value="0">--请选择--</option>
													<?php if($brands){ foreach($brands as $key=>$value){?>
														<option value="<?php echo $value->brand_id;?>" <?php if(isset($brand_id) && ($value->brand_id == $brand_id)) echo "selected";?>><?php echo $value->brand_name;?></option>
													<?php }}?>
												</select>
											</td>
											
										</tr>
										<tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%' ><span>所属分类:</span></td>
											<td colspan='4' id='brand_class'>
												<?php if(isset($brands_class) && $brands_class){ foreach($brands_class as $key=>$value){?>
													<input type="checkbox" value="<?php echo $value['s_class_id'];?>" name="s_class_id[]"/><?php echo $value['s_class_name'];?>
												<?php }}?>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>系列名称:</span></td>
											<td colspan='4'><input id='series_name' type='text' class="m-wrap medium" name='series_name'  /></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>系列英文:</span></td>
											<td colspan='4'><input id='series_ename' type='text' class="m-wrap medium" name='series_ename' /></td>
											
										</tr>
																	
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span> 系列图标:</span></td>
											<td colspan='4'>
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<input type='hidden' value='' name='brand_img'>
											</td>
										</tr>
										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>系列状态:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='series_status' id='series_status'>
									
														<option value="1" >全站所有</option>
														<option value="2" >经销商私有</option>
														<option value="11" >审核中</option>
														<option value="81">屏蔽</optionxz>
														<option value="99">删除</optionxz>
													</select>	
												</td>
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>系列描述:</span></td>
											<td colspan='4'>
												<textarea name="series_seodesc" cols="30" rows="10"></textarea>
											</td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>系列seo关键字:</span></td>
											<td colspan='4'><input type='text'  class="m-wrap medium" name='series_seokey' /></td>
											
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
		
	<script type="text/javascript">
		(function(){
			
			upload({
				sId: 'uploadId',
				sRole: 'upload_btn',
				width: 106,
				height: 30,
				btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px #f00',
				target: '/index.php/upload/product_brand_admin/',
				queueSizeLimit : 1,
				max: 1,
				queueId: 'upload_list',
				temp: '',
				formData: {"flg":"series"},
				onStart: function()
				{
			
				},
				onSelectErr: function()
				{
				},
				onsuc: function(file, data)
				{	if(data){
						var oInput = $('[name = brand_img]');
						var oInputValue = oInput.val();
						if(data != ''){
							if(oInputValue){
								oInput.val(oInputValue+"|"+data);
							}else{
								
								oInput.val(data);
							}
						}
					}else{
						alert("上传效果图片失败,最小尺寸100*100！");
					}
					
				}
			});
		})();
	
		</script>

		<!-- END PAGE -->
