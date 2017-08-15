
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

							标签分类&amp; 标签分类添加  <small>标签分类&amp; 内容管理</small>

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

							<li><a href="#">标签分类 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>3D索引图导航</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/three_config/domap_add');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">

									<thead>

										<tr>

		
											<th colspan='8'>地图导航参数设置</th>
											

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
									 		<td colspan='4' style='text-align:right;'>地图导航插件:</td>
											<td colspan='4'>
											
											<select name='file' >
												<option value='map' <?php if($map['file'] == 'map') echo "selected";?>>localmap.swf</option>
												<option value='baidu' <?php if($map['file'] == 'baidu') echo "selected";?>>baidumap.swf</option>
												<option value='mapbak' <?php if($map['file'] == 'mapbak') echo "selected";?>>localmapbak.swf</option>
											</select>
											
										（地图导航插件）</td>
									 	</tr>
									 	<tr>
									 		<td colspan='4' style='text-align:right;'>地图类型:</td>
											<td colspan='4'>
											
											<select name='type' >
												<option value='local' <?php if($map['type'] == 'local') echo "selected";?>>本地地图</option>
												<option value='baidu' <?php if($map['type'] == 'baidu') echo "selected";?>>baidu</option>
											</select>
											
											（地图类型）</td>
									 	</tr>
									 	<tr>
									 	 	<td colspan='4' style='text-align:right;'>地图显示的宽度:</td>
											<td colspan='4'><input type="text" class="input_blur" size="50"  id="width" name="width" value="<?php echo $map['width'];?>">（地图显示的宽度，可以是正数值或者百分比）</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>地图显示的高度:</td>
										<td colspan='4'><input type="text" class="input_blur" size="50"  id="height" name="height" value="<?php echo $map['height'];?>">（地图显示的高度，可以是正负数值或者百分比）</td>
									 	</tr>
									 	 <tr>
									 	<td colspan='4' style='text-align:right;'>排列方式:</td>
										<td colspan='4'>
											<select name='align' >
												<option value=left <?php if($map['align'] == 'left') echo "selected";?>>靠左并排</option>
												<option value='right' <?php if($map['align'] == 'right') echo "selected";?>>靠右并排</option>
												<option value='overlay' <?php if($map['align'] == 'overlay') echo "selected";?>>浮动在上面</option>
											</select>
										</td>
									 	</tr>
									 	
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>显示的x坐标: </td>
										<td colspan='4'><input type="text" class="input_blur" size="50"  id="x" name="x" value="<?php echo $map['x'];?>">（单位为像素，值为正负数字或百分比，）</td>
									 	</tr>
									 	
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>显示的y坐标: </td>
										<td colspan='4'><input type="text" class="input_blur" size="50"  id="y" name="y" value="<?php echo $map['y'];?>">（单位为像素，值为正负数字或百分比，）</td>
									 	</tr>
									 	
									 	<tr >
									 	<td colspan='4' style='text-align:right;'>初始是否显示: </td>
										<td colspan='4'>
										<label class="radio">
										<input type="radio" class="input_blur"  name="initialShow" value='1' <?php if($map['initialShow'] == '1' || !$map['initialShow']) echo "checked";?>>显示
										</label>
										<label class='radio'>
										<input type="radio" class="input_blur" name="initialShow" value='0' <?php if($map['initialShow'] == '0') echo "checked";?>>隐藏
										
								 		</label>
										</td>
									
									 	</tr>
									 	
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>设置雷达的颜色: </td>
										<td colspan='4'><input type="text" class="input_blur" size="50"  id="radarColor" name="radarColor" value="<?php echo $map['radarColor'];?>">（六位16进制颜色值，如FFFFFF）</td>
									 	</tr>
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>设置雷达的尺寸: </td>
										<td colspan='4'><input type="text" class="input_blur" size="50"  id="radarSize" name="radarSize" value="<?php echo $map['radarSize'];?>">（整数值，FLASH版本默认值75；HTML5版本默认值100）</td>
									 	</tr>
									 	 <tr>
									 	<td colspan='4' style='text-align:right;'>地图面板是否显示滚动条: </td>
										<td colspan='4'><label class='radio'><input type="radio" class="input_blur"  name="scrollBar" value='1' <?php if($map['scrollBar'] == '1' || !$map['scrollBar']) echo "checked";?>>显示</label><label class='radio'><input type="radio" class="input_blur" name="scrollBar" value='0' <?php if($map['scrollBar'] == '0' ) echo "checked";?>>隐藏</label></td>
									 	</tr>
									 	
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>地图上的热点的标识图: </td>
										<td colspan='4'>
											<?php if($map['hotspot']){?><img src="<?php echo $map['path'].$map['hotspot'];?>" width='30' height='30'/><br/><?php }?>
											<input type="file" class="input_blur" size="50"  id="hotspot" name="hotspot">（地图上的热点的标识图（jpg\png\gif\swf）
											<input type='hidden' name="hotspotcopy" value="<?php echo $map['hotspot'];?>">
											</td>
									 	</tr>
									 	
									 	<tr>
									 	<td colspan='4' style='text-align:right;'>鼠标移上去显示的热点标识图: </td>
										<td colspan='4'>
										<?php if($map['overState']){?><img src="<?php echo $map['path'].$map['overState'];?>" width='30' height='30'/><br/><?php }?>
											<input type="file" class="input_blur" size="50"  id="overState" name="overState">（鼠标移上去显示的热点标识图（jpg\png\gif\swf）
											<input type='hidden' name="overStatecopy" value="<?php echo $map['overState'];?>">
										</td>
									 	</tr>
									 	
									 	<tr >
									 	<td colspan='4' style='text-align:right;'>切换到此热点时显示的热点标识图: </td>
										<td colspan='4'>
											<?php if($map['activeState']){?><img src="<?php echo $map['path'].$map['activeState'];?>" width='30' height='30'/><br/><?php }?>
											<input type="file" class="input_blur" size="50"  id="activeState" name="activeState">（切换到此热点时显示的热点标识图（jpg\png\gif\swf）
											<input type='hidden' name="activeStatecopy" value="<?php echo $map['activeState'];?>">
										</td>
									 	</tr>
									 	
									 	
										<tr>
											<input type="hidden" name="t_m_id" value="<?php echo $map['t_m_id']?>" />
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
