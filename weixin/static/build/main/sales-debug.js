/*! fanwei 2014-03-10 */
define("main/sales-debug",["../global/global-debug","../global/backtop-debug","../global/bodyParse-debug","../global/tip-debug","../global/fnDo-debug","../global/navhilight-debug","../lib/template/template-debug"],function(t){t("../global/global-debug"),t("../global/bodyParse-debug");var e=t("../global/fnDo-debug"),n=t("../lib/template/template-debug"),r=_query.actid,i="/index.php?g=Wap&m=Act&a=getact&token="+token+"&actid="+r+"&wecha_id="+wid,o=$("[script-role = namer]");$.post(i,null,function(t){var e=n("data_list",t);$("[script-role = data_wrap]").html(e),o.html(t.data.act_name),loading()},"json");var a=new e({oWrap:$("[script-role = data_wrap]"),sTarget:"foc",fnDo:function(t){if(0==t.attr("is_follow")){var e=t.attr("focUrl");t.html("已关注"),this.req(e,null,function(){oTip.text("关注成功")})}}});a.init()}),define("global/global-debug",["global/backtop-debug","global/bodyParse-debug","global/tip-debug","global/fnDo-debug","global/navhilight-debug"],function(t){t("global/backtop-debug");var e=t("global/bodyParse-debug");t("global/tip-debug"),t("global/fnDo-debug"),t("global/navhilight-debug"),window._query=e(),window.token=_query.token,window.wid=_query.wecha_id,window.loading=function(t){function e(){$("#cover").animate({opacity:0},300,"ease-out",function(){$("#cover").hide()})}function n(){$("#cover").show(),$("#cover").css("opacity","1")}n();var r,i=$("img"),o=0,a=i.length;i.each(function(n){var s=new Image;r=i.eq(n).attr("src"),s.onload=function(){o++,o==a&&(e(),t&&t())},s.onerror=function(){o++,o==a&&(e(),t&&t())},s.src=r})}}),define("global/backtop-debug",[],function(){$("[script-role = backtop]").on("click",function(){document.documentElement.scrollTop=0,document.body.scrollTop=0})}),define("global/bodyParse-debug",[],function(){function t(){var t,e,n,r,i,o,a;if(window.location.search){for(t=decodeURIComponent(window.location.search.split("?")[1]),e=t.split("&"),r=e.length,a={},o=0;r>o;o++)n=e[o].split("="),i=n.length,a[n[0]]=n[1];return a}return null}return t}),define("global/tip-debug",[],function(t,e,n){function r(t){t=t||{},this.oWrap=null,this.bottom=t.bottom||"100px",this.delay=t.delay||2e3,this.timeBtn=t.timeBtn?!0:true,this.timer=null}r.prototype={init:function(){this.create(),this.setStyle(this.oWrap)},create:function(){this.oWrap=$("<div></div>"),$("body").append(this.oWrap)},setStyle:function(t){t.css({position:"fixed",bottom:this.bottom,borderRadius:"5px",boxShadow:"1px 1px 1px solid #000",padding:"0.5rem 1.25rem",background:"rgba(0, 0, 0 ,0.8)",color:"#fff",display:"block",left:"50%",zIndex:2e3,opacity:0})},transition:function(){$.css3(this.oWrap,{transition:"opacity .8s"})},removeTranstion:function(){$.css3(this.oWrap,{transition:"none"})},calc:function(){var t=this.oWrap.get(0).offsetWidth;this.oWrap.css("marginLeft",-t/2)},show:function(){this.oWrap.css("opacity","1")},hide:function(){this.oWrap.css("opacity","0")},text:function(t){var e=this;clearTimeout(this.timer),this.removeTranstion(),this.hide(),this.transition(),this.oWrap.html(t),this.show(),this.calc(),this.timeBtn&&(this.timer=setTimeout(function(){e.hide()},this.delay))}},window.oTip=new r,oTip.init(),n.exports=r}),define("global/fnDo-debug",[],function(t,e,n){function r(t){t=t||{},this.oWrap=t.oWrap,this.fnDo=t.fnDo||null,this.sTarget=t.sTarget||"",this.lock=!1}r.prototype={init:function(){this.addEvent()},addEvent:function(){var t,e,n;n=this,this.oWrap.on("click",function(r){n.lock||(this.lock=!0,t=$(r.srcElement||r.target),e=t.attr("script-role"),e==n.sTarget&&n.fnDo&&n.fnDo.call(n,t))})},req:function(t,e,n){var r=this;$.post(t,e,function(t){t.err?(oTip.text("操作失败,请重试"),r.lock=!1):(n&&n(t),r.lock=!1)},"json")}},n.exports=r}),define("global/navhilight-debug",[],function(){var t=$("body").attr("page-role"),e=$("[script-role = main_nav]").find("[script-role = text]"),n=$("[script-role = product_footer]").find("[script-role = product_list]");e.each(function(n){t==e.eq(n).text()&&e.eq(n).addClass("active")}),n.each(function(e){t==n.eq(e).text()&&n.eq(e).addClass("active")})}),define("lib/template/template-debug",[],function(t,e,n){!function(t){"use strict";var r,i,o,a,s=function(t,e){return s["string"==typeof e?"compile":"render"].apply(s,arguments)};s.version="2.0.2",s.openTag="<%",s.closeTag="%>",s.isEscape=!0,s.isCompress=!1,s.parser=null,s.render=function(t,e){var n=s.get(t)||o({id:t,name:"Render Error",message:"No Template"});return n(e)},s.compile=function(t,e){function n(n){try{return new i(n,t)+""}catch(r){return u?o(r)():s.compile(t,e,!0)(n)}}var i,c=arguments,u=c[2],l="anonymous";"string"!=typeof e&&(u=c[1],e=c[0],t=l);try{i=a(t,e,u)}catch(h){return h.id=t||e,h.name="Syntax Error",o(h)}return n.prototype=i.prototype,n.toString=function(){return""+i},t!==l&&(r[t]=n),n},r=s.cache={},i=s.helpers={$include:s.render,$string:function(t,e){return"string"!=typeof t&&(e=typeof t,"number"===e?t+="":t="function"===e?i.$string(t()):""),t},$escape:function(t){var e={"<":"&#60;",">":"&#62;",'"':"&#34;","'":"&#39;","&":"&#38;"};return i.$string(t).replace(/&(?![\w#]+;)|[<>"']/g,function(t){return e[t]})},$each:function(t,e){var n,r,i=Array.isArray||function(t){return"[object Array]"==={}.toString.call(t)};if(i(t))for(n=0,r=t.length;r>n;n++)e.call(t,t[n],n,t);else for(n in t)e.call(t,t[n],n)}},s.helper=function(t,e){i[t]=e},s.onerror=function(e){var n,r="Template Error\n\n";for(n in e)r+="<"+n+">\n"+e[n]+"\n\n";t.console&&console.error(r)},s.get=function(e){var n,i,o;return r.hasOwnProperty(e)?n=r[e]:"document"in t&&(i=document.getElementById(e),i&&(o=i.value||i.innerHTML,n=s.compile(e,o.replace(/^\s*|\s*$/g,"")))),n},o=function(t){return s.onerror(t),function(){return"{Template Error}"}},a=function(){var t=i.$each,e="break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined",n=/\/\*[\w\W]*?\*\/|\/\/[^\n]*\n|\/\/[^\n]*$|"(?:[^"\\]|\\[\w\W])*"|'(?:[^'\\]|\\[\w\W])*'|[\s\t\n]*\.[\s\t\n]*[$\w\.]+/g,r=/[^\w$]+/g,o=RegExp(["\\b"+e.replace(/,/g,"\\b|\\b")+"\\b"].join("|"),"g"),a=/^\d[^,]*|,\d[^,]*/g,c=/^,+|,+$/g,u=function(t){return t.replace(n,"").replace(r,",").replace(o,"").replace(a,"").replace(c,"").split(/^$|,+/)};return function(e,n,r){function o(t){return b+=t.split(/\n/).length-1,s.isCompress&&(t=t.replace(/[\n\r\t\s]+/g," ").replace(/<!--.*?-->/g,"")),t&&(t=$[1]+h(t)+$[2]+"\n"),t}function a(t){var e,n,o=b;return g?t=g(t):r&&(t=t.replace(/\n/g,function(){return b++,"$line="+b+";"})),0===t.indexOf("=")&&(e=0!==t.indexOf("=="),t=t.replace(/^=*|[\s;]*$/g,""),e&&s.isEscape?(n=t.replace(/\s*\([^\)]+\)/,""),i.hasOwnProperty(n)||/^(include|print)$/.test(n)||(t="$escape("+t+")")):t="$string("+t+")",t=$[1]+t+$[2]),r&&(t="$line="+o+";"+t),c(t),t+"\n"}function c(e){e=u(e),t(e,function(t){y.hasOwnProperty(t)||(l(t),y[t]=!0)})}function l(t){var e;"print"===t?e=T:"include"===t?(w.$include=i.$include,e=S):(e="$data."+t,i.hasOwnProperty(t)&&(w[t]=i[t],e=0===t.indexOf("$")?"$helpers."+t:e+"===undefined?$helpers."+t+":"+e)),_+=t+"="+e+","}function h(t){return"'"+t.replace(/('|\\)/g,"\\$1").replace(/\r/g,"\\r").replace(/\n/g,"\\n")+"'"}var f,p=s.openTag,d=s.closeTag,g=s.parser,m=n,v="",b=1,y={$data:1,$id:1,$helpers:1,$out:1,$line:1},w={},_="var $helpers=this,"+(r?"$line=0,":""),x="".trim,$=x?["$out='';","$out+=",";","$out"]:["$out=[];","$out.push(",");","$out.join('')"],E=x?"if(content!==undefined){$out+=content;return content;}":"$out.push(content);",T="function(content){"+E+"}",S="function(id,data){data=data||$data;var content=$helpers.$include(id,data,$id);"+E+"}";t(m.split(p),function(t){var e,n;t=t.split(d),e=t[0],n=t[1],1===t.length?v+=o(e):(v+=a(e),n&&(v+=o(n)))}),m=v,r&&(m="try{"+m+"}catch(e){"+"throw {"+"id:$id,"+"name:'Render Error',"+"message:e.message,"+"line:$line,"+"source:"+h(n)+".split(/\\n/)[$line-1].replace(/^[\\s\\t]+/,'')"+"};"+"}"),m=_+$[0]+m+"return new String("+$[3]+");";try{return f=Function("$data","$id",m),f.prototype=w,f}catch(k){throw k.temp="function anonymous($data,$id) {"+m+"}",k}}}(),"function"==typeof define?define(function(){return s}):e!==void 0&&(n.exports=s),t.template=s,n.exports=s}(this),function(t){t.openTag="{{",t.closeTag="}}",t.parser=function(e){var n,r,i,o,a,s,c,u;switch(e=e.replace(/^\s/,""),n=e.split(" "),r=n.shift(),i=n.join(" "),r){case"if":e="if("+i+"){";break;case"else":n="if"===n.shift()?" if("+n.join(" ")+")":"",e="}else"+n+"{";break;case"/if":e="}";break;case"each":o=n[0]||"$data",a=n[1]||"as",s=n[2]||"$value",c=n[3]||"$index",u=s+","+c,"as"!==a&&(o="[]"),e="$each("+o+",function("+u+"){";break;case"/each":e="});";break;case"echo":e="print("+i+");";break;case"include":e="include("+n.join(",")+");";break;default:t.helpers.hasOwnProperty(r)?e="=="+r+"("+n.join(",")+");":(e=e.replace(/[\s;]*$/,""),e="="+e)}return e}}(template)});