<script id="case_product" type="text/html">
<div class="inner clearfix">
	<p class="font_14 mb_8">当前房间家居产品包含以下（{{product_list.length}}件）：</p>
	<div class="product_list_wrap fl">
		<div class="left_btn fl">
			<a class="left_btn2 button178" script-role="product_left_btn" href="javascript:;">左</a>
		</div>
		<div class="list_main fl">
			<ul class="clearfix" script-role="product_roll_wrap">
				{{each product_list}}
					<li script-role="product_roll_list">
						<span class="add icon178"></span>
						<dl>
							<dt>
								<a href="{{$value.product_url}}">
									<img src="{{$value.product_pic}}" width="97" height="97" />
								</a>
							</dt>
							<dd>
								<p class="font_14">{{$value.product_name}}</p>
								<p>规格:{{$value.product_name}}</p>
							</dd>
						</dl>
					</li>
				{{/each}}
			</ul>
		</div>
		<div class="right_btn fl">
			<a class="right_btn2 button178" script-role="product_right_btn" href="javascript:;">右</a>
		</div>
	</div>
	<span class="sum icon178 fl"></span>
	<div class="sum_area fl font_20 pt_32">
		<p>套餐价</p>
		<p class="yellow">{{bill_cost}}</p>
		<p>元</p>
	</div>
</div>
</script>