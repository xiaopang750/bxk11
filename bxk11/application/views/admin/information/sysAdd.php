
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

							系统资讯&amp; 系统资讯添加  <small>系统资讯&amp;经销产品管理</small>

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

							<li><a href="#">系统资讯添加 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>系统资讯添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/information/doSysAdd');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.sysInforMation();">
								<table class="table table-hover">

									<thead>
										<tr>
											<th colspan='8'>系统资讯添加</th>
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
											<td colspan='4' style='text-align:right;'><span>资讯标题:</span></td>
											<td colspan='4'>
											<input type="text"  name="si_title" class="m-wrap medium" id="si_title" value =""/>
											
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>资讯摘要:</span></td>
											<td colspan='4'>
											<input type="text"  name="si_desc" class="m-wrap medium" id="si_desc" value =""/>
											
											</td>
											
										</tr>



										<tr>
											<td colspan='4' style='text-align:right;'><span>资讯分类:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='it_id' id="it_id">
														
														<?php if(isset($it_list)){foreach ($it_list as $type){?>
															<option  value="<?php echo $type->it_id;?>" ><?php echo $type->it_name;?></option>
														<?php }}?>
												</select>
											</td>
											
										</tr>

										

										<tr>
											<td colspan='4' style='text-align:right;'><span> 上传封面图片:</span></td>
											<td colspan='4'><input type="file"  name="si_pic" id="si_pic" value =""/></td>
											
										</tr>


										
										
										

										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>资讯内容:</span></td>
											<td colspan='4'>
												<script id="si_content" name="si_content" type="text/plain" style="width:800px;height:400px;">
												  
												</script>
												<script type="text/javascript">
													//UEDITOR_CONFIG.maximumWords = 80;
												    var editor = UE.getEditor('si_content')
												</script>

											</td>
										</tr>
										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 关键词列表:</span></td>
											<td colspan='4'><input type="text" class="m-wrap medium"  name="si_keyword" id="si_keyword" value =""/> 多个用，号隔开</td>
											
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
