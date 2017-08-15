
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

							<li><a href="#">博文列表 </a></li>

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

								<div class="caption"><i class="icon-cogs"></i>博文</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="<?php echo site_url('admin/blog/index')?>" method='get'>
										<div class="chat-form">
										
										 	博文状态  :
										<select class="header-option m-wrap small" name='content_status'>
											<option value="" <?php if($content_status == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($content_status == 1) echo "selected";?>>正常</option>
											<option value="11" <?php if($content_status == 11) echo "selected";?>>屏蔽</option>
											<option value="21" <?php if($content_status == 21) echo "selected";?>>草稿</option>
											<option value="12" <?php if($content_status == 12) echo "selected";?>>申述</option>
											<option value="2" <?php if($content_status == 2) echo "selected";?>>首页推荐</option>
											<option value="3" <?php if($content_status == 3) echo "selected";?>>频道推荐</option>
										</select>
										 	
											博文类型  :
										<select class="header-option m-wrap small" name='content_type'>
											<option value="" <?php if($content_type == '') echo "selected";?>>请选择</option>
											<option value="1" <?php if($content_type == 1) echo "selected";?>>灵感博文 </option>
											<option value="2" <?php if($content_type == 2) echo "selected";?>>家居美图</option>
											
										</select>
										
										 发表始时间：

										<div class="input-append">
											<input name='a_start' class="m-wrap m-ctrl-medium date-picker" type="text" value="" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>

										 发表结时间：

										<div class="input-append">
											<input name='a_end' class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php if($a_end){echo $a_end;}else{echo date('Y-m-d',time());}?>" size="16" onfocus="this.className='text2';rcalendar(this);" onblur="this.className='text'">
											<span class="add-on">
											<i class="icon-calendar"></i>
											</span>
										</div>
										
										<br/><br/>
											发表人昵称:
										<input  type="text"  class="m-wrap" name ='user_name' placeholder=" 用户名..." value="<?php echo $user_name;?>">
											
											博文标题:
										<input  type="text"  class="m-wrap span6" name ='content_title' placeholder=" 标签名..." value="<?php echo $content_title;?>">
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

											<th>博文标题</th>
											<th>发博文者</th>
											<th>博文内容</th>
											<th>浏览人次</th>
											<th>博文类型</th>

											<th class="hidden-480">发表时间</th>

											<th>问题状态 </th>
											<th>审核</th>
		
										</tr>

									</thead>

									<tbody>

										<?php foreach ($re as $val){?>
										<tr>

											<td><?php echo $val->content_id;?></td>
											<td><a href="<?php echo site_url('content/designinfo').'?cid='.$val->content_id;?>" target="_left"><?php echo cn_substr_utf8($val->content_title,0,10);?> </a></td>
											<td><a href="<?php echo site_url('user/index').'/'.$val->user_id;?>" target="_left"><?php echo cn_substr_utf8(get_tag_name('t_user_model',$val->user_id,'user_nickname'),0,10);?></a></td>
											<td>
											<ul class="dropdown" id="header_inbox_bar">

											<a href="<?php echo site_url('content/designinfo').'?cid='.$val->content_id;?>" class="dropdown-toggle" data-toggle="dropdown"  target="_blank">
				
											<?php echo cn_substr_utf8(question_content($val->content_content,'content_content','content'),0,20,true);?>
					
											<span class="badge">查看</span>
					
											</a>
					
											<ul class="dropdown-menu extended inbox">

												<li>
			
												<p>	<?php echo cn_substr_utf8(question_content($val->content_content,'content_content','content'),0,25,false);?></p>
			
												</li>
										
												<?php foreach(question_content($val->content_content,'pic_md5','content') as $key=>$vals){?>
			
												<li>
				
												<a href="<?php echo site_url('content/designinfo').'?cid='.$val->content_id;?>" target="_blank">
				
				
												<span class="photo"><img src="<?php echo $vals['thumb_2']?>" alt="问题图片" /></span>
				
				
												<span class="subject">
				
													<?php echo $vals['pic_content'];?>
				
												</span>
				
												</a>
				
												</li>
				
												<?php }?>
				
												<li class="external">
					
													<a href="<?php echo site_url('content/designinfo').'?cid='.$val->content_id;?>"  target="_blank"> 详细内容 <i class="m-icon-swapright"></i></a>
					
												</li>
					
										</ul>

										</ul>
											
											
											
											
											
											</td>

											<td><?php echo $val->content_views;?></td>
											<td><?php if($val->content_type == 1)echo "灵感博文";else echo "家居美图";?></td>
									

											<td class="hidden-480"><?php echo $val->content_subtime;?></td>

											<td>
											<?php if($val->content_status == 1){?>
											<span class="label label-success">正常</span>
											<?php }elseif($val->content_status == 11){?>
											<span class="label label-danger">屏蔽</span>
											<?php }elseif($val->content_status == 21){?>
											<span class="label label-info">草稿</span>
											<?php }elseif($val->content_status == 12){?>
											<span class="label label-warning" >申述</span>
											<?php }elseif($val->content_status == 2){?>
											<span class="label">首页推荐</span>
											<?php }else if($val->content_status == 3){?>
											<span class="label">频道推荐</span>
											<?php }?>
											</td>
											<td>
											<ul class="nav">
												<li class="dropdown user">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
													<span class="username">审核</span>
													<i class="icon-angle-down"></i>
													</a>
					
													<ul class="dropdown-menu">
														<?php if($val->content_status != 3){?>
														<li><a href="#" onclick="jsv.status('3',<?php echo $val->content_id;?>,'content');"><span class="label">频道推荐</span></a></li>
														<?php }?>
														<?php if($val->content_status != 1){?>
														<li><a href="#" onclick="jsv.status('1',<?php echo $val->content_id; ?>,'content');"><span class="label label-success">正常</span></a></li>
														<?php }?>
														<?php if($val->content_status != 11){?>
														<li><a href="#" onclick="jsv.status('11',<?php echo $val->content_id;?>,'content');"><span class="label label-danger">屏蔽</span></a></li>
														<?php }?>
														<?php if($val->content_status != 21){?>
														<li><a href="#" onclick="jsv.status('21',<?php echo $val->content_id;?>,'content');"><span class="label label-info">草稿</span></a></li>
														<?php }?>
														
														<?php if($val->content_status != 12){?>
														<li><a href="#" onclick="jsv.status('12',<?php echo $val->content_id;?>,'content');"><span class="label-warning">申述</span></a></li>
														<?php }?>
														<?php if($val->content_status != 2){?>
														<li><a href="#" onclick="jsv.status('2',<?php echo $val->content_id;?>,'content');"><span class="label">首页推荐</span></a></li>
														<?php }?>

													</ul>
							
												</li>
											</ul>
											</td>
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
