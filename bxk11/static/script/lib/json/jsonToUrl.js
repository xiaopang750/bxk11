define(function(require, exports, module) {

	function jsonUrl(json)
	{	
	  var arr = [];

	  for (var i in json)
	  {
	    var str = json[i] + "";
	    str = str.replace(/\n/g, "<br/>");
	    str = encodeURIComponent(str);
	    arr.push(i + "=" + str);
	  }
	  
	  return arr.join("&");

	}

	return jsonUrl;

});