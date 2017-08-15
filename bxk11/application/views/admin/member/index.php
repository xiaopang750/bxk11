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

										<option value="fluid" selected>Fluid</option>

										<option value="boxed">Boxed</option>

									</select>

								</label>

								<label>

									<span>Header</span>

									<select class="header-option m-wrap small">

										<option value="fixed" selected>Fixed</option>

										<option value="default">Default</option>

									</select>

								</label>

								<label>

									<span>Sidebar</span>

									<select class="sidebar-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected>Default</option>

									</select>

								</label>

								<label>

									<span>Footer</span>

									<select class="footer-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected>Default</option>

									</select>

								</label>

							</div>

						</div>

						<!-- END BEGIN STYLE CUSTOMIZER -->  

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							Editable Tables <small>editable table samples</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">服务商列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">服务商管理</a></li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-edit"></i>服务商列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/member/index')?>" method='get'>
										<div class="chat-form">
											选择地区   :
										<select class="header-option m-wrap small" id="province" onchange="jsv.provincec()" name="province">
											<option value="">-省份-</option>
											<?php if($provincere){foreach ($provincere as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($pxid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
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
												经销商状态  :
										<select class="header-option m-wrap small" name='service_status'>
											<option value="" <?php if($service_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($service_status == 1) echo "selected";?>>体验版用户</option>
											<option value="21" <?php if($service_status == 21) echo "selected";?>>未认证</option>
											<option value="22" <?php if($service_status == 22) echo "selected";?>>待提交认证</option>
											<option value="23" <?php if($service_status == 23) echo "selected";?>>认证中</option>
											<option value="24" <?php if($service_status == 24) echo "selected";?>>认证失败</option>
											<option value="81" <?php if($service_status == 81) echo "selected";?>>屏蔽 </option>
											<option value="99" <?php if($service_status == 99) echo "selected";?>>删除</option>
										</select>
										<br/><br/>
										 	模糊条件:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder=" 会员名或登录名或公司名..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/member/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<!-- <div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_product();">

										<i>	DELETE </i>

										</button>

									</div>
									 -->

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>

											<th>标识</th>

											

										

											<th>公司名</th>
											
										
											<th>省</th>

											<th>市</th>

											<th>服务商类型</th>

											<th>客户级别</th>

											<th>品牌审核</th>

											<th>门店操作</th>

											<th>账号管理</th>

											<th>商品管理</th>
											
											<th>状态</th>

											<th>审核</th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->service_id;?>">

											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->service_id;?>">
											</td>
											<td>
												<?php echo $val->service_id;?>
											</td>
								
											<td><?php if(!$val->service_company || empty($val->service_company)) echo "暂无";else echo  cn_substr_utf8($val->service_company,0,100,false);?></td>

											<td><?php if($val->service_province_code){echo getAraeName($val->service_province_code);}else{ echo "暂无";}?></td>

											<td><?php if($val->service_city_code){echo getAraeName($val->service_city_code);}else{ echo "暂无";}?></td>

											<td><?php if($val->service_type_id){echo getValueName("t_service_type_model",array('service_type_id'=>$val->service_type_id),"service_type");}else{ echo "暂无";}?></td>

											<td><?php if($val->la_rank){echo getValueName("t_service_level_role_model",array('la_rank'=>$val->la_rank),"la_name");}else{ echo "暂无";}?></td>

											<td>
											<!-- 	<a href="<?php echo site_url('admin/member/service_brands_apply')."?service_id=".$val->service_id;?>">进入</a>|
												<a href="<?php echo site_url('admin/member/service_brands_apply_system')."?service_id=".$val->service_id;?>">关联系统</a> -->
												<a href="<?php echo site_url('admin/member/newService_brands_apply')."?service_id=".$val->service_id;?>">进入</a>
												
											</td>
											
											<td><a href="<?php echo site_url('admin/shop/index')."?service_id=".$val->service_id;?>">进入</a></td>

											<td><a href="<?php echo site_url('admin/serviceUser/index')."?service_id=".$val->service_id;?>">进入</a></td>
											
											<td><a href="<?php echo site_url('admin/serviceProduct/index')."?service_id=".$val->service_id;?>">进入</a></td>
											

											<td>
												<?php if($val->service_status == 1){
														echo "体验版用户";
													  }elseif($val->service_status ==21){
														echo "未认证";
													  }elseif($val->service_status == 22){
														echo "待提交认证";
													  }elseif($val->service_status == 11){
														echo "<a href='".site_url('admin/member/doAuditing')."?service_id=".$val->service_id."'>继续审</a>";
													  }elseif($val->service_status == 23){
														echo "认证中";
													  }elseif($val->service_status == 24){
														echo "认证失败";
													  }elseif($val->service_status == 81){
														echo "屏蔽";
													  }elseif($val->service_status == 99){
														echo "删除";
													  }else{
														echo "非法";
													 }?>
											</td>
											
											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
					
													<ul class="dropdown-menu">
																
														<?php if($val->service_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->service_id; ?>,'newjoin');"><span class="label label-success">认证成功</span></a></li>
														<?php }?>

														<?php if($val->service_status != 21){?>
														<li><a href="#" onclick="jsv.status('21',<?php echo $val->service_id;?>,'newjoin');"><span class="label label-danger">未认证</span></a></li>
														<?php }?>

														<?php if($val->service_status != 22){?>
														<li><a href="#" onclick="jsv.status('22',<?php echo $val->service_id;?>,'newjoin');"><span class="label label-info">待提交认证</span></a></li>
														<?php }?>

														<?php if($val->service_status != 23){?>
														<li><a href="#" onclick="jsv.status('23',<?php echo $val->service_id;?>,'newjoin');"><span class="label-warning">认证中</span></a></li>
														<?php }?>

														<?php if($val->service_status != 24){?>
														<li><a href="#" onclick="jsv.status('24',<?php echo $val->service_id;?>,'newjoin');"><span class="label-warning">认证失败</span></a></li>
														<?php }?>

														<?php if($val->service_status != 81){?>
														<li><a href="#" onclick="jsv.status('81',<?php echo $val->service_id;?>,'newjoin');"><span class="label-warning">屏蔽</span></a></li>
														<?php }?>

														<?php if($val->service_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->service_id;?>,'newjoin');"><span class="label-warning">删除</span></a></li>
														<?php }?>

													</ul>
							
												</li>
											</ul>
											</td>

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/member/edit').'?service_id='.$val->service_id;?>');">Edit</a>|<a href="#" onclick="javascript:jsv.go('<?php echo site_url('admin/member/readJoin').'?service_id='.$val->service_id;?>')">查看</a><?php if($val->service_status == 1){ ?>|<a href="#" onclick="jsv.updatePwd(<?php echo $val->service_id;?>,'rank')">等级分配</a><?php }?><!-- |<a href="#" onclick="jsv.updatePwd(<?php echo $val->service_id;?>,'service')">密码重置</a> --></td>
										</tr>
										<?php }?>
									</tbody>
									<tfooter>
									<tr><td colspan='16' style="text-align:center;" ><?php echo $p;?></td></tr>
									</tfooter>
								</table>

							</div>

						</div>

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT -->

			</div>

			<!-- END PAGE CONTAINER-->

		</div>

		<!-- END PAGE -->
