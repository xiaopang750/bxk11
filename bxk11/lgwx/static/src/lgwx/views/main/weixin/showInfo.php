<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=no,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<style>

body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}body{font-family:Microsoft YaHei,Helvitica,Verdana,Tohoma,Arial,san-serif;}.page-url{margin-top:10px;border-top:1px solid #E5E5E5;text-align:center;}.page-url-link{font-size:14px;line-height:2.5;text-decoration:none;text-shadow:0 1px white;-webkit-text-shadow:0 1px #fff;-moz-text-shadow:0 1px #fff;color:#CACACA;}.fn-clear:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}.fn-clear{zoom:1;}.share{margin:15px 0;font-size:14px;word-wrap:break-word;color:#727272;margin:15px 0;display:block;}.share .share-1{float:left;width:49%;display:block;}.share .share-2{float:right;width:49%;display:block;}.share button{font-size:16px;padding:8px 0;border:1px solid #adadab;color:#000;background-color:#e8e8e8;background-image:linear-gradient(to top,#dbdbdb,#f4f4f4);box-shadow:0 1px 1px rgba(0,0,0,0.45),inset 0 1px 1px #efefef;text-shadow:.5px .5px 1px #fff;text-align:center;border-radius:3px;width:100%;}.share img{width:22px!important;height:22px!important;vertical-align:top;border:0;}
html{height:100%;}body{background-color:#eee;}.block{padding:5px 0 12px 0;text-align:left;}.block h1{font-size:16px;font-weight:bold;margin-bottom:15px;margin-left:12px;height:22px;line-height:22px;color:#655744;}.block .lst{margin:4px 10px 0 10px;border:1px solid #d8d8d8;box-shadow:0 0 5px #eae7e0;background-color:#fff;border-radius:5px;}ul{list-style-type:none;}.block li,.block li a{color:#2f3e46;font-size:14px;display:block;text-decoration:none;}.block li{line-height:40px;height:40px;padding-left:10px;cursor:pointer;-webkit-background-size:25px 500px;background-size:25px;overflow:hidden;position:relative;background-color:#FFF;border:1px solid #ccc;border-bottom:none;}.block li.last{border-bottom:1px solid #ccc;}.block li .icon-header{vertical-align:middle;margin-right:10px;width:22px;height:22px;}.block li a{padding-right:40px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;}.block .icon{position:absolute;display:block;top:50%;right:10px;margin-top:-9px;width:18px;height:18px;background-color:#666;background-color:rgba(0,0,0,.4);background-image:url("http://wxj.weixinjia.net/jquery-mobile/images/icons-18-white.png");background-position:-108px -1px;border-radius:9px;}.block .dist{position:absolute;padding:.2em .5em;font-weight:bold;color:white;top:50%;right:40px;margin-top:-.9em;line-height:20px;-webkit-border-radius:1em;border-radius:1em;border:1px solid #ccc;background:#898989;}#wrap{width:100%;padding:15px 0;}.shop-item{width:92%;margin:20px auto 50px auto;box-shadow:0 1px 3px #c9c9c9;-webkit-border-top-left-radius:10px;-webkit-border-top-right-radius:10px;}.shop-item li{background:#f8f8f8;}.shop-item>li:first-child{-webkit-border-top-left-radius:10px;-webkit-border-top-right-radius:10px;}.shop-item .shop-logo{width:100%;}.shop-item .shopname,.shop-item .address-txt,.shop-item .tel-txt{font-size:18px;font-weight:normal;color:#333;}.shop-item .address{font-size:18px;font-weight:normal;color:#686868;}.shop-item .tel{font-size:18px;font-weight:normal;color:#686868;}.shop-item .locnc{width:15px;}.shop-common{width:92%;padding:12px 4% 12px 4%;border-bottom:1px dotted #dadada;}.clearfix{zoom:1;}.top{position:relative;}.top .logo{width:100%;max-height:380px;}.top h4{text-align:center;line-height:30px;position:absolute;bottom:5px;margin:0 auto;width:100%;color:white;}.top .bottom{position:absolute;bottom:5px;width:100%;height:30px;background-color:#000;opacity:.3;}.detail li{line-height:25px;height:auto;}.detail .sep{height:1px;background-color:#CCC;width:98%;}.detail .nav-tip{color:#2f3e46;font-size:14px;}

</style>

<title><?php echo $lbs_name;?></title>
<style>
#map{
	height: 200px;
	width: 97%;
	margin-top: 10px;
}
</style>
</head>
<body>
	
	<div class="top">
		<img class="logo" src="<?php if(stripos($lbs_logourl,'http://') === false) echo "http://".$lbs_logourl; else echo $lbs_logourl;?>"/>
		<div class="bottom"></div>
		<h4><?php echo $lbs_name;?></h4>
	</div>
	<div class="block">
		<div class="lst"> 
			<ul id="lstname0"> 
				<li><a href="javascript:void(0)"><img class="icon-header" src="/lgwx/static/src/lgwx/views/main/weixin/icon_addr.png" /><?php echo $lbs_address;?></a></li>
				<li><a href="tel:<?php echo $lbs_phone;?>"><img class="icon-header" src="/lgwx/static/src/lgwx/views/main/weixin/icon_tel.png" /><?php echo $lbs_phone;?></a></li>
			</ul> 
		</div>
	</div>
	<div class="block detail">
		<div class="lst"> 
			<ul id="lstname0"> 
				<li><h3>门店位置</h3>
					<div class="sep"></div>
					<div id="map">
						<!-- <img src="<?php echo $mapUrl;?>"/> -->
					</div>
					<span class="nav-tip">温馨提醒：点击地图可以进行导航</span>
				</li>
			</ul> 
		</div>
	</div>
	<div class="block detail">
		<div class="lst"> 
			<ul id="lstname0"> 
				<li><h3>门店详情</h3>
					<div class="sep"></div>
					<div><?php echo $lbs_content;?></div>
				</li>
			</ul> 
		</div>
	</div>
	


<p class='page-url'><a href='http://www.mqm-home.com' target='_blank' class='page-url-link'>CopyRight © 家178</a></p>


<script>
		var lng = "<?php echo $lbs_longitude;?>";
		var useGoogle = false;
		if(lng != ""){
			window.onload = function(){
				var map = document.getElementById("map");
				var img = document.createElement("IMG");
				var width = window.innerWidth - 40;
				if(!useGoogle){//baidu map
					var address = "<?php echo $lbs_longitude;?>,<?php echo $lbs_latitude;?>";
					img.setAttribute("src", "http://api.map.baidu.com/staticimage?center="+address+"&markers="+address+"&width="+width+"&height=200&zoom=11");
				}else{//google map
					var address = "<?php echo $lbs_latitude;?>,<?php echo $lbs_longitude;?>";
					img.setAttribute("src","http://maps.googleapis.com/maps/api/staticmap?center="+address+"&zoom=14&size="+width+"x200&sensor=false&markers="+address+"&key=AIzaSyDFXjwEeVTzPh4D7v-4lyA1Ts3z2J6_DrM");
				}
				map.appendChild(img);
				img.onclick = function(){
					location.href = "<?php echo $map_url;?>";
				};
			};
		}
	</script>

	
	
</body>
</html>