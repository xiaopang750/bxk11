							<div class="portlet-body">
								<form action="<?php echo site_url('admin/member/doJoinCallback');?>" enctype="multipart/form-data" method="POST" >
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
											<input id='join_status' type='hidden'  name='join_status' value="<?php if(isset($join_status) && $join_status) echo $join_status;?>"/>
											<input id='join_id' type='hidden' name='join_id' value="<?php if(isset($join_id) && $join_id) echo $join_id;?>"/>
											<input id='service_id' type='hidden' name='service_id' value="<?php if(isset($service_id) && $service_id) echo $service_id;?>"/>
								
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消' onclick="myDialog.close()"></td>
											
										</tr>
										
										
									</tbody>

								</table>
							</form>
							</div>
