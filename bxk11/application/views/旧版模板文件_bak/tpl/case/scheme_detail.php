<script id="scheme_detail" type="text/html">
<div class="inner">
	<div class="top_area clearfix">
		<div class="designer fl mr_29 inline">
			<dl class="">
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
			<h3 class="font_18 mb_5"><span class="mr_5">房间名称：</span><span script-role="room_name">{{room_name}}</span></h3>
			<p class="mb_5"><span class="mr_5">房间描述：</span><span script-role="room_thinking">{{room_thinking.substring(0,30)+"..."}}</span></p>
			<div>关键词：
				{{each schemetag_list}}
					<a href="{{$value.tag_url}}" target="_blank">{{$value.tag_name}}</a>
				{{/each}}
			</div>
		</div>
		<div class="fnarea fr mb_20">
			<div class="mb_13 btn_area">
				<a href="javascript:;" class="fl mr_1 carry" script-role="carry" {{if scheme_user_type == 1}}style="display:none"{{/if}}>
					<span class="icon_star icon178"></span>
					<span class="ml_25" script-role="carry_name">搬到我家</span>
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
			<div class="clear pb_5"></div>
			<div class="share_area">
				<span class="artical_share icon178 fl mr_10 mt_2">share</span>
				<span class="fl mr_10">分享到</span>
				<div class="share_detail fl" script-role="share_wrap">
					
				</div>
			</div>

		</div>
	</div>
	<table width="970" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td bgcolor="#ebecec" width="87" align="center">项目名称</td>
			<td width="209" bgcolor="#f8f8f8"><span class="ml_20">{{project_name}}</span></td>
			<td bgcolor="#ebecec" width="84" align="center">房屋面积</td>
			<td width="98" bgcolor="#f8f8f8" class="br14"><span class="ml_20">{{project_size}}</span></td>
			<td bgcolor="#ebecec" width="87" align="center">户型类型</td>
			<td width="111" bgcolor="#f8f8f8"><span class="ml_20">{{project_type}}</span></td>
			<td bgcolor="#ebecec" width="86" align="center">方案造价</td>
			<td width="194" bgcolor="#f8f8f8"><span class="ml_20">{{cost}}</span></td>
		</tr>
		<tr>
			<td bgcolor="#ebecec" width="87" align="center">所在地</td>
			<td width="209" bgcolor="#f8f8f8"><span class="ml_20">{{province}}</span></td>
			<td width="182" bgcolor="#f8f8f8" class="br14" colspan=2><span class="ml_20">{{city}}</span></td>
			<td bgcolor="#ebecec" width="87" align="center">楼盘名称</td>
			<td colspan=3 width="391" bgcolor="#f8f8f8"><span class="ml_20">{{scheme_name}}</span></td>
		</tr>
		<tr>
			<td bgcolor="#ebecec" width="87" align="center">用户需求</td>
			<td colspan=7 width="883" bgcolor="#f8f8f8"><span class="ml_20">{{project_demand}}</span></td>
		</tr>
		<tr>
			<td bgcolor="#ebecec" width="87" align="center">设计思路</td>
			<td colspan=7 width="883" bgcolor="#f8f8f8"><span class="ml_20">{{room_thinking.substring(0,60)+"..."}}</span></td>
		</tr>
	</table>
</div>
</script>