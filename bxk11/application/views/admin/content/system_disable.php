
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

							博文 &amp; 博文列表  <small>博文&amp; 博文管理</small>

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

							<li><a href="#">系统禁止 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>系统禁止</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/system_disable/index')?>" method='get'>
										<div class="chat-form">
										
										 	内容类型  :
										<select id='sdisable_type' class="header-option m-wrap small" name='disable_status'>
											<option value=''>--请选择--</option>
											<?php if($type_config){
												foreach($type_config as $key=>$value){
											?>						
											<option value="<?php echo $value['type'];?>" <?php if($value['type'] == $disable_status) echo 'selected';?>><?php echo $value['type_content'];?></option>
											<?php }}?>
										</select>
								 	
										内容:
			
										<input  type="text"  class="m-wrap span8" name ='disable_content' placeholder=" 内容名..." value="<?php echo $disable_content;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>
								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/system_disable/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.disable_del();">

											DELETE 

										</button>

									</div>
									

								</div>
								<table class="table table-hover" id='sample_editable_1'>

									<thead>

										<tr>

											<th id='flgs'>
												<input type="checkbox" ack_data='tag_checkboxs' value='2'>
											</th>
											<th>禁止类型</th>
											<th>禁止内容</th>
											<th>编辑</th>
		
										</tr>

									</thead>

									<tbody>

										<?php foreach ($re as $val){?>
									<tr id="t_disable<?php echo $val->sdisable_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->sdisable_id;?>">
											</td>

				
											<td><?php echo getdisablecontent($val->sdisable_type);?></td>
											<td>
											<?php if($val->sdisable_type == 4){?>
											
											<a href="<?php echo site_url('user/index').'/'.$val->sdisable_value;?>" target="_left"><?php echo get_tag_name('t_user_model',$val->sdisable_value,'user_nickname');?></a>
											
											<?php }else{?>
											<?php echo $val->sdisable_value;?>
											<?php }?>
											
											</td>
											
											<td><a href="<?php echo site_url('admin/system_disable/edit').'?sdisable_id='.$val->sdisable_id;?>">Edit</a>|<a href="javascript:jsv.disable_del('<?php echo $val->sdisable_id;?>');">Delete</a></td>
					
										</tr>
										<?php }?>

									</tbody>
									<tfooter>
									<tr><td colspan='8' style="text-align:center;" class="pagination"><?php echo $p;?></td></tr>
									</tfooter>
								</table>

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
