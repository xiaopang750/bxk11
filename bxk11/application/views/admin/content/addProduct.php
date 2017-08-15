
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

							房间清单项&amp; 房间清单项添加  <small>房间清单项&amp; 内容管理</small>

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

							<li><a href="#"> 房间清单项添加</a></li>

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

								<div class="caption"><i class="icon-cogs"></i>房间清单项</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/room/doProductItem');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.checkProductItem();">
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>房间清单项添加</th>
											

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
												
												<select class="header-option m-wrap small" name='s_c_tag_id' id="s_c_tag_id" onchange="jsv.productshow();">
													<option value="0">--请选择--</option>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌系列:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='brand_id' id="brand_id" onchange="jsv.seriesshow();">
														<option value="0">--请选择--</option>
												</select>
									
												<select class="header-option m-wrap small" name='series_id' id="series_id">
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
												关键字:
												<input type="text" name="product_key_word" id="product_key_word">
												编号
												<input type="text" name="code" id="code">
												&nbsp;&nbsp;
												<button class="btn green" type="button" onclick="jsv.searchProduct();">
												
												Search...
												<i class="m-icon-swapright m-icon-white"></i>
												</button>
											</td>
											
										</tr>
									
										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>产品:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap small" name='product_id' id="product_id">
														<option value="0">--请选择--</option>
												</select>
											</td>
										</tr>

										
										<!--  tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>产品链接:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='poduct_url' id='poduct_url'/>
											</td>
												
										</tr>-->
										
										<!--  tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>广告模式:</span></td>
											<td colspan='4'>
													<label class="radio">

												<input type="radio" name="item_type" value="1"  checked/>

												系统匹配

												</label>

												<label class="radio">

												<input type="radio" name="item_type" value="2"/>

												指定投放

												</label>  
											
											</td>
																							
										</tr>-->
										<!--  tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>热点图:</span></td>
											<td colspan='4'>
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<input type='hidden' value='' name='poduct_picurl'>
											</td>
										</tr>-->
				
										<!-- tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>经销商id:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='service_id' id='service_id'/>
											</td>
												
										</tr>
										
										<tr> -->
											<td colspan='4' style='text-align:right;'  width='20%'><span>热点状态 :</span></td>
											<td colspan='4'>
	
												<select class="header-option m-wrap medium" name='hot_status' id='house_status'>
														<option value="1" >正常</option>
														<option value="11" >屏蔽</option>
														<option value="99">屏蔽</optionxz>
												</select>
											
											</td>	
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>热点U坐标:</span></td>
											<td colspan='3'>
													
												<input type='text' class="m-wrap medium" name='hot_x' id='hot_x'/>(正负小数)
											</td>
											
											<td >
													
												<a href="<?php echo site_url('admin/room/addhotspot').'?room_id='.$room_id;?>" target='_bank'>点击获取热点</a>
											</td>
												
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>热点V坐标:</span></td>
											<td colspan='4'>
												<input type='text' class="m-wrap medium" name='hot_y' id='hot_y'/>(正负小数)
											</td>
										</tr>
										
										<!-- tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>匹配角度:</span></td>
											<td colspan='4'>
													
												<input type='text' class="m-wrap medium" name='hot_angle' id='hot_angle'/>
											</td>
										</tr>
										<tr> -->
											<input type="hidden" value="<?php echo $room_id;?>" id="room_id" name="room_id" />
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
		
		
		<script>	/**
		var count = 0;
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
			{	
				var oInput = $('[name = poduct_picurl]');
				var oInputValue = oInput.val();
				if(data != ''){
					if(oInputValue){
						oInput.val(oInputValue+"|"+data);
					}else{
						
						oInput.val(data);
					}
				}
	
			}
		});*/
	
</script>

		<!-- END PAGE -->
