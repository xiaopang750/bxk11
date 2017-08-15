<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/application/views/admin/role/index.css" />
</head>

<body>

<div class="module-wrap" sc="module-wrap">
	
</div>

<script type="text/html" id="haha">
	{{each data.list}}
		<div class="module-list" sc="module-list">
			<div class="level1" sc="level1" scid="{{$value.id}}">
				<span class="slide" sc="slide">[-]</span>
				<input type="text" class="type1" value="{{$value.rank}}" sc="lv1-rank" />
				<input type="text" class="type2" value="{{$value.name}}" sc="lv1-name" />
			</div>
			<div class="level2-list" sc="level2-list">
				{{each $value.son}}
					<div class="level2" sc="level2" scid="{{$value.id}}">
						<input type="text" class="type1" value="{{$value.rank}}"  sc="lv2-rank" />
						<input type="text" class="type2" value="{{$value.name}}" sc="lv2-name" />
						<button sc="module3-add">+</button>
						<a href="javascript:;" sc="realremove" scid="{{$value.id}}">删除</a>
						<a href="/index.php/admin/service/action_edit?id={{$value.id}}">编辑</a>
						<div class="level3-list" sc="level3-list">
							{{each $value.son}}
								<div class="level3" sc="level3" scid="{{$value.id}}">
									<input type="text" class="type1" value="{{$value.rank}}" sc="lv3-rank" />
									<input type="text" class="type2" value="{{$value.name}}" sc="lv3-name" />
									<a href="javascript:;" sc="realremove" scid="{{$value.id}}">删除</a>
									<a href="/index.php/admin/service/action_edit?id={{$value.id}}">编辑</a>
								</div>
							{{/each}}
						</div>
					</div>
				{{/each}}
			</div>
			<button class="module2-add" sc="module2-add">添加新版块</button>
		</div>
	{{/each}}
</script>



<button sc="module-add" class="module-add">添加新模块</button>

<button sc="module-save" class="module-add">保存</button>


<script src="/application/views/admin/role/jquery.js"></script>
<script src="/application/views/admin/role/sea.js"></script>
<script>
	seajs.use('/application/views/admin/role/index.js');
</script>


<script>
	var data = {

	list: [
			{
				rank:"1",
				name:"erping",
				id:"2",
				son:[
					{
						rank:"1",
						name:"erping",
						id:"2",
						son: [
							{
								rank:"3",
								name:"erping",
								id:"3"
							}
						]
					}
				]
			}

	]

}
</script>
</body>
</html>