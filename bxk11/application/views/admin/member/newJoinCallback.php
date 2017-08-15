							<div class="portlet-body">
								<!-- onsubmit="return jsv.subnewJoin();" -->
								<form action="<?php echo site_url('admin/member/doNewJoinCallback');?>" enctype="multipart/form-data" method="POST" >
								<table class="table table-hover">
									<thead>
										<tr>
											<th colspan='8'>审核</th>
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

				<!-- 						<?php if($ss_type == 1){?>
										<tr  >
											<td colspan='4' style='text-align:right;'><span>充值卡号:</span></td>
											<td colspan='4'>
												<input id="rr_card_number" class="m-wrap medium" type="text" name="rr_card_number">
		
											</td>
										</tr>
										<?php }?> -->
										
										<tr>
											<input id='service_status' type='hidden'  name='service_status' value="<?php if(isset($service_status) && $service_status) echo $service_status;?>"/>
				
											<input id='service_id' type='hidden' name='service_id' value="<?php if(isset($re->service_id) && $re->service_id) echo $re->service_id;?>"/>
										
											<input id='spreader_code' type='hidden' name='spreader_code' value="<?php if(isset($re->spreader_code_source) && $re->spreader_code_source) echo $re->spreader_code_source;?>"/>

											<input id='ss_type' type='hidden' name='ss_type' value="<?php if(isset($ss_type) && $ss_type) echo $ss_type;?>"/>
											
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消' onclick="myDialog.close()"></td>
											
										</tr>
										
										
									</tbody>

								</table>
							</form>
							</div>
