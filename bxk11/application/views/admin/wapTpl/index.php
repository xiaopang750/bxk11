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

						</div> -->

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

								<a href="#">WAP模版列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">WAP模版管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>WAP模版列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/wapTpl/index')?>" method='get'>
										<div class="chat-form">
												WAP模版状态  :
										<select class="header-option m-wrap small" name='template_type'>

											<option value="" <?php if($template_type == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($template_type == 1) echo "selected";?>>系统模版 </option>
											<option value="2" <?php if($template_type == 2) echo "selected";?>>服务商定制模版</option>

										</select>
										
										 	WAP模版名:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder="WAP模版名..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo U('admin/wapTpl/add');?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
								<!-- 	
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_product();">

										<i>	DELETE </i>

										</button>

									</div> -->
									

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<!-- <th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th> -->
											<th>WAP模版标识</th>

											<th>服务商</th>
											
											<th>WAP模版名称</th>
											

										<!-- 	<th>WAP模版操作</th> -->
											
											<th>状态</th>

											
											
											<th> 操作项</th>

										

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){if($val->template_status == 99){continue;}?>

											

											


											
										<tr id="t_s<?php echo $val->template_id;?>">
											<!-- <td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->template_id;?>">
											</td> -->
											<td><?php echo $val->template_code;?></td>
											
											<td><?php if($val->service_id == 0) echo "系统方";elseif(!$val->service_id || empty($val->service_id)) echo "暂无";else echo getBrandByName("t_service_info_model",array('service_id'=>$val->service_id),"service_name");?></td>
								
											<td><?php if(!$val->template_name || empty($val->template_name)) echo "暂无";else echo  cn_substr_utf8($val->template_name,0,10,false);?></td>
										
											<td>
												<?php if($val->template_status == 1){
														echo "正常开放";
													  }elseif($val->template_status ==2){
														echo "未开放";
													  }elseif($val->template_status == 81){
														echo "屏蔽";
													  }else{
														echo "删除";
													 }?>
											</td>
											
											<td>	
					
													
											<a  href="javascript:jsv.go('<?php echo site_url('admin/wapTpl/dodele').'?status=99&question_id='.$val->template_id;?>');" onclick="return confirm('您确定要删除吗?')">删除</a>|
													
											<a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/wapTpl/edit').'?template_id='.$val->template_id;?>');">Edit</a></td>
											
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
