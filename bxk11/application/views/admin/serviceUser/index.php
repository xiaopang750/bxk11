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

							Editable Tables <small>editable table samples</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">账号列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">账号管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>账号列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/serviceUser/index')?>" method='get'>
				
										<div class="chat-form">
										添加时间：
										<div class="input-append">
											<input type="text" name="starttime" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'" value='<?php if(isset($starttime)) echo $starttime;?>'/>
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										--
										<div class="input-append">
											<input type="text" name="stoptime" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'" value='<?php if(isset($stoptime)) echo $stoptime;?>'/>
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
											状态  :
										<select class="header-option m-wrap small" name='service_user_status'>
																    
											<option value="" <?php if($service_user_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($service_user_status == 1) echo "selected";?>>正常</option>
											<option value="21" <?php if($service_user_status == 21) echo "selected";?>>临时用户</option>
											<option value="2" <?php if($service_user_status == 2) echo "selected";?>>停用</option>
											<option value="81" <?php if($service_user_status == 81) echo "selected";?>>屏蔽</option>
											<option value="99" <?php if($service_user_status == 99) echo "selected";?>>删除</option>
											
										</select>
									
										<input type="hidden" name="service_id" value="<?php if(isset($service_id) && $service_id) echo $service_id; ?>">
										 	昵名:
										<input  type="text"  class="m-wrap span2" name ='key_word' placeholder=" 服务商登录名或账号名..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/serviceUser/add')."?service_id=".$service_id;?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delServiceUser();">

										<i>	DELETE </i>

										</button>

									</div>
									 

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>账号标识</th>

											<th>所属服务商</th>

											<th>用户名（登录名）</th>
											
											<th>员工姓名</th>
											
											<th>员工电话 </th>

											<th>添加时间 </th>

											<th>状态</th>

											<th>审核</th>
									
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->service_user_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->service_user_id;?>">
											</td>
											<td><?php echo $val->service_user_id;?></td>

											<td><?php if(!$val->service_name || empty($val->service_name)) echo "暂无";else echo  cn_substr_utf8($val->service_name,0,20,false);?></td>
											
											<td><?php if(!$val->service_user_name || empty($val->service_user_name)) echo "暂无";else echo  cn_substr_utf8($val->service_user_name,0,20,false);?></td>

											<td><?php if(!$val->service_user_realname || empty($val->service_user_realname)) echo "暂无";else echo  cn_substr_utf8($val->service_user_realname,0,20,false);?></td>
								
											<td><?php if(!isset($val->service_user_phone))  echo "0";else if(trim($val->service_user_phone)=="") echo "暂无"; else echo $val->service_user_phone; ?></td>

											<td><?php if(empty($val->service_user_addtime)) echo "暂无";else echo  $val->service_user_addtime?></td>
											<td>
													<?php if($val->service_user_status == 1){
															echo "正常";
														  }elseif($val->service_user_status ==21){
															echo "临时用户";
														  }elseif($val->service_user_status ==2){
															echo "停用";
														  }elseif($val->service_user_status == 81){
															echo "屏蔽 ";
														  }else{
															echo "删除";
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

														<?php if($val->service_user_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->service_user_id; ?>,'serviceUser');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val->service_user_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->service_user_id;?>,'serviceUser');"><span class="label label-danger">停用</span></a></li>
														<?php }?>
														<?php if($val->service_user_status != 81){?>
														<li><a href="#" onclick="jsv.status('81',<?php echo $val->service_user_id;?>,'serviceUser');"><span class="label label-info">屏蔽</span></a></li>
														<?php }?>
														
														<?php if($val->service_user_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->service_user_id;?>,'serviceUser');"><span class="label-warning">删除</span></a></li>
														<?php }?>

												
														
													</ul>
							
												</li>
											</ul>
											</td>
											<td>
												<a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/serviceUser/edit').'?service_user_id='.$val->service_user_id.'&service_id='.$val->service_id;?>');">Edit</a>
												|<a class="delete" href="javascript:jsv.delServiceUser(<?php echo $val->service_user_id;?>)">Delete</a>
												|<a href="#" onclick="jsv.updatePwd(<?php echo $val->service_user_id;?>,'user')">密码重置</a>

											</td>
										</tr>
										<?php }?>


									</tbody>
									<tfooter>
									<tr><td colspan='14' style="text-align:center;" ><?php echo $p;?></td></tr>
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
