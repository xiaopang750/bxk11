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

								<a href="#">品牌列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">品牌管理</a></li>

						</ul>

						<?php if(isset($tags) && $tags == 1){?>
						<ul class="breadcrumb" >
							<li>
								<a href="#">第一步：添加经销商</a> 
								<i class="icon-angle-right"></i>

							</li>

							<li >

								<a href="#">第二步：添加品牌</a>

								<i class="icon-angle-right"></i>

							</li>

							<li style="background-color: red;line-height:20px; text-align:center;">

								<a href="#">第二步：关联品牌</a>

								<i class="icon-angle-right"></i>

							</li>

							<li>
								
								<a href="#">第三步：添加门店</a>
								<i class="icon-angle-right"></i>
							</li>

							<li>
								
								<a href="#">第四步：添加子账号</a>
							</li>

						</ul>
						<?php }?>


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
									<form class="form-search" action="<?php echo site_url('admin/member/service_brands_apply_system')?>" method='get'>
										<div class="chat-form">
												
										 	品牌名:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder=" 标签名..." value="<?php echo $key_word?>">
										<input type='hidden' value="<?php  echo $service_id;?>" name="service_id">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

							
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="jsv.join_brand('',<?php echo $service_id?>);">

										<i>	添加品牌关联 </i>

										</button>

									</div>
									<?php if(isset($tags) && $tags == 1){?>
										
										<div class="btn-group">

											<button id="sample_editable_1_new" class="btn red" onclick="window.location.href='<?php echo site_url("admin/product/brands_add")."?service_id=".$service_id;?>'">

											<i>	上一步 </i>

											</button>

										</div>

										<div class="btn-group">

											<button id="sample_editable_1_new" class="btn red" onclick="window.location.href='<?php echo site_url("admin/shop/add")."?service_id=".$service_id."&tags=1";?>'">

											<i>	下一步 </i>

											</button>

										</div>

								  <?php }?>

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>品牌标识</th>
											
											<th>品牌名</th>
											
											<th>品牌商品数</th>

											<th>品牌官网</th>

											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->brand_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->brand_id;?>">
											</td>
											<td><?php echo $val->brand_id;?></td>
											
											<td><?php if(!$val->brand_name || empty($val->brand_name)) echo "暂无";else echo  cn_substr_utf8($val->brand_name,0,20,false);?></td>
											
						

											<td><?php if(isset($val->brand_products))  echo $val->brand_products;else if(trim($val->brand_products)=="") echo "0"; else echo $val->brand_products; ?></td>

										

											<td><?php if(empty($val->brand_url) || is_null($val->brand_url)) echo "暂无";else echo  cn_substr_utf8($val->brand_url,0,20,false);?></td>


											<td><a class="delete" href="javascript:jsv.join_brand(<?php echo $val->brand_id;?>,<?php echo $service_id?>);">关联</a></td>

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