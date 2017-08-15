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

								<a href="#">推广服务</a>

						

							</li>

							

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

								<div class="caption"><i class="icon-edit"></i>推广联盟</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/extension/alliance')?>" method='get'>
										<div class="chat-form">
										推广者称呼：
										<input type="text" name="ss_name" id="goodsCodeT">											
										推广者标识：
										<input type="text" name="spreader_code" id="goodsCodeT">										
										推广者手机号:
										<input type="text" name="ss_phone" id="service_name">		
										<br/>
										时  间 :
										<input class="text" type="text" onblur="this.className='text'" onfocus="this.className='text2';rcalendar(this);" size="16" value="" name="rr_grant_time1">-<input class="text" type="text" onblur="this.className='text'" onfocus="this.className='text2';rcalendar(this);" size="16" value="" name="rr_grant_time2">
										<input type="hidden" name="yincang" value="888">
										<button class="btn green" type="submit">
										查询
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

							</div>
					
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											
											<th>推广者称呼</th>
											
											<th>推广者手机号</th>

											<th>推广者加入联盟时间</th>
											
											<th>根据推广者标识 </th>

											<th>推广者状态 </th>

											<th>推广类型</th>	
											
											<th>操作项	</th>

										</tr>

									</thead>

									<tbody>

									
										<?php
											//print_r($reg);
										foreach ($reg as $val){ $val=(array)$val;?>

										<tr id="<?php echo $val['ss_id']?>">
											<td><?php echo $val['ss_name']?></td>
											<td><?php echo $val['ss_phone']?></td>										
											<td><?php echo $val['ss_join_time']?></td>
											<td><?php echo $val['spreader_code']?></td>
											<td><?php if($val['ss_status']=="1") echo "正常";else echo "屏蔽"; ?></td>	
											<td><?php if($val['ss_type']=="1") echo "微信";else echo "服务商";?></td>
											<td><a href="<?php echo 'alliance_s?sid='.$val['ss_id'].'&nep=1'?>">正常</a>|<a href="<?php echo 'alliance_s?sid='.$val['ss_id'].'&nep=2'?>">屏蔽</a></td>	
										</tr>
										<?php }?>


									</tbody>
									<tfooter>
									<tr>
										<td>
											<!-- <button id="sample_editable_1_new" class="btn red" onclick="jsv.typedel();">批量删除 </i></button> -->
										    <!-- <a href="<?php echo site_url('/admin/user/dels');?>?uid=<?php echo $val->user_id;?>"><a> -->
										    <!-- <input type="submit" name="dels" id="dels" value="批量删除" onclick='fun()'/> -->
										</td>
										<td colspan='11' style="text-align:center;" ><?php echo $this->pagination->create_links(); ?></td>
									</tr>
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
