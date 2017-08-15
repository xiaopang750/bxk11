<script id="tpl_product_detail" type="text/html">
<div class="product_info_top mb_15">
	<div class="inner">
		<h3 class="font_16 mb_24">
			<span class="mr_20">{{product_brand}}</span>
		</h3>
		<div class="content clearfix">
			<div class="left_foc fl pr_15">
				<div class="foc_main mb_5">
					<img src="{{product_piclist[0].b}}" width="565" height="373" script-role="main_pic" />
				</div>
				<div class="view_area clearfix">
					<div class="view_left_btn fl">
					   <a class="left_btn2 button178" script-role="left_btn2" href="javascript:;">左</a>
					</div>
					<div class="roll_wrap fl" script-role="roll_wrap">
						<ul script-role="roll_main">
							{{each product_piclist}}
							<li script-role="roll_list">
								<img src="{{$value.s}}" width="86" height="86" _src="{{$value.b}}" />
								<p>{{$value.pic_type}}</p>
							</li>
							{{/each}}
						</ul>
					</div>
					<div class="view_right_btn fr">
					    <a class="right_btn2 button178" script-role="right_btn2" href="javascript:;">右</a>
					</div>
				</div>
			</div>
			<div class="right_main fl">
				<div class="info font_14 rel mb_38">
					<p>产品编号：<span class="ml_5">{{product_code}}</span></p>
					<p>市场价格：<span class="ml_5 yellow">{{product_price}}</span></p>
					<p class="clearfix">
						<span class="fl">推荐指数：</span>
						{{each product_hot}}
						<span class="score_ico icon178 actb178 fl mt_2"></span>
						{{/each}}
					</p>
					<p>服务：<span class="ml_5"></span></p>
					<p>规格：<span class="ml_5"></span>{{product_size}}</p>
					<a class="yellow_btn clearfix" href="javascript:;" script-role="collect" {{if is_collect == "1"}}dis="true"{{/if}}>
						<span class="head button178 fl"></span>
						<span class="mid button178 fl {{if is_collect == "1"}}default{{/if}}" {{if is_collect == "1"}}dis="true"{{/if}} script-role="collect_name">
							{{if is_collect == "1"}}已收藏
							{{else if is_collect == "0" || !is_collect}}收藏
							{{/if}}

						</span>
						<span class="end button178 fl"></span>
					</a>
				</div>
				<!-- 经销商列表 -->
				<div class="brand_list" script-role="brand_list_wrap">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="product_info_mid mb_15">
	<div class="inner">
		<div class="clearfix pb_14">
			<span class="product_detail icon178 fl pr_14"></span>
			<span class="font_18 fl">产品详情</span>
		</div>
		<table width="970" border="0" cellpadding="4" cellspacing="0">
			<tr>
				<td bgcolor="#ebecec" width="87" align="center">产品描述</td>
				<td width="882" bgcolor="#f8f8f8" colspan=7><span class="ml_20">{{product_description}}</span></td>
			</tr>
			<tr>
				<td bgcolor="#ebecec" width="87" align="center">品牌</td>
				<td width="209" bgcolor="#f8f8f8"><span class="ml_20">{{product_brand}}</span></td>
				<td bgcolor="#ebecec" width="84" align="center">系列</td>
				<td width="97" bgcolor="#f8f8f8" class="br14"><span class="ml_20">{{product_series}}</span></td>
				<td bgcolor="#ebecec" width="87" align="center">编号</td>
				<td width="111" bgcolor="#f8f8f8"><span class="ml_20">{{product_code}}</span></td>
				<td bgcolor="#ebecec" width="86" align="center">风格</td>
				<td width="193" bgcolor="#f8f8f8"><span class="ml_20">{{product_style}}</span></td>
			</tr>
			<tr>
				<td bgcolor="#ebecec" width="87" align="center">品类</td>
				<td width="209" bgcolor="#f8f8f8"><span class="ml_20">{{product_class_b}}</span></td>
				<td width="182" bgcolor="#f8f8f8" class="br14" colspan=2><span class="ml_20">{{product_class_s}}</span></td>
				<td bgcolor="#ebecec" width="87" align="center">关键词</td>
				<td colspan=3 width="391" bgcolor="#f8f8f8"><span class="ml_20">{{scheme_name}}</span></td>
			</tr>
			<tr>
				<td bgcolor="#ebecec" width="87" align="center">规格尺寸</td>
				<td width="209" bgcolor="#f8f8f8"><span class="ml_20">{{product_size}}</span></td>
				<td bgcolor="#ebecec" width="84" align="center">单位</td>
				<td width="97" bgcolor="#f8f8f8" class="br14"><span class="ml_20">{{product_unit}}</span></td>
				<td bgcolor="#ebecec" width="87" align="center">款式</td>
				<td colspan=3 width="391" bgcolor="#f8f8f8"><span class="ml_20">{{product_pattern}}</span></td>
			</tr>
			<tr>
				<td bgcolor="#ebecec" width="87" align="center">主材描述</td>
				<td colspan=7 width="883" bgcolor="#f8f8f8"><span class="ml_20">{{product_materials}}</span></td>
			</tr>
			<tr>
				<td bgcolor="#ebecec" width="87" align="center">辅材描述</td>
				<td colspan=7 width="883" bgcolor="#f8f8f8"><span class="ml_20">{{product_auxiliary}}</span></td>
			</tr>
		</table>
	</div>
</div>
</script>