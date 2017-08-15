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

								<a href="#">标签列表</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">标签管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>分类列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/type/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.typedel();">

											DELETE </i>

										</button>

									</div>
								</div>
								

				
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>系统分类标识</th>
											
											<th>系统分类名</th>

											<th>频道 </th>
											
											<th>系统分类描述</th>

											<th>分类排序</th>
											
											<th>是否前台显示</th>
											
											<th>分类选择方式</th>
											
											<th>编辑</th>

											<th>删除</th>
											
											<th>关联标签</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
											<?php if($val->s_class_pid == 0){?>
												<tr id="t_t<?php echo $val->s_class_id;?>">
													<td>
														<input  type="checkbox" name='newsletter' value="<?php echo $val->s_class_id;?>">
													</td>
													<td><?php echo $val->s_class_id;?></td>
													
													<td><?php if(!$val->s_class_name || empty($val->s_class_name)) echo "暂无";else echo  cn_substr_utf8($val->s_class_name,0,10,false);?></td>
													
													<td>
													<?php if($val->s_class_type == 11){?>
													<span class="label label-success">美图</span>
													<?php }elseif($val->s_class_type == 12){?>
													<span class="label label-danger">产品</span>
													<?php }elseif($val->s_class_type == 13){?>
													<span class="label label-info">方案案例</span>
													<?php }elseif($val->s_class_type == 99){?>
													<span class="label label-warning" >屏蔽</span>
													<?php }?>	
															
													</td>
		
													<td><?php if(empty($val->s_class_seodesc) || trim($val->s_class_seodesc) == '') echo "暂无";else echo  cn_substr_utf8($val->s_class_seodesc,0,15,false);?></td>
		
													<td><?php if(!$val->s_class_sort || empty($val->s_class_sort)) echo 0;else echo  $val->s_class_sort;?></td>
													
													<td><?php if($val->s_class_view == '0') echo "否";else echo  "是"?></td>
													
													<!-- 选项类型:radio单选,checkbox复选,one复选且必选一项,select下拉菜单,text单行输入,textarea多行输入,span选择 -->
													<td>
														<?php if($val->s_class_select == 'radio'){?>
														<span class="label label-success">单选</span>
														<?php }elseif($val->s_class_select == 'checkbox'){?>
														<span class="label label-danger">复选</span>
														<?php }elseif($val->s_class_select == 'one'){?>
														<span class="label label-info">复选且必选一项</span>
														<?php }elseif($val->s_class_select == 'select'){?>
														<span class="label label-warning" >下拉菜单</span>
														<?php }elseif($val->s_class_select == 'text'){?>
														<span class="label label-warning" >单行输入</span>
														<?php }elseif($val->s_class_select == 'textarea'){?>
														<span class="label label-warning" >多行输入</span>
														<?php }elseif($val->s_class_select == 'span'){?>
														<span class="label label-warning" >选择 </span>
														<?php }else{?>	
														<span class="label label-gray" >暂无</span>
														<?php }?>
													</td>
													
													<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/type/type_edit').'?s_class_id='.$val->s_class_id;?>');">Edit</a></td>
													
													<td><a class="delete" href="javascript:jsv.typedel(<?php echo $val->s_class_id;?>);">Delete</a></td>
													
													<td>
													
														<?php if(is_parent($val->s_class_id)){?>
														<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/tag/tag_add_type').'?p_id='.$val->s_class_id;?>');">Add</a>|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/s_class_tag/index').'?s_class_id='.$val->s_class_id;?>');">Detailed</a>|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/tag/add_system').'?s_class_id='.$val->s_class_id;?>');">Existing</a>
														<?php }else{?>
														<a class="href" href="#">NO</a>
														<?php }?>
														
													</td>
		
												</tr>
												<?php foreach ($re as $vals){?>
													<?php if($vals->s_class_pid == $val->s_class_id){?>
													
														<tr id="t_t<?php echo $vals->s_class_id;?>">
															<td>
																<input  type="checkbox" name='newsletter' value="<?php echo $vals->s_class_id;?>">
															</td>
															<td><?php echo $vals->s_class_id;?></td>
															
															<td>———<?php if(!$vals->s_class_name || empty($vals->s_class_name)) echo "暂无";else echo  cn_substr_utf8($vals->s_class_name,0,10,false);?></td>
															
															<td>
															<?php if($vals->s_class_type == 11){?>
															<span class="label label-success">美图</span>
															<?php }elseif($vals->s_class_type == 12){?>
															<span class="label label-danger">产品</span>
															<?php }elseif($vals->s_class_type == 13){?>
															<span class="label label-info">方案案例 </span>
															<?php }elseif($vals->s_class_type == 99){?>
															<span class="label label-warning" >屏蔽</span>
															<?php }?>	
																	
															</td>
				
															<td><?php if(empty($vals->s_class_seodesc) || trim($vals->s_class_seodesc) == '') echo "暂无";else echo  cn_substr_utf8($vals->s_class_seodesc,0,15,false);?></td>
				
															<td><?php if(!$vals->s_class_sort || empty($vals->s_class_sort)) echo 0;else echo  $vals->s_class_sort;?></td>
															
															<td><?php if($vals->s_class_view == '0') echo "否";else echo  "是"?></td>
															
															<!-- 选项类型:radio单选,checkbox复选,one复选且必选一项,select下拉菜单,text单行输入,textarea多行输入,span选择 -->
															<td>
																<?php if($vals->s_class_select == 'radio'){?>
																<span class="label label-success">单选</span>
																<?php }elseif($vals->s_class_select == 'checkbox'){?>
																<span class="label label-danger">复选</span>
																<?php }elseif($vals->s_class_select == 'one'){?>
																<span class="label label-info">复选且必选一项</span>
																<?php }elseif($vals->s_class_select == 'select'){?>
																<span class="label label-warning" >下拉菜单</span>
																<?php }elseif($vals->s_class_select == 'text'){?>
																<span class="label label-warning" >单行输入</span>
																<?php }elseif($vals->s_class_select == 'textarea'){?>
																<span class="label label-warning" >多行输入</span>
																<?php }elseif($vals->s_class_select == 'span'){?>
																<span class="label label-warning" >选择 </span>
																<?php }else{?>	
																<span class="label label-gray" >暂无</span>
																<?php }?>
															</td>
															
															<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/type/type_edit').'?s_class_id='.$vals->s_class_id;?>');">Edit</a></td>
															
															<td><a class="delete" href="javascript:jsv.typedel(<?php echo $vals->s_class_id;?>);">Delete</a></td>
				
															<td>
													
																<?php if(is_parent($vals->s_class_id)){?>
																<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/tag/tag_add_type').'?p_id='.$vals->s_class_id;?>');">Add</a>|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/s_class_tag/index').'?s_class_id='.$vals->s_class_id;?>');">Detailed</a>|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/tag/add_system').'?s_class_id='.$vals->s_class_id;?>');">Existing</a>
																<?php }else{?>
																<a class="href" href="#">NO</a>
																<?php }?>
																
															</td>
														</tr>
														
														<?php foreach ($re as $valsv){?>
															<?php if($valsv->s_class_pid == $vals->s_class_id){?>
																<tr id="t_t<?php echo $valsv->s_class_id;?>">
																	<td>
																		<input  type="checkbox" name='newsletter' value="<?php echo $valsv->s_class_id;?>">
																	</td>
																	<td><?php echo $valsv->s_class_id;?></td>
																	
																	<td>———————<?php if(!$valsv->s_class_name || empty($valsv->s_class_name)) echo "暂无";else echo  cn_substr_utf8($valsv->s_class_name,0,10,false);?></td>
																	
																	<td>
																	<?php if($valsv->s_class_type == 11){?>
																	<span class="label label-success">美图</span>
																	<?php }elseif($valsv->s_class_type == 12){?>
																	<span class="label label-danger">产品</span>
																	<?php }elseif($valsv->s_class_type == 13){?>
																	<span class="label label-info">方案案例</span>
																	<?php }elseif($valsv->s_class_type == 99){?>
																	<span class="label label-warning" >屏蔽</span>
																	
																	<?php }?>	
																			
																	</td>
						
																	<td><?php if(empty($valsv->s_class_seodesc) || trim($valsv->s_class_seodesc) == '') echo "暂无";else echo  cn_substr_utf8($valsv->s_class_seodesc,0,15,false);?></td>
						
																	<td><?php if(!$valsv->s_class_sort || empty($valsv->s_class_sort)) echo 0;else echo  $valsv->s_class_sort;?></td>
																	
																	<td><?php if($valsv->s_class_view == '0') echo "否";else echo  "是"?></td>
																	
																	<!-- 选项类型:radio单选,checkbox复选,one复选且必选一项,select下拉菜单,text单行输入,textarea多行输入,span选择 -->
																	<td>
																		<?php if($valsv->s_class_select == 'radio'){?>
																		<span class="label label-success">单选</span>
																		<?php }elseif($valsv->s_class_select == 'checkbox'){?>
																		<span class="label label-danger">复选</span>
																		<?php }elseif($valsv->s_class_select == 'one'){?>
																		<span class="label label-info">复选且必选一项</span>
																		<?php }elseif($valsv->s_class_select == 'select'){?>
																		<span class="label label-warning" >下拉菜单</span>
																		<?php }elseif($valsv->s_class_select == 'text'){?>
																		<span class="label label-warning" >单行输入</span>
																		<?php }elseif($valsv->s_class_select == 'textarea'){?>
																		<span class="label label-warning" >多行输入</span>
																		<?php }elseif($valsv->s_class_select == 'span'){?>
																		<span class="label label-warning" >选择 </span>
																		<?php }else{?>	
																		<span class="label label-gray" >暂无</span>
																		<?php }?>
												
																	</td>
																	
																	<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/type/type_edit').'?s_class_id='.$valsv->s_class_id;?>');">Edit</a></td>
																	
																	<td><a class="delete" href="javascript:jsv.typedel(<?php echo $valsv->s_class_id;?>);">Delete</a></td>
																	
																	<td>
													
																		<?php if(is_parent($valsv->s_class_id)){?>
																		<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/tag/tag_add_type').'?p_id='.$valsv->s_class_id;?>');">Add</a>|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/s_class_tag/index').'?s_class_id='.$valsv->s_class_id;?>');">Detailed</a>|<a class="href" href="javascript:jsv.go('<?php echo site_url('admin/tag/add_system').'?s_class_id='.$valsv->s_class_id;?>');">Existing</a>
																		<?php }else{?>
																		<a class="href" href="#">NO</a>
																		<?php }?>
																
																	</td>
						
																</tr>
															<?php }?>
														<?php }?>
													<?php }?>
												<?php }?>
											<?php }?>
										
										<?php }?>

	

					




									</tbody>
									<tfooter>
									<tr><td colspan='12' style="text-align:center;" ><?php echo $p;?></td></tr>
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