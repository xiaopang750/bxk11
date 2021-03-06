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

								<a href="#">服务商列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">服务商管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>服务商列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/member/sedCodeList')?>" method='get'>
										<div class="chat-form">
											选择地区   :
										<select class="header-option m-wrap small" id="province" onchange="jsv.provincec()" name="province">
											<option value="">-省份-</option>
											<?php if($provincere){foreach ($provincere as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($pxid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
											<?php }}?>
										</select>
										<select  class="header-option m-wrap small" id="city" onchange="jsv.cityr();" name="city">
											<option value="">-城市-</option>
											<?php if($cityre){foreach ($cityre as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($cid == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
											<?php }}?>
										</select>
										
										<select  class="header-option m-wrap small" id="district" name="district">
											<option value="">-州县-</option>
											<?php if($disre){foreach ($disre as $val){?>
											<option value="<?php echo $val['district_code']?>" <?php if(($did == $val['district_code']) && $pxid!='') echo "selected";?>><?php echo $val['district_name']?></option>
											<?php }}?>
										</select>
					
										是否发卡:
										<select  class="header-option m-wrap small" id="is_code" name="is_code">
											<option value="0">-请选择-</option>

											<option value="1" <?php if($is_code == 1) echo "selected";?> >未发卡</option>
							
											<option value="2" <?php if($is_code == 2) echo "selected";?> >己发卡</option>
											
										</select>
										 	模糊条件:
										<input  type="text"  class="m-wrap span5" name ='key_word' placeholder=" 服务商或微信昵称..." value="<?php echo $key_word;?>">
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

											<th>标识</th>

											<th>公司名</th>
											
											<th>省</th>

											<th>市</th>

											<th>微信名</th>

											<th>充值卡号</th>

											<th>发放时间</th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->service_id;?>">

											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->service_id;?>">
											</td>
											<td>
												<?php echo $val->service_id;?>
											</td>
								
											<td><?php if(!$val->service_company || empty($val->service_company)) echo "暂无";else echo  cn_substr_utf8($val->service_company,0,100,false);?></td>

											<td><?php if($val->service_province_code){echo getAraeName($val->service_province_code);}else{ echo "暂无";}?></td>

											<td><?php if($val->service_city_code){echo getAraeName($val->service_city_code);}else{ echo "暂无";}?></td>

											<td><?php if(!$val->ss_name || empty($val->ss_name)) echo "暂无";else echo  cn_substr_utf8($val->ss_name,0,100,false);?></td>

											<td><?php if(!$val->rr_card_number || empty($val->rr_card_number)) echo "暂无";else echo  cn_substr_utf8($val->rr_card_number,0,100,false);?></td>

											<td><?php if(!$val->rr_grant_time || empty($val->rr_grant_time)) echo "暂无";else echo  cn_substr_utf8($val->rr_grant_time,0,100,false);?></td>

											<td><?php if($val->rr_card_number) echo "己发放"; else { ?><a class="edit" href="javascript:void(0)" onclick="jsv.status('1',<?php echo $val->service_id; ?>,'code');">发卡</a><?php }?></td>
										</tr>
										<?php }?>
									</tbody>
									<tfooter>
									<tr><td colspan='16' style="text-align:center;" ><?php echo $p;?></td></tr>
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
