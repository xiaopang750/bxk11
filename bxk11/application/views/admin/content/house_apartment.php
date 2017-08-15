
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

							户型 &amp; 户型列表  <small>户型&amp; 户型管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">内容管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">户型列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>户型</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/house/house_apartment')?>" method='get'>
										<div class="chat-form">
												省：
											<select class="header-option m-wrap medium" name='house_province' id='house_province' onclick="return jsv.province();">
															<option value="0" >请选择</option>
															<?php if($house_province_source){
																foreach ($house_province_source as $value){
															?>
																<option value="<?php echo $value['district_code'];?>" <?php if($value['district_code'] == $house_province) echo "selected";?> ><?php echo $value['district_name'];?></option>
															<?php 	
																}
															}
															?>
											</select>
												市：
											<select class="header-option m-wrap medium" name='house_city' id='house_city' onclick="return jsv.city();">
														<option value="0" >请选择</option>
														<?php if($house_city_source){
																foreach ($house_city_source as $value){
															?>
																<option value="<?php echo $value['district_code'];?>" <?php if($value['district_code'] == $house_city) echo "selected";?> ><?php echo $value['district_name'];?></option>
															<?php 	
																}
															}
															?>
											</select>
												楼盘：
											<select class="header-option m-wrap medium" name='house_id' id='house_id'>
														<option value="0" >请选择</option>
														<?php if($house){
																foreach ($house as $value){
															?>
																<option value="<?php echo $value->house_id;?>" <?php if($value->house_id == $house_id) echo "selected";?> ><?php echo $value->house_name;?></option>
															<?php 	
																}
															}
															?>
											</select>
												户型类别  :
											<select class="header-option m-wrap small" name='apartment_type'>
												<option value="1" <?php if($apartment_type == 1) echo "selected";?>>系统 </option>
												<option value="2" <?php if($apartment_type == 2) echo "selected";?>>用户自建</option>
											</select>
											<br/><br/>
												户型类型:
											<select class="header-option m-wrap medium" name='apartment_category_id' id='apartment_category_id'>
														<option value="0" >请选择</option>
														<?php if($list){foreach($list as $value){?>
														<option value="<?php echo $value['tag_id']; ?>" <?php if($apartment_category_id == $value['tag_id']) echo "selected";?> ><?php echo $value['tag_name'];?></option>
														<?php }}?>	
											</select>
										 	户型状态  :
											<select class="header-option m-wrap small" name='apartment_status'>
												<option value="" <?php if($apartment_status == '') echo "selected";?>>请选择</option>
												<option value="1" <?php if($apartment_status == 1) echo "selected";?>>正常</option>
												<option value="2" <?php if($apartment_status == 2) echo "selected";?>>隐藏</option>
												<option value="99" <?php if($apartment_status == 99) echo "selected";?>>删除</option>
											</select>
											
												发表人昵称:
											<input  type="text"  class="m-wrap span4" name ='user_name' placeholder=" 用户名..." value="<?php echo $user_name;?>">	
												<br/><br/>
												户型名:
											<input  type="text"  class="m-wrap span9" name ='apartment_name' placeholder=" 楼盘名..." value="<?php echo $apartment_name;?>">
											<button class="btn green" type="submit">
											Search...
											<i class="m-icon-swapright m-icon-white"></i>
											</button>
										</div>
									</form>
								</div>

								<table class="table table-hover">

									<thead>

										<tr>

											<th>#</th>

											<th>户型名</th>
											<th>创建用户</th>
											<th>楼盘名</th>
											<th>户型类别</th>
											<th>类型</th>

											<th class="hidden-480">方案数</th>
											<th class="hidden-480">浏览数</th>
											<th>户型状态 </th>
											<th>审核</th>
											<th>推荐热点</th>
											<th>操作</th>
		
										</tr>

									</thead>

									<tbody>

										<?php foreach ($re as $val){?>
										<tr>

											<td><?php echo $val->apartment_id;?></td>
											<td> <a href="<?php echo site_url('content/designinfo').'?cid='.$val->apartment_id;?>" target="_left"><?php if($val->apartment_name)echo cn_substr_utf8($val->apartment_name,0,10); else echo "无户型";?></a></td>
											<td>
											<?php if($val->apartment_type == 1){?>
												系统创建
											<?php }else{?>
											<a href="<?php echo site_url('user/index').'/'.$val->user_id;?>" target="_left"><?php if(isset($val->user_nickname)){ echo cn_substr_utf8($val->user_nickname,0,15);}else{ if(getUserName($val->user_id))echo getUserName($val->user_id);else echo "无名氏";}?></a>
											<?php }?>
											</td>
											<td>
													<?php if(getHouseApartmentName($val->house_id)) echo getHouseApartmentName($val->house_id); else echo "无名楼盘";?>
											</td>
													
											<td>	
											<?php echo $val->apartment_category;?>
											</td>
											<td><?php if($val->apartment_type == 1)echo "系统";else echo "用户自建";?></td>
								
											<td class="hidden-480"><?php echo $val->apartment_schemes;?></td>
											<td class="hidden-480"><?php echo $val->apartment_views;?></td>
											<td>
											<?php if($val->apartment_status == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val->apartment_status == 2){?>
											<span class="label label-danger">待审核</span>
											<?php }elseif($val->apartment_status == 3){?>
											<span class="label label-danger">屏蔽</span>
											<?php }elseif($val->apartment_status == 99){?>
											<span class="label label-info">删除</span>
											<?php }else{?>
											<span class="label label-warning" >未知</span>
											<?php }?>
											</td>
											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
					
													<ul class="dropdown-menu">

														<?php if($val->apartment_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->apartment_id; ?>,'apartment');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val->apartment_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->apartment_id;?>,'apartment');"><span class="label label-danger">隐藏</span></a></li>
														<?php }?>
														<?php if($val->apartment_status != 99){?>
														<li><a href="#" onclick="jsv.status('',<?php echo $val->apartment_id;?>,'apartment');"><span class="label label-info">删除</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											</td>
											<td>
											<a href="#" onclick="jsv.room_is_hot('<?php if($val->apartment_is_hot == '' || $val->apartment_is_hot == 0 ){echo '1';}else{echo 0;}?>','<?php echo $val->apartment_id;?>','apartment');"><?php if(isset($val->apartment_is_hot) && $val->apartment_is_hot == 1){
											echo "取消热门";}else{ echo "推荐热门";}?></a>
											</td>
											<td>
											<a href="<?php echo site_url('admin/house/house_apartment_edit').'?apartment_id='.$val->apartment_id;?>"> 编辑</a>
											</td>
										</tr>
										<?php }?>

									</tbody>
									<tfooter>
									<tr><td colspan='12' style="text-align:center;" class="pagination"><?php echo $p;?></td></tr>
									</tfooter>
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
