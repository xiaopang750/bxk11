
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

								<div class="caption"><i class="icon-cogs"></i>3D配置</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/three_config/doadd');?>" enctype="multipart/form-data" method="POST">
								<table class="table table-hover">

									<thead>

										<tr>

											
											<th colspan='8'>全局参数设置&全景视窗参数</th>
											

										</tr>

									</thead>

									<tbody>
										<tr>
											<td colspan='8' ><span>全局参数</span></td>
										</tr>
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
											<td colspan='4' style='text-align:right;' width='20%'><span>全景模式:</span></td>
											<td colspan='4'>
												 <select class="add_sel mr_10" name = 'type'>
														<option value = "cube" <?php if($global['type'] == 'cube') echo "selected";?>>
								 							 正文体
												        </option>
												        <option value = "sphere" <?php if($global['type'] == 'sphere') echo "selected";?>>
								 							球形
												        </option>
								           		</select>
											</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>自动旋转:</span></td>
											<td colspan='4'>
											 <select class="add_sel mr_10" name = 'autoRotateStart' id='autoRotateStart'>
													<option value = "0" <?php if($global['autoRotateStart'] == 0) echo "selected";?>>
							 							 false
											        </option>
											        <option value = "1" <?php if($global['autoRotateStart'] == 1) echo "selected";?>>
							 							true
											        </option>
							           		</select>
           								  </td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>是否空闲自动旋转:</span></td>
											<td colspan='4'>
											 <select class="add_sel mr_10" name = 'autoRotateOnIdle' id='autoRotateOnIdle'>
													<option value = "0" <?php if($global['autoRotateOnIdle'] == 0) echo "selected";?>>
							 							 false
											        </option>
											        <option value = "1" <?php if($global['autoRotateOnIdle'] == 1) echo "selected";?>>
							 							true
											        </option>
							           		</select>（是否空闲自动旋转）HTML5 
           								  </td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'><span>空闲自动转动的时间间隔:</span></td>
											<td colspan='4'>
												<input type="text" size="50"  id="autoRotateDelay" name="autoRotateDelay" value="<?php echo $global['autoRotateDelay'];?>"> （单位为秒，默认值为5。）HTML5
           								  	</td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>自动旋转速度:</span></td>
											<td colspan='4'>
												<input type="text" size="50"  id="rate" name="rate" value="<?php echo $global['rate'];?>"> （合适的范围0-2，数值越大，速度越快。）
											</td>
											
										</tr>
									
										<tr>

											<td colspan='4' style='text-align:right;'><span>鼠标拖拽速度:</span></td>
											<td colspan='4'><input type="text"  size="50"  id="dragRate" name="dragRate" value='<?php echo $global['dragRate'];?>'></td>
											
										</tr>
										
																			
										<tr>

											<td colspan='4' style='text-align:right;'><span>是否显示热点注释信息:</span></td>
											<td colspan='4'>
											
											 <select class="add_sel mr_10" name = 'hotspotInfo'>
													<option value = "0" <?php if($global['hotspotInfo'] == 0) echo "selected";?>>
							 							 false
											        </option>
											        <option value = "1" <?php if($global['hotspotInfo'] == 1) echo "selected";?>>
							 							true
											        </option>
							           		</select>（可缺省，不设置此属性即为false）
											</td>
											
										</tr>
									
										<tr>
											<td colspan='4' style='text-align:right;'><span>全局背景音乐:</span></td>
											<td colspan='4'>
											
												<input type='file' name="bgSound" id='bgSound'><!-- input type='checkbox' name='isbg' value="1" <?php if($global['isbg'] == 1)echo "checked";?>>初始化是开 -->（不会随场景切换而更改。添加一个全局背景音乐）
												<input type='hidden' name="bgsoundcopy" value="<?php echo $global['bgSound'];?>">
											
											</td>
										</tr>
										
									   <tr>
											<td colspan='4' style='text-align:right;'><span>背景音乐声音大小:</span></td>
											<td colspan='4'>
												<input type='text' name='bgvolume' value="<?php echo $global['bgvolume'];?>"/>
											</td>
										</tr>
										
										<tr>
											<td colspan='8' ><span>全景视窗参数</span></td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'>窗口的宽度: </td>
											<td colspan='4'><input type="text"  size="50"  id="width" name="width" value="<?php echo $global['width'];?>"> （单位为像素，值为正数字或者百分数如：100%；）</td>
									 	</tr>
									 	 <tr>
											<td colspan='4' style='text-align:right;'>窗口的高度: </td>
											<td colspan='4'><input type="text"  size="50"  id="height" name="height" value="<?php echo $global['height'];?>"> （单位为像素，值为正数字或者百分数如：100%）</td>
									 	</tr>
									 	 <tr>
											<td colspan='4' style='text-align:right;'>窗口的x坐标: </td>
											<td colspan='4'><input type="text"  size="50"  id="x" name="x" value="<?php echo $global['x'];?>"> （单位为像素，值为正、负数字或者百分数如：30%）</td>
									 	</tr>
									 	 <tr>
											<td colspan='4' style='text-align:right;'>窗口的y坐标: </td>
											<td colspan='4'><input type="text" size="50"  id="y" name="y" value="<?php echo $global['y'];?>"> （单位为像素，值为正、负数字或者百分数如：30%。）</td>
									 	</tr>
									 	<tr>
											<td colspan='8' ><span>设置界面语言</span></td>
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>右键菜单里的全屏切换:</span></td>
											<td colspan='4'><input type="text"  size="50"  id="fullScreen" name="fullScreen" value='<?php echo $global['fullScreen'];?>'></td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>右键菜单里的退出全屏:</span></td>
											<td colspan='4'><input type="text"  size="50"  id="exitFullScreen" name="exitFullScreen" value='<?php echo $global['exitFullScreen'];?>'></td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>显示地图:</span></td>
											<td colspan='4'><input type="text"  size="50"  id="showMap" name="showMap" value='<?php echo $global['showMap'];?>'>（本地或百度地图）</td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>隐藏地图:</span></td>
											<td colspan='4'><input type="text"  size="50"  id="hideMap" name="hideMap" value='<?php echo $global['hideMap'];?>'>（本地或百度地图）</td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>显示缩略图:</span></td>
											<td colspan='4'><input type="text"  size="50"  id="showThumb" name="showThumb" value='<?php echo $global['showThumb'];?>'></td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>隐藏缩略图 :</span></td>
											<td colspan='4'><input type="text"  size="50"  id="hideThumb" name="hideThumb" value='<?php echo $global['hideThumb'];?>'></td>
											
										</tr>
										<tr>

											<td colspan='4' style='text-align:right;'><span>点击控制面板的帮助按钮:</span></td>
											<td colspan='4'><textarea id="helpInfo" class="large m-wrap" name="helpInfo" rows="3"><?php echo $global['helpInfo'];?></textarea>(点击控制面板的帮助按钮，打开的窗口里显示的文字)</td>
											
										</tr>
									 	<tr>
											<td colspan='8' ><span>导航设置</span></td>
										</tr>
									 	<tr>
											<td colspan='4' style='text-align:right;'>设计师是否开启本地地图:</td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="ismap" value='1' <?php if($global['ismap'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="ismap" value='0' <?php if($global['ismap'] == '0' || !$global['ismap']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>
									 	<tr>
											<td colspan='4' style='text-align:right;'>用户DIY是否开启索引图导航: </td>
											
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" size="50"  id="isthumb" name="isthumb" value='1' <?php if($global['isthumb'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur" size="50"  id="isthumb" name="isthumb" value='0' <?php if($global['isthumb'] == '0' || !$global['isthumb']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>
									 	<tr>
											<td colspan='4' style='text-align:right;'>全局开启控制面板: </td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="iscontrol" value='1' <?php if($global['iscontrol'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="iscontrol" value='0' <?php if($global['iscontrol'] == '0' ||!$global['iscontrol']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>
									 	
									 	<tr>
											<td colspan='4' style='text-align:right;'>是否开启信息面板: </td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="isinfo" value='1' <?php if($global['isinfo'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="isinfo" value='0' <?php if($global['isinfo'] == '0' ||!$global['isinfo']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>

									 								 	
									 	<tr>
											<td colspan='4' style='text-align:right;'>是否显示LOGO: </td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="islogo" value='1' <?php if($global['islogo'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="islogo" value='0' <?php if($global['islogo'] == '0' ||!$global['islogo']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>
									 	
									 	<tr>
											<td colspan='4' style='text-align:right;'>是否开启闭背景音乐: </td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="isbgsound" value='1' <?php if($global['isbgsound'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="isbgsound" value='0' <?php if($global['isbgsound'] == '0' ||!$global['isbgsound']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>
									 	
									 	<tr>
											<td colspan='4' style='text-align:right;'>是否开启热点: </td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="ishotspot" value='1' <?php if($global['ishotspot'] == '1') echo "checked";?>>是
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="ishotspot" value='0' <?php if($global['ishotspot'] == '0' ||!$global['ishotspot']) echo "checked";?>>否
												</label>
											</td>
									 	</tr>
									 	
									 	
										<tr>
											<td colspan='4' style='text-align:right;'>调试开关: </td>
											<td colspan='4'>
												<label class="radio">
													<input type="radio" class="input_blur" name="debug" value='1' <?php if($global['debug'] == '1') echo "checked";?>>开启
												</label>
												<label class="radio">
													<input type="radio" class="input_blur"   name="debug" value='0' <?php if($global['debug'] == '0' ||!$global['iscontrol']) echo "checked";?>>关闭
												</label>
											</td>
									 	</tr>
										<tr>
											<input type='hidden' name='t_g_id' value='<?php echo $global['t_g_id']?>'>
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
