<script id="scheme_list" type="text/html">
{{each data}}
{{if user_level <= 10}}
<table cellpadding="0" cellspacing="0" border="0" width="970" class="mb_5">
	<tr>
		<td bgcolor="#ebecec" align="center" width="87">楼盘名称</td>
		<td width="203" bgcolor="#ffffff"><span class="ml_25">{{$value.house_name}}</span></td>
		<td bgcolor="#ebecec" align="center" width="83">户型名称</td>
		<td width="324" bgcolor="#ffffff"><span class="ml_25">{{$value.project_title}}</span></td>
		<td bgcolor="#ebecec" align="center" width="84">户型类型</td>
		<td width="116" bgcolor="#ffffff"><span class="ml_25">{{$value.project_type}}</span></td>
	</tr>
	<tr>
		<td bgcolor="#ebecec" align="center">建筑面积</td>
		<td bgcolor="#ffffff"><span class="ml_25">{{$value.project_size}}</span></td>
		<td bgcolor="#ebecec" align="center">套内面积 </td>
		<td bgcolor="#ffffff"><span class="ml_25">{{$value.project_size}}</span></td>
		<td bgcolor="#ebecec" align="center">装修预算</td>
		<td bgcolor="#ffffff"><span class="ml_25">{{$value.project_budget}}</span></td>
	</tr>
</table>
{{/if}}
<ul>
{{each $value.scheme_list}}
<li>
	<div class="inner">
		{{if user_level <= 10}}
		<div class="top font_14 mb_10 clearfix">
			<div class="fl">
				方案名：<a href="{{$value.scheme_url}}" target="_blank">{{$value.scheme_name}}</a>
			</div>
			<div class="fr">
				<span class="view_ico icon178 fl pr_10">浏览</span>
				<a class="fl blue" href="{{$value.scheme_url}}" target="_blank">马上参观 ({{$value.scheme_views}})</a>
			</div>
		</div>
		{{/if}}
		<div class="mid mb_10 clearfix">
			{{if $value.room_list.length == 1}}
				<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[0]}}" width="467" height="231"/></a>
			{{else if $value.room_list.length <=4 && $value.room_list.length > 1}}
				<div class="wrapl fl pr_5">
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[0]}}" width="231" height="231"/></a>
				</div>
				<div class="wrapr fl clearfix">
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[1]}}" width="231" height="231"/></a>
				</div>
			{{else if $value.room_list.length >= 5}}	
				<div class="wrapl fl pr_5">
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[0]}}" width="231" height="231"/></a>
				</div>
				<div class="wrapl fl">
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[1]}}" width="113" height="113"/></a>
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[2]}}" width="113" height="113"/></a>
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[3]}}" width="113" height="113"/></a>
					<a href="{{$value.scheme_url}}" target="_blank"><img src="{{$value.room_list[4]}}" width="113" height="113"/></a>
				</div>
			{{/if}}
		</div>
		<div class="bot clearfix">
			{{if user_level <= 10}}
			<div class="left fl">
				<dl>
					<dt class="fl pr_5">
						<a href="{{$value.userspace}}" target="_blank">
						<img src="{{$value.user_pic}}" width="43" height="43" />
						</a>
					</dt>
					<dd class="fl">
						<p><a href="{{$value.userspace}}" target="_blank">{{$value.designer}}</a></p>
						<p>{{$value.company}}</p>
						<p>
							<a href="javascript:;" class="mr_15 {{if is_me == "1" || is_follow == "1"}}default{{/if}}" script-role="foc_name" {{if is_me == "1" || is_follow == "1"}}dis="true"{{/if}}>
								{{if is_follow == "0" && is_me == "0"}}关注TA
								{{else if is_follow == "1" && is_me == "0"}}已关注
								{{else if is_me == "1"}}关注数
								{{/if}}
							</a>
							<a href="{{$value.sendmsg}}" target="_blank">私信Ta</a>
						</p>
					</dd>
				</dl>
			</div>
			<div class="right fr">
				<p class="mb_5"><span>项目名称:</span>
					<a href="{{$value.scheme_url}}" target="_blank">{{$value.scheme_name}}</a>
				</p>
				<p class="mb_5">关键词：
					{{each $value.schemetag_list}}
						<span>{{$value.tag_name}}</span>
					{{/each}}
				</p>
			</div>
			{{else if user_level > 10}}
			<div class="fl">
				<h3 class="font_14 mb_10 bold">方案名：{{$value.scheme_name}}</h3>
				<p>项目名称：{{$value.project_name}}</p>
				<p>关键词：{{each $value.schemetag_list}}<span>{{$value.tag_name}}</span>{{/each}}</p>
			</div>
			<div class="fr">
				<span class="view_ico icon178 fl pr_10">浏览</span>
				<a class="fl blue" href="{{$value.scheme_url}}" target="_blank">马上参观</a>
			</div>
			{{/if}}
		</div>
	</div>
</li>
{{/each}}
</ul>
{{/each}}
</script>