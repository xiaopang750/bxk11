<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>积分设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<style type="text/css">
	table		{ background:#EEE; width:100%; }
	table td	{ background:#FFF; }
</style>
</head>

<body>
	<h1>t_system_score 列表</h1>
	<div id="record_list">
		<table cellpadding="5" cellspacing="1" border="0">
			<tr class="tr_header">
<td>score_id</td>
<td>score_name</td>
<td>score_get</td>
<td>score_daily_max</td>
<td>score_gold</td>
<td>score_2</td>
<td>score_3</td>
<td>score_4</td>
<td>查看详细</td>
<td>编辑</td>
<td>删除</td>
</tr>

			<?php foreach($list as $item) : ?>
			<tr class="tr_item">
<td><?php echo !isset($item->score_id)? '': $item->score_id; ?></td>
<td><?php echo !isset($item->score_name)? '': $item->score_name; ?></td>
<td><?php echo !isset($item->score_get)? '': $item->score_get; ?></td>
<td><?php echo !isset($item->score_daily_max)? '': $item->score_daily_max; ?></td>
<td><?php echo !isset($item->score_gold)? '': $item->score_gold; ?></td>
<td><?php echo !isset($item->score_2)? '': $item->score_2; ?></td>
<td><?php echo !isset($item->score_3)? '': $item->score_3; ?></td>
<td><?php echo !isset($item->score_4)? '': $item->score_4; ?></td>
<td><a href="<?php echo config_item("site_url"); ?>score/detail/<?php echo empty($item->score_id)? '': $item->score_id; ?>" target="_blank">查看详细</a></td>
<td><a href="<?php echo config_item("site_url"); ?>score/edit/<?php echo empty($item->score_id)? '': $item->score_id; ?>" target="_blank">编辑</a></td>
<td><a href="<?php echo config_item("site_url"); ?>score/delete/<?php echo empty($item->score_id)? '': $item->score_id; ?>" target="_blank">删除</a></td>
</tr>

			<?php endforeach; ?>
		</table>
		<br/>
		<div><?php echo $pagination; ?></div>
	</div>
</body>
</html>
<!-- Generator By "Auto Codeigniter" At 2013/11/21 16:14:40 
*        dinghaochenAuthor: 丁昊臣
*        Email: dotnet010@gmail.com
-->
