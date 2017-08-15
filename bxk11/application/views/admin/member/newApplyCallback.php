							<div class="portlet-body">
								<form action="<?php echo site_url('admin/member/doNewApplyCallback');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>反馈</th>
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
										
						
										<tr  >
											<td colspan='4' style='text-align:right;'><span>反馈内容:</span></td>
											<td colspan='4'>
												<textarea name='content'></textarea>
												
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>授权时间开始:</span></td>
											<td colspan='4'>
											<input type="text" name="apply_license_begin" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'" value="<?php if($re->apply_license_begin) echo $re->apply_license_begin;?>"/>
											
											</td>
								
										</tr>

										<tr>
											<td colspan='4' style='text-align:right;'><span>授权时间结束:</span></td>
											<td colspan='4'>
											<input type="text" name="apply_license_end" onfocus="this.className='text2';rcalendar(this,'full');" onblur="this.className='text'" value="<?php if($re->apply_license_begin) echo $re->apply_license_end;?>"/>
											</td>
								
										</tr>
										
										<tr>
											<input id='apply_status' type='hidden'  name='apply_status' value="<?php if(isset($apply_status) && $apply_status) echo $apply_status;?>"/>
											<input id='apply_id' type='hidden' name='apply_id' value="<?php if(isset($apply_id) && $apply_id) echo $apply_id;?>"/>
											<input id='apply_brand_name' type='hidden' name='apply_brand_name' value="<?php if(isset($apply_brand_name) && $apply_brand_name) echo $apply_brand_name;?>"/>
								
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消' onclick="myDialog.close()"></td>
											
										</tr>
										
										
									</tbody>

								</table>
							</form>
							</div>
