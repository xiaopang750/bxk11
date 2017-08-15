<script id="inspir_tag" type="text/html">
<div class="inner clearfix pt_7">
	<div class="tag_left fl pl_17 pr_15 mt_2">
		热门主题({{tagnum}}个主题):
	</div>
	<div class="tag_main fl pr_15" script-role="data_wrap">
		{{each taglist}}
			<a href="{{$value.url}}" script-role="tag">{{$value.tag}}</a>
		{{/each}}
	</div>
	<div class="tag_right fl mt_2">
		<a href="javascript:;" script-role="show_all" {{if tagnum<9}}style="display:none"{{/if}}>+全部展开</a>
	</div>
</div>
</script>