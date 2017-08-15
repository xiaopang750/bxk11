
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

           <!--  <div class="color-panel hidden-phone">

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

                <div class="caption"><i class="icon-cogs"></i>修改用户</div>
                <div class="tools">
                  <a style="color:#000000;font-weight:bold" href="<?php echo site_url('/admin/user/useradd');?>">添加新用户</a>
                  <a style="color:#000000;font-weight:bold" href="<?php echo site_url('/admin/user/userlist');?>">用户列表</a>
                </div>
              </div>
              <div class="portlet-body">
              
              
               <form action="<?php echo site_url('/admin/user/usersup');?>" method="post" >
					<table class="table table-hover">
		
						<thead>
		
							<tr>
		
								
								<th colspan='8'>标签添加</th>
								
		
							</tr>
		
						</thead>
		
						<tbody>
							<tr style="display:none;" id='tag_name'>
								<td colspan='8'>
										<div class="alert alert-error">
											<button class="close" data-dismiss="alert"></button>
											<strong>错误!</strong>
											<span id='tag_error'>The daily cronjob has failed.</span>
										</div>
								
								</td>
							
								
							</tr>
						
							<tr>
								<td colspan='4' style='text-align:right;'  width='20%'><span>邮箱:</span></td>
								<td colspan='4'>
									<input type="text" name="email" value="<?php echo $user_email?>">
								    <input type="hidden" name="id" value="<?php echo $user_id?>">
								 </td>
								
							</tr>
							<tr>
								<td colspan='4' style='text-align:right;'  width='20%'><span>昵称:</span></td>
								<td colspan='4'>
									<input type="text" name="yname" value="<?php echo $user_nickname?>">
								 </td>
								
							</tr>
		<!-- 
							<tr>
									<td colspan='4' style='text-align:right;'  width='20%'><span>密码:</span></td>
									<td colspan='4'>
									<input type="password" name="pwd">
									</td>
									
							</tr> -->
							
			                 <!--  <tr>
			                    <td colspan='4' style='text-align:right;'  width='20%'>用户组ID：</td>
			                    <td colspan='4'>
			                    <select name="group_id">
			                    <option value='1' <?php if($group_id == 1) echo "selected";?>>1级</option>
			                    <option value='2' <?php if($group_id == 2) echo "selected";?>>2级</option>
			                    <option value='21' <?php if($group_id == 21) echo "selected";?>>一级设计师</option>
			                    <option value='22' <?php if($group_id == 22) echo "selected";?>>二级设计师 </option>
			                    <option value='51' <?php if($group_id == 51) echo "selected";?>>1级服务商</option>
			                    <option value='52' <?php if($group_id == 52) echo "selected";?>>2级服务商</option>
			                    
			                    </select>
			                 
			                    </td>
			                  </tr> -->
			             
							<tr>
									<td colspan='4' style='text-align:right;'  width='20%'><span>手机号码:</span></td>
									<td colspan='4'>
									<input type="text" name="phone" value="<?php echo $user_mobile?>">
									</td>
									
							</tr>
							
							<tr>
								<td colspan='4' style='text-align:right;'><span>用户类型:</span></td>
													<td colspan='4'>
													
														<label class="radio">
		   													<input type="radio" value="1" name="type" <?php if($user_type == 1){?> checked="checked" <?php } ?>/>
		   													普通
		
														</label>
		
														<label class="radio">
		 												   <input type="radio" value="2" name="type" <?php if($user_type == 2){?> checked="checked" <?php } ?> />
		 												         明星
		
														</label>  
													
													</td>
			
												</tr>
							<tr>
		
							<td colspan='4' style='text-align:right;'><span>喜欢数:</span></td>
								<td colspan='4'><input type="text" name='likes' size="5" value="<?php echo $user_likes?>"></td>
								
							</tr>
							<tr>
								<td colspan='4' style='text-align:right;'><span>关注数:</span></td>
								<td colspan='4'><input type="text" name='follows' size="5" value="<?php echo $user_follows?>"></td>
							</tr>
							<tr id="zhuti" >
								<td colspan='4' style='text-align:right;'><span>粉丝数:</span></td>
								<td colspan='4'><input type="text" name='fans' size="5" value="<?php echo $user_fans?>"></td>
							</tr>
							<tr>
		
								<td colspan='4' style='text-align:right;'><span>灵感数:</span></td>
								<td colspan='4'><input type="text" name='content' size="5" value="<?php echo $user_contents?>"></td>
								
							</tr>

							<!-- <tr>
		
								<td colspan='4' style='text-align:right;'><span>访客数:</span></td>
								<td colspan='4'><input type="text" name='content' size="5" value="<?php echo $user_views?>"></td>
								
							</tr>

							<tr>
								<td colspan='4' style='text-align:right;'><span>推荐数:</span></td>
								<td colspan='4'><input type="text" name='recommend' size="5" value="<?php echo $user_recommend?>"></td>
							</tr>
							<tr id="zhuti">
								<td colspan='4' style='text-align:right;'><span>讨论数:</span></td>
								<td colspan='4'><input type="text"name='discussion' size="5" value="<?php echo $user_discussions?>"></td>
							</tr>
							
							<tr>
		
								<td colspan='4' style='text-align:right;'><span>任务数:</span></td>
								<td colspan='4'><input type="text" name="tasks" size="5" value="<?php echo $user_tasks?>"></td>
								
							</tr>
							<tr>
								<td colspan='4' style='text-align:right;'><span>用户问题数:</span></td>
								<td colspan='4'><input type="text" name="questions" size="5" value="<?php echo $user_questions?>"></td>
							</tr>
							<tr id="zhuti" >
								<td colspan='4' style='text-align:right;'><span>用户回答数:</span></td>
								<td colspan='4'><input type="text" name="answers" size="5" value="<?php echo $user_answers?>"></td>
							</tr>
							
																	<tr>
		
								<td colspan='4' style='text-align:right;'><span>已完成任务数:</span></td>
								<td colspan='4'><input type="text" name="complete" size="5" value="<?php echo $user_complete?>"></td>
								
							</tr>
							<tr>
								<td colspan='4' style='text-align:right;'><span>分享数:</span></td>
								<td colspan='4'><input type="text" name="share" size="5" value="<?php echo $user_share?>"></td>
							</tr>
							<tr id="zhuti" >
								<td colspan='4' style='text-align:right;'><span>可用积分:</span></td>
								<td colspan='4'><input type="text" name="vailable_score" size="5" value="<?php echo $user_vailable_score?>"></td>
							</tr>
				
		                  	<tr id="zhuti">
								<td colspan='4' style='text-align:right;'><span>累计积分:</span></td>
								<td colspan='4'><input type="text" name="score" size="5" value="<?php echo $user_score?>"></td>
							</tr> -->
							<tr>
								<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
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

    <!-- END PAGE -->
