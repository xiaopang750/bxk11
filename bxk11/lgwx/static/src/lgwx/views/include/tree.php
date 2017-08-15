<!-- tree-start -->
<div class="layer-nav clearfix" sc="tree-wrap tree">
	<div class="layer-main fl" sc="tree-nav">
		<div class="inner">
			<div class="user-logo">
				<img src="<{$actiondata.service_logo}>" width="70" height="70" sc="user-header">
			</div>
			<ul>
				<{foreach key=key item=value from=$actiondata.module_list}>
					<li sc="tree-head" class="tc <{if $value.select == 1}>active<{/if}>">
						<span class="icon-module <{$value.module_img}>"></span>
						<p><{$value.module_name}></p>
					</li>
				<{/foreach}>
			</ul>
			<div class="support yahei pb_40 font_12 tc">
				<p class="mb_5">灵感无限科技</p>
				<p class="mb_5">提供平台支持</p>
				<p id="qqask"></p>
			</div>
		</div>
	</div>
	<div class="mt_10 tree fl">
		<div class="identification">
			<div class="pt_17 pl_15 black yahei">
				<p class="mb_5"><{$actiondata.service_name}></p>
				<div class="mb_5">
					<img class="vt_m" src="/lgwx/static/system/lgwx/member/level<{$actiondata.service_level.la_rank}>.png">
					<span class="mr_5"><{$actiondata.user_level}></span>
					<img class="vt_m" src="/lgwx/static/system/lgwx/member/score.png">
					<span><{$actiondata.service_score}></span>
					<{if $actiondata.join_status == '0'}>
						<a href="<{$actiondata.to_certified.action_url}>">马上认证</a>
					<{/if}>
				</div>
				<div class="font_12">
					<{$actiondata.currentdate}>
				</div>
				<{if $actiondata.join_status == '0'}>
					<div class="leval no">
						<a href="<{$actiondata.to_certified.action_url}>" sc="reg-link">
							<span class="hidden"></span>
						</a>
					</div>
				<{/if}>
			</div>
			
		</div>
		
		<{foreach key=key item=value from=$actiondata.module_list}>

			<div sc="tree-content" class="tab-content <{if $value.select == 1}>active<{/if}>">
				<ul class="clearfix">

					<{foreach key=key item=item from=$value.actions_list}>

						<li class="list <{if $item.select == 1}>active<{/if}>" sc="tree-list"  tree-name="<{$item.actions_name}>">
							<a href="<{$item.actions_id}>"><{$item.actions_name}></a>
						</li>

					<{/foreach}>
				</ul>
			</div>

		<{/foreach}>

		<div class="divider"><span></span></div>
	</div>
</div>
<!-- tree-end -->
