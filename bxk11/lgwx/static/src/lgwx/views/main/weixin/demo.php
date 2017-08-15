<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="zh-cn" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title></title>
</head>
<style>
body {
  font-family: "Microsoft Yahei", Arial, sans-serif;
  font-size: 14px;
  background: #fff;
  overflow-x:hidden;
}
.title{
	font-size: 15px;
	margin-bottom:5px;
}
.content{
	margin-bottom:10px;
}
.textarea{
	background-color: #FFFCEC;
}
.module{
	border: 1px solid #DDDDDD; padding:5px; margin-bottom:10px;
}
.button {
	display: inline-block;
	position: relative;
	margin: 0px;
	padding: 0 20px;
	text-align: center;
	text-decoration: none;
	font: bold 12px/25px Arial, sans-serif;

	text-shadow: 1px 1px 1px rgba(255,255,255, .22);

	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;

	-webkit-box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
	-moz-box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);
	box-shadow: 1px 1px 1px rgba(0,0,0, .29), inset 1px 1px 1px rgba(255,255,255, .44);

	-webkit-transition: all 0.15s ease;
	-moz-transition: all 0.15s ease;
	-o-transition: all 0.15s ease;
	-ms-transition: all 0.15s ease;
	transition: all 0.15s ease;
}
.green {
	color: #3e5706;
	background: #a5cd4e;
}
</style>
<body  style="">
<div>
	<div class="module">
		<div class="title">
			<span>用户信息</span>
		</div>
		<div>
			<span style="">客服账号：</span><span type="text" id="workeraccount"></span>
		</div>
		<div>
			<span style="">当前访客：</span><span type="text" id="toUin"></span>
		</div>
	</div>
	<div class="module">
		<div class="title">
			<span>编辑消息</span>
		</div>
		<div class="content">
			<input id="radio1" type="radio" name="msg" onClick="setmsg(1)" value="1"/>图文消息
			<input type="radio" name="msg" onClick="setmsg(2)" value="2"/>图片
			<input type="radio" name="msg" onClick="setmsg(3)" value="3"/>文本消息 
			<input type="submit" onClick="putmsg()" value="输出到会话窗口"/>
		</div>
		<div>
			<textarea type="text" name="messageData" id="messageData" class="textarea" style="height:150; width:100%; overflow-y: auto;"></textarea>
		</div>
	</div>
	<div class="module">
		<div class="title">
			<span>高亮页卡</span>
		</div>
		<div class="content">
			<input  type="submit" onClick="notice()" value="高亮页卡"/><span id="noticecon" style="color:red;font-size: 11px"></span>
		</div>
	</div>

	<div class="module">
		<div class="title">
			<span>操作流水<?php echo $service_token;?></span>
		</div>
		<div class="content">
			<textarea id="area"  class="textarea" style="height:260;width:100%;overflow-y:auto"></textarea>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="http://static.paipaiimg.com/js/victor/lib/jquery.min.js"></script>
<script>
var ticket = getUrlParam('ticket');
var workerAccouont = '';
document.getElementById("radio1").checked = true;
setmsg(1);

$.getScript('http://crm1.dkf.qq.com/php/index.php/thirdapp/appdemo/get_workeraccount_by_sessionkey?callback=wokeraccountCallback&ticket='+ticket);

function wokeraccountCallback(data){
	document.getElementById('area').value += '您现在登录的帐号是：' +  $xss(data.workeraccount,"html") + '\n';
	document.getElementById('workeraccount').innerHTML =  $xss(data.workeraccount,"html");
}

function MCS_ClientNotify(EventData) {
	EventData = strToJson(EventData);
	switch(EventData['event']){
		case 'OnUserChange':{
			OnUserChange(EventData);
			break;
		}
		case 'OnMapMsgClick':{
			OnMapMsgClick(EventData);
			break;
		}
	}
}

