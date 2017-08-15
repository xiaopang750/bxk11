<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>t_system_score 详细</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<style type="text/css">
	table		{ background:#EEE; width:100%; }
	table td	{ background:#FFF; }
	.td1		{ width: 300px; font-weight:bold; text-align: right;}
</style>
</head>

<body>
	<h1>积分设置 详细</h1>
	<div id="info">
		<table cellpadding="5" cellspacing="1" border="0">
			<tr>
<td class="td1">score_id</td><td><?php echo empty($detail->score_id)? '': $detail->score_id; ?></td>
</tr>
<tr>
<td class="td1">score_name</td><td><?php echo empty($detail->score_name)? '': $detail->score_name; ?></td>
</tr>
<tr>
<td class="td1">score_get</td><td><?php echo empty($detail->score_get)? '': $detail->score_get; ?></td>
</tr>
<tr>
<td class="td1">score_daily_max</td><td><?php echo empty($detail->score_daily_max)? '': $detail->score_daily_max; ?></td>
</tr>
<tr>
<td class="td1">score_gold</td><td><?php echo empty($detail->score_gold)? '': $detail->score_gold; ?></td>
</tr>
<tr>
<td class="td1">score_2</td><td><?php echo empty($detail->score_2)? '': $detail->score_2; ?></td>
</tr>
<tr>
<td class="td1">score_3</td><td><?php echo empty($detail->score_3)? '': $detail->score_3; ?></td>
</tr>
<tr>
<td class="td1">score_4</td><td><?php echo empty($detail->score_4)? '': $detail->score_4; ?></td>
</tr>

		</table>
	</div>
	<br/>
	<div>
<?php $this->load->helper('url'); ?>
		<a href="<?php echo site_url('admin/score/edit/'); ?><?php echo empty($detail->score_id)? '': '/'.$detail->score_id; ?>">编辑</a>
		<a href="<?php echo site_url('admin/score/delete/'); ?><?php echo empty($detail->score_id)? '': '/'.$detail->score_id; ?>">删除</a>
	</div>
</body>
</html>
<!-- Generator By "Auto Codeigniter" At 2013/11/21 16:14:40 
*        dinghaochenAuthor: 丁昊臣
*        Email: dotnet010@gmail.com
-->
