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
									<form class="form-search" action="<?php echo site_url('admin/serviceProduct/index')?>" method='get'>
										<div class="chat-form">
										产品类
										<select class="header-option m-wrap small" id='product_add' name="product_add" onchange="jsv.product_add();">
											<option value="">--请选择--</option>
											<?php foreach ($product_class as $val){?>
													<option  value="<?php echo $val['s_class_id'];?>" <?php if(isset($product_add) && $product_add && $product_add == $val['s_class_id']) echo "selected";?>><?php echo $val['s_class_name'];?></option>
											<?php }?>
										</select>
									
						
										<select class="header-option m-wrap small" id='pattern_add' name="s_class_id" onchange="jsv.pattern_add();jsv.brandshow();">
											<option value="">--请选择--</option>
											<?php if(isset($system_class) && $system_class){foreach ($system_class as $key => $value) {?>
												<option value="<?php echo $value['s_class_id'];?>" <?php if($s_class_id && $value['s_class_id']==$s_class_id) echo "selected";?> ><?php echo $value['s_class_name'];?></option>
											<?php }}?>
										</select>
										
						
											经销商产品状态 :
										<select class="header-option m-wrap small" name='goods_status'>
											<option value="" <?php if($goods_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($goods_status == 1) echo "selected";?>>正常</option>
											<option value="11" <?php if($goods_status == 11) echo "selected";?>>屏蔽</option>
											<option value="21" <?php if($goods_status == 21) echo "selected";?>>草稿</option>
											<option value="12" <?php if($goods_status == 12) echo "selected";?>>申述</option>
											<option value="22" <?php if($goods_status == 22) echo "selected";?>>下架</option>
											<option value="99" <?php if($goods_status == 99) echo "selected";?>>删除</option>
											
										</select>
											产品名或商品编号:
										<input type="text" name="goodsCodeT" id="goodsCodeT" value="<?php echo $goodsCodeT;?>">
										<br/><br/>
											服务商名:
										<input type="text" name="service_name" id="service_name" value="<?php echo $service_name;?>">
								
										 	关键词:
										<input  type="text"  class="m-wrap span6" name ='key_word' placeholder=" 品牌名或系列名..." value="<?php echo $key_word;?>">
										<input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/serviceProduct/add')."?service_id=".$service_id?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<!-- <div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_goods();">

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
											<th>产品标识</th>
											
											<th>产品名</th>
											
											<th>产品编号 </th>

											<th>售价 </th>

											<th>服务商名</th>

											<th>品类名</th>
				
											<th>品牌名</th>
											
											<th>系列名</th>
											
											<th>状态</th>
											
											<th>审核</th>

											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->goods_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->goods_id;?>">
											</td>
											<td><?php echo $val->goods_id;?></td>
											
											<td><?php if(!$val->goods_title || empty($val->goods_title)) echo "暂无";else echo  cn_substr_utf8($val->goods_title,0,10,false);?></td>
											
											<td>
												<?php echo $val->goods_code;?>
											</td>

											<td><?php if(!isset($val->goods_price))  echo "0";else if(trim($val->goods_price)=="") echo "0"; else echo $val->goods_price; ?></td>

											<td><?php if($val->service_id) echo get_tag_name('t_service_info_model',$val->service_id,'service_name');else echo "暂无";?></td>

											<td><?php if($val->s_class_id) echo get_tag_name('t_system_class_model',$val->s_class_id,'s_class_name');else echo "暂无";?></td>

											<td><?php if($val->brand_id) echo get_tag_name('t_product_brands_model',$val->brand_id,'brand_name');else echo "暂无";?></td>
											
											<td><?php if($val->series_id) echo get_tag_name('t_product_brands_series_model',$val->series_id,'series_name');else echo "暂无";?></td>
											
											<td>
											<?php if($val->goods_status == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val->goods_status == 11){?>
											<span class="label label-danger">屏蔽</span>
											<?php }elseif($val->goods_status == 21){?>
											<span class="label label-info">草稿</span>
											<?php }elseif($val->goods_status == 12){?>
											<span class="label label-warning" >申述</span>
											<?php }elseif($val->goods_status == 22){?>
											<span class="label label-warning" >下架</span>
											<?php }elseif($val->goods_status == 99){?>
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
											
														<?php if($val->goods_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->goods_id; ?>,'goods');"><span class="label label-success">正常</span></a></li>
														<?php }?>

														<?php if($val->goods_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->goods_id;?>,'goods');"><span class="label label-danger">屏蔽</span></a></li>
														<?php }?>

														<?php if($val->goods_status != 21){?>
														<li><a href="#" onclick="jsv.status('21',<?php echo $val->goods_id;?>,'goods');"><span class="label label-info">草稿</span></a></li>
														<?php }?>

														<?php if($val->goods_status != 22){?>
														<li><a href="#" onclick="jsv.status('22',<?php echo $val->goods_id;?>,'goods');"><span class="label label-info"> 下架</span></a></li>
														<?php }?>
														
														<?php if($val->goods_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->goods_id;?>,'goods');"><span class="label-warning">申述</span></a></li>
														<?php }?>
														
														<?php if($val->goods_status != 99){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->goods_id;?>,'goods');"><span class="label-warning">删除</span></a></li>
														<?php }?>
		
													</ul>
							
												</li>
											</ul>
											
											
											</td>
									

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/serviceProduct/edit').'?goods_id='.$val->goods_id;?>');">Edit</a><!-- |<a class="delete" href="javascript:jsv.del_product(<?php //echo $val->product_id;?>);">Delete</a> --><!-- |<a class="edit" href="<?php echo site_url('/product/info');?>?pid=<?php echo $val->product_id;?>" target="_Blank">浏览</a> --></td>

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
