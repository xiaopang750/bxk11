/**
 *description:qq在线客服
 *author:fanwei
 *date:2014/06/04
 */

/*
	api请参考: https://id.b.qq.com/login/index
	账号密码请询问管理人员
*/

define(function(require, exports, module){
	
	var oQQ = $('#qqask');
	
	setTimeout(startQQ, 1000);

	function startQQ() {

		var oScript = document.createElement('script');
		oScript.src = 'http://wpa.b.qq.com/cgi/wpa.php';
		document.body.appendChild(oScript);	

		oScript.onload = oScript.onreadystatechange = function(){

		    if(!this.readyState || this.readyState=='loaded' || this.readyState=='complete') {  

		   		BizQQWPA.addCustom({aty: '0', a: '0', nameAccount: 800061781, selector: 'qqask', type:'1'});

		   		oQQ.show();		
		   		
		    } 
		}  
	}

});