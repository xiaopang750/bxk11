
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

							门店&amp; 门店查看  <small>门店&amp;门店管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">门店管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">门店查看 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>门店查看</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
							
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>门店查看</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>所属服务商:</span></td>
											<td colspan='4'>
												<?php if(!$result->service_id || empty($result->service_id)) echo "暂无";else echo getBrandByName("t_service_info_model",array('service_id'=>$result->service_id),"service_name");?>
								
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>门店名称:</span></td>
											<td colspan='4'>
												<?php if(!$result->shop_name || empty($result->shop_name)) echo "暂无";else echo  $result->shop_name;?>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>地区:</span></td>
											<td colspan='4'>
													
											<?php if($result->shop_province_code){echo getAraeName($result->shop_province_code);}else{ echo "暂无";}?>


											<?php if($result->shop_city_code){echo getAraeName($result->shop_city_code);}else{ echo "暂无";}?>
											</td>
											
										</tr>

																	
										<tr>
											<td colspan='4' style='text-align:right;'><span>详细地址:</span></td>
											<td colspan='4'><?php if($result->shop_address) echo "$result->shop_address";?></td>
											
										</tr>
										
										<tr  >
											<td colspan='4' style='text-align:right;'><span>门店logo图片:</span></td>
											<td colspan='4'>
												
												<img src="<?php echo $shop_url.$result->shop_logo; ?>">
												
											</td>
										</tr>
									
										<tr >
											<td colspan='4' style='text-align:right;'><span>实景图1:</span></td>
											<td colspan='4'>
												
												<img src="<?php echo $shop_url.$result->shop_pic1; ?>">
												
											</td>
										</tr>
								
										<tr >
											<td colspan='4' style='text-align:right;'><span>实景图2:</span></td>
											<td colspan='4'>
									
												<img src="<?php echo $shop_url.$result->shop_pic2; ?>">
											
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>实景图3:</span></td>
											<td colspan='4'>
												
												<img src="<?php echo $shop_url.$result->shop_pic3; ?>">
											
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>门店资质文件:</span></td>
											<td colspan='4'>
												
												<img  src="<?php echo $shop_url.$result->shop_license; ?>">
												
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>门店百度地图信息:</span></td>
											<td colspan='4'>
													<?php if($result->shop_map) echo "$result->shop_map";?>	
												
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>*门店百度地图经纬度:</span></td>
											<td colspan='4'>
													经度
													<input id='shop_longitude' type='text' class="m-wrap medium" name='shop_longitude' value="<?php if($result->shop_longitude) echo "$result->shop_longitude";?>"/>
													纬度
													<input id='shop_latitude' type='text' class="m-wrap medium" name='shop_latitude' value="<?php if($result->shop_latitude) echo "$result->shop_latitude";?>"/>	
													<a href="javascript:void(0);" onclick="setlatlng($('#shop_longitude').val(),$('#shop_latitude').val())">在地图中查看/设置</a>
											</td>
										</tr>
										<!-- <tr>
											<td colspan='4' style='text-align:right;'><span>门店状态:</span></td>
											<td colspan='4'>
											<select name='shop_status'>
												<option value='1' <?php if($result->shop_status && $result->shop_status == 1) echo "selected";?>>旗舰店 </option>
												<option value='2' <?php if($result->shop_status && $result->shop_status == 2) echo "selected";?>>分店 </option>
												<option value='11' <?php if($result->shop_status && $result->shop_status == 11) echo "selected";?>>审核中</option>
												<option value='12' <?php if($result->shop_status && $result->shop_status == 12) echo "selected";?>>停业</option>
												<option value='81' <?php if($result->shop_status && $result->shop_status == 81) echo "selected";?>>屏蔽</option>
												<option value='99' <?php if($result->shop_status && $result->shop_status == 99) echo "selected";?>>删除</option>
											</select>
											*如果该服务商下有旗舰店，再添加个旗舰店则以前的旗舰店将置为分店
											</td>
											
										</tr> -->
										
										<tr>
										<td colspan='4' style='text-align:right;'><span>门店介绍说明:</span></td>
											<td colspan='4'>
											<?php if($result->shop_explain) echo "$result->shop_explain";?>
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>门店排序:</span></td>
											<td colspan='4'>
										
											<?php if($result->shop_sort) echo "$result->shop_sort";?>
											</td>
											
										</tr>

									</tbody>

								</table>
				
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
			function setlatlng(longitude,latitude){
				art.dialog.data('shop_longitude', longitude);
				art.dialog.data('shop_latitude', latitude);
				// 此时 iframeA.html 页面可以使用 art.dialog.data('test') 获取到数据，如：
				// document.getElementById('aInput').value = art.dialog.data('test');
				var url = "<?php echo site_url('admin/shop/setlatlng');?>";
				art.dialog.open(url,{lock:false,title:'设置经纬度',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.87});
			}
		</script>