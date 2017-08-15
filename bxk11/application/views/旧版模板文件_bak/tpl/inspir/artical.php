<script id="inspir_artical" type="text/html">
<li class="clearfix pb_30"  script-role="content_list_jia178">
	<div class="user_head fl">
		<a href="{{userspace}}" target="_blank">
			<img src="{{pic}}" alt="{{nickname}}" width="64" height="64"  script-role="user_head_area" />
		</a>
		<div class="user_slide"  script-role="user_head_list">
			<span class="artical_dot icon178">dot</span>
			<ul>
				<li>
					<span class="artical_home icon178 fl mt_7 mr_1">home</span>
					<a href="{{userspace}}" target="_blank">访问{{if is_me=="1"}}WO家{{else if is_me=="0"}}TA家{{/if}}</a>
				</li>
				<li {{if is_me=="1"}}style="display:none"{{/if}}>
					<span class="artical_foc icon178 fl mt_7 mr_2">home</span>
					<a href="javascript:;" script-role="foc_name" {{if is_follow=="1"}}dis="true" class="default"{{/if}}>{{if is_follow=="1"}}已关注{{else if  is_follow=="0"}}关注TA{{/if}}</a>
				</li>
				<li {{if is_me=="1"}}style="display:none"{{/if}}>
					<span class="artical_mail icon178 fl mt_7 mr_2">home</span>
					<a href="#" target="_blank">私信TA</a>
				</li>
			</ul>	
		</div>
	</div>
	<div class="user_right fr clearfix">
		<span class="trangle icon178 fl">trangle</span>
		<div class="main font_14 fl">
			<div class="inner">
				<div class="top mb_10">
					<h3 class="clearfix mb_10 font_14">
						<p class="fl"><a href="{{userspace}}" target="_blank">{{nickname}}</a></p>
						<p class="fr">{{sub_time}}</p>
					</h3>
					<h4 class="font_18">博文题目 : <a href="{{url}}" target="_blank">{{title}}</a></h4>
				</div>
				<div class="mid clearfix">
					<div class="list_wrap" script-role="image_wrap">
						{{each pic_list as value index}}
							{{if index==0}}
								<img src="{{value.pic_url2}}" width="360"  script-role="image_list" _link="{{url}}" />
								<p>
									{{value.pic_content}}
								</p>	
							{{/if}}
						{{/each}}
						<a script-role="slide_up" href="javascript:;" class="fr blue slide_artical">展开全文</a>
					</div>
					<div class="pic_load"  script-role="pic_load">
					    <img src="/static/images/lib/loading/pic_load.gif" alt="load">
					</div>
				</div>
				<div class="bot clearfix pb_10">
					<div class="tag fl">
						<span class="rec_ico icon178 fl mr_5 mt_3">标签</span>
						<span class="fl">{{= tags}}</span>
					</div>
					<div class="fn_area fr">
						<ul class="">
							<li>
								<span class="artical_fav icon178 fl mt_5 mr_5">fav</span>
								<span class="fl">
									<a href="javascript:;" script-role="fav">
										{{if is_like == "0"}}<span script-role="fav_name">喜欢</span>{{else if is_like == "1"}}<span script-role="fav_name">取消喜欢</span>{{/if}}
										(<span script-role="fav_num">{{likes}}</span>)
									</a>
								</span>	
							</li>
							<li>
								<span class="artical_add icon178 fl mt_5 mr_5">add</span>
								<span class="fl">
									<a href="javascript:;" script-role="add" >
										<span effect-role="show_slide" tab-index="0" down="no" script-role="add_project">加入灵感辑</span>
										(<span script-role="project_num">{{project_num}}</span>)
									</a>
								</span>
							</li>
							<li>
								<span class="artical_arg icon178 fl mt_5 mr_5">arg</span>
								<span class="fl">
									<a href="javascript:;">
										<span effect-role="show_slide"  script-role="arg"  tab-index="1" down="no">评论</span>
										(<span script-role="pinlun_num">{{disc}}</span>)
									</a>
								</span>	
							</li>
							<li style="display:none">
								<span class="artical_share icon178 fl mt_5 mr_5">share</span>
								<span class="fl">
									分享到
								</span>	
							</li>
						</ul>
					</div>
				</div>
				<div class="fn_area_bot" script-role="artical_bot">
					<span class="artical_dot icon178" script-role="artical_dot">dot</span>
					<div class="fn_area_bot_detail">	
						{{include 'add_project'}}
						{{include 'arg'}}
					</div>
				</div>
			</div>
		</div>
	</div>
</li>
</script>
