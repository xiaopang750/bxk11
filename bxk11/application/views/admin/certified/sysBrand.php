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

								<div class="caption"><i class="icon-edit"></i>认证品牌列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/certified/sysBrand');?>" method='get'>
										<div class="chat-form">
											<input type='hidden' value='<?php echo $brand_id;?>' name='brand_id'>
										 	模糊条件:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder=" 申请品牌中文名或英文名..." value="<?php echo $key_word;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/certified/addSysBrand')."?brand_id=".$brand_id;?>'">

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

											<th>中文名称</th>

											<th>英文名称</th>
											
											<th>品牌官网</th>

											<th>品牌关键字</th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->c_brand_id;?>">

											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->c_brand_id;?>">
											</td>
											<td>
												<?php echo $val->c_brand_id;?>
											</td>
											<td><?php if(!$val->c_brand_name || empty($val->c_brand_name)) echo "暂无";else echo  cn_substr_utf8($val->c_brand_name,0,20,false);?></td>
											<td><?php if(!$val->c_brand_ename || empty($val->c_brand_ename)) echo "暂无";else echo  cn_substr_utf8($val->c_brand_ename,0,20,false);?></td>

											<td><?php if(!$val->c_brand_website || empty($val->c_brand_website)) echo "暂无";else echo  $val->c_brand_website;?></td>
											<td><?php if(!$val->c_brand_keywords || empty($val->c_brand_keywords)) echo "暂无";else echo  cn_substr_utf8($val->c_brand_keywords,0,20,false);?></td>

											<td>
												<a href="<?php echo site_url('admin/member/doCertifiedBrand')."?c_brand_id=".$val->c_brand_id."&brand_id=".$brand_id;?>">关联</a>
						
												
											</td>
											
											
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/certified/editCertifiedBrand').'?c_brand_id='.$val->c_brand_id."&brand_id=".$brand_id;?>');">Edit</a></td>
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
