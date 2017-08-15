/*! fanwei 2014-03-10 */
define("lib/zepto/zepto-debug",[],function(){(function(t){String.prototype.trim===t&&(String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")}),Array.prototype.reduce===t&&(Array.prototype.reduce=function(e){if(this===void 0||null===this)throw new TypeError;var n,r=Object(this),i=r.length>>>0,o=0;if("function"!=typeof e)throw new TypeError;if(0==i&&1==arguments.length)throw new TypeError;if(arguments.length>=2)n=arguments[1];else for(;;){if(o in r){n=r[o++];break}if(++o>=i)throw new TypeError}for(;i>o;)o in r&&(n=e.call(t,n,r[o],o,r)),o++;return n})})();var t=function(){function t(t){return null==t?t+"":L[J.call(t)]||"object"}function e(e){return"function"==t(e)}function n(t){return null!=t&&t==t.window}function r(t){return null!=t&&t.nodeType==t.DOCUMENT_NODE}function i(e){return"object"==t(e)}function o(t){return i(t)&&!n(t)&&t.__proto__==Object.prototype}function a(t){return t instanceof Array}function s(t){return"number"==typeof t.length}function c(t){return N.call(t,function(t){return null!=t})}function u(t){return t.length>0?T.fn.concat.apply([],t):t}function l(t){return t.replace(/::/g,"/").replace(/([A-Z]+)([A-Z][a-z])/g,"$1_$2").replace(/([a-z\d])([A-Z])/g,"$1_$2").replace(/_/g,"-").toLowerCase()}function h(t){return t in j?j[t]:j[t]=RegExp("(^|\\s)"+t+"(\\s|$)")}function f(t,e){return"number"!=typeof e||I[l(t)]?e:e+"px"}function p(t){var e,n;return P[t]||(e=A.createElement(t),A.body.appendChild(e),n=M(e,"").getPropertyValue("display"),e.parentNode.removeChild(e),"none"==n&&(n="block"),P[t]=n),P[t]}function d(t){return"children"in t?O.call(t.children):T.map(t.childNodes,function(t){return 1==t.nodeType?t:w})}function m(t,e,n){for(E in e)n&&(o(e[E])||a(e[E]))?(o(e[E])&&!o(t[E])&&(t[E]={}),a(e[E])&&!a(t[E])&&(t[E]=[]),m(t[E],e[E],n)):e[E]!==w&&(t[E]=e[E])}function g(t,e){return e===w?T(t):T(t).filter(e)}function v(t,n,r,i){return e(n)?n.call(t,r,i):n}function y(t,e,n){null==n?t.removeAttribute(e):t.setAttribute(e,n)}function b(t,e){var n=t.className,r=n&&n.baseVal!==w;return e===w?r?n.baseVal:n:(r?n.baseVal=e:t.className=e,w)}function _(t){var e;try{return t?"true"==t||("false"==t?!1:"null"==t?null:isNaN(e=Number(t))?/^[\[\{]/.test(t)?T.parseJSON(t):t:e):t}catch(n){return t}}function x(t,e){e(t);for(var n in t.childNodes)x(t.childNodes[n],e)}var w,E,T,S,$,k,H=[],O=H.slice,N=H.filter,A=window.document,P={},j={},M=A.defaultView.getComputedStyle,I={"column-count":1,columns:1,"font-weight":1,"line-height":1,opacity:1,"z-index":1,zoom:1},R=/^\s*<(\w+|!)[^>]*>/,D=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,C=/^(?:body|html)$/i,Y=["val","css","html","text","data","width","height","offset"],X=["after","prepend","before","append"],z=A.createElement("table"),F=A.createElement("tr"),W={tr:A.createElement("tbody"),tbody:z,thead:z,tfoot:z,td:F,th:F,"*":A.createElement("div")},U=/complete|loaded|interactive/,q=/^\.([\w-]+)$/,B=/^#([\w-]*)$/,V=/^[\w-]+$/,L={},J=L.toString,Z={},G=A.createElement("div");return Z.matches=function(t,e){if(!t||1!==t.nodeType)return!1;var n=t.webkitMatchesSelector||t.mozMatchesSelector||t.oMatchesSelector||t.matchesSelector;if(n)return n.call(t,e);var r,i=t.parentNode,o=!i;return o&&(i=G).appendChild(t),r=~Z.qsa(i,e).indexOf(t),o&&G.removeChild(t),r},$=function(t){return t.replace(/-+(.)?/g,function(t,e){return e?e.toUpperCase():""})},k=function(t){return N.call(t,function(e,n){return t.indexOf(e)==n})},Z.fragment=function(t,e,n){t.replace&&(t=t.replace(D,"<$1></$2>")),e===w&&(e=R.test(t)&&RegExp.$1),e in W||(e="*");var r,i,a=W[e];return a.innerHTML=""+t,i=T.each(O.call(a.childNodes),function(){a.removeChild(this)}),o(n)&&(r=T(i),T.each(n,function(t,e){Y.indexOf(t)>-1?r[t](e):r.attr(t,e)})),i},Z.Z=function(t,e){return t=t||[],t.__proto__=T.fn,t.selector=e||"",t},Z.isZ=function(t){return t instanceof Z.Z},Z.init=function(t,n){if(t){if(e(t))return T(A).ready(t);if(Z.isZ(t))return t;var r;if(a(t))r=c(t);else if(i(t))r=[o(t)?T.extend({},t):t],t=null;else if(R.test(t))r=Z.fragment(t.trim(),RegExp.$1,n),t=null;else{if(n!==w)return T(n).find(t);r=Z.qsa(A,t)}return Z.Z(r,t)}return Z.Z()},T=function(t,e){return Z.init(t,e)},T.extend=function(t){var e,n=O.call(arguments,1);return"boolean"==typeof t&&(e=t,t=n.shift()),n.forEach(function(n){m(t,n,e)}),t},Z.qsa=function(t,e){var n;return r(t)&&B.test(e)?(n=t.getElementById(RegExp.$1))?[n]:[]:1!==t.nodeType&&9!==t.nodeType?[]:O.call(q.test(e)?t.getElementsByClassName(RegExp.$1):V.test(e)?t.getElementsByTagName(e):t.querySelectorAll(e))},T.contains=function(t,e){return t!==e&&t.contains(e)},T.type=t,T.isFunction=e,T.isWindow=n,T.isArray=a,T.isPlainObject=o,T.isEmptyObject=function(t){var e;for(e in t)return!1;return!0},T.inArray=function(t,e,n){return H.indexOf.call(e,t,n)},T.camelCase=$,T.trim=function(t){return t.trim()},T.uuid=0,T.support={},T.expr={},T.map=function(t,e){var n,r,i,o=[];if(s(t))for(r=0;t.length>r;r++)n=e(t[r],r),null!=n&&o.push(n);else for(i in t)n=e(t[i],i),null!=n&&o.push(n);return u(o)},T.each=function(t,e){var n,r;if(s(t)){for(n=0;t.length>n;n++)if(e.call(t[n],n,t[n])===!1)return t}else for(r in t)if(e.call(t[r],r,t[r])===!1)return t;return t},T.grep=function(t,e){return N.call(t,e)},window.JSON&&(T.parseJSON=JSON.parse),T.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(t,e){L["[object "+e+"]"]=e.toLowerCase()}),T.fn={forEach:H.forEach,reduce:H.reduce,push:H.push,sort:H.sort,indexOf:H.indexOf,concat:H.concat,map:function(t){return T(T.map(this,function(e,n){return t.call(e,n,e)}))},slice:function(){return T(O.apply(this,arguments))},ready:function(t){return U.test(A.readyState)?t(T):A.addEventListener("DOMContentLoaded",function(){t(T)},!1),this},get:function(t){return t===w?O.call(this):this[t>=0?t:t+this.length]},toArray:function(){return this.get()},size:function(){return this.length},remove:function(){return this.each(function(){null!=this.parentNode&&this.parentNode.removeChild(this)})},each:function(t){return H.every.call(this,function(e,n){return t.call(e,n,e)!==!1}),this},filter:function(t){return e(t)?this.not(this.not(t)):T(N.call(this,function(e){return Z.matches(e,t)}))},add:function(t,e){return T(k(this.concat(T(t,e))))},is:function(t){return this.length>0&&Z.matches(this[0],t)},not:function(t){var n=[];if(e(t)&&t.call!==w)this.each(function(e){t.call(this,e)||n.push(this)});else{var r="string"==typeof t?this.filter(t):s(t)&&e(t.item)?O.call(t):T(t);this.forEach(function(t){0>r.indexOf(t)&&n.push(t)})}return T(n)},has:function(t){return this.filter(function(){return i(t)?T.contains(this,t):T(this).find(t).size()})},eq:function(t){return-1===t?this.slice(t):this.slice(t,+t+1)},first:function(){var t=this[0];return t&&!i(t)?t:T(t)},last:function(){var t=this[this.length-1];return t&&!i(t)?t:T(t)},find:function(t){var e,n=this;return e="object"==typeof t?T(t).filter(function(){var t=this;return H.some.call(n,function(e){return T.contains(e,t)})}):1==this.length?T(Z.qsa(this[0],t)):this.map(function(){return Z.qsa(this,t)})},closest:function(t,e){var n=this[0],i=!1;for("object"==typeof t&&(i=T(t));n&&!(i?i.indexOf(n)>=0:Z.matches(n,t));)n=n!==e&&!r(n)&&n.parentNode;return T(n)},parents:function(t){for(var e=[],n=this;n.length>0;)n=T.map(n,function(t){return(t=t.parentNode)&&!r(t)&&0>e.indexOf(t)?(e.push(t),t):w});return g(e,t)},parent:function(t){return g(k(this.pluck("parentNode")),t)},children:function(t){return g(this.map(function(){return d(this)}),t)},contents:function(){return this.map(function(){return O.call(this.childNodes)})},siblings:function(t){return g(this.map(function(t,e){return N.call(d(e.parentNode),function(t){return t!==e})}),t)},empty:function(){return this.each(function(){this.innerHTML=""})},pluck:function(t){return T.map(this,function(e){return e[t]})},show:function(){return this.each(function(){"none"==this.style.display&&(this.style.display=null),"none"==M(this,"").getPropertyValue("display")&&(this.style.display=p(this.nodeName))})},replaceWith:function(t){return this.before(t).remove()},wrap:function(t){var n=e(t);if(this[0]&&!n)var r=T(t).get(0),i=r.parentNode||this.length>1;return this.each(function(e){T(this).wrapAll(n?t.call(this,e):i?r.cloneNode(!0):r)})},wrapAll:function(t){if(this[0]){T(this[0]).before(t=T(t));for(var e;(e=t.children()).length;)t=e.first();T(t).append(this)}return this},wrapInner:function(t){var n=e(t);return this.each(function(e){var r=T(this),i=r.contents(),o=n?t.call(this,e):t;i.length?i.wrapAll(o):r.append(o)})},unwrap:function(){return this.parent().each(function(){T(this).replaceWith(T(this).children())}),this},clone:function(){return this.map(function(){return this.cloneNode(!0)})},hide:function(){return this.css("display","none")},toggle:function(t){return this.each(function(){var e=T(this);(t===w?"none"==e.css("display"):t)?e.show():e.hide()})},prev:function(t){return T(this.pluck("previousElementSibling")).filter(t||"*")},next:function(t){return T(this.pluck("nextElementSibling")).filter(t||"*")},html:function(t){return t===w?this.length>0?this[0].innerHTML:null:this.each(function(e){var n=this.innerHTML;T(this).empty().append(v(this,t,e,n))})},text:function(t){return t===w?this.length>0?this[0].textContent:null:this.each(function(){this.textContent=t})},attr:function(t,e){var n;return"string"==typeof t&&e===w?0==this.length||1!==this[0].nodeType?w:"value"==t&&"INPUT"==this[0].nodeName?this.val():!(n=this[0].getAttribute(t))&&t in this[0]?this[0][t]:n:this.each(function(n){if(1===this.nodeType)if(i(t))for(E in t)y(this,E,t[E]);else y(this,t,v(this,e,n,this.getAttribute(t)))})},removeAttr:function(t){return this.each(function(){1===this.nodeType&&y(this,t)})},prop:function(t,e){return e===w?this[0]&&this[0][t]:this.each(function(n){this[t]=v(this,e,n,this[t])})},data:function(t,e){var n=this.attr("data-"+l(t),e);return null!==n?_(n):w},val:function(t){return t===w?this[0]&&(this[0].multiple?T(this[0]).find("option").filter(function(){return this.selected}).pluck("value"):this[0].value):this.each(function(e){this.value=v(this,t,e,this.value)})},offset:function(t){if(t)return this.each(function(e){var n=T(this),r=v(this,t,e,n.offset()),i=n.offsetParent().offset(),o={top:r.top-i.top,left:r.left-i.left};"static"==n.css("position")&&(o.position="relative"),n.css(o)});if(0==this.length)return null;var e=this[0].getBoundingClientRect();return{left:e.left+window.pageXOffset,top:e.top+window.pageYOffset,width:Math.round(e.width),height:Math.round(e.height)}},css:function(e,n){if(2>arguments.length&&"string"==typeof e)return this[0]&&(this[0].style[$(e)]||M(this[0],"").getPropertyValue(e));var r="";if("string"==t(e))n||0===n?r=l(e)+":"+f(e,n):this.each(function(){this.style.removeProperty(l(e))});else for(E in e)e[E]||0===e[E]?r+=l(E)+":"+f(E,e[E])+";":this.each(function(){this.style.removeProperty(l(E))});return this.each(function(){this.style.cssText+=";"+r})},index:function(t){return t?this.indexOf(T(t)[0]):this.parent().children().indexOf(this[0])},hasClass:function(t){return H.some.call(this,function(t){return this.test(b(t))},h(t))},addClass:function(t){return this.each(function(e){S=[];var n=b(this),r=v(this,t,e,n);r.split(/\s+/g).forEach(function(t){T(this).hasClass(t)||S.push(t)},this),S.length&&b(this,n+(n?" ":"")+S.join(" "))})},removeClass:function(t){return this.each(function(e){return t===w?b(this,""):(S=b(this),v(this,t,e,S).split(/\s+/g).forEach(function(t){S=S.replace(h(t)," ")}),b(this,S.trim()),w)})},toggleClass:function(t,e){return this.each(function(n){var r=T(this),i=v(this,t,n,b(this));i.split(/\s+/g).forEach(function(t){(e===w?!r.hasClass(t):e)?r.addClass(t):r.removeClass(t)})})},scrollTop:function(){return this.length?"scrollTop"in this[0]?this[0].scrollTop:this[0].scrollY:w},position:function(){if(this.length){var t=this[0],e=this.offsetParent(),n=this.offset(),r=C.test(e[0].nodeName)?{top:0,left:0}:e.offset();return n.top-=parseFloat(T(t).css("margin-top"))||0,n.left-=parseFloat(T(t).css("margin-left"))||0,r.top+=parseFloat(T(e[0]).css("border-top-width"))||0,r.left+=parseFloat(T(e[0]).css("border-left-width"))||0,{top:n.top-r.top,left:n.left-r.left}}},offsetParent:function(){return this.map(function(){for(var t=this.offsetParent||A.body;t&&!C.test(t.nodeName)&&"static"==T(t).css("position");)t=t.offsetParent;return t})}},T.fn.detach=T.fn.remove,["width","height"].forEach(function(t){T.fn[t]=function(e){var i,o=this[0],a=t.replace(/./,function(t){return t[0].toUpperCase()});return e===w?n(o)?o["inner"+a]:r(o)?o.documentElement["offset"+a]:(i=this.offset())&&i[t]:this.each(function(n){o=T(this),o.css(t,v(this,e,n,o[t]()))})}}),X.forEach(function(e,n){var r=n%2;T.fn[e]=function(){var e,i,o=T.map(arguments,function(n){return e=t(n),"object"==e||"array"==e||null==n?n:Z.fragment(n)}),a=this.length>1;return 1>o.length?this:this.each(function(t,e){i=r?e:e.parentNode,e=0==n?e.nextSibling:1==n?e.firstChild:2==n?e:null,o.forEach(function(t){if(a)t=t.cloneNode(!0);else if(!i)return T(t).remove();x(i.insertBefore(t,e),function(t){null==t.nodeName||"SCRIPT"!==t.nodeName.toUpperCase()||t.type&&"text/javascript"!==t.type||t.src||window.eval.call(window,t.innerHTML)})})})},T.fn[r?e+"To":"insert"+(n?"Before":"After")]=function(t){return T(t)[e](this),this}}),Z.Z.prototype=T.fn,Z.uniq=k,Z.deserializeValue=_,T.zepto=Z,T}();window.Zepto=t,"$"in window||(window.$=t),function(t){function e(t){var e=this.os={},n=this.browser={},r=t.match(/WebKit\/([\d.]+)/),i=t.match(/(Android)\s+([\d.]+)/),o=t.match(/(iPad).*OS\s([\d_]+)/),a=!o&&t.match(/(iPhone\sOS)\s([\d_]+)/),s=t.match(/(webOS|hpwOS)[\s\/]([\d.]+)/),c=s&&t.match(/TouchPad/),u=t.match(/Kindle\/([\d.]+)/),l=t.match(/Silk\/([\d._]+)/),h=t.match(/(BlackBerry).*Version\/([\d.]+)/),f=t.match(/(BB10).*Version\/([\d.]+)/),p=t.match(/(RIM\sTablet\sOS)\s([\d.]+)/),d=t.match(/PlayBook/),m=t.match(/Chrome\/([\d.]+)/)||t.match(/CriOS\/([\d.]+)/),g=t.match(/Firefox\/([\d.]+)/);(n.webkit=!!r)&&(n.version=r[1]),i&&(e.android=!0,e.version=i[2]),a&&(e.ios=e.iphone=!0,e.version=a[2].replace(/_/g,".")),o&&(e.ios=e.ipad=!0,e.version=o[2].replace(/_/g,".")),s&&(e.webos=!0,e.version=s[2]),c&&(e.touchpad=!0),h&&(e.blackberry=!0,e.version=h[2]),f&&(e.bb10=!0,e.version=f[2]),p&&(e.rimtabletos=!0,e.version=p[2]),d&&(n.playbook=!0),u&&(e.kindle=!0,e.version=u[1]),l&&(n.silk=!0,n.version=l[1]),!l&&e.android&&t.match(/Kindle Fire/)&&(n.silk=!0),m&&(n.chrome=!0,n.version=m[1]),g&&(n.firefox=!0,n.version=g[1]),e.tablet=!!(o||d||i&&!t.match(/Mobile/)||g&&t.match(/Tablet/)),e.phone=!(e.tablet||!(i||a||s||h||f||m&&t.match(/Android/)||m&&t.match(/CriOS\/([\d.]+)/)||g&&t.match(/Mobile/)))}e.call(t,navigator.userAgent),t.__detect=e}(t),function(t){function e(t){return t._zid||(t._zid=p++)}function n(t,n,o,a){if(n=r(n),n.ns)var s=i(n.ns);return(f[e(t)]||[]).filter(function(t){return!(!t||n.e&&t.e!=n.e||n.ns&&!s.test(t.ns)||o&&e(t.fn)!==e(o)||a&&t.sel!=a)})}function r(t){var e=(""+t).split(".");return{e:e[0],ns:e.slice(1).sort().join(" ")}}function i(t){return RegExp("(?:^| )"+t.replace(" "," .* ?")+"(?: |$)")}function o(e,n,r){"string"!=t.type(e)?t.each(e,r):e.split(/\s/).forEach(function(t){r(t,n)})}function a(t,e){return t.del&&("focus"==t.e||"blur"==t.e)||!!e}function s(t){return m[t]||t}function c(n,i,c,u,l,h){var p=e(n),d=f[p]||(f[p]=[]);o(i,c,function(e,i){var o=r(e);o.fn=i,o.sel=u,o.e in m&&(i=function(e){var n=e.relatedTarget;return!n||n!==this&&!t.contains(this,n)?o.fn.apply(this,arguments):void 0}),o.del=l&&l(i,e);var c=o.del||i;o.proxy=function(t){var e=c.apply(n,[t].concat(t.data));return e===!1&&(t.preventDefault(),t.stopPropagation()),e},o.i=d.length,d.push(o),n.addEventListener(s(o.e),o.proxy,a(o,h))})}function u(t,r,i,c,u){var l=e(t);o(r||"",i,function(e,r){n(t,e,r,c).forEach(function(e){delete f[l][e.i],t.removeEventListener(s(e.e),e.proxy,a(e,u))})})}function l(e){var n,r={originalEvent:e};for(n in e)y.test(n)||void 0===e[n]||(r[n]=e[n]);return t.each(b,function(t,n){r[t]=function(){return this[n]=g,e[t].apply(e,arguments)},r[n]=v}),r}function h(t){if(!("defaultPrevented"in t)){t.defaultPrevented=!1;var e=t.preventDefault;t.preventDefault=function(){this.defaultPrevented=!0,e.call(this)}}}var f=(t.zepto.qsa,{}),p=1,d={},m={mouseenter:"mouseover",mouseleave:"mouseout"};d.click=d.mousedown=d.mouseup=d.mousemove="MouseEvents",t.event={add:c,remove:u},t.proxy=function(n,r){if(t.isFunction(n)){var i=function(){return n.apply(r,arguments)};return i._zid=e(n),i}if("string"==typeof r)return t.proxy(n[r],n);throw new TypeError("expected function")},t.fn.bind=function(t,e){return this.each(function(){c(this,t,e)})},t.fn.unbind=function(t,e){return this.each(function(){u(this,t,e)})},t.fn.one=function(t,e){return this.each(function(n,r){c(this,t,e,null,function(t,e){return function(){var n=t.apply(r,arguments);return u(r,e,t),n}})})};var g=function(){return!0},v=function(){return!1},y=/^([A-Z]|layer[XY]$)/,b={preventDefault:"isDefaultPrevented",stopImmediatePropagation:"isImmediatePropagationStopped",stopPropagation:"isPropagationStopped"};t.fn.delegate=function(e,n,r){return this.each(function(i,o){c(o,n,r,e,function(n){return function(r){var i,a=t(r.target).closest(e,o).get(0);return a?(i=t.extend(l(r),{currentTarget:a,liveFired:o}),n.apply(a,[i].concat([].slice.call(arguments,1)))):void 0}})})},t.fn.undelegate=function(t,e,n){return this.each(function(){u(this,e,n,t)})},t.fn.live=function(e,n){return t(document.body).delegate(this.selector,e,n),this},t.fn.die=function(e,n){return t(document.body).undelegate(this.selector,e,n),this},t.fn.on=function(e,n,r){return!n||t.isFunction(n)?this.bind(e,n||r):this.delegate(n,e,r)},t.fn.off=function(e,n,r){return!n||t.isFunction(n)?this.unbind(e,n||r):this.undelegate(n,e,r)},t.fn.trigger=function(e,n){return("string"==typeof e||t.isPlainObject(e))&&(e=t.Event(e)),h(e),e.data=n,this.each(function(){"dispatchEvent"in this&&this.dispatchEvent(e)})},t.fn.triggerHandler=function(e,r){var i,o;return this.each(function(a,s){i=l("string"==typeof e?t.Event(e):e),i.data=r,i.target=s,t.each(n(s,e.type||e),function(t,e){return o=e.proxy(i),i.isImmediatePropagationStopped()?!1:void 0})}),o},"focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select keydown keypress keyup error".split(" ").forEach(function(e){t.fn[e]=function(t){return t?this.bind(e,t):this.trigger(e)}}),["focus","blur"].forEach(function(e){t.fn[e]=function(t){return t?this.bind(e,t):this.each(function(){try{this[e]()}catch(t){}}),this}}),t.Event=function(t,e){"string"!=typeof t&&(e=t,t=e.type);var n=document.createEvent(d[t]||"Events"),r=!0;if(e)for(var i in e)"bubbles"==i?r=!!e[i]:n[i]=e[i];return n.initEvent(t,r,!0,null,null,null,null,null,null,null,null,null,null,null,null),n.isDefaultPrevented=function(){return this.defaultPrevented},n}}(t),function(t){function e(e,n,r){var i=t.Event(n);return t(e).trigger(i,r),!i.defaultPrevented}function n(t,n,r,i){return t.global?e(n||y,r,i):void 0}function r(e){e.global&&0===t.active++&&n(e,null,"ajaxStart")}function i(e){e.global&&!--t.active&&n(e,null,"ajaxStop")}function o(t,e){var r=e.context;return e.beforeSend.call(r,t,e)===!1||n(e,r,"ajaxBeforeSend",[t,e])===!1?!1:(n(e,r,"ajaxSend",[t,e]),void 0)}function a(t,e,r){var i=r.context,o="success";r.success.call(i,t,o,e),n(r,i,"ajaxSuccess",[e,r,t]),c(o,e,r)}function s(t,e,r,i){var o=i.context;i.error.call(o,r,e,t),n(i,o,"ajaxError",[r,i,t]),c(e,r,i)}function c(t,e,r){var o=r.context;r.complete.call(o,e,t),n(r,o,"ajaxComplete",[e,r]),i(r)}function u(){}function l(t){return t&&(t=t.split(";",2)[0]),t&&(t==E?"html":t==w?"json":_.test(t)?"script":x.test(t)&&"xml")||"text"}function h(t,e){return(t+"&"+e).replace(/[&?]{1,2}/,"?")}function f(e){e.processData&&e.data&&"string"!=t.type(e.data)&&(e.data=t.param(e.data,e.traditional)),!e.data||e.type&&"GET"!=e.type.toUpperCase()||(e.url=h(e.url,e.data))}function p(e,n,r,i){var o=!t.isFunction(n);return{url:e,data:o?n:void 0,success:o?t.isFunction(r)?r:void 0:n,dataType:o?i||r:r}}function d(e,n,r,i){var o,a=t.isArray(n);t.each(n,function(n,s){o=t.type(s),i&&(n=r?i:i+"["+(a?"":n)+"]"),!i&&a?e.add(s.name,s.value):"array"==o||!r&&"object"==o?d(e,s,r,n):e.add(n,s)})}var m,g,v=0,y=window.document,b=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,_=/^(?:text|application)\/javascript/i,x=/^(?:text|application)\/xml/i,w="application/json",E="text/html",T=/^\s*$/;t.active=0,t.ajaxJSONP=function(e){if(!("type"in e))return t.ajax(e);var n,r="jsonp"+ ++v,i=y.createElement("script"),c=function(){clearTimeout(n),t(i).remove(),delete window[r]},l=function(t){c(),t&&"timeout"!=t||(window[r]=u),s(null,t||"abort",h,e)},h={abort:l};return o(h,e)===!1?(l("abort"),!1):(window[r]=function(t){c(),a(t,h,e)},i.onerror=function(){l("error")},i.src=e.url.replace(/=\?/,"="+r),t("head").append(i),e.timeout>0&&(n=setTimeout(function(){l("timeout")},e.timeout)),h)},t.ajaxSettings={type:"GET",beforeSend:u,success:u,error:u,complete:u,context:null,global:!0,xhr:function(){return new window.XMLHttpRequest},accepts:{script:"text/javascript, application/javascript",json:w,xml:"application/xml, text/xml",html:E,text:"text/plain"},crossDomain:!1,timeout:0,processData:!0,cache:!0},t.ajax=function(e){var n=t.extend({},e||{});for(m in t.ajaxSettings)void 0===n[m]&&(n[m]=t.ajaxSettings[m]);r(n),n.crossDomain||(n.crossDomain=/^([\w-]+:)?\/\/([^\/]+)/.test(n.url)&&RegExp.$2!=window.location.host),n.url||(n.url=""+window.location),f(n),n.cache===!1&&(n.url=h(n.url,"_="+Date.now()));var i=n.dataType,c=/=\?/.test(n.url);if("jsonp"==i||c)return c||(n.url=h(n.url,"callback=?")),t.ajaxJSONP(n);var p,d=n.accepts[i],v={},y=/^([\w-]+:)\/\//.test(n.url)?RegExp.$1:window.location.protocol,b=n.xhr();n.crossDomain||(v["X-Requested-With"]="XMLHttpRequest"),d&&(v.Accept=d,d.indexOf(",")>-1&&(d=d.split(",",2)[0]),b.overrideMimeType&&b.overrideMimeType(d)),(n.contentType||n.contentType!==!1&&n.data&&"GET"!=n.type.toUpperCase())&&(v["Content-Type"]=n.contentType||"application/x-www-form-urlencoded"),n.headers=t.extend(v,n.headers||{}),b.onreadystatechange=function(){if(4==b.readyState){b.onreadystatechange=u,clearTimeout(p);var e,r=!1;if(b.status>=200&&300>b.status||304==b.status||0==b.status&&"file:"==y){i=i||l(b.getResponseHeader("content-type")),e=b.responseText;try{"script"==i?(1,eval)(e):"xml"==i?e=b.responseXML:"json"==i&&(e=T.test(e)?null:t.parseJSON(e))}catch(o){r=o}r?s(r,"parsererror",b,n):a(e,b,n)}else s(null,b.status?"error":"abort",b,n)}};var _="async"in n?n.async:!0;b.open(n.type,n.url,_);for(g in n.headers)b.setRequestHeader(g,n.headers[g]);return o(b,n)===!1?(b.abort(),!1):(n.timeout>0&&(p=setTimeout(function(){b.onreadystatechange=u,b.abort(),s(null,"timeout",b,n)},n.timeout)),b.send(n.data?n.data:null),b)},t.get=function(){return t.ajax(p.apply(null,arguments))},t.post=function(){var e=p.apply(null,arguments);return e.type="POST",t.ajax(e)},t.getJSON=function(){var e=p.apply(null,arguments);return e.dataType="json",t.ajax(e)},t.fn.load=function(e,n,r){if(!this.length)return this;var i,o=this,a=e.split(/\s/),s=p(e,n,r),c=s.success;return a.length>1&&(s.url=a[0],i=a[1]),s.success=function(e){o.html(i?t("<div>").html(e.replace(b,"")).find(i):e),c&&c.apply(o,arguments)},t.ajax(s),this};var S=encodeURIComponent;t.param=function(t,e){var n=[];return n.add=function(t,e){this.push(S(t)+"="+S(e))},d(n,t,e),n.join("&").replace(/%20/g,"+")}}(t),function(t){t.fn.serializeArray=function(){var e,n=[];return t(Array.prototype.slice.call(this.get(0).elements)).each(function(){e=t(this);var r=e.attr("type");"fieldset"!=this.nodeName.toLowerCase()&&!this.disabled&&"submit"!=r&&"reset"!=r&&"button"!=r&&("radio"!=r&&"checkbox"!=r||this.checked)&&n.push({name:e.attr("name"),value:e.val()})}),n},t.fn.serialize=function(){var t=[];return this.serializeArray().forEach(function(e){t.push(encodeURIComponent(e.name)+"="+encodeURIComponent(e.value))}),t.join("&")},t.fn.submit=function(e){if(e)this.bind("submit",e);else if(this.length){var n=t.Event("submit");this.eq(0).trigger(n),n.defaultPrevented||this.get(0).submit()}return this}}(t),function(t,e){function n(t){return r(t.replace(/([a-z])([A-Z])/,"$1-$2"))}function r(t){return t.toLowerCase()}function i(t){return o?o+t:r(t)}var o,a,s,c,u,l,h,f,p="",d={Webkit:"webkit",Moz:"",O:"o",ms:"MS"},m=window.document,g=m.createElement("div"),v=/^((translate|rotate|scale)(X|Y|Z|3d)?|matrix(3d)?|perspective|skew(X|Y)?)$/i,y={};t.each(d,function(t,n){return g.style[t+"TransitionProperty"]!==e?(p="-"+r(t)+"-",o=n,!1):e}),a=p+"transform",y[s=p+"transition-property"]=y[c=p+"transition-duration"]=y[u=p+"transition-timing-function"]=y[l=p+"animation-name"]=y[h=p+"animation-duration"]=y[f=p+"animation-timing-function"]="",t.fx={off:o===e&&g.style.transitionProperty===e,speeds:{_default:400,fast:200,slow:600},cssPrefix:p,transitionEnd:i("TransitionEnd"),animationEnd:i("AnimationEnd")},t.css3=function(t,e){t=t.get(0);for(var n in e){var r=n.charAt(0).toUpperCase()+n.substring(1);t.style["Webkit"+r]=e[n],t.style["Moz"+r]=e[n],t.style["ms"+r]=e[n],t.style["O"+r]=e[n],t.style[n]=e[n]}},t.fn.animate=function(e,n,r,i){return t.isPlainObject(n)&&(r=n.easing,i=n.complete,n=n.duration),n&&(n=("number"==typeof n?n:t.fx.speeds[n]||t.fx.speeds._default)/1e3),this.anim(e,n,r,i)},t.fn.anim=function(r,i,o,p){var d,m,g,b={},_="",x=this,w=t.fx.transitionEnd;if(i===e&&(i=.4),t.fx.off&&(i=0),"string"==typeof r)b[l]=r,b[h]=i+"s",b[f]=o||"linear",w=t.fx.animationEnd;else{m=[];for(d in r)v.test(d)?_+=d+"("+r[d]+") ":(b[d]=r[d],m.push(n(d)));_&&(b[a]=_,m.push(a)),i>0&&"object"==typeof r&&(b[s]=m.join(", "),b[c]=i+"s",b[u]=o||"linear")}return g=function(n){if(n!==e){if(n.target!==n.currentTarget)return;t(n.target).unbind(w,g)}t(this).css(y),p&&p.call(this)},i>0&&this.bind(w,g),this.size()&&this.get(0).clientLeft,this.css(b),0>=i&&setTimeout(function(){x.each(function(){g.call(this)})},0),this},g=null}(t)});