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

								<a href="#">权限授权</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">权限</a></li>

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

								<div class="caption"><i class="icon-edit"></i><?php if($la_name) echo "($la_name)";?>权限授权</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<form action="<?php echo site_url('admin/service/doRoleEdit');?>" enctype="multipart/form-data" method="POST">

							<div class="portlet-body">
								

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" >

										SAVE <i class="icon-plus"></i>

										</button>

									</div>
									
									<!-- <div class="btn-group">

										<button id="sample_editable_1_new" class="btn red" onclick="jsv.del_goods();">

										<i>	DELETE </i>

										</button>

									</div>
									 -->

								</div>

								
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

									<thead>

										<tr>
										
											<th>模块</th>
											
											<th>菜单</th>

											<th>页面</th>

										</tr>

									</thead>

									<tbody>

				<!-- 						main_1-1
										main_1-2
										main_1-3

										main_2-1
										main_2-2
										main_2-3 -->
									
										<?php foreach ($list as $key=>$val){?>
										
											<?php if($val['son']){foreach ($val['son'] as $ke=>$va){?>
												<tr >
													<?php if($ke == 0){?>
													<td rowspan='<?php echo $val['count'];?>'>
														<input  type="checkbox" name='newsletter' sc="main_<?php echo $key;?>_1" <?php if($val['is_selected'] == 1) echo "checked";?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?>
													</td>
													<?php }?>
													<td><input  type="checkbox" name='newsletter' sc="main_<?php echo $key;?>_2" <?php if($va['is_selected'] == 1) echo "checked";?> value="<?php echo $va['id'];?>"> <?php echo $va['name'];?></td>
													<td>
														<?php foreach ($va['son'] as $k=>$v){?>
															<input  type="checkbox" name='Threed[]' sc="main_<?php echo $key;?>_3" <?php if($v['is_selected'] == 1) echo "checked";?> value="<?php echo $v['id'];?>"> <?php echo $v['name'];?>
														<?php }?>

													</td>
												</tr>
											<?php }}else{?>

												<tr >
												
													<td>
														<input  type="checkbox" sc="main_<?php echo $key;?>_1" name='newsletter' <?php if($val['is_selected'] == 1) echo "checked";?> value="<?php echo $val['id'];?>"  name="ma_id[]"> <?php echo $val['name'];?>
													</td>
												
													<td></td>
													<td>
													</td>
												</tr>

											<?php }?>
											
										<?php }?>
										<input type='hidden' name='la_id' value="<?php if($id) echo $id;?>">
										</form>
										<script>

											var oTarget,
												sRole,
												lastDec,
												level,
												type,
												first;

											firstShow();	

											$(document).on('click','[sc^=main]', function(e){

												oTarget = $(e.target);
												sRole = oTarget.attr('sc');

												lastDec = sRole.lastIndexOf('_');
												level = sRole.substring(lastDec+1, lastDec+2);
												type = sRole.substring(0,lastDec);

												switch( level ) {

													case '1':
														toLevel1( oTarget,type );
													break;

													case '2':
														toLevel2( oTarget,sRole,type );
													break;

													case '3':
														toLevel3( oTarget,sRole,type );
													break;
												}		

											});

											function toLevel1(oThis,type) {

												var isChecked,
													aCheck;

												isChecked = judge(oThis);
												aCheck = $('[sc ^='+ type +']');

												if( isChecked ) {

													aCheck.attr('checked', true);

												} else {

													aCheck.attr('checked', false);
												}

												parentCheck(aCheck);

											}

											function toLevel2(oThis,name,type) {

												var aLevel3,
													aAllLevel2,
													isChecked,
													oNowLevel1;
													

												isChecked = judge(oThis);
												aLevel3 = oThis.parents('td').next().find('input[type=checkbox]');
												aAllLevel2 = $('[sc = '+  name +']');
												oNowLevel1 = $('[sc = '+ type +'_1]');

										
												
												if( isChecked ) {

													aLevel3.attr('checked', true);

												} else {

													aLevel3.attr('checked', false);
												}	

												parentCheck(aLevel3);

												judgeSelectAll( aAllLevel2, oNowLevel1);
												
											}

											function toLevel3(oThis,name,type) {

													var nowAllLevel3,
														isChecked,
														oPrevLevel,
														oNowLevel1,
														oNowLevel2,
														aLevel3;

													aLevel3 = oThis.parents('td').find('input[type=checkbox]');
													oPrevLevel = oThis.parents('td').prev().find('input[type=checkbox]');
													nowAllLevel3 = $('[sc = '+ name +']');
													oNowLevel1 = $('[sc = '+ type +'_1]');
													oNowLevel2 = $('[sc = '+ type +'_2]');

													judgeSelectAll( aLevel3, oPrevLevel);
													judgeSelectAll( nowAllLevel3, oNowLevel1 );
													judgeSelectAll( nowAllLevel3, oNowLevel2, function(){

														oNowLevel2.attr('checked','checked');
														parentCheck(oNowLevel2);

													}, function(){} );

											}

											function firstShow() {

												var allLevel3,
													name,
													type,
													lastDec;

												allLevel3 = $('[sc$=3]');

												allLevel3.each(function(i){

													name = allLevel3.eq(i).attr('sc');
													lastDec = name.lastIndexOf('_');
													type =  name.substring(0,lastDec);

													toLevel3(allLevel3.eq(i),name,type);

												});


											}

											function parentCheck(oCheck) {

												oCheck.parent().attr('class',oCheck.attr('checked') ? 'checked':'');

											}

											function judge(oThis) {

												var isChecked;

												isChecked = oThis.attr('checked');

												if( isChecked ) {

													return true;

												} else {

													return false;

												}

											}

											function judgeSelectAll(aCheck,oParent, fnYes, fnNo) {

												var result;

												result = true;

												aCheck.each(function(i){

													//isChecked = aCheck.eq(i).parent().hasClass('checked');

													isChecked = aCheck.eq(i).attr('checked');

													if( !isChecked ) {
														
														result = false;
														
													}

												});

												if( result ) {

													if( !fnYes ) {

														oParent.attr('checked', true);

														parentCheck(oParent);

													} else {

														fnYes();

													}

												} else {

													if( !fnNo ) {

														oParent.attr('checked', false);

														parentCheck(oParent);

													} else {

														fnNo();

													}

												}

											}
											

										</script>
									</tbody>
									<tfooter>
									
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
