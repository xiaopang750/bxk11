<div class="select-box" sc="goods-select-box">
	<div sc="goods-list-wrap">

	</div>
</div>

<script type="text/html" id="goods-tpl-info">
<div class="layer-content">
	<div class="table-title clearfix">
		<span class="icon-list-head icon10"></span>
		<span class="text">
			选择商品列表
		</span>
		<div class="select clearfix">
			<a class="btn btn-default fr ml_5 mr_5 mt_5" sc="goods-search-btn" href="javascript:;">查询</a>
			<div class="fr col-2 mt_5">
				<select class="form-control" sc="series">
					<option id="" value="">选择系列</option>
				</select>
			</div>
			<div class="fr col-2 mt_5 mr_5">
				<select class="form-control" sc="brand">
					<option id="" value="">选择品牌</option>
					{{each data.brandlist}}
						<option value="{{$value.brand_id}}" id="{{$value.brand_id}}" {{if $value.is_select == 1}}selected="selected"{{/if}}>{{$value.brand_name}}</option>
					{{/each}}
				</select>
			</div>
		</div>
	</div>

	<div class="list">
		<table width="100%">
			<tr>
				<td width="10%">
					
				</td>
				<td width="30%">
					商品封面
				</td>
				<td width="30%">
					商品编码
				</td>
				<td  width="30%">
					商品名称
				</td>
			</tr>
		</table>
		<div class="reply-list">
			<table width="100%">
				{{each data.gm_selection_list}}
					<tr sc="list">
						<td width="10%">
							<input type="checkbox" sc="goods-select-item" scid="{{$value.goods_id}}" />
						</td>
						<td width="30%">
							<img src="{{$value.goods_pic1}}" height="50">
						</td>
						<td width="30%">
							{{$value.goods_code}}
						</td>
						<td  width="30%">
							{{$value.goods_name}}
						</td>
					</tr>
				{{/each}}
			</table>
		</div>
		<div class="table-bottom">
			<div class="fenye fl col-6 mt_8 ml_5" sc="fenye-wrap">
				{{if data.gm_selection_list}}
					<button class="btn btn-sm btn-primary" sc="first">首页</button>
					<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
					<span class="num" sc="num">
						
					</span>
					<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
					<button class="btn btn-sm btn-primary" sc="last">尾页</button>
				{{/if}}
			</div>
			<a class="btn btn-danger fr mt_5 mr_10 small" sc="close">取消</a>
			<a class="btn btn-primary fr mt_5 mr_10 small" sc="goods-confirm-select" type="multi">确定</a>
		</div>
	</div>
</div>
</script>