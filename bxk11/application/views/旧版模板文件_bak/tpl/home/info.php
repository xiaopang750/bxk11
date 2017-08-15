<script id="tpl_user_info" type="text/html">
	<div class="user_bg">
		<img src="{{userspace_pic}}" width="1000" height="333" />
		<div class="user_head">
			<img src="{{user_pic}}" width="124" height="124"/>
			<div class="shadow"></div>
			<div class="text">{{nickname}}</div>
		</div>
	</div>
	<div class="info_detail clearfix pb_15" script-role="data_head_info">
		<div class="info_left fl pr_29">
			<a class="inspir_foc home_bg fl ml_42 {{if is_me == "1"}}hidden{{else if is_follow == "1"}}act default{{/if}}" href="javascript:;" script-role="foc" {{if is_me == "1" || is_follow == "1"}}dis="true"{{/if}}>
				<span class="ml_24" script-role="foc_name">
					{{if is_follow == "0" && is_me == "0"}}关注
					{{else if is_follow == "1" && is_me == "0"}}已关注
					{{/if}}
				</span>
			</a>
			<a class="message home_bg ml_10 {{if is_me == "1"}}hidden{{/if}}" href="{{send_message}}">
				<span>私信</span>
			</a>
		</div>
		<div class="info_mid fl mt_17">
			<div class="mb_17 clearfix">
				<span class="fl font_18 pr_5">{{nickname}}</span>
				<span class="level1 home_bg fl pr_10 mt_5"></span>
				<span class="fl mt_10">
					{{if user_level <= 10}}
					认证小区：{{house}}
					{{else if user_level > 10}}
					设计机构：{{company}}
					{{/if}}
				</span>
			</div>
			<p class="lineH_23 mb_15">{{user_summary}}</p>
			<div class="tag_area clearfix">
				<span class="fl pr_7 mt_2">标签:</span>
				{{each usertag_list}}
				<div class="taglist fl pr_5">
					<span class="tag_head home_bg fl"></span>
					<span class="tag_mid home_bg fl"><a href="{{$value.tag_url}}" target="_blank">{{$value.tag_name}}</a></span>
					<span class="tag_end home_bg fl"></span>
				</div>
				{{/each}}
			</div>
		</div>
		<div class="info_right fr pr_20">
			{{if user_level <= 10}}
			<span class="user_logo home_bg mt_10 ml_2 mb_10"><a href="{{user_swf}}" target="_blank">参观Ta家</a></span>
			{{else if user_level > 10}}
			<span class="design_logo home_bg mt_10 ml_2 mb_10"><span class="ml_30">认证设计师</span></span>
			{{/if}}
			<ul class="clearfix">
				<li class="fl">
					<p>{{follows}}</p>
					<p>关注</p>
				</li>
				<li class="fl">
					<p>{{fans}}</p>
					<p>粉丝</p>
				</li>
				<li class="fl">
					<p>{{contents}}</p>
					<p>微博</p>
				</li>
			</ul>
		</div>
	</div>
	<div class="user_main">
		<div class="user_nav">
			<div class="line"></div>
			<ul class="ml_15">
				<li script-role="nav_list">
					<a href="#" script-role="nav_name">最新动态</a>
				</li>
				<li script-role="nav_list">
					<a href="#" script-role="nav_name">灵感辑</a>
				</li>
				<li script-role="nav_list">
					<a href="#" script-role="nav_name">楼盘方案</a>
				</li>
				<li script-role="nav_list">
					<a href="#" script-role="nav_name">
						{{if user_level <= 10}}
						收藏产品
						{{else if user_level > 10}}
						推荐产品
						{{/if}}
					</a>
				</li>
				<li class="br" script-role="nav_list">
					<a href="#" script-role="nav_name">装修圈</a>
				</li>
			</ul>
		</div>
	</div>
</script>