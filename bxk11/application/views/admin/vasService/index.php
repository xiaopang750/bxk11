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

					<!-- 	<div class="color-panel hidden-phone">

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

						</div> -->

						<!-- END BEGIN STYLE CUSTOMIZER -->  

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							系统设置 <small>增值服务设置</small>

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

								<div class="caption"><i class="icon-edit"></i>增值服务列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/vasService/index')?>" method='get'>
										<div class="chat-form">
											服务状态:
										<select class="header-option m-wrap small" name='vas_status'>
											<option value="" <?php if($vas_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($vas_status == 1) echo "selected";?>>正常</option>
											<option value="2" <?php if($vas_status == 2) echo "selected";?>>无效</option>
											<option value="98" <?php if($vas_status == 98) echo "selected";?>>屏蔽 </option>
											<option value="99" <?php if($vas_status == 99) echo "selected";?>>删除</option>
										</select>
										
										 	模糊条件:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder="服务名称..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/vasService/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/vasService/doDel');?>');">

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
											
											<th>购买价格</th>

											<th>单位 </th>

											<th>服务状态 </th>

											<th>服务详情 </th>

											<th>显示排序 </th>
											
											<th>编辑</th>

											<th>删除</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->vas_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo cn_substr_utf8($val->vas_id,0,10,false);?>">
											</td>
											<td> <?php echo $val->vas_id;?></td>

											<td><?php if(!$val->vas_name || empty($val->vas_name)) echo "暂无";else echo cn_substr_utf8($val->vas_name,0,25,false);?></td>
											
											<td><?php if(!$val->vas_price || empty($val->vas_price)) echo "暂无";else echo cn_substr_utf8($val->vas_price,0,25,false);?></td>

											<td><?php if(!$val->vas_unit || empty($val->vas_unit)) echo "暂无";else echo $val->vas_unit;?></td>

											<td><?php if(!$val->vas_status || empty($val->vas_status)) echo "暂无";else echo $val->statusname;?></td>

											<td><?php if(!$val->vas_content || empty($val->vas_content)) echo "暂无";else echo cn_substr_utf8($val->vas_content,0,25,false);?></td>

											<td><?php if(!$val->vas_sort || empty($val->vas_sort)) echo "暂无";else echo $val->vas_sort;?></td>
						
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/vasService/edit').'?vas_id='.$val->vas_id;?>');">Edit</a></td>

											<td><a class="delete" href="javascript:jsv.delAll('<?php echo $val->vas_id;?>','<?php echo U('admin/vasService/doDel');?>');">Delete</a></td>

										</tr>
										<?php }?>


									</tbody>
									<tfooter>
										<tr><td colspan='10' style="text-align:center;" ><?php echo $p;?></td></tr>
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