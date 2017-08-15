<script id="case_index" type="text/html">
	<!-- 最新设计方案 -->
	<div class="newList clearfix">
		<div class="left_area fl">
			<div class="left_inner" script-role="main_tab_wrap">
					{{each data.topnew_list}}
					{{if $index == 0}}
					<div class="main" script-role="main_tab_content">
						<iframe src="{{$value.swf_url}}" frameborder="0" width="740" height="480"></iframe>
					</div>
					{{else if $index !=0}}
					<div class="main" script-role="main_tab_content">
						<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.pic_url}}" width="740" height="480"></a>
					</div>
					{{/if}}
					{{/each}}
			</div>
		</div>
		<div class="right_area fl">
			<h3 class="tc font_16 mt_10 mb_10 bold">最新项目设计方案</h3>
			<ul class="mb_20 clearfix" script-role="right_list_wrap">
				{{each data.topnew_list}}
				<li script-role="list">
					<p class="pt_5"><span>项目:<span class="ml_5">{{$value.project_name}}</span></span></p>
					<p><span>业主:<span class="ml_5">{{$value.project_owner}}</span></span></p>
					<p><span>入住时间:<span class="ml_5">{{$value.subtime}}</span></span></p>
					<span class="line_bg casebg"></span>
				</li>
				{{/each}}
			</ul>
			<a href="javascript:;" class="get_desigin_btn default" script-role="get_desigin_btn">获取免费设计方案</a>
		</div>
	</div>

	<!-- 室内设计 -->
	<div class="title_wrap clearfix">
		<h3 class="font_18 bold fl tc">室内设计师</h3>
		<span class="line_bg casebg fr mt_18"></span>
	</div>
	<div class="mid clearfix">
		<!-- designer -->
		<div class="designer fl">
			<div class="inner">
				<div class="top clearfix">
					<div class="star fl">
						<a href="{{data.topdesigner.userspace}}"  target="_blank">
							<img src="{{data.topdesigner.user_pic}}" width="190" height="210" />
						</a>
						<div class="shadow"></div>
						<div class="shadow_text">{{data.topdesigner.designer}}</div>
					</div>
					<div class="intro fr">
						<h3 class="tc font_16 bold mb_10">{{data.topdesigner.title}}</h3>
						<p class="mb_43">{{data.topdesigner.user_summary}}</p>
						<div class="intro_bot clearfix">
							<span class="case_font casebg fl pr_11"></span>
							<ul class="fl">
								{{each data.topdesigner.scheme_list}}
								{{if $index<4}}
								<li class="pr_5">
									<a href="{{$value.scheme_url}}" class="mb_3"  target="_blank">
										<img src="{{$value.scheme_pic}}"  width="111" height="75" />
									</a>
									<p class="tc">{{$value.scheme_name}}</p>
								</li>
								{{/if}}
								{{/each}}
							</ul>
						</div>
					</div>
				</div>
				<div class="bot">
					<ul class="clearfix">
						{{each data.topdesigner_list}}
						<li class="pb_15 pt_15">
							<dl class="clearfix">
								<dt class="fl pr_10">
									<a href="{{$value.userspace}}" target="_blank">
										<img src="{{$value.user_pic}}" width="80" height="80" />
									</a>
								</dt>
								<dd class="fl">
									<h4><a href="{{$value.userspace}}" target="_blank">{{$value.designer}}</a></h4>
									<p>{{$value.company}}</p>
									<p>
										<span class="mr_5">方案({{$value.schemes}})</span>
										<span>粉丝({{$value.fans}})</span>
									</p>
								</dd>
							</dl>
						</li>
						{{/each}}
					</ul>
				</div>
			</div>
		</div>
		<!-- rank -->
		<div class="rank fr">
			<div class="top">
				<h3 class="font_16 bold">方案下载排行榜</h3>
				<a href="{{data.topscheme_url}}" class="more" target="_blank">更多>></a>
			</div>
			<div class="bot" script-role="rank_wrap">
				<ul>
					{{each data.topscheme_list}}
					<li script-role="rank_list">
						<span class="num_bg casebg" script-role="num_bg">{{$index+1}}</span>
						<div class="front">
							<span class="ml_40">
								{{$value.scheme_name}}
							</span>
						</div>
						<div class="back">
							<a href="{{$value.scheme_url}}" target="_blank">
								{{$value.scheme_name}}
							</a>
							<dl class="clearfix mt_5">
								<dt class="fl pr_8">
									<a href="{{$value.userspace}}" target="_blank">
										<img src="{{$value.user_pic}}" width="80" height="80" />
									</a>
								</dt>
								<dd class="fl">
									<p class="mt_5 mb_13">
										<a href="{{$value.userspace}}" target="_blank">{{$value.designer}}</a>
									</p>
									<div class="clearfix">
										<a href="{{$value.userspace}}" target="_blank" class="fl pr_5">查看作品</a>
										<span class="look_logo casebg fl mt_2"></span>
									</div>
								</dd>
							</dl>
						</div>
					</li>
					{{/each}}
				</ul>
			</div>
		</div>
	</div>

	<!-- diy -->
	<div class="title_wrap clearfix">
		<h3 class="font_18 bold fl tc">DIY组合家装</h3>
		<span class="line_bg casebg fr mt_18"></span>
	</div>
	<div class="diy_logo mb_40">
		<ul class="clearfix">
			<li class="mt_5">
				<span class="house_bg1 casebg"></span>
				<p>创建自己的装修项目户型</p>
			</li>
			<li class="mt_16">
				<span class="house_bg2 casebg"></span>
				<p>选择喜欢的样板间</p>
			</li>
			<li class="mt_16">
				<span class="house_bg3 casebg"></span>
				<p>应用到自己的房间</p>
			</li>
			<li class="mt_16">
				<span class="house_bg4 casebg"></span>
				<p>在线与亲朋好友分享</p>
			</li>
		</ul>
		<span class="house_dot casebg bg1"></span>
		<span class="house_dot casebg bg2"></span>
		<span class="house_dot casebg bg3"></span>
	</div>
	<div class="diyList">
		<ul class="clearfix">
			{{each data.diyscheme_list}}
			<li>
				<dl>
					<dt class="mb_12">
						<a href="{{$value.scheme_url}}"><img src="{{$value.scheme_pic}}" width="290" height="170" /></a>
					</dt>
					<dd class="clearfix">
						<a href="{{$value.userspace}}" class="fl pr_9" target="_blank">
							<img src="{{$value.user_pic}}" width="52" height="52" />
						</a>
						<div class="fl">
							<p>
								<a href="{{$value.userspace}}" target="_blank">{{$value.nickname}}</a>
							</p>
							<p>
								<span class="mr_5">项目名称:</span>
								<a href="{{$value.scheme_url}}" target="_blank">{{$value.scheme_name}}</a>
							</p>
							<span class="mr_5">粉丝数({{$value.fans}})</span>
							<a href="{{$value.userspace}}" target="_blank">访问TA家</a>
						</div>
					</dd>
				</dl>
			</li>
			{{/each}}
		</ul>
	</div>

	<!-- 样板间 -->
	<div class="title_wrap clearfix">
		<h3 class="font_18 bold fl tc">推荐样板间</h3>
		<span class="line_bg casebg fr mt_18"></span>
	</div>
	<div class="rec_top mb_30">
		<a class="more fr" href="{{data.room_url}}" target="_blank">更多>></a>
		<div class="fr pr_50">热门样板间关键词：
			{{each data.taglist}}
				<span><a href="{{$value.tag_url}}" target="_blank">{{$value.tag_name}}</a>&nbsp;&nbsp;/&nbsp;</span>
			{{/each}}
		</div>
	</div>
	<div class="rec_main">
		<ul class="clearfix">
			{{each data.toproom_list}}
			<li>
				<div class="inner">
					<div class="top font_14 mb_10 clearfix">
						<div class="fl">
							<span class="mr_10">{{$value.room_name}}</span>
						</div>
						<div class="fr">
							<span class="view_ico icon178 fl pr_10">浏览</span>
							<a class="fl blue" href="{{$value.room_url}}" target="_blank">马上参观 ({{$value.room_view}})</a>
						</div>
					</div>
					<div class="mid mb_10">
						<a href="{{$value.room_url}}" target="_blank"><img src="{{$value.room_pic}}" width="467" height="231" /></a>
					</div>
					<div class="bot clearfix">
						<div class="left fl">
							<dl>
								<dt class="fl pr_5">
									<a href="{{$value.userspace}}" target="_blank">
										<img src="{{$value.user_pic}}" width="43" height="43" />
									</a>
								</dt>
								<dd class="fl">
									<p>
										<a href="{{$value.userspace}}" target="_blank">{{$value.designer}}</a>
									</p>
									<p>{{$value.company}}</p>
									<p>
										<span class="mr_10">粉丝数({{$value.fans}})</span>
										<a href="{{$value.send_message}}" {{if is_me == "1"}}style="display:none"{{/if}} target="_blank">私信Ta</a>
									</p>
								</dd>
							</dl>
						</div>
						<div class="right fr">
							<p class="mb_5"><span>房间描述：</span>{{$value.room_thinking.substring(0,10)+"..."}}</p>
							<p>关键词：
								{{each $value.roomtag_list}}
									<a href="{{$value.tag_url}}" target="_blank">{{$value.tag_name}}</a>
								{{/each}}
							</p>
						</div>
					</div>
				</div>
			</li>
			{{/each}}
		</ul>
	</div>
</script>