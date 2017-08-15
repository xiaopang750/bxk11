
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

							样板间 &amp; 样板列表  <small>样板列表&amp; 样板间管理</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">家178</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">样板间管理</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">样板间列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>样板间</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/room/index')?>" method='get'>
										<div class="chat-form">
										
										 	样板间状态  :
										<select class="header-option m-wrap small" name='room_status'>
											<option value="" <?php if($room_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($room_status == 1) echo "selected";?>>正常</option>
											<option value="11" <?php if($room_status == 11) echo "selected";?>>屏蔽</option>
											<option value="21" <?php if($room_status == 21) echo "selected";?>>草稿</option>
											<option value="12" <?php if($room_status == 12) echo "selected";?>>申述</option>

										</select>
										 	
											样板间类型  :
										<select class="header-option m-wrap small" name='room_type'>
											<option value="" <?php if($room_type == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($room_type == 1) echo "selected";?>>平面 </option>
											<option value="2" <?php if($room_type == 2) echo "selected";?>>3D</option>
											
										</select>
										
										 发表始时间：

										<div class="input-append">
											<input name='a_start' class="m-wrap m-ctrl-medium date-picker" type="text" value="" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>

										 发表时间：

										<div class="input-append">
											<input name='a_end' class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php if($a_end){echo $a_end;}else{echo date('Y-m-d',time());}?>" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										
										<br/><br/>
											发表昵称:
										<input  type="text"  class="m-wrap" name ='user_name' placeholder=" 用户名..." value="<?php echo $user_name;?>">
											
											样间名:
										<input  type="text"  class="m-wrap span6" name ='room_name' placeholder=" 标签名..." value="<?php echo $room_name;?>">
										<button class="btn green" type="submit">
										Search...
										<i class="m-icon-swapright m-icon-white"></i>
										</button>
										</div>
									</form>
								</div>

								<table class="table table-hover">

									<thead>

										<tr>

											<th>#</th>

											<th>房间</th>
											<th>发布房间者</th>
											<th>设计思路</th>
											<th>下载次数</th>
											<th>房间类型</th>
											<th class="hidden-480">发表时间</th>
											<th>状态 </th>
											<th>热点添加</th>
											<th>审核</th>
											<th>热门推荐</th>
											<th>查看</th>
					
										</tr>

									</thead>

									<tbody>

										<?php foreach ($re as $val){?>
										<tr>

											<td><?php echo $val->room_id;?></td>
											<td> <a href="<?php echo site_url('room/info').'?rid='.$val->room_id;?>" target="_left"><?php echo cn_substr_utf8($val->room_name,0,20);?></a></td>
											<td><a href="<?php echo site_url('user/index').'/'.$val->user_id;?>" target="_left"><?php echo cn_substr_utf8($val->user_nickname,0,10);?></a></td>
											<td>
													<?php echo cn_substr_utf8($val->room_thinking,0,20,false);?>
											</td>

											<td><?php echo $val->room_downs;?></td>
											<td><?php if($val->room_type == 1)echo "平面";else echo "3D";?></td>
									

											<td class="hidden-480"><?php echo $val->room_subtime;?></td>
					
											<td>
											<?php if($val->room_status == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val->room_status == 11){?>
											<span class="label label-danger">屏蔽</span>
											<?php }elseif($val->room_status == 21){?>
											<span class="label label-info">草稿</span>
											<?php }elseif($val->room_status == 12){?>
											<span class="label label-warning" >申述</span>
											<?php }?>
											</td>
											
											
											<td>
									
											 <a href="<?php echo site_url('admin/room/addProduct').'?room_id='.$val->room_id; ?>" >
											 	添加装修单项
											 </a>

											</td>
											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
					
													<ul class="dropdown-menu">
											
														<?php if($val->room_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->room_id; ?>,'room');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val->room_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->room_id;?>,'room');"><span class="label label-danger">屏蔽</span></a></li>
														<?php }?>
														<?php if($val->room_status != 21){?>
														<li><a href="#" onclick="jsv.status('21',<?php echo $val->room_id;?>,'room');"><span class="label label-info">草稿</span></a></li>
														<?php }?>
														
														<?php if($val->room_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->room_id;?>,'room');"><span class="label-warning">申述</span></a></li>
														<?php }?>
													
													</ul>
							
												</li>
											</ul>
											
											
											</td>
					
											<td>
											<a href="#" onclick="jsv.room_is_hot('<?php if($val->room_is_hot == '' || $val->room_is_hot == 0 ){echo '1';}else{echo 0;}?>','<?php echo $val->room_id;?>','room');">
											<?php if(isset($val->room_is_hot) && $val->room_is_hot == 1){
											echo "取消热门";}else{ echo "推荐热门";}?>
											</a>
											
											</td>
											<td>
											<?php if($val->room_status !=21){?>
											<a href="<?php echo site_url('admin/room/item').'?room_id='.$val->room_id;?>">清单项详细</a>
											<?php }?>
											<?php if($val->room_type == 2 && $val->room_status !=21){?>|
											<a href="<?php echo site_url('admin/room/roomShow').'?room_id='.$val->room_id;?>">预览并生成xml</a>
											<?php }else{?>
											暂无
											<?php }?>
											</td>
										
										</tr>
										<?php }?>

									</tbody>
									<tfooter>
									<tr><td colspan='12' style="text-align:center;" class="pagination"><?php echo $p;?></td></tr>
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
