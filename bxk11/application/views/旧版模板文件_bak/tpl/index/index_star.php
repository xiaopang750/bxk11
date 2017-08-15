<script id="star178_tpl" type="text/html">
<div class="section_star mb_30">
<div class="star_bg">
	<img src="{{star_bg}}"/ width="294" height="173">
</div>
<div class="userpic">
	<a href="{{userspace}}" target="_blank"><img src="{{user_pic}}"  width="94" height="94"/></a>
	<p class="font_18"><a href="{{userspace}}" class="blue" target="_blank">{{nickname.substring(0, 6)+"..."}}</a></p>
</div>
<div class="startype clearfix">
	<div class="fr pr_20 pt_12">
		<div class="mb_20">
			<span class="star_ico icon178 fl pr_10">每日之星</span>
			<span class="font_14 bold">每日之星</span>	
		</div>
		<div class="blue font_14">头衔：{{type}}</div>
	</div>
</div>
<div class="intro">
	{{summary}}
</div>
<div class="rank_num ml_13">
	<ul>
		<li>
			<dl>
				<dt class="font_24">{{views}}</dt>
				<dd>
					<a href="{{userspace}}" class="blue font_14" target="_blank">
						{{if is_me == "1"}}Wo的家
						{{else if is_me == "0"}}访问Ta家
						{{/if}}
					</a>
				</dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt class="font_24" script-role="foc_num" dis="true">{{fans}}</dt>
				<dd>
					<a href="javascript:;" class="blue font_14 {{if is_me == "1" || is_follow == "1"}}default{{/if}}" script-role="foc_name" {{if is_me == "1" || is_follow == "1"}}dis="true"{{/if}}>
						{{if is_follow == "0" && is_me == "0"}}关注Ta
						{{else if is_follow == "1" && is_me == "0"}}已关注
						{{else if is_me == "1"}}关注数
						{{/if}}
					</a>
				</dd>
			</dl>
		</li>
		<li>
			<dl>
				<dt class="font_24">{{shares}}</dt>
				<dd>
					<a href="{{userspace}}" class="blue font_14" target="_blank">
						{{if is_me == "1"}}Wo的分享
						{{else if is_me == "0"}}Ta的分享
						{{/if}}
					</a>
				</dd>	
			</dl>
		</li>
	</ul>
</div>
</script>