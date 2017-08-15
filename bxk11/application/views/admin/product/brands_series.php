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

								<a href="#">品牌系列列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">品牌管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>品牌系列列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/product/brands_series')?>" method='get'>
										<div class="chat-form">
										产品类
										<select class="header-option m-wrap small" id='product_add'  onchange="jsv.product_add();">
											<option value="">--请选择--</option>
											<?php foreach ($product_class as $val){?>
													<option  value="<?php echo $val['s_class_id'];?>"><?php echo $val['s_class_name'];?></option>
											<?php }?>
										</select>
									
						
										<select class="header-option m-wrap small" id='pattern_add' name='s_class_id' onchange="jsv.pattern_add();jsv.brandshow();">
											<option value="">--请选择--</option>
										
										</select>
										
										品牌:
										<select class="header-option m-wrap small" name='brand_id' id="brand_id" onchange="jsv.seriesshow();">
														<option value="0">--请选择--</option>
										</select>
										系列状态  :
										<select class="header-option m-wrap small" name='series_status'>
											<option value="" >--请选择--</option>
											<option value="1" <?php if($series_status == 1) echo "selected";?>>全站所有</option>
											<option value="2"  <?php if($series_status == 2) echo "selected";?>>经销商私有</option>
											<option value="11" <?php if($series_status == 11) echo "selected";?>>审核中</option>
											<option value="81" <?php if($series_status == 81) echo "selected";?>>屏蔽</option>
											<option value="99" <?php if($series_status == 99) echo "selected";?>>删除</option>
									    </select>
										 	系列名:
										<input  type="text"  class="m-wrap span2" name ='series_name' placeholder=" 标签名..." value="<?php echo $series_name;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/product/brands_series_add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_series();">

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
											<th>系列标识</th>
											
											<th>系列名</th>
											
											<th>系列seo关键字 </th>

											<th>系列描述 </th>
											
											<th>品牌</th>

											<th>状态</th>

											<th>审核</th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_ser<?php echo $val->series_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->series_id;?>">
											</td>
											<td><?php echo $val->series_id;?></td>
											
											<td><?php if(!$val->series_name || empty($val->series_name)) echo "暂无";else echo  cn_substr_utf8($val->series_name,0,20,false);?></td>
											
											<td><?php if(!$val->series_seokey || empty($val->series_seokey)) echo "暂无";else echo  cn_substr_utf8($val->series_seokey,0,30,false);?></td>
									
											<td><?php if(!$val->series_seodesc || empty($val->series_seodesc)) echo "暂无";else echo  cn_substr_utf8($val->series_seodesc,0,40,false);?></td>
											


											<td><?php if($val->brand_id) echo get_tag_name('t_product_brands_model',$val->brand_id,'brand_name');else echo "暂无";?></td>
											
											<td>
												<?php if($val->series_status == 1){
														echo "全站所有";
													  }elseif($val->series_status ==2){
														echo "经销商私有";
													  }elseif($val->series_status == 11){
														echo "审核中";
													  }elseif($val->series_status == 81){
														echo "屏蔽";
													  }else{
														echo "删除";
													 }?>
											</td>

											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
				
													<ul class="dropdown-menu">

														<?php if($val->series_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->series_id; ?>,'series');"><span class="label label-success">全站所有</span></a></li>
														<?php }?>
														<?php if($val->series_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->series_id;?>,'series');"><span class="label label-danger">经销商私有</span></a></li>
														<?php }?>
														<?php if($val->series_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->series_id;?>,'series');"><span class="label label-info">审核中</span></a></li>
														<?php }?>
														
														<?php if($val->series_status != 81){?>
														<li><a href="#" onclick="jsv.status('81',<?php echo $val->series_id;?>,'series');"><span class="label-warning">屏蔽</span></a></li>
														<?php }?>

														<?php if($val->series_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->series_id;?>,'series');"><span class="label-warning">删除</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											</td>

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/product/series_edit').'?series_id='.$val->series_id;?>');">Edit</a>|<a class="delete" href="javascript:jsv.del_series(<?php echo $val->series_id;?>);">Delete</a></td>

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
