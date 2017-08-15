<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>家178-博文导入</title>
</head>
<style>
body{

	margin:0px;
	padding:0px;
}


.header_top{
	margin:auto;
	text-align:center;
	line-height:100px;
	height:300px;
	width:900px;
	border-radius:5px;
	background-color:#4B5A39;	
	font-weight:bold;
	font-size:30px;
	margin-top:80px;
}

</style>
<body >
<div class="header_top">
Excel导入
<form action="" method='post' enctype='multipart/form-data' name='fr'>
    <input type="file" name="file">
    <input type="button" name="submit_shaomiao" value="扫 描"><!-- <input type="submit" name="submit_upload" value="上  传"> -->&nbsp<a href="<?php echo site_url('admin/t_admin_importexception/down_file')."?flg=1"?>">下载模板</a>
</form>
<script>
window.onload=function(){
	$obj = document.getElementsByTagName('input')[1];//扫描
	$oForm = document.getElementsByTagName('form')[0];
	var btn=true;
	var t = 1;
	$obj.onclick=function(){
		if(btn){
				$oForm.setAttribute('action',"<?php echo site_url('admin/t_admin_importexception/upload_file')."?flg=1"?>");
				$oForm.submit();
				btn=false;
		}
		
	};

};
</script>
</form>
</div>


</body>

</html>