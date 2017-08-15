<!-- BEGIN PAGE -->
		<link rel="stylesheet" href="/application/views/admin/role/index.css" />
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

								<div class="caption"><i class="icon-edit"></i>列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								

								
									<div class="module-wrap" sc="module-wrap">
										
									</div>

									<script type="text/html" id="haha">
										{{each data.list}}
											<div class="module-list" sc="module-list">
												<div class="level1" sc="level1" scid="{{$value.id}}">
													<span class="slide" sc="slide">[+]</span>
													<input type="text" class="type1" value="{{$value.rank}}" sc="lv1-rank" />
													<input type="text" class="type2" value="{{$value.name}}" sc="lv1-name" />
													<a href="javascript:;" sc="realremove" scid="{{$value.id}}">删除</a>
													<a href="/index.php/admin/service/action_edit?id={{$value.id}}">编辑</a>
													<span class="orange">开放状态:</span>
													{{if $value.is_open == 1}}
													<span class="green">开启</span>
													{{else}}
													<span class="red">关闭</span>
													{{/if}}
												</div>
												<div class="level2-list" sc="level2-list" style="display:none">
													{{each $value.son}}
														<div class="level2" sc="level2" scid="{{$value.id}}">
															<input type="text" class="type1" value="{{$value.rank}}"  sc="lv2-rank" />
															<input type="text" class="type2" value="{{$value.name}}" sc="lv2-name" />
															<button sc="module3-add">+</button>
															<a href="javascript:;" sc="realremove" scid="{{$value.id}}">删除</a>
															<a href="/index.php/admin/service/action_edit?id={{$value.id}}">编辑</a>
															<span class="orange">开放状态:</span>
															{{if $value.is_open == 1}}
															<span class="green">开启</span>
															{{else}}
															<span class="red">关闭</span>
															{{/if}}
															<div class="level3-list" sc="level3-list">
																{{each $value.son}}
																	<div class="level3" sc="level3" scid="{{$value.id}}">
																		<input type="text" class="type1" value="{{$value.rank}}" sc="lv3-rank" />
																		<input type="text" class="type2" value="{{$value.name}}" sc="lv3-name" />
																		<a href="javascript:;" sc="realremove" scid="{{$value.id}}">删除</a>
																		<a href="/index.php/admin/service/action_edit?id={{$value.id}}">编辑</a>
																		<span class="orange">开放状态:</span>
																		{{if $value.is_open == 1}}
																		<span class="green">开启</span>
																		{{else}}
																		<span class="red">关闭</span>
																		{{/if}}
																	</div>
																{{/each}}
															</div>
														</div>
													{{/each}}
												</div>
												<button class="module2-add" sc="module2-add" style="display:none">添加新版块</button>
											</div>
										{{/each}}
									</script>



									<button sc="module-add" class="module-add">添加新模块</button>

									<button sc="module-save" class="module-add">保存</button>


									<script src="/application/views/admin/role/jquery.js"></script>
									<script src="/application/views/admin/role/sea.js"></script>
									<script>
										seajs.use('/application/views/admin/role/index.js');
									</script>


									<script>
										var data = {

										list: [
												{
													rank:"1",
													name:"erping",
													id:"2",
													son:[
														{
															rank:"1",
															name:"erping",
															id:"2",
															son: [
																{
																	rank:"3",
																	name:"erping",
																	id:"3"
																}
															]
														}
													]
												}

										]

									}
									</script>
							
								

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
