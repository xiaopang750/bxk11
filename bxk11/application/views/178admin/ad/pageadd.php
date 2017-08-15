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
	width:360px;
}
#sub{
	margin-left:140px;
}
</style>
<div class="page-content">
	<div id="manage_content">
		<h3 class="page-title">页面添加</h3>
		<ul>
			<li><a href="<?php echo site_url('178admin/ad/page');?>">页面管理</a></li>
			<li><a href="<?php echo site_url('178admin/ad/pageadd');?>">页面添加</a></li>
			<li><a href="<?php echo site_url('178admin/ad/modeladd');?>">模块添加</a></li>
		</ul>
		<div id="add_form">
			<form action="<?php echo site_url('178admin/ad/pagesave');?>" method="post">
				页面名称：<input type="text" name="page_name" /><br /> 页面说明：
				<textarea rows="5" cols="300" name="page_intro"></textarea>
				<br /> <input type="submit" id="sub" value="确认添加" />

			</form>
		</div>
	</div>
</div>