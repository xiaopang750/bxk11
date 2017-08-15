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
		<h3 class="page-title">广告修改</h3>
		<ul>
			<li><a href="<?php echo site_url('178admin/ad/pageadd');?>">页面添加</a></li>
			<li><a href="<?php echo site_url('178admin/ad/modeladd');?>">模块添加</a></li>
		</ul>
		<div id="add_form">
			<form action="<?php echo site_url('178admin/ad/adaddsave?id=').$id;?>"
				method="post" enctype="multipart/form-data">
				<input type="hidden" name="module_id"
					value="<?php echo $ad_info->apm_id;?>" /><br /> 广告位名称：<input
					type="text" name="ad_name" value="<?php echo $ad_info->ad_title;?>" /><br />
				广告位 KEY：<input type="text" name="ad_key"
					value="<?php echo $ad_info->ad_key;?>" /><br /> 广告位描述：
				<textarea rows="5" cols="50" name="page_intro"><?php echo $ad_info->ad_desc;?></textarea>
				<br /> 
				广告图片：<input name="ad_pic" type="file"  /><br /> 
				<img height="50" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$ad_info->ad_pic;?>" /><br />
				广告位类型：
				<input type="radio" name= "ad_type" value="1"/>商品
				<input type="radio" name= "ad_type" value="2"/>方案
				<input type="radio" name= "ad_type" value="3"/>设计师
				<input type="radio" name= "ad_type" value="4"/>样板间
				<input type="radio" name= "ad_type" value="5"/>灵感辑
				<input type="radio" name= "ad_type" value="6"/>装修用户<br />
				推荐数据：<input type="text" name="recom"
					value="<?php echo $ad_info->ad_data_id;?>" /><br /> 广告链接：<input
					type="text" name="ad_url" value="<?php echo $ad_info->ad_url;?>" /><br />


				<input type="submit" value="修改广告" />
			</form>
		</div>
	</div>
</div>
<script>var option_url = "<?php echo site_url('178admin/ad/option_module');?>"</script>
<script>var tab_url = "<?php echo site_url('178admin/ad/getall');?>"</script>
<script type="text/javascript" src='/application/views/178admin/ad/ad.js'></script>