/*! fanwei 2014-03-10 */
define("lib/backbone/backbone-debug",[],function(){(function(t,e){t.Backbone=e(t,{},t._,t.jQuery||t.Zepto||t.ender||t.$)})(this,function(t,e,n,i){var r=t.Backbone,s=[];s.push;var a=s.slice;s.splice,e.VERSION="1.1.1",e.$=i,e.noConflict=function(){return t.Backbone=r,this},e.emulateHTTP=!1,e.emulateJSON=!0;var o=e.Events={on:function(t,e,n){if(!c(this,"on",t,[e,n])||!e)return this;this._events||(this._events={});var i=this._events[t]||(this._events[t]=[]);return i.push({callback:e,context:n,ctx:n||this}),this},once:function(t,e,i){if(!c(this,"once",t,[e,i])||!e)return this;var r=this,s=n.once(function(){r.off(t,s),e.apply(this,arguments)});return s._callback=e,this.on(t,s,i)},off:function(t,e,i){var r,s,a,o,u,l,h,f;if(!this._events||!c(this,"off",t,[e,i]))return this;if(!t&&!e&&!i)return this._events=void 0,this;for(o=t?[t]:n.keys(this._events),u=0,l=o.length;l>u;u++)if(t=o[u],a=this._events[t]){if(this._events[t]=r=[],e||i)for(h=0,f=a.length;f>h;h++)s=a[h],(e&&e!==s.callback&&e!==s.callback._callback||i&&i!==s.context)&&r.push(s);r.length||delete this._events[t]}return this},trigger:function(t){if(!this._events)return this;var e=a.call(arguments,1);if(!c(this,"trigger",t,e))return this;var n=this._events[t],i=this._events.all;return n&&l(n,e),i&&l(i,arguments),this},stopListening:function(t,e,i){var r=this._listeningTo;if(!r)return this;var s=!e&&!i;i||"object"!=typeof e||(i=this),t&&((r={})[t._listenId]=t);for(var a in r)t=r[a],t.off(e,i,this),(s||n.isEmpty(t._events))&&delete this._listeningTo[a];return this}},u=/\s+/,c=function(t,e,n,i){if(!n)return!0;if("object"==typeof n){for(var r in n)t[e].apply(t,[r,n[r]].concat(i));return!1}if(u.test(n)){for(var s=n.split(u),a=0,o=s.length;o>a;a++)t[e].apply(t,[s[a]].concat(i));return!1}return!0},l=function(t,e){var n,i=-1,r=t.length,s=e[0],a=e[1],o=e[2];switch(e.length){case 0:for(;r>++i;)(n=t[i]).callback.call(n.ctx);return;case 1:for(;r>++i;)(n=t[i]).callback.call(n.ctx,s);return;case 2:for(;r>++i;)(n=t[i]).callback.call(n.ctx,s,a);return;case 3:for(;r>++i;)(n=t[i]).callback.call(n.ctx,s,a,o);return;default:for(;r>++i;)(n=t[i]).callback.apply(n.ctx,e);return}},h={listenTo:"on",listenToOnce:"once"};n.each(h,function(t,e){o[e]=function(e,i,r){var s=this._listeningTo||(this._listeningTo={}),a=e._listenId||(e._listenId=n.uniqueId("l"));return s[a]=e,r||"object"!=typeof i||(r=this),e[t](i,r,this),this}}),o.bind=o.on,o.unbind=o.off,n.extend(e,o);var f=e.Model=function(t,e){var i=t||{};e||(e={}),this.cid=n.uniqueId("c"),this.attributes={},e.collection&&(this.collection=e.collection),e.parse&&(i=this.parse(i,e)||{}),i=n.defaults({},i,n.result(this,"defaults")),this.set(i,e),this.changed={},this.initialize.apply(this,arguments)};n.extend(f.prototype,o,{changed:null,validationError:null,idAttribute:"id",initialize:function(){},toJSON:function(){return n.clone(this.attributes)},sync:function(){return e.sync.apply(this,arguments)},get:function(t){return this.attributes[t]},escape:function(t){return n.escape(this.get(t))},has:function(t){return null!=this.get(t)},set:function(t,e,i){var r,s,a,o,u,c,l,h;if(null==t)return this;if("object"==typeof t?(s=t,i=e):(s={})[t]=e,i||(i={}),!this._validate(s,i))return!1;a=i.unset,u=i.silent,o=[],c=this._changing,this._changing=!0,c||(this._previousAttributes=n.clone(this.attributes),this.changed={}),h=this.attributes,l=this._previousAttributes,this.idAttribute in s&&(this.id=s[this.idAttribute]);for(r in s)e=s[r],n.isEqual(h[r],e)||o.push(r),n.isEqual(l[r],e)?delete this.changed[r]:this.changed[r]=e,a?delete h[r]:h[r]=e;if(!u){o.length&&(this._pending=i);for(var f=0,p=o.length;p>f;f++)this.trigger("change:"+o[f],this,h[o[f]],i)}if(c)return this;if(!u)for(;this._pending;)i=this._pending,this._pending=!1,this.trigger("change",this,i);return this._pending=!1,this._changing=!1,this},unset:function(t,e){return this.set(t,void 0,n.extend({},e,{unset:!0}))},clear:function(t){var e={};for(var i in this.attributes)e[i]=void 0;return this.set(e,n.extend({},t,{unset:!0}))},hasChanged:function(t){return null==t?!n.isEmpty(this.changed):n.has(this.changed,t)},changedAttributes:function(t){if(!t)return this.hasChanged()?n.clone(this.changed):!1;var e,i=!1,r=this._changing?this._previousAttributes:this.attributes;for(var s in t)n.isEqual(r[s],e=t[s])||((i||(i={}))[s]=e);return i},previous:function(t){return null!=t&&this._previousAttributes?this._previousAttributes[t]:null},previousAttributes:function(){return n.clone(this._previousAttributes)},fetch:function(t){t=t?n.clone(t):{},void 0===t.parse&&(t.parse=!0);var e=this,i=t.success;return t.success=function(n){return e.set(e.parse(n,t),t)?(i&&i(e,n,t),e.trigger("sync",e,n,t),void 0):!1},C(this,t),this.sync("read",this,t)},save:function(t,e,i){var r,s,a,o=this.attributes;if(null==t||"object"==typeof t?(r=t,i=e):(r={})[t]=e,i=n.extend({validate:!0},i),r&&!i.wait){if(!this.set(r,i))return!1}else if(!this._validate(r,i))return!1;r&&i.wait&&(this.attributes=n.extend({},o,r)),void 0===i.parse&&(i.parse=!0);var u=this,c=i.success;return i.success=function(t){u.attributes=o;var e=u.parse(t,i);return i.wait&&(e=n.extend(r||{},e)),n.isObject(e)&&!u.set(e,i)?!1:(c&&c(u,t,i),u.trigger("sync",u,t,i),void 0)},C(this,i),s=this.isNew()?"create":i.patch?"patch":"update","patch"===s&&(i.attrs=r),a=this.sync(s,this,i),r&&i.wait&&(this.attributes=o),a},destroy:function(t){t=t?n.clone(t):{};var e=this,i=t.success,r=function(){e.trigger("destroy",e,e.collection,t)};if(t.success=function(n){(t.wait||e.isNew())&&r(),i&&i(e,n,t),e.isNew()||e.trigger("sync",e,n,t)},this.isNew())return t.success(),!1;C(this,t);var s=this.sync("delete",this,t);return t.wait||r(),s},url:function(){var t=n.result(this,"urlRoot")||n.result(this.collection,"url")||M();return this.isNew()?t:t.replace(/([^\/])$/,"$1/")+encodeURIComponent(this.id)},parse:function(t){return t},clone:function(){return new this.constructor(this.attributes)},isNew:function(){return!this.has(this.idAttribute)},isValid:function(t){return this._validate({},n.extend(t||{},{validate:!0}))},_validate:function(t,e){if(!e.validate||!this.validate)return!0;t=n.extend({},this.attributes,t);var i=this.validationError=this.validate(t,e)||null;return i?(this.trigger("invalid",this,i,n.extend(e,{validationError:i})),!1):!0}});var p=["keys","values","pairs","invert","pick","omit"];n.each(p,function(t){f.prototype[t]=function(){var e=a.call(arguments);return e.unshift(this.attributes),n[t].apply(n,e)}});var d=e.Collection=function(t,e){e||(e={}),e.model&&(this.model=e.model),void 0!==e.comparator&&(this.comparator=e.comparator),this._reset(),this.initialize.apply(this,arguments),t&&this.reset(t,n.extend({silent:!0},e))},g={add:!0,remove:!0,merge:!0},v={add:!0,remove:!1};n.extend(d.prototype,o,{model:f,initialize:function(){},toJSON:function(t){return this.map(function(e){return e.toJSON(t)})},sync:function(){return e.sync.apply(this,arguments)},add:function(t,e){return this.set(t,n.extend({merge:!1},e,v))},remove:function(t,e){var i=!n.isArray(t);t=i?[t]:n.clone(t),e||(e={});var r,s,a,o;for(r=0,s=t.length;s>r;r++)o=t[r]=this.get(t[r]),o&&(delete this._byId[o.id],delete this._byId[o.cid],a=this.indexOf(o),this.models.splice(a,1),this.length--,e.silent||(e.index=a,o.trigger("remove",o,this,e)),this._removeReference(o,e));return i?t[0]:t},set:function(t,e){e=n.defaults({},e,g),e.parse&&(t=this.parse(t,e));var i=!n.isArray(t);t=i?t?[t]:[]:n.clone(t);var r,s,a,o,u,c,l,h=e.at,p=this.model,d=this.comparator&&null==h&&e.sort!==!1,v=n.isString(this.comparator)?this.comparator:null,m=[],y=[],b={},w=e.add,_=e.merge,x=e.remove,$=!d&&w&&x?[]:!1;for(r=0,s=t.length;s>r;r++){if(u=t[r]||{},a=u instanceof f?o=u:u[p.prototype.idAttribute||"id"],c=this.get(a))x&&(b[c.cid]=!0),_&&(u=u===o?o.attributes:u,e.parse&&(u=c.parse(u,e)),c.set(u,e),d&&!l&&c.hasChanged(v)&&(l=!0)),t[r]=c;else if(w){if(o=t[r]=this._prepareModel(u,e),!o)continue;m.push(o),this._addReference(o,e)}o=c||o,!$||!o.isNew()&&b[o.id]||$.push(o),b[o.id]=!0}if(x){for(r=0,s=this.length;s>r;++r)b[(o=this.models[r]).cid]||y.push(o);y.length&&this.remove(y,e)}if(m.length||$&&$.length)if(d&&(l=!0),this.length+=m.length,null!=h)for(r=0,s=m.length;s>r;r++)this.models.splice(h+r,0,m[r]);else{$&&(this.models.length=0);var k=$||m;for(r=0,s=k.length;s>r;r++)this.models.push(k[r])}if(l&&this.sort({silent:!0}),!e.silent){for(r=0,s=m.length;s>r;r++)(o=m[r]).trigger("add",o,this,e);(l||$&&$.length)&&this.trigger("sort",this,e)}return i?t[0]:t},reset:function(t,e){e||(e={});for(var i=0,r=this.models.length;r>i;i++)this._removeReference(this.models[i],e);return e.previousModels=this.models,this._reset(),t=this.add(t,n.extend({silent:!0},e)),e.silent||this.trigger("reset",this,e),t},push:function(t,e){return this.add(t,n.extend({at:this.length},e))},pop:function(t){var e=this.at(this.length-1);return this.remove(e,t),e},unshift:function(t,e){return this.add(t,n.extend({at:0},e))},shift:function(t){var e=this.at(0);return this.remove(e,t),e},slice:function(){return a.apply(this.models,arguments)},get:function(t){return null==t?void 0:this._byId[t]||this._byId[t.id]||this._byId[t.cid]},at:function(t){return this.models[t]},where:function(t,e){return n.isEmpty(t)?e?void 0:[]:this[e?"find":"filter"](function(e){for(var n in t)if(t[n]!==e.get(n))return!1;return!0})},findWhere:function(t){return this.where(t,!0)},sort:function(t){if(!this.comparator)throw Error("Cannot sort a set without a comparator");return t||(t={}),n.isString(this.comparator)||1===this.comparator.length?this.models=this.sortBy(this.comparator,this):this.models.sort(n.bind(this.comparator,this)),t.silent||this.trigger("sort",this,t),this},pluck:function(t){return n.invoke(this.models,"get",t)},fetch:function(t){t=t?n.clone(t):{},void 0===t.parse&&(t.parse=!0);var e=t.success,i=this;return t.success=function(n){var r=t.reset?"reset":"set";i[r](n,t),e&&e(i,n,t),i.trigger("sync",i,n,t)},C(this,t),this.sync("read",this,t)},create:function(t,e){if(e=e?n.clone(e):{},!(t=this._prepareModel(t,e)))return!1;e.wait||this.add(t,e);var i=this,r=e.success;return e.success=function(t,n){e.wait&&i.add(t,e),r&&r(t,n,e)},t.save(null,e),t},parse:function(t){return t},clone:function(){return new this.constructor(this.models)},_reset:function(){this.length=0,this.models=[],this._byId={}},_prepareModel:function(t,e){if(t instanceof f)return t;e=e?n.clone(e):{},e.collection=this;var i=new this.model(t,e);return i.validationError?(this.trigger("invalid",this,i.validationError,e),!1):i},_addReference:function(t){this._byId[t.cid]=t,null!=t.id&&(this._byId[t.id]=t),t.collection||(t.collection=this),t.on("all",this._onModelEvent,this)},_removeReference:function(t){this===t.collection&&delete t.collection,t.off("all",this._onModelEvent,this)},_onModelEvent:function(t,e,n,i){("add"!==t&&"remove"!==t||n===this)&&("destroy"===t&&this.remove(e,i),e&&t==="change:"+e.idAttribute&&(delete this._byId[e.previous(e.idAttribute)],null!=e.id&&(this._byId[e.id]=e)),this.trigger.apply(this,arguments))}});var m=["forEach","each","map","collect","reduce","foldl","inject","reduceRight","foldr","find","detect","filter","select","reject","every","all","some","any","include","contains","invoke","max","min","toArray","size","first","head","take","initial","rest","tail","drop","last","without","difference","indexOf","shuffle","lastIndexOf","isEmpty","chain","sample"];n.each(m,function(t){d.prototype[t]=function(){var e=a.call(arguments);return e.unshift(this.models),n[t].apply(n,e)}});var y=["groupBy","countBy","sortBy","indexBy"];n.each(y,function(t){d.prototype[t]=function(e,i){var r=n.isFunction(e)?e:function(t){return t.get(e)};return n[t](this.models,r,i)}});var b=e.View=function(t){this.cid=n.uniqueId("view"),t||(t={}),n.extend(this,n.pick(t,_)),this._ensureElement(),this.initialize.apply(this,arguments),this.delegateEvents()},w=/^(\S+)\s*(.*)$/,_=["model","collection","el","id","attributes","className","tagName","events"];n.extend(b.prototype,o,{tagName:"div",$:function(t){return this.$el.find(t)},initialize:function(){},render:function(){return this},remove:function(){return this.$el.remove(),this.stopListening(),this},setElement:function(t,n){return this.$el&&this.undelegateEvents(),this.$el=t instanceof e.$?t:e.$(t),this.el=this.$el[0],n!==!1&&this.delegateEvents(),this},delegateEvents:function(t){if(!t&&!(t=n.result(this,"events")))return this;this.undelegateEvents();for(var e in t){var i=t[e];if(n.isFunction(i)||(i=this[t[e]]),i){var r=e.match(w),s=r[1],a=r[2];i=n.bind(i,this),s+=".delegateEvents"+this.cid,""===a?this.$el.on(s,i):this.$el.on(s,a,i)}}return this},undelegateEvents:function(){return this.$el.off(".delegateEvents"+this.cid),this},_ensureElement:function(){if(this.el)this.setElement(n.result(this,"el"),!1);else{var t=n.extend({},n.result(this,"attributes"));this.id&&(t.id=n.result(this,"id")),this.className&&(t["class"]=n.result(this,"className"));var i=e.$("<"+n.result(this,"tagName")+">").attr(t);this.setElement(i,!1)}}}),e.sync=function(t,i,r){var s=$[t];n.defaults(r||(r={}),{emulateHTTP:e.emulateHTTP,emulateJSON:e.emulateJSON});var a={type:s,dataType:"json"};if(r.url||(a.url=n.result(i,"url")||M()),null!=r.data||!i||"create"!==t&&"update"!==t&&"patch"!==t||(a.contentType="application/json",a.data=JSON.stringify(r.attrs||i.toJSON(r))),r.emulateJSON&&(a.contentType="application/x-www-form-urlencoded",a.data=a.data?{model:a.data}:{}),r.emulateHTTP&&("PUT"===s||"DELETE"===s||"PATCH"===s)){a.type="POST",r.emulateJSON&&(a.data._method=s);var o=r.beforeSend;r.beforeSend=function(t){return t.setRequestHeader("X-HTTP-Method-Override",s),o?o.apply(this,arguments):void 0}}"GET"===a.type||r.emulateJSON||(a.processData=!1),"PATCH"===a.type&&x&&(a.xhr=function(){return new ActiveXObject("Microsoft.XMLHTTP")});var u=r.xhr=e.ajax(n.extend(a,r));return i.trigger("request",i,u,r),u};var x=!("undefined"==typeof window||!window.ActiveXObject||window.XMLHttpRequest&&(new XMLHttpRequest).dispatchEvent),$={create:"POST",update:"PUT",patch:"PATCH","delete":"DELETE",read:"GET"};e.ajax=function(){return e.$.ajax.apply(e.$,arguments)};var k=e.Router=function(t){t||(t={}),t.routes&&(this.routes=t.routes),this._bindRoutes(),this.initialize.apply(this,arguments)},E=/\((.*?)\)/g,T=/(\(\?)?:\w+/g,j=/\*\w+/g,A=/[\-{}\[\]+?.,\\\^$|#\s]/g;n.extend(k.prototype,o,{initialize:function(){},route:function(t,i,r){n.isRegExp(t)||(t=this._routeToRegExp(t)),n.isFunction(i)&&(r=i,i=""),r||(r=this[i]);var s=this;return e.history.route(t,function(n){var a=s._extractParameters(t,n);s.execute(r,a),s.trigger.apply(s,["route:"+i].concat(a)),s.trigger("route",i,a),e.history.trigger("route",s,i,a)}),this},execute:function(t,e){t&&t.apply(this,e)},navigate:function(t,n){return e.history.navigate(t,n),this},_bindRoutes:function(){if(this.routes){this.routes=n.result(this,"routes");for(var t,e=n.keys(this.routes);null!=(t=e.pop());)this.route(t,this.routes[t])}},_routeToRegExp:function(t){return t=t.replace(A,"\\$&").replace(E,"(?:$1)?").replace(T,function(t,e){return e?t:"([^/?]+)"}).replace(j,"([^?]*?)"),RegExp("^"+t+"(?:\\?(.*))?$")},_extractParameters:function(t,e){var i=t.exec(e).slice(1);return n.map(i,function(t,e){return e===i.length-1?t||null:t?decodeURIComponent(t):null})}});var O=e.History=function(){this.handlers=[],n.bindAll(this,"checkUrl"),"undefined"!=typeof window&&(this.location=window.location,this.history=window.history)},S=/^[#\/]|\s+$/g,R=/^\/+|\/+$/g,I=/msie [\w.]+/,P=/\/$/,N=/#.*$/;O.started=!1,n.extend(O.prototype,o,{interval:50,atRoot:function(){return this.location.pathname.replace(/[^\/]$/,"$&/")===this.root},getHash:function(t){var e=(t||this).location.href.match(/#(.*)$/);return e?e[1]:""},getFragment:function(t,e){if(null==t)if(this._hasPushState||!this._wantsHashChange||e){t=decodeURI(this.location.pathname+this.location.search);var n=this.root.replace(P,"");t.indexOf(n)||(t=t.slice(n.length))}else t=this.getHash();return t.replace(S,"")},start:function(t){if(O.started)throw Error("Backbone.history has already been started");O.started=!0,this.options=n.extend({root:"/"},this.options,t),this.root=this.options.root,this._wantsHashChange=this.options.hashChange!==!1,this._wantsPushState=!!this.options.pushState,this._hasPushState=!!(this.options.pushState&&this.history&&this.history.pushState);var i=this.getFragment(),r=document.documentMode,s=I.exec(navigator.userAgent.toLowerCase())&&(!r||7>=r);if(this.root=("/"+this.root+"/").replace(R,"/"),s&&this._wantsHashChange){var a=e.$('<iframe src="javascript:0" tabindex="-1">');this.iframe=a.hide().appendTo("body")[0].contentWindow,this.navigate(i)}this._hasPushState?e.$(window).on("popstate",this.checkUrl):this._wantsHashChange&&"onhashchange"in window&&!s?e.$(window).on("hashchange",this.checkUrl):this._wantsHashChange&&(this._checkUrlInterval=setInterval(this.checkUrl,this.interval)),this.fragment=i;var o=this.location;if(this._wantsHashChange&&this._wantsPushState){if(!this._hasPushState&&!this.atRoot())return this.fragment=this.getFragment(null,!0),this.location.replace(this.root+"#"+this.fragment),!0;this._hasPushState&&this.atRoot()&&o.hash&&(this.fragment=this.getHash().replace(S,""),this.history.replaceState({},document.title,this.root+this.fragment))}return this.options.silent?void 0:this.loadUrl()},stop:function(){e.$(window).off("popstate",this.checkUrl).off("hashchange",this.checkUrl),clearInterval(this._checkUrlInterval),O.started=!1},route:function(t,e){this.handlers.unshift({route:t,callback:e})},checkUrl:function(){var t=this.getFragment();return t===this.fragment&&this.iframe&&(t=this.getFragment(this.getHash(this.iframe))),t===this.fragment?!1:(this.iframe&&this.navigate(t),this.loadUrl(),void 0)},loadUrl:function(t){return t=this.fragment=this.getFragment(t),n.any(this.handlers,function(e){return e.route.test(t)?(e.callback(t),!0):void 0})},navigate:function(t,e){if(!O.started)return!1;e&&e!==!0||(e={trigger:!!e});var n=this.root+(t=this.getFragment(t||""));if(t=t.replace(N,""),this.fragment!==t){if(this.fragment=t,""===t&&"/"!==n&&(n=n.slice(0,-1)),this._hasPushState)this.history[e.replace?"replaceState":"pushState"]({},document.title,n);else{if(!this._wantsHashChange)return this.location.assign(n);this._updateHash(this.location,t,e.replace),this.iframe&&t!==this.getFragment(this.getHash(this.iframe))&&(e.replace||this.iframe.document.open().close(),this._updateHash(this.iframe.location,t,e.replace))}return e.trigger?this.loadUrl(t):void 0}},_updateHash:function(t,e,n){if(n){var i=t.href.replace(/(javascript:|#).*$/,"");t.replace(i+"#"+e)}else t.hash="#"+e}}),e.history=new O;var H=function(t,e){var i,r=this;i=t&&n.has(t,"constructor")?t.constructor:function(){return r.apply(this,arguments)},n.extend(i,r,e);var s=function(){this.constructor=i};return s.prototype=r.prototype,i.prototype=new s,t&&n.extend(i.prototype,t),i.__super__=r.prototype,i};f.extend=d.extend=k.extend=b.extend=O.extend=H;var M=function(){throw Error('A "url" property or function must be specified')},C=function(t,e){var n=e.error;e.error=function(i){n&&n(t,i,e),t.trigger("error",t,i,e)}};return e})});