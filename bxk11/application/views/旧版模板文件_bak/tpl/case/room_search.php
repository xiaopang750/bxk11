<script id="room_search" type="text/html">
	<li script-role="content_list_jia178">
		<div class="inner">
			<div class="top font_14 mb_10 clearfix">
				<div class="fl">
					<a href="{{room_url}}" target="_blank">{{room_name}}</a>
				</div>
				<div class="fr">
					<span class="view_ico icon178 fl pr_10">浏览</span>
					<a class="fl blue" href="{{room_url}}" target="_blank">马上参观 ({{room_views}})</a>
				</div>
			</div>
			<div class="mid mb_10 clearfix">
				<a href="{{room_url}}" target="_blank"><img src="{{room_pic}}" width="467" height="231"/></a>
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
								<a href="javascript:;" class="mr_15 {{if is_me == "1"}}hidden{{else if is_follow == "1"}}act default{{/if}}" href="javascript:;" script-role="foc" {{if is_me == "1" || is_follow == "1"}}dis="true"{{/if}}>
									{{if is_follow == "0" && is_me == "0"}}关注
									{{else if is_follow == "1" && is_me == "0"}}已关注
									{{/if}}
								</a>
								<a href="{{sendmsg}}" target="_blank" class="{{if is_me == "1"}}hidden{{/if}}">私信Ta</a>
							</p>
						</dd>
					</dl>
				</div>
				<div class="right fr">
					<p class="mb_5"><span>房间描述:</span>
						<a href="{{room_url}}" target="_blank">{{room_thinking.substring(0,10)+"..."}}</a>
					</p>
					<p>关键词：
						{{each roomtag_list}}
							<span>{{$value.tag_name}}</span>
						{{/each}}
					</p>
				</div>
			</div>
		</div>
	</li>
</script>