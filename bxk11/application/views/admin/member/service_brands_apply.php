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

						<div class="color-panel hidden-phone">

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

								<a href="#">经销商经销商品牌列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">经销商品牌管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i><?php if(isset($_GET['service_id']) && $_GET['service_id']) echo "(".get_tag_name('t_service_info_model',$_GET['service_id'],'service_name').")";?>品牌列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/member/service_brands_apply')?>" method='get'>
										<div class="chat-form">
										申请状态  :
										<select class="header-option m-wrap small" name='apply_status'>
											<option value="" <?php if($apply_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($apply_status == 1) echo "selected";?>>已生效</option>
											<option value="11" <?php if($apply_status == 11) echo "selected";?>>审核中</option>
											<option value="12" <?php if($apply_status == 12) echo "selected";?>>已到期</option>
											<option value="13" <?php if($apply_status == 13) echo "selected";?>>审核失败</option>
											<option value="81" <?php if($apply_status == 81) echo "selected";?>>屏蔽</option>
											<option value="99" <?php if($apply_status == 99) echo "selected";?>>删除 </option>
										</select>
										<input type="hidden" name="service_id" value="<?php echo $service_id;?>">
										 	经销商品牌名:
										<input  type="text"  class="m-wrap span6" name ='brand_name' placeholder=" 经销商品牌中文或者英文..." value="<?php echo $brand_name?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/product/brands_add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<!-- <div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_brand();">

										<i>	DELETE </i>

										</button>

									</div>
									 -->

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>品牌申请标识</th>
											
											<th>品牌中文名</th>
											
											<th>品牌英文名</th>

											<th>系列管理</th>

											<th>授权有效开始时间</th>

											<th>授权有效结束时间</th>

											<th>申请状态</th>

											<th>审核</th>

<!-- 											<th>操作</th> -->

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->apply_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->apply_id;?>">
											</td>
											<td><?php echo $val->apply_id;?></td>
											
											<td><?php if(!$val->apply_brand_name || empty($val->apply_brand_name)) echo "暂无";else echo  cn_substr_utf8($val->apply_brand_name,0,20,false);?></td>
									
											<td><?php if(!$val->apply_brand_ename || empty($val->apply_brand_ename)) echo "暂无";else echo  cn_substr_utf8($val->apply_brand_ename,0,20,false);?></td>

											<td>
												<?php if($val->brand_id && $val->apply_status != 11){?>
													<a href="<?php echo site_url('admin/serviceBrSe/series')."?brand_id=".$val->brand_id."&service_id=".$val->service_id;?>" target='_blank'>查看</a>
												<?php }else{ echo "请审核品牌";}?>
											</td>

											<td><?php if(!$val->apply_license_begin || empty($val->apply_license_begin)) echo "暂无";else echo  $val->apply_license_begin;?></td>
											
											<td><?php if(!$val->apply_license_end || empty($val->apply_license_end)) echo "暂无";else echo $val->apply_license_end;?></td>
											<td>
												<?php 
												if($val->apply_status == 1){
													echo "已生效";
												}elseif($val->apply_status == 11){
													echo "审核中";
												}elseif($val->apply_status == 12){
													echo "已到期";
												}elseif($val->apply_status == 13){
													echo "审核失败";
												}elseif($val->apply_status == 81){
													echo "屏蔽";
												}elseif($val->apply_status == 99){
													echo "删除";
												}else{
													echo "暂无";
												}
												?>
											</td>

											<td>
											<?php $results = getBrandByName('t_product_brands_model',array('brand_name'=>$val->apply_brand_name),'brand_name');
								
												if(!$results){
											?>
											<a href="<?php echo site_url('admin/product/brands_add')."?apply_id=".$val->apply_id;?>" target='__blank'>添加品牌后再审核</a>

											<?php if($val->apply_status == 11){?>
											<a href="#" onclick="jsv.status('13',<?php echo $val->apply_id;?>,'apply','<?php echo $val->apply_brand_name;?>');">不通过</a>
											<?php }?>

											<?php
											}else{
											?>

											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
				
													<ul class="dropdown-menu">
														
														<?php if($val->apply_status != 1){?>
			
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->apply_id; ?>,'apply','<?php echo $val->apply_brand_name;?>');"><span class="label label-success">已生效</span></a></li>
														<?php }?>
														<?php if($val->apply_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->apply_id;?>,'apply','<?php echo $val->apply_brand_name;?>');"><span class="label label-danger">审核中</span></a></li>
														<?php }?>
														<?php if($val->apply_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->apply_id;?>,'apply','<?php echo $val->apply_brand_name;?>');"><span class="label label-info">已到期</span></a></li>
														<?php }?>

														<?php if($val->apply_status != 13){?>
														<li><a href="#" onclick="jsv.status('13',<?php echo $val->apply_id;?>,'apply','<?php echo $val->apply_brand_name;?>');"><span class="label label-info">不通过</span></a></li>
														<?php }?>
														
														<?php if($val->apply_status != 81){?>
														<li><a href="#" onclick="jsv.status('81',<?php echo $val->apply_id;?>,'apply','<?php echo $val->apply_brand_name;?>');"><span class="label-warning">屏蔽</span></a></li>
														<?php }?>

														<?php if($val->apply_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->apply_id;?>,'apply','<?php echo $val->apply_brand_name;?>');"><span class="label-warning">删除</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											<?php
											}
											?>
											</td>

											<!-- <td><a class="edit" href="javascript:jsv.go('<?php //echo site_url('admin/product/edit_brand').'?brand_id='.$val->brand_id;?>');">Edit</a></td>

											<td><a class="delete" href="javascript:jsv.del_brand(<?php //echo $val->brand_id;?>);">Delete</a></td> -->

										</tr>
										<?php }?>


									</tbody>
									<tfooter>
									<tr><td colspan='9' style="text-align:center;" ><?php echo $p;?></td></tr>
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