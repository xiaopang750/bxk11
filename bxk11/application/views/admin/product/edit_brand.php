
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

							品牌&amp; 品牌编辑  <small>产品品牌&amp; 产品管理</small>

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

							<li><a href="#">产品品牌编辑 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>产品品牌编辑</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/product/doedit_brand');?>" enctype="multipart/form-data" method="POST" 	onsubmit='return jsv.checkbrands_add();'>
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>品牌编辑</th>
											

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
										<!-- 
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>产品一类:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" id='product_add'  onchange="jsv.product_add();">
													<option value="">--请选择--</option>
													<?php foreach ($product_class as $val){?>
															<option  value="<?php echo $val['s_class_id'];?>"><?php echo $val['s_class_name'];?></option>
													<?php }?>
												</select>
												
												<select class="header-option m-wrap small" id='pattern_add' name='s_class_id' onchange="jsv.pattern_add();">
													<option value="">--请选择--</option>
												</select>
								
											</td>
											
										</tr>
										 -->
										
				
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌名称:</span></td>
											<td colspan='4'><input id='brand_name' type='text' class="m-wrap medium" name='brand_name'  value="<?php if($re->brand_name) echo $re->brand_name;?>" /></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌英文:</span></td>
											<td colspan='4'><input id='brand_ename' type='text' class="m-wrap medium" name='brand_ename'  value="<?php if($re->brand_ename) echo $re->brand_ename;?>" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>分类:</span></td>
											<td colspan='4'>
											<?php if($productTwo){ foreach($productTwo as $key=>$value){?>
											<input type="checkbox" value="<?php echo $value['s_class_id'];?>" name="s_class_id[]" <?php if(in_array($value['s_class_id'],$cateGoryId)) echo "checked"; ?>/><?php echo $value['s_class_name'];?>
											<?php }}?>
											</td>
											
										</tr>
				
														
										<tr>
											<td colspan='4' style='text-align:right;'><span>seo描述:</span></td>
											<td colspan='4'>
											<textarea name="brand_seodesc" cols='30' rows='10'><?php if($re->brand_seodesc) echo $re->brand_seodesc;?> </textarea>
											</td>
											
										</tr>
																	
										<tr id="zhuti" >
											<td colspan='4' style='text-align:right;'><span>品牌图标:</span></td>
											<td colspan='4'>
											
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<img src="<?php echo $thumb_3.'/'.$re->brand_img;?>" width="60" height='60'/>
												<input type='hidden' value='' name='brand_img'>
												
											</td>
										</tr>
									
										<tr>

											<td colspan='4' style='text-align:right;'><span>seo关键字:</span></td>
											<td colspan='4'><input type='text'  class="m-wrap medium" name='brand_seokey' value="<?php if($re->brand_seokey) echo $re->brand_seokey;?>"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌官网:</span></td>
											<td colspan='4'><input type="text" id="brand_url" name="brand_url" class="m-wrap medium" value="<?php if($re->brand_url) echo $re->brand_url;?>" /></td>
											
										</tr>
	

										<tr>
											<input type="hidden" value="<?php echo $re->brand_id;?>" name='brand_id'>
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
				formData: {"flg":"brand"},
				onStart: function()
				{
					
				},
				onSelectErr: function()
				{
				},
				onsuc: function(file, data)
				{	if(data){

						if(data != ''){
							var oInput = $('[name = brand_img]');
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
