/*! fanwei 2014-03-10 */
define("global/bodyParse",[],function(){function o(){var o,n,t,e,l,c,i;if(window.location.search){for(o=decodeURIComponent(window.location.search.split("?")[1]),n=o.split("&"),e=n.length,i={},c=0;e>c;c++)t=n[c].split("="),l=t.length,i[t[0]]=t[1];return i}return null}return o});