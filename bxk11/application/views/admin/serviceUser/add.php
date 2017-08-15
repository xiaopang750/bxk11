
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

							子账号账号&amp; 账号添加  <small>子账号账号&amp;子账号账号管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">子账号账号管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">子账号账号添加 </a></li>

						</ul>

						<?php if(isset($tags) && $tags == 1){?>
						<ul class="breadcrumb" >
							<li>
								<a href="#">第一步：添加经销商</a> 
								<i class="icon-angle-right"></i>

							</li>

							<li >

								<a href="#">第二步：添加品牌</a>

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">第二步：关联品牌</a>

								<i class="icon-angle-right"></i>

							</li>

							<li >
								
								<a href="#">第三步：添加门店</a>
								<i class="icon-angle-right"></i>
							</li>

							<li style="background-color: red;line-height:20px; text-align:center;">
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

								<div class="caption"><i class="icon-cogs"></i>子账号账号添加</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/serviceUser/doadd');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.serviceUserSub()">
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>子账号添加</th>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>登录（用户）名:</span></td>
											<td colspan='4'>
												<input id='service_user_name' type='text' class="m-wrap medium" name='service_user_name' onblur="jsv.is_ServiceUser(this,'')" />
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>所属服务商:</span></td>
											<td colspan='4'>
												<select name="service_id" id="service_id" onchange="jsv.serviceShop()">
													
													<?php if($service&&isset($service)){
														foreach ($service as $key => $value) {
													?>
													<option value="<?php echo $value->service_id;?>" <?php if(isset($service_id) && $service_id && $value->service_id == $service_id) echo "selected";?>><?php echo $value->service_company;?></option>
													<?php }}?>
												</select>
								
											</td>
											
										</tr>


										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>子帐号负责门店:</span></td>
											<td colspan='4' id="shopInfod">
												<?php if(isset($shopInfo) && $shopInfo){ foreach($shopInfo as $key=>$value){?>
													<input type="checkbox" value="<?php echo $value['shop_id'];?>" name="shop_id"/><?php echo $value['shop_name'];?>
												<?php }}?>
											</td>
											
										</tr>


										<tr >
											<td colspan='8' style='text-align:left;' width='20%'><span>子帐户权限:</span></td>

											
										</tr>

										<?php if(isset($moduleArr) && $moduleArr){
											foreach ($moduleArr as $kexy => $valuex) {
										?>
											<tr>
												<td colspan='4' style='text-align:right;background: #D8E2FA;padding-right: 20px; width: 150px;' width='20%'>
													<span>
														<input type="checkbox" value="<?php echo $valuex['module_key'];?>" name="module_id[]"/>
														<?php echo $valuex['module_name'];?>
													</span>
												</td>
												<td colspan='4'>
													<?php if(isset($valuex['action']) && $valuex['action']){
														foreach ($valuex['action'] as $kxy => $valx) {
													?>
													<input type="checkbox" value="<?php echo $valx['action_key'];?>" name="action_id[]" />
													<?php echo $valx['action_name'];?>
													<?php 	}}?>
												</td>

												
											</tr>
										<?php 	}}?>
										<tr >
											<td colspan='4' style='text-align:right;' width='20%'><span> 账号密码:</span></td>
											<td colspan='4'>
												<input id='service_user_password' type='text' class="m-wrap medium" name='service_user_password'  value="123456" />
											</td>
											
										</tr>

										
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>员工电话:</span></td>
											<td colspan='4'>
												<input id='service_user_phone' type='text' class="m-wrap medium" name='service_user_phone'  value="<?php if(isset($re->service_user_phone) && $re->join_phone) echo $re->join_phone;?>"/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;' width='20%'><span>员工姓名:</span></td>
											<td colspan='4'>
												<input id='service_user_realname' type='text' class="m-wrap medium" name='service_user_realname'  value="<?php if(isset($re->join_person) && $re->join_person) echo $re->join_person;?>"/>
											</td>
											
										</tr>
										
										<!-- <tr>
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
											
										</tr> -->

										
										<tr  >
											<td colspan='4' style='text-align:right;'><span>员工照片:</span></td>
											<td colspan='4'>
												<input type='file' name='service_user_photo'>
												<input type='hidden' value='' name='service_user_photo_bak'>
											</td>
										</tr>
									
										
										
										
										
										<tr>
											<input type="hidden" value="" id="service_user_id">
											<td colspan='4' style='text-align:right;'>
												<?php if(isset($tags) && $tags == 1){?>
													<input type='hidden' value='<?php echo $tags;?>' name='tags'>
													<input class="btn red" type="button" value="进入列表页" onclick="window.location.href='<?php echo site_url('admin/member/index');?>'">
												<?php }?>
													
											<input class="btn red" type="submit" value="提交">
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
		<script language="javascript">
		$(document).ready(function(){					   
	function is_all_checked(input){ 
		var flag=false;
		input.each(function(){ 		
			flag=$(this).attr('checked');
			if(!flag)return false;
		});
		return flag;
	}
	var table_form=$('.table');
	$('tr',table_form).each(function(){ 
		var td_1_input=$("td:nth-child(1) input[type='checkbox']",this);
		var td_2_input=$("td:nth-child(2) input[type='checkbox']",this);
	
		td_1_input.attr('checked',is_all_checked(td_2_input));			  
		td_1_input.parent().attr('class',is_all_checked(td_2_input) ? 'checked':'');
		td_1_input.click(function(){
			td_2_input.attr('checked',td_1_input.attr('checked') ? true:false);
			td_2_input.parent().attr('class',td_1_input.attr('checked') ? 'checked':'');
			//td_2_input.attr('checked',td_1_input.attr('checked'));
		});
		
		td_2_input.click(function(){
			td_1_input.attr('checked',is_all_checked(td_2_input));	
			td_1_input.parent().attr('class',is_all_checked(td_2_input) ? 'checked':'');		  
		});
	});
});

</script>

		<!-- END PAGE -->
