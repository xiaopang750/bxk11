<div class="bread-area clearfix">
	<div class="info fl ml_49 mt_10">
		<span class="icon-normal home mr_10"></span>
		<span sc="global-hello">
			<{$topdata.welcome}>
			<{$topdata.service_user_name}>
			
		</span>
	</div>
	<div class="status fr mr_49 mt_10">
		<ul class="clearfix">
			<li>
				<dl class="clearfix">
					<dt class="icon-normal fans fl mr_10"></dt>
					<dd class="fl">
						<p class="blue bold" sc="global-fans">
							<{$topdata.new_fans.count}>
						</p>
						<p>新增粉丝</p>
					</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt class="icon-normal reach fl mr_10"></dt>
					<dd class="fl">
						<p class="blue bold" sc="global-reach">
							<{$topdata.new_visit.count}>
						</p>
						<p>今日到访</p>
					</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt class="icon-normal fav fl mr_10"></dt>
					<dd class="fl">
						<p class="blue bold" sc="global-fav">
							<{$topdata.new_like.count}>
						</p>
						<p>今日收藏</p>
					</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt class="icon-normal sign fl mr_10"></dt>
					<dd class="fl">
						<p class="blue bold" sc="global-enter">
							<{$topdata.new_apply.count}>
						</p>
						<p>今日报名</p>
					</dd>
				</dl>
			</li>
		</ul>
	</div>
</div>

<div class="news-area clearfix">
	<div class="location fl mt_15" sc="bread">
		<{$crumbsdata}>
	</div>
	<div class="news-wrap mt_15 fr mr_49">
		<span class="icon-normal news mr_10"></span>
		<span sc="global-notice">
			<{$topdata.new_notice}>
		</span>
	</div>
</div>

