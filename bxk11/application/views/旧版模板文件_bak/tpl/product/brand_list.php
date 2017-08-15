<script id="tpl_brand_list" type="text/html">
<div class="brand_list_top clearfix">
	<select class="fl ml_13 mt_6 mr_13 inline">
		<option value="">北京</option>
	</select>
	<span class="fl">地区实体店共<span class="yellow">{{data.servicelist.length}}</span>家</span>
</div>
<div class="brand_list_main">
	<ul script-role="brand_list_wrap">
		{{each data.servicelist}}
			<li><span class="list_name">{{$index + 1}}.</span><a href="{{$value.service_url}}">{{$value.service_name}}</a></li>
		{{/each}}
	</ul>
</div>
</script>