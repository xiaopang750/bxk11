<script id="header178_info_login_tpl" type="text/html">
<div class="login_before mt_17" {{if islogin == "1"}}style="display:none"{{else if islogin == "0"}}style="display:block"{{/if}}>
	<a href="/index.php/user/regist" class="mr_4" script-role="head_regist_btn">注册</a>
	<a href="/index.php/user/login" script-role="head_login_btn">登录</a>
</div>
<div class="login_after" {{if islogin == "1"}}style="display:block"{{else if islogin == "0"}}style="display:none"{{/if}} script-role="header_user_wrap">
	<span class="fl mt_10 white mr_10">{{nickname}}</span>
	<div class="user_pic mt_5">
		<a href="{{userspace}}"><img src="{{userpic}}" alt="{{userpic}}" width="40" height="40"></a>
	</div>
	<div class="slide_info" script-role="header_user_list">
		<div class="my_list">
			<div class="base_info pb_5">
				<ul>
					<li>
						<a href="#"><span>我的发布({{contents}})</span></a>
					</li>
					<li>
						<a href="#"><span>我的粉丝({{fans}})</span></a>
					</li>
					<li>
						<a href="#"><span>我的通知({{inform}})</span></a>
					</li>
					<li>
						<a href="#"><span>我的私信({{letter}})</span></a>
					</li>
					<li>
						<a href="#"><span>我的订阅({{take}})</span></a>
					</li>
					<li>
						<a href="#"><span>我的喜欢({{likes}})</span></a>
					</li>
					<li>
						<a href="#"><span>我的关注({{follows}})</span></a>
					</li>
				</ul>
			</div>
			<div class="tool pb_5 pt_5">
				<ul>
					<li>
						<a href="#"><span>绑定第三方平台账号</span></a>
					</li>
					<li>
						<a href="#"><span>安装家178采集工具</span></a>
					</li>
				</ul>
			</div>
			<div class="about pb_5 pt_5">
				<ul>
					<li>
						<a href="#"><span>我的账号设置</span></a>
					</li>
					<li>
						<a href="#"><span>进入用户中心</span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="login_out">
			<a href="/index.php/user/logout" script-role="login_out">
				<span class="ml_13">退出登录</span>
			</a>
		</div>
	</div>
</div>
</script>
