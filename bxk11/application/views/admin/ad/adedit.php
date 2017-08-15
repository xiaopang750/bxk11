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
	width: 360px;
}

#sub {
	margin-left: 140px;
}
</style>
<div class="page-content">
	<div id="manage_content">
		<h3 class="page-title">广告修改</h3>
		<ul>
			<li><a href="<?php echo site_url('admin/ad/pageadd');?>">页面添加</a></li>
			<li><a href="<?php echo site_url('admin/ad/modeladd');?>">模块添加</a></li>
		</ul>
		<div id="add_form">
			<form action="<?php echo site_url('admin/ad/adaddsave?id=').$id;?>"
				method="post" enctype="multipart/form-data">
				<input type="hidden" name="module_id"
					value="<?php echo $ad_info->apm_id;?>" /><br /> 广告位名称：<input
					type="text" name="ad_name" value="<?php echo $ad_info->ad_id;?>" /><br />
				广告位KEY：<input type="text" name="ad_key"
					value="<?php echo $ad_info->ad_title;?>" /><br /> 广告位描述：
				<textarea rows="5" cols="300" name="page_intro"><?php echo $ad_info->ad_desc;?></textarea>
				<br /> 广告图片：<input name="ad_pic" type="file"
					value="<?php echo $ad_info->ad_pic;?>" /><br /> 广告位类型：<label
					class="radio">
					<div class="radio">
						<span class=""><input type="radio" class="input_blur"
							name="ad_type" value="1" checked=""></span>
					</div>商品
				</label> <label class="radio">
					<div class="radio">
						<span class=""><input type="radio" class="input_blur"
							name="ad_type" value="2" checked=""></span>
					</div>方案
				</label> <label class="radio">
					<div class="radio">
						<span class=""><input type="radio" class="input_blur"
							name="ad_type" value="3" checked=""></span>
					</div>设计师
				</label> <label class="radio">
					<div class="radio">
						<span class=""><input type="radio" class="input_blur"
							name="ad_type" value="4" checked=""></span>
					</div>样板间
				</label> <label class="radio">
					<div class="radio">
						<span class=""><input type="radio" class="input_blur"
							name="ad_type" value="5" checked=""></span>
					</div>灵感集
				</label> <label class="radio">
					<div class="radio">
						<span class=""><input type="radio" class="input_blur"
							name="ad_type" value="6" checked=""></span>
					</div>装修用户
				</label> 推荐数据：<input type="text" name="recom"
					value="<?php echo $ad_info->ad_data_id;?>" /><br /> 广告链接：<input
					type="text" name="ad_url" value="<?php echo $ad_info->ad_url;?>" /><br />


				<input type="submit" value="修改广告" />
			</form>
		</div>
	</div>
</div>
<script>var option_url = "<?php echo site_url('admin/ad/option_module');?>"</script>
<script>var tab_url = "<?php echo site_url('admin/ad/getall');?>"</script>
<script type="text/javascript" src='/application/views/admin/ad/ad.js'></script>