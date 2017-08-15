<!-- changeShop -->
<div class="shop-change clearfix">
	<div class="fl col-2">
		<h2 class="font_16 fl mr_20">当前店铺:</h2>
		<div class="name fl font_16" sc="shop-name"></div>
	</div>
	<div class="fl col-5">
		<span class="manage fl mt_6 mr_10 font_14">管理其他店铺:</span>
		<select class="form-control col-2 fl mr_20" sc="shop">
			<option value="" id="">请选择</option>
		</select>
		<button class="fl btn btn-primary btn-sm" sc="shop-go">进入</button>
	</div>
</div>

<script type="text/html" id="tpl-shop">
{{each shop_list}}
	<option value="{{$value.shop_name}}" id="{{$value.shop_id}}">{{$value.shop_name}}</option>
{{/each}}
</script>
