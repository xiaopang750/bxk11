<script id="inspir_list" type="text/html">
{{each data}}
<li class="inspir_bg home_bg" album_id="{{$value.album_id}}" script-role="img_list">
	<div class="img_wrap">
		<img src="{{$value.album_pic}}" width="264" height="196" />
		<span class="inspir_name home_bg">{{$value.album_name}}</span>
	</div>
</li>
{{/each}}
</script>