<div class="select-box" sc="select-box">
	<div class="layer-content">
		<div class="table-title clearfix">
			<span class="icon-list-head icon10"></span>
			<span class="text">
				资讯列表
			</span>
			<div class="select clearfix">
				<span class="mr_10 font_14 fl">按分类查看:</span>
				<div class="fl col-2 mt_5">
					<select class="form-control" sc="user-search">
						<option id="" value="">请选择分类</option>
					</select>
				</div>
				<span class="mr_10 font_14 fl ml_10" >输入关键词:</span>
				<input type="text" class="fl form-control col-1 mt_5 ml_5" sc="key" />
				<a class="btn btn-default fl ml_10 mr_10 mt_5" sc="user-btn" href="javascript:;">查询</a>
			</div>
		</div>

		<div class="list" script-role="data_wrap">
			
		</div>
	</div>
</div>

<script type="text/html" id="tpl-info">
<table width="100%">
	<tr>
		<td width="10%">
			
		</td>
		<td width="30%">
			编号
		</td>
		<td width="20%">
			资讯标题
		</td>
		<td  width="20%">
			封面
		</td>
		<td  width="20%">
			发布日期
		</td>
	</tr>
</table>
<div class="reply-list">
	<table width="100%">
		{{each data.informationlist}}
		<tr sc="list">
			<td width="10%">
				<input type="radio" name="radio1" sc="info-select" scid="{{$value.si_id}}" />
			</td>
			<td width="30%">
				{{$index + 1}}
			</td>
			<td width="20%">
				{{$value.si_title}}
			</td>
			<td  width="20%">
				<img src="{{$value.si_pic}}" height="50">
			</td>
			<td  width="20%">
				{{$value.si_addtime}}
			</td>
		</tr>
		{{/each}}
	</table>
</div>
<div class="table-bottom">
	<div class="fenye fl col-6 mt_8 ml_5" sc="fenye-wrap">
		{{if data.informationlist}}
			<button class="btn btn-sm btn-primary" sc="first">首页</button>
			<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
			<span class="num" sc="num">
				
			</span>
			<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
			<button class="btn btn-sm btn-primary" sc="last">尾页</button>
		{{/if}}
	</div>
	<a class="btn btn-danger fr mt_5 mr_10 small" sc="close">取消</a>
	<a class="btn btn-primary fr mt_5 mr_10 small" sc="confirm-select">确定</a>
</div>
</script>

<script type="text/html" id="tpl-select">
	{{each data}}
		<option id="{{$value.it_id}}">{{$value.it_name}}</option>
	{{/each}}
</script>