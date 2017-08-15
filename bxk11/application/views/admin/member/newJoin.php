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

								<a href="#">加盟商列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">加盟商管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>加盟商列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/member/newJoin')?>" method='get'>
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
												加盟商状态  :
										<select class="header-option m-wrap small" name='join_status'>
											<option value="" <?php if($join_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($join_status == 1) echo "selected";?>>审核中</option>
											<option value="2" <?php if($join_status == 11) echo "selected";?>>审核成功</option>
											<option value="3" <?php if($join_status == 21) echo "selected";?>>审核失败</option>
											<option value="81" <?php if($join_status == 81) echo "selected";?>>屏蔽 </option>
											<option value="99" <?php if($join_status == 99) echo "selected";?>>删除</option>
										</select>
										<br/><br/>

										 	模糊查找:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder="店铺名称或申请编号或组织机构代码..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/member/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<!-- <div class="btn-group">

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
											<th>加盟商号</th>

											<th>店铺名称</th>
											
											<th>联系电话</th>
											
											<th>联系人名称 </th>

											<th>邀请识别码</th>
											
											<th>省</th>

											<th>市</th>

											<th>机构代码</th>

											<th>申请时间</th>
											
											<th>状态</th>

											<th>审核</th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->join_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->join_id;?>">
											</td>
											<td><?php echo $val->join_id;?></td>
											
											<td><?php if(!$val->join_name || empty($val->join_name)) echo "暂无";else echo  cn_substr_utf8($val->join_name,0,10,false);?></td>
								
											<td><?php if(!isset($val->join_phone))  echo "0";else if(trim($val->join_phone)=="") echo "暂无"; else echo $val->join_phone; ?></td>

											<td><?php if(empty($val->join_person) || is_null($val->join_person)) echo "暂无";else echo  cn_substr_utf8($val->join_person,0,20,false);?></td>
											<td><?php echo $val->join_code;?></td>
											
											<td><?php if($val->join_province_code && is_numeric($val->join_province_code)){echo getAraeName($val->join_province_code);}else{ echo "暂无";}?></td>

											<td><?php if($val->join_city_code && is_numeric($val->join_city_code)){echo getAraeName($val->join_city_code);}else{ echo "暂无";}?></td>
				
											
											<td><?php echo $val->join_code;?></td>
											
											<td><?php echo $val->join_addtime;?></td>

											<td>
												<?php if($val->join_status == 1){
														echo "已认证";
													  }elseif($val->join_status == 2){
														echo " 未提交认证";
													  }elseif($val->join_status == 3){
														echo "认证失败";
													  }else{
														echo "审核中";
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
																
														<?php if($val->join_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->join_id; ?>,'newjoin');"><span class="label label-success">认证</span></a></li>
														<?php }?>

														<?php if($val->join_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->join_id;?>,'newjoin');"><span class="label label-danger">未提交认证</span></a></li>
														<?php }?>

														<?php if($val->join_status != 3){?>
														<li><a href="#" onclick="jsv.status('3',<?php echo $val->join_id;?>,'newjoin');"><span class="label label-info">认证失败</span></a></li>
														<?php }?>

														<?php if($val->join_status != 4){?>
														<li><a href="#" onclick="jsv.status('4',<?php echo $val->join_id;?>,'newjoin');"><span class="label-warning">审核中</span></a></li>
														<?php }?>
													</ul>
							
												</li>
											</ul>
											</td>
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/member/readJoin').'?join_id='.$val->join_id;?>');">查看</a></td>
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
