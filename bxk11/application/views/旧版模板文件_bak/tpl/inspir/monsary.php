<script id="inspir_monsary" type="text/html">
<li>
<div class="top_area">
	{{each pic_list}}
		<a href="{{url}}"  target="_blank"><img src="{{$value.pic_url2}}" width="200" class="mb_5"></a>
	{{/each}}
</div>
<div class="bot_area">
	<dl class="mb_15">
		<dt class="mb_10 font_14">{{name}}</dt>
		{{each pic_list as value index}}
			{{if index==0}}
				<dd class="gray"><a href="{{url}}"  target="_blank">{{value.pic_content}}</a></dd>
			{{/if}}
		{{/each}}
	</dl>
	<div class="bot_fn clearfix">
		<span class="fl pr_8">
			<span class="view_ico icon178 fl mr_1">浏览</span>
			<span class="fl">
				<a href="javascript:;" class="blue default" title="浏览数">({{project_num}})</a>
			</span>
		</span>
		<span class="fl pr_8">
			<span class="arg_ico icon178 fl mt_4 mr_1">评论</span>
			<span class="fl">
				<a href="javascript:;" class="blue default" title="评论数">({{disc}})</a>
			</span>
		</span>
		<span class="fl">
			<span class="fav_ico icon178 fl mt_4 mr_1">喜欢</span>
			<span class="fl">
				<a href="javascript:;" class="blue default"  title="喜欢数">({{likes}})</a>
			</span>
		</span>
	</div>
</div>
</li>
</script>