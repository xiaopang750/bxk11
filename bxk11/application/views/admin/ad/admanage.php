<style type="text/css">
#manage_content {
	padding-left: 100px;
	pasition: absolute;
}

#info_tab {
	text-align: center;
}

#info_tab tr {
	line-height: 30px;
}

#add_form {
	width: 720px;
}

#sub {
	margin-left: 140px;
}
</style>
<div class="page-content">
	<div id="manage_content">
		<h3 class="page-title">广告管理</h3>
		<ul>
			<li><a href="<?php echo site_url('admin/ad/pageadd');?>">页面添加</a></li>
			<li><a href="<?php echo site_url('admin/ad/modeladd');?>">模块添加</a></li>
			<li><a href="<?php echo site_url('admin/ad/adadd');?>">广告添加</a></li>
		</ul>
		<div id="add_form">
			<form action="<?php echo site_url('posts/ad/page');?>" method="post">
				页面选择：<select name="page_id" id="page"><option>请选择页面</option>
													<?php echo $option_str;?>
								</select>模块选择：<select name="module_id" id="module">
					<option>请选择模块</option>
				</select> <input id="select_model" type="button" value="查找" />
				<table border="1" id="ad_tab">

				</table>

			</form>

		</div>
	</div>
</div>
<script>var option_url = "<?php echo site_url('admin/ad/option_module');?>"</script>
<script>var tab_url = "<?php echo site_url('admin/ad/getall');?>"</script>
<script type="text/javascript" src='/application/views/admin/ad/ad.js'></script>
<!-- END PAGE -->