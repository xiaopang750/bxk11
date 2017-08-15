<?php
	/**
	 *description:
	 *author:冀帅
	 *QQ:75426585
	 *date:2014-7-16
	 */
?>
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
	width: 600px;
}

#sub {
	margin-left: 140px;
}
</style>
<div class="page-content">
	<div id="manage_content">
		<h3 class="page-title">模块修改</h3>
		<ul>
			<li><a href="<?php echo site_url('178admin/ad/pageadd');?>">页面添加</a></li>
			<li><a href="<?php echo site_url('178admin/ad/modeladd');?>">模块添加</a></li>
		</ul>
		<div id="add_form">
			<form action="<?php echo site_url('178admin/ad/pagesave?id='.$id);?>"
				method="post">
					<?php if($res->apm_pid != 0){?>
								页面选择：<select name="model_pid">
					<option>请选择页面</option>
													<?php echo $option_str;?>
														</select><br />
					<?php };?>

					页面名称：<input type="text" name="page_name"
					value="<?php echo $res->apm_name;?>" /><br /> 页面说明：
				<textarea rows="5" cols="50" name="page_intro"><?php echo $res->apm_desc;?></textarea>
				<br /> <input type="submit" id="sub" value="修改" />

			</form>
		</div>
	</div>
</div>