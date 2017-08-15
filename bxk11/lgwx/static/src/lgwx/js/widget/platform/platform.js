/**
 *description:平台检测
 *author:fanwei
 *date:2014/5/12
 */

 /*
	该js只用作检测是mobile端还是pc端;
 */
 define(function(require, exports, module){
 		
 		var _platform;

 		var system ={
		        win : false,
		        mac : false,
		        xll : false
	        };
	       
	        var p = navigator.platform;
	       
	        system.win = p.indexOf("Win") == 0;
	        system.mac = p.indexOf("Mac") == 0;
	        system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
	        
	        if(system.win||system.mac||system.xll){
	            _platform = 'pc';
	        }else{
	            _platform = 'mobile';
	        }

	    return  _platform;   

 });