<script id="scheme_search" type="text/html">
	<li>
		<div class="inner">
			<div class="top font_14 mb_10 clearfix">
				<div class="fl">
					方案名：<a href="{{scheme_url}}" target="_blank">{{scheme_name}}</a>
				</div>
				<div class="fr">
					<span class="view_ico icon178 fl pr_10">浏览</span>
					<a class="fl blue" href="{{scheme_url}}" target="_blank">马上参观 ({{scheme_views}})</a>
				</div>
			</div>
			<div class="mid mb_10 clearfix">
				{{if room_list.length == 1}}
					<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[0].room_pic}}" width="467" height="231"/></a>
				{{else if room_list.length <= 4 && room_list.length > 1}}
					<div class="wrapl fl pr_5">
						<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[0].room_pic}}" width="231" height="231"/></a>
					</div>
					<div class="wrapr fl clearfix">
						<img src="{{room_list[1].room_pic}}" width="231" height="231"/>
					</div>
				{{else if room_list.length >= 5}}	
					<div class="wrapl fl pr_5">
						<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[0].room_pic}}" width="231" height="231"/></a>
					</div>
					<div class="wrapl fl">
						<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[1].room_pic}}" width="113" height="113"/></a>
						<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[2].room_pic}}" width="113" height="113"/></a>
						<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[3].room_pic}}" width="113" height="113"/></a>
						<a href="{{scheme_url}}" target="_blank"><img src="{{room_list[4].room_pic}}" width="113" height="113"/></a>
					</div>
				{{/if}}
			</div>
			<div class="bot clearfix">
				<div class="left fl">
					<dl>
						<dt class="fl pr_5">
							<a href="{{userspace}}" target="_blank">
							<img src="{{user_pic}}" width="43" height="43" />
							</a>
						</dt>
						<dd class="fl">
							<p><a href="{{userspace}}" target="_blank">{{designer}}</a></p>
							<p>{{company}}</p>
							<p>
								<a href="javascript:;" class="mr_15 {{if is_me == "1" || is_follow == "1"}}default{{/if}}" script-role="foc_name" {{if is_me == "1" || is_follow == "1"}}dis="true"{{/if}}>
									{{if is_follow == "0" && is_me == "0"}}关注TA
									{{else if is_follow == "1" && is_me == "0"}}已关注
									{{else if is_me == "1"}}关注数
									{{/if}}
								</a>
								<a href="{{sendmsg}}" target="_blank">私信Ta</a>
							</p>
						</dd>
					</dl>
				</div>
				<div class="right fr">
					<p class="mb_5"><span>项目名称:</span>
						<a href="{{scheme_url}}" target="_blank">{{scheme_name}}</a>
					</p>
					<p>关键词：
						{{each schemetag_list}}
							<span>{{$value.tag_name}}</span>
						{{/each}}
					</p>
				</div>
			</div>
		</div>
	</li>
</script>