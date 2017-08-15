<script id="arg_list" type="text/html">
{{each data}}
<li script-role="pinglun_list" class="pinglun_list clearfix">
	<a href="{{$value.userspace}}" target="_blank" class="fl">
		<img src="{{$value.user_pic}}" width="24" height="24" class="mr_16 vt_m">
	</a>
	<span class="fl">{{=$value.disc_str}}</span>
	<a href="javascript:;" script-role="arg_reply" name="{{$value.nickname}}" disc_id="{{$value.disc_id}}" user_id="{{$value.user_id}}" style="display:none" class="pinlun_reply fr">回复</a>
</li>
{{/each}}
</script>