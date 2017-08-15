<script id="recent_view" type="text/html">
{{each data}}
<li>
	<a href="{{$value.url}}" target="_blank"><img src="{{$value.pic_url}}" width="200" /></a>
	<p>{{$value.title}}<a href="{{$value.url}}" class="ml_5" target="_blank">[详细阅读]</a></p>
</li>
{{/each}}
</script>