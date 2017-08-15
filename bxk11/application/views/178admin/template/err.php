<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="<?php echo viewurl.'style/info.css';?>">
</head>
<body>
	<div id = "info" class="err">
		<i></i>
		<?php
			echo '<p class="big">'.$info.'</p>';
		?>
		<p>正在进行跳转(3s)</p>
		<p class = "small">如果没有跳转请<input type="button" onclick="history.back();" value="立即返回" /></p>
		<script type="text/javascript">
			window.onload = function(){
				setTimeout("history.back();",3000);
			}
		</script>
		<?php exit();?>
</div>