/*! fanwei 2014-03-10 */
define("lib/iscroll/iscroll-debug",[],function(t,e,n){(function(t,r){function i(t){return""===a?t:(t=t.charAt(0).toUpperCase()+t.substr(1),a+t)}var s=Math,o=r.createElement("div").style,a=function(){for(var t,e="t,webkitT,MozT,msT,OT".split(","),n=0,r=e.length;r>n;n++)if(t=e[n]+"ransform",t in o)return e[n].substr(0,e[n].length-1);return!1}(),c=a?"-"+a.toLowerCase()+"-":"",u=i("transform"),l=i("transitionProperty"),h=i("transitionDuration"),f=i("transformOrigin"),p=i("transitionTimingFunction"),d=i("transitionDelay"),m=/android/gi.test(navigator.appVersion),g=/iphone|ipad/gi.test(navigator.appVersion),v=/hp-tablet/gi.test(navigator.appVersion),y=i("perspective")in o,b="ontouchstart"in t&&!v,_=a!==!1,w=i("transition")in o,x="onorientationchange"in t?"orientationchange":"resize",E=b?"touchstart":"mousedown",T=b?"touchmove":"mousemove",S=b?"touchend":"mouseup",$=b?"touchcancel":"mouseup",H=function(){if(a===!1)return!1;var t={"":"transitionend",webkit:"webkitTransitionEnd",Moz:"transitionend",O:"otransitionend",ms:"MSTransitionEnd"};return t[a]}(),k=function(){return t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.oRequestAnimationFrame||t.msRequestAnimationFrame||function(t){return setTimeout(t,1)}}(),O=function(){return t.cancelRequestAnimationFrame||t.webkitCancelAnimationFrame||t.webkitCancelRequestAnimationFrame||t.mozCancelRequestAnimationFrame||t.oCancelRequestAnimationFrame||t.msCancelRequestAnimationFrame||clearTimeout}(),N=y?" translateZ(0)":"",I=function(e,n){var i,s=this;s.wrapper="object"==typeof e?e:r.getElementById(e),s.wrapper.style.overflow="hidden",s.scroller=s.wrapper.children[0],s.options={hScroll:!1,vScroll:!0,x:0,y:0,bounce:!1,bounceLock:!1,momentum:!0,lockDirection:!0,useTransform:!0,useTransition:!1,topOffset:0,checkDOMChanges:!1,handleClick:!0,hScrollbar:!1,vScrollbar:!1,fixedScrollbar:m,hideScrollbar:g,fadeScrollbar:g&&y,scrollbarClass:"",zoom:!1,zoomMin:1,zoomMax:4,doubleTapZoom:2,wheelAction:"scroll",snap:!1,snapThreshold:1,onRefresh:null,onBeforeScrollStart:function(t){t.preventDefault()},onScrollStart:null,onBeforeScrollMove:null,onScrollMove:null,onBeforeScrollEnd:null,onScrollEnd:null,onTouchEnd:null,onDestroy:null,onZoomStart:null,onZoom:null,onZoomEnd:null};for(i in n)s.options[i]=n[i];s.x=s.options.x,s.y=s.options.y,s.options.useTransform=_&&s.options.useTransform,s.options.hScrollbar=s.options.hScroll&&s.options.hScrollbar,s.options.vScrollbar=s.options.vScroll&&s.options.vScrollbar,s.options.zoom=s.options.useTransform&&s.options.zoom,s.options.useTransition=w&&s.options.useTransition,s.options.zoom&&m&&(N=""),s.scroller.style[l]=s.options.useTransform?c+"transform":"top left",s.scroller.style[h]="0",s.scroller.style[f]="0 0",s.options.useTransition&&(s.scroller.style[p]="cubic-bezier(0.33,0.66,0.66,1)"),s.options.useTransform?s.scroller.style[u]="translate("+s.x+"px,"+s.y+"px)"+N:s.scroller.style.cssText+=";position:absolute;top:"+s.y+"px;left:"+s.x+"px",s.options.useTransition&&(s.options.fixedScrollbar=!0),s.refresh(),s._bind(x,t),s._bind(E),b||"none"!=s.options.wheelAction&&(s._bind("DOMMouseScroll"),s._bind("mousewheel")),s.options.checkDOMChanges&&(s.checkDOMTime=setInterval(function(){s._checkDOMChanges()},500))};I.prototype={enabled:!0,x:0,y:0,steps:[],scale:1,currPageX:0,currPageY:0,pagesX:[],pagesY:[],aniTime:null,wheelZoomCount:0,handleEvent:function(t){var e=this;switch(t.type){case E:if(!b&&0!==t.button)return;e._start(t);break;case T:e._move(t);break;case S:case $:e._end(t);break;case x:e._resize();break;case"DOMMouseScroll":case"mousewheel":e._wheel(t);break;case H:e._transitionEnd(t)}},_checkDOMChanges:function(){this.moved||this.zoomed||this.animating||this.scrollerW==this.scroller.offsetWidth*this.scale&&this.scrollerH==this.scroller.offsetHeight*this.scale||this.refresh()},_scrollbar:function(t){var e,n=this;return n[t+"Scrollbar"]?(n[t+"ScrollbarWrapper"]||(e=r.createElement("div"),n.options.scrollbarClass?e.className=n.options.scrollbarClass+t.toUpperCase():e.style.cssText="position:absolute;z-index:100;"+("h"==t?"height:7px;bottom:1px;left:2px;right:"+(n.vScrollbar?"7":"2")+"px":"width:7px;bottom:"+(n.hScrollbar?"7":"2")+"px;top:2px;right:1px"),e.style.cssText+=";pointer-events:none;"+c+"transition-property:opacity;"+c+"transition-duration:"+(n.options.fadeScrollbar?"350ms":"0")+";overflow:hidden;opacity:"+(n.options.hideScrollbar?"0":"1"),n.wrapper.appendChild(e),n[t+"ScrollbarWrapper"]=e,e=r.createElement("div"),n.options.scrollbarClass||(e.style.cssText="position:absolute;z-index:100;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);"+c+"background-clip:padding-box;"+c+"box-sizing:border-box;"+("h"==t?"height:100%":"width:100%")+";"+c+"border-radius:3px;border-radius:3px"),e.style.cssText+=";pointer-events:none;"+c+"transition-property:"+c+"transform;"+c+"transition-timing-function:cubic-bezier(0.33,0.66,0.66,1);"+c+"transition-duration:0;"+c+"transform: translate(0,0)"+N,n.options.useTransition&&(e.style.cssText+=";"+c+"transition-timing-function:cubic-bezier(0.33,0.66,0.66,1)"),n[t+"ScrollbarWrapper"].appendChild(e),n[t+"ScrollbarIndicator"]=e),"h"==t?(n.hScrollbarSize=n.hScrollbarWrapper.clientWidth,n.hScrollbarIndicatorSize=s.max(s.round(n.hScrollbarSize*n.hScrollbarSize/n.scrollerW),8),n.hScrollbarIndicator.style.width=n.hScrollbarIndicatorSize+"px",n.hScrollbarMaxScroll=n.hScrollbarSize-n.hScrollbarIndicatorSize,n.hScrollbarProp=n.hScrollbarMaxScroll/n.maxScrollX):(n.vScrollbarSize=n.vScrollbarWrapper.clientHeight,n.vScrollbarIndicatorSize=s.max(s.round(n.vScrollbarSize*n.vScrollbarSize/n.scrollerH),8),n.vScrollbarIndicator.style.height=n.vScrollbarIndicatorSize+"px",n.vScrollbarMaxScroll=n.vScrollbarSize-n.vScrollbarIndicatorSize,n.vScrollbarProp=n.vScrollbarMaxScroll/n.maxScrollY),n._scrollbarPos(t,!0),void 0):(n[t+"ScrollbarWrapper"]&&(_&&(n[t+"ScrollbarIndicator"].style[u]=""),n[t+"ScrollbarWrapper"].parentNode.removeChild(n[t+"ScrollbarWrapper"]),n[t+"ScrollbarWrapper"]=null,n[t+"ScrollbarIndicator"]=null),void 0)},_resize:function(){var t=this;setTimeout(function(){t.refresh()},m?200:0)},_pos:function(t,e){this.zoomed||(t=this.hScroll?t:0,e=this.vScroll?e:0,this.options.useTransform?this.scroller.style[u]="translate("+t+"px,"+e+"px) scale("+this.scale+")"+N:(t=s.round(t),e=s.round(e),this.scroller.style.left=t+"px",this.scroller.style.top=e+"px"),this.x=t,this.y=e,this._scrollbarPos("h"),this._scrollbarPos("v"))},_scrollbarPos:function(t,e){var n,r=this,i="h"==t?r.x:r.y;r[t+"Scrollbar"]&&(i=r[t+"ScrollbarProp"]*i,0>i?(r.options.fixedScrollbar||(n=r[t+"ScrollbarIndicatorSize"]+s.round(3*i),8>n&&(n=8),r[t+"ScrollbarIndicator"].style["h"==t?"width":"height"]=n+"px"),i=0):i>r[t+"ScrollbarMaxScroll"]&&(r.options.fixedScrollbar?i=r[t+"ScrollbarMaxScroll"]:(n=r[t+"ScrollbarIndicatorSize"]-s.round(3*(i-r[t+"ScrollbarMaxScroll"])),8>n&&(n=8),r[t+"ScrollbarIndicator"].style["h"==t?"width":"height"]=n+"px",i=r[t+"ScrollbarMaxScroll"]+(r[t+"ScrollbarIndicatorSize"]-n))),r[t+"ScrollbarWrapper"].style[d]="0",r[t+"ScrollbarWrapper"].style.opacity=e&&r.options.hideScrollbar?"0":"1",r[t+"ScrollbarIndicator"].style[u]="translate("+("h"==t?i+"px,0)":"0,"+i+"px)")+N)},_start:function(e){var n,r,i,o,a,c=this,l=b?e.touches[0]:e;c.enabled&&(c.options.onBeforeScrollStart&&c.options.onBeforeScrollStart.call(c,e),(c.options.useTransition||c.options.zoom)&&c._transitionTime(0),c.moved=!1,c.animating=!1,c.zoomed=!1,c.distX=0,c.distY=0,c.absDistX=0,c.absDistY=0,c.dirX=0,c.dirY=0,c.options.zoom&&b&&e.touches.length>1&&(o=s.abs(e.touches[0].pageX-e.touches[1].pageX),a=s.abs(e.touches[0].pageY-e.touches[1].pageY),c.touchesDistStart=s.sqrt(o*o+a*a),c.originX=s.abs(e.touches[0].pageX+e.touches[1].pageX-2*c.wrapperOffsetLeft)/2-c.x,c.originY=s.abs(e.touches[0].pageY+e.touches[1].pageY-2*c.wrapperOffsetTop)/2-c.y,c.options.onZoomStart&&c.options.onZoomStart.call(c,e)),c.options.momentum&&(c.options.useTransform?(n=getComputedStyle(c.scroller,null)[u].replace(/[^0-9\-.,]/g,"").split(","),r=+(n[12]||n[4]),i=+(n[13]||n[5])):(r=+getComputedStyle(c.scroller,null).left.replace(/[^0-9-]/g,""),i=+getComputedStyle(c.scroller,null).top.replace(/[^0-9-]/g,"")),(r!=c.x||i!=c.y)&&(c.options.useTransition?c._unbind(H):O(c.aniTime),c.steps=[],c._pos(r,i),c.options.onScrollEnd&&c.options.onScrollEnd.call(c))),c.absStartX=c.x,c.absStartY=c.y,c.startX=c.x,c.startY=c.y,c.pointX=l.pageX,c.pointY=l.pageY,c.startTime=e.timeStamp||Date.now(),c.options.onScrollStart&&c.options.onScrollStart.call(c,e),c._bind(T,t),c._bind(S,t),c._bind($,t))},_move:function(t){var e,n,r,i=this,o=b?t.touches[0]:t,a=o.pageX-i.pointX,c=o.pageY-i.pointY,l=i.x+a,h=i.y+c,f=t.timeStamp||Date.now();return i.options.onBeforeScrollMove&&i.options.onBeforeScrollMove.call(i,t),i.options.zoom&&b&&t.touches.length>1?(e=s.abs(t.touches[0].pageX-t.touches[1].pageX),n=s.abs(t.touches[0].pageY-t.touches[1].pageY),i.touchesDist=s.sqrt(e*e+n*n),i.zoomed=!0,r=1/i.touchesDistStart*i.touchesDist*this.scale,i.options.zoomMin>r?r=.5*i.options.zoomMin*Math.pow(2,r/i.options.zoomMin):r>i.options.zoomMax&&(r=2*i.options.zoomMax*Math.pow(.5,i.options.zoomMax/r)),i.lastScale=r/this.scale,l=this.originX-this.originX*i.lastScale+this.x,h=this.originY-this.originY*i.lastScale+this.y,this.scroller.style[u]="translate("+l+"px,"+h+"px) scale("+r+")"+N,i.options.onZoom&&i.options.onZoom.call(i,t),void 0):(i.pointX=o.pageX,i.pointY=o.pageY,(l>0||i.maxScrollX>l)&&(l=i.options.bounce?i.x+a/2:l>=0||i.maxScrollX>=0?0:i.maxScrollX),(h>i.minScrollY||i.maxScrollY>h)&&(h=i.options.bounce?i.y+c/2:h>=i.minScrollY||i.maxScrollY>=0?i.minScrollY:i.maxScrollY),i.distX+=a,i.distY+=c,i.absDistX=s.abs(i.distX),i.absDistY=s.abs(i.distY),6>i.absDistX&&6>i.absDistY||(i.options.lockDirection&&(i.absDistX>i.absDistY+5?(h=i.y,c=0):i.absDistY>i.absDistX+5&&(l=i.x,a=0)),i.moved=!0,i._pos(l,h),i.dirX=a>0?-1:0>a?1:0,i.dirY=c>0?-1:0>c?1:0,f-i.startTime>300&&(i.startTime=f,i.startX=i.x,i.startY=i.y),i.options.onScrollMove&&i.options.onScrollMove.call(i,t)),void 0)},_end:function(e){if(!b||0===e.touches.length){var n,i,o,a,c,l,f,p=this,d=b?e.changedTouches[0]:e,m={dist:0,time:0},g={dist:0,time:0},v=(e.timeStamp||Date.now())-p.startTime,y=p.x,_=p.y;if(p._unbind(T,t),p._unbind(S,t),p._unbind($,t),p.options.onBeforeScrollEnd&&p.options.onBeforeScrollEnd.call(p,e),p.zoomed)return f=p.scale*p.lastScale,f=Math.max(p.options.zoomMin,f),f=Math.min(p.options.zoomMax,f),p.lastScale=f/p.scale,p.scale=f,p.x=p.originX-p.originX*p.lastScale+p.x,p.y=p.originY-p.originY*p.lastScale+p.y,p.scroller.style[h]="200ms",p.scroller.style[u]="translate("+p.x+"px,"+p.y+"px) scale("+p.scale+")"+N,p.zoomed=!1,p.refresh(),p.options.onZoomEnd&&p.options.onZoomEnd.call(p,e),void 0;if(!p.moved)return b&&(p.doubleTapTimer&&p.options.zoom?(clearTimeout(p.doubleTapTimer),p.doubleTapTimer=null,p.options.onZoomStart&&p.options.onZoomStart.call(p,e),p.zoom(p.pointX,p.pointY,1==p.scale?p.options.doubleTapZoom:1),p.options.onZoomEnd&&setTimeout(function(){p.options.onZoomEnd.call(p,e)},200)):this.options.handleClick&&(p.doubleTapTimer=setTimeout(function(){for(p.doubleTapTimer=null,n=d.target;1!=n.nodeType;)n=n.parentNode;"SELECT"!=n.tagName&&"INPUT"!=n.tagName&&"TEXTAREA"!=n.tagName&&(i=r.createEvent("MouseEvents"),i.initMouseEvent("click",!0,!0,e.view,1,d.screenX,d.screenY,d.clientX,d.clientY,e.ctrlKey,e.altKey,e.shiftKey,e.metaKey,0,null),i._fake=!0,n.dispatchEvent(i))},p.options.zoom?250:0))),p._resetPos(400),p.options.onTouchEnd&&p.options.onTouchEnd.call(p,e),void 0;if(300>v&&p.options.momentum&&(m=y?p._momentum(y-p.startX,v,-p.x,p.scrollerW-p.wrapperW+p.x,p.options.bounce?p.wrapperW:0):m,g=_?p._momentum(_-p.startY,v,-p.y,0>p.maxScrollY?p.scrollerH-p.wrapperH+p.y-p.minScrollY:0,p.options.bounce?p.wrapperH:0):g,y=p.x+m.dist,_=p.y+g.dist,(p.x>0&&y>0||p.x<p.maxScrollX&&p.maxScrollX>y)&&(m={dist:0,time:0}),(p.y>p.minScrollY&&_>p.minScrollY||p.y<p.maxScrollY&&p.maxScrollY>_)&&(g={dist:0,time:0})),m.dist||g.dist)return c=s.max(s.max(m.time,g.time),10),p.options.snap&&(o=y-p.absStartX,a=_-p.absStartY,s.abs(o)<p.options.snapThreshold&&s.abs(a)<p.options.snapThreshold?p.scrollTo(p.absStartX,p.absStartY,200):(l=p._snap(y,_),y=l.x,_=l.y,c=s.max(l.time,c))),p.scrollTo(s.round(y),s.round(_),c),p.options.onTouchEnd&&p.options.onTouchEnd.call(p,e),void 0;if(p.options.snap)return o=y-p.absStartX,a=_-p.absStartY,s.abs(o)<p.options.snapThreshold&&s.abs(a)<p.options.snapThreshold?p.scrollTo(p.absStartX,p.absStartY,200):(l=p._snap(p.x,p.y),(l.x!=p.x||l.y!=p.y)&&p.scrollTo(l.x,l.y,l.time)),p.options.onTouchEnd&&p.options.onTouchEnd.call(p,e),void 0;p._resetPos(200),p.options.onTouchEnd&&p.options.onTouchEnd.call(p,e)}},_resetPos:function(t){var e=this,n=e.x>=0?0:e.x<e.maxScrollX?e.maxScrollX:e.x,r=e.y>=e.minScrollY||e.maxScrollY>0?e.minScrollY:e.y<e.maxScrollY?e.maxScrollY:e.y;return n==e.x&&r==e.y?(e.moved&&(e.moved=!1,e.options.onScrollEnd&&e.options.onScrollEnd.call(e)),e.hScrollbar&&e.options.hideScrollbar&&("webkit"==a&&(e.hScrollbarWrapper.style[d]="300ms"),e.hScrollbarWrapper.style.opacity="0"),e.vScrollbar&&e.options.hideScrollbar&&("webkit"==a&&(e.vScrollbarWrapper.style[d]="300ms"),e.vScrollbarWrapper.style.opacity="0"),void 0):(e.scrollTo(n,r,t||0),void 0)},_wheel:function(t){var e,n,r,i,s,o=this;if("wheelDeltaX"in t)e=t.wheelDeltaX/12,n=t.wheelDeltaY/12;else if("wheelDelta"in t)e=n=t.wheelDelta/12;else{if(!("detail"in t))return;e=n=3*-t.detail}return"zoom"==o.options.wheelAction?(s=o.scale*Math.pow(2,1/3*(n?n/Math.abs(n):0)),o.options.zoomMin>s&&(s=o.options.zoomMin),s>o.options.zoomMax&&(s=o.options.zoomMax),s!=o.scale&&(!o.wheelZoomCount&&o.options.onZoomStart&&o.options.onZoomStart.call(o,t),o.wheelZoomCount++,o.zoom(t.pageX,t.pageY,s,400),setTimeout(function(){o.wheelZoomCount--,!o.wheelZoomCount&&o.options.onZoomEnd&&o.options.onZoomEnd.call(o,t)},400)),void 0):(r=o.x+e,i=o.y+n,r>0?r=0:o.maxScrollX>r&&(r=o.maxScrollX),i>o.minScrollY?i=o.minScrollY:o.maxScrollY>i&&(i=o.maxScrollY),0>o.maxScrollY&&o.scrollTo(r,i,0),void 0)},_transitionEnd:function(t){var e=this;t.target==e.scroller&&(e._unbind(H),e._startAni())},_startAni:function(){var t,e,n,r=this,i=r.x,o=r.y,a=Date.now();if(!r.animating){if(!r.steps.length)return r._resetPos(400),void 0;if(t=r.steps.shift(),t.x==i&&t.y==o&&(t.time=0),r.animating=!0,r.moved=!0,r.options.useTransition)return r._transitionTime(t.time),r._pos(t.x,t.y),r.animating=!1,t.time?r._bind(H):r._resetPos(0),void 0;n=function(){var c,u,l=Date.now();return l>=a+t.time?(r._pos(t.x,t.y),r.animating=!1,r.options.onAnimationEnd&&r.options.onAnimationEnd.call(r),r._startAni(),void 0):(l=(l-a)/t.time-1,e=s.sqrt(1-l*l),c=(t.x-i)*e+i,u=(t.y-o)*e+o,r._pos(c,u),r.animating&&(r.aniTime=k(n)),void 0)},n()}},_transitionTime:function(t){t+="ms",this.scroller.style[h]=t,this.hScrollbar&&(this.hScrollbarIndicator.style[h]=t),this.vScrollbar&&(this.vScrollbarIndicator.style[h]=t)},_momentum:function(t,e,n,r,i){var o=6e-4,a=s.abs(t)/e,c=a*a/(2*o),u=0,l=0;return t>0&&c>n?(l=i/(6/(c/a*o)),n+=l,a=a*n/c,c=n):0>t&&c>r&&(l=i/(6/(c/a*o)),r+=l,a=a*r/c,c=r),c*=0>t?-1:1,u=a/o,{dist:c,time:s.round(u)}},_offset:function(t){for(var e=-t.offsetLeft,n=-t.offsetTop;t=t.offsetParent;)e-=t.offsetLeft,n-=t.offsetTop;return t!=this.wrapper&&(e*=this.scale,n*=this.scale),{left:e,top:n}},_snap:function(t,e){var n,r,i,o,a,c,u=this;for(i=u.pagesX.length-1,n=0,r=u.pagesX.length;r>n;n++)if(t>=u.pagesX[n]){i=n;break}for(i==u.currPageX&&i>0&&0>u.dirX&&i--,t=u.pagesX[i],a=s.abs(t-u.pagesX[u.currPageX]),a=a?500*(s.abs(u.x-t)/a):0,u.currPageX=i,i=u.pagesY.length-1,n=0;i>n;n++)if(e>=u.pagesY[n]){i=n;break}return i==u.currPageY&&i>0&&0>u.dirY&&i--,e=u.pagesY[i],c=s.abs(e-u.pagesY[u.currPageY]),c=c?500*(s.abs(u.y-e)/c):0,u.currPageY=i,o=s.round(s.max(a,c))||200,{x:t,y:e,time:o}},_bind:function(t,e,n){(e||this.scroller).addEventListener(t,this,!!n)},_unbind:function(t,e,n){(e||this.scroller).removeEventListener(t,this,!!n)},destroy:function(){var e=this;e.scroller.style[u]="",e.hScrollbar=!1,e.vScrollbar=!1,e._scrollbar("h"),e._scrollbar("v"),e._unbind(x,t),e._unbind(E),e._unbind(T,t),e._unbind(S,t),e._unbind($,t),e.options.hasTouch||(e._unbind("DOMMouseScroll"),e._unbind("mousewheel")),e.options.useTransition&&e._unbind(H),e.options.checkDOMChanges&&clearInterval(e.checkDOMTime),e.options.onDestroy&&e.options.onDestroy.call(e)},refresh:function(){var t,e,n,r,i=this,o=0,a=0;if(i.scale<i.options.zoomMin&&(i.scale=i.options.zoomMin),i.wrapperW=i.wrapper.clientWidth||1,i.wrapperH=i.wrapper.clientHeight||1,i.minScrollY=-i.options.topOffset||0,i.scrollerW=s.round(i.scroller.offsetWidth*i.scale),i.scrollerH=s.round((i.scroller.offsetHeight+i.minScrollY)*i.scale),i.maxScrollX=i.wrapperW-i.scrollerW,i.maxScrollY=i.wrapperH-i.scrollerH+i.minScrollY,i.dirX=0,i.dirY=0,i.options.onRefresh&&i.options.onRefresh.call(i),i.hScroll=i.options.hScroll&&0>i.maxScrollX,i.vScroll=i.options.vScroll&&(!i.options.bounceLock&&!i.hScroll||i.scrollerH>i.wrapperH),i.hScrollbar=i.hScroll&&i.options.hScrollbar,i.vScrollbar=i.vScroll&&i.options.vScrollbar&&i.scrollerH>i.wrapperH,t=i._offset(i.wrapper),i.wrapperOffsetLeft=-t.left,i.wrapperOffsetTop=-t.top,"string"==typeof i.options.snap)for(i.pagesX=[],i.pagesY=[],r=i.scroller.querySelectorAll(i.options.snap),e=0,n=r.length;n>e;e++)o=i._offset(r[e]),o.left+=i.wrapperOffsetLeft,o.top+=i.wrapperOffsetTop,i.pagesX[e]=o.left<i.maxScrollX?i.maxScrollX:o.left*i.scale,i.pagesY[e]=o.top<i.maxScrollY?i.maxScrollY:o.top*i.scale;else if(i.options.snap){for(i.pagesX=[];o>=i.maxScrollX;)i.pagesX[a]=o,o-=i.wrapperW,a++;for(i.maxScrollX%i.wrapperW&&(i.pagesX[i.pagesX.length]=i.maxScrollX-i.pagesX[i.pagesX.length-1]+i.pagesX[i.pagesX.length-1]),o=0,a=0,i.pagesY=[];o>=i.maxScrollY;)i.pagesY[a]=o,o-=i.wrapperH,a++;i.maxScrollY%i.wrapperH&&(i.pagesY[i.pagesY.length]=i.maxScrollY-i.pagesY[i.pagesY.length-1]+i.pagesY[i.pagesY.length-1])}i._scrollbar("h"),i._scrollbar("v"),i.zoomed||(i.scroller.style[h]="0",i._resetPos(400))},scrollTo:function(t,e,n,r){var i,s,o=this,a=t;for(o.stop(),a.length||(a=[{x:t,y:e,time:n,relative:r}]),i=0,s=a.length;s>i;i++)a[i].relative&&(a[i].x=o.x-a[i].x,a[i].y=o.y-a[i].y),o.steps.push({x:a[i].x,y:a[i].y,time:a[i].time||0});o._startAni()},scrollToElement:function(t,e){var n,r=this;t=t.nodeType?t:r.scroller.querySelector(t),t&&(n=r._offset(t),n.left+=r.wrapperOffsetLeft,n.top+=r.wrapperOffsetTop,n.left=n.left>0?0:n.left<r.maxScrollX?r.maxScrollX:n.left,n.top=n.top>r.minScrollY?r.minScrollY:n.top<r.maxScrollY?r.maxScrollY:n.top,e=void 0===e?s.max(2*s.abs(n.left),2*s.abs(n.top)):e,r.scrollTo(n.left,n.top,e))},scrollToPage:function(t,e,n){var r,i,s=this;n=void 0===n?400:n,s.options.onScrollStart&&s.options.onScrollStart.call(s),s.options.snap?(t="next"==t?s.currPageX+1:"prev"==t?s.currPageX-1:t,e="next"==e?s.currPageY+1:"prev"==e?s.currPageY-1:e,t=0>t?0:t>s.pagesX.length-1?s.pagesX.length-1:t,e=0>e?0:e>s.pagesY.length-1?s.pagesY.length-1:e,s.currPageX=t,s.currPageY=e,r=s.pagesX[t],i=s.pagesY[e]):(r=-s.wrapperW*t,i=-s.wrapperH*e,s.maxScrollX>r&&(r=s.maxScrollX),s.maxScrollY>i&&(i=s.maxScrollY)),s.scrollTo(r,i,n)},disable:function(){this.stop(),this._resetPos(0),this.enabled=!1,this._unbind(T,t),this._unbind(S,t),this._unbind($,t)},enable:function(){this.enabled=!0},stop:function(){this.options.useTransition?this._unbind(H):O(this.aniTime),this.steps=[],this.moved=!1,this.animating=!1},zoom:function(t,e,n,r){var i=this,s=n/i.scale;i.options.useTransform&&(i.zoomed=!0,r=void 0===r?200:r,t=t-i.wrapperOffsetLeft-i.x,e=e-i.wrapperOffsetTop-i.y,i.x=t-t*s+i.x,i.y=e-e*s+i.y,i.scale=n,i.refresh(),i.x=i.x>0?0:i.x<i.maxScrollX?i.maxScrollX:i.x,i.y=i.y>i.minScrollY?i.minScrollY:i.y<i.maxScrollY?i.maxScrollY:i.y,i.scroller.style[h]=r+"ms",i.scroller.style[u]="translate("+i.x+"px,"+i.y+"px) scale("+n+")"+N,i.zoomed=!1)},isReady:function(){return!this.moved&&!this.zoomed&&!this.animating}},o=null,e!==void 0?e.iScroll=I:t.iScroll=I,n.exports=I})(window,document)});