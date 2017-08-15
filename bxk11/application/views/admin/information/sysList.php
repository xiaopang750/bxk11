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

								<a href="#">系统资讯</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">系统资讯管理</a></li>

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

								<div class="caption"><i class="icon-edit"></i>系统资讯</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/information/sysList')?>" method='get'>
										<div class="chat-form">
										<select class="header-option m-wrap small" name='it_type'>
											<option value="" >请选择</option>
											<?php if($it_list){foreach ($it_list as $key => $value) { ?>
											<option value="<?php echo $value['it_id'];?>" <?php echo $value['selected'];?>><?php echo $value['it_name'];?> </option>
											<?php }}?>

										</select>
										 	资讯名称:
										<input  type="text"  class="m-wrap span8" name ='key_word' placeholder="系统资讯名..." value="<?php echo $keywords;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										
										

										</div>
									</form>
									
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo U('admin/information/sysAdd');?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/information/doSysDel');?>');">

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


											<th>资讯标题</th>

											<th>分类类型</th>

											<th>资讯状态</th>
											
											<th>资讯收藏量</th>

											<th>资讯阅读量</th>
											
											<th> 编辑</th>

										

										</tr>

									</thead>

									<tbody>

									
										<?php if($informationlist){foreach ($informationlist as $key=>$val){?>
										<tr id="t_s<?php echo $val['si_id'];?>">

											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val['si_id'];?>">
											</td>


											<td><?php echo $val['si_title'];?></td>

											<td>
<!-- 
												<?php if($itList){foreach ($itList as $keys => $values) {  ?>

													<?php if($values->it_id == $val['it_id']) echo $values->it_name;?>
												<?php }}else{echo "暂无";}?>
 -->											<?php echo $val['it_name'];?>

											</td>
											
								
											<td><?php if($val['si_status'] == 1) echo "正常";elseif($val['si_status'] == 99) echo "删除";?></td>

											<td><?php if($val['si_likes']) echo $val['si_likes']; else echo 0;?></td>

											<td><?php if($val['si_views']) echo $val['si_views']; else echo 0;?></td>
										
											
											<td><a class="edit" href="javascript:jsv.go('<?php echo U('admin/information/sysEdit',array('si_id'=>$val['si_id']));?>');">Edit</a>|<a class="delete" href="javascript:void(0);" onclick="jsv.delAll(<?php echo $val['si_id']?>	,'<?php echo U('admin/information/doSysDel');?>');">Delete</a></td>
											
										</tr>
										<?php }}?>


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
