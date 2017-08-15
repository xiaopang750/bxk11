
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

							楼盘 &amp; 楼盘列表  <small>方案&amp; 楼盘管理</small>

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

							<li><a href="#">楼盘列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>楼盘</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/house/index')?>" method='get'>
										<div class="chat-form">
										开盘日期：

										<div class="input-append">
											<input name='ka_start' class="m-wrap m-ctrl-medium date-picker" type="text" value="" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										--
										<div class="input-append">
											<input name='ka_end' class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php if($ka_end){echo $ka_end;}else{echo date('Y-m-d',time());}?>" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										 	楼盘状态  :
										<select class="header-option m-wrap small" name='house_status'>
											<option value="" <?php if($house_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($house_status == 1) echo "selected";?>>正常</option>
											<option value="2" <?php if($house_status == 2) echo "selected";?>>隐藏</option>
											<option value="99" <?php if($house_status == 99) echo "selected";?>>删除</option>
										</select>
										 	
											楼盘类型  :
										<select class="header-option m-wrap small" name='house_type'>
											<option value="1" <?php if($house_type == 1) echo "selected";?>>系统 </option>
											<option value="2" <?php if($house_type == 2) echo "selected";?>>用户自建</option>
										</select>
										
										<br/><br/>
										入住时间：

										<div class="input-append">
											<input name='ea_end' class="m-wrap m-ctrl-medium date-picker" type="text" value="" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										--
										<div class="input-append">
											<input name='ea_end' class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php if($ea_end){echo $ea_end;}else{echo date('Y-m-d',time());}?>" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
											省：
										<select class="header-option m-wrap medium" name='house_province' id='house_province' onclick="return jsv.province();">
														<option value="0" >请选择</option>
														<?php if($house_province_source){
															foreach ($house_province_source as $value){
														?>
															<option value="<?php echo $value['district_code'];?>" <?php if($house_province ==  $value['district_code']) echo "selected";?>><?php echo $value['district_name'];?></option>
														<?php 	
															}
														}
														?>
										</select>
											市：
										<select class="header-option m-wrap medium" name='house_city' id='house_city'>
											<option value="0" >请选择</option>
											<?php if($house_city_source){
															foreach ($house_city_source as $value){
														?>
															<option value="<?php echo $value['district_code'];?>" <?php if($house_city ==  $value['district_code']) echo "selected";?>><?php echo $value['district_name'];?></option>
														<?php 	
															}
														}
														?>
										</select>
										
										<br/><br/>
											发表人昵称:
										<input  type="text"  class="m-wrap" name ='user_name' placeholder=" 用户名..." value="<?php echo $user_name;?>">	
											楼盘名:
										<input  type="text"  class="m-wrap span6" name ='house_name' placeholder=" 楼盘名..." value="<?php echo $house_name;?>">
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

											<th>楼盘名</th>
											<th>创建用户</th>
											<th>省</th>
											<th>市</th>
											<th>楼盘类型</th>

											<th class="hidden-480">开盘日期</th>
											<th class="hidden-480">入住日期</th>
											<th>楼盘状态 </th>
											<th>审核</th>
											<th>推荐热点</th>
											<th>操作</th>
		
										</tr>

									</thead>

									<tbody>

										<?php foreach ($re as $val){?>
										<tr>

											<td><?php echo $val->house_id;?></td>
											<td> <a href="<?php echo site_url('content/designinfo').'?cid='.$val->house_id;?>" target="_left"><?php echo cn_substr_utf8($val->house_name,0,10);?></a></td>
											<td>
					
											
											<?php if($val->house_type == 1){?>
												系统创建
											<?php }else{?>
											<a href="<?php echo site_url('user/index').'/'.$val->user_id;?>" target="_left"><?php if(isset($val->user_nickname)){ echo cn_substr_utf8($val->user_nickname,0,10);}else{ if(getUserName($val->user_id))echo getUserName($val->user_id);else echo "无名氏";}?></a>
											<?php }?>
											</td>
											<td>
													<?php if(isset($val->house_province) && $val->house_province !=''){ 
														if(getAraeName($val->house_province)){
															echo getAraeName($val->house_province);
														}else{
															echo "暂无";
														}
													}else{
															echo "暂无";
														}?>
											</td>

											<td>	<?php if(isset($val->house_city) && $val->house_city !=''){ 
														if(getAraeName($val->house_city)){
															echo getAraeName($val->house_city);
														}else{
															echo "暂无";
														}
													}else{
															echo "暂无";
														}?>
											</td>
											<td><?php if($val->house_type == 1)echo "系统";else echo "用户自建";?></td>
									

											<td class="hidden-480"><?php echo $val->house_opendate;?></td>
											<td class="hidden-480"><?php echo $val->house_checkdate;?></td>

											<td>
											<?php if($val->house_status == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val->house_status == 2){?>
											<span class="label label-danger">隐藏</span>
											<?php }elseif($val->house_status == 99){?>
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

														<?php if($val->house_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->house_id; ?>,'house');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val->house_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->house_id;?>,'house');"><span class="label label-danger">隐藏</span></a></li>
														<?php }?>
														<?php if($val->house_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->house_id;?>,'house');"><span class="label label-info">删除</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											</td>
											<td>
											<a href="#" onclick="jsv.room_is_hot('<?php if($val->house_is_hot == '' || $val->house_is_hot == 0 ){echo '1';}else{echo 0;}?>','<?php echo $val->house_id;?>','house');"><?php if(isset($val->house_is_hot) && $val->house_is_hot == 1){
											echo "取消热门";}else{ echo "推荐热门";}?></a>
											</td>
											<td>
											<a href="<?php echo site_url('admin/house/edit')."?house_id=".$val->house_id;?>">编辑</a>
											
											<td>
					
										
											</td>
										</tr>
										<?php }?>

									</tbody>
									<tfooter>
									<tr><td colspan='13' style="text-align:center;" class="pagination"><?php echo $p;?></td></tr>
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
