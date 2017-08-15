/*! fanwei 2014-03-10 */
define("global/loadMore",["../lib/template/template"],function(t,e,n){function r(t){t=t||{},this.btn=t.btn||null,this.oWrap=t.oWrap||null,this.row=t.row||null,this.reqUrl=t.reqUrl||null,this.sucDo=t.sucDo||null,this.tplId=t.tplId||null,this.p=1,this.param={},this.lock=!1,this.max=""}var i=t("../lib/template/template");r.prototype={init:function(){this.addEvent(),this.req({row:this.row,p:1})},addEvent:function(){var t=this;this.btn.on("click",function(){if(!t.lock){if(t.lock=!0,t.p++,t.p>t.max)return t.p=t.max,oTip.timeBtn=!0,oTip.text("暂无更多数据"),void 0;t.param.p=t.p,t.param.row=t.row,t.req(t.param)}})},req:function(t){var e=this;oTip.timeBtn=!1,oTip.text("加载中"),$.post(this.reqUrl,t,function(t){t.err?oTip.text("暂无更多数据"):(e.max=Math.ceil(t.data.count/e.row),oTip.hide(),e.render(t),e.sucDo&&e.sucDo.call(e,t),e.lock=!1)},"json")},render:function(t){var e=i(this.tplId,t),n=$(e);this.oWrap.append(n)}},n.exports=r}),define("lib/template/template",[],function(t,e,n){!function(t){"use strict";var r,i,a,o,s=function(t,e){return s["string"==typeof e?"compile":"render"].apply(s,arguments)};s.version="2.0.2",s.openTag="<%",s.closeTag="%>",s.isEscape=!0,s.isCompress=!1,s.parser=null,s.render=function(t,e){var n=s.get(t)||a({id:t,name:"Render Error",message:"No Template"});return n(e)},s.compile=function(t,e){function n(n){try{return new i(n,t)+""}catch(r){return c?a(r)():s.compile(t,e,!0)(n)}}var i,u=arguments,c=u[2],l="anonymous";"string"!=typeof e&&(c=u[1],e=u[0],t=l);try{i=o(t,e,c)}catch(h){return h.id=t||e,h.name="Syntax Error",a(h)}return n.prototype=i.prototype,n.toString=function(){return""+i},t!==l&&(r[t]=n),n},r=s.cache={},i=s.helpers={$include:s.render,$string:function(t,e){return"string"!=typeof t&&(e=typeof t,"number"===e?t+="":t="function"===e?i.$string(t()):""),t},$escape:function(t){var e={"<":"&#60;",">":"&#62;",'"':"&#34;","'":"&#39;","&":"&#38;"};return i.$string(t).replace(/&(?![\w#]+;)|[<>"']/g,function(t){return e[t]})},$each:function(t,e){var n,r,i=Array.isArray||function(t){return"[object Array]"==={}.toString.call(t)};if(i(t))for(n=0,r=t.length;r>n;n++)e.call(t,t[n],n,t);else for(n in t)e.call(t,t[n],n)}},s.helper=function(t,e){i[t]=e},s.onerror=function(e){var n,r="Template Error\n\n";for(n in e)r+="<"+n+">\n"+e[n]+"\n\n";t.console&&console.error(r)},s.get=function(e){var n,i,a;return r.hasOwnProperty(e)?n=r[e]:"document"in t&&(i=document.getElementById(e),i&&(a=i.value||i.innerHTML,n=s.compile(e,a.replace(/^\s*|\s*$/g,"")))),n},a=function(t){return s.onerror(t),function(){return"{Template Error}"}},o=function(){var t=i.$each,e="break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined",n=/\/\*[\w\W]*?\*\/|\/\/[^\n]*\n|\/\/[^\n]*$|"(?:[^"\\]|\\[\w\W])*"|'(?:[^'\\]|\\[\w\W])*'|[\s\t\n]*\.[\s\t\n]*[$\w\.]+/g,r=/[^\w$]+/g,a=RegExp(["\\b"+e.replace(/,/g,"\\b|\\b")+"\\b"].join("|"),"g"),o=/^\d[^,]*|,\d[^,]*/g,u=/^,+|,+$/g,c=function(t){return t.replace(n,"").replace(r,",").replace(a,"").replace(o,"").replace(u,"").split(/^$|,+/)};return function(e,n,r){function a(t){return y+=t.split(/\n/).length-1,s.isCompress&&(t=t.replace(/[\n\r\t\s]+/g," ").replace(/<!--.*?-->/g,"")),t&&(t=$[1]+h(t)+$[2]+"\n"),t}function o(t){var e,n,a=y;return g?t=g(t):r&&(t=t.replace(/\n/g,function(){return y++,"$line="+y+";"})),0===t.indexOf("=")&&(e=0!==t.indexOf("=="),t=t.replace(/^=*|[\s;]*$/g,""),e&&s.isEscape?(n=t.replace(/\s*\([^\)]+\)/,""),i.hasOwnProperty(n)||/^(include|print)$/.test(n)||(t="$escape("+t+")")):t="$string("+t+")",t=$[1]+t+$[2]),r&&(t="$line="+a+";"+t),u(t),t+"\n"}function u(e){e=c(e),t(e,function(t){b.hasOwnProperty(t)||(l(t),b[t]=!0)})}function l(t){var e;"print"===t?e=E:"include"===t?(w.$include=i.$include,e=T):(e="$data."+t,i.hasOwnProperty(t)&&(w[t]=i[t],e=0===t.indexOf("$")?"$helpers."+t:e+"===undefined?$helpers."+t+":"+e)),_+=t+"="+e+","}function h(t){return"'"+t.replace(/('|\\)/g,"\\$1").replace(/\r/g,"\\r").replace(/\n/g,"\\n")+"'"}var f,p=s.openTag,d=s.closeTag,g=s.parser,v=n,m="",y=1,b={$data:1,$id:1,$helpers:1,$out:1,$line:1},w={},_="var $helpers=this,"+(r?"$line=0,":""),x="".trim,$=x?["$out='';","$out+=",";","$out"]:["$out=[];","$out.push(",");","$out.join('')"],k=x?"if(content!==undefined){$out+=content;return content;}":"$out.push(content);",E="function(content){"+k+"}",T="function(id,data){data=data||$data;var content=$helpers.$include(id,data,$id);"+k+"}";t(v.split(p),function(t){var e,n;t=t.split(d),e=t[0],n=t[1],1===t.length?m+=a(e):(m+=o(e),n&&(m+=a(n)))}),v=m,r&&(v="try{"+v+"}catch(e){"+"throw {"+"id:$id,"+"name:'Render Error',"+"message:e.message,"+"line:$line,"+"source:"+h(n)+".split(/\\n/)[$line-1].replace(/^[\\s\\t]+/,'')"+"};"+"}"),v=_+$[0]+v+"return new String("+$[3]+");";try{return f=Function("$data","$id",v),f.prototype=w,f}catch(j){throw j.temp="function anonymous($data,$id) {"+v+"}",j}}}(),"function"==typeof define?define(function(){return s}):e!==void 0&&(n.exports=s),t.template=s,n.exports=s}(this),function(t){t.openTag="{{",t.closeTag="}}",t.parser=function(e){var n,r,i,a,o,s,u,c;switch(e=e.replace(/^\s/,""),n=e.split(" "),r=n.shift(),i=n.join(" "),r){case"if":e="if("+i+"){";break;case"else":n="if"===n.shift()?" if("+n.join(" ")+")":"",e="}else"+n+"{";break;case"/if":e="}";break;case"each":a=n[0]||"$data",o=n[1]||"as",s=n[2]||"$value",u=n[3]||"$index",c=s+","+u,"as"!==o&&(a="[]"),e="$each("+a+",function("+c+"){";break;case"/each":e="});";break;case"echo":e="print("+i+");";break;case"include":e="include("+n.join(",")+");";break;default:t.helpers.hasOwnProperty(r)?e="=="+r+"("+n.join(",")+");":(e=e.replace(/[\s;]*$/,""),e="="+e)}return e}}(template)});