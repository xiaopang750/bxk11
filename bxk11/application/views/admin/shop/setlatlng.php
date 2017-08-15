<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;}
#l-map{height:100%;width:100%;float:left;border-right:2px solid #bcbcbc;}
#r-result{height:100%;width:20%;float:left;display: none;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo $key;?>"></script>
<script src="/static/admin/artDialog/artDialog.js?skin=aero"></script>
<script src="/static/admin/artDialog/plugins/iframeTools.js"></script>
<script src="/static/admin/js/jquery.js"></script>
<title>设置覆盖物的显示与隐藏</title>
<!--style type="text/css">
body, html {width: 100%;height: 100%;overflow: hidden;margin:0;}
#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;}
#l-map{height:100%;width:100%;}
</style-->
</head>
<body>

<div class="ftip" style="margin:0">拖动红色图标到相应位置然后点击右侧链接-><a id="ok" href="###">已经设定好，关闭该页面</a></div>
<div id="l-map"></div>
<div id="r-result" >
	<input type="hidden" id="longitude" value="0" />
	<input type="hidden" id="latitude" value="0" />
  <!--   <input type="button" onclick="marker.enableDragging();" value="可拖拽" />
    <input type="button" onclick="marker.disableDragging();" value="不可拖拽" /> -->
</div>
</body>
</html>
<script type="text/javascript">

if (art.dialog.data('shop_longitude')) {
	document.getElementById('longitude').value = art.dialog.data('shop_longitude');// 获取由主页面传递过来的数据
	document.getElementById('latitude').value = art.dialog.data('shop_latitude');
};
// 关闭并返回数据到主页面
document.getElementById('ok').onclick = function () {
	var origin = artDialog.open.origin;
	var longitudeinput = origin.document.getElementById('shop_longitude');
	var latitudeinput = origin.document.getElementById('shop_latitude');
	longitudeinput.value = document.getElementById('longitude').value;
	latitudeinput.value = document.getElementById('latitude').value;
	art.dialog.close();
};

// 百度地图API功能
var map = new BMap.Map("l-map");
var point = new BMap.Point($('#longitude').val(),$('#latitude').val());
map.centerAndZoom(point, 12);
map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件  //右上角，仅包含平移和缩放按钮

function myFun(result){
	var cityName = result.name;
	if($('#longitude').val()==0||$('#longitude').val()==''){
		map.setCenter(cityName);
		p = new BMap.Point(result.center.lng,result.center.lat);
	}else{
		p = new BMap.Point($('#longitude').val(),$('#latitude').val());
	}
	var marker = new BMap.Marker(p);
	marker.enableDragging();
	map.addOverlay(marker);

	marker.addEventListener("dragend", function(e){
		$('#longitude').attr('value',e.point.lng)
		$('#latitude').attr('value',e.point.lat)
	})
}

var myCity = new BMap.LocalCity();
var p=myCity.get(myFun);
/*var marker = new BMap.Marker(point);  // 创建标注
map.addOverlay(marker);              // 将标注添加到地图中
marker.enableDragging();    //可拖拽
marker.addEventListener("dragend", function(e){
		alert(e.point.lng);
		alert(e.point.lat)
});
*/

</script>
