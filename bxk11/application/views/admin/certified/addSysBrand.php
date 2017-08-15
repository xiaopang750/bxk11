
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

						<!-- <div class="color-panel hidden-phone">

							<div class="color-mode-icons icon-color"></div>

							<div class="color-mode-icons icon-color-close"></div>

							<div class="color-mode">

								<p>THEME COLOR</p>

								<ul class="inline">

									<li class="color-black current color-default" data-style="default"></li>

									<li class="color-blue" data-style="blue"></li>

									<li class="color-brown" data-style="brown"></li>

									<li class="color-purple" data-style="purple"></li>

									<li class="color-grey" data-style="grey"></li>

									<li class="color-white color-light" data-style="light"></li>

								</ul>

								<label>

									<span>Layout</span>

									<select class="layout-option m-wrap small">

										<option value="fluid" selected="">Fluid</option>

										<option value="boxed">Boxed</option>

									</select>

								</label>

								<label>

									<span>Header</span>

									<select class="header-option m-wrap small">

										<option value="fixed" selected="">Fixed</option>

										<option value="default">Default</option>

									</select>

								</label>

								<label>

									<span>Sidebar</span>

									<select class="sidebar-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected="">Default</option>

									</select>

								</label>

								<label>

									<span>Footer</span>

									<select class="footer-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected="">Default</option>

									</select>

								</label>

							</div>

						</div> -->

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							认证品牌&amp; 认证品牌添加  <small>产品认证品牌&amp; 产品管理</small>

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

							<li><a href="#">产品认证品牌 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>产品认证品牌</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/certified/doAddSysBrand');?>" enctype="multipart/form-data" method="POST" >
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
											<td colspan='4' style='text-align:right;'><span> 品牌中文名称:</span></td>
											<td colspan='4'><input type="text"  name="c_brand_name" class="m-wrap medium" id="c_brand_name"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 品牌英文名称:</span></td>
											<td colspan='4'><input type="text"  name="c_brand_ename" class="m-wrap medium" id='c_brand_ename'/></td>
											
										</tr>


										<tr >
											<td colspan='4' style='text-align:right;'><span>品牌logo:</span></td>
											<td colspan='4'>
												<div script-role="upload_btn"></div>
												<div id="upload_list"></div>
												<input type='hidden' value='' name='brand_img'>
											
												
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 品牌官网:</span></td>
											<td colspan='4'><input type="text"  name="c_brand_website" class="m-wrap medium" id="c_brand_website"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 品牌描述:</span></td>
											<td colspan='4'><input type="text"  name="c_brand_desc" class="m-wrap medium" id="c_brand_desc" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 关键词:</span></td>
											<td colspan='4'><input type="text"  name="c_brand_keywords" class="m-wrap medium" id='c_brand_keywords'/>(多个以逗号隔开)</td>
											
										</tr>

										<tr>
											<input name='brand_id' type="hidden" value="<?php echo $brand_id;?>">
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