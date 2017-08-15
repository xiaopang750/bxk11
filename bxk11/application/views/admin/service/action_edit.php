
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

							功能&amp; 功能编辑  <small>功能&amp; 服务商管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">功能管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">功能列表 </a></li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->


				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN SAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-cogs"></i>功能</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo U('admin/service/doaction_edit');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.action();'>
								<table class="table table-hover">

									<thead>

										<tr>
											<th colspan='8'>功能编辑</th>
										</tr>

									</thead>

									<tbody>
										<tr style="display:none;" id='tag_name'>
											<td colspan='8'>
													<div class="alert alert-error">
														<button class="close" data-dismiss="alert"></button>
														<strong>错误!</strong>
														<span id='tag_error'>The daily cronjob has failed.</span>
													</div>
											
											</td>
											
										</tr>


										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能名:</span></td>
											<td colspan='4'><input name="ma_name" id="ma_name" type='text' class="m-wrap medium" value="<?php if($actions_info->ma_name) echo $actions_info->ma_name;?>"></td>
											
										</tr>
										
										<tr sc='key' <?php if($actions_info->ma_depth != 3) echo "style='display:none;'";?>>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能key:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='ma_key' id='ma_key' value="<?php if($actions_info->ma_key) echo $actions_info->ma_key;?>" /></td>
										</tr>
										
										<tr>
												<td colspan='4' style='text-align:right;'  width='20%'><span>服务商类型列表:</span></td>
												<td colspan='4'>
													<select class="header-option m-wrap medium" name='service_types' id='service_types'>
														<?php if($service_type){foreach($service_type as $va){?>
															<option value="<?php echo $va->service_type_id;?>" <?php if($va->service_type_id && $va->service_type_id == $actions_info->service_types) echo "selected";?>><?php echo $va->service_type;?></option>
														<?php } }?>
									
													</select>	
												</td>
												
										</tr>
										
										<tr >
											<td colspan='4' style='text-align:right;'><span>功能层级:</span></td>
											<td colspan='4'>
													<?php if($actions_info->ma_depth && $actions_info->ma_depth == 1) echo "模块";?>
													<?php if($actions_info->ma_depth && $actions_info->ma_depth == 2) echo "菜单";?>
													<?php if($actions_info->ma_depth && $actions_info->ma_depth == 3) echo "页面";?>
												
												<input type='hidden' name='ma_depth' value="<?php if($actions_info->ma_depth) echo $actions_info->ma_depth;?>">
											</td>
										</tr>

										<tr >
											<td colspan='4' style='text-align:right;'><span>模块图标:</span></td>
											<td colspan='4'>
												<input type='text' value="<?php if(!$actions_info->ma_pic || empty($actions_info->ma_pic)) echo "";else echo  $actions_info->ma_pic; ?>" name='ma_pic'>
												<!-- <input type='file' name='ma_pic'>
												<img src="<?php echo $actions_info->ma_pic;?>" width="60" height="60">
												<input type='hidden' value="<?php if(!$actions_info->ma_pic || empty($actions_info->ma_pic)) echo "暂无";else echo  $actions_info->ma_pic; ?>" name='ma_pic_bak'> -->
											</td>
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能描述:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='ma_desc' id='ma_desc' value="<?php if($actions_info->ma_desc) echo $actions_info->ma_desc;?>"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能显示排序:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" name='ma_sort' id='ma_sort' value="<?php if($actions_info->ma_sort) echo $actions_info->ma_sort;?>"/></td>
											
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>功能开放状态:</span></td>
											<td colspan='4'>
												<input type='radio' class="m-wrap medium" name='is_open' id='is_open' value="0" <?php if($actions_info->is_open == 0) echo "checked";?>/>关闭
												<input type='radio' class="m-wrap medium" name='is_open' id='is_open' value="1" <?php if($actions_info->is_open == 1) echo "checked";?>/>开启
											</td>
											
										</tr>

										
										<tr <?php if($actions_info->ma_depth != 3) echo "style='display:none;'";?> sc='type'>
											<td colspan='4' style='text-align:right;'  width='20%'><span>页面功能类型 :</span></td>
											<td colspan='4'>
												<select class="header-option m-wrap medium" name='ma_type' id='ma_type'>
														<option value="1" <?php if($actions_info->ma_type && 1 == $actions_info->ma_type) echo "selected";?>>列表详情</option>
														<option value="2" <?php if($actions_info->ma_type && 2 == $actions_info->ma_type) echo "selected";?>>添加</option>
														<option value="3" <?php if($actions_info->ma_type && 3 == $actions_info->ma_type) echo "selected";?>>编辑</option>
														<option value="4" <?php if($actions_info->ma_type && 4 == $actions_info->ma_type) echo "selected";?>>认证</option>
														<option value="5" <?php if( 5 == $actions_info->ma_type || !$actions_info->ma_type) echo "selected";?>>其它</option>
												</select>
											</td>
										</tr>
										
										<tr>
										
											<input type="hidden" name="ma_id" value="<?php echo $actions_info->ma_id;?>" id="ma_id"/>
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消'></td>
											
										</tr>
										
									</tbody>

								</table>
							</form>
							</div>

						</div>

						<!-- END SAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT-->

			</div>

			<!-- END PAGE CONTAINER--> 

		</div>

		<!-- END PAGE -->
