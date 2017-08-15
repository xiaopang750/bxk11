
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

							品牌&amp; 品牌添加  <small>产品品牌&amp; 产品管理</small>

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

							<li><a href="#">产品品牌列表 </a></li>

						</ul>


						<?php if(isset($service_id) && $service_id){?>
						<ul class="breadcrumb" >
							<li>
								<a href="#">第一步：添加经销商</a> 
								<i class="icon-angle-right"></i>

							</li>

							<li  style="background-color: red;line-height:20px; text-align:center;">

								<a href="#">第二步：添加品牌</a>

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">第二步：关联品牌</a>

								<i class="icon-angle-right"></i>

							</li>

							<li>
								
								<a href="#">第三步：添加门店</a>
								<i class="icon-angle-right"></i>
							</li>

							<li>
								
								<a href="#">第四步：添加子账号</a>
							</li>

						</ul>
						<?php }?>

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

								<div class="caption"><i class="icon-cogs"></i>产品品牌列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/product/dobrands_add');?>" enctype="multipart/form-data" method="POST" 	onsubmit='return jsv.checkbrands_add();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>品牌添加</th>
											

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
										
										<!-- <tr> 
											<td colspan='4' style='text-align:right;' width='20%'><span>产品一类:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" id='product_add'  onchange="jsv.product_add();">
													<option value="">--请选择--</option>
													<?php //foreach ($product_class as $val){?>
															<option  value="<?php //echo $val['s_class_id'];?>"><?php //echo $val['s_class_name'];?></option>
													<?php // }?>
												</select>
												
												<select class="header-option m-wrap small" id='pattern_add' name='s_class_id' onchange="jsv.pattern_add();">
													<option value="">--请选择--</option>
												</select>
								
											</td>
											
										</tr>
										-->
										<tr>
											<td colspan='4' style='text-align:right;'><span>分类:</span></td>
											<td colspan='4'>
											<?php if($productTwo){ foreach($productTwo as $key=>$value){?>
											<input type="checkbox" value="<?php echo $value['s_class_id'];?>" name="s_class_id[]" 
											<?php if(isset($apply_classid) && $apply_classid && in_array($value['s_class_id'], $apply_classid)) echo "checked";?>
											/><?php echo $value['s_class_name'];?>
											<?php }}?>
											</td>
											
										</tr>
				
				
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌名称:</span></td>
											<td colspan='4'><input id='brand_name' type='text' class="m-wrap medium" name='brand_name'  value="<?php if(isset($apply->apply_brand_name)) echo $apply->apply_brand_name;?>"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌英文:</span></td>
											<td colspan='4'><input id='brand_ename' type='text' class="m-wrap medium" name='brand_ename'  value="<?php if(isset($apply->apply_brand_ename) ) echo $apply->apply_brand_ename;?>"/></td>
											
										</tr>
														
										<tr>
											<td colspan='4' style='text-align:right;'><span>seo描述:</span></td>
											<td colspan='4'>
											<textarea name="brand_seodesc" cols='30' rows='10'> </textarea>
											</td>
											
										</tr>
																	
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>品牌图标:</span></td>
											<td colspan='4'>
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<input type='hidden' value='' name='brand_img'>
												<input type='hidden' value="<?php if(isset($apply->apply_id) ) echo $apply->apply_id;?>" name='apply_id'>
												<input type='hidden' value="<?php if(isset($apply->apply_brand_img) ) echo $apply->apply_brand_img;?>" name='brand_apply_img'>
												<img src="<?php if(isset($apply->apply_brand_img))echo $apply->apply_brand_img?>" width="60px" height="60px" <?php if(!isset($apply->apply_brand_img)) echo "style='display:none;'";?>>
												<?php if(isset($apply->apply_brand_img) && $apply->apply_brand_img){ echo "* 如果你选择上传则将会覆盖用户申请的图标。";}?>
												
											</td>
										</tr>
										
									
										<tr>

											<td colspan='4' style='text-align:right;'><span>seo关键字:</span></td>
											<td colspan='4'><input type='text'  class="m-wrap medium" name='brand_seokey' /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌官网:</span></td>
											<td colspan='4'><input type="text" id="brand_url" name="brand_url" class="m-wrap medium" /></td>
											
										</tr>
	

										<tr>
											
											<td colspan='4' style='text-align:right;'>
											<?php if(isset($service_id) && $service_id){?>
												<input  type="hidden" value="<?php echo $service_id;?>" name="service_id">
												<input class="btn red" type="submit" value="下一步">
												<input class="btn red" type="button" value="跳过" onclick="window.location.href='<?php echo site_url("admin/member/service_brands_apply_system")."?service_id=".$service_id."&tags=1";?>'">
											<?php }else{?>
												<input class="btn red" type="submit" value="提交">
											<?php }?>
											</td>
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
				formData: {"flg":"brand"},
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
						alert("上传品牌LOGON失败,最小尺寸300*100,最在为10M!");
					}
					
				}
			});
		})();
	
		</script>
		<!-- END PAGE -->
