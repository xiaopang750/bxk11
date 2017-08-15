<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线申请加盟</title>
<?php include '../include/meta.php' ?>
<?php include '../include/globalcss.php' ?>
<link rel="stylesheet" href="../../css/main/regist.css" />
</head>
<body>

<div class="regist_box">
	<div class="title tc white font_14">欢迎加盟灵感无限</div>
	<div class="content pt_20">
		<div class="form">
			<div class="form-group">
				<label class="label-control fl col-2">商品名称:</label>
				<input type="text" class="form-control fl col-3" />
			</div>

			<div class="form-group">
				<label class="label-control fl col-2">联系人:</label>
				<input type="text" class="form-control fl col-3" />
			</div>

			<div class="form-group">
				<label class="label-control fl col-2">联系电话:</label>
				<input type="text" class="form-control fl col-3" />
			</div>

			<div class="form-group">
				<label class="label-control fl col-2">所在地区:</label>
				<select class="fl col-2 form-control mr_10">
					<option value="">11</option>
				</select>
				<select class="fl col-2 form-control">
					<option value="">11</option>
				</select>
			</div>

			<div class="form-group">
				<label class="label-control fl col-2">门店地址:</label>
				<input type="text" class="form-control fl col-4" />
			</div>

			<form action="">
				<div class="form-group">
					<label class="label-control fl col-2">上传门店照片:</label>
					<input type="file" class="mt_5" />
				</div>
				<iframe frameborder="0" name="" class="uploadframe"></iframe>
			</form>

			<form action="">
				<div class="form-group">
					<label class="label-control fl col-2">上传品牌授权
:</label>
					<input type="file" class="mt_5" />
				</div>
				<iframe frameborder="0" name="" class="uploadframe"></iframe>
			</form>

			<form action="">
				<div class="form-group">
					<label class="label-control fl col-2">上传营业执照:</label>
					<input type="file" class="mt_5" />
				</div>
				<iframe frameborder="0" name="" class="uploadframe"></iframe>
			</form>

			<form action="">
				<div class="form-group">
					<label class="label-control fl col-2">上传组织机构代码证:</label>
					<input type="file" class="mt_5" />
				</div>
				<iframe frameborder="0" name="" class="uploadframe"></iframe>
			</form>

			<div class="form-group">
				<label class="label-control fl col-2">验证码:</label>
				<input type="text" class="form-control fl col-1" />
				<img src="" alt="" class="fl" height="34" />
			</div>

			<div class="form-group">
				<label class="label-control fl col-2 agree">
					<input type="checkbox"/>
				</label>
				<span>我已阅读并同意</span>
				<a href="#">《灵感无限加盟协议》</a>
			</div>
			
			<div class="tc">
				<button class="btn btn-success">马上申请加盟</button>
			</div>
		</div>
	</div>
</div>

<script src="/seajs/sea.js"></script>
<script src="/seajs/config.js"></script>
<script>

	//入口文件
	//seajs.use('main/index.js');

</script>
</body>
</html>