<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/weixin.css" />
</head>
<body>

<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>	

<!-- main -->
<div class="weixin-box clearfix">
	<div class="line"></div>
	<div class="menu fl" sc="menu-wrap">
		<div class="menu-head">
			<span class="ml_15">菜单管理</span>
			<span sc="todoFront" class="todoFront">
				<a href="javascript:;" sc="add-main" class="btn btn-success add">添加</a>
				<a href="javascript:;" sc="sort" class="btn btn-default rank">排序</a>
			</span>
			<span sc="todoBack" class="todoBack">
				<a href="javascript:;" sc="confirmSort" class="btn btn-success confirm">完成</a>
				<a href="javascript:;" sc="cancel" class="btn btn-default cancel">取消</a>	
			</span>
		</div>
		<div class="menu-content" sc="menu-content">
			
		</div>
	</div>
	<div class="main fl">
		
		<!-- init -->
		<div class="none-lay tc font_14 none" sc="none-lay" select-lay order="-2">
			你可以先添加一个菜单，然后开始为其设置响应动作
		</div>

		<!-- init -->
		<div class="none-lay tc font_14 none" sc="none-lay" select-lay order="-1">
			已有子菜单，无法设置动作
		</div>

		<!-- select -->
		<div class="type-select none" sc="type-select" select-lay order="0">
			<h3 class="bold font_14">请选择订阅者点击菜单后，公众号做出相应动作</h3>
			<ul class="clearfix">
				<li sc="order-list" click-order="1">
					<dl>
						<dt class="message"></dt>
						<dd>发送消息</dd>
					</dl>
				</li>
				<li sc="order-list" click-order="2">
					<dl>
						<dt class="info"></dt>
						<dd>发送资讯</dd>
					</dl>
				</li>
				<li  sc="order-list" click-order="3">
					<dl>
						<dt class="link"></dt>
						<dd>跳转网页</dd>
					</dl>
				</li>
			</ul>
		</div>

		<!-- text -->
		<div class="text-wrap none" sc="text-wrap" select-lay order="1">
			<div class="text-title">
				<div class="text-logo">
					<div class="pt_5 pl_5">
						<span class="icon-text-logo"></span>
						<span>文字</span>
					</div>
				</div>
			</div>
			<div class="text-content">
				<textarea sc="text-input"></textarea>
			</div>
			<div class="text-bottom">
				<span class="fr mr_10 mt_4 gray">您还可以输入<span sc="text-tip"></span>字</span>
			</div>
			<a href="javascript:;" sc="save-text" role="save-btn" class="btn btn-success mt_20" type="1">保存</a>
		</div>
		

		<!-- info -->
		<div class="info-wrap none" sc="info-wrap" select-lay order="2">
			<h3 class="font_14 mb_10">订阅者点击该子菜单会收到以下消息</h3>
			<div class="info-inner" sc="info-view">
				
			</div>
		</div>
		
		<!-- link -->
		<div class="link-wrap none" sc="link-wrap" select-lay order="3">
			<h3 class="font_14 mb_10">订阅者点击该子菜单会跳转到以下页面</h3>
			<select class="form-control col-5" sc="link-select-wrap">
				
			</select>
			<a href="javascript:;" sc="save-link" role="save-btn" class="btn btn-success mt_20" type="3">保存</a>
		</div>
	</div>
</div>

<div class="save-wrap auto clearfix">
	<a href="javascript:;" sc="save-all" class="btn btn-success small pt_5 pb_5 pl_30 pr_30 fr">保存</a>
</div>

<!-- addBox -->
<div class="weixin-menu-add-box" sc="weixin-add-box">
	<div class="title">
		<h3>输入提示框</h3>
		<a href="javascript:;" class="weixin-menu-close" sc="close">关闭</a>
	</div>
	<div class="content">
		<div class="input_area">
			<div class="tip mb_10 font_16" sc="box-title">菜单名称名字不多于8个汉字或16个字母:</div>
			<input type="text" class="form-control col-6" sc="input-name" />
			<div sc="wrong-tip" class="wrong-tip">holder</div>
		</div>
	</div>
	<div class="confrim-area">
		<a href="javascript:;" sc="confirm" confirm-type="add" class="btn btn-success add small mr_10">确认</a>
		<a href="javascript:;" sc="close" class="btn btn-default rank small">取消</a>
	</div>
</div>

<!-- del-confirm-box -->
<div class="weixin-menu-add-box confirm" sc="weixin-remove-confirm">
	<div class="title">
		<h3>温馨提示</h3>
		<a href="javascript:;" class="weixin-menu-close" sc="close">关闭</a>
	</div>
	<div class="content yahei clearfix">
		<div class="weixin-warning fl mr_10"></div>
		<div class="fl mt_5">
			<h3 class="font_16 mb_5 bold">删除确认</h3>
			<p class="gray font_14">删除后该菜单下设置的消息将不会被保存</p>
		</div>
	</div>
	<div class="confrim-area">
		<a href="javascript:;" sc="confirm" class="btn btn-success add small mr_10">确认</a>
		<a href="javascript:;" sc="close" class="btn btn-default rank small">取消</a>
	</div>
