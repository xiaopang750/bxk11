<script id="detail_content" type="text/html">
<li>
<div class="user_right clearfix">
	<div class="main font_14 fl">
		<div class="inner">
			<div class="top mb_10">
				<h3 class="clearfix mb_10 font_14">
					<p class="fl"><a href="{{userspace}}">{{nick_name}}</a></p>
					<p class="fr">{{sub_time}}</p>
				</h3>
				<h4 class="font_18">博文题目 : <span>{{title}}</span></h4>
			</div>
			<div class="mid clearfix">
				<div class="list_wrap actw" script-role="image_wrap">
					{{each pic_list as value index}}
						<img src="{{value.pic_url}}" width="724"/>
						<p>
							{{value.pic_content}}
						</p>	
					{{/each}}
				</div>
			</div>
			<div class="bot clearfix pb_10">
				<div class="tag fl">
					<span class="rec_ico icon178 fl mr_5 mt_3">标签</span>
					<span class="fl">{{= tags}}</span>
				</div>
				<div class="fn_area fr">
					<ul class="clearfix">
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