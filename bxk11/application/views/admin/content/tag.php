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

								<div class="caption"><i class="icon-edit"></i>标签列表</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/tag/index')?>" method='get'>
										<div class="chat-form">
										标签类别 :
										<select class="header-option m-wrap small" name='tag_type' id='tag_types'>
											<option value="" <?php if($tag_type == '') echo 'selected';?>>请选择</option>			
											<option value="1" <?php if($tag_type == 1) echo 'selected';?>>普通</option>
											<option value="2" <?php if($tag_type == 2) echo 'selected';?>>主题</option>
											<option value="50" <?php if($tag_type == 50) echo 'selected';?>>系统保留</option>
											<option value="99" <?php if(($tag_type) == 99) echo 'selected';?>>屏蔽</optionxz>
										</select>
										 	标签名:
										<input  type="text"  class="m-wrap span8" name ='tag_name' placeholder=" 标签名..." value="<?php echo $tag_name?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo site_url('admin/tag/add')?>'">

										Add New <i class="icon-plus"></i>

										</button>

									</div>
									
									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del();">

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
											<th>标签标识</th>
											
											<th>标签名</th>

											<th>标签类别 </th>

											<th>SEO关键字</th>
											
											<th>成员数</th>

											<th>标签描述</th>

											<th>编辑</th>

											<th>删除</th>

										</tr>

									</thead>

									<tbody>

									
										<?php foreach ($re as $val){?>
										<tr id="t_s<?php echo $val->tag_id;?>">
											<td>
												<input  type="checkbox" name='newsletter' value="<?php echo $val->tag_id;?>">
											</td>
											<td><?php echo $val->tag_id;?></td>
											
											<td><?php if(!$val->tag_name || empty($val->tag_name)) echo "暂无";else echo  cn_substr_utf8($val->tag_name,0,10,false);?></td>
											
											<td>
											<?php if($val->tag_type == 1){?>
											<span class="label label-success">普通标签</span>
											<?php }elseif($val->tag_type == 2){?>
											<span class="label label-danger">主题</span>
											<?php }elseif($val->tag_type == 50){?>
											<span class="label label-info">系统保留</span>
											<?php }elseif($val->tag_type == 99){?>
											<span class="label label-warning" >屏蔽</span>
											<?php }?>	
													
											</td>

											<td><?php if(isset($val->tag_selkey))  echo "暂无";else if(trim($val->tag_seokey)=="") echo "暂无"; else echo cn_substr_utf8($val->tag_seokey,0,10,false); ?></td>

											<td><?php if(!$val->tag_count || empty($val->tag_count)) echo "0";else echo  cn_substr_utf8($val->tag_count,0,10,false);?></td>

											<td><?php if(empty($val->tag_seodesc) || is_null($val->tag_seodesc)) echo "暂无";else echo  cn_substr_utf8($val->tag_seodesc,0,15,false);?></td>

											<td><a class="edit" href="javascript:jsv.go('<?php echo site_url('admin/tag/add_edit').'?tag_id='.$val->tag_id;?>');">Edit</a></td>

											<td><a class="delete" href="javascript:jsv.del(<?php echo $val->tag_id;?>);">Delete</a></td>

										</tr>
										<?php }?>


									</tbody>
									<tfooter>
									<tr><td colspan='9' style="text-align:center;" ><?php echo $p;?></td></tr>
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