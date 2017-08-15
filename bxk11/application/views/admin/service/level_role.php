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

								<a href="#">商务级别列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">商务级别管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>商务级别列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/service/level_role')?>" method='get'>
										<div class="chat-form">
										服务商类型
										<select class="header-option m-wrap small" id='service_type' name="service_type">
											<option value="">--请选择--</option>
											<?php foreach ($service_type as $val){?>
													<option  value="<?php echo $val->service_type_id;?>" <?php if($val->service_type_id == $service_type_id) echo "selected";?>><?php echo $val->service_type;?></option>
											<?php }?>
										</select>
										 	关键词:
										<input  type="text"  class="m-wrap span6" name ='key_word' placeholder="级别名称..." value="<?php echo $key_word;?>">
										
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo U('admin/service/role_add');?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/service/doDel')?>');">

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
											<th>级别标识</th>
											
											<th>级别名称 </th>

											<th>服务商类型</th>

											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->la_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->la_id;?>">
											</td>
											<td><?php echo $val->la_rank;?></td>
											
											<td><?php if(!$val->la_name || empty($val->la_name)) echo "暂无";else echo  cn_substr_utf8($val->la_name,0,100,false);?></td>
						
											
											<td>
											<?php foreach ($service_type as $valS){?>
													<?php if($valS->service_type_id == $val->service_type_id) echo $valS->service_type;?>
											<?php }?>
											</td>
											
									

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/service/role_edit').'?la_id='.$val->la_id;?>');">Edit</a>|<a class="delete" href="javascript:jsv.delAll(<?php echo $val->la_id;?>,'<?php echo U('admin/service/doDel')?>');">Delete</a>|<a href="javascript:jsv.go('<?php echo site_url('admin/service/role_list').'?la_id='.$val->la_id;?>');">权限授权</a></td>

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
