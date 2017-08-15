<script id="indexContent178_tpl" type="text/html">
<div class="content_main">
	<div class="top">
	   <a href="{{url}}" target="_blank"><img src="{{pic_url}}" width="670"/></a>
	</div>
	<div class="bot_inner">
		<p class="blue font_20 mb_15">博文题目:<a href="{{url}}" class="blue"  target="_blank">{{title}}</a></p>
		<div class="mb_10">
			<span class="mr_5">{{sub_time}}</span>
			<span class="mr_5">by</span>
			<span class="mr_5"><a href="{{userspace}}">{{nickname}}</a></span>
			<span class="mr_5">标签:</span>
			<span class="tag_wrap">{{=tags}}</span>
		</div>
		<div class="clearfix mb_15">
			<p class="fl pr_5 lineH_23">
				<span>{{pic_content}}</span>
				<span class="look_more icon178 mr_2 ml_2">详细阅读</span>
				<span><a href="{{url}}" target="_blank">详细阅读</a></span>
			</p>
		</div>
		<div class="bot_fn clearfix">
			<span class="fl pr_20">
				<span class="view_ico icon178 fl mr_10">浏览</span>
				<span class="fl">
					<a href="{{url}}" target="_blank">浏览({{views}})</a>
				</span>
			</span>
			<span class="fl pr_20">
				<span class="fav_ico icon178 fl mr_10 mt_4">喜欢</span>
				<span class="fl">
					<a href="javascript:;" script-role="fav">
						{{if is_like == "0"}}<span script-role="fav_name">喜欢</span>{{else if is_like == "1"}}<span script-role="fav_name">取消喜欢</span>{{/if}}
						(<span script-role="fav_num">{{likes}}</span>)
					</a>
				</span>
			</span>
			<span class="fl pr_20">
				<span class="arg_ico icon178 fl mr_10 mt_4">评论</span>
				<span class="fl">
					<a href="{{url}}" target="_blank">评论({{discs}})</a>
				</span>
			</span>
		</div>
	</div>
</div>	
<div class="shadow_670"></div>
</script>