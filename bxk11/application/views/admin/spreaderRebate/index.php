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

							推广返利设置 <small>推广返利项设置</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">管理中心</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">推广返利设置</a></li>

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

								<div class="caption"><i class="icon-edit"></i>推广返利项列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/spreaderRebate/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/spreaderRebate/doDel')?>');">

											DELETE </i>

										</button>

									</div>
									

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>

											<th>标识</th>

											<th>返利类型</th>
											
											<th>返利单位</th>

											<th>返利数量 </th>

											<th>开放状态 </th>

											<th>推广类型 </th>
											
											<th>编辑</th>

											<th>删除</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->sr_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->sr_id;?>">
											</td>
											<td> <?php echo $val->sr_id;?></td>

											<td><?php if(!$val->sr_type || empty($val->sr_type)) echo "暂无";else echo cn_substr_utf8($val->sr_type,0,100,false);?></td>
											
											<td><?php if(!$val->sr_unit || empty($val->sr_unit)) echo "0"; else echo $val->sr_unit;?></td>

											<td><?php if(!$val->sr_amount || empty($val->sr_amount)) echo "暂无";else echo $val->sr_amount;?></td>

											<td><?php if($val->sr_status == 1){echo "开放";}else{echo "关闭";}?></td>

											<td><?php if($val->ss_type == 1){echo "微信";}else{echo "商户";}?></td>
						
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/spreaderRebate/edit').'?sr_id='.$val->sr_id;?>');">Edit</a></td>

											<td><a class="delete" href="javascript:jsv.delAll('<?php echo $val->sr_id;?>','<?php echo U('admin/spreaderRebate/doDel')?>');">Delete</a></td>

										</tr>
										<?php }?>


									</tbody>
									<tfooter>
								
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