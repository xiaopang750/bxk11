<div class="layer_goods layer"  sc="layer" type="goods">
	<div class="layer_select clearfix">
		<span class="fl mt_6 mr_10">筛选:</span>
		<div>
			<select class="form-control col-1 fl mr_10" sc="series">
				<option value="" id="">按系列筛选</option>
			</select>
			<select class="form-control col-1 fl mr_10" sc="goods-brand">
				<option value="" id="">按品牌筛选</option>
			</select>
			<select class="form-control col-1 fl mr_10" sc="classlist">
				<option value="" id="">按品类筛选</option>
			</select>
		</div>
		<span class="fl mt_6 mr_10">商品编码:</span>
		<input type="text" class="form-control col-1 fl" sc="goods-code" />
		<button class="btn btn-primary fl ml_10" sc="goods-btn">查询</button>
		<button class="btn btn-danger fr" sc="close" type="goods">x</button>
	</div>
	<div class="list mt_20" sc="goods-wrap">
		
	</div>
</div>

<script type="text/html" id="tpl-goods">
	{{if err!=1}}
	<table width="100%">
		<tr>
			<td width="10%">
				序号
			</td>
			<td width="30%">
				商品名称
			</td>
			<td width="20%">
				商品编码
			</td>
			<td  width="20%">
				缩略图
			</td>
			<td  width="20%">
				操作
			</td>
		</tr>
	</table>
	<div class="reply-list mb_20">
		<table width="100%">
			{{each data.goods_list}}
			<tr sc="list">
				<td width="10%">
					{{$index+1}}
				</td>
				<td width="30%">
					{{$value.goods_title}}
				</td>
				<td width="20%">
					{{$value.goods_code}}
				</td>
				<td  width="20%">
					<img src="{{$value.goods_pic}}" height="50">
				</td>
				<td  width="20%">
					<a href="javascript:;" select-id="{{$value.goods_id}}" select-type="goods" sc="chose">选择</a>
				</td>
			</tr>
			{{/each}}
		</table>
	</div>

	<div class="fenye pt_10 pb_10" sc="fenye-wrap">
		<span class="ab">本页  {{data.goods_list.length}}  条数据，总共{{data.count}}条数据</span>
		{{if data.goods_list && data.count>5}}
			<button class="btn btn-sm btn-primary" sc="first">首页</button>
			<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
			<span class="num" sc="num">
				
			</span>
			<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
			<button class="btn btn-sm btn-primary" sc="last">尾页</button>
		{{/if}}
	</div>
	{{else}}
		<div class="tc">暂无数据</div>
	{{/if}}
</script>