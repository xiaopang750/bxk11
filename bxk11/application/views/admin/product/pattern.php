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

								<div class="caption"><i class="icon-edit"></i>款式列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/product/pattern')?>" method='get'>
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
										
										<select class="header-option m-wrap small" name='s_c_tag_id' id="s_c_tag_id" onchange="jsv.productshow();">
											<option value="0">--请选择--</option>
										</select>
										 	产品名:
										<input  type="text"  class="m-wrap span4" name ='pattern_type' placeholder=" 标签名..." value="<?php echo $pattern_type;?>">
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

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_pattern();">

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
											
											<th>排序 </th>

											<th>款式描述 </th>
											
											<th>所属分类 </th>
											<th>所属标签 </th>
											
											<th>操作</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_pat<?php echo $val->pattern_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->pattern_id;?>">
											</td>
											<td><?php echo $val->pattern_id;?></td>
											
											<td><?php if(!$val->pattern_type || empty($val->pattern_type)) echo "暂无";else echo  cn_substr_utf8($val->pattern_type,0,10,false);?></td>
											
											<td>
												<?php echo $val->pattern_sort;?>
											</td>
											
											<td><?php if(!$val->pattern_seodesc || empty($val->pattern_seodesc)) echo "暂无";else echo  cn_substr_utf8($val->pattern_seodesc,0,30,false);?></td>
											

											<td><?php if(!isset($val->s_c_tag_id))  echo "无分类";else if(trim($val->s_c_tag_id)=="") echo "无分类"; else echo get_tag_name('t_system_class_model',get_tag_name('t_s_class_tag_model',$val->s_c_tag_id,'s_class_id'),'s_class_name'); ?></td>

											<td><?php if(!isset($val->s_c_tag_id))  echo "无标签";else if(trim($val->s_c_tag_id)=="") echo "无标签"; else echo get_tag_name('t_tag_model',get_tag_name('t_s_class_tag_model',$val->s_c_tag_id,'s_tag_id'),'tag_name'); ?></td>
											
											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/product/pattern_edit').'?pattern_id='.$val->pattern_id;?>');">Edit</a>|<a class="delete" href="javascript:jsv.del_pattern(<?php echo $val->pattern_id;?>);">Delete</a></td>

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
