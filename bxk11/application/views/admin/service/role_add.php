
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

							客户级别&amp; 客户级别添加  <small>客户级别&amp;经销产品管理</small>

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

							<li><a href="#">客户级别添加 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>客户级别添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/service/dorole_add');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">

									<thead>
										<tr>
											<th colspan='8'>客户级别添加</th>
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
											<td colspan='4' style='text-align:right;'><span>服务商类型:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='service_type_id' id="service_type_id">
														
														<?php if(isset($service_type)){foreach ($service_type as $type){?>
															<option  value="<?php echo $type->service_type_id;?>" ><?php echo $type->service_type;?></option>
														<?php }}?>
												</select>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>级别名称:</span></td>
											<td colspan='4'>
											<input type="text"  name="la_name" class="m-wrap medium" id="la_name" value =""/>
											
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>客户级别:</span></td>
											<td colspan='4'>
											<input type="text"  name="la_rank" class="m-wrap medium" id="la_rank" value =""/>
											
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span> 商户级别图标:</span></td>
											<td colspan='4'><input type="text"  name="la_ico" class="m-wrap medium" id="la_ico" value =""/></td>
											
										</tr>


										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>级别所需积分:</span></td>
											<td colspan='4'>
											<input type="text"  name="la_score" class="m-wrap medium" id="la_score" value =""/>
											
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>所需充值金额:</span></td>
											<td colspan='4'>
											<input type="text"  name="la_voucher_price" class="m-wrap medium" id="la_voucher_price" value =""/>
											
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>所需消费金额:</span></td>
											<td colspan='4'>
											<input type="text"  name="la_buy_price" class="m-wrap medium" id="la_buy_price" value =""/>
											
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>级别描述:</span></td>
											<td colspan='4'>
												<script id="la_desc" name="la_desc" type="text/plain" style="width:800px;height:400px;">
												  
												</script>
												<script type="text/javascript">
												    var editor = UE.getEditor('la_desc')
												</script>

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
				
		<script>
function onImageP(){
	var iFile = document.getElementsByName('goods_color[]');//上传文本域名
	var i,
		num;

	num = iFile.length;	

	for(i=0; i<num; i++){

		(function(index){

			iFile[index].onchange = function(e){
				var oFile = e.target.files[0];
				var reader = new FileReader();
				var oImage = $(this).parents('tr').find('img');
				reader.readAsDataURL(oFile);
				reader.onload = function(e) {
					oImage.attr('src',e.target.result);
					oImage.show();
				}

			};


		})(i);
	}
}


	
</script>

		<!-- END PAGE -->
