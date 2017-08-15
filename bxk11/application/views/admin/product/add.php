
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

								<div class="caption"><i class="icon-cogs"></i>产品款式列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/product/doadd');?>" enctype="multipart/form-data" method="POST" 	onsubmit='return jsv.checkproductadd();'>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>产品类:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" id='product_add'  onchange="jsv.product_add();">
													<option value="">--请选择--</option>
													<?php foreach ($product_class as $val){?>
															<option  value="<?php echo $val['s_class_id'];?>"><?php echo $val['s_class_name'];?></option>
													<?php }?>
												</select>
											
								
												<select class="header-option m-wrap small" id='pattern_add'  onchange="jsv.pattern_add();jsv.brandshow();">
													<option value="">--请选择--</option>
												
												</select>
												
												
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>产品标签类:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap small" name='s_c_tag_id' id="s_c_tag_id" onchange="jsv.productshow();">
													<option value="0">--请选择--</option>
												</select>
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>款式名称:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='pattern_id' id="pattern_id">
														<option value="0">--请选择--</option>
												</select>
									
											
											</td>
											
										</tr>
										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌名称:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='brand_id' id="brand_id" onchange="jsv.seriesshow();">
														<option value="0">--请选择--</option>
												</select>
									
											
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>系列名称:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='series_id' id="series_id">
														<option value="0">--请选择--</option>
												</select>
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span> 品牌编号(工厂):</span></td>
											<td colspan='4'><input type="text"  name="product_brand_code" class="m-wrap medium" id="product_brand_code"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 平台编号:</span></td>
											<td colspan='4'><input type="text"  name="product_system_code" class="m-wrap medium" value="<?php echo $randcode;?>" readonly="true"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品名称:</span></td>
											<td colspan='4'><input type="text"  name="product_name" class="m-wrap medium" id="product_name"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 推荐指数:</span></td>
											<td colspan='4'><input type="text"  name="product_hot" class="m-wrap medium" id="product_hot" value="<?php echo $product_hot;?>"/></td>
											
										</tr>
										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 参考价格:</span></td>
											<td colspan='4'><input type="text"  name="product_price" class="m-wrap medium" id="product_price"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 关键词:</span></td>
											<td colspan='4'><input type="text"  name="product_key_word" class="m-wrap medium" />(多个以逗号隔开)</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 单位:</span></td>
											<td colspan='4'><input type="text"  name="product_unit" class="m-wrap medium" id="product_unit"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品长:</span></td>
											<td colspan='4'><input type="text"  name="product_long" class="m-wrap medium" id="product_long"/></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品宽:</span></td>
											<td colspan='4'><input type="text"  name="product_width" class="m-wrap medium" id="product_width"/></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品高:</span></td>
											<td colspan='4'><input type="text"  name="product_high" class="m-wrap medium" id="product_high"/></td>
											
										</tr>
															

										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否热门:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="product_is_hot" value="1" />

												是

												</label>

												<label class="radio">

												<input type="radio" name="product_is_hot" value="0" checked/>

												否

												</label>  
											
											</td>
																							
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>是否首页:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="product_index" value="1" />

												是

												</label>

												<label class="radio">

												<input type="radio" name="product_index" value="0" checked/>

												否

												</label>  
											
											</td>
											
												
										</tr>
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>缩略图:</span></td>
											<td colspan='4'>
												<div script-role="upload_thumb_btn"></div>
												<div id="upload_thumb"></div>
												<input type='hidden' value='' name='product_thumb'>
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>状态:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap medium" name='product_status' id='product_status'>
														<option value="1" >正常</option>
														<option value="12" >申述</option>
														<option value="11" >屏蔽</option>
														<option value="21" >草稿</option>
														<option value="99">屏蔽</option>
												</select>
											
											</td>
										
												
										</tr>
										

										
										
										
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>效果图:</span></td>
											<td colspan='4'>
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<input type='hidden' value='' name='product_result'>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>产品描述:</span></td>
											<td colspan='4'>
												<textarea name="product_description"></textarea>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>主材描述:</span></td>
											<td colspan='4'>
												<textarea name="product_materials"></textarea>
											</td>
										</tr>
				
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>辅材描述:</span></td>
											<td colspan='4'>
												<textarea name="product_auxiliary"></textarea>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>经销商:</span></td>
											<td colspan='4'>
												<select id="pattern_id" class="header-option m-wrap small" name="service_id">
												<?php if($service){
													foreach ($service as $val){
												?>
												<option value="<?php echo $val['service_id'];?>"><?php echo $val['service_name'];?></option>
												<?php } }?>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>经销商自定义标题:</span></td>
											<td colspan='4'>
												<input type='text' value='' name='goods_title' >
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>经销商自定义售价:</span></td>
											<td colspan='4'>
												<input type='text' value='' name='goods_price' >
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>经销商自定义底价:</span></td>
											<td colspan='4'>
												<input type='text' value='' name='goods_upset' >
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>排序:</span></td>
											<td colspan='4'><input type="text"  name="product_sort" class="m-wrap medium" /></td>
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
				
		<script>

		(function(){
			
			upload({
				sId: 'uploadId_thumb',
				sRole: 'upload_thumb_btn',
				width: 106,
				height: 30,
				btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px #f00',
				target: '/index.php/upload/product_index_admin/',
				queueSizeLimit : 1,
				max: 6,
				queueId: 'upload_thumb',
				temp: '',
				formData: {},
				onStart: function()
				{
					
				},
				onSelectErr: function()
				{
				},
				onsuc: function(file, data)
				{	
					if(data)
					{
						var oInput = $('[name = product_thumb]');
						oInput.val(data);	
					}else{
						alert("上传缩略图失败,最小尺寸100*100！");
					}								
		
				}
			});
		})();


		(function(){
			
				upload({
					sId: 'uploadId',
					sRole: 'upload_btn',
					width: 106,
					height: 30,
					btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px #f00',
					target: '/index.php/upload/product_admin/',
					queueSizeLimit : 1,
					max: 6,
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
							var oInput = $('[name = product_result]');
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
