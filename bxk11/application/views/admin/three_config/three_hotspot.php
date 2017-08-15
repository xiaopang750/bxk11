
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

						<!--<div class="color-panel hidden-phone">

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

										<option value="fluid" selected="">Fluid</option>

										<option value="boxed">Boxed</option>

									</select>

								</label>

								<label>

									<span>Header</span>

									<select class="header-option m-wrap small">

										<option value="fixed" selected="">Fixed</option>

										<option value="default">Default</option>

									</select>

								</label>

								<label>

									<span>Sidebar</span>

									<select class="sidebar-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected="">Default</option>

									</select>

								</label>

								<label>

									<span>Footer</span>

									<select class="footer-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected="">Default</option>

									</select>

								</label>

							</div>

						</div>-->

						<!-- END BEGIN STYLE CUSTOMIZER --> 

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							3D全局设置&amp; 热点设置  <small>热点&amp; 内容管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">内容管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">热点设置 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>热点设置</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/three_config/dohotspot_add');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">

									<thead>

										<tr>

		
											<th colspan='8'>热点设置</th>
											

										</tr>

									</thead>

									<tbody>
				
										<tr style="display:none;" id='s_class_name'>
											<td colspan='8'>
													<div class="alert alert-error">
														<button class="close" data-dismiss="alert"></button>
														<strong>错误!</strong>
														<span id='s_class_error'>The daily cronjob has failed.</span>
													</div>
											
											</td>
										
											
										</tr>
										<tr>
									 		<td colspan='4' style='text-align:right;'>热点和热区类型:</td>
											<td colspan='4'>

											 <select class="add_sel mr_10" name = 'type'>
													<option value = "spot" <?php if($hotspot['type'] == 'spot') echo "selected";?>>
							 							 spot
											        </option>
							           		</select>热点和热区类型
											
											
											</td>
									 	</tr>
										<tr>
									 		<td colspan='4' style='text-align:right;'>热点注释信息框宽度:</td>
											<td colspan='4'><input type="text" id="infoWidth" name="infoWidth" value="<?php echo $hotspot['infoWidth']?>"></td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>热点注释信息框高度:</td>
											<td colspan='4'><input type="text" id="infoHeight" name="infoHeight" value='<?php echo $hotspot['infoHeight']?>'></td>
									 	</tr>
									 	<tr >
									 	 	<td colspan='4' style='text-align:right;'>热点注释信息的文字颜色:</td>
											<td colspan='4'><input type="text" id="infoFont" name="infoFont" value="<?php echo $hotspot['infoFont']?>">(如：FFFFFF，默认值：333333;)</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>热点注释信息框背景渐变色一: </td>
										<td colspan='4'>
											<input type="text" id="infoColor1" name="infoColor1" value="<?php echo $hotspot['infoColor1']?>">(默认值：FFFFFF)</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>热点注释信息框背景渐变色二: </td>
										<td colspan='4'>
											<input type="text" id="infoColor2" name="infoColor2" value="<?php echo $hotspot['infoColor2']?>">(默认值：9C9C9C)</td>
									 	</tr>
										
										<tr>
									 	<td colspan='4' style='text-align:right;'>热点注释信息框的透明度: </td>
										<td colspan='4'>
											<input type="text" id="infoAlpha" name="infoAlpha" value="<?php echo $hotspot['infoAlpha']?>">(默认值：1)</td>
									 	</tr>
										<tr >
									 	<td colspan='4' style='text-align:right;'>热点标识的外部引用文件: </td>
										<td colspan='4'>
											<?php if($hotspot['file']){?><img src="<?php echo $hotspot['path'].$hotspot['file'];?>" width='60' height='60'/><br/><?php }?>
											<input type="file" class="input_blur" size="50"  id="file" name="file">（（jpg\png\gif\swf）
											<input type='hidden' name="filecopy" value="<?php echo $hotspot['file'];?>">
										</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>热点点击后的动作类型: </td>
										<td colspan='4'>
											 <select class="add_sel mr_10" name = 'action' id='action' onclick="jsv.toshow();">
													
											        <option value=''>
							 							热点的目标
											        </option>
											        <option value = "toShow" <?php if($hotspot['action'] == 'toShow') echo "selected";?>>
							 							全景视窗内打开窗口载入内容
											        </option>
							           		 </select>
									 	</tr>
									
									 	<tr class='toShow' style = "<?php if($hotspot['action'] != 'toShow') echo'display:none';?>">
									 	<td colspan='4' style='text-align:right;'>子窗口的宽度: </td>
										<td colspan='4'>
											<input type="text" class="input_blur" size="50"  id="windowWidth" name="windowWidth" value="<?php if($hotspot['windowWidth'])echo $hotspot['windowWidth'];?>"> （子窗口的宽度）</td>
									 	</tr>
									 
									 	<tr  class='toShow' style = "<?php if($hotspot['action'] != 'toShow') echo'display:none';?>">
									 	<td colspan='4' style='text-align:right;'>子窗口的高度: </td>
										<td colspan='4'>
											<input type="text" class="input_blur" size="50"  id="windowHeight" name="windowHeight" value="<?php if($hotspot['windowHeight'])echo $hotspot['windowHeight'];?>"> （子窗口的高度））</td>
									 	</tr>
									 	<tr class='toShow' style = "<?php if($hotspot['action'] != 'toShow') echo'display:none';?>">
										 	<td colspan='4' style='text-align:right;'>子窗口显示文字颜色: </td>
											<td colspan='4'>
												<input type="text" class="input_blur" size="50"  id="windowFont" name="windowFont" value="<?php if($hotspot['windowFont'])echo $hotspot['windowFont'];?>"> （子窗口显示文字颜色，默认值：333333）
											</td>
									 	</tr>
									 	<tr class='toShow' style = "<?php if($hotspot['action'] != 'toShow') echo'display:none';?>">
									 	<td colspan='4' style='text-align:right;'>子窗口背景渐变色一: </td>
										<td colspan='4'>
											<input type="text" class="input_blur" size="50"  id="windowColor1" name="windowColor1" value="<?php if($hotspot['windowColor1'])echo $hotspot['windowColor1'];?>"> （子窗口背景渐变色一，默认值：FFFFFF，HTML5版默认值EAECF0）</td>
									 	</tr>
									 	<tr class='toShow' style = "<?php if($hotspot['action'] != 'toShow') echo'display:none';?>">
									 	<td colspan='4' style='text-align:right;'>子窗口背景渐变色二: </td>
										<td colspan='4'>
											<input type="text" class="input_blur" size="50"  id="windowColor2" name="windowColor2" <?php if($hotspot['windowColor2']){?>value="<?php echo $hotspot['windowColor2']?>" <?php }else{?>value='FFFFFF'<?php }?>> （子窗口背景渐变色二，默认值：FFFFFF）</td>
									 	</tr>
									 	<tr class='toShow' style = "<?php if($hotspot['action'] != 'toShow') echo'display:none';?>">
									 	<td colspan='4' style='text-align:right;'>子窗口背景透明度: </td>
										<td colspan='4'>
											<input type="text" class="input_blur" size="50"  id="windowAlpha" name="windowAlpha"  <?php if($hotspot['windowAlpha']){?>value="<?php echo $hotspot['windowAlpha']?>" <?php }else{?>value='1'<?php }?>> （子窗口背景透明度，默认值：1）</td>
									 	</tr>
									 	
									
										<tr>
											<input type="hidden" name="h_id" value="<?php echo $hotspot['h_id']?>" />
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消'></td>	
										</tr>
										</div>
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
