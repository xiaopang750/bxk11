<!-- login -->
<div style="display:none">
	<div id="login_box">
		<div class="head clearfix">
			<a class="close_btn button178 fr mt_15 mr_20" script-role="close_btn" onfocus="this.blur()" href="javascript:$.fancybox.close()">关闭</a>
		</div>
		<div class="inner">
			<div class="title clearfix">
				<span class="pr_5 fl mt_10">没有178帐号?</span>
				<a href="/index.php/user/regist" class="fl mt_10 blue">马上注册</a>
			</div>
			<div class="area clearfix">
				<div class="area_left fl" script-role="formBeautyBound" script-bound="form_check">
					<!-- 邮箱 -->
					<div class="mail input_area" script-role="check_wrap">
						<input type="text" text="请输入邮箱" top="15" left="4" form_check="sys" ischeck="true" name="user_name"  tip="邮箱不能为空" wrong="请输入正确的邮箱格式" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" holder="true" script-role="enterLogin" />	
					</div>
					<!-- 密码 -->
					<div class="pass input_area" script-role="check_wrap">
						<input type="password" type="text" script-role="enterLogin" text="请设置密码" top="15" left="4" form_check="sys" ischeck="true" name="pass_word"  tip="密码不能为空" wrong="请输入6-16位的密码" re="[a-zA-Z\d_]{6,16}" holder="true"/>	
					</div>
					<!-- 记住密码 -->
					<div class="remember_name clearfix mb_5 mt_5" is-form-beauty="true" form-beauty-type="checkbox">
						<input type="checkbox" class="fl mr_5" checked="true" value="1" script-role="issave" />
						<span class="fl">记住密码</span>
						<a href="#" class="fr">忘记登录密码?</a>
					</div>
					<a class="box_login_btn button178" href="javascript:;" onfocus="this.blur()" script-role="confirm_btn">登录</a>
				</div>
				<div class="area_mid fl">
					<span class="c666 yahei">或</span>
				</div>
				<div class="area_right fl">
					<ul>
						<li>
							<a class="weibo_btn button178 other_way" href="javascript:;" onfocus="this.blur()" script-role="weibo_btn"><span>使用新浪微博登录</span></a>
						</li>
						<li>
							<a class="qq_btn button178 other_way" href="javascript:;" onfocus="this.blur()" script-role="qq_btn"><span>使用QQ账号登录</span></a>
						</li>
						<li>
							<a class="renren_btn button178 other_way" href="javascript:;" onfocus="this.blur()" script-role="renren_btn"><span>使用人人账号登录</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>