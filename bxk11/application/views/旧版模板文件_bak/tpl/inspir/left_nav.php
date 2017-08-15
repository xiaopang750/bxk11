<script id="inspir_leftnav" type="text/html">
{{each data}}
<div class="list_wrap" script-role="list_wrap">
	<h3 class="clearfix" script-role="list_head" tab-index="{{$index}}">
		<span class="add_reduce icon178 fl mt_6" script-role="click_bg"></span>
		<span class="fl pl_2" script-role="click_title">{{$value.bname}}</span>
	</h3>
	<ul script-role="click_content">
		{{each $value.sname}}
			<li><a href="{{$value.url}}" script-role="click_tag">{{$value.name}}</a></li>
		{{/each}}
	</ul>
</div>
{{/each}}
</script>