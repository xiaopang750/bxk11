<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>品时家居</title>
<link rel="stylesheet" type="text/css" href="../static/css/lib/reset/reset.css" />
<style>
	img {display: block;width: 100%;}
</style>
</head>

<body page-role="play_flat">
<!-- foc -->
<ul script-role="data_wrap">
	
</ul>

<script src="../seajs/sea.js"></script>
<script src="../seajs/config.js"></script>
<script id="data_list" type="text/html">
{{each data.pic_list}}
	<li><img src="{{$value.room_pic}}"></li>
{{/each}}
</script>
<script>
	seajs.use('main/flat.js');
</script>

</body>
</html>