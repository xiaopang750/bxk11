							<div class="portlet-body">
								<form action="<?php echo site_url('admin/shop/doShopCallback');?>" enctype="multipart/form-data" method="POST" >
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
										<?php if($shop_flg == 1){?>
										<tr>
											<td colspan='4' style='text-align:right;'><span>设置旗舰店：</span></td>
											<td colspan='4'>
													&nbsp;
													<?php if($shop_re){?>
														<?php foreach ($shop_re as $key => $value) { ?>
					
															<label class="radio">
																<input type="radio" name="shop_fei" value="<?php echo $value['shop_id'];?>" checked/>
																<?php echo $value['shop_name'];?>
															</label>
															
														<?php }?>
													<?php }else{?>
														暂无分店
													<?php }?>
											  
											</td>	
										</tr>
										<tr>
										
											<td colspan='8'>
												<span>
													*旗舰店置为非旗舰店，则必需选择一个分店置为旗舰店，不选择或者没有分店的情况下该服务商停用
											    </span>
											</td>
										</tr>
										<?php }?>
										
										
										<tr>
											<input id='shop_status' type='hidden'  name='shop_status' value="<?php if(isset($shop_status) && $shop_status) echo $shop_status;?>"/>
											<input id='shop_id' type='hidden' name='shop_id' value="<?php if(isset($shop_id) && $shop_id) echo $shop_id;?>"/>
											<input id='service_id' type='hidden' name='service_id' value="<?php if(isset($service_id) && $service_id) echo $service_id;?>"/>
											<input id='shop_flg' type='hidden' name='shop_flg' value="<?php if(isset($shop_flg) && $shop_flg) echo $shop_flg;?>"/>
											<input id='service_id_feidian' type='hidden' name='service_id_feidian' value="<?php if(isset($service_id_feidian) && $service_id_feidian) echo $service_id_feidian;?>"/>
											
											<td colspan='4' style='text-align:right;'><input class="btn red" type="submit" value="提交"></td>
											<td colspan='4'><input class="btn gray" type='reset' value='取消' onclick="myDialog.close()"></td>
										</tr>
										
										
									</tbody>

								</table>
							</form>
							</div>
