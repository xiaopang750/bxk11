
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

							服务商&amp; 服务商添加  <small>服务商&amp;服务商管理</small>

						</h3>
						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">服务商管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">服务商添加 </a></li>

						</ul>

			
						<ul class="breadcrumb" >

							<li style="background-color: red;line-height:20px; text-align:center;">

								<a href="#">第一步：添加经销商</a> 
								<i class="icon-angle-right"></i>

							</li>

							<li>

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

								<div class="caption"><i class="icon-cogs"></i>服务商添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/member/doadd');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.memberSub('')">
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
											<td colspan='4' style='text-align:right;' width='20%'><span>经销商会员:</span></td>
											<td colspan='4'>
												<input id='service_ename' type='text' class="m-wrap medium" name='service_ename' onblur="jsv.isService_ename(this,'')" value="<?php if(isset($service_ename) && $service_ename) echo $service_ename;?>"/>
											</td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>登录名:</span></td>
											<td colspan='4'>
												<input id='service_name' type='text' class="m-wrap medium" name='service_name' onblur="jsv.is_user(this,'')" value="<?php if(isset($service_name) && $service_name) echo $service_name;?>"/>*
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>公司名:</span></td>
											<td colspan='4'>
												<input id='service_company' type='text' class="m-wrap medium" name='service_company' value="<?php if(isset($re->join_name) && $re->join_name) echo $re->join_name;?>" onblur="jsv.isCompany(this,'')"/>
											</td>
											
										</tr>	

										<!-- <tr>
											<td colspan='4' style='text-align:right;' width='20%'><span> 服务商密码:</span></td>
											<td colspan='4'>
												<input id='service_passwd' type='text' class="m-wrap medium" name='service_passwd'  value="123456" />
											</td>
											
										</tr> -->
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>公司联系电话:</span></td>
											<td colspan='4'>
												<input id='service_phone' type='text' class="m-wrap medium" name='service_phone'  value="<?php if(isset($re->join_phone) && $re->join_phone) echo $re->join_phone;?>"/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>联系人名称:</span></td>
											<td colspan='4'>
												<input id='service_person' type='text' class="m-wrap medium" name='service_person'  value="<?php if(isset($re->join_person) && $re->join_person) echo $re->join_person;?>"/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>联系人电话:</span></td>
											<td colspan='4'>
												<input id='service_person_phone' type='text' class="m-wrap medium" name='service_person_phone' value="<?php if(isset($re->join_phone) && $re->join_phone) echo $re->join_phone;?>" />
											</td>
											
										</tr>
										

										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>地区   :</span></td>
											<td colspan='4'>
													
												<select class="header-option m-wrap small" id="province" onchange="jsv.provincec()" name="province">
													<option value="">-省份-</option>
													<?php if($provincere){foreach ($provincere as $val){?>
													<option value="<?php echo $val['district_code']?>" <?php if(isset($pxid) && ($pxid == $val['district_code']) && ($pxid!='')) echo "selected";?>><?php echo $val['district_name']?></option>
													<?php }}?>
												</select>
												<select  id="city" onchange="jsv.cityr();" name="city">
													<option value="">-城市-</option>
													<?php if($cityre){foreach ($cityre as $val){?>
													<option value="<?php echo $val['district_code']?>" <?php if(($cid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
													<?php }}?>
												</select>
												
												<select id="district" name="district">
													<option value="">-州县-</option>
													<?php if($disre){foreach ($disre as $val){?>
													<option value="<?php echo $val['district_code']?>" <?php if(($did == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
													<?php }}?>
												</select>
											</td>
											
										</tr>

																	
										<tr>
											<td colspan='4' style='text-align:right;'><span>详细地址:</span></td>
											<td colspan='4'><input type="text" id='service_address' name="service_address" class="m-wrap medium" value="<?php if(isset($re->join_address) && $re->join_address ) echo $re->join_address;?>"/></td>
											
										</tr>
										
										<tr  >
											<td colspan='4' style='text-align:right;'><span>营业执照图片:</span></td>
											<td colspan='4'>
												<input type='file' name='service_license'>*
												<?php if(isset($re->join_license) && $re->join_license){?>
													<img src='<?php echo $re->join_license; ?>' height='60' width='60'/>
													<input type='hidden' value='<?php echo $re->join_license; ?>' name='service_license_bak'>
										
												<?php } ?>
												
												
											</td>
										</tr>
									
										<tr >
											<td colspan='4' style='text-align:right;'><span>证件1:</span>
												<!-- <img src="" id="sdf" width="50"> -->
											</td>
											<td colspan='4'>
												<input type='file' name='service_doc1'>
											</td>
										</tr>
								
										<tr >
											<td colspan='4' style='text-align:right;'><span>证件1:</span></td>
											<td colspan='4'>
												<input type='file' name='service_doc2'>
												<input type='hidden' value='' name='service_doc2_bak'>
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>服务类别:</span></td>
											<td colspan='4'>
											<select name='service_class'>
											<option value='0'>默认类别</option>											
											</select>
											</td>
										</tr>
										
										<!-- <tr>
											<td colspan='4' style='text-align:right;'><span>服务商模板:</span></td>
											<td colspan='4'>
											
												<label class="radio">

												<input type="radio" name="service_model" value="1" checked/>

												qthome

												</label>

											</td>
										</tr> -->
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>服务商预存款:</span></td>
									
											<td colspan='4'><input type="text" id='service_deposit' name="service_deposit" class="m-wrap medium" /></td>
							
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>服务商网站:</span></td>
											<td colspan='4'><input type="text" id='service_website' name="service_website" class="m-wrap medium" /></td>
											
										</tr>
										
																				
										<tr>
											<td colspan='4' style='text-align:right;'><span>cpa协议金额:</span></td>
											<td colspan='4'><input type="text" id='service_cpa' name="service_cpa" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>cps协议比例:</span></td>
											<td colspan='4'><input type="text" id='service_cps' name="service_cps" class="m-wrap medium" /></td>
											
										</tr>
										
										
									<!-- 	<tr>
											<td colspan='4' style='text-align:right;'><span>公众号名称:</span></td>
											<td colspan='4'><input type="text" id='service_wxname' name="service_wxname" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>公众号原始id:</span></td>
											<td colspan='4'><input type="text" id='service_wxid' name="service_wxid" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>微信号:</span></td>
											<td colspan='4'><input type="text" id='service_wxuser' name="service_wxuser" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>公众号邮箱:</span></td>
											<td colspan='4'><input type="text" id='service_email' name="service_email" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>微信AppId:</span></td>
											<td colspan='4'><input type="text" id='service_appId' name="service_appId" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>微信AppSecret:</span></td>
											<td colspan='4'><input type="text" id='service_appsecret' name="service_appsecret" class="m-wrap medium" /></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>微信号token:</span></td>
											<td colspan='4'><input type="text" id='service_token' name="service_token" class="m-wrap medium" value="<?php echo $tokenvalue;?>"  readonly="true" /></td>
											
										</tr> -->
										
										<!-- <tr>
											<td colspan='4' style='text-align:right;'><span>经销商状态:</span></td>
											<td colspan='4'>
											<select name='service_status'>
												<option value='1'>普通 </option>
												<option value='2'>vip</option>
												<option value='3'>vip已到期 </option>
												<option value='11'>审核中 </option>
												<option value='81'>屏蔽  </option>
												<option value='99'>删除 </option>
											</select>
											
											</td>
											
										</tr>
 -->
										<tr>
											<td colspan='4' style='text-align:right;'><span>vip有效开始日期:</span></td>
											<td colspan='4'>
											<input type="text" name="service_vipstart" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'"/>
											</td>
											
										</tr>
										<tr>
										<td colspan='4' style='text-align:right;'><span>vip有效结束日期:</span></td>
											<td colspan='4'>
											<input type="text" name="service_vipend" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'"/>
											</td>
											
										</tr>
										<tr>
											
											<td colspan='4' style='text-align:right;'>
												<input type="hidden" value='<?php if(isset($join_id) && $join_id) echo $join_id;?>' name="join_id">
													<input type='hidden' value='<?php echo $tags;?>' name='tags'>
													<input class="btn red" type="submit" value="下一步">
												
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
	window.onload = function(){

	var iFile = document.getElementsByName('service_doc1');//上传文本域名
	//var sssz = document.getElementById('sss');

	iFile[0].onchange = function(e){
		
		var oFile = e.target.files[0];

		var reader = new FileReader();

		//var sName = oFile.name;

		var oImage = document.getElementById('sdf');

		//oImage.src = sName;

		reader.readAsDataURL(oFile);

		reader.onload = function(e) {
			
			oImage.src = e.target.result;

		}

	};

	}

})();
													 
</script>
		<!-- END PAGE -->
