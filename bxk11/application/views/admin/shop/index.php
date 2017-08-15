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

								<a href="#">门店列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">门店管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i><?php if($service_id && !empty($service_id)) echo "(".getBrandByName("t_service_info_model",array('service_id'=>$service_id),"service_name").")";?>门店列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/shop/index')?>" method='get'>
										<div class="chat-form">
											选择地区   :
										<select class="header-option m-wrap small" id="province" onchange="jsv.provincec()" name="province">
											<option value="">-省份-</option>
											<?php if($provincere){foreach ($provincere as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($pxid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
											<?php }}?>
										</select>
										<select  id="city" onchange="jsv.cityr();" name="city">
											<option value="">-城市-</option>
											<?php if($cityre){foreach ($cityre as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($cid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
											<?php }}?>
										</select>
										
										<select id="district" name="district">
											<option value="">-州县-</option>
											<?php if($disre){foreach ($disre as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($did == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
											<?php }}?>
										</select>
												门店状态  :
										<select class="header-option m-wrap small" name='shop_status'>

											<option value="" <?php if($shop_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($shop_status == 1) echo "selected";?>>旗舰店</option>
											<option value="2" <?php if($shop_status == 2) echo "selected";?>>分店</option>
											<option value="3" <?php if($shop_status == 3) echo "selected";?>>未认证</option>
											<option value="4" <?php if($shop_status == 4) echo "selected";?>>参与企业认证</option>
											<option value="12" <?php if($shop_status == 12) echo "selected";?>>停业</option>
											<option value="13" <?php if($shop_status == 13) echo "selected";?>>审核未通过</option>
											<option value="81" <?php if($shop_status == 81) echo "selected";?>>屏蔽 </option>
											<option value="99" <?php if($shop_status == 99) echo "selected";?>>删除</option>
										</select>
										<br/><br/>
											<input type="hidden" value="<?php if($service_id) echo $service_id; ?>" name="service_id">
											服务商:
										<input  type="text"  class="m-wrap span4" name ='service_name' placeholder="服务商..." value="<?php echo $service_name;?>">
										 	门店名:
										<input  type="text"  class="m-wrap span4" name ='key_word' placeholder="门店名..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/shop/add')."?service_id=".$service_id;?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
								<!-- 	<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_product();">

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
											<th>门店标识</th>

											<th>服务商</th>
											
											<th>门店名称</th>
											
											<th>省</th>

											<th>市</th>

										<!-- 	<th>门店操作</th> -->
											
											<th>状态</th>

											<th>审核</th>
											
											<th> 编辑</th>

											<th> 关联品牌</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->shop_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->shop_id;?>">
											</td>
											<td><?php echo $val->shop_id;?></td>
											
											<td><?php if(!$val->service_id || empty($val->service_id)) echo "暂无";else echo getBrandByName("t_service_info_model",array('service_id'=>$val->service_id),"service_name");?></td>
								
											<td><?php if(!$val->shop_name || empty($val->shop_name)) echo "暂无";else echo  cn_substr_utf8($val->shop_name,0,10,false);?></td>
											
											<td><?php if($val->shop_province_code){echo getAraeName($val->shop_province_code);}else{ echo "暂无";}?></td>

											<td><?php if($val->shop_city_code){echo getAraeName($val->shop_city_code);}else{ echo "暂无";}?></td>
					
										<!-- 	<td><a href="<?php //echo site_url('admin/member/service_brands_apply')."?service_id=".$val->service_id;?>">进入</a></td> -->
											
						
											<td>
												<?php if($val->shop_status == 1){
														echo "旗舰店";
													  }elseif($val->shop_status ==2){
														echo "分店";
													  }elseif($val->shop_status == 3){
														echo "未认证";
													  }elseif($val->shop_status == 4){
														echo "参与企业认证";
													  }elseif($val->shop_status == 11){
														echo "审核中";
													  }elseif($val->shop_status == 12){
														echo "停业";
													  }elseif($val->shop_status == 13){
														echo "审核未通过";
													  }elseif($val->shop_status == 81){
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

														<?php if($val->shop_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->shop_id; ?>,'shop');"><span class="label label-success">旗舰店</span></a></li>
														<?php }?>

														<?php if($val->shop_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->shop_id;?>,'shop');"><span class="label label-danger">分店</span></a></li>
														<?php }?>

														<?php if($val->shop_status != 3){?>
														<li><a href="#" onclick="jsv.status('3',<?php echo $val->shop_id;?>,'shop');"><span class="label label-danger">未认证</span></a></li>
														<?php }?>

														<?php if($val->shop_status != 4){?>
														<li><a href="#" onclick="jsv.status('4',<?php echo $val->shop_id;?>,'shop');"><span class="label label-danger">参与企业认证</span></a></li>
														<?php }?>

														<?php if($val->shop_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->shop_id;?>,'shop');"><span class="label label-info">审核中</span></a></li>
														<?php }?>
														
														<?php if($val->shop_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->shop_id;?>,'shop');"><span class="label-warning">停业</span></a></li>
														<?php }?>

														<?php if($val->shop_status != 13){?>
														<li><a href="#" onclick="jsv.status('13',<?php echo $val->shop_id;?>,'shop');"><span class="label-warning">审核未通过</span></a></li>
														<?php }?>
														
														<?php if($val->shop_status != 81){?>
														<li><a href="#" onclick="jsv.status('81',<?php echo $val->shop_id;?>,'shop');"><span class="label-warning">屏蔽</span></a></li>
														<?php }?>
														
														<?php if($val->shop_status != 99){?>
														<li><a href="#" onclick="jsv.status('99',<?php echo $val->shop_id;?>,'shop');"><span class="label-warning">删除</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											</td>
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/shop/edit').'?shop_id='.$val->shop_id;?>');">Edit</a>|<a class="edit" target='_blank' href="<?php echo site_url('admin/shop/readShop').'?shop_id='.$val->shop_id;?>">查看</a></td>
											<td>

												<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/shop/detailed').'?service_id='.$val->service_id.'&shop_id='.$val->shop_id;?>');">未关联</a>
												|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/shop/existing').'?service_id='.$val->service_id.'&shop_id='.$val->shop_id;?>');">己存在</a>
											</td>
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