function OnUserChange(data)
{
	document.getElementById('toUin').innerHTML = data['userid'];
	var str = document.getElementById('area').value;

	str += "切换到用户:" + data['userid'] + ", channeltype:" + data['channeltype'] + "\n";

	try{
		if(data.hasOwnProperty('visitorid')){
			
		}
		document.getElementById('area').value += 'hasOwnProperty no problem';
	}catch(e){
		document.getElementById('area').value += e.message;
	}
	
    document.getElementById('area').value = str;
}

function OnMapMsgClick (data) {

	$id('area').value += "latitude :" + data['latitude'] + ",longitude:" + data['longitude'] + ",location :" + data['location'] + ",scale :" + data['scale'];
}

function $id(id){
	return document.getElementById(id);
}

function putmsg(){
	var strReturn = window.external.PutMsg('{"msg":'+document.getElementById('messageData').value+'}');
	document.getElementById('area').value += 'put msg return:' + strReturn +'\n';
}

function setmsg(d){
	var msg = [
		'{"head":{"random":"{#random#}"}, "body":[{"type":7, "content":[{"title":"常见问题", "digest":"查看全文", "cover":"http://p.qpic.cn/ecc_merchant/0/P_idc2844234_1399602518774/0", "url":"http://weigou.qq.com/wkd/messages/show/cid-cc_idc_208646"}]}]}',
		'{"head":{"random":"{#random#}"}, "body":[{"type":1, "content":{"picUrl":"http://p.qpic.cn/ecc_merchant/0/P_idc2844234_1399602518774/0"}}]}',
		'{"head":{"random":"{#random#}"}, "body":[{"type":0, "content":{"text":"您好，请问有什么可以帮到您的呢"}}]}'
	];
	
	document.getElementById('messageData').value = msg[d-1].replace("{#random#}",  Math.ceil(Math.random()*10000000));
}

function strToJson(str){ 
	var json = (new Function("return " + str))(); 
	return json; 
} 

function getUrlParam(name)
{
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
	var r = window.location.search.substr(1).match(reg);  //匹配目标参数
	if (r!=null) return unescape(r[2]); return null; //返回参数值
}

function notice()
{ 
	document.getElementById('area').value += '5秒钟后开始执行notice,请先切换到其他TAB\n'
	document.getElementById('noticecon').innerHTML="(5秒钟后开始执行notice,请先切换到其他TAB)";
	setTimeout('window.external.Notice("");',5000);
}
function $xss(str,type){
	//空过滤
	if(!str){
		return str===0 ? "0" : "";
	}
	
	switch(type){
		case "none": //过度方案
			return str+"";
		break;
		case "html": //过滤html字符串中的XSS
			return str.replace(/[&'"<>\/\\\-\x00-\x09\x0b-\x0c\x1f\x80-\xff]/g, function(r){
				return "&#" + r.charCodeAt(0) + ";"
			}).replace(/ /g, " ").replace(/\r\n/g, "<br />").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
		break;
		case "htmlEp": //过滤DOM节点属性中的XSS
			return str.replace(/[&'"<>\/\\\-\x00-\x1f\x80-\xff]/g, function(r){
				return "&#" + r.charCodeAt(0) + ";"
			});
		break;
		case "url": //过滤url
			return escape(str).replace(/\+/g, "%2B");
		break;
		case "miniUrl":
			return str.replace(/%/g, "%25");
		break;
		case "script":
			return str.replace(/[\\"']/g, function(r){
				return "\\" + r;
			}).replace(/%/g, "\\x25").replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\x01/g, "\\x01");
		break;
		case "reg":
			return str.replace(/[\\\^\$\*\+\?\{\}\.\(\)\[\]]/g, function(a){
				return "\\" + a;
			});
		break;
		default:
			return escape(str).replace(/[&'"<>\/\\\-\x00-\x09\x0b-\x0c\x1f\x80-\xff]/g, function(r){
				return "&#" + r.charCodeAt(0) + ";"
			}).replace(/ /g, " ").replace(/\r\n/g, "<br />").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
		break;
	}
}
</script><!--[if !IE]>|xGv00|520830615c1cdf2d2a19f66f6834a3f5<![endif]-->