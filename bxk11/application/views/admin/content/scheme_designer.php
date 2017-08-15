
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

							标签&amp; 标签添加  <small>标签&amp; 内容管理</small>

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

							<li><a href="#">楼盘列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>标签</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<form action="<?php echo site_url('admin/scheme_recommend/doscheme_designer');?>" enctype="multipart/form-data" method="POST" onsubmit="return jsv.designer_recommend();">
								<table class="table table-hover">
									<thead>

										<tr>

											
											<th colspan='8'>案例频道首页推荐设计师</th>
											

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
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-1:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-1' id='scheme_recommend-1' value='<?php if(isset($designer_recommend['0'])){ $hv = explode('|',$designer_recommend['0']); echo $hv['0'];}?>'/><span></span></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>设计师-1:介绍标题</span></td>
											<td colspan='4'><textarea name='scheme_title-1' id='scheme_title-1' rows='5'><?php if(isset($des_rec_title)) echo $des_rec_title;?></textarea>(内容以|分隔，如标题|内容)</td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-2:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-2' id='scheme_recommend-2' value='<?php if(isset($designer_recommend['1'])) echo $designer_recommend['1'];?>'/></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-3:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-3' id='scheme_recommend-3' value='<?php if(isset($designer_recommend['2'])) echo $designer_recommend['2'];?>'/></td>
											
										</tr>
																			<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-4:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-4' id='scheme_recommend-4' value='<?php if(isset($designer_recommend['3'])) echo $designer_recommend['3'];?>'/></td>
											
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-5:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-5' id='scheme_recommend-5' value='<?php if(isset($designer_recommend['4'])) echo  $designer_recommend['4'];?>'/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-6:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-6' id='scheme_recommend-6' value='<?php if(isset($designer_recommend['5'])) echo  $designer_recommend['5'];?>'/></td>
											
										</tr>
										
										<tr>
											<td colspan='4' style='text-align:right;'  width='20%'><span>案例频道首页推荐设计师-7:</span></td>
											<td colspan='4'><input type='text' class="m-wrap medium" tar_key='check' name='scheme_recommend-7' id='scheme_recommend-7' value='<?php if(isset($designer_recommend['6'])) echo  $designer_recommend['6'];?>'/></td>
											
										</tr>
						
										<tr>
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
