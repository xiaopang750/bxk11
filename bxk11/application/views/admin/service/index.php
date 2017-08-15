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

								<a href="#">服务商列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">服务商管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>服务商列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/service/index')?>" method='get'>
										<div class="chat-form">
												模块状态  :
										<select class="header-option m-wrap small" name='module_status'>
											<option value="" <?php if($module_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($module_status == 1) echo "selected";?>>正常显示</option>
											<option value="11" <?php if($module_status == 11) echo "selected";?>>开发中</option>
											<option value="12" <?php if($module_status == 21) echo "selected";?>>不显示</option>
											<option value="13" <?php if($module_status == 12) echo "selected";?>>屏蔽</option>
											<option value="99" <?php if($module_status == 99) echo "selected";?>>删除 </option>
										</select>
										 	模块名称或key:
										<input  type="text"  class="m-wrap span6" name ='key_word' placeholder=" 模块名称或key..." value="<?php echo $key_word;?>">
						
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/service/module_add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_Module();">

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
											<th>模块ID</th>
											<th>模块名称</th>
											
											<th>模块key</th>
											
											<th>模块排序 </th>

											<th>模块状态</th>

											<th>功能</th>

											<th>审核</th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->module_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->module_id;?>">
											</td>
											<td><?php echo $val->module_id;?></td>
											
											<td><?php if(!$val->module_name || empty($val->module_name)) echo "暂无";else echo  cn_substr_utf8($val->module_name,0,10,false);?></td>
								
											<td><?php if(!isset($val->module_key))  echo "0";else if(trim($val->module_key)=="") echo "暂无"; else echo $val->module_key; ?></td>

											<td><?php if(empty($val->module_sort) || is_null($val->module_sort)) echo "暂无";else echo  cn_substr_utf8($val->module_sort,0,20,false);?></td>
						
											<td>
												<?php if($val->module_status == 1){
														echo "正常显示";
													  }elseif($val->module_status ==11){
														echo "开发中";
													  }elseif($val->module_status == 12){
														echo "不显示";
													  }elseif($val->module_status == 13){
														echo "屏蔽";
													  }else{
														echo "删除";
													 }?>
											</td>
											<td><a href="<?php echo site_url('admin/service/action').'?module_id='.$val->module_key;?>">详细功能</a></td>
											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
				
													<ul class="dropdown-menu">

														<?php if($val->module_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->module_id; ?>,'module');"><span class="label label-success">正常显示</span></a></li>
														<?php }?>
														<?php if($val->module_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->module_id;?>,'module');"><span class="label label-danger">开发中</span></a></li>
														<?php }?>
														<?php if($val->module_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->module_id;?>,'module');"><span class="label label-info">不显示</span></a></li>
														<?php }?>
														
														<?php if($val->module_status != 13){?>
														<li><a href="#" onclick="jsv.status('13',<?php echo $val->module_id;?>,'module');"><span class="label-warning">屏蔽</span></a></li>
														<?php }?>

														<?php if($val->module_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->module_id;?>,'module');"><span class="label-warning">删除</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											</td>
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/service/module_edit').'?module_id='.$val->module_id;?>');">Edit</a></td>
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
