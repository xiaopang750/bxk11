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
 -->
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

								<a href="#">标签列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">标签管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>分类列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:jsv.areaadd();">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delarea();">

											DELETE </i>

										</button>

									</div>
								</div>
								

							<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/area/index')?>" method='post'>
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
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>地区名</th>
					
											<th>邮编</th>
											<th>编辑</th>

											<th>删除</th>


										</tr>

									</thead>

									<tbody>

									<?php if($re){foreach ($re as $val){?>
												<tr id="area_<?php echo $val['district_id']?>">
													<td>
														<input  type="checkbox" name='newsletter' value="<?php echo $val['district_id']?>">
													</td>
													<td id="district_name_<?php echo $val['district_id']?>">
														<?php echo $val['district_name']?>
													</td>
													<td>
														<?php echo $val['district_code']?>
													</td>
		
				
													<td><a class="edit" href="javascript:jsv.editName('<?php echo $val['district_id']?>','<?php echo $val['district_name']?>')">Edit</a></td>
													
													<td><a class="delete" href="javascript:jsv.delarea(<?php echo $val['district_id'];?>);">Delete</a></td>
		
												</tr>
										
										<?php }}?>
							
										



									</tbody>
									<tfooter>
									<tr><td colspan='12' style="text-align:center;" ></td></tr>
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