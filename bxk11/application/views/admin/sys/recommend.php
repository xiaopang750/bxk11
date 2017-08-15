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

							系统设置 <small>系统项设置</small>

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

							<li><a href="#">系统设置</a></li>

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

								<div class="caption"><i class="icon-edit"></i>系统项列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/sys_recommend/index')?>" method='get'>
										<div class="chat-form">
									
										 	设置项:
										<input  type="text"  class="m-wrap span10" name ='sys_key' placeholder=" 设置项..." value="<?php echo $sys_key?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/sys_recommend/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_sys();">

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
											<th>设置项</th>
											
											<th>设置项中文说明</th>

											<th>设置值 </th>

											<th>设置组</th>
											
											<th>编辑</th>

											<th>删除</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_sys<?php echo $val->sys_key;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo cn_substr_utf8($val->sys_key,0,10,false);?>">
											</td>
											<td> <?php echo $val->sys_key;?></td>
											<td><?php if(!$val->sys_key_cn || empty($val->sys_key_cn)) echo "暂无";else echo cn_substr_utf8($val->sys_key_cn,0,25,false);?></td>
											
											<td><?php if(!$val->sys_value || empty($val->sys_value)){ echo "暂无";}else{ if($val->sys_key =='sync') echo "己设置";else echo $val->sys_value;}?></td>
											
											<td>
											<?php if($val->sys_group == '0')echo '第一组';else echo "第二组";?>
											
											</td>

				
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/sys_recommend/add_edit').'?sys_key='.$val->sys_key;?>');">Edit</a></td>

											<td><a class="delete" href="javascript:jsv.del_sys('<?php echo $val->sys_key;?>');">Delete</a></td>

										</tr>
										<?php }?>


									</tbody>
									<tfooter>
									<tr><td colspan='7' style="text-align:center;" ><?php echo $p;?></td></tr>
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