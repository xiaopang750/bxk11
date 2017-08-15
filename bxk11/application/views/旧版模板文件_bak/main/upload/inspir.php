<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<?php loadInclude('/lib/global/meta.php')?>
<link rel="stylesheet" type="text/css" href="<?php loadStatic('/css/main/upload/upload.css')?>"/>
</head>
<body main_type="灵感">
<?php loadInclude('/lib/global/header.php')?>
<div class="upload main_content" script-role="upload_type" upload_type="分享家居灵感">
	
	<?php loadInclude('/lib/upload/nav.php')?>

	<div class="upload_main" script-bound="inspir_check">
		<div class="inner">

			<div class="input_area clearfix">
				<div class="label">
					<span>灵感标题</span>
				</div>
				<div class="input">
					<input type="text" class="text" form_check="sys" ischeck="true" name="title"  tip="标题不能为空" wrong="请输入25个字以内的标题" re="[(a-zA-Z0-9)|(\u4e00-\u9fa5)|\s]{1,25}"/>
				</div>
			</div>

			<div class="input_area clearfix">
				<div class="label">
					<span>选择灵感辑</span>
				</div>
				<div class="input">
					<select class="select" form_check="sys" ischeck="true" name="name" tip="请选择项目灵感辑" wrong="请选择项目灵感辑" re=".+">
					</select>
					<input type="text" class="text inspir_input" form_check="sys" ischeck="true" name="name"  tip="灵感辑名称不能为空" script-role="create_inspir" wrong="请输入10个字以内的灵感辑名称" re="[(a-zA-Z0-9)|(\u4e00-\u9fa5)|\s]{1,10}"/>
				</div>
			</div>

			<div class="input_area clearfix" script-role="upload_pic_area">
				<?php loadInclude('/lib/upload/upload_area.php')?>
			</div>
			<div class="clearfix"></div>

			<div class="input_area clearfix" script-role="upload_tag_area">
				<?php loadInclude('/lib/upload/tag.php')?>
			</div>

			<?php loadInclude('/lib/upload/btn.php')?>

		</div>
	</div>
</div>
<?php loadInclude('/lib/global/common_temp.php')?>
<?php loadInclude('/lib/global/footer.php')?>
<?php loadInclude('/lib/global/box.php')?>
<script type="text/javascript">
	<?php echo $config?>
</script>
<script src="<?php loadStatic('/script/seajs/sea.js')?>"></script>
<script src="<?php loadStatic('/script/config/jia178config.js')?>"></script>
<script>
	seajs.use('/static/script/main/upload/inspir.js');
</script>
</body>
</html>
