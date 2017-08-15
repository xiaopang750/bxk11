							<div class="portlet-body">
								<form action="<?php echo site_url('admin/member/doUpdatePwdCallback');?>" enctype="multipart/form-data" method="POST" onsubmit='return jsv.pwdCallback();'>
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>密码重置</th>
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
											<td colspan='4' style='text-align:right;'><span>*输入新密码:</span></td>
											<td colspan='4'>
												<input name='newPwd' id='newPwd' type='password' class="m-wrap medium">
											</td>
										</tr>
										<tr>
											<td colspan='4' style='text-align:right;'><span>*确认新密码:</span></td>
											<td colspan='4'>
												<input name='newActPwd' id='newActPwd' type='password' class="m-wrap medium">
											</td>
										</tr>

										
										<tr>
											<input id='service_id' type='hidden'  name='service_id' value="<?php if(isset($service_id) && $service_id) echo $service_id;?>"/>
											
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消' onclick="myDialog.close()"></td>
											
										</tr>
										
										
									</tbody>

								</table>
							</form>
							</div>
