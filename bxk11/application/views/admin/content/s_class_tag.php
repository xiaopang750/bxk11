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

								<a href="#">关联列表</a>

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

								<div class="caption"><i class="icon-edit"></i><?php echo get_tag_name('t_system_class_model',$s_class_id,'s_class_name');?></div>

								<div class="tools">
								
									<a href="javascript:;" class="red"><?php echo $num;?></a>

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">
									
										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/tag/tag_add_type').'?p_id='.$s_class_id;?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_s();">

											Cancel </i>

										</button>

									</div>
								</div>
				
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>关联标识</th>
											
											<th>标签名</th>

											<th>取消关联</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_ct<?php echo $val['s_c_tag_id'];?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val['s_c_tag_id'];?>">
											</td>
											
											<td><?php echo $val['s_c_tag_id'];?></td>
											<td><a href='<?php echo site_url('admin/tag/add')."?tag_id=".$val['s_tag_id'];?>'><?php echo get_tag_name('t_tag_model',$val['s_tag_id'],'tag_name');?></a></td>
											<td><a class="delete" href="javascript:jsv.del_s(<?php echo $val['s_c_tag_id'];?>);">Cancel</a></td>

											
										</tr>
										<?php }?>

	




									</tbody>
									<tfooter>
									<tr><td colspan='4' style="text-align:center;" ><?php echo $p;?></td></tr>
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