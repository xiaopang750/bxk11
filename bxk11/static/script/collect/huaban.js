(
function(a){
if(window.MooTools&&Element.prototype.getElement&&Element.prototype.getElements){
a.__getElement=Element.prototype.getElement,a.__getElements=Element.prototype.getElements;
return}

(function(){
function m(e,f,h,j,l,m,n,o,p,q,r,s,t,u,v,w){
if(f||b===-1){
a.expressions[++b]=[],c=-1;
if(f)return""}
if(h||j||c===-1){
h=h||" ";
var x=a.expressions[b];
d&&x[c]&&(x[c].reverseCombinator=i(h)),x[++c]={
combinator:h,tag:"*"}
}
var y=a.expressions[b][c];
if(l)y.tag=l.replace(g,"");
else if(m)y.id=m.replace(g,"");
else if(n)n=n.replace(g,""),y.classList||(y.classList=[]),y.classes||(y.classes=[]),y.classList.push(n),y.classes.push({
value:n,regexp:new RegExp("(^|\\s)"+k(n)+"(\\s|$)")}
);
else if(t)w=w||v,w=w?w.replace(g,""):null,y.pseudos||(y.pseudos=[]),y.pseudos.push({
key:t.replace(g,""),value:w,type:s.length==1?"class":"element"}
);
else if(o){
o=o.replace(g,""),r=(r||"").replace(g,"");
var z,A;
switch(p){
case"^=":A=new RegExp("^"+k(r));
break;
case"$=":A=new RegExp(k(r)+"$");
break;
case"~=":A=new RegExp("(^|\\s)"+k(r)+"(\\s|$)");
break;
case"|=":A=new RegExp("^"+k(r)+"(-|$)");
break;
case"=":z=function(a){
return r==a}
;
break;
case"*=":z=function(a){
return a&&a.indexOf(r)>-1}
;
break;
case"!=":z=function(a){
return r!=a}
;
break;
default:z=function(a){
return!!a}
}
r==""&&/^[*$^]=$/.test(p)&&(z=function(){
return!1}
),z||(z=function(a){
return a&&A.test(a)}
),y.attributes||(y.attributes=[]),y.attributes.push({
key:o,operator:p,value:r,test:z}
)}
return""}//m end

var a,b,c,d,e={},f={},
g=/\\/g,h=function(c,g){
	if(c==null)return null;
	if(c.Slick===!0)return c;
	c=(""+c).replace(/^\s+|\s+$/g,""),d=!!g;
	var i=d?f:e;
	if(i[c])return i[c];
	a={
		Slick:!0,expressions:[],raw:c,reverse:function(){
		return h(this.raw,!0)}
	},b=-1;
	while(c!=(c=c.replace(l,m)));
	return a.length=a.expressions.length,i[a.raw]=d?j(a):a
}
,i=function(a){return a==="!"?" ":a===" "?"!":/^!/.test(a)?a.replace(/^!/,""):"!"+a}
,j=function(a){
	var b=a.expressions;
	for(var c=0;c<b.length;c++){
	var d=b[c],e={
	parts:[],tag:"*",combinator:i(d[0].combinator)};
	for(var f=0;f<d.length;f++){
		var g=d[f];
		g.reverseCombinator||(g.reverseCombinator=" "),
		g.combinator=g.reverseCombinator,delete g.reverseCombinator
		}
	d.reverse().push(e)}
	return a
},
k=function(a){return a.replace(/[-[\]{}()*+?.\\^$|,#\s]/g,function(a){return"\\"+a})},
l=new RegExp("^(?:\\s*(,)\\s*|\\s*(<combinator>+)\\s*|(\\s+)|(<unicode>+|\\*)|\\#(<unicode>+)|\\.(<unicode>+)|\\[\\s*(<unicode1>+)(?:\\s*([*^$!~|]?=)(?:\\s*(?:([\"']?)(.*?)\\9)))?\\s*\\](?!\\])|(:+)(<unicode>+)(?:\\((?:(?:([\"'])([^\\13]*)\\13)|((?:\\([^)]+\\)|[^()]*)+))\\))?)".replace(/<combinator>/,"["+k(">+~`!@$%^&={}\\;</")+"]").replace(/<unicode>/g,"(?:[\\w\\u00a1-\\uFFFF-]|\\\\[^\\s0-9a-f])").replace(/<unicode1>/g,"(?:[:\\w\\u00a1-\\uFFFF-]|\\\\[^\\s0-9a-f])")),
n=this.Slick||{};n.parse=function(a){return h(a)},
n.escapeRegExp=k,
this.Slick||(this.Slick=n)}).apply(typeof exports!="undefined"?exports:this),
function(){
var a={},b={},c=Object.prototype.toString;
a.isNativeCode=function(a){return/\{\s*\[native code\]\s*\}/.test(""+a)},
a.isXML=function(a){return!!a.xmlVersion||!!a.xml||c.call(a)=="[object XMLDocument]"||a.nodeType==9&&a.documentElement.nodeName!="HTML"},
a.setDocument=function(a){
var c=a.nodeType;
if(c!=9)if(c)a=a.ownerDocument;
else if(a.navigator)a=a.document;
else return;
if(this.document===a)return;
this.document=a;
var d=a.documentElement,e=this.getUIDXML(d),f=b[e],g;
if(f){for(g in f)this[g]=f[g];return}
f=b[e]={},f.root=d,
f.isXMLDocument=this.isXML(a),
f.brokenStarGEBTN=f.starSelectsClosedQSA=f.idGetsName=f.brokenMixedCaseQSA=f.brokenGEBCN=f.brokenCheckedQSA=f.brokenEmptyAttributeQSA=f.isHTMLDocument=f.nativeMatchesSelector=!1;
var h,i,j,k,l,m,n="slick_uniqueid",o=a.createElement("div"),p=a.body||a.getElementsByTagName("body")[0]||d;
p.appendChild(o);
try{o.innerHTML='<a id="'+n+'"></a>',f.isHTMLDocument=!!a.getElementById(n)}
catch(q){}
if(f.isHTMLDocument){
o.style.display="none",o.appendChild(a.createComment("")),i=o.getElementsByTagName("*").length>1;
try{o.innerHTML="foo</foo>",m=o.getElementsByTagName("*"),h=m&&!!m.length&&m[0].nodeName.charAt(0)=="/"}
catch(q){}
f.brokenStarGEBTN=i||h;
try{o.innerHTML='<a name="'+n+'"></a><b id="'+n+'"></b>',f.idGetsName=a.getElementById(n)===o.firstChild}
catch(q){}
if(o.getElementsByClassName){
try{
o.innerHTML='<a class="f"></a><a class="b"></a>',o.getElementsByClassName("b").length,o.firstChild.className="b",
k=o.getElementsByClassName("b").length!=2}
catch(q){}
try{o.innerHTML='<a class="a"></a><a class="f b a"></a>',j=o.getElementsByClassName("a").length!=2}
catch(q){}
f.brokenGEBCN=k||j}
if(o.querySelectorAll){
try{o.innerHTML="foo</foo>",m=o.querySelectorAll("*"),f.starSelectsClosedQSA=m&&!!m.length&&m[0].nodeName.charAt(0)=="/"}
catch(q){}
try{o.innerHTML='<a class="MiX"></a>',f.brokenMixedCaseQSA=!o.querySelectorAll(".MiX").length}
catch(q){}
try{o.innerHTML='<select><option selected="selected">a</option></select>',f.brokenCheckedQSA=o.querySelectorAll(":checked").length==0}
catch(q){}
try{o.innerHTML='<a class=""></a>',f.brokenEmptyAttributeQSA=o.querySelectorAll('[class*=""]').length!=0}
catch(q){}}
try{o.innerHTML='<form action="s"><input id="action"/></form>',l=o.firstChild.getAttribute("action")!="s"}
catch(q){}
f.nativeMatchesSelector=d.matchesSelector||d.mozMatchesSelector||d.webkitMatchesSelector;
if(f.nativeMatchesSelector)try{f.nativeMatchesSelector.call(d,":slick"),f.nativeMatchesSelector=null}
catch(q){}
}
try{
d.slick_expando=1,delete d.slick_expando,f.getUID=this.getUIDHTML}
catch(q){f.getUID=this.getUIDXML}
p.removeChild(o),o=m=p=null,f.getAttribute=f.isHTMLDocument&&l?function(a,b){
var c=this.attributeGetters[b];
if(c)return c.call(a);
var d=a.getAttributeNode(b);
return d?d.nodeValue:null}
:function(a,b){
var c=this.attributeGetters[b];
return c?c.call(a):a.getAttribute(b)}
,f.hasAttribute=d&&this.isNativeCode(d.hasAttribute)?function(a,b){return a.hasAttribute(b)}
:function(a,b){
return a=a.getAttributeNode(b),!(!a||!a.specified&&!a.nodeValue)}
,f.contains=d&&this.isNativeCode(d.contains)?function(a,b){return a.contains(b)}
:d&&d.compareDocumentPosition?function(a,b){return a===b||!!(a.compareDocumentPosition(b)&16)}
:function(a,b){
if(b)do if(b===a)return!0;
while(b=b.parentNode);
return!1}
,f.documentSorter=d.compareDocumentPosition?function(a,b){
return!a.compareDocumentPosition||!b.compareDocumentPosition?0:a.compareDocumentPosition(b)&4?-1:a===b?0:1}
:"sourceIndex"in d?function(a,b){return!a.sourceIndex||!b.sourceIndex?0:a.sourceIndex-b.sourceIndex}
:a.createRange?function(a,b){
if(!a.ownerDocument||!b.ownerDocument)return 0;
var c=a.ownerDocument.createRange(),d=b.ownerDocument.createRange();
return c.setStart(a,0),c.setEnd(a,0),d.setStart(b,0),d.setEnd(b,0),c.compareBoundaryPoints(Range.START_TO_END,d)}
:null,d=null;
for(g in f)this[g]=f[g]};
var d=/^([#.]?)((?:[\w-]+|\*))$/,e=/\[.+[*$^]=(?:""|'')?\]/,f={};
a.search=function(a,b,c,g){
var h=this.found=g?null:c||[];
if(!a)return h;
if(a.navigator)a=a.document;
else if(!a.nodeType)return h;
var i,j,k=this.uniques={},m=!!c&&!!c.length,n=a.nodeType==9;this.document!==(n?a:a.ownerDocument)&&this.setDocument(a);
if(m)for(j=h.length;j--;)k[this.getUID(h[j])]=!0;
if(typeof b=="string"){
var o=b.match(d);
p:if(o){
var q=o[1],r=o[2],s,t;
if(!q){
if(r=="*"&&this.brokenStarGEBTN)break p;
t=a.getElementsByTagName(r);
if(g)return t[0]||null;
for(j=0;s=t[j++];)(!m||!k[this.getUID(s)])&&h.push(s)}
else if(q=="#"){
if(!this.isHTMLDocument||!n)break p;
s=a.getElementById(r);
if(!s)return h;
if(this.idGetsName&&s.getAttributeNode("id").nodeValue!=r)break p;
if(g)return s||null;
(!m||!k[this.getUID(s)])&&h.push(s)}
else if(q=="."){
if(!this.isHTMLDocument||(!a.getElementsByClassName||this.brokenGEBCN)&&a.querySelectorAll)break p;
if(a.getElementsByClassName&&!this.brokenGEBCN){
t=a.getElementsByClassName(r);
if(g)return t[0]||null;
for(j=0;s=t[j++];)(!m||!k[this.getUID(s)])&&h.push(s)}
else{
var u=new RegExp("(^|\\s)"+l.escapeRegExp(r)+"(\\s|$)");
t=a.getElementsByTagName("*");
for(j=0;s=t[j++];){
className=s.className;
if(!className||!u.test(className))continue;
if(g)return s;
(!m||!k[this.getUID(s)])&&h.push(s)}
}}
return m&&this.sort(h),g?null:h}
v:if(a.querySelectorAll){
if(!this.isHTMLDocument||f[b]||this.brokenMixedCaseQSA||this.brokenCheckedQSA&&b.indexOf(":checked")>-1||
this.brokenEmptyAttributeQSA&&e.test(b)||!n&&b.indexOf(",")>-1||l.disableQSA)break v;
var w=b,x=a;
if(!n){
var y=x.getAttribute("id"),z="slickid__";
x.setAttribute("id",z),w="#"+z+" "+w,a=x.parentNode}
try{
if(g)return a.querySelector(w)||null;
t=a.querySelectorAll(w)}
catch(A){
f[b]=1;
break v}
finally{
n||(y?x.setAttribute("id",y):x.removeAttribute("id"),a=x)}
if(this.starSelectsClosedQSA)for(j=0;
s=t[j++];
)s.nodeName>"@"&&(!m||!k[this.getUID(s)])&&h.push(s);
else for(j=0;s=t[j++];)(!m||!k[this.getUID(s)])&&h.push(s);
return m&&this.sort(h),h}
i=this.Slick.parse(b);
if(!i.length)return h}
else{
if(b==null)return h;
if(b.Slick)i=b;
else return this.contains(a.documentElement||a,b)?(h?h.push(b):h=b,h):h}
this.posNTH={}
,this.posNTHLast={}
,this.posNTHType={}
,this.posNTHTypeLast={}
,this.push=!m&&(g||i.length==1&&i.expressions[0].length==1)?this.pushArray:this.pushUID,h==null&&(h=[]);
var B,C,D,E,F,G,H,I,J,K,L,M,N,O,P=i.expressions;
Q:for(j=0;M=P[j];j++)for(B=0;N=M[B];B++){
E="combinator:"+N.combinator;
if(!this[E])continue Q;
F=this.isXMLDocument?N.tag:N.tag.toUpperCase(),G=N.id,H=N.classList,I=N.classes,J=N.attributes,K=N.pseudos,O=B===M.length-1,this.bitUniques={
}
,O?(this.uniques=k,this.found=h):(this.uniques={},this.found=[]);
if(B===0){
this[E](a,F,G,I,J,K,H);
if(g&&O&&h.length)break Q}
else if(g&&O)for(C=0,D=L.length;C<D;C++){
this[E](L[C],F,G,I,J,K,H);
if(h.length)break Q}
else for(C=0,D=L.length;C<D;C++)this[E](L[C],F,G,I,J,K,H);
L=this.found}
return(m||i.expressions.length>1)&&this.sort(h),g?h[0]||null:h}
,a.uidx=1,a.uidk="slick-uniqueid",a.getUIDXML=function(a){
var b=a.getAttribute(this.uidk);
return b||(b=this.uidx++,a.setAttribute(this.uidk,b)),b}
,a.getUIDHTML=function(a){
return a.uniqueNumber||(a.uniqueNumber=this.uidx++)}
,a.sort=function(a){
return this.documentSorter?(a.sort(this.documentSorter),a):a}
,a.cacheNTH={}
,a.matchNTH=/^([+-]?\d*)?([a-z]+)?([+-]\d+)?$/,a.parseNTHArgument=function(a){
var b=a.match(this.matchNTH);
if(!b)return!1;
var c=b[2]||!1,d=b[1]||1;
d=="-"&&(d=-1);
var e=+b[3]||0;
return b=c=="n"?{a:d,b:e}
:c=="odd"?{a:2,b:1}
:c=="even"?{a:2,b:0}
:{a:0,b:d}
,this.cacheNTH[a]=b}
,a.createNTHPseudo=function(a,b,c,d){
return function(e,f){
var g=this.getUID(e);
if(!this[c][g]){
var h=e.parentNode;
if(!h)return!1;
var i=h[a],j=1;
if(d){
var k=e.nodeName;
do{
if(i.nodeName!=k)continue;
this[c][this.getUID(i)]=j++}
while(i=i[b])}
else do{
if(i.nodeType!=1)continue;
this[c][this.getUID(i)]=j++}
while(i=i[b])}
f=f||"n";
var l=this.cacheNTH[f]||this.parseNTHArgument(f);
if(!l)return!1;
var m=l.a,n=l.b,o=this[c][g];
if(m==0)return n==o;
if(m>0){
if(o<n)return!1}
else if(n<o)return!1;
return(o-n)%m==0}
}
,a.pushArray=function(a,b,c,d,e,f){
this.matchSelector(a,b,c,d,e,f)&&this.found.push(a)}
,a.pushUID=function(a,b,c,d,e,f){
var g=this.getUID(a);
!this.uniques[g]&&this.matchSelector(a,b,c,d,e,f)&&(this.uniques[g]=!0,this.found.push(a))}
,a.matchNode=function(a,b){
if(this.isHTMLDocument&&this.nativeMatchesSelector)try{
return this.nativeMatchesSelector.call(a,b.replace(/\[([^=]+)=\s*([^'"\]]+?)\s*\]/g,'[$1="$2"]'))}
catch(c){}
var d=this.Slick.parse(b);
if(!d)return!0;
var e=d.expressions,f=0,g;
for(g=0;
currentExpression=e[g];
g++)if(currentExpression.length==1){
var h=currentExpression[0];
if(this.matchSelector(a,this.isXMLDocument?h.tag:h.tag.toUpperCase(),h.id,h.classes,h.attributes,h.pseudos))return!0;
f++}
if(f==d.length)return!1;
var i=this.search(this.document,d),j;
for(g=0;j=i[g++];)if(j===a)return!0;
return!1}
,a.matchPseudo=function(a,b,c){
var d="pseudo:"+b;
if(this[d])return this[d](a,c);
var e=this.getAttribute(a,b);
return c?c==e:!!e}
,a.matchSelector=function(a,b,c,d,e,f){
if(b){
var g=this.isXMLDocument?a.nodeName:a.nodeName.toUpperCase();
if(b=="*"){
if(g<"@")return!1}
else if(g!=b)return!1}
if(c&&a.getAttribute("id")!=c)return!1;
var h,i,j;
if(d)for(h=d.length;h--;){
j=a.getAttribute("class")||a.className;
if(!j||!d[h].regexp.test(j))return!1}
if(e)for(h=e.length;h--;){
i=e[h];
if(i.operator?!i.test(this.getAttribute(a,i.key)):!this.hasAttribute(a,i.key))return!1}
if(f)for(h=f.length;h--;){
i=f[h];
if(!this.matchPseudo(a,i.key,i.value))return!1}
return!0}
;
var g={
" ":function(a,b,c,d,e,f,g){
var h,i,j;
if(this.isHTMLDocument){
k:if(c){
i=this.document.getElementById(c);
if(!i&&a.all||this.idGetsName&&i&&i.getAttributeNode("id").nodeValue!=c){
j=a.all[c];
if(!j)return;
j[0]||(j=[j]);
for(h=0;i=j[h++];){
var l=i.getAttributeNode("id");
if(l&&l.nodeValue==c){
this.push(i,b,null,d,e,f);
break}
}
return}
if(!i){
if(this.contains(this.root,a))return;
break k}
if(this.document!==a&&!this.contains(a,i))return;
this.push(i,b,null,d,e,f);
return}
m:if(d&&a.getElementsByClassName&&!this.brokenGEBCN){
j=a.getElementsByClassName(g.join(" "));
if(!j||!j.length)break m;
for(h=0;
i=j[h++];
)this.push(i,b,c,null,e,f);
return}
}
n:{
j=a.getElementsByTagName(b);
if(!j||!j.length)break n;
this.brokenStarGEBTN||(b=null);
for(h=0;
i=j[h++];
)this.push(i,b,c,d,e,f)}
}
,">":function(a,b,c,d,e,f){
if(a=a.firstChild)do a.nodeType==1&&this.push(a,b,c,d,e,f);
while(a=a.nextSibling)}
,"+":function(a,b,c,d,e,f){
while(a=a.nextSibling)if(a.nodeType==1){
this.push(a,b,c,d,e,f);
break}
}
,"^":function(a,b,c,d,e,f){
a=a.firstChild,a&&(a.nodeType==1?this.push(a,b,c,d,e,f):this["combinator:+"](a,b,c,d,e,f))}
,"~":function(a,b,c,d,e,f){
while(a=a.nextSibling){
if(a.nodeType!=1)continue;
var g=this.getUID(a);
if(this.bitUniques[g])break;
this.bitUniques[g]=!0,this.push(a,b,c,d,e,f)}
}
,"++":function(a,b,c,d,e,f){
this["combinator:+"](a,b,c,d,e,f),this["combinator:!+"](a,b,c,d,e,f)}
,"~~":function(a,b,c,d,e,f){
this["combinator:~"](a,b,c,d,e,f),this["combinator:!~"](a,b,c,d,e,f)}
,"!":function(a,b,c,d,e,f){
while(a=a.parentNode)a!==this.document&&this.push(a,b,c,d,e,f)}
,"!>":function(a,b,c,d,e,f){
a=a.parentNode,a!==this.document&&this.push(a,b,c,d,e,f)}
,"!+":function(a,b,c,d,e,f){
while(a=a.previousSibling)if(a.nodeType==1){
this.push(a,b,c,d,e,f);
break}
}
,"!^":function(a,b,c,d,e,f){
a=a.lastChild,a&&(a.nodeType==1?this.push(a,b,c,d,e,f):this["combinator:!+"](a,b,c,d,e,f))}
,"!~":function(a,b,c,d,e,f){
while(a=a.previousSibling){
if(a.nodeType!=1)continue;
var g=this.getUID(a);
if(this.bitUniques[g])break;
this.bitUniques[g]=!0,this.push(a,b,c,d,e,f)}
}
}
;
for(var h in g)a["combinator:"+h]=g[h];
var i={
empty:function(a){
var b=a.firstChild;
return(!b||b.nodeType!=1)&&!(a.innerText||a.textContent||"").length}
,not:function(a,b){
return!this.matchNode(a,b)}
,contains:function(a,b){
return(a.innerText||a.textContent||"").indexOf(b)>-1}
,"first-child":function(a){
while(a=a.previousSibling)if(a.nodeType==1)return!1;
return!0}
,"last-child":function(a){
while(a=a.nextSibling)if(a.nodeType==1)return!1;
return!0}
,"only-child":function(a){
var b=a;
while(b=b.previousSibling)if(b.nodeType==1)return!1;
var c=a;
while(c=c.nextSibling)if(c.nodeType==1)return!1;
return!0}
,"nth-child":a.createNTHPseudo("firstChild","nextSibling","posNTH"),
"nth-last-child":a.createNTHPseudo("lastChild","previousSibling","posNTHLast"),
"nth-of-type":a.createNTHPseudo("firstChild","nextSibling","posNTHType",!0),
"nth-last-of-type":a.createNTHPseudo("lastChild","previousSibling","posNTHTypeLast",!0),
index:function(a,b){
return this["pseudo:nth-child"](a,""+b+1)}
,even:function(a){
return this["pseudo:nth-child"](a,"2n")}
,odd:function(a){
return this["pseudo:nth-child"](a,"2n+1")}
,"first-of-type":function(a){
var b=a.nodeName;
while(a=a.previousSibling)if(a.nodeName==b)return!1;
return!0}
,"last-of-type":function(a){
var b=a.nodeName;
while(a=a.nextSibling)if(a.nodeName==b)return!1;
return!0}
,"only-of-type":function(a){
var b=a,c=a.nodeName;
while(b=b.previousSibling)if(b.nodeName==c)return!1;
var d=a;
while(d=d.nextSibling)if(d.nodeName==c)return!1;
return!0}
,enabled:function(a){
return!a.disabled}
,disabled:function(a){
return a.disabled}
,checked:function(a){
return a.checked||a.selected}
,focus:function(a){
return this.isHTMLDocument&&this.document.activeElement===a&&(a.href||a.type||this.hasAttribute(a,"tabindex"))}
,root:function(a){
return a===this.root}
,selected:function(a){
return a.selected}
}
;
for(var j in i)a["pseudo:"+j]=i[j];
var k=a.attributeGetters={
"class":function(){
return this.getAttribute("class")||this.className}
,"for":function(){
return"htmlFor"in this?this.htmlFor:this.getAttribute("for")}
,href:function(){
return"href"in this?this.getAttribute("href",2):this.getAttribute("href")}
,style:function(){
return this.style?this.style.cssText:this.getAttribute("style")}
,tabindex:function(){
var a=this.getAttributeNode("tabindex");
return a&&a.specified?a.nodeValue:null}
,type:function(){
return this.getAttribute("type")}
,maxlength:function(){
var a=this.getAttributeNode("maxLength");
return a&&a.specified?a.nodeValue:null}
};
k.MAXLENGTH=k.maxLength=k.maxlength;
var l=a.Slick=this.Slick||{};
l.version="1.1.6",l.search=function(b,c,d){
return a.search(b,c,d)}
,l.find=function(b,c){
return a.search(b,c,null,!0)}
,l.contains=function(b,c){
return a.setDocument(b),a.contains(b,c)}
,l.getAttribute=function(b,c){
return a.setDocument(b),a.getAttribute(b,c)}
,l.hasAttribute=function(b,c){
return a.setDocument(b),a.hasAttribute(b,c)}
,l.match=function(b,c){
return!b||!c?!1:!c||c===b?!0:(a.setDocument(b),a.matchNode(b,c))}
,l.defineAttributeGetter=function(b,c){
return a.attributeGetters[b]=c,this}
,l.lookupAttributeGetter=function(b){
return a.attributeGetters[b]}
,l.definePseudo=function(b,c){
return a["pseudo:"+b]=function(a,b){
return c.call(a,b)}
,this}
,l.lookupPseudo=function(b){
var c=a["pseudo:"+b];
return c?function(a){
return c.call(this,a)}
:null}
,l.override=function(b,c){
return a.override(b,c),this}
,l.isXML=a.isXML,l.uidOf=function(b){
return a.getUIDHTML(b)}
,this.Slick||(this.Slick=l)}
.apply(typeof exports!="undefined"?exports:this),a.__getElements=function(a,b){
return Slick.search(a,b)}
,a.__getElement=function(a,b){
return Slick.find(a,b)}})(this),
String.prototype.trim=function(){
return String(this).replace(/^\s+|\s+$/g,"")}
,function(){

function getHref(a){return a=a||"",a.indexOf("//")==0?a=location.protocol+a:a.indexOf("http")<0&&(a=location.protocol+"//"+location.hostname+a),a}
function getAttribute(a,b){return a&&a.getAttribute&&a.getAttribute(b)||""}
function getClass(a){return getAttribute(a,"class")}
function hasClass(a,b){return getClass(a).indexOf(b)>=0}
function tagName(a){return(a&&a.tagName||"").toLowerCase()}

function registerImagesForPinBtn(a){
for(var b=0;b<a.length;b++)registerImageForPinBtn(a[b])
}

function registerImageForPinBtn(a){
	var b=a.container||a.img;
	if(b&&!b.getAttribute("data-pinit")){
	b.setAttribute("data-pinit","registered");
	var c=[b.onmouseover||function(){},
	b.onmouseout||function(){},
	b.onmousemove||function(){}];
	b.onmouseover=function(){
		getToggleOn(function(b){
		if(!b)return;
		if(isShowedBtn)return;
		isShowedBtn=!0,c[0](),showPinBtn(a)})
	}
	,b.onmouseout=function(){c[1](),hidePinBtn(),isShowedBtn=!1}
	,b.onmousemove=function(){getToggleOn(function(b){
	if(!b)return;
	if(isShowedBtn)return;
	isShowedBtn=!0,c[2](),showPinBtn(a)}
	)}
	}
}//registerImageForPinBtn end
function generatePinBtn(){
document.getElementById(global+"_Button")?pinBtn=document.getElementById(global+"_Button"):(pinBtn=generateTag("Button","pinit"),
pinBtn.innerHTML="\u91c7\u96c6\u5230\u82b1\u74e3",
pinBtn.style.display="none",
pinBtn.onmouseover=function(){selectedText=getSelectedText(),showPinBtn()}
,pinBtn.onmouseout=function(){hidePinBtn()}
,pinBtn.onclick=function(){currentImage&&pinImage(currentImage),selectedText="",itemUrl=""}
,document.body.appendChild(pinBtn)),isShareBtn&&pinBtn&&pinBtn.setAttribute("class",global+"_Button_share")
}//generatePinBtn end
function showPinBtn(a){
clearTimeout(hidePinBtnTimer);
if(a){
	var b=a.container||a.img,c,d;
	d=c=0,currentImage=a;
	if(b.getBoundingClientRect){
	var e=document.documentElement,b=b.getBoundingClientRect(),
	f=e.clientTop||document.body.clientTop||0,
	g=window.pageYOffset||document.body.scrollTop,
	h=0,i=0;
	currentImage._parentNode&&(h=currentImage._parentNode.offsetTop||0,i=currentImage._parentNode.offsetLeft||0),
	c=b.left+(window.pageXOffset||document.body.scrollLeft)-(e.clientLeft||document.body.clientLeft||0)+i,d=b.top+g-f+h}
	d-=9,c-=9,pinBtn.style.top=(d>0?d:0)+"px",pinBtn.style.left=(c>0?c:0)+"px"
}
pinBtn.style.display="block !important",pinBtn.style.visibility="visible !important"
}//showPinBtn end
function hidePinBtn(){
hidePinBtnTimer=setTimeout(function(){
pinBtn.style.display="none !important",pinBtn.style.visibility="hidden !important",currentImage=null}
,100)}
function calculateMarginTop(a){return Math.max(a.h,a.w)>199?a.h<a.w?"margin-top: "+parseInt(100-100*(a.h/a.w))+"px;":"":"margin-top: "+parseInt(100-a.h/2)+"px;"}
function generateStyleElement(){
var a=global+"_Style";
if(document.getElementById(a))return;
var b="#PREFIX_Container {font-family: 'helvetica neue', arial, sans-serif; position: absolute; padding-top: 37px;  z-index: 100000002;  top: 0;  left: 0;  background-color: transparent;  opacity: 1; hasLayout:-1; } #PREFIX_Overlay { position: fixed;  z-index: 100000001;  top: 0;  right: 0;  bottom: 0;  left: 0;  background-color: #f2f2f2;  opacity: .95; } #PREFIX_Control { position:relative;  z-index: 100000;  float: left;  background-color: #fcf9f9;  border: solid #ccc;  border-width: 0 1px 1px 0;  height: 200px;  width: 200px;  opacity: 1; } #PREFIX_Control img { position: relative;  padding: 0;  display: block;  margin: 82px auto 0;  -ms-interpolation-mode: bicubic; } #PREFIX_Control a { position: fixed;  z-index: 10001;  right: 0;  top: 0;  left: 0;  height: 24px;  padding: 12px 0 0;  text-align: center;  font-size: 14px;  line-height: 1em;  text-shadow: 0 1px #fff;  color: #211922;  font-weight: bold;  text-decoration: none;  background: #fff url(ASSETS_URL/static/images/collect/tbg.png) 0 0 repeat-x;  border-bottom: 1px solid #ccc;  -mox-box-shadow: 0 0 2px #d7d7d7;  -webkit-box-shadow: 0 0 2px #d7d7d7; } #PREFIX_Control a:hover { color: #fff;  text-decoration: none;  background-color: #1389e5;  border-color: #1389e5;  text-shadow: 0 -1px #46A0E6; } #PREFIX_Control a:active { height: 23px;  padding-top: 13px;  background-color: #211922;  border-color: #211922;  background-image: url(ASSETS_URL);  text-shadow: 0 -1px #211922; } .PREFIXImagePreview { position: relative;  padding: 0;  margin: 0;  float: left;  background-color: #fff;  border: solid #e7e7e7;  border-width: 0 1px 1px 0;  height: 200px;  width: 200px;  opacity: 1;  z-index: 10002;  text-align: center; } .PREFIXImagePreview .PREFIXVideoIcon { position:absolute; display:block; top:0; left:0; width:100%; height:100%; background:url(ASSETS_URL/media_video.png) center center no-repeat; } .PREFIXImagePreview .PREFIXImg { border: none;  height: 200px;  width: 200px;  opacity: 1;  padding: 0; } .PREFIXImagePreview .PREFIXImg a { margin: 0;  padding: 0;  position: absolute;  top: 0;  bottom: 0;  right: 0;  left: 0;  display: block;  text-align: center;   z-index: 1; } .PREFIXImagePreview .PREFIXImg a:hover { background-color: #fcf9f9;  border: none; } .PREFIXImagePreview .PREFIXImg .ImageToPin { max-height: 200px;  max-width: 200px;  width: auto !important;  height: auto !important; } .PREFIXImagePreview img.PREFIX_PinIt { border: none;  position: absolute;  top: 82px;  left: 42px;  display: none;  padding: 0;  background-color: transparent;  z-index: 100; } .PREFIXImagePreview img.PREFIX_vidind { border: none;  position: absolute;  top: 75px;  left: 75px;  padding: 0;  background-color: transparent;  z-index: 99; } .PREFIXDimensions {  color: #000;  position: relative;  margin-top: 180px;  text-align: center;  font-size: 10px;  z-index:10003;  display: inline-block;  background: white;  border-radius: 4px;  padding: 0 2px; } #PREFIX_Button {  display: block;  position: absolute;  z-index: 999999999;  color: #211922;  background: #fff;  text-shadow: 0 1px #eaeaea;  border-radius: 5px;  box-shadow: 0 0 2px #555;  font: 12px/1 'Helvetica Neue',Helvetica,Arial,Sans-serif;  text-align: center;  padding: 5px 8px;  cursor: pointer;  } #PREFIX_Button:hover {  background-image: -webkit-linear-gradient(top, #fefeff, #efefef);  background-image: -moz-linear-gradient(top, #fefeff, #efefef);  } .PREFIX_Button_share { background: url(ASSETS_URL/sharebutton.png) no-repeat !important;  text-indent: -9999px;  width: 70px; }".replace(/PREFIX/g,global).replace(/ASSETS_URL/g,imageRoot),c=document.createElement("style");
c.id=a,isIE()&&(c.type="text/css",c.media="screen"),
(document.getElementsByTagName("head")[0]||document.body).appendChild(c),
c.styleSheet?c.styleSheet.cssText=b:c.appendChild(document.createTextNode(b))
} //generateStyleElement end

function generateTag(a,b){var c=document.createElement(b||"div");return c.id=global+"_"+a,c}
function encapsulateImage(a){
var b=new Image;b.src=a.src;var c={w:a.width,h:a.height,src:a.src,img:a,alt:"",img2:b};
return c}
function isValidImage(a){return a.style.display=="none"||a.className=="ImageToPin"||a.width<100||a.height<100?!1:!0}
function getVideoOnCustomerPage(a,b){
	for(i=0;i<a.embeds.length;i++){
		var c=a.embeds[i],d=c.src,e=new Image;
		if(d.indexOf("player.youku.com/player")>0||d.indexOf("www.tudou.com")>0||d.indexOf("player.ku6.com/refer")>0||d.indexOf("player.56.com")>0)e.src="http://"+siteDomain+"/pins/create/video/swf?url="+d,
			e.width=448,
			e.height=336,
			e=encapsulateImage(e),
			e.container=c,e.video=d,e.media_type=1,b.push(e);
		else if(d.indexOf("v.ifeng.com/include/exterior.swf")>0){
			var f=/guid=(.+?)&/,g=f.exec(d);
			if(!g)return!1;
			g=g[1],e.src="http://"+siteDomain+"/pins/create/video/ifeng/"+g,e.width=480,e.height=360,e=encapsulateImage(e),e.container=c,e.video=d,e.media_type=1,b.push(e)
		}
	}
}
function getCurrentPageImagesWithEncapsulation(d,eImages,opts){
	var _document=d||document;eImages=eImages||[],opts=opts||{};
	if(skip)return eImages;
	for(i=0;i<_document.images.length;i++){
	var img=_document.images[i];
	isValidImage(img)&&(img=encapsulateImage(img),opts&&(img._parentNode=opts.parentNode||null),eImages.push(img))
	//wl("i="+i+"|length:"+ eImages.length);
	}
	//wl("getCurrentPageImagesWithEncapsulation 1:");
	//wl(eImages.length);
	getVideoOnCustomerPage(_document,eImages);
	var bgimgs_reg;
	for(i in bgimgs){
		bgimgs_reg=new RegExp(i);
		if(bgimgs_reg.test(location.href)){
		var imgs=bgimgs[i]();
		if(!imgs)break;
		for(var i=0;
		i<imgs.length;
		i++)opts&&(imgs[i].img._parentNode=opts.parentNode||null),eImages.push(imgs[i]);
		break}
	}
	var url=_document.location.href,thumb=new Image;
	if(url.indexOf("www.tudou.com")>0){
		if(bigItemUrl.indexOf("w.jpg")==-1){
		var image=bigItemUrl.split("/");
		bigItemUrl=bigItemUrl.replace(image[image.length-1],"w.jpg")}
		thumb.src=bigItemUrl,thumb.width=320,thumb.height=240,thumb=encapsulateImage(thumb),thumb.container=_document.getElementById("playerObject"),thumb.video="http://www.tudou.com/v/"+iid_code+"/v.swf",thumb.media_type=1,eImages.push(thumb)
	}else if(url.indexOf("v.ku6.com")>0)thumb.src=App.VideoInfo.data.data.bigpicpath,thumb.width=480,thumb.height=360,thumb=encapsulateImage(thumb),thumb.container=_document.getElementById("ku6player"),thumb.video="http://player.ku6.com/refer/"+App.VideoInfo.id+"/v.swf",thumb.media_type=1,eImages.push(thumb);
	 else if(url.indexOf("v.youku.com")>0){
		var json=eval("("+httpGet("http://v.youku.com/player/getPlayList/VideoIDS/"+videoId2)+")");
		thumb.src=json.data[0].logo,thumb.width=448,thumb.height=336,thumb=encapsulateImage(thumb),thumb.container=_document.getElementById("player"),thumb.video="http://player.youku.com/player.php/sid/"+videoId2+"/v.swf",thumb.media_type=1,eImages.push(thumb)
	}else if(url.indexOf("v.ifeng.com")>0){
		var a=url.split("/"),id=a[a.length-1].split(".");
		id=id[0];
		var json=httpGet("http://v.ifeng.com/video_info_new/"+id[id.length-2]+"/"+id[id.length-2]+id[id.length-1]+"/"+id+".xml"),reg=/BigPosterUrl="(.+)" SmallPosterUrl/,a=reg.exec(json);
		thumb.src=a[1],thumb.width=480,thumb.height=360,thumb=encapsulateImage(thumb),thumb.container=_document.getElementById("playerDiv"),thumb.video="http://v.ifeng.com/include/exterior.swf?guid="+id+"&AutoPlay=false",thumb.media_type=1,eImages.push(thumb)
	}else if(url.indexOf("www.56.com/u")>0){
		var reg=/v_(.+?)\.html/,a=reg.exec(url);
		a=a[1],thumb.src="http://"+siteDomain+"/pins/create/video/56/"+a,thumb.width=480,thumb.height=405,thumb=encapsulateImage(thumb),thumb.container=_document.getElementById("myflashBox"),thumb.video="http://player.56.com/v_"+a+".swf",thumb.media_type=1,eImages.push(thumb)
	}
	var iframes=_document.getElementsByTagName("iframe");
	for(var i=0;i<iframes.length;i++)
	try{
		var d=iframes[i].contentDocument;
		if(d){
			var parentNode=iframes[i].parentNode;
			eImages=getCurrentPageImagesWithEncapsulation(d,eImages,{parentNode:parentNode})
		}
	}catch(e){}
return eImages}//getCurrentPageImagesWithEncapsulation end

function httpGet(a){var b=null;return b=new XMLHttpRequest,b.open("GET",a,!1),b.send(null),b.responseText}
function getSelectedText(){return(""+(window.getSelection?window.getSelection():document.getSelection?document.getSelection():document.selection.createRange().text)).replace(/(^\s+|\s+$)/g,"")}
function isIE(){return/msie/i.test(navigator.userAgent)&&!/opera/i.test(navigator.userAgent)}
function isSafari(){return/Safari/.test(navigator.userAgent)&&!/Chrome/.test(navigator.userAgent)}
function isPinable(a){
	var b=!0,c=!1,d=this.location,e=d.host;
	if(/^(?:about|chrome)/.test(d.protocol))d.href="http://"+siteDomain,b=!1;
	else if(siteDomain==e)/^\/guide\/pin\/?/.test(d.pathname)||(a&&alert("不能采集本站图片"),b=!1);
	else if(/^127.0.0.1(?::\d+)?/.test(e))c=!0;
	else if(/^localhost(?::\d+)?/.test(e))c=!0;
	else if(/^10\./.test(e))c=!0;
	else if(/^192\.168\./.test(e))c=!0;
	else if(/^(?:\d+\.){3}\d+$/.test(e)){
		var f=e.split("."),g=parseInt(f[0],10),f=parseInt(f[1],10);
		g===172&&f>15&&f<32?c=!0:g===169&&f===254&&(c=!0)}
	return c&&(a&&alert("不能采集本站图片"),b=!1),b
}
function pinAllImage(){
for(var i=0;i<g_allimage.length;i++) pinImage(g_allimage[i]);
}
function removeOneImage(a){
for(var i=0;i<g_allimage.length;i++){
 if(a.src == g_allimage[i].src){ g_allimage.remove(i);break;}
}
}
Array.prototype.remove=function(dx){
if(isNaN(dx)||dx>this.length){return false;}
for(var i=0,n=0;i<this.length;i++) if(this[i]!=this[dx]) this[n++]=this[i];
this.length-=1;
}
function pinImage(a){
	for(i in filters){
		var b=new RegExp(i);
		if(b.test(location.href)){
		a=filters[i](a)||a;
		break}
	}
var c=a.url||(a.src==location.href?document.referrer||location.href:location.href),d=a.img;
isSafari()&&(c=encodeURI(c));
var e={
	media:a.big_img?a.big_img.src:d.src,
	url:c,
	w:a.big_img?a.big_img.width:d.width,
	h:a.big_img?a.big_img.height:d.height,
	alt:d.alt,
	title:a.title||document.title,
	description:a.description||"",
	media_type:a.media_type||"",
	video:a.video||""
};
imageDesc=getSelectedText()||selectedText,imageDesc&&(e.description=imageDesc);
var f=[];
f.push(bookmarkletUrl),f.push("?");
for(var g in e)f.push(encodeURIComponent(g)),f.push("="),f.push(encodeURIComponent(e[g])),f.push("&");
var c=f.join(""),h="status=no,resizable=no,scrollbars=yes,personalbar=no,directories=no,location=no,toolbar=yes,menubar=no,width=550,height=250,left=0,top=0";
window.open(c,"pin"+(new Date).getTime(),h)}//pinImage end
function showImages(a){
g_allimage = a;
if(showingImage)return;
hideFlash(),lastScrollY=window.pageYOffset||document.body.scrollTop;
var b=function(){
	return c.parentNode.removeChild(c),
	d.parentNode.removeChild(d),
	showingImage=!1,
	selectedText="",
	showFlash(),
	window.scroll(0,lastScrollY),
	!1
},
c=generateTag("Overlay");
document.keydown=b,document.body.appendChild(c);
var d=generateTag("Container");
document.body.appendChild(d);
var e=document.createElement("div");
e.setAttribute("id",global+"_Control");
var f=new Image;
f.src=imageRoot+"/static/images/collect/logoabout.png",e.appendChild(f);
var g=generateTag("RemoveLink","a");
g.href="javascirpt:;",
g.appendChild(document.createTextNode("\u53d6\u6d88")),
e.appendChild(g),
d.appendChild(e),
document.getElementById(global+"_RemoveLink").onclick=b;
var h={};
for(var i=0;i<a.length;i++)h[a[i].src]||(h[a[i].src]=1,
	function(a){
	var c=document.createElement("div");
	isIE()?c.className=global+"ImagePreview":c.setAttribute("class",global+"ImagePreview");
	var d=document.createElement("div");
	isIE()?d.className=global+"Img":d.setAttribute("class",global+"Img");
	var e=document.createElement("span");
	e.innerHTML=a.w+" x "+a.h,isIE()?e.className=global+"Dimensions":
	e.setAttribute("class",global+"Dimensions"),
	c.appendChild(e),
	document.getElementById(global+"_Container").appendChild(c).appendChild(d),
	c=document.createElement("a"),
	c.setAttribute("href","javascript:;"),
	c.onclick=function(){return pinImage(a),b()};
	if(a.video){
	var f=document.createElement("span");
	isIE()?f.className=global+"VideoIcon":f.setAttribute("class",global+"VideoIcon"),c.appendChild(f)}
	d.appendChild(c);
	var g=document.createElement("img");
	isIE()?d.className=global+"Img":d.setAttribute("class",global+"Img"),
	g.setAttribute("style",""+calculateMarginTop(a)),
	g.src=a.src,
	g.setAttribute("alt","Pin This"),
	g.className="ImageToPin",
	c.appendChild(g);
	var h=document.createElement("img");
	var hd=document.createElement("img");
	isIE()?h.className=global+"_PinIt":h.setAttribute("class",global+"_PinIt"),
	isIE()?hd.className=global+"_PinIt":hd.setAttribute("class",global+"_removeIt"),
	h.src=imageRoot+"/static/images/collect/pinthis.png",
	//hd.src=imageRoot+"application/views/index/skin/images/collect/delete.png",
	hd.onclick=removeOneImage(a);
	h.setAttribute("alt","Pin This"),
	isIE()?(
	c.attachEvent("onmouseover",function(){h.style.display="block"}),
	c.attachEvent("onmouseout",function(){h.style.display="none"})
	):(
	c.addEventListener("mouseover",function(){h.style.display="block"},!1),
	c.addEventListener("mouseout",function(){h.style.display="none"},!1)
	),
	c.appendChild(h)
}(a[i]));
showingImage=!0
}//showImages end
function initPinBtn(a){generatePinBtn(),registerImagesForPinBtn(a)}
function showImagesAndInitPinBtn(){
if(!isPinable(!0))return;
var a=getCurrentPageImagesWithEncapsulation();
imageDesc=getSelectedText()||selectedText;
if(a.length==0){
	if(!reported){
		reported=!0;
		var b=location.href,c=new Image;
		c.src="http://"+siteDomain+"/feedback/objnotfound?link="+encodeURIComponent(b)
	}
	try{
	window.top===window.self&&window.alert("\u62b1\u6b49\uff0c\u9875\u9762\u4e0a\u6ca1\u6709\u8db3\u591f\u5927\u7684\u56fe\u7247\u3002")
	}catch(d){}
}
else showImages(a),initPinBtn(a),window.scroll(0,0)
}//showImagesAndInitPinBtn end

function getToggleOn(a){a(!0)}
function showFlash(){
	var a=document.getElementById(global+"_FixFlashStyle");
	a&&(document.getElementsByTagName("head")[0]||document.body).removeChild(a)}
function hideFlash(){
	var a=global+"_FixFlashStyle";
	if(!document.getElementById(a)){
	var b="object, embed {visibility: hidden}",c=document.createElement("style");
	c.id=a,(document.getElementsByTagName("head")[0]||document.body).appendChild(c),c.styleSheet?c.styleSheet.cssText=b:c.appendChild(document.createTextNode(b))}
}
var global="__huaban";
var g_allimage="";
document[global]=document[global]||{};
var siteDomain="192.168.1.87",imageRoot="http://"+siteDomain,bookmarkletUrl="http://"+siteDomain+"/index.php"+"/collect/showPage",domChanged=!1,selectedText="",lastScrollY=0,isShareBtn=!1,pinBtn=null,hidePinBtnTimer=null,currentImage=null,imageDesc="",showingImage=!1,itemUrl="",skip=!1,skiphrefs=["http://www.test.com/"];

//http://localhost/huaban/spider/test.php
(function(){
for(var a=0;a<skiphrefs.length;a++)if(location.href.indexOf(skiphrefs[a])>=0){
	skip=!0;
	break}
})();

var checkbgimgs=function(a){
	var b=a;
	if(!b)return;
	var c=b.style.backgroundImage||b.style.getPropertyValue&&b.style.getPropertyValue("background-image");
	if(!c)return;
	var d=c.match(/url\((.+)\)/);
	if(d==null||d.length!=2)return;
	var e=d[1];
	if(e.indexOf("http://")==0||e.indexOf("https://")==0||e.indexOf("/")==0){
		var f=new Image;
		f.src=e;
		var g={container:b,w:f.width,h:f.height,src:f.src,img:f,alt:"",img2:f};
		return g
	}
	return
},
bgimgs={
	"^http://1x.com/":function(){
		var a=checkbgimgs(document.getElementById("bigimage2"));
		if(a)return[a];
	return},
	"^http://\\w+.163.com/photoview/":function(){
		var a=document.getElementById("modePhoto");
		if(!a)return;
		var b=__getElement(a,"#photoView img"),c=__getElement(a,".nph_photo_prev"),d=__getElement(a,"#photoDesc"),e=document.title||"";
		e+="\n";
		if(b&&c)return[{container:c,w:b.width,h:b.height,src:b.src,img:b,description:e+(d&&d.innerText||""),img2:b}];
	return}
	,"^http://luxury.qq.com/":function(){
		var a=document.getElementById("Main-A"),b=document.getElementById("mainArea"),c,d,e,f=document.title||"";
		a&&(c=__getElement(a,"#PicSrc"),d=__getElement(a,"#mouseOverleft"),e=__getElement(document,"#Main-B > p"),e&&(e=e.innerText||"")),b&&(c=document.getElementById("Display"),d=document.getElementById("preArrow"),e=__getElement(b,"#titleArea > p"),e&&(e=e.innerText||"")),f+="\n";
		if(c&&d)return[{container:d,w:c.width,h:c.height,src:c.src,img:c,description:f+e,img2:c}];
	return}
}
,filters={
"^http(s)?://(\\w+.)?diandian.com":function(a){
	var b=a.img,c=null,d=null,e=null;
	if(tagName(b)=="img"){
		b=b.parentNode;
		var f=!1;
		while(b&&b.nodeName.toLowerCase()!="body"){
			var g=getClass(b);
			if(g=="feed-content-holder pop"){
				var h=__getElement(b,"div.link-to-post-holder a.link-to-post");
				h&&(c=h.getAttribute("href"),f=!0);
				var i=__getElement(b,"div.feed-ct");
				i&&(e=i.innerText||i.textContent||"",e=e.trim())
			}else if(g=tagName(b)=="a")c=b.getAttribute("href"),f=!0;
			if(f)break;
			b=b.parentNode||null
		}
	}
	return c&&(a.url=getHref(c)),d&&(a.title=d),e&&(a.description=e),a
},
"^http://(.*\\.)?weibo.com":function(a){
var b=a.img,c=null,d=null,e=null;
if(tagName(b)=="img"&&getAttribute(b,"action-type")=="feed_list_media_bigimg"){
b=b.parentNode;
var f=!1;
while(b&&b.nodeName.toLowerCase()!="body"&&(tagName(b)!="dl"||!hasClass(b,"feed_list"))){
if(tagName(b)=="dd"&&hasClass(b,"content")){
f=!0;
var g=__getElement(b,"a[node-type=feed_list_item_date]");
g&&(c=g.getAttribute("href")||"");
var h=__getElement(b,"p[node-type=feed_list_content]");
h&&(e=h.innerText||h.textContent||"",e=e.trim())}
if(f)break;
b=b.parentNode||null}
}
else if(tagName(b)=="img"&&getAttribute(b,"node-type")=="img_view"){
b=b.parentNode&&b.parentNode.parentNode||null;
if(b&&hasClass(b,"big_pic")&&getAttribute(b,"node-type")=="layer_center"){
var g=__getElement(b,"p[node-type=feed_list_content] a[node-type=feed_list_item_date]");
g&&(c=g.getAttribute("href")||"");
var h=__getElement(b,"p[node-type=feed_list_content]");
h&&(e=h.innerText||h.textContent||"",e=e.trim())}
}
else if(tagName(b)=="img"&&b.parentNode&&b.parentNode.parentNode&&b.parentNode.parentNode.parentNode&&getAttribute(b.parentNode.parentNode.parentNode,"node-type")=="albumDetail"){
var i=b.parentNode.parentNode.parentNode,g=tagName(b.parentNode)=="a"?b.parentNode:!1;
g&&(c=g.getAttribute("href")||"");
var h=i&&__getElement(i,".photo_comment > div > p");
h&&(e=h.innerText||h.textContent||"",e=e.trim())}
return c&&(a.url=getHref(c)),d&&(a.title=d),e&&(a.description=e),a
},
"^http(s)?://www.google.com/reader/":function(a){
var b=a.img,c=null,d=null,e=null;
if(tagName(b)=="img"){
b=b.parentNode;
var f=!1;
while(b&&b.nodeName.toLowerCase()!="body"&&(tagName(b)!="div"||!hasClass(b,"entry-container"))){
if(tagName(b)=="div"&&hasClass(b,"entry-main")){
f=!0;
var g=__getElement(b,"h2.entry-title a.entry-title-link");
g&&(c=g.getAttribute("href")||"",d=g.innerText||g.textContent||"",d=d.trim(),e=d)}
if(f)break;
b=b.parentNode||null}
}
c&&(a.url=getHref(c)),e&&(a.title=e),d&&(a.description=d)
},
"^http(s)?://(www\\.)?markzhi.com":function(a){
var b=a.img,c=null,d=null,e=null,f=null;
if(tagName(b)=="img"&&b.parentNode&&b.parentNode.parentNode&&hasClass(b.parentNode.parentNode,"item mark")){
var g=getAttribute(b,"src");
g&&/metal.jpg$/.test(g)&&(f=g.replace(/metal.jpg$/,"wood.jpg")),b=b.parentNode;
var h=null;
tagName(b)=="a"&&hasClass(b,"image")&&(c=getAttribute(b,"href")),b=b.parentNode;
var i=__getElement(b,"strong.title");
i&&(e=i.innerText||i.textContent||"",e=e.trim())}
c&&(a.url=getHref(c)),e&&(a.title=e),d&&(a.description=d);
if(f){
var j=new Image;
j.alt=a.img.alt,j.src=f,a.big_img=j}
},
"^http(s)?://plus.google.com/":function(a){
var b=a.img,c=null;
itemUrl&&(c=itemUrl);
if(b.parentNode){
var d=getAttribute(b.parentNode,"data-content-url");
d&&/http(s)?:\/\/plus.google.com\/photos\/.+\/albums\/.+/.test(d)&&(c=d)}
c&&(a.url=getHref(c))
},
"^http(s)?://(www\\.)?tumblr.com":function(a){
var b=a.img,c=null,d=null;
if(tagName(b)=="img"){
b=b.parentNode;
var e=!1;
while(b&&b.nodeName.toLowerCase()!="body"){
if(tagName(b)=="li"&&hasClass(b,"post")&&b.id&&b.id.indexOf("post_")==0){
e=!0;
var f=__getElement(b,"a.permalink");
f&&(c=f.getAttribute("href")||"");
var g=__getElement(b,"div.caption > p");
g&&(d=g.innerText||g.textContent||"",d=d.trim())}
if(e)break;
b=b.parentNode||null}
}
c&&(a.url=getHref(c)),d&&(a.description=d)
},
"^http(s)?://(www\\.)?topit.me":function(a){
	var b=a.img,c=null,d=null,e=null;
	if(tagName(b)=="img"){
	b=b.parentNode;
	var f=!1;
	while(b&&b.nodeName.toLowerCase()!="body"){
		if(tagName(b)=="div"&&hasClass(b,"e")&&hasClass(b,"m")){
		f=!0;
		var g=a.img.parentNode;
		c=g.getAttribute("href")||"";
		var h=__getElement(b,".bar > .title");
		d=h&&h.innerText||h.textContent||"",h=__getElement(b,".bar > .info"),d=h&&d&&d.trim()+"\n",d+=h&&h.innerText||h.textContent||"",d=d.trim();
		var i=getAttribute(a.img,"src");
		i&&(/m\.jpg$/.test(i)?e=i.replace(/m\.jpg$/,"l.jpg"):/topit\.me\/m\d+\//.test(i)?e=i.replace(/(topit\.me\/)m(\d+\/)/,"$1l$2"):/img\.topit\.me\/m\//.test(i)&&(e=i.replace(/(img\.topit\.me\/)m(\/)/,"$1l$2")))}
		if(f)break;
		b=b.parentNode||null}
	}
	c&&(a.url=getHref(c)),d&&(a.description=d);
	if(e){
	var j=new Image;
	j.alt=a.img.alt,j.src=e,a.big_img=j}
	}
}
,isShowedBtn=!1,reported=!1;

(function(){
if(document[global]._loaded)return;
if(isPinable(!1)){
	generateStyleElement();
	if(document.getElementById("huaban_script"))showImagesAndInitPinBtn();
	else if(document.getElementById("huaban_user_script")||document.getElementById("huaban_share_script")){
		document.getElementById("huaban_share_script")&&(isShareBtn=!0);
		var a=getCurrentPageImagesWithEncapsulation();
		a.length>0&&initPinBtn(a)
	}else showImagesAndInitPinBtn()
}
isIE()||(
document.body.addEventListener("DOMNodeInserted",function(a){domChanged=!0,clearTimeout(b),b=setTimeout(c,500)},!1),
window.addEventListener("scroll",function(){domChanged=!0,clearTimeout(b),b=setTimeout(c,500)},!1));
var b=!1,c=function(){
	if(!domChanged)return;
	var a=getCurrentPageImagesWithEncapsulation();
	a.length>0&&initPinBtn(a),domChanged=!1,b=setTimeout(c,5e3)
};

setTimeout(c,5e3),isIE()?document.body.attachEvent("onclick",function(){
	var a=window.event;
	if(a.target&&a.target.tagName=="pinit")return;
	domChanged=!0,clearTimeout(b),b=setTimeout(c,500)
}):document.body.addEventListener("click",function(a){
	if(a.target&&a.target.tagName=="pinit")return;
	a.target&&tagName(a.target)=="img"&&a.target.parentNode&&(itemUrl=getAttribute(a.target.parentNode,"data-content-url")),
	domChanged=!0,
	clearTimeout(b),
	b=setTimeout(c,500)}),
	document[global]._loaded=!0,
	document[global].showValidImages=showImagesAndInitPinBtn
})()
}()