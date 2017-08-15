<script id="add_project" type="text/html">
<div class="add_area add_project fn_list" script-role="add_project" select-role="artical_fn">
	<div class="fn_inner clearfix">
		<input type="radio" class="radio fl mr_2" name="add" value="选择灵感辑" script-role="select_project_type">
		<span class="font_14 fl mr_5">选择灵感辑</span>
		<select script-role="select_project_area" class="fl mr_10">
			<option value="">请选择</option>
		</select>
		<input type="radio" name="add"  class="radio fl mr_2" value="新建灵感辑" script-role="select_add_type">
		<span class="font_14 fl mr_5">新建灵感辑</span>
		<input type="text"  class="project_add_input fl mr_5" script-role="add_new_project">
		<a href="javascript:;" class="add_project_btn fl" script-role="add_project_btn" cid="{{cid}}">加入灵感辑</a>
	</div>
</div>
</script>