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
<div class="layer-content">
	
	<div class="table-title clearfix">
		<span class="icon-list-head icon11"></span>
		<span class="text">
			<{$title}>
		</span>
	</div>
	<div class="form"  script-bound="form_check">

	</div>

</div>

<!-- 编辑 -->
<script type="text/html" id="hand-edit">
	<div class="form-group">
		<label class="label-control col-2 fl">
			选择公众号类型：
		</label>
		<div class="col-6 fl mt_5" script-role="check_wrap" radio_group="true" name="wx_type" form_check="sys" ischeck="true">
			<input type="radio" {{if data.wx_type == 1}}checked="checked"{{/if}} disabled="disabled" sc="radio-type" value="1" name="wx_type" /><span class="ml_10">服务号&nbsp;&nbsp;&nbsp;</span>
			<input type="radio" {{if data.wx_type == 2}}checked="checked"{{/if}} disabled="disabled" sc="radio-type" value="2" name="wx_type" /><span class="ml_10">订阅号&nbsp;&nbsp;&nbsp;</span>
			<div class="ml_10 mt_10 gray">（提示：订阅号无法使用自定菜单功能）</div>
		</div>
	</div>

	<div class="form-group">
		<div class="clearfix">
			<div script-role="check_wrap">
				<label class="label-control col-2 fl mb_40">
					输入公众号名称：
				</label>
				<input type="text" class="form-control col-2 fl" name="wx_name" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" value="{{data.wx_name}}" readonly="readonly" />
			</div>
			<div script-role="check_wrap">
				<label class="label-control col-1 fl mb_40">
				输入登录邮箱：
				</label>
				<input type="text" class="form-control col-2 fl" name="wx_email" form_check="sys" ischeck="true" tip="此项为必填" wrong="邮箱格式不正确" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" value="{{data.wx_email}}" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="clearfix" script-role="check_wrap">
			<div script-role="check_wrap">
				<label class="label-control col-2 fl">
					输入公众号原始id：
				</label>
				<input type="text" class="form-control col-2 fl" name="wx_id" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" value="{{data.wx_id}}" readonly="readonly" />
			</div>
			<div script-role="check_wrap">
				<label class="label-control col-1 fl mb_40">
				输入微信号：
				</label>
				<input type="text" class="form-control col-2 fl" readonly="readonly" name="wx_code" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" value="{{data.wx_code}}" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	{{if data.wx_type == 1}}
	<div class="form-group">
		<div script-role="check_wrap">
			<label class="label-control col-2 fl mb_40">
				输入公众号AppID：
			</label>
			<input type="text" class="form-control col-2 fl" name="wx_appid" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" sc="appid" value="{{data.wx_appid}}" />
		</div>
		<div script-role="check_wrap">
			<label class="label-control col-1 fl mb_40">
				AppSecret：
			</label>
			<input type="text" class="form-control col-2 fl" name="wx_appsecret" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" sc="appsec" value="{{data.wx_appsecret}}" />
		</div>
		<div class="clear"></div>
	</div>
	{{/if}}


	<div class="form-group">
		<label class="label-control col-2 fl"></label>
		<div class="col-2 fl mt_6">
			<button class="btn btn-success"  script-role="confirm_btn">保存</button>
		</div>
	</div>
</script>

<!-- 添加 -->
<script type="text/html" id="hand-add">
<div class="form-group" script-role="check_wrap">
	<div class="label-control col-5 fl">
		<span class="blue">第一步：</span>
		请确定您已经拥有微信公众号，没有可以马上申请：
		<a href="https://mp.weixin.qq.com" target="_blank">
			<img src="<{$smarty.const.APP_LINK}>img/main/weixin/weixin_step.jpg" alt="微信公众平台" class="vt_m" /> 
		</a>
	</div>
</div>

<div class="form-group">
	<label class="label-control col-2 fl">
		<span class="blue">第二步：</span>
		选择公众号类型：
	</label>
	<div class="col-6 fl mt_5" script-role="check_wrap" radio_group="true" name="wx_type" form_check="sys" ischeck="true">
		<input type="radio" sc="radio-type" value="1" {{if data.wx_type == '1' || !data.wx_type}}checked="checked"{{/if}} name="wx_type" /><span class="ml_10">服务号&nbsp;&nbsp;&nbsp;</span>
		<input type="radio" sc="radio-type" value="2" name="wx_type" {{if data.wx_type == '2'}}checked="checked"{{/if}} /><span class="ml_10">订阅号&nbsp;&nbsp;&nbsp;</span>
		<div class="ml_10 mt_10 gray">（提示：订阅号无法使用自定菜单功能）</div>
	</div>
</div>

