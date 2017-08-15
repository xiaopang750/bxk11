
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
<!-- 
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

						</div> -->

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							jia178    <small>  </small>

						</h3>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
	<!-- BEGIN PAGE CONTENT-->


				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN SAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-cogs"></i>用户列表</div>

								<div class="tools">
										
									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>
							
							</div>

				
							<div class="portlet-body">
							<div style="margin-right:0px;">
								<a href="<?php echo site_url('/admin/user/userlist');?>" style="color:#000000;font-weight:bold">返回用户列表</a>&nbsp;&nbsp;&nbsp;
								<a href="<?php echo site_url('/admin/user/useradd');?>" style="color:#000000;font-weight:bold">添加用户</a>
							</div>
							<div class="row-fluid search-forms search-default">
									<form action="./userlist" method="get" name="">
										<div class="chat-form">
											 邮箱:
										<input type="text" name="email" value='<?php if($email) echo $email;?>'/>
										注册时间：
										<div class="input-append">
											<input type="text" name="starttime" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'" value='<?php if($starttime) echo $starttime;?>'/>
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										--
										<div class="input-append">
											<input type="text" name="stoptime" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'" value='<?php if($stoptime) echo $stoptime;?>'/>
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										
										 <br><br>
											昵称:
										<input  type="text"  class="m-wrap span10" name ='nicname' placeholder="昵称..." value="<?php if($nicname) echo $nicname;?>">
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
											<th>用户序号</th>
											<th>邮箱</th>
											<th>呢称</th>
											<th>性别</th>
											<th>用户类型</th>
											<!-- <th>用户累计积分</th> -->
											<th>用户所在省</th>
											<th>用户注册时间</th>
											<th>设置每日之星</th>
											<th>用户动态</th>
											<th>操作</th>

										</tr>
									</thead>

									<tbody>

										<?php foreach($list as $val):?>
										<tr>

											<td>
											    <!-- <input type="checkbox" name="ID_Dele[]" id='ID_Dele[]' value="<?php echo $val->user_id; ?>" /> -->
												<?php echo $val->user_id; ?>											
                                            </td>
										  <td><?php echo $val->user_email;?></td>
											<td><?php echo $val->user_nickname;?></td>
											<td><?php if($val->user_sex == 1) echo '男'; else echo "女";?></td>
											<td><?php if($val->user_type == 1) echo '普通'; else echo "明星";?></td>
										<!-- 	<td><?php echo $val->user_score;?></td> -->
											<td><?php if($val->provinceid){echo getAraeName($val->provinceid);}else{ echo "暂无";}?></td>
											<td><?php echo $val->user_reg_time;?></td> 
											<td><a href="<?php echo site_url('/admin/user/daily_star');?>?uid=<?php echo $val->user_id;?>">每日之星</a></td>
											<td>
											<a href="<?php echo site_url('/admin/user/feeds_list');?>?uid=<?php echo $val->user_id;?>&email=<?php echo $val->user_email;?>"><span class="label label-success">用户动态</span></a>
											</td>
											<td>
												<a href="<?php echo site_url('/admin/user/users');?>?uid=<?php echo $val->user_id;?>">编辑</a>/
												<a href="<?php echo site_url('/admin/user/deluser');?>?uid=<?php echo $val->user_id;?>" onclick="return confirm('您确定要删除吗?')" >删除</a>
											</td>
										</tr>
										<?php endforeach;?>
									</tbody>
									<tfooter>
									<tr>
										<td>
											<!-- <button id="sample_editable_1_new" class="btn red" onclick="jsv.typedel();">批量删除 </i></button> -->
										    <!-- <a href="<?php echo site_url('/admin/user/dels');?>?uid=<?php echo $val->user_id;?>"><a> -->
										    <!-- <input type="submit" name="dels" id="dels" value="批量删除" onclick='fun()'/> -->
										</td>
										<td colspan='11' style="text-align:center;" ><?php echo $page;?></td>
									</tr>
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
