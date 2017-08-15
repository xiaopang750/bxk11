<script id="product_list" type="text/html">
{{each data}}
<li>
	<div class="inner">
		<a href="{{$value.product_url}}"><img src="{{$value.product_pic}}" width="299" height="192" target="_blank" /></a>
		<div class="mt_10 clearfix mb_18">
			<span class="fl">{{$value.product_name}}</span>
			<div class="fr">
				<span class="view_ico icon178 fl pr_10">浏览</span>
				<a href="{{$value.product_url}}" class="blue fl" target="_blank">产品详情</a>
			</div>
		</div>
		<div class="mb_5">
			<span>规格：{{$value.product_size}}</span>
		</div>
		<div>
			关键词：
			{{each $value.tag_list}}
				<a href="{{$value.tag_url}}" target="_blank">{{$value.tag_name}}</a>
			{{/each}}
		</div>
	</div>
</li>
{{/each}}
</script>