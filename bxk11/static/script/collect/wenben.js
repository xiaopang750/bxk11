(function(){

	var hrefs = window.location.href;
	var ele = document.createElement('script');
	hrefs = encodeURIComponent(hrefs);
	ele.src = 'http://192.168.1.87/index.php/collect/test_version?url='+hrefs;
	// ele.onload = function()
	// {
	// 	//alert(window.callback['name']);
	// }
	document.body.appendChild(ele);


	
})()