
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

						<div class="color-panel hidden-phone">

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

						</div>

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							加盟商预览&amp; 服务商  <small>加盟商预览&amp; 产品管理</small>

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

							<li><a href="#">加盟商预览 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>加盟商预览</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/member/doedit');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.memberSub()">
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>加盟商<?php if(isset($result->join_name) && $result->join_name) echo $result->join_name;?>预览</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>申请id:</span></td>
											<td colspan='4'>
												<?php if(isset($result->service_id) && $result->service_id) echo $result->service_id;else "无";?>
											</td>
											
										</tr>

										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>企业名称:</span></td>
											<td colspan='4'>
												<?php if(isset($result->service_company) && $result->service_company) echo $result->service_company;else "无";?>
											</td>
											
										</tr>	

										<tr>
											<td colspan='4' style='text-align:right;'><span>企业邮箱:</span></td>
									
											<td colspan='4'>

												<?php if(isset($result->service_email) && $result->service_email) echo $result->service_email;else "无";?>	

											</td>
							
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>联系人名称:</span></td>
											<td colspan='4'>
												<?php if(isset($result->service_person) && $result->service_person) echo $result->service_person;else "无";?>
											</td>
											
										</tr>
										
					
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span> 联系人电话:</span></td>
											<td colspan='4'>
												<?php if(isset($result->service_person_phone) && $result->service_person_phone) echo $result->service_person_phone;else "无";?>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>营业执照注册号:</span></td>
											<td colspan='4'>
												<?php if(isset($result->service_license_code) && $result->service_license_code) echo $result->service_license_code;else "无";?>
											</td>
											
										</tr>
																	
										<tr>
											<td colspan='4' style='text-align:right;'><span>组织机构代码:</span></td>
											<td colspan='4'>
											
												<?php if(isset($result->service_organization_code) && $result->service_organization_code) echo $result->service_organization_code;else "无";?>	
											</td>
										</tr>

										
										<tr  >
											<td colspan='4' style='text-align:right;'><span>营业执照图片:</span></td>
											<td colspan='4'>
												
												<img src="<?php if($result->service_license) echo $serviceJoin_url.$result->service_license;?>"  >
											</td>
										</tr>
									
										
										
										
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>经销商状态:</span></td>
											<td colspan='4'>
											
												<?php 

													if(isset($result->service_status)){
														if($result->service_status == 1){
															echo "已认证(体验版用户)";
														}elseif ($result->service_status == 21) {
															echo " 待提交认证 ";
														}elseif ($result->service_status == 23) {
															echo "认证中";
														}elseif ($result->service_status == 24) {
															echo "认证失败";
														}elseif ($result->service_status == 81) {
															echo "屏蔽";
														}elseif ($result->service_status == 99) {
															echo "删除";
														}else{
															echo "暂无";
														}
													}else{
														echo "暂无";
													}
												?>	
											
											</td>

											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>申请时间:</span></td>
									
											<td colspan='4'>

												<?php if(isset($result->service_join_addtime) && $result->service_join_addtime) echo $result->service_join_addtime;else "无";?>	

											</td>
							
										</tr>
										
										
										
										<!-- 品牌 -->
										<tr>
											<td colspan='8'><span>品牌预览</span></td>
							
										</tr>
										<?php if($brand_r){?>
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>品牌中文名:</span></td>
											<td colspan='4'>
												<?php if(isset($brand_r["apply_brand_name"]) && $brand_r["apply_brand_name"]) echo $brand_r["apply_brand_name"];else "无";?>
											</td>
											
										</tr>	

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>品牌英文名:</span></td>
											<td colspan='4'>
												<?php if(isset($brand_r["apply_brand_ename"]) && $brand_r["apply_brand_ename"]) echo $brand_r["apply_brand_ename"];else "无";?>
											</td>
											
										</tr>
									
										<tr  >
											<td colspan='4' style='text-align:right;'><span>品牌logo:</span></td>
											<td colspan='4'>
												
												<img src="<?php if($brand_r["apply_brand_img"]) echo $brand_url.$brand_r["apply_brand_img"];?>"  >
											</td>
										</tr>
									
										<tr >
											<td colspan='4' style='text-align:right;'><span>授权文件:</span>
				
											</td>
											<td colspan='4'>
										
												<img src="<?php if($brand_r["apply_license_file"]) echo $brand_url.$brand_r["apply_license_file"];?>" >
												
											</td>
										</tr>
								
										

										
										<tr>
											<td colspan='4' style='text-align:right;'><span>申请状态:</span></td>
											<td colspan='4'>
											
												<?php 

													if(isset($brand_r["apply_status"])){
														if($brand_r["apply_status"] == 1){  
															echo "已认证";
														}elseif ($brand_r["apply_status"] == 2) {
															echo "未认证";
														}elseif ($brand_r["apply_status"] == 3) {
															echo "下架";
														}elseif ($brand_r["apply_status"] == 4) {
															echo "参与企业认证";
														}elseif ($brand_r["apply_status"] == 11) {
															echo "审核中";
														}elseif ($brand_r["apply_status"] == 12) {
															echo "认证已到期";
														}elseif ($brand_r["apply_status"] == 13) {
															echo "认证审核失败";
														}elseif ($brand_r["apply_status"] == 81) {
															echo "屏蔽";
														}elseif ($brand_r["apply_status"] == 99) {
															echo "删除";
														}else{
															echo "暂无";
														}
													}else{
														echo "暂无";
													}
												?>	
											
											</td>

											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>授权有效开始时间:</span></td>
									
											<td colspan='4'>

												<?php if(isset($brand_r["apply_license_begin"]) && $brand_r["apply_license_begin"]) echo $brand_r["apply_license_begin"];else "无";?>	

											</td>
							
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>授权有效结束时间:</span></td>
									
											<td colspan='4'>

												<?php if(isset($brand_r['apply_license_end']) && $brand_r['apply_license_end']) echo $brand_r['apply_license_end'];else "无";?>	

											</td>
							
										</tr>
										<?php }?>
										
										<!-- 门店 -->
										<tr>
											<td colspan='8'><span>门店预览</span></td>
							
										</tr>
										<?php if($shop_r){?>
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>所属服务商:</span></td>
											<td colspan='4'>
												<?php if(!$shop_r['service_id'] || empty($shop_r['service_id'])) echo "暂无";else echo getBrandByName("t_service_info_model",array('service_id'=>$shop_r['service_id']),"service_name");?>
								
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>门店名称:</span></td>
											<td colspan='4'>
												<?php if(!$shop_r['shop_name'] || empty($shop_r['shop_name'])) echo "暂无";else echo  $shop_r['shop_name'];?>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>地区:</span></td>
											<td colspan='4'>
													
											<?php if($shop_r['shop_province_code']){echo getAraeName($shop_r['shop_province_code']);}else{ echo "暂无";}?>


											<?php if($shop_r['shop_city_code']){echo getAraeName($shop_r['shop_city_code']);}else{ echo "暂无";}?>
											</td>
											
										</tr>

																	
										<tr>
											<td colspan='4' style='text-align:right;'><span>详细地址:</span></td>
											<td colspan='4'><?php if($shop_r['shop_address']) echo $shop_r['shop_address'];?></td>
											
										</tr>
										
										<tr  >
											<td colspan='4' style='text-align:right;'><span>门店logo图片:</span></td>
											<td colspan='4'>
												
												<img src="<?php echo $shop_url.$shop_r['shop_logo']; ?>">
												
											</td>
										</tr>
									
										<tr >
											<td colspan='4' style='text-align:right;'><span>实景图1:</span></td>
											<td colspan='4'>
												
												<img src="<?php echo $shop_url.$shop_r['shop_pic1']; ?>">
												
											</td>
										</tr>
								
										<tr >
											<td colspan='4' style='text-align:right;'><span>实景图2:</span></td>
											<td colspan='4'>
									
												<img src="<?php echo $shop_url.$shop_r['shop_pic2']; ?>">
											
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>实景图3:</span></td>
											<td colspan='4'>
												
												<img src="<?php echo $shop_url.$shop_r['shop_pic3']; ?>">
											
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>门店资质文件:</span></td>
											<td colspan='4'>
												
												<img  src="<?php echo $shop_url.$shop_r['shop_license']; ?>">
												
											</td>
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>门店状态:</span></td>
											<td colspan='4'>
												<?php if($shop_r['shop_status'] == 1){
														   echo "旗舰店";
													   }elseif($shop_r['shop_status'] == 2){
															echo "分店";
													   }elseif($shop_r['shop_status'] == 3){ 
															echo "未认证";
													   }elseif($shop_r['shop_status'] == 4){ 
															echo "参与企业认证";
													   }elseif($shop_r['shop_status'] == 11){
															echo "审核中";
													   }elseif($shop_r['shop_status'] == 12){
															echo "删除";
													   }elseif($shop_r['shop_status'] == 81){
																echo "停业";
													   }elseif($shop_r['shop_status'] == 99){
															echo "删除";
													   }else{
													   		echo "非法";
													   }
												?>
		
											</td>
										
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>*门店百度地图经纬度:</span></td>
											<td colspan='4'>
													经度
													<input id='shop_longitude' type='text' class="m-wrap medium" name='shop_longitude' value="<?php if($shop_r['shop_longitude']) echo $shop_r['shop_longitude'];?>"/>
													纬度
													<input id='shop_latitude' type='text' class="m-wrap medium" name='shop_latitude' value="<?php if($shop_r['shop_latitude']) echo $shop_r['shop_latitude'];?>"/>	
													<a href="javascript:void(0);" onclick="setlatlng($('#shop_longitude').val(),$('#shop_latitude').val())">在地图中查看/设置</a>
											</td>
										</tr>
										
										
										<tr>
										<td colspan='4' style='text-align:right;'><span>门店介绍说明:</span></td>
											<td colspan='4'>
											<?php if($shop_r['shop_explain']) echo $shop_r['shop_explain'];?>
											</td>
											
										</tr>
										
										<?php }?>
										
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
			function setlatlng(longitude,latitude){
				art.dialog.data('shop_longitude', longitude);
				art.dialog.data('shop_latitude', latitude);
				// 此时 iframeA.html 页面可以使用 art.dialog.data('test') 获取到数据，如：
				// document.getElementById('aInput').value = art.dialog.data('test');
				var url = "<?php echo site_url('admin/shop/setlatlng');?>";
				art.dialog.open(url,{lock:false,title:'设置经纬度',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.87});
			}
		</script>