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
									<form class="form-search" action="<?php echo site_url('admin/product/pack')?>" method='get'>
										<div class="chat-form">
										经消商：
										<select id="pattern_id" class="header-option m-wrap small" name="goods_id">
										<?php if($service){
											foreach ($service as $val){
										?>
										<option value="<?php echo $val['service_id'];?>" <?php if($goods_id && $goods_id == $val['service_id'])echo "selected";?>><?php echo $val['service_name'];?></option>
										<?php }}?>
										</select>
									
						
									
										 	套餐名称:
										<input  type="text"  class="m-wrap span4" name ='pack_name' placeholder=" 标签名..." value="<?php echo $series_name;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/product/packAdd')?>'">

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
											
											<th>套餐名称</th>
											
											<th>经销商 </th>

											
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_ser<?php echo $val->pack_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->pack_id;?>">
											</td>
											<td><?php echo $val->pack_id;?></td>
											
											<td><?php if(!$val->pack_name || empty($val->pack_name)) echo "暂无";else echo  "<a href=''>".cn_substr_utf8($val->pack_name,0,20,false)."</a>";?></td>
											

											<td><?php if($val->goods_id) echo get_tag_name('t_service_info_model',$val->goods_id,'service_name');else echo "暂无";?></td>
											

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/product/pack_edit').'?pack_id='.$val->pack_id;?>');">Edit</a>|<a class="delete" href="javascript:jsv.del_pack(<?php echo $val->pack_id;?>);">Delete</a>|<a class="delete" href="javascript:jsv.go('<?php echo site_url('admin/product/packitemAdd').'?goods_id='.$val->goods_id.'&pack_id='.$val->pack_id;?>');">添加套餐</a></td>

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
