<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="<?php echo viewurl.'style/info.css';?>">
</head>
<body>
	<div id = "info" class="succ">
		<i></i>
		<?php
			echo '<p class="big">'.$info.'</p>';
		?>
		<p>正在进行跳转....</p>
		<p class = "small">如果没有跳转请<a href="<?php echo $url;?>">点此返回</a></p>
		<script type="text/javascript">
			window.onload = function(){
				setTimeout("window.location.href = '<?php  echo $url;?>';",1000);
			}
		</script>
</div>