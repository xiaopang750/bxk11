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

								<a href="#">资讯分类列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">资讯分类管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>资讯分类列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/information/index')?>" method='get'>
										<div class="chat-form">
										<select class="header-option m-wrap small" name='it_type'>

											<option value="" <?php if($it_type == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($it_type == 1) echo "selected";?>>系统 </option>
											<option value="2" <?php if($it_type == 2) echo "selected";?>>服务商自定义</option>

										</select>
										 	分类名称:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder="资讯分类名..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo U('admin/information/add');?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/information/doDel');?>');">

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
											<th>资讯分类标识</th>

											<th>经销商id</th>
											
											<th>分类名称</th>
											
											<th>分类类型</th>
											
											<th> 编辑</th>

										

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->it_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->it_id;?>">
											</td>
											<td><?php echo $val->it_id;?></td>
											
											
													
											<td><?php if($val->service_id == 0) echo "系统方";elseif(!$val->service_id || empty($val->service_id)) echo "暂无"; else echo getBrandByName("t_service_info_model",array('service_id'=>$val->service_id),"service_name");?></td>
										
								
											<td><?php if(!$val->it_name || empty($val->it_name)) echo "暂无";else echo  cn_substr_utf8($val->it_name,0,100,false);?></td>

											<td><?php if($val->it_type == 1) echo "系统"; else echo "服务商自定义";?></td>
										
											
											<td><a class="edit" href="javascript:jsv.go('<?php echo U('admin/information/edit',array('it_id'=>$val->it_id));?>');">Edit</a>|<a class="delete" href="javascript:void(0);" onclick="jsv.delAll(<?php echo $val->it_id?>,'<?php echo U('admin/information/doDel');?>');">Delete</a></td>
											
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
