<script id="room_detail" type="text/html">
<div class="inner">
	<div class="top_area clearfix mb_18">
		<div class="designer fl mr_29 inline">
			<dl>
				<dt class="pr_8 fl">
					<a href="{{userspace}}" target="_blank"><img src="{{user_pic}}" width="48" height="48" /></a>
				</dt>
				<dd class="fl">
					<h4>
						<a href="{{userspace}}" target="_blank">{{designer}}</a>
					</h4>
					<h5>{{company}}</h5>
					<div>
						<a href="javascript:;" class="mr_15 {{if is_me == "1" || is_follow == "1"}}default{{/if}}" script-role="foc_name" {{if is_me == "1" || is_follow == "1"}}dis="true"{{/if}}>
							{{if is_follow == "0" && is_me == "0"}}关注TA
							{{else if is_follow == "1" && is_me == "0"}}已关注
							{{else if is_me == "1"}}
							{{/if}}
						</a>
						{{if is_me != "1"}}
						<a href="{{send_message}}" target="_blank">
							预约设计
						</a>
						{{/if}}
					</div>
				</dd>
			</dl>
		</div>
		<div class="intro fl">
			<h3 class="font_18 mb_10"><span class="mr_5">房间名称:</span>{{room_name}}</h3>
			<div class="share_area">
				<span class="artical_share icon178 fl mr_10 mt_2">share</span>
				<span class="fl mr_10">分享到</span>
				<div class="share_detail fl" script-role="share_wrap">
					
				</div>
			</div>
		</div>
		<div class="fnarea fr mb_20">
			<div class="mb_13 btn_area">
				<a href="javascript:;" class="fl mr_1 carry" script-role="diy" {{if user_level>10}}style="display:none"{{/if}}>
					<span class="icon_carry icon178"></span>
					<span class="ml_25" script-role="diy_name">加入DIY方案</span>
				</a>					
				<a href="javascript:;" class="fl addfav {{if is_collect == "1"}}default{{/if}}" script-role="collect" {{if is_collect == "1"}}dis="true"{{/if}}>
					<span class="icon_star icon178"></span>
					<span class="ml_25" script-role="collect_name" {{if is_collect == "1"}}dis="true"{{/if}}>
						{{if is_collect == "1"}}已收藏
						{{else if is_collect == "0"}}加入收藏
						{{/if}}
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="room_detail clearfix">
		<div class="room_pic fl pr_10">
			<img src="{{floor_pic1}}" width="269" height="391" />
			<div style="position:absolute;left:{{mapx*269/405}}px;top:{{mapy*269/405}}px;z-index:3">
				<span class="pic_pin icon178" href="javascript:;" script-role="pin"></span>
				<div class="pin_dec" script-role="pin_text">{{room_type}}</div>
			</div>
		</div>
		<div class="room_intro fl">
			<table cellpadding="0" cellspacing="0" border="0" width="675" class="mb_46">
				<tr>
					<td bgcolor="#ebecec" width="102" align="center">项目名称</td>
					<td bgcolor="#f8f8f8" class="br10"><span class="ml_25" width="235">{{project_name}}</span></td>
					<td bgcolor="#ebecec" width="102" align="center">所属方案</td>
					<td bgcolor="#f8f8f8"><span class="ml_25" width="226"><a href="{{scheme_url}}" target="_blank">{{scheme_name}}</a></span></td>
				</tr>
				<tr>
					<td bgcolor="#ebecec" align="center">房间功能</td>
					<td bgcolor="#f8f8f8" class="br10"><span class="ml_25">{{room_type}}</span></td>
					<td bgcolor="#ebecec" align="center">房间面积</td>
					<td bgcolor="#f8f8f8"><span class="ml_25">{{room_size}}</span></td>
				</tr>
				<tr>
					<td bgcolor="#ebecec" align="center">房间描述</td>
					<td bgcolor="#f8f8f8" colspan=3><span class="ml_25">{{room_thinking.substring(0,30)+"..."}}</span></td>
				</tr>
				<tr>
					<td bgcolor="#ebecec" align="center">关键词</td>
					<td bgcolor="#f8f8f8" colspan=3><span class="ml_25">
					{{each roomtag_list}}
						<span class="mr_5">{{$value}}</span>
					{{/each}}
					</span></td>
				</tr>
			</table>
			<div class="room_pic_list">
				<div class="room_title">
					<span class="font_14 ml_25">相关样板间</span>
				</div>
				<div class="room_wrap clearfix">
					<div class="left_btn fl">
						<a class="left_btn2 button178" script-role="room_left_btn" href="javascript:;">左</a>
					</div>
					<div class="room_main fl">
						<ul class="clearfix" script-role="room_list_wrap">
							{{each room_list}}
							<li script-role="room_list">
								<dl>
									<dt>
										<a href="{{$value.room_url}}" target="_blank">
											<img src="{{$value.room_pic}}" width="113" height="113" />	
										</a>
									</dt>
									<dd>{{$value.room_name.substring(0,7)+"..."}}</dd>
								</dl>
							</li>
							{{/each}}
						</ul>
					</div>
					<div class="right_btn fr">
						<a class="right_btn2 button178" script-role="room_right_btn" href="javascript:;">右</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</script>