
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

						<!-- <div class="color-panel hidden-phone">

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
								 <a style="color:#000000;font-weight:bold" href="<?php echo site_url('/admin/user/userlist');?>">用户列表</a>
							</div>
							<div class="row-fluid search-forms search-default">
								<form action="./feeds_list" method="get" name="">
									<div class="chat-form">
										时间段：
										<div class="input-append">
											<input type="text" name="starttime" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'" value="<?php if($starttime)echo $starttime; ?>"/>
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										--
										<div class="input-append">
											<input type="text" name="stoptime" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'" value="<?php if($stoptime)echo $stoptime; ?>"/>
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										 类型：
									<select name="type" >
                                    	<option value="" <?php if($types  == '') echo "selected";?>>请选择类型</option>
                                       <!--  <option value="1" <?php //if($type  == 1) echo "selected";?>>博文</option>
                                        <option value="2" <?php //if($type  == 2) echo "selected";?>>问答</option>
                                        <option value="3" <?php //if($type  == 3) echo "selected";?>>积分</option>
                                        <option value="4" <?php //if($type  == 4) echo "selected";?>>用户设置类</option>
                                        <option value="11" <?php //if($type  == 11) echo "selected";?>>用户登录</option>
                                        <option value="21" <?php //if($type  == 21) echo "selected";?>>找回密码</option> -->
                                        <?php foreach($feed as $key=>$val):?>
                                        	<option value="<?php echo $key;?>" <?php if($types == $key) echo "selected";?>><?php echo $val;?></option>
                                        <?php endforeach;?>
                                    </select>
                                     <br><br>
                                    <input type='hidden' name='uid' value="<?php echo $uid;?>" />
                                    <!-- <input type='hidden' name='uid' value="<?php echo $uid;?>" /> -->
                                    <input type='hidden' name='email' value="<?php echo $email;?>" />
                                    <!-- <input type='hidden' name='type' value="<?php echo $type;?>" /> -->
											内容:
									<input  type="text"  class="m-wrap span10" name ='content' placeholder="内容..." value="<?php if($content)echo $content; ?>">
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
											<th>用户邮箱</th>
											<th>详细内容</th>
											<th>时间</th>
											<!-- <th>查看详细</th> -->
										</tr>

									</thead>

									<tbody>

										<?php foreach($list as $val):?>
										<tr>

											<td><?php echo $email;?></td>
											<td><?php echo $val->feed_content;?></td>
											<td><?php echo $val->feed_time;?></td>
											<!-- <td>
												<ul class="nav">
												<li class="dropdown user">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<span class="username">用户动态</span><i class="icon-angle-down"></i>
													</a>
													<ul class="dropdown-menu">
                                                    	<li><a href="<?php echo site_url('/admin/user/show_feed');?>?uid=<?php echo $val->user_id;?>&type=1"><span class="label label-success">博文</span></a></li>
                                                        <li><a href="<?php echo site_url('/admin/user/show_feed');?>?uid=<?php echo $val->user_id;?>&type=2"><span class="label label-success">问答</span></a></li>
                                                        <li><a href="<?php echo site_url('/admin/user/show_feed');?>?uid=<?php echo $val->user_id;?>&type=3"><span class="label label-success">积分</span></a></li>
                                                        <li><a href="<?php echo site_url('/admin/user/show_feed');?>?uid=<?php echo $val->user_id;?>&type=4"><span class="label label-success">用户设置类</span></a></li>
                                                        <li><a href="<?php echo site_url('/admin/user/show_feed');?>?uid=<?php echo $val->user_id;?>&type=11"><span class="label label-success">用户登录</span></a></li>
                                                        <li><a href="<?php echo site_url('/admin/user/show_feed');?>?uid=<?php echo $val->user_id;?>&type=21"><span class="label label-success">找回密码</span></a></li>
                                                    </ul>
												</li>
												</ul>
											</td> -->
										</tr>
										<?php endforeach;?>
									</tbody>
									<tfooter>
									<tr><td colspan='8' style="text-align:center;" ><?php echo $page;?></td></tr>
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
