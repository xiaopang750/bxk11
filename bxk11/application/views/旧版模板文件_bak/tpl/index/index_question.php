<script id="ques178_tpl" type="text/html">
{{each hotquestion}}
<li class="pb_20">
	<p class="mb_10">
		<span class="list_ico icon178 fl pr_5 mt_4">dot</span>
		<span>{{$value.title}}</span>
	</p>
	<p class="mb_10">
		<span>最新回复：</span>
		<span>{{$value.last_answer}}</span>	
	</p>
	<p>
		<a href="{{$value.url}}">{{$value.class_pname}}</a>
		<a href="{{$value.url}}">回复(<span>{{$value.answers}}</span>)</a>
	</p>
</li>
{{/each}}
</script>