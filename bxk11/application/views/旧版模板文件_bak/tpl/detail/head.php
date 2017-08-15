<script id="detail_head" type="text/html">
<dl class="clearfix">
	<dt class="fl pr_12">
		<a href="{{userspace}}" target="_blank"><img src="{{user_pic}}" width="64" height="64"></a>
	</dt>
	<dd class="fl font_14">
		<div class="fl left_area mt_15">
			<div class="mb_5">
				<span class="mr_15">
					<a href="{{userspace}}" target="_blank">{{nick_name}}</a>
				</span>
				<span class="mr_15">TA的灵感辑({{project_num}})</span>
				<span class="mr_15">TA的粉丝({{fans}})</span>
			</div>
			<div>个人签名:{{}}</div>
		</div>
		<div class="fr right_area">
			<ul class="mt_15">
				<li>
					<span class="detail_home icon178 pb_3">home</span>
					<a href="{{userspace}}" target="_blank">访问TA家</a>
				</li>
				<li>
					<span class="detail_mail icon178 pb_4">mail</span>
					<a href="#" target="_blank">私信TA</a>
				</li>
				<li {{if is_me=="1"}}style="display:none"{{/if}}>
					<span class="detail_foc icon178 pb_1">foc</span>
					<a href="javascript:;"  script-role="foc_name"  {{if is_follow=="1"}}dis="true" class="default"{{/if}}>{{if is_follow=="1"}}已关注{{else if  is_follow=="0"}}关注TA{{/if}}</a>
				</li>
			</ul>
		</div>
	</dd>
</dl>
</script>