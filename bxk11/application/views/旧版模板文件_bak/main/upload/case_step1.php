<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/upload/upload.css')?>"/>
</head>
<body main_type="案例">
<?php loadInclude('/lib/global/header.php')?>
<div class="upload main_content" script-role="upload_type" upload_type="发布装修案例" step_type="1">
	<?php loadInclude('/lib/upload/case_nav.php')?>

	<div class="upload_main case1" script-bound="step1_check">
		
		<div class="inner">
			<!-- 装修项目 -->
			<div class="input_area clearfix">
				<div class="label">
					<span>选择装修项目</span>
				</div>
				<div class="input">
					<select class="select" form_check="sys" ischeck="true" name="project_name" tip="请选择项目名称" wrong="请选择项目名称" re=".+" script-role="project">
						<option value="">请选择</option>
					</select>
					<input type="text" class="text inspir_input" form_check="sys" ischeck="true" name="project_name"  tip="项目名称不能为空" script-role="create_inspir" wrong="请输入10个字以内的项目名称" re="[(a-zA-Z0-9)|(\u4e00-\u9fa5)|\s]{1,10}"/>
				</div>
			</div>
			
			<!-- 地区 -->
			<div class="input_area clearfix">
				<div class="label">
					<span>所在地区</span>
				</div>
				<div class="input">
					<select class="select pr_city mr_20" script-role="province"></select>
					<select class="select pr_city" script-role="city" form_check="sys" ischeck="false" name="house_city"></select>
				</div>
			</div>
			<!-- 楼盘名称户型 -->
			<div class="clearfix bulding_area input_area">
				<div class="input_area fl">
					<div class="label">
						<span>楼盘名称</span>
					</div>
					<div class="input">
						<input type="text" class="text building_name" form_check="sys" ischeck="true" name="house_name"  tip="楼盘名称不能为空" script-role="building_name" wrong="请输入10个字以内的楼盘名称" re="[(a-zA-Z0-9)|(\u4e00-\u9fa5)|\s]{1,20}"/>
					</div>
				</div>

				<div class="input_area fl">
					<div class="label">
						<span>户型</span>
					</div>
					<div class="input">
						<select class="select type" form_check="sys" ischeck="true" name="apartment_category_id" tip="请选择户型" re=".+" script-role="house_type">
							<option>请先选择楼盘名称</option>
						</select>
					</div>
				</div>
			</div>
			<!-- 上传显示 -->
			<div class="input_area clearfix">
				<div class="label">
					<span>户型图</span>
				</div>
				<div class="input" tip="请至少上传或选择一张户型图" name="tag_namelist" form_check="self" ischeck="true">
					<ul class="upload_list clearfix" script-role="list_wrap" id="step1_list">
						<li class="pic_list">
							<dl>
								<dt script-role="upload_btn_area"></dt>
								<dd>
									<p class="pt_15">上传原始户型图 </p>
								</dd>
							</dl>
						</li>
					</ul>
				</div>
			</div>

			<!-- 面积，预算，客户称谓 -->
			<div class="clearfix input_area">
				<div class="fl">
					<div class="label">
						<span>户型面积</span>
					</div>
					<div class="input">
						<input type="text" class="text squre" form_check="sys" ischeck="true" name="apartment_size"  tip="面积不能空" script-role="squre" wrong="您输入的格式不正确" re="\d{1,5}"/>
						<span class="ml_5 font_14">平米</span>
					</div>
				</div>

				<div class="fl">
					<div class="label">
						<span>装修预算</span>
					</div>
					<div class="input">
						<input type="text" class="text price" form_check="sys" ischeck="true" name="project_budget"  tip="价格不能空" script-role="price" wrong="您输入的格式不正确" re="\d{1,20}"/>
						<span class="ml_5 font_14">万元</span>
					</div>
				</div>

				<div class="fl">
					<div class="label">
						<span>客户称谓</span>
					</div>
					<div class="input">
						<input type="text" class="text namespace" form_check="sys" ischeck="true" name="project_owner"  tip="客户称谓不能空" script-role="namespace" wrong="请输入10个字以内的客户称谓" re="[(a-zA-Z)|(\u4e00-\u9fa5)|\s]{1,5}"/>
					</div>
				</div>
			</div>

			<!-- 装修需求 -->
			<div class="input_area clearfix">
				<div class="label">
					<span>装修需求</span>
				</div>
				<div class="input">
					<textarea type="text" class="text need" form_check="sys" ischeck="true" name="project_demand"  tip="装修需求不能空" script-role="need" wrong="请输入200个字以内的装修需求" re=".{1,200}"></textarea>
				</div>
			</div>

			<!-- 生成项目名称 -->
			<div class="clearfix bot">
				<div class="input_area fl">
					<div class="label">
						<span>项目名称</span>
					</div>
					<div class="input mt_4">
						<span class="font_14" script-role="project_name">省+市+楼盘名称+户型名称+面积+客户称谓</span>
					</div>
				</div>
				<div class="input_area fr" form_check="sys" ischeck="false" name="project_status" checkbox_group="1">
					<input type="checkbox" value="1" />
					<span class="font_14">设置公开</span>
				</div>
			</div>

			<?php loadInclude('/lib/upload/btn.php')?>

		</div>
	</div>
</div>

<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<?php loadInclude('/lib/global/common_temp.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/upload/case_step1.js');
</script>
</body>
</html>
