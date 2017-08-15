<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>全景展示</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<style>
		body, div, h1, h2, h3, span, p {
		    font-family: Verdana,Arial,Helvetica,sans-serif;
		    color: #000000; 
		}
		/* fullscreen */
		html {
		    height:100%;
		}
		body {
		    height:100%;
		    margin: 0px;
		    overflow:hidden; /* disable scrollbars */
		}
		body {
		  font-size: 10pt;
		  background : #ffffff; 
		}
		table,tr,td {
		    font-size: 10pt;
		    border-color : #777777;
		    background : #dddddd; 
		    color: #000000; 
		    border-style : solid;
		    border-width : 2px;
		    padding: 5px;
		    border-collapse:collapse;
		}
		h1 {
		    font-size: 18pt;
		}
		h2 {
		    font-size: 14pt;
		}
		.warning { 
		    font-weight: bold;
		} 
		/* fix for scroll bars on webkit & Mac OS X Lion */ 
		::-webkit-scrollbar {
		    background-color: rgba(0,0,0,0.5);
		    width: 0.75em;
		}
		::-webkit-scrollbar-thumb {
		    background-color:  rgba(255,255,255,0.5);
		}
		a {
		    text-decoration: none;
		}
	</style>
	<script type="text/javascript" src="<?php echo ROOT; ?>3d/view.js"></script>
	<script type="text/javascript" src="<?php echo ROOT; ?>3d/rotate.js"></script>
	</head>
	<body>
		<div id="container" style="width:100%;height:100%;">
		This content requires HTML5/CSS3, WebGL;
		</div>
		<script type="text/javascript">

		var rid = window.location.href.substring(window.location.href.lastIndexOf('=')+1);

		var root = "/uploads/room/" + Math.ceil(rid/1000);

		var uri = root + '/' + rid + '/' + 'ok.xml';
		
		// check for CSS3 3D transformations and WebGL
		if (ggHasHtml5Css3D() || ggHasWebGL()) {
	
			// create the panorama player with the container
			pano=new pano2vrPlayer("container");
			// add the skin object
			skin=new pano2vrSkin(pano);
			// load the configuration
			pano.readConfigUrl( uri );

			//'/uploads/room/1/930/ok.xml'
			//'http://192.168.1.87/index.php/view/room/createJsXml?room=' + rid
			//http://www.fanwei.com/haha.php

			// hide the URL bar on the iPhone
			hideUrlBar();

		} else {

			
		} 
		</script>
		<noscript>
			<p><b>Please enable Javascript!</b></p>
		</noscript>
	</body>
</html>
