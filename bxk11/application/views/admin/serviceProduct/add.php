
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

							经销商品&amp; 经销商品添加  <small>经销商品&amp;经销产品管理</small>

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

							<li><a href="#">经销商品添加 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>经销商品添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/serviceProduct/doadd');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.serviceProductSub();'>
								<table class="table table-hover">

									<thead>
										<tr>
											<th colspan='8'>经销商品添加</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>地区 :</span></td>
											<td colspan='4'>
													
												<select class="header-option m-wrap small" id="province" onchange="jsv.provincec()" name="province">
													<option value="">-省份-</option>
													<?php if($provincere){foreach ($provincere as $val){?>
													<option value="<?php echo $val['district_code']?>" <?php if(isset($pxid) && ($pxid == $val['district_code']) && ($pxid!='')) echo "selected";?>><?php echo $val['district_name']?></option>
													<?php }}?>
												</select>
												<select  id="city" onchange="jsv.cityr();jsv.serviceInfo()" name="city">
													<option value="">-城市-</option>
													<?php if($cityre){foreach ($cityre as $val){?>
													<option value="<?php echo $val['district_code']?>" <?php if(($cid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
													<?php }}?>
												</select>
												<!-- 
												<select id="district" name="district">
													<option value="">-州县-</option>
													<?php if($disre){foreach ($disre as $val){?>
													<option value="<?php echo $val['district_code']?>" <?php if(($did == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
													<?php }}?>
												</select> -->
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>经销商:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" id='service_id'  onchange="jsv.BrandInfo()" name="service_id">
													<option value="">--请选择--</option>
													<?php if(isset($product_class)){foreach ($product_class as $val){?>
															<option  value="<?php echo $val['service_id'];?>" <?php if(isset($goods['service_id']) && $val['service_id'] == $goods['service_id']) echo "selected";?>><?php echo $val['service_company'];?></option>
													<?php }}?>
												</select>
												
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>品牌名称:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='brand_id' id="brand_id" onchange="jsv.seriesshow();">
														<option value="0">--请选择--</option>
														<?php if(isset($brandR)){foreach ($brandR as $valsz){?>
															<option  value="<?php echo $valsz['brand_id'];?>" ><?php echo $valsz['apply_brand_name'];?></option>
														<?php }}?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>系列名称:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='series_id' id="series_id" onchange="jsv.category();">
														<option value="0">--请选择--</option>
														<?php if(isset($seriesR)){foreach ($seriesR as $ser){?>
															<option  value="<?php echo $ser['series_id'];?>" ><?php echo $ser['series_name'];?></option>
														<?php }}?>
												</select>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>品类:</span></td>
											<td colspan='4'>
											
												<select class="header-option m-wrap small" name='s_class_id' id="s_class_id">
														<option value="0">--请选择--</option>
														<?php if(isset($class_system)){foreach ($class_system as $cs){?>
															<option  value="<?php echo $cs['s_class_id'];?>" <?php if(isset($goods->s_class_id) && $goods->s_class_id && ($cs['s_class_id'] == $goods->s_class_id)) echo "selected";?>>
																<?php if($cs['s_class_id']) echo get_tag_name('t_system_class_model',$cs['s_class_id'],'s_class_name');else echo "暂无";?>
																
															</option>
														<?php }}?>
												</select>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>产品标题:</span></td>
											<td colspan='4'><input type="text"  name="goods_title" class="m-wrap medium" id="goods_title"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品关键词:</span></td>
											<td colspan='4'><input type="text"  name="good_key_word" class="m-wrap medium" id="good_key_word"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>  产品售价:</span></td>
											<td colspan='4'><input type="text"  name="goods_price" class="m-wrap medium" id="goods_price"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>  产品底价:</span></td>
											<td colspan='4'><input type="text"  name="goods_upset" class="m-wrap medium" id="goods_upset"/></td>
											
										</tr>
										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>  产品货号:</span></td>
											<td colspan='4'><input type="text"  name="goods_code" class="m-wrap medium" id="goods_code"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 库存数量:</span></td>
											<td colspan='4'><input type="text"  id="goods_stock" name="goods_stock" class="m-wrap medium" /></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品排序:</span></td>
											<td colspan='4'><input type="text"  name="goods_sort" class="m-wrap medium" id="goods_sort"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 单位:</span></td>
											<td colspan='4'><input type="text"  name="good_unit" class="m-wrap medium" id="good_unit"/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span> 产品规格:</span></td>
											<td colspan='4'><input type="text"  name="good_size" class="m-wrap medium" id="good_size"/></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span> 材质:</span></td>
											<td colspan='4'><input type="text"  name="good_material" class="m-wrap medium" id="good_material"/></td>
											
										</tr>
										
										<tr id="good_color">
											<td colspan='4' style='text-align:right;'><span>颜色贴面:</span></td>
											<td colspan='4'>
												<input class="btn red" type="button" value="增加" onclick="goodColor();onImageP()">
											</td>
										</tr>
										
										<script type="text/javascript">
											function goodColor(){
												$("#good_color").after("<tr><td colspan='4' style='text-align:right;'><img src='' width='60' height='60' name='images' style='display:none'></td><td colspan='4'><input type='file' name='goods_color[]'><input class='m-wrap medium' type='text' name='goods_color_title[]'></td></tr>");
	
											}
										</script>
								
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>产品状态:</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap medium" name='goods_status' id='goods_status'>
														<option value="1" >正常</option>
														<option value="11" >屏蔽</option>
														<option value="12" >申述</option>
														<option value="21" >草稿</option>
														<option value="22" >下架</option>
														<option value="99">屏蔽</option>
												</select>
											</td>
										
												
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'>缩略图1:</td>
											<td colspan='4'>
												<input type="file" name="good_pic1">
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'>缩略图2:</td>
											<td colspan='4'>
												<input type="file" name="good_pic2">
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'>缩略图3:</td>
											<td colspan='4'>
												<input type="file" name="good_pic3">
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'>缩略图4:</td>
											<td colspan='4'>
												<input type="file" name="good_pic4">
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'>缩略图5:</td>
											<td colspan='4'>
												<input type="file" name="good_pic5">
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>产品描述:</span></td>
											<td colspan='4'>
												<script id="goods_desc" name="goods_desc" type="text/plain" style="width:800px;height:400px;">
												    
												</script>
												<script type="text/javascript">
												    var editor = UE.getEditor('goods_desc')
												</script>
												
											</td>
										</tr>
										
									
										<tr>
											<input type="hidden" name="service_flg" value="<?php if(isset($goods['service_id']) && $goods['service_id']) echo $goods['service_id'];?>">
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
