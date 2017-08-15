<div class="layer_series layer" sc="layer" type="series">
	<div class="layer_select clearfix">
		<span class="fl mt_6 mr_10">筛选:</span>
		<select class="form-control col-1 fl mr_10" sc="series-brand">
			<option value="">按品牌筛选</option>
		</select>
		<span class="fl mt_6 mr_10">关键字:</span>
		<input type="text" class="form-control col-1 fl mr_10" sc="series-code" />
		<button class="btn btn-primary fl" sc="series-btn">查询</button>
		<button class="btn btn-danger fr" sc="close" type="series">x</button>
	</div>
	<div class="list mt_20" sc="series-wrap">
		
	</div>
</div>

<script type="text/html" id="tpl-series">
	{{if err!=1}}
	<table width="100%">
			<tr>
				<td width="10%">
					序号
				</td>
				<td width="30%">
					系列名称
				</td>
				<td width="20%">
					品牌
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
				{{each data.serieslist}}
				<tr sc="list">
					<td width="10%">
						{{$index+1}}
					</td>
					<td width="30%">
						{{$value.series_name}}
					</td>
					<td width="20%">
						{{$value.brand_name}}
					</td>
					<td  width="20%">
						<img src="{{$value.series_img}}" height="50">
					</td>
					<td  width="20%">
						<a href="javascript:;" select-id="{{$value.series_id}}" select-type="series" sc="chose">选择</a>
					</td>
				</tr>
				{{/each}}
			</table>
		</div>

		<div class="fenye pt_10 pb_10" sc="fenye-wrap">
		<span class="ab">本页  {{data.serieslist.length}}  条数据，总共{{data.count}}条数据</span>
		{{if data.serieslist && data.count>5}}
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