<?php
	/**
	 *description:
	 *author:冀帅
	 *QQ:75426585
	 *date:2014-7-16
	 */
?>
<style type="text/css">
	#manage_content{
		padding-left:100px;
		pasition:absolute;
	}
	#info_tab{
		text-align:center;
	}
	#info_tab tr {
		line-height:30px;
	}
</style>
<div class="page-content">
	<div id="manage_content">
		<h3 class="page-title">模块管理</h3>
		<ul>
		<li><a href="<?php echo site_url('178admin/ad/page');?>">页面管理</a></li>
			<li><a href="<?php echo site_url('178admin/ad/pageadd');?>">页面添加</a></li>
			<li><a href="<?php echo site_url('178admin/ad/modeladd');?>">模块添加</a></li>
		</ul>
		<table border="1" id="info_tab">
			<tr>
				<th width="200">页面名称</th>
				<th width="200">页面描述</th>
				<th width="200">操作</th>
			</tr>
		<?php foreach ($page as $v){?>
			<tr>
				<td><?php echo $v->apm_name;?></td>
				<td><?php echo $v->apm_desc;?></td>
				<td><a class="is_del" href="<?php echo site_url('178admin/ad/del?id='.$v->apm_id);?>">删除</a>
				<a href="<?php echo site_url('178admin/ad/modeledit?id='.$v->apm_id);?>">修改</a>
				</td>
			</tr>
			<?php };?>
		</table>
	</div>
</div>
<script type="text/javascript"
	src="<?php echo ADMIN_PUBLIC_URL.'js/jquery.js';?>"></script>
<script type="text/javascript" src='/application/views/admin/ad/ad.js'></script>