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

								<div class="caption"><i class="icon-edit"></i><?php echo get_tag_name('t_project_room_model',$room_id,'room_name');?></div>

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
									
										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/room/addProduct').'?room_id='.$room_id;?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_item();">

											DElete </i>

										</button>

									</div>
								</div>
				
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>清单项标识</th>
											<th>产品名</th>
											<th>热点x</th>
											<th>热点y</th>
											<th>热点状态</th>
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_ct<?php echo $val['item_id'];?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val['item_id'];?>">
											</td>
											
											<td><?php echo $val['item_id'];?></td>
											<td><a href='<?php echo site_url('admin/tag/add')."?tag_id=".$val['item_id'];?>'><?php echo $val['poduct_name'];?></a></td>
											<td><?php echo $val['hot_x'];?></td>
											<td><?php echo $val['hot_y'];?></td>
					

											<td>
											<?php if($val['hot_status'] == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val['hot_status'] == 11){?>
											<span class="label label-danger">屏蔽</span>
											<?php }else{?>
											<span class="label label-info">删除</span>
											<?php }?>
											</td>
											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
					
													<ul class="dropdown-menu">
														
														<?php if($val['hot_status'] != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val['item_id']; ?>,'item');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val['hot_status'] != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val['item_id'];?>,'item');"><span class="label label-danger">屏蔽</span></a></li>
														<?php }?>
														<?php if($val['hot_status'] != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val['item_id'];?>,'item');"><span class="label label-info">删除</span></a></li>
														<?php }?>
							

													</ul>
							
												</li>
											</ul>
											</td>
											
											<td><a class="delete" href="<?php echo site_url('admin/room/item_edit').'?item_id='.$val['item_id']?>">编辑</a|--><a class="delete" href="javascript:jsv.del_item(<?php echo $val['item_id'];?>);">删除</a></td>

											
										</tr>
										<?php }?>

	




									</tbody>
									<tfooter>
									<tr><td colspan='8' style="text-align:center;" ></td></tr>
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