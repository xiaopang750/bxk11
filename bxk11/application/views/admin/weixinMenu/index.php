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
									
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/weixinMenu/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/weixinMenu/doDel')?>');">

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

											<th>菜单名称</th>
											
											<th>菜单说明</th>

											<th>菜单链接地址 </th>
											
											<th>编辑</th>

											<th>删除</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->c_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo cn_substr_utf8($val->c_id,0,10,false);?>">
											</td>
											<td> <?php echo $val->c_id;?></td>

											<td><?php if(!$val->c_name || empty($val->c_name)) echo "暂无";else echo cn_substr_utf8($val->c_name,0,25,false);?></td>
											
											<td><?php if(!$val->c_desc || empty($val->c_desc)) echo "暂无";else echo cn_substr_utf8($val->c_desc,0,25,false);?></td>

											<td><?php if(!$val->c_url || empty($val->c_url)) echo "暂无";else echo $val->c_url;?></td>
						
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/weixinMenu/edit').'?c_id='.$val->c_id;?>');">Edit</a></td>

											<td><a class="delete" href="javascript:jsv.delAll('<?php echo $val->c_id;?>','<?php echo U('admin/weixinMenu/doDel')?>');">Delete</a></td>

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