<div class="form-group">
	<div class="clearfix">
		<div script-role="check_wrap">
			<label class="label-control col-2 fl mb_40">
				<span class="blue">第三步：</span>输入公众号名称：
			</label>
			<input type="text" class="form-control col-2 fl" value="{{data.wx_name}}" name="wx_name" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" />
		</div>
		<div script-role="check_wrap">
			<label class="label-control col-1 fl mb_40">
			输入登录邮箱：
			</label>
			<input type="text" class="form-control col-2 fl" value="{{data.wx_email}}" name="wx_email" form_check="sys" ischeck="true" tip="此项为必填" wrong="邮箱格式不正确" re="([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="clearfix" script-role="check_wrap">
		<div script-role="check_wrap">
			<label class="label-control col-2 fl">
				<span class="blue hidden">第三步：</span>输入公众号原始id：
			</label>
			<input type="text" class="form-control col-2 fl" value="{{data.wx_id}}" name="wx_id" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" />
		</div>
		<div script-role="check_wrap">
			<label class="label-control col-1 fl mb_40">
			输入微信号：
			</label>
			<input type="text" class="form-control col-2 fl" value="{{data.wx_code}}" name="wx_code" form_check="sys" ischeck="true" tip="此项为必填" wrong="此项为必填" re="(.+)" />
		</div>
		<div class="clear"></div>
	</div>
	<div>
		<label class="label-control col-2 fl"></label>
		<span class="gray">
			请将微信公众号帐号信息中
			<span class="red">[名称]</span>
			<span class="red">[登录邮箱]</span>
			<span class="red">[原始ID]</span>
			<span class="red">[微信号]</span>内容分别复制到以上输入框<a href="#" class="ml_10">详见帮助</a>
		</span>
	</div>
</div>

<div class="form-group">
	<div script-role="check_wrap">
		<label class="label-control col-2 fl mb_40">
			<span class="blue">第四步：</span>输入公众号AppID：
		</label>
		<input type="text" class="form-control col-2 fl" value="{{data.wx_appid}}" name="wx_appid" form_check="sys" ischeck="{{if data.wx_type == 2}}false{{else}}false{{/if}}" tip="此项为必填" wrong="此项为必填" re="(.+)" sc="appid" {{if data.wx_type == 2}}disabled="disabled"{{/if}} />
	</div>
	<div script-role="check_wrap">
		<label class="label-control col-1 fl mb_40">
			AppSecret：
		</label>
		<input type="text" class="form-control col-2 fl" value="{{data.wx_appsecret}}" name="wx_appsecret" form_check="sys" ischeck="{{if data.wx_type == 2}}false{{else}}false{{/if}}" tip="此项为必填" wrong="此项为必填" re="(.+)" sc="appsec" {{if data.wx_type == 2}}disabled="disabled"{{/if}} />
	</div>
	<div class="clear"></div>
	<div>
		<label class="label-control col-2 fl"></label>
		<span class="gray">
			请将微信公众号开发者凭据
			<span class="red">[AppID]</span>
			<span class="red">[AppSecret]</span>
			项复制到以上
			<span class="red">[AppID]</span>
			<span class="red">[AppSecret]</span>
			框中<a href="#" class="ml_10">详见帮助</a>
		</span>
	</div>
</div>


<div class="form-group">
	<label class="label-control col-2 fl"></label>
	<div class="col-2 fl mt_6">
		<a class="btn btn-success" script-role="confirm_btn" href="javascript:;">测试绑定</a>
	</div>
</div>
</script>

<div class="confirm-box" sc="confirm-box">
	<div class="table-title clearfix">
		<span class="icon-list-head icon10"></span>
		<span class="text">
			测试绑定是否成功
		</span>
	</div>
	<div class="content clearfix">
		
		<div class="clearfix" script-role="check_wrap">
			<label class="label-control col-2 fl mb_20">
				公众号绑定：URL
			</label>
			<input type="text" sc="url" readonly="readonly" copy-role class="form-control col-6 fl" />
			<a href="javascript:;" class="fl mt_6 ml_10" sc="copy-btn">复制</a>
			<div class="clear"></div>
		</div>
		
		<div class="clearfix" script-role="check_wrap">
			<label class="label-control col-2 fl">
				<span class="fr">Token</span>
			</label>
			<input type="text" sc="token" copy-role readonly="readonly" class="form-control col-6 fl"/>
			<a href="javascript:;" class="fl mt_6 ml_10" sc="copy-btn">复制</a>
			<div class="clear"></div>
		</div>

		<p class="clearfix lineH_23 ml_15">
			将系统生成的绑定代码【URL】【Token】的内容复制到公众号服务器配置项中然后用手机关注您绑定的公众号，并给公众号发送文字信息“test”<a href="#">[查看帮助]</a>
		</p>
	
		<div class="clearfix">
			<label class="label-control col-4 fl">
				输入公众号返回的四位验证码：
			</label>
			<input type="text" sc="code" class="form-control col-1 fl"/>
			<label class="label-control col-2 fl">
				<span class="icon-global no" sc="test-status"></span>
			</label>
		</div>
		
		<div class="clearfix mt_20 ml_15">

			<div class="btn-wrap fr">
				<a class="btn btn-danger small" sc="close" href="javascript:;">关闭</a>
				<a class="btn btn-success small" sc="check-btn" href="javascript:;">验证</a>
			</div>
		</div>
	</div>
</div>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/weixin_code_add.js');
</script>
</body>
</html>