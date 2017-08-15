/*! fanwei 2014-03-10 */
define("widget/focus/focus-debug",["../../lib/hammer/hammer-debug","../../lib/underscore/underscore-debug"],function(require,exports,module){function Focus(t){t=t||{},this.oWrap=t.oWrap||null,this.oDataWrap=this.oWrap.find("[widget-role = focus-data-wrap]")||null,this.oDotWrap=this.oWrap.find("[widget-role = focus-dot-wrap]")||null,this.requestType=t.requestType||"post",this.speed=t.speed||500,this.auto=t.auto?!0:true,this.roudTime=t.roudTime||5e3,this.url=t.url||"",this.param=t.param||null,this.compailed=t.compailed||'<%_.each(data, function(focus){%><li><img src="<%=focus.slide_pic%>" link="<%=focus.slide_url%>"/></li><%})%>',this.orgWidth=this.oWrap.attr("widget-width"),this.orgHeight=this.oWrap.attr("widget-height"),this.scale=this.oWrap.attr("widget-scale"),this.sensity=t.sensity||50,this._start=0,this._iNow=0,this._wrapWidth=0,this.timer=null,this.roundTimer=null,this._lock=!1,this._ORIENT_DELAY=500,this._ORGDOTBG="#fff",this._ACTDOTBG="#ff5000",this.lock=!1}require("../../lib/hammer/hammer-debug"),require("../../lib/underscore/underscore-debug"),Focus.prototype={init:function(){this.load(),this.auto?this.autoPlay():null},addEvent:function(){var t=this;this.oWrap.hammer().on("touch dragleft dragright dragend tap",function(e){switch(e.type){case"touch":clearInterval(t.roundTimer),$.css3(t.oDataWrap,{transition:"none"});break;case"dragleft":e.gesture.preventDefault(),t.dragmove(t.oDataWrap,e);break;case"dragright":e.gesture.preventDefault(),t.dragmove(t.oDataWrap,e);break;case"dragend":var n,r,i;n=e.gesture,r=n.deltaX,i=n.direction,t.judge(r,i),t.autoPlay();break;case"tap":var o=e.srcElement.getAttribute("link");o&&(window.location=o)}}),window.onorientationchange=function(){clearTimeout(t.timer),t.timer=setTimeout(function(){t.setStyle(t.num),t.setDotWrap(),$.css3(t.oDataWrap,{transition:"none",transform:"translateX(0)"}),t.autoPlay()},t._ORIENT_DELAY)}},dragmove:function(t,e){var n,r;r=e.gesture.deltaX,n=r,$.css3(t,{transform:"translateX("+n+"px)"})},autoPlay:function(){var t=this;clearInterval(this.roundTimer),this.roundTimer=setInterval(function(){t.judge(t.sensity+1,"left")},this.roudTime)},judge:function(t,e){Math.abs(t)>this.sensity?"left"==e?(this._iNow++,this._iNow==this._aLi.length&&(this._iNow=0),this.animate(-this._wrapWidth)):(this._iNow--,-1==this._iNow&&(this._iNow=this._aLi.length-1),this.animate(this._wrapWidth)):this.animate(0)},animate:function(t){var e=this;$.css3(this.oDataWrap,{transition:this.speed+"ms",transform:"translateX("+t+"px)"}),setTimeout(function(){e._aDot.eq(e._iNow).css("background",e._ACTDOTBG).siblings().css("background",e._ORGDOTBG),e.postion(e._aLi)},this.speed)},setStyle:function(){var t,e,n;t=this.calc(),e=t.w,n=t.h,this._wrapWidth=e,this._aLi=this.oDataWrap.children(),this.oWrap.css({width:e+"px",height:n+"px",position:"relative",overflow:"hidden"}),this._aLi.css({width:e+"px",height:n+"px",position:"absolute",top:0}),this.oDataWrap.find("img").css({width:"100%",height:"100%",display:"block"}),this.oDataWrap.css({position:"relative"}),this.postion(this._aLi)},postion:function(t){$.css3(this.oDataWrap,{transition:"none",transform:"translateX(0)"}),t.hide(),t.eq(this._iNow%t.length).show(),t.eq(this._iNow%t.length).css({left:0}),this.getPrev(t).css({left:-this._wrapWidth+"px",display:"block"}),this.getNext(t).css({left:this._wrapWidth+"px",display:"block"})},getPrev:function(t){return t.eq((this._iNow+t.length-1)%t.length)},getNext:function(t){return t.eq((this._iNow+1)%t.length)},calc:function(){var t,e;return t=document.documentElement.clientWidth*this.scale,e=t/this.orgWidth*this.orgHeight,{w:t,h:e}},load:function(){var _this=this;$.ajax({url:this.url,dataType:"text",success:function(data){var data=eval("("+data+")");_this.createDomList(data),_this.num=data.data.length,_this.setStyle(_this.num),_this.createDot(),_this.addEvent()}})},createDomList:function(t){var e=_.template(this.compailed,t);this.oDataWrap.html(e)},createDot:function(){var t,e;for(e=this._aLi.length,this.setDotWrap(),t=0;e>t;t++){var n=$('<a href="javascript:;"></a>');n.css({width:"0.5rem",height:"0.5rem",display:"inline-block",background:this._ORGDOTBG,margin:"0.3rem",borderRadius:"0.5rem"}),this.oDotWrap.append(n)}this._aDot=this.oDotWrap.children(),this._aDot.eq(0).css("background",this._ACTDOTBG)},setDotWrap:function(){this.oDotWrap.css({textAlign:"center",position:"absolute",bottom:0,width:this._wrapWidth})}},module.exports=Focus}),define("lib/hammer/hammer-debug",[],function(t,e,n){(function(t,e){"use strict";function r(){Hammer.READY||(Hammer.event.determineEventTypes(),Hammer.utils.each(Hammer.gestures,function(t){Hammer.detection.register(t)}),Hammer.event.onTouch(Hammer.DOCUMENT,Hammer.EVENT_MOVE,Hammer.detection.detect),Hammer.event.onTouch(Hammer.DOCUMENT,Hammer.EVENT_END,Hammer.detection.detect),Hammer.READY=!0)}t.Hammer=function(t,e){return new Hammer.Instance(t,e||{})},Hammer.defaults={stop_browser_behavior:{userSelect:"none",touchAction:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}},Hammer.HAS_POINTEREVENTS=t.navigator.pointerEnabled||t.navigator.msPointerEnabled,Hammer.HAS_TOUCHEVENTS="ontouchstart"in t,Hammer.MOBILE_REGEX=/mobile|tablet|ip(ad|hone|od)|android|silk/i,Hammer.NO_MOUSEEVENTS=Hammer.HAS_TOUCHEVENTS&&t.navigator.userAgent.match(Hammer.MOBILE_REGEX),Hammer.EVENT_TYPES={},Hammer.DIRECTION_DOWN="down",Hammer.DIRECTION_LEFT="left",Hammer.DIRECTION_UP="up",Hammer.DIRECTION_RIGHT="right",Hammer.POINTER_MOUSE="mouse",Hammer.POINTER_TOUCH="touch",Hammer.POINTER_PEN="pen",Hammer.EVENT_START="start",Hammer.EVENT_MOVE="move",Hammer.EVENT_END="end",Hammer.DOCUMENT=t.document,Hammer.plugins=Hammer.plugins||{},Hammer.gestures=Hammer.gestures||{},Hammer.READY=!1,Hammer.utils={extend:function(t,n,r){for(var i in n)t[i]!==e&&r||(t[i]=n[i]);return t},each:function(t,n,r){var i,o;if("forEach"in t)t.forEach(n,r);else if(t.length!==e){for(i=0,o=t.length;o>i;i++)if(n.call(r,t[i],i,t)===!1)return}else for(i in t)if(t.hasOwnProperty(i)&&n.call(r,t[i],i,t)===!1)return},hasParent:function(t,e){for(;t;){if(t==e)return!0;t=t.parentNode}return!1},getCenter:function(t){var n=[],r=[];return Hammer.utils.each(t,function(t){n.push(t.clientX!==e?t.clientX:t.pageX),r.push(t.clientY!==e?t.clientY:t.pageY)}),{pageX:(Math.min.apply(Math,n)+Math.max.apply(Math,n))/2,pageY:(Math.min.apply(Math,r)+Math.max.apply(Math,r))/2}},getVelocity:function(t,e,n){return{x:Math.abs(e/t)||0,y:Math.abs(n/t)||0}},getAngle:function(t,e){var n=e.pageY-t.pageY,r=e.pageX-t.pageX;return 180*Math.atan2(n,r)/Math.PI},getDirection:function(t,e){var n=Math.abs(t.pageX-e.pageX),r=Math.abs(t.pageY-e.pageY);return n>=r?t.pageX-e.pageX>0?Hammer.DIRECTION_LEFT:Hammer.DIRECTION_RIGHT:t.pageY-e.pageY>0?Hammer.DIRECTION_UP:Hammer.DIRECTION_DOWN},getDistance:function(t,e){var n=e.pageX-t.pageX,r=e.pageY-t.pageY;return Math.sqrt(n*n+r*r)},getScale:function(t,e){return t.length>=2&&e.length>=2?this.getDistance(e[0],e[1])/this.getDistance(t[0],t[1]):1},getRotation:function(t,e){return t.length>=2&&e.length>=2?this.getAngle(e[1],e[0])-this.getAngle(t[1],t[0]):0},isVertical:function(t){return t==Hammer.DIRECTION_UP||t==Hammer.DIRECTION_DOWN},stopDefaultBrowserBehavior:function(t,e){e&&t&&t.style&&(Hammer.utils.each(["webkit","khtml","moz","Moz","ms","o",""],function(n){Hammer.utils.each(e,function(e){n&&(e=n+e.substring(0,1).toUpperCase()+e.substring(1)),e in t.style&&(t.style[e]=e)})}),"none"==e.userSelect&&(t.onselectstart=function(){return!1}),"none"==e.userDrag&&(t.ondragstart=function(){return!1}))}},Hammer.Instance=function(t,e){var n=this;return r(),this.element=t,this.enabled=!0,this.options=Hammer.utils.extend(Hammer.utils.extend({},Hammer.defaults),e||{}),this.options.stop_browser_behavior&&Hammer.utils.stopDefaultBrowserBehavior(this.element,this.options.stop_browser_behavior),Hammer.event.onTouch(t,Hammer.EVENT_START,function(t){n.enabled&&Hammer.detection.startDetect(n,t)}),this},Hammer.Instance.prototype={on:function(t,e){var n=t.split(" ");return Hammer.utils.each(n,function(t){this.element.addEventListener(t,e,!1)},this),this},off:function(t,e){var n=t.split(" ");return Hammer.utils.each(n,function(t){this.element.removeEventListener(t,e,!1)},this),this},trigger:function(t,e){e||(e={});var n=Hammer.DOCUMENT.createEvent("Event");n.initEvent(t,!0,!0),n.gesture=e;var r=this.element;return Hammer.utils.hasParent(e.target,r)&&(r=e.target),r.dispatchEvent(n),this},enable:function(t){return this.enabled=t,this}};var i=null,o=!1,a=!1;Hammer.event={bindDom:function(t,e,n){var r=e.split(" ");Hammer.utils.each(r,function(e){t.addEventListener(e,n,!1)})},onTouch:function(t,e,n){var r=this;this.bindDom(t,Hammer.EVENT_TYPES[e],function(s){var c=s.type.toLowerCase();if(!c.match(/mouse/)||!a){c.match(/touch/)||c.match(/pointerdown/)||c.match(/mouse/)&&1===s.which?o=!0:c.match(/mouse/)&&!s.which&&(o=!1),c.match(/touch|pointer/)&&(a=!0);var u=0;o&&(Hammer.HAS_POINTEREVENTS&&e!=Hammer.EVENT_END?u=Hammer.PointerEvent.updatePointer(e,s):c.match(/touch/)?u=s.touches.length:a||(u=c.match(/up/)?0:1),u>0&&e==Hammer.EVENT_END?e=Hammer.EVENT_MOVE:u||(e=Hammer.EVENT_END),(u||null===i)&&(i=s),n.call(Hammer.detection,r.collectEventData(t,e,r.getTouchList(i,e),s)),Hammer.HAS_POINTEREVENTS&&e==Hammer.EVENT_END&&(u=Hammer.PointerEvent.updatePointer(e,s))),u||(i=null,o=!1,a=!1,Hammer.PointerEvent.reset())}})},determineEventTypes:function(){var t;t=Hammer.HAS_POINTEREVENTS?Hammer.PointerEvent.getEvents():Hammer.NO_MOUSEEVENTS?["touchstart","touchmove","touchend touchcancel"]:["touchstart mousedown","touchmove mousemove","touchend touchcancel mouseup"],Hammer.EVENT_TYPES[Hammer.EVENT_START]=t[0],Hammer.EVENT_TYPES[Hammer.EVENT_MOVE]=t[1],Hammer.EVENT_TYPES[Hammer.EVENT_END]=t[2]},getTouchList:function(t){return Hammer.HAS_POINTEREVENTS?Hammer.PointerEvent.getTouchList():t.touches?t.touches:(t.identifier=1,[t])},collectEventData:function(t,e,n,r){var i=Hammer.POINTER_TOUCH;return(r.type.match(/mouse/)||Hammer.PointerEvent.matchType(Hammer.POINTER_MOUSE,r))&&(i=Hammer.POINTER_MOUSE),{center:Hammer.utils.getCenter(n),timeStamp:(new Date).getTime(),target:r.target,touches:n,eventType:e,pointerType:i,srcEvent:r,preventDefault:function(){this.srcEvent.preventManipulation&&this.srcEvent.preventManipulation(),this.srcEvent.preventDefault&&this.srcEvent.preventDefault()},stopPropagation:function(){this.srcEvent.stopPropagation()},stopDetect:function(){return Hammer.detection.stopDetect()}}}},Hammer.PointerEvent={pointers:{},getTouchList:function(){var t=this,e=[];return Hammer.utils.each(t.pointers,function(t){e.push(t)}),e},updatePointer:function(t,e){return t==Hammer.EVENT_END?this.pointers={}:(e.identifier=e.pointerId,this.pointers[e.pointerId]=e),Object.keys(this.pointers).length},matchType:function(t,e){if(!e.pointerType)return!1;var n=e.pointerType,r={};return r[Hammer.POINTER_MOUSE]=n===e.MSPOINTER_TYPE_MOUSE||n===Hammer.POINTER_MOUSE,r[Hammer.POINTER_TOUCH]=n===e.MSPOINTER_TYPE_TOUCH||n===Hammer.POINTER_TOUCH,r[Hammer.POINTER_PEN]=n===e.MSPOINTER_TYPE_PEN||n===Hammer.POINTER_PEN,r[t]},getEvents:function(){return["pointerdown MSPointerDown","pointermove MSPointerMove","pointerup pointercancel MSPointerUp MSPointerCancel"]},reset:function(){this.pointers={}}},Hammer.detection={gestures:[],current:null,previous:null,stopped:!1,startDetect:function(t,e){this.current||(this.stopped=!1,this.current={inst:t,startEvent:Hammer.utils.extend({},e),lastEvent:!1,name:""},this.detect(e))},detect:function(t){if(this.current&&!this.stopped){t=this.extendEventData(t);var n=this.current.inst.options;return Hammer.utils.each(this.gestures,function(r){return this.stopped||n[r.name]===!1||r.handler.call(r,t,this.current.inst)!==!1?e:(this.stopDetect(),!1)},this),this.current&&(this.current.lastEvent=t),t.eventType==Hammer.EVENT_END&&!t.touches.length-1&&this.stopDetect(),t}},stopDetect:function(){this.previous=Hammer.utils.extend({},this.current),this.current=null,this.stopped=!0},extendEventData:function(t){var e=this.current.startEvent;!e||t.touches.length==e.touches.length&&t.touches!==e.touches||(e.touches=[],Hammer.utils.each(t.touches,function(t){e.touches.push(Hammer.utils.extend({},t))}));var n,r,i=t.timeStamp-e.timeStamp,o=t.center.pageX-e.center.pageX,a=t.center.pageY-e.center.pageY,s=Hammer.utils.getVelocity(i,o,a);return"end"===t.eventType?(n=this.current.lastEvent&&this.current.lastEvent.interimAngle,r=this.current.lastEvent&&this.current.lastEvent.interimDirection):(n=this.current.lastEvent&&Hammer.utils.getAngle(this.current.lastEvent.center,t.center),r=this.current.lastEvent&&Hammer.utils.getDirection(this.current.lastEvent.center,t.center)),Hammer.utils.extend(t,{deltaTime:i,deltaX:o,deltaY:a,velocityX:s.x,velocityY:s.y,distance:Hammer.utils.getDistance(e.center,t.center),angle:Hammer.utils.getAngle(e.center,t.center),interimAngle:n,direction:Hammer.utils.getDirection(e.center,t.center),interimDirection:r,scale:Hammer.utils.getScale(e.touches,t.touches),rotation:Hammer.utils.getRotation(e.touches,t.touches),startEvent:e}),t},register:function(t){var n=t.defaults||{};return n[t.name]===e&&(n[t.name]=!0),Hammer.utils.extend(Hammer.defaults,n,!0),t.index=t.index||1e3,this.gestures.push(t),this.gestures.sort(function(t,e){return t.index<e.index?-1:t.index>e.index?1:0}),this.gestures}},Hammer.gestures.Drag={name:"drag",index:50,defaults:{drag_min_distance:10,correct_for_drag_min_distance:!0,drag_max_touches:1,drag_block_horizontal:!1,drag_block_vertical:!1,drag_lock_to_axis:!1,drag_lock_min_distance:25},triggered:!1,handler:function(t,n){if(Hammer.detection.current.name!=this.name&&this.triggered)return n.trigger(this.name+"end",t),this.triggered=!1,e;if(!(n.options.drag_max_touches>0&&t.touches.length>n.options.drag_max_touches))switch(t.eventType){case Hammer.EVENT_START:this.triggered=!1;break;case Hammer.EVENT_MOVE:if(t.distance<n.options.drag_min_distance&&Hammer.detection.current.name!=this.name)return;if(Hammer.detection.current.name!=this.name&&(Hammer.detection.current.name=this.name,n.options.correct_for_drag_min_distance&&t.distance>0)){var r=Math.abs(n.options.drag_min_distance/t.distance);Hammer.detection.current.startEvent.center.pageX+=t.deltaX*r,Hammer.detection.current.startEvent.center.pageY+=t.deltaY*r,t=Hammer.detection.extendEventData(t)}(Hammer.detection.current.lastEvent.drag_locked_to_axis||n.options.drag_lock_to_axis&&n.options.drag_lock_min_distance<=t.distance)&&(t.drag_locked_to_axis=!0);var i=Hammer.detection.current.lastEvent.direction;t.drag_locked_to_axis&&i!==t.direction&&(t.direction=Hammer.utils.isVertical(i)?0>t.deltaY?Hammer.DIRECTION_UP:Hammer.DIRECTION_DOWN:0>t.deltaX?Hammer.DIRECTION_LEFT:Hammer.DIRECTION_RIGHT),this.triggered||(n.trigger(this.name+"start",t),this.triggered=!0),n.trigger(this.name,t),n.trigger(this.name+t.direction,t),(n.options.drag_block_vertical&&Hammer.utils.isVertical(t.direction)||n.options.drag_block_horizontal&&!Hammer.utils.isVertical(t.direction))&&t.preventDefault();break;case Hammer.EVENT_END:this.triggered&&n.trigger(this.name+"end",t),this.triggered=!1}}},Hammer.gestures.Hold={name:"hold",index:10,defaults:{hold_timeout:500,hold_threshold:1},timer:null,handler:function(t,e){switch(t.eventType){case Hammer.EVENT_START:clearTimeout(this.timer),Hammer.detection.current.name=this.name,this.timer=setTimeout(function(){"hold"==Hammer.detection.current.name&&e.trigger("hold",t)},e.options.hold_timeout);break;case Hammer.EVENT_MOVE:t.distance>e.options.hold_threshold&&clearTimeout(this.timer);break;case Hammer.EVENT_END:clearTimeout(this.timer)}}},Hammer.gestures.Release={name:"release",index:1/0,handler:function(t,e){t.eventType==Hammer.EVENT_END&&e.trigger(this.name,t)}},Hammer.gestures.Swipe={name:"swipe",index:40,defaults:{swipe_min_touches:1,swipe_max_touches:1,swipe_velocity:.7},handler:function(t,e){if(t.eventType==Hammer.EVENT_END){if(e.options.swipe_max_touches>0&&t.touches.length<e.options.swipe_min_touches&&t.touches.length>e.options.swipe_max_touches)return;(t.velocityX>e.options.swipe_velocity||t.velocityY>e.options.swipe_velocity)&&(e.trigger(this.name,t),e.trigger(this.name+t.direction,t))}}},Hammer.gestures.Tap={name:"tap",index:100,defaults:{tap_max_touchtime:250,tap_max_distance:10,tap_always:!0,doubletap_distance:20,doubletap_interval:300},handler:function(t,e){if(t.eventType==Hammer.EVENT_END&&"touchcancel"!=t.srcEvent.type){var n=Hammer.detection.previous,r=!1;if(t.deltaTime>e.options.tap_max_touchtime||t.distance>e.options.tap_max_distance)return;n&&"tap"==n.name&&t.timeStamp-n.lastEvent.timeStamp<e.options.doubletap_interval&&t.distance<e.options.doubletap_distance&&(e.trigger("doubletap",t),r=!0),(!r||e.options.tap_always)&&(Hammer.detection.current.name="tap",e.trigger(Hammer.detection.current.name,t))}}},Hammer.gestures.Touch={name:"touch",index:-1/0,defaults:{prevent_default:!1,prevent_mouseevents:!1},handler:function(t,n){return n.options.prevent_mouseevents&&t.pointerType==Hammer.POINTER_MOUSE?(t.stopDetect(),e):(n.options.prevent_default&&t.preventDefault(),t.eventType==Hammer.EVENT_START&&n.trigger(this.name,t),e)}},Hammer.gestures.Transform={name:"transform",index:45,defaults:{transform_min_scale:.01,transform_min_rotation:1,transform_always_block:!1},triggered:!1,handler:function(t,n){if(Hammer.detection.current.name!=this.name&&this.triggered)return n.trigger(this.name+"end",t),this.triggered=!1,e;if(!(2>t.touches.length))switch(n.options.transform_always_block&&t.preventDefault(),t.eventType){case Hammer.EVENT_START:this.triggered=!1;break;case Hammer.EVENT_MOVE:var r=Math.abs(1-t.scale),i=Math.abs(t.rotation);if(n.options.transform_min_scale>r&&n.options.transform_min_rotation>i)return;Hammer.detection.current.name=this.name,this.triggered||(n.trigger(this.name+"start",t),this.triggered=!0),n.trigger(this.name,t),i>n.options.transform_min_rotation&&n.trigger("rotate",t),r>n.options.transform_min_scale&&(n.trigger("pinch",t),n.trigger("pinch"+(1>t.scale?"in":"out"),t));break;case Hammer.EVENT_END:this.triggered&&n.trigger(this.name+"end",t),this.triggered=!1}}},"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return Hammer}):"object"==typeof n&&"object"==typeof n.exports?n.exports=Hammer:t.Hammer=Hammer})(this),function(t,e){"use strict";function n(t,n){t.event.bindDom=function(t,r,i){n(t).on(r,function(t){var n=t.originalEvent||t;n.pageX===e&&(n.pageX=t.pageX,n.pageY=t.pageY),n.target||(n.target=t.target),n.which===e&&(n.which=n.button),n.preventDefault||(n.preventDefault=t.preventDefault),n.stopPropagation||(n.stopPropagation=t.stopPropagation),i.call(this,n)})},t.Instance.prototype.on=function(t,e){return n(this.element).on(t,e)},t.Instance.prototype.off=function(t,e){return n(this.element).off(t,e)},t.Instance.prototype.trigger=function(t,e){var r=n(this.element);return r.has(e.target).length&&(r=n(e.target)),r.trigger({type:t,gesture:e})},n.fn.hammer=function(e){return this.each(function(){var r=n(this),i=r.data("hammer");i?i&&e&&t.utils.extend(i.options,e):r.data("hammer",new t(this,e||{}))})}}"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(["hammerjs","jquery"],n):n(t.Hammer,t.jQuery||t.Zepto)}(this)}),define("lib/underscore/underscore-debug",[],function(t,e,n){(function(){var t=this,r=t._,i={},o=Array.prototype,a=Object.prototype,s=Function.prototype,c=o.push,u=o.slice,l=o.concat,h=a.toString,f=a.hasOwnProperty,p=o.forEach,d=o.map,g=o.reduce,m=o.reduceRight,v=o.filter,b=o.every,y=o.some,w=o.indexOf,_=o.lastIndexOf,x=Array.isArray,$=Object.keys,E=s.bind,T=function(t){return t instanceof T?t:this instanceof T?(this._wrapped=t,void 0):new T(t)};e!==void 0?(n!==void 0&&n.exports&&(e=n.exports=T),e._=T):t._=T,T.VERSION="1.6.0";var k=T.each=T.forEach=function(t,e,n){if(null==t)return t;if(p&&t.forEach===p)t.forEach(e,n);else if(t.length===+t.length){for(var r=0,o=t.length;o>r;r++)if(e.call(n,t[r],r,t)===i)return}else for(var a=T.keys(t),r=0,o=a.length;o>r;r++)if(e.call(n,t[a[r]],a[r],t)===i)return;return t};T.map=T.collect=function(t,e,n){var r=[];return null==t?r:d&&t.map===d?t.map(e,n):(k(t,function(t,i,o){r.push(e.call(n,t,i,o))}),r)};var S="Reduce of empty array with no initial value";T.reduce=T.foldl=T.inject=function(t,e,n,r){var i=arguments.length>2;if(null==t&&(t=[]),g&&t.reduce===g)return r&&(e=T.bind(e,r)),i?t.reduce(e,n):t.reduce(e);if(k(t,function(t,o,a){i?n=e.call(r,n,t,o,a):(n=t,i=!0)}),!i)throw new TypeError(S);return n},T.reduceRight=T.foldr=function(t,e,n,r){var i=arguments.length>2;if(null==t&&(t=[]),m&&t.reduceRight===m)return r&&(e=T.bind(e,r)),i?t.reduceRight(e,n):t.reduceRight(e);var o=t.length;if(o!==+o){var a=T.keys(t);o=a.length}if(k(t,function(s,c,u){c=a?a[--o]:--o,i?n=e.call(r,n,t[c],c,u):(n=t[c],i=!0)}),!i)throw new TypeError(S);return n},T.find=T.detect=function(t,e,n){var r;return H(t,function(t,i,o){return e.call(n,t,i,o)?(r=t,!0):void 0}),r},T.filter=T.select=function(t,e,n){var r=[];return null==t?r:v&&t.filter===v?t.filter(e,n):(k(t,function(t,i,o){e.call(n,t,i,o)&&r.push(t)}),r)},T.reject=function(t,e,n){return T.filter(t,function(t,r,i){return!e.call(n,t,r,i)},n)},T.every=T.all=function(t,e,n){e||(e=T.identity);var r=!0;return null==t?r:b&&t.every===b?t.every(e,n):(k(t,function(t,o,a){return(r=r&&e.call(n,t,o,a))?void 0:i}),!!r)};var H=T.some=T.any=function(t,e,n){e||(e=T.identity);var r=!1;return null==t?r:y&&t.some===y?t.some(e,n):(k(t,function(t,o,a){return r||(r=e.call(n,t,o,a))?i:void 0}),!!r)};T.contains=T.include=function(t,e){return null==t?!1:w&&t.indexOf===w?-1!=t.indexOf(e):H(t,function(t){return t===e})},T.invoke=function(t,e){var n=u.call(arguments,2),r=T.isFunction(e);return T.map(t,function(t){return(r?e:t[e]).apply(t,n)})},T.pluck=function(t,e){return T.map(t,T.property(e))},T.where=function(t,e){return T.filter(t,T.matches(e))},T.findWhere=function(t,e){return T.find(t,T.matches(e))},T.max=function(t,e,n){if(!e&&T.isArray(t)&&t[0]===+t[0]&&65535>t.length)return Math.max.apply(Math,t);var r=-1/0,i=-1/0;return k(t,function(t,o,a){var s=e?e.call(n,t,o,a):t;s>i&&(r=t,i=s)}),r},T.min=function(t,e,n){if(!e&&T.isArray(t)&&t[0]===+t[0]&&65535>t.length)return Math.min.apply(Math,t);var r=1/0,i=1/0;return k(t,function(t,o,a){var s=e?e.call(n,t,o,a):t;i>s&&(r=t,i=s)}),r},T.shuffle=function(t){var e,n=0,r=[];return k(t,function(t){e=T.random(n++),r[n-1]=r[e],r[e]=t}),r},T.sample=function(t,e,n){return null==e||n?(t.length!==+t.length&&(t=T.values(t)),t[T.random(t.length-1)]):T.shuffle(t).slice(0,Math.max(0,e))};var O=function(t){return null==t?T.identity:T.isFunction(t)?t:T.property(t)};T.sortBy=function(t,e,n){return e=O(e),T.pluck(T.map(t,function(t,r,i){return{value:t,index:r,criteria:e.call(n,t,r,i)}}).sort(function(t,e){var n=t.criteria,r=e.criteria;if(n!==r){if(n>r||void 0===n)return 1;if(r>n||void 0===r)return-1}return t.index-e.index}),"value")};var N=function(t){return function(e,n,r){var i={};return n=O(n),k(e,function(o,a){var s=n.call(r,o,a,e);t(i,s,o)}),i}};T.groupBy=N(function(t,e,n){T.has(t,e)?t[e].push(n):t[e]=[n]}),T.indexBy=N(function(t,e,n){t[e]=n}),T.countBy=N(function(t,e){T.has(t,e)?t[e]++:t[e]=1}),T.sortedIndex=function(t,e,n,r){n=O(n);for(var i=n.call(r,e),o=0,a=t.length;a>o;){var s=o+a>>>1;i>n.call(r,t[s])?o=s+1:a=s}return o},T.toArray=function(t){return t?T.isArray(t)?u.call(t):t.length===+t.length?T.map(t,T.identity):T.values(t):[]},T.size=function(t){return null==t?0:t.length===+t.length?t.length:T.keys(t).length},T.first=T.head=T.take=function(t,e,n){return null==t?void 0:null==e||n?t[0]:0>e?[]:u.call(t,0,e)},T.initial=function(t,e,n){return u.call(t,0,t.length-(null==e||n?1:e))},T.last=function(t,e,n){return null==t?void 0:null==e||n?t[t.length-1]:u.call(t,Math.max(t.length-e,0))},T.rest=T.tail=T.drop=function(t,e,n){return u.call(t,null==e||n?1:e)},T.compact=function(t){return T.filter(t,T.identity)};var j=function(t,e,n){return e&&T.every(t,T.isArray)?l.apply(n,t):(k(t,function(t){T.isArray(t)||T.isArguments(t)?e?c.apply(n,t):j(t,e,n):n.push(t)}),n)};T.flatten=function(t,e){return j(t,e,[])},T.without=function(t){return T.difference(t,u.call(arguments,1))},T.partition=function(t,e,n){e=O(e);var r=[],i=[];return k(t,function(t){(e.call(n,t)?r:i).push(t)}),[r,i]},T.uniq=T.unique=function(t,e,n,r){T.isFunction(e)&&(r=n,n=e,e=!1);var i=n?T.map(t,n,r):t,o=[],a=[];return k(i,function(n,r){(e?r&&a[a.length-1]===n:T.contains(a,n))||(a.push(n),o.push(t[r]))}),o},T.union=function(){return T.uniq(T.flatten(arguments,!0))},T.intersection=function(t){var e=u.call(arguments,1);return T.filter(T.uniq(t),function(t){return T.every(e,function(e){return T.contains(e,t)})})},T.difference=function(t){var e=l.apply(o,u.call(arguments,1));return T.filter(t,function(t){return!T.contains(e,t)})},T.zip=function(){for(var t=T.max(T.pluck(arguments,"length").concat(0)),e=Array(t),n=0;t>n;n++)e[n]=T.pluck(arguments,""+n);return e},T.object=function(t,e){if(null==t)return{};for(var n={},r=0,i=t.length;i>r;r++)e?n[t[r]]=e[r]:n[t[r][0]]=t[r][1];return n},T.indexOf=function(t,e,n){if(null==t)return-1;var r=0,i=t.length;if(n){if("number"!=typeof n)return r=T.sortedIndex(t,e),t[r]===e?r:-1;r=0>n?Math.max(0,i+n):n}if(w&&t.indexOf===w)return t.indexOf(e,n);for(;i>r;r++)if(t[r]===e)return r;return-1},T.lastIndexOf=function(t,e,n){if(null==t)return-1;var r=null!=n;if(_&&t.lastIndexOf===_)return r?t.lastIndexOf(e,n):t.lastIndexOf(e);for(var i=r?n:t.length;i--;)if(t[i]===e)return i;return-1},T.range=function(t,e,n){1>=arguments.length&&(e=t||0,t=0),n=arguments[2]||1;for(var r=Math.max(Math.ceil((e-t)/n),0),i=0,o=Array(r);r>i;)o[i++]=t,t+=n;return o};var D=function(){};T.bind=function(t,e){var n,r;if(E&&t.bind===E)return E.apply(t,u.call(arguments,1));if(!T.isFunction(t))throw new TypeError;return n=u.call(arguments,2),r=function(){if(!(this instanceof r))return t.apply(e,n.concat(u.call(arguments)));D.prototype=t.prototype;var i=new D;D.prototype=null;var o=t.apply(i,n.concat(u.call(arguments)));return Object(o)===o?o:i}},T.partial=function(t){var e=u.call(arguments,1);return function(){for(var n=0,r=e.slice(),i=0,o=r.length;o>i;i++)r[i]===T&&(r[i]=arguments[n++]);for(;arguments.length>n;)r.push(arguments[n++]);return t.apply(this,r)}},T.bindAll=function(t){var e=u.call(arguments,1);if(0===e.length)throw Error("bindAll must be passed function names");return k(e,function(e){t[e]=T.bind(t[e],t)}),t},T.memoize=function(t,e){var n={};return e||(e=T.identity),function(){var r=e.apply(this,arguments);return T.has(n,r)?n[r]:n[r]=t.apply(this,arguments)}},T.delay=function(t,e){var n=u.call(arguments,2);return setTimeout(function(){return t.apply(null,n)},e)},T.defer=function(t){return T.delay.apply(T,[t,1].concat(u.call(arguments,1)))},T.throttle=function(t,e,n){var r,i,o,a=null,s=0;n||(n={});var c=function(){s=n.leading===!1?0:T.now(),a=null,o=t.apply(r,i),r=i=null};return function(){var u=T.now();s||n.leading!==!1||(s=u);var l=e-(u-s);return r=this,i=arguments,0>=l?(clearTimeout(a),a=null,s=u,o=t.apply(r,i),r=i=null):a||n.trailing===!1||(a=setTimeout(c,l)),o}},T.debounce=function(t,e,n){var r,i,o,a,s,c=function(){var u=T.now()-a;e>u?r=setTimeout(c,e-u):(r=null,n||(s=t.apply(o,i),o=i=null))};return function(){o=this,i=arguments,a=T.now();var u=n&&!r;return r||(r=setTimeout(c,e)),u&&(s=t.apply(o,i),o=i=null),s}},T.once=function(t){var e,n=!1;return function(){return n?e:(n=!0,e=t.apply(this,arguments),t=null,e)}},T.wrap=function(t,e){return T.partial(e,t)},T.compose=function(){var t=arguments;return function(){for(var e=arguments,n=t.length-1;n>=0;n--)e=[t[n].apply(this,e)];return e[0]}},T.after=function(t,e){return function(){return 1>--t?e.apply(this,arguments):void 0}},T.keys=function(t){if(!T.isObject(t))return[];if($)return $(t);var e=[];for(var n in t)T.has(t,n)&&e.push(n);return e},T.values=function(t){for(var e=T.keys(t),n=e.length,r=Array(n),i=0;n>i;i++)r[i]=t[e[i]];return r},T.pairs=function(t){for(var e=T.keys(t),n=e.length,r=Array(n),i=0;n>i;i++)r[i]=[e[i],t[e[i]]];return r},T.invert=function(t){for(var e={},n=T.keys(t),r=0,i=n.length;i>r;r++)e[t[n[r]]]=n[r];return e},T.functions=T.methods=function(t){var e=[];for(var n in t)T.isFunction(t[n])&&e.push(n);return e.sort()},T.extend=function(t){return k(u.call(arguments,1),function(e){if(e)for(var n in e)t[n]=e[n]}),t},T.pick=function(t){var e={},n=l.apply(o,u.call(arguments,1));return k(n,function(n){n in t&&(e[n]=t[n])}),e},T.omit=function(t){var e={},n=l.apply(o,u.call(arguments,1));for(var r in t)T.contains(n,r)||(e[r]=t[r]);return e},T.defaults=function(t){return k(u.call(arguments,1),function(e){if(e)for(var n in e)void 0===t[n]&&(t[n]=e[n])}),t},T.clone=function(t){return T.isObject(t)?T.isArray(t)?t.slice():T.extend({},t):t},T.tap=function(t,e){return e(t),t};var P=function(t,e,n,r){if(t===e)return 0!==t||1/t==1/e;if(null==t||null==e)return t===e;t instanceof T&&(t=t._wrapped),e instanceof T&&(e=e._wrapped);var i=h.call(t);if(i!=h.call(e))return!1;switch(i){case"[object String]":return t==e+"";case"[object Number]":return t!=+t?e!=+e:0==t?1/t==1/e:t==+e;case"[object Date]":case"[object Boolean]":return+t==+e;case"[object RegExp]":return t.source==e.source&&t.global==e.global&&t.multiline==e.multiline&&t.ignoreCase==e.ignoreCase}if("object"!=typeof t||"object"!=typeof e)return!1;for(var o=n.length;o--;)if(n[o]==t)return r[o]==e;var a=t.constructor,s=e.constructor;if(a!==s&&!(T.isFunction(a)&&a instanceof a&&T.isFunction(s)&&s instanceof s)&&"constructor"in t&&"constructor"in e)return!1;n.push(t),r.push(e);var c=0,u=!0;if("[object Array]"==i){if(c=t.length,u=c==e.length)for(;c--&&(u=P(t[c],e[c],n,r)););}else{for(var l in t)if(T.has(t,l)&&(c++,!(u=T.has(e,l)&&P(t[l],e[l],n,r))))break;if(u){for(l in e)if(T.has(e,l)&&!c--)break;u=!c}}return n.pop(),r.pop(),u};T.isEqual=function(t,e){return P(t,e,[],[])},T.isEmpty=function(t){if(null==t)return!0;if(T.isArray(t)||T.isString(t))return 0===t.length;for(var e in t)if(T.has(t,e))return!1;return!0},T.isElement=function(t){return!(!t||1!==t.nodeType)},T.isArray=x||function(t){return"[object Array]"==h.call(t)},T.isObject=function(t){return t===Object(t)},k(["Arguments","Function","String","Number","Date","RegExp"],function(t){T["is"+t]=function(e){return h.call(e)=="[object "+t+"]"}}),T.isArguments(arguments)||(T.isArguments=function(t){return!(!t||!T.has(t,"callee"))}),T.isFunction=function(t){return"function"==typeof t},T.isFinite=function(t){return isFinite(t)&&!isNaN(parseFloat(t))},T.isNaN=function(t){return T.isNumber(t)&&t!=+t},T.isBoolean=function(t){return t===!0||t===!1||"[object Boolean]"==h.call(t)},T.isNull=function(t){return null===t},T.isUndefined=function(t){return void 0===t},T.has=function(t,e){return f.call(t,e)},T.noConflict=function(){return t._=r,this},T.identity=function(t){return t},T.constant=function(t){return function(){return t}},T.property=function(t){return function(e){return e[t]}},T.matches=function(t){return function(e){if(e===t)return!0;for(var n in t)if(t[n]!==e[n])return!1;return!0}},T.times=function(t,e,n){for(var r=Array(Math.max(0,t)),i=0;t>i;i++)r[i]=e.call(n,i);return r},T.random=function(t,e){return null==e&&(e=t,t=0),t+Math.floor(Math.random()*(e-t+1))},T.now=Date.now||function(){return(new Date).getTime()};var A={escape:{"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;"}};A.unescape=T.invert(A.escape);var R={escape:RegExp("["+T.keys(A.escape).join("")+"]","g"),unescape:RegExp("("+T.keys(A.unescape).join("|")+")","g")};T.each(["escape","unescape"],function(t){T[t]=function(e){return null==e?"":(""+e).replace(R[t],function(e){return A[t][e]})}}),T.result=function(t,e){if(null==t)return void 0;var n=t[e];return T.isFunction(n)?n.call(t):n},T.mixin=function(t){k(T.functions(t),function(e){var n=T[e]=t[e];T.prototype[e]=function(){var t=[this._wrapped];return c.apply(t,arguments),q.call(this,n.apply(T,t))}})};var I=0;T.uniqueId=function(t){var e=++I+"";return t?t+e:e},T.templateSettings={evaluate:/<%([\s\S]+?)%>/g,interpolate:/<%=([\s\S]+?)%>/g,escape:/<%-([\s\S]+?)%>/g};
var W=/(.)^/,M={"'":"'","\\":"\\","\r":"r","\n":"n","	":"t","\u2028":"u2028","\u2029":"u2029"},C=/\\|'|\r|\n|\t|\u2028|\u2029/g;T.template=function(t,e,n){var r;n=T.defaults({},n,T.templateSettings);var i=RegExp([(n.escape||W).source,(n.interpolate||W).source,(n.evaluate||W).source].join("|")+"|$","g"),o=0,a="__p+='";t.replace(i,function(e,n,r,i,s){return a+=t.slice(o,s).replace(C,function(t){return"\\"+M[t]}),n&&(a+="'+\n((__t=("+n+"))==null?'':_.escape(__t))+\n'"),r&&(a+="'+\n((__t=("+r+"))==null?'':__t)+\n'"),i&&(a+="';\n"+i+"\n__p+='"),o=s+e.length,e}),a+="';\n",n.variable||(a="with(obj||{}){\n"+a+"}\n"),a="var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n"+a+"return __p;\n";try{r=Function(n.variable||"obj","_",a)}catch(s){throw s.source=a,s}if(e)return r(e,T);var c=function(t){return r.call(this,t,T)};return c.source="function("+(n.variable||"obj")+"){\n"+a+"}",c},T.chain=function(t){return T(t).chain()};var q=function(t){return this._chain?T(t).chain():t};T.mixin(T),k(["pop","push","reverse","shift","sort","splice","unshift"],function(t){var e=o[t];T.prototype[t]=function(){var n=this._wrapped;return e.apply(n,arguments),"shift"!=t&&"splice"!=t||0!==n.length||delete n[0],q.call(this,n)}}),k(["concat","join","slice"],function(t){var e=o[t];T.prototype[t]=function(){return q.call(this,e.apply(this._wrapped,arguments))}}),T.extend(T.prototype,{chain:function(){return this._chain=!0,this},value:function(){return this._wrapped}}),"function"==typeof define&&define.amd&&define("underscore",[],function(){return T}),window._=T}).call(this)});