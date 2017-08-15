define('/static/script/lib/plugin/box/fadebox', ['/static/script/lib/css/css',
	'/static/script/lib/css/getInfo',
	'/static/script/lib/css/windowInfo',
	'/static/script/lib/event/resize',
	'/static/script/lib/css/offset',
	'/static/script/lib/event/click',
	'/static/script/lib/plugin/dom/fix',
	'/static/script/lib/broswer/test',
	'/static/script/lib/dom/remove',
	'/static/script/lib/plugin/ie6/ie6Follow',
	'/static/script/lib/selector/selector',
	'/static/script/lib/dom/map',
	'/static/script/lib/event/addEvent'
	], function(require, exports, module) {

	var css=require('/static/script/lib/css/css');
	var getInfo=require('/static/script/lib/css/getInfo');
	var windowInfo=require('/static/script/lib/css/windowInfo');
	var resize=require('/static/script/lib/event/resize');
	var offset=require('/static/script/lib/css/offset');
	var click=require('/static/script/lib/event/click');
	var fix=require('/static/script/lib/plugin/dom/fix');
	var test=require('/static/script/lib/broswer/test');
	var remove=require('/static/script/lib/dom/remove');
	var ie6Follow=require('/static/script/lib/plugin/ie6/ie6Follow');
	var $=require('/static/script/lib/selector/selector');
	var map=require('/static/script/lib/dom/map');
	var addEvent=require('/static/script/lib/event/addEvent');
	
	function fadebox(options)
	{	
	    var options=options||{};

	    var ele=options.ele||null;

	    var relativeParent=options.relativeParent||null;

	    var aBtn=options.aBtn||null;

	    var aClose=options.aClose||null;

	    var onClosed = options.onClosed || null;

	    var zIndex=parseInt(options.zIndex)||2000;

	    var shadowIndex=options.shadowIndex||1999;

	    var opacity=parseFloat(options.opacity)||0.7;

	    var scroll=options.scroll||true;

	    var shadowBtn=options.shadowBtn||true;

	    var oShadow=null;

	    var oWrap=oWrap||null;

	    var fnDo=options.fnDo||function(){};

	    var boxWidth=0,boxHeight=0;

	    var autoClick=options.autoClick||true;

	    window._fadeBox_arr=window._fadeBox_arr||[];

	    if(!ele||!aBtn||!aClose)return;

	    _fadeBox_arr.push(ele[0]);
	   
	    ele[0].clickBtn=false;
	    ele[0].scrollBtn=scroll;
	    ele[0].shadowBtn=shadowBtn;

	    ele.clickBtn=false;

	    init();
	    //setAttr();
	    createShadow();
	    getSize();
		addShowEvent(); 
		addHideEvent();
		fnDo && fnDo(ele);

		/* 初始化 */
		function init()
		{
			css(ele,{display:'none'});
		}

		/*创建遮罩层*/
		function createShadow()
		{	
			/* 只创建一个遮罩层 */
			if(!window._fadeBox_added)
			{
				window._fadeBox_added=true;

				oShadow=document.createElement('div');

				css([oShadow],{display:'none'});

				oShadow.id='_fadeBoxShadow';

				document.body.appendChild(oShadow);
			}
		}

		/*获取容器大小*/
		function getSize()
		{	
			options.ele[0].style.display='block';

			boxWidth=getInfo(options.ele).outerWidth;

		 	boxHeight=getInfo(options.ele).outerHeight;	

		 	options.ele[0].style.display='none';		 
		}  
		
		/*显示时获取定位坐标*/
		function getPosition()
		{
			var boxLeft=options.left||0;

			var boxTop=options.top||0;

			var boxRight=options.right||0;

			var boxBottom=options.bottom||0;

			var windowWidth=windowInfo().width;

			var windowHeight=windowInfo().height;

			var relativeParentLeft=relativeParent?offset(relativeParent).left:0;

			var relativeParentTop=relativeParent?offset(relativeParent).top:0;

			var scrollTop=windowInfo().scrollTop;

			if(relativeParentLeft&&relativeParentTop)
			{
				var boxLeft=parseInt(options.left)+relativeParentLeft;
				var boxTop=parseInt(options.top)+relativeParentTop;
			}

			if(!boxLeft&&!boxTop&&!boxRight&&!boxBottom)
			{	
				var boxLeft=parseInt((windowWidth-boxWidth)/2);
				var boxTop=parseInt((windowHeight-boxHeight)/2);
			}
			
			setStyle(boxLeft,boxTop,boxRight,boxBottom,scrollTop,windowWidth,windowHeight);
		}

		/*设置样式*/
		function setStyle(boxLeft,boxTop,boxRight,boxBottom,scrollTop,windowWidth,windowHeight)
		{	
			/* dom */
			css(ele,{zIndex:zIndex});

			/* scroll */
			if(ele[0].scrollBtn===true||ele[0].scrollBtn==='true')
			{	
				fix({
					ele:ele,
					left:boxLeft,
					top:boxTop,
					right:boxRight,
					bottom:boxBottom
				});	
			}
			else if(ele[0].scrollBtn==='false')
			{		
				css(ele,{
					left:boxLeft+'px',
					top:parseInt(boxTop)+scrollTop+'px',
					position:'absolute'
				});	
			}

			/* shadow */
			if(test().ie6&&shadowBtn)
			{	
				if(oShadow)
				{	
					css([oShadow],{
						width:windowWidth,
						height:windowHeight,
						background:'#000',
						position:'absolute',
						left:0,
						top:scrollTop,
						zIndex:shadowIndex,
						opacity:opacity
					});
				}
				
			}
		}

		/* ie6+shadow层 */
		function except_ie6_shadow()
		{
			css([oShadow],{
				width:'100%',
				height:'100%',
				background:'#000',
				position:'fixed',
				left:0,
				top:0,
				zIndex:shadowIndex,
				opacity:opacity
			});
		}

		/*显示*/
		function show()
		{	
			var oShadow=$('#_fadeBoxShadow')[0];

			map(_fadeBox_arr,function(i){

				if(ele[0] !== _fadeBox_arr[i]) _fadeBox_arr[i].style.display = 'none';

			});
			
			css(ele,{display:'block'});
			if(oShadow&&(ele[0].shadowBtn===true)||(ele[0].shadowBtn==='true')) css(oShadow,{display:'block'});
		}

		/*隐藏*/
		function hide()
		{	
			var oShadow=$('#_fadeBoxShadow')[0];

			map(_fadeBox_arr,function(i){

				_fadeBox_arr[i].style.display='none';
				_fadeBox_arr[i].clickBtn=false;
			});

			if(oShadow&&shadowBtn) css(oShadow,{display:'none'});

			onClosed && onClosed();
		}

		/*绑定显示事件*/
		function addShowEvent()
		{	
			if(autoClick==='false')return;

			if(typeof aBtn!=='object')return;

			try{

				click(aBtn,function(){

					showBox();

				});
			
			}catch(e){};
		}

		function showBox()
		{	
			if(!ele[0].clickBtn)
			{	
				ele[0].clickBtn=true;

				oShadow = $('#_fadeBoxShadow')[0];

				if(!test().ie6&&shadowBtn&&oShadow)
				{	
					except_ie6_shadow();
				}
				else if(test().ie6&&shadowBtn&&oShadow)
				{	
					ie6Follow({
						ele:oShadow,
						left:'0',
						top:'0'
					});
				}

				getPosition();
				show();
				return false;
			}
		}
		/*绑定隐藏事件*/
		function addHideEvent()
		{
			click(aClose,function(){
				hide();
				return false;
			});
		}

		/*resize事件*/
		resize([window],function(){
			getPosition();
		});

		//return hide;
		return {show:showBox,hide:hide};
	}

	return fadebox;

});