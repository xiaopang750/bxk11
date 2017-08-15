<script id="inspir_banner" type="text/html">
<img src="{{img}}" / width="848" height="275">
<div class="banner_shadow"></div>
<div class="banner_lay">
	<div class="inner">
		<div class="top clearfix mb_5">
			<h2 class="font_22 fl">主题:{{name}}</h2>
		</div>
		<div class="count clearfix mb_10">
			<span class="articals icon178 fl mt_4 mr_5" title="博文数">博文数</span>
			<span class="fl mr_5">{{contents}}</span>
			<span class="favs icon178 fl mr_5 mt_5" title="喜欢数">喜欢数</span>
			<span class="fl mr_5">{{likes}}</span>
			<span class="books icon178 fl mr_5" title="订阅数">订阅数</span>
			<span class="fl mr_15">{{takes}}</span>
			<a href="javascript:;" class="yellow fl" style="display:none">申请编辑</a>
		</div>
		<div class="content">
			{{desc}}
		</div>
		<div class="bot" style="display:none">
			<span>编辑团队</span>
			{{each group}}
				<a href="{{$value.href}}">{{$value.name}}</a>
			{{/each}}
		</div>
	</div>
</div>
</script>