</div>

<div class="info-box" sc="info-box">
	<a href="javascript:;" class="weixin-menu-close" sc="close">关闭</a>
	<div class="info-box-inner mb_15">
		<ul class="clearfix" sc="info-box-wrap">
			
		</ul>
	</div>
	<a href="javascript:;" sc="confirm" role="save-btn" class="fr btn btn-success add small mr_10 confirm-info-btn" type="2">确认</a>
</div>


<script type="text/html" id="main-list-wrap">
	{{each data.menu_list}}
		{{include 'menu-main' $value}}
	{{/each}}
</script>

<!-- menu-tpl -->
<script type="text/html" id="menu-main">
<div class="main-list move" role="main-list" sort-list-main move list-id="{{smd_pid}}">
	<div class="list list-head" sc="hover-list" {{if !smd_ptype && !smd_son_list}}select-type="0"{{else if smd_ptype && !smd_son_list}}select-type={{smd_ptype}}{{else if smd_son_list}}select-type="-1"{{/if}} list-id="{{smd_pid}}" list-parent="parent">
		<i class="trangle"></i>
		<a href="javascript:void(0);" class="inner_menu_link first" sc="inner_menu_link">
			<strong sc="main-name">{{smd_pname}}</strong>
		</a>
		<span class="menu_opr">
			<span sc="func-btn-area" class="func-btn-area">
	            <a href="javascript:void(0);" class="add" sc="list-add" role="main" list-id="{{smd_pid}}">添加</a>
	            <a href="javascript:void(0);" class="edit" sc="list-edit-main" role="main" list-id="{{smd_pid}}" name="{{smd_pname}}">编辑</a>
	            <a href="javascript:void(0);" class="del" sc="list-del" role="main" list-id="{{smd_pid}}" type="main">删除</a>
            </span>
            <a href="javascript:void(0);" class="sort" sc="list-sort" role="main">排序</a>
        </span>
	</div>
	<ul sc="sub-wrap" class="sub-wrap" list-id="{{smd_pid}}">
		{{each smd_son_list}}
			{{include 'menu-sub' $value}}
		{{/each}}
	</ul>
</div>	
</script>

<script type="text/html" id="menu-sub">
<li class="list list-head move" sc="hover-list" role="sub-list" sort-list-sub move list-id="{{smd_id}}" {{if !smd_type}}select-type="0"{{else}}select-type={{smd_type}}{{/if}} list-sub="sub">
	<i class="icon_dot">●</i>
	<a href="javascript:void(0);" class="inner_menu_link" sc="inner_menu_link">
		<strong  sc="sub-name">{{smd_name}}</strong>
	</a>
	<span class="menu_opr">
		<span sc="func-btn-area" class="func-btn-area">
            <a href="javascript:void(0);" class="edit" sc="list-edit-sub" role="sub" list-id="{{smd_id}}" name="{{smd_name}}">编辑</a>
            <a href="javascript:void(0);" class="del" sc="list-del" role="sub" list-id="{{smd_id}}" type="sub">删除</a>
        </span>
        <a href="javascript:void(0);" class="sort" sc="list-sort" role="sub">排序</a>
    </span>
</li>
</script>

<script type="text/html" id="select-list">
	<option value="" id="">请选择</option>
	{{each data.informationlist}}
		<option value="{{$value.c_id}}" id="{{$value.c_id}}">{{$value.c_name}}</option>
	{{/each}}
</script>

<script type="text/html" id="info-list">

<div class="photo-view" sc="info-link-wrap">
	<h3 class="mb_10">{{smd_content[0].si_addtime}}</h3>
	<div class="img-wrap mb_20">
		<img src="{{smd_content[0].si_pic}}" />
		<div class="shadow-lay"></div>
		<div class="shadow-text">
			<span class="ml_5">{{smd_content[0].si_title}}</span>
		</div>
	</div>
	<div class="photo-sub-list">
		{{if smd_content.length > 1}}
		<ul>
			{{each smd_content}}
				{{if $index >= 1}}
					<li class="clearfix">
						<span class="fl">{{$value.si_title}}</span>
						<img src="{{$value.si_pic}}" class="fr" />
					</li>
				{{/if}}
			{{/each}}
		</ul>
		{{/if}}
	</div>
</div>
</script>

<script type="text/html" id="info-box-list">
{{each data.informationlist}}
<li sc="info-select-list" sid="{{$value.si_id}}">
	<h4 class="font_14 mb_10">{{$value.si_addtime}}</h4>
	<p class="mb_5">{{$value.si_title}}</p>
	<img src="{{$value.si_pic}}" class="mb_5" width="208" />
	<div class="mark"></div>
</li>
{{/each}}
</script>


<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/weixin_menu.js');
</script>
</body>
</html>