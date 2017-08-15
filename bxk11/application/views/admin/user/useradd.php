
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

                <div class="caption"><i class="icon-cogs"></i>添加新用户</div>
                <div class="tools">
                  <a style="color:#000000;font-weight:bold" href="<?php echo site_url('/admin/user/userlist');?>">用户列表</a>
                </div>
              </div>
              <div class="portlet-body">
                <form action="<?php echo site_url('/admin/user/adduser');?>" method="post">
					<table class="table table-hover">

						<thead>
							<tr>
								<th colspan='8'>添加新用户</th>
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
								<td colspan='4'><input type="text" name='emial'></td>
								
							</tr>
							<tr>
									<td colspan='4' style='text-align:right;'  width='20%'><span>昵称:</span></td>
									<td colspan='4'>
										<input type="text" name='yname'>
									</td>
									
							</tr>
							<tr>
								<td colspan='4' style='text-align:right;'><span>密码:</span></td>
								<td colspan='4'>
									<input type="password" name='pwd'>
								</td>
							</tr>

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
