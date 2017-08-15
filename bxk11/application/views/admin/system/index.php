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

						<!--<div class="color-panel hidden-phone">

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

						</div>-->

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

								<a href="#">品牌列表</a>

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

								<div class="caption"><i class="icon-edit"></i>品牌列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/product/index')?>" method='get'>
										<div class="chat-form">
										产品类
										<select class="header-option m-wrap small" id='product_add'  onchange="jsv.product_add();">
											<option value="">--请选择--</option>
											<?php foreach ($product_class as $val){?>
													<option  value="<?php echo $val['s_class_id'];?>"><?php echo $val['s_class_name'];?></option>
											<?php }?>
										</select>
									
						
										<select class="header-option m-wrap small" id='pattern_add'  onchange="jsv.pattern_add();jsv.brandshow();">
											<option value="">--请选择--</option>
										
										</select>
										
										<select class="header-option m-wrap small" name='s_c_tag_id' id="s_c_tag_id" onchange="jsv.productshow();">
											<option value="0">--请选择--</option>
										</select>
										品牌系列:
										<select class="header-option m-wrap small" name='brand_id' id="brand_id" onchange="jsv.seriesshow();">
														<option value="0">--请选择--</option>
										</select>
							
										<select class="header-option m-wrap small" name='series_id' id="series_id">
												<option value="0">--请选择--</option>
										</select>
										款式名称:
										<select class="header-option m-wrap small" name='pattern_id' id="pattern_id">
											<option value="0">--请选择--</option>
										</select>
										<br/><br/>
											认证产品状态  :
										<select class="header-option m-wrap small" name='product_status'>
											<option value="" <?php if($product_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($product_status == 1) echo "selected";?>>正常</option>
											<option value="11" <?php if($product_status == 11) echo "selected";?>>屏蔽</option>
											<option value="21" <?php if($product_status == 21) echo "selected";?>>草稿</option>
											<option value="12" <?php if($product_status == 12) echo "selected";?>>申述</option>
											<option value="2" <?php if($product_status == 99) echo "selected";?>>删除</option>
											
										</select>
											关键字:
										<input type="text" name="product_key_word" id="product_key_word" value="<?php echo $key_word;?>">
											编号
										<input type="text" name="code" id="code" value="<?php echo $code;?>">
				
										<br/><br/>
										 	产品名:
										<input  type="text"  class="m-wrap span8" name ='product_name' placeholder=" 标签名..." value="<?php echo $product_name;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/product/pattern_add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_product();">

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
											<th>产品标识</th>
											
											<th>产品名</th>
											
											<th>产品编号 </th>

											<th>参考价格 </th>
											
											<th>推荐度(热度)</th>

											<th>品牌名</th>
											
											<th>系列名</th>
											
											<th>款式名</th> 
											
											<th>推荐热门</th>
											
											<th>推荐首页</th>
											
											<th>状态</th>
											
											<th>审核</th>

											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->product_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->product_id;?>">
											</td>
											<td><?php echo $val->product_id;?></td>
											
											<td><?php if(!$val->product_name || empty($val->product_name)) echo "暂无";else echo  cn_substr_utf8($val->product_name,0,10,false);?></td>
											
											<td>
												<?php echo $val->product_system_code;?>
											</td>

											<td><?php if(!isset($val->product_price))  echo "0";else if(trim($val->product_price)=="") echo "0"; else echo $val->product_price; ?></td>

											<td><?php if(empty($val->product_hot) || is_null($val->product_hot)) echo "暂无";else echo  cn_substr_utf8($val->product_hot,0,20,false);?></td>

											<td><?php if($val->brand_id) echo get_tag_name('t_product_brands_model',$val->brand_id,'brand_name');else echo "暂无";?></td>
											<td><?php if($val->series_id) echo get_tag_name('t_product_brands_series_model',$val->series_id,'series_name');else echo "暂无";?></td>
											<td><?php if($val->pattern_id) echo get_tag_name('t_system_product_pattern_model',$val->pattern_id,'pattern_type');else echo "暂无";?></td>
											
					
											<td>
											<a href="#" onclick="jsv.room_is_hot('<?php if($val->product_is_hot == '' || $val->product_is_hot == 0 ){echo '1';}else{echo 0;}?>','<?php echo $val->product_id;?>','product');">
											<?php if(isset($val->product_is_hot) && $val->product_is_hot == 1){
											echo "取消热门";}else{ echo "推荐热门";}?>
											</a>
											
											<td>
											<a href="#" onclick="jsv.room_is_hot('<?php if($val->product_index == '' || $val->product_index == 0 ){echo '1';}else{echo 0;}?>','<?php echo $val->product_id;?>','product_index');">
											<?php if(isset($val->product_index) && $val->product_index == 1){
											echo "取消首页";}else{ echo "推荐首页";}?>
											</a>
											
											</td>
											<td>
											<?php if($val->product_status == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val->product_status == 11){?>
											<span class="label label-danger">屏蔽</span>
											<?php }elseif($val->product_status == 21){?>
											<span class="label label-info">草稿</span>
											<?php }elseif($val->product_status == 12){?>
											<span class="label label-warning" >申述</span>
											<?php }elseif($val->product_status == 12){?>
											<span class="label label-warning" >删除</span>
											<?php }else{?>
											<span class="label label-warning" >无</span>
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
											
														<?php if($val->product_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->product_id; ?>,'product');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val->product_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->product_id;?>,'product');"><span class="label label-danger">屏蔽</span></a></li>
														<?php }?>
														<?php if($val->product_status != 21){?>
														<li><a href="#" onclick="jsv.status('21',<?php echo $val->product_id;?>,'product');"><span class="label label-info">草稿</span></a></li>
														<?php }?>
														
														<?php if($val->product_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->product_id;?>,'product');"><span class="label-warning">申述</span></a></li>
														<?php }?>
														
														<?php if($val->product_status != 99){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->product_id;?>,'product');"><span class="label-warning">删除</span></a></li>
														<?php }?>
		
													</ul>
							
												</li>
											</ul>
											
											
											</td>
									

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/product/edit').'?product_id='.$val->product_id;?>');">Edit</a><!-- |<a class="delete" href="javascript:jsv.del_product(<?php //echo $val->product_id;?>);">Delete</a> -->|<a class="edit" href="<?php echo site_url('/product/info');?>?pid=<?php echo $val->product_id;?>" target="_Blank">浏览</a></td>

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
